<style>
	.loca{display:none;}
</style>

<div class="masterUsers form">
<?php //echo "<pre>";print_r($country);exit;
	echo $this->Form->create('MasterUser'); ?>
	<fieldset>
		<legend><?php echo __('Add Master User'); ?></legend>
	<?php
		echo $this->Form->input('full_name');
		echo $this->Form->input('email',array('autocomplete'=>'off'));
		echo $this->Form->input('pass',array('type'=>'password','id'=>'pwd'));
		echo $this->Form->input('confirm_pass',array('type'=>'password','id'=>'rpwd','onclick'=>'match_pass()'));
		echo "<div id='err_confpaw'></div>";
		echo $this->Form->input('telephone');
		echo $this->Form->input('country_id',array('type' => 'select','options' => $country,'empty'=>'Choose one country','onChange'=>'location_list(this.value)'));
		echo "<label for='MasterUserLocalityId'>Locality</label>";
		echo $this->Form->input('locality_id',array('type' => 'select','empty'=>'Choose one location','id'=>'old_location','label'=>''));
		echo '<div id="hh"></div>'; 
	?>
		<label for="MasterUserUserType">User Type</label>
	<?php	$options = $user_type;
		$attributes=array('legend'=>false,'value' => '1');
		echo $this->Form->radio('user_type',$options,$attributes);
		echo $this->Form->input('', array('type'=>'checkbox','id'=>'trms','class'=>'ch','onclick'=>'chk_but()'))."I accept all the terms and conditions";
	?>
	</fieldset>
<?php echo "<div id='sho'>".$this->Form->end(__('Submit'))."</div>"; ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Master Users'), array('action' => 'index')); ?></li>
	</ul>
</div>


<script src="<?php echo $this->webroot ?>js/jquery.js"></script>
<script src="<?php echo $this->webroot ?>js/jquery.min.js"></script>
<script src="<?php //echo $this->webroot ?>js/jquery-1.5.2.min.js"></script>
<script type="text/javascript">
	 //$("body").on("click", ".ch", function(){
	  //alert("checked");
	//});
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
		jQuery.ajax({
            type: "POST",
            url: "<?php echo $this->webroot.'MasterUsers/add/'?>",
            data: {"c_id":id},
            dataType: "json",
            success: function(data){
               // alert(data);
			   var listItems = "<select id='MasterUserLocalityId' name='data[MasterUser][locality_id]'>";
				$.each(data, function(key, value) {
					//console.log(key);console.log(value);
					listItems+= "<option value='" + key + "'>" + value + "</option>";
				});
				listItems+="</select>";
				//alert(listItems);
				$(".loca").css("display", "block");
				$("#old_location").addClass('loca');
				$("#hh").html(listItems);
            }
        });
	}
	$('body').on('click', function(){ 
      var pas = $("#pwd").val(); 
	  var rpas = $("#rpwd").val();
	  if(pas && rpas){ //alert('kkk');
		if(pas === rpas){
			$("#err_confpaw").html('');
		}else{
			$("#err_confpaw").html('Password and conformpassword should same.');
		}
		
	 }
    });
</script>