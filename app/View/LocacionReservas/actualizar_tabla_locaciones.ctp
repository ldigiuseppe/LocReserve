<div class="col-sm-6 col-sm-offset-2">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th> Tipo de Locación </th>
                <th> N° de </th>
                <th> Cantidad </th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class=".table-hover">
            <tr>
                <td><?php echo $locacion['tipo_cabania']; ?></td>
                <td><?php echo $locacion['locacion_id']; ?></td>
                <td><?php echo $locacion['cantidad_adultos']; ?></td>
                <td> <a href="#">Eliminar</a> </td>
            </tr>
        </tbody>
    </table>
</div>