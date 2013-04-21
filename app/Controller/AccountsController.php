<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/19/13
 * Time: 9:26 PM
 * To change this template use File | Settings | File Templates.
 */

class AccountsController extends AppController{

    public $helpers = array( 'Html' => array('className' => 'UI'));

    public function add(){
        if($this->request->is('post')){
            // save account
        }
    }
}