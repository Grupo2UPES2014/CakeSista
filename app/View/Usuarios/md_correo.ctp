<h2>Cambiar correo</h2>
<h3>Correo activo: <?php echo $this->Session->read('Auth.User.correo'); ?></h3><hr>
<?php
echo $this->Form->create('Usuario');
echo $this->Form->input('id');
echo $this->Form->input('n_correo', array(
    'placeholder' => 'Nuevo Correo',
    'label' => false
        )
);
echo $this->Form->button('Actualizar', array('class' => 'update'));
echo $this->Form->end();
?>