<?php
/**
 * @property User User
 * @property AccountUser AccountUser
 *
 * In general, Kaigenie support three types of users.
 * 1. Site Administrator
 * 2. External Administrator
 * 3. Normal Users
 * Site Administrator (aka Internal Admin) who basically can do everything allowed in the system, for example he/she can
 * create other types of users, add accounts, maintenance master data setting.
 * External Administrator only allow to maintenance their own account, for example, name/address information, number of
 * seats
 *
 * Normal users also known as member that are not supported in phrase one
 *
 */
APP::uses('Group', 'Model');
class UsersController extends AppController{

  public $uses = array('Group', 'User', 'AccountUser');
  /**
   * Add an User.
   * Admin User is responsible for manage restaurant, coffee bar
   */
  public function register(){
    if($this->request->is('post')){
      $username = $this->request->data['User']['username'];
      if($this->User->findByUsername($username)){
        $this->Session->setFlash(__('Username is already been taken'));
        return;
      }

      $email = $this->request->data['User']['email'];
      if($this->User->findByEmail($email)){
        $this->Session->setFlash(__('Email Address is already been taken'));
        return;
      }

      $this->request->data['User']['group_id'] = Group::USER_GROUP_ACCOUNT_ADMIN;

      if($this->User->save($this->request->data)){
        $this->Session->setFlash('Save Successfully');
        $this->redirect('/login');
      }else{
        $this->Session->setFlash("Sorry, Your data couldn't been saved");
      }
    }

  }


  public function login(){

      if($this->request->is('post')){
          if($this->Auth->login()){
              $this->redirect($this->Auth->redirectUrl());
          }else{
              $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
          }
      }
  }

  public function logout() {
      $this->Auth->logout();
      $this->redirect($this->Auth->redirectUrl());
  }

  public function beforeFilter(){
    parent::beforeFilter();

    // FIXME: Remove the allow everything after configuring ACL
    $this->Auth->allow();
  }

  /**
   * List all of the Account Administrator, the function only allowed by Super User
   */
  public function list_admin(){

    $admins = $this->User->getAllAccountAdmin();
    $this->set('admins', $admins);
    $this->render('admin_list');
  }


  public function delete_admin($id){
    if(!$this->AccountUser->exists($id)){
      throw new NotFoundException(__("The relationship is not found"));
    }

    if($this->AccountUser->delete($id)){
      $this->redirect(array("action" => 'list_admin'));
    }
  }

  public function expire_admin($id, $days){
    if(!$this->AccountUser->exists($id)){
      throw new NotFoundException(__("The Administrator can not been found"));
    }

    if($this->request->is('post')){
      if($this->AccountUser->setExpireDate($id, $days)){
        $this->redirect(array("action" => 'list_admin'));
      }
    }
  }

  /**
   * Add an Account Administrator
   */
  public function add_admin(){

    $this->autoRender = false;

    if($this->request->is('ajax') && !empty($this->request->data)){

      $this->User->create();
      $this->request->data['User']['group_id'] = Group::USER_GROUP_ACCOUNT_ADMIN;
      $this->request->data['User']['password'] = Configure::read('User.DefaultPassword');
      $this->request->data['User']['is_active'] = true;
      $this->request->data['User']['is_delete'] = false;

      $accountId = $this->request->data['User']['account_id'];

      $this->request->data['AccountUser'] = array(
        array('account_id' => $this->request->data['User']['account_id'])
      );

      if($this->User->saveAll($this->request->data)){
        $allAdmins = $this->AccountUser->getAccountAdmin($accountId);
        echo json_encode($allAdmins);
      }

    }
  }

  /**
   * Remove administrator from an account.
   *
   * @param $id
   */
  public function remove_admin($id){

    $this->autoRender = false;

    if(!isset($id)){
      $id = $_POST['id'];
    }

    if($this->request->is('post')){
      $result = $this->AccountUser->delete($id);
      echo json_encode(array("result"=>$result));

    }
  }

  public function setup($param = null){

    if($param == 'password'){
      // Render change password page

      if($this->request->is('post')){
        $oldPwd = $_POST['oldPassword'];
        $newPwd = $_POST['newPassword'];
        $rptPwd = $_POST['repeatPassword'];

        $ready = true;

        $loggedInUser = $this->Auth->user();

        $this->User->recursive = -1;
        $user = $this->User->findByUsername($loggedInUser['username']);

        $oldHashedPwd = AuthComponent::password($oldPwd);

        if($oldHashedPwd != $user['User']['password']){
          $this->Session->setFlash("Your current password is incorrect.", 'flash_alert');
          $ready = false;
        }

        if($newPwd != $rptPwd){
          $this->Session->setFlash("Two passwords are inconsistant.", 'flash_alert');
          $ready = false;
        }

        if($ready){
          $updateUser = $this->User->create();
          $this->User->id = $loggedInUser['id'];
          $this->User->saveField('password', $newPwd);
          $this->Session->setFlash("Your Password had been changed", 'flash_alert');
        }


        $this->data = $_POST;
      }
      $this->render('/users/chgpsw');

    }
  }

  public function beforeRender() {
      if($this->Session->check('Auth.User')) {

          $currentUser = $this->Auth->user();

          $this->Auth->loggedIn();

          $this->set('authUser',$currentUser);
      }
  }
}