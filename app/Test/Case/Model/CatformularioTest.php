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
