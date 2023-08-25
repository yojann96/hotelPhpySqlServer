@extends('layout')

@section('contenido')

    <?php
        $flag_alert = 'success';
        if( $flag != 'SUCCESS' ){
            $flag_alert = 'danger';
        }
    ?>
    
    <div class="alert alert-{{$flag_alert}}" role="alert">
        <strong>{{$smsRespuesta}}</strong>
        <br>
        <a href="{{route('listarHoteles')}}">Inicio</a>
    </div>
    
@stop