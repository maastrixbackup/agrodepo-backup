 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Email Template</h3>
                                  <div class="box-tools pull-right">
                                  <button class="btn btn-primary btn-flat" onclick="location.href='<?php echo $base_url;?>admin/EmailTemplates/add'">Add New</button>
                                       
                                </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
			<th><?php echo $this->Paginator->sort('compose_id','SL#'); ?></th>
            <th><?php echo $this->Paginator->sort('email_of', 'Assign To'); ?></th>
			<th><?php echo $this->Paginator->sort('mail_subject', 'Subject'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php
										$pageno=$this->request->params['paging']['EmailTemplate']['page'];
									$perpage=$this->request->params['paging']['EmailTemplate']['limit'];
									
									if(!empty($emailTemplates))
									{
										if($pageno!=1)
										{
											
											$nlcount=$perpage*$pageno;
											$nlcount=($nlcount-$perpage)+1;
										}
										else
										{
											$nlcount=1;	
										} 
										foreach ($emailTemplates as $emailTemplate): ?>
                                       <tr>
		<td><?php echo $nlcount; ?>&nbsp;</td>
        <td><?php 
		$usertype=array(1 => 'Register for User', 2 =>'Forgot password', 3 => 'User Past Ad Order',4 => 'User Register for Admin', 5 => 'Admin Past Ad Order', 6 => 'Seller Past Ad Order', 7 => 'Parts Request Question(parent)', 8 => 'Parts Request Question(sub question)', 9 => 'Bid Offer', 10 => 'Sales Question', 11 => 'Parts Order to User', 12 => 'Parts Order to Bidder', 13 => 'Parts Order to Admin', 14 => 'Subscribe Alert for ad', 15 => 'Subscribe Alert for Request Parts');
		echo $usertype[$emailTemplate['EmailTemplate']['email_of']];
		?>&nbsp;</td>
		<td><?php
			echo $emailTemplate['EmailTemplate']['mail_subject'];
		 ?>&nbsp;</td>
		<td><?php 
		$status=array('0'=>'Inactive','1'=>'Active');
		echo $status[$emailTemplate['EmailTemplate']['compose_status']];
		?>&nbsp;</td>		
		<td class="actions">
		<?php echo $this->Html->link(__('View'), array('action' => 'view', $emailTemplate['EmailTemplate']['compose_id'])); ?>
         <?php
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $emailTemplate['EmailTemplate']['compose_id']));
		?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $emailTemplate['EmailTemplate']['compose_id']), null, __('Are you sure you want to delete # %s?', $emailTemplate['EmailTemplate']['mail_subject'])); ?>
		</td>
	</tr>
                                        <?php 
										$nlcount++;
										endforeach;
									}?>
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

<script>
function changeStatus(id){
	var news_letter_id=id.substring(0,id.indexOf('_'));
	var status=$("#"+id).val();
	var url="<?php echo $this->webroot.'NewsLetters/changeStatus'; ?>";
	$.post(url,{'news_letter_id':news_letter_id,'status':status},function(res){
		if(res==1){
			alert("Status Updated successfully");
		}else{
			alert("Status not updated");
		}
	});
}
</script>
