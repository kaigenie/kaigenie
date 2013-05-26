<?php
/**
 * MenusController means to maintenance account menu and menu items. It basically allow account administrator to add/edit
 * Account Menu and append items with it. It also provide features like attach external photos with menu items.
 * User: zjczhjuncai@gmail.com
 * Date: 5/10/13
 * Time: 10:40 PM
 */
App::uses('Thumbnail','Utility');
class MenusController extends AppController{

  public $components = array("ImageUpload");

  public $uses = array('Account', 'User', 'MenuItem','Menu', 'ItemImage');

  /**
   * Make sure Add menu/item under on specific account.
   *
   * @throws NotFoundException
   */
  public function beforeFilter(){
    /*
     * Since Menu can not exist alone, so we need to check if the passed account id exits
     */
    if(!empty($this->passedArgs)){
      $accid = $this->passedArgs[0];
    }else{
      $accid = $this->request->data['Menu']['account_id'] || $this->request->data['MenuItem']['account_id'];
    }
    if(!isset($accid) && !$this->Account->exists($accid)){
      throw new NotFoundException("You have to specify an existing account");
    }
    $this->layout = 'layout-accmenu';
  }

  /**
   * Index page of Menu, URI like /accounts/1000/menu will route to this method
   *
   * @param $accid Account ID
   */
  public function index($accid = null){

    $account = $this->Account->findById($accid);
    $this->set("account", $account);
  }

  /**
   * Add a Menu.
   */
  public function add(){

    if($this->request->is('post')){
      $this->Menu->create();
      $this->Menu->save($this->request->data);
    }
    $this->redirect(array(
      "controller"=>"accounts",
      "accid"=> $this->request->data['Menu']['account_id'],
      'action' => 'menu'
    ));
  }

  public function add_item(){

    $accountId = $this->request->data["MenuItem"]['account_id'];

    if($this->request->is('post')){
      $this->MenuItem->create();
      $images = $this->ImageUpload->upload(array("account_id" => $accountId));

      $savedMenu = $this->MenuItem->save($this->request->data);

      $this->ItemImage->saveImages($images, $savedMenu);


    }

//    $this->redirect(array(
//      'controller' => 'accounts',
//      'action'=> 'menu',
//      'accid' => $accountId
//    ));

    $this->redirect($this->referer());


  }

}