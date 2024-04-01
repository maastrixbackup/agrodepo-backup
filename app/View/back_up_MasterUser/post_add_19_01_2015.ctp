<style>
	.fl{float:left;}
</style>

<?php echo $this->Form->create('MasterUser', array('enctype' => 'multipart/form-data')); ?>
<div>
	<span class="fl">
		<h2>Category</h2>
	</span>
	<span class="fl">
		<h2>Description</h2>
	</span>
	<span class="fl">
		<h2>Preview Add</h2>
	</span>
	<span class="fl">
		<h2>Ready</h2>
	</span>
</div>

<div id="category" style="display:block">
	<?php
		echo "<div id='cat_err'></div>";
		echo "<div style='float:left; clear:none'>".$this->Form->input('category_id',array('type' => 'select','options' => @$cat_list,'empty'=>'Choose one category','onChange'=>'show_subcat(this.value)'))."</div>";
		echo '<div id="sub_cat_show" style="float:left; clear:none;margin-top: 30px;"></div>';
		
		echo $this->Form->input('sub_cat',array('id'=>'sub_cat','type'=>'text','readonly'=>false,'label'=>false,'div'=>false,'value'=>'')); 
	?>
		<div onclick="show_section2()">Carry On</div>
</div>

<div id="description" style="display:none">
	<span>category will be added to the add.<a href='#' onclick="open_prev()">Edit</a></span>
	<?php
		echo "Name of Song - ".$this->Form->input('song_name',array('id'=>'song_nm','required'=>'required','type'=>'text','readonly'=>false,'label'=>false,'div'=>false,'value'=>'')); 
		echo "<div>Details about the song</div>";
		echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
		echo $this->Form->textarea('myelement', array('class'=>'ckeditor','required'=>'required',)); 
		echo "Photo if the song - ".$this->Form->input('photos',array('id'=>'file_','type'=>'file','name'=>'data[MasterUser][photos][]','label'=>false,'multiple')); 
		
		//echo "<input type='file' name='data[MasterUser][image]' id='FileImage' />";
		
		echo "<div style='float:left; clear:none'>Make and Model car".$this->Form->input('brand',array('type'=>'select','required'=>'required','options'=>$brand_list,'id'=>'brand_nm','label'=>false,'empty'=>'Choose brand','onChange'=>'choose_model(this.value)'))."</div>";
		echo "<div style='float:left; clear:none;margin-top: 30px;' id='mod'>".$this->Form->input('model_list', array('type'=>'select','label'=>false,'div'=>false,'empty'=>'Choose the model'))."</div>";
		echo "<div id='model_name' style='float:left; clear:none;margin-top: 30px;'></div>";
		echo "<div style='float:left; clear:none;margin-top: 30px;'><input type='button' id='add_more' value='Add' onclick='add_more_brand_model();'></div>";
		echo "<div id='show_brand_model'></div>";
		
		
		
		$options = array('new'=>'New', "old"=>'Old');
		echo $this->Form->input('product_cond', array('type'=>'select','required'=>'required','options'=>$options,'id'=>'product_cond','label'=>false)); 
		
		echo "Price".$this->Form->input('price', array('type'=>'text','required'=>'required', 'label'=>false,'id'=>'price'));
		$opt = array('RON'=>'RON');
		echo "Currency".$this->Form->input('currency', array('type'=>'select','options'=>$opt,'label'=>false,'id'=>'currency'));
		echo "Quantity Available:".$this->Form->input('quantity', array('type'=>'text','required'=>'required', 'label'=>false,'id'=>'quantity'));
		
		echo "<div>what methods of payment have accepted</div>";
		echo "<div id='payment_err'></div>";
		echo $this->Form->input('cash', array('type'=>'checkbox','id'=>'cash','div'=>false,'label'=>false,'value'=>1)).'Cash on Delivery<br>';
		echo $this->Form->input('upon', array('type'=>'checkbox','id'=>'upon','div'=>false,'label'=>false,'value'=>2)).'Upon Delivery<br>';
		echo $this->Form->input('wire', array('type'=>'checkbox','id'=>'wire','div'=>false,'label'=>false,'value'=>3)).'Wire Transfer<br>';
		echo $this->Form->input('card', array('type'=>'checkbox','id'=>'card','div'=>false,'label'=>false,'value'=>4)).'Banking Card<br>';
		echo $this->Form->input('other', array('type'=>'checkbox','id'=>'other','div'=>false,'label'=>false,'value'=>5)).'Others';
		
		echo "<div>How to send the song to the customer ?</div>";
		echo "<div>Method of delivery:</div>";
		echo $this->Form->input('', array('type'=>'checkbox','id'=>'personal_teach','div'=>false)).'Personal teaching';
		echo $this->Form->input('', array('type'=>'checkbox','id'=>'courier','div'=>false)).'Courier<br>';
		echo "Delivery Cost".$this->Form->input('price', array('type'=>'text', 'label'=>false,'id'=>'price')).'RON<br>';
		echo $this->Form->input('', array('type'=>'checkbox','id'=>'free_del','div'=>false)).'Free delivery by courier';
		$opt = array('1'=>'1 day','2'=>'2 days','3'=>'3 days','4'=>'4 days','5'=>'5 days','10'=>'10 days','15'=>'15 days','30'=>'30 days');
		echo "Time required for dispatch".$this->Form->input('dispatch_time', array('type'=>'select','options'=>$opt, 'label'=>false,'id'=>'dispatch_time'));
		echo $this->Form->button('Carry On',array('type'=>'submit','div'=>false));
		//echo $this->Form->button('Carry On',array('type'=>'button','div'=>false,'onclick'=>'return show_section3()'));
	?>
		<!--div onclick="show_section3()">Carry On</div-->
	<!--input type="submit"-->
