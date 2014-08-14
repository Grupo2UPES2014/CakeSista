<h2>Nueva contraseña</h2>
<?php if (isset($this->request->data['Usuario']['alias'])): ?>
    <h3><?php echo strtoupper($this->request->data['Usuario']['alias']); ?></h3>
<?php endif; ?>

<?php
echo $this->Form->create('Usuario');
echo $this->Form->input('id');
echo $this->Form->input('contrasena', array(
    'type' => 'password',
    'placeholder' => 'Nueva Contraseña',
    'label' => false
));
echo $this->Form->button('Actualizar', array('class' => 'update'));
echo $this->Form->end();
?>