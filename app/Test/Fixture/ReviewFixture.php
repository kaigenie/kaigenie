<?php
/**
 * ReviewFixture
 *
 */
class ReviewFixture extends CakeTestFixture {

  public $import = array('model' => 'Review');

  /**
   * Records
   *
   * @var array
   */
	public $records = array(
		array(
			'id' => '1',
			'account_id' => '1',
			'user_id' => '1',
			'comment' => 'hello',
			'status' => '',
			'gene_rating' => '5',
			'service_rating' => '5',
			'envi_rating' => '5',
			'food_rating' => '5',
			'suggest_item' => '',
			'created' => '2013-06-08 09:40:54',
			'modified' => '2013-06-08 09:40:54',
			'modifiedBy' => null,
			'note' => ''
		),
		array(
			'id' => '2',
			'account_id' => '1',
			'user_id' => '1',
			'comment' => 'The restaurant is fantastic',
			'status' => '',
			'gene_rating' => '2',
			'service_rating' => '2',
			'envi_rating' => '2',
			'food_rating' => '2',
			'suggest_item' => '',
			'created' => '2013-06-08 09:42:40',
			'modified' => '2013-06-08 09:42:40',
			'modifiedBy' => null,
			'note' => ''
		),
		array(
			'id' => '3',
			'account_id' => '2',
			'user_id' => '1',
			'comment' => 'yu never want to miss it',
			'status' => '',
			'gene_rating' => '4',
			'service_rating' => '3',
			'envi_rating' => '4',
			'food_rating' => '2',
			'suggest_item' => '',
			'created' => '2013-06-08 09:45:19',
			'modified' => '2013-06-08 09:45:19',
			'modifiedBy' => null,
			'note' => ''
		),
	);

}
