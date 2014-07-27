<h2>Eliminar Cargo</h2>
<h3><?php echo $facultad['Cargo']['nombre']; ?></h3>
<?php
echo $this->Form->create('Cargo');
echo $this->Form->input('id');
echo $this->Form->button('Eliminar', array('class' => 'del'));
echo $this->Form->end();
?>