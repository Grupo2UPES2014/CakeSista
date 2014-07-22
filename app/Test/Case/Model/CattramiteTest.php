<?php
App::uses('Cattramite', 'Model');

/**
 * Cattramite Test Case
 *
 */
class CattramiteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cattramite',
		'app.calendario',
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
		$this->Cattramite = ClassRegistry::init('Cattramite');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cattramite);

		parent::tearDown();
	}

}
