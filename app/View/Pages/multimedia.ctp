<?php
$this->set('title_for_layout', 'Centro Multimedia');
?>
<h2>Centro Multimedia</h2>

<div id="mediacenter">
    <div style="vertical-align: top">
        <h3>Índice</h3>
        <?php if ($this->Session->read('Auth.User.role_id') == 3): ?>
            <ol style="list-style-type: square">
                <li><a href="#" data-video="0" data-titulo="Cambio de Contraseña">Inicio y Seguimiento de un tramite</a></li>
            </ol>
        <?php endif; ?>
        <ol style="list-style-type: square">
            <li><a href="#" data-video="1" data-titulo="Cambio de Contraseña">Cambio de Contraseña</a></li>
            <li><a href="#" data-video="2" data-titulo="Cambio de Correo">Cambio de Correo</a></li>
        </ol>
        <?php if ($this->Session->read('Auth.User.role_id') == 1): ?>
            <ol style="list-style-type: square">
                <li><a href="#" data-video="3" data-titulo="Catalogo Academico">Catalogo Academico</a></li>
                <li><a href="#" data-video="4" data-titulo="Catalogo Administrativo">Catalogo Administrativo</a></li>
                <li><a href="#" data-video="5" data-titulo="Creacion de nuevo usuario">Creacion de nuevo usuario</a></li> 
            </ol>
        <?php endif; ?>

    </div>
    <div id="video">

    </div>
</div>
<?php
echo $this->Html->script('media', array('block' => 'sistajs'));
?>
