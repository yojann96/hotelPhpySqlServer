<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('HabitacionesPorHotel',function( Blueprint $table ){
            $table->increments('IdHabitacionesPorHotel');

            $table->integer('IdHotel')->unsigned();
            $table->foreign('IdHotel')->references('IdHotel')->on('Hoteles');

            $table->integer('IdHabitaciones')->unsigned();
            $table->foreign('IdHabitaciones')->references('IdHabitaciones')->on('Habitaciones');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('HabitacionesPorHotel');
    }
};
