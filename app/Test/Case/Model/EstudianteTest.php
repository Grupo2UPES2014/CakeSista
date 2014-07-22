<?php
App::uses('Estudiante', 'Model');

/**
 * Estudiante Test Case
 *
 */
class EstudianteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.estudiante',
		'app.usuario',
		'app.role',
		'app.empleado',
		'app.carrera',
		'app.facultade',
		'app.asignatura',
		'app.tramite'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Estudiante = ClassRegistry::init('Estudiante');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Estudiante);

		parent::tearDown();
	}

}
