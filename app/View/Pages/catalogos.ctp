<?php
$this->set('title_for_layout', 'Catálogos');
?>
<h1>Catálogos</h1>

<div class="opciones">
    <div>
        <fieldset>
            <legend>Academicos</legend>
            <a href="<?php echo Router::url(array('controller' => 'facultades', 'action' => 'index')); ?>"><div class="opcion facultades">Facultades</div></a>
            <a href="<?php echo Router::url(array('controller' => 'carreras', 'action' => 'index')); ?>"><div class="opcion carreras">Carreras</div></a>
            <a href="<?php echo Router::url(array('controller' => 'asignaturas', 'action' => 'index')); ?>"><div class="opcion asignaturas">Asignatura</div></a>
        </fieldset>
        <fieldset>
            <legend>Administrativos</legend>
            <a href="<?php echo Router::url(array('controller' => 'catcargos', 'action' => 'index')); ?>"><div class="opcion cargos">Cargos</div></a>
            <a href="<?php echo Router::url(array('controller' => 'empleados', 'action' => 'index')); ?>"><div class="opcion empleados">Empleados</div></a>
        </fieldset>
        <fieldset>
            <legend>Sistema</legend>
            <a href="<?php echo Router::url(array('controller' => 'cuentas', 'action' => 'index')); ?>"><div class="opcion cuentas">Cuentas</div></a>
        </fieldset>
    </div>
</div>
