<h2>Eliminar Empleado</h2>
<h3><?php echo $facultad['Empleado']['nombre']; ?></h3>
<?php
echo $this->Form->create('Empleado');
echo $this->Form->input('id');
echo $this->Form->button('Eliminar', array('class' => 'del'));
echo $this->Form->end();
?>