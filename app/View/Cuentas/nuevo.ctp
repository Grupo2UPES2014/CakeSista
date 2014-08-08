<h2>Nueva Cuenta</h2>

<?php
echo $this->Form->create('Cuenta');
echo $this->Form->input('numero', array('label' => false, 'placeholder' => 'Número')); //'type' => 'textarea'
echo $this->Form->input('descripcion', array('label' => false, 'placeholder' => 'Descripción', 'type' => 'textarea'));
echo $this->Form->input('activo', array('label' => 'Activa'));
echo $this->Form->button('Guardar', array('class' => 'save'));
echo $this->Form->end();
?>
