<h1>Registro de nuevo usuario</h1>
<?php
echo $this->Form->create('Usuario');
echo $this->Form->input('alias', array(
    'placeholder' => 'Alias',
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
?>
<fieldset>
    <legend>Datos de Empleado: </legend>
    <?php
    echo $this->Form->input('Empleado.0.nombres', array(
        'placeholder' => 'Nombres',
        'label' => false
    ));
    echo $this->Form->input('Empleado.0.apellido1', array(
        'placeholder' => 'Primer Apellido',
        'label' => false
    ));
    echo $this->Form->input('Empleado.0.apellido2', array(
        'placeholder' => 'Segundo apellido',
        'label' => false
    ));
    echo $this->Form->input('Empleado.0.catcargo_id', array('empty' => 'Seleccione el cargo', 'label' => false));
    ?>
</fieldset>
<?php
echo $this->Form->button('Registrar', array('class' => 'save'));
echo $this->Form->end();
?>