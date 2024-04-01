<?php //pr($parts_lists);?>
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Parts List Reports</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
			<th><?php echo $this->Paginator->sort('part_id','SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('name_piece', 'Name'); ?></th>
			<th><?php echo $this->Paginator->sort('description','description'); ?></th>
			<th><?php echo $this->Paginator->sort('part_no'); ?></th>
			<th><?php echo $this->Paginator->sort('max_price','Price'); ?></th>
			<th><?php echo $this->Paginator->sort('currency'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php
										//pr($parts_lists);
										$pageno=$this->request->params['paging']['RequestAccessory']['page'];
									$perpage=$this->request->params['paging']['RequestAccessory']['limit'];
									if(!empty($parts_lists))
									{
										if($pageno!=1)
										{
											
											$plcount=$perpage*$pageno;
											$plcount=($plcount-$perpage)+1;
										}
										else
										{
											$plcount=1;	
										} 
										
										foreach ($parts_lists as $parts_list): 
										
										?>
	<tr>
		<td><?php echo $plcount; ?>&nbsp;</td>
		<!--<td><?php //$user_details= $this->Custom->user_details($parts_list['RequestAccessory']['user_id']);
		//echo $user_details['first_name'].' '.$user_details['last_name'];
		?>
		</td>-->
		<td><?php echo $parts_list['RequestAccessory']['name_piece'];
		?>&nbsp;</td>
		<td><?php echo $parts_list['RequestAccessory']['description'];
		?>&nbsp;</td>
		<td><?php echo h($parts_list['RequestAccessory']['part_no']); ?>&nbsp;</td>
		<td><?php echo $parts_list['RequestAccessory']['max_price']; 
		
		?></td>
		<td><?php echo h($parts_list['RequestAccessory']['currency']); ?>&nbsp;</td>
		<td><?php
			$status=array(0=>"Inactive",1=>"Active",2=>"Resolved");
			echo $this->Form->input($parts_list['RequestAccessory']['part_id']."_is_active",array("options"=>$status,'label'=>false,'onchange'=>'changeStatus(this.id)','selected'=>@$parts_list['RequestAccessory']['status']));
		
		 ?>&nbsp;
		 </td>
		
		<td class="actions">
			<?php
			$partsid=$parts_list['RequestAccessory']['part_id'];
			echo $this->Form->postLink(__('Delete'), array('action' => 'partlist_delete', $partsid), null, __('Are you sure you want to delete # %s?', $parts_list['RequestAccessory']['part_id'])); ?>
			
		</td>
	</tr>

                                        <?php 
										$plcount++;
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
	$.post(url,{'id':id,'status':status,'model':'RequestAccessory'},function(res){
		if(res==1){
			alert("Status Updated successfully");
		}else{
			alert("Status not updated");
		}
	});
		
}


</script>
