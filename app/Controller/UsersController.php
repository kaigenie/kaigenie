<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/14/13
 * Time: 8:23 PM
 * To change this template use File | Settings | File Templates.
 */
class UsersController extends AppController{

    public function login(){
        if($this->request->is('post')){
            $username = $this->request->data['Users']['usrUsername'];
            // Mock up the user login
//            $this->Session->
        }
    }
}