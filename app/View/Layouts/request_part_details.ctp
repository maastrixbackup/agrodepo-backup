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
$requestUserid=$RequestRes['RequestPart']['user_id'];
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
$usertypearr=array(1=> BUYERRRR, 2=> SELLERRR);
$usercounty=$this->Custom->region_nm($userdetails['MasterUser']['country_id']);
$usercity=$this->Custom->region_nm($userdetails['MasterUser']['locality_id']);
$c_date=date_create($userdetails['MasterUser']['created']);
$now=date_create(date('Y-m-d h:i:s'));
$diff=date_diff($c_date,$now);
$memberdetails=$this->Custom->BapCustUniMembership($userdetails['MasterUser']['user_id']);
$singpartsimg=$this->Custom->RequestSingimg($part_id);
$wantsong=stripslashes($RequestRes['RequestPart']['want_song']);
//pr($this->request->data);
if($this->Session->check('User'))
{
$sessionUser=$this->Session->read('User');
$sessionuserID=$sessionUser['user_id'];
}
else
{
	$sessionuserID='';
}
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
	$("#bidid").val('');
	$("#bidUserID").val('');
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
function sendReply(showval, qid)
{
	if(showval==1)
	{
		$("#showoffer").hide();
		$("#showquestion").show();
		 $('html, body').animate({
        scrollTop: $("#showquestion").offset().top- 135
    }, 2000);
		$("#RequestQuestionParent").val(qid);
	}
	else
	{
		$("#showoffer").hide();
		$("#showquestion").hide();
	}
}

