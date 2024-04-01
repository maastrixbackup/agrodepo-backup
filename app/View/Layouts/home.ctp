<?php
echo $this->element('header-home');
//echo $this->element('sql_dump');
?>
<!-- the CSS for Smooth Div Scroll -->
<link rel="Stylesheet" type="text/css" href="css/smoothDivScroll.css" />

<div class="container">
		<div class="row">
					
			<div class="innerpanel">
				<!-- Left Sidebar Start -->
                <?php echo $this->element('home-left');?>
					
				<!-- Left Sidebar End -->
				
				
				<!-- Right Sidebar Start -->
				<div class="col-md-9">
					<div class="clearfix" style="height:15px;"></div>
                      <article>
                                <?php
								//pr($bannerRes);
								if(isset($bannerRes) && !empty($bannerRes))
								{
									?>
                             <div class="callbacks_container">
                                <ul class="rslides callbacks callbacks1" id="slider4"> 
                                    <?php
									foreach($bannerRes as $bannerResult)
									{
										if($bannerResult['Banner']['banner_img']!='')
										{
										$path = "files/banner/920X270_".$bannerResult['Banner']['banner_img'];	
										if (file_exists($path)) {
										$img_path = $base_url.'files/banner/920X270_'.$bannerResult['Banner']['banner_img'];
										   }else{
										$img_path = $base_url.'files/banner/'.$bannerResult['Banner']['banner_img'];
											   }
														
										?>
									  <li>
										<img src="<?php echo $img_path ;?>" alt="<?php echo $bannerResult['Banner']['banner_title'];?>" rel="nofollow">
										<p class="caption">
										 <?php echo stripslashes($bannerResult['Banner']['banner_caption']);?>
										</p>
									  </li>
									  <?php
										}
									}
									?>
                                    </ul>
                                <a href="#" class="callbacks_nav callbacks1_nav prev"></a>
                                <a href="#" class="callbacks_nav callbacks1_nav next"></a>
                              </div> 
                                    <?php
								  }
								  ?>
                               
                              
                              
                          	<div class="clearfix"></div>



