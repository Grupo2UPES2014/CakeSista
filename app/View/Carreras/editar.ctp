<h2>Nueva Carrera</h2>
<?php
echo $this->Form->create('Carrera');
echo $this->Form->input('id');
echo $this->Form->input('codigo', array('label' => false, 'placeholder' => 'Código'));
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->input('nombreabrev', array('label' => false, 'placeholder' => 'Nombre abreviado'));
echo $this->Form->input('facultade_id', array('empty' => 'Seleccione Facultad', 'label' => false));
echo $this->Form->button('Actualizar', array('class' => 'update'));
echo $this->Form->end();
?>