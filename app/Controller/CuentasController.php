<?php
App::uses('AppController', 'Controller');
/**
 * Cuentas Controller
 *
 * @property Cuenta $Cuenta
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CuentasController extends AppController {

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
		$this->Cuenta->recursive = 0;
		$this->set('cuentas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cuenta->exists($id)) {
			throw new NotFoundException(__('Invalid cuenta'));
		}
		$options = array('conditions' => array('Cuenta.' . $this->Cuenta->primaryKey => $id));
		$this->set('cuenta', $this->Cuenta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function nuevo() {
		if ($this->request->is('post')) {
			$this->Cuenta->create();
			if ($this->Cuenta->save($this->request->data)) {
				$this->Session->setFlash(__('¡Se ha guardado la cuenta con éxito!'), array('class' => 'OK'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! , por favor intente de nuevo.'), array('class' => 'ERROR'));
			}
		}
                $this->set('title_for_layout', 'Nuevo');
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function editar($id = null) {
		if (!$this->Cuenta->exists($id)) {
			//throw new NotFoundException(__('Invalid cuenta'));
                    $this->Session->setFlash(__('Código de Cuenta Invalido.'), array('class' => 'ERROR'));
		} else {
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cuenta->save($this->request->data)) {
				$this->Session->setFlash(__('Se han guardado los cambios con exito.'), array('class' => 'OK'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! , por favor intente de nuevo.'), array('class' => 'ERROR'));
			}
		} else {
			$options = array('conditions' => array('Cuenta.' . $this->Cuenta->primaryKey => $id));
			$this->request->data = $this->Cuenta->find('first', $options);
		}
                
	}
        $this->set('title_for_layout', 'Editar');
}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function eliminar($id = null) {
		$this->Cuenta->id = $id;
		if (!$this->Cuenta->exists()) {
			//throw new NotFoundException(__('Invalid cuenta'));
                    $this->Session->setFlash(__('Código de Cuenta Invalido.'), array('class' => 'ERROR'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->request->is(array('post', 'delete'))) {
                    if ($this->Cuenta->delete()) {
			$this->Session->setFlash(__('Se ha eliminado la facultad con exito'), array('class' => 'OK'));
                    } else {
			$this->Session->setFlash(__('¡Ha ocurrido un error al eliminar la facultad! , por favor intente de nuevo.'), array('class' => 'ERROR'));
		}
		return $this->redirect(array('action' => 'index'));
	}
                $options = array('conditions' => array('Cuenta.' . $this->Cuenta->primaryKey => $id), 'fields' => array('numero'));
        $this->set('cuenta', $this->Cuenta->find('first', $options));
        $this->set('title_for_layout', 'Eliminar');
}

}