<div class="usuarios form">

    <h1>Nuevo Usuario</h1>

    <?php echo $this->Html->link("Volver", array('action' => 'index'), array('class' => 'btn btn-info', 'escape' => false)); ?>

    <?php echo $this->Form->create('Usuario'); ?>

    <div class="form-group">
        <label class="col-sm-2 control-label">Email:</label>
        <div class="col-sm-8">
            <?php echo $this->Form->input('email'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Contraseña:</label>
        <div class="col-sm-8">
            <?php echo $this->Form->input('password'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Confirmar Contraseña:</label>
        <div class="col-sm-8">
            <?php echo $this->Form->input('password_confirm', array('type' => 'password')); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Nombre:</label>
        <div class="col-sm-8">
            <?php echo $this->Form->input('nombre'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Apellido:</label>
        <div class="col-sm-8">
            <?php echo $this->Form->input('apellido'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Rol:</label>
        <div class="col-sm-8">
            <?php
            echo $this->Form->input('rol_id', array(
                'options' => array($roles),
                'empty' => 'Seleccione'));
            ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <?php echo $this->Form->submit(__('Guardar'), array('class' => 'btn btn-primary')) ?>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>

</div>
