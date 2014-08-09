<?php

App::uses('AppController', 'Controller');

/**
 * Calendarios Controller
 *
 * @property Calendario $Calendario
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CalendariosController extends AppController {

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
        $this->Calendario->recursive = 0;
        $this->set('calendarios', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Calendario->exists($id)) {
            throw new NotFoundException(__('Invalid calendario'));
        }
        $options = array('conditions' => array('Calendario.' . $this->Calendario->primaryKey => $id));
        $this->set('calendario', $this->Calendario->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function nuevo() {
        if ($this->request->is('post')) {
            $this->Calendario->create();
            if ($this->Calendario->save($this->request->data)) {
                $this->Session->setFlash(__('¡Se ha guardado el Calendario con éxito!'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
        }
        $cattramites = $this->Calendario->Cattramite->find('list');
        $this->set(compact('cattramites'));

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
        if (!$this->Calendario->exists($id)) {
//throw new NotFoundException(__('Invalid calendario'));
            $this->Session->setFlash(__('Código de Calendario Inválido.'), array('class' => 'ERROR'));
        } else
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Calendario->save($this->request->data)) {
                $this->Session->setFlash(__('Se han guardado los cambios con éxito.'), array('class' => 'OK'));
//				$this->Session->setFlash(__('The calendario has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
        } else {
            $options = array('conditions' => array('Calendario.' . $this->Calendario->primaryKey => $id));
            $this->request->data = $this->Calendario->find('first', $options);
        }
        $this->set('title_for_layout', 'Editar');
        $cattramites = $this->Calendario->Cattramite->find('list');
        $this->set(compact('cattramites'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function eliminar($id = null) {
        $this->Calendario->id = $id;
        if (!$this->Calendario->exists()) {
            throw new NotFoundException(__('Código de Calendario Inválido.'), array('class' => 'ERROR'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->request->is(array('post', 'delete'))) {

            if ($this->Calendario->delete()) {
                $this->Session->setFlash(__('Se ha eliminado el calendario con éxito'), array('class' => 'OK'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al eliminar la facultad! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
            return $this->redirect(array('action' => 'index'));
        }

        $options = array('conditions' => array('Calendario.' . $this->Calendario->primaryKey => $id), 'fields' => array('nombre'));
        $this->set('calendario', $this->Calendario->find('first', $options));
        $this->set('title_for_layout', 'Eliminar');
    }

}
