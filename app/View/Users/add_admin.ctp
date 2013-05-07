<h1>Add Account Administrator</h1>

<?php
echo $this->Form->create('User');
echo $this->Form->input('username', array('label' => 'Username'));
echo $this->Form->input('first_name', array('label' => 'First Name'));
echo $this->Form->input('last_name', array('label' => 'Last Name'));
echo $this->Form->input('email', array('label' => 'Email Address'));
echo $this->Form->end('Add');

?>