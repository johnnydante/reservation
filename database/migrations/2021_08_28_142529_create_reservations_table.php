<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vehicleId');
            $table->string('email',255);
            $table->string('activityType',155);
            $table->string('activityKey',55);
            $table->date('fromDate');
            $table->date('toDate');

            $table->foreign('vehicleId')
                ->references('id')
                ->on('vehicles')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['vehicleId']);
        });
        Schema::dropIfExists('reservations');
    }
}
