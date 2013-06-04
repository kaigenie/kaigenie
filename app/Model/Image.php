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
    $uploadConfig= Configure::read('App.Uploads');
    $staticServer = $uploadConfig['static_server'];
    $staticUri = $uploadConfig['static_uri'];
    $versions = $uploadConfig['image_versions'];

    $newImage = array();
    $updatedPhotos = array();
    debug($results);
    if(!empty($results)){
      foreach($results as $image){
        list($imageID,$fileName,$fileSize) = array($image['ID'],$image['name'],$image['size']);
        list($uniqueName, $relativePath) = array($image['unique_name'], $image['relative_path']);
        foreach ($versions as $version => $options) {
          if (!empty($version)) {
            $staticUri = rtrim($staticUri, '/');
            $newImage[$version . '_url'] = $staticServer . $staticUri . $relativePath . $version . '/' . $uniqueName;
          }
        }
        $newImage = array_merge($newImage,array(
          'ID'   => $imageID,
          'name' => $fileName,
          'size' => $fileSize
        ));

        $updatedPhotos[] = $newImage;
      }
    }
    return $updatedPhotos;
  }

}