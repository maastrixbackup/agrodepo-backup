  <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Credits</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('credit_id', 'SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'User Name'); ?></th>
			<th><?php echo $this->Paginator->sort('member_type', 'Last Transaction ID'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_method', 'Total Credits'); ?></th>
            <th><?php echo $this->Paginator->sort('modified', 'Credits Date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php 
	$pageno=$this->request->params['paging']['UserCreditAccount']['page'];
	$perpage=$this->request->params['paging']['UserCreditAccount']['limit'];
	if(!empty($creditres))
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
	foreach ($creditres as $creditResult): ?>
	<tr>
		<td><?php echo $qstncount; ?>&nbsp;</td>
		<td><?php $userdetails=$this->Custom->BapUserDetails($creditResult['UserCreditAccount']['user_id']);
		if(!empty($userdetails)){echo $userdetails['MasterUser']['first_name'].' '.$userdetails['MasterUser']['last_name'];}
		 ?>&nbsp;</td>
		<td><?php echo md5($creditResult['UpgradeMembership']['transfer_id']); ?>&nbsp;</td>

		<td><?php
		echo $creditResult['UserCreditAccount']['credits'];
		  ?>
         <?php /*?> <select name="status" id="status" onchange="return status(this.value,<?php echo $payment['Payment']['upgrade_id'];?>);">
          <option value="0" <?php if($payment['Payment']['plan_status']==0){?> selected="selected"<?php }?>>Pending</option>
          <option value="1" <?php if($payment['Payment']['plan_status']==1){?> selected="selected"<?php }?>>Approved</option>
          </select><?php */?>
          &nbsp;</td>
        <td><?php echo date("d-m-Y", strtotime($creditResult['UserCreditAccount']['modified'])); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Add Credits'), array('action' => 'add_credit', $creditResult['UserCreditAccount']['credit_id'])); ?>
            <?php echo $this->Html->link(__('All Credits List'), array('action' => 'credits_list', $creditResult['UserCreditAccount']['credit_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $creditResult['UserCreditAccount']['credit_id']), null, __('Are you sure you want to delete # %s?', $userdetails['MasterUser']['first_name'].' '.$userdetails['MasterUser']['last_name'])); ?>
		</td>
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
