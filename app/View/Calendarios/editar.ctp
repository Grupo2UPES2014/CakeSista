<h2>Actualizar Calendario</h2>
<?php
echo $this->Form->create('Calendario');
echo $this->Form->input('id');
echo $this->Form->input('nombres', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->input('fechainicio', array('label' => false, 'placeholder' => 'Fecha de Inicio'));
echo $this->Form->input('fechafinal', array('label' => false, 'placeholder' => 'Fecha Final'));
echo $this->Form->input('arancel', array('label' => false, 'placeholder' => 'Arancel'));
echo $this->Form->input('catcargo_id', array('label' => false));
echo $this->Form->button('Actualizar', array('class' => 'update'));
echo $this->Form->end();
?>