
<div class="innerpanel">
				<!-- Left Sidebar Start -->
					<div class="col-md-12 prof">
						 <div class="clearfix" style="height:15px;"></div>
						 
                         <div id="breadcrumb">
                            <ul class="crumbs">
                                <li class="first">
                                	<a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span>Dashboard</a>
                                </li>
								<li class="first">
                                	<a style="z-index:9;" href="<?php echo $base_url;?>RequestParts"><span></span>My Request Parts</a>
                                </li>
                                <li class="last"><a style="z-index:7;" href="javascript:void(0);">User Response</a></li>   
                            </ul>
                        </div>
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        <?php 
							
							$brand_name=$this->Custom->brand_nm($req_dtl['brand_id']);
							$model_name=$this->Custom->brand_nm($req_dtl['model_id']);
							$user_dtl=$this->Custom->user_details($req_dtl['user_id']);
							//pr($req_dtl);
							$c_date=date_create($user_dtl['created']);
							$now=date_create(date('Y-m-d h:i:s'));
							$diff=date_diff($c_date,$now);
							?>
						<h2 class="detailstitle1" style="color:#DF5E08"><?php echo $brand_name.' '.$model_name; ?>	</h2>
                        
                        <div class="clearfix" style="height:15px;"></div>

						 <div class="col-lg-12">
                         	<div class="row cereri">
                            	
                               <div class="user_header">
                                  <div class="user_data_left">
                                    <div class="feedback">
                                      <b>
                                      <font>
                                      <font>
                                      This user has no ratings
                                      </font>
                                      </font>
                                      </b>
                                    </div>
                                    <span class="user_feedback_btn">
                                    <span class="owner_label">
                                    <font>
                                    <font>
                                    <?php echo $this->Custom->user_type($user_dtl['user_type_id'])?>:
                                    </font>
                                    </font>
                                    </span>
                                    <span class="username">
                                    <font>
                                    <font>
                                   <?php echo $user_dtl['first_name'].' '.$user_dtl['last_name'];?>
                                    </font>
                                    </font>
                                    </span>
                                    <span class="user_stars">
                                    <span class="user_star stars_green">
                                    </span>
                                    <font>
                                    <font>
                                    <?php echo $this->Custom->userProfileResult($user_dtl['user_id']);?>
                                    </font>
                                    </font>
                                    </span>
                                    <span class="user_ribbon ">
                                    <span class="ribbon_percent">
                                    <font>
                                    <font>
                                    <?php echo $this->Custom->userAllPositivePercent($user_dtl['user_id']);?>%
                                    </font>
                                    </font>
                                    </span>
                                    <span class="ribbon_label">
                                    <font>
                                    <font>
                                    positive ratings
                                    </font>
                                    </font>
                                    </span>
                                    <span class="ribbon_info" title="If the buyer has a lower percentage of 100% means that has negative ratings.  The percentages below 90% may indicate a problem.  Read explanation NEGATIVE ratings received by the buyer before making an offer.">
                                    </span>
                                    </span>
                                    </span>
                                  </div>
                                  <div class="other_data">
                                    <div class="member_from">
                                      <font>
                                      <font>
                                      Member for
                                      </font>
                                      </font>
                                      <b>
                                      <?php if($diff->m){?>
                                      <font>
                                      <font>
                                      <?php 
									  if($diff->y){
										  $mon=$diff->y*12 + $diff->m;
										  }else{
											   $mon=$diff->m;
											  }
									  echo $mon;?>
                                      </font>
                                      </font>
                                      </b>
                                      <font>
                                      <font>
                                      months and
                                      </font>
                                      </font>
                                      <?php } ?>
                                      <b>
                                       <?php if($diff->d){?>
                                      <font>
                                      <font>
                                      <?php echo $diff->d;?>
                                      </font>
                                      </font>
                                      </b>
                                      <font>
                                      <font>
                                      days
                                      </font>
                                      </font>
                                         <?php } ?>
                                    </div>
                                    <div class="cereri_nr">
                                    <?php $request_count=$this->Custom->count_bid_type($parts_id);
									$req_status=array(0=>'Approved',1=>'Winning',2=>'Cancel');
									//pr(array_sum($request_count));
									?>
                                      <b>
                                      <font>
                                      <font>
                                      <?php if(count($request_count)){echo array_sum($request_count);}else{ echo 0;}?>
                                      </font>
                                      </font>
                                      </b>
                                      <font>
                                      <font>
                                      requests /
                                      </font>
                                      </font>
                                      <span title="Requests that have received offers but the buyer has canceled">
                                      <b>
                                      <font>
                                      <font>
                                      <?php if(isset($request_count[2])){echo $request_count[2];}else{ echo 0;} ?>
                                      </font>
                                      </font>
                                      </b>
                                      <font>
                                      <font>
                                      Cancelled
                                      </font>
                                      </font>
                                      </span>
                                      <font>
                                      <font>
                                      /
                                      </font>
                                      </font>
                                      <b>
                                      <font>
                                      <font>
                                      <?php if(isset($request_count[1])){echo $request_count[1];}else{ echo 0;} ?>
                                      </font>
                                      </font>
                                      </b>
                                      <font>
                                      <font>
                                      with winner
                                      </font>
                                      </font>
                                    </div>
                                  </div>
                                  <span class="separator" style="float:right;">
                                  </span>
                                  <div class="clearing">
                                  </div>
                                </div>
                                
                               <div class="clear" style="height:20px;"></div> 
                               
                                
                                  <div class="description">
                                    <font>
                                    <font>
                                    Both leaving the compressor
                                    </font>
                                    </font>
                                  </div>
                                  
                                  <p class="description_others location" title="Customer Bucharest">
                                    <b>
                                    <font>
                                    <font>
                                    <?php 
									if($this->Custom->region_nm($req_dtl['county'])){
										echo $this->Custom->region_nm($req_dtl['county']).',';
										}
										if($this->Custom->location_nm($req_dtl['city'])){
										echo $this->Custom->location_nm($req_dtl['city']);
										}
								     ?>
                                    </font>
                                    </font>
                                    </b>
                                  </p>
                                  <div class="cerere_status_wrapper ">
                                    <div class="top">
                                      <div class="left">
                                        <div class="status">
                                          <span class="active">
                                          </span>
                                          <font>
                                          <font>
										  <?php 
										  $status=array(0=>'Pending',1=>'Active',2=>'Solved',3=>'Inactive');
										  echo 'Application is '.$status[$req_dtl['status']];
										  ?>
                                          
                                          </font>
                                          </font>
                                        </div>
                                      </div>
                                      
                                      <div class="clearing">
                                      </div>
                                    </div>
                                    <div class="bottom">
                                      <div class="left">
                                        <span>
                                        </span>
                                        <font>
                                        <font>
										<?php 
										$requestdate=$this->Custom->Bap_cust_uni_time_since($req_dtl['created']);
										echo 'Posted '.$requestdate;
										?>
                                        
                                        </font>
                                        </font>
                                      </div>
                                      <div class="center">
                                        <span>
                                        </span>
                                        <font>
                                        <font>
										<?php 
										echo 'Updated '.$this->Custom->Bap_cust_uni_time_since($req_dtl['modified']);
										?>
                                        
                                        </font>
                                        </font>
                                      </div>
                                      
                                      <div class="clearing">
                                      </div>
                                    </div>
                                  </div>
                            
                            
                                
                               <div class="clearfix" style="height:10px;"></div> 
                               
								
                            </div>
                            <div class="clearfix" style="height:1px;"></div>
                            
                           <div class="row">
                            	<h2 class="detailstitle1"><font><font class="">Data about Request</font></font></h2>
                            	<div class="clearfix" style="height:10px;"></div>
                                
                               <div class="car_data">
                                <div class="item">
                                    <div class="label">
                                    <font>
                                      <font>
                                    Mărci
                                    </font>
                                      </font>
                                  </div>
                                    <div class="content">
                                    <font>
                                      <font>
                                    <?php echo $brand_name;?>
                                    </font>
                                      </font>
                                  </div>
                                 </div>
                                <div class="item">
                                    <div class="label">
                                    <font>
                                      <font>
                                    model
                                    </font>
                                      </font>
                                  </div>
                                    <div class="content">
                                    <font>
                                      <font>
                                   <?php echo $model_name;?>
                                    </font>
                                      </font>
                                  </div>
                                 </div>
                                 <div class="item">
                                    <div class="label">
                                    <font>
                                      <font>
                                    Motoare
                                    </font>
                                      </font>
                                  </div>
                                    <div class="content">
                                    <font>
                                      <font>
                                     <?php echo $req_dtl['engines'];?> 
                                    </font>
                                      </font>
                                  </div>
                                 </div>
                                
                                <div class="item">
                                    <div class="label">
                                    <font>
                                      <font>
                                    An
                                    </font>
                                      </font>
                                  </div>
                                    <div class="content">
                                    <font>
                                      <font>
                                    <?php echo $req_dtl['yr_of_manufacture'];?> 
                                    </font>
                                      </font>
                                  </div>
                                 </div>
                                
                                 <div class="item">
                                    <div class="label">
                                    <font>
                                      <font>
                                    Motoare
                                    </font>
                                      </font>
                                  </div>
                                    <div class="content">
                                    <font>
                                      <font>
                                     <?php echo $req_dtl['engines'];?> 
                                    </font>
                                      </font>
                                  </div>
                                 </div>
                                 <div class="item">
                                    <div class="label">
                                    <font>
                                      <font>
                                    versiune
                                    </font>
                                      </font>
                                  </div>
                                    <div class="content">
                                    <font>
                                      <font>
                                    <?php echo $req_dtl['version'];?>
                                    </font>
                                      </font>
                                  </div>
                                 </div>
                                 <div class="item">
                                    <div class="label">
                                    <font>
                                      <font>
                                    Serie Sasiu
                                    </font>
                                      </font>
                                  </div>
                                    <div class="content">
                                    <font>
                                      <font>
                                    
                                    <?php if(isset($req_dtl['vehicle_identy_no'])){echo $req_dtl['vehicle_identy_no'];}?>
                                    </font>
                                      </font>
                                  </div>
                                 </div>
                             </div>
                             
                             	<div class="clearfix" style="height:50px;"></div>
						
						<?php 
						$cnt=count($user_resp);
						if($cnt>0){
							$responseCount=1;
							?>
							<h2 class="detailstitle1"><font><font class="">Offer for <?php echo $brand_name.' '.$model_name; ?></font></font></h2>
                            <?php
						foreach($user_resp AS $user_response){
							//pr($user_response);
							$user_rsp=$user_response['BidOffer'];
							$bid_user_dtl=$this->Custom->user_details($user_rsp['user_id']);
							$bid_req_dtl=$this->Custom->reqPartDetails($user_rsp['request_id']);
							$part_dtl=$this->Custom->partsDetails($user_rsp['parts_id']);
							//pr($user_rsp);
							
							
							
							/*pr($user_dtl);
							pr($req_dtl);
							pr($part_dtl);*/
							?>
							 
                             	
                            	<div class="clearfix" style="height:10px;"></div>
                                
                                  <div class="message_item " style="padding-left:0px;">
                                      <div class="message_content" data-message-id="msg834359">
                                        <div id="msg834359">
                                          <a name="msg834359">
                                          </a>
                                          <div class="message_top" id="mess834359">
                                            <div class="paid_seller">
                                              <div class="medal medal_2">
                                              </div>
                                              <div class="seller_wrapper">
                                                <div class="seller_type">
                                                  <font>
                                                  <font>
                                                  From Gold
                                                  </font>
                                                  </font>
                                                </div>
                                                <div class="username">
                                                  <a href="#" title="View profile">
                                                  <font>
                                                  <font>
                                                  <?php echo $bid_user_dtl['first_name'].' '.$bid_user_dtl['last_name']; ?>
                                                  </font>
                                                  </font>
                                                  </a>
                                                </div>
                                                <span class="seller_chat chat_online">
                                                <font>
                                                <font>
                                                Online
                                                </font>
                                                </font>
                                                </span>
                                                <div class="clearing">
                                                </div>
                                                <span class="user_stars">
                                                <a href="#" title="View profile Otomobil">
                                                <span class="user_star stars_purple">
                                                </span>
                                                <font>
                                                <font>
                                                0
                                                </font>
                                                </font>
                                                </a>
                                                </span>
                                                <span class="user_ribbon ">
                                                <a href="#" title="View profile Otomobil">
                                                <span class="ribbon_percent">
                                                <font>
                                                <font>
                                                0%
                                                </font>
                                                </font>
                                                </span>
                                                <span class="ribbon_label">
                                                <font>
                                                <font>
                                                Positive Feedback
                                                </font>
                                                </font>
                                                </span>
                                                <span class="ribbon_info">
                                                </span>
                                                </a>
                                                </span>
                                                <div class="clearing">
                                                </div>
                                              </div>
                                            </div>
                                            <div>
                                            <?php
                                          $bid_status=array(0=>'Approved',1=>'Winning',2=>'Cancel');
										  $bid_id=$user_rsp['bid_id'];
										  $parts_id=$user_rsp['parts_id'];
										 // pr($bid_status);
										 
										  ?>
										  <select id='bid_status_id' name='bid_status' onchange="changeBidStatus(this.value,'<?php echo $bid_id;?>','<?php echo $parts_id;?>');" <?php if($user_rsp['status']==1){echo 'disabled';}?>>
										  <?php
										  foreach($bid_status AS $bid_key=>$bid_val){
											  ?>
											  <option value="<?php echo $bid_key;?>" <?php if($user_rsp['status']==$bid_key){echo 'selected';}?>><?php echo $bid_val;?></option>
											  <?php
											  }?>
											  </select>
											  <?php
											?>
                                            </div>
                                            <div class="seller_company">
                                              <div class="company_info">
                                                <div class="company_type">
                                                  <font>
                                                  <!--<font>
                                                  Park truck
                                                  </font>
-->                                                  </font>
                                                  <a href="#" title="Otomobile">
                                                  <font>
                                                  <font>
                                                  <?php echo $bid_user_dtl['first_name'].' '.$bid_user_dtl['last_name']; ?>
                                                  </font>
                                                  </font>
                                                  </a>
                                                </div>
                                                <div class="company_data">
                                                  <div class="company_location">
                                                    <span>
                                                    </span>
                                                    <font>
                                                    <font>
                                                  <?php 
									if($this->Custom->region_nm($bid_req_dtl['city'])){
										echo ' '.$this->Custom->region_nm($bid_req_dtl['city']);
										}
										if($this->Custom->location_nm($bid_req_dtl['county'])){
										echo '.'.$this->Custom->location_nm($bid_req_dtl['county']);
										}
								     ?>
                                                    </font>
                                                    </font>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="company_logo">
                                                <a href="#" title="Otomobile">
                                                <?php if($bid_user_dtl['profile_img']!='' && isset($bid_user_dtl['profile_img'])){
													?>
													<img src="<?php echo $base_url.'files/profileimg/'.$bid_user_dtl['profile_img'];?>" height="54" alt="Otomobile">
													<?php
													}else{?>
														<img src="<?php echo $base_url;?>images/noimage.jpg" height="54" alt="Otomobile">
														<?php }?>
                                                
                                                </a>
                                              </div>
                                            </div>
                                            <div class="clearing">
                                            </div>
                                          </div>
                                          <div class="message_text">
                                            <div class="sub_message_text_wrapper">
                                              <div class="msg_date">
                                                <font>
                                                <font>
                                                <?php echo date('F m, Y, h:i',strtotime($user_rsp['created']));?>
                                                
                                                </font>
                                                </font>
                                              </div>
                                              
                                              <div class="oferta">
                                                <font>
                                                <font>
                                                Offer
                                                </font>
                                                </font>
                                                <span>
                                                <font>
                                                <font>
                                                of
                                                </font>
                                                </font>
                                                <b>
                                                <font>
                                                <font>
                                               <?php echo $user_rsp['piece'];?>
                                                </font>
                                                </font>
                                                </span>
                                              </div>
                                            </div>
                                            
											
											<div class="clear" style="height:5px;"></div>
											
											
											
                                            <div id="Accordion<?php echo $responseCount;?>" class="Accordion" tabindex="0">
                                              <div class="AccordionPanel">
                                                <div class="AccordionPanelTab">Pictures</div>
                                                <div class="AccordionPanelContent pic_div">
                                                    
                                                     <div class="clear15"></div>
                                                         <?php 
														 $bid_img=$this->Custom->bidImg($user_rsp['bid_id']);
														// pr($bid_img);
														 if(count($bid_img)>=1){	 
														 foreach($bid_img AS $img_key=>$img_val){
															 ?>
														 <div class="col-lg-2 col-sm-2 col-xs-3">
														  <div class="row">
                                                              <img src="<?php echo $base_url.'files/bidimg/'.$img_val;?>" />
                                                                </div>
                                                         </div>
														 <?php }
														 }else{
															 ?>
															  <div class="col-lg-2 col-sm-2 col-xs-3">
														  <div class="row">
                                                              No Image Present
                                                                </div>
                                                         </div>
															 <?php
															
															 }
						
														 ?>
                                                </div>
                                              </div>
                                              <div class="AccordionPanel">
                                                <div class="AccordionPanelTab">Shipping & Payment</div>
                                                <div class="AccordionPanelContent">
                                                     <div class="clearing"></div>
                                                     <div class="description_head">Delivery : <?php 
													
			$dm='';
		if($user_rsp['personal_teaching']==1){
			$dm.= 'Personal Teaching,';
		}	
		if($user_rsp['courier']==1){
			if($user_rsp['free_courier']==1){
			$dm.= 'Courier (Free),';
			}else{
				$dm.= "Courier (".$user_rsp['courier_cost']." RON),";
			}
		}	
		if($user_rsp['roman_mail']){
			
			if($user_rsp['free_roman_mail']==1){
			$dm.= 'Romanian Mail (Free)';
			}else{
				$dm.= "Romanian Mail (".$user_rsp['romanian_mail_cost']." RON)";
			}
		}
		echo trim($dm,',');
													 
													 ?></div>
                                                     <div class="msg_price_group ch_delivery">
                    
                    <div class="clear10"></div>
                    <div class="description_head">Payment Methods : <?php echo $user_rsp['payment_method'];?></div>
                
                <div class="msg_price_group ch_delivery">
                
                     
                </div>
                 
					<div class="clear10"></div>
                </div>
                <div class="msg_price_group ch_delivery">
                    
                    <div class="clear10"></div>
                    <div class="description_head">Garanție & Valabilitate : <?php echo $user_rsp['warranty'].' ('.$user_rsp['validity'].')';?></div>
                
                <div class="msg_price_group ch_delivery">
                
                     
                </div>
                 
					<div class="clear10"></div>
                </div>
                <div class="msg_price_group ch_delivery">
                    
                    <div class="clear10"></div>
                    <div class="description_head">Doriti piesa : <?php echo $user_rsp['offers'];?></div>
                
                <div class="msg_price_group ch_delivery">
                
                     
                </div>
                 
					<div class="clear10"></div>
                </div>
                                                </div>
                                              </div>
                                             <!-- <div class="AccordionPanel">
                                                <div class="AccordionPanelTab">Warranty & Return</div>
                                                <div class="AccordionPanelContent">Content 3</div>
                                              </div>
                                              <div class="AccordionPanel">
                                                <div class="AccordionPanelTab">View phone</div>
                                                <div class="AccordionPanelContent">Content 4</div>
                                              </div>-->
                                            </div>
<div class="clear" style="height:25px;"></div>
											
                                          </div>
                                          <div class="clearing">
                                          </div>
                                        </div>
                                        <div class="clearing">
                                        </div>
                                        <div class="clearing">
                                        </div>
                                      </div>
                                      <div class="clearing">
                                      </div>
                                    </div>
                                
                                
                           </div>
                            
                         </div>
						 
						 
                         
                         
                        <div class="clear"></div>
							
							<?php 
							$responseCount++;
						}
							}?>
                        
                        
					</div>
				<!-- Left Sidebar End -->
				
				
				<div class="clearfix" style="height:1px;"></div>
                
                
                <div class="col-lg-12">
   
        	<div style="padding-left:0px;" data-project_id="502172291" data-message-id="517199" class="message_item">
      <div data-project_id="502172291" data-message-id="517199" class="message_content ">
      <?php 
	  $question=$this->Custom->getQuestion($req_dtl['request_id']);
	  //pr($question);
	  if(count($question)>0){
		  foreach( $question AS $qst){
			  $qstion=$qst['RequestQuestion'];
			 
			 ?>
			  <div id="msg517199"> <a name="msg517199"></a>
          <div id="mess517199" class="message_top"> <span class="message_cumparator">Cumpărător: </span> <span class="message_user_link"> <a title="" href="#"> <?php 
		  $user=$this->Custom->user_details($qstion['user_id']);
		  echo $user['first_name']." ".$user['last_name'];
		  
		  ?> </a> <span class="user_stars2"> <a title="Mergi la profilul utilizatorului KULA" href="#"> <span class="user_star stars_green"></span> &nbsp;  </a> </span> <span class="localization"> <?php echo $this->Custom->location_nm($user['locality_id'])?>            	                 	                 	                 	     </span> </span>
          <!--<span class="message_date" style="float: right; margin-top:2px;" >18-12-2014 11:33:48</span>-->
          		   <span style="float: right; margin-top:2px;" class="message_date"><?php echo date('d-m-Y h:i:s',strtotime($qstion['created']));?></span> <span style="float:right; margin-right:159px; margin-top:-30px; position:relative;" class="message_text"><a style="text-decoration:none; cursor:pointer;" href="javascript:void(0)" onclick="askQuestion('<?php echo $qstion['question_id'];?>');">Reply</a></span>
                  
		
		  		  
            <div class="clearing"></div>
          </div>
          <div class="message_text">
            <div style="padding:0 0 5px 0;"> Question : <?php echo $qstion['description'];?> </div>
            <?php $reply=$this->Custom->getQuestion($req_dtl['request_id'],$qstion['question_id']);
			//pr($reply);
			if(count($reply) >0 && !empty($reply)){
			foreach($reply AS $qreply){
				$rply=$qreply['RequestQuestion'];
				?>
				 <div style="padding:0 0 5px 0;">Reply : <?php echo $rply['description'];?> </div>
				<?php
				}
			}
			 ?>
           
          </div>
        </div>
        
        
        <div class="clear"></div>
         <div class="message_text bg_grey post_offer_message" id="showquestion_<?php echo $qstion['question_id'];?>" style='display:none' ><div class="datascl">
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
                    
                        <?php echo $this->Form->create('RequestQuestion',array('url' => array('controller' => 'RequestParts', 'action' => 'addReply'))); ?>
                       
                           <?php
						echo $this->Form->input('description', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));
						echo $this->Form->input('request_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$qstion['request_id']));
						echo $this->Form->input('parent', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$qstion['question_id']));
						echo $this->Form->input('parts_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$qstion['parts_id']));
						?>
                          <div class="clear" style="height:20px"></div>
                         <!-- <div class="captch">
                              <img src="<?php echo $base_url;?>captcha/captcha_code_file.php?rand=<?php echo rand();?>" id="captchaimg">
                              
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
                          <button type="submit" name="question" class="btn gbutton6">Submit the Answar</button>
                           <?php
					 /* if(isset($openlogin) && $openlogin='yes')
					  {
						  ?>
                         <!----> <div id="openlogin form-inline">
						      
											  <div class="form-group">
												<label for="exampleInputName2">User Id</label>
												&nbsp;&nbsp;
												 <input type="text" name="data[MasterUser][user_login_id]" class="form-control" id="MasterUserUserLoginId" />
											  </div>
											  <div class="form-group">
												&nbsp;&nbsp;&nbsp;&nbsp;
												<label for="exampleInputEmail2">Password</label>
												&nbsp;&nbsp;
												<input type="password" name="data[MasterUser][user_pass]"  id="MasterUserUserPass" class="form-control" />
											  </div>
											  
											  &nbsp;&nbsp;
											  <input type="submit" name="question" class="btn btn-success" value="Login">
											  
											  <div class="clearfix"></div>
											  <br>
											  <div class="form-group">
												<label for="exampleInputEmail2">Login with Facebook account</label>
												<br>
												<a href="#">
													<img src="<?php echo $base_url;?>images/facebook_login_button.png" alt="" style="width:183px; margin-top:5px;">
												</a>
											  </div>

                          </div>
                          <?php
					  }*/
					  ?>
                        </form>
                        
                    </div>
                </div>
                
                <div class="col-lg-1"></div>
                
               
                <div class="clear"></div>
            </div>
            
        </div></div>
       
                 
			 <?php
			  }
		  }
	  
	  ?>
     
      </div>
       
    </div>
    </div>
                 
          <div class="clear"></div>      
                          
			   
			</div>
            </div>
            
            <script>
            function askQuestion(qid){
				$("#showquestion_"+qid).toggle();
				}
            function changeBidStatus(statusval,bid_id,parts_id){
				
				var url="<?php echo $this->webroot;?>RequestParts/change_bid_status";
				
				$.post(url,{'bid_id':bid_id,'status':statusval,'parts_id':parts_id},function(res){
					
					if(res==1){
						alert('Status Changed Successfully');
						window.location.href="<?php echo $this->webroot.'RequestParts/request_response/'.$req_dtl['request_id'].'/'.$parts_id;?>";
						
						}else{
					alert('Status Not Changed');
							}
					});
					
				
				}
            </script>