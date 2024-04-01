<style>
	.fl{float:left;}
	
</style>
<?php //echo "<pre>";print_r($saved_data_info);?>
<?php echo $this->Form->create('MasterUser', array('enctype' => 'multipart/form-data')); ?>
<!--<div>
	<span class="fl">
		<h2><a href='javascript:void(0)'>Choose Category</a> > </h2>
	</span>
	<span class="fl">
		<h2><a href='javascript:void(0)'>Description</a> > </h2>
	</span>
	<span class="fl">
		<h2><a href='javascript:void(0)'>Preview ad </a>> </h2>
	</span>
	<span class="fl">
		<h2><a href='javascript:void(0)'>Ready!</a></h2>
	</span>
	<span style="float:right"><a href="<?php echo $this->webroot.'Logins/user_dashboard' ?>"><?php echo $this->Form->button('Back',array('type'=>'button','div'=>false));?></a></span>
</div> -->
<div id='succ'  style='color:green;font-weight: bold;'></div>
<?php echo $this->Form->input('modify_id',array('type'=>'hidden', 'value'=>@$saved_data_info['SalesAdvertisement']['adv_id']));?>
<div id="category" style="display:block">
	<?php
		//echo "<div id='cat_err' style='color:red'></div>";
		//echo "<div style='float:left; clear:none'>".$this->Form->input('category_id',array('label' => 'Chose Category','size' => 10,'type' => 'select','options' => @$cat_list,'empty'=>'Choose one category','onChange'=>'show_subcat(this.value)','value'=>@$saved_data_info['SalesAdvertisement']['category_id']))."</div>";
		//echo '<div id="sub_cat_show" style="float:left; clear:none;margin-top: 30px;"></div>';
		
		//echo $this->Form->input('sub_cat',array('id'=>'sub_cat','type'=>'text','readonly'=>false,'label'=>'... Or search for the name of the class','placeholder' => '','value'=>'')); 
	?>
		<!--<div id="category_carry" onclick="show_section2()" style='cursor:pointer;text-decoration: underline;'>carray on</div>-->
        
</div>

<div id="description" style="display:none">
	<span>The category will be added to the ad:<br/><a href='#' onclick="open_prev()">Edit</a></span><br/>
	<?php
		echo "<h3>1. Name of the song</h3>";
		echo "Use a title as suggestive and completely. <br/>
eg BMW 3 Series E46 front bumper year in 2001 with projectors and green grid".$this->Form->input('song_name',array('id'=>'song_nm','required'=>'required','type'=>'text','readonly'=>false,'label'=>false,'div'=>false,'value'=>@$saved_data_info['SalesAdvertisement']['song_name'])); 
		echo "<h3>2. Details about the song sold</h3>";
		echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
		echo "Describe as detailed piece on sale. The more customers,<br/>
the chances of selling increase exponentially.<br/>It is forbidden to publish contact information (phone, email, website, etc) within the ad and pictures.".$this->Form->textarea('myelement', array('class'=>'ckeditor','required'=>'required','value'=>@$saved_data_info['SalesAdvertisement']['myelement'])); 
echo "<h3>3. Photos of the song (be careful not to be less than 250x250 pixels)</h3>";
		echo "Tip: You can select multiple photos at the same time! <br/>
To increase your chances of selling adds more real pictures by piece from different angles.";
echo "Choose pictures (up to 8)".$this->Form->input('photos',array('id'=>'file_','type'=>'file','name'=>'data[MasterUser][photos][]','label'=>false,'div'=>false,'multiple')); 
		
		//echo "<input type='file' name='data[MasterUser][image]' id='FileImage' />";
		echo "<h3>4. Make and Model Car</h3>";
		echo "<div style='float:left; clear:none'>Your ad will appear in searches like 'lighthouse Logan' unless you select 'Logan' below.<br/> 
