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
                <?php echo $this->Html->link('Editar',array('controller'=>'facultades','action'=>'editar',$facultad['Facultade']['id'])); ?>
                <?php echo $this->Html->link('Eliminar',array('controller'=>'facultades','action'=>'eliminar',$facultad['Facultade']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>