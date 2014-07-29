<h2>Nuevo Empleado</h2>
<?php
echo $this->Form->create('Empleado');
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre')); //'type' => 'textarea'
// El apellido 1 y 2 como colocarlo en Singular??
echo $this->Form->input('apallido1', array('label' => false, 'placeholder' => 'Primer Apellido')); //'type' => 'textarea'
echo $this->Form->input('apallido2', array('label' => false, 'placeholder' => 'Segundo Apellido')); //'type' => 'textarea'

//IDs de usuario y cargo como tambien en singular??
echo $this->Form->input('usuario_id', array('label' => false, 'placeholder' => 'ID de Empleado')); //'type' => 'textarea'
echo $this->Form->input('catcargo_id', array('label' => false, 'placeholder' => 'ID de Cargo de Empleado')); //'type' => 'textarea'
echo $this->Form->button('Guardar', array('class' => 'save'));
echo $this->Form->end();
?>