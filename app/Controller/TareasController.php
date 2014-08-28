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

    public function edit($id = null) {
        if (!$this->Tarea->exists($id)) {
            throw new NotFoundException(__('Invalid tarea'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Tarea->save($this->request->data)) {
                $this->Session->setFlash(__('The tarea has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tarea could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Tarea.' . $this->Tarea->primaryKey => $id));
            $this->request->data = $this->Tarea->find('first', $options);
        }
        $cattareas = $this->Tarea->Cattarea->find('list');
        $empleados = $this->Tarea->Empleado->find('list');
        $tramites = $this->Tarea->Tramite->find('list');
        $this->set(compact('cattareas', 'empleados', 'tramites'));
    }

    public function asignar($id = null) {
        $this->autoRender = FALSE;
        if (!$this->Tarea->Tramite->exists($id)) {
            $this->Session->setFlash(__('ID de trámite invalido.'), array('class' => 'ERROR'));
        } else {
            if ($this->Tarea->existenTareas($id)) {
                //existen tareas  
                $correlativo = $this->Tarea->contarTareas($id) + 1;
                $cattramite = $this->Tarea->Tramite->obtenerIdCattramite($id);
                if ($cattarea = $this->Tarea->Cattarea->obtenerCattarea($correlativo, $cattramite)) {
                    $data = array(
                        'Tarea' => array(
                            'estado' => 1,
                            'cattarea_id' => $cattarea['Cattarea']['id'],
                            'tramite_id' => $id
                        )
                    );
                    if ($this->Tarea->save($data)) {
                        $this->_validarTarea($cattarea['Cattarea']['tipo'], $this->Tarea->id);
                    } else {
                        $this->Session->setFlash(__('Ocurrio un error al enviar los datos.'), array('class' => 'ERROR'));
                    }
                } else {
//pendiente------------------------
                    //---------Las tareas han terminado y se procede a finalizar el tramite
                    return $this->redirect(array('controller' => 'Pages', 'action' => 'display', 'inicio'));
                }
            } else {
                //tramite recien iniciado
                $cattramite = $this->Tarea->obtenerPrimeraTarea($id);
                $data = array(
                    'Tarea' => array(
                        'estado' => 1,
                        'cattarea_id' => $cattramite['Cattarea']['id'],
                        'tramite_id' => $id
                    )
                );
                if ($this->Tarea->save($data)) {
                    $this->_validarTarea($cattramite['Cattarea']['tipo'], $this->Tarea->id);
                } else {
                    $this->Session->setFlash(__('Ocurrio un error al enviar los datos.'), array('class' => 'ERROR'));
                }
            }
        }
    }

    private function _validarTarea($tipo = null, $tarea = NULL) {
        if ($tipo != NULL) {
            switch ($tipo) {
                case 1:
                    $this->redirect(array('controller' => 'Tareas', 'action' => 'actividad', $tarea));
                    break;
                case 2:
                    $this->redirect(array('controller' => 'Tareas', 'action' => 'mandamiento', $tarea));
                    break;
                case 3:
                    $this->redirect(array('controller' => 'Tareas', 'action' => 'documento', $tarea));
                    break;
                case 4:
                    $this->redirect(array('controller' => 'Tareas', 'action' => 'formulario', $tarea));
                    break;
            }
        }
    }

    public function actividad($id = null) {
        $this->set('title_for_layout', 'Actividad');
    }

    public function documento($id = NULL) {
        $this->set('title_for_layout', 'Recepcion de Documento');
    }

    public function formulario($id = NULL) {
        $this->set('title_for_layout', 'Formulario');
    }

    public function mandamiento($id = NULL) {
        $this->set('title_for_layout', 'Mandamiento de Pago');
    }

}
