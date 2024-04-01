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
            <?php echo $this->Form->create('Sitesetting', array('type' => 'file')); ?>
                <div class="box-body">
                <?php echo $this->Form->input('id');?>
                 <?php echo $this->Form->input('logo_title',array('label'=>'Logo Title','type'=>'text', 'class' => 'form-control', 'div' => 'form-group', 'value' => $settingres['Sitesetting']['logo_title']));?>
 				 <?php echo $this->Form->input('logo_image',array('label' => 'Image','type' => 'file','class' => 'form-control', 'div' => 'form-group'));?>
                 
            <div id='prev_img'><img src="<?php echo $base_url.'files/site_logo/'.$settingres['Sitesetting']['logo_image'];?>" style="width:180px;" /></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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
function hideImg(){
	$("#prev_img").attr('style','display:none');
	
	
	}
</script>