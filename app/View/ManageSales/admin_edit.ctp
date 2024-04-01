<style type="text/css">
.clear{clear:both;}

.clear5{clear:both;height:5px;}

.clear10{clear:both;height:10px;}
.clear15{clear:both;height:15px;}
.iframe_list {
  list-style-type: none;
  float: none;
  margin: 0;
  padding: 0;
}
.iframe_list li {
  list-style-type: none;
  float: left;
  width: 20%;
  margin: 10px;
  padding: 0;
  position: relative;
  background: #000;
  border: 2px solid rgb(194, 194, 194);
  border-radius: 4px;
}
.iframe_PostAd li {
  width: 15%;
}
.iframe_list li:nth-child(4) {
  margin-right: 0;
}
.iframe_list li button {
  background-color: #d9534f;
  cursor: pointer;
  outline: none;
  padding: 3px;
  color: #FFF;
  font-size: 13px;
  text-decoration: none;
  border: 1px solid #d9534f;
  border-radius: 3px;
  width: 21px;
  height: 22px;
  position: absolute;
  top: 5px;
  right: 5px;
}
.iframe_list li img {
  width: 100%;
  height: 100px;
}
.iframe_list li:hover img {
  opacity: 0.8;
}
button.btn.btn-primary.rotateClass {
    margin-top: 5px;
    width: 100% !important;
    top: inherit !important;
    right: inherit !important;
}
</style>
<script type="text/javascript">
$(function() {
	$( "#ManageSaleFreeRomanianMail" ).click(function() {
		if($("#ManageSaleFreeRomanianMail").is(":checked")==true)
		{
			$("#ManageSaleRomanianMailCost").val(0);
			$("#ManageSaleRomanianMailCost").attr("readonly","readonly");
		}else
		{
			$("#ManageSaleRomanianMailCost").removeAttr("readonly");
		}
	});
	$( "#ManageSaleFreeCourier" ).click(function() {
		if($("#ManageSaleFreeCourier").is(":checked")==true)
		{
			$("#ManageSaleCourierCost").val(0);
			$("#ManageSaleCourierCost").attr("readonly","readonly");
		}else
		{
			$("#ManageSaleCourierCost").removeAttr("readonly");
		}
	});
	
});
function show_subcat(id){ 
	if(id){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo $this->webroot.'ManageSales/subcatajax'?>",
				data: {"cat_id":id},
				dataType: "json",
				success: function(data){  
					if(data != ''){ 
					   var listItems = "";
						$.each(data, function(key, value) {
							console.log(key);console.log(value);
							listItems+= "<option value='" + key + "'>" + value + "</option>";
						});
						
						$("#ManageSaleSubCatId").html(listItems);
						$("#ManageSaleSubCatId").show();
					}else{ 
						$("#ManageSaleSubCatId").html('');
						$("#ManageSaleSubCatId").show();
						//$("#category_carry").attr("disabled",'disabled');
					}
				}
			});
		}else{
			$("#ManageSaleSubCatId").html('');
		}
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
						$("#ManageSaleAdvModelId").html(listItems);
					}else{ 
						$("#ManageSaleAdvModelId"). attr('readonly','readonly');
						
					}
				}
			});
		}else{
			$("#ManageSaleAdvModelId"). attr('readonly','readonly');
		}
}
function add_more_brand_model(){
	var brand_id = $("#ManageSaleAdvBrandId option:selected").val(); 
	var ManageSaleAdvBrandId = $("#ManageSaleAdvBrandId option:selected").text(); 
	var modelid=$("#ManageSaleAdvModelId").val();
	if(modelid!='')
	{
	var model_id = $("#ManageSaleAdvModelId option:selected").val(); 
	var model_nm = $("#ManageSaleAdvModelId option:selected").text(); 
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
					$("#ManageSaleAdvModelId").css("border-color","");
					var rand = Math.random();
					var inner_details = " <div class='clearfix'></div><div id='div"+rand+"' class='row'><div class='col-lg-4 col-sm-4'><input type='text' name='data[ManageSale][adv_brand_id]' value='"+ManageSaleAdvBrandId+"'  class='brandclass dataloadclass form-control'></div><div class='col-lg-4 col-sm-4'><input type='text' name='data[ManageSale][model_nm"+rand+"]' value='"+model_nm+"'  class='dataloadclass form-control'></div><input type='hidden' name='data[ManageSale][adv_brand][]' value='"+brand_id+"' style='width:100px'><input type='hidden' name='data[ManageSale][adv_model][]' value="+model_id+" style='width:100px' class='modelclass'><div class='col-lg-4 col-sm-4'><input type='button' id='remove' value='x' class='btn btn-danger'  onclick='remove_div("+rand+")'></div></div><div class='clearfix'></div>";
					$("#show_brand_model").append(inner_details);
				}
		
	}
	else
	{
		$("#ManageSaleAdvModelId").css("border-color","#f00");
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
function removedata(imgid,img_fold)
{
  $.ajax(
      {
        type: 'POST',
        url: '<?php echo $base_url; ?>ManageSales/removeimg',
        data: 'imgid='+imgid+'&img_fold='+img_fold,
        success: function(data) {
          //alert(data);
          if(data==1)
          {
            if(img_fold=='temp')
            {
            $("#imgtemp"+imgid).remove();
            }
            else if(img_fold=='original')
            {
            $("#imgoriginal"+imgid).remove();
            }
          }
          
        }
      });
}
function getrotateidFunc(imgid,imgFrom){
  $("#iframeid").attr("src", "<?php echo $base_url;?>ManageSales/rotateimg/"+imgid+"/"+imgFrom);
  //alert(imgid);
}
function closeRotation(){
  $("#fileuplodframe").attr('src', '<?php echo $base_url;?>ManageSales/fileupload/<?php if(isset($this->request->data['ManageSale']['adv_id'])){echo $this->request->data['ManageSale']['adv_id'];}?>');
}
</script>






<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-9">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Manage Sales</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
          <?php echo $this->Form->create('ManageSale', array('type' => 'file')); ?>
                <div class="box-body">
                  <?php
                  echo $this->Form->input('user_id', array('label' => 'Select User','type' => 'select','options' => $userList, 'class' => 'form-control','div' => 'form-group'));
				
				 if(isset($this->request->data['ManageSale']['sub_cat_id'])){$subcatid=$this->request->data['ManageSale']['sub_cat_id'];$subcatname=$this->Custom->category_name($subcatid);}else{$subcatid='';$subcatname='';};
		
		echo $this->Form->input('adv_id');
		
		
		?>
        <div class="row" id="showcat">
        <div class="col-lg-6">
           <?php
		echo $this->Form->input('category_id', array('label' => false, 'size' =>8,'type' => 'select','options' => $cat_list, 'placeholder' => 'Category','div' => 'item post_dropdown', 'class' => 'form-control','onChange'=>'show_subcat(this.value)'));
		?> 
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
           <?php
		   echo $this->Form->input('sub_cat_id', array('label' => false, 'size' =>8,'type' => 'select','options' => array($subcatid=>$subcatname),'div' => 'item post_dropdown', 'class' => 'form-control'));
		
		?> 
        </div><!-- /.col-lg-6 -->
    </div>
    <div class="clear15"></div>
    <div class="si_field si_field_project_title">
    <p class="sif_head">1. Name of the song</p>
    <p class="sif_desc">Use a title as suggestive and completely. <br>
          eg BMW 3 Series E46 front bumper year in 2001 with projectors and green grid</p>
   <!-- <input type="text" name="" value="" maxlength="150" class="">-->
     <?php
		echo $this->Form->input('adv_name', array('label' => false,'class' => 'form-control', 'div' => 'form-group'));
		?>
  </div>
  
  <div class="clear15"></div>
      <p class="sif_head">2. Details about the song sold</p>
      <p class="sif_desc">Describe as detailed piece on sale. The more customers, <br>
    the chances of selling increase exponentially.</p>
     <?php
		echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
		echo $this->Form->input('adv_details', array('label' => false,'type' => 'textarea', 'class'=>'ckeditor form-control', 'div' => 'col-lg-7'));
		?>
        <div class="clear15"></div>
      <p class="sif_head">3. Photos of the song (be careful not to be less than 250x250 pixels)</p>
      <p class="sif_desc">Tip: You can select multiple photos at the same time! <br>
    To increase your chances of selling adds more real pictures by piece from different angles.</p>
      <p class="sfau_item"><span>Choose pictures (up to 8)</span>
      <div class="clear"></div>
    <iframe src="<?php echo $base_url;?>ManageSales/fileupload/<?php if(isset($this->request->data['ManageSale']['adv_id'])){echo $this->request->data['ManageSale']['adv_id'];}?>"  style="width:620px;height:35px;border: none;" id="fileuplodframe"></iframe>
<div id="loading" style="display:none;"><img src="http://www.pieseauto.ro/images/default/ajax-loader.gif" alt="loading...">Loading...</div>
<div id="picGallery" class="iframe_PostAd" style="display:none;"></div>

  </p>
  <div class="clear15"></div>
      <div class="si_field si_car_model_values">
    <p class="sif_head"><font><font class="">4. Make and Model Car</font></font></p>
    <p class="sif_error"></p>
    <p class="sif_desc">Your ad will appear in searches like "lighthouse Logan" unless you select "Logan" below. <br>
         Select models are not compatible with the song sold erase the announcement.</p>
  
  
  <p> 
       <div class="clearfix"></div>
  <div class="row">
    <div class="col-lg-4 col-sm-4">
       <?php
	 echo  $this->Form->input('adv_brand_id',array('type'=>'select','options'=>$brand_list,'label'=>false,'div'=>false,'empty'=>'Choose brand','onChange'=>'choose_model(this.value)', 'class' => 'sel_maker form-control')); ?>
    </div>
    <div class="col-lg-4 col-sm-4">
    <?php echo $this->Form->input('adv_model_id', array('type'=>'select','label'=>false,'div'=>false,'empty'=>'Choose the model', 'onchange' => 'return add_more_brand_model();', 'class' => 'sel_model form-control'));?>
    </div>
    <div class="col-lg-4 col-sm-4">
    <?php echo '<input type="button" class="button" id="add_more" value="Add" onclick="add_more_brand_model();" >'; ?>
    </div>
  </div>
  <div class="clearfix"></div> 
      <?php
	/* echo  $this->Form->input('adv_brand_id',array('type'=>'select','options'=>$brand_list,'label'=>false,'div'=>false,'empty'=>'Choose brand','onChange'=>'choose_model(this.value)', 'class' => 'sel_maker'));
	  echo $this->Form->input('adv_model_id', array('type'=>'select','label'=>false,'div'=>false,'empty'=>'Choose the model', 'onchange' => 'return add_more_brand_model();', 'class' => 'sel_model'));
	  echo '<input type="button" class="button" id="add_more" value="Add" onclick="add_more_brand_model();" style="width: 9%; margin-left: 10px; padding: 2px;">';*/
	  echo "<div id='show_brand_model'></div>";
	  if(isset($this->request->data['ManageSale']['adv_brand']) && !empty($this->request->data['ManageSale']['adv_brand']))
		{
			if(isset($this->request->data['ManageSale']['adv_model']) && !empty($this->request->data['ManageSale']['adv_model']))
			{
			$brandarr=$this->request->data['ManageSale']['adv_brand'];

			$modelarr=$this->request->data['ManageSale']['adv_model'];
			if(!empty($brandarr))
			{
				foreach($brandarr as $brandindex => $singlebrand)
				{
				$brandname=$this->Custom->brand_nm($singlebrand);
				$modelname=$this->Custom->brand_nm($modelarr[$brandindex]);
			?>
         
             <div class="clearfix"></div>
            <div id='div<?php echo $brandindex;?>' class="row">
            <input type='hidden' name='data[ManageSale][adv_brand][]' value='<?php echo $singlebrand;?>' style='width:100px'>
            <input type='hidden' name='data[ManageSale][adv_model][]' value="<?php echo $modelarr[$brandindex];?>" style='width:100px'>
            <div class="col-lg-4 col-sm-4">
	 <input type='text' class='dataloadclass form-control' name='data[ManageSale][adv_brand_id]' value='<?php echo $brandname;?>' style='width:100px'>
    		</div>
            <div class="col-lg-4 col-sm-4">
    <input type='text' class='dataloadclass' name='data[ManageSale][model_nm<?php echo $modelname;?>]' value='<?php echo $modelname;?>' class='modelclass' style='width:100px'>
    </div>
     <div class="col-lg-4 col-sm-4">
     <input type='button' id='remove' value='x' class='btn btn-danger' style='width:50px' onclick='remove_div("<?php echo $brandindex;?>")'>
    </div> 
            </div>
             <div class="clearfix"></div>
            <?php
				}
			}
			}
		}
		else if(isset($this->request->data['ManageSale']['adv_brand_id'])&& !empty($this->request->data['ManageSale']['adv_brand_id']))
		{
			if(isset($this->request->data['ManageSale']['adv_model_id'])&& !empty($this->request->data['ManageSale']['adv_model_id']))
			{
			if($this->request->data['ManageSale']['adv_brand_id']!='')
			{
				$brand=$this->request->data['ManageSale']['adv_brand_id'];
				$brandarr=explode(",", $this->request->data['ManageSale']['adv_brand_id']);
				$model=$this->request->data['ManageSale']['adv_model_id'];
				$modelarr=explode(",", $this->request->data['ManageSale']['adv_model_id']);
				if(!empty($brandarr))
				{
					foreach($brandarr as $brandindex => $singlebrand)
					{
					$brandname=$this->Custom->brand_nm($singlebrand);
					$modelname=$this->Custom->brand_nm($modelarr[$brandindex]);
				?>
                <div class="clearfix"></div>
				<div id='div<?php echo $brandindex;?>' class="row">
                <input type='hidden' name='data[ManageSale][adv_brand][]' value='<?php echo $singlebrand;?>' style='width:100px'>
                <input type='hidden' name='data[ManageSale][adv_model][]' value="<?php echo $modelarr[$brandindex];?>" style='width:100px'>
                <div class="col-lg-4 col-sm-4">
                <input type='text' class='dataloadclass form-control' name='data[ManageSale][adv_brand_id]' value='<?php echo $brandname;?>'>
                </div>
                <div class="col-lg-4 col-sm-4">
                <input type='text' class='dataloadclass form-control' name='data[ManageSale][model_nm<?php echo $modelname;?>]' value='<?php echo $modelname;?>' >
                </div>
                <div class="col-lg-4 col-sm-4">
                <input type='button' id='remove' value='x' class='btn btn-danger'  onclick='remove_div("<?php echo $brandindex;?>")'>
                </div>
                
                </div>
                <div class="clearfix"></div>
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
   
  </div>
            <div class="clear"></div>
  
  <p class="sip_head">5. Information about the track</p>
  <div class="cf_item cfi_type_pulldown cfi_id_3">
    <strong><font class="">Product Condition </font>
    </strong><span><font class="">new or used?</font></span>

    <?php echo $this->Form->input('product_cond', array('label' => false,'type' => 'select','options' => array('' => 'Select','new'=>'New', 'Used' => 'Used'),'class' => 'form-control', 'div' => 'form-group'));?>
  </div>
   <div class="clear15"></div>
  
  <p class="sip_head">6. Rate track</p>
  <p class="sif_desc sif_desc_warning">
  	
        <font>Note:</font>
        Enter the actual price of the product including VAT. 
        Introducing a false price erase the announcement.
    </p>
    
   
  <div class="clear"></div>
  <div class="col-lg-2">
  	<div class="row ratetitle">
    	<!--<span><font class="">Price</font></span>-->
        <?php echo $this->Form->input('price',array('label' => 'Price','div' => 'rateclass23','class' => 'form-control'));?>
    </div>
  </div>
  
  <div class="col-lg-2">
  	<div class="row ratetitle">
    	<!--<span><font class="">Currency</font></span>-->
          <?php echo $this->Form->input('currency',array('label' => 'Currency','type' => 'select','options' => array('' => 'Select','RON'=>'RON'),'div' => 'rateclass23','class' => 'form-control'));?>
    </div>
  </div>
   <div class="clear15"></div>
  
  <p class="sip_head">7. Quantity Available</p>
  <div class="cf_item cfi_type_pulldown cfi_id_3">
    
     <p class="sif_desc">Your ad will appear in searches like "lighthouse Logan" unless you select "Logan" below. <br>
         Select models are not compatible with the song sold erase the announcement.</p>
    <!--<strong><font class="">Number of pieces </font></strong>-->
    <?php
		echo $this->Form->input('quantity',array('label' => 'Number of pieces','class' => 'form-control', 'div' => 'form-group'));
		?>
  </div>
   <div class="clear15"></div>
  
   <p class="sip_head">8. What methods of payment are accepted?</p>
  <div class="cf_item cfi_type_pulldown cfi_id_3 payment_method">
    
     <p class="sif_desc">Check the payment methods that we accept from the list below:</p>

    <?php
		if(isset($this->request->data['ManageSale']['payment_mode']) && $this->request->data['ManageSale']['payment_mode']!='')
		{
			if(is_array($this->request->data['ManageSale']['payment_mode']))
			{
				$paymentarr=$this->request->data['ManageSale']['payment_mode'];
			}
			else
			{
				$paymentarr=explode(",",$this->request->data['ManageSale']['payment_mode']);
			}
			
		}
		else
		{
			
			$paymentarr=array();
		}
		if(in_array('Cash on delivery',$paymentarr))
		{
		echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Cash on delivery','name' => 'data[ManageSale][payment_mode][]','checked' => 'checked')).'Cash on delivery</label>';

		}
		else
		{
			echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Cash on delivery','name' => 'data[ManageSale][payment_mode][]')).'Cash on delivery</label>';
		}
		if(in_array('Upon delivery',$paymentarr))
		{
		echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Upon delivery','name' => 'data[ManageSale][payment_mode][]','checked' => 'checked')).'Upon delivery</label>';
		}
		else
		{
			echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Upon delivery','name' => 'data[ManageSale][payment_mode][]')).'Upon delivery</label>';
		}
		if(in_array('Wire Transfer',$paymentarr))
		{
		echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Wire Transfer','name' => 'data[ManageSale][payment_mode][]','checked' => 'checked')).'Wire Transfer</label>';
		}
		else
		{
			echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Wire Transfer','name' => 'data[ManageSale][payment_mode][]')).'Wire Transfer</label>';
		}
		if(in_array('Banking Card',$paymentarr))
		{
	echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Banking Card','name' => 'data[ManageSale][payment_mode][]','checked' => 'checked')).'Banking Card</label>';
		}
		else
		{
			echo '<label>'.$this->Form->input('payment_mode',array('label' =>  false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Banking Card','name' => 'data[ManageSale][payment_mode][]')).'Banking Card</label>';
		}
		if(in_array('Others',$paymentarr))
		{
	echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Others','name' => 'data[ManageSale][payment_mode][]','checked' => 'checked')).'Others</label>';
		}
		else
		{
			echo '<label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Others','name' => 'data[ManageSale][payment_mode][]')).'Others</label>';
		}
	?>
  </div>
  
   <div class="clear15"></div> 
  <p class="sip_head">9. How to send the song to the customer?</p>
   <div class="cf_item cfi_type_pulldown cfi_id_3">
  <p class="sif_desc">
  	
       <font>Check the ways you can send the song to the buyer.</font>
    </p>
  <p class="sif_desc sif_desc_warning">
  	
        <font>Note:</font>
       Fill in as accurately as possible the cost of transport and delivery terms! 
Jeopardy Rate if they are wrong!
    </p>
  <div class="sfs_section"><font><font class="goog-text-highlight">Method of delivery:</font></font></div>
   <div class="sfs_shipmethods">
        <label> 
              <?php
		
			echo $this->Form->input('personal_teaching',array('label' => false, 'class' => 'checkbox','div' => false,'type' =>'checkbox', 'value'=> 1));

			?>
            <font>Personal Teaching</font>
        </label> 
    </div>
     <div class="sfs_shipmethods">
        <label class="ship_method_courier">
            <?php echo $this->Form->input('courier',array('label' => false, 'class' => 'checkbox','div' => false,'type' =>'checkbox', 'value'=> 1));?>
            <font>Courier</font>
        </label>
        <label class="ship_courier_price">
            <font>Delivery Cost</font>
            <?php
			echo $this->Form->input('courier_cost',array('label' => false,'div' => false,'type' =>'text', 'class' => 'text'));
			?>
            <font>RON</font>
        </label>
        <label class="ship_free_shipping">
             <?php
			echo $this->Form->input('free_courier',array('label' => false, 'class' => 'checkbox','div' => false,'type' =>'checkbox', 'value'=> 1))
			?>
            <font>Free delivery by courier</font>
        </label>
     </div>
     
    <div class="sfs_shipmethods">
   
        <label class="ship_method_courier">
             <?php
			echo $this->Form->input('romanian_mail',array('label' => false, 'class' => 'checkbox','div' => false,'type' =>'checkbox', 'value'=> 1));
			?>
            <font>Romanian Mail</font>
        </label>
        <label class="ship_courier_price">
            <font>Delivery Cost</font>
             <?php
			echo $this->Form->input('romanian_mail_cost',array('label' => false,'div' => false, 'class' => 'text','type' =>'text'));
			?>
            <font>RON</font>
        </label>
        <label class="ship_free_shipping">
             <?php
			echo $this->Form->input('free_romanian_mail',array('label' => false,'div' => false, 'class' => 'checkbox','type' =>'checkbox', 'value'=> 1));
			?>
            <font>Free Shipping by Mail</font>
        </label>
     </div>
     </div>
    
    <div class="clear10"></div>
     <div class="sfs_section"><font><font class="goog-text-highlight">Time required for dispatch:</font></font></div>
   <?php
		//echo $this->Form->input('delivery_method');
		echo $this->Form->input('time_required', array('label'=>false,'class' => 'drop34','class' => 'form-control', 'div' => 'form-group','type' => 'select','options' => array('1' => '1 Day','2'=>'2 Days','3'=>'3 Days', '4' => '4 Days', '5' => '5 Days', '10' => '10 Days', '15' => '15 Days', '30' => '30 Days')));
	?>
    <div class="clear15"></div>
              <div class="si_field si_field_project_title">
            <p class="sif_head">Status</p>
             <?php
                echo $this->Form->input('adv_status', array('label' => false,'type' => 'select','class' => 'form-control', 'div' => 'form-group','options' => array('' => 'Select Status','1'=>'Publish', '0' => 'Unpublish')));
                ?>
          </div>
      <div class="clear10"></div>
      <div class="row searchlistdata">
      

     <!--   <div class="col-lg-5" style="min-height:32px;">
              <div class="row carry">
            <input type="submit" name="Submit2" value="Submit" class="newsletter_snd_btn">
          </div>
            </div>-->
        <div class="clearfix"></div>
     
  </div>
     </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div><!-- /.box -->

      

    </div><!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">
        <!-- general form elements disabled -->
        <!-- /.box -->
    </div><!--/.col (right) -->
</div>   <!-- /.row -->
</section><!-- /.content -->


<!-- Modal -->
<div class="modal fade" id="rotateModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Rotate Image</h4>
      </div>
      <div class="modal-body">
          <iframe src="<?php echo $base_url;?>ManageSales/rotateimg/" width="560" height="441" frameborder="0" allowtransparency="true" id="iframeid"></iframe> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeRotation();">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->