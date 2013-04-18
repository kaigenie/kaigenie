<!-- Views/AdminUsers/add.ctp -->

<h1>Add Administrator</h1>

<?php
    echo $this->Form->create('User');
    echo $this->Form->input('username', array('label' => 'Username'));
//    echo $this->Form->input('admFirstName', array('label' => 'First Name'));
//    echo $this->Form->input('admLastName', array('label' => 'Last Name'));
    echo $this->Form->input('password', array('type' => 'password',
                                                 'label' => 'Password'));
    echo $this->Form->input('email', array('label' => 'Email Address'));
    echo $this->Form->end('Add');

?>