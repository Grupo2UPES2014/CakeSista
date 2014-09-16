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
                'fields' => array('Tarea.id', 'Catformulario.id'),
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
                $this->Session->setFlash(__('The formulario has been saved.'));
                return $this->redirect('/');
            } else {
                $this->Session->setFlash(__('The formulario could not be saved. Please, try again.'));
            }
        } else {
            return $this->redirect('/');
        }
    }

}
