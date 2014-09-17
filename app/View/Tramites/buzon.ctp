<h2>Buzón de Trámites</h2>
<table>
    <tr>
        <th>Tramite</th>
        <th>Estado</th>
        <th>Fecha de inicio</th>
        <th>Acciones</th>
    </tr>
    <?php
    foreach ($tramites as $tramite):
        ?>
        <tr>
            <td><?php echo $tramite['Cattramite']['nombre']; ?></td>
            <td><?php echo $estados[$tramite['Tramite']['estado']]; ?></td>
            <td><?php echo $tramite['Tramite']['fechainicio']; ?></td>
            <td><div class="ico medium icoView"></div> Ver</td>
        </tr>
        <?php
    endforeach;
    ?>
</table>
<?php
var_dump($tramites);
?>