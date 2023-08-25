

    <label for="ciudad" class="form-label mt-4">Acomodación</label>
    <select class="form-select" name="idTipoAcomodacion" id="idTipoAcomodacion">
    <option value="">Seleccione...</option>
    @foreach($listarAcomodacion as $acomodasion)
        <option value="{{$acomodasion->IdTipoAcomodaciones}}">{{$acomodasion->TipoAcomodaciones}}</option>
    @endforeach
    </select>


    <script>
        $("#idTipoAcomodacion").on("change", function(){            
            if($(this).val() == ''){
                $("#NroHabitaciones, #btnguardarHabitacion").hide();
            }else{
                $("#NroHabitaciones, #btnguardarHabitacion").show();
            }
        })
    </script>