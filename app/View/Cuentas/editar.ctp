<h2>Actualizar Cuenta</h2>
<?php
echo $this->Form->create('Cuenta');
echo $this->Form->input('id');
echo $this->Form->input('numero', array('label' => false, 'placeholder' => 'Número'));
echo $this->Form->input('descripcion', array('label' => false, 'placeholder' => 'Descripción'));
echo $this->Form->input('activo', array('label' => 'Activar'));
echo $this->Form->button('Actualizar', array('class' => 'update'));
echo $this->Form->end();
?>