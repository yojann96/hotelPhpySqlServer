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
        Schema::create('HabitacionesAcomodTipo',function( Blueprint $table ){
            $table->increments('IdHabitacionesAcomodTipo');

            $table->integer('IdHabitaciones')->unsigned();
            $table->foreign('IdHabitaciones')->references('IdHabitaciones')->on('Habitaciones');

            $table->integer('IdHotel')->unsigned();
            $table->foreign('IdHotel')->references('IdHotel')->on('Hoteles');

            $table->integer('IdTipoHabitaciones')->unsigned();
            $table->foreign('IdTipoHabitaciones')->references('IdTipoHabitaciones')->on('TipoHabitaciones');

            $table->integer('IdTipoAcomodaciones')->unsigned();
            $table->foreign('IdTipoAcomodaciones')->references('IdTipoAcomodaciones')->on('TipoAcomodaciones');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('HabitacionesAcomodTipo');
    }
};
