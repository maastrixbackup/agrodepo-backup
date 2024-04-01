<div class="row">
					
			<div class="innerpanel">
			<!-- Left Sidebar Start -->
					<?php echo $this->element('dashboard-left');?>
				<!-- Left Sidebar End -->
				<!-- Right Sidebar Start -->
				<div class="col-md-9">
					<div class="clearfix" style="height:15px;"></div>
                       <div class="col-lg-12 prof bs-example" style="min-height:400px; padding-left:30px;">
                          <h2 class="detailstitle1 blue23">
                           <?php echo CHANGEPASSWORD;?>
                          </h2>
                          <div class="clearfix">
                          </div>
                          <div>
                            <span id="errmsg" style=" font-size:12px;color:#900;">
                            </span>
                          </div>
                          <div class="clearfix" style="height:10px;">
                          </div>
                          <div class="signup_left" style="width:100% !important;">
						  <?php echo $this->Form->create('MasterUser'); 
						 // print_r($this->request->data);
						  ?>
                          
                              <div class="form-group">
                                <label class="col-lg-3 control-label" ><?php echo CURRENTPASWORD;?>*</label>
                                <div class="col-lg-6">
								<?php echo $this->Form->input('current_password',array('type'=>'password','required'=>'required','label'=>false,'autocomplete'=>'off','class'=>'form-control'));?>
                          
                                </div>
                              </div>
                              <div class="clearfix" style="height:10px;">
                              </div>
                              <div class="form-group">
                                <label class="col-lg-3 control-label" ><?php echo NEWPASSWORD;?> *</label>
                                <div class="col-lg-6">
								<?php echo $this->Form->input('new_password',array('type'=>'password','required'=>'required','label'=>false,'autocomplete'=>'off','class'=>'form-control'));?>
                                </div>
                              </div>
                              <div class="clearfix" style="height:10px;">
                              </div>
                              <div class="form-group">
                                <label class="col-lg-3 control-label" ><?php echo CONFIRMATIONPASSWORD;?> *</label>
                                <div class="col-lg-6">
								<?php echo $this->Form->input('retype_new_password',array('type'=>'password','required'=>'required','label'=>false,'autocomplete'=>'off','class'=>'form-control'));?>
                                </div>
                              </div>
                              <div class="clearfix" style="height:10px;"></div>
                              <div class="form-group">
                                <label class="col-lg-3 control-label"  style="background:none;"></label>
                                <div class="col-lg-6">
                                  <input type="hidden" name="save" id="save">
                                  <?php echo $this->Form->button(SUBMIT,array('type'=>'submit','div'=>false,'id'=>'save'));?>
								  
                                </div>
                              </div>
                              <div class="clearfix" style="height:10px;"></div>
                              <div class="form-group">
                                <label class="col-lg-3 control-label"  style="background:none;"></label>
                                <div class="col-lg-7">
                                  <span id="errmsg" style=" font-size:12px;color:#900;">
								  
                                  </span>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                    <div class="clear"></div>
			  </div>
				<!-- Right Sidebar end -->
				
				<div class="clearfix" style="height:1px;"></div>
                
                
                 
                
                          
			   
			</div>
		</div>
		<div class="clearfix"></div>






<script>
function chkPasslen(){
var pass=$("#MasterUserNewPassword").val().trim();
if(pass){
var len=pass.length;
if(len<6){
$("#MasterUserNewPassword").val('');
$("#err_msg").removeAttr("style");
}else{
$("#err_msg").attr("style","display:none");
}
}else{
$("#MasterUserNewPassword").val('');
}
}



</script>