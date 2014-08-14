<?php
$this->set('title_for_layout', 'Configuración');
?>
<h1>Configuración</h1>
<div class="opciones">
    <fieldset><legend>Actualizar:</legend>
        <div>
            <a href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'md_correo', $this->Session->read('Auth.User.id'))); ?>"><div class="opcion correo">Correo</div></a>
            <a href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'umd_contrasena', $this->Session->read('Auth.User.id'))); ?>"><div class="opcion pass">Contraseña</div></a> 
        </div>
    </fieldset>
</div>