</div>

<div id="preview_add" style="display:none">
	<div><h3>1. Preview Ad</h3></div>
	<a href = "#">Click here</a>&nbsp; to preview your ad before definitive public.
	<div><h3>2. Public Notic</h3></div>
	<div>
		<span><?php echo $this->Form->button('Modify',array('type'=>'button','div'=>false)); ?></span>
		<span><?php echo $this->Form->button('Advertiser',array('type'=>'button','div'=>false)); ?></span>
	</div>
</div>

<?php echo $this->Form->end(); ?>


<script src="<?php echo $this->webroot ?>js/jquery.js"></script>
<script src="<?php echo $this->webroot ?>js/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {	
	<?php  if(isset($saved_data) && !empty($saved_data)){?>
		$("#category").css("display", "none");
		$("#description").css("display", "none");
		$("#preview_add").css("display", "block");
		
	<?php } ?>


	$('#sub_cat').focus(function(){
		var cid = $("#MasterUserCategoryId option:selected").val(); //alert(cid);
		$("#sub_cat").autocomplete("<?php echo $this->webroot; ?>MasterUsers/auto_sub_cat/"+cid, {
			width:500
		});
		$("#sub_cat").result(function(event,data,formatted){ 
			
		});
	});
});

function chk_chkbox(){ alert(99);
	if( $("#cash").is(':checked') || $("#upon").is(':checked') || $("#wire").is(':checked') || $("#card").is(':checked') || $("#other").is(':checked') ){
		return;
	}else{
		$("#payment_err").html('Please choose atleast one payment mode.');
	}
}


function add_more_brand_model(){
	var brand_id = $("#brand_nm option:selected").val();
	var brand_nm = $("#brand_nm option:selected").text(); 
	
	var model_id = $("#load_model option:selected").val(); 
	var model_nm = $("#load_model option:selected").text(); 
	var rand = Math.random();;
	var inner_details = "<div id='div"+rand+"'><input type='button' id='remove' value='x' style='width:50px' onclick='remove_div("+rand+")'><input type='text' name='data[MasterUser][brand_nm"+rand+"]' value="+brand_nm+" style='width:100px'><input type='text' name='data[MasterUser][model_nm"+rand+"]' value='"+model_nm+"' style='width:100px'><input type='text' name='data[MasterUser][brand_nm"+rand+"]' value='"+brand_id+"' style='width:100px'><input type='text' name='data[MasterUser][model_nm"+rand+"]' value='"+model_id+"' style='width:100px'></div>";
	$("#show_brand_model").append(inner_details);	
}

function remove_div(id){ 
	document.getElementById("div"+id).innerHTML = "";
	//$("#div"+id).html('');
}

function show_subcat(id){ 
	if(id){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'MasterUsers/post_add/'?>",
				data: {"cat_id":id},
				dataType: "json",
				success: function(data){  
					if(data != ''){ 
					   var listItems = "<select id='MasterUserSubcategoryId' name='data[MasterUser][sub_cat_id]'>";
						$.each(data, function(key, value) {
							console.log(key);console.log(value);
							listItems+= "<option value='" + key + "'>" + value + "</option>";
						});
						listItems+="</select>";
						//$("#old_location").css("display", "none");
						$("#sub_cat_show").html(listItems);
					}else{ 
						$("#sub_cat_show").html('');
						$("#MasterUserSubcategoryId").css("display", "none");
					}
				}
			});
		}else{
			$("#sub_cat_show").html('');
			$("#MasterUserSubcategoryId").css("display", "none");
		}
}

function choose_model(id){  
	if(id){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'MasterUsers/post_add/'?>",
				data: {"brand_id":id},
				dataType: "json",
				success: function(data){  
					if(data){  
					   var listItems = "<select id='load_model' name='data[MasterUser][brand_model_nm]'>";
						$.each(data, function(key, value) {
							console.log(key);console.log(value);
							listItems+= "<option value='" + key + "'>" + value + "</option>";
						});
						listItems+="</select>";
						$("#mod").css("display", "none");
						$("#model_name").html(listItems);
					}else{ 
						$("#model_name").css("display", "none");
						$("#model_name").html('');
						$("#load_model").css("display", "none");
						$("#mod").css("display", "block");
					}
				}
			});
		}else{
			$("#model_name").html('');
			$("#load_model").css("display", "none");
			$("#mod").css("display", "block");
		}
}

function open_prev(){ 
	$("#category").css("display", "block");
	$("#description").css("display", "none");
}
function show_section2(){ 
	var cat_nm = $("#MasterUserCategoryId option:selected").val(); //alert(cid);
	if(cat_nm){
		$("#cat_err").html('');
		$("#category").css("display", "none");
		$("#description").css("display", "block");
	}else{
		$("#cat_err").html('Please choose one category.');
	}
	
}
function show_section3(){ 
	//$("#description").css("display", "none");
	//$("#preview_add").css("display", "block");
	/*var category_id = $("#MasterUserCategoryId").val();
	var sub_cat_id = $("#MasterUserSubcategoryId").val();
	var adv_name = $("#song_nm").val();
	var adv_detail = $("#MasterUserMyelement").val();
	
	
	
	var person = {firstName:"John", lastName:"Doe", age:46};
	jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'MasterUsers/post_add/'?>",
				data: {"person":person},
				//dataType: "json",
				success: function(data){  //alert(data);
					if(data){ 
					  
					}
				}
			});*/
	
	
}
</script>