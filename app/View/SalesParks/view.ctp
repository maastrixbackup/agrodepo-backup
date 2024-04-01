<div class="salesParks view">
<h2><?php echo __('Sales Park'); ?></h2>
	<dl>
		<dt><?php echo __('Park Id'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['park_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Add Type'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['add_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Park Name'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['park_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comp Name'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['comp_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vat'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['vat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country Id'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['country_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location Id'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['location_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postal Code'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['postal_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['street']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nr'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['nr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Other Add'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['other_add']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logo'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['logo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fleet Pics'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['fleet_pics']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Warranty Detail'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['warranty_detail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Brand Id'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['brand_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Person'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['contact_person']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($salesPark['SalesPark']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sales Park'), array('action' => 'edit', $salesPark['SalesPark']['park_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sales Park'), array('action' => 'delete', $salesPark['SalesPark']['park_id']), null, __('Are you sure you want to delete # %s?', $salesPark['SalesPark']['park_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales Parks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sales Park'), array('action' => 'add')); ?> </li>
	</ul>
</div>
