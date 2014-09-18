<div class="SeguimientoGrid">
    <?php
    foreach ($cattareas as $cattarea):
        ?>
        <div title="Descripción: <?php echo $cattarea['Cattarea']['descripcion']; ?>" class="noiniciado">
            <span><?php echo $cattarea['Cattarea']['correlativo']; ?></span>
            <div class="<?php echo $tipos[$cattarea['Cattarea']['tipo']]; ?>"></div>
            <span style="font-weight: bold;"><?php echo $cattarea['Cattarea']['nombre']; ?></span>
            <span style="font-size: 12px"><?php echo $cattarea['Catcargo']['nombre']; ?></span>
        </div>
    <?php endforeach; ?>
</div>
<?php
var_dump($tramite);
echo '--------------------------------';
var_dump($cattareas);
?>