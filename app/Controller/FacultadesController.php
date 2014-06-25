<?php

App::uses('AppController', 'Controller');

/**
 * Facultades Controller
 *
 * @property Facultade $Facultade
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FacultadesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public  $helpers = array('Html','Form','Paginator');
    public $components = array('Paginator', 'Session');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->set('facultades', $this->Paginator->paginate());
        $this->set('title_for_layout', 'Índice'); 
    }

    /**
     * add method
     *
     * @return void
     */
    public function nuevo() {
        if ($this->request->is('post')) {
            $this->Facultade->create();
            if ($this->Facultade->save($this->request->data)) {
                $this->Session->setFlash(__('The facultade has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The facultade could not be saved. Please, try again.'));
            }
        }
        $this->set('title_for_layout', 'Nuevo'); 
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Facultade->exists($id)) {
            throw new NotFoundException(__('Invalid facultade'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Facultade->save($this->request->data)) {
                $this->Session->setFlash(__('The facultade has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The facultade could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Facultade.' . $this->Facultade->primaryKey => $id));
            $this->request->data = $this->Facultade->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Facultade->id = $id;
        if (!$this->Facultade->exists()) {
            throw new NotFoundException(__('Invalid facultade'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Facultade->delete()) {
            $this->Session->setFlash(__('The facultade has been deleted.'));
        } else {
            $this->Session->setFlash(__('The facultade could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
