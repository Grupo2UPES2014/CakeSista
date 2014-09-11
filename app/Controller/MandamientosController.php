<?php

App::uses('AppController', 'Controller');

/**
 * Mandamientos Controller
 *
 * @property Mandamiento $Mandamiento
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MandamientosController extends AppController {

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
        $this->Mandamiento->recursive = 0;
        $this->set('mandamientos', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function imprimir() {
        $id = $this->Session->read('mandamiento');
        if (!$this->Mandamiento->exists($id)) {
            $this->Session->setFlash(__('El ID de mandamiento es invalido'), array('class' => 'ERROR'));
            $this->redirect('/');
        } else {
            $this->response->header(array('Content-type: application/pdf'));
            $this->response->type('pdf');
            Configure::write('debug', 0);
            $this->layout = 'pdf'; //esto usara el layout pdf.ctp

            $options = array('conditions' => array('Mandamiento.' . $this->Mandamiento->primaryKey => $id), 'recursive' => -1);
            $mandamiento = $this->Mandamiento->find('first', $options);

            $options = array(
                'conditions' => array('Tramite.id' => $mandamiento['Mandamiento']['tramite_id']),
                'fields' => array('Estudiante.nombres', 'Estudiante.apellido1', 'Estudiante.apellido2', 'Estudiante.carnet', 'Estudiante.nui', 'Carrera.nombre'),
                'recursive' => 0,
                'joins' => array(
                    array('table' => 'carreras',
                        'alias' => 'Carrera',
                        'type' => 'INNER',
                        'conditions' => array('Carrera.id = Estudiante.carrera_id')
                    )
                )
            );
            $estudiante = $this->Mandamiento->Tramite->find('first', $options);

            $exp = new DateTime($mandamiento['Mandamiento']['fechaemision']);
            $exp->add(new DateInterval('P1D'));

            $this->set('mandamiento', $mandamiento);
            $this->set('estudiante', $estudiante);
            $this->set('vencimiento', $exp);

            $this->render();
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Mandamiento->create();
            if ($this->Mandamiento->save($this->request->data)) {
                $this->Session->setFlash(__('The mandamiento has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The mandamiento could not be saved. Please, try again.'));
            }
        }
        $tramites = $this->Mandamiento->Tramite->find('list');
        $cuentas = $this->Mandamiento->Cuentum->find('list');
        $this->set(compact('tramites', 'cuentas'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Mandamiento->exists($id)) {
            throw new NotFoundException(__('Invalid mandamiento'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Mandamiento->save($this->request->data)) {
                $this->Session->setFlash(__('The mandamiento has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The mandamiento could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Mandamiento.' . $this->Mandamiento->primaryKey => $id));
            $this->request->data = $this->Mandamiento->find('first', $options);
        }
        $tramites = $this->Mandamiento->Tramite->find('list');
        $cuentas = $this->Mandamiento->Cuentum->find('list');
        $this->set(compact('tramites', 'cuentas'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Mandamiento->id = $id;
        if (!$this->Mandamiento->exists()) {
            throw new NotFoundException(__('Invalid mandamiento'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Mandamiento->delete()) {
            $this->Session->setFlash(__('The mandamiento has been deleted.'));
        } else {
            $this->Session->setFlash(__('The mandamiento could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
