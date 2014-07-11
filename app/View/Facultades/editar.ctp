<h2>Actualizar Facultad</h2>
<?php
echo $this->Form->create('Facultade');
echo $this->Form->input('id');
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->button('Actualizar', array('class' => 'update'));
echo $this->Form->end();
?>