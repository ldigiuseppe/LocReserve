<?php
/**
 * ReservaFixture
 *
 */
class ReservaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'fecha_creacion' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'fecha_actualizacion' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'fecha_desde' => array('type' => 'date', 'null' => true, 'default' => null),
		'fecha_hasta' => array('type' => 'date', 'null' => true, 'default' => null),
		'hora_arribo' => array('type' => 'time', 'null' => true, 'default' => null),
		'info_adicional' => array('type' => 'binary', 'null' => true, 'default' => null),
		'usuario_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'cliente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id', 'usuario_id', 'cliente_id'), 'unique' => 1),
			'fk_reservas_usuarios1_idx' => array('column' => 'usuario_id', 'unique' => 0),
			'fk_reservas_clientes1_idx' => array('column' => 'cliente_id', 'unique' => 0)
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
			'id' => 1,
			'fecha_creacion' => '2014-12-05 16:47:43',
			'fecha_actualizacion' => '2014-12-05 16:47:43',
			'fecha_desde' => '2014-12-05',
			'fecha_hasta' => '2014-12-05',
			'hora_arribo' => '16:47:43',
			'info_adicional' => 'Lorem ipsum dolor sit amet',
			'usuario_id' => 1,
			'cliente_id' => 1
		),
	);

}
