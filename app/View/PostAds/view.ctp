<div class="postAds view">
<h2><?php echo __('Post Ad'); ?></h2>
	<dl>
		<dt><?php echo __('Adv Id'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['adv_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Id'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['category_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sub Cat Id'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['sub_cat_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Adv Name'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['adv_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Adv Details'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['adv_details']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Adv Img'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['adv_img']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Adv Brand Id'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['adv_brand_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Adv Model Id'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['adv_model_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Cond'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['product_cond']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currency'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Mode'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['payment_mode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Delivery Method'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['delivery_method']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time Required'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['time_required']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($postAd['PostAd']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Post Ad'), array('action' => 'edit', $postAd['PostAd']['adv_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Post Ad'), array('action' => 'delete', $postAd['PostAd']['adv_id']), null, __('Are you sure you want to delete # %s?', $postAd['PostAd']['adv_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Post Ads'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post Ad'), array('action' => 'add')); ?> </li>
	</ul>
</div>
