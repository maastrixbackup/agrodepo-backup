<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Admin Edit Social Icon</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
			<?php echo $this->Form->create('SocialIcon',array('enctype' => 'multipart/form-data')); ?>
                <div class="box-body">
               <?php 
			   echo $this->Form->input('social_id');
				echo $this->Form->input('social_name',array('type'=>'text', 'class' => 'form-control', 'div' => 'form-group'));
				echo $this->Form->input('social_img',array('type'=>'file','label'=>'Social Image', 'onchange'=>'changeImg(this.id)' ,'class' => 'form-control', 'div' => 'form-group'));
				?>
				<div id="hid_div">
                <input type="hidden" name="hid_img" id="hid_img" value="<?php echo $this->request->data['SocialIcon']['social_img'];?>">
                <input type="hidden" name="prev_hid_img" id="hid_img" value="<?php echo $this->request->data['SocialIcon']['social_img'];?>">
                <img src="<?php echo $this->webroot.'files/socialicon/'.$this->request->data['SocialIcon']['social_img']; ?>" style="width:100px;height:100px" >
                </div>
				<?php
				echo $this->Form->input('social_link',array('type'=>'text', 'class' => 'form-control', 'div' => 'form-group'));
				echo $this->Form->input('orderno',array('label'=>'Order No','type'=>'text', 'class' => 'form-control', 'div' => 'form-group'));
		
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

<script>
function changeImg(id){
	var img_name=$("#"+id).val();
	if(img_name!=''){
		$("#hid_img").val('');
		$("#hid_div").attr("style","display:none");
		}
	}
</script>

