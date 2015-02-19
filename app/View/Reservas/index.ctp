<?php
//echo '<pre>';var_dump($locaciones); echo '</pre>';
?>
<div class="usuarios form">
    <h1>Lista de Reservas<small> <?php echo count($reservas); ?> </small></h1>

    <h5>
        <?php echo $this->Html->link("Nueva Reserva", array('action' => 'add'), array('class' => 'btn btn-info', 'escape' => false)); ?>
    </h5>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Filtros</h3>
        </div>
        <div class="panel-body">
            <?php echo $this->Form->create("Filtro"); ?>
            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label">Cliente:</label>
                <div class="col-sm-2">
                    <?php
                    echo $this->Form->input('cliente', array(
                        'class' => 'form-control input-sm',
                        'placeholder' => 'Nombre o Apellido'));
                    ?>
                </div>
                <label class="col-sm-1 control-label">Usuario:</label>
                <div class="col-sm-2">
                    <?php echo $this->Form->input('usuario_id', array('empty' => 'Todos', 'options' => $usuarios));
                    ?>               
                </div>
                <label class="col-sm-1 control-label">Locaciones:</label>
                <div class="col-sm-3">
                    <?php
                    echo $this->Form->input('locacion_id', array('empty' => 'Todos', 'options' => $locaciones));
                    ?>                
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label">Creación:</label>
                <div class="col-md-1" style="padding-right: 2px">
                    <?php
                    echo $this->Form->input('creacion_desde', array(
                        'class' => 'form-control input-sm',
                        'placeholder' => 'Desde',
                        'style' => 'font-size: 11px'));
                    ?>          
                </div>
                <div class="col-lg-1" style="padding-left: 2px">
                    <?php
                    echo $this->Form->input('creacion_hasta', array(
                        'class' => 'form-control input-sm',
                        'placeholder' => 'Hasta',
                        'style' => 'font-size: 11px'));
                    ?>      
                </div>
                <label class="col-sm-1 control-label">Reserva:</label>
                <div class="col-md-1" style="padding-right: 2px">
                    <?php
                    echo $this->Form->input('reserva_desde', array(
                        'class' => 'form-control input-sm',
                        'placeholder' => 'Desde',
                        'style' => 'font-size: 11px'));
                    ?>                    
                </div>
                <div class="col-lg-1" style="padding-left: 2px">
                    <?php
                    echo $this->Form->input('reserva_hasta', array(
                        'class' => 'form-control input-sm',
                        'placeholder' => 'Hasta',
                        'style' => 'font-size: 11px'));
                    ?>                      
                </div>
                <label class="col-sm-1 control-label">Pago:</label>
                <div class="col-sm-2">
                    <?php
                    echo $this->Form->input('pago_id', array('empty' => 'Todos', 'options' => $lista_pagos));
                    ?>                
                </div>
                <div class="col-sm-1">
                    <?php echo $this->Form->submit(__('Filtrar'), array('class' => 'btn btn-primary')) ?>

                </div><div class="col-sm-1">
                    <?php
                    echo $this->Form->button('Limpiar', array(
                        'onclick' => "resetForm('#FiltroIndexForm')",
                        'class' => 'btn btn-primary',
                        'type' => 'button',
                            )
                    );
                    ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('fecha_creacion', 'Creación'); ?>  </th>
                <th><?php echo $this->Paginator->sort('fecha_desde', 'Desde'); ?>  </th>
                <th><?php echo $this->Paginator->sort('fecha_hasta', 'Hasta'); ?></th>
                <th><?php echo $this->Paginator->sort('Cliente.nombre', 'Cliente'); ?></th>
                <th>Locaciones</th>
                <th><?php echo $this->Paginator->sort('Usuario.nombre', 'Usuario'); ?></th>
                <th><?php echo $this->Paginator->sort('pago', 'Pago'); ?></th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class=".table-hover">  
            <tr>
                <?php
                $reserva_actual = null;
                $tablaPre = "";
                $tablaLoc = "";
                $tablaPos = "";
                $primeraLinea = true;

                foreach ($reservas as $reserva) {
                    if ($reserva_actual != $reserva['Reserva']['id']) {

                        if (!$primeraLinea) {
                            echo $tablaPre . $tablaLoc . $tablaPos;
                            $tablaPre = "";
                            $tablaLoc = "";
                            $tablaPos = "";
                        }

                        $reserva_actual = $reserva['Reserva']['id'];
                        $tablaPre .= '<tr>';
                        $tablaPre .= '<td>' . $this->Time->format($reserva['Reserva']['fecha_creacion'], '%d/%m/%Y') . '</td>';
                        $tablaPre .= '<td>' . $this->Time->format($reserva['Reserva']['fecha_desde'], '%d/%m/%Y') . '</td>';
                        $tablaPre .= '<td>' . $this->Time->format($reserva['Reserva']['fecha_hasta'], '%d/%m/%Y') . '</td>';
                        $tablaPre .= '<td>' . $reserva['Cliente']['nombre'] . ' ' . $reserva['Cliente']['apellido'] . '</td>';
                        $tablaPre .= '<td><ul>';
                        $tablaLoc .= '<li>' . $reserva['Locacion']['nombre'] . ' (' . $reserva['TipoLocacion']['titulo'] . ')</li>';
                        $tablaPos .= '</ul></td>';
                        $tablaPos .= '<td>' . $reserva['Usuario']['nombre'] . ' ' . $reserva['Usuario']['apellido'] . '</td>';
                        $tablaPos .= '<td>';
                        switch ($reserva['Reserva']['tipo_pago']) {
                            case 0:
                                $tablaPos .= "Parcial";
                                break;
                            case 1:
                                $tablaPos .= "Total";
                                break;
                            case 2:
                                $tablaPos .= "Impago";
                                break;
                        }
                        $tablaPos .= '</td>';
                        $tablaPos .= '<td><a href="' . $this->Html->url(array('controller' => 'reservas', 'action' => 'view', $reserva['Reserva']['id'])) . '" class="btn btn-success btn-xs"> Ver </a>';
                        if ($reserva['Usuario']['id'] == (AuthComponent::user('id'))) {
                            $tablaPos .= '<a href="' . $this->Html->url(array('controller' => 'reservas', 'action' => 'edit', $reserva['Reserva']['id'])) . '" class="btn btn-success btn-xs"> Editar </a>';
                            $tablaPos .= '<a id="eliminaReserva" href="' . $this->Html->url(array('controller' => 'reservas', 'action' => 'delete', $reserva['Reserva']['id'])) . '" class="btn btn-success btn-xs eliminaReserva"> Eliminar </a>';
                        }
                        $tablaPos .= '</td>';
                        $tablaPos .= '</tr>';
                        $primeraLinea = false;
                    } else {
                        $tablaLoc .= '<li>' . $reserva['Locacion']['nombre'] . ' (' . $reserva['TipoLocacion']['titulo'] . ')</li>';
                    }
                }
                echo $tablaPre . $tablaLoc . $tablaPos;
                ?>
        </tbody>
    </table>
    <?php echo $this->element('paginator'); ?>
</div>

<script type="text/javascript">
    $('.eliminaReserva').on('click', function () {
        return confirm('¿Estás seguro que queres eliminar la reserva?');
    });

    function resetForm(nombreForm) {
        console.log(nombreForm);
        $form = $(nombreForm);
        console.log($form);
        $form.find('input:text, input:password, input:file, select, textarea').val('');
        $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
    }

    $("#FiltroCreacionDesde").datepicker({
        numberOfMonths: 1,
        dateFormat: "dd/mm/yy",
        onClose: function (selectedDate) {
            $("#FiltroCreacionHasta").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#FiltroCreacionHasta").datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        onClose: function (selectedDate) {
            $("#FiltroCreacionDesde").datepicker("option", "maxDate", selectedDate);
        }
    });

    $("#FiltroReservaDesde").datepicker({
        numberOfMonths: 1,
        dateFormat: "dd/mm/yy",
        onClose: function (selectedDate) {
            $("#FiltroReservaHasta").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#FiltroReservaHasta").datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        onClose: function (selectedDate) {
            $("#FiltroReservaDesde").datepicker("option", "maxDate", selectedDate);
        }
    });
    $.datepicker.regional['es'];

</script>