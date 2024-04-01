<?php
echo $this->element('header-home');
//pr($this->request->data);exit;
$user=$this->Custom->user_details($userid);
$countyname=$this->Custom->region_nm($user['country_id']);
$city=$this->Custom->location_nm($user['locality_id']);
$memdetails=$this->Custom->BapCustUniMembership($user['user_id']);
if(!empty($memdetails))
{
	$memplan=$memdetails['UserMembership']['memb_type'];
	$memimg=$base_url.'files/memberplanimg/'.$memdetails['UserMembership']['plan_img'];
}
else
{
	$memplan='';
	$memimg=$base_url.'images/no-image.jpg';
}
//pr($userRating);

?>
    <div class="container">
		<div class="row">
					
			<div class="innerpanel">
            <div class="clear10"></div>
            	<div id="breadcrumb">
                  <ul class="crumbs">
                    <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span><?php echo DASHBOARD;?></a> </li>
                    <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo MYRATING;?></a></li>
              	</ul>
           	 </div>
                  <div class="clear15"></div>
                  
            <div class="col-lg-12 col-sm-12 col-xs-12">
            
                <div class="row"><div role="tabpanel">
                    
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo ALLPOSITIVERECIVE;?></a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php echo ALLNETURALRECIVE;?></a></li>
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><?php echo ALLNEGATIVERECIVE;?></a></li>
                      </ul>
                    
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                             <div id="listing_items">
							<table cellpadding="0" cellspacing="0" class="tab-content">
								<tbody>
									<tr class="listing_header">
									  <td width="30%"><?php echo NOTICE;?></td>
									  <td align="center" width="20%"><?php echo SALECLERK;?></td>
                                      <td align="center" width="20%"><?php echo RECIVEFROM;?></td>
									  <td align="center" width="20%"><font><font><?php echo RATINGS;?></font></font></td>
										<td align="center" width="10%"><font><font><?php echo GRADE;?></font></font></td>
                                        
									</tr>
									<?php
								if(!empty($allpositivegrade))
								{
													
									foreach($allpositivegrade as $userRatingRes)
									{
										$totuserrating=$userRatingRes['UserRating']['productdescribedval']+$userRatingRes['UserRating']['communicationval']+$userRatingRes['UserRating']['deliverytimeval']+$userRatingRes['UserRating']['cost_of_transportval'];
										$avgrating=$totuserrating/4;
										?>
									<tr class="tbl_data">
										<td>
										<?php
										$advid=$userRatingRes['UserRating']['adv_id'];
										$advdetail=$this->Custom->BapCustUniAdvDetail($advid);
										?>
										<a href="javascript:void(0);" onclick="saveView(<?php echo $advid;?>,'<?php echo $base_url.'pages/sales-details/'.$advdetail['PostAd']['slug'];?>');" target="_blank"><?php echo $advdetail['PostAd']['adv_name'];?></a>
									  </td>
										<td>
												
									<?php
									$ads_userid=$advdetail['PostAd']['user_id'];
									$ad_user=$this->Custom->user_details($ads_userid);
									?>
									<a href="<?php echo $base_url.'pages/user-profiles/'.$ads_userid;?>" target="_blank"><?php echo $ad_user['first_name'].' '.$ad_user['last_name'];?></a>
									  </td>
									<td align="center">
									<?php echo ($userRatingRes['UserRating']['rating_type']==1)? "Buyer" : "Seller";?>:
									<?php
									$rateuserid=$userRatingRes['UserRating']['from_user_id'];
									$rateuser=$this->Custom->user_details($rateuserid);
									?>
									<a href="<?php echo $base_url.'pages/user-profiles/'.$rateuserid;?>" target="_blank"><?php echo $rateuser['first_name'].' '.$rateuser['last_name'];?></a>
									</td>
									<td align="center"><?php 
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
                    ?></td>
                                    <td>
                                 <div class="tbl_data_sign">
                                <?php if($userRatingRes['UserRating']['grade']==1){?>		
                                <span class="fdbk_sign positive"></span>
                                <?php }else if($userRatingRes['UserRating']['grade']==0){?>
                                <span class="fdbk_sign neutral"></span>
                                <?php }else if($userRatingRes['UserRating']['grade']==-1){?>
                                <span class="fdbk_sign negative"></span>
                                <?php }?>
                                        </div>	
									  </td>
                                      </tr>
									<?php } }else{?>
                               <tr>
                              <td colspan="5"> <?php echo NORESULTWEREFOUND;?></td>
                               </tr>
                               <?php }?>
		
                                    
								</tbody>
							</table>
						</div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                        <div id="listing_items">
							<table cellpadding="0" cellspacing="0" class="tab-content">
								<tbody>
									<tr class="listing_header">
									  <td width="30%"><?php echo NOTICE;?></td>
									  <td align="center" width="20%"><?php echo SALECLERK;?></td>
                                      <td align="center" width="20%"><?php echo RECIVEFROM;?></td>
									  <td align="center" width="20%"><font><font><?php echo RATINGS;?></font></font></td>
										<td align="center" width="10%"><font><font><?php echo GRADE;?></font></font></td>
                                        
									</tr>
									<?php
								if(!empty($allneutralgrade))
								{
									
									foreach($allneutralgrade as $receivedthesellerRes)
									{
										$selleradvdetail=$this->Custom->BapCustUniAdvDetail($selleradvid);
										if(isset($selleradvdetail['PostAd']))
										{
										$thesellerrating=$receivedthesellerRes['UserRating']['productdescribedval']+$receivedthesellerRes['UserRating']['communicationval']+$receivedthesellerRes['UserRating']['deliverytimeval']+$receivedthesellerRes['UserRating']['cost_of_transportval'];
										$selleravgrating=$thesellerrating/4;
										?>
									<tr class="tbl_data">
										<td>
										<?php
										$selleradvid=$receivedthesellerRes['UserRating']['adv_id'];
										$selleradvdetail=$this->Custom->BapCustUniAdvDetail($selleradvid);
										if(isset($selleradvdetail['PostAd']))
										{
										?>
										<a href="javascript:void(0);" onclick="saveView(<?php echo $selleradvid;?>,'<?php echo $base_url.'pages/sales-details/'.$selleradvdetail['PostAd']['slug'];?>');" target="_blank"><?php echo $selleradvdetail['PostAd']['adv_name'];?></a>
									 <?php
										}
									  ?>
                                      </td>
                                      
										<td>
												
									<?php
									$sellerads_userid=$selleradvdetail['PostAd']['user_id'];
									$sellerad_user=$this->Custom->user_details($sellerads_userid);
									if(isset($selleradvdetail['PostAd']))
									{
										?>
									<a href="<?php echo $base_url.'pages/user-profiles/'.$sellerads_userid;?>" target="_blank"><?php echo $sellerad_user['first_name'].' '.$sellerad_user['last_name'];?></a>
                                    <?php }?>
									  </td>
									<td align="center">
									<?php echo ($receivedthesellerRes['UserRating']['rating_type']==1)? "Buyer" : "Seller";?>:
									<?php
									$sellerrateuserid=$receivedthesellerRes['UserRating']['from_user_id'];
									$sellerrateuser=$this->Custom->user_details($sellerrateuserid);
									?>
									<a href="<?php echo $base_url.'pages/user-profiles/'.$sellerrateuserid;?>" target="_blank"><?php echo $sellerrateuser['first_name'].' '.$sellerrateuser['last_name'];?></a>
									</td>
									<td align="center"><?php 
                    if(!empty($selleravgrating))
                    {
						for($sellersingrating=1; $sellersingrating<=round($selleravgrating); $sellersingrating++)
						{
							if($sellersingrating>$selleravgrating)
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
					if(round($selleravgrating)<5)
					{
						for($sellersingavg=5; round($selleravgrating)<$sellersingavg; $sellersingavg--)
						{
							?>
                            <img border="0" src="<?php echo $base_url;?>/images/star-small-inactive.png">   
                            <?php
						}
					}
                    ?></td>
                                    <td>
                                 <div class="tbl_data_sign">
                                <?php if($receivedthesellerRes['UserRating']['grade']==1){?>		
                                <span class="fdbk_sign positive"></span>
                                <?php }else if($receivedthesellerRes['UserRating']['grade']==0){?>
                                <span class="fdbk_sign neutral"></span>
                                <?php }else if($receivedthesellerRes['UserRating']['grade']==-1){?>
                                <span class="fdbk_sign negative"></span>
                                <?php }?>
                                        </div>	
									  </td>
                                       </tr>
									<?php }}}else{?>
                               <tr>
                              <td colspan="5"> <?php echo NORESULTWEREFOUND;?></td>
                               </tr>
                               <?php }?>
		
                                    
								</tbody>
							</table>
						</div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="messages">
                        <div id="listing_items">
							<table cellpadding="0" cellspacing="0" class="tab-content">
								<tbody>
									<tr class="listing_header">
									  <td width="30%"><?php echo NOTICE;?></td>
									  <td align="center" width="20%"><?php echo SALECLERK;?></td>
                                      <td align="center" width="20%"><?php echo RECIVEFROM;?></td>
									  <td align="center" width="20%"><font><font><?php echo RATINGS;?></font></font></td>
										<td align="center" width="10%"><font><font><?php echo GRADE;?></font></font></td>
                                        
									</tr>
									<?php
								if(!empty($allnegativegrade))
								{
									foreach($allnegativegrade as $raceiveasbuyerRes)
									{
										$totbuyerrating=$raceiveasbuyerRes['UserRating']['productdescribedval']+$raceiveasbuyerRes['UserRating']['communicationval']+$raceiveasbuyerRes['UserRating']['deliverytimeval']+$raceiveasbuyerRes['UserRating']['cost_of_transportval'];
										$buyeravgrating=$totbuyerrating/4;
										?>
									<tr class="tbl_data">
										<td>
										<?php
										$buyeradvid=$raceiveasbuyerRes['UserRating']['adv_id'];
										$buyeradvdetail=$this->Custom->BapCustUniAdvDetail($buyeradvid);
										?>
										<a href="javascript:void(0);" onclick="saveView(<?php echo $buyeradvid;?>,'<?php echo $base_url.'pages/sales-details/'.$buyeradvdetail['PostAd']['slug'];?>');" target="_blank"><?php echo $buyeradvdetail['PostAd']['adv_name'];?></a>
									  </td>
										<td>
												
									<?php
									$buyerads_userid=$buyeradvdetail['PostAd']['user_id'];
									$buyerad_user=$this->Custom->user_details($buyerads_userid);
									?>
									<a href="<?php echo $base_url.'pages/user-profiles/'.$buyerads_userid;?>" target="_blank"><?php echo $buyerad_user['first_name'].' '.$buyerad_user['last_name'];?></a>
									  </td>
									<td align="center">
									<?php echo ($raceiveasbuyerRes['UserRating']['rating_type']==1)? "Buyer" : "Seller";?>:
									<?php
									$buyerrateuserid=$raceiveasbuyerRes['UserRating']['from_user_id'];
									$buyerrateuser=$this->Custom->user_details($buyerrateuserid);
									?>
									<a href="<?php echo $base_url.'pages/user-profiles/'.$buyerrateuserid;?>" target="_blank"><?php echo $buyerrateuser['first_name'].' '.$buyerrateuser['last_name'];?></a>
									</td>
									<td align="center"><?php 
                    if(!empty($buyeravgrating))
                    {
						for($buyersingavgrating=1; $buyersingavgrating<=round($buyeravgrating); $buyersingavgrating++)
						{
							if($buyersingavgrating>$buyeravgrating)
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
					if(round($buyeravgrating)<5)
					{
						for($buyersingavg=5; round($buyeravgrating)<$buyersingavg; $buyersingavg--)
						{
							?>
                            <img border="0" src="<?php echo $base_url;?>/images/star-small-inactive.png">   
                            <?php
						}
					}
                    ?></td>
                                    <td>
                                 <div class="tbl_data_sign">
                                <?php if($raceiveasbuyerRes['UserRating']['grade']==1){?>		
                                <span class="fdbk_sign positive"></span>
                                <?php }else if($raceiveasbuyerRes['UserRating']['grade']==0){?>
                                <span class="fdbk_sign neutral"></span>
                                <?php }else if($raceiveasbuyerRes['UserRating']['grade']==-1){?>
                                <span class="fdbk_sign negative"></span>
                                <?php }?>
                                        </div>	
									  </td>
                                      </tr>
									<?php }}else{?>
                               <tr>
                              <td colspan="5"> <?php echo NORESULTWEREFOUND;?></td>
                               </tr>
                               <?php }?>
		
                                    
								</tbody>
							</table>
						</div>
                        </div>
                      </div>
                    
                    </div></div>  
            </div>
            
            
          <div class="clear15"></div>  
            </div>
          </div>
      </div>
<?php
echo $this->element('footer-home');
?>