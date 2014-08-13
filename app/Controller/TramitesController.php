<?php

App::uses('AppController', 'Controller');

/**
 * Tramites Controller
 *
 * @property Tramite $Tramite
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TramitesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Tramite->recursive = 0;
        $this->set('tramites', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Tramite->exists($id)) {
            throw new NotFoundException(__('Invalid tramite'));
        }
        $options = array('conditions' => array('Tramite.' . $this->Tramite->primaryKey => $id));
        $this->set('tramite', $this->Tramite->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function nuevo($id_cattramite) {
        $this->autoRender = FALSE;
        if ($this->request->is('get')) {
            $this->Tramite->create();
            $this->request->data['Tramite']['estado'] = 1;
            $this->request->data['Tramite']['fechainicio'] = date('Y-m-d');
            //$this->request->data['Tramite']['fechafin'] = date();
            $this->request->data['Tramite']['estudiante_id'] = $this->Tramite->Estudiante->obtener_id($this->Session->read('Auth.User.id'));
            $this->request->data['Tramite']['cattramite_id'] = $id_cattramite;
            if ($this->Tramite->save($this->request->data)) {
                $this->Session->setFlash(__('The tramite has been saved.'));
                return $this->redirect(array('controller' => 'cattramites', 'action' => 'tramites'));
            } else {
                $this->Session->setFlash(__('The tramite could not be saved. Please, try again.'));
            }
        }
//        $estudiantes = $this->Tramite->Estudiante->find('list');
//        $cattramites = $this->Tramite->Cattramite->find('list');
//        $this->set(compact('estudiantes', 'cattramites'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Tramite->exists($id)) {
            throw new NotFoundException(__('Invalid tramite'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Tramite->save($this->request->data)) {
                $this->Session->setFlash(__('The tramite has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tramite could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Tramite.' . $this->Tramite->primaryKey => $id));
            $this->request->data = $this->Tramite->find('first', $options);
        }
        $estudiantes = $this->Tramite->Estudiante->find('list');
        $cattramites = $this->Tramite->Cattramite->find('list');
        $this->set(compact('estudiantes', 'cattramites'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Tramite->id = $id;
        if (!$this->Tramite->exists()) {
            throw new NotFoundException(__('Invalid tramite'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Tramite->delete()) {
            $this->Session->setFlash(__('The tramite has been deleted.'));
        } else {
            $this->Session->setFlash(__('The tramite could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
