<?php
echo $this->element('header-home');
?>
 <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof">
        <div class="clearfix" style="height:15px;"></div>
        
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>"><span></span><?php echo HOME;?></a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo REQUESTPARTSS;?></a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <article>
						<div class="ofr_TPL">
                        	<h2><?php echo LASTCALLTENDERSRESOLVED;?></h2>
                            
                            <div class="col-lg-12">
                            <?php
			if(isset($activeRequest) && !empty($activeRequest)){?>
                 <div class="row ofr_TPL_list">
                                	<ul>
							<?php
							//pr($activeRequest);
                            foreach($activeRequest as $activeRequestRes)
                            {
								$name_piece=stripslashes($activeRequestRes['RequestAccessory']['name_piece']);
								$status=stripslashes($activeRequestRes['RequestAccessory']['status']);
								$description=stripslashes($activeRequestRes['RequestAccessory']['description']);
								$description=(strlen($description)>110)?substr($description,0,110)."..." : $description;
								$county=stripslashes($activeRequestRes['RequestPart']['county']);
								$city=stripslashes($activeRequestRes['RequestPart']['city']);
								$created=stripslashes($activeRequestRes['RequestPart']['created']);
								$part_img=stripslashes($activeRequestRes['RequestAccessory']['part_img']);
								$brand_id=stripslashes($activeRequestRes['RequestPart']['brand_id']);
								$model_id=stripslashes($activeRequestRes['RequestPart']['model_id']);
								$offerno=stripslashes($activeRequestRes['RequestAccessory']['offerno']);
								$brandname=$this->Custom->brand_nm($brand_id);
								$modelname=$this->Custom->brand_nm($model_id);
								$countryname=$this->Custom->region_nm($county);
								$locationname=$this->Custom->location_nm($city);
								$parts_id=stripslashes($activeRequestRes['RequestAccessory']['part_id']);
								$img=$this->Custom->RequestSingimg($parts_id);
								$path=$base_url.'pages/request-parts/'.$activeRequestRes['RequestAccessory']['slug'];
								$year_of_mfg=stripslashes($activeRequestRes['RequestPart']['yr_of_manufacture']);
								$version=stripslashes($activeRequestRes['RequestPart']['version']);
								$engines=stripslashes($activeRequestRes['RequestPart']['engines']);
								$name_piece=stripslashes($activeRequestRes['RequestAccessory']['name_piece']);
								if(!empty($img))
								{
									$part_img=$img['RequestImg']['img_path'];
								}
								else
								{
									$part_img='';
								}
								$userid=$activeRequestRes['RequestPart']['user_id'];
								$userdetails=$this->Custom->BapUserDetails($userid);
								$memberdetails=$this->Custom->BapCustUniMembership($userdetails['MasterUser']['user_id']);
                            ?>
                              <li>
                                        	<div class="ofr_TPL_title">
                                            	<div class="col-lg-2 col-sm-2 col-xs-12">
                                                    <div class="row">
                                                    	<h4><?php echo $countryname;?>, <?php echo $locationname;?></h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7 col-sm-7 col-xs-12">
                                                    <div class="row">
                                                    	<h4><?php echo PUBLISHEDAPPLICATION;?> - <?php echo date("d.m.Y",strtotime($created));?></h4>
                                                    </div>
                                                </div>
                                            </div>
											
                                            <div class="clearfix"></div>
											
                                            <div class="ofr_TPL_data">
                                            	<div class="col-lg-2 col-sm-2 col-xs-12">
                                                    <div class="row">
                                                    	<a href="<?php echo $path;?>">  <?php if($part_img!=''){
													
													if (file_exists('files/requestpart/160X100_'.$part_img)) {
													$part_img_path = $base_url.'files/requestpart/160X100_'.$part_img;
													}else{
													$part_img_path = $base_url.'files/requestpart/'.$part_img;
													}
                                                        ?>
                                        <img src="<?php echo $part_img_path;?>" alt="<?php echo $name_piece;?>"/>
                                        <?php }else{?>
                                        <img src="<?php echo $base_url;?>images/no-image.jpg" alt="<?php echo $name_piece;?>"/>
                                        <?php }?> </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7 col-sm-7 col-xs-12">
                                                    <div class="row">
                                                    	<div class="ofr_TPL_TlI"><a href="<?php echo $path;?>"><?php echo $name_piece;?></a></h4>
                                                        <div class="ofr_TPL_Sm_TlI"><?php echo $brandname.' '.$modelname.' '.$version.' '. $engines.' '. $year_of_mfg;?> </div>
                                                        <p>
                                                        	<?php echo $description;?>
                                                        </p>
                                                        <div class="ofr_TPL_Mid_tag"><?php echo OFFERSS;?> - <?php echo $offerno;?></div>
                                                        <div class="ofr_TPL_Tag">
                                                        	 <?php if(!empty($memberdetails)){ 
															if($memberdetails['UserMembership']['plan_img']!=''){
																														
															if (file_exists('files/memberplanimg/45X45_'.$memberdetails['UserMembership']['plan_img'])) {
															$memberdetails_path = $base_url.'files/memberplanimg/45X45_'.$memberdetails['UserMembership']['plan_img'];
															}else{
															$memberdetails_path = $base_url.'files/memberplanimg/'.$memberdetails['UserMembership']['plan_img'];
															}
                                                           ?> 
															<img src="<?php echo $memberdetails_path;?>" alt="dez"/>
															<?php }else{?>
															<img src="<?php echo $base_url;?>images/no_plan.png" alt="dez"/>
															<?php }}else{?>
															<img src="<?php echo $base_url;?>images/no_plan.png" alt="dez"/>
															<?php }?>
                                                            <?php echo $brandname.' '.$modelname;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
												<div class="col-lg-3 col-sm-3 col-xs-12 left_brd">
														<div class="row">
															<h2 class="ribbon <?php if($status==2){echo "green";}else if($status==1){echo "blue";}?>">
																<span><?php if($status==1){ echo ACTIVE ;}else{ echo RESOLV;};?></span>
																<div class="fold-right"></div>
															</h2>
															<div class="clearfix"></div>
															<a href="<?php echo $path;?>" class="detalii_btn"><?php echo DETAILS;?></a>
														</div>
													</div>
											</div>	
                                        </li>
                      
                            <?php
                            }
                            ?>     
                   </ul>
               </div>
              <?php }?>
                            	
                            </div>
                            
                            
                            
                             <div class="paging">
							<?php
                                echo $this->Paginator->prev( __('«'), array(), null, array('class' => 'prev disabled'));
                                echo $this->Paginator->numbers(array('separator' => ''));
                                echo $this->Paginator->next(__('»'), array(), null, array('class' => 'next disabled'));
                            ?>
                            </div>
                        </div>
						<div class="clearfix"></div>
					</article>
                    
                    
                    
                    
                    
       <?php /*?> <h2 class="detailstitle1" style="color:#DF5E08"><?php echo LASTCALLTENDERSRESOLVED;?></h2>
        <div class="clearfix" style="height:15px;"></div>
        <?php if(isset($ResoveOfferlist) && !empty($ResoveOfferlist)){?>
        <div class="col-lg-12">
              <div class="row">
            <div class="col-lg-12">
                  <div class="row searchlistdata">
                <ul>
                <?php
				foreach($ResoveOfferlist as $Resoveofferres){
					$offer_name_piece=stripslashes($Resoveofferres['RequestAccessory']['name_piece']);
					$offer_description=stripslashes($Resoveofferres['RequestAccessory']['description']);
					$offer_description=(strlen($offer_description)>110)?substr($offer_description,0,110)."..." : $offer_description;
					$offer_county=stripslashes($Resoveofferres['RequestPart']['county']);
					$offer_city=stripslashes($Resoveofferres['RequestPart']['city']);
					$offer_created=stripslashes($Resoveofferres['RequestPart']['created']);
					$offer_brand_id=stripslashes($Resoveofferres['RequestPart']['brand_id']);
					$offer_model_id=stripslashes($Resoveofferres['RequestPart']['model_id']);
					$offer_offerno=stripslashes($Resoveofferres['RequestAccessory']['offerno']);
					$offer_brandname=$this->Custom->brand_nm($offer_brand_id);
					$offer_modelname=$this->Custom->brand_nm($offer_model_id);
					$offer_countryname=$this->Custom->region_nm($offer_county);
					$offer_locationname=$this->Custom->location_nm($offer_city);
					$offer_parts_id=stripslashes($Resoveofferres['RequestAccessory']['part_id']);
					$offer_img=$this->Custom->RequestSingimg($offer_parts_id);
					if(!empty($offer_img))
					{
						$offer_part_img=$offer_img['RequestImg']['img_path'];
					}
					else
					{
						$offer_part_img='';
					}
					?>
                                      <li class="re_li_blue">
                                    <div class="col-lg-6">
                                          <div class="datalistitem">
                                        <h1 class="blue_h"><a href="<?php echo $this->webroot.'pages/request-parts/'.$Resoveofferres['RequestAccessory']['slug'];?>"><?php echo $offer_name_piece;?></a></h1>
                                        <p><?php echo $offer_description;?> </p>
                                        <div class="clear10"></div>
                                        <div class="row">
                                              <div class="col-lg-6">
                                            <p><img src="<?php echo $base_url;?>images/icon_location.png" alt="Location"/> &nbsp; <span class="grn"><?php echo $offer_countryname;?>, <?php echo $offer_locationname;?></span> </p>
                                          </div>
                                              <div class="col-lg-6 pull-right tl_rit">
                                            <p><img src="<?php echo $base_url;?>images/icon_data.png" alt="calender"/> &nbsp; <span class="grn"><?php echo date("F d, Y",strtotime($offer_created));?></span></p>
                                          </div>
                                            </div>
                                        <div class="clear"></div>
                                      </div>
                                        </div>
                                    <div class="col-lg-1">
                                          <div class="row"> <a href="<?php echo $this->webroot.'pages/request-parts/'.$Resoveofferres['RequestAccessory']['slug'];?>"> <?php if($offer_part_img!=''){?>
                                        <img src="<?php echo $base_url;?>files/requestpart/<?php echo $offer_part_img;?>" class="reqimg" alt="<?php echo $offer_name_piece;?>"/>
                                        <?php }else{?>
                                        <img src="<?php echo $base_url;?>images/no-image.jpg" class="reqimg" alt="<?php echo $offer_name_piece;?>"/>
                                        <?php }?> </a> </div>
                                        </div>
                                    <div class="col-lg-2">
                                          <div class="row">
                                        <div class="req_txt">
                                              <h3><?php echo $offer_brandname;?> <br>
                                            <?php echo $offer_modelname;?></h3>
                                            </div>
                                      </div>
                                        </div>
                                        <div class="col-lg-1">
                                          <div class="row">
                                        <div class="req_txt">
                                              <h3><strong><?php echo $offer_offerno;?></strong> <br>
                                            Offers</h3>
                                            </div>
                                      </div>
                                        </div>
                                        <div class="col-lg-2">
                                          <div class="row">
                                        <!--<div class="req_solved">
                                            <img src="<?php echo $base_url;?>images/ok.png" alt="ok"/> <br/>
                                              Request resolved
                                              
                                            </div>-->
                                            <div class="req_resolved">
                                        <img src="<?php echo $base_url;?>images/tick-white.png" alt="ok"> <br>
                                          <?php echo REQUESTRESOLVED;?>
                                          <div class="clear5"></div>
                                          <?php 
								 $path_rr= $this->webroot.'pages/request-parts/'.$Resoveofferres['RequestAccessory']['slug'];										  
								 ?>
                                          <button type="button" class="btn btn-sm blue_btn" onclick="detailsRR('<?php echo $path_rr; ?>')"><?php echo CLICKME;?> »</button>
                                        </div>
                                        
                                        
                                      </div>
                                        </div>
                                    <div class="clearfix"></div>
                                  </li>
                                  <?php }?>
                                  
                               

                    </ul>
                    
                    <div style="text-align:center;"><a class="gbutton9 gbuttonnew" rel="nofollow" href="<?php echo $this->webroot;?>pages/request-parts-solved/" title="Modify">
                        <?php echo VIEWSOLVEDREQUEST;?>
                        </a></div>
              </div>
              
              
              
              
              
                </div>
            <div class="clear40"></div>
          </div>
            </div>
           <?php }?> 
            
            
            
            
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08"><?php echo LASTCALLPROPOSAL;?></h2>
        <div class="clearfix" style="height:15px;"></div>
            
            <div class="listing_header"> <div class="col1"><font><font class="">
				<?php echo PLAYREQUIRED;?>
			</font></font></div> <div class="col2"><font><font>
				<?php echo POSE;?>
			</font></font></div> <div class="col3"><font><font>
				<?php echo CAR;?>
			</font></font></div> <div class="col4"><?php echo NRDEALS;?>
			</font></font></div> <div class="col6"><font><font>
				<?php echo STATUS;?>
			</font></font></div> <div class="clearing"></div> </div>
             <div class="clear10"></div>
            <div class="col-lg-12">
              <div class="row">
            <div class="col-lg-12">
            <?php
			if(isset($activeRequest) && !empty($activeRequest)){?>
                  <div class="row searchlistdata">
                  
               		 <ul>
							<?php
							//pr($activeRequest);
                            foreach($activeRequest as $activeRequestRes)
                            {
								$name_piece=stripslashes($activeRequestRes['RequestAccessory']['name_piece']);
								$description=stripslashes($activeRequestRes['RequestAccessory']['description']);
								$description=(strlen($description)>110)?substr($description,0,110)."..." : $description;
								$county=stripslashes($activeRequestRes['RequestPart']['county']);
								$city=stripslashes($activeRequestRes['RequestPart']['city']);
								$created=stripslashes($activeRequestRes['RequestPart']['created']);
								$part_img=stripslashes($activeRequestRes['RequestAccessory']['part_img']);
								$brand_id=stripslashes($activeRequestRes['RequestPart']['brand_id']);
								$model_id=stripslashes($activeRequestRes['RequestPart']['model_id']);
								$offerno=stripslashes($activeRequestRes['RequestAccessory']['offerno']);
								$brandname=$this->Custom->brand_nm($brand_id);
								$modelname=$this->Custom->brand_nm($model_id);
								$countryname=$this->Custom->region_nm($county);
								$locationname=$this->Custom->location_nm($city);
								$parts_id=stripslashes($activeRequestRes['RequestAccessory']['part_id']);
								$img=$this->Custom->RequestSingimg($parts_id);
								$path=$base_url.'pages/request-parts/'.$activeRequestRes['RequestAccessory']['slug'];
								if(!empty($img))
								{
									$part_img=$img['RequestImg']['img_path'];
								}
								else
								{
									$part_img='';
								}
                            ?>
                               <li class="re_li_red">
                                <div class="col-lg-6">
                                      <div class="datalistitem">
                                    <h1 class="red_h"><a href="<?php echo $path;?>"><?php echo $name_piece;?></a></h1>
                                    <p><?php echo $description;?> </p>
                                    <div class="clear10"></div>
                                    <div class="row">
                                          <div class="col-lg-6">
                                        <p>
                                        <img src="<?php echo $base_url;?>images/icon_location.png" alt="Location"/> 
                                         &nbsp; <span class="grn"><?php echo $countryname;?>, <?php echo $locationname;?></span> </p>
                                      </div>
                                          <div class="col-lg-6 pull-right tl_rit">
                                        <p><img src="<?php echo $base_url;?>images/icon_data.png" alt="calender"/> &nbsp; <span class="grn"><?php echo date("F d, Y",strtotime($created));?></span></p>
                                      </div>
                                        </div>
                                    <div class="clear"></div>
                                  </div>
                                    </div>
                                <div class="col-lg-1">
                                      <div class="row"> <a href="<?php echo $path;?>">  <?php if($part_img!=''){?>
                                        <img src="<?php echo $base_url;?>files/requestpart/<?php echo $part_img;?>" class="reqimg" alt="<?php echo $name_piece;?>"/>
                                        <?php }else{?>
                                        <img src="<?php echo $base_url;?>images/no-image.jpg" class="reqimg" alt="<?php echo $name_piece;?>"/>
                                        <?php }?> </a> </div>
                                    </div>
                                <div class="col-lg-2">
                                      <div class="row">
                                    <div class="req_txt">
                                          <h3><?php echo $brandname;?> <br>
                                        <?php echo $modelname;?></h3>
                                        </div>
                                  </div>
                                    </div>
                                    <div class="col-lg-1">
                                      <div class="row">
                                    <div class="req_txt">
                                          <h3><strong><?php echo $offerno;?></strong> <br>
                                        Offers</h3>
                                        </div>
                                  </div>
                                    </div>
                                    <div class="col-lg-2">
                                      <div class="row">
                                    <div class="req_resolved">
                                        <img src="<?php echo $base_url;?>images/active_req.png" alt="ok"/> <br/>
                                          <?php echo ACTIVEREQUEST;?>
                                          <div class="clear5"></div>
                                          <button type="button" class="btn btn-sm red_btn" onclick="detailsLink('<?php echo $path;?>')">Offer »</button>
                                        </div>
                                  </div>
                                    </div>
                                <div class="clearfix"></div>
                              </li>
                      
                            <?php
                            }
                            ?>     
                    </ul>
                    
                    <div style="text-align:center;"><a class="gbutton6 gbuttonnew" rel="nofollow" href="<?php echo $this->webroot;?>pages/request-parts-active/" title="Modify">
                        <?php echo VIEWREQUESTS;?>
                        </a></div>
              </div>
              <?php }?>
                </div><?php */?>
            
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
<script>
function detailsLink(path){
	window.location.href=path;
	}
function detailsRR(path){
  window.location.href=path;
}

</script>