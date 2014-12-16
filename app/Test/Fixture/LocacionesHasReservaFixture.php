<?php
/**
 * LocacionesHasReservaFixture
 *
 */
class LocacionesHasReservaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'locacion_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'reserva_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'cantidad_adultos' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'cantidad_ninos' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => array('locacion_id', 'reserva_id'), 'unique' => 1),
			'fk_locaciones_has_reservas_reservas1_idx' => array('column' => 'reserva_id', 'unique' => 0),
			'fk_locaciones_has_reservas_locaciones1_idx' => array('column' => 'locacion_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'locacion_id' => 1,
			'reserva_id' => 1,
			'cantidad_adultos' => 1,
			'cantidad_ninos' => 1
		),
	);

}
