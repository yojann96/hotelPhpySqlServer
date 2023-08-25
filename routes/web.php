<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelesController;
use App\Http\Controllers\HabitacionesController;

Route::get('/', function () {
    return view('layout');
});

route::get('layout', [HotelesController::class, 'layout'])->name('layout');
route::get('listarHoteles', [HotelesController::class, 'listarHoteles'] )->name('listarHoteles');
route::get('formularioHoteles', [HotelesController::class, 'formularioHoteles'] )->name('formularioHoteles');
route::post('guardarHotel', [HotelesController::class, 'guardarHotel'] )->name('guardarHotel');

route::get('habitacionesPorHotel/{IdHotel}', [HabitacionesController::class, 'habitacionesPorHotel'] )->name('habitacionesPorHotel');
route::post('listarTipoHabitacion', [HabitacionesController::class, 'listarTipoHabitacion'] )->name('listarTipoHabitacion');
route::post('consultarAcomodacion', [HabitacionesController::class, 'consultarAcomodacion'] )->name('consultarAcomodacion');

route::post('guardarAcomodacion', [HabitacionesController::class, 'guardarAcomodacion'] )->name('guardarAcomodacion');
route::post('crearHabitacion', [HabitacionesController::class, 'crearHabitacion'] )->name('crearHabitacion');

