<?php
App::uses('AppController', 'Controller');
/**
 * Calendarios Controller
 *
 * @property Calendario $Calendario
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CalendariosController extends AppController {

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
		$this->Calendario->recursive = 0;
		$this->set('calendarios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Calendario->exists($id)) {
			throw new NotFoundException(__('Invalid calendario'));
		}
		$options = array('conditions' => array('Calendario.' . $this->Calendario->primaryKey => $id));
		$this->set('calendario', $this->Calendario->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Calendario->create();
			if ($this->Calendario->save($this->request->data)) {
				$this->Session->setFlash(__('The calendario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calendario could not be saved. Please, try again.'));
			}
		}
		$cattramites = $this->Calendario->Cattramite->find('list');
		$this->set(compact('cattramites'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Calendario->exists($id)) {
			throw new NotFoundException(__('Invalid calendario'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Calendario->save($this->request->data)) {
				$this->Session->setFlash(__('The calendario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calendario could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Calendario.' . $this->Calendario->primaryKey => $id));
			$this->request->data = $this->Calendario->find('first', $options);
		}
		$cattramites = $this->Calendario->Cattramite->find('list');
		$this->set(compact('cattramites'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Calendario->id = $id;
		if (!$this->Calendario->exists()) {
			throw new NotFoundException(__('Invalid calendario'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Calendario->delete()) {
			$this->Session->setFlash(__('The calendario has been deleted.'));
		} else {
			$this->Session->setFlash(__('The calendario could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
