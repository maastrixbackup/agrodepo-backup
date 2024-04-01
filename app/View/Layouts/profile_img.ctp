<?php
echo $this->element('header-home');
?>

	<div class="container">		
<?php echo $this->Session->flash(); ?>
	 <div class="row">					
			<div class="innerpanel">
				<!-- Left Sidebar Start -->
					<?php echo $this->element('dashboard-left');?>
				<!-- Left Sidebar End -->
				
				<!-- Right Sidebar Start -->
				<div class="col-md-9">
					<div class="clearfix" style="height:15px;"></div>
					<div class="col-lg-12 prof bs-example">					
								<h2 class="detailstitle1 blue23">Change Profile Image</h2>
								<div class="clearfix"></div>
								 <div class="clearfix" style="height:10px;"></div>
									<?php echo $this->Form->create('MasterUser',array('role'=>'form','class'=>'form-horizontal','type'=>'file')); ?>
					   <div class="signup_left">
					   
					   <div class="form-group">
							<label class="col-lg-5 control-label">Upload Image</label>
							
							<?php echo $this->Form->input('profile_img',array('type'=>'file','label'=>false,'class'=>'form-control', 'div' => 'col-lg-7'));?> 
						  </div>
						  
						 
						   
						  <div class="form-group">
							<label class="col-lg-5 control-label" style="background:none;"></label>
							<div class="col-lg-7">
							
							  <?php echo $this->Form->button('Upload',array('type'=>'submit','div'=>false,'class'=>'btn1 savebtn','style'=>'margin-left: 0em;'));?>
							 
							</div>
						  </div>
						  
						  
						  </div>
						</form>
							</div>
                    <div class="clear"></div>
			  </div>
				
		</div>
		<div class="clearfix"></div>
    </div>
    </div>
    <!-- /.container -->
<?php
echo $this->element('footer-home');
?>