<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'name',
        'type',
        'key',
    ];

    public $timestamps = false;

    public function reservations() {
        return $this->hasMany(
            Reservation::class,
            'vehicleId',
            'id'
        );
    }

    public function getReservations() {
        return $this->reservations()->get();
    }
}
