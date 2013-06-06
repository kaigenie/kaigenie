<?php
/**
 * Created by JetBrains PhpStorm.
 * User: I076004
 * Date: 5/13/13
 * Time: 8:51 PM
 * To change this template use File | Settings | File Templates.
 */


class UploadController extends AppController{

  public $uses = array("AccountImage", "Account", "Image");

  public $components = array("ImageUpload");

  public function upload($type="", $id){
    
    switch ($type){
      case "account":
        self::_upload_account($id);
        break;
      case "menuitem":
        self::_upload_item($id);
        break;
      default:
        throw new NotFoundException("The page is not found");
    }
  }

  private function _upload_item($item_id){

  }

  private function _upload_account($account_id){

    $this->autoRender = false;

    if($this->request->is("post")){
      $images = $this->ImageUpload->upload(array("account_id" => $account_id));

      $this->AccountImage->saveImages($images,$account_id);

      $this->ImageUpload->json_response($images);

    }else{
      $this->set("account", $this->Account->findById($account_id, true, array(
        'fields' => array('Account.id', 'Account.name')
      )));
      $this->render("/Upload/acc_img");
    }

  }

}