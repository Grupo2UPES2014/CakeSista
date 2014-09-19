<h2><?php echo $tramite['Cattramite']['nombre']; ?></h2>
<br>
<div class="SeguimientoGrid">
    <?php
    $n = 0;
    foreach ($cattareas as $cattarea):
        ?>
        <?php
        if (!empty($tramite['Tarea'][$n]['estado'])) {
            $clase = $estados[$tramite['Tarea'][$n]['estado']];
            $id = $tramite['Tarea'][$n]['id'];
        } else {
            $clase = $estados[0];
            $id = NULL;
        }
        ?>

        <div title="Descripción: <?php echo $cattarea['Cattarea']['descripcion']; ?>" class="<?php echo $clase; ?>" data-tipo="<?php echo $cattarea['Cattarea']['tipo']; ?>" data-id="<?php echo $id; ?>">
            <span><?php echo $cattarea['Cattarea']['correlativo']; ?></span>
            <div class="<?php echo $tipos[$cattarea['Cattarea']['tipo']]; ?>"></div>
            <span style="font-weight: bold;"><?php echo $cattarea['Cattarea']['nombre']; ?></span>
            <span style="font-size: 12px"><?php echo $cattarea['Catcargo']['nombre']; ?></span>
        </div>
        <?php
        $n++;
    endforeach;
    echo $this->Html->link('<strong>test</strong>', array('controller' => 'tareas', 'action' => 'mandamiento', 107), array('target' => '_blank'));
    ?>
</div>
<?php
echo $this->Html->script('buzonEstudiante', array('block' => 'sistajs'));
?>