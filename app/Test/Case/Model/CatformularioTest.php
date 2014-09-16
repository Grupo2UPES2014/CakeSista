<?php
App::uses('Catformulario', 'Model');

/**
 * Catformulario Test Case
 *
 */
class CatformularioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.catformulario',
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
		'app.formulario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Catformulario = ClassRegistry::init('Catformulario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Catformulario);

		parent::tearDown();
	}

}
