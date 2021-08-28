<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    use ApiTrait;

    public function add(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:155',
                'key' => 'required|string|max:55|unique:vehicles'
            ]);
            if ($validator->fails()) {
                return $this->parseValidatorResponse($validator->getMessageBag()->getMessages());
            }

            Vehicle::create($request->all());

            return $this->parseEndpoint([
                'type' => 'success',
                'message' => 'Pomyślnie dodano pojazd do bazy.'
            ],201);
        } catch (\Exception $e) {
            return $this->catchException($e);
        }
    }

    public function edit(Request $request, $id) {
        try {
            $objVehicle = Vehicle::find($id);

            if(!$objVehicle) {
                return $this->parseEndpoint([
                    'type' => 'warning',
                    'message' => 'Brak pojazdu o wskazanym id'
                ],404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:155',
                'key' => 'required|string|max:55|unique:vehicles,key,'.$id
            ]);
            if ($validator->fails()) {
                return $this->parseValidatorResponse($validator->getMessageBag()->getMessages());
            }

            $objVehicle->update($request->all());

            return $this->parseEndpoint([
                'type' => 'success',
                'message' => 'Pomyślnie edytowano pojazd o id '.$id.'.'
            ],200);
        } catch (\Exception $e) {
            return $this->catchException($e);
        }
    }

    public function delete($id) {
        try {
            $objVehicle = Vehicle::find($id);

            if(!$objVehicle) {
                return $this->parseEndpoint([
                    'type' => 'warning',
                    'message' => 'Brak pojazdu o wskazanym id'
                ],404);
            }

            $objVehicle->delete();

            return $this->parseEndpoint([
                'type' => 'success',
                'message' => 'Pomyślnie usunięto pojazd o id '.$id.'.'
            ],200);
        } catch (\Exception $e) {
            return $this->catchException($e);
        }
    }
}
