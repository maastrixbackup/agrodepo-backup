<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Admin Edit Brand</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
			<?php echo $this->Form->create('ManageBrand', array('type' => 'file')); ?>
                <div class="box-body">
               <?php echo $this->Form->input('brand_id');

			    echo $this->Form->input('brand_name',array('type'=>'text', 'class' => 'form-control', 'div' => 'form-group'));

				echo $this->Form->input('flag',array('options'=>$brand,'label'=>'Parent','class' => 'form-control', 'div' => 'form-group'));
                  echo $this->Form->input('image',array('type' => 'file','onchange'=>'hideImg()', 'class' => 'form-control', 'div' => 'form-group'));
                if($this->request->data['ManageBrand']['image']!=''){
                ?>
                <div id='prev_img'><img src="<?php echo $this->webroot.'files/brand/100X100_'.$this->request->data['ManageBrand']['image']?>" style=" height:80px" /></div>
                <?php }
				echo $this->Form->input('meta_description',array('class' => 'form-control', 'div' => 'form-group'));
		        echo $this->Form->input('meta_keywords',array('class' => 'form-control', 'div' => 'form-group'));
				$status=array('0'=>'Inactive','1'=>'Active');
				echo $this->Form->input('status',array('label'=>'Status','options'=>$status,'class' => 'form-control', 'div' => 'form-group'));
			    ?>
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


