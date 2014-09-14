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

    public function ver($vistaForm = null) {
        $this->set('title_for_layout', 'Solicitud de constancia de estudios');
        $this->autoRender = false;
        $this->render($vistaForm);
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
            $this->request->data['Formulario']['respuestas'] = $this->request->data['Form']['algo'];
            $this->request->data['Formulario']['catformulario_id'] = 1;
            $this->request->data['Formulario']['tarea_id'] = 78;
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
