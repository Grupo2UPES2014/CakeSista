<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UsuariosController
 * @author Amaury
 */
class UsuariosController extends AppController {

    public function index() {
        
    }

    public function nuevo() {
        $this->set('title_for_layout', 'Nuevo Usuario');
        $this->Usuario->create();
        $this->Usuario->save($this->request->data);
    }

}
