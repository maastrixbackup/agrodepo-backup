<?php
echo $this->element('header-home');
$park_id=stripslashes($parkDetail['SalesPark']['park_id']);
$user_id=stripslashes($parkDetail['SalesPark']['user_id']);
$park_name=stripslashes($parkDetail['SalesPark']['park_name']);
$description=stripslashes($parkDetail['SalesPark']['description']);
$add_type=stripslashes($parkDetail['SalesPark']['add_type']);
$slug=stripslashes($parkDetail['SalesPark']['slug']);											
$parkUrl=$base_url.'pages/parks/'.$slug;
$memdetail=$this->Custom->BapCustUniMembership($user_id);
$logo=stripslashes($parkDetail['SalesPark']['logo']);
$vat=stripslashes($parkDetail['SalesPark']['vat']);
$user_detail=$this->Custom->user_details($user_id);
$totprofilegrade=$this->Custom->userProfileResult($user_id);
$allparkimg=$this->Custom->allParksimg($park_id);
$comp_name=stripslashes($parkDetail['SalesPark']['comp_name']);
$brand_id=stripslashes($parkDetail['SalesPark']['brand_id']);
$brandname=array();
if($brand_id!='')
{
	$brandarr=explode(',',$brand_id);
	foreach($brandarr as $singbid)
	{
		array_push($brandname, $this->Custom->brand_nm($singbid));
	}
}
$warranty_detail=stripslashes($parkDetail['SalesPark']['warranty_detail']);
$rating_from=($add_type==1)?1:2;
$country_id=stripslashes($parkDetail['SalesPark']['country_id']);
$countryname=$this->Custom->region_nm($country_id);
$location_id=stripslashes($parkDetail['SalesPark']['location_id']);
$locationname=$this->Custom->location_nm($location_id);
$totpostad=$this->Custom->dezPostAdsCount('user_id',$user_id);
$totrequestparts=$this->Custom->dezRequestPartCount('user_id',$user_id);
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
function addQuestion(showval)
{
	if(showval==1)
	{
		$("#showoffer").hide();
		$("#showquestion").show();
		$(".addquestion").attr("onClick","addQuestion(0);");
		 $('html, body').animate({
        scrollTop: $("#showquestion").offset().top- 135
    }, 2000);
	}
	else
	{
		$("#showoffer").hide();
		$("#showquestion").hide();
		$(".addquestion").attr("onClick","addQuestion(1);");
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
		$("#ParkQuestionParent").val(qid);
	}
	else
	{
		$("#showoffer").hide();
		$("#showquestion").hide();
	}
}
</script>
  <div class="container">
		<div class="row">
        <div class="clearfix" style="height:15px;"></div>
			<?php echo $this->Session->flash(); ?>		
			<div class="innerpanel">
				<!-- Left Sidebar Start -->
					<div class="col-md-12 prof">
						 <div class="clearfix" style="height:15px;"></div>
						 
                         <div id="breadcrumb">
                              <ul class="crumbs">
                                <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>"><span></span><?php echo HOME;?></a> </li>
                                <?php if($add_type==1){?>
                                <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>pages/truck-parks"><span></span><?php echo TRUCKPARKS;?></a> </li>
                                <?php }else{?>
                                <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>pages/company-parts"><span></span><?php echo COMPANYPARTS;?></a> </li>
                                <?php }?>
                                <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo $park_name;?></a></li>
                           	 </ul>
           				 </div>
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                         <h2 class="detailstitle1" style="color:#DF5E08"><?php if($add_type==1){?><?php echo TRUCKPARKS;?><?php }else{?><?php echo COMPANYPARTS;?> <?php }?></h2>
                         
                         <div class="clearfix" style="height:15px;"></div>
                         
						 <div class="col-lg-9">
						 	<div class="row">
								<div class="col-lg-12">
								
                            	<div class="row searchlistdata">
                                	<ul>
                                    	<li>
                                        	<div class="col-lg-2">
                                            	<div class="row">
                                                	<a href="<?php echo $parkUrl;?>">
                                                     <?php if($logo!=''){
														 $path ='files/company_logo/133X100_'.$logo;
														if (file_exists($path)) {
														$logo_path = $base_url.'files/company_logo/133X100_'.$logo;
														}else{
														$logo_path = $base_url.'files/company_logo/'.$logo;
														}
														 ?>
                                                        <img src="<?php echo $logo_path;?>" class="listimg_fix" alt="<?php echo $comp_name;?>">
                                                        <?php }else{?>
                                                        <img src="<?php echo $base_url;?>images/profileholder.png" class="listimg_fix" alt="<?php echo $comp_name;?>">
                                                        <?php }?>
                                                    </a>
                                                    <div class="clear5"></div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-8">
                                            	<div class="datalistitem">
                                                	<h1><a href="<?php echo $parkUrl;?>"><?php echo $park_name;?></a></h1>
                                                    <p>
                                                        <span class="blue_txt"><?php echo $comp_name;?> &nbsp;| </span> 
                                                        <span class="blue_txt vat_data"><?php echo $vat;?></span>
                                                        <br>
                                                        
                                                        <div class="clear5"></div>
                                                        
                                                        <span class="text-upper op7"><img src="<?php echo $base_url;?>images/location.png" alt="location" /> <?php echo $locationname.' &nbsp;&nbsp;'.$countryname;?> | <!--<img src="<?php // echo $base_url;?>images/icon_calendar.gif" alt="date" />--> <?php echo NOTIFICATION;?> : <?php echo $totpostad;?>  | <?php echo APPLICATION;?> : <?php echo $totrequestparts;?>  | <?php echo PIESELEVERATE;?>:0
                                                        
                                                        </span>
                                                        
                                                        <div class="clear5"></div>
                                                        
                                                     </p>
                                                    <div class="clear"></div>
                                                    <div class="sr_user_isseller" style="background:none; padding-left:0; height:auto;">
                                                    	<span class="text-upper"><?php echo PARCRUN;?> :</span> 
                                                        <span class="text-upper op7">	<?php echo stripslashes($user_detail['first_name'].' '.$user_detail['last_name']);?> ( <img src="<?php echo $base_url;?>images/star-small-active.png" /><?php echo $totprofilegrade;?> )</span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                            	<div class="row">
                                                	<div class="sr_price mr_minus">
                                                    	<h3><?php if(!empty($memdetail)){if($memdetail['UserMembership']['plan_img']!=''){                                                      
														$path='files/memberplanimg/70X100_'.$memdetail['UserMembership']['plan_img'];
														if (file_exists($path)) {
														$memdetail_path = $base_url.'files/memberplanimg/70X100_'.$memdetail['UserMembership']['plan_img'];
														}else{
														$memdetail_path = $base_url.'files/memberplanimg/'.$memdetail['UserMembership']['plan_img'];
														}
															
															?>
                                                        <img src="<?php echo $memdetail_path;?>" alt="<?php echo $memdetail['UserMembership']['memb_type'];?>">
                                                        <?php }}?></h3>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
										
                                    </ul>
                                </div>
                                
                                
                                <div class="clear15"></div>
                                     <div class="row font12"> 
                                         <h4 class="blue_txt"><?php echo ABOUTUS;?>:</h4>
                                      <?php echo nl2br($description);?>
                                       
                                       <?php 
									   if(!empty($allparkimg))
									   {
										   ?>
                                       <ul class="ser_det">
                                       <?php
									   foreach($allparkimg as $parkimgRes)
									   {
										$path = 'files/parkimg/155X100_'.$parkimgRes['ParkImg']['img_path'];   
										if (file_exists($path)) {
										$parkimgRes_path = $base_url.'files/parkimg/155X100_'.$parkimgRes['ParkImg']['img_path'];
										}else{
										$parkimgRes_path = $base_url.'files/parkimg/'.$parkimgRes['ParkImg']['img_path'];
										}
										   ?>
                                          <li>
                                              <img src="<?php echo $parkimgRes_path;?>" alt="<?php echo $park_name;?>"/>
                                          </li>
                                          <?php
									   }
									   ?>
                                         
                                       </ul>
                                       <?php }?>
                                       
                                       
                                       <div class="clear10"></div>
                                       <h4 class="blue_txt"><?php echo VEHICLEBRANDSDISMANTL;?>:</h4>
                                       <p><?php if(!empty($brandname)){echo implode(", ",$brandname).'.';}?> </p>
                                     
                                     
                                     
                                     <h4 class="blue_txt"><?php echo WARRANTYTDR;?>:</h4>
                                    <p>
                                    <?php echo nl2br(stripslashes($warranty_detail));?>
                                    </p>
                                      
                                     </div>
                                <div class="clear15"></div>
                                
                                
                                
                               <div class="row wrapper-bx1">
                               <h4 class="blue_txt"><?php echo RATEPARKK;?>:</h4>  
                               <div class="hr"></div>
                               <div class=" clear5"></div>
                                    <div class="col-lg-4">
                                           <div class="row ratinguser">
                                           <input type="hidden" id="rating_from" name="rating_from" value="<?php echo $rating_from;?>" />
                                              <input type="hidden" name="park_id" id="park_id" value="<?php echo $park_id;?>" />
                                              <span class="pull-left"><?php echo YOURRATING;?>: &nbsp;&nbsp; </span><input id="prksrate" value="0" type="number" min=0 max=5 step=0.5 ><span id="rating_loader"></span>
                                           </div>
                                           
                                    </div>
                                    <span id="ratepoint">
                                    <?php
									$ratinglist=$this->Custom->parkRating($park_id, $rating_from);
									 $ratingtotal=0;
									 if(!empty($ratinglist))
									 {
										 foreach($ratinglist as $ratingRes)
										 {
										 $ratingtotal+=$ratingRes['ParkRating']['ratingno'];
										 }
										 $avgpercent=$ratingtotal/count($ratinglist);
										 $roundavg=round($avgpercent);
										?>
										 <div class="col-lg-4">
											<div class="row"> 
										 Rating:
										 <?php 
												if(!empty($avgpercent))
												{
													for($cost_trans=1; $cost_trans<=$roundavg; $cost_trans++)
													{
														if($cost_trans>$avgpercent)
														{
															?>
															<img border="0" src="<?php echo Router::url('/', true);?>/images/star-small-halfactive.png" alt="rating" />
															<?php
														}
														else
														{
														?>
														<img border="0" src="<?php echo Router::url('/', true);?>/images/star-small-active.png" alt="rating" />
														<?php
														}
													}
												}
												if(round($avgpercent)<5)
												{
													for($cost=5; $roundavg<$cost; $cost--)
													{
														?>
														<img border="0" src="<?php echo Router::url('/', true);?>/images/star-small-inactive.png">   
														<?php
													}
												}
												?>
															   &nbsp; &nbsp;  <span class="grn_txt"> <strong> <?php echo $avgpercent;?> / 5</strong></span>  
															   </div></div>
																
																
																 <div class="col-lg-4">
																	   <div class="row"> 
																			 <span class="op7"><?php echo AVERAGERATTING;?> <?php echo $avgpercent;?> <?php echo OUTOF;?> <?php echo count($ratinglist);?> <?php echo VOTES;?>.</span>
																	   </div>
																 </div>
										<?php
									 }
									?>
                                  
                                     </span>    
                                    
                                    <div class=" clear5"></div>
                                    
                                </div>
                                <div class=" clear5"></div>
                                <input type="button" value="<?php echo ASKQUESTION;?>" onclick="addQuestion(1);" name="button" class="btn_dlts addquestion <?php if($sessionuserID==$user_id){?> sales_disabled<?php }?>" <?php if($sessionuserID==$user_id){?> disabled="disabled"<?php }?>>
                                
                                
                                
                            </div>
						
								
							</div>
						 </div>
						 
						 
						 
						 <div class="col-lg-3 prof" style="padding-right: 0px;">
                        <?php /*?> <button class="org_btn btn radius-zero imagefull text-upper" onclick="location.href='<?php echo $base_url;?>SalesParks/company_add';"><img src="<?php echo $base_url;?>images/plus_white.png" width="25"><strong>  <?php echo ADDTOCOMPANYPARTS;?></strong></button>
                          <div class="clear15"></div><?php */?>
                         
                         
						 	<h2 class="detailstitle1" style="color: #fff;background: #1996E6;padding: 5px 5px 5px 10px;"><?php echo RECENTCOMPANYPARTS;?></h2>
                             <?php
						 echo $this->element('park-right');
						 ?>
						 </div>
                         
                         
                        <div class="clear"></div>
                        <div class="clear40 col-lg-12" style="background:url(<?php echo $base_url;?>images/horiz_dotter_border.png) repeat-x center center;"></div>
                        
                              <div class="clear" style="height:20px;"></div>
                
                                <!--  New Question Answer panel start on 14th May  -->
                                
                                <div class="message_item questionpan">
                                <?php
                                if(!empty($parkQustionRes) && count($parkQustionRes)>0){
                                    foreach($parkQustionRes as $requestQustionResult)
                                    {
										 $rqid=$requestQustionResult['ParkQuestion']['qid'];
                                        $questionUserid=$requestQustionResult['ParkQuestion']['user_id'];
                                        $requestuserDetail=$this->Custom->user_details($questionUserid);
                                        $countyID=$requestuserDetail['country_id'];
                                        $qcountyName=$this->Custom->region_nm($countyID);
                                        $locationID=$requestuserDetail['locality_id'];
                                        $qlocationName=$this->Custom->location_nm($locationID);
                                        $is_facebook=$requestuserDetail['is_facebook'];
                                        $fbid=$requestuserDetail['fb_id'];
                                        $profile_img=$requestuserDetail['profile_img'];
                                        $rquestion=$requestQustionResult['ParkQuestion']['question'];
                                        $rcreated=$requestQustionResult['ParkQuestion']['created'];
										$request_questionfst=$this->Custom->parkReplylist($rqid);
										 $parksQuestImgRes=$this->Custom->BapCustuniparkQuestImg($rqid);
                                        ?>
                                        <!--  Step  1 List  -->
                                        <div class="message_content stepOne">
                                            <div class="message_top">
                                                <div class="col-lg-12 paid_seller">
                                                    <div class="row">
                                                        <div class="col-lg-1" style="width:40px;">
                                                            <div class="row">
                                                            <?php if($profile_img!=''){
																	$path ='files/profileimg/40X40_'.$profile_img;						
																	if (file_exists($path)) {
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
                                                                    Buyer
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
	                                                    <?php if(!empty($parksQuestImgRes)){
	                                                    		foreach($parksQuestImgRes as $parksQuestImgResult){
	                                                    			$parkQuestImgPath=$base_url."files/parkquestion/".$parksQuestImgResult['ParksquestionImage']['img_file'];
			                                                    	?>
															        <div class="col-lg-3 blockimg23" style="height: auto;">
					                                                    <a href="<?=$parkQuestImgPath?>" target="_blank"><img src="<?=$parkQuestImgPath?>" alt="" style="height: auto;"></a>
					                                                </div>
					                                                <?php 
					                                            }
			                                                }?>
	                                                    </div>
                                                        </div>
                                                        
                                                        <div class="seller_Date">
                                                            <div class="msg_date"><?php echo date("F d, Y, H:i", strtotime($rcreated));?></div>
                                                        </div>
                                                        
                                                        <?php if($user_id== $sessionuserID){?>
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
												 $fstrqid=$request_qstFirst['ParkQuestion']['qid'];
												$fstquestionUserid=$request_qstFirst['ParkQuestion']['user_id'];
												$fstParent=$request_qstFirst['ParkQuestion']['parent'];
												$parentQst=$this->Custom->parentparkDetail($fstParent);
												$parentUser=$parentQst['ParkQuestion']['user_id'];
												$fstrequestuserDetail=$this->Custom->user_details($fstquestionUserid);
												$fstcountyID=$fstrequestuserDetail['country_id'];
												$fstqcountyName=$this->Custom->region_nm($fstcountyID);
												$fstlocationID=$fstrequestuserDetail['locality_id'];
												$fstqlocationName=$this->Custom->location_nm($fstlocationID);
												$fstis_facebook=$fstrequestuserDetail['is_facebook'];
												$fstfbid=$fstrequestuserDetail['fb_id'];
												$fstprofile_img=$fstrequestuserDetail['profile_img'];
												$fstrquestion=$request_qstFirst['ParkQuestion']['question'];
												$fstrcreated=$request_qstFirst['ParkQuestion']['created'];
												$rqstmemberDetail=$this->Custom->BapCustUniMembership($fstquestionUserid);
												$request_questionsec=$this->Custom->parkReplylist($fstrqid);
												$fparksQuestImgRes=$this->Custom->BapCustuniparkQuestImg($fstrqid);
												
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
																		$path =$base_url.'files/profileimg/40X40_'.$fstprofile_img;
																	if (file_exists($path)) {
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
	                                                    <?php if(!empty($fparksQuestImgRes)){
	                                                    		foreach($fparksQuestImgRes as $fparksQuestImgResult){
	                                                    			$fparkQuestImgPath=$base_url."files/parkquestion/".$fparksQuestImgResult['ParksquestionImage']['img_file'];
			                                                    	?>
															        <div class="col-lg-3 blockimg23" style="height: auto;">
					                                                    <a href="<?=$fparkQuestImgPath?>" target="_blank"><img src="<?=$fparkQuestImgPath?>" alt="" style="height: auto;"></a>
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
												 $secrqid=$request_questionSecond['ParkQuestion']['qid'];
												$secquestionUserid=$request_questionSecond['ParkQuestion']['user_id'];
												$secParent=$request_questionSecond['ParkQuestion']['parent'];
												$secparentQst=$this->Custom->parentparkDetail($secParent);
												$secparentUser=$secparentQst['ParkQuestion']['user_id'];
												$secrequestuserDetail=$this->Custom->user_details($secquestionUserid);
												$seccountyID=$secrequestuserDetail['country_id'];
												$secqcountyName=$this->Custom->region_nm($seccountyID);
												$seclocationID=$secrequestuserDetail['locality_id'];
												$secqlocationName=$this->Custom->location_nm($seclocationID);
												$secis_facebook=$secrequestuserDetail['is_facebook'];
												$secfbid=$secrequestuserDetail['fb_id'];
												$secprofile_img=$secrequestuserDetail['profile_img'];
												$secrquestion=$request_questionSecond['ParkQuestion']['question'];
												$secrcreated=$request_questionSecond['ParkQuestion']['created'];
												$secrqstmemberDetail=$this->Custom->BapCustUniMembership($secquestionUserid);
												$request_questionTrd=$this->Custom->parkReplylist($secrqid);
												$secparksQuestImgRes=$this->Custom->BapCustuniparkQuestImg($secrqid);
											?>
                                             <!--  Step  3 List  -->
                                            <div class="message_content Answer_step_two">
                                                <div class="step_arrow"></div>
                                                <div class="message_top">
                                                    <div class="col-lg-12 paid_seller">
                                                        <div class="row">
                                                            <div class="col-lg-1" style="width:40px;">
                                                                <div class="row">
                                                                    <?php if($secprofile_img!=''){
																		
																	if (file_exists('files/profileimg/40X40_'.$secprofile_img)) {
																	$secprofile_img_path = $base_url.'files/profileimg/40X40_'.$secprofile_img;
																	}else{
																	$secprofile_img_path = $base_url.'files/profileimg/'.$secprofile_img;
																	}
																		?>
                                                                <img src="<?php echo $secprofile_img_path;?>" height="40" width="40">
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
			                                                    <?php if(!empty($secparksQuestImgRes)){
			                                                    		foreach($secparksQuestImgRes as $secparksQuestImgResult){
			                                                    			$secparkQuestImgPath=$base_url."files/parkquestion/".$secparksQuestImgResult['ParksquestionImage']['img_file'];
					                                                    	?>
																	        <div class="col-lg-3 blockimg23" style="height: auto;">
							                                                    <a href="<?=$secparkQuestImgPath?>" target="_blank"><img src="<?=$secparkQuestImgPath?>" alt="" style="height: auto;"></a>
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
												 $trdrqid=$request_questionThird['ParkQuestion']['qid'];
												$trdquestionUserid=$request_questionThird['ParkQuestion']['user_id'];
												$trdParent=$request_questionThird['ParkQuestion']['parent'];
												$trdparentQst=$this->Custom->parentparkDetail($trdParent);
												$trdparentUser=$trdparentQst['ParkQuestion']['user_id'];
												$trdrequestuserDetail=$this->Custom->user_details($trdquestionUserid);
												$trdcountyID=$trdrequestuserDetail['country_id'];
												$trdqcountyName=$this->Custom->region_nm($trdcountyID);
												$trdlocationID=$trdrequestuserDetail['locality_id'];
												$trdqlocationName=$this->Custom->location_nm($trdlocationID);
												$trdis_facebook=$trdrequestuserDetail['is_facebook'];
												$trdfbid=$trdrequestuserDetail['fb_id'];
												$trdprofile_img=$trdrequestuserDetail['profile_img'];
												$trdrquestion=$request_questionThird['ParkQuestion']['question'];
												$trdrcreated=$request_questionThird['ParkQuestion']['created'];
												$trdrqstmemberDetail=$this->Custom->BapCustUniMembership($trdquestionUserid);
												//$request_questiontrd=$this->Custom->requestReplylist($secrqid);
												$trdparksQuestImgRes=$this->Custom->BapCustuniparkQuestImg($trdrqid);

											?>
                                             <!--  Step  4 List  -->
                                            <div class="message_content Answer_step_three">
                                                <div class="step_arrow"></div>
                                                <div class="message_top">
                                                    <div class="col-lg-12 paid_seller">
                                                        <div class="row">
                                                            <div class="col-lg-1" style="width:40px;">
                                                                <div class="row">
                                                                    <?php if($trdprofile_img!=''){
																	if (file_exists('files/profileimg/40X40_'.$trdprofile_img)) {
																	$trdprofile_img_path = $base_url.'files/profileimg/40X40_'.$trdprofile_img;
																	}else{
																	$trdprofile_img_path = $base_url.'files/profileimg/'.$trdprofile_img;
																	}
																		?>
                                                                <img src="<?php echo $trdprofile_img_path;?>" height="40" width="40">
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
			                                                    <?php if(!empty($trdparksQuestImgRes)){
			                                                    		foreach($trdparksQuestImgRes as $trdparksQuestImgResult){
			                                                    			$trdparkQuestImgPath=$base_url."files/parkquestion/".$trdparksQuestImgResult['ParksquestionImage']['img_file'];
					                                                    	?>
																	        <div class="col-lg-3 blockimg23" style="height: auto;">
							                                                    <a href="<?=$trdparkQuestImgPath?>" target="_blank"><img src="<?=$trdparkQuestImgPath?>" alt="" style="height: auto;"></a>
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
                                <!--question form start-->
                            <div class="message_text bg_grey post_offer_message" id="showquestion" <?php if(!isset($this->request->data['question'])){?> style="display:none"<?php }?>><div class="datascl">
            <h2>Intrebare Despre Park</h2>
            <br>
            <div class="product_section product_shipping">
              <p>
                <?php echo QUESTIOONONTHISNOTICE;?>
              </p>
            </div>
            
            <div class="clearfix"></div>
            
            <h5>întrebare</h5>
            
            <div class="highlight">
                <div class="col-lg-7">
                    <div class="row">
                    
                        <?php echo $this->Form->create('ParkQuestion', array('id' => 'salesquestion', 'enctype' => 'multipart/form-data')); ?>
                       
                           <?php
						echo $this->Form->input('question', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));
						
						echo $this->Form->input('park_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$park_id));
						echo $this->Form->input('park_type', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$add_type));
						echo $this->Form->input('parent', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control'));
						
						?>
                          <div class="clear" style="height:20px"></div>
                          <?php
						echo $this->Form->input('img_files', array('label' => false, 'type' => 'file', 'multiple' => 'multiple', 'name' => 'data[ParkQuestion][img_files][]', 'div' => false, 'class' => 'form-control', 'style' => 'width:50%'));
						?>
						<span><i>(Maximum 8 Image allow to upload)</i></span>
                          <div class="clear" style="height:20px"></div>
                          <div class="captch">
                              <img src="<?php echo $base_url;?>captcha/captcha_code_file.php?rand=<?php echo rand();?>" id="captchaimg">
                              
                          <input type="text" class="required form-control" id="code" name="code">
                          </div>
                          <div class="clear10"></div>
                          <input type="hidden" name="park_user_id" value="<?php echo $user_id;?>" />
                          <button type="submit" name="question" class="btn gbutton6"><?php echo ASKQUESTION;?></button>
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
											  <input type="submit" name="question" class="btn btn-success" value="<?php echo LOGIN;?>">
											  
											  <div class="clearfix"></div>
											  <br>
											  <div class="form-group">
												<label for="exampleInputEmail2"><?php echo LOGINFACEBOOKACCOUNT;?></label>
												<br>
												<fb:login-button scope="public_profile,email" class="faacebook_suctomCL" onlogin="checkLoginState('innerpg');">
<?php echo FBLOGIN;?>
</fb:login-button>&nbsp;<span id="innerfbloader"></span>
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
            
        </div></div>
        					<!--question form end-->
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