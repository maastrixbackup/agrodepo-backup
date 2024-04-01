<?php //pr($salesQuestions);?>
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Park Question Reports</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
			<th><?php echo $this->Paginator->sort('question_id','SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'Posted By'); ?></th>
			<th><?php echo $this->Paginator->sort('park_type','Park Type'); ?></th>
			<th><?php echo $this->Paginator->sort('park_id', 'Park Name'); ?></th>
			<th><?php echo $this->Paginator->sort('question', 'Message'); ?></th>
            <th>Replied On</th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Sent Date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php
										//pr($salesQuestions);
										$pageno=$this->request->params['paging']['ParkQuestion']['page'];
									$perpage=$this->request->params['paging']['ParkQuestion']['limit'];
									if(!empty($questionRes))
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
										
										foreach($questionRes as $questionResult):
										$qid=$questionResult['ParkQuestion']['qid'];
									$submitedID=$questionResult['ParkQuestion']['user_id'];
									$submitedBY=$this->Custom->user_details($submitedID);
									$parkid=$questionResult['ParkQuestion']['park_id'];
									$parkDetail=$this->Custom->BapCustUniParkDetail($parkid);
									$parktype=$questionResult['ParkQuestion']['park_type'];
									$question=stripslashes($questionResult['ParkQuestion']['question']);
									$sentDate=date("d-m-Y", strtotime($questionResult['ParkQuestion']['created']));
									$parentID=$questionResult['ParkQuestion']['parent'];
									$repliedDetail=$this->Custom->BapCustUniParkParent($parentID);
										
										?>
	<tr>
		<td><?php echo $qstncount; ?>&nbsp;</td>
		<td><?php echo stripslashes($submitedBY['first_name'].' '. $submitedBY['last_name']);?>
		</td>
		<td><?php if($parktype==1){echo "Parcuri dezmembrări";}else{echo "Firme piese";}?>&nbsp;</td>
		<td> <a href="<?php echo $base_url;?>pages/parks/<?php echo stripslashes($parkDetail['SalesPark']['slug']);?>" title="<?php echo stripslashes($parkDetail['SalesPark']['park_name']);?>" target="_blank"><strong><?php echo stripslashes($parkDetail['SalesPark']['park_name']);?></strong></a>&nbsp;</td>
		<td><?php echo $question;?></td>
        <td><?php if(count($repliedDetail)>0){echo $repliedDetail['ParkQuestion']['question'];}else{echo "N/A";}?></td>
		<td><?php
			$status=array("1"=>"Active","2"=>"Inactive");
			echo $status[$questionResult['ParkQuestion']['status']];
		
		 ?>&nbsp;
		 </td>
		<td><?php echo date('d-m-Y',strtotime($questionResult['ParkQuestion']['created'])); ?>&nbsp;</td>
		<td class="actions">
			<a href="<?php echo $base_url;?>admin/Reports/viewquestionimage/imageof:parks/qid:<?=$questionResult['ParkQuestion']['qid']?>"class="btn primary">View Image</a>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'parkqs_delete', $questionResult['ParkQuestion']['qid']), null, __('Are you sure you want to delete # %s?', $questionResult['ParkQuestion']['qid'])); ?>
			
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