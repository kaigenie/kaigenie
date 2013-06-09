<div class="reviews index">
	<h2><?php echo __('Reviews'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('account_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('gene_rating'); ?></th>
			<th><?php echo $this->Paginator->sort('service_rating'); ?></th>
			<th><?php echo $this->Paginator->sort('envi_rating'); ?></th>
			<th><?php echo $this->Paginator->sort('food_rating'); ?></th>
			<th><?php echo $this->Paginator->sort('suggest_item'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('modifiedBy'); ?></th>
			<th><?php echo $this->Paginator->sort('note'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($reviews as $review): ?>
	<tr>
		<td><?php echo h($review['Review']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($review['Account']['name'], array('controller' => 'accounts', 'action' => 'view', $review['Account']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($review['User']['id'], array('controller' => 'users', 'action' => 'view', $review['User']['id'])); ?>
		</td>
		<td><?php echo h($review['Review']['comment']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['status']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['gene_rating']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['service_rating']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['envi_rating']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['food_rating']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['suggest_item']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['created']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['modified']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['modifiedBy']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['note']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $review['Review']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $review['Review']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $review['Review']['id']), null, __('Are you sure you want to delete # %s?', $review['Review']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Review'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Review Images'), array('controller' => 'review_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review Image'), array('controller' => 'review_images', 'action' => 'add')); ?> </li>
	</ul>
</div>
