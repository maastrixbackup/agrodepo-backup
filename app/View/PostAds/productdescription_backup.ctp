<script type="text/javascript" src="<?php echo $base_url;?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(function() {
	$( "#PostAdFreeRomanianMail" ).click(function() {
		if($("#PostAdFreeRomanianMail").is(":checked")==true)
		{
			$("#PostAdRomanianMailCost").val(0);
			$("#PostAdRomanianMailCost").attr("readonly","readonly");
		}else
		{
			$("#PostAdRomanianMailCost").removeAttr("readonly");
		}
	});
	$( "#PostAdFreeCourier" ).click(function() {
		if($("#PostAdFreeCourier").is(":checked")==true)
		{
			$("#PostAdCourierCost").val(0);
			$("#PostAdCourierCost").attr("readonly","readonly");
		}else
		{
			$("#PostAdCourierCost").removeAttr("readonly");
		}
	});
	
});
function show_subcat(id){ 
	if(id){
		jQuery.ajax({
				type: "POST",
				url: "<?php echo $base_url.'PostAds/catdetail'?>",
				data: "cat_id="+id,
				success: function(data){  
					if(data != ''){ 
					  $("#catname").html(data);
					  $("#subcatname").html('');
					  $("#chagecat").html(data);
					  $("#changsubcat").html('');
					}else{ 
						$("#chagecat").html('');
					}
				}
			});
			jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'PostAds/subcatajax'?>",
				data: {"cat_id":id},
				dataType: "json",
				success: function(data){  
					if(data != ''){ 
					   var listItems = "";
						$.each(data, function(key, value) {
							console.log(key);console.log(value);
							listItems+= "<option value='" + key + "'>" + value + "</option>";
						});
						
						$("#PostAdSubCatId").html(listItems);
						$("#PostAdSubCatId").show();
					}else{ 
						$("#PostAdSubCatId").html('');
						$("#PostAdSubCatId").show();
						//$("#category_carry").attr("disabled",'disabled');
					}
				}
			});
		}else{
			$("#PostAdSubCatId").html('');
		}
}
function enabledButton(subcatval)
{
	jQuery.ajax({
				type: "POST",
				url: "<?php echo $base_url.'PostAds/catdetail'?>",
				data: "cat_id="+subcatval,
				success: function(data){  
					if(data != ''){ 
					  $("#subcatname").html(" >> "+data);
					  $("#changsubcat").html(" » "+data);
					}else{ 
						$("#subcatname").html('');
						$("#changsubcat").html('');
					}
				}
			});	
}
function showCat(catoption)
{
	if(catoption==1)
	{
	
		$("#showcat").show(500);
		$("#editcat").attr("onclick","showCat(0);");	
	}
	else
	{
		$("#showcat").hide(500);
		$("#editcat").attr("onclick","showCat(1);");
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
					   var listItems = "<option value=''>Select</option>";
						$.each(data, function(key, value) {
							console.log(key);console.log(value);
							listItems+= "<option value='" + key + "'>" + value + "</option>";
						});
						//$("#mod").css("display", "none");
						$("#PostAdAdvModelId").html(listItems);
					}else{ 
						$("#PostAdAdvModelId"). attr('readonly','readonly');
						
					}
				}
			});
		}else{
			$("#PostAdAdvModelId"). attr('readonly','readonly');
		}
}
function add_more_brand_model(){
	var brand_id = $("#PostAdAdvBrandId option:selected").val(); 
	var PostAdAdvBrandId = $("#PostAdAdvBrandId option:selected").text(); 
	var modelid=$("#PostAdAdvModelId").val();
	if(modelid!='')
	{
	var model_id = $("#PostAdAdvModelId option:selected").val(); 
	var model_nm = $("#PostAdAdvModelId option:selected").text(); 
	var modelarr=new Array();
	$( ".modelclass" ).each(function( index ) {
 		modelarr.push($(this).val());
	});
		if(modelarr.length>0)
		{
			//alert(modelarr);
			//alert(model_id);
		if($.inArray( model_id, modelarr )!==-1)
		{
			
			alert("Duplicate Model are not allowed for same brand");
			return false;
		}
	}
	
				if(brand_id){
					$("#PostAdAdvModelId").css("border-color","");
					var rand = Math.random();
					var inner_details = "<div id='div"+rand+"'><input type='text' name='data[PostAd][adv_brand_id]' value='"+PostAdAdvBrandId+"' style='width:100px' class='brandclass dataloadclass'><input type='text' name='data[PostAd][model_nm"+rand+"]' value='"+model_nm+"' style='width:100px' class='dataloadclass'><input type='hidden' name='data[PostAd][adv_brand][]' value='"+brand_id+"' style='width:100px'><input type='hidden' name='data[PostAd][adv_model][]' value="+model_id+" style='width:100px' class='modelclass'><input type='button' id='remove' value='x' class='btn btn-danger' style='width:50px' onclick='remove_div("+rand+")'></div>";
					$("#show_brand_model").append(inner_details);
				}
		
	}
	else
	{
		$("#PostAdAdvModelId").css("border-color","#f00");
	}
}

