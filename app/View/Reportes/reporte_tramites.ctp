<?php

?>
<h2>Tramites Iniciados por mes</h2>
<?php
echo $this->Form->create('Reporte');
echo $this->Form->select('anyo', array(date('Y')), array('empty' => 'Seleccione el año'));
echo $this->Form->select('mes', $meses, array('empty' => 'Seleccione el Mes', 'value' => date('m')));
echo '<br>';
echo $this->Form->button('Consultar');
echo $this->Form->end();
echo $this->Html->image('r1.png');
//var_dump($total);
//var_dump($data);
?>