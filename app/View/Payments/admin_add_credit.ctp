<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Credits</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo $this->Form->create('AddCredit'); ?>
                <div class="box-body">
                  <?php
				  echo $this->Form->input('credits',array('label' => 'Enter Credit amount', 'class' => 'form-control', 'div' => 'form-group'));
	?>
                    
                </div><!-- /.box-body -->

                <div class="box-footer">
                
                    <button type="submit" name="add_credit" class="btn btn-primary">Submit</button>
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
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->

