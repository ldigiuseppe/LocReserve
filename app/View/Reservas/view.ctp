<div class="reserva form">
    <h1>Reserva 
        <small>por <?php echo $this->data['Usuario']['apellido'] . ', ' . $this->data['Usuario']['nombre'] . ' el día ' . $this->Time->format($this->data['Reserva']['fecha_creacion'], '%d/%m/%Y %H:%M hs.'); ?>
            <?php
            echo $this->Html->link(__('Convertir a PDF'), array(
                'action' => 'view_pdf',
                'ext' => 'pdf',
                $this->data['Reserva']['id']
                    ), array(
                'target' => '_blank',
                'style' => 'float:right;'
            ));
            ?> 
        </small> 
    </h1>

    <?php echo $this->Form->create('Reserva'); ?>


    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Fechas</h3></div>
        <div class="panel-body">
            <label class="col-sm-2 control-label">Desde:</label>
            <div class="col-sm-3">
                <p class="form-control-static">
                    <?php echo $fecha_desde; ?>
                </p>
            </div>
            <label class="col-sm-2 control-label">Hasta:</label>
            <div class="col-sm-3">
                <p class="form-control-static">
                    <?php echo $fecha_hasta; ?>
                </p>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Locaciones</h3></div>


        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
                <table id="tabla_locaciones" class="table table-striped table-hover">
                    <tbody><tr>
                            <th>Tipo</th>
                            <th>Número</th>
                            <th>Adultos</th>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                    <p class="form-control-static">
                        <?php echo $this->data['Cliente']['nombre']; ?>
                    </p>
                </div>
                <label class="col-sm-2 control-label">Apellido:</label>
                <div class="col-sm-3">
                    <p class="form-control-static">
                        <?php echo $this->data['Cliente']['apellido']; ?>
                    </p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Teléfono:</label>
                <div class="col-sm-3">
                    <p class="form-control-static">
                        <?php echo $this->data['Cliente']['telefono']; ?>
                    </p>
                </div>
                <label class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-3">
                    <p class="form-control-static">
                        <?php echo $this->data['Cliente']['email']; ?>
                    </p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Dirección:</label>
                <div class="col-sm-3">
                    <p class="form-control-static">
                        <?php echo $this->data['Cliente']['direccion']; ?>
                    </p>
                </div>
                <label class="col-sm-2 control-label">Ciudad:</label>
                <div class="col-sm-3">
                    <p class="form-control-static">
                        <?php echo $this->data['Cliente']['ciudad']; ?>
                    </p>                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Ocupación:</label>
                <div class="col-sm-3">
                    <p class="form-control-static">
                        <?php echo $this->data['Cliente']['ocupacion']; ?>
                    </p>
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
                    <p class="form-control-static">
                        <?php
                        switch ($this->data['Reserva']['tipo_pago']) {
                            case 0:
                                echo "Parcial";
                                break;
                            case 1:
                                echo "Total";
                                break;
                            case 2:
                                echo "Impago";
                                break;
                        }
                        ?>
                    </p>
                </div>
                <label class="col-sm-1 control-label">Total:</label>
                <div class="col-sm-2">
                    <p class="form-control-static">
                        <?php echo $this->data['Reserva']['total'] ?>    
                    </p>
                </div>
                <label class="col-sm-1 control-label">Seña:</label>
                <div class="col-sm-2">
                    <p class="form-control-static">
                        <?php echo $this->data['Reserva']['senia'] ?>    
                    </p>
                </div>
                <label class="col-sm-1 control-label">Resta:</label>
            </div>

            <div class="form-group">
                <label class="col-sm-1 control-label">Notas:</label>
                <div class="col-sm-5">
                    <?php
                    echo $this->Form->textarea('Reserva.info_adicional', array('rows' => '6', 'cols' => '80', 'readonly' => 'readonly'))
                    ?>
                </div>

                <label class="col-sm-offset-1 col-sm-2 control-label">Horario de arribo:</label>
                <div class="col-sm-1">
                    <p class="form-control-static">
                        <?php echo $this->data['Reserva']['hora_arribo']; ?>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">

        var cantidadLocaciones = 0;

<?php
if (isset($this->data['LocacionReserva']) && count($this->data['LocacionReserva']) > 0) {
    foreach ($this->data['LocacionReserva'] as $locacionReserva) {
        echo "agregarLocacionATabla('" . $locacionReserva['Locacion']['TipoLocacion']['titulo'] . "', '" . $locacionReserva['Locacion']['nombre'] . "', '" . $locacionReserva['locacion_id'] . "', '" . $locacionReserva['Locacion']['TipoLocacion']['cantidad_adultos'] . "', '" . $locacionReserva['Locacion']['TipoLocacion']['cantidad_adultos'] . "');";
    }
}
?>

        function agregarLocacionATabla(tipoCabania, numeroCabania, numeroCabaniaVal, cantidadAdultos) {
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
                cols += '<input type="hidden" class="locacion_id" name="data[Reserva][LocacionReservaNueva][' + cantidadLocaciones + '][cantidad_adultos]" value="' + cantidadAdultos + '"/>';
                cols += '<input type="hidden" class="locacion_id" name="data[Reserva][LocacionReservaNueva][' + cantidadLocaciones + '][tipo_cabania]" value="' + tipoCabania + '"/>';
                cols += '<input type="hidden" class="locacion_id" name="data[Reserva][LocacionReservaNueva][' + cantidadLocaciones + '][numero_cabania]" value="' + numeroCabania + '"/>';
                cols += '<input type="hidden" id="locacion_id" class="locacion_id" name="data[Reserva][LocacionReservaNueva][' + cantidadLocaciones + '][locacion_id]" value="' + numeroCabaniaVal + '"/>';
                cantidadLocaciones++;
                newRow.append(cols);
                $("#tabla_locaciones").append(newRow);
            }
        }

        $("#tabla_locaciones").on('click', '.btnDelete', function () {
            $(this).parent().parent().remove();
        });
    </script>

</div>