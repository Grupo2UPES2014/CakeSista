<h2>Recuperar contraseña</h2>
<?php
echo $this->Form->create('Usuario');
echo $this->Form->input('v_correo', array('label' => false, 'placeholder' => 'Correo Electrónico'));
echo $this->Form->button('Recuperar');
echo $this->Form->end();
?>
<span id="tut" data-fuente="rc" data-titulo="Recuperar Contraseña">¿Como recuperar la contraseña?</span>