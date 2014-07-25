<?php
App::uses('AppController', 'Controller');
/**
 * Catcargos Controller
 *
 * @property Catcargo $Catcargo
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CatcargosController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $helpers = array('Html', 'Form', 'Paginator');
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Catcargo->recursive = 0;
		$this->set('catcargos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Catcargo->exists($id)) {
			throw new NotFoundException(__('Invalid catcargo'));
		}
		$options = array('conditions' => array('Catcargo.' . $this->Catcargo->primaryKey => $id));
		$this->set('catcargo', $this->Catcargo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function nuevo() {
		if ($this->request->is('post')) {
			$this->Catcargo->create(); //Limpia modelo
			if ($this->Catcargo->save($this->request->data)) {  //variable request con datos
				$this->Session->setFlash(__('¡Se ha guardado el Cargo con éxito!'), array('class' => 'OK'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! , por favor intente de nuevo.'), array('class' => 'ERROR'));
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
		if (!$this->Catcargo->exists($id)) {
			throw new NotFoundException(__('Invalid catcargo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Catcargo->save($this->request->data)) {
				$this->Session->setFlash(__('The catcargo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The catcargo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Catcargo.' . $this->Catcargo->primaryKey => $id));
			$this->request->data = $this->Catcargo->find('first', $options);
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
		$this->Catcargo->id = $id;
		if (!$this->Catcargo->exists()) {
			throw new NotFoundException(__('Invalid catcargo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Catcargo->delete()) {
			$this->Session->setFlash(__('The catcargo has been deleted.'));
		} else {
			$this->Session->setFlash(__('The catcargo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
