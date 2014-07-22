<?php
/**
 * CalendarioFixture
 *
 */
class CalendarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'fechainicio' => array('type' => 'date', 'null' => true, 'default' => null),
		'fechafinal' => array('type' => 'date', 'null' => true, 'default' => null),
		'arancel' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '11,2', 'unsigned' => false),
		'cattramite_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_calendarios_cattramites1_idx' => array('column' => 'cattramite_id', 'unique' => 0)
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
			'fechainicio' => '2014-07-22',
			'fechafinal' => '2014-07-22',
			'arancel' => 1,
			'cattramite_id' => 1
		),
	);

}
