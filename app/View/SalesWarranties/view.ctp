<div class="salesWarranties view">
<h2><?php echo __('Sales Warranty'); ?></h2>
	<dl>
		<dt><?php echo __('Warranty Id'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['warranty_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Disclaimer Of Warranty'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['disclaimer_of_warranty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Discaimer Warranty Mth'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['discaimer_warranty_mth']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Terms Of Warranty'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['terms_of_warranty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Return Policy'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['return_policy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Return Policy Days'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['return_policy_days']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Method Return Accepted'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['method_return_accepted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transportation Cost'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['transportation_cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Return Policy Info'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['return_policy_info']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Personal Teaching'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['personal_teaching']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Courier'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['courier']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Courier Cost'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['courier_cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Free Courier'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['free_courier']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Romanian Mail'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['romanian_mail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Romanian Cost'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['romanian_cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Free Romanian'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['free_romanian']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time Required'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['time_required']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sending Package'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['sending_package']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Methos'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['payment_methos']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Condition'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['product_condition']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invoice'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['invoice']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message Response'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['message_response']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message Content'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['message_content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($salesWarranty['SalesWarranty']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sales Warranty'), array('action' => 'edit', $salesWarranty['SalesWarranty']['warranty_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sales Warranty'), array('action' => 'delete', $salesWarranty['SalesWarranty']['warranty_id']), null, __('Are you sure you want to delete # %s?', $salesWarranty['SalesWarranty']['warranty_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales Warranties'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sales Warranty'), array('action' => 'add')); ?> </li>
	</ul>
</div>
