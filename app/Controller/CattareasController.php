<?php
App::uses('AppController', 'Controller');
/**
 * Cattareas Controller
 *
 * @property Cattarea $Cattarea
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CattareasController extends AppController {

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
		$this->Cattarea->recursive = 0;
		$this->set('cattareas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cattarea->exists($id)) {
			throw new NotFoundException(__('Invalid cattarea'));
		}
		$options = array('conditions' => array('Cattarea.' . $this->Cattarea->primaryKey => $id));
		$this->set('cattarea', $this->Cattarea->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cattarea->create();
			if ($this->Cattarea->save($this->request->data)) {
				$this->Session->setFlash(__('The cattarea has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cattarea could not be saved. Please, try again.'));
			}
		}
		$catcargos = $this->Cattarea->Catcargo->find('list');
		$cattramites = $this->Cattarea->Cattramite->find('list');
		$this->set(compact('catcargos', 'cattramites'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Cattarea->exists($id)) {
			throw new NotFoundException(__('Invalid cattarea'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cattarea->save($this->request->data)) {
				$this->Session->setFlash(__('The cattarea has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cattarea could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cattarea.' . $this->Cattarea->primaryKey => $id));
			$this->request->data = $this->Cattarea->find('first', $options);
		}
		$catcargos = $this->Cattarea->Catcargo->find('list');
		$cattramites = $this->Cattarea->Cattramite->find('list');
		$this->set(compact('catcargos', 'cattramites'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cattarea->id = $id;
		if (!$this->Cattarea->exists()) {
			throw new NotFoundException(__('Invalid cattarea'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Cattarea->delete()) {
			$this->Session->setFlash(__('The cattarea has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cattarea could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
