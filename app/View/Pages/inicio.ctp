<h3>Otros servicios</h3>
<?php
echo $this->Html->image('upes1.png', array('url' => 'http://www.upes.edu.sv/', 'class' => 'imgcenter'));
?>
<br><br><br><br><br><br><br><br><br>
<div style="width: 500px;margin-left: auto;margin-right: auto;"><?php
    echo $this->Html->image('6.png', array('height' => 138, 'url' => 'http://aulaweb.upes.edu.sv/'));
//echo 'Aulaweb<br>';
    echo $this->Html->image('matriz.png', array('height' => 138, 'url' => 'http://www.upes.edu.sv/desafio/'));
//echo 'Desafío Politécnico<br>';
    echo $this->Html->image('book-icon.png', array('url' => 'http://aulaweb.upes.edu.sv/siab75/opac/'));
//echo 'BIBLIOTECA EN LÍNEA<br>';
    $this->Html->css('inicio', array('inline' => false));
    ?></div>