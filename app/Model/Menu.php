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
                'titulo' => 'HomeX',
                'icono' => 'icoCog',
                'ruta' => 'carreras/'
            ),
            array(
                'titulo' => 'HomeX2',
                'icono' => 'icoInbox',
                'ruta' => ''
            )
        ),
        2 => 'y',
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
