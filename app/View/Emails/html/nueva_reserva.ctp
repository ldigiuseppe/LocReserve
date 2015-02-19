<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Nueva reserva realizada</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="margin: 0; padding: 0;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;border: 1px solid #cccccc;">
                        <tr>
                            <td align="center" bgcolor="#f8f8f8" style="padding: 40px 0 30px 0;">
                                <img src="http://complejolosrobles.com.ar/img/logo-hor.png" alt="Complejo de Cabañas Los Robles" style="display: block;" />
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">Hola
                                            <?php echo $nombre; ?>, una nueva reserva fue realizada:</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 20px 0 30px 0;color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                            <h3>Fechas</h3>
                                            <p><label style="color: #153643; font-family: Arial, sans-serif;">Desde: </label><?php echo $fecha_desde; ?></p>
                                            <p> <label style="color: #153643; font-family: Arial, sans-serif;">Hasta: </label><?php echo $fecha_hasta; ?></p>

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
                                                    foreach ($reserva['LocacionReserva'] as $locacionReserva) {
                                                        echo '<tr>';
                                                        echo '<td style="padding: 4px;border-collapse: collapse;border: 1px solid #cccccc;">' . $locacionReserva['Locacion']['TipoLocacion']['titulo'] . '</td>';
                                                        echo '<td style="padding: 4px;border-collapse: collapse;border: 1px solid #cccccc;">' . $locacionReserva['Locacion']['nombre'] . '</td>';
                                                        echo '<td style="padding: 4px;border-collapse: collapse;border: 1px solid #cccccc;">' . $locacionReserva['cantidad_adultos'] . '</td>';
                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <br />

                                            <h3>Cliente</h3>
                                            <p><label style="color: #153643; font-family: Arial, sans-serif;">Nombre: </label>
                                                <?php echo $reserva['Cliente']['nombre']; ?>
                                            </p>
                                            <p><label style="color: #153643; font-family: Arial, sans-serif;">Apellido: </label>
                                                <?php echo $reserva['Cliente']['apellido']; ?>
                                            </p>
                                            <p><label style="color: #153643; font-family: Arial, sans-serif;">Teléfono: </label>
                                                <?php echo $reserva['Cliente']['telefono']; ?>
                                            </p>
                                            <p><label style="color: #153643; font-family: Arial, sans-serif;">Email: </label>
                                                <?php echo $reserva['Cliente']['email']; ?>
                                            </p>    
                                            <p><label style="color: #153643; font-family: Arial, sans-serif;">Dirección: </label>
                                                <?php echo $reserva['Cliente']['direccion']; ?>
                                            </p>

                                            <h3>Reserva</h3>

                                            <p><label style="color: #153643; font-family: Arial, sans-serif;">Total:</label>
                                                <?php echo $reserva['Reserva']['total'] ?>    
                                            </p>

                                            <p><label style="color: #153643; font-family: Arial, sans-serif;">Seña:</label>
                                                <?php echo $reserva['Reserva']['senia'] ?>    
                                            </p>

                                            <p><label style="color: #153643; font-family: Arial, sans-serif;">Resta:</label>
                                                <?php echo $reserva['Reserva']['total'] - $reserva['Reserva']['senia']; ?>
                                            </p>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <td width="75%" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                        <h3>Reserva realizada por <?php echo $reserva['Usuario']['nombre'] . " " . $reserva['Usuario']['apellido']; ?>:</h3>	
                                        <p>Telefono: <strong><?php echo $reserva['Usuario']['telefono']; ?></strong>
                                            <br/>Email: <strong><?php echo $reserva['Usuario']['email']; ?></strong>
                                        </p>&reg; Complejo Los Robles 2015
                                        <br/>
                                    </td>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>