function remove_div(id){ 
	document.getElementById("div"+id).innerHTML = "";
	//$("#div"+id).html('');
}
function postAdval()
{
	if((".payment_mode").is(":checked")==false)
	{
		alert("Select a payment mode");
		return false;
	}
	if((".delivery_method").is(":checked")==false)
	{
		alert("Select a Delivery Method");
		return false;
	}
}
</script>
<style>
	.fl{float:left;}
	
</style>
 <!--form 1-->
<?php echo $this->Form->create('PostAd', array('type' => 'file')); ?>
	
    <ul class="sellitem_progress">
        <li>
            <a href='javascript:void(0)' onclick="showCat(1);"><?php echo CHOOSECATEGORY;?></a>
            <div class="arrw_btm"></div>
            <div class="success_tick"></div>
        </li>
        <li class="active">
            <a href="javascript:void(0)"><?php echo DESCRIPTION;?></a>
            <div class="arrw_btm"></div>
        </li>
        <li>
            <a href="javascript:void(0)"><?php echo PREVIEWADS;?></a>
            <div class="arrw_btm"></div>
        </li>
        <li>
            <a href="javascript:void(0)"><?php echo READYS;?></a>
            <div class="arrw_btm"></div>
        </li>
    </ul>
    
      <div class="clear40"></div>
      <p class="sip_head"><?php echo CATEGORYWILLAD;?>:</p>
      <p>
        <strong class="si_category_value">
       <span id="chagecat"> <?php if(isset($this->request->data['PostAd']['category_id'])){$catid=$this->request->data['PostAd']['category_id'];echo $this->Custom->category_name($catid);};?></span>
            <span id="changsubcat"><?php if(isset($this->request->data['PostAd']['sub_cat_id'])){$subcatid=$this->request->data['PostAd']['sub_cat_id'];echo " » ".$this->Custom->category_name($subcatid);}?></span>
        </strong> 
        
        <a href="javascript:void(0);" id="editcat" onclick="showCat(1);"><font><font class="">(<?php echo EDIT;?>)</font></font></a>
        </p>
      <div class="clear10"></div>
      <?php
	if(isset($this->request->data['PostAd']['sub_cat_id'])){$subcatid=$this->request->data['PostAd']['sub_cat_id'];$subcatname=$this->Custom->category_name($subcatid);}else{$subcatid='';$subcatname='';};
		
		echo $this->Form->input('adv_id');
		
		?>
      <div class="cat_tree"  id="showcat" style="display:none;">
      
        <?php
		echo $this->Form->input('category_id', array('label' => false, 'size' =>15,'type' => 'select','options' => $cat_list, 'placeholder' => 'Category','div' => 'item post_dropdown', 'class' => 'form-control','onChange'=>'show_subcat(this.value)'));
		echo $this->Form->input('sub_cat_id', array('label' => false, 'size' =>15,'type' => 'select','options' => array($subcatid=>$subcatname),'div' => 'item post_dropdown', 'class' => 'form-control','onChange'=>'return enabledButton(this.value)'));
		?>
      </div>
      
      <div class="clear15"></div>
      <div class="si_field si_field_project_title">
    <p class="sif_head">1. <?php echo NAMEOFSONG;?></p>
    <p class="sif_desc"><?php echo NOTETITLEASSUGG;?></p>
   <!-- <input type="text" name="" value="" maxlength="150" class="">-->
     <?php
		echo $this->Form->input('adv_name', array('label' => false));
		?>
  </div>
      <div class="clear15"></div>
      <p class="sif_head">2. <?php echo DETAILABTSONGSOLD;?></p>
      <p class="sif_desc"><?php echo DESCRIBEASDETAIL;?></p>
     <?php
		echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
		echo $this->Form->input('adv_details', array('label' => false,'type' => 'textarea', 'class'=>'ckeditor', 'div' => 'col-lg-7'));
		?>
      <div class="clear15"></div>
      <p class="sif_head">3.<?php echo PHOTOOFSONG;?></p>
      <p class="sif_desc"><?php echo NOTETIP;?></p>
      <p class="sfau_item"><span><?php echo CHOOSEPICTURE;?></span>
      <div class="clear"></div>
    <iframe src="<?php echo $base_url;?>PostAds/fileupload/<?php echo $this->request->data['PostAd']['adv_id'];?>" style="width: 620px;min-height: 200px;
