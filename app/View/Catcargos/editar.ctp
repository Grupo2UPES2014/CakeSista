<h2>Actualizar Cargo</h2>
<?php
echo $this->Form->create('Cargo');
echo $this->Form->input('id');
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->input('descripcion', array('label' => false, 'placeholder' => 'Descripción'));
echo $this->Form->button('Actualizar', array('class' => 'update'));
echo $this->Form->end();
?>