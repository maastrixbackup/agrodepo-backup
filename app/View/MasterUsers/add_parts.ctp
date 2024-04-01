<style>
	input{width:65%;}
	.set{text-align:right}
</style>
<?php echo $this->Form->create('SalesAddPart', array('url'=>array('controller'=>'MasterUsers','action'=>'add_parts'),'enctype' => 'multipart/form-data')); ?>
<div>
	<table>
		<tr><td></td><td><h4>Facts about the car looking for the song</h4></td></tr>
		<tr>
			<td class='set'>Brand</td>
			<td><?php echo $this->Form->input('brand_id',array('type'=>'select','options'=>$brand_list,'empty'=>'Choose a brand','required'=>'required','label'=>false,'value'=>'','onChange'=>'show_model(this.value)'));?></td>
		</tr>
		<tr>
			<td class='set'>Model</td>
			<td>
				<?php 
					echo $this->Form->input('model_name',array('id'=>'model_11','type'=>'select','empty'=>'Choose a model','label'=>false,'div'=>false,'value'=>'')); 
					echo "<div id='show_mod'></div>";
				?>
			</td>
		</tr>
		<tr>
			<td class='set'>Version</td>
			<td><?php echo $this->Form->input('version',array('type'=>'text','label'=>false,'required'=>'required','value'=>''));?></td>
		</tr>
		<tr>
			<td class='set'>Year of manufacture</td>
			<td><?php echo $this->Form->input('manufacture_yr',array('type'=>'text','label'=>false,'required'=>'required','value'=>''));?></td>
		</tr>
		<tr>
			<td class='set'>Engines</td>
			<td><?php echo $this->Form->input('engine',array('type'=>'text','label'=>false,'required'=>'required','value'=>''));?></td>
		</tr>
		<tr>
			<td class='set'>Vehicle Identification Number</td>
			<td><?php echo $this->Form->input('identification_no',array('type'=>'text','label'=>false,'value'=>''));?></td>
		</tr>
	</table>
	
	<table id="mstr_tbl">
		<tr><td></td><td><h4>Looking for parts or accessories</h4></td></tr>
		<tr>
			<td class='set'>Name piece</td>
			<td><?php echo $this->Form->input('name_piece',array('type'=>'text','label'=>false,'required'=>'required','value'=>''));?></td>
		</tr>
		<tr>
			<td class='set'>Description</td>
			<td><?php echo $this->Form->input('description',array('type'=>'textarea','label'=>false,'value'=>'','row'=>4,'col'=>'3'));?></td>
		</tr>
		<tr>
			<td class='set'>Part No</td>
			<td><?php echo $this->Form->input('part_no',array('type'=>'text','label'=>false,'value'=>''));?></td>
		</tr>
		<tr>
			<td class='set'>Maximum price offered</td>
			<td><?php echo $this->Form->input('price',array('type'=>'text','label'=>false,'value'=>''));?>
				<?php $option = array('ron'=>'RON', 'eur'=>'EUR','usd'=>'USD');
					echo $this->Form->input('currency',array('options'=>$option,'type'=>'select','label'=>false,'value'=>''));?>
			</td>
		</tr>
		<tr>
			<td class='set'>Pictures</td>
			<td><?php echo $this->Form->input('file',array('type'=>'file','label'=>false));?></td>
		</tr>
		<tr>
			<td>
				<div onclick="open_append_offer()" id="add_more">[+] Add another piece</div>
			</td>
		</tr>
	</table>
	
	
	<table id="sec_tbl" style='display:none;'>
		<tr><td><h4>Looking for parts or accessories</h4></td><td><div onclick="remove_tbl()">Remove(X)</td></tr>
		<tr>
			<td class='set'>Name piece</td>
			<td><?php echo $this->Form->input('name_piece',array('type'=>'text','name'=>'data[SalesAddPart][Add][name_piece]','label'=>false,'value'=>''));?></td>
		</tr>
		<tr>
			<td class='set'>Description</td>
			<td><?php echo $this->Form->input('description',array('type'=>'textarea','name'=>'data[SalesAddPart][Add][description]','label'=>false,'value'=>'','row'=>4,'col'=>'3'));?></td>
		</tr>
		<tr>
			<td class='set'>Part No</td>
			<td><?php echo $this->Form->input('part_no',array('type'=>'text','name'=>'data[SalesAddPart][Add][part_no]','label'=>false,'value'=>''));?></td>
		</tr>
		<tr>
			<td class='set'>Maximum price offered</td>
			<td><?php echo $this->Form->input('price',array('type'=>'text','name'=>'data[SalesAddPart][Add][price]','label'=>false,'value'=>''));?>
				<?php $option = array('ron'=>'RON', 'eur'=>'EUR','usd'=>'USD');
					echo $this->Form->input('currency',array('options'=>$option,'name'=>'data[SalesAddPart][Add][currency]','type'=>'select','label'=>false,'value'=>''));?>
			</td>
		</tr>
		<tr>
			<td class='set'>Pictures</td>
			<td><?php echo $this->Form->input('file',array('type'=>'file','name'=>'data[SalesAddPart][Add][file]','label'=>false));?></td>
		</tr>
		<tr>
			<td>
				<div onclick="append_offer()">[+] Add another piece</div>
			</td>
		</tr>
	</table>
	
	<div id='append_frm'></div>
	
	<table>
		<tr><td>I offer parts</td></tr>
		<tr>
			<td><?php echo $this->Form->input('we',array('type'=>'checkbox','label'=>false,'value'=>'1','div'=>false))."We<br>"; ?>
				<?php echo $this->Form->input('from_truck',array('type'=>'checkbox','label'=>false,'value'=>'2','div'=>false))."From Truck"; ?>
			</td>
		</tr>
		<tr><td colspan=2>Where do you want to shipped?</td></tr>
		<tr>
			<td>
				<?php 
					echo $this->Form->input('country_id',array('type' => 'select','options' => $country,'empty'=>'Choose region','label'=>'Region','required'=>'required','onChange'=>'location_list(this.value)')); 
					echo "City".$this->Form->input('location_id1',array('id'=>'loc_11','type'=>'select','label'=>'City','empty'=>'Choose city','label'=>false,'div'=>false,'value'=>'')); 
					echo "<div id='show_location'></div>";
				?>
			</td>
		</tr>
	</table>
	<div><?php echo $this->Form->button('Add Request',array('type'=>'submit','div'=>false));?></div>
	<div><a href="<?php echo $this->webroot.'Logins/user_dashboard' ?>"><?php echo $this->Form->button('Back',array('type'=>'button','div'=>false));?></a></div>
