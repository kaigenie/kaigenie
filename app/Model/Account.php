<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/18/13
 * Time: 10:46 PM
 * To change this template use File | Settings | File Templates.
 */

class Account extends AppModel{

//    public $hasAndBelongsToMany = array(
//      'Feature' => array(
//        'className'             => 'Feature',
//        'joinTable'             => 'accounts_features',
//        'foreignKey'            => 'account_id',
//        'associationForeignKey' => 'feature_id',
//        'unique'                 => true,
//        'conditions'             => '',
//        'fields'                 => '',
//        'order'                  => '',
//        'limit'                  => '',
//        'offset'                 => '',
//        'finderQuery'            => '',
//        'deleteQuery'            => '',
//        'insertQuery'            => ''
//
//      )
//    );

  public static $ACCOUNT_TYPE  = array('1' => 'Restaurant', '2' => 'Coffee Bar' );

  public static $ACCOUNT_LEVEL = array('1' => 'Basic', '2' => 'Premium');

  public $actsAs = array('Containable');

  public $hasMany = array(
    'AccountFeature',
    'AccountCategory',
    'AccountUser',
    'AccountImage',
    'Menu'
  );



  public $validate = array(
    'name' => array(
        'rule' => 'notEmpty'
    ),
    'street' => array(
        'rule' => 'notEmpty'
    )
  );

  /**
   * Due to CakePHP would NOT remove associated features and categories before update main account table.
   * I need to remove the associate data before save everything again.
   *
   * Caution: There has a risk that the save fail then I lose the previous state.
   *
   * @param array $data
   * @param array $options
   * @return mixed|void
   */
  public function saveAll($data = array(), $options = array()){
    $accountId = $data['Account']['ID'];
    if(isset($accountId)){
      $this->AccountFeature->deleteAll(array(
        'account_id' => $accountId
      ));

      $this->AccountCategory->deleteAll(array(
        'account_id' => $accountId
      ));
    }
    return parent::saveAll($data, $options);
  }

  public function findById($accountId = null, $self = true, $query = array()){

    if($self){
      $this->recursive = -1;
    }
    $query = array_merge(array(
      'conditions' => array('Account.ID = ' => $accountId),
    ),$query);
    return $this->find('first',$query);

  }

  /**
   * @param $accountId
   * @return array
   */
  public function findAccountWithMenus($accountId){

    $account = $this->find('first', array(
      'fields' => array('Account.ID', 'Account.name', 'Account.type'),
      'conditions' => array('Account.ID = ' => $accountId),
      'contain' => array('Menu')
    ));
    return $account;
  }

  public function findAccountPhotos($accountId){
    $query = array(
      'contain' => 'AccountImage'
    );

    $account = $this->findById($accountId, false, $query);
    debug($account);
    return $account;

  }


}