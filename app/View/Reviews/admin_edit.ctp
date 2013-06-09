<div class="reviews form">
<?php echo $this->Form->create('Review'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Review'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('account_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('comment');
		echo $this->Form->input('status');
		echo $this->Form->input('gene_rating');
		echo $this->Form->input('service_rating');
		echo $this->Form->input('envi_rating');
		echo $this->Form->input('food_rating');
		echo $this->Form->input('suggest_item');
		echo $this->Form->input('modifiedBy');
		echo $this->Form->input('note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Review.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Review.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Reviews'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Review Images'), array('controller' => 'review_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review Image'), array('controller' => 'review_images', 'action' => 'add')); ?> </li>
	</ul>
</div>
