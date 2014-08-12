<h2><?php echo $cattramite['Cattramite']['nombre']; ?></h2>
<table>
    <tr>
        <th>Pasos</th>
        <th>Descripción</th>
    </tr>
    <?php
    foreach ($cattramite['Cattarea'] as $cattarea):
        ?>
        <tr>
            <td><?php echo $cattarea['correlativo']; ?></td>
            <td>
                <?php echo $cattarea['nombre']; ?>   
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="<?php echo Router::url(array('controller' => 'tramites', 'action' => 'nuevo',$cattramite['Cattramite']['id'])); ?>"><button>Iniciar Trámite</button></a>