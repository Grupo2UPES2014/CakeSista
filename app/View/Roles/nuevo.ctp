<h2>Nuevo Rol</h2>
<?php
echo $this->Form->create('Role');
echo $this->Form->input('nombre');
echo $this->Form->end('Guardar');
?>