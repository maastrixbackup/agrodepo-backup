<div class="upgradeMemberships form">
<?php echo $this->Form->create('UpgradeMembership'); ?>
	<fieldset>
		<legend><?php echo __('Edit Upgrade Membership'); ?></legend>
	<?php
		echo $this->Form->input('upgrade_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('member_type');
		echo $this->Form->input('payment_method');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('company_name');
		echo $this->Form->input('county');
		echo $this->Form->input('city');
		echo $this->Form->input('zip');
		echo $this->Form->input('shipping_different');
		echo $this->Form->input('shipping_name');
		echo $this->Form->input('shipping_email');
		echo $this->Form->input('shipping_phone');
		echo $this->Form->input('shipping_company');
		echo $this->Form->input('shipping_county');
		echo $this->Form->input('shipping_city');
		echo $this->Form->input('shipping_zip');
		echo $this->Form->input('payment_status');
		echo $this->Form->input('transfer_id');
		echo $this->Form->input('plan_status');
		echo $this->Form->input('price');
		echo $this->Form->input('credit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UpgradeMembership.upgrade_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UpgradeMembership.upgrade_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Upgrade Memberships'), array('action' => 'index')); ?></li>
	</ul>
</div>
