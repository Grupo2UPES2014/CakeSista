<h2>Iniciar Sesión</h2>
<?php
echo $this->Form->create('Usuario');
echo $this->Form->input('alias', array(
    'placeholder' => 'Carnet',
    'label' => FALSE
));
echo $this->Form->input('contrasena', array(
    'placeholder' => 'Contraseña',
    'label' => FALSE,
    'type' => 'password'
));
echo $this->Form->button('Iniciar Sesión');
echo $this->Form->end();
?>

<span>¿Has olvidado tu contraseña?</span><br>
<span><?php echo $this->Html->link('¿No tienes cuenta?',array('controller'=>'registro')); ?></span>