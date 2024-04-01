<?php //pr($requestParts);?>
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Request Parts Reports</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
			<th><?php echo $this->Paginator->sort('request_id','SL#'); ?></th>
            <th width="150px"><?php echo $this->Paginator->sort('name_piece','Name'); ?></th>
             <th><?php echo $this->Paginator->sort('user_id','Request By'); ?></th>
			<th><?php echo $this->Paginator->sort('brand_id', 'Brand'); ?></th>
			<th><?php echo $this->Paginator->sort('model_id','Model'); ?></th>
			<th><?php echo $this->Paginator->sort('version'); ?></th>
			<th><?php echo $this->Paginator->sort('yr_of_manufacture','Manufacture Year'); ?></th>
			<th><?php echo $this->Paginator->sort('engines'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Created Date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php
										//pr($requestParts);
										$pageno=$this->request->params['paging']['RequestPart']['page'];
									$perpage=$this->request->params['paging']['RequestPart']['limit'];
									if(!empty($requestParts))
									{
										if($pageno!=1)
										{
											
											$rpcount=$perpage*$pageno;
											$rpcount=($rpcount-$perpage)+1;
										}
										else
										{
											$rpcount=1;	
										} 
										
										foreach ($requestParts as $requestPart): 
										
										?>
	<tr>
		<td><?php echo $rpcount; ?>&nbsp;</td>
		<td><?php echo $requestPart['RequestAccessory']['name_piece'];
		?>&nbsp;</td>
         <td><?php 
		$userdeatils=$this->Custom->user_details($requestPart['RequestPart']['user_id']);
		echo stripslashes($userdeatils['first_name'].' '.$userdeatils['last_name']);
		?>&nbsp;</td>
		<td><?php echo $this->Custom->brand_nm($requestPart['RequestPart']['brand_id']);
		?>&nbsp;</td>
		<td><?php echo $this->Custom->brand_nm($requestPart['RequestPart']['model_id']);
		?>&nbsp;</td>
		<td><?php echo h($requestPart['RequestPart']['version']); ?>&nbsp;</td>
		<td><?php echo $requestPart['RequestPart']['yr_of_manufacture']; 
		
		?></td>
		<td><?php echo h($requestPart['RequestPart']['engines']); ?>&nbsp;</td>
		<td><?php
		
			$status=array(0=>"Pending",1=>"Active",2=>"Solved",3=>"Inactive");
			echo $this->Form->input($requestPart['RequestPart']['request_id']."_is_active",array("options"=>$status,'label'=>false,'onchange'=>'changeStatus(this.id)','selected'=>@$requestPart['RequestPart']['status']));
		
		 ?>&nbsp;
		 </td>
		<td><?php echo date('d/m/Y',strtotime($requestPart['RequestPart']['created'])); ?>&nbsp;</td>
		<td class="actions">
			
			<?php 
			echo $this->Form->postLink(__('View'), array('action' => 'view_part', $requestPart['RequestPart']['request_id']), null, null, $requestPart['RequestPart']['request_id']); 
			?> &nbsp;&nbsp;
			<?php
			echo $this->Form->postLink(__('Delete'), array('action' => 'request_parts_delete', $requestPart['RequestPart']['request_id']), null, __('Are you sure you want to delete # %s?', $requestPart['RequestPart']['request_id'])); ?>
			
		</td>
	</tr>

                                        <?php 
										$rpcount++;
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
	$.post(url,{'id':id,'status':status,'model':'RequestPart'},function(res){
		if(res==1){
			alert("Status Updated successfully");
		}else{
			alert("Status not updated");
		}
	});
		
}


</script>
