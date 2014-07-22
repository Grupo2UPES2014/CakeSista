<?php
App::uses('Mandamiento', 'Model');

/**
 * Mandamiento Test Case
 *
 */
class MandamientoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mandamiento',
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
		'app.cuenta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mandamiento = ClassRegistry::init('Mandamiento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mandamiento);

		parent::tearDown();
	}

}
