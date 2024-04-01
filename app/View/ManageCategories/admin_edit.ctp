<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"> Edit Category</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo $this->Form->create('ManageCategory'); ?>
                <div class="box-body">
                  <?php
				  echo $this->Form->input('category_id');
				  echo $this->Form->input('category_name',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('flag',array('label'=>'Parent',"options"=>@$parent,'class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('meta_description',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('meta_keywords',array('class' => 'form-control', 'div' => 'form-group'));
		$status=array("0"=>"Inactive","1"=>"Active");
			echo $this->Form->input("status",array("options"=>$status,'label'=>'Status','selected'=>1,'class' => 'form-control', 'div' => 'form-group'));
		
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


