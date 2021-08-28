<?php

namespace App\Http\Controllers;

use App\Mail\Reservation as MailReservation;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CronController extends Controller
{
    public function sendReservationReminder() {
        try {
            $colReservations = Reservation::whereDate('fromDate', Carbon::tomorrow()->format('Y-m-d'))->get();
            if($colReservations->count() > 0) {
                foreach ($colReservations as $objReservation) {
                    Mail::to($objReservation->email)->send(new MailReservation(
                        'Przypomnienie o rezerwacji',
                        $objReservation->getVehicle()->name
                    ));
                }
                Log::debug('Reminder emails sent successfully');
            } else {
                Log::debug('No reservations to remind');
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
            error_log($e->getTraceAsString());
        }
    }
}
