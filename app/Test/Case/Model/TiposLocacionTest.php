<?php
App::uses('TiposLocacion', 'Model');

/**
 * TiposLocacion Test Case
 *
 */
class TiposLocacionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipos_locacion'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TiposLocacion = ClassRegistry::init('TiposLocacion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TiposLocacion);

		parent::tearDown();
	}

}
