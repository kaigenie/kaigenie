<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 5/5/13
 * Time: 1:59 PM
 * To change this template use File | Settings | File Templates.
 */

class AccountUser extends AppModel{

  public $useTable = 'accounts_users';

  public $belongsTo = array(
    'Account', 'User'
  );

  /**
   * Get all users based on accountID
   *
   * @param $accountId Account ID
   * @return all account users
   */
  public function getAccountAdmin($accountId){
    $accountAdmins = $this->find('all', $query = array(
      'conditions'  => array('AccountUser.account_id' => $accountId),
      'fields'      => array(
        'User.ID',
        'User.username'
      ),
      'order'       => array(
        'AccountUser.created' => 'Desc'
      )
    ));
//    $log = $this->getDataSource()->getLog(false, false);
//    debug($log);

    return $accountAdmins;
  }

}