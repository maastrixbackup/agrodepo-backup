 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Languages</h3>
                                    <div class="box-tools">
                                    
                                        <div class="box-tools pull-right">
                                        <div class="input-group">	
                                      
        								<input type="text" placeholder="Search Language" name="searchtxt" id="searchtxt" onkeypress='enterSrch(event);' value="<?php echo @$searchtxt;?>" class="form-control input-sm pull-right" style="width: 150px;float: left!important; margin-top:2px;">
                                        <button type="button" name="searchbutn" id="searchbutn" class="btn btn-sm btn-default" onclick="return searchTxt();" style="margin-right:10px;" >Search</button>
                                        <button class="btn btn-primary btn-flat" onclick="location.href='<?php echo $base_url;?>admin/AdminLangs/add'">Add News</button>
                                        </div>
                                   
                                       
                                </div>
                                    </div>
                                    
                              
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                          <tr>
                            <th><?php echo $this->Paginator->sort('lid','SL#'); ?></th>
                            <th><?php echo $this->Paginator->sort('en_label','English Label'); ?></th>
                            <th><?php echo $this->Paginator->sort('roman_label','Romanian Label'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php 
										$pageno=$this->request->params['paging']['AdminLang']['page'];
									$perpage=$this->request->params['paging']['AdminLang']['limit'];
									if(!empty($adminLangs))
									{
										if($pageno!=1)
										{
											
											$langcount=$perpage*$pageno;
											$langcount=($langcount-$perpage)+1;
										}
										else
										{
											$langcount=1;	
										} 
										foreach ($adminLangs as $adminLang): ?>
                                       <tr>
		<td><?php echo $langcount; ?>&nbsp;</td>
		<td><?php echo stripslashes($adminLang['AdminLang']['en_label']); ?>&nbsp;</td>
        <td><?php echo stripslashes($adminLang['AdminLang']['roman_label']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $adminLang['AdminLang']['lid'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $adminLang['AdminLang']['lid']), array(), __('Are you sure you want to delete this language ?')); ?>
		</td>
	</tr>
                                        <?php 
										$langcount++;
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
function enterSrch(e){
	//alert(e.which);
	if(e.which==13){
		searchTxt();
	}
}
function searchTxt(){
	var searchtxt=$("#searchtxt").val().trim();

	var url="<?php echo $this->webroot.'admin/AdminLangs/index/'; ?>";
	url+='searchtxt:'+searchtxt;
	window.location=url;
}
</script>

