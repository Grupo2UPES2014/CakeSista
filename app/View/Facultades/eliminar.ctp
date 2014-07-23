<h2>Eliminar Facultad</h2>
<h3><?php echo $facultad['Facultade']['nombre']; ?></h3>
<?php
echo $this->Form->create('Facultade');
echo $this->Form->input('id');
echo $this->Form->button('Eliminar', array('class' => 'del'));
echo $this->Form->end();
?>