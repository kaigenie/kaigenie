<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/18/13
 * Time: 9:14 PM
 * To change this template use File | Settings | File Templates.
 */

class AccessComponent extends Object{
    private $components = array('Acl', 'Auth');
    private $user;

    function startup(){
        $this->user = $this->Auth->user();
    }

    function check($aco, $action){
        if(empty($this->user)){
            return true;
        }else{
            return false;
        }
    }


}