<?php

App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UsuariosController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $components = array('Paginator', 'Session');

    public function registro() {
        $this->set('title_for_layout', 'Registro de Usuario');
        $this->layout = 'registro';
        if ($this->request->is('post')) {
            if ($this->request->data['Usuario']['contrasena'] == $this->request->data['Usuario']['rcontrasena']) {
                if ($this->Usuario->existeAlumno($this->request->data['Usuario']['alias'])) {
                    $this->Usuario->create();
                    $this->request->data['Usuario']['alias'] = strtoupper($this->request->data['Usuario']['alias']);
                    $this->request->data['Usuario']['role_id'] = 3;
                    $this->request->data['Usuario']['estado'] = 0;
                    if ($this->Usuario->save($this->request->data)) {
                        $this->Session->setFlash(__('OK'), array('class' => 'OK'));
                    } else {
                        $this->Session->setFlash(__('¡Ha ocurrido un error al registrar el usuario! , por favor intente de nuevo.'), array('class' => 'ERROR'));
                    }
                } else {
                    $this->Session->setFlash(__('El carnet ingresado no existe.'), array('class' => 'ALERT'));
                }
            } else
                $this->Session->setFlash(__('Las claves no coinciden.'), array('class' => 'ALERT'));
        }
    }

    public function index() {
        $this->Usuario->recursive = 0;
        $this->set('usuarios', $this->Paginator->paginate());
    }

    public function view($id = null) {
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
        $this->set('usuario', $this->Usuario->find('first', $options));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Usuario->create();
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('The usuario has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The usuario could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Usuario->Role->find('list');
        $this->set(compact('roles'));
    }

    public function edit($id = null) {
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('The usuario has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The usuario could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
            $this->request->data = $this->Usuario->find('first', $options);
        }
        $roles = $this->Usuario->Role->find('list');
        $this->set(compact('roles'));
    }

    public function delete($id = null) {
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Usuario->delete()) {
            $this->Session->setFlash(__('The usuario has been deleted.'));
        } else {
            $this->Session->setFlash(__('The usuario could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
