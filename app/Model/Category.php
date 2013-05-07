<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/29/13
 * Time: 10:20 PM
 * To change this template use File | Settings | File Templates.
 */

class Category extends AppModel{

  /**
   * @return array
   */
  public function getAllCategoryPair(){

    $categories = $this->find('all', array(
      'conditions' => array('Category.enabled' => true),
      'fields' => array('Category.ID', 'Category.name')
    ));

    $keyValues = array();
    foreach($categories as $category){
      $key = $category['Category']['ID'];
      $value = $category['Category']['name'];
      $keyValues[$key] = $value;
    }

    return $keyValues;
  }
}