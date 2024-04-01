<h3>Alerts auto parts requests</h3>
<div >Vendors can subscribe by email to receive free tracks requests made by customers. Select below the criteria for which you want to be notified notification interval.</div>
<?php echo $this->Form->create('MasterUser', array('enctype' => 'multipart/form-data')); ?>

<div>
	<b>Enamel</b><?php echo $this->Form->input('email',array('type'=>'text','required'=>'required','value'=>@$alert_data['email'],'label'=>false,'div'=>false,'onblur'=>'chkEmail(this.id);'));?>
	<label id='err_msg_email' style='display:none'><font color='red'>Enter a valid email</font></label>
	<?php echo $this->Form->input("alert_hid",array('type'=>'hidden','id'=>'alert_hid','value'=>@$alert_data['alert_id']))?>
	You will receive a confirmation email with a link to the address entered.
	<div style="height:10px;" id='brand_div'>
		
		<b>Choose marks for which you want to receive alerts</b><br/><br/>
		<label id='brand_err_msg' style='display:none'><font color='red'>Choose at least one brand</font></label>
		<input type="checkbox" name = "data[MasterUser][brand][]"  value='all' />ALL<br/>
		<?php 
		$brand=explode(",",@$alert_data['brand_ids']);
		
		foreach($brand_list as $key=>$val){ ?>
			<input type="checkbox" name = "data[MasterUser][brand][]" class='group-required'  value=<?php echo $key;?> <?php if(in_array($key,@$brand)) echo "checked";?>> <?php echo $val; ?><br/><br/>
		<?php } ?>
	</div>
	<div>
		<b>Choose the type of application you want to get</b><br/><br/>
		<input type="radio" value="1" id="optionsRadios1" name="data[MasterUser][app_request]" required='required' <?php if(@$alert_data['application_type']==1) echo "checked";?>>Requests for new parts <br/><br/>
		<input type="radio" value="2" id="optionsRadios2" name="data[MasterUser][app_request]" <?php if(@$alert_data['application_type']==2) echo "checked";?>>Requests Parts sh <br/><br/>
		<input type="radio" value="3" id="optionsRadios3" name="data[MasterUser][app_request]" <?php if(@$alert_data['application_type']==3) echo "checked";?>>All applications<br/><br/>
	</div>
	<div style="height:10px;" id='country_div'>
	
	<b>Choose county from which you want to receive calls</b><br/><br/>
	<label id='country_err_msg' style='display:none'><font color='red'>Choose at least one country</font></label>
	<input type="checkbox" name = "data[MasterUser][country][]"  value='all' />ALL<br/>
	<?php 
	$country_arr=explode(",",@$alert_data['country_id']);
	foreach($country as $key1=>$val1){ ?>
			<input type="checkbox" name = "data[MasterUser][country][]" value=<?php echo $key1;?> <?php if(in_array($key1,@$country_arr)) echo "checked";?>> <?php echo $val1; ?><br/><br/>
		<?php } ?>
	</div>
	<div>
	<b>I want to receive alerts for applications relist</b><br/><br/>
	<input type="radio" value="1" id="optionsRadios4" name="data[MasterUser][app_relist_alert]" required='required' <?php if(@$alert_data['app_relist_alert']==1) echo "checked";?>>YUP<br/><br/>
		<input type="radio" value="2" id="optionsRadios5" name="data[MasterUser][app_relist_alert]" <?php if(@$alert_data['app_relist_alert']==2) echo "checked";?>>NOT<br/><br/>
	
	</div>
	
	<div style="min-height:10px;" id='category_div'>
	
		<b>Choose the categories in which you want to receive calls</b><br/><br/>
		<label id='category_err_msg' style='display:none'><font color='red'>Choose at least one category</font></label>
		<?php 
		$category=explode(",",@$alert_data['category_ids']);
		foreach($cat_list as $key1=>$val1){ ?>
			<input type="checkbox" name = "data[MasterUser][category][]" value=<?php echo $key1;?> <?php if(in_array($key1,@$category)) echo "checked";?>> <?php echo $val1; ?><br/><br/>
		<?php
		} ?>In addition to the categories checked you will receive applications for which have not identified category.
	</div>
	<div>
		<b>I want to receive an email each application separately</b><br/><br/>
		<input type="radio" value="1" id="optionsRadios10" name="data[MasterUser][app_separate_email]" required='required' <?php if(@$alert_data['app_separate_email']==1) echo "checked";?>>YUP<br/><br/>
		<input type="radio" value="2" id="optionsRadios11" name="data[MasterUser][app_separate_email]" <?php if(@$alert_data['app_separate_email']==2) echo "checked";?>>NOT<br/><br/>
	</div>
	<div>
		<b>I want to receive alerts</b><br/><br/>
		<input type="radio" value="1" id="optionsRadios6" name="data[MasterUser][rcv_alert_time]" onclick="showTime(this.id);" required='required' <?php if(@$alert_data['alert_type']==1) echo "checked";?>>Instant <br/><br/>
		<input type="radio" value="2" id="optionsRadios7" name="data[MasterUser][rcv_alert_time]" onclick="showTime(this.id);" <?php if(@$alert_data['alert_type']==2) echo "checked";?>>Of 10 in 10 minutes <br/><br/>
		<input type="radio" value="3" id="optionsRadios8" name="data[MasterUser][rcv_alert_time]" onclick="showTime(this.id);" <?php if(@$alert_data['alert_type']==3) echo "checked";?>>Hourly <br/><br/>
		<input type="radio" value="4" id="optionsRadios9" name="data[MasterUser][rcv_alert_time]"  <?php if(@$alert_data['alert_type']==4) echo "checked";?>>Once a day at
		<?php 
			$opt = array('0.00'=>'0.00','1.00'=>'1.00','2.00'=>'2.00','3.00'=>'3.00','4.00'=>'4.00','5.00'=>'5.00','6.00'=>'6.00','7.00'=>'7.00','8.00'=>'8.00','9.00'=>'9.00','10.00'=>'10.00','11.00'=>'11.00','12.00'=>'12.00','1.00pm'=>'1.00pm','2.00pm'=>'2.00pm','3.00pm'=>'3.00pm','4.00pm'=>'4.00pm','5.00pm'=>'5.00pm','6.00pm'=>'6.00pm','7.00pm'=>'7.00pm','8.00pm'=>'8.00pm','9.00pm'=>'9.00pm','10.00pm'=>'10.00pm','11.00pm'=>'11.00pm',);
			
			echo $this->Form->input('mail_time',array('type' => 'select','options'=>$opt,'empty'=>'-','id'=>'time_day','label'=>'','value'=>@$alert_data['email_send_time'])); 
			/*if(@$alert_data['alert_type']==4){
				echo $this->Form->input('mail_time',array('type' => 'select','options'=>$opt,'empty'=>'-','id'=>'time_day','label'=>'','value'=>@$alert_data['email_send_time'])); 
			}else{
				echo $this->Form->input('mail_time',array('type' => 'select','options'=>$opt,'empty'=>'-','id'=>'time_day','label'=>'','style'=>'display:none')); 
			} */
			
		?>
	</div>
	<div>
		<?php echo $this->Form->button('Subscribe',array('type'=>'submit','div'=>false,'onclick'=>'return validChk()')); ?>
	</div>
