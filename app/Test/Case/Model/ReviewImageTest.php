<?php
App::uses('ReviewImage', 'Model');

/**
 * ReviewImage Test Case
 *
 */
class ReviewImageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.review_image',
		'app.review',
		'app.account',
		'app.account_feature',
		'app.feature',
		'app.account_category',
		'app.category',
		'app.account_user',
		'app.user',
		'app.group',
		'app.account_image',
		'app.menu',
		'app.menu_item',
		'app.image',
		'app.item_image'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ReviewImage = ClassRegistry::init('ReviewImage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ReviewImage);

		parent::tearDown();
	}

}
