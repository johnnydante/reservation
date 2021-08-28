<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'vehicleId',
        'email',
        'activityType',
        'activityKey',
        'fromDate',
        'toDate',
    ];

    public $timestamps = false;

    public function vehicle() {
        return $this->belongsTo(
            Vehicle::class,
            'vehicleId',
            'id'
        );
    }

    public function getVehicle() {
        return $this->vehicle()->first();
    }
}
