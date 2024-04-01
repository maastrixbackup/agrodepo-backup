 <?php echo $this->Form->create('MasterUser',array('class'=>'form-horizontal','role'=>'form')); ?>
                   
                        <div class="signup_left">
                        <h2 class="detailstitle1"><?php echo PERSONALINFORMATION;?></h2>
                          <div class="clearfix" style="height:10px;"></div>
                           
								  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo FIRSTNAME;?> *</label>
									<div class="col-lg-7">
									<?php echo $this->Form->input('first_name',array('type'=>'text','required'=>'required','label'=>false,'class'=>'form-control txtprop','autocomplete'=>'off','placeholder'=>FIRSTNAME)); ?>

									</div>
								  </div>
								  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo LASTNAME;?>*</label>
									<div class="col-lg-7">
									<?php echo $this->Form->input('last_name',array('type'=>'text','required'=>'required','label'=>false,'class'=>'form-control txtprop','autocomplete'=>'off','placeholder'=>LASTNAME)); ?>
									  
									</div>
								  </div>
                                  
                                 <!-- <div class="form-group">
									<label class="col-lg-5 control-label">Sex *</label>
									<div class="col-lg-7">
									  <select name="gender" id="gender" class="required form-control" tabindex="3">
                                          <option value="m">Male</option>
                                          <option value="f">Female</option>
                                   </select>
									</div>
								  </div>-->
                                  
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo USERTYPE;?> *</label>
									<div class="col-lg-7">
									
									<?php 
						echo $this->Form->input('user_type_id',array('options'=>$user_type,'label'=>false,'class'=>'form-control'));
					?>
									</div>
								  </div>
                                  
                                    <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PHONE;?> 1 *</label>
									<div class="col-lg-7">
									<?php echo $this->Form->input('telephone1',array('type'=>'text','required'=>'required','class'=>'required number form-control txtprop','onkeypress'=>'return isNumberKey(event)','maxlength'=>'10','label'=>false)); ?>
									 
									</div>
								  </div>
								   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PHONE;?> 2</label>
									<div class="col-lg-7">
									<?php echo $this->Form->input('telephone2',array('type'=>'text','class'=>'number form-control txtprop','onkeypress'=>'return isNumberKey(event)','maxlength'=>'10','label'=>false)); ?>
									
									</div>
								  </div>
								   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PHONE;?> 3</label>
									<div class="col-lg-7">
									<?php echo $this->Form->input('telephone3',array('type'=>'text','class'=>'txtprop number form-control','onkeypress'=>'return isNumberKey(event)','maxlength'=>'10','label'=>false)); ?>
									  
									</div>
								  </div>
								   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PHONE;?> 4</label>
									<div class="col-lg-7">
									<?php echo $this->Form->input('telephone4',array('type'=>'text','class'=>'number form-control txtprop','onkeypress'=>'return isNumberKey(event)','maxlength'=>'10','label'=>false)); ?>
									</div>
								  </div>
                               
                                   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo DISTRICT;?>*</label>
									<div class="col-lg-7">
									<?php echo $this->Form->input('country_id',array('type' => 'select','options' => $country,'empty'=>'--'.CHOOSECOUNTY.'--','onChange'=>'location_list(this.value)','label'=>false,'class'=>'required form-control')); ?>
									</div>
								  </div>
                                   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo CITY;?>*</label>
									<div class="col-lg-7" id="place_locality">
									  
									  <?php echo $this->Form->input('locality_id',array('type' => 'select','empty'=>'--'.CHOOSETWON.'--','id'=>'old_location','label'=>false,'class'=>'form-control')); 
									echo '<div id="hh" ></div>';?>
									</div>
								  </div>
                                
                                  
                        </div>
                        
                        <div class="signup_right">
                           <h2 class="detailstitle1"><?php echo LOGININFO;?></h2>
                           <div class="clearfix" style="height:10px;"></div>
								
								  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo EMAIL;?>*</label>
									<div class="col-lg-7">
									  
									  <?php echo $this->Form->input('email',array('autocomplete'=>'off','required'=>'required','label'=>false,'class'=>'form-control')); ?>
									</div>
								  </div>
								  
								  
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PASSWORD;?>*</label>
									<div class="col-lg-7">
									<?php echo $this->Form->input('password',array('type'=>'password','id'=>'pwd','maxlength'=>9,'required'=>'required','label'=>false,'class'=>'form-control','autocomplete'=>'off')); ?>
									</div>
								  </div>
                                  
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo CONFIRMATIONPASSWORD;?>*</label>
									<div class="col-lg-7">
									
									<?php echo $this->Form->input('confirm_password',array('type'=>'password','id'=>'rpwd','required'=>'required','label'=>false,'class'=>'form-control','autocomplete'=>'off')); ?>
									</div>
								  </div>
								  
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo SECURITYCODE;?></label>
									<div class="col-lg-7"><div style="width:auto; float:left;margin-right:10px;">
						<img src="<?php echo $this->webroot;?>captcha/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' >
							<a href='javascript: refreshCaptcha();'>
								<img src="<?php echo $this->webroot;?>img/captcha.png" style="top: 5px;position: relative;margin-left: 5px;" alt="">
							</a>
							</div>
						
						<div style="width:auto; float:left;">
						<?php echo $this->Form->input('captcha_text', array('label'=>false,'required'=>'required','class'=>'form-control required','style'=>'width:170px;margin-top:10px;')); ?>
						
									</div>
							
									</div>
								  </div>
                                    
                                  <div class="form-group">
                                  <div class="col-lg-12" style="text-align:right;">
                                  <input name="data[MasterUser][tc]" id="trms" type="checkbox" class='tc' onclick=
								  <input name="data[MasterUser][tc]" id="trms" type="checkbox" class='tc' onclick="chk_but()" value="1" required>  <?php echo OVER18YEAROLD;?><a href="#login-box" class="login-window"> <?php echo TERMANDCONDITION;?> </a> *
									
									<!--popup content-->
                                    <div id="login-box" class="login-popup" style="display: none; margin-top: -226.5px; margin-left: -461.5px;">
										<a href="#login-box" class="close"><img src="<?php echo $this->webroot;?>images/delete_icon.png" class="btn_close" title="Close Window" alt="Close"></a>
										<h2> <?php echo TERMANDCONDITION;?></h2>
										<p>
                                        <?php
										$pageDetail=$this->Custom->getPages(4);
										echo nl2br(stripslashes($pageDetail['AdminPage']['page_desc']));
										?>
                                       </p>
						
										  
										</div>
                
                
                                     <!--popup content-->
                                    </div>										
								  </div>
								  <div class="form-group">
									
									<div class="col-lg-12" style="text-align:right;float:right;width:auto;">
									  <input class="btn1 savebtn" type="submit" value="<?php echo REGISTER;?>">
									  <a href="<?php echo $this->webroot;?>Logins/login"><input class="btn1 cancelbtn" type="button" value="<?php echo SIGNIN;?>"></a>
									</div>
								  </div>
                        </div>
                        
                      
						<?php $this->Form->end();?>

