<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/26/13
 * Time: 4:57 PM
 * To change this template use File | Settings | File Templates.
 */

class Feature extends AppModel{
  public $hasMany = array(
    'AccountFeature'
  );

  /**
   * Get all enabled and non-deleted account features with key value pairs
   * @return array
   */
  public function getAllFeaturesKeyValue(){

    $features = $this->find('all', array(
      'conditions'  => array('Feature.enabled' => true, 'Feature.is_deleted' => false),
      'fields'      => array('Feature.ID', 'Feature.name')
    ));
    $keyValues = array();
    foreach($features as $feature){
      $key = $feature['Feature']['ID'];
      $value = $feature['Feature']['name'];
      $keyValues[$key] = $value;
    }
    return $keyValues;
  }
}