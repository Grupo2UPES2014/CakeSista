<?php

App::uses('AppController', 'Controller');

/**
 * Cattramites Controller
 *
 * @property Cattramite $Cattramite
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CattramitesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $helpers = array('Form', 'Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->set('title_for_layout', 'Catálogo de Trámites');
        $this->Cattramite->recursive = 0;
        $this->set('cattramites', $this->Paginator->paginate());
    }

    public function tramites() {
        $this->set('title_for_layout', 'Trámites Academicos');
        $this->Cattramite->recursive = 0;
        $this->set('cattramites', $this->Paginator->paginate());
    }

    /**
     * add method
     *
     * @return void
     */
    public function nuevo() {
        $this->set('title_for_layout', 'Nuevo Trámites');
        if ($this->request->is('post')) {
            $this->Cattramite->create();
            if ($this->Cattramite->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('The cattramite has been saved.'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The cattramite could not be saved. Please, try again.'), array('class' => 'ERROR'));
            }
        }
        $catcargos = $this->Cattramite->Cattarea->Catcargo->find('list');
        $this->set(compact('catcargos'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Cattramite->exists($id)) {
            throw new NotFoundException(__('Invalid cattramite'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Cattramite->save($this->request->data)) {
                $this->Session->setFlash(__('The cattramite has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The cattramite could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Cattramite.' . $this->Cattramite->primaryKey => $id));
            $this->request->data = $this->Cattramite->find('first', $options);
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
        $this->Cattramite->id = $id;
        if (!$this->Cattramite->exists()) {
            throw new NotFoundException(__('Invalid cattramite'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Cattramite->delete()) {
            $this->Session->setFlash(__('The cattramite has been deleted.'));
        } else {
            $this->Session->setFlash(__('The cattramite could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
