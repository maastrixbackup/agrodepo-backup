<?php
?>
<script type="text/javascript">
function forward_to_next()
{
//alert("enter");
var fname=$('#fname').val();
var email=$('#email').val();
var phone=$('#phone').val();
var address=$('#address').val();
var city=$('#city').val();
var state=$('#state').val();
var zip=$('#zip').val();

var sfname=$('#shipping_fname').val();
var semail=$('#shipping_email').val();
var sphone=$('#shipping_phone').val();
var saddress=$('#shipping_address').val();
var scity=$('#shipping_city').val();
var sstate=$('#shipping_state').val();
var szip=$('#shipping_zip').val();

var phone_allow=/^[0-9 \.-]+$/;
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(fname=='' || fname=='First Name*')
		{
		$("#fname").css("background-color", "rgb(242, 206, 206)");
		
		//$("#fname").css('border-color','#FF0000');
		$('#fname').focus();
		return false;
		}
		else
		{
		$("#fname").css("background-color", "");
		}
		if(email=='' || email=='Email*')
		{
		$("#email").css("background-color", "rgb(242, 206, 206)");
		
		$('#email').focus();
		return false;
		}
		else
		{
		$("#email").css("background-color", "");
		}
		if(!filter.test(email))
		{
		$("#email").css("background-color", "rgb(242, 206, 206)");
		$('#email').val('');
		$('#semail').val('');
		$('#email').focus();
		return false;
		}
		else
		{
		$("#email").css("background-color", "");
		}
		if(phone=='' || phone=='Phone*')
		{
		$("#phone").css("background-color", "rgb(242, 206, 206)");
		
		$('#phone').focus();
		return false;
		}
		else
		{
		$("#phone").css("background-color", "");
		}
		 if(phone!='')
		   {
			   if(!phone_allow.test(phone))
			   {
			   $("#phone").css("background-color", "rgb(242, 206, 206)");
				$('#phone').val('');
				$('#sphone').val('');
				$('#phone').focus();
				return false;
			   }
			   else
			   {
			  $("#phone").css("background-color", "");
			   }
		   }
		if(address=='' || address=='Address*')
		{
		$("#address").css("background-color", "rgb(242, 206, 206)");
		
		$('#address').focus();
		return false;
		}
		else
		{
		$("#address").css("background-color", "");
		}
		
		  if(city=='' || city=='City*')
		{
		$("#city").css("background-color", "rgb(242, 206, 206)");
		
		$('#city').focus();
		return false;
		}
		else
		{
		$("#city").css("background-color", "");
		}
		if(state=='' || state=='State*')
		{
		$("#state").css("background-color", "rgb(242, 206, 206)");
		
		$('#state').focus();
		return false;
		}
		else
		{
		$("#state").css("background-color", "");
		}
		if(zip=='' || zip=='Zip*')
		{
		$("#zip").css("background-color", "rgb(242, 206, 206)");
		
		$('#zip').focus();
		return false;
		}
		else
		{
		$("#zip").css("background-color", "");
		}
		//Validation for shipping details Your address
		if(sfname=='' || sfname=='First Name*')
		{
		$("#shipping_fname").css("background-color", "rgb(242, 206, 206)");
		
		//$("#fname").css('border-color','#FF0000');
		$('#shipping_fname').focus();
		return false;
		}
		else
		{
		$("#shipping_fname").css("background-color", "");
		}
		if(semail=='' || semail=='Email*')
		{
		$("#shipping_email").css("background-color", "rgb(242, 206, 206)");
		
		$('#shipping_email').focus();
		return false;
		}
		else
		{
		$("#shipping_email").css("background-color", "");
		}
		if(!filter.test(semail))
		{
		$("#shipping_email").css("background-color", "rgb(242, 206, 206)");
		$('#shipping_email').val('');
		$('#shipping_email').focus();
		return false;
		}
		else
		{
		$("#shipping_email").css("background-color", "");
		}
		if(sphone=='' || sphone=='Phone*')
		{
		$("#shipping_phone").css("background-color", "rgb(242, 206, 206)");
		
		$('#shipping_phone').focus();
		return false;
		}
		else
		{
		$("#shipping_phone").css("background-color", "");
		}
		 if(sphone!='')
		   {
			   if(!phone_allow.test(phone))
			   {
			   $("#shipping_phone").css("background-color", "rgb(242, 206, 206)");
				$('#shipping_phone').val('');
				$('#shipping_phone').focus();
				return false;
			   }
			   else
			   {
			  	$("#shipping_phone").css("background-color", "");
			   }
		   }
		if(saddress=='' || saddress=='Address*')
		{
		$("#shipping_address").css("background-color", "rgb(242, 206, 206)");
		
		$('#shipping_address').focus();
		return false;
		}
		else
		{
		$("#shipping_address").css("background-color", "");
		}
		
		  if(scity=='' || scity=='City*')
		{
		$("#shipping_city").css("background-color", "rgb(242, 206, 206)");
		
		$('#shipping_city').focus();
		return false;
		}
		else
		{
		$("#shipping_city").css("background-color", "");
		}
		if(sstate=='' || sstate=='State*')
		{
		$("#shipping_state").css("background-color", "rgb(242, 206, 206)");
		
		$('#shipping_state').focus();
		return false;
		}
		else
		{
		$("#shipping_state").css("background-color", "");
		}
		if(szip=='' || szip=='Zip*')
		{
		$("#shipping_zip").css("background-color", "rgb(242, 206, 206)");
		
		$('#shipping_zip').focus();
		return false;
		}
		else
		{
		$("#shipping_zip").css("background-color", "");
		}
		//End here
		
			
}
 $(document).ready(function(){
 $('.copydetails').click(function()
{
var fname=$('#fname').val();
var lname=$('#lname').val();
var email=$('#email').val();
var phone=$('#phone').val();
var address=$('#address').val();
var zip=$('#zip').val();
var city=$('#city').val();
var state=$('#state').val();
var radiocheck=$("#copydetails").is(":checked");
		if(radiocheck==true)
		{
			$('#shipping_fname').val('');
			$('#shipping_lname').val('');
			$('#shipping_email').val('');
			$('#shipping_phone').val('');
			$('#shipping_address').val('');
			$('#shipping_zip').val('');
			$('#shipping_city').val('');
			$('#shipping_state').val('');
		}
		else
		{
		$('#shipping_fname').val(fname);
			$('#shipping_lname').val(lname);
			$('#shipping_email').val(email);
			$('#shipping_phone').val(phone);
			$('#shipping_address').val(address);
			$('#shipping_zip').val(zip);
			$('#shipping_city').val(city);
			$('#shipping_state').val(state);
		}
	
});
});
function shift_fname()
{
var radiocheck=$("#copydetails").is(":checked");

var fname=$('#fname').val();
	if(radiocheck==false)
	{
		if(fname!='')
		{
		$('#shipping_fname').val(fname);
		}
	}
}