Select models are not compatible with the song sold erase the announcement.<br/>".$this->Form->input('brand',array('type'=>'select','required'=>'required','options'=>$brand_list,'id'=>'brand_nm','label'=>false,'empty'=>'Choose brand','onChange'=>'choose_model(this.value)'))."</div>";
		echo "<div style='float:left; clear:none;margin-top: 30px;' id='mod'>".$this->Form->input('model_list', array('type'=>'select','label'=>false,'div'=>false,'empty'=>'Choose the model'))."</div>";
		echo "<div id='model_name' style='float:left; clear:none;margin-top: 30px;'></div>";
		echo "<div style='float:left; clear:none;margin-top: 30px;'><input type='button' id='add_more' value='Add' onclick='add_more_brand_model();'></div>";
		echo "<div id='show_brand_model'></div>";
		
		
		
		$options = array('Select' => '','new'=>'New', "old"=>'Old');
		echo "Product condition".$this->Form->input('product_cond', array('type'=>'select','required'=>'required','options'=>$options,'id'=>'product_cond','label'=>false,'value'=>@$saved_data_info['SalesAdvertisement']['product_cond'])); 
		
		echo "Price".$this->Form->input('price', array('type'=>'text','required'=>'required', 'label'=>false,'id'=>'price','value'=>@$saved_data_info['SalesAdvertisement']['price'])); 
		$opt = array('RON'=>'RON');
		echo "Currency".$this->Form->input('currency', array('type'=>'select','options'=>$opt,'label'=>false,'id'=>'currency','value'=>@$saved_data_info['SalesAdvertisement']['currency']));
		echo "Quantity Available:".$this->Form->input('quantity', array('type'=>'text','required'=>'required', 'label'=>false,'id'=>'quantity','onkeypress'=>'return isNumberKey(event)'));
		
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
		echo "Delivery Cost".$this->Form->input('delivery_cost', array('type'=>'text', 'label'=>false,'id'=>'delivery_cost')).'RON<br>';
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
	<a href = "#" onclick="show_all()">Click here</a>&nbsp; to preview your ad before definitive public.
	<div><h3>2. Public Notice</h3></div>
	<div>
		<span id="before_modify"><?php echo $this->Form->button('Preview',array('type'=>'button','div'=>false,'onclick'=>'show_all()')); ?></span>
		<span id="after_modify" style="display:none"><?php echo $this->Form->button('Modify',array('type'=>'submit','div'=>false)); ?></span>
		<span><?php echo $this->Form->button('Advertiser',array('type'=>'button','div'=>false)); ?></span>
	</div>
</div>

<div id="ready" style="display:none">
	<div><h3>Congratulations</h3></div>
	<div>
		<span><?php echo $this->Form->button('Ad',array('type'=>'button','div'=>false,'onclick'=>'show_msg(1);')); ?></span>
		<span><?php echo $this->Form->button('promotes',array('type'=>'button','div'=>false,'onclick'=>'show_msg(2);')); ?></span>
	</div>
</div>

<?php echo $this->Form->end(); ?>



<div class="container">
		<div class="row">
					
			<div class="innerpanel">
				<!-- Left Sidebar Start -->
					<div class="col-md-12 prof">
						 <div class="clearfix" style="height:15px;"></div>
						 
                         <div id="breadcrumb">
                            <ul class="crumbs">
                                <li class="first">
                                	<a style="z-index:9;" href="index.html"><span></span>Auto Parts</a>
                                </li>
								<li class="first">
                                	<a style="z-index:9;" href="index.html"><span></span> Truck Parks</a>
                                </li>
                                <li class="last"><a style="z-index:7;" href="javascript:void(0);">Parks Truck</a></li>   
                            </ul>
                        </div>
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                         <h2 class="detailstitle1" style="color:#DF5E08">Choose category</h2>
                         
                         <div class="clearfix" style="height:15px;"></div>
                         
						 <div class="col-lg-12">
						 	<div class="row">
								
						       <!--form 1-->
                                <?php echo $this->Form->input('modify_id',array('type'=>'hidden', 'value'=>@$saved_data_info['SalesAdvertisement']['adv_id']));?>
                                 
                                     <ul class="sellitem_progress">
									 
                                          <li class="active"><a href="choose_category.html">Choose category</a><div class="arrw_btm"></div></li>
                                          <li><a href="choose_category_2.html">Description</a><div class="arrw_btm"></div></li>
                                          <li><a href="choose_category_3.html">Preview ad</a><div class="arrw_btm"></div></li>
                                          <li><a href="choose_category_4.html">Ready!</a><div class="arrw_btm"></div></li>
                                      </ul>
                                       <div class="clear40"></div>
							 <div id="category" style="display:block">
                                      <p class="sip_head">Categoria</p>
                                       <div class="clear10"></div>
                                       <ul class="cat_tree">  <li class="item">
									   <?php echo$this->Form->input('category_id',array('size' => 15,'label'=>false,'type' => 'select','options' => @$cat_list,'empty'=>'Choose one category','onChange'=>'show_subcat(this.value)','value'=>@$saved_data_info['SalesAdvertisement']['category_id'],'multiple'=>'multiple'));?>
                                           <?php echo '<div id="sub_cat_show" onchange="showCat()"></div>'; ?>
		
                                       </li></ul>
                                 
                                 
                                 <div class="clear15"></div>
								 
                                 <p class="sip_head"><font>... Or search for the name of the class</font></p>
                                 <div class="clear15"></div>
                                 <div> 
								 <?php echo $this->Form->input('sub_cat',array('id'=>'sub_cat','type'=>'text','readonly'=>false,'label'=>false,'placeholder' => 'Începe să scrii aici numele categoriei sau al piesei ','value'=>'','autocomplete'=>'off','class'=>'ac_input','div'=>false)); ?>
								 
								<input id="category_search_button" type="button"> <div class="clearing"></div> </div>
                                 
                                 <div class="clear40"></div>
                                 <div class="row searchlistdata">
                                	<ul class="col-lg-8 carryul">
                                    	<li>
                                        	<div class="col-lg-1" style="text-align:center;">
                                            	<div class="row">
                                                	<a href="#">
                                                        <img src="images/ico-ok.png" alt="" width="30">
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                            	<div class="datalistitem">
                                                	<h1><a href="#">You have selected category:</a></h1>
                                                    <p id='slect_cat'>
													</p>
                                                    <div class="clear"></div>
                                                 </div>
                                            </div>
                                            
                                            <div class="col-lg-2" style="min-height:32px;">
                                            	<div class="row carry">
												 <input type="button" name="category_carry" id="category_carry" onclick="show_section2()" disabled="disabled" class="newsletter_snd_btn" value="Carry On">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
										
										
                                    </ul>
                                </div>
								</div>
                                 </form>
								<!--form 1-->
							</div>
						 </div>
						 
                         
                        <div class="clear"></div>
                        
					</div>
				<!-- Left Sidebar End -->
				
				
				<div class="clearfix" style="height:1px;"></div>
                
                
                 
                
                          
			   
			</div>
		</div>
		<div class="clearfix"></div>
    </div>









