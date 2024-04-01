<?php //pr($salesQuestions);?>
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Ask Seller</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th><?php echo $this->Paginator->sort('qid','SL#'); ?></th>
                                            <th><?php echo $this->Paginator->sort('user_id', 'Sent By'); ?></th>
                                            <th><?php echo $this->Paginator->sort('to_id', 'Sent To'); ?></th>
                                            <th><?php echo $this->Paginator->sort('bidid','Offer Name'); ?></th>
                                            <th><?php echo $this->Paginator->sort('parts_id', 'Request Parts'); ?></th>
                                            <th><?php echo $this->Paginator->sort('description', 'Question'); ?></th>
                                            <th><?php echo $this->Paginator->sort('status'); ?></th>
                                            <th><?php echo $this->Paginator->sort('created','Created Date'); ?></th>
                                            <th class="actions"><?php echo __('Actions'); ?></th>
                                    </tr>
                                        <?php
										//pr($salesQuestions);
										$pageno=$this->request->params['paging']['BidQuestion']['page'];
									$perpage=$this->request->params['paging']['BidQuestion']['limit'];
									if(!empty($salesQuestions))
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
										
										foreach ($salesQuestions as $salesQuestion): 
										
										?>
	<tr>
		<td><?php echo $qstncount; ?>&nbsp;</td>
		<td>
		<a href="<?php echo $base_url;?>admin/ManageUsers/view/<?php echo $salesQuestion['BidQuestion']['user_id'];?>" target="_blank"><?php $user_details= $this->Custom->user_details($salesQuestion['BidQuestion']['user_id']);
		echo $user_details['first_name'].' '.$user_details['last_name'];
		?></a>
		</td>
        <td>
		<a href="<?php echo $base_url;?>admin/ManageUsers/view/<?php echo $salesQuestion['BidQuestion']['to_id'];?>" target="_blank"><?php $userdetails= $this->Custom->user_details($salesQuestion['BidQuestion']['to_id']);
		echo $userdetails['first_name'].' '.$userdetails['last_name'];
		?></a>
		</td>
		<td><?php $bidDetail=$this->Custom->BapCustUniBidDetail($salesQuestion['BidQuestion']['bidid']);
		if(!empty($bidDetail)){echo $bidDetail['BidOffer']['piece'];}
		?>&nbsp;</td>
		<td><?php $parts_detail=$this->Custom->BapCustUniPartsDetail($salesQuestion['BidQuestion']['parts_id']);
			if(!empty($parts_detail)){echo stripslashes($parts_detail['RequestAccessory']['name_piece']);}
		 ?>&nbsp;</td>
		<td><?php echo $salesQuestion['BidQuestion']['description']; ?></td>
		<td><?php
			$status=array("1"=>"Active","2"=>"Inactive");
			echo $this->Form->input("is_active",array("options"=>$status,'label'=>false, 'id' => 'questionStatus'.$salesQuestion['BidQuestion']['qid'],'onchange'=>'changeStatus(this.value, '.$salesQuestion['BidQuestion']['qid'].')','selected'=>@$salesQuestion['BidQuestion']['status']));
		
		 ?>&nbsp;
		 </td>
		<td><?php echo date('d/m/Y',strtotime($salesQuestion['BidQuestion']['created'])); ?>&nbsp;</td>
		<td class="actions">
			<a href="<?php echo $base_url;?>admin/Reports/viewquestionimage/imageof:bidoffer/qid:<?=$salesQuestion['BidQuestion']['qid']?>"class="btn primary">View Image</a>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'ask_seller_delete', $salesQuestion['BidQuestion']['qid']), null, __('Are you sure you want to delete # %s?', $salesQuestion['BidQuestion']['qid'])); ?>
			
		</td>
	</tr>

                                        <?php 
										$qstncount++;
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




<script type='text/javascript'>
function changeStatus(statusval, id){
$.ajax(
	{
		type: 'POST',
		url: '<?php echo $base_url;?>Reports/ask_seller_status',
		data: 'status='+statusval+'&ask_id='+id,
		success: function(data) {
			//alert(data);
			if(data==1)
			{
				alert("Status Update successfully");
			}
			else
			{
				alert("Status Updating Failed");
			}
		}
	});		
}


</script>
