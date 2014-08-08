<h2>Asignaturas</h2>
<a href="<?php echo Router::url(array('controller' => 'asignaturas', 'action' => 'nuevo')); ?>"><div class="btnNuevo"></div></a>
<table>
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php
    foreach ($asignaturas as $asignatura):
        ?>
        <tr>
            <td><?php echo $asignatura['Asignatura']['codigo'] ?></td>
            <td><?php echo $asignatura['Asignatura']['nombre'] ?></td>
            <td><a href="<?php echo Router::url(array('controller' => 'asignaturas', 'action' => 'editar', $asignatura['Asignatura']['id'])); ?>"><div class="ico medium icoUpdate"></div></a></td>
        </tr>
        <?php
    endforeach;
    ?>
</table>