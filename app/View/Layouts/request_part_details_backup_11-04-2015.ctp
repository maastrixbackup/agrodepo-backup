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
$status=stripslashes($AccessoryRes['RequestAccessory']['status']);
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
$wantsong=stripslashes($RequestRes['RequestPart']['want_song']);
//pr($this->request->data);
?>
<script type="text/javascript">
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
                                                <?php if(!empty($memberdetails)){ ?><p class="pt_number"><?php echo $memberdetails['UserMembership']['memb_type']." Member";?></p><?php }?>
                                                <p class="deals_number"><?php echo OFFERSRECIVEDD;?><br> <strong><?php $request_count=$this->Custom->count_bid_type($part_id);?>
                                    <?php if(count($request_count)){echo array_sum($request_count);}else{ echo 0;}?></strong></p>
                                           
                                      
                                   </div>
                                   
                                   <div class="col-lg-6" style="padding-left:40px;">
                                        <h1 class="h1b"><?php echo stripslashes($AccessoryRes['RequestAccessory']['name_piece']);?></h1>
                                       <div class="description font2"><?php echo $descriptions;?></div>
                                        
                                        <div class="clear10"></div>
                                       <?php if(!empty($wantsong)){?>  <div class="description_head redtxt">Doriti Piesa: <?php if($wantsong=="new"){echo "Noua";}else if($wantsong=="used"){echo "din dezmembrari";}else if($wantsong=="both"){echo "Noua sau din dezmembrari";}?></div><?php }?>
                                        <div class="description"><?php echo APPLICATIONDATE;?>: <?php echo $partsdate;?></div>
                                        
                                        <div class="clear15"></div>
                                        <!--<div class="description font2">Throttle with geared motor step by step</div>-->
                                        <?php /*?><div class="description"><?php echo $descriptions;?></div><?php */?>
                                        <div class="clear15"></div>
                                        <div class="clear40"></div>
                                        
                                        <div class="col-lg-8 pull-right">
                                            <a href="javascript:void(0);" <?php if(($userid != $usr_id) && ($AccessoryRes['RequestAccessory']['status']!=2)){ ?> class="org_btn radius-zero addquestion default_btn34" onClick="addQuestion(1);"<?php }else { ?> class="org_btn radius-zero addquestion offer_disabled default_btn34"<?php }?> >
                            <?php echo REQSTDETAIIL;?>
                            </a> &nbsp; &nbsp;
                                            <a href="javascript:void(0);" <?php if(($userid != $usr_id) && ($AccessoryRes['RequestAccessory']['status']!=2)){?>onClick="bidOffer(1);" class="blue_btn bidoffer radius-zero default_btn34"<?php }else{?> class="blue_btn radius-zero bidoffer offer_disabled default_btn34"<?php }?>><?php echo OFFER;?></a>
										</div>                                        
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
													echo $countyname .' '.$cityname;
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
                                
                                <?php /*?><div class="message_text bg_grey post_offer_message" id="showoffer" <?php if(!isset($this->request->data['bidoffer'])){?> style="display:none"<?php }?>>
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
                                          </div><?php */?>
                                          <div class="col-lg-12" id="showoffer" <?php if(!isset($this->request->data['bidoffer'])){?> style="display:none"<?php }?>>
						 	<div class="row">
                                <?php echo $this->Form->create('BidOffer',array('type' => 'file', 'class' => 'form-inline step3_format bidoffer_border')); ?>
                                    <table class="table table-bordered no-border rqst_parts">
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                	<div style="width:100%;">
                                                    	<table cellpadding="0" cellspacing="0" style="width:100%;">
                                                        	<tr>
                                                            	<td><label>Denumire piesa: </label></th>
                                                                <td colspan="4">
                                                                   
                                                                    <?php echo $this->Form->input('piece', array('label' => false, 'div' => false, 'class' => 'form-control', 'style' => 'width:450px;'));?>
                                                                </td>
                                                                <td colspan="2" style="text-align: right;">
                                                                    <label>&nbsp;&nbsp; Doriti paise: </label>
                                                                    
                                                                     <?php
									echo $this->Form->input('offers', array('label' => false, 'type' => 'select','options' => array('' => '[ Select ]', 'new' => 'Noua', 'used' => 'din dezmembrari'), 'div' => false, 'class' => 'form-control step3_droplis1', 'style' => 'width:62%!important;'));?>
                                                                    
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td width="13%"><label>Pret: </label></td>
                                          <td width="31%">
                               	  <table>
                                                    	<tr>
                                                        	<td>
                                                                
                                                                <?php echo $this->Form->input('price', array('label' => false, 'div' => false, 'class' => 'form-control', 'style' => 'width:45%; float:left;'));?>
                                                                
                                                                <?php
		echo $this->Form->input('currency', array('label' => false,'type' => 'select','options' => array('' => 'Select','RON' => 'RON','EUR' => 'EUR','USD' => 'USD'), 'div' => false, 'class' => 'form-control  step3_droplis1', 'style' => 'width:45%!important; float:right;'));
		?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                              <td width="48%"><label>&nbsp; </label></td>
                                              <td width="8%">&nbsp;</td>
                                          </tr>
                                            
                                            <tr>
                                                <td><label class="size_14"><i>Adauga Fotogrifi</i></label></td>
                                                <td style="  width: 500px;  display: inline-block;">
                                                	<table>
                                                    	<tr>
                                                        	<td style="width:100%!important">
                                                                	<div class="listphoto">
                                                                        <ul>
                                                                        <li>
                                                                            <iframe src="<?php echo $base_url;?>RequestParts/bidupload/<?php echo $part_id;?>/seqno:1" style="border: none; overflow: hidden;"></iframe>
                                                                            </li>
                                                                            <li>
                                                                                <iframe src="<?php echo $base_url;?>RequestParts/bidupload/<?php echo $part_id;?>/seqno:2" style="border: none; overflow: hidden;"></iframe>
                                                                            </li>
                                                                            <li>
                                                                                <iframe src="<?php echo $base_url;?>RequestParts/bidupload/<?php echo $part_id;?>/seqno:3" style="border: none; overflow: hidden;"></iframe>
                                                                            </li>
                                                                            <li>
                                                                                <iframe src="<?php echo $base_url;?>RequestParts/bidupload/<?php echo $part_id;?>/seqno:4" style="border: none; overflow: hidden;"></iframe>
                                                                            </li>
                                                                            <li>
                                                                                <iframe src="<?php echo $base_url;?>RequestParts/bidupload/<?php echo $part_id;?>/seqno:5" style="border: none; overflow: hidden;"></iframe>
                                                                            </li>
                                                                        </ul>
                                                                         
                                                                    </div>
                              								  <div id="loading" style="display:none;"></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;</td>
                                                <td>&nbsp;&nbsp;&nbsp;</td>
                                            </tr>
                                            
                                            <tr>
                                            	<td colspan="4">
                                                	<table>
                                                    	<tr>
                                                        	<td>
                                                                     <?php
		echo $this->Form->input('warranty', array('label' => false,'type' => 'select','options' => array('' => 'Selectați Garanție','Ofer warranty' => 'Ofer garanţie','We do not offer warranty' => 'Nu ofer garanţie'), 'div' => false, 'class' => 'form-control  step3_droplis1', 'style' => 'width: 230px!important;margin-right: 32px;'));?>
                                                            </td>
                                                             <td colspan="4">&nbsp;</td>
                                                            <td colspan="2" style="text-align: right;">
                                                                <label><font><font>Valabilitate: </font></font></label>
                                                                <?php echo $this->Form->input('validity', array('label' => false, 'div' => false, 'class' => 'form-control', 'style' => 'width:212px;'));?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                            	<td colspan="4">
                                                	<div class="col-lg-8">
                                                    	<div class="row">
                                                        	<table>
                                                            	<tr>
                                                                	<td style="min-width:138px;">&nbsp;&nbsp;</td>
                                                                	<td style="padding-right:35px;">
                                                                     <?php if(isset($this->request->data['BidOffer']['courier'])){$courier=$this->request->data['BidOffer']['courier'];}else{$courier='';}?>
                    <input type="hidden" name="data[BidOffer][courier]" id="BidOfferCourier_" value="0">
                    <label><input type="checkbox"  name="data[BidOffer][courier]" id="BidOfferCourier"  value="1"<?php if($courier==1){?> checked="checked" <?php }?>> Curier</label>
                                                                    </td>
                                                                    <td><label style="width:120px">Denumire piesa: </label>
                                                                    </td><td colspan="4">
                                                                     <?php if(isset($this->request->data['BidOffer']['courier_cost'])){$courier_cost=$this->request->data['BidOffer']['courier_cost'];}else{$courier_cost='';}?>
                                                                      
                                                                        <input type="text" value="<?php echo $courier_cost;?>" name="data[BidOffer][courier_cost]" id="BidOfferCourierCost" class="form-control">
                                                                    </td>
                                                                    <td style="padding-left:2em; padding-top:6px;">
                                                                    	<div class="checkbox">
                                                                        <?php if(isset($this->request->data['BidOffer']['free_courier'])){$free_courier=$this->request->data['BidOffer']['free_courier'];}else{$free_courier='';}?>
                     <input type="hidden" name="data[BidOffer][free_courier]" id="BidOfferRreeCourier_" value="0">
                     <label><input type="checkbox" name="data[BidOffer][free_courier]" id="BidOfferFreeCourier" value="1"<?php if($free_courier==1){?> checked="checked" <?php }?> > Livrte Gratuita</label>
                                                                            
                                                                        </div>
                                                                    </td>
                                                            	</tr>
                                                            </table>
                                                        </div>
                                                        
                                                        <br>
                                                        
                                                        <div class="row">
                                                        	<table>
                                                            	<tr>
                                                                	<td style="min-width:138px;"><label style="font-size:23px!important;">Livrare</label></td>
                                                                	<td style="padding-right:35px;">
                                                                    	<div class="checkbox">
                                                                            <?php if(isset($this->request->data['BidOffer']['personal_teaching'])){$personal_teaching=$this->request->data['BidOffer']['personal_teaching'];}else{$personal_teaching='';}?>
                <input type="hidden" name="data[BidOffer][personal_teaching]" id="BidOfferPersonalTeaching_" value="0">
                                                                            <label><input type="checkbox" name="data[BidOffer][personal_teaching]" id="BidOfferPersonalTteaching" value="1"<?php if($personal_teaching==1){?> checked="checked" <?php }?> > Predare personala</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><label>&nbsp;</label></td>
                                                                    <td colspan="4">
                                                                        <label>&nbsp;</label>
                                                                    </td>
                                                                    <td style="padding-left:2em; padding-top:6px;"><label>&nbsp;</label></td>
                                                            	</tr>
                                                            </table>
                                                        </div>
                                                        
                                                        <br>
                                                        
                                                        <div class="row">
                                                        	<table>
                                                            	<tr>
                                                                	<td style="min-width:138px;">&nbsp;&nbsp;</td>
                                                                	<td>
                                                                     <?php if(isset($this->request->data['BidOffer']['roman_mail'])){$roman_mail=$this->request->data['BidOffer']['roman_mail'];}else{$roman_mail='';}?>
                    <input type="hidden" name="data[BidOffer][roman_mail]" id="BidOfferRomanMail_" value="0">
                     <label style="margin-right:20px;"><input type="checkbox" name="data[BidOffer][roman_mail]" id="BidOfferRomanMail" value="1"<?php if($roman_mail==1){?> checked="checked" <?php }?>> Posta Romana</label>
                                                                  </td>
                                                                    <td><label style="width:80px">Cost Livera: </label>
                                                                    </td><td colspan="4">
                                                                       
                                                                         <?php if(isset($this->request->data['BidOffer']['roman_mail_cost'])){$roman_mail_cost=$this->request->data['BidOffer']['roman_mail_cost'];}else{$roman_mail_cost='';}?>
                     <input type="text" value="<?php echo $roman_mail_cost;?>" name="data[BidOffer][roman_mail_cost]" id="BidOfferRomanMailCost" class="form-control" style="width:200px;" />
                                                                    </td>
                                                                    <td style="padding-left:2em; padding-top:6px;">
                                                                    	<div class="checkbox">
                                                                        <?php if(isset($this->request->data['BidOffer']['free_roman_mail'])){$free_roman_mail=$this->request->data['BidOffer']['free_roman_mail'];}else{$free_roman_mail='';}?>
                     <input type="hidden" name="data[BidOffer][free_roman_mail]" id="BidOfferFreeRomanMail_" value="0">
                     <label><input type="checkbox" name="data[BidOffer][free_roman_mail]" id="BidOfferFreeRomanMail" value="1" <?php if($free_roman_mail==1){?> checked="checked" <?php }?>> Livrte Gratuita</label>
                                                                            
                                                                        </div>
                                                                    </td>
                                                            	</tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4">
                                                    	<div class="row">
                                                        	<div class="rightofr_list">
                                                            	<table>
                                                                	<tr>
                                                                        <td><label style="font-size:23px!important; padding-top:60px;">Plata</label>
                                                                         <?php if(isset($this->request->data['BidOffer']['payment_method'])){$payment_method=$this->request->data['BidOffer']['payment_method'];}else{$payment_method=array();}?>
                                                                        </td>
                                                                        <td>
                                                                            <table class="payment_click3">
                                                                                <tbody><tr>
                                                                                    <td>
                                                                                        <div class="checkbox">
                                                                                         <input type="hidden" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod_" value="0">
                                                                                          <label><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod1"<?php if(is_array($payment_method) && in_array('Cash on delivery',$payment_method)){?> checked="checked"<?php }?> value="Cash on delivery">
                                                                                          <?php echo CASHONDELICERY;?></label>
                                                                                           
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="checkbox">
                                                                                            
                                                                                            <label><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod2"<?php if(is_array($payment_method) && in_array('Upon delivery',$payment_method)){?> checked="checked"<?php }?>  value="Upon delivery'">
                       <?php echo UPONDELIVERY;?></label>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="checkbox">
                                                                                           
                                                                                            <label><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod3"<?php if(is_array($payment_method) && in_array('Wire Transfer',$payment_method)){?> checked="checked"<?php }?>  value="Wire Transfer"> <?php echo WIRETRANSFER;?></label>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="checkbox">
                                                                                            <label><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod4"<?php if(is_array($payment_method) && in_array('Banking Card',$payment_method)){?> checked="checked"<?php }?>  value="Banking Card"> <?php echo BANKCARD;?></label>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                 <tr>
                                                                                    <td>
                                                                                        <div class="checkbox">
                                                                                            <label><input type="checkbox" name="data[BidOffer][payment_method][]" id="BidOfferPaymentMethod5"<?php if(is_array($payment_method) && in_array('Others',$payment_method)){?> checked="checked"<?php }?>  value="Others"> <?php echo OTHER;?></label>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                        
                                                                        
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            
                                        </tbody>
                                    </table>
                                    
                                    <table style="width:100%">
                                    	<tr>
                                        	<td colspan="4" style="border:none;">
                                            <input type="hidden" name="data[BidOffer][parts_id]" value="<?php echo $part_id;?>" />
                <input type="hidden" name="data[BidOffer][request_id]" value="<?php echo $request_id;?>" />
                                            	<input type="submit" name="bidoffer" value="Plaseaza Oferta &raquo;" class="blue_btn ofr_RQST" style="float:right;">
                                        	</td>
                                        </tr>
                                    </table>
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
                              
							
                                </form>
                                
                                <!--  Step 3 Form start  -->
                                
                                <!--form 1-->
							</div>
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