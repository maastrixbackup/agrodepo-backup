<?php

echo $this->element('header-home');
$request_id=stripslashes($RequestRes['RequestPart']['request_id']);
//pr($RequestRes['RequestPart']);
$part_id=stripslashes($AccessoryRes['RequestAccessory']['part_id']);
$parts_no=stripslashes($AccessoryRes['RequestAccessory']['part_no']);
if($AccessoryRes['RequestAccessory']['created']=='0000-00-00 00:00:00')
{
	$partsdate="N/A";
}
else
{
@$partsdate=date("d.m.Y",strtotime(stripslashes($AccessoryRes['RequestAccessory']['created'])));
}
$brandid=stripslashes($RequestRes['RequestPart']['brand_id']);
$brandname=$this->Custom->brand_nm($brandid);
$model_id=stripslashes($RequestRes['RequestPart']['model_id']);
$modelname=$this->Custom->brand_nm($model_id);
$year_of_mfg=stripslashes($RequestRes['RequestPart']['yr_of_manufacture']);
$version=stripslashes($RequestRes['RequestPart']['version']);
$engines=stripslashes($RequestRes['RequestPart']['engines']);
$vehicle_id_no=stripslashes($RequestRes['RequestPart']['vehicle_identy_no']);
$countyid=stripslashes($RequestRes['RequestPart']['county']);
$countyname=$this->Custom->region_nm($countyid);
$cityid=stripslashes($RequestRes['RequestPart']['city']);
$cityname=$this->Custom->location_nm($cityid);
$descriptions=stripslashes($AccessoryRes['RequestAccessory']['description']);
$price=stripslashes($AccessoryRes['RequestAccessory']['max_price']);
$status=stripslashes($AccessoryRes['RequestAccessory']['status']);
$want_song=stripslashes($RequestRes['RequestPart']['want_song']);
if(!empty($want_song))
{
$postAdres=$this->Custom->dezPostAdsRes();
}
else
{
	$postAdres=array();
}
$statusarr=array(0=> 'Pending', 1 => 'Active', 2=> SOLVED);
$created=$RequestRes['RequestPart']['created'];
$modified=$RequestRes['RequestPart']['modified'];
$requestdate=$this->Custom->Bap_cust_uni_time_since($created);
$modifieddate=$this->Custom->Bap_cust_uni_time_since($modified);
$userid=$RequestRes['RequestPart']['user_id'];
$userdetails=$this->Custom->BapUserDetails($userid);
$usertypearr=array(1=> BUYERS, 2=> 'Seller');
$usercounty=$this->Custom->region_nm($userdetails['MasterUser']['country_id']);
$usercity=$this->Custom->region_nm($userdetails['MasterUser']['locality_id']);

