<?php //pr($auditLogins);?>
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">login Reports</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
			<th><?php echo $this->Paginator->sort('audit_id','SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'Name'); ?></th>
			<th><?php echo $this->Paginator->sort('login_time'); ?></th>
			<th><?php echo $this->Paginator->sort('logout_time '); ?></th>
			<th><?php echo $this->Paginator->sort('ip_address '); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php
										//pr($auditLogins);
										$pageno=$this->request->params['paging']['AuditLogin']['page'];
									$perpage=$this->request->params['paging']['AuditLogin']['limit'];
									if(!empty($auditLogins))
									{
										if($pageno!=1)
										{
											
											$loginncount=$perpage*$pageno;
											$loginncount=($loginncount-$perpage)+1;
										}
										else
										{
											$loginncount=1;	
										} 
										
										foreach ($auditLogins as $auditLogin): 
										
										?>
	<tr>
		<td><?php echo $loginncount; ?>&nbsp;</td>
		<td><?php $user_details= $this->Custom->user_details($auditLogin['AuditLogin']['user_id']);
		echo $user_details['first_name'].' '.$user_details['last_name'];
		?>
		</td>
		<td><?php echo date('d/m/Y h:i:s',strtotime($auditLogin['AuditLogin']['login_time'])); ?>&nbsp;</td>
		<td><?php if($auditLogin['AuditLogin']['logout_time']!=''){ echo date('d/m/Y h:i:s',strtotime($auditLogin['AuditLogin']['logout_time'])); }?>&nbsp;</td>
		<td><?php echo $auditLogin['AuditLogin']['ip_address']; 
		
		?></td>
		
		
		<td class="actions">
			
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'login_delete', $auditLogin['AuditLogin']['audit_id']), null, __('Are you sure you want to delete # %s?', $auditLogin['AuditLogin']['audit_id'])); ?>
			
		</td>
	</tr>

                                        <?php 
										$loginncount++;
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

