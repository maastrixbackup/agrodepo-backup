<style>
	.per_del{clear:none;width:200px;margin-top: -10px;}
</style>

<h3>Warranty / Return / Shipping / Payment</h3>
<div style='font-weight:bold;'>
Now get a free account. <br/>
The settings on this page are only available when you have an active subscription PieseAuto.ro <br/>
View subscriptions available for vendors <a href='javascript:void(0)'>here</a> .
</div>
<?php echo $this->Form->create('MasterUser', array('enctype' => 'multipart/form-data')); ?>
<div><font size='4'>1. Disclaimer of Warranty</font></div>
<div>
	<input type="radio" value="1" id="optionsRadios1" name="data[MasterUser][offer]" checked='checked'> We do not offer warranty<br><br/>
	<input type="radio" value="2" id="optionsRadios2" name="data[MasterUser][offer]"><span>Offer warranty</span>
</div>
<div id='warranty_details' style="display:none;">
	<div><b>How many months you give warranty products sold?</b></div>
	<label id='err_msg_mnth' style='display:none'><font color='red'>Fill in the number of months warranty</font></label>
	<input type='text' id='sold_product' name='data[MasterUser][warranty_month]' style="width:30px;"><br/><br/>
	<div><b>Terms of warranty for products sold:</b></div>
	<label id='err_msg_wrnt' style='display:none'><font color='red'>Fill general conditions guarantee</font></label>
	<textarea rows="5" name="data[MasterUser][terms_warranty]" id="other_add"></textarea>
	<span>
		Ex:<br/>
		90 days warranty is given in accordance with law. <br/>
		For warranty claims must be made ​​proof mounting parts in RAR authorized service.
	</span>
</div>

<div><font size='4'>2. Return Policy</font></div>
<div>
	<input type="radio" value="1" id="optionsRadios3" name="data[MasterUser][return]" checked='checked' > I do not accept return<br><br/>
	<input type="radio" value="2" id="optionsRadios4" name="data[MasterUser][return]"><span>Accept return</span>
</div>
<div id='return_details' style="display:none;">
	<div><b>The period during which you can return the product after receiving it:</b></div>
	<label id='err_msg_days' style='display:none'><font color='red'>Complete the return period</font></label>
	<input type='text' id='return_days' name='data[MasterUser][return_days]' style="width:30px;">days<br/><br/>
	<span><b>Method return accepted:</b></span><br/>
	<label id='err_msg_rtn_mthod' style='display:none'><font color='red'>Select the method of return</font></label>
	<span id='return_method'>
		<input type="checkbox" name = "data[MasterUser][return][]" value='cash'> Cash consideration product<br><br/>
		<input type="checkbox" name = "data[MasterUser][return][]" value='replacement'> Replacement product<br>
	</span> <br/>
	<span><b>The transportation cost for return is supported by:</b></span> <br/>
	<label id='err_msg_tc' style='display:none'><font color='red'>Choose who will bear the cost of return transport</font></label>
	<span id='tc_id'>
		<input type="radio" value="1" id="optionsRadios5" name="data[MasterUser][transport_cost]"  > Customer<br><br/>
		<input type="radio" value="2" id="optionsRadios6" name="data[MasterUser][transport_cost]"><span> Sales Clerk</span>
	</span>
	<div><b>Additional information regarding return policy:</b></div>
	<textarea rows="5" name="data[MasterUser][additional_info]" id="additional_info"></textarea>
</div>

<div><font size='4'>3. Delivery</font></div>
<div>
	<div>Delivery methods</div>
	<label id='dm_err_msg' style='display:none'><font color='red'>Choose at least one Delivery method</font></label>
	<div class='fl'><input type="checkbox"  name = "data[MasterUser][delivery_methods][]" value='cash' >Personal Delivery</div>
	<div>
		<div class='fl' style="clear:none"><input type="checkbox" name = "data[MasterUser][delivery_methods][]" value='courier'>Courier</div>
		<div class='fl per_del'>Delivery Cost <input type='text' id='cst' name='data[MasterUser][del_cost]' style='width:30px'>RON</div>
		<div class='fl' style="clear:none"><input type="checkbox" name = "data[MasterUser][delivery_methods][]" value='free'>Free delivery by courier</div>
	</div>
	<div>
		<div class='fl' style="clear:none"><input type="checkbox" name = "data[MasterUser][delivery_methods][]" value='courier'>Romanian Mail</div>
		<div class='fl per_del'>Delivery Cost <input type='text' id='cst' name='data[MasterUser][del_cost]' style='width:30px'>RON</div>
		<div class='fl' style="clear:none"><input type="checkbox" name = "data[MasterUser][delivery_methods][]" value='free'>Free Shipping by Mail</div>
	</div>
</div>
<div>
<?php
	$opt = array('1'=>'1 day','2'=>'2 days','3'=>'3 days','4'=>'4 days','5'=>'5 days','10'=>'10 days','15'=>'15 days','30'=>'30 days');
	echo "Time required for dispatch".$this->Form->input('dispatch_time', array('type'=>'select','options'=>$opt, 'label'=>false,'id'=>'dispatch_time'));
?>
</div>
<div><b>Standard rates for sending packages:</b></div>
<textarea rows="5" name="data[MasterUser][package_details]" id="package_details"></textarea>
<span>
	<i>Ex:<br/>
	Romanian Post - xx lei / kg - usually in xx days. <br/>
	Courier - xx xx lei for the first kilograms. + Xx lei / kg extra weight. <br/>
	Rates valid for normal volumes courier network coverage. <br/>
	Payment refunded collector (not actually sending the cash paid) / cash payment is paid by the client.</i>
