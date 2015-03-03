<div class="reserva form">
    <h1>Nueva Reserva</h1>

    <?php echo $this->Form->create('Reserva'); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Fechas</h3></div>
        <div class="panel-body">
            <label class="col-sm-2 control-label">Desde:</label>
            <div class="col-sm-3">
                <?php
                echo $this->Form->input('Reserva.fecha_desde', array(
                    'id' => 'fecha_desde',
                    'type' => 'text'
                ));
                ?>
            </div>
            <label class="col-sm-2 control-label">Hasta:</label>
            <div class="col-sm-3">
                <?php
                echo $this->Form->input('Reserva.fecha_hasta', array(
                    'id' => 'fecha_hasta',
                    'type' => 'text'
                ));
                ?>
            </div>
            <div class="col-sm-8" id="alerta_disponibilidad"></div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Locaciones</h3></div>
        <div class="panel-body">
            <label class="col-sm-2 control-label">Tipo:</label>
            <div class="col-sm-4">
                <?php
                echo $this->Form->input('tipo_cabania', array(
                    'options' => array(),
                    'empty' => 'Seleccione Fecha',
                    'onChange' => 'cargarLocaciones()')
                );
                ?>
            </div>
            <label class="col-sm-2 control-label">N°:</label>
            <div class="col-sm-4">
                <?php
                echo $this->Form->input('locacion_id', array(
                    'options' => array(),
                    'empty' => 'Seleccione Tipo'));
                ?>
            </div>
        </div>
        <div class="panel-body">
            <label class="col-sm-2 control-label">Adultos:</label>
            <div class="col-sm-3">
                <?php
                echo $this->Form->input('cantidad_adultos', array(
                    'options' => array(),
                    'empty' => 'Seleccione Tipo'));
                ?>
            </div>
            <div class="col-sm-5">
                <input type="button" id="bonton_agregar" class="btn btn-primary" id="addrow" value="Agregar" onclick="OnClickAgregaLocacion()"/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
            <?php
            if (!empty($this->validationErrors['LocacionReserva']['validaLocaciones'])) {
                echo '<p class="text-danger">' . $this->validationErrors['LocacionReserva']['validaLocaciones'] . '</p>';
            }
            ?>  
            <table id="tabla_locaciones" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Número</th>
                        <th>Adultos</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Calendario</h3></div>
        <div class="panel-body">
            <div id="calendario"></div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Cliente</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-3">
                    <?php
                    echo $this->Form->input('Cliente.nombre', array(
                        'id' => 'nombre',
                        'type' => 'text'
                    ));
                    ?>
                </div>
                <label class="col-sm-2 control-label">Apellido:</label>
                <div class="col-sm-3">
                    <?php
                    echo $this->Form->input('Cliente.apellido', array(
                        'id' => 'apellido',
                        'type' => 'text'
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Teléfono:</label>
                <div class="col-sm-3">
                    <?php
                    echo $this->Form->input('Cliente.telefono', array(
                        'id' => 'nombre',
                        'type' => 'text'
                    ));
                    ?>
                </div>
                <label class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-3">
                    <?php
                    echo $this->Form->input('Cliente.email', array(
                        'id' => 'apellido',
                        'type' => 'text'
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Dirección:</label>
                <div class="col-sm-3">
                    <?php
                    echo $this->Form->input('Cliente.direccion', array(
                        'id' => 'nombre',
                        'type' => 'text'
                    ));
                    ?>
                </div>
                <label class="col-sm-2 control-label">Ciudad:</label>
                <div class="col-sm-3">
                    <?php
                    echo $this->Form->input('Cliente.ciudad', array(
                        'id' => 'apellido',
                        'type' => 'text'
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Ocupación:</label>
                <div class="col-sm-3">
                    <?php
                    echo $this->Form->input('Cliente.ocupacion', array(
                        'id' => 'apellido',
                        'type' => 'text'
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Reserva</h3>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-1 control-label">Pago:</label>
                <div class="col-sm-2">
                    <p class="form-control-static" id="tipo_pago"></p>
                    <?php
                    echo $this->Form->input('Reserva.tipo_pago', array(
                        'options' => array("Pago parcial", "Pago total", "Impago", "Bonificado"),
                        'readonly' => 'readonly',
                        'type' => 'hidden'
                    ));
                    ?>
                </div>
                <label class="col-sm-1 control-label">Total:</label>
                <div class="col-sm-2">
                    <?php
                    echo $this->Form->input('Reserva.total', array(
                        'onChange' => 'cargarRestante()')
                    );
                    ?>
                </div>
                <label class="col-sm-1 control-label">Seña:</label>
                <div class="col-sm-2">
                    <?php
                    echo $this->Form->input('Reserva.senia', array(
                        'onChange' => 'cargarRestante()')
                    );
                    ?>
                </div>
                <label class="col-sm-1 control-label">Resta:</label>
                <div class="col-sm-2">
                    <p class="form-control-static" id="resta">
                    </p>
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-1 control-label">Notas:</label>
                <div class="col-sm-5">
                    <?php echo $this->Form->textarea('Reserva.info_adicional', array('rows' => '6', 'cols' => '80'));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Horario de arribo:</label>
                <div class="col-sm-1">
                    <?php echo $this->Form->hour('hora_arribo', true); ?>
                </div>
                <div class="col-sm-offset-2 col-sm-2">
                    <?php echo $this->Form->submit(__('Guardar'), array('class' => 'btn btn-primary')) ?>
                </div>

            </div>


            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>


<script type="text/javascript">

    var cantidadLocaciones = 0;
    /*Cargo datepicker*/
    $(function () {

        cargarTipoLocaciones();
        $("#fecha_desde").datepicker({
            numberOfMonths: 2,
            dateFormat: "dd/mm/yy",
            onClose: function (selectedDate) {
                $("#fecha_hasta").datepicker("option", "minDate", selectedDate);
            },
            onSelect: function (date) {
                cargarTipoLocaciones();
            }
        });
        $("#fecha_hasta").datepicker({
            numberOfMonths: 2,
            dateFormat: 'dd/mm/yy',
            onClose: function (selectedDate) {
                $("#fecha_desde").datepicker("option", "maxDate", selectedDate);
            },
            onSelect: function (date) {
                cargarTipoLocaciones();
            }
        });
        $.datepicker.regional['es'];
    });
    /*Cargo fullcalendar*/
    $('#calendario').fullCalendar({
        eventAfterRender: function (event, element, view) {
            $(element).css('width', '100px');
        },
        events: {
            url: '/reservas/calendarFeed2'/*,
             error: function () {
             $('#script-warning').show();
             }*/
        },
        /*loading: function (bool) {
         $('#loading').toggle(bool);
         },*/
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
        },
        lang: 'es',
        height: 500,
        selectable: true,
    });
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

    $("#tabla_locaciones").on('click', '.btnDelete', function () {
        $(this).parent().parent().remove();
    });
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

    // todo: quitar y agregar la de la shared_lib
    function vaciarLista(nombreLista, valorDefecto) {
        var $selectList = $(nombreLista);
        $selectList.empty(); // elimino opciones viejas
        if (typeof valorDefecto !== 'undefined') {
            var option = $('<option></option>').attr("value", "option value").text(valorDefecto);
            $selectList.append(option);
        }
    }

    function cargarRestante() {
        $total = $("#ReservaTotal").val();
        $senia = $("#ReservaSenia").val();

        $diff = $total - $senia;

        $("#resta").empty();

        if ($total !== '' && $senia !== '') {
            $("#resta").append($diff);
        }

        if ($total <= 0) {
            $("#tipo_pago").text("Bonificado");
            $("#ReservaTipoPago").val("3"); // pago bonificado   
        } else {
            if ($senia === '0') {
                $("#tipo_pago").text("Impago");
                $("#ReservaTipoPago").val("2"); // inpago
            } else if ($diff <= 0) {
                $("#tipo_pago").text("Total");
                $("#ReservaTipoPago").val("1"); // pago total
            } else {
                $("#tipo_pago").text("Parcial");
                $("#ReservaTipoPago").val("0"); // pago parcial
            }
        }
    }

<?php
if (isset($this->data['Reserva']['LocacionReserva']) && count($this->data['Reserva']['LocacionReserva']) > 0) {
    foreach ($this->data['Reserva']['LocacionReserva'] as $locacionReserva) {
        echo "agregarLocacionATabla('" . $locacionReserva['tipo_cabania'] . "', '" . $locacionReserva['numero_cabania'] . "', '" . $locacionReserva['locacion_id'] . "', '" . $locacionReserva['cantidad_adultos'] . "', '" . $locacionReserva['cantidad_adultos_val'] . "');";
    }
}
?>

</script>

</div>
