

<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Advertisement</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo $this->Form->create('Advertisement',array('enctype' => 'multipart/form-data')); ?>
                <div class="box-body">
                  <?php
				  echo $this->Form->input('title',array('type'=>'text', 'class' => 'form-control', 'div' => 'form-group'));
		$ad_options=array(1=>'Banner &nbsp;&nbsp;',2=>'Script');
		$attributes=array('legends'=>false);
		//echo $this->Form->input('ad_type');
		echo $this->Form->radio('ad_type',$ad_options,$attributes);
		
		if(@$this->request->data['Advertisement']['ad_type']!=''){
			if($this->request->data['Advertisement']['ad_type']==1){?>
			<div id='banner_div' >
		<?php echo $this->Form->input('banner_title',array('class' => 'form-control', 'div' => 'form-group'));
		 echo $this->Form->input('banner_link',array('class' => 'form-control', 'div' => 'form-group'));
		 echo $this->Form->input('banner_image',array('type'=>'file','class' => 'form-control', 'div' => 'form-group'));
		 ?>
		 </div>
		 <div id="script_div" style='display:none'>
		 <?php
		echo $this->Form->input('ad_script',array('class' => 'form-control', 'div' => 'form-group'));
		?>
		</div>
		 <?php
		}else{?>
		<div id='banner_div' style='display:none'>
		<?php echo $this->Form->input('banner_title',array('class' => 'form-control', 'div' => 'form-group'));
		 echo $this->Form->input('banner_link',array('class' => 'form-control', 'div' => 'form-group'));?>
		 </div>
			<div id="script_div" >
		 <?php
		echo $this->Form->input('ad_script',array('class' => 'form-control', 'div' => 'form-group'));
		?>
		</div><?php
		}	
		}else{?>
			<div id='banner_div' style='display:none'>
		<?php echo $this->Form->input('banner_title',array('class' => 'form-control', 'div' => 'form-group'));
		 echo $this->Form->input('banner_link',array('class' => 'form-control', 'div' => 'form-group'));
		 echo $this->Form->input('banner_image',array('type'=>'file','class' => 'form-control', 'div' => 'form-group'));
		 ?>
		 </div>
		 <div id="script_div" style='display:none'>
		 <?php
		echo $this->Form->input('ad_script',array('class' => 'form-control', 'div' => 'form-group'));
		?>
		</div>
		<?php
		}
		$position_arr=array('1'=>'Top','2'=>'Left Sidebar 1','3'=>'Left Sidebar 2','4'=>'Middle','5'=>'right sidebar','6'=>'Footer');
		echo $this->Form->input('show_position',array('options'=>$position_arr,'class' => 'form-control', 'div' => 'form-group'));
		$staus_arr=array('0'=>'Inactive','1'=>'Active');
		echo $this->Form->input('status',array('options'=>$staus_arr,'selected'=>1,'class' => 'form-control', 'div' => 'form-group'));
		
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
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->

