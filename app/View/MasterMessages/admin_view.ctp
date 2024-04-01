<div class="masterMessages view">
<h2><?php echo __('Master Message'); ?></h2>
	<dl>
		<dt><?php echo __('Msg Id'); ?></dt>
		<dd>
			<?php echo h($masterMessage['MasterMessage']['msg_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Msg Name'); ?></dt>
		<dd>
			<?php echo h($masterMessage['MasterMessage']['msg_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Msg'); ?></dt>
		<dd>
			<?php echo h($masterMessage['MasterMessage']['msg']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Master Message'), array('action' => 'edit', $masterMessage['MasterMessage']['msg_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Master Message'), array('action' => 'delete', $masterMessage['MasterMessage']['msg_id']), null, __('Are you sure you want to delete # %s?', $masterMessage['MasterMessage']['msg_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Master Messages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Master Message'), array('action' => 'add')); ?> </li>
	</ul>
</div>
