<?php
App::uses('AppController', 'Controller');
/**
 * Catformularios Controller
 *
 * @property Catformulario $Catformulario
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CatformulariosController extends AppController {

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
		$this->Catformulario->recursive = 0;
		$this->set('catformularios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Catformulario->exists($id)) {
			throw new NotFoundException(__('Invalid catformulario'));
		}
		$options = array('conditions' => array('Catformulario.' . $this->Catformulario->primaryKey => $id));
		$this->set('catformulario', $this->Catformulario->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Catformulario->create();
			if ($this->Catformulario->save($this->request->data)) {
				$this->Session->setFlash(__('The catformulario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The catformulario could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Catformulario->exists($id)) {
			throw new NotFoundException(__('Invalid catformulario'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Catformulario->save($this->request->data)) {
				$this->Session->setFlash(__('The catformulario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The catformulario could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Catformulario.' . $this->Catformulario->primaryKey => $id));
			$this->request->data = $this->Catformulario->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Catformulario->id = $id;
		if (!$this->Catformulario->exists()) {
			throw new NotFoundException(__('Invalid catformulario'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Catformulario->delete()) {
			$this->Session->setFlash(__('The catformulario has been deleted.'));
		} else {
			$this->Session->setFlash(__('The catformulario could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
