<?php
App::uses('Formulario', 'Model');

/**
 * Formulario Test Case
 *
 */
class FormularioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.formulario',
		'app.tarea',
		'app.catformulario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Formulario = ClassRegistry::init('Formulario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Formulario);

		parent::tearDown();
	}

}
