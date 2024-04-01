  <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Credits List</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('credits_by', 'Credited By'); ?></th>
            <th><?php echo $this->Paginator->sort('credits', 'Credits'); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Credits Date'); ?></th>
	</tr>
	<?php 
	$pageno=$this->request->params['paging']['AddCredit']['page'];
	$perpage=$this->request->params['paging']['AddCredit']['limit'];
	if(!empty($creditsList))
	{
		if($pageno!=1)
		{
			
			$qstncount=$perpage*$pageno;
			$qstncount=($qstncount-$perpage)+1;
		}
		else
		{
			$qstncount=1;	
		} 
	foreach ($creditsList as $creditResult): ?>
	<tr>
		<td><?php echo $qstncount; ?>&nbsp;</td>
		<td><?php if($creditResult['AddCredit']['credits_by']==1){echo "Admin";}else{echo "User";} ?>&nbsp;</td>

		<td><?php
		echo $creditResult['AddCredit']['credits'];
		  ?>
         <?php /*?> <select name="status" id="status" onchange="return status(this.value,<?php echo $payment['Payment']['upgrade_id'];?>);">
          <option value="0" <?php if($payment['Payment']['plan_status']==0){?> selected="selected"<?php }?>>Pending</option>
          <option value="1" <?php if($payment['Payment']['plan_status']==1){?> selected="selected"<?php }?>>Approved</option>
          </select><?php */?>
          &nbsp;</td>
        <td><?php echo date("d-m-Y", strtotime($creditResult['AddCredit']['created'])); ?>&nbsp;</td>
	</tr>
 <?php 
	$qstncount++;
	endforeach;
}else{?>
<tr><td>No Payment Found</td></tr>
<?php }?>
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
