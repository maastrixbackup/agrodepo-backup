<script type="text/javascript">
function removedata(imgid,img_fold)
{
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>RequestParts/removeimg',
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
function changeModel(brandval)
{
	$.ajax(
				{
					type: 'POST',
					url: '<?php echo $base_url; ?>RequestParts/modeldata',
					data: 'brandid='+brandval,
					success: function(data) {
						//alert(data);
						if(data)
						{
							$("#RequestPartModelId").html(data);
						}
						
					}
				});
}
function changeCity(countyval)
{
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>RequestParts/citydata',
				data: 'countyid='+countyval,
				success: function(data) {
					//alert(data);
					if(data)
					{
						$("#RequestPartCity").html(data);
					}
					
				}
			});
}
function appenPart()
{
	var totpart=$("#cout_part").val();
	var increasecount=parseInt(totpart)+1;
	//alert(increasecount);
	$("#accessories").append('<div class="col-lg-6 form_rpt" id="section'+increasecount+'" ><div class="row"><div class="clear10"></div><div class="form-group"><label class="col-lg-5 control-label"><?php echo NAMEPIECE;?> </label><div class="col-lg-7"><input name="data[RequestAccessory][name_piece][]" class="form-control name_piece" type="text" id="RequestPartNamePiece'+increasecount+'"></div></div><div class="form-group"><label class="col-lg-5 control-label"><?php echo DESCRIPTION;?></label><div class="col-lg-7"><textarea name="data[RequestAccessory][description][]" class="form-control description" id="RequestPartDescription'+increasecount+'"></textarea></div></div><div class="form-group"><label class="col-lg-5 control-label"><?php echo PARTNO;?> </label><div class="col-lg-7"><input name="data[RequestAccessory][part_no][]" class="form-control part_no" type="text" id="RequestPartPartNo"></div></div><div class="form-group"><label class="col-lg-5 control-label"><?php echo MAXPRICE;?></label><div class="col-lg-7"><input name="data[RequestAccessory][max_price][]" class="form-control" style="width:35%;float:left;margin-right:5px;" type="text" id="RequestPartMaxPrice" onkeypress="chkNumber(event)">&nbsp;<select name="data[RequestAccessory][currency][]" class="form-control" style="width:35%;float:left;" id="RequestPartCurrency"><option value="RON">RON</option><option value="EUR">EUR</option><option value="USD">USD</option></select>&nbsp;(<?php echo OPTIONAL;?>)</div></div><div class="form-group"><label class="col-lg-5 control-label"><?php echo PICTURES;?></label><div class="col-lg-7"><iframe src="<?php echo $base_url;?>RequestParts/fileupload/seqno:'+increasecount+'" style="width: 100%; height:22px; border: none; overflow: hidden;"></iframe></div><input type="hidden" name="data[RequestAccessory][part_img][]" value="'+increasecount+'" /><div id="loading'+increasecount+'" style="display:none;"></div><div id="picGallery'+increasecount+'" style="display:none;"></div></div></div><div class="clear15"></div><a href="javascript:void(0);" onclick="removePart('+increasecount+')" class="pull-right" style="margin-right:10px;"> <?php echo REMOVE;?><img src="<?php echo $base_url;?>images/delete_icon.png" /></a><div class="clear5"></div></div><div class="clear10"></div></div>');
	$("#cout_part").val(increasecount);
}
function removePart(removeid)
{
	$("#section"+removeid).remove();
}
function chkNumber(e){
	//alert(e.which);
	var kc=(e.which) ? e.which : e.keyCode; 
	if(!(( kc>= 48 && kc <= 57) || kc==46 || kc==8)){
	e.preventDefault();
	}
}

</script>

 <!--form 1-->
