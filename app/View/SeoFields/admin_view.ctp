<div class="seoFields view">
<h2><?php echo __('Seo Field'); ?></h2>
	<dl>
		<dt><?php echo __('Seo Id'); ?></dt>
		<dd>
			<?php echo h($seoField['SeoField']['seo_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page Name'); ?></dt>
		<dd>
			<?php echo h($seoField['SeoField']['page_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Title'); ?></dt>
		<dd>
			<?php echo h($seoField['SeoField']['meta_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Desc'); ?></dt>
		<dd>
			<?php echo h($seoField['SeoField']['meta_desc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Keyword'); ?></dt>
		<dd>
			<?php echo h($seoField['SeoField']['meta_keyword']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($seoField['SeoField']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($seoField['SeoField']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Seo Field'), array('action' => 'edit', $seoField['SeoField']['seo_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Seo Field'), array('action' => 'delete', $seoField['SeoField']['seo_id']), null, __('Are you sure you want to delete # %s?', $seoField['SeoField']['seo_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Seo Fields'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Field'), array('action' => 'add')); ?> </li>
	</ul>
</div>
