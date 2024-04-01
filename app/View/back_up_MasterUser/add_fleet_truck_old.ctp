<div align='right'>
	<a href="<?php echo $this->webroot.'MasterUsers/fleet_truck_list'?>"><h2>List of Trucks</h2></a>
</div>
<div>
<h2>Add fleet of Truck</h2>
</div>


<h3>Company Information</h3>
<?php echo $this->Form->create('MasterUser', array('enctype' => 'multipart/form-data')); ?>
<table>
	<tr>
		<td>The commercial name of the park :(as you know the world)<?php echo $this->Form->input('park_name',array('type'=>'text','required'=>'required','value'=>'','label'=>''));?> </td>
	</tr>
	<tr>
		<td>Name of Company:<?php echo $this->Form->input('company_name',array('type'=>'text','required'=>'required','value'=>'','label'=>''));?> </td>
	</tr>
	<tr>
		<td>VAT:<?php echo $this->Form->input('vat',array('type'=>'text','required'=>'required','value'=>'','label'=>''));?> </td>
	</tr>
	<tr><td colspan=2><h3>Location</h3></td></tr>
	<tr>
		<td>County:<?php echo $this->Form->input('country_id',array('type' => 'select','options' =>@$country,'empty'=>'Choose one country','onChange'=>'location_list(this.value)','label'=>'','value'=> @$user_detail['User']['country_id'])); ?></td>
	</tr>
	<tr>
		<td>City:<?php echo $this->Form->input('locality_id',array('type' => 'select','empty'=>'Choose one location','id'=>'old_location','label'=>'')); ?>
			<div id="hh"></div>
		</td>
	</tr>
	<tr>
		<td>Postal Code:<?php echo $this->Form->input('postal_code',array('type'=>'text','value'=>'','label'=>'','maxlength'=>'6','onkeypress'=>'return isNumberKey(event)'));?></td>
	</tr>
	<tr>
		<td>Street:<?php echo $this->Form->input('street',array('type'=>'text','required'=>'required','value'=>'','label'=>''));?></td>
	</tr>
	<tr>
		<td>Nr:<?php echo $this->Form->input('nr',array('type'=>'text','required'=>'required','value'=>'','label'=>''));?></td>
	</tr>
	<tr>
		<td>
			Other details of address<textarea rows="3" name="data[MasterUser][other_add]" id="other_add"><?php echo @$user_detail['User']['other_add'];?></textarea>
		</td>
	</tr>
	<tr><td colspan=2><h3>Contact</h3></td></tr>
	<tr>
		<td>Phone:<?php echo $this->Form->input('phone',array('type'=>'text','required'=>'required','value'=>'','label'=>'','maxlength'=>'10','onkeypress'=>'return isNumberKey(event)'));?></td>
	</tr>
	<tr> 
		<td>Fax:<?php echo $this->Form->input('fax',array('type'=>'text','value'=>'','label'=>'','maxlength'=>'10','onkeypress'=>'return isNumberKey(event)'));?></td>
	</tr>
	<tr>
		<td>Email:<?php echo $this->Form->input('email',array('type'=>'text','required'=>'required','value'=>'','label'=>'','onblur'=>'chkEmail()'));?>
			<label style='display:none' id='err_msg'><font color='red'>Enter a valid email.</font></label>
		</td>
	</tr>
	<tr>
		<td>Website:<?php echo $this->Form->input('website',array('type'=>'text','value'=>'','label'=>''));?></td>
	</tr>
	<tr><td colspan=2><h3>Description park and logo</h3></td></tr>
	<tr>
		<td>
			Description * (minimum 20 characters)<textarea rows="5" "required" name="data[MasterUser][description]" id="other_add"><?php echo @$user_detail['User']['other_add'];?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			Logo / Banner park
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $this->Form->input('logo',array('type'=>'file'));?>
		</td>
	</tr>
	<tr>
		<td><h3>Pictures actual truck fleet</h3></td>
	</tr>
	<tr>
		<td>Choose Pictures (upto 8) <?php echo $this->Form->input('file',array('type'=>'file','name'=>'data[MasterUser][photos][]','multiple'));?></td>
	</tr>
	<tr>
		<td><h3>Warranty, transport, delivery, return:</h3>
			<div>
				Describe the conditions of the warranty offered by your truck fleet, the return period, delivery or other contractual conditions.
			</div>
		</td>
	</tr>
	<tr>
		<td><textarea rows="5" name="data[MasterUser][warrent]" id="other_add"></textarea></td>
	</tr>
	<tr>
		<td><h3>Vehicle Brands dismantled</h3></td>
	</tr>
	<tr>
		<td colspan=2>
			<?php //echo "<pre>";print_r($brand_list);
				foreach($brand_list as $key=>$val){
					//echo $this->Form->input('', array('type'=>'checkbox','div'=>false,'name'=>'data[MasterUser][brand][]','label'=>false,'value'=>$key)).$val.'<br>';
			?>
				<input type="checkbox" name = "data[MasterUser][brand][]" value=<?php echo $key;?>> <?php echo $val; ?><br>
			<?php
				}
			?>
		</td>
	</tr>
	<tr><td><h3>Contact person at Dezmem</h3></td></tr>
	<tr>
		<td>
			<input type="radio" value="1" id="optionsRadios1" name="data[MasterUser][is_contact]" onclick="show_text_box()">Yes<br>
			<input type="radio" value="2" id="optionsRadios2" name="data[MasterUser][is_contact]">No
			<?php echo $this->Form->input('contact_name',array('type'=>'text','value'=>'','label'=>'','style'=>'display:none'));?>
		</td>
	</tr>
	<tr><td><?php echo $this->Form->button('Finishing adding park',array('type'=>'submit','div'=>false)); ?> </td></tr>
</table>
<?php echo $this->Form->end();?>

<script type="text/javascript">
	$( "#optionsRadios1" ).click(function() {
	  $( "#MasterUserContactName" ).css("display", "block");
	});
	$( "#optionsRadios2" ).click(function() {
	  $( "#MasterUserContactName" ).css("display", "none");
	});
	
	$("#MasterUserParkName").keypress(function(e) {
		if(e.which < 97 /* a */ || e.which > 122 /* z */) {
			e.preventDefault();
		}
	});
	$("#MasterUserCompanyName").keypress(function(e) {
		if(e.which < 97 /* a */ || e.which > 122 /* z */) {
			e.preventDefault();
		}
	});
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	
function chkEmail(){
	var email=$("#MasterUserEmail").val();
	var partn="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$";
	var is_avl=email.match(partn);
	if(!is_avl){
		$("#MasterUserEmail").val('');
		$("#err_msg").removeAttr("style");
	}else{
		$("#err_msg").attr("style","display:none");
	}
}
	
	function location_list(id){ 
		if(id){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'MasterUsers/add_fleet_truck/'?>",
				data: {"c_id":id},
				dataType: "json",
				success: function(data){ 
					if(data != ''){ 
					   var listItems = "<select id='MasterUserLocalityId' name='data[MasterUser][locality_id]'>";
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
	}
	
</script>