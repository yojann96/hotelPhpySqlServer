<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ciudades;
use App\Models\Hoteles;
use App\Models\HabitacionesPorHotel;
use App\Models\TipoHabitaciones;

class HotelesController extends Controller
{   
    public function layout(){
        return view('/layout');
    }

    public function listarHoteles(){
        $Hoteles = DB::table('dbo.Hoteles as H')
            ->join('Ciudades as C', 'H.IdCiudadHotel','=','C.IdCiudad')
            ->paginate(10);
            //dd($Hoteles);
        if( count($Hoteles) >= 1){
            return view('/Hoteles/listarHoteles', compact('Hoteles'));
        }else{
            $flag = "SUCCESS";
            $smsRespuesta = "Aún no hay hoteles creados";
            return view('/Hoteles/respuestaHotel', compact('flag','smsRespuesta'));
        }
    }

    public function formularioHoteles(){
        $Ciudades = Ciudades::orderBy('NombreCiudad','ASC')->get();
        //dd($Ciudades);
        return view('/Hoteles/formularioHoteles', compact('Ciudades'));
    }

    public function guardarHotel(Request $request){
        //dd($request->all());
        //  1.  Validar datos:
        $this->validate($request,[
            'NombreHotel' => 'required',
            'DireccionHotel' => 'required',
            'NITHotel' => 'required|numeric',
            'IdCiudadHotel' => 'required|numeric',
            'NroHabsHotel' => 'required|numeric'
        ]);

        //  2.  Validar la No existencia del hotel con Nro NIT
        $flagHotel = DB::table('dbo.Hoteles')->where('NITHotel',trim($request->NITHotel))->limit(1)->get();
        //dd($flagHotel);
        if( count($flagHotel) == 1 ){   //  Hotel ya existe
            $flag = "ERROR";
            $smsRespuesta = "Hotel ya existente con NIT: ".$flagHotel[0]->NITHotel.", Nombre: ".$flagHotel[0]->NombreHotel;
        }else{  //  3.  Crear Hotel
            //dd($request->all());
            $NuevoHotel = new Hoteles($request->all());
            $NuevoHotel->NombreHotel      = trim($request->NombreHotel);
            $NuevoHotel->DireccionHotel   = trim($request->DireccionHotel);
            $NuevoHotel->IdCiudadHotel    = trim($request->IdCiudadHotel);
            $NuevoHotel->NITHotel          = trim($request->NITHotel);
            $NuevoHotel->NroHabsHotel       = trim($request->NroHabsHotel);
            $NuevoHotel->save();
            $idNuevoHotel  = $NuevoHotel->IdHotel;
            
            $flag = "SUCCESS";
            $smsRespuesta = "Hotel creado exitosamente. NIT: ".trim($request->NITHotel).", Nombre: ".trim($request->NombreHotel)." con ".trim($request->NroHabsHotel)." habitaciones";
        }
        return view('/Hoteles/respuestaHotel', compact('flag','smsRespuesta'));
    }

    

}
