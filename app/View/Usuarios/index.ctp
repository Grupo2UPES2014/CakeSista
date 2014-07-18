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
            elseif ($usuario['Usuario']['estado'] == 2):
                ?>
                <td>Bloqueado</td>
            <?php else: ?>
                <td>Inactivo</td>
            <?php
            endif;
            ?>

            <td>
                <a href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'md_contrasena', $usuario['Usuario']['id'])); ?>">Cambiar contraseña</a> 
                <a href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'md_estado', $usuario['Usuario']['id'])); ?>">Cambiar estado</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>