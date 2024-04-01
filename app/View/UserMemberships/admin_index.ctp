 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage User Memberships</h3>
                                   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
			<th><?php echo $this->Paginator->sort('memb_id','SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('memb_type','Membership Type'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('credits'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php
										$pageno=$this->request->params['paging']['UserMembership']['page'];
									$perpage=$this->request->params['paging']['UserMembership']['limit'];
									if(!empty($userMemberships))
									{
										if($pageno!=1)
										{
											
											$membercount=$perpage*$pageno;
											$membercount=($membercount-$perpage)+1;
										}
										else
										{
											$membercount=1;	
										} 
										foreach ($userMemberships as $userMembership): ?>
                                       <tr>
		<td><?php echo $membercount; ?>&nbsp;</td>
		<td><?php 
		echo $this->Html->link(__($userMembership['UserMembership']['memb_type']), array('action' => 'view', $userMembership['UserMembership']['memb_id']));
		?>&nbsp;</td>
		<td><?php echo h($userMembership['UserMembership']['price']); ?>&nbsp;</td>
		<td><?php echo h($userMembership['UserMembership']['credits']); ?>&nbsp;</td>
		<td><?php 
		$status=array('0'=>'Inactive','1'=>'Active');
		echo $this->Form->input($userMembership['UserMembership']['memb_id'].'_status',array('label'=>false,'options'=>$status,'selected'=>@$userMembership['UserMembership']['status'],'onchange'=>'changeStatus(this.id)'));
		//echo h($userMembership['UserMembership']['status']); ?>&nbsp;</td>
		<td><?php echo date('d/m/Y',strtotime($userMembership['UserMembership']['created'])); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userMembership['UserMembership']['memb_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userMembership['UserMembership']['memb_id']), null, __('Are you sure you want to delete "'.@$userMembership[UserMembership][memb_type].' "?', $userMembership['UserMembership']['memb_id'])); ?>
		</td>
	</tr>
                                        <?php 
										$membercount++;
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



<? //echo $this->element('sql_dump');?>
<script>
function changeStatus(id){
	var memb_id=id.substring(0,id.indexOf('_'));
	var status=$("#"+id).val();
	var url="<?php echo $this->webroot.'UserMemberships/changeStatus'; ?>";
	$.post(url,{'memb_id':memb_id,'status':status},function(res){
		if(res==1){
			alert("Status Updated successfully");
		}else{
			alert("Status not updated");
		}
	});
}

</script>
