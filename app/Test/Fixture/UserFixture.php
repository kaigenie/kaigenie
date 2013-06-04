<?php
/**
 * Created by JetBrains PhpStorm.
 * User: I076004
 * Date: 5/23/13
 * Time: 9:42 PM
 * To change this template use File | Settings | File Templates.
 */

class UserFixture extends CakeTestFixture{

  public $name = 'User';

  public $fields = array(

    'id' => array('type' => 'integer', 'key' => 'primary'),

    'username' => array('type' => 'string', 'null' => false),

    'password' => array('type' => 'string', 'null' => false),

    'created' => 'datetime',

    'updated' => 'datetime'
  );


  /**

   * records property

   *

   * @var array

   * @access public

   */

  public $records = array(

    array('username' => 'mariano', 'password' => '5f4dcc3b5aa765d61d8327deb882cf99', 'created' => '2007-03-17 01:16:23', 'updated' => '2007-03-17 01:18:31'),
    array('username' => 'nate', 'password' => '5f4dcc3b5aa765d61d8327deb882cf99', 'created' => '2007-03-17 01:18:23', 'updated' => '2007-03-17 01:20:31'),
    array('username' => 'larry', 'password' => '5f4dcc3b5aa765d61d8327deb882cf99', 'created' => '2007-03-17 01:20:23', 'updated' => '2007-03-17 01:22:31'),
    array('username' => 'garrett', 'password' => '5f4dcc3b5aa765d61d8327deb882cf99', 'created' => '2007-03-17 01:22:23', 'updated' => '2007-03-17 01:24:31'),

  );

}