<h1>Registro de nuevo usuario</h1>
<?php
echo $this->Form->create('Usuario');
echo $this->Form->input('alias', array(
    'placeholder' => 'Carnet',
    'label' => false
));
echo $this->Form->input('contrasena', array(
    'type' => 'password',
    'placeholder' => 'Contraseña',
    'label' => false
));
echo $this->Form->input('correo', array(
    'placeholder' => 'Correo Electrónico',
    'label' => false
));
echo $this->Form->button('Registrase', array('class' => 'save'));
echo $this->Form->end();
?>