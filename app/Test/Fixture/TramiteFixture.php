<?php
/**
 * TramiteFixture
 *
 */
class TramiteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'estado' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'fechainicio' => array('type' => 'date', 'null' => true, 'default' => null),
		'fechafin' => array('type' => 'date', 'null' => true, 'default' => null),
		'estudiante_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'cattramite_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_tramites_estudiantes1_idx' => array('column' => 'estudiante_id', 'unique' => 0),
			'fk_tramites_cattramites1_idx' => array('column' => 'cattramite_id', 'unique' => 0)
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
			'estado' => 1,
			'fechainicio' => '2014-07-22',
			'fechafin' => '2014-07-22',
			'estudiante_id' => 1,
			'cattramite_id' => 1
		),
	);

}
