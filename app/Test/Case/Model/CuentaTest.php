<?php
App::uses('Cuenta', 'Model');

/**
 * Cuenta Test Case
 *
 */
class CuentaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cuenta',
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
		'app.asignatura'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cuenta = ClassRegistry::init('Cuenta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cuenta);

		parent::tearDown();
	}

}
