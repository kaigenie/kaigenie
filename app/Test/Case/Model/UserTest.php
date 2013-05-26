<?php
/**
 * Created by JetBrains PhpStorm.
 * User: I076004
 * Date: 5/23/13
 * Time: 9:44 PM
 * To change this template use File | Settings | File Templates.
 */

App::import('Model', 'User');

class UserTest extends CakeTestCase{

  public $fixtures = array('user');
  public $User;

  public function setUp(){
    echo "in Setup";
    $this->User = ClassRegistry::init('User');
  }

  public function testGetInstance(){

    $created = $this->User->field('created', array('User.username' => 'mariano'));
    $this->assertEquals($created, '2007-03-17 01:16:23', 'Created Date');
  }
}