$c_date=date_create($userdetails['MasterUser']['created']);
$now=date_create(date('Y-m-d h:i:s'));
$diff=date_diff($c_date,$now);
$memberdetails=$this->Custom->BapCustUniMembership($userdetails['MasterUser']['user_id']);
$singpartsimg=$this->Custom->RequestSingimg($part_id);
$requestImg=$this->Custom->RequestAllImg($part_id);
//pr($this->request->data);
$payment_mode=stripslashes($RequestRes['RequestPart']['payment_mode']);
$personal_teaching=stripslashes($RequestRes['RequestPart']['personal_teaching']);
$courier=stripslashes($RequestRes['RequestPart']['courier']);
$free_courier=stripslashes($RequestRes['RequestPart']['free_courier']);
$courier_cost=stripslashes($RequestRes['RequestPart']['courier_cost']);
$romanian_mail=stripslashes($RequestRes['RequestPart']['romanian_mail']);
$romanian_mail_cost=stripslashes($RequestRes['RequestPart']['romanian_mail_cost']);
$free_romanian_mail=stripslashes($RequestRes['RequestPart']['free_romanian_mail']);
?>
<script type="text/javascript">
function removedata(imgid,img_fold)
{
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>RequestParts/removeBidImg',
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
function bidOffer(showval)
{
	if(showval==1)
	{
		$("#showquestion").hide();
		$("#showoffer").show();
		$("#bidoffer").attr("onClick","bidOffer(0);");
		$("#addquestion").attr("onClick","addQuestion(1);");
		 $('html, body').animate({
        scrollTop: $("#showoffer").offset().top- 135
    }, 2000);
	}
	else
	{
		$("#showoffer").hide();
		$("#showquestion").hide();
		$(".bidoffer").attr("onClick","bidOffer(1);");
		$(".addquestion").attr("onClick","addQuestion(1);");
	}
}
function addQuestion(showval)
{

	if(showval==1)
	{
		$("#showoffer").hide();
		$("#showquestion").show();
		$(".addquestion").attr("onClick","addQuestion(0);");
		$(".bidoffer").attr("onClick","bidOffer(1);");
		 $('html, body').animate({
        scrollTop: $("#showquestion").offset().top- 135
    }, 2000);
	}
	else
	{
		$("#showoffer").hide();
		$("#showquestion").hide();
		$(".addquestion").attr("onClick","addQuestion(1);");
		$(".bidoffer").attr("onClick","bidOffer(1);");
	}
}

</script>
<script type="text/javascript">
/* wait for images to load */
//$(window).load( function() {
$(document).ready(function() {

	$('.phone').click( function() {
	$('.numdetails').slideToggle('5000', function(){
	if ($('.numdetails').is(':visible')) {
	$('#toggleButton').val('Hide');
	} else {
	$('#toggleButton').val('Show'); 
	}
	});
	});
});
</script>
 <div class="container">
		<div class="row">
        	<div class="innerpanel">
				<!-- middle Start -->
				
                <div class="cerera_model_details col-lg-12">
                	<div class="cerera_model_block">
                    	<div class="col-lg-8 col-sm-8 col-xs-12">
                        	<div class="row">
                            	<h1><?php echo stripslashes($AccessoryRes['RequestAccessory']['name_piece']);?></h1>
                               <?php if(!empty($RequestRes['RequestPart']['want_song'])){?> <h2>doreste piesa <?php if($RequestRes['RequestPart']['want_song']=='new'){echo "noua";}else if($RequestRes['RequestPart']['want_song']=='used'){echo "din dezmembrari";}else if($RequestRes['RequestPart']['want_song']=='both'){echo "noua sau din dezmembrari";}}?></h2>
                                <h4>Pret: <?php echo $price;?></h4>
                                
                                <div class="clearfix"></div>
                            	<?php if(!empty($requestImg))
								{
									?>
                                <div class="listCere">
                                <?php
								foreach ($requestImg as $requestsingimg)
								{
									if($requestsingimg['RequestImg']['img_path']!='')
									{
									?>
                                	<div class="col-lg-3 blockimg23">
                                        <a href="#"><img src="<?php echo $base_url;?>files/requestpart/<?php echo $requestsingimg['RequestImg']['img_path'];?>" alt=""></a>
                                    </div>
                                    
                                   
                                    <?php
									}
								}
								?>
                                    
                                </div>
                                <?php
								}
								?>
                                
                                <div class="clearfix"></div>
                                
                                <div class="col-lg-4 col-sm-4 col-xs-12">
                                	<div class="row">
                                    	<div class="cerethird_Til">Garantie: <?php if(!empty($postAdres)){echo $postAdres['PostAd']['warranty'];}?></div>
                                    	<div class="cerethird_Ltlil">
                                            Liverare: <?php if($personal_teaching==1){echo PERSONALTEACHING.', ';}?>
                            <?php if($courier==1 || $free_courier==1){
								if($free_courier==1){$cost='free';}else{$cost=$courier_cost.'RON';}
								echo COURIORDELIVERYCOST.'('.$cost.'), ';}?>
                            <?php if($romanian_mail==1 || $free_romanian_mail==1){
								if($free_romanian_mail==1){$rcost='free';}else{$rcost=$romanian_mail_cost.'RON';}
								echo ROMANIDELIVERYCOST.'('.$rcost.')';?>
                            <?php }?> <br>
                                            Plats: Ramburs
                                        </h2>
                                        </div>
                                    </div>
                            	</div>
                            
                                <div class="col-lg-8 col-sm-8 col-xs-12">
                                    <div class="row Cerre_new_btn">
                                       <!-- <a href="#" class="cancelbtn-new">selecteaza</a> 
                                        <a href="#" class="savebtn-new">Intreaba vanzatorul</a>-->
                                         <a href="javascript:void(0);" <?php if(($userid != $usr_id) && ($AccessoryRes['RequestAccessory']['status']!=2)){?>onClick="bidOffer(1);" class="cancelbtn-new bidoffer"<?php }else{?> class="cancelbtn-new bidoffer offer_disabled"<?php }?>><?php echo OFFER;?></a>
                                          <a href="javascript:void(0);" <?php if(($userid != $usr_id) && ($AccessoryRes['RequestAccessory']['status']!=2)){ ?> class="savebtn-new addquestion" onClick="addQuestion(1);"<?php }else { ?> class="savebtn-new addquestion offer_disabled"<?php }?> >
                        <?php echo REQSTDETAIIL;?>
                        </a>
                       
                                    </div>
                                </div>
                        </div>
                    </div>
                    	
                        <div class="col-lg-4 col-sm-4 col-xs-12">
                        	<div class="spacerLT">
                                <div class="seller_limg">
                                    <span title="Private Seller" class="label">
                                     <?php if(!empty($memberdetails)){ 
												if($memberdetails['UserMembership']['plan_img']!=''){?>
                                                <img src="<?php echo $base_url;?>files/memberplanimg/<?php echo $memberdetails['UserMembership']['plan_img'];?>" alt="" width="60" height="60"/></div>
                                                <?php }else{?>
                                                <img src="<?php echo $base_url;?>images/no_plan.png" alt="" width="60" height="60"/>
												<?php }}else{?>
                                                <img src="<?php echo $base_url;?>images/no_plan.png" alt="" width="60" height="60"/>
												<?php }?>
                                    </span> 
                                </div>
                                
                                <div class="seller_limg2">
                                    <span title="Private Seller" class="label">
                                    <br>
                                     <?php if(@$userdetails['MasterUser']['profile_img']!=''){?>
                                        <img src="<?php echo $base_url;?>files/profileimg/<?php echo $userdetails['MasterUser']['profile_img'];?>" alt="<?php echo @$userdetails['MasterUser']['first_name'].' '.@$userdetails['MasterUser']['last_name'];?>" style="width:160px;"/>
                                         <?php }else{?><img src="<?php echo $base_url;?>images/no_userphoto.png" alt="<?php echo @$userdetails['MasterUser']['first_name'].' '.@$userdetails['MasterUser']['last_name'];?>" style="width:160px;"/><?php }?>
                                    </span> 
                                </div>
                                
                                <div class="clearfix"></div>
                                <div class="blue_txt3"><?php if(!empty($memberdetails)){echo 'Vanzator premiu';}else{echo "Vanzator liber";}?></div>   
                                <div class="line"></div> 
                                <div class="blue_txt4"><?php echo @$userdetails['MasterUser']['first_name'].' '.@$userdetails['MasterUser']['last_name'];?></div> 
                                <div class="glyphicon glyphicon-map-marker txt">  <?php echo $countyname.', '.$cityname;?> </div>
                                <div class="col-lg-12">
                                <div class="col-lg-10">
                                    <a href="javascript:void(0);" class="savebtn-green phone">
                                        <img src="<?php echo $base_url;?>images/details-Call.png" alt=""> <?php echo PHONE;?> : <?php echo VIEW;?>
                                    </a>  
                                    <div class="clearing"></div>
							  					<div style="position: relative;width: 100%;margin:13px 10px 0px 0px;border-radius: 5px;" class="numdetails">
        	<h2> <?php echo WHISK;?>: <?php echo @$userdetails['MasterUser']['telephone1'];?>         </h2>
            <p><?php echo NOTICESDATAA;?></p>
          </div>              
                                    <div class="savebtn-green2">
                                        <?php echo $this->Custom->userAllPositivePercent($userdetails['MasterUser']['user_id']);?>% <?php echo POSITIVERATING;?>
                                    </div>
                                    <div class="details_rating">
                                        <span class="rtng_cere"><?php echo RATINGS;?>: </span>
                                        <div class="rating rtng_cere" id="rate1">
                                           <?php $avgrating=$this->Custom->userRatingcount($userdetails['MasterUser']['user_id']);
                                                  if(!empty($avgrating))
                                                    {
                                                        for($singavgrating=1; $singavgrating<=round($avgrating); $singavgrating++)
                                                        {
                                                            if($singavgrating>$avgrating)
                                                            {
                                                                ?>
                                                                <img border="0" src="<?php echo $base_url;?>/images/star-small-halfactive.png" alt="rating" />
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <img border="0" src="<?php echo $base_url;?>/images/star-small-active.png" alt="rating" />
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                    if(round($avgrating)<5)
                                                    {
                                                        for($singavg=5; round($avgrating)<$singavg; $singavg--)
                                                        {
                                                            ?>
                                                            <img border="0" src="<?php echo $base_url;?>/images/star-small-inactive.png">   
                                                            <?php
                                                        }
                                                    }
                                                 ?>
                                        </div>
                                        
                                    </div>
                                    <br>
                                </div>
                            </div>
                            </div>
                            
                            
                        </div>
                	</div>
				 <div class="clear"></div> 
                 <div class=" col-lg-12">
                               
                                <div class="cerere_left">
                                  
                                  
                                   <!--   Car Specificaton New page starts here    --> 
                            
                                    <div class="wrapper-bx1 car_spcs2">
                                        <table class="table table-bordered specificPanel">
                                            <thead>
                                                <tr>
                                                    <td colspan="5"><?php echo DATAABTREQST;?></td>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <tr>
                                                    <th><?php echo BRAND;?></th>
                                                    <th><?php echo MODEL;?></th>
                                                    <th><?php echo ENGINES;?></th>
                                                    <th>An</th>
                                                    <th><?php echo VERSION;?></th>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $brandname;?></td>
                                                    <td><?php echo $modelname;?></td>
                                                    <td> <?php echo $engines;?>  </td>
                                                    <td><?php echo $year_of_mfg;?></td>
                                                    <td><?php echo $version;?></td>
                                                </tr>
                                                <?php if($vehicle_id_no!=''){?>
                                                <tr>
                                                    <td colspan="5">Serie Sasiu: <?php echo $vehicle_id_no;?> </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <!--   Car Specificaton New page starts here    --> 
                                  
                                  
                                </div>
                                
                                
                                <div class="cerere_right">
                                
                                <div class="clear15"></div>
                                 <div class="clear5"></div>
                                 <?php 
            
            $ad_details=$this->Custom->rightsideAd();
			if(count($ad_details) >0 && !empty($ad_details)){
            $ad_details=$ad_details['Advertisement'];
            if($ad_details['ad_type']==1){ // for banner type
                    ?>
                     <a href="<?php echo $ad_details['banner_link'];?>" target="_blank">
            <img src="<?php echo $this->webroot.'files/advertisement/'.$ad_details['banner_image'];?>" alt="<?php echo $ad_details['banner_title'];?>" style="width:100%;height: 240px;">
            </a>
                    <?php
                }elseif($ad_details['ad_type']==2){ // for script type
                    
                    echo stripslashes($ad_details['ad_script']);
                }
			}
            
            ?>
                                </div>
                                 <div class="clearfix" style="height:1px;"></div>
                            
                           <div>
                               
                                <div class="clear15"></div> 
                                <!--offerform-->
                                
                                <div class="message_text bg_grey post_offer_message" id="showoffer" <?php if(!isset($this->request->data['bidoffer'])){?> style="display:none"<?php }?>>
                                <?php echo $this->Form->create('BidOffer',array('type' => 'file')); ?>
                                            <div class="sub_message_text_wrapper">
                                              <div class="msg_date">
                                                <font>
                                                <font>
                                                <?php echo date('F d, Y, H:i');?>
                                                </font>
                                                </font>
                                              </div>
                                              
                                <div class="description_head">Bid</div>              
                                              
                                              <div id="msg_offer_groups0">
					<div class="msg_price_group">
	<div class="msg_group_desc">
		<div class="msg_group_label"><?php echo PLAY;?> <span class="msg_group_info">(<?php echo DACIALOGANFRONT;?>)</span></div>
         <?php echo $this->Form->input('piece', array('label' => false, 'div' => false, 'class' => 'msg_input_price'));?>
	</div>
	<div class="msg_group_price">
		<div class="msg_group_label"><?php echo PRICEWITHVAT;?></div>
        <?php echo $this->Form->input('price', array('label' => false, 'div' => false, 'class' => 'msg_input_price'));?>
	</div>
	<div class="msg_group_currency">
		<div class="msg_group_label"><?php echo CURRENCY;?></div>
                         <?php
		echo $this->Form->input('currency', array('label' => false,'type' => 'select','options' => array('' => 'Select','RON' => 'RON','EUR' => 'EUR','USD' => 'USD'), 'div' => false, 'class' => 'msg_input_price'));
		?>
	</div>
	<div class="msg_group_um">
		<div class="msg_group_label">U.M.</div>
                        <?php
		echo $this->Form->input('um', array('label' => false,'type' => 'select','options' => array('' => 'Select','buc' => 'buc','set' => 'set'), 'div' => false, 'class' => 'msg_input_price'));
		?>
	</div>
	<div class="msg_group_comment">
		<div class="msg_group_label"><?php echo OBSERVATIONON;?> <span class="msg_group_info">(<?php echo THEYSEEONLY;?>)</span></div>
         <?php echo $this->Form->input('comment', array('label' => false, 'type' => 'text', 'placeholder' => 'ex: Cod piesă / Furnizor / Raft', 'div' => false));?>
	</div>
	<div class="clearing"></div>
</div>

<!--<div class="msg_price_group">
	<div class="msg_group_desc">
		<div class="msg_group_label">Piesa <span class="msg_group_info">(ex: Bară faţă Dacia Logan roşie fără zgârieturi)</span></div>
		<input type="text" onkeyup="test_filled_groups($(this));" class="msg_input_price" value="" name="msg_group[2][desc]">
	</div>
	<div class="msg_group_price">
		<div class="msg_group_label">Preţ cu TVA</div>
		<input type="text" onkeyup="test_filled_groups($(this));" class="msg_input_price" value="" name="msg_group[2][price]">
	</div>
	<div class="msg_group_currency">
		<div class="msg_group_label">Moneda</div>
		<select onchange="test_filled_groups($(this));" class="msg_input_price" name="msg_group[2][currency]">
			<option value="">-------</option>
							<option value="41">RON</option>
								<option value="14">EUR</option>
								<option value="1">USD</option>
						</select>
	</div>
	<div class="msg_group_um">
		<div class="msg_group_label">U.M.</div>
		<select onchange="test_filled_groups($(this));" class="msg_input_price" name="msg_group[2][um]">
			<option value="">-------</option>
							<option value="1">buc</option>
								<option value="2">set</option>
						</select>
	</div>
	<div class="msg_group_comment">
		<div class="msg_group_label">Observaţii private <span class="msg_group_info">(le vezi doar tu)</span></div>
		<input type="text" placeholder="ex: Cod piesă / Furnizor / Raft" title="Poţi nota de exemplu codul piesei pentru care faci oferta. Doar tu vei vedea aceste notiţe şi îţi vom aminti de ele dacă oferta este câştigătoare." onkeyup="test_filled_groups($(this));" class="" value="" name="msg_group[2][comment]">
	</div>
	<div class="clearing"></div>
</div>-->

				</div>
                                              
                                              
                                              
                <div style="padding:12px 0 8px 0;">
					<div class="clearing"></div>
					<div class="description_head h_width"><?php echo OFFER;?>:</div>
                    <input type="hidden" name="data[BidOffer][offers]" id="BidOfferOffers_" value="0">
                    <?php if(isset($this->request->data['BidOffer']['offers'])){$offers=$this->request->data['BidOffer']['offers'];}else{$offers='';}?>
					<label class="offer_sp_label"><input type="radio" name="data[BidOffer][offers]" id="BidOfferOffers" value="New"<?php if($offers=='New'){?> checked="checked"<?php }?> > &nbsp; <?php echo NEWPARTSS;?></label>
					<label class="offer_sp_label" style="width:150px;"><input type="radio" name="data[BidOffer][offers]" id="BidOfferOffers" value="Used"<?php if($offers=='Used'){?> checked="checked" <?php }?>> &nbsp; <?php echo USEDPARTS;?></label>
					<div class="clearing"></div>
				</div>  
                                              
                 <div style="padding:12px 0 8px 0;">
					<div class="clearing"></div>
					<div class="description_head h_width"><?php echo AVAILABELITY;?> :</div>
                    <?php if(isset($this->request->data['BidOffer']['availbility'])){$availbility=$this->request->data['BidOffer']['availbility'];}else{$availbility='';}?>
                    <input type="hidden" name="data[BidOffer][availbility]" id="BidOfferAvailbility_" value="0">
					<label class="offer_sp_label"><input type="radio" name="data[BidOffer][availbility]" id="BidOfferAvailbility" value="1"<?php if($availbility==1){?> checked="checked" <?php }?> > &nbsp; <?php echo INSTOCK;?></label>
					<label class="offer_sp_label" style="width:150px;"><input type="radio" name="data[BidOffer][availbility]" id="BidOfferAvailbility"<?php if($availbility==2){?> checked="checked" <?php }?> value="2"> &nbsp; <?php echo CUSTOMMADE;?></label>
					<div class="clearing"></div>
				</div>                              
                
                <div class="clearing"></div>
                <div class="description_head"><?php echo DELICERYYY;?></div>
                
                <div class="msg_price_group ch_delivery">
                <?php if(isset($this->request->data['BidOffer']['personal_teaching'])){$personal_teaching=$this->request->data['BidOffer']['personal_teaching'];}else{$personal_teaching='';}?>
                <input type="hidden" name="data[BidOffer][personal_teaching]" id="BidOfferPersonalTeaching_" value="0">
                    <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][personal_teaching]" id="BidOfferPersonalTteaching" value="1"<?php if($personal_teaching==1){?> checked="checked" <?php }?> > <span>&nbsp;<?php echo PERSONALTEACHING;?></span></label>
					<div class="clear10"></div>
                     <?php if(isset($this->request->data['BidOffer']['courier'])){$courier=$this->request->data['BidOffer']['courier'];}else{$courier='';}?>
                    <input type="hidden" name="data[BidOffer][courier]" id="BidOfferCourier_" value="0">
                    <label class="offer_sp_label"><input type="checkbox"  name="data[BidOffer][courier]" id="BidOfferCourier"  value="1"<?php if($courier==1){?> checked="checked" <?php }?>> <span>&nbsp;<?php echo COURIER;?></span></label>
                     <?php if(isset($this->request->data['BidOffer']['courier_cost'])){$courier_cost=$this->request->data['BidOffer']['courier_cost'];}else{$courier_cost='';}?>
                     <label class="offer_sp_label"> <?php echo DELIVERYCOST;?> <input type="text" value="<?php echo $courier_cost;?>" name="data[BidOffer][courier_cost]" id="BidOfferCourierCost">  <span>&nbsp;RON</span></label>
                     <?php if(isset($this->request->data['BidOffer']['free_courier'])){$free_courier=$this->request->data['BidOffer']['free_courier'];}else{$free_courier='';}?>
                     <input type="hidden" name="data[BidOffer][free_courier]" id="BidOfferRreeCourier_" value="0">
                     <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][free_courier]" id="BidOfferFreeCourier" value="1"<?php if($free_courier==1){?> checked="checked" <?php }?> > <span>&nbsp;<?php echo FREEDELIVERYCOURIER;?></span></label>
					<div class="clear10"></div>
                    <?php if(isset($this->request->data['BidOffer']['roman_mail'])){$roman_mail=$this->request->data['BidOffer']['roman_mail'];}else{$roman_mail='';}?>
                    <input type="hidden" name="data[BidOffer][roman_mail]" id="BidOfferRomanMail_" value="0">
                     <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][roman_mail]" id="BidOfferRomanMail" value="1"<?php if($roman_mail==1){?> checked="checked" <?php }?>> <span>&nbsp;<?php echo ROMANIANMAIL;?></span></label>
                       <?php if(isset($this->request->data['BidOffer']['roman_mail_cost'])){$roman_mail_cost=$this->request->data['BidOffer']['roman_mail_cost'];}else{$roman_mail_cost='';}?>
                     <label class="offer_sp_label"> <?php echo DELIVERYCOST;?> <input type="text" value="<?php echo $roman_mail_cost;?>" name="data[BidOffer][roman_mail_cost]" id="BidOfferRomanMailCost" >  <span>&nbsp;RON</span></label>
                       <?php if(isset($this->request->data['BidOffer']['free_roman_mail'])){$free_roman_mail=$this->request->data['BidOffer']['free_roman_mail'];}else{$free_roman_mail='';}?>
                     <input type="hidden" name="data[BidOffer][free_roman_mail]" id="BidOfferFreeRomanMail_" value="0">
                     <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][free_roman_mail]" id="BidOfferFreeRomanMail" value="1" <?php if($free_roman_mail==1){?> checked="checked" <?php }?>> <span>&nbsp;<?php echo FREEDELIVERYROMAILMAIL;?></span></label>
					<div class="clear10"></div>
                    
                     <label class="offer_sp_label"><span>&nbsp;<?php echo TIMEREQUIREDPROCESS;?></span></label>
                     <label class="offer_sp_label"> 
                      <?php
		echo $this->Form->input('time_required', array('label' => false,'type' => 'select','options' => array('' => 'Select', '1' => '1 Day','2'=>'2 Days','3'=>'3 Days', '4' => '4 Days', '5' => '5 Days', '10' => '10 Days', '15' => '15 Days', '30' => '30 Days'), 'div' => false, 'class' => 'msg_input_price','style' => 'width:50%'));
		?>
                     </label>
                 
					<div class="clear10"></div>
                    
                    <label class="offer_sp_label"><span>&nbsp; <?php echo TERMOFDELIVER;?></span></label>
                    <?php echo $this->Form->input('terms_of_delivery', array('label' => false, 'type' => 'textarea','cols' => false, 'rows' => false, 'div' => false, 'class' => 'form-control','style' =>'width:100%'));?>
                 
					<div class="clear10"></div>
                </div>
                
                
                 <div class="clear15"></div>
                <div class="description_head"><?php echo PAYMENTMETHODS;?></div>
                
                <div class="msg_price_group ch_delivery">
                 <?php if(isset($this->request->data['BidOffer']['payment_method'])){$payment_method=$this->request->data['BidOffer']['payment_method'];}else{$payment_method=array();}?>
                <input type="hidden" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod_" value="0">
                      <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod1"<?php if(is_array($payment_method) && in_array('Cash on delivery',$payment_method)){?> checked="checked"<?php }?> value="Cash on delivery">
                       <span>&nbsp;<?php echo CASHONDELICERY;?></span></label>
                      <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod2"<?php if(is_array($payment_method) && in_array('Upon delivery',$payment_method)){?> checked="checked"<?php }?>  value="Upon delivery'">
                       <span>&nbsp;<?php echo UPONDELIVERY;?></span></label>
                      <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod3"<?php if(is_array($payment_method) && in_array('Wire Transfer',$payment_method)){?> checked="checked"<?php }?>  value="Wire Transfer"> <span>&nbsp;<?php echo WIRETRANSFER;?></span></label>
                      <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod4"<?php if(is_array($payment_method) && in_array('Banking Card',$payment_method)){?> checked="checked"<?php }?>  value="Banking Card"> <span>&nbsp;<?php echo BANKCARD;?></span></label>
                      <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod5"<?php if(is_array($payment_method) && in_array('Others',$payment_method)){?> checked="checked"<?php }?>  value="Others"> <span>&nbsp;<?php echo OTHER;?></span></label>
                </div>
                <?php if($this->Session->check('User')){?>
                 <div class="clear15"></div>
                <div class="description_head"><?php echo PHOTOOFSONG;?></div>
                <iframe src="<?php echo $base_url;?>RequestParts/bidupload/<?php echo $part_id;?>" style="width: 100%; height:22px; border: none; overflow: hidden;"></iframe>
                 <div id="loading" style="display:none;"></div>
                 <div id="bidgallery" style="display:none;"></div>
                 <?php }?>
                <div class="clear10"></div>
                <div style="text-align:center;">
                <input type="hidden" name="data[BidOffer][parts_id]" value="<?php echo $part_id;?>" />
                <input type="hidden" name="data[BidOffer][request_id]" value="<?php echo $request_id;?>" />
                <button type="submit" name="bidoffer" class="gbutton6 gbuttonnew" rel="nofollow" title="Modify"><?php echo ADDOFFER;?></button>
                
                </div>
                </div>
                                            
											
											<div class="clear" style="height:5px;"></div>
											
											
											
							  
                              
                              <?php 
							  if(isset($bidopenlogin) && $bidopenlogin=='yes'){?>
                              
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
												  <input type="submit" name="bidoffer" class="btn btn-success" value="Login">
												  
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
                              <?php }?>
							 
                                            
                                            
											<div class="clear" style="height:25px;"></div>
											 </form>
                                          </div>
                                  
                               <!--offerformend-->        
                              
							<!--question form start-->
                            
                 <div class="message_text bg_grey post_offer_message col-lg-12" id="showquestion" <?php if(!isset($this->request->data['question'])){?> style="display:none"<?php }?>><div class="datascl">
            <div class="row">
            <div class="col-lg-12">
            
            <h2><?php echo QUESTIONABTREQUESTPARTS;?></h2>
            <br>
            <div class="product_section product_shipping">
              <p>
                <?php echo QUESTIOONONTHISNOTICE;?>
              </p>
            </div>
            
            <div class="clearfix"></div>
            
            <h5><?php echo ADDRESSELLERQUESTION;?></h5>
            
            <div class="highlight">
                <div class="col-lg-7">
                    <div class="row">
                    
                        <?php echo $this->Form->create('RequestQuestion'); ?>
                       
                           <?php
						echo $this->Form->input('description', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));
						echo $this->Form->input('request_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$request_id));
						echo $this->Form->input('parts_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$part_id));
						?>
                          <div class="clear" style="height:20px"></div>
                          <div class="captch">
                              <img src="<?php echo $base_url;?>captcha/captcha_code_file.php?rand=<?php echo rand();?>" id="captchaimg">
                              
                          <input type="text" class="required form-control" id="code" name="code">
                          </div>
                          <div class="clear10"></div>
                          <button type="submit" name="question" class="btn gbutton6"><?php echo ASKQUESTIONSS;?></button>
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
											  <input type="submit" name="question" class="btn btn-success" value="Login">
											  
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
                        </form>
                        
                    </div>
                </div>
                
                <div class="col-lg-1"></div>
                
                <div class="col-lg-4">
                    <div class="msg_label red_label">
                        <span class="warning_sign"></span>
                        <b><font><font><?php echo PROHIBITED;?></font></font></b>
                        <font><font> <?php echo PERSONALINFODATA;?></font></font>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
             </div>
        </div></div></div>
        					<!--question form end-->
                           
                           </div>
                           </div>
									
				<!-- middle end -->
				
				<div class="clearfix" style="height:10px;"></div>
                </div>
		</div>
					
			<?php /*?><div class="innerpanel">
				<!-- Left Sidebar Start -->
					<div class="col-md-12 prof">
						 <div class="clearfix" style="height:15px;"></div>
						 
                         <div id="breadcrumb">
                            <ul class="crumbs">
                                <li class="first">
                                	<a style="z-index:9;" href="<?php echo $base_url;?>"><span></span><?php echo HOME;?></a>
                                </li>
								<li class="first">
                                	<a style="z-index:9;" href="<?php echo $base_url;?>pages/request-parts"><span></span> <?php echo PARTREQUEST;?></a>
                                </li>
                                <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo stripslashes($AccessoryRes['RequestAccessory']['name_piece']);?></a></li>   
                            </ul>
                        </div>
                        
                        <div class="clearfix" style="height:15px;"></div>
                        
                        <?php echo $this->Session->flash(); ?>
                       <!-- <div class="clearfix" style="height:10px;"></div>
                        <h2 class="detailstitle1" style="color:#DF5E08">Ac ducts</h2>-->
                        
                        <div class="clearfix" style="height:15px;"></div>

						 <div class="col-lg-12">
                         	<div class="row cereri">
                            	
                                 <div class="clear"></div> 
                               
                                <div class="wrapper-bx">
                                <div class="clear10"></div>
                                   <div class="col-lg-2">
                                       
                                            <?php
											if(!empty($singpartsimg)){
												if($singpartsimg['RequestImg']['img_path']!='')
												{
												?>
                                                <img src="<?php echo $base_url;?>files/requestpart/<?php echo $singpartsimg['RequestImg']['img_path'];?>" alt="dez" class="imagefull imgborder"/>
                                                <?php
												}
												else
												{
													?>
                                                <img src="<?php echo $base_url;?>images/profileholder.png" alt="dez" class="imagefull imgborder"/>
                                                <?php
												}
												}else
												{
													?>
                                                <img src="<?php echo $base_url;?>images/profileholder.png" alt="dez" class="imagefull imgborder"/>
                                                <?php
												}?>
                                                <div class="clear10"></div>
                                                
                                                <div class="aligncenter">
                                                <?php if(!empty($memberdetails)){ 
												if($memberdetails['UserMembership']['plan_img']!=''){?>
                                                <img src="<?php echo $base_url;?>files/memberplanimg/<?php echo $memberdetails['UserMembership']['plan_img'];?>" alt="dez" width="50%"/></div>
                                                <?php }else{?>
                                                <img src="<?php echo $base_url;?>images/no_plan.png" alt="dez" width="50%"/></div>
												<?php }}else{?>
                                                <img src="<?php echo $base_url;?>images/no_plan.png" alt="dez" width="50%"/></div>
												<?php }?>
                                                <div class="clear10"></div>
                                                <p class="pt_number"><?php if(!empty($memberdetails)){ echo $memberdetails['UserMembership']['memb_type']." Member";}?></p>
                                                <p class="deals_number"><?php echo OFFERSRECIVEDD;?><br> <strong><?php $request_count=$this->Custom->count_bid_type($part_id);?>
                                    <?php if(count($request_count)){echo array_sum($request_count);}else{ echo 0;}?></strong></p>
                                           
                                      
                                   </div>
                                   
                                   <div class="col-lg-6" style="padding-left:40px;">
                                        <h1 class="h1b"><?php echo stripslashes($AccessoryRes['RequestAccessory']['name_piece']);?></h1>
                                        <div class="description font2"><?php echo $brandname.' '.$modelname.' '.$version.' '.$year_of_mfg.' '.$engines;?></div>
                                        
                                        <div class="clear10"></div>
                                        <div class="description_head redtxt"><?php echo CODPIECES;?>: <?php echo $parts_no;?></div>
                                        <div class="description"><?php echo APPLICATIONDATE;?>: <?php echo $partsdate;?></div>
                                        
                                        <div class="clear15"></div>
                                        <!--<div class="description font2">Throttle with geared motor step by step</div>-->
                                        <div class="description"><?php echo $descriptions;?></div>
                                        <div class="clear15"></div>
                                        <div class="clear40"></div>
                                        
                                        <a href="javascript:void(0);" <?php if(($userid != $usr_id) && ($AccessoryRes['RequestAccessory']['status']!=2)){ ?> class="org_btn radius-zero addquestion" onClick="addQuestion(1);"<?php }else { ?> class="org_btn radius-zero addquestion offer_disabled"<?php }?> >
                        <?php echo REQSTDETAIIL;?>
                        </a> &nbsp; &nbsp;
                        <a href="javascript:void(0);" <?php if(($userid != $usr_id) && ($AccessoryRes['RequestAccessory']['status']!=2)){?>onClick="bidOffer(1);" class="blue_btn bidoffer radius-zero"<?php }else{?> class="blue_btn bidoffer offer_disabled"<?php }?>><?php echo OFFER;?></a>
                                        
                                        
                                       <div class="clear10"></div>
                                   </div> 
                                   
                                  <div class="col-lg-1 bor_left" style="min-height:350px;">
                                  
                                  </div> 
                                   
                                <div class="col-lg-3">
                                     <div class="active_ribbon"><?php echo $statusarr[$status];?></div>
                                     
                                     <div class="clear10"></div>
                                     
                                     <div class="description font2"><?php echo $usertypearr[$userdetails['MasterUser']['user_type_id']];?></div>
                                        <div class="description"><?php if($diff->m){?><?php echo MEMBERFOR;?> <?php 
									  if($diff->y){
										  $mon=$diff->y*12 + $diff->m;
										  }else{
											   $mon=$diff->m;
											  }
									  echo $mon;?> <?php echo MONTHAND;?><?php } ?> <?php if($diff->d){?><?php echo $diff->d;?> <?php echo DAYS;?><?php }?>
                                         
                                        
                                        </div>
                                        
                                        <div class="hr-white"></div>
                                        
                                        <div class="description font2 grn_txt">
                                        <?php
									
									 echo $userdetails['MasterUser']['first_name'].' '.$userdetails['MasterUser']['last_name'];?>
                                        
                                        </div>
                                        <div class="description"><img src="<?php echo $base_url;?>images/location.png" />  <?php 
													echo $usercounty .' '.$usercity;
													?></div>
                                         <div class="clear10"></div>
                                        <div style="width:80%;margin:0;" class="savebtn phone">
            <img style="float:left;" src="<?php echo $base_url;?>images/phone_wh.png">
           <?php echo PHONE;?>: <?php echo VIEW;?>
                     </div>
                             
                             <div style="position: relative;width: 100%;margin:13px 10px 5px 0px;border-radius: 5px;" class="numdetails">
        	<h2> <?php echo WHISK;?>: <?php echo $userdetails['MasterUser']['telephone1'];?>            </h2>
            <p><?php echo NOTICESDATAA;?></p>
          </div>        
                                
                                <div class="clear10"></div> 
                                <span class="user_ribbon "> &nbsp; <?php echo $this->Custom->userAllPositivePercent($userdetails['MasterUser']['user_id']);?>% <?php echo CERTIFICATEPOSITIVE;?> </span>
                                 <div class="clear10"></div>
                                 Rating : 
                                 <?php $avgrating=$this->Custom->userRatingcount($userdetails['MasterUser']['user_id']);
								  if(!empty($avgrating))
									{
										for($singavgrating=1; $singavgrating<=round($avgrating); $singavgrating++)
										{
											if($singavgrating>$avgrating)
											{
												?>
												<img border="0" src="<?php echo $base_url;?>/images/star-small-halfactive.png" alt="rating" />
												<?php
											}
											else
											{
											?>
											<img border="0" src="<?php echo $base_url;?>/images/star-small-active.png" alt="rating" />
											<?php
											}
										}
									}
									if(round($avgrating)<5)
									{
										for($singavg=5; round($avgrating)<$singavg; $singavg--)
										{
											?>
											<img border="0" src="<?php echo $base_url;?>/images/star-small-inactive.png">   
											<?php
										}
									}
								 ?>
                                </div>   
                                   
                                    <div class="clear10"></div> 
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   <div class="clear10"></div>   
                                </div>
                                
                               <div class="clear"></div> 
                               
                                <div class="cerere_left">
                                  
                                  
                                  <div class="cerere_status_wrapper bg_grey">
                                  <div class="clear5"></div>
                                    
                                  <h2 class="detailstitle1"> &nbsp;&nbsp;<?php echo DATAABTREQST;?></h2>
                                  <div class="clear1"></div>
                                   <div class="car_data">
                                <div class="item">
                                    <div class="label">
                                    <?php echo BRAND;?>
                                  </div>
                                    <div class="content">
                                    <?php echo $brandname;?>
                                  </div>
                                 </div>
                                <div class="item">
                                    <div class="label">
                                    <?php echo MODEL;?>
                                  </div>
                                    <div class="content">
                                    <?php echo $modelname;?>
                                  </div>
                                 </div>
                                <div class="item">
                                    <div class="label">
                                    <?php echo VERSION;?>
                                  </div>
                                    <div class="content">
                                    <?php echo $version;?>
                                  </div>
                                 </div>
                                <div class="item">
                                    <div class="label">
                                    Year
                                  </div>
                                    <div class="content">
                                     <?php echo $year_of_mfg;?>
                                  </div>
                                 </div>
                                <div class="item">
                                    <div class="label">
                                    <?php echo ENGINES;?>
                                  </div>
                                    <div class="content">
                                    <?php echo $engines;?>    
                                  </div>
                                 </div>
                                 <?php if($vehicle_id_no!=''){?>
                                 <div class="item">
                                    <div class="label">
                                    <?php echo VEHICLEIDNO;?>
                                  </div>
                                    <div class="content">
                                    <?php echo $vehicle_id_no;?>    
                                  </div>
                                 </div>
                                 <?php } ?>
                             </div>
                               </div>
                                  
                                  
                                </div>
                                
                                
                                <div class="cerere_right">
                                
                                <div class="clear15"></div>
                                 <div class="clear5"></div>
                                 <?php 
            
            $ad_details=$this->Custom->rightsideAd();
			if(count($ad_details) >0 && !empty($ad_details)){
            $ad_details=$ad_details['Advertisement'];
            if($ad_details['ad_type']==1){ // for banner type
                    ?>
                     <a href="<?php echo $ad_details['banner_link'];?>" target="_blank">
            <img src="<?php echo $this->webroot.'files/advertisement/'.$ad_details['banner_image'];?>" alt="<?php echo $ad_details['banner_title'];?>" style="width:100%;height: 240px;">
            </a>
                    <?php
                }elseif($ad_details['ad_type']==2){ // for script type
                    
                    echo stripslashes($ad_details['ad_script']);
                }
			}
            
            ?>
                                </div>
								
                            </div>
                            <div class="clearfix" style="height:1px;"></div>
                            
                           <div class="row">
                               
                                <div class="clear15"></div> 
                                <!--offerform-->
                                
                                <div class="message_text bg_grey post_offer_message" id="showoffer" <?php if(!isset($this->request->data['bidoffer'])){?> style="display:none"<?php }?>>
                                <?php echo $this->Form->create('BidOffer',array('type' => 'file')); ?>
                                            <div class="sub_message_text_wrapper">
                                              <div class="msg_date">
                                                <font>
                                                <font>
                                                <?php echo date('F d, Y, H:i');?>
                                                </font>
                                                </font>
                                              </div>
                                              
                                <div class="description_head">Bid</div>              
                                              
                                              <div id="msg_offer_groups0">
					<div class="msg_price_group">
	<div class="msg_group_desc">
		<div class="msg_group_label"><?php echo PLAY;?> <span class="msg_group_info">(<?php echo DACIALOGANFRONT;?>)</span></div>
         <?php echo $this->Form->input('piece', array('label' => false, 'div' => false, 'class' => 'msg_input_price'));?>
	</div>
	<div class="msg_group_price">
		<div class="msg_group_label"><?php echo PRICEWITHVAT;?></div>
        <?php echo $this->Form->input('price', array('label' => false, 'div' => false, 'class' => 'msg_input_price'));?>
	</div>
	<div class="msg_group_currency">
		<div class="msg_group_label"><?php echo CURRENCY;?></div>
                         <?php
		echo $this->Form->input('currency', array('label' => false,'type' => 'select','options' => array('' => 'Select','RON' => 'RON','EUR' => 'EUR','USD' => 'USD'), 'div' => false, 'class' => 'msg_input_price'));
		?>
	</div>
	<div class="msg_group_um">
		<div class="msg_group_label">U.M.</div>
                        <?php
		echo $this->Form->input('um', array('label' => false,'type' => 'select','options' => array('' => 'Select','buc' => 'buc','set' => 'set'), 'div' => false, 'class' => 'msg_input_price'));
		?>
	</div>
	<div class="msg_group_comment">
		<div class="msg_group_label"><?php echo OBSERVATIONON;?> <span class="msg_group_info">(<?php echo THEYSEEONLY;?>)</span></div>
         <?php echo $this->Form->input('comment', array('label' => false, 'type' => 'text', 'placeholder' => 'ex: Cod piesă / Furnizor / Raft', 'div' => false));?>
	</div>
	<div class="clearing"></div>
</div>

<!--<div class="msg_price_group">
	<div class="msg_group_desc">
		<div class="msg_group_label">Piesa <span class="msg_group_info">(ex: Bară faţă Dacia Logan roşie fără zgârieturi)</span></div>
		<input type="text" onkeyup="test_filled_groups($(this));" class="msg_input_price" value="" name="msg_group[2][desc]">
	</div>
	<div class="msg_group_price">
		<div class="msg_group_label">Preţ cu TVA</div>
		<input type="text" onkeyup="test_filled_groups($(this));" class="msg_input_price" value="" name="msg_group[2][price]">
	</div>
	<div class="msg_group_currency">
		<div class="msg_group_label">Moneda</div>
		<select onchange="test_filled_groups($(this));" class="msg_input_price" name="msg_group[2][currency]">
			<option value="">-------</option>
							<option value="41">RON</option>
								<option value="14">EUR</option>
								<option value="1">USD</option>
						</select>
	</div>
	<div class="msg_group_um">
		<div class="msg_group_label">U.M.</div>
		<select onchange="test_filled_groups($(this));" class="msg_input_price" name="msg_group[2][um]">
			<option value="">-------</option>
							<option value="1">buc</option>
								<option value="2">set</option>
						</select>
	</div>
	<div class="msg_group_comment">
		<div class="msg_group_label">Observaţii private <span class="msg_group_info">(le vezi doar tu)</span></div>
		<input type="text" placeholder="ex: Cod piesă / Furnizor / Raft" title="Poţi nota de exemplu codul piesei pentru care faci oferta. Doar tu vei vedea aceste notiţe şi îţi vom aminti de ele dacă oferta este câştigătoare." onkeyup="test_filled_groups($(this));" class="" value="" name="msg_group[2][comment]">
	</div>
	<div class="clearing"></div>
</div>-->

				</div>
                                              
                                              
                                              
                <div style="padding:12px 0 8px 0;">
					<div class="clearing"></div>
					<div class="description_head h_width"><?php echo OFFER;?>:</div>
                    <input type="hidden" name="data[BidOffer][offers]" id="BidOfferOffers_" value="0">
                    <?php if(isset($this->request->data['BidOffer']['offers'])){$offers=$this->request->data['BidOffer']['offers'];}else{$offers='';}?>
					<label class="offer_sp_label"><input type="radio" name="data[BidOffer][offers]" id="BidOfferOffers" value="New"<?php if($offers=='New'){?> checked="checked"<?php }?> > &nbsp; <?php echo NEWPARTSS;?></label>
					<label class="offer_sp_label" style="width:150px;"><input type="radio" name="data[BidOffer][offers]" id="BidOfferOffers" value="Used"<?php if($offers=='Used'){?> checked="checked" <?php }?>> &nbsp; <?php echo USEDPARTS;?></label>
					<div class="clearing"></div>
				</div>  
                                              
                 <div style="padding:12px 0 8px 0;">
					<div class="clearing"></div>
					<div class="description_head h_width"><?php echo AVAILABELITY;?> :</div>
                    <?php if(isset($this->request->data['BidOffer']['availbility'])){$availbility=$this->request->data['BidOffer']['availbility'];}else{$availbility='';}?>
                    <input type="hidden" name="data[BidOffer][availbility]" id="BidOfferAvailbility_" value="0">
					<label class="offer_sp_label"><input type="radio" name="data[BidOffer][availbility]" id="BidOfferAvailbility" value="1"<?php if($availbility==1){?> checked="checked" <?php }?> > &nbsp; <?php echo INSTOCK;?></label>
					<label class="offer_sp_label" style="width:150px;"><input type="radio" name="data[BidOffer][availbility]" id="BidOfferAvailbility"<?php if($availbility==2){?> checked="checked" <?php }?> value="2"> &nbsp; <?php echo CUSTOMMADE;?></label>
					<div class="clearing"></div>
				</div>                              
                
                <div class="clearing"></div>
                <div class="description_head"><?php echo DELICERYYY;?></div>
                
                <div class="msg_price_group ch_delivery">
                <?php if(isset($this->request->data['BidOffer']['personal_teaching'])){$personal_teaching=$this->request->data['BidOffer']['personal_teaching'];}else{$personal_teaching='';}?>
                <input type="hidden" name="data[BidOffer][personal_teaching]" id="BidOfferPersonalTeaching_" value="0">
                    <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][personal_teaching]" id="BidOfferPersonalTteaching" value="1"<?php if($personal_teaching==1){?> checked="checked" <?php }?> > <span>&nbsp;<?php echo PERSONALTEACHING;?></span></label>
					<div class="clear10"></div>
                     <?php if(isset($this->request->data['BidOffer']['courier'])){$courier=$this->request->data['BidOffer']['courier'];}else{$courier='';}?>
                    <input type="hidden" name="data[BidOffer][courier]" id="BidOfferCourier_" value="0">
                    <label class="offer_sp_label"><input type="checkbox"  name="data[BidOffer][courier]" id="BidOfferCourier"  value="1"<?php if($courier==1){?> checked="checked" <?php }?>> <span>&nbsp;<?php echo COURIER;?></span></label>
                     <?php if(isset($this->request->data['BidOffer']['courier_cost'])){$courier_cost=$this->request->data['BidOffer']['courier_cost'];}else{$courier_cost='';}?>
                     <label class="offer_sp_label"> <?php echo DELIVERYCOST;?> <input type="text" value="<?php echo $courier_cost;?>" name="data[BidOffer][courier_cost]" id="BidOfferCourierCost">  <span>&nbsp;RON</span></label>
                     <?php if(isset($this->request->data['BidOffer']['free_courier'])){$free_courier=$this->request->data['BidOffer']['free_courier'];}else{$free_courier='';}?>
                     <input type="hidden" name="data[BidOffer][free_courier]" id="BidOfferRreeCourier_" value="0">
                     <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][free_courier]" id="BidOfferFreeCourier" value="1"<?php if($free_courier==1){?> checked="checked" <?php }?> > <span>&nbsp;<?php echo FREEDELIVERYCOURIER;?></span></label>
					<div class="clear10"></div>
                    <?php if(isset($this->request->data['BidOffer']['roman_mail'])){$roman_mail=$this->request->data['BidOffer']['roman_mail'];}else{$roman_mail='';}?>
                    <input type="hidden" name="data[BidOffer][roman_mail]" id="BidOfferRomanMail_" value="0">
                     <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][roman_mail]" id="BidOfferRomanMail" value="1"<?php if($roman_mail==1){?> checked="checked" <?php }?>> <span>&nbsp;<?php echo ROMANIANMAIL;?></span></label>
                       <?php if(isset($this->request->data['BidOffer']['roman_mail_cost'])){$roman_mail_cost=$this->request->data['BidOffer']['roman_mail_cost'];}else{$roman_mail_cost='';}?>
                     <label class="offer_sp_label"> <?php echo DELIVERYCOST;?> <input type="text" value="<?php echo $roman_mail_cost;?>" name="data[BidOffer][roman_mail_cost]" id="BidOfferRomanMailCost" >  <span>&nbsp;RON</span></label>
                       <?php if(isset($this->request->data['BidOffer']['free_roman_mail'])){$free_roman_mail=$this->request->data['BidOffer']['free_roman_mail'];}else{$free_roman_mail='';}?>
                     <input type="hidden" name="data[BidOffer][free_roman_mail]" id="BidOfferFreeRomanMail_" value="0">
                     <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][free_roman_mail]" id="BidOfferFreeRomanMail" value="1" <?php if($free_roman_mail==1){?> checked="checked" <?php }?>> <span>&nbsp;<?php echo FREEDELIVERYROMAILMAIL;?></span></label>
					<div class="clear10"></div>
                    
                     <label class="offer_sp_label"><span>&nbsp;<?php echo TIMEREQUIREDPROCESS;?></span></label>
                     <label class="offer_sp_label"> 
                      <?php
		echo $this->Form->input('time_required', array('label' => false,'type' => 'select','options' => array('' => 'Select', '1' => '1 Day','2'=>'2 Days','3'=>'3 Days', '4' => '4 Days', '5' => '5 Days', '10' => '10 Days', '15' => '15 Days', '30' => '30 Days'), 'div' => false, 'class' => 'msg_input_price','style' => 'width:50%'));
		?>
                     </label>
                 
					<div class="clear10"></div>
                    
                    <label class="offer_sp_label"><span>&nbsp; <?php echo TERMOFDELIVER;?></span></label>
                    <?php echo $this->Form->input('terms_of_delivery', array('label' => false, 'type' => 'textarea','cols' => false, 'rows' => false, 'div' => false, 'class' => 'form-control','style' =>'width:100%'));?>
                 
					<div class="clear10"></div>
                </div>
                
                
                 <div class="clear15"></div>
                <div class="description_head"><?php echo PAYMENTMETHODS;?></div>
                
                <div class="msg_price_group ch_delivery">
                 <?php if(isset($this->request->data['BidOffer']['payment_method'])){$payment_method=$this->request->data['BidOffer']['payment_method'];}else{$payment_method=array();}?>
                <input type="hidden" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod_" value="0">
                      <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod1"<?php if(is_array($payment_method) && in_array('Cash on delivery',$payment_method)){?> checked="checked"<?php }?> value="Cash on delivery">
                       <span>&nbsp;<?php echo CASHONDELICERY;?></span></label>
                      <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod2"<?php if(is_array($payment_method) && in_array('Upon delivery',$payment_method)){?> checked="checked"<?php }?>  value="Upon delivery'">
                       <span>&nbsp;<?php echo UPONDELIVERY;?></span></label>
                      <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod3"<?php if(is_array($payment_method) && in_array('Wire Transfer',$payment_method)){?> checked="checked"<?php }?>  value="Wire Transfer"> <span>&nbsp;<?php echo WIRETRANSFER;?></span></label>
                      <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod4"<?php if(is_array($payment_method) && in_array('Banking Card',$payment_method)){?> checked="checked"<?php }?>  value="Banking Card"> <span>&nbsp;<?php echo BANKCARD;?></span></label>
                      <label class="offer_sp_label"><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod5"<?php if(is_array($payment_method) && in_array('Others',$payment_method)){?> checked="checked"<?php }?>  value="Others"> <span>&nbsp;<?php echo OTHER;?></span></label>
                </div>
                <?php if($this->Session->check('User')){?>
                 <div class="clear15"></div>
                <div class="description_head"><?php echo PHOTOOFSONG;?></div>
                <iframe src="<?php echo $base_url;?>RequestParts/bidupload/<?php echo $part_id;?>" style="width: 100%; height:22px; border: none; overflow: hidden;"></iframe>
                 <div id="loading" style="display:none;"></div>
                 <div id="bidgallery" style="display:none;"></div>
                 <?php }?>
                <div class="clear10"></div>
                <div style="text-align:center;">
                <input type="hidden" name="data[BidOffer][parts_id]" value="<?php echo $part_id;?>" />
                <input type="hidden" name="data[BidOffer][request_id]" value="<?php echo $request_id;?>" />
                <button type="submit" name="bidoffer" class="gbutton6 gbuttonnew" rel="nofollow" title="Modify"><?php echo ADDOFFER;?></button>
                
                </div>
                </div>
                                            
											
											<div class="clear" style="height:5px;"></div>
											
											
											
							  
                              
                              <?php 
							  if(isset($bidopenlogin) && $bidopenlogin=='yes'){?>
                              
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
												  <input type="submit" name="bidoffer" class="btn btn-success" value="Login">
												  
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
                              <?php }?>
							 
                                            
                                            
											<div class="clear" style="height:25px;"></div>
											 </form>
                                          </div>
                                  
                               <!--offerformend-->        
                              
							<!--question form start-->
                            
                 <div class="message_text bg_grey post_offer_message col-lg-12" id="showquestion" <?php if(!isset($this->request->data['question'])){?> style="display:none"<?php }?>><div class="datascl">
            <div class="row">
            <div class="col-lg-12">
            
            <h2><?php echo QUESTIONABTREQUESTPARTS;?></h2>
            <br>
            <div class="product_section product_shipping">
              <p>
                <?php echo QUESTIOONONTHISNOTICE;?>
              </p>
            </div>
            
            <div class="clearfix"></div>
            
            <h5><?php echo ADDRESSELLERQUESTION;?></h5>
            
            <div class="highlight">
                <div class="col-lg-7">
                    <div class="row">
                    
                        <?php echo $this->Form->create('RequestQuestion'); ?>
                       
                           <?php
						echo $this->Form->input('description', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));
						echo $this->Form->input('request_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$request_id));
						echo $this->Form->input('parts_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$part_id));
						?>
                          <div class="clear" style="height:20px"></div>
                          <div class="captch">
                              <img src="<?php echo $base_url;?>captcha/captcha_code_file.php?rand=<?php echo rand();?>" id="captchaimg">
                              
                          <input type="text" class="required form-control" id="code" name="code">
                          </div>
                          <div class="clear10"></div>
                          <button type="submit" name="question" class="btn gbutton6"><?php echo ASKQUESTIONSS;?></button>
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
											  <input type="submit" name="question" class="btn btn-success" value="Login">
											  
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
                        </form>
                        
                    </div>
                </div>
                
                <div class="col-lg-1"></div>
                
                <div class="col-lg-4">
                    <div class="msg_label red_label">
                        <span class="warning_sign"></span>
                        <b><font><font><?php echo PROHIBITED;?></font></font></b>
                        <font><font> <?php echo PERSONALINFODATA;?></font></font>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
             </div>
        </div></div></div>
        					<!--question form end-->
                           
                           </div>
                            
                         </div><?php */?>
						 
						 
                         
                         
                        <div class="clear"></div>
                        
					</div>
				<!-- Left Sidebar End -->
				
				
				<div class="clearfix" style="height:1px;"></div>
                
                
                 
                
                          
			   
			</div>
		</div>
		<div class="clearfix"></div>
    </div>
<?php
echo $this->element('footer-home');
?>