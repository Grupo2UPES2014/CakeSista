<h2>Buzón de Tareas</h2>
<?php
var_dump($tareas);
?>
<table>
    <tr>
        <th>ID</th>
        <th>Tramite</th>
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
            <td><?php echo $tarea['Tarea']['tramite_id']; ?></td>
            <td><?php echo $tarea['Cattarea']['nombre']; ?></td>
            <td><?php echo $tarea['Tarea']['estado']; ?></td>
            <td><?php echo $tarea['Tarea']['tipo']; ?></td>
            <td></td>
        </tr>  
    <?php endforeach; ?>
</table>

