<script type="text/javascript">
$(function() {
$(".showdisclaimer").on("click", function(){
	if($(this).is(":checked")==true)
	{
		var disclaimer=$(this).val();
		if(disclaimer==1)
		{
			$("#showdiclaimerDiv").show(500);
		}
		else
		{
			$("#showdiclaimerDiv").hide(500);
		}
	}
});
$(".showreturnpolicy").on("click", function(){
	if($(this).is(":checked")==true)
	{
		var returnpolicy=$(this).val();
		if(returnpolicy==1)
		{
			$("#showReturnpolicyDiv").show(500);
		}
		else
		{
			$("#showReturnpolicyDiv").hide(500);
		}
	}
});
$(".automatic_response").on("click", function(){
	if($(this).is(":checked")==true)
	{
		var automaticresponse=$(this).val();
		if(automaticresponse==1)
		{
			$("#automaticresponse").show(500);
		}
		else
		{
			$("#automaticresponse").hide(500);
		}
	}
});
});
function warrantyValidate()
{
	var disarr=new Array();
	$(".showdisclaimer").each(function(){
			if($(this).is(":checked")==true)
			disarr.push($(this).val());
		});
		var returnarr=new Array();
	$(".showreturnpolicy").each(function(){
			if($(this).is(":checked")==true)
			returnarr.push($(this).val());
		});
		var responsearr=new Array();
	$(".automatic_response").each(function(){
			if($(this).is(":checked")==true)
			responsearr.push($(this).val());
		});
	if($(".showdisclaimer").is(":checked")==false)
	{
		$("#disclaimerMsg").html('&nbsp;<font color="#f00">Choose Disclaimer Warranty</font>');
		$(".showdisclaimer").focus();
		return false;
	}
	else
	{
		$("#disclaimerMsg").html('');
	}
	if(disarr == 1)
	{
		if($("#SalesWarrantyDiscaimerWarrantyMth").val()=='')
		{
			$("#SalesWarrantyDiscaimerWarrantyMth").css("background-color", "#FEBBB4");
			$("#SalesWarrantyDiscaimerWarrantyMth").focus();
			return false;
		}
		else
		{
			$("#SalesWarrantyDiscaimerWarrantyMth").css("background-color", "");
		}
		if($("#SalesWarrantyTermsOfWarranty").val()=='')
		{
			$("#SalesWarrantyTermsOfWarranty").css("background-color", "#FEBBB4");
			$("#SalesWarrantyTermsOfWarranty").focus();
			return false;
		}
		else
		{
			$("#SalesWarrantyTermsOfWarranty").css("background-color", "");
		}
	}
		

	
	if($(".showreturnpolicy").is(":checked")==false)
	{
		$("#returnPolicyMsg").html('&nbsp;<font color="#f00">Choose Return Policy</font>');
		$(".showreturnpolicy").focus();
		return false;
	}
	
	else
	{
		$("#returnPolicyMsg").html('');
	}
	if(returnarr==1)
	{
		if($("#SalesWarrantyReturnPolicyDays").val()=='')
		{
			$("#SalesWarrantyReturnPolicyDays").css("background-color", "#FEBBB4");
			$("#SalesWarrantyReturnPolicyDays").focus();
			return false;
		}
		else
		{
			$("#SalesWarrantyReturnPolicyDays").css("background-color", "");
		}
		if($(".method_return_accepted").is(":checked")==false)
		{
			$("#returnacceptMsg").html('&nbsp;<font color="#f00">Choose one of them</font>');
			$("#method_return_accepted").focus();
			return false;
		}
		else
		{
			$("#transportationMsg").html('');
		}
		if($(".transportation_cost").is(":checked")==false)
		{
			$("#transportationMsg").html('&nbsp;<font color="#f00">Choose one of them</font>');
			$("#transportation_cost").focus();
			return false;
		}
		else
		{
			$("#transportationMsg").html('');
		}
		if($("#SalesWarrantyReturnPolicyInfo").val()=='')
		{
			$("#SalesWarrantyReturnPolicyInfo").css("background-color", "#FEBBB4");
			$("#SalesWarrantyReturnPolicyInfo").focus();
			return false;
		}
		else
		{
			$("#SalesWarrantyReturnPolicyInfo").css("background-color", "");
		}
	}
	if(($(".personal_teaching").is(":checked")== false) && ($(".courier").is(":checked")==false) && ($(".free_courier").is(":checked")==false) && ($(".romanian_mail").is(":checked")==false) && ($(".free_romanian").is(":checked")==false))
		{
			alert("Chose a delivery method");
			return false;
		}
		if($(".courier").is(":checked")==true)
		{
			if($("#SalesWarrantyCourierCost").val()=='')
			{
				$("#SalesWarrantyCourierCost").css("background-color", "#FEBBB4");
				$("#SalesWarrantyCourierCost").focus();
				return false;
			}
			else
			{
				$("#SalesWarrantyCourierCost").css("background-color", "");
			}
		}
		if($(".romanian_mail").is(":checked")==true)
		{
			if($("#SalesWarrantyRomanianCost").val()=='')
			{
				$("#SalesWarrantyRomanianCost").css("background-color", "#FEBBB4");
				$("#SalesWarrantyRomanianCost").focus();
				return false;
			}
			else
			{
				$("#SalesWarrantyRomanianCost").css("background-color", "");
			}
		}
		if($("#SalesWarrantyTimeRequired").val()=='')
		{
			$("#SalesWarrantyTimeRequired").css("background-color", "#FEBBB4");
			$("#SalesWarrantyTimeRequired").focus();
			return false;
		}
		else
		{
			$("#SalesWarrantyTimeRequired").css("background-color", "");
		}
		if($(".payment_methods").is(":checked")==false)
		{
			alert("Chose a Payment method");
			return false;
		}
		if($("#SalesWarrantyProductCondition").val()=='')
		{
			$("#SalesWarrantyProductCondition").css("background-color", "#FEBBB4");
			$("#SalesWarrantyProductCondition").focus();
			return false;
		}
		else
		{
			$("#SalesWarrantyProductCondition").css("background-color", "");
		}
		if($("#SalesWarrantyInvoice").val()=='')
		{
			$("#SalesWarrantyInvoice").css("background-color", "#FEBBB4");
			$("#SalesWarrantyInvoice").focus();
			return false;
		}
		else
		{
			$("#SalesWarrantyInvoice").css("background-color", "");
		}
		if($(".automatic_response").is(":checked")==false)
		{
			alert("Chose an Automatic response in case of order");
			return false;
		}
		if(responsearr==1)
		{
			if($("#SalesWarrantyMessageContent").val()=='')
			{
				$("#SalesWarrantyMessageContent").css("background-color", "#FEBBB4");
				$("#SalesWarrantyMessageContent").focus();
				return false;
			}
			else
			{
				$("#SalesWarrantyMessageContent").css("background-color", "");
			}
		}
	
}
</script>
<?php
if(isset($this->request->data['SalesWarranty']['disclaimer_of_warranty']))
{
$showdisclaimer=$this->request->data['SalesWarranty']['disclaimer_of_warranty'];
}
else
{
$showdisclaimer='';	
}
if(isset($this->request->data['SalesWarranty']['return_policy']))
{
$showreturnpolicy=$this->request->data['SalesWarranty']['return_policy'];
}
else
{
$showreturnpolicy='';	
}
if(isset($this->request->data['SalesWarranty']['method_return_accepted']))
{
	if($this->request->data['SalesWarranty']['method_return_accepted']!='')
	{
		$method_return_accepted=explode(",",$this->request->data['SalesWarranty']['method_return_accepted']);
	}
	else
	{
	$method_return_accepted=array();	
	}
}
else
{
$method_return_accepted=array();	
}
if(isset($this->request->data['SalesWarranty']['transportation_cost']))
{
$transportation_cost=$this->request->data['SalesWarranty']['transportation_cost'];
}
else
{
$transportation_cost='';	
}
if(isset($this->request->data['SalesWarranty']['personal_teaching']))
{
$personal_teaching=$this->request->data['SalesWarranty']['personal_teaching'];
}
else
{
$personal_teaching='';	
}
if(isset($this->request->data['SalesWarranty']['courier']))
{
$courier=$this->request->data['SalesWarranty']['courier'];
}
else
{
$courier='';	
}
if(isset($this->request->data['SalesWarranty']['free_courier']))
{
$free_courier=$this->request->data['SalesWarranty']['free_courier'];
}
else
{
$free_courier='';	
}
if(isset($this->request->data['SalesWarranty']['romanian_mail']))
{
$romanian_mail=$this->request->data['SalesWarranty']['romanian_mail'];
}
else
{
$romanian_mail='';	
}
if(isset($this->request->data['SalesWarranty']['free_romanian']))
{
$free_romanian=$this->request->data['SalesWarranty']['free_romanian'];
}
else
{
$free_romanian='';	
}
if(isset($this->request->data['SalesWarranty']['payment_methods']))
{
	if($this->request->data['SalesWarranty']['payment_methods']!='')
	{
		$payment_methods=explode(",",$this->request->data['SalesWarranty']['payment_methods']);
	}
	else
	{
	$payment_methods=array();	
	}
}
else
{
$payment_methods=array();	
}
if(isset($this->request->data['SalesWarranty']['message_response']))
{
$message_response=$this->request->data['SalesWarranty']['message_response'];
}
else
{
$message_response='';	
}
?>
<!-- my Sales Warranty design-->
<?php echo $this->Form->create('SalesWarranty', array('class' => 'form-inline', 'onsubmit' => 'return warrantyValidate();')); ?>
 <?php echo $this->Form->input('warranty_id');?>
                            <div class="rpt_row">
                                <div class="pref_section">
                                    1. <?php echo DESCLAIRMERWARRENTY;?><span id="disclaimerMsg"></span>
                                </div>
                                
                                <div class="radio _offer form-group">
                                    <label>
                                        <input type="radio" name="data[SalesWarranty][disclaimer_of_warranty]" value="0" class="showdisclaimer" <?php if($showdisclaimer==0){?> checked="checked"<?php }?>>
                                        <?php echo WEDONTOFFERWARENTY;?>
                                    </label>
                                    
                                    <label>
                                        <input type="radio" name="data[SalesWarranty][disclaimer_of_warranty]" value="1" class="showdisclaimer" <?php if($showdisclaimer==1){?> checked="checked"<?php }?>>
                                        <?php echo OFFERWARRENTY;?>
                                    </label>
                                </div>
                                
                                <br>
                                <span id="showdiclaimerDiv"  <?php if($showdisclaimer!=1){?> style="display:none"<?php }?>>
                                    <div class="form-group small13">
                                        <label><?php echo WARRENTYPRODUCTSOLD;?></label>
                                    </div>
                                    
                                    <br>
                                    <div class="form-group timepan">
                                        <label>
                                            <?php echo $this->Form->input('discaimer_warranty_mth', array('label' => false, 'class' => 'guarantee_time', 'div' => false));?>
                                            <?php echo MONTHS;?>
                                        </label>
                                    </div>
                            	
                                <br>
                                
                                <div class="form-group small13">
                                    <label><?php echo TERMOFPRUDUCTSOLD;?>:</label>
                                     <?php echo $this->Form->input('terms_of_warranty', array('label' => false, 'class' => 'form-control', 'div' => false, 'style' => 'height:100px', 'type' => 'textarea', 'cols' => false, 'rows' => false));?>
                                </div>
                                
                                <div class="form-group">
                                    <p>Ex:</p>
                                    <span class="italic">
                                       <?php echo ROMAINDATA3;?>
                                    </span>
                                </div>
                                </span>
                        	</div>
                        
                        
                        	<div class="rpt_row">
                                <div class="pref_section">
                                    2. <?php echo RETURNPLOY;?><span id="returnPolicyMsg"></span>
                                </div>
                                
                                <div class="radio _offer form-group">
                                    <label>
                                        <input type="radio" name="data[SalesWarranty][return_policy]" id="SalesWarrantyReturnPolicy" value="0" class="showreturnpolicy" <?php if($showreturnpolicy==0){?> checked="checked"<?php }?>>
                                        <?php echo IDONOTACCEPTRETURN;?>
                                    </label>
                                    
                                    <label>
                                        <input type="radio" name="data[SalesWarranty][return_policy]" id="SalesWarrantyReturnPolicy" value="1" class="showreturnpolicy" <?php if($showreturnpolicy==1){?> checked="checked"<?php }?>>
                                        <?php echo ACCEPTRETURN;?>
                                    </label>
                                </div>
                                <span id="showReturnpolicyDiv"<?php if($showreturnpolicy!=1){?> style="display:none"<?php }?>>
                                <div class="form-group small13">
                                    <label><?php echo PDWYOURETURNAFTER;?>:</label>
                                </div>
                                <br>
                                <div class="form-group timepan">
                                    <label>
                                        <?php echo $this->Form->input('return_policy_days', array('label' => false, 'type' => 'text', 'class' => 'guarantee_time', 'div' => false));?>
                                        <?php echo DAYS;?>
                                    </label>
                                </div>
                                
                                
                                <div class="form-group small23">
                                    <label><strong>METHODRETURN:</strong><span id="returnacceptMsg"></span></label>
                                    <label>
                                        <input type="checkbox" name="data[SalesWarranty][method_return_accepted][]" id="method_return_accepted" value="Cash consideration product" class="method_return_accepted" <?php if(in_array('Cash consideration product', $method_return_accepted)){?> checked="checked"<?php }?>>
                                        <?php echo CASECONSIPRO;?>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="data[SalesWarranty][method_return_accepted][]" value="Replacement product" class="method_return_accepted" <?php if(in_array('Replacement product', $method_return_accepted)){?> checked="checked"<?php }?>>
                                         <?php echo REPLACEMENTPRODUCT;?>
                                    </label>
                                </div>
                                <br>
                            
                                
                                <div class="form-group small23">
                                    <label><strong> <?php echo TRANSPOTETIONCOST;?>:</strong><span id="transportationMsg"></span></label>
                                    <label>
                                        <input type="radio" name="data[SalesWarranty][transportation_cost]" id="transportation_cost" value="Customer" class="transportation_cost"<?php if($transportation_cost=='Customer'){?> checked="checked"<?php }?>>
                                         <?php echo CUSTOMERSS;?>
                                    </label>
                                    <label>
                                        <input type="radio" name="data[SalesWarranty][transportation_cost]" value="Sales Clerk" class="transportation_cost" <?php if($transportation_cost=='Sales Clerk'){?> checked="checked"<?php }?>>
                                         <?php echo SALECLERK;?>
                                    </label>
                                </div>
                                <br>
                            
                                <div class="form-group small13">
                                    <label><?php echo AADITIONALINFOPOLICY;?>:</label>
                                     <?php echo $this->Form->input('return_policy_info', array('label' => false, 'class' => 'form-control', 'div' => false, 'style' => 'height:100px', 'type' => 'textarea', 'cols' => false, 'rows' => false));?>
                                </div>
                                </span>
                            </div>
                        
                        	
                            <div class="rpt_row">
                                <div class="pref_section">
                                    3. <?php echo DELICERYYY;?>
                                </div>
                                
                                <div class="radio _offer form-group">
                                	<label><strong><?php echo DELIVERYMETHOD;?></strong></label>
                                    <div class="clear1" style="height:10px;"></div>
                                    <div class="col-lg-12">
                                    	<div class="row">
                                        	<div class="col-lg-4">
                                            	<div class="row">
                                                	<label>
                                                        <input type="checkbox" name="data[SalesWarranty][personal_teaching]" value="1"<?php if($personal_teaching==1){?> checked="checked"<?php }?> class="personal_teaching">
                                                        <?php echo PERSONALTEACHING;?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="clear1" style="height:10px;"></div>
                                    	<div class="row">
                                        	<div class="col-lg-4">
                                            	<div class="row">
                                                	<label>
                                                        <input type="checkbox" name="data[SalesWarranty][courier]" value="1" class="courier"<?php if($courier==1){?> checked="checked"<?php }?>>
                                                        <?php echo COURIER;?>
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4 ">
                                            	<div class="row cost_box23">
                                                	<label>
                                                    	<?php echo DELIVERYCOST;?>
                                                        <?php echo $this->Form->input('courier_cost', array('label' => false, 'type' => 'text', 'class' => false, 'div' => false));?>
                                                        RON
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4">
                                            	<div class="row">
                                                	<label>
                                                        <input type="checkbox" name="data[SalesWarranty][free_courier]" value="1" class="free_courier"<?php if($free_courier==1){?> checked="checked"<?php }?>>
                                                        <?php echo FREEDELIVERYCOURIER;?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="clear1" style="height:10px;"></div>
                                    	<div class="row">
                                        	<div class="col-lg-4">
                                            	<div class="row">
                                                	<label>
                                                        <input type="checkbox" name="data[SalesWarranty][romanian_mail]" value="1" class="romanian_mail"<?php if($romanian_mail==1){?> checked="checked"<?php }?>>
                                                        <?php echo ROMANIANMAIL;?>
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4 ">
                                            	<div class="row cost_box23">
                                                	<label>
                                                    	<?php echo DELIVERYCOST;?>
                                                   		<?php echo $this->Form->input('romanian_cost', array('label' => false, 'type' => 'text', 'class' => false, 'div' => false));?>
                                                        RON
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4">
                                            	<div class="row">
                                                	<label>
                                                        <input type="checkbox" name="data[SalesWarranty][free_romanian]" value="1" class="free_romanian"<?php if($free_romanian==1){?> checked="checked"<?php }?>>
                                                        <?php echo FREESHIPPINGMAIL;?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group small13">
                                    <label><?php echo TIMEREQDISPATCH;?>:</label>
                                    <?php
										echo $this->Form->input('time_required', array('label'=>false,'class' => 'form-control','type' => 'select','options' => array('1' => '1 Day','2'=>'2 Days','3'=>'3 Days', '4' => '4 Days', '5' => '5 Days', '10' => '10 Days', '15' => '15 Days', '30' => '30 Days'), 'style' => 'width:20%!important;'));
									?>
                                </div>
                                <br>
                            
                                <div class="form-group small13">
                                    <label><?php echo STANDARDSENPACKEGE;?>:</label>
                                    <?php echo $this->Form->input('sending_package', array('label' => false, 'class' => 'form-control', 'div' => false, 'style' => 'height:100px', 'type' => 'textarea', 'cols' => false, 'rows' => false));?>
                                </div>
                                
                                <div class="form-group">
                                    <p>Ex:</p>
                                    <span class="italic">
                                       <?php echo ROMAINDATA;?>
                                    </span>
                                </div>
                                
                                
                                
                            </div>
                            
                            
                            <div class="rpt_row">
                                <div class="pref_section">
                                    4. <?php echo PAYMENTS;?>
                                </div>
                                
                                <div class="radio _offer form-group">
                                    <label>
                                        <input type="checkbox" name="data[SalesWarranty][payment_methods][]" value="<?php echo CASHONDELICERY;?>" class="payment_methods"<?php if(in_array('Cash on delivery', $payment_methods)){?> checked="checked"<?php }?>>
                                        <?php echo CASHONDELICERY;?>
                                    </label>
                                    <br>
                                    <label>
                                        <input type="checkbox" name="data[SalesWarranty][payment_methods][]" value="<?php echo UPONDELIVERY;?>" class="payment_methods"<?php if(in_array('Upon delivery', $payment_methods)){?> checked="checked"<?php }?>>
                                        <?php echo UPONDELIVERY;?>
                                    </label>
                                    <br>
                                    <label>
                                        <input type="checkbox" name="data[SalesWarranty][payment_methods][]" value="<?php echo WIRETRANSFER;?>" class="payment_methods"<?php if(in_array('Wire Transfer', $payment_methods)){?> checked="checked"<?php }?>>
                                        <?php echo WIRETRANSFER;?>
                                    </label>
                                    <br>
                                    <label>
                                        <input type="checkbox" name="data[SalesWarranty][payment_methods][]" value="<?php echo BANKCARD;?>" class="payment_methods"<?php if(in_array('Banking Card', $payment_methods)){?> checked="checked"<?php }?>>
                                       <?php echo BANKCARD;?>
                                    </label>
                                    <br>
                                    <label>
                                        <input type="checkbox" name="data[SalesWarranty][payment_methods][]" value="<?php echo OTHER;?>" class="payment_methods"<?php if(in_array('Others', $payment_methods)){?> checked="checked"<?php }?>>
                                        <?php echo OTHER;?>
                                    </label>
                                </div>
                                
                            </div>
                            
                            
                            <div class="rpt_row">
                                <div class="pref_section">
                                    5. <?php echo PRODUCTCONDITION;?>
                                </div>
                                <div class="clear10"></div>
                                <div class="form-group">
                                	
                                    <?php echo $this->Form->input('product_condition', array('label' => false,'type' => 'select','options' => array('' => SELECT,'new'=>'New', 'Used' => 'Used'), 'style' => 'width:20%!important;', 'div' => false, 'class' => 'form-control'));?>
                                </div>
                                
                            </div>
                            
                            
                            <div class="rpt_row">
                                <div class="pref_section">
                                    6. Invoice
                                </div>
                                <div class="clear10"></div>
                                <div class="form-group">
                                     <?php echo $this->Form->input(INVOICE, array('label' => false,'type' => 'select','options' => array('' => SELECT,'NOT'=>'NOT', 'YUP' => 'YUP'), 'style' => 'width:20%!important;', 'div' => false, 'class' => 'form-control'));?>
                                </div>
                                
                            </div>
                            
                            
                            <div class="rpt_row">
                                <div class="pref_section">
                                    7. <?php echo AUTOMATICRESPONSECASE;?>
                                </div>
                                <div class="clear10"></div>
                                <div class="radio _offer form-group">
                                    <label>
                                        <input type="radio" name="data[SalesWarranty][message_response]" value="0" class="automatic_response"<?php if($message_response==0){?> checked="checked"<?php }?>>
                                        <?php echo DONOTSENDAUTOMESG;?>
                                    </label>
                                    
                                    <label>
                                        <input type="radio" name="data[SalesWarranty][message_response]" value="1" class="automatic_response"<?php if($message_response==1){?> checked="checked"<?php }?>>
                                        <?php echo SENDMESSAGEAUTO;?>
                                    </label>
                                </div>
                                <span id="automaticresponse"<?php if($message_response!=1){?> style="display:none"<?php }?>>
                                <div class="form-group small13">
                                    <label><?php echo STANDARDSENPACKEGE;?>:</label>
                                      <?php echo $this->Form->input('message_content', array('label' => false, 'class' => 'form-control', 'div' => false, 'style' => 'height:100px', 'type' => 'textarea', 'cols' => false, 'rows' => false));?>
                                </div>
                                
                                <div class="form-group">
                                    <p>Ex:</p>
                                    <span class="italic">
                                       <?php echo ROMAINDATA1;?>
                                    </span>
                                </div>
                                </span>
                                
                            </div>     
                            
                            <div class="clear10"></div>
                            <input type="submit" name="sales_warranty_sub" value="<?php echo SAVE;?>" class="btn btn-success">
                          
                        </form>
