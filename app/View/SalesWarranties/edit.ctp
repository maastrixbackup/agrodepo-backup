<div class="salesWarranties form">
<?php echo $this->Form->create('SalesWarranty'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sales Warranty'); ?></legend>
	<?php
		echo $this->Form->input('warranty_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('disclaimer_of_warranty');
		echo $this->Form->input('discaimer_warranty_mth');
		echo $this->Form->input('terms_of_warranty');
		echo $this->Form->input('return_policy');
		echo $this->Form->input('return_policy_days');
		echo $this->Form->input('method_return_accepted');
		echo $this->Form->input('transportation_cost');
		echo $this->Form->input('return_policy_info');
		echo $this->Form->input('personal_teaching');
		echo $this->Form->input('courier');
		echo $this->Form->input('courier_cost');
		echo $this->Form->input('free_courier');
		echo $this->Form->input('romanian_mail');
		echo $this->Form->input('romanian_cost');
		echo $this->Form->input('free_romanian');
		echo $this->Form->input('time_required');
		echo $this->Form->input('sending_package');
		echo $this->Form->input('payment_methos');
		echo $this->Form->input('product_condition');
		echo $this->Form->input('invoice');
		echo $this->Form->input('message_response');
		echo $this->Form->input('message_content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SalesWarranty.warranty_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SalesWarranty.warranty_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sales Warranties'), array('action' => 'index')); ?></li>
	</ul>
</div>
