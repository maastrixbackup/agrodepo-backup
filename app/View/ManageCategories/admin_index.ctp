 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Categories</h3>
                                    <div class="box-tools">
                                        <div class="input-group">
                                      
        <input type="text" placeholder="Search category" name="searchtxt" id="searchtxt" onkeypress='enterSrch(event);' value="<?php echo @$searchtxt;?>" class="form-control input-sm pull-right" style="width: 150px;">
                                              <select id='prnt_cat_id'  class="form-control input-sm pull-right" style="width: 150px; margin-right:5px;" >
		<option value='' <?php if(@$par_ct=='') echo "selected=selected";?>>-Select-</option>
		<?php
		foreach($parent AS $key => $val){
			?>
			<option value='<?php echo $key;?>' <?php if($key==@$par_ct && @$par_ct!='') echo 'selected=selected';?>><?php echo $val;?></option>
			<?php }?>
		</select>
                                            <div class="input-group-btn">
                                            &nbsp;&nbsp; <button type="button" name="searchbutn" id="searchbutn" class="btn btn-sm btn-default" onclick="return searchTxt();" >Search</button>
                                               
                                            </div>
                                        </div>
                                      
		
		</td>
		<td>
		
		</td>
		</tr>
		</table>				 
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th><?php echo $this->Paginator->sort('category_id','SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('category_name'); ?></th>
			<th><?php echo $this->Paginator->sort('flag','Parent'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
                                        </tr>
                                       <?php 
	$i=1;
	foreach ($manageCategories as $manageCategory): ?>
	<tr>
		<td><?php echo $i; ?>&nbsp;</td>
		<td>
		<?php echo $this->Html->link(__($manageCategory['ManageCategory']['category_name']), array('action' => 'view', $manageCategory['ManageCategory']['category_id'])); ?>
		&nbsp;</td>
		<td><?php if(@$manageCategory['ManageCategory']['flag']!=0){
			echo $this->Custom->category_name($manageCategory['ManageCategory']['flag']);
		}else{
			echo "Parent";
		} 
		?>&nbsp;</td>
		<td>
		<?php
			$status=array("0"=>"Inactive","1"=>"Active");
			echo $this->Form->input($manageCategory['ManageCategory']['category_id']."_is_active",array("options"=>$status,'label'=>false,'onchange'=>'changeStatus(this.id)','selected'=>@$manageCategory['ManageCategory']['status']));
			?>
		
		</td>
		<td><?php echo date('d/m/Y',strtotime($manageCategory['ManageCategory']['created'])); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $manageCategory['ManageCategory']['category_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $manageCategory['ManageCategory']['category_id']), null, __('Are you sure you want to delete # %s?', $manageCategory['ManageCategory']['category_id'])); ?>
		</td>
	</tr>
<?php 
$i++;
endforeach; ?>
                                    </table>
                                   
                                </div><!-- /.box-body -->
                               
                            </div><!-- /.box -->
                             <div class="clearfix"></div>
                                 
									<div class="float_left"><?php
                                    echo $this->Paginator->counter(array(
                                    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                                    ));
                                    ?></div>
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
	var category_id=id.substring(0,id.indexOf("_"));
	var status=$("#"+id).val();
	var url="<?php echo $this->webroot.'ManageCategories/changeStatus'; ?>";
	$.post(url,{'category_id':category_id,'status':status},function(res){
		if(res==1){
			alert("Status Updated successfully");
		}else{
			alert("Status not updated");
		}
	});
		
}
function enterSrch(e){
	//alert(e.which);
	if(e.which==13){
		searchTxt();
	}
}
function searchTxt(){
	var searchtxt=$("#searchtxt").val().trim();
	var flag=$("#prnt_cat_id").val();
	var url="<?php echo $this->webroot.'admin/ManageCategories/index/'; ?>";
	url+='searchtxt:'+searchtxt+'/flag:'+flag;
	window.location=url;
}
</script>
