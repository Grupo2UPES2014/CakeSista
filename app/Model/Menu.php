<?php

App::uses('AppModel', 'Model');

/**
 * CakePHP Menu
 * @author BeardMan
 */
class Menu extends AppModel {

    public $useTable = false;
    public $menu = array(
        1 => array(
            array(
                'titulo' => 'Trámites',
                'icono' => 'icoTramite',
                'ruta' => 'cattramites'
            ),
            array(
                'titulo' => 'Catálogos',
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
                'ruta' => 'pages/config'
            ),
        ),
        2 => array(
            array(
                'titulo' => 'Buzón',
                'icono' => 'icoInbox',
                'ruta' => 'tareas/index'
            ),
            array(
                'titulo' => 'Configuración',
                'icono' => 'icoCog',
                'ruta' => 'pages/config'
            )
        ),
        3 => array(
            array(
                'titulo' => 'Trámites',
                'icono' => 'icoTramite',
                'ruta' => 'cattramites/tramites'
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
                'ruta' => 'pages/config'
            )
        )
    );

    public function getMenu($rol) {
        return $this->menu[$rol];
    }

}
