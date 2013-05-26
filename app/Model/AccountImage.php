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

  public $belongsTo = array("Account", "Image");

  public function saveImages($images = array(), $accountId = null){
    if(!empty($images)){
      $saved = array();
      foreach($images as $image){
        $this->create();
        $this->data["image_id"] = $image["Image"]["ID"];
        $this->data["account_id"] = $accountId;

        $saved[] = $this->save($this->data);
      }
      return $saved;
    }

    return array();
  }

  /**
   *
   * Retrieve all of the uploaded images according to accountID
   *
   * @param null $accountId Account ID
   * @return array
   */
  public function findAccountImages($accountId = null){

    $results = $this->find('all', array(
      'fields' => array(
        'Account.ID', 'Account.name', 'AccountImage.*', 'Image.*'
      ),
      'conditions' => array(
        'Account.ID' => $accountId
      )
    ));

    $imageWithUrl = $this->_buildImageUrl($results);

    return $imageWithUrl;
  }

  private function _buildImageUrl($results = array()){

    $uploadConfig= Configure::read('App.Uploads');

    $staticServer = $uploadConfig['static_server'];
    $staticUri = $uploadConfig['static_uri'];
    $versions = $uploadConfig['image_versions'];


    $newImage = array();
    $updatedResults = array();

    foreach($results as $result){
      $image = $result['Image'];
      list($imageID,$fileName,$fileSize) = array($image['ID'],$image['name'],$image['size']);
      list($uniqueName, $relativePath) = array($image['unique_name'], $image['relative_path']);
      $uploadOn = $result['AccountImage']['created'];
      $uploadBy = $image['uploadBy'];

      foreach ($versions as $version => $options) {
        if (!empty($version)) {
          $newImage[$version . '_url'] = $staticServer . $staticUri . $relativePath . $version . '/' . $uniqueName;
        }
      }

      unset($result['Image']);
      unset($result['AccountImage']);

      $result['Image'] = array_merge($newImage,array(
        'ID'   => $imageID,
        'name' => $fileName,
        'size' => $fileSize,
        'time' => $uploadOn,
        'user' => $uploadBy
      ));

      $updatedResults[] = $result;
    }
    return $updatedResults;
  }

}