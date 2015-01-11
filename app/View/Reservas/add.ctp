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

            <script>
                $(function () {
                    $("#fecha_desde").datepicker({
                        numberOfMonths: 2,
                        dateFormat: "dd/mm/y"
                    });
                    $("#fecha_hasta").datepicker({
                        numberOfMonths: 2,
                        dateFormat: 'dd/mm/y'

                    });
                    $.datepicker.regional['es'];
                });
            </script>        
        </div>
    </div>



    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Locaciones</h3></div>
        <div class="panel-body">
            <label class="col-sm-1 control-label">Tipo:</label>
            <div class="col-sm-2">
                <?php
                echo $this->Form->input('tipo_cabania', array(
                    'options' => array($tipo_cabanias),
                    'empty' => 'Seleccione'));
                ?>
            </div>

            <label class="col-sm-1 control-label">N°:</label>
            <div class="col-sm-2">
                <?php
                echo $this->Form->input('locacion_id', array(
                    'options' => array(),
                    'empty' => 'Seleccione Tipo'));
                ?>
            </div>

            <label class="col-sm-1 control-label">Adultos:</label>
            <div class="col-sm-2">
                <?php
                echo $this->Form->input('cantidad_adultos', array(
                    'options' => array(),
                    'empty' => 'Seleccione Tipo'));
                ?>
            </div>

            <div class="col-sm-1">
                <input type="button" id="bonton_agregar" class="btn btn-primary" id="addrow" value="Agregar" onclick="agregaLocacion()"/>
            </div>

        </div>

        
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
                <?php if (!empty($this->validationErrors['LocacionReserva']['validaLocaciones'])){
            echo '<p class="text-danger">'.$this->validationErrors['LocacionReserva']['validaLocaciones'].'</p>';
        }
        ?>
                <table id="tabla_locaciones" class="table table-striped table-hover">
                    <tbody><tr>
                            <th>Tipo</th>
                            <th>Número</th>
                            <th>Adultos</th>
                            <th>Acción</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        $this->Js->get('#ReservaTipoCabania')->event(
            'change', $this->Js->request(array(
                'controller' => 'locaciones',
                'action' => 'obtenerSegunTipoLocacion'
            ), array(
                'update' => '#ReservaLocacionId',
                'async' => true,
                'method' => 'post',
                'dataExpression' => true,
                'data' => $this->Js->serializeForm(array(
                    'isForm' => true,
                    'inline' => true
                ))
            ))
        );

        $this->Js->get('#ReservaTipoCabania')->event(
            'change', $this->Js->request(array(
                'controller' => 'locaciones',
                'action' => 'obtenerCantidadAdultosLocacion'
            ), array(
                'update' => '#ReservaCantidadAdultos',
                'async' => true,
                'method' => 'post',
                'dataExpression' => true,
                'data' => $this->Js->serializeForm(array(
                    'isForm' => true,
                    'inline' => true
                ))
            ))
        );
        ?>

        <script>
            var i = 0;
            function agregaLocacion() {
                var newRow = $("<tr>");

                var cols = "";

                var tipoCabania = $('#ReservaTipoCabania').find(":selected").text();
                var tipoCabaniaVal = $('#ReservaTipoCabania').find(":selected").val();
                var numeroCabania = $('#ReservaLocacionId').find(":selected").text();
                var numeroCabaniaVal = $('#ReservaLocacionId').find(":selected").val();
                var cantidadAdultos = $('#ReservaCantidadAdultos').find(":selected").text();
                var cantidadAdultosVal = $('#ReservaCantidadAdultos').find(":selected").val();
                cols += '<td>' + tipoCabania + '</td>';
                cols += '<td>' + numeroCabania + '</td>';
                cols += '<td>' + cantidadAdultos + '</td>';
                cols += '<td><input type="button" class="btnDelete"  value="Delete" ></td>';

                cols += '<input type="hidden" name="data[Reserva][LocacionReserva][' + i + '][locacion_id]" value="' + numeroCabaniaVal + '"/>';
                cols += '<input type="hidden" name="data[Reserva][LocacionReserva][' + i + '][cantidad_adultos]" value="' + cantidadAdultosVal + '"/>';

                i++;

                newRow.append(cols);
                $("#tabla_locaciones").append(newRow);
            }

            $("#tabla_locaciones").on('click', '.btnDelete', function () {
                $(this).parent().parent().remove();
            });

        </script>

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
                <label class="col-sm-2 control-label">País:</label>
                <div class="col-sm-3">
            <?php
                echo $this->Form->input('Cliente.pais_id', array(
                'options' => array($paises),
                'empty' => 'Seleccione'));

            ?>
                </div>
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

                <label class="col-sm-2 control-label">Horario de arribo:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->hour('hora_arribo', true); ?>
                    :
                    <?php echo $this->Form->minute('minuto_arribo'); ?>
                </div>

                <label class="col-sm-2 control-label">Pago:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('field', array(
                        'options' => array("Pendiente", "Pagado", "Otro")
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">

                <label class="col-sm-1 control-label">Notas:</label>
                <div class="col-sm-7">
                    <?php echo $this->Form->textarea('Reserva.info_adicional',
                        array('rows' => '8', 'cols' => '134')); ?>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
            <?php echo $this->Form->submit(__('Guardar'), array('class' => 'btn btn-primary')) ?>
                </div>
            </div>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>






</div>

