<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 5/4/13
 * Time: 8:53 PM
 * To change this template use File | Settings | File Templates.
 */

class Image extends AppModel{

  /**
   * Images were uploaded by either Account Admin or Super Administrator,
   * and the image will be loaded on account detail page.
   * @var array
   */
  public $belongsTo = array(
    'User',
    'Account'
  );

  /**
   * Image afterFind callback function to construct image urls based on different versions and remove unnecessary data.
   *
   * @param mixed $results
   * @param bool $primary
   * @return array|mixed
   */
  public function afterFind($results, $primary = false){

    parent::afterFind($results, $primary);

    $uploadConfig= Configure::read('App.Uploads');
    $staticServer = $uploadConfig['static_server'];
    $staticUri = $uploadConfig['static_uri'];
    $versions = $uploadConfig['image_versions'];

    $newImage = array();
    $updatedPhotos = array();

    if(!empty($results)){

      if(self::_isFilted($results)){
//        return self::_getFilted($results);
        return $results;
      }


      foreach($results as $key=>$image){
        list($imageID,$fileName,$fileSize) = array($image['id'],$image['name'],$image['size']);
        list($uniqueName, $relativePath) = array($image['unique_name'], $image['relative_path']);
        foreach ($versions as $version => $options) {
          if (!empty($version)) {
            $staticUri = rtrim($staticUri, '/');
            $newImage[$version . '_url'] = $staticServer . $staticUri . $relativePath . $version . '/' . $uniqueName;
          }
        }
        $newImage = array_merge($newImage,array(
          'id'   => $imageID,
          'name' => $fileName,
          'size' => $fileSize,
          'fill' => true // afterFind will be called twice, this flag is used to make sure it doesn't broken
        ));

        $updatedPhotos[] = $newImage;
      }
    }
    return $updatedPhotos;
  }

  private function _isFilted($results){
    $firstElement = reset($results);

    if(isset($firstElement[$this->alias])){
      return reset($firstElement[$this->alias])['fill'];
    }

    if(array_key_exists($this->alias,array_keys($firstElement))){
      return true;
    }

    return false;
  }

  private function _getFilted($results){
    $firstElement = reset($results);

    if(isset($firstElement)){
      return reset($firstElement);
    }

    return $firstElement[$this->alias];
  }

}