<?php echo $this->Form->create('RequestPart', array('type' =>'file', 'class' => 'myform')); ?>
      
      <div class="clear40"></div>
      <p class="sip_head">1. <?php echo FACTOFCAR;?></p>
         <div class="clear15"></div>
      <div class="col-lg-6">
  <div class="row"> 
                     <div class="form-group">
                        <label class="col-lg-5 control-label">*<?php echo BRANDS;?> </label>
                        <?php
						echo $this->Form->input('brand_id', array('label' => false, 'type' => 'select','options' => $brandlist, 'div' => 'col-lg-7', 'class' => 'form-control','onChange'=>'changeModel(this.value)'));
						?>
                      </div>
                       <div class="form-group">
                        <label class="col-lg-5 control-label">*<?php echo MODEL;?></label>
                        <?php
						if(isset($this->request->data['RequestPart']['brand_id']) && $this->request->data['RequestPart']['brand_id']!='')
						{
							$modellist=$this->requestAction('/RequestParts/modelget/'.$this->request->data['RequestPart']['brand_id']);
							echo $this->Form->input('model_id', array('label' => false, 'type' => 'select','options' => $modellist, 'div' => 'col-lg-7', 'class' => 'form-control'));
						}
						else
						{
							echo $this->Form->input('model_id', array('label' => false, 'type' => 'select','options' => array('' => '-Choose the model-'), 'div' => 'col-lg-7', 'class' => 'form-control'));
						}
						?>
                      </div>
                      
                       <div class="form-group">
                        <label class="col-lg-5 control-label">*<?php echo VERSION;?></label>
                        <?php echo $this->Form->input('version', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control'));?>
                      </div>
                      
                       <div class="form-group">
                        <label class="col-lg-5 control-label">*<?php echo YEAROFMANUFACTURE;?></label>
                        <?php echo $this->Form->input('yr_of_manufacture', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control'));?>
                      </div>
                      
                       <div class="form-group">
                        <label class="col-lg-5 control-label">*<?php echo ENGINES;?></label>
                       
                        <?php echo $this->Form->input('engines', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control'));?>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-lg-5 control-label"><?php echo VEHICLEIDNUMBER;?></label>
                       
                        <?php echo $this->Form->input('vehicle_identy_no', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control'));?>
                      </div>
  </div>
  </div>
      
      
      

      <div class="clearfix" style="height:20px;"></div>
      <p class="sip_head">2. <?php echo LOOKPARTOFACCESSO;?></p>
            
              
               
               <div id="accessories">
       <?php
       $partcount=1;
	   
	    if(isset($this->request->data['RequestAccessory']['name_piece'])){
		   if(is_array($this->request->data['RequestAccessory']['name_piece'])){
			   
			   foreach($this->request->data['RequestAccessory']['name_piece'] as $partindex => $singname)
			   {
				   $description=$this->request->data['RequestAccessory']['description'];
				   $part_no=$this->request->data['RequestAccessory']['part_no'];
				   $max_price=$this->request->data['RequestAccessory']['max_price'];
				   $currency=$this->request->data['RequestAccessory']['currency'];
		   ?>
           <div class="col-lg-6 form_rpt" id="section<?php echo $partcount;?>" >
                  <div class="row"> 
                      <div class="clear10"></div>
                      <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo NAMEPIECE;?></label>
									<?php echo $this->Form->input('name_piece', array('label' => false , 'value' => $singname,'name' => 'data[RequestAccessory][name_piece][]', 'div' => 'col-lg-7', 'class' => 'form-control name_piece','id' =>'RequestPartNamePiece'.$partcount));?>
								  </div>
                                   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo DESCRIPTION;?></label>
									<?php echo $this->Form->input('description', array('label' => false, 'value' => $description[$partindex],'name' => 'data[RequestAccessory][description][]','type' => 'textarea', 'cols' => false, 'rows' => false, 'div' => 'col-lg-7', 'class' => 'form-control description','id' =>'RequestPartDescription'.$partcount));?>
								  </div>
                                   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PARTNO;?></label>
                                    <?php  echo $this->Form->input('part_no', array('label' => false, 'value' => $part_no[$partindex],'name' => 'data[RequestAccessory][part_no][]', 'div' => 'col-lg-7', 'class' => 'form-control part_no'));?>
								  </div>
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo MAXPRICE;?></label>
									<div class="col-lg-7">
                                   <?php echo $this->Form->input('max_price', array('label' => false, 'value' => $max_price[$partindex],'name' => 'data[RequestAccessory][max_price][]', 'div' => false, 'class' => 'form-control', 'style' => 'width:35%;float:left;margin-right:5px;'));?>
									  &nbsp;
                                     <?php echo $this->Form->input('currency', array('label' => false,'name' => 'data[RequestAccessory][currency][]', 'type' => 'select','options' => array('RON' => 'RON','EUR' => 'EUR','USD' => 'USD'),'selected'=>$currency[$partindex], 'div' => false, 'class' => 'form-control', 'style' => 'width:35%;float:left;'));?>
                                     &nbsp; (<?php echo OPTIONAL;?>)
									</div>
								  </div>
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PICTURES;?></label>
                                     <?php //echo $this->Form->input('part_img', array('label' => false,'name' => 'data[RequestAccessory][part_img][]','type' => 'file', 'div' => 'col-lg-7', 'class' => 'form-control part_img'));?>
                                     <input type="hidden" name="data[RequestAccessory][part_img][]" value="<?php echo $partcount;?>" />
                                      <div class="col-lg-7">
                                     <iframe src="<?php echo $base_url;?>RequestParts/fileupload/seqno:<?php echo $partcount;?>" style="width: 100%; height:22px; border: none; overflow: hidden;"></iframe>
                                     </div>
                                     <div id="loading<?php echo $partcount;?>" style="display:none;"></div>
                                     <?php
									 $picgallery=$this->requestAction('/RequestParts/fetchimg/sqno:'.$partcount);
									 
									 ?>
                                     <div id="picGallery<?php echo $partcount;?>"<?php if(empty($picgallery)){?> style="display:none;"<?php }?>></div>
								  </div>
       <div class="clear15"></div>
              <a href="javascript:void(0);" onclick="removePart(<?php echo $partcount;?>)" class="pull-right" style="margin-right:10px;"> <?php echo REMOVE;?> <img src="<?php echo $base_url;?>images/delete_icon.png" /> </a>  
         <div class="clear5"></div>
       </div>
      			  <div class="clear10"></div>
       
              </div> 
              <div class="clear10"></div>
       <?php $partcount++; }}}else{?>
        <div class="col-lg-6 form_rpt" id="section1" >
                  <div class="row"> 
                      <div class="clear10"></div>
                      <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo NAMEPIECE;?></label>
									<?php echo $this->Form->input('name_piece', array('label' => false ,'name' => 'data[RequestAccessory][name_piece][]', 'div' => 'col-lg-7', 'class' => 'form-control name_piece','id' => 'RequestPartNamePiece1'));?>
								  </div>
                                   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo DESCRIPTION;?></label>
									<?php echo $this->Form->input('description', array('label' => false,'name' => 'data[RequestAccessory][description][]', 'div' => 'col-lg-7', 'class' => 'form-control description', 'cols' => false, 'rows' => false,'type' => 'textarea'));?>
								  </div>
                                  
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PARTNO;?></label>
                                    <?php  echo $this->Form->input('part_no', array('label' => false,'name' => 'data[RequestAccessory][part_no][]', 'div' => 'col-lg-7', 'class' => 'form-control part_no'));?>
								  </div>
                                  
                                  <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo MAXPRICE;?> </label>
									<div class="col-lg-7">
                                   <?php echo $this->Form->input('max_price', array('label' => false,'name' => 'data[RequestAccessory][max_price][]', 'div' => false, 'class' => 'form-control', 'style' => 'width:35%;float:left;margin-right:5px;','onkeypress'=>'chkNumber(event)'));?>
									  &nbsp;
                                     <?php echo $this->Form->input('currency', array('label' => false,'name' => 'data[RequestAccessory][currency][]', 'type' => 'select','options' => array('RON' => 'RON','EUR' => 'EUR','USD' => 'USD'), 'div' => false, 'class' => 'form-control', 'style' => 'width:35%;float:left;'));?>
                                     &nbsp; (<?php echo OPTIONAL;?>)
									</div>
								  </div>
                                  
                                   <div class="form-group">
									<label class="col-lg-5 control-label"><?php echo PICTURES;?></label>
                                     <?php //echo $this->Form->input('part_img', array('label' => false,'name' => 'data[RequestAccessory][part_img][]','type' => 'file', 'div' => 'col-lg-7', 'class' => 'form-control part_img'));?>
                                     <input type="hidden" name="data[RequestAccessory][part_img][]" value="1" />
                                     <div class="col-lg-7">
                                     <iframe src="<?php echo $base_url;?>RequestParts/fileupload/seqno:1" style="width: 100%; height:22px; border: none; overflow: hidden;"></iframe>
                                     </div>
                                     <div id="loading1" style="display:none;"></div>
                                     <div id="picGallery1" style="display:none;"></div>
								  </div>
      
       
       </div>
      			  <div class="clear10"></div>
       
              </div> 
              <div class="clear10"></div>
       <?php }?>
            
       </div> 
              
         <div class="clear10"></div>
              <a href="javascript:void(0);" onclick="appenPart();"> <?php echo ADDANOTHERPIECE;?> <img src="<?php echo $base_url;?>images/plus.jpg" />  </a>  
       <input type="hidden" value="<?php echo $partcount;?>" id="cout_part"  />
         <div class="clear10"></div>
        
               
      
      
      
       <div class="clear40"></div>
      <p class="sip_head">3. <?php echo IOFFERPART;?></p>
            
             <div class="col-lg-6">
  <div class="row"> 
      <div class="clear10"></div>
       <?php 
		if(isset($this->request->data['RequestPart']['i_offer_parts']))
		{
			$offarr=$this->request->data['RequestPart']['i_offer_parts'];
		}
		else
		{
			$offarr=array();
		}
			?>
        <div class="item_new_sh_option"> <input type="hidden" name="data[RequestPart][i_offer_parts][]" id="RequestPartIOfferParts_" value="0"><input type="checkbox" name="data[RequestPart][i_offer_parts][]" value="We" class="i_offer_parts" id="RequestPartIOfferParts" <?php if(in_array('We',$offarr)){?> checked="checked"<?php }?>> <label for="part_new1"><font><font><?php echo WE;?></font></font></label> </div>
        <div class="item_new_sh_option"> <input type="hidden" name="data[RequestPart][i_offer_parts][]" id="RequestPartIOfferParts_" value="0"><input type="checkbox" name="data[RequestPart][i_offer_parts][]" value="From Truck" class="i_offer_parts" id="RequestPartIOfferParts" <?php if(in_array('From Truck',$offarr)){?> checked="checked"<?php }?>> <label for="part_new1"><font><font><?php echo FROMTRUCK;?></font></font></label> </div>
        
      
      </div>
      </div>
      
       <div class="clear40"></div>
      <p class="sip_head">4. <?php echo WANTTOBESHIPPED;?></p>
            
             <div class="col-lg-6">
  <div class="row"> 
      <div class="clear10"></div>
      <div class="form-group">
                        <label class="col-lg-5 control-label">* <?php echo COUNTRY;?></label>
                       
                         <?php
							echo $this->Form->input('county', array('label' => false, 'type' => 'select','options' => $countylist, 'div' => 'col-lg-7', 'class' => 'form-control','onChange'=>'changeCity(this.value)'));
						?>
                      </div>
                       <div class="form-group">
                        <label class="col-lg-5 control-label">*<?php echo CITY;?></label>
                        
						<?php
                        if(isset($this->request->data['RequestPart']['county']) && $this->request->data['RequestPart']['county']!='')
                        {
                            $citylist=$this->requestAction('/RequestParts/cityget/'.$this->request->data['RequestPart']['county']);
                            echo $this->Form->input('city', array('label' => false, 'type' => 'select','options' => $citylist, 'div' => 'col-lg-7', 'class' => 'form-control'));
                        }
                        else
                        {
                            echo $this->Form->input('city', array('label' => false, 'type' => 'select','options' => array('' => '-'.CHOOSECITY.'-'), 'div' => 'col-lg-7', 'class' => 'form-control'));
                        }
                    ?>
                      </div>
                     
                      
        
        
      
      </div>
      </div>
      <div class="clear10"></div>
      <div class="carry col-lg-6"><input type="submit" name="Submit2" value="<?php echo ADDREQUEST;?>" class="newsletter_snd_btn"></div>
      <div class="rqst_login">
      <div class="clear10"></div>
       <?php
					  if(isset($openlogin) && $openlogin='yes')
					  {
						  ?>
                          <div id="openlogin form-inline">
						      
											  <div class="form-group">
												<label for="exampleInputName2"><?php echo USERID;?></label>
												&nbsp;&nbsp;
												 <input type="text" name="data[MasterUser][user_login_id]" class="form-control" id="MasterUserUserLoginId" />
											  </div>
											  <div class="form-group">
												&nbsp;&nbsp;&nbsp;&nbsp;
												<label for="exampleInputEmail2"><?php echo PASSWORD;?></label>
												&nbsp;&nbsp;
												<input type="password" name="data[MasterUser][user_pass]"  id="MasterUserUserPass" class="form-control" />
											  </div>
											  
											  &nbsp;&nbsp;
											  <input type="submit" class="btn btn-success" value="<?php echo LOGIN;?>">
											  
											  <div class="clearfix"></div>
											  <br>
											  <div class="form-group">
												<label for="exampleInputEmail2"><?php echo LOGINFACEBOOKACCOUNT;?></label>
												<br>
												<fb:login-button scope="public_profile,email" class="faacebook_suctomCL" onlogin="checkLoginState('innerpg');">
<?php echo FBLOGIN;?>
</fb:login-button>&nbsp;<span id="innerfbloader">
											  </div>

                          </div>
                          <?php
					  }
					  ?>
      </div>
  </div>
    </form>
<!--form 1--> 