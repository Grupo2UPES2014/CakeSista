<?php
App::uses('AppController', 'Controller');
/**
 * Cattramites Controller
 *
 * @property Cattramite $Cattramite
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CattramitesController extends AppController {

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
		$this->Cattramite->recursive = 0;
		$this->set('cattramites', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cattramite->exists($id)) {
			throw new NotFoundException(__('Invalid cattramite'));
		}
		$options = array('conditions' => array('Cattramite.' . $this->Cattramite->primaryKey => $id));
		$this->set('cattramite', $this->Cattramite->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cattramite->create();
			if ($this->Cattramite->save($this->request->data)) {
				$this->Session->setFlash(__('The cattramite has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cattramite could not be saved. Please, try again.'));
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
		if (!$this->Cattramite->exists($id)) {
			throw new NotFoundException(__('Invalid cattramite'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cattramite->save($this->request->data)) {
				$this->Session->setFlash(__('The cattramite has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cattramite could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cattramite.' . $this->Cattramite->primaryKey => $id));
			$this->request->data = $this->Cattramite->find('first', $options);
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
		$this->Cattramite->id = $id;
		if (!$this->Cattramite->exists()) {
			throw new NotFoundException(__('Invalid cattramite'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Cattramite->delete()) {
			$this->Session->setFlash(__('The cattramite has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cattramite could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
