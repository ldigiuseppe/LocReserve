<?php
App::uses('LocacionesHasReserva', 'Model');

/**
 * LocacionesHasReserva Test Case
 *
 */
class LocacionesHasReservaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.locaciones_has_reserva',
		'app.locacion',
		'app.reserva'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LocacionesHasReserva = ClassRegistry::init('LocacionesHasReserva');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LocacionesHasReserva);

		parent::tearDown();
	}

}