<script type="text/javascript">

	function refreshCaptcha(){
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	}

$(document).ready(function(){
$('#reload').click(function() {
          var captcha = $("#captcha_image");
           captcha.attr('src', captcha.attr('src')+'?'+Math.random());
          return false;
      });
});

	$(document).ready(function() {
		$("#sho").css("display", "none");
	});
	function chk_but(){
		if($("#trms").is(':checked'))
			$("#sho").css("display", "block"); // checked
			//$("#sho").attr('disabled','disabled');
		else
			$("#sho").hide(); 
	}

	function location_list(id){ 
		if(id){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'MasterUsers/add/'?>",
				data: {"c_id":id},
				success: function(data){ 
				//alert(data);
					if(data != ''){ 
					//alert(data);
					   var listItems = "<select id='MasterUserLocalityId' name='data[MasterUser][locality_id]' class='form-control'>";
						/*$.each(data, function(key, value) {
							//console.log(key);console.log(value);
							listItems+= "<option value='" + key + "'>" + value + "</option>";
							alert(listItems);
						});*/
						listItems+=data;
						listItems+="</select>";
						//alert(listItems);
						$("#old_location").css("display", "none");
						$("#hh").html(listItems);
					}else{ 
						$("#hh").html('');
						$("#old_location").css("display", "block");
						$("#MasterUserLocalityId").css("display", "none");
					}
				}
			});
		}else{
			$("#hh").html('');
			$("#old_location").css("display", "block");
			$("#MasterUserLocalityId").css("display", "none");
		}
	}
	$('body').on('click', function(){ 
      var pas = $("#pwd").val(); 
	  var rpas = $("#rpwd").val();
	  if(pas && rpas){ 
		if(pas === rpas){
			$("#err_confpaw").html('');
		}else{
			$("#err_confpaw").html('Password and conformpassword should same.');
		}
		
	 }
    });
	
	
	function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : evt.keyCode; 
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
    }
	
	function isAlphabet(e){
		var kc=(e.which) ? e.which : e.keyCode; 
		// 97->a 122->z 65->A 90->Z
		if(!((kc>=65 && kc <=90 )|| (kc >= 97 && kc <= 122) ) && kc!=8) {//alert(kc)
		e.preventDefault();
        }
	}
	 
	function chkPasslen(){
       var pass=$("#pwd").val().trim();
       if(pass){
       var len=pass.length;
        if(len<6){
         $("#pwd").val('');
        $("#err_msg_pass").removeAttr("style");
        }else{
         $("#err_msg_pass").attr("style","display:none");
       }
      }else{
       $("#pwd").val('');
      }
   }
   function chkEmail(){
   var email=$("#MasterUserEmail").val();
   var partn="^[a-z0-9._-]+@[a-z0-9]+\.[a-z]{2,6}$";
   var is_avl=email.match(partn);
   if(!is_avl){
     $("#MasterUserEmail").val('');
     $("#err_msg_email").removeAttr("style");
    }else{
      $("#err_msg_email").attr("style","display:none");
    }
  }
 
  $(document).ready(function() {
	$('a.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').on('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
	}); 
	return false;
	});
});
	
</script>
                       