<h2 class="detailstitle1"><?php echo FORGOTPASSWORD;?></h2>
			<div class="clearfix"></div>
					<div class="sign_error"><span id="errmsg"></span></div>
						 <div class="clearfix" style="height:10px;"></div>
						<?php
							echo $this->Form->create('MasterUser',array('class'=>'form-horizontal','role'=>'form')); 
							?>
						
					   <div class="signup_left">
					   
					   <div class="form-group">
							<label class="col-lg-5 control-label"><?php echo EMAILIDD;?> *</label>
							<div class="col-lg-7">
							<?php
							echo $this->Form->input('Email',array('label'=>false,'autocomplete'=>'off','required'=>'required','class'=>'email form-control','size'=>'40','aria-required'=>true,'required'=>'required'));
							?>
				
							</div>
						  </div>	 
						  <div class="form-group">
							<label class="col-lg-5 control-label" style="background:none;"></label>
							<div class="col-lg-7">
							<input type="hidden" name="save" value="update">
						
	
							  <input type="submit" class="btn1 savebtn" value="<?php echo SUBMIT;?>" name="send" style="margin-left: 0em;">
							  <input class="btn1 cancelbtn" type="button" onclick="window.location.href='<?php echo $this->webroot;?>Logins/login'" value="<?php echo SIGNIN;?>">
							
							</div>
						  </div>
						  
						  
						  </div>
						</form>
								
							</div>

<script>
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