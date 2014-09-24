<h2>Empleados</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($empleados as $empleado): ?>
        <tr>
            <td><?php echo $empleado['Empleado']['id'] ?></td>
            <td><?php echo $empleado['Empleado']['nombres'] . ' ' . $empleado['Empleado']['apellido1'] . ' ' . $empleado['Empleado']['apellido2']; ?></td>
            <td>
                <a href="<?php echo Router::url(array('controller' => 'empleados', 'action' => 'editar', $empleado['Empleado']['id'])); ?>"><div class="ico medium icoUpdate"></div></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php echo $this->Paginator->first('<< Primero ') ?>&nbsp;
<?php echo $this->Paginator->prev('<< Anterior ') ?>&nbsp;
<?php echo $this->Paginator->numbers(); ?>&nbsp;
<?php echo $this->Paginator->next(' Siguiente >>') ?>&nbsp;
<?php echo $this->Paginator->last('Ultimo >>') ?>