</div>
<?php echo $this->Form->end();?>

<script type='text/javascript'>
function chkEmail(id){
	var email=$("#"+id).val();
	 var partn="^[a-z0-9._-]+@[a-z0-9]+\.[a-z]{2,6}$";
    var is_avl=email.match(partn);
    if(!is_avl){
     $("#"+id).val('');
     $("#err_msg_email").removeAttr("style");
    }else{
      $("#err_msg_email").attr("style","display:none");
    }
	//alert(email);
}

function showTime(id){
	var chk=$("#"+id).val();
	if(chk==4){
		$("#time_day").removeAttr("style");
	}else{
	$("#time_day").attr("style","display:none");
	}
}
	function validChk(){
		var i=1;
		if($("#brand_div").find("input[type=checkbox]:checked").length==0){
			i=0;
			$("#brand_err_msg").removeAttr("style");
		}else{
			$("#brand_err_msg").attr("style",'display:none');
		}
		if($("#country_div").find("input[type=checkbox]:checked").length==0){
			i=0;
			$("#country_err_msg").removeAttr("style");
		}else{
			$("#country_err_msg").attr("style",'display:none');
		}
		if($("#category_div").find("input[type=checkbox]:checked").length==0){
			i=0;
			$("#category_err_msg").removeAttr("style");
		}else{
			$("#category_err_msg").attr("style",'display:none');
		}
		if(i)
			return true;
		else
			return false;
	}

</script>