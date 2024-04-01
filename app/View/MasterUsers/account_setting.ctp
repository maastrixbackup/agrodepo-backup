  <div class="container">
		<div class="row">
					
			<div class="innerpanel">
				<!-- Left Sidebar Start -->
					<?php echo $this->element('dashboard-left');?>
				<!-- Left Sidebar End -->
				
				
				<!-- Right Sidebar Start -->
				<div class="col-md-9">
					<div class="clearfix" style="height:15px;"></div>
					<div class="col-lg-12 prof bs-example">					
								<h2 class="detailstitle1 blue23"><?php echo ACCOUNTSETTINGS;?></h2>
								<div class="clearfix"></div>
								                                 <div class="clearfix" style="height:10px;"></div>
				<?php echo $this->Form->create('MasterUser',array('class'=>'form-horizontal','role'=>'form')); ?>			 <div class="signup_left">
				<div class="form-group">
									<label class="col-lg-5 control-label"><?php echo FIRSTNAME;?>*</label>
									<div class="col-lg-7">
		<?php echo $this->Form->input('first_name',array('type'=>'text','required'=>'required','class'=>'form-control','value'=>@$user_detail['User']['first_name'],'label'=>false,'placeholder'=>FIRSTNAME,'autocomplete'=>'off'));?>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo LASTNAME;?> *</label>
									<div class="col-lg-7">
									
				<?php echo $this->Form->input('last_name',array('type'=>'text','class'=>'form-control','value'=>@$user_detail['User']['last_name'],'placeholder'=>LASTNAME,'label'=>false,'autocomplete'=>'off'));?>					
									 
									</div>
								  </div>
                                  
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PHONE;?> 1 *</label>
									<div class="col-lg-7">
									
				<?php echo $this->Form->input('telephone1',array('type'=>'text','required'=>'required','class'=>'form-control','value'=>@$user_detail['User']['telephone1'],'onkeypress'=>'return isNumberKey(event)','maxlength'=>'10','label'=>false,'placeholder'=>PHONE.'1'));?>
									
									</div>
								  </div>
								  
								   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PHONE;?> 2</label>
									<div class="col-lg-7">
									
				<?php echo $this->Form->input('telephone2',array('type'=>'text','class'=>'form-control','value'=>@$user_detail['User']['telephone2'],'onkeypress'=>'return isNumberKey(event)','maxlength'=>'10','label'=>false,'placeholder'=>PHONE.'2'));?>
									
									</div>
								  </div>
								   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PHONE;?> 3</label>
									<div class="col-lg-7">
									
				<?php echo $this->Form->input('telephone3',array('type'=>'text','class'=>'form-control','value'=>@$user_detail['User']['telephone3'],'onkeypress'=>'return isNumberKey(event)','maxlength'=>'10','label'=>false,'placeholder'=>PHONE .'3'));?>
									
									</div>
								  </div>
								   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PHONE;?> 4</label>
									<div class="col-lg-7">
									
				<?php echo $this->Form->input('telephone4',array('type'=>'text','class'=>'form-control','value'=>@$user_detail['User']['telephone4'],'onkeypress'=>'return isNumberKey(event)','maxlength'=>'10','label'=>false,'placeholder'=>PHONE.'4'));?>
									
									</div>
								  </div>
								    <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo EMAIL;?> *</label>
									<div class="col-lg-7 small_text23">
						<?php echo @$user_detail['User']['email'];?> [<a href="<?php echo $this->webroot.'MasterUsers/change_email'?>"><?php echo EDITEMAIL;?></a> ]		
									</div>
								  </div>
                                  
                                   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo DISTRICT;?> *</label>
									<div class="col-lg-7">
					<?php echo $this->Form->input('country_id',array('type' => 'select','options' =>@$country,'empty'=>'-- Choose region --','onChange'=>'location_list(this.value)','class'=>'form-control','value'=> @$user_detail['User']['country_id'],'label'=>false,'required'=>'required')); ?>
					</div>
				</div>
                                      
				</div>
                                
                               <div class="signup_right">
                                
                                    <div class="form-group">
									<label class="col-lg-5 control-label">localitate</label>
									<div class="col-lg-7" id="place_locality">
					<?php 
					$locationlist=array('' => '-- alege Localitate --');
					if($user_detail['User']['country_id']!='')
					{
						$locationlist +=$this->Custom->locationList($user_detail['User']['country_id']);
					}
					
					echo $this->Form->input('locality_id',array('type' => 'select','options' => $locationlist,'id'=>'old_location','label'=>false,'class'=>'form-control', 'selected' => @$user_detail['User']['locality_id'])); ?>
					<div id="hh"></div> 
									</div>
								  </div>
							
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo POSTALCODE;?></label>
									<div class="col-lg-7">
									 <?php echo $this->Form->input('Postal',array('type'=>'text','class'=>'form-control','onkeypress'=>'return isNumberKey(event)','maxlength'=>'6','value'=>@$user_detail['User']['postal_code'],'label'=>false,));?>
		&nbsp;&nbsp;<?php /*?><a id='srch_pc' href='javascript:void(0)' style='text-decoration:none' onclick='getPostcode();'><?php echo SEARCHPOSTCODE;?></a><?php */?>
									</div></div>	
									
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo OTHERDETAILOFADDRESS;?></label>
									<div class="col-lg-7">
								
			<textarea rows="3" class='form-control' name="data[MasterUser][other_add]" id="other_add"><?php echo @$user_detail['User']['other_add'];?></textarea>	
								
									</div></div>
                                    
                                    <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo USERTYPE;?> *</label>
									<div class="col-lg-7">
									<?php 
						echo $this->Form->input('user_type_id',array('options'=>$user_type,'label'=>false,'class'=>'form-control','selected'=>@$user_detail['User']['user_type_id']));
					?> 
									</div>
								  </div>
								  <div class="form-group">
									
									<div class="col-lg-12" style="float:right;text-align:right;">
                                    <input type="hidden" name="updateme" value="update">
									<?php echo $this->Form->button(SAVECHANGE,array('type'=>'submit','div'=>false,'class'=>'btn1 savebtn'));?>
									  
									 <!-- <input class="btn1 cancelbtn" type="button" onclick="window.location.reload();" value="Cancel">-->
									</div>
								  </div>
                                
                                </div>
								
