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
        $catcargo_id = $this->Tarea->Empleado->obtenerCargoEmpleado($this->Session->read('Auth.User.id'));
        $empleado_id = $this->Tarea->Empleado->obtenerEmpleado_id($this->Session->read('Auth.User.id'));

        $options = array('conditions' => array(
                'OR' => array(
                    array('Tarea.empleado_id' => $empleado_id),
                    array('Tarea.empleado_id' => null),
                ),
                'Cattarea.catcargo_id' => $catcargo_id,
                'Tarea.estado !=' => 2
            ),
            'fields' => array('Tarea.id', 'Tramite.id', 'Cattarea.nombre', 'Cattramite.nombre', 'Tarea.estado', 'Cattarea.tipo')
        );

        $options['joins'] = array(
            array('table' => 'cattramites',
                'alias' => 'Cattramite',
                'type' => 'INNER',
                'conditions' => array('Cattramite.id = Tramite.cattramite_id')
            )
        );

        $tipos = array(
            1 => array('Actividad', 'actividad'),
            2 => array('Mandamiento de Pago', 'mandamiento'),
            3 => array('Documento', 'documento'),
            4 => array('Formulario', 'formulario')
        );
        $estados = array(0 => 'Inactivo', 1 => 'Activo', 2 => 'Terminado');

        $this->set('tareas', $this->Tarea->find('all', $options));
        $this->set(compact('tipos', 'estados'));
    }

    public function ver($id = null) {
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
            $this->redirect(array('controller' => 'Tareas', 'action' => 'index'));
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
                        $this->redirect(array('controller' => 'Tareas', 'action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('Ocurrio un error al enviar los datos.'), array('class' => 'ERROR'));
                    }
                } else {
                    //---------Las tareas han terminado y se procede a finalizar el tramite
                    if ($this->Tarea->Tramite->finalizar($id)) {
                        $this->Session->setFlash(__('Ha finalizado el trámite'), array('class' => 'INFO'));
                        return $this->redirect(array('controller' => 'Tareas', 'action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('Ocurrio un error al finalizar el trámite'), array('class' => 'ERROR'));
                        return $this->redirect(array('controller' => 'Tareas', 'action' => 'index'));
                    }
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
                    $tipos = array(2, 3, 4);
                    if (in_array($cattramite['Cattarea']['tipo'], $tipos)) {
                        $this->_validarTarea($cattramite['Cattarea']['tipo'], $this->Tarea->id);
                    } else {
                        return $this->redirect(array('controller' => 'Pages', 'action' => 'display', 'inicio'));
                    }
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
        if (!$this->Tarea->exists($id)) {
            $this->Session->setFlash(__('El ID de tarea es invalido.'), array('class' => 'ERROR'));
        } else {
            if ($this->request->is(array('post', 'put'))) {
                $empleado_id = $this->Tarea->Empleado->obtenerEmpleado_id($this->Session->read('Auth.User.id'));
                $this->request->data['Tarea']['empleado_id'] = $empleado_id;
                if ($this->Tarea->save($this->request->data)) {
                    $this->Session->setFlash(__('Se ha actualizado el estado del trámite'), array('class' => 'OK'));
                    if ($this->request->data['Tarea']['estado'] == 2) {
                        return $this->redirect(array('controller' => 'Tareas', 'action' => 'asignar', $this->request->data['Tarea']['tramite_id']));
                    } else {
                        return $this->redirect(array('controller' => 'Tareas', 'action' => 'index'));
                    }
                } else {
                    $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
                }
            } else {
                $options = array('conditions' => array('Tarea.' . $this->Tarea->primaryKey => $id));
                $this->request->data = $this->Tarea->find('first', $options);
            }
            $options = array('conditions' => array('Cattarea.id' => $this->Tarea->obtenerCattarea($id)), 'recursive' => -1);
            $cattareas = $this->Tarea->Cattarea->find('first', $options);
            $this->set(compact('cattareas'));
        }
    }

    public function documento($id = NULL) {
        $this->set('title_for_layout', 'Recepcion de Documento');
    }

    public function formulario($id = NULL) {
        $this->set('title_for_layout', 'Formulario');
    }

    public function mandamiento($id = NULL) {
        $this->set('title_for_layout', 'Mandamiento de Pago');
        if (!$id) {
            $this->Session->setFlash('no has seleccionado ningun pdf.');
            $this->redirect(array('action' => 'index'));
        }
        // Sobrescribimos para que no aparezcan los resultados de debuggin
        // ya que sino daria un error al generar el pdf.
        $this->response->header(array('Content-type: application/pdf'));
        $this->response->type('pdf');
        Configure::write('debug', 0);
        $this->layout = 'pdf'; //esto usara el layout pdf.ctp
        $this->render();
    }

}
