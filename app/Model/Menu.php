<?php

App::uses('AppModel', 'Model');

/**
 * CakePHP Menu
 * @author Amaury
 */
class Menu extends AppModel {

    public $useTable = false;
    public $menu = array(
        1 => array(
            array(
                'titulo' => 'Catágolos',
                'icono' => 'icoCat',
                'ruta' => 'pages/catalogos'
            ),
            array(
                'titulo' => 'Usuarios',
                'icono' => 'icoUser',
                'ruta' => 'usuarios'
            ),
            array(
                'titulo' => 'Configuración',
                'icono' => 'icoCog',
                'ruta' => ''
            )
        ),
        2 => array(
            array(
                'titulo' => 'Configuración',
                'icono' => 'icoCog',
                'ruta' => ''
            )
        ),
        3 => array(
            array(
                'titulo' => 'Trámites',
                'icono' => 'icoTramite',
                'ruta' => ''
            ),
            array(
                'titulo' => 'Buzón',
                'icono' => 'icoInbox',
                'ruta' => ''
            )
            ,
            array(
                'titulo' => 'Configuración',
                'icono' => 'icoCog',
                'ruta' => ''
            )
        )
    );

    public function getMenu($rol) {
        return $this->menu[$rol];
    }

}
