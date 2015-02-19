<?php
App::uses('Locacione', 'Model');

/**
 * Locacione Test Case
 *
 */
class LocacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.locacione',
		'app.tipo_locacion'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Locacione = ClassRegistry::init('Locacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Locacione);

		parent::tearDown();
	}

}
