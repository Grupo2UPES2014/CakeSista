<h2>Facultades</h2>
<?php
echo $this->Html->link('Nuevo', array('controller' => 'facultades', 'action' => 'nuevo'));
?>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
    </tr>
    <?php
    foreach ($facultades as $facultad):
        ?>
        <tr>
            <td><?php echo $facultad['Facultade']['id']; ?></td>
            <td><?php echo $facultad['Facultade']['nombre']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>