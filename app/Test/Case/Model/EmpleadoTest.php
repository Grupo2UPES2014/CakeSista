<?php
App::uses('Empleado', 'Model');

/**
 * Empleado Test Case
 *
 */
class EmpleadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.empleado',
		'app.usuario',
		'app.role',
		'app.estudiante',
		'app.carrera',
		'app.facultade',
		'app.asignatura',
		'app.tramite',
		'app.catcargo',
		'app.tarea'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Empleado = ClassRegistry::init('Empleado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Empleado);

		parent::tearDown();
	}

}
