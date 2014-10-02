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
    public function index($cattramite_id = NULL) {
        $this->Calendario->recursive = 0;
        if ($this->Calendario->Cattramite->exists($cattramite_id)) {
            $options = array('conditions' => array('cattramite_id' => $cattramite_id), 'recursive' => -1);
            $this->set('calendarios', $this->Calendario->find('all', $options));
            $this->set('cattramite_id', $cattramite_id);
        } else {
            $this->Session->setFlash(__('¡ID de Trámite invalido!'), array('class' => 'ERROR'));
            return $this->redirect('/');
        }
        $this->set('title_for_layout', 'índice');
    }

    /**
     * add method
     *
     * @return void
     */
    public function nuevo($cattramite_id = NULL) {
        if (!empty($cattramite_id)) {
            if ($this->request->is('post')) {
                $this->Calendario->create();
                if ($this->Calendario->save($this->request->data)) {
                    $this->Session->setFlash(__('¡Se ha guardado el Calendario con éxito!'), array('class' => 'OK'));
                    return $this->redirect(array('action' => 'index', $cattramite_id));
                } else {
                    $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
                }
            }
            $this->set('cattramite_id', $cattramite_id);
            $this->set('title_for_layout', 'Nuevo Calendario');
        } else {
            $this->Session->setFlash(__('¡ID de Trámite invalido!'), array('class' => 'ERROR'));
            return $this->redirect('/');
        }
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
            $this->Session->setFlash(__('Código de Calendario Inválido.'), array('class' => 'ERROR'));
        } else
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Calendario->save($this->request->data)) {
                $this->Session->setFlash(__('Se han guardado los cambios con éxito.'), array('class' => 'OK'));
                return $this->redirect(array('controller'=>'cattramites','action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
                return $this->redirect('/');
            }
        } else {
            $options = array('conditions' => array('Calendario.' . $this->Calendario->primaryKey => $id));
            $this->request->data = $this->Calendario->find('first', $options);
        }
        $this->set('title_for_layout', 'Editar');
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
