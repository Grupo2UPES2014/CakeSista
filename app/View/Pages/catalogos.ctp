<?php
$this->set('title_for_layout', 'Catálogos');
?>
<h1>Catálogos</h1>

<div class="opciones">
    <div>

        <a href="<?php echo Router::url(array('controller' => 'facultades', 'action' => 'index')); ?>"><div class="opcion facultad">Facultades</div></a>
        <a href="<?php echo Router::url(array('controller' => 'carreras', 'action' => 'index')); ?>"><div class="opcion carrera">Carreras</div></a>
    </div>
</div>
