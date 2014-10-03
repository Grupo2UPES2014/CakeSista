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
    public $paginate = array(
        'order' => array(
            'nombre' => 'asc'
        )
    );

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->set('title_for_layout', 'Catálogo de Trámites');
        $this->Cattramite->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('cattramites', $this->Paginator->paginate());
    }

    public function tramites() {
        $this->set('title_for_layout', 'Trámites Academicos');
        $this->Cattramite->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('cattramites', $this->Paginator->paginate());
    }

    public function tramite($id = null) {
        $this->set('title_for_layout', 'Trámites Academicos');
        if (!$this->Cattramite->exists($id)) {
            $this->Session->setFlash(__('Código de Trámite Invalido.'), array('class' => 'ERROR'));
            $this->set('cattramite', NULL);
        } else {
            $options = array('conditions' => array('Cattramite.' . $this->Cattramite->primaryKey => $id));
            $tramite = $this->Cattramite->find('first', $options);
            $this->set('cattramite', $tramite);
            //$options = array('conditions' => array('cattramite_id' => $tramite['Cattramite']['id']));
            //$this->set('cattareas', $this->Cattramite->Cattarea->find('list', $options));
        }
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
                $this->Session->setFlash(__('El trámite ha sido guardado con éxito.'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
        }
        $catcargos = $this->Cattramite->Cattarea->Catcargo->find('list');
        $this->set(compact('catcargos'));
    }

    public function editar($id = null) {
        if (!$this->Cattramite->exists($id)) {
            $this->Session->setFlash(__('Trámite Invalido'), array('class' => 'ERROR'));
            $this->redirect('/');
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Cattramite->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('El trámite ha sido guardado con éxito.'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
        } else {
            $options = array(
                'conditions' => array('Cattramite.id' => $id),
                'recursive' => -1
            );
            $this->request->data = $this->Cattramite->find('first', $options);

            $options = array(
                'conditions' => array('Cattarea.cattramite_id' => $id),
                'recursive' => -1
            );
            $cattareas = $this->Cattramite->Cattarea->find('all', $options);

            $catcargos = $this->Cattramite->Cattarea->Catcargo->find('list');
            $this->set(compact('catcargos', 'cattareas'));
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
