<?php
$this->set('title_for_layout', 'Catálogos');
?>
<h1>Catálogos</h1>

<div class="opciones">
    <div>
        <a href="<?php echo Router::url(array('controller' => 'facultades', 'action' => 'index')); ?>"><div class="opcion facultad">Facultades</div></a>
        <a href="<?php echo Router::url(array('controller' => 'carreras', 'action' => 'index')); ?>"><div class="opcion carrera">Carreras</div></a>
        <a href="<?php echo Router::url(array('controller' => 'asignaturas', 'action' => 'index')); ?>"><div class="opcion carrera">Asignatura</div></a>
        <a href="<?php echo Router::url(array('controller' => 'catcargos', 'action' => 'index')); ?>"><div class="opcion carrera">Cargos</div></a>
        <a href="<?php echo Router::url(array('controller' => 'cuentas', 'action' => 'index')); ?>"><div class="opcion carrera">Cuentas</div></a>
        <a href="<?php echo Router::url(array('controller' => 'empleados', 'action' => 'index')); ?>"><div class="opcion carrera">Empleados</div></a>
    </div>
</div>
