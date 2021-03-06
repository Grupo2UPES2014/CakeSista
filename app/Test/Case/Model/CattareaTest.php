<?php
App::uses('Cattarea', 'Model');

/**
 * Cattarea Test Case
 *
 */
class CattareaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.cattramite',
		'app.calendario',
		'app.mandamiento',
		'app.cuenta',
		'app.tarea',
		'app.formulario',
		'app.catformulario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cattarea = ClassRegistry::init('Cattarea');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cattarea);

		parent::tearDown();
	}

}
