<h2>Editar Trámite</h2>
<?php
echo $this->Form->create('Cattramite');
echo $this->Form->input('id');
echo $this->Form->input('nombre', array('label' => false, 'placeholder' => 'Nombre'));
echo $this->Form->input('codigo', array('label' => false, 'placeholder' => 'Código'));
echo $this->Form->input('arancel', array('label' => false, 'placeholder' => 'Arancel', 'step' => '0.5'));
echo $this->Form->input('porcentajerecargo', array('label' => false, 'placeholder' => 'Porcentaje de racargo', 'step' => '0.5'));
?>
<fieldset><legend>Tareas:</legend>
    <?php
    $n = 0;
    foreach ($cattareas as $tarea) {
        if ($n > 0)
            echo '<hr>';
        echo $this->Form->hidden('Cattarea.' . $n . '.id', array('value' => $tarea['Cattarea']['id']));
        echo $this->Form->input('Cattarea.' . $n . '.nombre', array('label' => false, 'placeholder' => 'Nombre','value'=>$tarea['Cattarea']['nombre']));
        echo $this->Form->input('Cattarea.' . $n . '.descripcion', array('label' => false, 'placeholder' => 'Descripción','value'=>$tarea['Cattarea']['descripcion']));
        $tipos = array(
            '1' => 'Actividad',
            '2' => 'Mandamiento de Pago',
            '3' => 'Documento',
            '4' => 'Formulario'
        );
        echo $this->Form->select('Cattarea.' . $n . '.tipo', $tipos, array('empty' => 'Seleccione el Tipo','value'=>$tarea['Cattarea']['tipo']));
        echo $this->Form->input('Cattarea.' . $n . '.catcargo_id', array('empty' => 'Seleccione el cargo', 'label' => false,'value'=>$tarea['Cattarea']['catcargo_id']));
        $n++;
    }
    ?>
</fieldset>
<?php
echo $this->Form->button('Guardar', array('class' => 'save'));
echo $this->Form->end();
?>