</span>
	<div><font size='4'>4. Payment</font></div>
	<label id='payment_err_msg' style='display:none'><font color='red'>Choose at least one Payment method</font></label>
	<div class='pm'>
	<?php
		//echo "<div id='payment_err'></div>";
		echo $this->Form->input('cash', array('type'=>'checkbox','id'=>'cash','div'=>false,'label'=>false,'value'=>1)).'Cash on Delivery<br>';
		echo $this->Form->input('upon', array('type'=>'checkbox','id'=>'upon','div'=>false,'label'=>false,'value'=>2)).'Upon Delivery<br>';
		echo $this->Form->input('wire', array('type'=>'checkbox','id'=>'wire','div'=>false,'label'=>false,'value'=>3)).'Wire Transfer<br>';
		echo $this->Form->input('card', array('type'=>'checkbox','id'=>'card','div'=>false,'label'=>false,'value'=>4)).'Banking Card<br>';
		echo $this->Form->input('other', array('type'=>'checkbox','id'=>'other','div'=>false,'label'=>false,'value'=>5)).'Others<br><br>';
	?>
	</div>
	<div><font size='4'>5. Product Condition</font></div>
	<?php
		$options = array('new'=>'New', "old"=>'Old');
		echo $this->Form->input('product_cond', array('type'=>'select','required'=>'required','options'=>$options,'id'=>'product_cond','label'=>false,'value'=>@$saved_data_info['SalesAdvertisement']['product_cond'])); 
	?>	
	<div><font size='4'>6. Invoice</font></div>
	<?php
		$options = array('not'=>'NOT', "yup"=>'YUP');
		echo $this->Form->input('invoice', array('type'=>'select','required'=>'required','options'=>$options,'id'=>'invoice','label'=>false,'value'=>'')); 
	?>	
	<div><font size='4'>7. Automatic response in case of order</font></div>
	
	
	<div>
	
		<input type="radio" value="1" id="optionsRadios7" name="data[MasterUser][order_response]" checked='checked'> Do not send automated message<br><br/>
		<input type="radio" value="2" id="optionsRadios8" name="data[MasterUser][order_response]"><span>Send message automatically</span>
	</div>
	
	<div id='auto_msg_content' style="display:none;">
	<label id='err_msg_autoresp' style='display:none'><font color='red'>Fill autoresponder message content for</font></label>
	<b>Automatic Message content:</b>
		<textarea rows="5" name="data[MasterUser][msg_content]" id="msg_content" ></textarea>
		<i>Ex:
Thank you for order made.<br>
In the shortest possible time colleague will contact you to confirm order details and the date can be shipped. <br>
We are open Monday to Friday from 9.00 to 18.00.<br>
If you order made outside these hours, please be aware that we will process your orders in the order in which they were made.<br>
If you forgot to tell us something through field observations, you can do the buttons below to contact this email. <br>
We treat all orders very seriously and we guarantee that the products delivered will be described.<br>
Good luck shopping!</i>
	</div>
	
<?php echo $this->Form->button('save',array('type'=>'submit','div'=>false,'onclick'=>'return validateForm()'));?>
<?php echo $this->Form->end();?>

<script type="text/javascript">
	function validateForm(){
		var flag=1;
		if($(".fl").find("input[type=checkbox]:checked").length==0){
			$("#dm_err_msg").removeAttr("style");
			flag=0;
		}else{
			$("#dm_err_msg").attr("style","display:none");
		}
		if($(".pm").find("input[type=checkbox]:checked").length==0){
			flag=0;
			$("#payment_err_msg").removeAttr("style");
		}else{
			$("#payment_err_msg").attr("style","display:none");
		}
		if($("#optionsRadios2").is(":checked")){
			if($("#sold_product").val().trim()==''){
				flag=0;
				$("#err_msg_mnth").removeAttr("style");
			}else{
				$("#err_msg_mnth").attr("style","display:none");
			}
			if($("#other_add").val().trim()==''){
				flag=0;
				$("#err_msg_wrnt").removeAttr("style");
			}else{
				$("#err_msg_wrnt").attr("style","display:none");
			}
		}
		if($("#optionsRadios4").is(":checked")){
			if($("#return_days").val().trim()==''){
				flag=0;
				$("#err_msg_days").removeAttr("style");
			}else{
				$("#err_msg_days").attr("style","display:none");
			}
			if($("#return_method").find("input[type=checkbox]:checked").length==0){
			  flag=0;
			$("#err_msg_rtn_mthod").removeAttr("style");
		     }else{
			$("#err_msg_rtn_mthod").attr("style","display:none");
		    }
		   if($("#tc_id").find("input[type=radio]:checked").length==0){
			flag=0;
			$("#err_msg_tc").removeAttr("style");
		   }else{
			$("#err_msg_tc").attr("style","display:none");
		   }
			
		}
		if($("#optionsRadios8").is(":checked")){
			if($("#msg_content").val().trim()==''){
				flag=0;
				$("#err_msg_autoresp").removeAttr("style");
			}else{
				$("#err_msg_autoresp").attr("style","display:none");
			}
			
		}
		
		
		if(flag==1){
			return true;
		}else{
			return false;
		}
	}

	$( "#optionsRadios2" ).click(function() {
	  $( "#warranty_details" ).css("display", "block");
	});
	$( "#optionsRadios1" ).click(function() {
	  $( "#warranty_details" ).css("display", "none");
	});
	
	$( "#optionsRadios4" ).click(function() {
	  $( "#return_details" ).css("display", "block");
	});
	$( "#optionsRadios3" ).click(function() {
	  $( "#return_details" ).css("display", "none");
	});
	
	$( "#optionsRadios8" ).click(function() {
	  $( "#auto_msg_content" ).css("display", "block");
	});
	$( "#optionsRadios7" ).click(function() {
	  $( "#auto_msg_content" ).css("display", "none");
	});
</script>