<h2>Trámites Academicos</h2>
<table>
    <tr>
        <th>Nombre</th>
        <th>Arancel</th>
        <th>Acciones</th>
    </tr>
    <?php
    foreach ($cattramites as $tramite):
        ?>
        <tr>
            <td><a href="<?php echo Router::url(array('controller' => 'cattramites', 'action' => 'tramite', $tramite['Cattramite']['id'])); ?>" class="vTramite"><?php echo $tramite['Cattramite']['nombre']; ?></a></td>
            <td><?php echo $tramite['Cattramite']['arancel']; ?></td>
            <td>
                <a href="<?php echo Router::url(array('controller' => 'cattramites', 'action' => 'tramite', $tramite['Cattramite']['id'])); ?>">
                    <div class="ico medium icoView"></div>
                </a>
            </td>
        </tr>
        <?php
    endforeach;
    ?>
</table>