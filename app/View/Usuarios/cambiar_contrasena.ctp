<h2>Nueva Contraseña</h2>
<?php
echo $this->Form->create('Usuario');
echo $this->Form->input('contrasena', array('placeholder' => 'Contraseña', 'label' => FALSE, 'type' => 'password'));
echo $this->Form->input('r_contrasena', array('placeholder' => 'Repetir Contraseña', 'label' => FALSE, 'type' => 'password'));
echo $this->Form->button('Actualizar');
echo $this->Form->end();
?>