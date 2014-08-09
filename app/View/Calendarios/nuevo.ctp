<h2>Nuevo Calendario</h2>
<?php
echo $this->Form->create('Calendario');
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Calendario')); //'type' => 'textarea'
// El apellido 1 y 2 como colocarlo en Singular??
echo $this->Form->input('fechainicio', array('label' => false, 'placeholder' => 'Fecha de Inicio')); //'type' => 'textarea'
echo $this->Form->input('fechafinal', array('label' => false, 'placeholder' => 'Fecha Final')); //'type' => 'textarea'
echo $this->Form->input('arancel', array('label' => false, 'placeholder' => 'Arancel')); //'type' => 'textarea'
echo $this->Form->input('cattramite_id', array('label' => false, 'placeholder' => 'ID de Calendario')); //'type' => 'textarea'
echo $this->Form->button('Guardar', array('class' => 'save'));
echo $this->Form->end();
?>