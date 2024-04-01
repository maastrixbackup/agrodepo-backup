<script type="text/javascript">
function show_subcat(id, childID){
	if(id){
		jQuery.ajax({
				type: "POST",
				url: "<?php echo $base_url.'PostAds/catdetail'?>",
				data: "cat_id="+id,
				success: function(data){
					if(data != ''){
					  $("#catname").html(data);
					  $("#subcatname").html('');
					}else{
						$("#catname").html('');
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
							//console.log(key+" "+childID);
							if(parseInt(key) == parseInt(childID)){
								//alert(key)
								listItems+= "<option value='" + key + "' selected>" + value + "</option>";
								$("#subcatname").html(" >> "+value);
							}else{
								listItems+= "<option value='" + key + "'>" + value + "</option>";
							}
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
					}else{
						$("#subcatname").html('');
					}
				}
			});
}
/**
*Brand jQuery start from here
*
**/
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
	var brandid=$("#PostAdAdvBrandId").val();
	//alert(modelid);
	if(brandid=='' || brandid==null)
	{
		$("#PostAdAdvBrandId").css("border-color","#f00");
		return false;
	}
	else if(modelid=='' || modelid==null)
	{
		$("#PostAdAdvBrandId").css("border-color","");
		$("#PostAdAdvModelId").css("border-color","#f00");
		return false;
	}
	else
	{
		$("#PostAdAdvModelId").css("border-color","");

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
					var rand = Math.floor(Math.random()*100000);
					//alert(rand);
					//var frand="'"+rand+"'";
					var inner_details = "<li id='div"+rand+"'><div class='col-lg-8 col-sm-8 col-lg-12'><input type='text' name='data[PostAd][adv_brand_id]' value='"+PostAdAdvBrandId+" ("+model_nm+")"+"' class='form-control brandclass'><input type='hidden' name='data[PostAd][model_nm"+rand+"]' value='"+model_nm+"' class='form-control'><input type='hidden' name='data[PostAd][adv_brand][]' value='"+brand_id+"' class='form-control'><input type='hidden' name='data[PostAd][adv_model][]' value="+model_id+" class='form-control modelclass'></div><div class='col-lg-4 col-sm-4 col-lg-12'><div class='row'><button type='button' id='addli"+rand+"' class='btn btn-danger' onclick='remove_div("+rand+");'>X</button></div></div></li>";
					$("#show_brand_model").append(inner_details);
				}


	}
}

function remove_div(id){
	//document.getElementById("div"+id).innerHTML = "";
	//alert(id);
//document.getElementById("div"+id).innerHTML = "";
var elem = document.getElementById("div"+id);
elem.parentNode.removeChild(elem);
//$("div"+id).remove();
}
</script>
<style>
	.fl{float:left;}

</style>
<!--My Design-->
 <!--form 1-->
