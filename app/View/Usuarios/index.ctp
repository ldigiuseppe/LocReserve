<div class="usuarios form">
    <h1>Lista de Usuarios<small> <?php echo count($usuarios); ?> </small></h1>

    <?php echo $this->Html->link("Nuevo Usuario", array('action' => 'add'), array('class' => 'btn btn-info', 'escape' => false)); ?>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('email', 'E-Mail'); ?>  </th>
                <th><?php echo $this->Paginator->sort('nombre', 'Nombre'); ?></th>
                <th><?php echo $this->Paginator->sort('apellido', 'Apellido'); ?></th>
                <th><?php echo $this->Paginator->sort('telefono', 'Teléfono'); ?></th>
                <th><?php echo $this->Paginator->sort('ultimo_acceso', 'Ultimo Acceso'); ?></th>
                <th><?php echo $this->Paginator->sort('rol', 'Rol'); ?></th>
                <th><?php echo $this->Paginator->sort('rol', 'Estado'); ?></th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class=".table-hover">                       
            <?php $count = 0; ?>
            <?php foreach ($usuarios as $usuario): ?>          
                <?php $count ++; ?>
                <?php echo '<tr>'; ?>
            <td><?php echo $this->Html->link($usuario['Usuario']['email'], array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false)); ?></td>
            <td><?php echo $usuario['Usuario']['nombre']; ?></td>
            <td><?php echo $usuario['Usuario']['apellido']; ?></td>
            <td><?php echo $usuario['Usuario']['telefono']; ?></td>
            <td><?php echo $this->Time->niceShort($usuario['Usuario']['ultimo_acceso']); ?></td>
            <td><?php echo $usuario['Rol']['nombre']; ?></td>
            <td><?php echo ($usuario['Usuario']['estado'] == 1) ? "Activo" : "Desactivado"; ?></td>
            <td >
                <?php
                echo '<a href="' . $this->Html->url(array('controller' => 'usuarios', 'action' => 'edit', $usuario['Usuario']['id'])) . '" class="btn btn-success btn-xs">'
                . '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar'
                . '</a>'
                ?> 
                <?php
//                if ($usuario['Usuario']['status'] != 0) {
//                    echo $this->Html->link("Delete", array('action' => 'delete', $usuario['Usuario']['id']));
//                } else {
//                    echo $this->Html->link("Re-Activate", array('action' => 'activate', $usuario['Usuario']['id']));
//                }
                ?>
            </td>
            </tr>
        <?php endforeach; ?>
        <?php unset($usuario); ?>
        </tbody>
    </table>
    <?php
    echo $this->element('paginator');
    ?>
    <?php //echo $this->Html->link("Add A New Usuario.", array('action' => 'add'), array('escape' => false));   ?>
    <br/>