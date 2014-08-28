<h2>Actividad</h2>
<h3>Paso nº<?php echo $cattareas['Cattarea']['correlativo']; ?> : <?php echo $cattareas['Cattarea']['nombre']; ?></h3>
<em><?php echo $cattareas['Cattarea']['descripcion']; ?></em>
<?php
echo $this->Form->create('Tarea');
echo $this->Form->input('id');
echo $this->Form->input('observaciones', array('placeholder' => 'Observaciones', 'label' => false));
echo $this->Form->input('estado');
echo $this->Form->button('Finalizar');
echo $this->Form->end();
?>