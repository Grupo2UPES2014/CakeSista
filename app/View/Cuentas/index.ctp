<h2>Cuentas</h2>
<a href="<?php echo Router::url(array('controller' => 'cuentas', 'action' => 'nuevo')); ?>"><div class="btnNuevo"></div></a>
<table>
    <tr>
        <th>ID</th>
        <th>Cuenta</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($cuentas as $cuenta): ?>
        <tr>
            <td><?php echo $cuenta['Cuenta']['id']; ?></td>
            <td><?php echo $cuenta['Cuenta']['numero']; ?></td>
            <?php if ($cuenta['Cuenta']['activo'] == 1): ?>
                <td>Activo</td>
            <?php else: ?>
                <td>Inactivo</td>
            <?php endif; ?>
            <td>
                <a href="<?php echo Router::url(array('controller' => 'cuentas', 'action' => 'editar', $cuenta['Cuenta']['id'])); ?>"><div class="ico medium icoUpdate"></div></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>