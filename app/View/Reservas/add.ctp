<div class="reserva form">

    <h1>Nueva Reserva</h1>

    <?php echo $this->Form->create('Reserva'); ?>

    <div class="form-group">
        <label class="col-sm-2 control-label">fecha_desde:</label>
        <div class="col-sm-3">
            <?php
            echo $this->Form->input('fecha_desde', array(
                'id' => 'fecha_desde',
                'type' => 'text'
            ));
            ?>
        </div>
        <label class="col-sm-2 control-label">fecha_hasta:</label>
        <div class="col-sm-3">
            <?php
            echo $this->Form->input('fecha_hasta', array(
                'id' => 'fecha_hasta',
                'type' => 'text'
            ));
            ?>
        </div>
    </div>

    <script>
        $(function () {
            $("#fecha_desde").datepicker({
                numberOfMonths: 3
            });
            $("#fecha_hasta").datepicker({
                numberOfMonths: 3
            });
            $.datepicker.regional['es'];
        });
    </script>

    <hr style="border-top: 1px solid #777; width: 700px">

    <div class="form-group">
        <label class="col-sm-2 control-label">Tipo:</label>
        <div class="col-sm-2">
            <?php
            echo $this->Form->input('tipo_cabania', array(
                'options' => array($tipo_cabanias),
                'empty' => 'Seleccione'));
            ?>
        </div>

        <label class="col-sm-2 control-label">N°:</label>
        <div class="col-sm-2">
            <?php
            echo $this->Form->input('subcategory_id');
            ?>
        </div>
    </div>

    <?php
    $this->Js->get('#ReservaTipoCabania')->event('change', $this->Js->request(array(
                'controller' => 'locaciones',
                'action' => 'obtenerSegunTipoLocacion'
                    ), array(
                'update' => '#ReservaSubcategoryId',
                'async' => true,
                'method' => 'post',
                'dataExpression' => true,
                'data' => $this->Js->serializeForm(array(
                    'isForm' => true,
                    'inline' => true
                ))
            ))
    );
    $this->Js->get('#ReservaTipoCabania')->event('change', $this->Js->request(array(
                'controller' => 'locaciones',
                'action' => 'obtenerSegunTipoLocacion'
                    ), array(
                'update' => '#ReservaSubcategoryId',
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

    <div class="form-group">
        <label class="col-sm-2 control-label">Adultos:</label>
        <div class="col-sm-2">
            <?php
            echo $this->Form->input('tipo_cabania', array(
                'options' => array($tipo_cabanias),
                'empty' => 'Seleccione'));
            ?>
        </div>

        <label class="col-sm-2 control-label">Chicos:</label>
        <div class="col-sm-2">
            <?php
            echo $this->Form->input('tipo_cabania', array(
                'options' => array($tipo_cabanias),
                'empty' => 'Seleccione'));
            ?>
        </div>
    </div>




    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <?php echo $this->Form->submit(__('Guardar'), array('class' => 'btn btn-primary')) ?>
        </div>
    </div>
</form>

</div>


