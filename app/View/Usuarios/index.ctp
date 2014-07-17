<h2>Usuarios</h2>
<a href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'nuevo')); ?>"><div class="btnNuevo"></div></a>
<table>
    <tr>
        <th>ID</th>
        <th>Alias</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    <?php
    foreach ($usuarios as $usuario):
        ?>
        <tr>
            <td><?php echo $usuario['Usuario']['id']; ?></td>
            <td><?php echo $usuario['Usuario']['alias']; ?></td>
            <?php if ($usuario['Usuario']['estado'] == 1): ?>
                <td>Activo</td>
                <?php
            else:
                ?>
                <td>Inactivo</td>
            <?php
            endif;
            ?>

            <td></td>
        </tr>
    <?php endforeach; ?>
</table>