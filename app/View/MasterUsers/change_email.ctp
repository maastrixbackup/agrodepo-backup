<div class="row">					
			<div class="innerpanel">
				<!-- Left Sidebar Start -->
					<?php echo $this->element('dashboard-left');?>
				<!-- Left Sidebar End -->
				
				<!-- Right Sidebar Start -->
				<div class="col-md-9">
					<div class="clearfix" style="height:15px;"></div>
					<div class="col-lg-12 prof bs-example">					
								<h2 class="detailstitle1 blue23"><?php echo CHANGEEMAILADDRESS;?></h2>
								<div class="clearfix"></div>
								 <div class="clearfix" style="height:10px;"></div>
									<?php echo $this->Form->create('MasterUser',array('role'=>'form','class'=>'form-horizontal')); ?>
					   <div class="signup_left">
					   
					   <div class="form-group">
							<label class="col-lg-5 control-label"><?php echo EMAILIDD;?>*</label>
							<div class="col-lg-7">
							<?php echo $this->Form->input('Email',array('type'=>'text','required'=>'required','value'=>@$umail,'label'=>false,'class'=>'form-control'));?> 
							</div>
						  </div>
						  
						 
						   
						  <div class="form-group">
							<label class="col-lg-5 control-label" style="background:none;"></label>
							<div class="col-lg-7">
							<input type="hidden" name="save" value="update">
							
							  <?php echo $this->Form->button(SAVE,array('type'=>'submit','div'=>false,'class'=>'btn1 savebtn','style'=>'margin-left: 0em;'));?>
							 
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


<script type='text/javascript'>
function chkEmail(){
	var email=$("#MasterUserEmail").val();
	var partn="^[a-z0-9._-]+@[a-z0-9]+\.[a-z]{2,6}$";
	var is_avl=email.match(partn);
	if(!is_avl){
		$("#MasterUserEmail").val('');
		$("#err_msg").removeAttr("style");
	}else{
		$("#err_msg").attr("style","display:none");
	}
}
</script>