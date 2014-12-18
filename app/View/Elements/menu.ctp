<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="padding: 5px 5px;"><img src="/img/logo-hor.png" style="height: 100%;"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php if (AuthComponent::user('id')): ?>
                <ul class="nav navbar-nav">
                    <li><?php echo $this->Html->link("Dashboard", array('controller' => 'web', 'action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link("Usuarios", array('controller' => 'usuarios', 'action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link("Reservas", array('controller' => 'reservas', 'action' => 'index')); ?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Perfil</a></li>
                    <li><?php echo $this->Html->link("Salir", array('action' => 'logout')); ?></li>
                </ul>
            <?php endif; ?>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>