<script type="text/javascript">
	
	function showCat(){
		/*var cat=$("#category_id").val();
		var sub_cat=$("#MasterUserSubcategoryId").val();
		alert($("#slect_cat").text());
		
		//alert(cat_name+"---"+sub_cat_name);
		$("#slect_cat").html('<span style="color:#DF5E08; font-weight:bold;"></span>');*/
		
	}

	function show_msg(id){ alert(id);
		if(id == 1){
			$("#succ").html('');
			$("#succ").html('Your add has been added');
			$('html, body').animate({ scrollTop: 0 }, 'slow');
		}else{
			$("#succ").html('');
			$("#succ").html('Your add has been promoted');
			$('html, body').animate({ scrollTop: 0 }, 'slow');
		}
	}

	$("#song_nm").keypress(function(e) {
		var kc=e.which;
		// 97->a 122->z 65->A 90->Z
		if(!((kc>=65 && kc <=90 )|| (kc >= 97 && kc <= 122) ) && kc!=8) {
		e.preventDefault();
        }
    });
	function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
    }



function enabledButton(subcatval)
{

	if(subcatval!='')
	{
		$("#category_carry").removeAttr("disabled");
	}
	else
	{
		$("#category_carry").attr("disabled",'disabled');
	}
}



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
		$("#sub_cat").result(function(event,data,formatted){  //alert(data);
			
		});
	});
	
	var category_idd  = $("#MasterUserCategoryId option:selected").val();
	show_subcat(category_idd);
	
});

function show_all(){ 
	$("#category_carry").css("display", "none");
	$("#category").css("display", "block");
	$("#description").css("display", "block");
	$("#preview_add").css("display", "block"); 
	$("#before_modify").css("display", "none");
	$("#after_modify").css("display", "block");
	$("#preview_add").css("display", "none");
	$("#ready").css("display", "block");
	
}

function chk_chkbox(){ 
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
	if(brand_id){
		var rand = Math.random();
		var inner_details = "<div id='div"+rand+"'><input type='button' id='remove' value='x' style='width:50px' onclick='remove_div("+rand+")'><input type='text' name='data[MasterUser][brand_nm"+rand+"]' value="+brand_nm+" style='width:100px'><input type='text' name='data[MasterUser][model_nm"+rand+"]' value='"+model_nm+"' style='width:100px'><input type='hidden' name='data[MasterUser][brand_nm"+rand+"]' value='"+brand_id+"' style='width:100px'><input type='hidden' name='data[MasterUser][model_nm"+rand+"]' value='"+model_id+"' style='width:100px'></div>";
		$("#show_brand_model").append(inner_details);
	}
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
					   var listItems = "<select id='MasterUserSubcategoryId' name='data[MasterUser][sub_cat_id]' size='15' onchange='return enabledButton(this.value);'>";
						$.each(data, function(key, value) {
							console.log(key);console.log(value);
							listItems+= "<option class='has_children' value='" + key + "'>" + value + "</option>";
						});
						listItems+="</select>";
						//$("#old_location").css("display", "none");
						$("#sub_cat_show").html(listItems);
					}else{ 
						$("#sub_cat_show").html('');
						$("#MasterUserSubcategoryId").css("display", "none");
						$("#category_carry").attr("disabled",'disabled');
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
							listItems+= "<option class='has_children' value='" + key + "'>" + value + "</option>";
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
function show_section2(){ alert(3333);
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