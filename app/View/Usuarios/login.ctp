<div class="Usuario form">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('Usuario', array('class' => 'form-signin')); ?>
    <fieldset>
        <legend><?php echo __('Ingrese su email y contraseña'); ?></legend>
        <?php
        echo $this->Form->input('email', array(
            'class' => 'form-control',
            'placeholder' => 'Ingrese su email',
            'label' => false)
        );
        echo $this->Form->input('password', array(
            'class' => 'form-control',
            'placeholder' => 'Contraseña',
            'label' => false)
        );
        ?>
    </fieldset>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
    <?php echo $this->Form->end(); ?>

</div>
<?php
//echo $this->Html->link("Add A New Usuario", array('action' => 'add'));

