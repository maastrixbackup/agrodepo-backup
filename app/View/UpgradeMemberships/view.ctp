<div class="upgradeMemberships view">
<h2><?php echo __('Upgrade Membership'); ?></h2>
	<dl>
		<dt><?php echo __('Upgrade Id'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['upgrade_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Member Type'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['member_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Method'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['payment_method']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Name'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['company_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('County'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['county']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping Different'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['shipping_different']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping Name'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['shipping_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping Email'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['shipping_email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping Phone'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['shipping_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping Company'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['shipping_company']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping County'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['shipping_county']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping City'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['shipping_city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping Zip'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['shipping_zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Status'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['payment_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transfer Id'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['transfer_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plan Status'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['plan_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Credit'); ?></dt>
		<dd>
			<?php echo h($upgradeMembership['UpgradeMembership']['credit']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Upgrade Membership'), array('action' => 'edit', $upgradeMembership['UpgradeMembership']['upgrade_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Upgrade Membership'), array('action' => 'delete', $upgradeMembership['UpgradeMembership']['upgrade_id']), null, __('Are you sure you want to delete # %s?', $upgradeMembership['UpgradeMembership']['upgrade_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Upgrade Memberships'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Upgrade Membership'), array('action' => 'add')); ?> </li>
	</ul>
</div>