<?php echo $this->Form->create('PostAd'); ?>

       <div class="col-lg-12">
						 	<div class="row">
                                <!--form 1-->
                                <form>

                                <ul class="progressbar">
                                    <li>
                                    	<a href="javascript:void(0)" class="active">
                                    		<span class="active">1</span>
                                        </a>
                                    </li>

                                    <li>
                                    	<a href="javascript:void(0)">
                                    		<span>2</span>
                                        </a>
                                    </li>

                                    <li>
                                    	<a href="javascript:void(0)">
                                    		<span>3</span>
                                        </a>
                                    </li>

                                    <li>
                                    	<a href="javascript:void(0)">
                                    		<span>4</span>
                                        </a>
                                    </li>

                                    <li>
                                    	<a href="javascript:void(0)"></a>
                                    </li>
                                </ul>

                                <div class="clearfix clear40"></div>


                                <div class="col-lg-4 col-sm-4 col-xs-12">
                                	<div class="row">
                                    	<p class="sip_head" style="height:35px;"><?php echo CATEGORI;?></p>

                                        <ul class="cat_tree cat_new">
                                            <li class="item">

                                                 <?php
												 if(isset($this->request->data['PostAd']['sub_cat_id'])){$subcatid=$this->request->data['PostAd']['sub_cat_id'];$subcatname=$this->Custom->category_name($subcatid);}else{$subcatid='';$subcatname='';};
		echo $this->Form->input('category_id', array('label' => false, 'size' =>15,'type' => 'select','options' => $cat_list, 'placeholder' => 'Category','div' => false,'onChange'=>'show_subcat(this.value)'));

			echo $this->Form->input('sub_cat_id', array('label' => false, 'size' =>15,'type' => 'select','options' => array($subcatid=>$subcatname),'div' => false,'onChange'=>'return enabledButton(this.value)'));

	?>
                                            </li>
                                        </ul>
                                        <div>
                                         <?php
                                         $autoCatVal='';
                                         if(isset($this->request->data['PostAd']['category_id'])){
                                         	$catid=$this->request->data['PostAd']['category_id'];
                                         	$autoCatVal.=$this->Custom->category_name($catid);
                                         }
                                         if(isset($this->request->data['PostAd']['sub_cat_id'])){
                                         	$subcatid=$this->request->data['PostAd']['sub_cat_id'];
                                         	$autoCatVal.=" >> ".$this->Custom->category_name($subcatid);
                                         }
                                         if($autoCatVal==''){
                                         	$autoCatVal=@$this->request->data['PostAd']['category_brand'];

                                         }                                            echo $this->Form->input('category_brand', array('type'=>'text','label'=>false,'div'=>false, 'onkeyup' => 'return getautocategory();', 'onblur' => 'return getautocategory();', 'class' => 'form-control', 'value' => @$autoCatVal, 'autocomplete' => 'off', 'placeholder' => 'începe sâ scrii aici numele categoriei sau ai piesei'));
                                            ?>
                                            <div class="keywrd_pop_top2" id="topSrc2" style=""></div>
										</div>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-sm-8 col-xs-12">
                                	<div class="normal_spacer">
                                    	<p class="sip_head" style="height:35px;">Marca si model autovehicle</p>

                                        <ul class="cat_tree cat_new">
                                            <li class="item">
                                                 <?php
	 echo  $this->Form->input('adv_brand_id',array('type'=>'select', 'size' =>15,'options'=>$brand_list,'label'=>false,'div'=>false,'empty'=>CHOOSEBRAND,'onChange'=>'choose_model(this.value)', 'class' => 'sel_maker'));
	  echo $this->Form->input('adv_model_id', array('type'=>'select', 'size' =>15,'label'=>false,'div'=>false,'empty'=>CHOOSEMODEL, 'onchange' => 'return add_more_brand_model();', 'class' => 'sel_model'));

		//-------------------
	  ?>
                                            </li>

                                        </ul>


                                        <ul class="cat_tree cat_new fullpan_list"  id="show_brand_model">
                                        	<li>
                                            	<div class="col-lg-8 col-sm-8 col-lg-12">
                                                	<button type="button" class="btn btn-success"  id="add_more" onclick="add_more_brand_model();">Adauga Compatibility</button>
                                                </div>
                                                <div class="col-lg-4 col-sm-4 col-lg-12">
                                                	<div class="row">&nbsp;</div>
                                                </div>
                                            </li>
                                            <?php
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
				$uniqueid=uniqid();
			?>
            <li id='div<?php echo $uniqueid;?>'>
                <div class='col-lg-8 col-sm-8 col-lg-12'>
                <input type='text' name='data[PostAd][adv_brand_id]' value='<?php echo $brandname.' ('.$modelname.')';?>' class='form-control brandclass'>
                <input type='hidden' name='data[PostAd][model_nm<?php echo $modelname;?>]' value='<?php echo $modelname;?>' class='form-control'>
                <input type='hidden' name='data[PostAd][adv_brand][]' value='<?php echo $singlebrand;?>' class='form-control'>
                <input type='hidden' name='data[PostAd][adv_model][]' value="<?php echo $modelarr[$brandindex];?>" class='form-control modelclass'>
                </div>
                <div class='col-lg-4 col-sm-4 col-lg-12'>
                    <div class='row'>
                    <button type='button' id='addli' class='btn btn-danger' onclick="remove_div('<?php echo $uniqueid;?>')">X</button>
                    </div>
                </div>
            </li>
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
					$uniqueid=uniqid();
				?>
				<li id='div<?php echo $uniqueid;?>'>
                <div class='col-lg-8 col-sm-8 col-lg-12'>
                <input type='text' name='data[PostAd][adv_brand_id]' value='<?php echo $brandname.' ('.$modelname.')';?>' class='form-control brandclass'>
                <input type='hidden' name='data[PostAd][model_nm<?php echo $modelname;?>]' value='<?php echo $modelname;?>' class='form-control'>
                <input type='hidden' name='data[PostAd][adv_brand][]' value='<?php echo $singlebrand;?>' class='form-control'>
                <input type='hidden' name='data[PostAd][adv_model][]' value="<?php echo $modelarr[$brandindex];?>" class='form-control modelclass'>
                </div>
                <div class='col-lg-4 col-sm-4 col-lg-12'>
                    <div class='row'>
                    <button type='button' id='addli<?php echo $uniqueid;?>' class='btn btn-danger' onclick="remove_div('<?php echo $uniqueid;?>')">X</button>
                    </div>
                </div>
            </li>
				<?php
					}
				}
			}
			}
		}


		?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="clear15"></div>

                                <div class="row searchlistdata">
                                <ul class="col-lg-8 carryul">
                                <li>
                                <div class="col-lg-1" style="text-align:center;">
                                <div class="row">
                                <a href="#">
                                <img src="<?php echo $base_url;?>images/tick1.png" alt="">
                                </a>
                                </div>
                                </div>

                                <div class="col-lg-7 col-sm-7 col-lg-12">
                                <div class="datalistitem">
                                <h1><a href="#">Ati selected Catagory: </a></h1>
                                <p>
                                <span style="color:#DF5E08; font-weight:bold;"><span id="catname"><?php if(isset($this->request->data['PostAd']['category_id'])){$catid=$this->request->data['PostAd']['category_id'];echo $this->Custom->category_name($catid);};?></span><span id="subcatname"><?php if(isset($this->request->data['PostAd']['sub_cat_id'])){$subcatid=$this->request->data['PostAd']['sub_cat_id'];echo " >> ".$this->Custom->category_name($subcatid);};?></span></span>
                                </p>
                                <div class="clear"></div>
                                </div>
                                </div>

                                <div class="col-lg-4 col-sm-4 col-xs-12" style="min-height:32px;">
                                <div class="row">
                                <input type="submit" name="Submit2" value="Continua cu Descrierea &raquo;" class="blue_btn">
                                </div>
                                </div>
                                <div class="clearfix"></div>
                                </li>


                                </ul>
                                </div>
                                </form>
                                <!--form 1-->
							</div>
						 </div>
