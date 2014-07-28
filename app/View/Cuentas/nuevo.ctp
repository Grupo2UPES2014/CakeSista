<h2>Nueva Cuenta</h2>

<?php
echo $this->Form->create('Cuenta');
echo $this->Form->input('numero', array('label' => false, 'placeholder' => 'Número')); //'type' => 'textarea'
echo $this->Form->input('descripcion', array('label' => false, 'placeholder' => 'Descripción'));
echo $this->Form->input('activo', array('label' => false, 'placeholder' => 'Activo')); // Cambiar el tipo de valor de entrada
echo $this->Form->button('Guardar', array('class' => 'save'));
echo $this->Form->end();
?>
