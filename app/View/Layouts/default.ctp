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
                    <?php
                    $menus = $this->Session->read('menu');
                    foreach ($menus as $menu):
                        ?>
                        <a href="<?php echo $this->webroot . $menu['ruta']; ?>"><div class="m_elemento"><div class="ico <?php echo $menu['icono']; ?>"></div><span><?php echo $menu['titulo']; ?></span></div></a>
                        <?php
                    endforeach;
                    ?>
                    <a href="<?php echo $this->webroot . 'about'; ?>"><div class="m_elemento"><div class="ico icoInfo"></div><span>Acerca de SiSTA</span></div></a>
                </div>
                <div id="usuario"><?php echo $this->Html->image('ajax-loader.gif', array('id' => 'loading', 'alt' => 'Cargando...')); ?><span><?php echo $this->Session->read('Auth.User.alias'); ?></span><a href="<?php echo $this->webroot . 'usuarios/logout'; ?>"><div class="ico mini icoLogout"></div></a></div>
            </div>
            <div id="sistacontent">
                <div id="sistaroute">SiSTA >> <span id="controller"><?php echo $this->name; ?></span> >> <?php echo $title_for_layout; ?></div>
                <div id="sistadesktop">
                    <?php echo $this->fetch('content'); ?>
                </div>
                <div id="sistamensajes"><?php echo $this->Session->flash(); ?></div>
            </div>
        </div>
        <?php echo $this->Html->script('jquery-1.11.1.min'); ?>
        <?php echo $this->Html->script('gui'); ?>
        <?php echo $this->fetch('sistajs'); ?> 
    </body>
</html>