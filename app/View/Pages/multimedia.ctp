<?php
$this->set('title_for_layout', 'Centro Multimedia');
?>
<h2>Centro Multimedia</h2>

<div id="mediacenter">
    <div style="vertical-align: top">
        <h3>Índice</h3>
        <ol style="list-style-type: square">
            <li><a href="#" data-video="1" data-titulo="Cambio de Contraseña">Cambio de Contraseña</a></li>
            <li><a href="#" data-video="yyy" data-titulo="Cambio de Correo">Cambio de Correo</a></li>
        </ol>
        <ol style="list-style-type: square">
            <li><a href="#" data-video="zzz" data-titulo="Catalogo Academico">Catalogo Academico</a></li>
            <li><a href="#" data-video="yyy" data-titulo="Catalogo Administrativo">Catalogo Administrativo</a></li>
            <li><a href="#" data-video="yyy" data-titulo="Creacion de nuevo usuario">Creacion de nuevo usuario</a></li> 
        </ol>

    </div>
    <div id="video">

    </div>
</div>
<?php
echo $this->Html->script('media', array('block' => 'sistajs'));
?>
