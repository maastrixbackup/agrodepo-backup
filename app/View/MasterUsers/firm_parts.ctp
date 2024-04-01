<div align='right'>
	<a href="<?php echo $this->webroot.'MasterUsers/firm_parts_listing'?>"><h2>List of Companies Parts</h2></a>
</div>
<div>
<h2>Add a business of auto parts</h2>
</div>


<h3>Company Information</h3>
<?php echo $this->Form->create('MasterUser', array('enctype' => 'multipart/form-data')); ?>
<table>

	<tr>
		<td>Commercial name of the company * (as you know the world)
		<?php echo $this->Form->input('commercial_name',array('type'=>'text','required'=>'required','value'=>@$firm_parts['commercial_name'],'label'=>''));?> 
		<?php echo $this->Form->input('fleet_id',array('type'=>'hidden','value'=>@$fp_id,'label'=>''));?>
		</td>
	</tr>
	<tr>
		<td>Name of company *<br/>
		<?php //echo $this->Form->input('company_name',array('type'=>'text','required'=>'required','value'=>@$firm_parts['comp_name'],'label'=>''));?>
		<input type='text' value='SC' style='width:30px;'  disabled='disabled'>
		<input type='text' id='MasterUserCompanyName' name='data[MasterUser][company_name]' required='required' style='width:84%;' value="<?php echo str_replace('_SRL','',str_replace('SC_','',@$firm_parts['comp_name']));?>">
		<input type='text' value='SRL' style='width:40px;' disabled='disabled'>
		</td>
	</tr>
	<tr>
		<td>VAT *<br/>
		<div>
		<input type='text' name='en' value='EN' disabled='disabled' style='width:30px'>
		<?php
		$vat=str_replace('EN_','',@$firm_parts['vat']);
		
		echo $this->Form->input('vat',array('type'=>'text','required'=>'required','value'=>$vat,'label'=>false,'div'=>false,'style'=>'width:91.6%'));?> 
		</div>
		</td>
	</tr>
	<tr><td colspan=2><h3>Location</h3></td></tr>
	<tr>
		<td>County *<?php echo $this->Form->input('country_id',array('type' => 'select','options' =>@$country,'empty'=>'- Choose region -','onChange'=>'location_list(this.value)','label'=>'','div'=>false,'value'=> @$firm_parts['country_id'])); ?></td>
	</tr>
	<tr>
		<td>City *<?php echo $this->Form->input('locality_id',array('type' => 'select','empty'=>'- Choose city -','id'=>'old_location','label'=>'','value'=>@$firm_parts['location_id'])); ?>
			<div id="hh"></div>
		</td>
	</tr>
	<tr>
		<td>Postal Code<?php echo $this->Form->input('postal_code',array('type'=>'text','value'=>@$firm_parts['postal_code'],'label'=>'','maxlength'=>'6','onkeypress'=>'return isNumberKey(event)'));?></td>
	</tr>
	<tr>
		<td>Street *<?php echo $this->Form->input('street',array('type'=>'text','required'=>'required','value'=>@$firm_parts['street'],'label'=>''));?></td>
	</tr>
	<tr>
		<td>Nr. *<?php echo $this->Form->input('nr',array('type'=>'text','required'=>'required','value'=>@$firm_parts['nr'],'label'=>''));?></td>
	</tr>
	<tr>
		<td>
			Other address details<textarea rows="3" name="data[MasterUser][other_add]" id="other_add"><?php //echo @$user_detail['User']['other_add'];?><?php echo @$firm_parts['other_add'];?></textarea>
		</td>
	</tr>
	<tr><td colspan=2><h3>Contact</h3></td></tr>
	<tr>
		<td>Phone *<?php echo $this->Form->input('phone',array('type'=>'text','required'=>'required','value'=>@$firm_parts['phone'],'label'=>'','maxlength'=>'10','onkeypress'=>'return isNumberKey(event)'));?></td>
	</tr>
	<tr> 
		<td>Fax<?php echo $this->Form->input('fax',array('type'=>'text','value'=>@$firm_parts['fax'],'label'=>'','maxlength'=>'10','onkeypress'=>'return isNumberKey(event)'));?></td>
	</tr>
	<tr>
		<td>Email *<?php echo $this->Form->input('email',array('type'=>'text','required'=>'required','value'=>@$firm_parts['email'],'label'=>'','onblur'=>'chkEmail()'));?>
			<label style='display:none' id='err_msg'><font color='red'>Enter a valid email.</font></label>
		</td>
	</tr>
	<tr>
		<td>Website<?php echo $this->Form->input('website',array('type'=>'text','value'=>@$firm_parts['website'],'label'=>''));?></td>
	</tr>
	<tr><td colspan=2><h3>About and logo</h3></td></tr>
	<tr>
		<td>
			Description * (minimum 20 characters)<textarea rows="5" "required" name="data[MasterUser][description]" id="other_add" required><?php //echo @$user_detail['User']['other_add'];?>    <?php echo @$firm_parts['description'];?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			Logo / Banner Company (160x90 pixels)
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $this->Form->input('logo',array('type'=>'file','onchange'=>'getImage(this)'));?>
			
			<?php if(@$fp_id && @$firm_parts['logo']){?>
			<div id='hid_logo_div'><input type='hidden' id='hid_logo' name='hid_logo' value=<?php echo @$firm_parts['logo'];?>>
			<img src="<?php echo $this->webroot.'img/firmparts_logo/'.@$firm_parts['logo'];?>" style="width:120px;">
			</div>
			<?php }?>
		</td>
	</tr>
	<tr>
		<td><h3>Real pictures of auto parts company</h3></td>
	</tr>
	<tr>
		<td>Choose pictures (up to 8) <?php echo $this->Form->input('file',array('type'=>'file','name'=>'data[MasterUser][photos][]','multiple','onchange'=>'getMulImage(this)')); ?>
		
		<?php if(@$fp_id && @$firm_parts['parts_pics']){?>
					<div id='parts_img_div'>
					<input type='hidden' id='parts_pics' name='parts_pics' value=<?php echo @$firm_parts['parts_pics'];?>>
					<?php $fleet_img=explode(',',@$firm_parts['parts_pics']);
						foreach($fleet_img AS $key=>$val){?>
							<span><img src="<?php echo $this->webroot.'img/firmparts_img/'.@$val;?>" style="width:120px;"></span>
						<?php
						}
					?>
					</div>
		<?php }?>
					
			   		
		</td>
	</tr>
	<tr>
		<td><h3>Warranty, transport, delivery, return:</h3>
			<div>
				Describe the conditions of the warranty offered by your company for auto parts, return period, delivery or other contractual conditions.
			</div>
		</td>
	</tr>
	<tr>
		<td><textarea rows="5" name="data[MasterUser][warrent]" id="other_add"><?php echo @$firm_parts['warranty_detail']?></textarea></td>
	</tr>
	<tr>
		<td><h3>Spare parts for brands</h3></td>
	</tr>
	<tr>
		<td colspan=2>
			<?php //echo "<pre>";print_r($brand_list);
				foreach($brand_list as $key=>$val){
					//echo $this->Form->input('', array('type'=>'checkbox','div'=>false,'name'=>'data[MasterUser][brand][]','label'=>false,'value'=>$key)).$val.'<br>';
			?>
				<input type="checkbox" name = "data[MasterUser][brand][]" value=<?php echo $key;?> <?php $brand_arr=explode(',',@$firm_parts['brand_id']);if(in_array($key,$brand_arr)){ echo 'checked';}?>> <?php echo $val; ?><br>
			<?php
				}
			?>
		</td>
	</tr>
	<tr><td><h3>Contact person at PieseAuto.ro</h3></td></tr>
	<tr>
		<td>Have you talked to a representative PieseAuto.ro before making this entry?
