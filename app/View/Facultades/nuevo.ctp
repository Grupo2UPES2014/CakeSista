<h2>Nueva Facultad</h2>
<?php
echo $this->Form->create('Facultade');
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->button('Guardar', array('class' => 'save'));
echo $this->Form->end();
?>