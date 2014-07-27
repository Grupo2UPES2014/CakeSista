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
	public function editar ($id = null) {
		if (!$this->Catcargo->exists($id)) {
			$this->Session->setFlash(__('Código de Cargo Invalido.'), array('class' => 'ERROR'));
		} else {
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Catcargo->save($this->request->data)) {
				$this->Session->setFlash(__('Se han guardado los cambios con exito.'), array('class' => 'OK'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! , por favor intente de nuevo.'), array('class' => 'ERROR'));
			}
		} else {
			$options = array('conditions' => array('Catcargo.' . $this->Catcargo->primaryKey => $id));
			$this->request->data = $this->Catcargo->find('first', $options);
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
		$this->Catcargo->id = $id;
		if (!$this->Catcargo->exists()) {
			throw new NotFoundException(__('Código de Cargo Invalido.'), array('class' => 'ERROR'));
		}
		if ($this->request->is(array('post', 'delete'))) {
            if ($this->Catcargo->delete()) {
			$this->Session->setFlash(__('Se ha eliminado el Cargo con exito'), array('class' => 'OK'));
		} else {
			$this->Session->setFlash(__('¡Ha ocurrido un error al eliminar el Cargo! , por favor intente de nuevo.'), array('class' => 'ERROR'));
		}
		return $this->redirect(array('action' => 'index'));
	}

        $options = array('conditions' => array('Cargo.' . $this->Facultade->primaryKey => $id), 'fields' => array('nombre'));
        $this->set('cargo', $this->Cargo->find('first', $options));
        $this->set('title_for_layout', 'Eliminar');
        
        
        
                }
                
}