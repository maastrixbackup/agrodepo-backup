 <!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
               
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo $this->Form->create('siteSetting', array('type' => 'file')); ?>
                <div class="box-body">
                 <?php echo $this->Form->input('logo_title',array('label'=>'Logo Title','type'=>'text', 'class' => 'form-control', 'div' => 'form-group'));?>
 				 <?php echo $this->Form->input('logo_image',array('label' => 'Image','type' => 'file','onchange'=>'hideImg()', 'class' => 'form-control', 'div' => 'form-group'));?>
                   
                  
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
