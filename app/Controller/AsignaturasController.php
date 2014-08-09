<?php

App::uses('AppController', 'Controller');

/**
 * Asignaturas Controller
 *
 * @property Asignatura $Asignatura
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AsignaturasController extends AppController {

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
        $this->Asignatura->recursive = 0;
        $this->set('asignaturas', $this->Paginator->paginate());
        $this->set('title_for_layout', 'Índice');
    }

    /**
     * add method
     *
     * @return void
     */
    public function nuevo() {
        if ($this->request->is('post')) {
            $this->Asignatura->create();
            if ($this->Asignatura->save($this->request->data)) {
                $this->Session->setFlash(__('¡Se ha guardado la facultad con éxito!'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
        }
        $this->set('title_for_layout', 'Nuevo');
        $carreras = $this->Asignatura->Carrera->find('list');
        $this->set(compact('carreras'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function editar($id = null) {
        if (!$this->Asignatura->exists($id)) {
            // throw new NotFoundException(__('Invalid asignatura'));
            $this->Session->setFlash(__('Código de Asignatura Inválido.'), array('class' => 'ERROR'));
        } else {
            if ($this->request->is(array('post', 'put'))) {
                if ($this->Asignatura->save($this->request->data)) {
                    $this->Session->setFlash(__('Se han guardado los cambios con éxito.'), array('class' => 'OK'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
                }
            } else {
                $options = array('conditions' => array('Asignatura.' . $this->Asignatura->primaryKey => $id));
                $this->request->data = $this->Asignatura->find('first', $options);
            }
            $carreras = $this->Asignatura->Carrera->find('list');
            $this->set(compact('carreras'));
        }
        $this->set('title_for_layout', 'Editar');
        $carreras = $this->Asignatura->Carrera->find('list');
        $this->set(compact('carreras'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function eliminar($id = null) {
        $this->Asignatura->id = $id;
        if (!$this->Asignatura->exists()) {
            // throw new NotFoundException(__('Invalid asignatura'));
            $this->Session->setFlash(__('Código de Asignatura Inválido.'), array('class' => 'ERROR'));
        }

        //$this->request->allowMethod('post', 'delete');
        if ($this->request->is(array('post', 'delete'))) {
            if ($this->Asignatura->delete()) {
                $this->Session->setFlash(__('Se ha eliminado la facultad con éxito'), array('class' => 'OK'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al eliminar la facultad! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
            return $this->redirect(array('action' => 'index'));
        }
        $options = array('conditions' => array('Asignatura.' . $this->Asignatura->primaryKey => $id), 'fields' => array('codigo'));
        $this->set('asignatura', $this->Asignatura->find('first', $options));
        $this->set('title_for_layout', 'Eliminar');
    }

}
