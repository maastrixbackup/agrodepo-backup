 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage SEO Pages</h3>
                                    <?php /*?><div class="box-tools">
                                        <div class="input-group">
                                        <input type="text" placeholder="Search User" name="searchtxt" id="searchtxt" onkeypress='enterSrch(event);' value="<?php echo @$searchtxt;?>"  class="form-control input-sm pull-right" style="width: 150px; margin-right:5px;" >
    
                                   <div class="input-group-btn">
                              &nbsp;&nbsp; <button  type="button" name="searchbutn"  class="btn btn-sm btn-default" id="searchbutn" onclick="return searchTxt();">Search</button>
                                              
                                            </div>
                                        </div>
                                     
	</div><?php */?>
                                   </div>
                                </div><!-- /.box-header -->
                                 
     <div class="box-body table-responsive no-padding">
                                    
                                   <table class="table table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('seo_id', 'SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('page_name', 'Page Name'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_title', 'Meta Title'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_desc', 'Meta Description'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_keyword', 'Meta Keywords'); ?></th>
			<?php /*?><th><?php echo $this->Paginator->sort('created', 'Create Date'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modified Date'); ?></th><?php */?>
			<th class="actions" style="width:160px;"><?php echo __('Actions'); ?></th>
	</tr>
	<?php 
	$pageno=$this->request->params['paging']['SeoField']['page'];
	$perpage=$this->request->params['paging']['SeoField']['limit'];
	if(!empty($seoFields))
	{
		if($pageno!=1)
		{
			
			$seofldCount=$perpage*$pageno;
			$seofldCount=($seofldCount-$perpage)+1;
		}
		else
		{
			$seofldCount=1;	
		} 
	foreach ($seoFields as $seoField): ?>
	<tr>
		<td><?php echo $seofldCount; ?>&nbsp;</td>
		<td><?php echo stripslashes($seoField['SeoField']['page_name']); ?>&nbsp;</td>
		<td><?php echo stripslashes($seoField['SeoField']['meta_title']); ?>&nbsp;</td>
		<td><?php echo stripslashes($seoField['SeoField']['meta_desc']); ?>&nbsp;</td>
		<td><?php echo stripslashes($seoField['SeoField']['meta_keyword']); ?>&nbsp;</td>
		<?php /*?><td><?php echo stripslashes($seoField['SeoField']['created']); ?>&nbsp;</td>
		<td><?php echo stripslashes($seoField['SeoField']['modified']); ?>&nbsp;</td><?php */?>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $seoField['SeoField']['seo_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $seoField['SeoField']['seo_id'])); ?>
			<?php /*echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $seoField['SeoField']['seo_id']), null, __('Are you sure you want to delete # %s?', $seoField['SeoField']['page_name']));*/ ?>
		</td>
	</tr>
<?php
$seofldCount++;
 endforeach;

	}
 ?>
	</table>
                                </div><!-- /.box-body -->
	
	 </div><!-- /.box -->
         <div class="clearfix"></div>
             
                <div class="float_left">
                <?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>	
                </div>
                
                <div class="paging">
            <?php
echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>
            
            
            </div>
    </div>
</div>
</section><!-- /.content -->