<h2>Usuarios</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Alias</th>
        <th>Acciones</th>
    </tr>
    <?php
    foreach ($usuarios as $usuario):
        ?>
        <tr>
            <td><?php echo $usuario['Usuario']['id']; ?></td>
            <td><?php echo $usuario['Usuario']['alias']; ?></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
</table>