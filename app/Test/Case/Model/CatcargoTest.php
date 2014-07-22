<?php
App::uses('Catcargo', 'Model');

/**
 * Catcargo Test Case
 *
 */
class CatcargoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.catcargo',
		'app.cattarea',
		'app.empleado',
		'app.usuario',
		'app.role',
		'app.estudiante',
		'app.carrera',
		'app.facultade',
		'app.asignatura',
		'app.tramite',
		'app.tarea'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Catcargo = ClassRegistry::init('Catcargo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Catcargo);

		parent::tearDown();
	}

}
