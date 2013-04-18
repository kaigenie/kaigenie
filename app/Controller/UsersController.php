<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/14/13
 * Time: 8:23 PM
 * To change this template use File | Settings | File Templates.
 */
class UsersController extends AppController{

    public $helpers = array("Html", "Form", "Access" => array(
                                                        "className" => 'Access'
                                                        )
    );
    public $components = array('Session',
                            'Auth' => array(
                                'loginAction' => array(
//                                    'controller' => 'users',
//                                    'action' => 'login',
//                                    'plugin' => 'users'
                                ),
                                'authError' => 'do you really think you are allow to see that?',
                                'authenticate' => array(
                                    'Form' => array(
                                        'fields' => array('username' => 'username')
                                    )
                                )
                            ));



    /**
     * Add an Admin User.
     * Admin User is responsible for manage restaurant, coffee bar
     */
    public function register(){
        if($this->request->is('post')){
            $username = $this->request->data['User']['username'];
            if($this->User->findByUsername($username)){
                $this->Session->setFlash(__('Username is already been taken'));
//                $this->redirect($this->request->url);
                return;
            }

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

    public function beforeRender() {
        if($this->Session->check('Auth.User')) {

            $currentUser = $this->Auth->user();

            $this->Auth->loggedIn();

            $this->set('authUser',$currentUser);
        }
    }
}