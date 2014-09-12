<h2>Nuevo Cargo</h2>
<?php
echo $this->Form->create('Catcargo');
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->input('descripcion', array('label' => false, 'placeholder' => 'Descripción'));
echo $this->Form->input('oficina', array('label' => false, 'placeholder' => 'Oficina'));
echo $this->Form->button('Guardar', array('class' => 'save'));
echo $this->Form->end();
?>