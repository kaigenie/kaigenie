<h2>Add Feature</h2>
<?php
echo $this->Form->create('Feature');
echo $this->Form->input('name', array('required'=>'true'));
echo $this->Form->input('description');
echo $this->Form->end('Create');
?>