<!--<pre>
<?php var_dump($reservas_ingresan); ?>
</pre>
-->
<h1>Dashboard</h1>
<div class="row">
    <div class="col-md-6">
        <h3>Ingresan hoy</h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Salida</th>
                    <th>Cliente</th>
                    <th>Locaciones</th>
                    <th>Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody class=".table-hover">  
                <tr>
                    <?php
                    foreach ($reservas_ingresan as $reserva) {
                        ?>
                    <tr>
                        <td>
                            <?php echo $this->Time->format($reserva['Reserva']['fecha_hasta'], '%d/%m/%Y') ?>
                        </td>
                        <td>
                            <?php echo $reserva['Cliente']['nombre'] . ' ' . $reserva['Cliente']['apellido']; ?>
                        </td>
                        <td>
                            <?php
                            echo '<ul>';
                            foreach ($reserva['LocacionReserva'] as $locacion) {
                                echo '<li>' . $locacion['Locacion']['nombre'] . '</li>';
                            }
                            echo '</ul>';
                            ?>
                        </td>
                        <td>
                            <?php
                            switch ($reserva['Reserva']['tipo_pago']) {
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
                        </td>
                        <td>
                            <?php echo '<a href="' . $this->Html->url(array('controller' => 'reservas', 'action' => 'view', $reserva['Reserva']['id'])) . '" class="btn btn-success btn-xs"> Ver </a>'; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <h3>Salen hoy</h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Ingreso</th>
                    <th>Cliente</th>
                    <th>Locaciones</th>
                    <th>Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody class=".table-hover">  
                <tr>
                    <?php
                    foreach ($reservas_salen as $reserva) {
                        ?>
                    <tr>
                        <td>
                            <?php echo $this->Time->format($reserva['Reserva']['fecha_desde'], '%d/%m/%Y') ?>
                        </td>
                        <td>
                            <?php echo $reserva['Cliente']['nombre'] . ' ' . $reserva['Cliente']['apellido']; ?>
                        </td>
                        <td>
                            <?php
                            echo '<ul>';
                            foreach ($reserva['LocacionReserva'] as $locacion) {
                                echo '<li>' . $locacion['Locacion']['nombre'] . '</li>';
                            }
                            echo '</ul>';
                            ?>
                        </td>
                        <td>
                            <?php
                            switch ($reserva['Reserva']['tipo_pago']) {
                                case 0:
                                    echo "Parcial";
                                    break;
                                case 1:
                                    echo "Pagado";
                                    break;
                                case 2:
                                    echo "Impago";
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo '<a href="' . $this->Html->url(array('controller' => 'reservas', 'action' => 'view', $reserva['Reserva']['id'])) . '" class="btn btn-success btn-xs"> Ver </a>'; ?>
                            <?php
                            if (AuthComponent::user('rol_id') == 1 || AuthComponent::user('rol_id') == 3) {
                                if ($reserva['Reserva']['tipo_pago'] != 1) {
                                    echo '<a id="pagaBoton" href="' . $this->Html->url(array('controller' => 'reservas', 'action' => 'pagar', $reserva['Reserva']['id'])) . '" class="btn btn-success btn-xs"> Pagado </a>';
                                } else {
                                    echo '<a id="impagaBoton" href="' . $this->Html->url(array('controller' => 'reservas', 'action' => 'impagar', $reserva['Reserva']['id'])) . '" class="btn btn-success btn-xs"> Impago </a>';
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $('.pagaBoton').on('click', function () {
        return confirm('¿Estás seguro que queres marcar esta reserva como pagada?');
    });
    $('.impagaBoton').on('click', function () {
        return confirm('¿Estás seguro que queres marcar esta reserva como impagada?');
    });
</script>