<div align='right'>
	<a href="<?php echo $this->webroot.'MasterUsers/fleet_truck_list'?>"><h2>List of Trucks</h2></a>
</div>
<div>
<h2 style='color:black'>Add a fleet of truck</h2>
</div>


<font size='4'>Company Information</font>
<?php echo $this->Form->create('MasterUser', array('enctype' => 'multipart/form-data')); ?>
<table>
	<tr>
		<td>The commercial name of the park * (as you know the world)
		<?php echo $this->Form->input('park_name',array('type'=>'text','required'=>'required','value'=>@$fleet_truck['park_name'],'label'=>''));?> 
		<?php echo $this->Form->input('fleet_id',array('type'=>'hidden','value'=>@$f_id,'label'=>''));?>
		</td>
	</tr>
	<tr>
		<td>Name of company *
		<div>
		<input type='text' value='SC' style='width:30px;'  disabled='disabled'>
		<?php echo $this->Form->input('company_name',array('type'=>'text','required'=>'required','value'=>str_replace('_SRL',' ',str_replace('SC_',' ',@$fleet_truck['comp_name'])),'label'=>false,'div'=>false,'style'=>'width:84%'));?> 
		<input type='text' value='SRL' style='width:40px;' disabled='disabled'>
		</div>
		</td>
	</tr>
	<tr>
		<td>VAT *
		<div>
		<input type='text' name='en' value='EN' disabled='disabled' style='width:30px'>
		<?php echo $this->Form->input('vat',array('type'=>'text','required'=>'required','value'=>str_replace('EN_','',@$fleet_truck['vat']),'label'=>false,'div'=>false,'style'=>'width:91.6%'));?> 
		</div>
		</td>
	</tr>
	<tr><td colspan=2><font size='4'>Location</font></td></tr>
	<tr>
		<td>County *<?php echo $this->Form->input('country_id',array('type' => 'select','options' =>@$country,'empty'=>'-- Choose region --','onChange'=>'location_list(this.value)','label'=>false,'value'=> @$fleet_truck['country_id'])); ?></td>
	</tr>
	<tr>
		<td>City *<?php echo $this->Form->input('locality_id',array('type' => 'select','empty'=>'-- Choose city --','id'=>'old_location','label'=>'','value'=>@$fleet_truck['location_id'])); ?>
			<div id="hh"></div>
		</td>
	</tr>
	<tr>
		<td>Postal Code<?php echo $this->Form->input('postal_code',array('type'=>'text','value'=>@$fleet_truck['postal_code'],'label'=>'','maxlength'=>'6','onkeypress'=>'return isNumberKey(event)'));?></td>
	</tr>
	<tr>
		<td>Street *<?php echo $this->Form->input('street',array('type'=>'text','required'=>'required','value'=>@$fleet_truck['street'],'label'=>''));?></td>
	</tr>
	<tr>
		<td>Nr. *<?php echo $this->Form->input('nr',array('type'=>'text','required'=>'required','value'=>@$fleet_truck['nr'],'label'=>''));?></td>
	</tr>
	<tr>
		<td>
			Other address details<textarea rows="3" name="data[MasterUser][other_add]" id="other_add"><?php //echo @$user_detail['User']['other_add'];?><?php echo @$fleet_truck['other_add'];?></textarea>
		</td>
	</tr>
	<tr><td colspan=2><font size='4'>Contact</font></td></tr>
	<tr>
		<td>Phone *<?php echo $this->Form->input('phone',array('type'=>'text','required'=>'required','value'=>@$fleet_truck['phone'],'label'=>'','maxlength'=>'10','onkeypress'=>'return isNumberKey(event)'));?></td>
	</tr>
	<tr> 
		<td>Fax<?php echo $this->Form->input('fax',array('type'=>'text','value'=>@$fleet_truck['fax'],'label'=>'','maxlength'=>'10','onkeypress'=>'return isNumberKey(event)'));?></td>
	</tr>
	<tr>
		<td>Email *<?php echo $this->Form->input('email',array('type'=>'text','required'=>'required','value'=>@$fleet_truck['email'],'label'=>false,'onblur'=>'chkEmail()'));?>
			<label style='display:none' id='err_msg'><font color='red'>Enter a valid email.</font></label>
		</td>
	</tr>
	<tr>
		<td>Website<?php echo $this->Form->input('website',array('type'=>'text','value'=>@$fleet_truck['website'],'label'=>''));?></td>
	</tr>
	<tr><td colspan=2><font size='4'>Description park and logo</font></td></tr>
	<tr>
		<td>
			Description * (minimum 20 characters)<textarea rows="5" "required" name="data[MasterUser][description]" id="other_add"><?php //echo @$user_detail['User']['other_add'];?>    <?php echo @$fleet_truck['description'];?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			Logo / Banner park (160x90 pixels)
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $this->Form->input('logo',array('type'=>'file','onchange'=>'getImage(this)','label'=>false));?>
			
			<?php if(@$f_id && @$fleet_truck['logo']){?>
			<div id='hid_logo_div'><input type='hidden' id='hid_logo' name='hid_logo' value=<?php echo @$fleet_truck['logo'];?>>
			<img src="<?php echo $this->webroot.'img/park_logo/'.@$fleet_truck['logo'];?>" style="width:120px;">
			</div>
			<?php }?>
		</td>
	</tr>
	<tr>
		<td><font size='4'>Pictures actual truck fleet</font></td>
	</tr>
	<tr>
		<td>Choose pictures (up to 8) <?php echo $this->Form->input('file',array('type'=>'file','name'=>'data[MasterUser][photos][]','multiple','onchange'=>'getMulImage(this)','label'=>false)); ?>
		
		<?php if(@$f_id && @$fleet_truck['fleet_pics']){?>
					<div id='truck_img_div'>
					<input type='hidden' id='truck_img' name='truck_img' value=<?php echo @$fleet_truck['fleet_pics'];?>>
					<?php $fleet_img=explode(',',@$fleet_truck['fleet_pics']);
						foreach($fleet_img AS $key=>$val){?>
							<span><img src="<?php echo $this->webroot.'img/truck_img/'.@$val;?>" style="width:120px;"></span>
						<?php
						}
					?>
					</div>
		<?php }?>
					
					
		</td>
	</tr>
	<tr>
		<td><font size='4'>Warranty, transport, delivery, return:</font>
			<div>
				Describe the conditions of the warranty offered by your truck fleet, the return period, delivery or other contractual conditions.
			</div>
		</td>
	</tr>
	<tr>
		<td><textarea rows="5" name="data[MasterUser][warrent]" id="other_add"><?php echo @$fleet_truck['warranty_detail']?></textarea></td>
	</tr>
	<tr>
		<td><font size='4'>Vehicle Brands dismantled</font></td>
	</tr>
	<tr>
		<td colspan=2>
			<?php //echo "<pre>";print_r($brand_list);
				foreach($brand_list as $key=>$val){
					//echo $this->Form->input('', array('type'=>'checkbox','div'=>false,'name'=>'data[MasterUser][brand][]','label'=>false,'value'=>$key)).$val.'<br>';
			?>
				<input type="checkbox" name = "data[MasterUser][brand][]" value=<?php echo $key;?> <?php $brand_arr=explode(',',@$fleet_truck['brand_id']);if(in_array($key,$brand_arr)){ echo 'checked';}?>> <?php echo $val; ?><br>
			<?php
				}
			?>
		</td>
	</tr>
	<tr><td><font size='4'>Contact person at PieseAuto.ro</font></td></tr>
	<tr>
		<td>Have you talked to a representative PieseAuto.ro before making this entry?<br/>
			<input type="radio" value="1" id="optionsRadios1" name="data[MasterUser][is_contact]" <?php if(@$f_id && @$fleet_truck['contact_person']){ echo 'checked';}else{ echo '';}?> onclick="show_text_box()">Yes<br><br>
			<input type="radio" value="2" id="optionsRadios2" name="data[MasterUser][is_contact]" <?php if(@$f_id &&!@$fleet_truck['contact_person']){ echo 'checked';}else{ echo '';}?>>No
			<label id='msg_id' style='display:none'><b>Fill in here the name of the person with whom you discussed PieseAuto.ro.</b></label>
			<?php 
			if(@$fleet_truck['contact_person']){
				echo $this->Form->input('contact_name',array('type'=>'text','value'=>@$fleet_truck['contact_person'],'label'=>''));
			}else{
				echo $this->Form->input('contact_name',array('type'=>'text','value'=>'','label'=>'','style'=>'display:none'));
			}
			?>
		</td>
	</tr>
	<tr><td><?php 
	if(@$f_id){
	echo $this->Form->button('Finishing Updating park',array('type'=>'submit','div'=>false));	
	}else{
	echo $this->Form->button('Finishing adding park',array('type'=>'submit','div'=>false));
	}
	?> </td></tr>
</table>
<?php echo $this->Form->end();?>

<script type="text/javascript">
	$(window).load(function() {
      var country_id="<?php echo @$fleet_truck['country_id'];?>";
	  if(country_id)
	  location_list(country_id);
    });
	$( "#optionsRadios1" ).click(function() {
	  $( "#MasterUserContactName" ).css("display", "block");
	  $("#msg_id").removeAttr("style");
	});
	$( "#optionsRadios2" ).click(function() {
	  $( "#MasterUserContactName" ).css("display", "none");
	   $("#msg_id").attr("style","display:none");
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
	function getImage(obj){
		var id=obj.id;
		var logo_name=$("#"+id).val();
		if(logo_name){
			$("#hid_logo_div").attr("style","display:none");
		}else{
			$("#hid_logo_div").removeAttr("style");
		}
	}
	function getMulImage(obj){
		var id=obj.id;
		var logo_name=$("#"+id).val();
		if(logo_name){
			$("#truck_img_div").attr("style","display:none");
		}else{
			$("#truck_img_div").removeAttr("style");
		}
	}
	
</script>