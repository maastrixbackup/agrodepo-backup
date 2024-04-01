<div class="masterUsers index">
	<h2><?php echo __('Master Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('full_name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('pass'); ?></th>
			<th><?php echo $this->Paginator->sort('telephone'); ?></th>
			<th><?php echo $this->Paginator->sort('country_id'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_type'); ?></th>
			<th><?php echo $this->Paginator->sort('is_actve'); ?></th>
			<th><?php echo $this->Paginator->sort('is_admin'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($masterUsers as $masterUser): ?>
	<tr>
		<td><?php echo h($masterUser['MasterUser']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['full_name']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['email']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['pass']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['telephone']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['country_id']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['locality_id']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['user_type']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['is_actve']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['is_admin']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['created']); ?>&nbsp;</td>
		<td><?php echo h($masterUser['MasterUser']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $masterUser['MasterUser']['user_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $masterUser['MasterUser']['user_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $masterUser['MasterUser']['user_id']), null, __('Are you sure you want to delete # %s?', $masterUser['MasterUser']['user_id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Master User'), array('action' => 'add')); ?></li>
	</ul>
</div>
