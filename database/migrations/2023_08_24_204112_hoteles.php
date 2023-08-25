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
        Schema::create('Hoteles',function( Blueprint $table ){
            $table->increments('IdHotel');
            $table->string('NombreHotel', 80);
            $table->string('DireccionHotel', 80);
            
            $table->integer('IdCiudadHotel')->unsigned();
            $table->foreign('IdCiudadHotel')->references('IdCiudad')->on('Ciudades');

            $table->integer('NITHotel');
            $table->integer('NroHabsHotel');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('Hoteles');
    }
};
