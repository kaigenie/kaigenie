<?php
/**
 * Created by JetBrains PhpStorm.
 * User: I076004
 * Date: 5/13/13
 * Time: 3:45 PM
 * To change this template use File | Settings | File Templates.
 */

class AccountImage extends AppModel{

  public $useTable = "accounts_images";

  public function saveImages($images = array(), $accountId = null){
    if(!empty($images)){
      $saved = array();
      foreach($images as $image){
        $this->create();
        $this->data["image_id"] = $image["Image"]["id"];
        $this->data["account_id"] = $accountId;

        $saved[] = $this->save($this->data);
      }

      return $saved;
    }

    return array();
  }

}