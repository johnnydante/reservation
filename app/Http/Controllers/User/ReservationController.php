<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reservation as MailReservation;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    use ApiTrait;

    public function add(Request $request) {
        try {
            $arrRequest = $request->all();

            $validator = Validator::make($arrRequest, [
                'vehicleId' => 'required|numeric|exists:vehicles,id',
                'email' => 'required|email',
                'fromDate' => 'required|date_format:Y-m-d|after:'.Carbon::today()->format('Y-m-d'),
                'toDate' => 'required|date_format:Y-m-d|after:'.$arrRequest['fromDate']
            ]);
            if ($validator->fails()) {
                return $this->parseValidatorResponse($validator->getMessageBag()->getMessages());
            }

            if(!$this->isVehicleAvailable($arrRequest)) {
                return $this->parseEndpoint([
                    'type' => 'warning',
                    'message' => 'Pojazd jest zarezerwowany w wybranym terminie.'
                ],403);
            }

            $objActivity = $this->getActivity();
            if(!$objActivity) {
                return $this->parseEndpoint([
                    'type' => 'warning',
                    'message' => 'Nie udało się pobrać aktywności. Spróbuj ponownie.'
                ],400);
            }
            $arrRequest['activityType'] = $objActivity->type;
            $arrRequest['activityKey'] = $objActivity->key;

            DB::beginTransaction();
            $objReservation = new Reservation();
            $objReservation->fill($arrRequest);
            $objReservation->save();

            $objVehicle = $objReservation->getVehicle();

            Mail::to($arrRequest['email'])->send(new MailReservation(
                'Nowa rezerwacja',
                $objVehicle->name
            ));
            DB::commit();

            return $this->parseEndpoint([
                'type' => 'success',
                'message' => 'Pomyślnie dodano rezerwację na pojazd '.$objVehicle->name.'.'
            ],201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->catchException($e);
        }
    }

    private function getActivity() {
        return Http::get('https://www.boredapi.com/api/activity/?participants=1')->json();
    }

    private function isVehicleAvailable($arrRequest) {
        $colReservations = Reservation::where('vehicleId',$arrRequest['vehicleId'])
            ->where(function ($query) use ($arrRequest) {
                $query->whereDate('fromDate', '<=', $arrRequest['fromDate'])
                    ->whereDate('toDate','>=', $arrRequest['fromDate']);
            })->orWhere(function ($query) use ($arrRequest) {
                $query->whereDate('fromDate', '<=', $arrRequest['toDate'])
                    ->whereDate('fromDate', '>', $arrRequest['fromDate']);
            })->get();

        if($colReservations->count() > 0) {
            return false;
        }
        return true;
    }
}
