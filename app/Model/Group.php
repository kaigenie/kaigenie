<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/29/13
 * Time: 6:34 PM
 * To change this template use File | Settings | File Templates.
 */


class Group extends AppModel{

  /**
   * Site Administrator, Super user
   */
  const USER_GROUP_SITE_ADMIN      = 1000;

  /**
   * Account Admin, aka External Administrator
   */
  const USER_GROUP_ACCOUNT_ADMIN   = 1001;

  /**
   * Normal User who can add post comments on accounts
   */
  const USER_GROUP_MEMBER          = 1002;

  public static $USER_GROUP_NAMES = array(
    self::USER_GROUP_SITE_ADMIN     => 'Site Administrator',
    self::USER_GROUP_ACCOUNT_ADMIN  => 'Account Administrator',
    self::USER_GROUP_MEMBER         => 'Member'
  );

  public $actsAs = array('Acl' => array('type' => 'requester'));

  public function parentNode() {
    return null;
  }
  public function bindNode($group) {
    return array('model' => 'Group', 'foreign_key' => $group['Group']['id']);
  }

}