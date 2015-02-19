<?php
App::uses('Reserva', 'Model');

/**
 * Reserva Test Case
 *
 */
class ReservaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reserva',
		'app.usuario',
		'app.rol',
		'app.cliente',
		'app.pais'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reserva = ClassRegistry::init('Reserva');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reserva);

		parent::tearDown();
	}

}
