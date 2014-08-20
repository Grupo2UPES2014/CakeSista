<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'inicio'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
Router::connect('/about', array('controller' => 'pages', 'action' => 'display', 'about'));
Router::connect('/login', array('controller' => 'usuarios', 'action' => 'login'));
Router::connect('/registro', array('controller' => 'usuarios', 'action' => 'registro'));
Router::connect('/activar/*', array('controller' => 'usuarios', 'action' => 'activar'));
Router::connect('/nuevo_correo/*', array('controller' => 'usuarios', 'action' => 'nuevo_correo'));
Router::connect('/recuperar', array('controller' => 'usuarios', 'action' => 'recuperar_contrasena'));
Router::connect('/cambiar_contrasena/*', array('controller' => 'usuarios', 'action' => 'cambiar_contrasena'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
