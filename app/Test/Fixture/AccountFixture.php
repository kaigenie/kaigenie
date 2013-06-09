<?php
/**
 * AccountFixture
 *
 */
class AccountFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => 'Business Name', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 4000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'level' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'identify account as basic or premium?'),
		'openTo' => array('type' => 'time', 'null' => true, 'default' => null),
		'level_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'integer', 'null' => false, 'default' => null),
		'type_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'country' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'state' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'city' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'suburb' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'zipcode' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'street' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => 'Address', 'charset' => 'utf8'),
		'telephone' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mobile_num' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mobile_num2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'fax' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'website' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'geolat' => array('type' => 'float', 'null' => true, 'default' => null),
		'geolng' => array('type' => 'float', 'null' => true, 'default' => null),
		'avg_spending' => array('type' => 'integer', 'null' => true, 'default' => null),
		'seat_num' => array('type' => 'integer', 'null' => true, 'default' => null),
		'biz_hour_from' => array('type' => 'time', 'null' => true, 'default' => null),
		'biz_hour_to' => array('type' => 'time', 'null' => true, 'default' => null),
		'enabled' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1, 'comment' => 'Status (Enable/Disable)'),
		'note' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Creation Date'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'biz_day_from' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'biz_day_to' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'expire_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'open_hour' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => 'open hour text for display', 'charset' => 'utf8'),
		'allow_review' => array('type' => 'string', 'null' => true,'default'=>'1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'id' => '1',
			'name' => 'Test Account',
			'description' => null,
			'level' => '2',
			'openTo' => '22:00:00',
			'level_name' => 'Premium',
			'type' => '1',
			'type_name' => 'Restaurant',
			'country' => 'New Zealand',
			'state' => '',
			'city' => 'Auckland',
			'suburb' => 'Pu Dong',
			'zipcode' => '610059',
			'street' => '#342 Yin Shan Road',
			'telephone' => '021-84071235',
			'mobile_num' => null,
			'mobile_num2' => null,
			'fax' => '021-84071235',
			'email' => null,
			'website' => null,
			'geolat' => null,
			'geolng' => null,
			'avg_spending' => '80',
			'seat_num' => '30',
			'biz_hour_from' => null,
			'biz_hour_to' => null,
			'enabled' => true,
			'note' => null,
			'created' => '2013-06-06 15:56:37',
			'modified' => '2013-06-06 15:56:37',
			'biz_day_from' => null,
			'biz_day_to' => null,
			'expire_date' => null,
			'open_hour' => null,
			'allow_review' => true
		),
		array(
			'id' => '2',
			'name' => 'Mr. Su Sea Food',
			'description' => null,
			'level' => '2',
			'openTo' => null,
			'level_name' => 'Premium',
			'type' => '2',
			'type_name' => 'Coffee Bar',
			'country' => 'New Zealand',
			'state' => '',
			'city' => 'Auckland',
			'suburb' => 'Pu Dong',
			'zipcode' => '601159',
			'street' => 'PuDong DaDao 1001',
			'telephone' => '021 123049345',
			'mobile_num' => null,
			'mobile_num2' => null,
			'fax' => '021 67865432',
			'email' => null,
			'website' => null,
			'geolat' => null,
			'geolng' => null,
			'avg_spending' => '13',
			'seat_num' => '50',
			'biz_hour_from' => null,
			'biz_hour_to' => null,
			'enabled' => true,
			'note' => null,
			'created' => '2013-06-08 09:44:04',
			'modified' => '2013-06-08 09:44:04',
			'biz_day_from' => null,
			'biz_day_to' => null,
			'expire_date' => null,
			'open_hour' => null,
			'allow_review' => true
		),
	);

}
