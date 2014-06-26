 <?php
echo $this->Form->create('Carrera');
echo $this->Form->input('id');
echo $this->Form->input('codigo');
echo $this->Form->input('nombre');
echo $this->Form->input('nombreabrev');
echo $this->Form->input('facultade_id', array('empty' => 'Seleccione Facultad'));
echo $this->Form->end('Actualizar');
?>