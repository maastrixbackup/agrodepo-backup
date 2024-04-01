<script src="<?php echo $this->webroot; ?>ckeditor/ckeditor.js"></script>
<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Pages</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo $this->Form->create('AdminPage'); ?>
                <div class="box-body">
                  <?php
				  echo $this->Form->input('page_name',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('page_title',array('type'=>'text','class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('meta_title',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('meta_desc',array('label'=>'Meta Description','class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('meta_keywords',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('page_desc',array('label'=>'Page Content','class'=>'ckeditor form-control', 'div' => 'form-group'));
		echo $this->Form->input('is_active',array('default'=>'1','class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('page_slug',array('type'=>'hidden'));
				  
		
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

