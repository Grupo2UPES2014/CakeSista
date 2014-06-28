<h2>Carreras</h2>
<?php echo $this->Html->link('Nuevo', array('controller' => 'carreras', 'action' => 'nuevo')); ?>
<table>
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php
    foreach ($carreras as $carrera):
        ?>
        <tr>
            <td><?php echo $carrera['Carrera']['codigo']; ?></td>
            <td><?php echo $carrera['Carrera']['nombre']; ?></td>
            <td>
                <?php echo $this->Html->link('Editar',array('controller'=>'carreras','action'=>'editar',$carrera['Carrera']['id'])) ; ?> - Eliminar
            </td>
        </tr>
        <?php
    endforeach;
    ?>
</table>