</div>
<?php echo $this->Form->end(); ?>


<script type="text/javascript">
	$("#SalesAddPartNamePiece").keypress(function(e) {
		var kc=e.which;
		// 97->a 122->z 65->A 90->Z
		if(!((kc>=65 && kc <=90 )|| (kc >= 97 && kc <= 122) ) && kc!=8) {
		e.preventDefault();
        }
	});



	/*function append_offer(){ alert('hii');
		var appen = "<table><tr><td></td><td><h4>Looking for parts or accessories</h4></td></tr><tr><td class='set'>Name piece</td><td><?php echo $this->Form->input('name_piece',array('type'=>'text','label'=>false,'required'=>'required','value'=>''));?></td></tr><tr><td class='set'>Description</td><td><?php echo $this->Form->input('description',array('type'=>'textarea','label'=>false,'value'=>'','row'=>4,'col'=>'3'));?></td></tr><tr><td class='set'>Part No</td><td><?php echo $this->Form->input('part_no',array('type'=>'text','label'=>false,'value'=>''));?></td></tr><tr><td class='set'>Maximum price offered</td><td><?php echo $this->Form->input('price',array('type'=>'text','label'=>false,'value'=>''));?><?php $option = array('ron'=>'RON', 'eur'=>'EUR','usd'=>'USD');echo $this->Form->input('currency',array('options'=>$option,'type'=>'select','label'=>false,'value'=>''));?></td></tr><tr><td class='set'>Pictures</td><td><?php echo $this->Form->input('file',array('type'=>'file','label'=>false));?></td></tr></table>";
		$("#append_frm").html(appen);
	}*/

	function append_offer(){
		//$('#append_frm').html($('#mstr_tbl').clone().attr('id', 'tableb_copy'));
		$("#sec_tbl").css("display", "block");
		$( "#sec_tbl" ).clone().appendTo("#append_frm");
	}
	function open_append_offer(){
		$("#add_more").css("display", "none");
		$("#sec_tbl").css("display", "block");
	}
	function remove_tbl(){ 
		$("#sec_tbl").css("display", "none");
		if( $("#sec_tbl").css("display", "block") ){
			$("#sec_tbl").css("display", "none");
		}
	}
	function show_model(id){
		if(id){ 
			jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'MasterUsers/post_add/'?>",
				data: {"brand_id":id},
				dataType: "json",
				success: function(data){  
					if(data){  
					   var listItems = "<select label ='City' id='load_model' name='data[SalesAddPart][model_id]'>";
						$.each(data, function(key, value) {
							//console.log(key);console.log(value);
							listItems+= "<option value='" + key + "'>" + value + "</option>";
						});
						listItems+="</select>";
						$("#show_mod").css("display", "block");
						$("#model_11").css("display", "none");
						$("#load_model").css("display", "block");
						$("#show_mod").html(listItems);
						
					}else{ 
						$("#show_mod").css("display", "none");
						$("#show_mod").html('');
						$("#load_model").css("display", "none");
						$("#model_11").css("display", "block");
					}
				}
			});
		}else{ 
			$("#show_mod").css("display", "none");
			$("#show_mod").html('');
			$("#load_model").css("display", "none");
			$("#model_11").css("display", "block");
		}
	}
	
	function location_list(id){ //alert(id);
		if(id){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'MasterUsers/add/'?>",
				data: {"c_id":id},
				dataType: "json",
				success: function(data){ 
					if(data != ''){ 
					   var listItems = "<select id='location11' name='data[SalesAddPart][location_id]'>";
						$.each(data, function(key, value) {
							//console.log(key);console.log(value);
							listItems+= "<option value='" + key + "'>" + value + "</option>";
						});
						listItems+="</select>";
						$("#loc_11").css("display", "none");
						$("#show_location").html(listItems);
					}else{ 
						$("#show_location").html('');
						$("#loc_11").css("display", "block");
						$("#location11").css("display", "none");
					}
				}
			});
		}else{
			$("#show_location").html('');
			$("#loc_11").css("display", "block");
			$("#location11").css("display", "none");
		}
	}
</script>