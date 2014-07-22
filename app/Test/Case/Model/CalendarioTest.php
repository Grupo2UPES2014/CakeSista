<?php
App::uses('Calendario', 'Model');

/**
 * Calendario Test Case
 *
 */
class CalendarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.calendario',
		'app.cattramite',
		'app.cattarea',
		'app.catcargo',
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
		$this->Calendario = ClassRegistry::init('Calendario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Calendario);

		parent::tearDown();
	}

}
