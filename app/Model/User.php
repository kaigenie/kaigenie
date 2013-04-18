<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/14/13
 * Time: 8:42 PM
 * To change this template use File | Settings | File Templates.
 */

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel{

    public function beforeSave($option = array()){
        if(isset($this->data[$this->alias]['password'])){
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }

    }

}