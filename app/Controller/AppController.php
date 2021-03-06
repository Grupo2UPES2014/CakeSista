<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        //'DebugKit.Toolbar',
        'Session',
        'Acl',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario',
                    'fields' => array(
                        'username' => 'alias',
                        'password' => 'contrasena'
                    ),
                    'passwordHasher' => array(
                        'className' => 'Simple',
                        'hashType' => 'md5'
                    )
                )
            ),
            'loginAction' => array(
                'controller' => 'usuarios',
                'action' => 'login'
            ),
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers', 'userModel' => 'Usuario')
            )
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        date_default_timezone_set('America/El_Salvador');
        $this->Auth->allow('registro', 'activar', 'logout', 'nuevo_correo', 'recuperar_contrasena', 'cambiar_contrasena');
        if ($this->Auth->user()) {
            if (!($this->Acl->check(array('Usuario' => $this->Auth->user()), $this->name . '/' . $this->action) || $this->Acl->check(array('Usuario' => $this->Auth->user()), $this->name)) && $this->name != 'CakeError') {
                $this->redirect(array('controller' => 'pages', 'action' => 'prohibido'));
                //$this->redirect($this->Auth->logout());
            }
            if ($this->name == 'Pages') {
                if (!$this->Acl->check(array('Usuario' => $this->Auth->user()), $this->name . '/' . $this->action . '/' . $this->params['pass'][0]) && $this->action == 'display') {
                    $this->redirect(array('controller' => 'pages', 'action' => 'prohibido'));
                    //$this->redirect($this->Auth->logout());
                }
            }
        }
    }

}
