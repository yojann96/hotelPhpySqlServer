

@extends('layout')

@section('contenido')
<br>
{{csrf_field()}}

<input type="hidden" disabled id="IdHotel" value="{{$IdHotel}}">
<input type="hidden" disabled id="nroHabsEnTotal" value="{{$InfoHotel->NroHabsHotel}}">

<div class="form-group" id="InformacionHotel">
    <h3 class="text-align-center">Datos del hotel: <strong> {{$InfoHotel->NombreHotel}} </strong></h3>
    <div class="container col-md-12 row">
        <div class="col-md-3">
            <strong>Dirección</strong>: {{$InfoHotel->DireccionHotel}}
        </div>
        <div class="col-md-3">
            <strong>NIT</strong>: {{$InfoHotel->NITHotel}}
        </div>
        <div class="col-md-3">
            <strong>Nro. Habs.</strong>:  <strong class="alert alert-success text-danger"> {{$InfoHotel->NroHabsHotel}} </strong>
        </div>
    </div>
</div>

<br>

<div id="msmLimiteHabitaciones">
    <div class="alert alert-warning  d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                Ha alcanzado el máximo de habitaciones permitidas para este hotel.
            </div>
    </div>
</div>
<button type="button" class="btn btn-danger Crear_Habitacion"  data-whatever="@mdo" onclick="cargarTipoHabitaciones();">
    Agregar Habitación</a>
</button>



@if( count($ListarHabitacionesPorHotel) >= 1 )
    {{csrf_field()}}
    <?php $nroHabs = 0; ?>
    <table class="table table-striped table-bordered mx-auto">
        <thead>
            <tr class="table-info">
                <th scope="col">Nro Habitaciones</th>
                <th scope="col">Tipo Habitación </th>
                <th scope="col">Tipo Acomodación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ListarHabitacionesPorHotel as $Habitacion)
                <tr>
                    <td>{{$Habitacion->cantidad}}</td>
                    <td>{{$Habitacion->TipoHabitaciones}}</td>
                    <td>{{$Habitacion->TipoAcomodaciones}}</td>
                </tr>
                <?php $nroHabs = $nroHabs + $Habitacion->cantidad; ?>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" disabled name="NroHabitacionesCreadas" id="NroHabitacionesCreadas" value="{{$nroHabs}}">
    <div>
        {{ $ListarHabitacionesPorHotel->links() }}
    </div>
@endif

<br>

<div id="CreacionHabitacionesGeneral" name="CreacionHabitacionesGeneral">

</div>

<div id="Listar_TiposHabitacion">
    @yield('ListarTiposHabitacion')
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{asset('../public/js/funcionGeneral.js')}}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
    $("#msmLimiteHabitaciones").hide();
    $(document).ready(function(){
        validarOcultarBtns();
    });
    

</script>

@stop