<!DOCTYPE html>
<!--
Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
[Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
-->
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>SiSTA : <?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('registro');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="modal">
            <span id="closeModal">X</span>
            <h2 id="tituloModal">Crear Cuenta</h2>
            <video id="vid" controls="controls" poster="img/poster.png" preload="metadata" height="80%" style="margin-left: auto;margin-right: auto;display: block">
            </video>
        </div>
        <div>
            <?php echo $this->Html->image('logo5.png', array('id' => 'logo', 'alt' => 'Logo SiSTA', 'data-raiz' => $this->webroot)); ?>
            <div id="logo" data-raiz="<?php echo $this->webroot; ?>"></div>
            <div id="franja"><span>Sistema de Seguimiento de Trámites Académicos</span></div>
            <div id="login"><div id="icon"><?php echo $this->Html->image('appbar.people.arrow.right.png', array('alt' => 'REGISTRO')); ?><div></div></div><div id="form">
                    <div>
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
            <div id="sistamensajes"><?php echo $this->Session->flash(); ?></div>
            <?php echo $this->Html->script('jquery-1.11.1.min'); ?>
            <?php echo $this->Html->script('login'); ?>
            <?php echo $this->Html->script('gui'); ?>
            <div id="controller" style="display: none">Registro</div>
        </div>
    </body>
</html>