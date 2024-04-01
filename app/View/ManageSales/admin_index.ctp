

 <!-- Main content -->
 <section class="content">

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Sales</h3>
                                    <div class="box-tools">
                                        <div class="input-group">
                                        <input type="text" placeholder="Keywords" name="searchtxt" id="searchtxt" onkeypress='enterSrch(event);' value="<?php echo @$searchtxt;?>" class="form-control input-sm pull-right" style="width: 150px;">
                                      Brand :<select id='brand_id' name='brand_id' onchange='getSubBrand()'>
			<option value='' <?php if(@$brand_id=='') echo "selected=selected";?>>-Select-</option>
			<?php
			foreach($brand AS $key => $val){
				?>
				<option value='<?php echo $key;?>' <?php if($key==@$brand_id && @$brand_id!='') echo 'selected=selected';?>><?php echo $val;?></option>
				<?php }?>
			</select>
			</td>
			<td>
			<select name="sub_brand_id" id="sub_brand_id" >
				<option value="">-Select-</option>
                <?php if(@$sub_brand_id!='' || @brand_id!=''){
				$sub_brand=$this->Custom->subBrand($brand_id);
				foreach($sub_brand As $k=>$v){
					?>
					<option value="<?php echo $k;?>" <?php if($k==@$sub_brand_id){ echo 'selected';}?>><?php echo $v;?></option>
					<?php
					}
				}?>
			</select>
            Category :<select id='cat_id' name='cat_id' onchange='getSubCat()'>
			<option value='' <?php if(@$cat_id=='') echo "selected=selected";?>>-Select-</option>
			<?php
			foreach($category AS $key => $val){
				?>
				<option value='<?php echo $key;?>' <?php if($key==@$cat_id && @$cat_id!='') echo 'selected=selected';?>><?php echo $val;?></option>
				<?php }?>
			</select>
			</td>
			<td>
			<select name="sub_cat_id" id="sub_cat_id" >
            <option value="">-Select-</option>
            <?php if(@$sub_cat_id!='' || @brand_id!=''){
				$sub_cat=$this->Custom->subCat($cat_id);
				foreach($sub_cat As $k=>$v){
					?>
					<option value="<?php echo $k;?>" <?php if($k==@$sub_cat_id){ echo 'selected';}?>><?php echo $v;?></option>
					<?php
					}
				}?>

			</select>
             <div class="input-group-btn">
                               <button type="button" class="btn btn-sm btn-default" name="searchbutn" id="searchbutn" onclick="return searchTxt();" > <i class="fa fa-search"></i></button>

                                            </div>
                                        </div>
                                        <div>

	</div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
			<th><?php echo $this->Paginator->sort('adv_id','SL#'); ?></th>
			<th width="150px"><?php echo $this->Paginator->sort('adv_name','Name'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id','Posted By'); ?></th>
			<th><?php echo $this->Paginator->sort('adv_img','Image'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sub_cat_id','Sub Category'); ?></th>
            <th><?php echo $this->Paginator->sort('is_promote','Is promoted'); ?></th>

			<th><?php echo $this->Paginator->sort('adv_status','Status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>

			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
                                        <?php
										$pageno=$this->request->params['paging']['ManageSale']['page'];
									$perpage=$this->request->params['paging']['ManageSale']['limit'];
									if(!empty($manageSales))
									{
										if($pageno!=1)
										{

											$salescount=$perpage*$pageno;
											$salescount=($salescount-$perpage)+1;
										}
										else
										{
											$salescount=1;
										}
										foreach ($manageSales as $manageSale): ?>
                                       <tr>
		<td><?php echo $salescount; ?>&nbsp;</td>
			<td><?php
		echo $this->Html->link(__(h($manageSale['ManageSale']['adv_name'])), array('action' => 'view', $manageSale['ManageSale']['adv_id']));
		?>&nbsp;</td>
        <td><?php
		$userdeatils=$this->Custom->user_details($manageSale['ManageSale']['user_id']);
		echo stripslashes($userdeatils['first_name'].' '.$userdeatils['last_name']);
		?>&nbsp;</td>
		<td><?php
		$img_name=$this->Custom->AdvImage($manageSale['ManageSale']['adv_id']);
			 $path ='files/postad/100X100_'.$img_name;
			if (file_exists($path)) {
			$img = $base_url.'files/postad/100X100_'.$img_name;
			}else{
			$img = $base_url.'files/postad/'.$img_name;
			}
		//$img=$this->webroot."files/postad/$img_name";
		if($img_name)
		print "<img src='$img'>";
		 ?>&nbsp;</td>
		 <td><?php echo $manageSale['ManageSale']['price']." ".$manageSale['ManageSale']['currency']; ?>&nbsp;</td>
		 <td><?php echo h($manageSale['ManageSale']['quantity']); ?>&nbsp;</td>
		<td><?php
		if($manageSale['ManageSale']['category_id']!=0)
		{
		echo $this->Html->link(__($this->Custom->category_name($manageSale['ManageSale']['category_id'])), array('controller'=>'ManageCategories','action' => 'view', $manageSale['ManageSale']['category_id']));
		}
		 ?>



		&nbsp;</td>
		<td><?php

				if($manageSale['ManageSale']['sub_cat_id']!=0)
				echo $this->Html->link(__($this->Custom->category_name($manageSale['ManageSale']['sub_cat_id'])), array('controller'=>'ManageCategories','action' => 'view', $manageSale['ManageSale']['sub_cat_id']));
		 ?>&nbsp;</td>
		<?php /*?> <td><?php
		  if(strpos($manageSale['ManageSale']['adv_brand_id'],',')){
				$brand=explode(',',$manageSale['ManageSale']['adv_brand_id']);
				$u_brand=array_unique($brand);
				$i=1;
				foreach($u_brand AS $k=>$v){
					if(isset($v))
				echo $this->Html->link(__($this->Custom->brand_nm($v)), array('controller'=>'ManageBrands','action' => 'view',$v)) ;
				if($i<count($u_brand)) echo ',';
				$i++;
				}
			}else{
				if(isset($manageSale['ManageSale']['adv_brand_id']))
				echo $this->Html->link(__($this->Custom->brand_nm($manageSale['ManageSale']['adv_brand_id'])), array('controller'=>'ManageBrands','action' => 'view', $manageSale['ManageSale']['adv_brand_id']));

			} ?>
		&nbsp;</td>
		<td>
		<?php

		  if(strpos($manageSale['ManageSale']['adv_model_id'],',')){
				$sub_brand=explode(',',$manageSale['ManageSale']['adv_model_id']);
				$i=1;
				foreach($sub_brand AS $k=>$v){
					if(isset($v))
				echo $this->Html->link(__($this->Custom->brand_nm($v)), array('controller'=>'ManageBrands','action' => 'view',$v));
				if($i<count($brand)) echo ',';
				$i++;
				}
			}else{
				if(@$manageSale['ManageSale']['adv_model_id']!='')
				  echo $this->Html->link(__($this->Custom->brand_nm(@$manageSale['ManageSale']['adv_model_id'])), array('controller'=>'ManageBrands','action' => 'view', $manageSale['ManageSale']['adv_model_id']));

			} ?>

		&nbsp;</td><?php */?>
        <td><?php if($manageSale['ManageSale']['is_promote']==1){ ?> <a href="<?php echo $base_url;?>admin/ManageSales/promoteddetail/<?php echo $manageSale['ManageSale']['adv_id'];?>" target="_blank" title="Click here to view promoted details">Promoted</a><?php }else{?> Not Promoted<?php }?></td>

		<td><?php
		$status=array('0'=>'Unpublish','1'=>'Publish');
		echo $this->Form->input($manageSale['ManageSale']['adv_id'].'_status',array('label'=>false,'options'=>$status,'selected'=>@$manageSale['ManageSale']['adv_status'],'onchange'=>'changeStatus(this.id)'));
		//echo h($manageSale['ManageSale']['adv_status']); ?>&nbsp;</td>
		<td><?php echo date('d/m/Y',strtotime($manageSale['ManageSale']['created'])); ?>&nbsp;</td>

		<td class="actions">

			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $manageSale['ManageSale']['adv_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $manageSale['ManageSale']['adv_id']), null, __('Are you sure you want to delete # %s?', $manageSale['ManageSale']['adv_id'])); ?>
		</td>
	</tr>
                                        <?php
										$salescount++;
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
$(document).ready(function(){

	//getSubBrand();
	//getSubCat();
})
function changeStatus(id){
	var adv_id=id.substring(0,id.indexOf('_'));
	var status=$("#"+id).val();
	var url="<?php echo $this->webroot.'ManageSales/changeStatus'; ?>";
	$.post(url,{'adv_id':adv_id,'status':status},function(res){//alert(res);
		if(res==1){
			alert("Status Updated successfully");
		}else{
			alert("Status not updated");
		}
	});
}
function searchTxt(){
	var searchtxt=$("#searchtxt").val().trim();
	var brand_id=$("#brand_id").val();
	var sub_brand_id=$("#sub_brand_id").val();
	var cat_id=$("#cat_id").val();
	var sub_cat_id=$("#sub_cat_id").val();
	var url="<?php echo $this->webroot.'admin/ManageSales/index/'; ?>";
	url+='searchtxt:'+searchtxt+'/brand_id:'+brand_id+'/sub_brand_id:'+sub_brand_id+'/cat_id:'+cat_id+'/sub_cat_id:'+sub_cat_id;
	window.location=url;
}
function enterSrch(e){
	//alert(e.which);
	if(e.which==13){
		searchTxt();
	}
}

function getSubBrand(){
	var brand_id=$("#brand_id").val();
	var url="<?php echo $this->webroot;?>ManageSales/getSubbrand";
	$("#sub_brand_id").load(url,{'brand_id':brand_id});
	$("#sub_brand_id").load(url,{'brand_id':brand_id});
}
function getSubCat(){
	var cat_id=$("#cat_id").val();
	var url="<?php echo $this->webroot;?>ManageSales/getSubcat";
	$("#sub_cat_id").load(url,{'cat_id':cat_id});
}
</script>