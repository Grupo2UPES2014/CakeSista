<?php
App::uses('AppController', 'Controller');
/**
 * Empleados Controller
 *
 * @property Empleado $Empleado
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EmpleadosController extends AppController {

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
		$this->Empleado->recursive = 0;
		$this->set('empleados', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Empleado->exists($id)) {
			throw new NotFoundException(__('Invalid empleado'));
		}
		$options = array('conditions' => array('Empleado.' . $this->Empleado->primaryKey => $id));
		$this->set('empleado', $this->Empleado->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Empleado->create();
			if ($this->Empleado->save($this->request->data)) {
				$this->Session->setFlash(__('The empleado has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The empleado could not be saved. Please, try again.'));
			}
		}
		$usuarios = $this->Empleado->Usuario->find('list');
		$catcargos = $this->Empleado->Catcargo->find('list');
		$this->set(compact('usuarios', 'catcargos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Empleado->exists($id)) {
			throw new NotFoundException(__('Invalid empleado'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Empleado->save($this->request->data)) {
				$this->Session->setFlash(__('The empleado has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The empleado could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Empleado.' . $this->Empleado->primaryKey => $id));
			$this->request->data = $this->Empleado->find('first', $options);
		}
		$usuarios = $this->Empleado->Usuario->find('list');
		$catcargos = $this->Empleado->Catcargo->find('list');
		$this->set(compact('usuarios', 'catcargos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Empleado->id = $id;
		if (!$this->Empleado->exists()) {
			throw new NotFoundException(__('Invalid empleado'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Empleado->delete()) {
			$this->Session->setFlash(__('The empleado has been deleted.'));
		} else {
			$this->Session->setFlash(__('The empleado could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
