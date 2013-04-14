<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/12/13
 * Time: 5:57 PM
 * To change this template use File | Settings | File Templates.
*/

class AdminUsersController extends AppController{
    public $helpers = array("Html", "Form");
    public $components = array('Session');

    /**
     * Add an Admin User.
     * Admin User is responsible for manage restaurant, coffee bar
     */
    public function add(){
        if($this->request->is('post')){

            $username = $this->request->data['AdminUser']['username'];

            if($this->AdminUser->findByUsername($username)){
                $this->Session->setFlash("Username is already been taken");
                return;
            }

            if($this->AdminUser->save($this->request->data)){
                $this->Session->setFlash("Save successfully");
                $this->redirect('/alogin');
            }else{
                $this->Session->setFlash("Sorry, Your data couldn't been saved");
            }
        }
    }
}

