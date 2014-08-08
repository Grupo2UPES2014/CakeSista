<h2>Nuevo trámite</h2>
<?php
echo $this->Form->create('Cattramite');
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->input('arancel', array('label' => false, 'placeholder' => 'Arancel', 'step' => '0.5'));
echo $this->Form->input('porcentajerecargo', array('label' => false, 'placeholder' => 'Porcentaje de racargo', 'step' => '0.5'));
?>
<fieldset><legend>Tareas:</legend>
    <?php
    echo $this->Form->hidden('Cattarea.0.correlativo', array('value' => '1'));
    echo $this->Form->input('Cattarea.0.nombre', array('label' => false, 'placeholder' => 'Nombre'));
    echo $this->Form->input('Cattarea.0.descripcion', array('label' => false, 'placeholder' => 'Descripción'));
    $tipos = array(
        '1' => 'Diligencia',
        '2' => 'Mandamiento',
        '3' => 'documento',
        '4' => 'formulario'
    );
    echo $this->Form->select('Cattarea.0.tipo', $tipos, array('empty' => 'Seleccione el Tipo'));
    echo $this->Form->input('Cattarea.0.catcargo_id', array('empty' => 'Seleccione el cargo', 'label' => false));
    ?>
    <button id="mas">+</button>
</fieldset>
<?php
echo $this->Form->button('Guardar', array('class' => 'save'));
echo $this->Form->end();
echo $this->Html->script('cattramites', array('block' => 'sistajs'));
?>