<h2><?php echo $tramite['Cattramite']['nombre'];?></h2>
<br>
<div class="SeguimientoGrid">
    <?php
    $n = 0;
    foreach ($cattareas as $cattarea):
        ?>
        <?php
        if (!empty($tramite['Tarea'][$n]['estado'])) {
            $clase = $estados[$tramite['Tarea'][$n]['estado']];
        } else
            $clase = $estados[0];
        ?>
        <div title="Descripción: <?php echo $cattarea['Cattarea']['descripcion']; ?>" class="<?php echo $clase; ?>">
            <span><?php echo $cattarea['Cattarea']['correlativo']; ?></span>
            <div class="<?php echo $tipos[$cattarea['Cattarea']['tipo']]; ?>"></div>
            <span style="font-weight: bold;"><?php echo $cattarea['Cattarea']['nombre']; ?></span>
            <span style="font-size: 12px"><?php echo $cattarea['Catcargo']['nombre']; ?></span>
        </div>
        <?php
        $n++;
    endforeach;
    ?>
</div>
<?php
var_dump($tramite);
echo '--------------------------------';
var_dump($cattareas);
?>