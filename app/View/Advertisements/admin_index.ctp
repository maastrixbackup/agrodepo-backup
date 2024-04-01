<!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Advertisements</h3>
                                 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
			<th><?php echo $this->Paginator->sort('ad_id','SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('ad_type'); ?></th>
			<!--<th><?php echo $this->Paginator->sort('banner_title'); ?></th>
			<th><?php echo $this->Paginator->sort('banner_link'); ?></th>
			<th><?php echo $this->Paginator->sort('ad_script'); ?></th>-->
			<th><?php echo $this->Paginator->sort('show_position'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php
										$pageno=$this->request->params['paging']['Advertisement']['page'];
									$perpage=$this->request->params['paging']['Advertisement']['limit'];
									if(!empty($advertisements))
									{
										if($pageno!=1)
										{
											
											$adcount=$perpage*$pageno;
											$adcount=($adcount-$perpage)+1;
										}
										else
										{
											$adcount=1;	
										} 
										foreach ($advertisements as $advertisement):?>
                                       <tr>
		<td><?php echo $adcount; ?>&nbsp;</td>
        
        <td><?php 
		echo $this->Html->link(__(h($advertisement['Advertisement']['title'])), array('action' => 'view', $advertisement['Advertisement']['ad_id']));?>
		&nbsp;</td>
		<td><?php
		$ad_options=array(1=>'Banner',2=>'Script');
		echo h($ad_options[$advertisement['Advertisement']['ad_type']]); ?>&nbsp;</td>
		<!--
		<td><?php echo h($advertisement['Advertisement']['banner_title']); ?>&nbsp;</td>
		<td><?php echo h($advertisement['Advertisement']['banner_link']); ?>&nbsp;</td>
		<td><?php echo h($advertisement['Advertisement']['ad_script']); ?>&nbsp;</td>-->
		<td><?php 
		$position_arr=array('1'=>'Top','2'=>'Left Sidebar 1','3'=>'Left Sidebar 2','4'=>'Middle','5'=>'right sidebar','6'=>'Footer');
		echo h($position_arr[$advertisement['Advertisement']['show_position']]); ?>&nbsp;</td>
		<td><?php
		$staus_arr=array('0'=>'Inactive','1'=>'Active');
		echo $this->Form->input('status',array('options'=>$staus_arr,'selected'=>$advertisement['Advertisement']['status'],'label'=>false,'onchange'=>'changeStatus(this.id)','id'=>$advertisement['Advertisement']['ad_id']."_status"));
		//echo h($staus_arr[$advertisement['Advertisement']['status']]); ?>&nbsp;</td>
		<td><?php echo date('d/m/Y',strtotime($advertisement['Advertisement']['created'])); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $advertisement['Advertisement']['ad_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $advertisement['Advertisement']['ad_id']), null, __('Are you sure you want to delete # %s?', $advertisement['Advertisement']['ad_id'])); ?>
		</td>
        
		
	</tr>
                                        <?php 
										$adcount++;
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
	var status=$("#"+id).val();
	var url="<?php echo $this->webroot;?>Advertisements/changeStatus";
	var ad_id=id.substring(0,id.indexOf("_")); //alert(id+'----'+status+'---'+status);return;
	$.post(url,{'status':status,'ad_id':ad_id},function(res){
		if(res==1){
			alert('Status changed Successfully.');
		}else if(res==0){
			alert('Status Not changed');
		}
	});
}
</script>
