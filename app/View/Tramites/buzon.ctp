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
            <td><a href="<?php echo Router::url(array('controller' => 'tramites', 'action' => 'ver', $tramite['Tramite']['id'])); ?>"><div class="ico medium icoView"></div>Ver</a></td>
        </tr>
        <?php
    endforeach;
    ?>
</table>