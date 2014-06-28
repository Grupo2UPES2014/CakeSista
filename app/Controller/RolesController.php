<?php

App::uses('AppController', 'Controller');

class RolesController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $components = array('Paginator', 'Session');

    public function index() {
        $this->Role->recursive = 0;
        $this->set('roles', $this->Paginator->paginate());
        $this->set('title_for_layout', 'Índice');
    }

    public function nuevo() {
        $this->set('title_for_layout', 'Nuevo');
        if ($this->request->is('post')) {
            $this->Role->create();
            if ($this->Role->save($this->request->data)) {
                $this->Session->setFlash(__('¡Se ha guardado el rol con éxito!'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! , por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
        }
    }

    public function editar($id = null) {
        $this->set('title_for_layout', 'Editar');
        if (!$this->Role->exists($id)) {
            $this->Session->setFlash(__('Código de Rol Invalido.'), array('class' => 'ERROR'));
        } else {
            if ($this->request->is(array('post', 'put'))) {
                if ($this->Role->save($this->request->data)) {
                    $this->Session->setFlash(__('Se han guardado los cambios con exito.'), array('class' => 'OK'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! , por favor intente de nuevo.'), array('class' => 'ERROR'));
                }
            } else {
                $options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
                $this->request->data = $this->Role->find('first', $options);
            }
        }
    }

    public function delete($id = null) {
        $this->Role->id = $id;
        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Role->delete()) {
            $this->Session->setFlash(__('The role has been deleted.'));
        } else {
            $this->Session->setFlash(__('The role could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
