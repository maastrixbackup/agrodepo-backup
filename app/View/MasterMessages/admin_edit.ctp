 <!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add New Message</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
           <?php echo $this->Form->create('MasterMessage');
		   echo $this->Form->input('msg_id');
		   ?>
                <div class="box-body">
                <?php echo $this->Form->input('msg_name',array('label'=>'Message Name','type'=>'text', 'class' => 'form-control', 'div' => 'form-group'));?>
				<?php echo $this->Form->input('msg',array('label'=>'Message','type'=>'textarea', 'class' => 'form-control', 'div' => 'form-group'));?>
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