function bidAddQuestion(showval,bidid,bidUserID)
{
	if(showval==1)
	{
		$("#showoffer").hide();
		$("#bidid").val(bidid);
		$("#bidUserID").val(bidUserID);
		$("#showquestion").show();
		$("#clickQuestion"+bidid).attr("onClick","bidAddQuestion(0,"+bidid+");");
		$(".bidoffer").attr("onClick","bidOffer(1);");
		 $('html, body').animate({
        scrollTop: $("#showquestion").offset().top- 135
    }, 2000);
	}
	else
	{
		$("#showoffer").hide();
		$("#showquestion").hide();
		$("#bidid").val('');
		$("#bidUserID").val('');
		//$(".addquestion").attr("onClick","addQuestion(1);");
		$("#clickQuestion"+bidid).attr("onClick","bidAddQuestion(1,"+bidid+");");
		$(".bidoffer").attr("onClick","bidOffer(1);");
	}
}
function bidReply(showval,bidid,bidUserID,bidQid)
{
	if(showval==1)
	{
		$("#showoffer").hide();
		$("#bidid").val(bidid);
		$("#bidUserID").val(bidUserID);
		$("#showquestion").show();
		 $('html, body').animate({
        scrollTop: $("#showquestion").offset().top- 135
    }, 2000);
		$("#RequestQuestionParent").val(bidQid);
	}
	else
	{
		$("#showoffer").hide();
		$("#showquestion").hide();
		$("#bidid").val('');
		$("#bidUserID").val('');
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
function bidUserPhone(bidid)
{
	if($("#bidPhone"+bidid).hasClass( ".bidPhone"+bidid ))
	{
		$("#bidPhone"+bidid).removeClass(".bidPhone"+bidid);
		$("#bidPhone"+bidid).hide(500);
	}
	else
	{
		$("#bidPhone"+bidid).addClass(".bidPhone"+bidid);
		$("#bidPhone"+bidid).show(500);
	}
	
}
function bidWin(bid_id, parts_id, statusval)
{	
var url="<?php echo $base_url;?>RequestParts/change_bid_status";
$.post(url,{'bid_id':bid_id,'status':statusval,'parts_id':parts_id},function(res){
		if(res==1)
		{
			alert("You win this bid offer successfully");
			window.location=window['location']['href'];
		}
		else
		{
		alert('Winning failed. Please try again');
		}
	});
}
<?php 
//pr($this->request->params['named']);exit;
if(!empty($this->request->params['named']) && isset($this->request->params['named']['reply']) && $this->request->params['named']['reply']!=''){
	?>
	$(document).ready(function(e) {

			var qid="<?php echo $this->request->params['named']['replyid'];?>";
			$("#showoffer").hide();
				$("#showquestion").show();
				 $('html, body').animate({
				scrollTop: $("#showquestion").offset().top- 135
			}, 2000);
				$("#RequestQuestionParent").val(qid);
		});
	<?php
}
?>
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
													if (file_exists('files/requestpart/150X150_'.$singpartsimg['RequestImg']['img_path'])) {
													$singpartsimg_path = $base_url.'files/requestpart/150X150_'.$singpartsimg['RequestImg']['img_path'];
													}else{
													$singpartsimg_path = $base_url.'files/requestpart/'.$singpartsimg['RequestImg']['img_path'];
													}
												?>
                                                <img src="<?php echo $singpartsimg_path;?>" alt="dez" class="imagefull imgborder"/>
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
												if($memberdetails['UserMembership']['plan_img']!=''){
													if (file_exists('files/memberplanimg/74X105_'.$memberdetails['UserMembership']['plan_img'])) {
													$memberdetails_path = $base_url.'files/memberplanimg/74X105_'.$memberdetails['UserMembership']['plan_img'];
													}else{
													$memberdetails_path = $base_url.'files/memberplanimg/'.$memberdetails['UserMembership']['plan_img'];
													}
													?>
                                                <img src="<?php echo $memberdetails_path;?>" alt="dez" width="50%"/></div>
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
                                <span class="user_ribbon "> &nbsp; <?php $ratingPercent=$this->Custom->userAllPositivePercent($userdetails['MasterUser']['user_id']); if(is_float($ratingPercent)){echo number_format($ratingPercent, 2, '.', '');}else{echo $ratingPercent;}?><?php /*echo $this->Custom->userAllPositivePercent($userdetails['MasterUser']['user_id']);*/?>% <?php echo CERTIFICATEPOSITIVE;?> </span>
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
				if (file_exists('files/advertisement/327X240_'.$ad_details['banner_image'])) {
				$ad_details_path = $base_url.'files/advertisement/327X240_'.$ad_details['banner_image'];
				}else{
				$ad_details_path = $base_url.'files/advertisement/'.$ad_details['banner_image'];
				}
                    ?>
                     <a href="<?php echo $ad_details['banner_link'];?>" target="_blank">
            <img src="<?php echo $ad_details_path;?>" alt="<?php echo $ad_details['banner_title'];?>" style="width:100%;height: 240px;">
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
                
                                <!--  New Question Answer panel start on 14th May  -->
                                
                                <div class="message_item questionpan row">
                                <?php
                                if(!empty($requestQustionRes) && count($requestQustionRes)>0){
                                    foreach($requestQustionRes as $requestQustionResult)
                                    {
										 $rqid=$requestQustionResult['RequestQuestion']['question_id'];
                                        $questionUserid=$requestQustionResult['RequestQuestion']['user_id'];
                                        $requestuserDetail=$this->Custom->user_details($questionUserid);
                                        $countyID=$requestuserDetail['country_id'];
                                        $qcountyName=$this->Custom->region_nm($countyID);
                                        $locationID=$requestuserDetail['locality_id'];
                                        $qlocationName=$this->Custom->location_nm($locationID);
                                        $is_facebook=$requestuserDetail['is_facebook'];
                                        $fbid=$requestuserDetail['fb_id'];
                                        $profile_img=$requestuserDetail['profile_img'];
                                        $rquestion=$requestQustionResult['RequestQuestion']['description'];
                                        $rcreated=$requestQustionResult['RequestQuestion']['created'];
										$request_questionfst=$this->Custom->requestReplylist($rqid);
										$requestQuestImgRes=$this->Custom->BapCustuniRequestQuestImg($rqid);
                                        ?>
                                        <!--  Step  1 List  -->
                                        <div class="message_content stepOne">
                                            <div class="message_top">
                                                <div class="col-lg-12 paid_seller">
                                                    <div class="row">
                                                        <div class="col-lg-1" style="width:40px;">
                                                            <div class="row">
                                                            <?php if($profile_img!=''){
																if (file_exists('files/profileimg/40X40_'.$profile_img)) {
																$profile_img_path = $base_url.'files/profileimg/40X40_'.$profile_img;
																}else{
																$profile_img_path = $base_url.'files/profileimg/'.$profile_img;
																}
																
																?>
                                                                <img src="<?php echo $profile_img_path;?>" height="40" width="40">
                                                                <?php }else if($is_facebook==1){?>
                                                                <img src="http://graph.facebook.com/<?php echo $fbid;?>/picture?type=large" width="40" height="40" alt="">
                                                                <?php }else{?>
                                                                <img src="<?php echo $base_url;?>images/user.png" height="40" width="40">
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-3">
                                                            <span class="message_cumparator">
                                                                <a href="#"><?php echo stripslashes($requestuserDetail['first_name'].' '.$requestuserDetail['last_name']);?></a> 
                                                            </span>
                                                            
                                                            
                                                            <div class="clear"></div>
                                                            
                                                            <div class="seller_wrapper">
                                                                <span class="seller_chat chat_online">
                                                                    <font><?php echo $qlocationName;?>, <?php echo $qcountyName;?></font>
                                                                </span>
                                                                <div class="clear" style="height:5px;"></div>
                                                                <span class="user_ribbon">
                                                                    <?php echo 'Vanzator';?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-5">
                                                              <span class="user_stars">
                                                                    <a href="#" title="View profile Otomobil">
                                                                        <span class="user_star stars_purple"></span>
                                                                        <font><?php echo $this->Custom->userProfileResult($questionUserid);?></font>
                                                                    </a> 
                                                                </span>
                                                                
                                                                <div class="clear"></div>
                                                            <div class="content_qtn">
                                                                <?php echo stripslashes($rquestion);?>
                                                            </div>
                                                             <div class="listCere">
	                                                    <?php if(!empty($requestQuestImgRes)){
	                                                    		foreach($requestQuestImgRes as $requestQuestImgResult){
	                                                    			$requestQuestImgPath=$base_url."files/requestquestion/".$requestQuestImgResult['RequestquestionImage']['img_file'];
			                                                    	?>
															        <div class="col-lg-3 blockimg23">
					                                                    <a href="<?=$requestQuestImgPath?>" target="_blank"><img src="<?=$requestQuestImgPath?>" alt="" style="height: auto;"></a>
					                                                </div>
					                                                <?php 
					                                            }
			                                                }?>
	                                                    </div>
                                                        </div>
                                                        
                                                        <div class="seller_Date">
                                                            <div class="msg_date"><?php echo date("F d, Y, H:i", strtotime($rcreated));?></div>
                                                        </div>
                                                        
                                                        <?php if($requestUserid== $sessionuserID){?>
                                                        <div class="seller_reply">
                                                            <a href="javascript:void(0);" onClick="sendReply(1,<?php echo $rqid;?>);">Reply</a>
                                                        </div>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <div class="clearing"> </div>
                                            </div>
                                        </div>
                                        <!--  Step  1 List  -->
                                        <?php
										if(!empty($request_questionfst))
										{
											foreach($request_questionfst as $request_qstFirst)
											{
												 $fstrqid=$request_qstFirst['RequestQuestion']['question_id'];
												$fstquestionUserid=$request_qstFirst['RequestQuestion']['user_id'];
												$fstParent=$request_qstFirst['RequestQuestion']['parent'];
												$parentQst=$this->Custom->parentRequestDetail($fstParent);
												$parentUser=$parentQst['RequestQuestion']['user_id'];
												$fstrequestuserDetail=$this->Custom->user_details($fstquestionUserid);
												$fstcountyID=$fstrequestuserDetail['country_id'];
												$fstqcountyName=$this->Custom->region_nm($fstcountyID);
												$fstlocationID=$fstrequestuserDetail['locality_id'];
												$fstqlocationName=$this->Custom->location_nm($fstlocationID);
												$fstis_facebook=$fstrequestuserDetail['is_facebook'];
												$fstfbid=$fstrequestuserDetail['fb_id'];
												$fstprofile_img=$fstrequestuserDetail['profile_img'];
												$fstrquestion=$request_qstFirst['RequestQuestion']['description'];
												$fstrcreated=$request_qstFirst['RequestQuestion']['created'];
												$rqstmemberDetail=$this->Custom->BapCustUniMembership($fstquestionUserid);
												$request_questionsec=$this->Custom->requestReplylist($fstrqid);
												$frequestQuestImgRes=$this->Custom->BapCustuniRequestQuestImg($fstrqid);
											?>
                                             <!--  Step  2 List  -->
                                            <div class="message_content Answer_step">
                                                <div class="step_arrow"></div>
                                                <div class="message_top">
                                                    <div class="col-lg-12 paid_seller">
                                                        <div class="row">
                                                            <div class="col-lg-1" style="width:40px;">
                                                                <div class="row">
                                                                    <?php if($fstprofile_img!=''){
																		
																if (file_exists('files/profileimg/40X40_'.$fstprofile_img)) {
																$fstprofile_img_path = $base_url.'files/profileimg/40X40_'.$fstprofile_img;
																}else{
																$fstprofile_img_path = $base_url.'files/profileimg/'.$fstprofile_img;
																}
																
																?>
                                                                <img src="<?php echo $fstprofile_img_path;?>" height="40" width="40">
                                                                <?php }else if($fstis_facebook==1){?>
                                                                <img src="http://graph.facebook.com/<?php echo $fstfbid;?>/picture?type=large" width="40" height="40" alt="">
                                                                <?php }else{?>
                                                                <img src="<?php echo $base_url;?>images/user.png" height="40" width="40">
                                                                <?php }?>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-3">
                                                                <span class="message_cumparator">
                                                                    <a href="#"><?php echo stripslashes($fstrequestuserDetail['first_name'].' '.$fstrequestuserDetail['last_name']);?></a> 
                                                                </span>
                                                                
                                                                
                                                                <div class="clear"></div>
                                                                
                                                                <div class="seller_wrapper">
                                                                    <span class="seller_chat chat_online">
                                                                        <font><?php echo $fstqlocationName;?>, <?php echo $fstqcountyName;?></font>
                                                                    </span>
                                                                    <div class="clear" style="height:5px;"></div>
                                                                   
                                                                    <span class="user_ribbon_yelow">
                                                                <?php if(!empty($rqstmemberDetail)){echo $rqstmemberDetail['UserMembership']['memb_type'];}?> Vendor
                                                            </span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-5">
                                                                  <span class="user_stars">
                                                                    <a href="#" title="View profile Otomobil">
                                                                        <span class="user_star stars_purple"></span>
                                                                        <font><?php echo $this->Custom->userProfileResult($fstquestionUserid);?></font>
                                                                    </a> 
                                                                </span>
                                                                
                                                                <div class="clear"></div>
                                                                <div class="content_qtn">
                                                                    <?php echo stripslashes($fstrquestion);?>
                                                                </div>
                                                                <div class="listCere">
	                                                                <?php if(!empty($frequestQuestImgRes)){
		                                                    		foreach($frequestQuestImgRes as $frequestQuestImgResult){
		                                                    			$frequestQuestImgPath=$base_url."files/requestquestion/".$frequestQuestImgResult['RequestquestionImage']['img_file'];
				                                                    	?>
																        <div class="col-lg-3 blockimg23">
						                                                    <a href="<?=$frequestQuestImgPath?>" target="_blank"><img src="<?=$frequestQuestImgPath?>" alt="" style="height: auto;"></a>
						                                                </div>
						                                                <?php 
						                                            }
				                                                }?>
				                                                </div>
                                                            </div>
                                                            
                                                            <div class="seller_Date">
                                                                <div class="msg_date"><?php echo date("F d, Y, H:i", strtotime($fstrcreated));?></div>
                                                            </div>
                                                             <?php if($parentUser == $sessionuserID){?>
                                                        <div class="seller_reply">
                                                            <a href="javascript:void(0);" onClick="sendReply(1,<?php echo $fstrqid;?>);">Reply</a>
                                                        </div>
                                                        <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="clearing"> </div>
                                                </div>
                                            </div>
                                            <!--  Step 2 List  -->
                                             <?php
										if(!empty($request_questionsec))
										{
											foreach($request_questionsec as $request_questionSecond)
											{
												 $secrqid=$request_questionSecond['RequestQuestion']['question_id'];
												$secquestionUserid=$request_questionSecond['RequestQuestion']['user_id'];
												$secParent=$request_questionSecond['RequestQuestion']['parent'];
												$secparentQst=$this->Custom->parentRequestDetail($secParent);
												$secparentUser=$secparentQst['RequestQuestion']['user_id'];
												$secrequestuserDetail=$this->Custom->user_details($secquestionUserid);
												$seccountyID=$secrequestuserDetail['country_id'];
												$secqcountyName=$this->Custom->region_nm($seccountyID);
												$seclocationID=$secrequestuserDetail['locality_id'];
												$secqlocationName=$this->Custom->location_nm($seclocationID);
												$secis_facebook=$secrequestuserDetail['is_facebook'];
												$secfbid=$secrequestuserDetail['fb_id'];
												$secprofile_img=$secrequestuserDetail['profile_img'];
												$secrquestion=$request_questionSecond['RequestQuestion']['description'];
												$secrcreated=$request_questionSecond['RequestQuestion']['created'];
												$secrqstmemberDetail=$this->Custom->BapCustUniMembership($secquestionUserid);
												$request_questionTrd=$this->Custom->requestReplylist($secrqid);
												$secrequestQuestImgRes=$this->Custom->BapCustuniRequestQuestImg($secrqid);
											?>
                                             <!--  Step  3 List  -->
                                            <div class="message_content Answer_step_two">
                                                <div class="step_arrow"></div>
                                                <div class="message_top">
                                                    <div class="col-lg-12 paid_seller">
                                                        <div class="row">
                                                            <div class="col-lg-1" style="width:40px;">
                                                                <div class="row">
                                                                    <?php if($secprofile_img!=''){?>
                                                                <img src="<?php echo $base_url;?>files/profileimg/<?php echo $secprofile_img;?>" height="40" width="40">
                                                                <?php }else if($secis_facebook==1){?>
                                                                <img src="http://graph.facebook.com/<?php echo $secfbid;?>/picture?type=large" width="40" height="40" alt="">
                                                                <?php }else{?>
                                                                <img src="<?php echo $base_url;?>images/user.png" height="40" width="40">
                                                                <?php }?>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-3">
                                                                <span class="message_cumparator">
                                                                    <a href="#"><?php echo stripslashes($secrequestuserDetail['first_name'].' '.$secrequestuserDetail['last_name']);?></a> 
                                                                </span>
                                                                
                                                                <div class="clear"></div>
                                                                
                                                                <div class="seller_wrapper">
                                                                    <span class="seller_chat chat_online">
                                                                        <font><?php echo $secqlocationName;?>, <?php echo $secqcountyName;?></font>
                                                                    </span>
                                                                    <div class="clear" style="height:5px;"></div>
                                                                   
                                                                    <span class="user_ribbon_yelow">
                                                                <?php if(!empty($secrqstmemberDetail)){echo $secrqstmemberDetail['UserMembership']['memb_type'];}?> Vendor
                                                            </span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-5">
                                                                <span class="user_stars">
                                                                    <a href="#" title="View profile Otomobil">
                                                                        <span class="user_star stars_purple"></span>
                                                                        <font><?php echo $this->Custom->userProfileResult($secquestionUserid);?></font>
                                                                    </a> 
                                                                </span>
                                                                
                                                                <div class="clear"></div>
                                                                <div class="content_qtn">
                                                                    <?php echo stripslashes($secrquestion);?>
                                                                </div>
                                                                 <div class="listCere">
	                                                                <?php if(!empty($secrequestQuestImgRes)){
		                                                    		foreach($secrequestQuestImgRes as $secrequestQuestImgResult){
		                                                    			$secrequestQuestImgPath=$base_url."files/requestquestion/".$secrequestQuestImgResult['RequestquestionImage']['img_file'];
				                                                    	?>
																        <div class="col-lg-3 blockimg23">
						                                                    <a href="<?=$secrequestQuestImgPath?>" target="_blank"><img src="<?=$secrequestQuestImgPath?>" alt="" style="height: auto;"></a>
						                                                </div>
						                                                <?php 
						                                            }
				                                                }?>
				                                                </div>
                                                            </div>
                                                            
                                                            <div class="seller_Date">
                                                                <div class="msg_date"><?php echo date("F d, Y, H:i", strtotime($secrcreated));?></div>
                                                            </div>
                                                             <?php if($secparentUser == $sessionuserID){?>
                                                        <div class="seller_reply">
                                                            <a href="javascript:void(0);" onClick="sendReply(1,<?php echo $secrqid;?>);">Reply</a>
                                                        </div>
                                                        <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="clearing"> </div>
                                                </div>
                                            </div>
                                            <!--  Step  3 List  -->
                                            <?php
										if(!empty($request_questionTrd))
										{
											foreach($request_questionTrd as $request_questionThird)
											{
												 $trdrqid=$request_questionThird['RequestQuestion']['question_id'];
												$trdquestionUserid=$request_questionThird['RequestQuestion']['user_id'];
												$trdParent=$request_questionThird['RequestQuestion']['parent'];
												$trdparentQst=$this->Custom->parentRequestDetail($trdParent);
												$trdparentUser=$trdparentQst['RequestQuestion']['user_id'];
												$trdrequestuserDetail=$this->Custom->user_details($trdquestionUserid);
												$trdcountyID=$trdrequestuserDetail['country_id'];
												$trdqcountyName=$this->Custom->region_nm($trdcountyID);
												$trdlocationID=$trdrequestuserDetail['locality_id'];
												$trdqlocationName=$this->Custom->location_nm($trdlocationID);
												$trdis_facebook=$trdrequestuserDetail['is_facebook'];
												$trdfbid=$trdrequestuserDetail['fb_id'];
												$trdprofile_img=$trdrequestuserDetail['profile_img'];
												$trdrquestion=$request_questionThird['RequestQuestion']['description'];
												$trdrcreated=$request_questionThird['RequestQuestion']['created'];
												$trdrqstmemberDetail=$this->Custom->BapCustUniMembership($trdquestionUserid);
												//$request_questiontrd=$this->Custom->requestReplylist($secrqid);
												$trdrequestQuestImgRes=$this->Custom->BapCustuniRequestQuestImg($trdrqid);
											?>
                                             <!--  Step  4 List  -->
                                            <div class="message_content Answer_step_three">
                                                <div class="step_arrow"></div>
                                                <div class="message_top">
                                                    <div class="col-lg-12 paid_seller">
                                                        <div class="row">
                                                            <div class="col-lg-1" style="width:40px;">
                                                                <div class="row">
                                                                    <?php if($trdprofile_img!=''){?>
                                                                <img src="<?php echo $base_url;?>files/profileimg/<?php echo $trdprofile_img;?>" height="40" width="40">
                                                                <?php }else if($trdis_facebook==1){?>
                                                                <img src="http://graph.facebook.com/<?php echo $trdfbid;?>/picture?type=large" width="40" height="40" alt="">
                                                                <?php }else{?>
                                                                <img src="<?php echo $base_url;?>images/user.png" height="40" width="40">
                                                                <?php }?>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-3">
                                                                <span class="message_cumparator">
                                                                    <a href="#"><?php echo stripslashes($trdrequestuserDetail['first_name'].' '.$trdrequestuserDetail['last_name']);?></a> 
                                                                </span>
                                                                
                                                                
                                                                <div class="clear"></div>
                                                                
                                                                <div class="seller_wrapper">
                                                                    <span class="seller_chat chat_online">
                                                                        <font><?php echo $trdqlocationName;?>, <?php echo $trdqcountyName;?></font>
                                                                    </span>
                                                                    <div class="clear" style="height:5px;"></div>
                                                                   
                                                                    <span class="user_ribbon_yelow">
                                                                <?php if(!empty($trdrqstmemberDetail)){echo $trdrqstmemberDetail['UserMembership']['memb_type'];}?> Vendor
                                                            </span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-5">
                                                                <span class="user_stars">
                                                                    <a href="#" title="View profile Otomobil">
                                                                        <span class="user_star stars_purple"></span>
                                                                        <font><?php echo $this->Custom->userProfileResult($trdquestionUserid);?></font>
                                                                    </a> 
                                                                </span>
                                                                <div class="clear"></div>
                                                                <div class="content_qtn">
                                                                    <?php echo stripslashes($trdrquestion);?>
                                                                </div>
                                                                  <div class="listCere">
	                                                                <?php if(!empty($trdrequestQuestImgRes)){
		                                                    		foreach($trdrequestQuestImgRes as $trdrequestQuestImgResult){
		                                                    			$trdrequestQuestImgPath=$base_url."files/requestquestion/".$trdrequestQuestImgResult['RequestquestionImage']['img_file'];
				                                                    	?>
																        <div class="col-lg-3 blockimg23">
						                                                    <a href="<?=$trdrequestQuestImgPath?>" target="_blank"><img src="<?=$trdrequestQuestImgPath?>" alt="" style="height: auto;"></a>
						                                                </div>
						                                                <?php 
						                                            }
				                                                }?>
				                                                </div>
                                                            </div>
                                                            
                                                            <div class="seller_Date">
                                                                <div class="msg_date"><?php echo date("F d, Y, H:i", strtotime($trdrcreated));?></div>
                                                            </div>
                                                             <?php if($trdparentUser == $sessionuserID){?>
                                                        <?php /*?><div class="seller_reply">
                                                            <a href="javascript:void(0);" onClick="sendReply(1,<?php echo $trdrqid;?>);">Reply</a>
                                                        </div><?php */?>
                                                        <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="clearing"> </div>
                                                </div>
                                            </div>
                                            <!--  Step  4 List  -->
                                       
                                    <?php
											}
										}//trd Children end here
											}
										}//sec Children end here
									 }
										}//First Children end here
                                    }
                                
                                }?>
                                </div>         
                                
                                <!--  New Question Answer panel start on 14th May  -->   
                                <div class="clear"></div> 
                            <!--bid offer listing design -->
                            <?php
							//pr($bidOfferRes);
							if(!empty($bidOfferRes))
							{
								foreach($bidOfferRes as $bidOfferResult)
								{
									$bidID=$bidOfferResult['BidOffer']['bid_id'];
									$product_type=$bidOfferResult['BidOffer']['offers'];
									$payment_mode=stripslashes($bidOfferResult['BidOffer']['payment_method']);
									$personal_teaching=stripslashes($bidOfferResult['BidOffer']['personal_teaching']);
									$courier=stripslashes($bidOfferResult['BidOffer']['courier']);
									$free_courier=stripslashes($bidOfferResult['BidOffer']['free_courier']);
									$courier_cost=stripslashes($bidOfferResult['BidOffer']['courier_cost']);
									$romanian_mail=stripslashes($bidOfferResult['BidOffer']['roman_mail']);
									$romanian_mail_cost=stripslashes($bidOfferResult['BidOffer']['roman_mail_cost']);
									$free_romanian_mail=stripslashes($bidOfferResult['BidOffer']['free_roman_mail']);
									$bidUserID=$bidOfferResult['BidOffer']['user_id'];
									$memberdetails=$this->Custom->BapCustUniMembership($bidOfferResult['BidOffer']['user_id']);
									$bidUserDetail=$this->Custom->BapUserDetails($bidOfferResult['BidOffer']['user_id']);
									$bidImgRes=$this->Custom->bidImg($bidID);
									$usercountyid=stripslashes($bidUserDetail['MasterUser']['country_id']);
									$bidcountyname=$this->Custom->region_nm($usercountyid);
									$usercityid=stripslashes($bidUserDetail['MasterUser']['locality_id']);
									$bidcityname=$this->Custom->location_nm($usercityid);
							?>
                            <div class="row">
                            	<div class="cerera_model_details">
                                <div class="cerera_model_block">
                                    <div class="col-lg-8 col-sm-8 col-xs-12">
                                        <div class="row">
                                            <h1><?php echo $bidOfferResult['BidOffer']['piece'];?></h1>
                                            <h2>Doriti Piesa <?php if($product_type=='new'){echo "nou";}else if($product_type=='used'){echo "din dezmembrari";}?></h2>
                                            
                                            <h4>Pret: <?php echo $bidOfferResult['BidOffer']['price'].' '.$bidOfferResult['BidOffer']['currency'];?></h4>
                                            
                                            <div class="clearfix"></div>
                                            <?php
											if(!empty($bidImgRes))
											{
											?>
                                           
                                            <div class="listCere">
												<?php
                                                foreach($bidImgRes as $bidImgResult)
                                                {
													if (file_exists('files/bidimg/107X95_'.$bidImgResult)) {
													$bidImgResult_path = $base_url.'files/bidimg/107X95_'.$bidImgResult;
													}else{
													$bidImgResult_path = $base_url.'files/bidimg/'.$bidImgResult;
													}
                                                ?>
                                                <div class="col-lg-3 blockimg23">
                                                    <a href="#"><img src="<?php echo $bidImgResult_path;?>" alt=""></a>
                                                </div>
                                             <?php }?>
                                            </div>
                                             <div class="clearfix"></div>
                                            <?php }?>
                                            
                                            
                                            
                                            <div class="col-lg-4 col-sm-4 col-xs-12">
                                                <div class="row">
                                                    <div class="cerethird_Til">Garanti: <?php echo floatval($bidOfferResult['BidOffer']['validity']);?> luni</div>
                                                    <div class="cerethird_Ltlil">
                                            Liverare: <?php if($personal_teaching==1){echo PERSONALTEACHING.', ';}?>
                            <?php if($courier==1 || $free_courier==1){
								if($free_courier==1){$cost='free';}else{$cost=$courier_cost.'RON';}
								echo COURIORDELIVERYCOST.'('.$cost.'), ';}?>
                            <?php if($romanian_mail==1 || $free_romanian_mail==1){
								if($free_romanian_mail==1){$rcost='free';}else{$rcost=$romanian_mail_cost.'RON';}
								echo ROMANIDELIVERYCOST.'('.$rcost.')';?>
                            <?php }?> <br>
                             <?php
						  $payment_mode = str_replace("Cash on delivery", "Ramburs",  $payment_mode);
						  $payment_mode = str_replace("Upon delivery", "La livrare",  $payment_mode);
						  $payment_mode = str_replace("Wire Transfer", "Transfer Bancar",  $payment_mode);
						  $payment_mode = str_replace("Banking Card", "Card de Banking",  $payment_mode);
						  $payment_mode = str_replace("Others", "alții",  $payment_mode);
						  ?>
                                            Plats: <?php echo $payment_mode;?>
                                        </h2>
                                        </div>
                                                </div>
                                            </div>
                                        
                                            <div class="col-lg-8 col-sm-8 col-xs-12">
                                                <div class="row Cerre_new_btn">
                                                    <a href="javascript:void(0);" <?php if(($userid == $usr_id) && ($AccessoryRes['RequestAccessory']['status']!=2)){ ?> onClick="location.href='<?php echo $base_url."pages/parts-order/bidid:".$bidID;?>';" class="cancelbtn-new"<?php }else if($AccessoryRes['RequestAccessory']['status']==2){ ?> onClick="alert('This request parts already resolved')" class="cancelbtn-new offer_disabled"<?php }else if($this->Session->check('User')){?> onClick="alert('You are unable to win this offer')" class="cancelbtn-new"<?php }else { ?> onClick="location.href='<?php echo $base_url."pages/parts-order/bidid:".$bidID;?>';" class="cancelbtn-new"<?php }?> id="clickBidWin<?php echo $bidID;?>">selecteaza</a> 
                                                    
                                                    <a href="javascript:void(0);" <?php if(($userid == $usr_id) && ($AccessoryRes['RequestAccessory']['status']!=2)){ ?> onClick="bidAddQuestion(1,<?php echo $bidID;?>,<?php echo $bidUserID;?>);" class="savebtn-new"<?php }else if( $AccessoryRes['RequestAccessory']['status']==2){ ?> onClick="alert('This request parts already resolved')" class="savebtn-new offer_disabled"<?php }else if($this->Session->check('User')){?> onClick="alert('You are unable to ask question to this offer')" class="savebtn-new"<?php }else { ?> onClick="alert('Login to ask question')" class="savebtn-new"<?php }?> id="clickQuestion<?php echo $bidID;?>">Intreaba vanzatorul</a>
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
                                                <img src="<?php echo $base_url;?>files/memberplanimg/<?php echo $memberdetails['UserMembership']['plan_img'];?>" alt="" width="60" height="60"/>
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
                                                 <?php if($bidUserDetail['MasterUser']['profile_img']!=''){?>
                                        <img src="<?php echo $base_url;?>files/profileimg/<?php echo $bidUserDetail['MasterUser']['profile_img'];?>" alt="<?php echo $bidUserDetail['MasterUser']['first_name'].' '.$bidUserDetail['MasterUser']['last_name'];?>"/>
                                         <?php }else{?><img src="<?php echo $base_url;?>images/no_userphoto.png" alt="<?php echo $bidUserDetail['MasterUser']['first_name'].' '.$bidUserDetail['MasterUser']['last_name'];?>"/><?php }?>
                                                </span> 
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                            <div class="blue_txt3"><?php if(!empty($memberdetails)){echo 'vanzator premium';}else{echo "Vanzator liber";}?></div>   
                                            <div class="line"></div> 
                                            <div class="blue_txt4"><?php echo $bidUserDetail['MasterUser']['first_name'].' '.$bidUserDetail['MasterUser']['last_name'];?></div> 
                                            <div class="glyphicon glyphicon-map-marker txt">  <?php echo $bidcountyname.', '.$bidcityname;?> </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="col-lg-10">
                                                <a href="javascript:void(0);" class="savebtn-green" onclick="bidUserPhone(<?php echo $bidID;?>);">
                                                    <img src="<?php echo $base_url;?>images/details-Call.png" alt=""> <?php echo PHONE;?> : <?php echo VIEW;?>
                                                </a>  
                                                <div class="clearing"></div>
							  					   <div style="position: relative;width: 100%;margin:13px 10px 0px 0px;border-radius: 5px; display:none" id="bidPhone<?php echo $bidID;?>" class="numdetails">
        	<h2> <?php echo WHISK;?>: <?php echo $bidUserDetail['MasterUser']['telephone1'];?>         </h2>
            <p><?php echo NOTICESDATAA;?></p>
          </div>            
                                                <div class="savebtn-green2">
                                                     <?php $bidratingPercent=$this->Custom->userAllPositivePercent($bidUserDetail['MasterUser']['user_id']); if(is_float($bidratingPercent)){echo number_format($bidratingPercent, 2, '.', '');}else{echo $bidratingPercent;}?><?php /*echo $this->Custom->userAllPositivePercent($bidUserDetail['MasterUser']['user_id']);*/?>% <?php echo POSITIVERATING;?>
                                                </div>
                                                <div class="details_rating">
                                                    <span class="rtng_cere"><?php echo RATINGS;?>: &nbsp;</span>
                                                     <?php $avgrating=$this->Custom->userRatingcount($bidUserDetail['MasterUser']['user_id']);
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
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
					
				<!-- middle end -->
				
				<div class="clearfix" style="height:10px;"></div>
                </div>
                
                                <!--  New Question Answer panel start on 14th May  -->
                                
                                <div class="message_item questionpan">
                                <?php
								$bidQustionRes=$this->Custom->bidQuestionRes($bidID);
                                if(!empty($bidQustionRes) && count($bidQustionRes)>0){
                                    foreach($bidQustionRes as $requestQustionResult)
                                    {
										 $rqid=$requestQustionResult['BidQuestion']['qid'];
                                        $questionUserid=$requestQustionResult['BidQuestion']['user_id'];
                                        $requestuserDetail=$this->Custom->user_details($questionUserid);
                                        $countyID=$requestuserDetail['country_id'];
                                        $qcountyName=$this->Custom->region_nm($countyID);
                                        $locationID=$requestuserDetail['locality_id'];
                                        $qlocationName=$this->Custom->location_nm($locationID);
                                        $is_facebook=$requestuserDetail['is_facebook'];
                                        $fbid=$requestuserDetail['fb_id'];
                                        $profile_img=$requestuserDetail['profile_img'];
                                        $rquestion=$requestQustionResult['BidQuestion']['description'];
                                        $rcreated=$requestQustionResult['BidQuestion']['created'];
										$request_questionfst=$this->Custom->bidReplylist($rqid);
										$bidQuestImgRes=$this->Custom->BapCustuniBidQuestImg($rqid);
                                        ?>
                                        <!--  Step  1 List  -->
                                        <div class="message_content stepOne">
                                            <div class="message_top">
                                                <div class="col-lg-12 paid_seller">
                                                    <div class="row">
                                                        <div class="col-lg-1" style="width:40px;">
                                                            <div class="row">
                                                            <?php if($profile_img!=''){?>
                                                                <img src="<?php echo $base_url;?>files/profileimg/<?php echo $profile_img;?>" height="40" width="40">
                                                                <?php }else if($is_facebook==1){?>
                                                                <img src="http://graph.facebook.com/<?php echo $fbid;?>/picture?type=large" width="40" height="40" alt="">
                                                                <?php }else{?>
                                                                <img src="<?php echo $base_url;?>images/user.png" height="40" width="40">
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-3">
                                                            <span class="message_cumparator">
                                                                <a href="#"><?php echo stripslashes($requestuserDetail['first_name'].' '.$requestuserDetail['last_name']);?></a> 
                                                            </span>
                                                            
                                                            
                                                            <div class="clear"></div>
                                                            
                                                            <div class="seller_wrapper">
                                                                <span class="seller_chat chat_online">
                                                                    <font><?php echo $qlocationName;?>, <?php echo $qcountyName;?></font>
                                                                </span>
                                                                <div class="clear" style="height:5px;"></div>
                                                                <span class="user_ribbon">
                                                                     <?php echo BUYERRRR;?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-5">
                                                              <span class="user_stars">
                                                                    <a href="#" title="View profile Otomobil">
                                                                        <span class="user_star stars_purple"></span>
                                                                        <font><?php echo $this->Custom->userProfileResult($questionUserid);?></font>
                                                                    </a> 
                                                                </span>
                                                                
                                                                <div class="clear"></div>
                                                            <div class="content_qtn">
                                                                <?php echo stripslashes($rquestion);?>
                                                            </div>
                                                             <div class="listCere">
	                                                    <?php if(!empty($bidQuestImgRes)){
	                                                    		foreach($bidQuestImgRes as $bidQuestImgResult){
	                                                    			$bidQuestImgPath=$base_url."files/bidquestion/".$bidQuestImgResult['BidquestionImage']['img_file'];
			                                                    	?>
															        <div class="col-lg-3 blockimg23" style="height: auto;">
					                                                    <a href="<?=$bidQuestImgPath?>" target="_blank"><img src="<?=$bidQuestImgPath?>" alt="" style="height: auto;"></a>
					                                                </div>
					                                                <?php 
					                                            }
			                                                }?>
	                                                    </div>
                                                        </div>
                                                        
                                                        <div class="seller_Date">
                                                            <div class="msg_date"><?php echo date("F d, Y, H:i", strtotime($rcreated));?></div>
                                                        </div>
                                                        
                                                        <?php
														//echo $bidUserID;
														//echo $sessionuserID;
														 if($bidUserID == $sessionuserID){?>
                                                        <div class="seller_reply">
                                                            <a href="javascript:void(0);" onClick="bidReply(1,<?php echo $bidID;?>,<?php echo $bidUserID;?>,<?php echo $rqid;?>);">Reply</a>
                                                        </div>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <div class="clearing"> </div>
                                            </div>
                                        </div>
                                        <!--  Step  1 List  -->
                                        <?php
										if(!empty($request_questionfst))
										{
											foreach($request_questionfst as $request_qstFirst)
											{
												 $fstrqid=$request_qstFirst['BidQuestion']['qid'];
												$fstquestionUserid=$request_qstFirst['BidQuestion']['user_id'];
												$fstParent=$request_qstFirst['BidQuestion']['parent'];
												$parentQst=$this->Custom->parentBidDetail($fstParent);
												$parentUser=$parentQst['BidQuestion']['user_id'];
												$fstrequestuserDetail=$this->Custom->user_details($fstquestionUserid);
												$fstcountyID=$fstrequestuserDetail['country_id'];
												$fstqcountyName=$this->Custom->region_nm($fstcountyID);
												$fstlocationID=$fstrequestuserDetail['locality_id'];
												$fstqlocationName=$this->Custom->location_nm($fstlocationID);
												$fstis_facebook=$fstrequestuserDetail['is_facebook'];
												$fstfbid=$fstrequestuserDetail['fb_id'];
												$fstprofile_img=$fstrequestuserDetail['profile_img'];
												$fstrquestion=$request_qstFirst['BidQuestion']['description'];
												$fstrcreated=$request_qstFirst['BidQuestion']['created'];
												$rqstmemberDetail=$this->Custom->BapCustUniMembership($fstquestionUserid);
												$request_questionsec=$this->Custom->bidReplylist($fstrqid);
												$fbidQuestImgRes=$this->Custom->BapCustuniBidQuestImg($fstrqid);
											?>
                                             <!--  Step  2 List  -->
                                            <div class="message_content Answer_step">
                                                <div class="step_arrow"></div>
                                                <div class="message_top">
                                                    <div class="col-lg-12 paid_seller">
                                                        <div class="row">
                                                            <div class="col-lg-1" style="width:40px;">
                                                                <div class="row">
                                                                    <?php if($fstprofile_img!=''){?>
                                                                <img src="<?php echo $base_url;?>files/profileimg/<?php echo $fstprofile_img;?>" height="40" width="40">
                                                                <?php }else if($fstis_facebook==1){?>
                                                                <img src="http://graph.facebook.com/<?php echo $fstfbid;?>/picture?type=large" width="40" height="40" alt="">
                                                                <?php }else{?>
                                                                <img src="<?php echo $base_url;?>images/user.png" height="40" width="40">
                                                                <?php }?>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-3">
                                                                <span class="message_cumparator">
                                                                    <a href="#"><?php echo stripslashes($fstrequestuserDetail['first_name'].' '.$fstrequestuserDetail['last_name']);?></a> 
                                                                </span>
                                                                
                                                                
                                                                <div class="clear"></div>
                                                                
                                                                <div class="seller_wrapper">
                                                                    <span class="seller_chat chat_online">
                                                                        <font><?php echo $fstqlocationName;?>, <?php echo $fstqcountyName;?></font>
                                                                    </span>
                                                                    <div class="clear" style="height:5px;"></div>
                                                                   
                                                                    <span class="user_ribbon_yelow">
                                                                <?php if(!empty($rqstmemberDetail)){echo $rqstmemberDetail['UserMembership']['memb_type'];}?> Vendor
                                                            </span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-5">
                                                                  <span class="user_stars">
                                                                    <a href="#" title="View profile Otomobil">
                                                                        <span class="user_star stars_purple"></span>
                                                                        <font><?php echo $this->Custom->userProfileResult($fstquestionUserid);?></font>
                                                                    </a> 
                                                                </span>
                                                                
                                                                <div class="clear"></div>
                                                                <div class="content_qtn">
                                                                    <?php echo stripslashes($fstrquestion);?>
                                                                </div>
                                                                <div class="listCere">
			                                                    <?php if(!empty($fbidQuestImgRes)){
			                                                    		foreach($fbidQuestImgRes as $fbidQuestImgResult){
			                                                    			$fbidQuestImgPath=$base_url."files/bidquestion/".$fbidQuestImgResult['BidquestionImage']['img_file'];
					                                                    	?>
																	        <div class="col-lg-3 blockimg23" style="height: auto;">
							                                                    <a href="<?=$fbidQuestImgPath?>" target="_blank"><img src="<?=$fbidQuestImgPath?>" alt="" style="height: auto;"></a>
							                                                </div>
							                                                <?php 
							                                            }
					                                                }?>
			                                                    </div>
                                                            </div>
                                                            
                                                            <div class="seller_Date">
                                                                <div class="msg_date"><?php echo date("F d, Y, H:i", strtotime($fstrcreated));?></div>
                                                            </div>
                                                             <?php if($parentUser == $sessionuserID){?>
                                                        <div class="seller_reply">
                                                            <a href="javascript:void(0);" onClick="bidReply(1,<?php echo $bidID;?>,<?php echo $bidUserID;?>,<?php echo $fstrqid;?>);">Reply</a>
                                                        </div>
                                                        <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="clearing"> </div>
                                                </div>
                                            </div>
                                            <!--  Step 2 List  -->
                                             <?php
										if(!empty($request_questionsec))
										{
											foreach($request_questionsec as $request_questionSecond)
											{
												 $secrqid=$request_questionSecond['BidQuestion']['qid'];
												$secquestionUserid=$request_questionSecond['BidQuestion']['user_id'];
												$secParent=$request_questionSecond['BidQuestion']['parent'];
												$secparentQst=$this->Custom->parentBidDetail($secParent);
												$secparentUser=$secparentQst['BidQuestion']['user_id'];
												$secrequestuserDetail=$this->Custom->user_details($secquestionUserid);
												$seccountyID=$secrequestuserDetail['country_id'];
												$secqcountyName=$this->Custom->region_nm($seccountyID);
												$seclocationID=$secrequestuserDetail['locality_id'];
												$secqlocationName=$this->Custom->location_nm($seclocationID);
												$secis_facebook=$secrequestuserDetail['is_facebook'];
												$secfbid=$secrequestuserDetail['fb_id'];
												$secprofile_img=$secrequestuserDetail['profile_img'];
												$secrquestion=$request_questionSecond['BidQuestion']['description'];
												$secrcreated=$request_questionSecond['BidQuestion']['created'];
												$secrqstmemberDetail=$this->Custom->BapCustUniMembership($secquestionUserid);
												$request_questionTrd=$this->Custom->bidReplylist($secrqid);
												$secbidQuestImgRes=$this->Custom->BapCustuniBidQuestImg($secrqid);
											?>
                                             <!--  Step  3 List  -->
                                            <div class="message_content Answer_step_two">
                                                <div class="step_arrow"></div>
                                                <div class="message_top">
                                                    <div class="col-lg-12 paid_seller">
                                                        <div class="row">
                                                            <div class="col-lg-1" style="width:40px;">
                                                                <div class="row">
                                                                    <?php if($secprofile_img!=''){?>
                                                                <img src="<?php echo $base_url;?>files/profileimg/<?php echo $secprofile_img;?>" height="40" width="40">
                                                                <?php }else if($secis_facebook==1){?>
                                                                <img src="http://graph.facebook.com/<?php echo $secfbid;?>/picture?type=large" width="40" height="40" alt="">
                                                                <?php }else{?>
                                                                <img src="<?php echo $base_url;?>images/user.png" height="40" width="40">
                                                                <?php }?>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-3">
                                                                <span class="message_cumparator">
                                                                    <a href="#"><?php echo stripslashes($secrequestuserDetail['first_name'].' '.$secrequestuserDetail['last_name']);?></a> 
                                                                </span>
                                                                
                                                                <div class="clear"></div>
                                                                
                                                                <div class="seller_wrapper">
                                                                    <span class="seller_chat chat_online">
                                                                        <font><?php echo $secqlocationName;?>, <?php echo $secqcountyName;?></font>
                                                                    </span>
                                                                    <div class="clear" style="height:5px;"></div>
                                                                   
                                                                    <span class="user_ribbon_yelow">
                                                                <?php if(!empty($secrqstmemberDetail)){echo $secrqstmemberDetail['UserMembership']['memb_type'];}?> Vendor
                                                            </span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-5">
                                                                <span class="user_stars">
                                                                    <a href="#" title="View profile Otomobil">
                                                                        <span class="user_star stars_purple"></span>
                                                                        <font><?php echo $this->Custom->userProfileResult($secquestionUserid);?></font>
                                                                    </a> 
                                                                </span>
                                                                
                                                                <div class="clear"></div>
                                                                <div class="content_qtn">
                                                                    <?php echo stripslashes($secrquestion);?>
                                                                </div>
                                                                 <div class="listCere">
			                                                    <?php if(!empty($secbidQuestImgRes)){
			                                                    		foreach($secbidQuestImgRes as $secbidQuestImgResult){
			                                                    			$secbidQuestImgPath=$base_url."files/bidquestion/".$secbidQuestImgResult['BidquestionImage']['img_file'];
					                                                    	?>
																	        <div class="col-lg-3 blockimg23" style="height: auto;">
							                                                    <a href="<?=$secbidQuestImgPath?>" target="_blank"><img src="<?=$secbidQuestImgPath?>" alt="" style="height: auto;"></a>
							                                                </div>
							                                                <?php 
							                                            }
					                                                }?>
			                                                    </div>
                                                            </div>
                                                            
                                                            <div class="seller_Date">
                                                                <div class="msg_date"><?php echo date("F d, Y, H:i", strtotime($secrcreated));?></div>
                                                            </div>
                                                             <?php if($secparentUser == $sessionuserID){?>
                                                        <div class="seller_reply">
                                                            <a href="javascript:void(0);" onClick="bidReply(1,<?php echo $bidID;?>,<?php echo $bidUserID;?>,<?php echo $secrqid;?>);">Reply</a>
                                                        </div>
                                                        <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="clearing"> </div>
                                                </div>
                                            </div>
                                            <!--  Step  3 List  -->
                                            <?php
										if(!empty($request_questionTrd))
										{
											foreach($request_questionTrd as $request_questionThird)
											{
												 $trdrqid=$request_questionThird['BidQuestion']['qid'];
												$trdquestionUserid=$request_questionThird['BidQuestion']['user_id'];
												$trdParent=$request_questionThird['BidQuestion']['parent'];
												$trdparentQst=$this->Custom->parentBidDetail($trdParent);
												$trdparentUser=$trdparentQst['BidQuestion']['user_id'];
												$trdrequestuserDetail=$this->Custom->user_details($trdquestionUserid);
												$trdcountyID=$trdrequestuserDetail['country_id'];
												$trdqcountyName=$this->Custom->region_nm($trdcountyID);
												$trdlocationID=$trdrequestuserDetail['locality_id'];
												$trdqlocationName=$this->Custom->location_nm($trdlocationID);
												$trdis_facebook=$trdrequestuserDetail['is_facebook'];
												$trdfbid=$trdrequestuserDetail['fb_id'];
												$trdprofile_img=$trdrequestuserDetail['profile_img'];
												$trdrquestion=$request_questionThird['BidQuestion']['description'];
												$trdrcreated=$request_questionThird['BidQuestion']['created'];
												$trdrqstmemberDetail=$this->Custom->BapCustUniMembership($trdquestionUserid);
												//$request_questiontrd=$this->Custom->requestReplylist($secrqid);
												$trdbidQuestImgRes=$this->Custom->BapCustuniBidQuestImg($trdrqid);
											?>
                                             <!--  Step  4 List  -->
                                            <div class="message_content Answer_step_three">
                                                <div class="step_arrow"></div>
                                                <div class="message_top">
                                                    <div class="col-lg-12 paid_seller">
                                                        <div class="row">
                                                            <div class="col-lg-1" style="width:40px;">
                                                                <div class="row">
                                                                    <?php if($trdprofile_img!=''){?>
                                                                <img src="<?php echo $base_url;?>files/profileimg/<?php echo $trdprofile_img;?>" height="40" width="40">
                                                                <?php }else if($trdis_facebook==1){?>
                                                                <img src="http://graph.facebook.com/<?php echo $trdfbid;?>/picture?type=large" width="40" height="40" alt="">
                                                                <?php }else{?>
                                                                <img src="<?php echo $base_url;?>images/user.png" height="40" width="40">
                                                                <?php }?>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-3">
                                                                <span class="message_cumparator">
                                                                    <a href="#"><?php echo stripslashes($trdrequestuserDetail['first_name'].' '.$trdrequestuserDetail['last_name']);?></a> 
                                                                </span>
                                                                
                                                                
                                                                <div class="clear"></div>
                                                                
                                                                <div class="seller_wrapper">
                                                                    <span class="seller_chat chat_online">
                                                                        <font><?php echo $trdqlocationName;?>, <?php echo $trdqcountyName;?></font>
                                                                    </span>
                                                                    <div class="clear" style="height:5px;"></div>
                                                                   
                                                                    <span class="user_ribbon_yelow">
                                                                <?php if(!empty($trdrqstmemberDetail)){echo $trdrqstmemberDetail['UserMembership']['memb_type'];}?> Vendor
                                                            </span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-5">
                                                                <span class="user_stars">
                                                                    <a href="#" title="View profile Otomobil">
                                                                        <span class="user_star stars_purple"></span>
                                                                        <font><?php echo $this->Custom->userProfileResult($trdquestionUserid);?></font>
                                                                    </a> 
                                                                </span>
                                                                <div class="clear"></div>
                                                                <div class="content_qtn">
                                                                    <?php echo stripslashes($trdrquestion);?>
                                                                </div>
                                                                 <div class="listCere">
			                                                    <?php if(!empty($trdbidQuestImgRes)){
			                                                    		foreach($trdbidQuestImgRes as $trdbidQuestImgResult){
			                                                    			$trdbidQuestImgPath=$base_url."files/bidquestion/".$trdbidQuestImgResult['BidquestionImage']['img_file'];
					                                                    	?>
																	        <div class="col-lg-3 blockimg23" style="height: auto;">
							                                                    <a href="<?=$trdbidQuestImgPath?>" target="_blank"><img src="<?=$trdbidQuestImgPath?>" alt="" style="height: auto;"></a>
							                                                </div>
							                                                <?php 
							                                            }
					                                                }?>
			                                                    </div>
                                                            </div>
                                                            
                                                            <div class="seller_Date">
                                                                <div class="msg_date"><?php echo date("F d, Y, H:i", strtotime($trdrcreated));?></div>
                                                            </div>
                                                             <?php if($trdparentUser == $sessionuserID){?>
                                                        <?php /*?><div class="seller_reply">
                                                            <a href="javascript:void(0);" onClick="sendReply(1,<?php echo $trdrqid;?>);">Reply</a>
                                                        </div><?php */?>
                                                        <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="clearing"> </div>
                                                </div>
                                            </div>
                                            <!--  Step  4 List  -->
                                       
                                    <?php
											}
										}//trd Children end here
											}
										}//sec Children end here
									 }
										}//First Children end here
                                    }
                                
                                }?>
                                </div>         
                                
                                <!--  New Question Answer panel start on 14th May  -->  
                			</div>
                            
                            <?php
								}
							}
							?>
                            <?php /*?> <div class="clearfix" style="height:30px;"></div>
                            <div class="row">
   
        	<div class="message_item" data-message-id="517199" data-project_id="502172291" style="padding-left:0px;">
      <div class="message_content " data-message-id="517199" data-project_id="502172291">
      			  <div id="msg517199"> <a name="msg517199"></a>
          <div class="message_top" id="mess517199"> <span class="message_cumparator">Cumpărător: </span> <span class="message_user_link"> <a href="#" title=""> biswonath Mishra </a> <span class="user_stars2"> <a href="#" title="Mergi la profilul utilizatorului KULA"> <span class="user_star stars_green"></span> &nbsp;  </a> </span> <span class="localization">             	                 	                 	                 	     </span> </span>
          <!--<span class="message_date" style="float: right; margin-top:2px;" >18-12-2014 11:33:48</span>-->
          		   <span class="message_date" style="float: right; margin-top:2px;">13-05-2015 02:50:06</span> <span class="message_text" style="float:right; margin-right:159px; margin-top:-30px; position:relative;"><a onclick="askQuestion('10');" href="javascript:void(0)" style="text-decoration:none; cursor:pointer;">Reply</a></span>
                  
		
		  		  
            <div class="clearing"></div>
          </div>
          <div class="message_text">
            <div style="padding:0 0 5px 0;"> Question : test question from dsfs </div>
            				 <div style="padding:0 0 5px 0;">Reply : test set </div>
				           
          </div>
        </div>
        
        
        <div class="clear"></div>
         <div style="display:none" id="showquestion_10" class="message_text bg_grey post_offer_message"><div class="datascl">
            <h2>Reply about Question</h2>
            <br>
            <div class="product_section product_shipping">
              <p>
                There were no questions on this notice.
              </p>
            </div>
            
            <div class="clearfix"></div>
            
            <h5>Addresses the seller a question</h5>
            
            <div class="highlight">
                <div class="col-lg-7">
                    <div class="row">
                    
                        <form accept-charset="utf-8" method="post" id="RequestQuestionRequestResponseForm" action="/dezmem/RequestParts/addReply"><div style="display:none;"><input type="hidden" value="POST" name="_method"></div>                       
                           <textarea required="required" id="RequestQuestionDescription" rows="3" class="form-control" name="data[RequestQuestion][description]"></textarea><input type="hidden" id="RequestQuestionRequestId" value="35" class="form-control" name="data[RequestQuestion][request_id]"><input type="hidden" id="RequestQuestionParent" value="10" class="form-control" name="data[RequestQuestion][parent]"><input type="hidden" id="RequestQuestionPartsId" value="27" class="form-control" name="data[RequestQuestion][parts_id]">                          <div style="height:20px" class="clear"></div>
                         <!-- <div class="captch">
                              <img src="/dezmem/captcha/captcha_code_file.php?rand=1890" id="captchaimg">
                              
                          <input type="text" class="required form-control" id="code" name="code">
                          </div>-->
                          <div class="col-lg-4">
                    <div class="msg_label red_label">
                        <span class="warning_sign"></span>
                        <b><font><font>PROHIBITED</font></font></b>
                        <font><font> to post this personal information such as phone, e-mail, website, etc.</font></font>
                    </div>
                </div>
                          <div class="clear10"></div>
                          <button class="btn gbutton6" name="question" type="submit">Submit the Answar</button>
                                                   </form>
                        
                    </div>
                </div>
                
                <div class="col-lg-1"></div>
                
               
                <div class="clear"></div>
            </div>
            
        </div></div>
       
                 
			      
      </div>
       
    </div>
    </div><?php */?>
                <div class="clearfix" style="height:1px;"></div>
                <!--bid offer listing design End -->
                            
                           <div class="row">
                               
                                <div class="clear15"></div> 
                                <!--offerform-->
                                

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
                                                                    <label>&nbsp;&nbsp; Doriti piesa: </label>
                                                                    
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
                                                                    <td><label style="width:120px">Cost Livrare: </label>
                                                                    </td><td colspan="4">
                                                                     <?php if(isset($this->request->data['BidOffer']['courier_cost'])){$courier_cost=$this->request->data['BidOffer']['courier_cost'];}else{$courier_cost='';}?>
                                                                      
                                                                        <input type="text" value="<?php echo $courier_cost;?>" name="data[BidOffer][courier_cost]" id="BidOfferCourierCost" class="form-control">
                                                                    </td>
                                                                    <td style="padding-left:2em; padding-top:6px;">
                                                                    	<div class="checkbox">
                                                                        <?php if(isset($this->request->data['BidOffer']['free_courier'])){$free_courier=$this->request->data['BidOffer']['free_courier'];}else{$free_courier='';}?>
                     <input type="hidden" name="data[BidOffer][free_courier]" id="BidOfferRreeCourier_" value="0">
                     <label><input type="checkbox" name="data[BidOffer][free_courier]" id="BidOfferFreeCourier" value="1"<?php if($free_courier==1){?> checked="checked" <?php }?> > Livrare Gratuita</label>
                                                                            
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
                                                                    <td><label style="width:80px">Cost Livrare: </label>
                                                                    </td><td colspan="4">
                                                                       
                                                                         <?php if(isset($this->request->data['BidOffer']['roman_mail_cost'])){$roman_mail_cost=$this->request->data['BidOffer']['roman_mail_cost'];}else{$roman_mail_cost='';}?>
                     <input type="text" value="<?php echo $roman_mail_cost;?>" name="data[BidOffer][roman_mail_cost]" id="BidOfferRomanMailCost" class="form-control" style="width:200px;" />
                                                                    </td>
                                                                    <td style="padding-left:2em; padding-top:6px;">
                                                                    	<div class="checkbox">
                                                                        <?php if(isset($this->request->data['BidOffer']['free_roman_mail'])){$free_roman_mail=$this->request->data['BidOffer']['free_roman_mail'];}else{$free_roman_mail='';}?>
                     <input type="hidden" name="data[BidOffer][free_roman_mail]" id="BidOfferFreeRomanMail_" value="0">
                     <label><input type="checkbox" name="data[BidOffer][free_roman_mail]" id="BidOfferFreeRomanMail" value="1" <?php if($free_roman_mail==1){?> checked="checked" <?php }?>> Livrare Gratuita</label>
                                                                            
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
                 <input type="hidden" name="bidrequest_user_id" value="<?php echo $userid;?>" />
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
                    
                        <?php echo $this->Form->create('RequestQuestion', array('enctype' => 'multipart/form-data')); ?>
                       
                           <?php
						echo $this->Form->input('description', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));
						echo $this->Form->input('request_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$request_id));
						echo $this->Form->input('parts_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$part_id));
						echo $this->Form->input('parent', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control'));
						?>
                        <input type="hidden" name="data[RequestQuestion][bidid]" id="bidid" value="" />
                        <input type="hidden" name="data[RequestQuestion][to_id]" id="bidUserID" />
                          <div class="clear" style="height:20px"></div>
                          <?php
						echo $this->Form->input('img_files', array('label' => false, 'type' => 'file', 'multiple' => 'multiple', 'name' => 'data[RequestQuestion][img_files][]', 'div' => false, 'class' => 'form-control', 'style' => 'width:50%'));
						?>
						<span><i>(Maximum 8 Image allow to upload)</i></span>
                          <div class="clear" style="height:20px"></div>
                          <div class="captch">
                              <img src="<?php echo $base_url;?>captcha/captcha_code_file.php?rand=<?php echo rand();?>" id="captchaimg">
                              
                          <input type="text" class="required form-control" id="code" name="code">
                          </div>
                          <div class="clear10"></div>
                          <input type="hidden" name="request_user_id" value="<?php echo $userid;?>" />
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