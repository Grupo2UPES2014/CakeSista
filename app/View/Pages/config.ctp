<?php
$this->set('title_for_layout', 'Configuración');
?>
<h1>Configuración</h1>
<div class="opciones">
    <div>
        <a href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'md_correo', $this->Session->read('Auth.User.id'))); ?>"><div class="opcion">Cambio de correo</div></a>
        <a href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'umd_contrasena', $this->Session->read('Auth.User.id'))); ?>"><div class="opcion">Cambio de contraseña</div></a>
        
 </div>
</div>