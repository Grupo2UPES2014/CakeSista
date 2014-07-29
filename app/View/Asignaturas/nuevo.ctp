<h2>Nueva Asignatura</h2>
<?php
echo $this->Form->create('Asignatura');
echo $this->Form->input('codigo', array('label' => false, 'placeholder' => 'Código')); //'type' => 'textarea'
echo $this->Form->input('correlativo', array('label' => false, 'placeholder' => 'Correlativo')); //'type' => 'textarea'
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre')); //'type' => 'textarea'
echo $this->Form->input('carrera_id', array('label' => false, 'placeholder' => 'ID de Carrera')); //'type' => 'textarea'
echo $this->Form->button('Guardar', array('class' => 'save'));
echo $this->Form->end();
?>