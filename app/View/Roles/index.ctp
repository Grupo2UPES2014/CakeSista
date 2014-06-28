<?php echo $this->Html->link('Nuevo',array('controller'=>'roles','action'=>'nuevo')); ?>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php
    foreach ($roles as $rol):
    ?>
    <tr>
        <td><?php echo $rol['Role']['id']; ?></td>
        <td><?php echo $rol['Role']['nombre'] ?></td>
        <td><?php echo $this->Html->link('Editar',array('controller'=>'roles','action'=>'editar',$rol['Role']['id'])); ?></td>
    </tr>
    <?php endforeach; ?>
</table>