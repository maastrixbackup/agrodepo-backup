<div class="requestParts view">
<h2><?php echo __('Request Part'); ?></h2>
	<dl>
		<dt><?php echo __('Request Id'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['request_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Brand Id'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['brand_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model Id'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['model_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Version'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['version']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Yr Of Manufacture'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['yr_of_manufacture']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Engines'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['engines']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vehicle Identy No'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['vehicle_identy_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('I Offer Parts'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['i_offer_parts']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('County'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['county']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($requestPart['RequestPart']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Request Part'), array('action' => 'edit', $requestPart['RequestPart']['request_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Request Part'), array('action' => 'delete', $requestPart['RequestPart']['request_id']), null, __('Are you sure you want to delete # %s?', $requestPart['RequestPart']['request_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Request Parts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request Part'), array('action' => 'add')); ?> </li>
	</ul>
</div>
