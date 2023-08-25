
@section('contenido')
{{csrf_field()}}
<br><br>
<div class="container mx-auto border border-primary">
    <h1>Parametrizar habitación</h1>
    <hr>
    
    <form method="POST" action="{{route('crearHabitacion')}}" >
        {{csrf_field()}}
        <div class="form-group col-md-12 row">
            <div class="form-group col-md-4">
                <label for="Tipo_Habitacion" class="form-label mt-4">Tipo Habitacion</label>
                <select class="form-select" name="IdTipoHabitacion" id="IdTipoHabitacion">
                    <option value="">Seleccione una opción...</option>
                    @foreach( $listarTipoHabitaciones as $TipoHabitacion )
                        <option value="{{$TipoHabitacion->IdTipoHabitaciones}}">{{$TipoHabitacion->TipoHabitaciones}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4" id="RtaListaTipoAcomodasion"></div>
            
            <div class="form-group col-md-3" id="NroHabitaciones">
                    <label for="Tipo_Habitacion" class="form-label mt-4">Nro Habitaciones</label>
                    <input type="number" id="NroHabitacionesCrear" name="NroHabitacionesCrear" onblur="validarDisponibilidadHabs();">
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary" id="btnguardarHabitacion">Guardar</button><br><br>
        <input type="hidden" id="Id_Hotel" name="Id_Hotel" readonly value="{{$IdHotel}}">
        </fieldset>        
    </form>
    
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    $("#NroHabitaciones, #btnguardarHabitacion").hide();
    var divResult = 'RtaListaTipoAcomodasion';
    $("#IdTipoHabitacion").on("change", function(){
        $("#NroHabitaciones, #btnguardarHabitacion").hide();
        var IdTipoHabitacion = $("#IdTipoHabitacion option:selected").val();
        $("#NroHabitacionesCrear").val("1");
        if( IdTipoHabitacion == '' ){
            $("#RtaListaTipoAcomodasion").empty();
        }else{
            var data = {
                IdTipoHabitacion: IdTipoHabitacion
            };
            solicitudAjax('consultarAcomodacion', 'RtaListaTipoAcomodasion', 'POST', data); // en funcionGeneral.js
        }
    });
    
    function validarDisponibilidadHabs() {
        var NroUndsDisponibles = 0;
        var nroHabsEnTotal = $("#nroHabsEnTotal").val();
        var NroHabitacionesCreadas = $("#NroHabitacionesCreadas").val();
        var saldoHabitaciones = parseFloat(nroHabsEnTotal) - NroHabitacionesCreadas;
        if (isNaN(saldoHabitaciones)) { saldoHabitaciones = $("#nroHabsEnTotal").val(); }
        var undASolicitar = parseFloat($("#NroHabitacionesCrear").val());
        if (undASolicitar >= 1) {   //  Validar que sea mayor a 0
            //  Validar el nro de unds a crear esté disponible:
            //alert("Nro Unidades a solicitar: " + undASolicitar+"----"+nroHabsEnTotal);
            if(parseInt(undASolicitar) <= saldoHabitaciones){
                $("#btnguardarHabitacion").show();
            }else{
                $("#btnguardarHabitacion").hide();
                alert("Excede el nro de unidades disponibles. Sólo restan "+saldoHabitaciones+" unidad(es) por usar");
                $("#NroHabitacionesCrear").val("0");
            }        
        } else {
            $("#btnguardarHabitacion").hide();
        }

    }
    

</script>



