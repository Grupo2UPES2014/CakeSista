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
    public $helpers = array('Html', 'Form', 'Paginator');
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

    public function nuevo() {
        if ($this->request->is('post')) {
            $this->Facultade->create();
            if ($this->Facultade->save($this->request->data)) {
                $this->Session->setFlash(__('¡Se ha guardado la facultad con éxito!'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                //
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
        }
        $this->set('title_for_layout', 'Nuevo');
    }

    public function editar($id = null) {
        if (!$this->Facultade->exists($id)) {
            $this->Session->setFlash(__('Código de Facultad Inválido.'), array('class' => 'ERROR'));
        } else {
            if ($this->request->is(array('post', 'put'))) {
                if ($this->Facultade->save($this->request->data)) {
                    $this->Session->setFlash(__('Se han guardado los cambios con éxito.'), array('class' => 'OK'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
                }
            } else {
                $options = array('conditions' => array('Facultade.' . $this->Facultade->primaryKey => $id));
                $this->request->data = $this->Facultade->find('first', $options);
            }
        }
        $this->set('title_for_layout', 'Editar');
    }

    public function eliminar($id = null) {
        $this->Facultade->id = $id;
        if (!$this->Facultade->exists()) {
            $this->Session->setFlash(__('Código de Facultad Inválido.'), array('class' => 'ERROR'));
        }
        //$this->request->allowMethod('post', 'delete');
        if ($this->request->is(array('post', 'delete'))) {
            if ($this->Facultade->delete()) {
                $this->Session->setFlash(__('Se ha eliminado la facultad con éxito'), array('class' => 'OK'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al eliminar la facultad! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
            return $this->redirect(array('action' => 'index'));
        }
        $options = array('conditions' => array('Facultade.' . $this->Facultade->primaryKey => $id), 'fields' => array('nombre'));
        $this->set('facultad', $this->Facultade->find('first', $options));
        $this->set('title_for_layout', 'Eliminar');
    }

}
