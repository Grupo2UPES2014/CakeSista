<h2>Catálogo de Trámites</h2>
<a href="<?php echo Router::url(array('controller' => 'cattramites', 'action' => 'nuevo')); ?>"><div class="btnNuevo"></div></a>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Arancel</th>
        <th>Acciones</th>
    </tr>
    <?php
    foreach ($cattramites as $tramite):
        ?>
        <tr>
            <td><?php echo $tramite['Cattramite']['id']; ?></td>
            <td><?php echo $tramite['Cattramite']['nombre']; ?></td>
            <td><?php echo $tramite['Cattramite']['arancel']; ?></td>
            <td><a href="<?php echo Router::url(array('action' => 'editar',$tramite['Cattramite']['id'])); ?>"><div class="ico medium icoUpdate"></div></a><a href="<?php echo Router::url(array('controller'=>'calendarios','action' => 'index',$tramite['Cattramite']['id'])); ?>"><div class="ico medium icoCalendario"></div></a></td>
        </tr>
        <?php
    endforeach;
    ?>
</table>