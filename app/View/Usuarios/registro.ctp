<h2>Registrar Cuenta</h2>
<?php
echo $this->Form->create('Usuario');
echo $this->Form->input('alias', array('label' => false, 'placeholder' => 'Carnet'));
echo $this->Form->input('contrasena', array('label' => false, 'placeholder' => 'Contraseña', 'type' => 'password'));
echo $this->Form->input('rcontrasena', array('label' => false, 'placeholder' => 'Repetir Contraseña', 'type' => 'password'));
echo $this->Form->input('correo', array('label' => false, 'placeholder' => 'Correo Electrónico'));
echo $this->Form->button('Registrar Cuenta');
echo $this->Form->end();
?>