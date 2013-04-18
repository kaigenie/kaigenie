<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/18/13
 * Time: 9:20 PM
 * To change this template use File | Settings | File Templates.
 */

App::uses('Auth', 'Component');
App::uses('Session', 'View/Helper');

class AccessHelper extends AppHelper{
    public $helpers = array('Session');
    private $access;
    private $Auth;
    private $user;

    public function __construct(View $view, $settings = array()) {
        parent::__construct($view, $settings);

        $this->user = $this->Session->read('Auth.User');
    }



    public function beforeRender($viewFile){
        App::import('Component', 'Access');
        $this->access = new AccessComponent();

        App::import('Component', 'Auth');

    }

    public function loggedIn(){
        $user = $this->Session->read('Auth.User');
        if(!empty($user)){
            return true;
        }else{
            return false;
        }
    }

    public function getUsername(){
        return $this->user['username'];
    }

    public function getName(){
        return $this->user['first_name'] .' '. $this->user['last_name'];
    }
}