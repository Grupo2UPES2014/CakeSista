<?php

App::uses('AppController', 'Controller');

/**
 * Carreras Controller
 *
 * @property Carrera $Carrera
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CarrerasController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form');

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
        $this->Carrera->recursive = 0;
        $this->set('carreras', $this->Paginator->paginate());
        $this->set('title_for_layout', 'Índice');
    }

    public function nuevo() {
        if ($this->request->is('post')) {
            $this->Carrera->create();
            if ($this->Carrera->save($this->request->data)) {
                $this->Session->setFlash(__('¡Se ha guardado la Carrera con éxito!'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! , por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
        }
        $facultades = $this->Carrera->Facultade->find('list');
        $this->set(compact('facultades'));
        $this->set('title_for_layout', 'Nuevo');
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function editar($id = null) {
        if (!$this->Carrera->exists($id)) {
            $this->Session->setFlash(__('Código de Carrera Invalido.'), array('class' => 'ERROR'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Carrera->save($this->request->data)) {
                $this->Session->setFlash(__('Se han guardado los cambios con exito.'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! , por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
        } else {
            $options = array('conditions' => array('Carrera.' . $this->Carrera->primaryKey => $id));
            $this->request->data = $this->Carrera->find('first', $options);
        }
        $facultades = $this->Carrera->Facultade->find('list');
        $this->set(compact('facultades'));
        $this->set('title_for_layout', 'Editar');
    }

    public function eliminar($id = null) {
        $this->Carrera->id = $id;
        if (!$this->Carrera->exists()) {
            throw new NotFoundException(__('Invalid carrera'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Carrera->delete()) {
            $this->Session->setFlash(__('The carrera has been deleted.'));
        } else {
            $this->Session->setFlash(__('The carrera could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