<div class="mainslider_btm_mobilebanner">
                                  <h2><?php echo PRODUCTPROMOTE;?></h2>
                                 
                                 
                                 <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
   <?php
                                if(!empty($promoteAd))
                                {
                                ?>
  <!-- Wrapper for slides -->
  <div class="carousel-inner">

<?php
                                    $promoCount=1;
                                    foreach($promoteAd as $promoteadRes)
                                    {
                                        $postId=stripslashes($promoteadRes['PostAd']['adv_id']);
                                        $adv_name=stripslashes($promoteadRes['PostAd']['adv_name']);
                                        $adv_name=(strlen($adv_name)>15) ? substr($adv_name,0,15).'...' : $adv_name;
                                        $product_cond=stripslashes($promoteadRes['PostAd']['product_cond']);
                                        $price=stripslashes($promoteadRes['PostAd']['price']);
                                        $currency=stripslashes($promoteadRes['PostAd']['currency']);
                                        $quantity=stripslashes($promoteadRes['PostAd']['quantity']);
                                        $adv_details=strip_tags(stripslashes($promoteadRes['PostAd']['adv_details']));
                                        $content=(strlen($adv_details)>30) ? substr($adv_details,0,30).'...' : $adv_details;
                                        $slug=stripslashes($promoteadRes['PostAd']['slug']);
                                        $salespath=$base_url.'pages/sales-details/'.$slug;
                                        $salesImg=$this->Custom->BapCustUniSalesImg($postId);
                                        
                                        if(!empty($salesImg))
                                                {
                                                    if( $promoCount<=4){
                                                    $path ='files/postad/165X135_'.$salesImg['PostadImg']['img_path'];  
                                                    if (file_exists($path)) {
                                                    $imgpath=$base_url.'files/postad/165X135_'.$salesImg['PostadImg']['img_path']."?timestamp=".time();
                                                       }else{
                                                    $imgpath=$base_url.'files/postad/'.$salesImg['PostadImg']['img_path']."?timestamp=".time();
                                                           }
                                                        
                                                        
                                            ?>




    <div class="item <?php if($promoCount==1){echo 'active';}?>">
      <div class="row">
        <div class="col-xs-12">
          <div class="thumbnail adjust1">
            
            <div class="col">
                                    <div class="img-wrapper">
                                        <!-- <a href="#" link="data/frontImages/b2b/product_images/1398027492_disc_razol_40_talere.jpg" title="Disc razol">
                                            <img src="images/promt3.jpg" border="0" width="120" height="120" class="thumb">
                                        </a> -->
                                        <a href="javascript:void(0);" onclick="saveView(<?php echo $postId;?>,'<?php echo $salespath;?>');" link="<?php echo $imgpath;?>" title="<?php echo $adv_name;?>">
                                            <img src="<?php echo $imgpath;?>" border="0" width="120" height="120" class="thumb" alt="<?php echo $adv_name;?>">
                                        </a>
                                    </div>
                                    <div class="ribbon"></div>
                                    
                                    <span class="block-title">
                                        <!-- <a href="#" title="Disc razol">
                                        Disc razol
                                        </a> -->
                                        <a  href="javascript:void(0);" onclick="saveView(<?php echo $postId;?>,'<?php echo $salespath;?>');" title="<?php echo $adv_name;?>">
                                            <?php echo $adv_name;?>
                                        </a>
                                    </span>
                                    <br>
                                    <?php echo nl2br($content);?>
                                    <br>
                                    <div class="rating">
                                        <!-- <img src="images/star-small-active.png" border="0">
                                        <img src="images/star-small-active.png" border="0">
                                        <img src="images/star-small-active.png" border="0">
                                        <img src="images/star-small-inactive.png" border="0">
                                        <img src="images/star-small-inactive.png" border="0"> -->
                                        <?php $avgrating=$this->Custom->SalesRatingcout($postId);
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
                                    <span class="price-previous"><?php echo $price ;?></span>
                                    &nbsp;
                                    <span class="price"><?php echo $currency ;?></span>
                                </div>
            
          </div>
        </div>
      </div>
    </div>

    <?php
    }
         $promoCount++;
                }

    }
    ?>
    <!-- <div class="item">
      <div class="row">
        <div class="col-xs-12">
          <div class="thumbnail adjust1">
            
           <div class="col">
                                    <div class="img-wrapper">
                                        <a href="#" link="data/frontImages/b2b/product_images/1398027492_disc_razol_40_talere.jpg" title="Disc razol">
                                            <img src="images/promt3.jpg" border="0" width="120" height="120" class="thumb">
                                        </a>
                                    </div>
                                    <div class="ribbon"></div>
                                    
                                    <span class="block-title">
                                        <a href="#" title="Disc razol">
                                        Disc razol
                                        </a>
                                    </span>
                                    <br>
                                    Vand disc agricol marca razol are 4...
                                    <br>
                                    <div class="rating">
                                        <img src="images/star-small-active.png" border="0">
                                        <img src="images/star-small-active.png" border="0">
                                        <img src="images/star-small-active.png" border="0">
                                        <img src="images/star-small-inactive.png" border="0">
                                        <img src="images/star-small-inactive.png" border="0">
                                    </div>
                                    <br>
                                    <span class="price-previous">RON 0</span>
                                    &nbsp;
                                    <span class="price">500 EUR</span>
                                </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="row">
        <div class="col-xs-12">
          <div class="thumbnail adjust1">
          
            <div class="col">
                                    <div class="img-wrapper">
                                        <a href="#" link="data/frontImages/b2b/product_images/1398027492_disc_razol_40_talere.jpg" title="Disc razol">
                                            <img src="images/promt3.jpg" border="0" width="120" height="120" class="thumb">
                                        </a>
                                    </div>
                                    <div class="ribbon"></div>
                                    
                                    <span class="block-title">
                                        <a href="#" title="Disc razol">
                                        Disc razol
                                        </a>
                                    </span>
                                    <br>
                                    Vand disc agricol marca razol are 4...
                                    <br>
                                    <div class="rating">
                                        <img src="images/star-small-active.png" border="0">
                                        <img src="images/star-small-active.png" border="0">
                                        <img src="images/star-small-active.png" border="0">
                                        <img src="images/star-small-inactive.png" border="0">
                                        <img src="images/star-small-inactive.png" border="0">
                                    </div>
                                    <br>
                                    <span class="price-previous">RON 0</span>
                                    &nbsp;
                                    <span class="price">500 EUR</span>
                                </div>
            
          </div>
        </div>
      </div>
    </div> -->
  </div>
   <?php
    }
    ?>
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">&nbsp;</a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">&nbsp;</a>
</div>
 
                                 
                                 
                                 
                            </div>













                          <div class="block block-grid block-featured mainslider_btmbanner">
                            <h2>
                              <?php echo PRODUCTPROMOTE;?>
                            </h2>
                            <div class="block-body newheight">
                            	<div id="liquid1" class="liquid">
                                <span class="previous carousel-control left"></span>
                                <div class="wrapper" style="background:none; width:100%!important; height:278px;">
                                <?php
								if(!empty($promoteAd))
								{
								?>
                                    <ul>
                                    <?php
                                    $promoCount=1;
									foreach($promoteAd as $promoteadRes)
									{
										$postId=stripslashes($promoteadRes['PostAd']['adv_id']);
										$adv_name=stripslashes($promoteadRes['PostAd']['adv_name']);
										$adv_name=(strlen($adv_name)>15) ? substr($adv_name,0,15).'...' : $adv_name;
										$product_cond=stripslashes($promoteadRes['PostAd']['product_cond']);
										$price=stripslashes($promoteadRes['PostAd']['price']);
										$currency=stripslashes($promoteadRes['PostAd']['currency']);
										$quantity=stripslashes($promoteadRes['PostAd']['quantity']);
										$adv_details=strip_tags(stripslashes($promoteadRes['PostAd']['adv_details']));
										$content=(strlen($adv_details)>30) ? substr($adv_details,0,30).'...' : $adv_details;
										$slug=stripslashes($promoteadRes['PostAd']['slug']);
										$salespath=$base_url.'pages/sales-details/'.$slug;
										$salesImg=$this->Custom->BapCustUniSalesImg($postId);
										
										if(!empty($salesImg))
												{
                                                    if( $promoCount<=4){
													$path ='files/postad/165X135_'.$salesImg['PostadImg']['img_path'];	
													if (file_exists($path)) {
													$imgpath=$base_url.'files/postad/165X135_'.$salesImg['PostadImg']['img_path']."?timestamp=".time();
													   }else{
													$imgpath=$base_url.'files/postad/'.$salesImg['PostadImg']['img_path']."?timestamp=".time();
														   }
														
														
											?>
                                                <li>
                                                     <div class="col">
                                            <div class="img-wrapper">
                                                <a href="javascript:void(0);" onclick="saveView(<?php echo $postId;?>,'<?php echo $salespath;?>');" link="<?php echo $imgpath;?>" title="<?php echo $adv_name;?>">
                                                    <img src="<?php echo $imgpath;?>" border="0" width="120" height="120" class="thumb" alt="<?php echo $adv_name;?>">
                                                </a>
                                            </div>
                                            <div class="ribbon"></div>
                                            
                                            <span class="block-title">
                                                <a  href="javascript:void(0);" onclick="saveView(<?php echo $postId;?>,'<?php echo $salespath;?>');" title="<?php echo $adv_name;?>">
                                                <?php echo $adv_name;?>
                                                </a>
                                            </span>
                                            <br>
                                            <?php echo nl2br($content);?>
                                            <br>
                                            <div class="rating">
                                                 <?php $avgrating=$this->Custom->SalesRatingcout($postId);
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
                                            <!--<span class="price-previous">RON 0</span>-->
                                            &nbsp;
                                            <span class="price"><?php echo $price.' '.$currency;?></span>
                                           
                                        </div>
                                                </li>
                                        <?php
                                    }
                                         $promoCount++;
												}

									}
									?>
                                        
                                        
                                        
                                    </ul>
                                    <?php
								}
								?>
                                </div>
                                <span class="next carousel-control right"></span>
                            </div>
                            
                            	
                                <div class="clear"></div>
                            </div>
                          </div>
                          
                          <div class="clearfix" style="height:15px;"></div>
                          <?php
						  if(!empty($middlead)){?>
                          <div class="block-ad">
                             <?php
							if($middlead['Advertisement']['ad_type']==1)
							{
								$adlinkmid=$middlead['Advertisement']['banner_link'];
								$adimgmid=$middlead['Advertisement']['banner_image'];
								$adtitlemid=$middlead['Advertisement']['banner_title'];
								$path = "files/advertisement/810X160_".$adimgmid;
								if (file_exists($base_url."files/advertisement/810X160_".$adimgmid)) {
								$ad_img = $base_url."files/advertisement/810X160_".$adimgmid;
								   }else{
								$ad_img = $base_url."files/advertisement/".$adimgmid;
									   }
														
							?>
                        	<a href="<?php echo $adlinkmid;?>" target="_blank"><img src="<?php echo $ad_img;?>" alt="<?php echo $adtitlemid;?>" style="width:100%;"></a>
                            <?php }else if($middlead['Advertisement']['ad_type']==2){
								echo stripslashes($middlead['Advertisement']['ad_script']);
								}
							?>
                        </div>
                        <?php }?>
                         
                          
                         
                          <div class="clearfix"></div>
                          <?php echo $this->element('home-tab');?>
                        
                        <div class="clearfix" style="height:15px;"></div>

                        <?php if(count($brands_image)>0){ ?>
                        <div class="block block-grid block-featured"> 
                            <h2 style="margin-top: 5px;">
                              <?php echo OURBRAND;?>: <span class="pull-right"><a href="<?php echo $base_url;?>brand-list">View All</a></span>
                            </h2>
                            <div id="logoParade">
                                <?php 
                                foreach ($brands_image as $brand_image) {
                                    if(trim($brand_image['ManageBrand']['slug'])!=''){
                                        $brandPath=$base_url.'brand/'.$brand_image['ManageBrand']['slug'];
                                    }else{
                                        $brandPath=$base_url.'brand/'.$brand_image['ManageBrand']['brand_id'];
                                    }
                                ?>
                                <a href="<?php echo $brandPath;?>" >
                                    <img src="<?php echo $base_url.'files/brand/100X100_'.$brand_image['ManageBrand']['image'];?>"  data-u="image" style="height:55px">
                                </a>                                                                           
                                <?php } ?>  
                            </div> 
                        <?php } ?>


                            <?php
							
							if(isset($recentViews) && !empty($recentViews))
							{
								//print_r($_COOKIE['recentSale']);exit;
								$sessionSales=$recentViews;
								//krsort($sessionSales);
								?>
                            <div class="block block-grid block-featured">
                            <h2 style="margin-top: 15px;">
                              <?php echo RECENTVIEW;?>:
                            </h2>
                            <div class="block-body newheight">
                            	<div id="liquid2" class="liquid2">
                                <span class="previous carousel-control left"></span>
                                <div class="wrapper" style="background:none; width:100%!important; height:278px;">
                                    <ul>
                                    <?php
									if(!empty($sessionSales))
									{
										foreach($sessionSales as $sessionSalesID)
										{
											$salesDetail=$this->Custom->BapCustUniSales($sessionSalesID);
											if(!empty($salesDetail))
											{
												$postId=stripslashes($salesDetail['PostAd']['adv_id']);
												$adv_name=stripslashes($salesDetail['PostAd']['adv_name']);
												$adv_name=(strlen($adv_name)>15) ? substr($adv_name,0,15).'...' : $adv_name;
												$product_cond=stripslashes($salesDetail['PostAd']['product_cond']);
												$price=stripslashes($salesDetail['PostAd']['price']);
												$currency=stripslashes($salesDetail['PostAd']['currency']);
												$quantity=stripslashes($salesDetail['PostAd']['quantity']);
												$adv_details=strip_tags(stripslashes($salesDetail['PostAd']['adv_details']));
												$content=(strlen($adv_details)>30) ? substr($adv_details,0,30).'...' : $adv_details;
												$slug=stripslashes($salesDetail['PostAd']['slug']);
												$salespath=$base_url.'pages/sales-details/'.$slug;
												$salesImg=$this->Custom->BapCustUniSalesImg($sessionSalesID);
												if(!empty($salesImg))
												{
													$path='files/postad/128X120_'.$salesImg['PostadImg']['img_path'];
													if (file_exists($path)) {
													$imgpath=$base_url.'files/postad/128X120_'.$salesImg['PostadImg']['img_path']."?timestamp=".time();
													   }else{
													$imgpath=$base_url.'files/postad/'.$salesImg['PostadImg']['img_path']."?timestamp=".time();
														   }
																		
													
													?>
                                                <li>
                                                     <div class="col">
                                            <div class="img-wrapper">
                                                <a href="javascript:void(0);" onclick="saveView(<?php echo $postId;?>,'<?php echo $salespath;?>');" link="<?php echo $imgpath;?>" title="<?php echo $adv_name;?>">
                                                    <img src="<?php echo $imgpath;?>" border="0" style="width: 120px; height: 120px;" class="thumb" alt="<?php echo $adv_name;?>">
                                                </a>
                                            </div>
                                            <div class="ribbon"></div>
                                            
                                            <span class="block-title">
                                                <a  href="javascript:void(0);" onclick="saveView(<?php echo $postId;?>,'<?php echo $salespath;?>');" title="<?php echo $adv_name;?>">
                                                <?php echo $adv_name;?>
                                                </a>
                                            </span>
                                            <br>
                                            <?php echo nl2br($content);?>
                                            <br>
                                            <div class="rating">
                                                <img src="<?php echo $base_url;?>images/star-small-inactive.png" border="0">
                                                <img src="<?php echo $base_url;?>images/star-small-inactive.png" border="0">
                                                <img src="<?php echo $base_url;?>images/star-small-inactive.png" border="0">
                                                <img src="<?php echo $base_url;?>images/star-small-inactive.png" border="0">
                                                <img src="<?php echo $base_url;?>images/star-small-inactive.png" border="0">
                                            </div>
                                            <br>
                                            <!--<span class="price-previous">RON 0</span>-->
                                            &nbsp;
                                            <span class="price"><?php echo $price.' '.$currency;?></span>
                                        </div>
                                                </li>
                                        <?php
												}
											}
										}
									}
									?>
                                    
									</ul>
                                </div>
                                 
                                <span class="next carousel-control right"></span>
                            </div>
                            
                            <div  id="successstories"></div>
                                <div class="clear"></div>
                            </div>
                           </div>
                            <?php }?>
                          
                          
                  </article>
					
			  </div>
				<!-- Right Sidebar end -->
				
				<div class="clearfix" style="height:1px;"></div>     
                
                 <?php echo $this->element('home-bottom');?>                     
			   
			</div>
		</div>
		<div class="clearfix"></div>
    </div>
    <!-- jQuery UI Widget and Effects Core (custom download)
         You can make your own at: http://jqueryui.com/download -->
    <script src="js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
    
    <!-- Latest version of jQuery Mouse Wheel by Brandon Aaron
         You will find it here: http://brandonaaron.net/code/mousewheel/demos -->
    <script src="js/jquery.mousewheel.min.js" type="text/javascript"></script>

    <!-- Smooth Div Scroll 1.3 minified -->
    <script src="js/jquery.smoothdivscroll-1.3-min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("#logoParade").smoothDivScroll({
            autoScrollingMode: "always",
            autoScrollingDirection: "endlessLoopRight",
            autoScrollingStep: 1,
            autoScrollingInterval: 25 
        });

        // Logo parade
        $("#logoParade").bind("mouseover", function () {
            $(this).smoothDivScroll("stopAutoScrolling");
        }).bind("mouseout", function () {
            $(this).smoothDivScroll("startAutoScrolling");
        });


        $("#accordion > li").click(function(){

            if(false == $(this).next().is(':visible')) {
                $('#accordion > ul').slideUp(300);
            }
            $(this).next().slideToggle(300);
            var hrefval=$(this).children("input").val();
            var catname=$(this).children("input").attr('name');
            $(this).next("ul").before("<li><a href="+hrefval+">"+catname+"</a></li>");
        });
    </script>
<?php
echo $this->element('footer-home');
?>