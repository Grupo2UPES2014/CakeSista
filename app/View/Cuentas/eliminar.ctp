<h2>Eliminar Cuenta</h2>
<h3><?php echo $cuenta['Cuenta']['numero']; ?></h3>
<?php
echo $this->Form->create('Cuenta');
echo $this->Form->input('id');
echo $this->Form->button('Eliminar', array('class' => 'del'));
echo $this->Form->end();
?>