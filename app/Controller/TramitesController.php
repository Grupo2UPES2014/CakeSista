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

    public function ver($id = null) {
        $this->set('title_for_layout', 'Seguimiento de Trámite');
        if (!$this->Tramite->exists($id)) {
            $this->Session->setFlash(__('ID de trámite invalido'), array('class' => 'ERROR'));
            return $this->redirect('/');
        } else {
            $estudiante_id = $this->Tramite->Estudiante->obtener_id($this->Session->read('Auth.User.id'));

            if ($this->Tramite->owner($id, $estudiante_id)) {

                $options = array('conditions' => array('Tramite.' . $this->Tramite->primaryKey => $id));
                $tramite = $this->Tramite->find('first', $options);

                $options = array('conditions' => array('Cattarea.cattramite_id' => $tramite['Cattramite']['id']), 'recursive' => 0, 'fields' => array('Cattarea.*', 'Catcargo.*'));
                $cattareas = $this->Tramite->Tarea->Cattarea->find('all', $options);
                $tipos = array(
                    1 => 'segActividad',
                    2 => 'segMandamiento',
                    3 => 'segDocumento',
                    4 => 'segFormulario'
                );
                $estados = array(
                    0 => 'noiniciado',
                    1 => 'enproceso',
                    2 => 'finalizado'
                );
                $this->set(compact('tramite', 'cattareas', 'tipos', 'estados'));
            } else {
                return $this->redirect('/');
            }
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function nuevo($id_cattramite) {
        $this->autoRender = FALSE;
        if (!$this->Tramite->Cattramite->exists($id_cattramite)) {
            $this->Session->setFlash(__('ID de trámite invalido'), array('class' => 'ERROR'));
            return $this->redirect(array('controller' => 'cattramites', 'action' => 'tramites'));
        } else {
            if ($this->request->is('get')) {
                $this->Tramite->create();
                $this->request->data['Tramite']['estado'] = 1;
                $this->request->data['Tramite']['fechainicio'] = date('Y-m-d');
                $this->request->data['Tramite']['estudiante_id'] = $this->Tramite->Estudiante->obtener_id($this->Session->read('Auth.User.id'));
                $this->request->data['Tramite']['cattramite_id'] = $id_cattramite;
                if ($this->Tramite->save($this->request->data)) {
                    $this->Session->setFlash(__('Se ha iniciado el trámite con exito.'), array('class' => 'OK'));
                    return $this->redirect(array('controller' => 'tareas', 'action' => 'asignar', $this->Tramite->id));
                } else {
                    $this->Session->setFlash(__('¡Ha ocurrido un error al iniciar el trámite! , por favor intente de nuevo.'), array('class' => 'ERROR'));
                }
            }
        }
    }

    public function buzon() {
        $this->set('title_for_layout', 'Buzón de Trámites');

        $id = $this->Tramite->Estudiante->obtener_id($this->Session->read('Auth.User.id'));
        $options = array('conditions' => array('Tramite.estudiante_id' => $id), 'fields' => array('Cattramite.nombre', 'Tramite.estado', 'Tramite.fechainicio'), 'recursive' => 0);

        $estados = array(0 => 'Finalizado', 1 => 'Activo');

        $this->set('tramites', $this->Tramite->find('all', $options));
        $this->set(compact('estados'));
    }

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
