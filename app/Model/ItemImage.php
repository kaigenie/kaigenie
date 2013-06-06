<?php
/**
 * Created by JetBrains PhpStorm.
 * User: I076004
 * Date: 5/26/13
 * Time: 2:46 PM
 * To change this template use File | Settings | File Templates.
 */

class ItemImage extends AppModel{

  public $useTable = 'menuitem_images';

  public function saveImages($images = array(), $savedMenu = null){

    $itemId = $savedMenu['MenuItem']['id'];

    if(!empty($images)){
      $saved = array();
      foreach($images as $image){
        $this->create();
        $this->data["image_id"] = $image["Image"]["id"];
        $this->data["item_id"] = $itemId;
        $saved[] = $this->save($this->data);
      }
      return $saved;
    }

    return array();
  }

}