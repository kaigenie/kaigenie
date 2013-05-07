<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 5/4/13
 * Time: 4:05 PM
 * To change this template use File | Settings | File Templates.
 */

App::import('Component', 'Auth');
class GroupAuthComponent extends AuthComponent {

  public function isAuthorized($user = null, CakeRequest $request = null) {

    if(empty($user)){
      return parent::isAuthorized($user, $request);
    }else{
      $group = array('model' => 'Group','foreign_key' =>$user['group_id']);
      return true;
    }
  }
}