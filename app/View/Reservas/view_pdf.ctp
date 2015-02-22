<html>
    <body style="margin: 0; padding: 0;">
        <div border="0" cellpadding="0" cellspacing="0" width="100%">
            <div align="center" width="550" style="border-collapse: collapse;border: 1px solid #cccccc;">
                <div style="padding: 20px 0 30px 0; font-family: Arial, sans-serif; font-size: 28px; background-color:#f8f8f8;">
                    Complejo de Cabañas Los Robles
                </div>
                <div style="text-align: left;padding:20px 30px 20px 30px;background-color:#ffffff">
                    <div style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">Información de la Reserva:</div>
                    <div style="padding: 0px 0 30px 0;color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 15px;">
                        <h3>Fechas</h3>
                        <p><label style="color: #153643; font-family: Arial, sans-serif;"><?php echo $fecha_desde; ?> - <?php echo $fecha_hasta; ?></label></p>
                        <h3>Locaciones</h3>

                        <table border="1" style="padding: 4px;border-collapse: collapse;border: 1px solid #cccccc;">
                            <thead>
                                <tr>
                                    <th style="padding: 4px;border-collapse: collapse;border: 1px solid #cccccc;">Tipo</th>
                                    <th style="padding: 4px;border-collapse: collapse;border: 1px solid #cccccc;">Número</th>
                                    <th style="padding: 4px;border-collapse: collapse;border: 1px solid #cccccc;">Adultos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($this->data['LocacionReserva'] as $locacionReserva) {
                                    echo '<tr>';
                                    echo '<td style="padding: 4px;border-collapse: collapse;border: 1px solid #cccccc;">' . $locacionReserva['Locacion']['TipoLocacion']['titulo'] . '</td>';
                                    echo '<td style="padding: 4px;border-collapse: collapse;border: 1px solid #cccccc;">' . $locacionReserva['Locacion']['nombre'] . '</td>';
                                    echo '<td style="padding: 4px;border-collapse: collapse;border: 1px solid #cccccc;">' . $locacionReserva['cantidad_adultos'] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                        <h3>Cliente</h3>
                        <p><label style="color: #153643; font-family: Arial, sans-serif;">Nombre: </label>
                            <?php echo $this->data['Cliente']['nombre']; ?>
                        </p>
                        <p><label style="color: #153643; font-family: Arial, sans-serif;">Apellido: </label>
                            <?php echo $this->data['Cliente']['apellido']; ?>
                        </p>
                        <p><label style="color: #153643; font-family: Arial, sans-serif;">Teléfono: </label>
                            <?php echo $this->data['Cliente']['telefono']; ?>
                        </p>
                        <p><label style="color: #153643; font-family: Arial, sans-serif;">Email: </label>
                            <?php echo $this->data['Cliente']['email']; ?>
                        </p>    
                        <p><label style="color: #153643; font-family: Arial, sans-serif;">Dirección: </label>
                            <?php echo $this->data['Cliente']['direccion']; ?>
                        </p>

                        <h3>Reserva</h3>

                        <p><label style="color: #153643; font-family: Arial, sans-serif;">Total:</label>
                            <?php echo $this->data['Reserva']['total'] ?>    <label style="color: #153643; font-family: Arial, sans-serif;">Seña:</label>
                            <?php echo $this->data['Reserva']['senia'] ?>        
                        </p>

                        <p><label style="color: #153643; font-family: Arial, sans-serif;">Resta:</label>
                            <?php echo $this->data['Reserva']['total'] - $this->data['Reserva']['senia']; ?>
                        </p>
                    </div>
                </div>
                <div  style="background-color: #ee4c50;padding: 30px 30px 30px 30px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width="75%" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                <h3>Reserva realizada por <?php echo $this->data['Usuario']['nombre'] . " " . $this->data['Usuario']['apellido']; ?>:</h3>	
                                <p>Telefono: <strong><?php echo $this->data['Usuario']['telefono']; ?></strong>
                                    <br/>Email: <strong><?php echo $this->data['Usuario']['email']; ?></strong>
                                </p>&reg; Complejo Los Robles 2015
                                <br/>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </body>
</html>