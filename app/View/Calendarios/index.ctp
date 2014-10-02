<h2>Calendarios</h2>
<a href="<?php echo Router::url(array('controller' => 'calendarios', 'action' => 'nuevo', $cattramite_id)); ?>"><div class="btnNuevo"></div></a>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Periodo</th>
        <th>Acciones</th>
    </tr>
    <?php
    foreach ($calendarios as $calendario):
        ?>
    <tr>
        <td><?php echo $calendario['Calendario']['id'];?></td>
        <td><?php echo $calendario['Calendario']['nombre'];?></td>
        <td><?php echo date('d/m', strtotime($calendario['Calendario']['fechainicio']));?> al <?php echo date('d/m', strtotime($calendario['Calendario']['fechafinal']));?></td>
        <td><a href="<?php echo Router::url(array('action' => 'editar', $calendario['Calendario']['id'])); ?>"><div class="ico medium icoUpdate"></div></a></td>
    </tr>
    <?php endforeach; ?>
</table>