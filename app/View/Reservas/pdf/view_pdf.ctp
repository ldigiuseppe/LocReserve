<html>

    <h2>Reserva <small>por <?php echo $this->data['Usuario']['apellido'] . ', ' . $this->data['Usuario']['nombre'] . ' el día ' . $this->Time->format($this->data['Reserva']['fecha_creacion'], '%d/%m/%Y %H:%M hs.'); ?></small></h2>

    <h3>Fechas</h3>
    <p><label>Desde: </label><?php echo $fecha_desde; ?></p>
    <p><label>Hasta: </label><?php echo $fecha_hasta; ?></p>

    <h3>Locaciones</h3>

    <table border="1">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Número</th>
                <th>Adultos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($this->data['LocacionReserva'] as $locacionReserva) {
                echo '<tr>';
                echo '<td>' . $locacionReserva['Locacion']['TipoLocacion']['titulo'] . '</td>';
                echo '<td>' . $locacionReserva['Locacion']['nombre'] . '</td>';
                echo '<td>' . $locacionReserva['cantidad_adultos'] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <br />

    <h3>Cliente</h3>


    <p><label>Nombre: </label>
        <?php echo $this->data['Cliente']['nombre']; ?>
    </p>
    <p><label>Apellido: </label>
        <?php echo $this->data['Cliente']['apellido']; ?>
    </p>
    <p><label>Teléfono: </label>
        <?php echo $this->data['Cliente']['telefono']; ?>
    </p>
    <p><label>Email: </label>
        <?php echo $this->data['Cliente']['email']; ?>
    </p>    
    <p><label>Dirección: </label>
        <?php echo $this->data['Cliente']['direccion']; ?>
    </p>

    <h3>Reserva</h3>
    <p>
        <label>Pago:</label>
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

    <p><label>Total:</label>
        <?php echo $this->data['Reserva']['total'] ?>    
    </p>

    <p><label>Seña:</label>
        <?php echo $this->data['Reserva']['senia'] ?>    
    </p>

    <p><label>Resta:</label>
        <?php echo $this->data['Reserva']['total'] - $this->data['Reserva']['senia']; ?>
    </p>

    <label>Notas:</label>
    <?php
    echo $this->Form->textarea('Reserva.info_adicional', array('rows' => '6', 'cols' => '80', 'readonly' => 'readonly'))
    ?>

    <p><label>Horario de arribo:</label>
        <?php echo $this->data['Reserva']['hora_arribo']; ?>
    </p>

</html>