var nroHabsDisponibles = 0;

function validarOcultarBtns() {
    var nroHabsEnTotal = $("#nroHabsEnTotal").val();
    var NroHbsCreadas = $("#NroHabitacionesCreadas").val();
    if (isNaN(NroHbsCreadas)) {
        var NroHbsCreadas = 0;
    }
    //alert(nroHabsEnTotal + "----" + NroHbsCreadas);

    if (nroHabsEnTotal == NroHbsCreadas) {
        $("#msmLimiteHabitaciones").show();
        $(".Crear_Habitacion").remove();
    } else {
        $("#msmLimiteHabitaciones").remove();
    }


    NroHabsDisponibles = parseInt(nroHabsEnTotal) - parseInt(NroHbsCreadas);
    $("#nroHabsDisponibles").val(NroHabsDisponibles);

}

function cargarTipoHabitaciones() {
    var data = { 'IdHotel': $("#IdHotel").val() };
    solicitudAjax('listarTipoHabitacion', 'CreacionHabitacionesGeneral', 'POST', data); // en funcionGeneral.js
}

function solicitudAjax(url, divResultado, method, data) {
    var result = '';
    //hacemos la petición ajax   
    $.ajax({
        headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
        url: "../" + url,
        type: method,
        data: data,
        //necesario para subir archivos via ajax
        cache: false,
        //mientras enviamos el archivo
        beforeSend: function() {
            $("#" + divResultado + "").html($("#cargador_empresa").html());
        },
        //una vez finalizado correctamente
        success: function(data, status) {
            if (data != '') {
                $("#" + divResultado + "").html(data);
            }
            result = status;
        },
        error: function(data) {
            result = data.status;
        },
        async: false
    });
    return result;
}