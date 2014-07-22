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
	public function view($id = null) {
		if (!$this->Mandamiento->exists($id)) {
			throw new NotFoundException(__('Invalid mandamiento'));
		}
		$options = array('conditions' => array('Mandamiento.' . $this->Mandamiento->primaryKey => $id));
		$this->set('mandamiento', $this->Mandamiento->find('first', $options));
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
