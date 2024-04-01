<div class="postAds form">
<?php echo $this->Form->create('PostAd'); ?>
	<fieldset>
		<legend><?php echo __('Edit Post Ad'); ?></legend>
	<?php
		echo $this->Form->input('adv_id');
		echo $this->Form->input('category_id');
		echo $this->Form->input('sub_cat_id');
		echo $this->Form->input('adv_name');
		echo $this->Form->input('adv_details');
		echo $this->Form->input('adv_img');
		echo $this->Form->input('adv_brand_id');
		echo $this->Form->input('adv_model_id');
		echo $this->Form->input('product_cond');
		echo $this->Form->input('price');
		echo $this->Form->input('currency');
		echo $this->Form->input('quantity');
		echo $this->Form->input('payment_mode');
		echo $this->Form->input('delivery_method');
		echo $this->Form->input('time_required');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PostAd.adv_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PostAd.adv_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Post Ads'), array('action' => 'index')); ?></li>
	</ul>
</div>
