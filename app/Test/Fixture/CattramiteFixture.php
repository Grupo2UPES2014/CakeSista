<?php
/**
 * CattramiteFixture
 *
 */
class CattramiteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 75, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'arancel' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '11,2', 'unsigned' => false),
		'porcentajerecargo' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'arancel' => 1,
			'porcentajerecargo' => 1
		),
	);

}
