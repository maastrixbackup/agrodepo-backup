 <script type="text/javascript">
 function status(statusval,paymentid)
 {
	 if(statusval!='')
	 {
		 $.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url;?>Payments/changeStatus',
				data: 'status=yes&statusval='+statusval+'&paymentid='+paymentid,
				success: function(data) {
					//alert(data);
					if(data==1)
					{
						alert("Status Updated Successfully");
					}
					else
					{
						alert("Status Updating failed");
					}
				}
			});

	 }
 }
 </script>
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Membership Payment report</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('upgrade_id', 'SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'User Name'); ?></th>
			<th><?php echo $this->Paginator->sort('member_type', 'Membership Plan'); ?></th>
			<th>Current Plan</th>
			<th><?php echo $this->Paginator->sort('payment_status'); ?></th>
			<th><?php echo $this->Paginator->sort('transfer_id', 'Transaction ID'); ?></th>
			<th><?php echo $this->Paginator->sort('plan_status', 'Status'); ?></th>
			<th><?php echo $this->Paginator->sort('price', 'Amount'); ?></th>
			<th><?php echo $this->Paginator->sort('credit', 'Credits'); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php 
	$pageno=$this->request->params['paging']['Payment']['page'];
	$perpage=$this->request->params['paging']['Payment']['limit'];
	if(!empty($payments))
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
	foreach ($payments as $payment): ?>
	<tr>
		<td><?php echo $qstncount; ?>&nbsp;</td>
		<td><?php $userdetails=$this->Custom->BapUserDetails($payment['Payment']['user_id']);
		if(!empty($userdetails)){echo $userdetails['MasterUser']['first_name'].' '.$userdetails['MasterUser']['last_name'];}
		 ?>&nbsp;</td>
		<td><?php 
		$memdetails=$this->Custom->getMemberByID($payment['Payment']['member_type']);
		if(!empty($memdetails)){echo $memdetails['UserMembership']['memb_type'];}
		 ?>&nbsp;</td>
		<td><?php
		$curplan=$this->Custom->curentPlan($payment['Payment']['upgrade_id']);
		if($curplan>0){?><img src="<?php echo $base_url;?>images/success_icon.png" alt="current" /><?php }else{?><img src="<?php echo $base_url;?>images/cancel_icon.png" alt="Expired" /><?php }
		  ?>&nbsp;</td>
		
		<td>
		<?php
		$methodarr=array(0=>'Pending', 1=> 'Paid');
		 echo $methodarr[$payment['Payment']['payment_status']];
		  ?>
          &nbsp;</td>
		<td><?php echo md5($payment['Payment']['transfer_id']); ?>&nbsp;</td>

		<td><?php
		$statusarr=array(0=>'Pending', 1=> 'Approved');
		 echo $statusarr[$payment['Payment']['plan_status']];
		  ?>
         <?php /*?> <select name="status" id="status" onchange="return status(this.value,<?php echo $payment['Payment']['upgrade_id'];?>);">
          <option value="0" <?php if($payment['Payment']['plan_status']==0){?> selected="selected"<?php }?>>Pending</option>
          <option value="1" <?php if($payment['Payment']['plan_status']==1){?> selected="selected"<?php }?>>Approved</option>
          </select><?php */?>
          &nbsp;</td>
		<td><?php echo h($payment['Payment']['price']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['credit']); ?>&nbsp;</td>
        <td><?php echo date("d-m-Y", strtotime($payment['Payment']['created'])); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $payment['Payment']['upgrade_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $payment['Payment']['upgrade_id']), null, __('Are you sure you want to delete # %s?', $userdetails['MasterUser']['first_name'].' '.$userdetails['MasterUser']['last_name'])); ?>
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
