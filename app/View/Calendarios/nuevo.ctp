<h2>Nuevo Calendario</h2>
<?php
echo $this->Form->create('Calendario');
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->input('fechainicio', array('label' => false));
echo $this->Form->input('fechafinal', array('label' => false));
echo $this->Form->input('arancel', array('label' => false, 'placeholder' => 'Arancel'));
echo $this->Form->input('cattramite_id', array('type' => 'hidden', 'value' => $cattramite_id));
echo $this->Form->button('Guardar', array('class' => 'save'));
echo $this->Form->end();
?>