<?php

App::uses('AppController', 'Controller');

/**
 * Formularios Controller
 *
 * @property Formulario $Formulario
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FormulariosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    public function index() {
        $this->Formulario->recursive = 0;
        $this->set('formularios', $this->Paginator->paginate());
    }

    public function ver($vistaForm = null, $tarea = null) {
        if (!empty($tarea) && $this->Formulario->Tarea->exists($tarea)) {
            //verificar previo si ya existe un formulario lleno
            $this->set('title_for_layout', 'Solicitud de constancia de estudios');
            $this->autoRender = false;
            $options = array(
                'conditions' => array('Tarea.id' => $tarea),
                'fields' => array('Tarea.id', 'Catformulario.id', 'Tarea.tramite_id'),
                'recursive' => 0
            );
            $options['joins'] = array(
                array('table' => 'catformularios',
                    'alias' => 'Catformulario',
                    'type' => 'INNER',
                    'conditions' => array('Catformulario.cattarea_id = Tarea.cattarea_id')
                )
            );
            $this->set('formulario', $this->Formulario->Tarea->find('first', $options));
            $this->render($vistaForm);
        } else {
            return $this->redirect('/');
        }
    }

    public function view($id = null) {
        $this->autoRender = false;
        $this->render('test');
        if (!$this->Formulario->exists($id)) {
            //throw new NotFoundException(__('Invalid formulario'));
        }
        $options = array('conditions' => array('Formulario.' . $this->Formulario->primaryKey => $id));
        $this->set('formulario', $this->Formulario->find('first', $options));
    }

    public function add() {
        if ($this->request->is('post')) {
            if (!$this->Formulario->existe($this->request->data['Formulario']['tarea_id'])) {
                $this->autoRender = false;
                var_dump($this->request->data);
                $this->Formulario->create();

                $json = '{"Respuestas":[';
                $n = 0; //contador para las respuestas
                foreach ($this->request->data['Form'] as $respuesta) {
                    $n++;
                    $json.='{"R' . $n . '":"' . $respuesta . '"},';
                }
                $json = substr($json, 0, -1);
                $json .= ']}';
                $this->request->data['Formulario']['respuestas'] = $json;

                if ($this->Formulario->save($this->request->data)) {
                    $this->Formulario->Tarea->actualizarEstado($this->request->data['Formulario']['tarea_id'], 2);
                    $this->Session->setFlash(__('El formulario a sido enviado'), array('class' => 'OK'));
                    return $this->redirect(array('controller' => 'tareas', 'action' => 'asignar', $this->request->data['Formulario']['tramite_id']));
                } else {
                    $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'),array('class'=>'ERROR'));
                }
            } else {
                $this->Session->setFlash(__('Ya se ha ingresado un formulario para esta tarea.'),array('class'=>'ERROR'));
                return $this->redirect('/');
            }
        } else {
            return $this->redirect('/');
        }
    }

}
