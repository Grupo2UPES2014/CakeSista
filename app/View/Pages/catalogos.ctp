<?php
$this->set('title_for_layout', 'Catálogos');
?>
<?php
echo $this->Html->link('Facultades', array('controller' => 'facultades', 'action' => 'index'));
?>
<br>
<?php
echo $this->Html->link('Carreras', array('controller' => 'carreras', 'action' => 'index'));
?>