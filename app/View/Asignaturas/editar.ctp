<h2>Actualizar Facultad</h2>
<?php
echo $this->Form->create('Asignatura');
echo $this->Form->input('id');
echo $this->Form->input('codigo', array('label' => false, 'placeholder' => 'Código'));
echo $this->Form->input('correlativo', array('label' => false, 'placeholder' => 'Correlativo'));
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->input('carrera_id', array('label' => false, 'placeholder' => 'ID de Carrera'));
echo $this->Form->button('Actualizar', array('class' => 'update'));
echo $this->Form->end();
?>