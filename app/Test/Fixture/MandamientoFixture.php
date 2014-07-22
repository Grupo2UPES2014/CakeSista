<?php
/**
 * MandamientoFixture
 *
 */
class MandamientoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'arancel' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '11,2', 'unsigned' => false),
		'fechaemision' => array('type' => 'date', 'null' => true, 'default' => null),
		'npe' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'codigobarras' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descripcion' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tramite_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'cuenta_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_mandamientos_tramites1_idx' => array('column' => 'tramite_id', 'unique' => 0),
			'fk_mandamientos_cuentas1_idx' => array('column' => 'cuenta_id', 'unique' => 0)
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
			'arancel' => 1,
			'fechaemision' => '2014-07-22',
			'npe' => 'Lorem ip',
			'codigobarras' => 'Lorem ipsum dolor sit amet',
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'tramite_id' => 1,
			'cuenta_id' => 1
		),
	);

}
