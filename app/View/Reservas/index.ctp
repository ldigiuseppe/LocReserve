<div class="usuarios form">
    <h1>Lista de Reservas<small> <?php echo count($reservas); ?> </small></h1>

    <?php echo $this->Html->link("Nueva Reserva", array('action' => 'add'), array('class' => 'btn btn-info', 'escape' => false)); ?>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('fecha_desde', 'Desde'); ?>  </th>
                <th><?php echo $this->Paginator->sort('fecha_hasta', 'Hasta'); ?></th>
                <th><?php echo $this->Paginator->sort('Cliente.nombre', 'Cliente'); ?></th>
                <th>Locaciones</th>
                <th><?php echo $this->Paginator->sort('Usuario.nombre', 'Usuario'); ?></th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class=".table-hover">  
            <tr>
            <?php $count = 0; ?>
            <?php foreach ($reservas as $reserva): ?>          
                <?php $count ++; ?>
                <?php echo '<tr>'; ?>
                <td><?php echo $this->Time->format($reserva['Reserva']['fecha_desde'], '%d/%m/%Y'); ?></td>
                <td><?php echo $this->Time->format($reserva['Reserva']['fecha_hasta'], '%d/%m/%Y'); ?></td>
                <td><?php echo $reserva['Cliente']['nombre'].' '.$reserva['Cliente']['apellido']; ?></td>
                <td><ul>
                    <?php 
                        foreach ($reserva['LocacionReserva'] as $locacionReserva) {
                            echo '<li>'.$locacionReserva['Locacion']['nombre'].' ('.$locacionReserva['Locacion']['TipoLocacion']['titulo'].')</li>';
    
                        }
                    ?>
                    </ul>

                </td>
                <td><?php echo $reserva['Usuario']['nombre'].' '.$reserva['Usuario']['apellido']; ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
        <?php unset($usuario); ?>
        </tbody>
    </table>
    <?php echo $this->element('paginator'); ?>
    <br/>

</div>