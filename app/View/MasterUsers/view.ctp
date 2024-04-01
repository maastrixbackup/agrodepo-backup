<div class="masterUsers view">
<h2><?php echo __('Master User'); ?></h2>
	<dl>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['full_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pass'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['pass']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telephone'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['telephone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country Id'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['country_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality Id'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['locality_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Type'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['user_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Actve'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['is_actve']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Admin'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['is_admin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($masterUser['MasterUser']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Master User'), array('action' => 'edit', $masterUser['MasterUser']['user_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Master User'), array('action' => 'delete', $masterUser['MasterUser']['user_id']), null, __('Are you sure you want to delete # %s?', $masterUser['MasterUser']['user_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Master Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Master User'), array('action' => 'add')); ?> </li>
	</ul>
</div>
