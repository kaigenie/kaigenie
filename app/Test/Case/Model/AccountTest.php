<?php
/**
 * Created by JetBrains PhpStorm.
 * User: I076004
 * Date: 5/23/13
 * Time: 10:43 PM
 * To change this template use File | Settings | File Templates.
 */

App::import("Model", 'Account');
App::import("Model", 'AccountImage');
class AccountTest extends CakeTestCase{

  public $fixtures = array('account','AccountImage','image');

  public $Account;
  public $AccountImage;

  public function setUp(){
    $this->Account = ClassRegistry::init('Account');
    $this->AccountImage = ClassRegistry::init('AccountImage');
  }

  public function testGetAccountPhotos(){
    // $result = $this->Account->findAccountPhotos(1);

    $results = $this->AccountImage->findAccountImages(1);

    if(!empty($results)){
      foreach($results as $index=>$result){
        list($account,$image) = array($result['Account'], $result['Image']);
        $this->assertNotEmpty($image['thumbnail_url']);
        $this->assertNotEmpty($image['medium_url']);
      }
    }
  }
}