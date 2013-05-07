<h2><?php echo __('Add Category') ?></h2>

<?php
echo $this->Form->create('Category');
echo $this->Form->input('name', array(
  'label'=> __('Category Name'),
));

echo $this->Form->input('description', array(
  'label'=> __('Description'),
  'type' => 'textarea',
  'rows' => 3,
  'cols' => 5
));

echo $this->Form->end('Create');
?>