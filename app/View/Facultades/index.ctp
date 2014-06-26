<h2>Facultades</h2>
<?php
echo $this->Html->link('Nuevo', array('controller' => 'facultades', 'action' => 'nuevo'));
?>
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
            <td><?php echo $this->Html->link('Editar',array('controller'=>'facultades','action'=>'editar',$facultad['Facultade']['id'])); ?></td>
        </tr>
    <?php endforeach; ?>
</table>