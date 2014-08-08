<h2>Actualizar Empleado</h2>
<?php
echo $this->Form->create('Empleado');
echo $this->Form->input('id');
echo $this->Form->input('nombres', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->input('apellido1', array('label' => false, 'placeholder' => 'Primer Apellido'));
echo $this->Form->input('apellido2', array('label' => false, 'placeholder' => 'Segundo Apellido'));
echo $this->Form->input('catcargo_id', array('label' => false));
echo $this->Form->button('Actualizar', array('class' => 'update'));
echo $this->Form->end();
?>