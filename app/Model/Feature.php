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
      'fields'      => array('Feature.id', 'Feature.name')
    ));
    $keyValues = array();
    foreach($features as $feature){
      $key = $feature['Feature']['id'];
      $value = $feature['Feature']['name'];
      $keyValues[$key] = $value;
    }
    return $keyValues;
  }

  public function getFeaturesWithAccountCount(){
    $result = $this->find('all', $query=array(
      'fields' => array("Feature.id", 'Feature.name', 'count(account_id) as cntAcc'),
      'joins' => array(
        array(
          'table'=>'accounts_features',
          'alias' => 'af',
          'type' => 'left',
          'conditions' => array(
            'af.feature_id = Feature.id'
          )
        )
      ),
      'conditions' => array(
        'Feature.enabled'=>true,
        'Feature.is_deleted' => false
      ),
      'group'  => array("Feature.id", 'Feature.name'),
      'order'  => array("Feature.name ASC")
    ));

    return $result;
  }
}