float: left;border: 1px solid rgb(197, 197, 197);overflow-x: hidden;"></iframe>

  </p>
      <div class="clear15"></div>
      <div class="si_field si_car_model_values">
    <p class="sif_head"><font><font class="">4. <?php echo MAKEANDMODELCAR;?></font></font></p>
    <p class="sif_error"></p>
    <p class="sif_desc"><?php echo LOGANSEARCH;?></p>
    <p>       
      <?php
	 echo  $this->Form->input('adv_brand_id',array('type'=>'select','options'=>$brand_list,'label'=>false,'div'=>false,'empty'=>CHOOSEBRAND,'onChange'=>'choose_model(this.value)', 'class' => 'sel_maker'));
	  echo $this->Form->input('adv_model_id', array('type'=>'select','label'=>false,'div'=>false,'empty'=>CHOOSEMODEL, 'onchange' => 'return add_more_brand_model();', 'class' => 'sel_model'));
	  echo '<input type="button" class="button" id="add_more" value="Add" onclick="add_more_brand_model();">';
	  echo "<div id='show_brand_model'></div>";
	  if(isset($this->request->data['PostAd']['adv_brand']) && !empty($this->request->data['PostAd']['adv_brand']))
		{
			if(isset($this->request->data['PostAd']['adv_model']) && !empty($this->request->data['PostAd']['adv_model']))
			{
			$brandarr=$this->request->data['PostAd']['adv_brand'];

			$modelarr=$this->request->data['PostAd']['adv_model'];
			if(!empty($brandarr))
			{
				foreach($brandarr as $brandindex => $singlebrand)
				{
				$brandname=$this->Custom->brand_nm($singlebrand);
				$modelname=$this->Custom->brand_nm($modelarr[$brandindex]);
			?>
            <div id='div<?php echo $brandindex;?>'><input type='hidden' name='data[PostAd][adv_brand][]' value='<?php echo $singlebrand;?>' style='width:100px'><input type='hidden' name='data[PostAd][adv_model][]' value="<?php echo $modelarr[$brandindex];?>" style='width:100px'><input type='text' class='dataloadclass' name='data[PostAd][adv_brand_id]' value='<?php echo $brandname;?>' style='width:100px'><input type='text' class='dataloadclass' name='data[PostAd][model_nm<?php echo $modelname;?>]' value='<?php echo $modelname;?>' class='modelclass' style='width:100px'><input type='button' id='remove' value='x' class='btn btn-danger' style='width:50px' onclick='remove_div("<?php echo $brandindex;?>")'></div>
            <?php
				}
			}
			}
		}
		else if(isset($this->request->data['PostAd']['adv_brand_id'])&& !empty($this->request->data['PostAd']['adv_brand_id']))
		{
			if(isset($this->request->data['PostAd']['adv_model_id'])&& !empty($this->request->data['PostAd']['adv_model_id']))
			{
			if($this->request->data['PostAd']['adv_brand_id']!='')
			{
				$brand=$this->request->data['PostAd']['adv_brand_id'];
				$brandarr=explode(",", $this->request->data['PostAd']['adv_brand_id']);
				$model=$this->request->data['PostAd']['adv_model_id'];
				$modelarr=explode(",", $this->request->data['PostAd']['adv_model_id']);
				if(!empty($brandarr))
				{
					foreach($brandarr as $brandindex => $singlebrand)
					{
					$brandname=$this->Custom->brand_nm($singlebrand);
					$modelname=$this->Custom->brand_nm($modelarr[$brandindex]);
				?>
				<div id='div<?php echo $brandindex;?>'><input type='hidden' name='data[PostAd][adv_brand][]' value='<?php echo $singlebrand;?>' style='width:100px'><input type='hidden' name='data[PostAd][adv_model][]' value="<?php echo $modelarr[$brandindex];?>" style='width:100px'><input type='text' class='dataloadclass' name='data[PostAd][adv_brand_id]' value='<?php echo $brandname;?>' style='width:100px'><input type='text' class='dataloadclass' name='data[PostAd][model_nm<?php echo $modelname;?>]' value='<?php echo $modelname;?>' style='width:100px'><input type='button' id='remove' value='x' class='btn btn-danger' style='width:50px' onclick='remove_div("<?php echo $brandindex;?>")'></div>
				<?php
					}
				}
			}
			}
		}
		//-------------------
	  ?>
          
           </p>
           
    <ul>
        </ul>
    <!--<label class="sfm_skip">
          <input type="checkbox" class="checkbox" value="skipthis">
          <font><font>Do not want to appear as search by brand / model</font></font></label>-->
  </div>
  
  <div class="clear"></div>
  
  <p class="sip_head">5.<?php echo INFORMATIONTRACK;?></p>
  <div class="cf_item cfi_type_pulldown cfi_id_3">
    <strong><font class=""><?php echo PRODUCTCONDITION;?></font>
    </strong><span><font class=""><?php echo NEWUSED;?></font></span>
    <?php echo $this->Form->input('product_cond', array('label' => false,'type' => 'select','options' => array('' => 'Select','new'=>'New', 'Used' => 'Used')));?>
  </div>
  
  <div class="clear15"></div>
  
  <p class="sip_head">6.<?php echo RATETRACK;?></p>
  <p class="sif_desc sif_desc_warning">
  	
        <?php echo NOTEFORACTUALVAT;?>
    </p>
    
   
  <div class="clear"></div>
  
  
  <div class="col-lg-2">
  	<div class="row ratetitle">
    	<span><font class=""><?php echo PRICE;?></font></span>
        <?php echo $this->Form->input('price',array('label' => false,'div' => 'rateclass23'));?>
    </div>
  </div>
  
  <div class="col-lg-2">
  	<div class="row ratetitle">
    	<span><font class=""><?php echo CURRENCY;?></font></span>
          <?php echo $this->Form->input('currency',array('label' => false,'type' => 'select','options' => array('' => 'Select','RON'=>'RON'),'div' => 'rateclass23'));?>
    </div>
  </div>
   <div class="clear15"></div>
  
  <p class="sip_head">7.<?php echo QUANTITYAVAILABLE;?></p>
  <div class="cf_item cfi_type_pulldown cfi_id_3">
    
     <p class="sif_desc">Your ad will appear in searches like "lighthouse Logan" unless you select "Logan" below. <br>
         Select models are not compatible with the song sold erase the announcement.</p>
    <strong><font class=""><?php echo NOOFPIECES;?> </font></strong>
    <?php
		echo $this->Form->input('quantity',array('label' => false));
		?>
  </div>
   <div class="clear15"></div>
  
  <p class="sip_head">8.<?php echo PAYMENTMETHODACCEPTED;?> </p>
  <div class="cf_item cfi_type_pulldown cfi_id_3 payment_method">
    
     <p class="sif_desc"><?php echo CHECKPAYMENTMETHOD;?>:</p>

    <?php
		if(isset($this->request->data['PostAd']['payment_mode']) && $this->request->data['PostAd']['payment_mode']!='')
		{
			if(is_array($this->request->data['PostAd']['payment_mode']))
			{
				$paymentarr=$this->request->data['PostAd']['payment_mode'];
			}
			else
			{
				$paymentarr=explode(",",$this->request->data['PostAd']['payment_mode']);
			}
			
		}
		else
		{
			
			$paymentarr=array();
		}
		if(in_array('Cash on delivery',$paymentarr))
		{
		echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Cash on delivery','name' => 'data[PostAd][payment_mode][]','checked' => 'checked')).CASHONDELICERY.'.</label>';

		}
		else
		{
			echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Cash on delivery','name' => 'data[PostAd][payment_mode][]')).CASHONDELICERY.'</label>';
		}
		if(in_array('Upon delivery',$paymentarr))
		{
		echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Upon delivery','name' => 'data[PostAd][payment_mode][]','checked' => 'checked')).UPONDELIVERY.'.</label>';
		}
		else
		{
			echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Upon delivery','name' => 'data[PostAd][payment_mode][]')).UPONDELIVERY.'</label>';
		}
		if(in_array('Wire Transfer',$paymentarr))
		{
		echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Wire Transfer','name' => 'data[PostAd][payment_mode][]','checked' => 'checked')).WIRETRANSFER.'.</label>';
		}
		else
		{
			echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Wire Transfer','name' => 'data[PostAd][payment_mode][]')).WIRETRANSFER.'</label>';
		}
		if(in_array('Banking Card',$paymentarr))
		{
	echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Banking Card','name' => 'data[PostAd][payment_mode][]','checked' => 'checked')).BANKCARD.'</label>';
		}
		else
		{
			echo '<label>'.$this->Form->input('payment_mode',array('label' =>  false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Banking Card','name' => 'data[PostAd][payment_mode][]')).BANKCARD.'</label>';
		}
		if(in_array('Others',$paymentarr))
		{
	echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Others','name' => 'data[PostAd][payment_mode][]','checked' => 'checked')).OTHER.'</label>';
		}
		else
		{
			echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Others','name' => 'data[PostAd][payment_mode][]')).OTHER.'</label>';
		}
	?>
  </div>
  
   <div class="clear15"></div>
  
  <p class="sip_head">9.<?php echo SENDSONGTOCUSTOMER;?></p>
   <div class="cf_item cfi_type_pulldown cfi_id_3">
  <p class="sif_desc">
  	
       <font><?php echo SENDTHESONGTOBUYER;?></font>
    </p>
  <p class="sif_desc sif_desc_warning">
  	
        <?php echo NOTEACCURATELY;?>
    </p>
  <div class="sfs_section"><font><font class="goog-text-highlight"><?php echo METHODOFDELIVERY;?></font></font></div>
  
  
    <div class="sfs_shipmethods">
        <label> 
              <?php
		
			echo $this->Form->input('personal_teaching',array('label' => false, 'class' => 'checkbox','div' => false,'type' =>'checkbox', 'value'=> 1));

			?>
            <font><?php echo PERSONALTEACHING;?></font>
        </label> 
    </div>
    
    <div class="sfs_shipmethods">
        <label class="ship_method_courier">
            <?php echo $this->Form->input('courier',array('label' => false, 'class' => 'checkbox','div' => false,'type' =>'checkbox', 'value'=> 1));?>
            <font><?php echo COURIER;?></font>
        </label>
        <label class="ship_courier_price">
            <font><?php echo DELIVERYCOST;?></font>
            <?php
			echo $this->Form->input('courier_cost',array('label' => false,'div' => false,'type' =>'text', 'class' => 'text'));
			?>
            <font><?php echo RON;?></font>
        </label>
        <label class="ship_free_shipping">
             <?php
			echo $this->Form->input('free_courier',array('label' => false, 'class' => 'checkbox','div' => false,'type' =>'checkbox', 'value'=> 1))
			?>
            <font><?php echo FREEDELIVERYCOURIER;?>r</font>
        </label>
     </div>
     
    <div class="sfs_shipmethods">
   
        <label class="ship_method_courier">
             <?php
			echo $this->Form->input('romanian_mail',array('label' => false, 'class' => 'checkbox','div' => false,'type' =>'checkbox', 'value'=> 1));
			?>
            <font><?php echo ROMANIANMAIL;?></font>
        </label>
        <label class="ship_courier_price">
            <font><?php echo DELIVERYCOST;?></font>
             <?php
			echo $this->Form->input('romanian_mail_cost',array('label' => false,'div' => false, 'class' => 'text','type' =>'text'));
			?>
            <font><?php echo RON;?></font>
        </label>
        <label class="ship_free_shipping">
             <?php
			echo $this->Form->input('free_romanian_mail',array('label' => false,'div' => false, 'class' => 'checkbox','type' =>'checkbox', 'value'=> 1));
			?>
            <font><?php echo FREESHIPPINGMAIL;?></font>
        </label>
     </div>
     </div>
    
    <div class="clear10"></div>
    <div class="sfs_section"><font><font class="goog-text-highlight"><?php echo TIMEREQDISPATCH;?></font></font></div>
   <?php
		//echo $this->Form->input('delivery_method');
		echo $this->Form->input('time_required', array('label'=>false,'class' => 'drop34','type' => 'select','options' => array('1' => '1 Day','2'=>'2 Days','3'=>'3 Days', '4' => '4 Days', '5' => '5 Days', '10' => '10 Days', '15' => '15 Days', '30' => '30 Days')));
	?>
  
      <!--<div>
        <input type="text" id="category_search" value="" placeholder="Începe să scrii aici numele categoriei sau al piesei " autocomplete="off" class="ac_input">
        <input id="category_search_button" type="button">
        <div class="clearing"></div>
      </div>-->
      <div class="clear10"></div>
      <div class="row searchlistdata">
    <ul class="col-lg-8 carryul">
          <li>
        <div class="col-lg-1" style="text-align:center;">
              <div class="row"> <a href="#"> <img src="<?php echo $base_url;?>/images/ico-ok.png" alt="" width="30"> </a> </div>
            </div>
        <div class="col-lg-6">
              <div class="datalistitem">
            <h1><a href="#"><?php echo NEXTSTEP;?></a></h1>
            <p>
             <span style="color:#DF5E08; font-weight:bold;" id="catname"><?php if(isset($this->request->data['PostAd']['category_id'])){$catid=$this->request->data['PostAd']['category_id'];echo $this->Custom->category_name($catid);};?></span><span id="subcatname"><?php if(isset($this->request->data['PostAd']['sub_cat_id'])){$subcatid=$this->request->data['PostAd']['sub_cat_id'];echo " >> ".$this->Custom->category_name($subcatid);};?></span>
            </p>
            <div class="clear"></div>
          </div>
            </div>
        <div class="col-lg-5" style="min-height:32px;">
              <div class="row carry">
            <input type="submit" name="Submit2" value="<?php echo CARRYON;?>" class="newsletter_snd_btn">
          </div>
            </div>
        <div class="clearfix"></div>
      </li>
        </ul>
  </div>
    </form>
<!--form 1--> 