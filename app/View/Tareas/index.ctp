<h2>Buzón de Tareas</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Tramite</th>
        <th>Estudiante</th>
        <th>Tarea</th>
        <th>Estado</th>
        <th>Tipo</th>
        <th>Acciones</th>
    </tr>
    <?php
    foreach ($tareas as $tarea):
        ?>
        <tr>
            <td><?php echo $tarea['Tarea']['id']; ?></td>
            <td>#<?php echo $tarea['Tramite']['id']; ?> <?php echo $tarea['Cattramite']['nombre']; ?></td>
            <td><?php echo $tarea['Estudiante']['nombres']; ?> <?php echo $tarea['Estudiante']['apellido1']; ?> <?php echo $tarea['Estudiante']['apellido2']; ?>(<?php echo $tarea['Estudiante']['carnet']; ?>)</td>
            <td><?php echo $tarea['Cattarea']['nombre']; ?></td>
            <td><?php echo $estados[$tarea['Tarea']['estado']]; ?></td>
            <td><?php echo $tipos[$tarea['Cattarea']['tipo']][0]; ?></td>
            <td><a href="<?php echo Router::url(array('controller' => 'tareas', 'action' => 'ver', $tarea['Tarea']['id'])); ?>"><div class="ico medium icoView"></div></a> <a href="<?php echo Router::url(array('controller' => 'tareas', 'action' => $tipos[$tarea['Cattarea']['tipo']][1], $tarea['Tarea']['id'])); ?>"><div class="ico medium iconRecibir"></div></a></td>
        </tr>  
    <?php endforeach; ?>
</table>

