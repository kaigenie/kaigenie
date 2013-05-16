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
      $result = $this->ImageUpload->upload(array("account_id" => $account_id));

      $images = $result['files'];
      $this->AccountImage->saveImages($images,$account_id);

      $response = $result['response'];
      echo $response;
    }else{

      $this->render("/Upload/acc_img");
    }

  }
}