<?php echo $this->Form->end();?>
								
							</div>
                    <div class="clear"></div>
			  </div>
				<!-- Right Sidebar end -->
				
				<div class="clearfix" style="height:1px;"></div>
                
                
                 
                
                          
			   
			</div>
		</div>
		<div class="clearfix"></div>
    </div>


<script>

	$("#MasterUserFullName").keypress(function(e) {
		var kc=e.which;
		// 97->a 122->z 65->A 90->Z
		if(!((kc>=65 && kc <=90 )|| (kc >= 97 && kc <= 122) ) && kc!=8) {
		e.preventDefault();
        }
     });
	function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
    }
	
	function validate_form(){
		var validator=$("#MasterUserAccountSettingForm").validate({
		rules:{
			"data[MasterUser][Telephone]":{
				required:true,
				number:true
			},
			"data[MasterUser][Telephone1]":{
				required:true,
				number:true
			},
			"data[MasterUser][Telephone2]":{
				number:true
			},
			"data[MasterUser][Telephone3]":{
				number:true
			},
			"data[MasterUser][Postal]":{
				number:true
			}
		},
		messages:{
			"data[MasterUser][Telephone]":{
				required:"<br/><font color=red>This field required.</font>",
				number:"<br/><font color=red>Enter only digits.</font>"
			},
			"data[MasterUser][Telephone1]":{
				required:"<br/><font color=red>This field required.</font>",
				number:"<br/><font color=red>Enter only digits.</font>"
			},
			"data[MasterUser][Telephone2]":{
				number:"<br/><font color=red>Enter only digits.</font>"
			},
			"data[MasterUser][Telephone3]":{
				number:"<br/><font color=red>Enter only digits.</font>"
			},
			"data[MasterUser][Postal]":{
				number:"<br/><font color=red>Enter only digits.</font>"
			}
		}
		});
		
		alert(validator.form());return false;
		return validator.form();
		}
	$(document).ready(function(){
		var cnt_id = $("#MasterUserCountryId option:selected").val(); 
		if(cnt_id){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'MasterUsers/account_setting/'?>",
				data: {"c_id":cnt_id},
				dataType: "json",
				success: function(data){ 
					if(data != ''){ 
					   var listItems = "<select id='MasterUserLocalityId' name='data[MasterUser][locality_id]' class='form-control'>";
						$.each(data, function(key, value) {
							//console.log(key);console.log(value);
							listItems+= "<option value='" + key + "'>" + value + "</option>";
						});
						listItems+="</select>";
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
		
	});


	function location_list(id){ 
		if(id){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'MasterUsers/account_setting/'?>",
				data: {"c_id":id},
				dataType: "json",
				success: function(data){ 
					if(data != ''){ 
					   var listItems = "";
						$.each(data, function(key, value) {
							//console.log(key);console.log(value);
							listItems+= "<option value='" + key + "'>" + value + "</option>";
						});
						//listItems+="</select>";
						//$("#old_location").css("display", "none");
						$("#old_location").html(listItems);
					}else{
						//$("#hh").html('');
						//$("#old_location").css("display", "block");
						//$("#MasterUserLocalityId").css("display", "none");
					}
				}
			});
		}else{
			$("#hh").html('');
			$("#old_location").css("display", "block");
			$("#MasterUserLocalityId").css("display", "none");
		}
	}
	function getPostcode(){
		//$.fancybox(34543534);
		alert("Under Development");
	}
</script>