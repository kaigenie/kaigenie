<!-- Views/Account/add.ctp -->

<h1>Add an Account</h1>

<?php
echo $this->Form->create('Account');
echo $this->Form->input('name', array('label' => 'Name'));

echo $this->Form->input('country', array('label' => 'Country'));
echo $this->Form->input('state', array('label' => 'State'));
echo $this->Form->input('city', array('label' => 'City'));
echo $this->Form->input('street', array('label' => 'Street'));
echo $this->Form->input('zipcode', array('label' => 'Zip Code'));

echo $this->Form->input('telephone', array('label' => 'Telephone'));
echo $this->Form->input('mobile_num', array('label' => 'Mobile Phone'));


echo $this->Form->end('Add');

?>