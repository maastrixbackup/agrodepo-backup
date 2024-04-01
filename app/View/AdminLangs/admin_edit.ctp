<script type="text/javascript" src="<?php echo $base_url;?>js/ckeditor/ckeditor.js"></script>
<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Admin Edit Language</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
			<?php echo $this->Form->create('AdminLang'); ?>
                <div class="box-body">
               <?php 
			   echo $this->Form->input('lid');
		 echo $this->Form->input('en_label',array('class' => 'form-control ckeditor', 'div' => 'form-group'));
		echo $this->Form->input('roman_label',array('class' => 'form-control ckeditor', 'div' => 'form-group'));
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



