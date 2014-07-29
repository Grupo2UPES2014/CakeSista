<h2>Eliminar Asignatura</h2>
<h3><?php echo $asignatura['Asignatura']['codigo']; ?></h3>
<?php
echo $this->Form->create('Asignatura');
echo $this->Form->input('id');
echo $this->Form->button('Eliminar', array('class' => 'del'));
echo $this->Form->end();
?>