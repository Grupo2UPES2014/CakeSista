<h2>Facultades</h2>
<a href="<?php echo Router::url(array('controller' => 'facultades', 'action' => 'nuevo')); ?>"><div class="btnNuevo"></div></a>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php
    foreach ($facultades as $facultad):
        ?>
        <tr>
            <td><?php echo $facultad['Facultade']['id']; ?></td>
            <td><?php echo $facultad['Facultade']['nombre']; ?></td>
            <td>
                <a href="<?php echo Router::url(array('controller' => 'facultades', 'action' => 'editar', $facultad['Facultade']['id'])); ?>"><div class="ico medium icoUpdate"></div></a>
                <a href="<?php echo Router::url(array('controller' => 'facultades', 'action' => 'eliminar', $facultad['Facultade']['id'])); ?>"><div class="ico medium icoDel"></div></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>