<?php

App::uses('AppController', 'Controller');

/**
 * Tareas Controller
 *
 * @property Tarea $Tarea
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TareasController extends AppController {

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
        $this->set('title_for_layout', 'Buzón de Tareas');
        $this->Tarea->recursive = 0;
        $this->set('tareas', $this->Paginator->paginate());
    }

    public function view($id = null) {
        if (!$this->Tarea->exists($id)) {
            throw new NotFoundException(__('Invalid tarea'));
        }
        $options = array('conditions' => array('Tarea.' . $this->Tarea->primaryKey => $id));
        $this->set('tarea', $this->Tarea->find('first', $options));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Tarea->create();
            if ($this->Tarea->save($this->request->data)) {
                $this->Session->setFlash(__('The tarea has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tarea could not be saved. Please, try again.'));
            }
        }
        $cattareas = $this->Tarea->Cattarea->find('list');
        $empleados = $this->Tarea->Empleado->find('list');
        $tramites = $this->Tarea->Tramite->find('list');
        $this->set(compact('cattareas', 'empleados', 'tramites'));
    }

    public function asignar($id = null) {
        if (!$this->Tarea->Tramite->exists($id)) {
            $this->Session->setFlash(__('ID de trámite invalido.'), array('class' => 'ERROR'));
        } else {
            if ($this->Tarea->existenTareas($id)) {
                //existen tareas  
            } else {
                //tramite recien iniciado 
                var_dump($this->Tarea->obtenerPrimeraTarea($id));
            }
        }
    }

    private function _validarTarea($tipo = null) {
        if ($tipo != NULL) {
            switch ($tipo) {
                case 1:
                    $this->redirect(array('controller' => ''));
                    break;
                case 2:
                    $this->redirect(array('controller' => ''));
                    break;
                case 3:
                    $this->redirect(array('controller' => ''));
                    break;
                case 4:
                    $this->redirect(array('controller' => ''));
                    break;
            }
        }
    }

}
