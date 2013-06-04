<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/14/13
 * Time: 8:42 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel{

  public $belongsTo = array('Group');
  public $hasMany = array('AccountUser');
  public $actsAs = array('Acl' => array('type' => 'requester'));

  /**
   * @return mixed
   */
  public function getAllAccountAdmin(){

    $accountAdmins = $this->AccountUser->find('all', array(
      'fields' => array('User.ID', 'User.username', 'User.email', 'Account.name', 'Account.ID', 'AccountUser.ID', 'AccountUser.expired_date'),
      'conditions'  => array('User.group_id' => Group::USER_GROUP_ACCOUNT_ADMIN),
      'order'       => array('Account.name', 'User.username DESC')
    ));

    return $accountAdmins;
  }


  /**
   * Hash the password before saving user in db.
   *
   * @param array $option
   * @return bool|void
   */
  public function beforeSave($option = array()){
    if(isset($this->data[$this->alias]['password'])){
      $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }

  }


  public function parentNode() {
    if (!$this->id && empty($this->data)) {
      return null;
    }
    if (isset($this->data['User']['group_id'])) {
      $groupId = $this->data['User']['group_id'];
    } else {
      $groupId = $this->field('group_id');
    }
    if (!$groupId) {
      return null;
    } else {
      return array('Group' => array('id' => $groupId));
    }
  }


}