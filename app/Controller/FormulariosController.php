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

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Formulario->recursive = 0;
		$this->set('formularios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Formulario->exists($id)) {
			throw new NotFoundException(__('Invalid formulario'));
		}
		$options = array('conditions' => array('Formulario.' . $this->Formulario->primaryKey => $id));
		$this->set('formulario', $this->Formulario->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Formulario->create();
			if ($this->Formulario->save($this->request->data)) {
				$this->Session->setFlash(__('The formulario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The formulario could not be saved. Please, try again.'));
			}
		}
		$tareas = $this->Formulario->Tarea->find('list');
		$catformularios = $this->Formulario->Catformulario->find('list');
		$this->set(compact('tareas', 'catformularios'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Formulario->exists($id)) {
			throw new NotFoundException(__('Invalid formulario'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Formulario->save($this->request->data)) {
				$this->Session->setFlash(__('The formulario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The formulario could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Formulario.' . $this->Formulario->primaryKey => $id));
			$this->request->data = $this->Formulario->find('first', $options);
		}
		$tareas = $this->Formulario->Tarea->find('list');
		$catformularios = $this->Formulario->Catformulario->find('list');
		$this->set(compact('tareas', 'catformularios'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Formulario->id = $id;
		if (!$this->Formulario->exists()) {
			throw new NotFoundException(__('Invalid formulario'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Formulario->delete()) {
			$this->Session->setFlash(__('The formulario has been deleted.'));
		} else {
			$this->Session->setFlash(__('The formulario could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
