<?php
//
//Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
//[Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
//
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SiSTA</title>
    </head>

    <body style="background: #233E78;font-family: Arial, Helvetica, sans-serif;">   
        <div style="background: #233E78;">
            <div style="width: 100%;">
                <img src="cid:logo" style="z-index: 2;position: absolute;top: 0px;" alt="SISTA LOGO">
            </div>
            <div style="background-color: #cccccc;">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
    </body>
</html>