<?php
App::uses('Review', 'Model');

/**
 * Review Test Case
 *
 */
class ReviewTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.review',
		'app.account',
//		'app.account_feature',
//		'app.feature',
//		'app.account_category',
//		'app.category',
//		'app.account_user',
		'app.user',
//		'app.group',
//		'app.account_image',
//		'app.menu',
//		'app.menu_item',
		'app.image',
//		'app.item_image',
		'app.review_image'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Review = ClassRegistry::init('Review');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Review);

		parent::tearDown();
	}

  public function testAccountWithReviews(){
    $result = $this->Review->findReviewCount();
    $this->assertNotEmpty($result);
  }

  public function testFindReviewByAccount(){
    $result = $this->Review->findReviewsByAccount(1);
    $this->assertNotEmpty($result);
    $this->assertArrayHasKey('User',$result[0]);
    $this->assertArrayHasKey('ReviewImage',$result[0]);
  }

}