</td>
		</tr>
		<tr>
		<td>
			<input type="radio" required value="1" id="optionsRadios1" name="data[MasterUser][is_contact]" <?php if(@$fp_id && @$firm_parts['contact_person']){ echo 'checked';}else{ echo '';}?> onclick="show_text_box()" >YUP<br/><br/>
			<input type="radio" value="2" id="optionsRadios2" name="data[MasterUser][is_contact]" <?php if(@$fp_id &&!@$firm_parts['contact_person']){ echo 'checked';}else{ echo '';}?>>NOT
			<br/><br/>
			<label id='contact_per' style='display:none;'>
			<b><font>Fill in here the name of the person with whom you discussed PieseAuto.ro.</font></b></label>
			<?php 
			if(@$firm_parts['contact_person']){
				echo $this->Form->input('contact_name',array('type'=>'textarea','value'=>@$firm_parts['contact_person'],'label'=>'','rows'=>'2'));
			}else{
				echo $this->Form->input('contact_name',array('type'=>'textarea','value'=>'','label'=>'','style'=>'display:none','rows'=>'2'));
			}
			?>
			
		</td>
	</tr>
	<tr><td><?php 
	if(@$fp_id){
	echo $this->Form->button('Finish updating company',array('type'=>'submit','div'=>false));	
	}else{
	echo $this->Form->button('Finish adding company',array('type'=>'submit','div'=>false));
	}
	?> </td></tr>
</table>
<?php echo $this->Form->end();?>

<script type="text/javascript">
	$(window).load(function() {
      var country_id="<?php echo @$firm_parts['country_id'];?>";
	  if(country_id)
	  location_list(country_id);
    });
	$( "#optionsRadios1" ).click(function() {
	  $( "#MasterUserContactName" ).css("display", "block").attr('required','required');
	  $("#contact_per").removeAttr("style");
	});
	$( "#optionsRadios2" ).click(function() {
	  $( "#MasterUserContactName" ).css("display", "none").removeAttr('required');
	   $("#contact_per").attr("style",'display:none');
	});
	
	$("#MasterUserCommercialName").keypress(function(e) {
		if((e.which < 97 /* a */ || e.which > 122 /* z */) && !( e.which==8 || e.which==32)) {
			e.preventDefault();
		}
	});
	$("#MasterUserCompanyName").keypress(function(e) {
		if((e.which < 97 /* a */ || e.which > 122 /* z */) &&!( e.which==8 || e.which==32)) {
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
				url: "<?php echo $this->webroot.'MasterUsers/firm_parts/'?>",
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
			$("#parts_img_div").attr("style","display:none");
		}else{
			$("#parts_img_div").removeAttr("style");
		}
	}
	
</script>