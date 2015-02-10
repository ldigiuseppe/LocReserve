/* Vacia opciones de select list */
function vaciarLista(nombreLista, valorDefecto) {
    var $selectList = $(nombreLista);
    $selectList.empty(); // elimino opciones viejas
    if (typeof valorDefecto !== 'undefined') {
        var option = $('<option></option>').attr("value", "option value").text(valorDefecto);
        $selectList.append(option);
    }
}

/*Cuando agrega locacion nueva*/
function OnClickAgregaLocacion() {

    var tipoCabania = $('#ReservaTipoCabania').find(":selected").text();
    var numeroCabania = $('#ReservaLocacionId').find(":selected").text();
    var numeroCabaniaVal = $('#ReservaLocacionId').find(":selected").val();
    var cantidadAdultos = $('#ReservaCantidadAdultos').find(":selected").text();
    var cantidadAdultosVal = $('#ReservaCantidadAdultos').find(":selected").val();

    if (numeroCabaniaVal > 0) {

    } else {
        return;
    }

    agregarLocacionATabla(tipoCabania, numeroCabania, numeroCabaniaVal, cantidadAdultos, cantidadAdultosVal);
}

function agregarLocacionATabla(tipoCabania, numeroCabania, numeroCabaniaVal, cantidadAdultos, cantidadAdultosVal) {
    var existe = false;

    $("#tabla_locaciones").each(function () {
        $(this).find('[id=locacion_id]').each(function () {
            if (this.value === numeroCabaniaVal) {
                existe = true;
            }
        });
    });

    if (!existe) {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td>' + tipoCabania + '</td>';
        cols += '<td>' + numeroCabania + '</td>';
        cols += '<td>' + cantidadAdultos + '</td>';
        cols += '<td><input type="button" class="btnDelete"  value="Quitar" ></td>';
        cols += '<input type="hidden" class="locacion_id" name="data[Reserva][LocacionReserva][' + cantidadLocaciones + '][cantidad_adultos]" value="' + cantidadAdultos + '"/>';
        cols += '<input type="hidden" class="locacion_id" name="data[Reserva][LocacionReserva][' + cantidadLocaciones + '][tipo_cabania]" value="' + tipoCabania + '"/>';
        cols += '<input type="hidden" class="locacion_id" name="data[Reserva][LocacionReserva][' + cantidadLocaciones + '][numero_cabania]" value="' + numeroCabania + '"/>';
        cols += '<input type="hidden" id="locacion_id" class="locacion_id" name="data[Reserva][LocacionReserva][' + cantidadLocaciones + '][locacion_id]" value="' + numeroCabaniaVal + '"/>';
        cantidadLocaciones++;
        newRow.append(cols);
        $("#tabla_locaciones").append(newRow);
    }
}

function cargarTipoLocaciones() {

    $("#tabla_locaciones tbody").remove();
    vaciarLista('#ReservaLocacionId', "Seleccione Tipo");
    vaciarLista('#ReservaCantidadAdultos', "Seleccione Tipo");

    $fecha_inicial = $("#fecha_desde").val();
    $fecha_final = $("#fecha_hasta").val();

    if ($fecha_inicial == '' || $fecha_final == '') {
        return;
    }

    // Serialize the data in the form
    var serializedData = $('#ReservaAddForm').serialize();

    // Fire off the request to /form.php
    request = $.ajax({
        url: "/locaciones/popularTiposLocacion",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {

        var $selectList = $("#ReservaTipoCabania");

        result = jQuery.parseJSON(response);

        $selectList.empty(); // remove old options
        var option = $('<option></option>').attr("value", "option value").text("Seleccione");
        $selectList.append(option);

        if (typeof result != "undefined" && result != null && result.length > 0) {
            $('#alerta_disponibilidad').empty();

            for (var k in result) {
                $selectList.append($("<option></option>")
                        .attr("value", result[k].tipos_locacion.id)
                        .text(result[k].tipos_locacion.titulo));
            }
        } else {
            $('#alerta_disponibilidad').empty();
            $('#alerta_disponibilidad').append("Para las fechas seleccionadas no hay disponibilidad");
        }
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
        // Log the error to the console
        console.error(
                "Ha ocurrido el siguiente error: " +
                textStatus, errorThrown
                );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs

    });
}

function cargarLocaciones() {
    // Serialize the data in the form
    var serializedData = $('#ReservaAddForm').serialize();

    // Fire off the request to /form.php
    request = $.ajax({
        url: "/locaciones/popularLocaciones",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {

        var $cantidadAdultos = 0;

        result = jQuery.parseJSON(response);

        vaciarLista('#ReservaLocacionId', "Seleccione");
        var $selectList = $('#ReservaLocacionId');

        for (var k in result) {
            $selectList.append($("<option></option>")
                    .attr("value", result[k].locaciones.id)
                    .text(result[k].locaciones.nombre));
            $cantidadAdultos = result[k].tipos_locacion.cantidad_adultos;
        }

        vaciarLista('#ReservaCantidadAdultos');
        var $selectCandidadAdultos = $('#ReservaCantidadAdultos');

        for (n = $cantidadAdultos; n > 0; n--) {
            $selectCandidadAdultos.append($("<option></option>")
                    .attr("value", n)
                    .text(n));
        }
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
        // Log the error to the console
        console.error(
                "Ha ocurrido el siguiente error: " +
                textStatus, errorThrown
                );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs

    });
}
