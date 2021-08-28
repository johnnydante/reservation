<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\User\ReservationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/* Routki wyciągnięte poza middleware dla celów testowych: */

Route::post('add-vehicle',[VehicleController::class,'add'])
    ->name('admin.add.vehicle');
Route::put('edit-vehicle/{id}',[VehicleController::class,'edit'])
    ->name('admin.edit.vehicle');
Route::delete('delete-vehicle/{id}',[VehicleController::class,'delete'])
    ->name('admin.delete.vehicle');


/* Routki docelowe dla gotowej aplikacji: */

//Route::middleware(['auth'])->group(function (){
//    Route::middleware(['admin'])->group(function (){
//        Route::group(['prefix' => 'admin'], function (){
//            Route::post('add-vehicle',[VehicleController::class,'add'])
//                ->name('admin.add.vehicle');
//            Route::post('edit-vehicle/{id}',[VehicleController::class,'edit'])
//                ->name('admin.edit.vehicle');
//            Route::get('delete-vehicle/{id}',[VehicleController::class,'delete'])
//                ->name('admin.delete.vehicle');
//        });
//    });
//});


Route::group(['prefix' => 'client'], function (){
    Route::post('new-reservation',[ReservationController::class,'add'])
        ->name('user.add.reservation');
});
