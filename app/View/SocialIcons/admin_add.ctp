
<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Social Icon</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo $this->Form->create('SocialIcon',array('enctype' => 'multipart/form-data')); ?>
                <div class="box-body">
                  <?php
				  echo $this->Form->input('social_name',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('social_img',array('label'=>'Social Image','type'=>'file','class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('social_link',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('orderno',array('class' => 'form-control', 'div' => 'form-group'));
				  
		/*echo $this->Form->input('brand_name',array('class' => 'form-control', 'div' => 'form-group'));
		
		echo $this->Form->input('flag',array('options'=>@$brand,'label'=>'Parent','selected'=>0,'class' => 'form-control', 'div' => 'form-group'));
		$status=array('0'=>'Inactive','1'=>'Active');
		echo $this->Form->input('status',array('label'=>'Status','options'=>$status,'selected'=>1,'class' => 'form-control', 'div' => 'form-group'));*/
		//echo $this->Form->input('status');
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


