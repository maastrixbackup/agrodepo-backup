<?php //pr($salesQuestions);?>
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Ask Question Reports</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
			<th><?php echo $this->Paginator->sort('question_id','SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'Posted By'); ?></th>
			<th><?php echo $this->Paginator->sort('adv_id','Sales Name'); ?></th>
			<th><?php echo $this->Paginator->sort('question'); ?></th>
			<th><?php echo $this->Paginator->sort('parent'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Created Date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php
										//pr($salesQuestions);
										$pageno=$this->request->params['paging']['SalesQuestion']['page'];
									$perpage=$this->request->params['paging']['SalesQuestion']['limit'];
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
		<td><?php $user_details= $this->Custom->user_details($salesQuestion['SalesQuestion']['user_id']);
		echo $user_details['first_name'].' '.$user_details['last_name'];
		?>
		</td>
		<td><?php $advt= $this->Custom->BapCustUniAdvDetail($salesQuestion['SalesQuestion']['adv_id']);
		//pr($advt);
		echo $advt['PostAd']['adv_name'];
		?>&nbsp;</td>
		<td><?php echo h($salesQuestion['SalesQuestion']['question']); ?>&nbsp;</td>
		<td><?php $question= $this->Custom->getSalesQuestion($salesQuestion['SalesQuestion']['parent']); 
		echo $question['question'];
		?></td>
		<td><?php
			$status=array("1"=>"Active","2"=>"Inactive");
			echo $this->Form->input($salesQuestion['SalesQuestion']['question_id']."_is_active",array("options"=>$status,'label'=>false,'onchange'=>'changeStatus(this.id)','selected'=>@$salesQuestion['SalesQuestion']['status']));
		
		 ?>&nbsp;
		 </td>
		<td><?php echo date('d/m/Y',strtotime($salesQuestion['SalesQuestion']['created'])); ?>&nbsp;</td>
		<td class="actions">
			<a href="<?php echo $base_url;?>admin/Reports/viewquestionimage/imageof:sales/qid:<?=$salesQuestion['SalesQuestion']['question_id']?>"class="btn primary">View Image</a>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'ask_qstn_delete', $salesQuestion['SalesQuestion']['question_id']), null, __('Are you sure you want to delete # %s?', $salesQuestion['SalesQuestion']['question_id'])); ?>
			
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
function changeStatus(id){
	var status=$("#"+id).val();
	var id=id.substring(0,id.indexOf("_"));
	var url="<?php echo $this->webroot.'admin/Reports/chngStatus/'; ?>";
	$.post(url,{'id':id,'status':status,'model':'SalesQuestion'},function(res){
		if(res==1){
			alert("Status Updated successfully");
		}else{
			alert("Status not updated");
		}
	});
		
}


</script>
