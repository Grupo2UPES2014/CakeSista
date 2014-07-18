<h2>Cambiar estado</h2>
<?php if (isset($this->request->data['Usuario']['alias'])): ?>
    <h3><?php echo strtoupper($this->request->data['Usuario']['alias']); ?></h3>
<?php endif; ?>

<?php
echo $this->Form->create('Usuario');
echo $this->Form->input('id');
if (isset($this->request->data['Usuario']['estado'])) {
    echo $this->Form->select(
            'estado', array(
        '1' => 'Activo',
        '2' => 'Bloqueado'
            ), array(
        'empty' => 'Selecciona un estado',
        'default' => $this->request->data['Usuario']['estado']
    ));
} else {
    echo $this->Form->select(
            'estado', array(
        '1' => 'Activo',
        '2' => 'Bloqueado'
            ), array(
        'empty' => 'Selecciona un estado'));
}
echo '<br>';
echo $this->Form->button('Actualizar', array('class' => 'update'));
echo $this->Form->end();
?>