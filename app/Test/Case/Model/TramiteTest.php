<?php
App::uses('Tramite', 'Model');

/**
 * Tramite Test Case
 *
 */
class TramiteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tramite',
		'app.estudiante',
		'app.usuario',
		'app.role',
		'app.empleado',
		'app.catcargo',
		'app.cattarea',
		'app.cattramite',
		'app.calendario',
		'app.tarea',
		'app.formulario',
		'app.catformulario',
		'app.carrera',
		'app.facultade',
		'app.asignatura',
		'app.mandamiento'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tramite = ClassRegistry::init('Tramite');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tramite);

		parent::tearDown();
	}

}
