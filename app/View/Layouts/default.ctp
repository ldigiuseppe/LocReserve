<!DOCTYPE html>

<html>
    <head>

        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />

        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $this->fetch('title'); ?>
        </title>

        <?php
        echo $this->Html->meta('icon');
        
        echo $this->Html->script('jquery-1.10.2.js');
        echo $this->Html->script('jquery-ui.js');
        echo $this->Html->script('datepicker-es.js');
        echo $this->Html->script('bootstrap.min.js');
        
        echo $this->Html->script('moment.min.js');
        echo $this->Html->script('fullcalendar.min.js');
        echo $this->Html->script('fc-lang-es.js');

        echo $this->Html->css('style');
        echo $this->Html->css('jquery-ui.css');
        echo $this->Html->css('bootstrap.min.css');
        echo $this->Html->css('bootstrap-theme.min.css');
        
        echo $this->Html->css('fullcalendar.min.css');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div class="container">

            <?php echo $this->element('menu'); ?>

            <div class="content">
                <div class="page-header">
                    <h1><?php echo $this->fetch('page_header'); ?></h1>
                </div>
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>

            <div class="footer">
                <p>
                </p>
            </div>
        </div>
        <?php //echo $this->element('sql_dump');    ?>
        <?php
        if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) {
            echo $this->Js->writeBuffer();
            // Writes cached scripts
        }
        ?>
    </body>
</html>
