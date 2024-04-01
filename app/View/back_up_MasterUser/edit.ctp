<div class="masterUsers form">
<?php echo $this->Form->create('MasterUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Master User'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('full_name');
		echo $this->Form->input('email');
		echo $this->Form->input('pass');
		echo $this->Form->input('telephone');
		echo $this->Form->input('country_id');
		echo $this->Form->input('locality_id');
		echo $this->Form->input('user_type');
		echo $this->Form->input('is_actve');
		echo $this->Form->input('is_admin');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MasterUser.user_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MasterUser.user_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Master Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
