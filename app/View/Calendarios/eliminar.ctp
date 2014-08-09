<h2>Eliminar Calendario</h2>
<h3><?php echo $calendario['Calendario']['nombre']; ?></h3>
<?php
echo $this->Form->create('Calendario');
echo $this->Form->input('id');
echo $this->Form->button('Eliminar', array('class' => 'del'));
echo $this->Form->end();
?>