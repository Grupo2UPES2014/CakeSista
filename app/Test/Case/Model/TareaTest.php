<?php
App::uses('Tarea', 'Model');

/**
 * Tarea Test Case
 *
 */
class TareaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tarea',
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
		$this->Tarea = ClassRegistry::init('Tarea');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tarea);

		parent::tearDown();
	}

}
