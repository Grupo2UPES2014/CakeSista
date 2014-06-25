<?php
App::uses('Facultade', 'Model');

/**
 * Facultade Test Case
 *
 */
class FacultadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.facultade',
		'app.carrera'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Facultade = ClassRegistry::init('Facultade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Facultade);

		parent::tearDown();
	}

}
