<!DOCTYPE html>
<!--
Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
[Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
-->
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            SiSTA : <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('gui');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="sistacontainer">
            <div id="sistamenu">
                <div id="logo"></div>
                <div id="m_elementos">
                    <div class="m_elemento"><div class="ico icoTramite"></div><span>Trámites</span></div>
                    <div class="m_elemento"><div class="ico icoInbox"></div><span>Buzón</span></div>
                    <div class="m_elemento"><div class="ico icoCog"></div><span>Configuración</span></div>
                    <a href="<?php echo $this->webroot.'about'; ?>"><div class="m_elemento"><div class="ico icoInfo"></div><span>Acerca de SiSTA</span></div></a>
                </div>
                <div id="usuario"><?php echo $this->Html->image('ajax-loader.gif', array('id' => 'loading', 'alt' => 'Cargando...')); ?><span>TT200601</span><div class="ico mini icoLogout"></div></div>
            </div>
            <div id="sistacontent">
                <div id="sistaroute">SiSTA >> <?php echo $this->name; ?> >> <?php echo $title_for_layout; ?></div>
                <div id="sistadesktop">
                    <?php echo $this->fetch('content'); ?>
                </div>
                <div id="sistamensajes"><?php echo $this->Session->flash(); ?></div>
            </div>
        </div>
        <?php echo $this->Html->script('jquery-1.11.1.min'); ?>
        <?php echo $this->Html->script('gui'); ?>
    </body>
</html>