<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Admin Edit User Membership</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
			<?php echo $this->Form->create('UserMembership',array('type'=>'file')); ?>
                <div class="box-body">
               <?php 
			   echo $this->Form->input('memb_id');
		echo $this->Form->input('memb_type',array('label'=>'Member Type','class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('price',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('credits',array('class' => 'form-control', 'div' => 'form-group'));
		$status=array('0'=>'Inactive','1'=>'Active');
		echo $this->Form->input('status',array('options'=>$status,'class' => 'form-control', 'div' => 'form-group'));
		
		echo $this->Form->input('plan_img',array('label'=>'Membership Image','type'=>'file','onchange'=>'hideImg(this.id)','div' => 'form-group'));
		echo $this->Form->input('plan_img_hid',array('type'=>'hidden','value'=>@$this->request['data']['UserMembership']['plan_img'],'label'=>false,'id'=>'plan_img_hid'));
			echo $this->Form->input('prev_img_hid',array('type'=>'hidden','value'=>@$this->request['data']['UserMembership']['plan_img'],'label'=>false,'id'=>'prev_img_hid'));
		if($this->request['data']['UserMembership']['plan_img']!='' ){
			$img_name=$this->request['data']['UserMembership']['plan_img'];
				 $path ='files/memberplanimg/102X142_'.$img_name;
				if (file_exists($path)) {
				$memberplanimg_path = $base_url.'files/memberplanimg/102X142_'.$img_name;
				}else{
				$memberplanimg_path = $base_url.'files/memberplanimg/'.$img_name;
				}
			?>
		<div id='div_imd_id' > <img src="<?php echo $memberplanimg_path;?>" style="width:100px;height:100px;"> </div>
        <?php
			} ?>   
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div><!-- /.box -->

      

    </div><!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">
        <!-- general form elements disabled -->
        <!-- /.box -->
    </div><!--/.col (right) -->
</div>   <!-- /.row -->
</section><!-- /.content -->





<script>
function hideImg(id){
		$("#plan_img_hid").val('');
		$("#div_imd_id").attr('style','display:none');
	
}
	

</script>