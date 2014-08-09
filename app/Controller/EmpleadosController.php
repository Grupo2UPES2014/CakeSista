<?php

App::uses('AppController', 'Controller');

/**
 * Empleados Controller
 *
 * @property Empleado $Empleado
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EmpleadosController extends AppController {

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
        $this->Empleado->recursive = 0;
        $this->set('empleados', $this->Paginator->paginate());
    }

    /**
     * add method
     *
     * @return void
     */
    public function nuevo() {
        if ($this->request->is('post')) {
            $this->Empleado->create();
            if ($this->Empleado->save($this->request->data)) {
                $this->Session->setFlash(__('¡Se ha guardado la facultad con éxito!'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
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
    public function editar($id = null) {
        if (!$this->Empleado->exists($id)) {
            $this->Session->setFlash(__('Código de Empleado Invalido.'), array('class' => 'ERROR'));
        } else {
            if ($this->request->is(array('post', 'put'))) {
                if ($this->Empleado->save($this->request->data)) {
                    $this->Session->setFlash(__('Se han guardado los cambios con éxito.'), array('class' => 'OK'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
                }
            } else {
                $options = array('conditions' => array('Empleado.' . $this->Empleado->primaryKey => $id));
                $this->request->data = $this->Empleado->find('first', $options);
            }
        }
        $this->set('title_for_layout', 'Editar');
        $catcargos = $this->Empleado->Catcargo->find('list');
        $this->set(compact('catcargos'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function eliminar($id = null) {
        $this->Empleado->id = $id;
        if (!$this->Empleado->exists()) {
            throw new NotFoundException(__('Código de Facultad Invalido.'), array('class' => 'ERROR'));
        }

        $this->request->allowMethod('post', 'delete');
        if ($this->request->is(array('post', 'delete'))) {
            if ($this->Empleado->delete()) {
                $this->Session->setFlash(__('Se ha eliminado la facultad con éxito'), array('class' => 'OK'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al eliminar la facultad! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
            return $this->redirect(array('action' => 'index'));
        }
        $options = array('conditions' => array('Empleado.' . $this->Empleado->primaryKey => $id), 'fields' => array('nombre'));
        $this->set('empleado', $this->Empleado->find('first', $options));
        $this->set('title_for_layout', 'Eliminar');
    }

}
