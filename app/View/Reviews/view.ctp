<div class="reviews view">
<h2><?php  echo __('Review'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($review['Review']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account'); ?></dt>
		<dd>
			<?php echo $this->Html->link($review['Account']['name'], array('controller' => 'accounts', 'action' => 'view', $review['Account']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($review['User']['id'], array('controller' => 'users', 'action' => 'view', $review['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($review['Review']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($review['Review']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gene Rating'); ?></dt>
		<dd>
			<?php echo h($review['Review']['gene_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Rating'); ?></dt>
		<dd>
			<?php echo h($review['Review']['service_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Envi Rating'); ?></dt>
		<dd>
			<?php echo h($review['Review']['envi_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Food Rating'); ?></dt>
		<dd>
			<?php echo h($review['Review']['food_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Suggest Item'); ?></dt>
		<dd>
			<?php echo h($review['Review']['suggest_item']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($review['Review']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($review['Review']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ModifiedBy'); ?></dt>
		<dd>
			<?php echo h($review['Review']['modifiedBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($review['Review']['note']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Review'), array('action' => 'edit', $review['Review']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Review'), array('action' => 'delete', $review['Review']['id']), null, __('Are you sure you want to delete # %s?', $review['Review']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reviews'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Review Images'), array('controller' => 'review_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review Image'), array('controller' => 'review_images', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Review Images'); ?></h3>
	<?php if (!empty($review['ReviewImage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Review Id'); ?></th>
		<th><?php echo __('Image Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($review['ReviewImage'] as $reviewImage): ?>
		<tr>
			<td><?php echo $reviewImage['id']; ?></td>
			<td><?php echo $reviewImage['review_id']; ?></td>
			<td><?php echo $reviewImage['image_id']; ?></td>
			<td><?php echo $reviewImage['created']; ?></td>
			<td><?php echo $reviewImage['updated']; ?></td>
			<td><?php echo $reviewImage['is_deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'review_images', 'action' => 'view', $reviewImage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'review_images', 'action' => 'edit', $reviewImage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'review_images', 'action' => 'delete', $reviewImage['id']), null, __('Are you sure you want to delete # %s?', $reviewImage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Review Image'), array('controller' => 'review_images', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
