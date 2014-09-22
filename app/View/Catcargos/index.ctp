<h2>Cargos</h2>
<a href="<?php echo Router::url(array('controller' => 'catcargos', 'action' => 'nuevo')); ?>"><div class="btnNuevo"></div></a>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($catcargos as $cargo): ?>
        <tr>
            <td><?php echo $cargo['Catcargo']['id']; ?></td>
            <td><?php echo $cargo['Catcargo']['nombre']; ?></td>
            <td>
                <a href="<?php echo Router::url(array('controller' => 'catcargos', 'action' => 'editar', $cargo['Catcargo']['id'])); ?>"><div class="ico medium icoUpdate"></div></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php echo $this->Paginator->first('<< Primero ') ?>&nbsp;
<?php echo $this->Paginator->prev('<< Anterior ') ?>&nbsp;
<?php echo $this->Paginator->numbers(); ?>&nbsp;
<?php echo $this->Paginator->next(' Siguiente >>') ?>&nbsp;
<?php echo $this->Paginator->last('Ultimo >>') ?>