function shift_lname()
{
var radiocheck=$("#copydetails").is(":checked");
var lname=$('#lname').val();
	if(radiocheck==false)
	{
		if(fname!='')
		{
		$('#shipping_lname').val(lname);
		}
	}
}
function shift_email()
{
var radiocheck=$("#copydetails").is(":checked");
var email=$('#email').val();
	if(radiocheck==false)
	{
		if(email!='')
		{
		$('#shipping_email').val(email);
		}
	}
}
function shift_phone()
{
var radiocheck=$("#copydetails").is(":checked");
var phone=$('#phone').val();
	if(radiocheck==false)
	{
		if(phone!='')
		{
		$('#shipping_phone').val(phone);
		}
	}
}
function shift_address()
{
var radiocheck=$("#copydetails").is(":checked");
var address=$('#address').val();
	if(radiocheck==false)
	{
		if(address!='')
		{
		$('#shipping_address').val(address);
		}
	}
}
function shift_zip()
{
var radiocheck=$("#copydetails").is(":checked");
var zip=$('#zip').val();
	if(radiocheck==false)
	{
		if(zip!='')
		{
		$('#shipping_zip').val(zip);
		}
	}
}
function shift_city(city)
{
var radiocheck=$("#copydetails").is(":checked");
//var city=$('#city').val();
	if(radiocheck==false)
	{
		if(city!='')
		{
		$('#shipping_city').val(city);
		}
	}
}
function shift_state(state)
{
var radiocheck=$("#copydetails").is(":checked");
//var state=$('#state').val();
	if(radiocheck==false)
	{
		if(state!='')
		{
		$('#shipping_state').val(state);
		}
	}
}
</script>
<script type="text/javascript" language="javascript">

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode != 46 && charCode != 32 && charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	return true;
}
</script>
<div class="row">
            	<div class="listtop34">
                  <h2 class="detailstitle1"><?php echo YOURMEMBERSHIPPLAN;?></h2>
                    <div class="clear10"></div>
                   <div class="place_order">
                   
                            	<div class="clearfix" style="height:10px;"></div>
                                
                               <div class="car_data">
                                <div class="item">
                                    <div class="label">
                                    
                                   <?php echo MEMBERPLANS;?>
                                    
                                  </div>
                                    <div class="content">
                                    <?php echo $UserMembership['UserMembership']['memb_type'];?>                          
                                  </div>
                                 </div>
                                <div class="item">
                                    <div class="label">
                                    <?php echo PRICE;?>
                                  </div>
                                    <div class="content">
                                   
                                    <?php echo $UserMembership['UserMembership']['price'];?> RON
                                   
                                  </div>
                                 </div>
                                <div class="item">
                                    <div class="label">
                                   
                                    <?php echo CREDITS;?>
                                   
                                  </div>
                                    <div class="content">
                                   
                                    <?php echo $UserMembership['UserMembership']['credits'];?>
                                   
                                  </div>
                                 </div>
                                 <div class="item">
                                    <div class="label">
                                   
                                    <?php echo PAYMENTTYPE;?>
                                   
                                  </div>
                                    <div class="content">
                                   
                                    <?php echo CREDITCARD;?>
                                   
                                  </div>
                                 </div>
                             </div>
                             
                             	<div class="clear10"></div>
                   </div>
                    
                  
                            
                   <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                        	<div class="clear5"></div>
                            <?php echo PAYSECURECREDITCARD;?>
                            <div class="clear10"></div>
                             
                        </div>

                    <div class="clear40"></div>
                     <h2 class="detailstitle1"><?php echo BILLINGDETAILS;?></h2>
                    <div class="clearfix" style="height:15px;"></div>
                	<!--<form class="form-inline" id="checkout_form" name="checkout_form" method="post" action="" onsubmit="return forward_to_next();">-->
                    <?php echo $this->Form->create('TempMembershipDetail', array('name' => 'checkout_form', 'id' => 'checkout_form', 'class' => 'form-inline', 'onsubmit' => 'return forward_to_next();'));?>
                    	<div>
                       <div class="col-lg-4">
                        	  <div class="form-group row">
                                <label><?php echo NAME;?></label>
                                <input type="text" name="data[TempMembershipDetail][fname]" id="fname" class="form-control" placeholder="<?php echo ENTERYOURNAME;?>" onkeyup="shift_fname();" onblur="shift_fname();" value="<?php echo @$this->request->data['TempMembershipDetail']['fname'];?>">
                              </div>
                        </div>
                        <div class="col-lg-4">
                        	  <div class="form-group row">
                                <label><?php echo EMAILADDRESS;?> </label>
                                <input type="text" class="form-control" placeholder="<?php echo ENTEREMAIL;?>" id="email" name="data[TempMembershipDetail][email]" onkeyup="shift_email();" onblur="shift_email();" value="<?php echo @$this->request->data['TempMembershipDetail']['email'];?>">
                              </div>
                        </div>
                        
                        	<div class="col-lg-4">
                        	<div class="form-group row">
                                <label><?php echo PHONE;?></label>
                                <input id="phone" name="data[TempMembershipDetail][phone]" type="text" class="form-control" placeholder="<?php echo ENTERYOURNO;?>" onkeyup="shift_phone();" onblur="shift_phone();" value="<?php echo @$this->request->data['TempMembershipDetail']['phone'];?>">
                                
                              </div>
                        </div>
                        </div>
                        
                        <div class="clearfix" style="height:10px;"></div>
                        <div>
                      
                        <div class="col-lg-4">
                        	  <div class="form-group row">
                                <label><?php echo ADDRESSS;?></label>
                                <input id="address" name="data[TempMembershipDetail][address]" type="text" class="form-control" id="exampleInputEmail3" placeholder="<?php echo ENTERADDRESS;?>" onkeyup="shift_address();" onblur="shift_address();" value="<?php echo @$this->request->data['TempMembershipDetail']['address'];?>">
                              </div>
                        </div>
                        
                        	<div class="col-lg-4">
                        	<div class="form-group row">
                                <label> <?php echo CITY;?>/ <?php echo CITY;?> </label>
                                <select  id="city" name="data[TempMembershipDetail][city]" class="form-control" onchange="shift_city(this.value);">
                                    <option value=""><?php echo SELECTHERE;?></option>
                                   <?php 
									$citylist=$this->Custom->dezCity();
									if(!empty($citylist))
									{
										foreach($citylist as $citylistres)
										{
											?>
                                           <option value="<?php echo $citylistres['MasterLocation']['location_id'];?>"><?php echo $citylistres['MasterLocation']['location_name'];?></option> 
                                            <?php
										}
									}
									?>
                                </select>
                              </div>
                        </div>
                        </div>
                        
                        
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        <div>
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label> <?php echo STATE;?> / <?php echo COUNTRY;?></label>
                                    <select id="state" name="data[TempMembershipDetail][state]" class="form-control" onchange="shift_state(this.value);">
                                    <option value=""><?php echo SELECTHERE;?></option>
                                     <?php 
									$countylist=$this->Custom->dezCounty();
									if(!empty($countylist))
									{
										foreach($countylist as $countylistres)
										{
											?>

                                           <option value="<?php echo $countylistres['MasterCountry']['country_id'];?>"><?php echo $countylistres['MasterCountry']['country_name'];?></option> 
                                            <?php
										}
									}
									?>
                                    </select>
                                  </div>
                            </div>
                        
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label><?php echo POSTALCODE;?>/ Zip *</label>
                                    <input name="data[TempMembershipDetail][zip]" id="zip" type="text" class="form-control" placeholder="<?php echo ENTERPOSTALCODE;?>" onkeyup="shift_zip();" onblur="shift_zip();" onkeypress="return isNumberKey(event);" value="<?php echo @$this->request->data['TempMembershipDetail']['zip'];?>">
                                  </div>
                            </div>
                            
                            
                        </div>
                        
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        
                        <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                        	
                            <div class="checkbox">
                            	<label>
                            		<input type="checkbox" class="copydetails" id="copydetails" name="data[TempMembershipDetail][copydetails]" style="position:relative;top:2px;"/> <strong><?php echo SHIPADDRESS;?></strong>
                            	</label>
                            </div>
                            <div class="clear10"></div>
                             
                        </div>
                        <div class="clear10"></div>
                        
                        <div class="shipping_add">
                        <div>
                       <div class="col-lg-4">
                        	  <div class="form-group row">
                                <label><?php echo NAME;?></label>
                                <input id="shipping_fname" name="data[TempMembershipDetail][shipping_fname]" type="text" class="form-control" placeholder="<?php echo ENTERNAME;?>" value="<?php echo @$this->request->data['TempMembershipDetail']['shipping_fname'];?>">
                              </div>
                        </div>
                        <div class="col-lg-4">
                        	  <div class="form-group row">
                                <label><?php echo EMAILADDRESS;?> </label>
                                <input id="shipping_email" name="data[TempMembershipDetail][shipping_email]" type="text" class="form-control" placeholder="<?php echo ENTEREMAIL;?>" value="<?php echo @$this->request->data['TempMembershipDetail']['shipping_email'];?>">
                              </div>
                        </div>
                        
                        	<div class="col-lg-4">
                        	<div class="form-group row">
                                <label><?php echo PHONE;?></label>
                                <input id="shipping_phone" name="data[TempMembershipDetail][shipping_phone]" type="text" class="form-control" placeholder="<?php echo ENTERYOURNO;?>" value="<?php echo @$this->request->data['TempMembershipDetail']['shipping_phone'];?>">
                                
                              </div>
                        </div>
                        </div>
                        
                        <div class="clearfix" style="height:10px;"></div>
                        <div>
                      
                        <div class="col-lg-4">
                        	  <div class="form-group row">
                                <label><?php echo ADDRESSS;?></label>
                                <input id="shipping_address" name="data[TempMembershipDetail][shipping_address]" type="text" class="form-control" placeholder="<?php echo ENTERADDRESS;?>" value="<?php echo @$this->request->data['TempMembershipDetail']['shipping_address'];?>">
                              </div>
                        </div>
                        
                        	<div class="col-lg-4">
                        	<div class="form-group row">
                                <label><?php echo CITY;?>/ <?php echo CITY;?>  </label>
                                <select id="shipping_city" name="data[TempMembershipDetail][shipping_city]" class="form-control">
                                    <option><?php echo SELECTHERE;?></option>
                                    <?php 
									$citylist=$this->Custom->dezCity();
									if(!empty($citylist))
									{
										foreach($citylist as $citylistres)
										{
											?>
                                           <option value="<?php echo $citylistres['MasterLocation']['location_id'];?>"><?php echo $citylistres['MasterLocation']['location_name'];?></option> 
                                            <?php
										}
									}
									?>
                                </select>
                              </div>
                        </div>
                        </div>
                        
                        
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        <div>
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label><?php echo STATE;?> / <?php echo COUNTRY;?></label>
                                    <select id="shipping_state" name="data[TempMembershipDetail][shipping_state]" class="form-control">
                                    <option value=""><?php echo SELECTHERE;?></option>
                                     <?php 
									$countylist=$this->Custom->dezCounty();
									if(!empty($countylist))
									{
										foreach($countylist as $countylistres)
										{
											?>
                                           <option value="<?php echo $countylistres['MasterCountry']['country_id'];?>"><?php echo $countylistres['MasterCountry']['country_name'];?></option> 
                                            <?php
										}
									}
									?>
                                    </select>
                                  </div>
                            </div>
                        
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label><?php echo POSTALCODE;?> / Zip *</label>
                                    <input id="shipping_zip" name="data[TempMembershipDetail][shipping_zip]" type="text" class="form-control" placeholder="<?php echo ENTERPOSTALCODE;?>" onkeypress="return isNumberKey(event);" value="<?php echo @$this->request->data['TempMembershipDetail']['shipping_zip'];?>">
                                  </div>
                            </div>
                            
                            
                        </div>
                        </div>
                        <div class="clear15"></div>
                      <div class="col-lg-4">
                                <div class="form-group row">
                                    <button class="btn btn-success" type="submit" name="confirm_order"><?php echo CONFIRMORDER;?></button>
                                  </div>
                            </div>
                    </form>
 
                </div>
            </div>