<div class="col-md-3">

            <div class="leftnav_mobile">
                            <div class="block-heading">
                                <div class="symbol"><?php echo CATEGORIES;?></div>
                            </div>
                            <div class="block-body">
                                <div id="side_nav" class="side_nav grid_3 push_down"> 
                                    <ul class="clearfix " style="height:auto;" id="accordion"><?php foreach($category As $categoryResult){
                                        $catID=$categoryResult['SalesCategory']['category_id'];
                                        if(trim($categoryResult['SalesCategory']['slug'])!=''){
                                         $catPath=$base_url.'category/'.$categoryResult['SalesCategory']['slug'];
                                         $catSlug=$categoryResult['SalesCategory']['slug'];
                                     }else{
                                        $catPath=$base_url.'category/'.$categoryResult['SalesCategory']['category_id'];
                                        $catSlug=$categoryResult['SalesCategory']['category_id'];
                                     }
                                     $catVal= stripcslashes($categoryResult['SalesCategory']['category_name']);
                                            ?>
                                            <li>
                                            
                                                <span class="glyphicon glyphicon-tag"></span>
                                                <span> <?php echo $catVal;?> <span class="count">&nbsp; (<?php echo $this->Custom->dezPostAdsCount('category_id',$catID);    ?>)</span></span>
                                                <span class="icon">&nbsp;</span>
                                                <input type="hidden" name="<?php echo $catVal;?>" value="<?php echo $catPath;?>">
                                            
                                             </li> 
                                            <ul class="" style="display: none;">
                                            <?php 
                                            $sub_cat=$this->Custom->BapCustUnisubCat($catID);

                                            if(!empty($sub_cat) && is_array($sub_cat)){
                                            foreach($sub_cat as $subcatResult){
                                                $subcatID=$subcatResult['SalesCategory']['category_id'];
                                                if(trim($subcatResult['SalesCategory']['slug'])!=''){
                                                 $subcatPath=$base_url.'category/'.$catSlug."/".$subcatResult['SalesCategory']['slug'];
                                                 }else{
                                                    $subcatPath=$base_url.'category/'.$catSlug."/".$subcatResult['SalesCategory']['category_id'];
                                                 }
                                                 $subcatVal= stripcslashes($subcatResult['SalesCategory']['category_name']);
                                                ?>
                                                <li><a href="<?php echo $subcatPath;?>"><?php echo $subcatVal;?><span>&nbsp; (<?php echo$this->Custom->dezPostAdsCount('sub_cat_id',$subcatID);  ?>)</span></span></a></li>
                                                <?php
                                            }
                                            }
                                            ?>
                                             </ul>
                                            
                                             <?php }?>
                                             <div class="clear"></div>
                                    </ul>
                                </div>
                            </div> 
                                       
                        </div>








						<div class="block block-cat-menu leftnav_desktop">
							<div class="block-heading">
								<div class="symbol"><?php echo CATEGORIES;?></div>
							</div>
							<div class="block-body">
								<div id="side_nav" class="side_nav grid_3 push_down"> 
                                    <ul class="clearfix " style="height:auto;"><?php foreach($category As $categoryResult){
                                        $catID=$categoryResult['SalesCategory']['category_id'];
                                        if(trim($categoryResult['SalesCategory']['slug'])!=''){
                                         $catPath=$base_url.'category/'.$categoryResult['SalesCategory']['slug'];
                                         $catSlug=$categoryResult['SalesCategory']['slug'];
                                     }else{
                                        $catPath=$base_url.'category/'.$categoryResult['SalesCategory']['category_id'];
                                        $catSlug=$categoryResult['SalesCategory']['category_id'];
                                     }
                                     $catVal= stripcslashes($categoryResult['SalesCategory']['category_name']);
											?>
											<li>
											<a href="<?php echo $catPath;?>">
                                            	<span class="glyphicon glyphicon-tag"></span>
                                            	<span> <?php echo $catVal;?> <span class="count">&nbsp; (<?php echo $this->Custom->dezPostAdsCount('category_id',$catID);	 ?>)</span></span>
                                            	<span class="icon">&nbsp;</span>
                                            </a>
											
											<ul class="" style="display: none;">
											<?php 
											$sub_cat=$this->Custom->BapCustUnisubCat($catID);

											if(!empty($sub_cat) && is_array($sub_cat)){
											foreach($sub_cat as $subcatResult){
                                                $subcatID=$subcatResult['SalesCategory']['category_id'];
                                                if(trim($subcatResult['SalesCategory']['slug'])!=''){
                                                 $subcatPath=$base_url.'category/'.$catSlug."/".$subcatResult['SalesCategory']['slug'];
                                                 }else{
                                                    $subcatPath=$base_url.'category/'.$catSlug."/".$subcatResult['SalesCategory']['category_id'];
                                                 }
                                                 $subcatVal= stripcslashes($subcatResult['SalesCategory']['category_name']);
												?>
                                                <li><a href="<?php echo $subcatPath;?>"><?php echo $subcatVal;?><span>&nbsp; (<?php echo$this->Custom->dezPostAdsCount('sub_cat_id',$subcatID);	 ?>)</span></span></a></li>
												<?php
											}
											}
											?>
											 </ul>
											 </li> 
											 <?php }?>
											 <div class="clear"></div>
                    				</ul>
                                </div>
							</div> 
									   
						</div>       	
						 
                        <div class="clear"></div>
                        
                        <div class="belowmenu">
                        <?php if(!empty($left1)){
							if($left1['Advertisement']['ad_type']==1)
							{
								$adlink=$left1['Advertisement']['banner_link'];
								$adimg=$left1['Advertisement']['banner_image'];
								$adtitle=$left1['Advertisement']['banner_title'];
							?>
                        	<a href="<?php echo $adlink;?>" target="_blank"><img src="<?php echo $base_url;?>files/advertisement/<?php echo $adimg;?>" alt="<?php echo $adtitle;?>" style="width:100%;"></a>
                            <?php }else if($left1['Advertisement']['ad_type']==2){
								echo stripslashes($left1['Advertisement']['ad_script']);
								}
							}?>
                            
                            <div class="clear" style="height:18px;"></div>
                            
                            <div class="block block-list">
                                <div class="block-heading silver"><div class="symbol" style="background-image:url(<?php echo $base_url;?>images/static.png); background-repeat:no-repeat; padding-left:38px;"><?php echo TRADESTATISTICS;?></div></div>
                                <div class="block-body">
                                    <ul style="height: auto;">
                                        <li><a href="<?php echo $base_url;?>Search"><span class="prdg1"></span> Produse <span class="label label-primary">(<?php echo $productcount;?>)</span></a></li>
                                        <li><a href="javascript:void(0);"><span class="prdg2"></span> Selling Leads <span class="label label-success">(<?php echo $sellercount;?>)</span></a></li>
                                        <li><a href="javascript:void(0);"><span class="prdg3"></span> Buying Leads <span class="label label-warning">(<?php echo $buyercount;?>)</span></a></li>
                                        <li class="last-child"><a href="<?php echo $base_url;?>pages/request-parts-active/"><span class="prdg4"></span> Piese de oferta <span class="label label-danger">(<?php echo $offercount;?>)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="clear" style="height:18px;"></div>
                            
                            <div class="block block-list" style="height: 183px;">
                                <div id="usual2" class="usual">
                                    <ul>
                                        <li>
                                        	<a class="selected" href="javascript:void(0)" onClick="shobtab1(2,this);">
                                            	<span class="glyphicon" style="background-image:url(<?php echo $base_url;?>images/buyer.png); background-repeat:no-repeat; background-size: 110%;top: 2px;"></span><?php echo BUYERS;?>
                                            </a>
                                        </li>
                                        
                                        <li>
                                        	<a class="" href="javascript:void(0)" onClick="shobtab1(1,this);">
                                            	<span class="glyphicon" style="background-image:url(<?php echo $base_url;?>images/supplyer.png); background-repeat:no-repeat; background-size: 100%;top: 2px;"></span><?php echo SUPPLIERS;?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clear"></div>
                                
                                <div class="block-content" style="border: 1px solid #E1E1E1;padding: 10px; display:none;" id="tab1">
                                      <ul class="list-unstyled block-tab-suppliers">
                                            <li> Top Search Ranking</li>
                                            <li> Post Unlimited Leads</li>
                                            <li> Easy Upgradation</li>
                                        </ul>
                                       <a href="<?php echo $base_url;?>MasterUsers/add" class="join" style="position: relative;top: 7px;">Sign up for free!</a>
                                  </div>
                                  
                                  
                                <div class="block-content" style="border: 1px solid #E1E1E1;padding: 10px;" id="tab2">
                                      <p>Promovati-va afacerea cu  <span class="block-title">Dezmembraripenet .ro</span>. Rapid si usor</p>
                                        <a href="<?php echo $base_url;?>MasterUsers/add" class="join"><?php echo SIGNUP;?></a><br>
                                        Already a member? <a href="<?php echo $base_url;?>Logins/login"><?php echo PLEASESIGNIN;?></a>
                                  </div>
                            </div>	
                            
                        </div>
                        <?php if(!empty($left2)){?>
                        
                        <div class="clearad">
                        	 <?php
							if($left2['Advertisement']['ad_type']==1)
							{
								$adlink1=$left2['Advertisement']['banner_link'];
								$adimg1=$left2['Advertisement']['banner_image'];
								$adtitle1=$left2['Advertisement']['banner_title'];
							?>
                        	<a href="<?php echo $adlink1;?>" target="_blank"><img src="<?php echo $base_url;?>files/advertisement/<?php echo $adimg1;?>" alt="<?php echo $adtitle1;?>" style="width:100%;"></a>
                            <?php }else if($left2['Advertisement']['ad_type']==2){
								echo stripslashes($left2['Advertisement']['ad_script']);
								}
							?>
                        </div>
                        <?php }?>
                        
                        
                        
					</div>