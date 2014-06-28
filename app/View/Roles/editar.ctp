<h2>Editar Role</h2>
<?php
echo $this->Form->create('Role');
echo $this->Form->input('id');
echo $this->Form->input('nombre');
echo $this->Form->end('Actualizar');
?>