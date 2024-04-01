
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Brands</h3>
                                    <div class="box-tools">
                                        <div class="input-group">
                                          
                                            <input type="text" placeholder="Search Brand" name="searchtxt" id="searchtxt" onkeypress='enterSrch(event);' class="form-control input-sm pull-right" style="width: 150px;" value="<?php echo @$searchtxt;?>"><select id='prnt_brnd_id' class="form-control input-sm pull-right" style="width: 150px; margin-right:5px;">
		<option value='' <?php if(@$par_brnd=='') echo "selected=selected";?>>-Select-</option>
		<?php
		foreach($parent AS $key => $val){
			?>
			<option value='<?php echo $key;?>' <?php if($key==@$par_brnd && @$par_brnd!='') echo 'selected=selected';?>><?php echo $val;?></option>
			<?php }?>
		</select>
                                            <div class="input-group-btn">
                               <button type="button" class="btn btn-sm btn-default" name="searchbutn" id="searchbutn" onclick="return searchTxt();" >Search</button>
                                              
                                            </div>
                                        </div>
                                        <div>
				 
	</div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
			<th><?php echo $this->Paginator->sort('brand_id','SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('brand_name'); ?></th>
			<th><?php echo $this->Paginator->sort('flag','Parent'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php
										$pageno=$this->request->params['paging']['ManageBrand']['page'];
									$perpage=$this->request->params['paging']['ManageBrand']['limit'];
									if(!empty($manageBrands))
									{
										if($pageno!=1)
										{
											
											$brandcount=$perpage*$pageno;
											$brandcount=($brandcount-$perpage)+1;
										}
										else
										{
											$brandcount=1;	
										} 
										foreach ($manageBrands as $manageBrand): ?>
                                       <tr>
		<td><?php echo $brandcount; ?>&nbsp;</td>
		<td><?php
			echo $this->Html->link(__($manageBrand['ManageBrand']['brand_name']), array('action' => 'admin_view', $manageBrand['ManageBrand']['brand_id']));
		 ?>&nbsp;</td>
		<td><?php if(@$manageBrand['ManageBrand']['flag']==0){
			echo "Parent";
		}else{
			echo $this->Custom->brand_nm($manageBrand['ManageBrand']['flag']);
		} 
		//$sub_brnd=$this->Custom->sub_brand_nm($manageBrand['ManageBrand']['brand_id']);
		?>&nbsp;</td>
		<td><?php 
		$status=array('0'=>'Inactive','1'=>'Active');
		echo $this->Form->input($manageBrand['ManageBrand']['brand_id'].'_status',array('label'=>false,'options'=>$status,'selected'=>@$manageBrand['ManageBrand']['status'],'onchange'=>'changeStatus(this.id)'));
		?>&nbsp;</td>
		<td><?php echo date('d/m/Y',strtotime($manageBrand['ManageBrand']['created'])); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'admin_edit', $manageBrand['ManageBrand']['brand_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'admin_delete', $manageBrand['ManageBrand']['brand_id']), null, __('Are you sure you want to delete # %s?', $manageBrand['ManageBrand']['brand_id'])); ?>
		</td>
	</tr>
                                        <?php 
										$brandcount++;
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
	var brand_id=id.substring(0,id.indexOf('_'));
	var status=$("#"+id).val();
	var url="<?php echo $this->webroot.'ManageBrands/changeStatus'; ?>";
	$.post(url,{'brand_id':brand_id,'status':status},function(res){
		if(res==1){
			alert("Status Updated successfully");
		}else{
			alert("Status not updated");
		}
	});
}
function searchTxt(){
	var searchtxt=$("#searchtxt").val().trim();
	var flag=$("#prnt_brnd_id").val();
	var url="<?php echo $this->webroot.'admin/ManageBrands/index/'; ?>";
	url+='searchtxt:'+searchtxt+'/flag:'+flag;
	window.location=url;
}
function enterSrch(e){
	//alert(e.which);
	if(e.which==13){
		searchTxt();
	}
}
</script>
