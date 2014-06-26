<?php
echo $this->Form->create('Facultade');
echo $this->Form->input('id');
echo $this->Form->input('nombre',array('label'=>'Nombre: '));
echo $this->Form->end('Guardar');
?>