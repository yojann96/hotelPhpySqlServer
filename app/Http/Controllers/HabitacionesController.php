<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ciudades;
use App\Models\Habitaciones;
use App\Models\Hoteles;
use App\Models\HabitacionesPorHotel;
use App\Models\HabitacionesAcomodacTipo;
use App\Models\TipoHabitaciones;

class HabitacionesController extends Controller
{
    public function habitacionesPorHotel($IdHotel){
        //dd($IdHotel);
        //  1.  Obtener información Hotel
        $InfoHotel = Hoteles::where('IdHotel', $IdHotel)->get();
        //dd($InfoHotel[0]);
        $InfoHotel = $InfoHotel[0];

        $ListarHabitacionesPorHotel = DB::table('dbo.HabitacionesPorHotel as HPH ')
        ->join('Habitaciones as HB','HB.IdHabitaciones','HPH.IdHabitaciones')
        ->join('HabitacionesAcomodTipo as HAT','HB.IdHabitaciones','=','HAT.IdHabitaciones')
        ->join('dbo.TipoHabitacionPorAcomodaciones AS THXA','HAT.IdTipoAcomodaciones','THXA.IdTipoAcomodaciones')
        ->join('TipoHabitaciones AS TH',[['THXA.IdTipoHabitaciones','TH.IdTipoHabitaciones'], ['HAT.IdTipoHabitaciones','TH.IdTipoHabitaciones'] ])
        ->join('TipoAcomodaciones AS TA','THXA.IdTipoAcomodaciones','TA.IdTipoAcomodaciones')
        ->select('HPH.IdHabitacionesPorHotel', 'HB.IdHabitaciones', 'HB.cantidad', 
            'TH.IdTipoHabitaciones', 'TH.TipoHabitaciones',
            'TA.IdTipoAcomodaciones', 'TA.TipoAcomodaciones')
        ->where('HPH.IdHotel',$IdHotel)->paginate(10);
        //dd($ListarHabitacionesPorHotel);
        return view('/Habitaciones/habitacionesPorHotel', compact('InfoHotel','ListarHabitacionesPorHotel','IdHotel'));
    }

    public function listarTipoHabitacion(Request $request){
        $listarTipoHabitaciones = DB::table('TipoHabitaciones')->get();
        $IdHotel = $request->IdHotel;
        return view('/Habitaciones/listarTipoHabitaciones', compact('listarTipoHabitaciones','IdHotel'));
    } 

    public function consultarAcomodacion( Request $request){
        $listarAcomodacion = DB::table('TipoHabitacionPorAcomodaciones AS THPA ')
        ->join('TipoHabitaciones AS TH','THPA.IdTipoHabitaciones','TH.IdTipoHabitaciones')
        ->join('TipoAcomodaciones AS TA','THPA.IdTipoAcomodaciones','TA.IdTipoAcomodaciones')
        ->select('TA.IdTipoAcomodaciones', 'TA.TipoAcomodaciones')
        ->where('THPA.idTipoHabitaciones', $request->IdTipoHabitacion)
        ->groupBy('TA.IdTipoAcomodaciones', 'TA.TipoAcomodaciones')->get();
        return view('/Habitaciones/listarAcomodacion', compact('listarAcomodacion') );
    } 

    public function crearHabitacion(Request $request){
        //dd($request->all());
        //  Crear registro en Tabla Habitaciones:
        $crearHabitacion = new Habitaciones();
        $crearHabitacion->cantidad = $request->NroHabitacionesCrear;
        $crearHabitacion->save();
        $idHabitacion  = $crearHabitacion->IdHabitaciones;

        //  Insert en tabla Pivot de Habitaciones y Tipo habitación:
        DB::table('HabitacionesAcomodTipo')->insert([
            'IdHabitaciones' => $idHabitacion,
            'IdHotel' => $request->Id_Hotel,
            'IdTipoHabitaciones' =>  $request->IdTipoHabitacion,
            'IdTipoAcomodaciones' =>  $request->idTipoAcomodacion,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //  Crear registro en Tabla HabitacionesPorHotel:
        DB::table('HabitacionesPorHotel')->insert([
            'IdHotel' => $request->Id_Hotel,
            'IdHabitaciones' => $idHabitacion,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        
        $flag = "SUCCESS";
        $smsRespuesta = "Registro creado exitosamente";
        //return view('/habitacionesPorHotel/2', compact('flag','smsRespuesta'));
        return view('/Hoteles/respuestaHotel', compact('flag','smsRespuesta'));

    }

}
