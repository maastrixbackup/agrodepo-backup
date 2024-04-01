<?php
echo $this->element('header-home');

$adv_name=stripslashes($salesDetail['PostAd']['adv_name']);
$product_cond=stripslashes($salesDetail['PostAd']['product_cond']);
$price=stripslashes($salesDetail['PostAd']['price']);
$currency=stripslashes($salesDetail['PostAd']['currency']);
$quantity=stripslashes($salesDetail['PostAd']['quantity']);
$adv_details=stripslashes($salesDetail['PostAd']['adv_details']);
$adv_brand_id=stripslashes($salesDetail['PostAd']['adv_brand_id']);
$adv_model_id=stripslashes($salesDetail['PostAd']['adv_model_id']);
$adv_model_id=stripslashes($salesDetail['PostAd']['adv_model_id']);
$personal_teaching=stripslashes($salesDetail['PostAd']['personal_teaching']);
$courier=stripslashes($salesDetail['PostAd']['courier']);
$free_courier=stripslashes($salesDetail['PostAd']['free_courier']);
$courier_cost=stripslashes($salesDetail['PostAd']['courier_cost']);
$romanian_mail=stripslashes($salesDetail['PostAd']['romanian_mail']);
$romanian_mail_cost=stripslashes($salesDetail['PostAd']['romanian_mail_cost']);
$free_romanian_mail=stripslashes($salesDetail['PostAd']['free_romanian_mail']);
$time_required=stripslashes($salesDetail['PostAd']['time_required']);
$slug=stripslashes($salesDetail['PostAd']['slug']);
$payment_mode=stripslashes($salesDetail['PostAd']['payment_mode']);
$adv_id=stripslashes($salesDetail['PostAd']['adv_id']);
$ads_userid=stripslashes($salesDetail['PostAd']['user_id']);
$warrantyDetail=$this->Custom->warrantyDetail($ads_userid);
//pr($warrantyDetail);
if($this->Session->check('User'))
{
$sessionUser=$this->Session->read('User');
$sessionuserID=$sessionUser['user_id'];
}
else
{
	$sessionuserID='';
}
if(!empty($userDetail))
{
	$countyid=$userDetail['ManageUser']['country_id'];
	$locality_id=$userDetail['ManageUser']['locality_id'];
	$countyname=$this->Custom->region_nm($countyid);
	$locationname=$this->Custom->location_nm($locality_id);
}
$memberdetails=$this->Custom->BapCustUniMembership($userDetail['ManageUser']['user_id']);
?>
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
		$("#SalesQuestionParent").val(qid);
	}
	else
	{
		$("#showoffer").hide();
		$("#showquestion").hide();
	}
}
function FavLogin()
{
	alert('First Login to "add to favourite" this sales');
}
function addToFav(advid)
{
	<?php if($sessionuserID==$ads_userid){?>
	alert('You can not add to favourite to your sales');
	<?php }else{?>
	if(advid!='')
	{
		$("#add_to_fav").html('Add to Favourite <span sttyle="color:green">Processing...</span>');
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>Search/addtofavourite',
				data: 'advid='+advid,
				success: function(data) {
					
					//alert(data);
					if(data==1)
					{
						$("#add_to_fav").html('Favourite');
						alert('Added to favourites successfully');
						
						
					}
					else if(data==2)
					{
						$("#add_to_fav").html('Add to Favourite');
						alert('You have Add to favourite adding failed');
					}
					else if(data==3)
					{
						$("#add_to_fav").html('Favourite');
						alert('You have already added to favourite');
						
					}
					else if(data==4)
					{
						$("#add_to_fav").html('Add to Favourite');
						alert('First login to "add to favourite" this sales');
					}
					
				}
			});
	}
	else
	{
		alert('You have already add to favourite this sales');
	}
	<?php }?>
}
function submitOrder()
{
	var pid=$("#pid").val();
	var qty=$("#qty").val();
	if(pid!='')
	{
		if(qty!='' && qty!=0 && qty!=null)
		{
			window.location="<?php echo $base_url;?>pages/sales-order/pid:"+pid+"/qty:"+qty;
		}
		else
		{
			alert("Select Quantity");
		}
	}
}
</script>

<div class="container">
		<div class="row">
					 <div class="clearfix" style="height:15px;"></div>
                        
                        <?php echo $this->Session->flash(); ?>
			<div class="innerpanel">
				<!-- middle Start -->
				<div class="clear" style="height:20px;"></div>
				<div class="">
					<div class="col-lg-4">
						<!--<a href = "images/large/image1.jpg">
                           <img class = "cloudzoom detailspan" src = "images/details.jpg"/>
                        </a><img class = "cloudzoom detailspan" src = "images/details.jpg"
             data-cloudzoom = "zoomImage: 'images/details.jpg'" />-->
             
             <div class="zoom-img">
             <?php
			 if(!empty($allimg)){
				 $singcount=1;
				foreach($allimg as $imgres)
				{ 
				if($singcount==1)
				{
					$imgname=$imgres['PostadImg']['img_path'];
					if($imgname!=''){
				 ?>
		        <div style="top:0px;z-index:9999;position:relative;" id="wrap"><a id="zoom1" rel="tint:'#ff0000',tintOpacity:0.5,smoothMove:5,zoomWidth:480,adjustY:-4,adjustX:10" class="cloud-zoom" href="<?php echo $base_url;?>files/postad/<?php echo $imgname;?>" style="position: relative; display: block;">
      	<img alt="" src="<?php echo $base_url;?>files/postad/<?php echo $imgname;?>" style="display: block;">
      	</a><div style="background-image: url(&quot;.&quot;); z-index: 999; position: absolute; width: 343px; height: 258px; left: 0px; top: 0px; cursor: move;" class="mousetrap"></div></div>
				<?php
                $singcount++;
					}
				}
		
		 }
		
		}?>
	  <p>
	  	 <?php
		 if(!empty($allimg)){
			 $imgcount=1;
			foreach($allimg as $thumbimgres)
			{ 
				$thumbimg=$thumbimgres['PostadImg']['img_path'];
				if($thumbimg!=''){
				
				if (file_exists('files/postad/50X37_'.$thumbimg)) {
				$thumbimg_path = $base_url.'files/postad/50X37_'.$thumbimg;
				}else{
				$thumbimg_path = $base_url.'files/postad/'.$thumbimg;
				}
			 ?>  
      <a rel="useZoom: 'zoom1', smallImage: '<?php echo $base_url;?>files/postad/<?php echo $thumbimg;?>'" class="cloud-zoom-gallery" href="<?php echo $base_url;?>files/postad/<?php echo $thumbimg;?>">
      <img class="zoom-tiny-image" src="<?php echo $thumbimg_path;?>">
      </a> 
      <?php
                $imgcount++;
				}
		
		 }
		
		}?>
		</p>
	</div>
    <div class="clearing" style="height: 18px !important;"></div>
<div>
                <a style="width:80px;" href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base_url;?>pages/sales-details/<?php echo $slug;?>" data-text="<?php echo $adv_name;?>">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                                
                <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $base_url;?>pages/sales-details/<?php echo $slug;?>&amp;width=20&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=567880319902937" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;width:80px;" allowTransparency="true"></iframe>
                
                
                <!-- Place this tag in your head or just before your close body tag. -->
				<script src="https://apis.google.com/js/platform.js" async defer></script>
                <!-- Place this tag where you want the +1 button to render. -->
                <div class="g-plusone" data-size="medium"></div>
                
                
                </div>
                        
					</div>
					
					<div class="col-lg-8 product_details">
						<div class="product_info">
						 <?php /*?> <h1 itemprop="name"><font><font class=""><?php echo $adv_name;?></font></font></h1>
						  <div class="state"><font><font><?php echo $product_cond;?></font></font></div><?php */?>
                          
                          
                          <div class="details-new">
							<div class="left_side-new details_new23">
							   <form class="order_now" name="orderform" id="orderform" accept-charset="UTF-8" action="#" method="post">
								<input type="hidden" value="purchase-confirm" name="cmd">
								<input type="hidden" value="<?php echo $adv_id;?>" name="pid" id="pid">
								<!--<div class="order_label"><font><font>Price:</font></font></div>-->
								<h2><?php echo $adv_name;?></h2>
								<div class="clearing order_spacer"></div>
                               
                                <div itemprop="price" class="order_price-new"><!--<font><font style="font-size:29px !important; color:#cc0607;font-weight:bold;">--> <?php echo PRICE;?> : <?php echo $price.' '.$currency;?></font></font></div>
                                <div class="clearing order_spacer"></div>
								<div class="order_label-new"><?php echo QUANTITYS;?>:</div>
								<div class="order_qty">
                                 <select id="qty" name="qty">
                                <?php
								if(isset($SalesOrder) && !empty($SalesOrder))
								{
										$quantity=$quantity-$SalesOrder[0]['orderqty'];
								}
								if($quantity!='')
								{
									for($startqty=1; $startqty<=$quantity; $startqty++)
									{
										?>
                                        <option value="<?php echo $startqty;?>"><?php echo $startqty;?></option>
                                        <?php
									}
								}
								else
								{
									?>
                                    <option value="0">0</option>
                                    <?php
								}
								?>                                
                                </select>
                                
								  <?php echo PCS;?>.
							    </div>
								<div class="clearing order_spacer"></div>
								<div style="padding-left: 15px;" class="btn_option_wrapper"> 
								 
                                 
                                          
         
      <!--<button class="cancelbtn" name="order_now_submit" style="width:80%;margin:10px 7% 5px;background-image:url(http://maasinfotech24x7.com/dezmembraripenet/images/cart_icon.png); background-position:17px 12px;float:left; background-repeat:no-repeat;">Order Now  </button>-->
        
        <div>
        <?php if($sessionuserID!=$ads_userid){?>
        <?php if($salesDetail['PostAd']['category_id']!=79){?>
            <a href="Javascript:void(0);" onclick="submitOrder();" class="cancelbtn-new"><?php echo COMMANDS;?></a> 
            <?php }?> 
        	<a href="Javascript:void(0);"  onclick="addQuestion(1);"class="savebtn-new addquestion"><?php echo ASKQUESTION;?></a>
            <?php }else{?>
            <?php if($salesDetail['PostAd']['category_id']!=79){?>
             <a href="Javascript:void(0);" onclick="alert('Nu se poate comanda pentru propriul produs .');" class="cancelbtn-new"><?php echo COMMANDS;?></a>  
             <?php }?>
        	<a href="Javascript:void(0);"  onclick="alert('Nu poti cere întrebare propriul produs .');"class="savebtn-new addquestion"><?php echo ASKQUESTION;?></a>
            <?php }?>
        </div>
       
       <div class="blue_txt2"><a href="<?php echo $base_url;?>Search/index/user_id:<?php echo $ads_userid;?>"><?php echo VIEWADS;?></a></div>  
        <div class="clearing"></div>
         <?php if($this->Session->check('User')){?>
									  <div onclick="addToFav(<?php echo $adv_id;?>)" id="add_to_fav"><?php echo ADDTOFAVORITE;?></div>
                                      <?php }else{?>
                                       <div onclick="FavLogin();" id="add_to_fav" style="margin-left:10px;"><?php echo ADDTOFAVORITE;?></div>
                                      <?php }?>
           
        <div class="clearing"></div>
  	  <div class="rating" style="margin:0; margin-top:5px;float:left;width:220px; margin-left: 8px; font-size:9px" id="rate1">
                <?php
				if($this->Session->check('User'))
				{
					$user=$this->Session->read('User');
					$rating=$this->Custom->BapCustUnisingRate($adv_id,$user['user_id']);
					if(!empty($rating))
					{
						$rateval=$rating['SalesRating']['rating'];
					}
					else
					{
						$rateval=0;
					}
				}
				else
				{
					$rateval=0;
				}
				?>
                <input id="input-21f" value="<?php echo $rateval;?>" type="number" min=0 max=5 step=0.5 data-size="md" >
                <input type="hidden" name="rateadvid" id="rateadvid" value="<?php echo $adv_id;?>" />
                </div>
				<div class="rtng_nbr2">
					<?php echo RATINGS;?>: <strong><span id="ratepoint"><?php echo $rateval;?></span>/5</strong>
				</div>
                <div class="clearing"></div>
            <div class="blue_txt2"><?php echo TOTALVIEW;?>: <?php echo $this->Custom->totalView($adv_id);?></div>    
		  </div>
       
				 </form>
							  
								
							</div>
							
						<div class="right_side-new">
                        		
                                <div class="col-lg-1 hidden-xs">
                                	<div class="half_border"></div>
                                </div>
                                <div class="spacerLT">
                                    <div class="seller_limg">
                                        <span title="Private Seller" class="label">
                                         <?php if(!empty($memberdetails)){ 
												if($memberdetails['UserMembership']['plan_img']!=''){
													if (file_exists('files/memberplanimg/60X60_'.$memberdetails['UserMembership']['plan_img'])) {
													$memberdetails_path = $base_url.'files/memberplanimg/60X60_'.$memberdetails['UserMembership']['plan_img'];
													}else{
													$memberdetails_path = $base_url.'files/memberplanimg/'.$memberdetails['UserMembership']['plan_img'];
													}
													?>
                                                <img src="<?php echo $memberdetails_path;?>" alt="dez" width="60" height="60"/>
                                                <?php }else{?>
                                                <img src="<?php echo $base_url;?>images/profileholder.png" alt="dez" width="60" height="60"/>
												<?php }}else{?>
                                                <img src="<?php echo $base_url;?>images/no_plan.png" alt="dez" width="60" height="60"/>
												<?php }?>
                                        </span> 
                                    </div>
                                    
                                    <div class="seller_limg2 details_user2">
                                        <span title="Private Seller" class="label">
                                        <br>
                                        <?php if(@$userDetail['ManageUser']['profile_img']!=''){
													
													if (file_exists('files/profileimg/40X40_'.$userDetail['ManageUser']['profile_img'])) {
													$part_img_path = $base_url.'files/profileimg/40X40_'.$userDetail['ManageUser']['profile_img'];
													}else{
													$part_img_path = $base_url.'files/profileimg/'.$userDetail['ManageUser']['profile_img'];
													}
											?>
                                        <img src="<?php echo $part_img_path;?>" alt="<?php echo @$userDetail['ManageUser']['first_name'].' '.@$userDetail['ManageUser']['last_name'];?>"/>
                                         <?php }else{?><img src="<?php echo $base_url;?>images/no_userphoto.png" alt="<?php echo @$userDetail['ManageUser']['first_name'].' '.@$userDetail['ManageUser']['last_name'];?>"/><?php }?>
                                        </span> 
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <div class="blue_txt3"><?php if(!empty($memberdetails)){echo 'Vanzator premiu';}else{echo "Vanzator liber";}?></div>   
                                    <div class="line"></div> 
                                    <div class="clearfix"></div>
                                    <div class="blue_txt4"><?php echo @$userDetail['ManageUser']['first_name'].' '.@$userDetail['ManageUser']['last_name'];?></div> 									<div class="clearfix"></div>
                                    <div class="glyphicon glyphicon-map-marker txt">  <?php echo $countyname.', '.$locationname;?> </div>
                                </div>
                                
								<div class="clearfix"></div>
									<div class="col-lg-12">
										<div class="col-lg-10">
											<a href="javascript:void(0);" class="savebtn-green phone">
												<img src="<?php echo $base_url;?>images/details-Call.png" alt=""> <?php echo PHONE;?> : <?php echo VIEW;?>
											</a>  
                                            <div class="clearing"></div>
							  					<div style="position: relative;width: 100%;margin:13px 10px 0px 0px;border-radius: 5px;" class="numdetails">
        	<h2> <?php echo WHISK;?>: <?php echo @$userDetail['ManageUser']['telephone1'];?>         </h2>
            <p><?php echo NOTICESDATAA;?></p>
          </div>             
											<div class="savebtn-green2">
												<?php $ratingPercent=$this->Custom->userAllPositivePercent($userDetail['ManageUser']['user_id']); if(is_float($ratingPercent)){echo number_format($ratingPercent, 2, '.', '');}else{echo $ratingPercent;}?>% <?php echo POSITIVERATING;?>
											</div>
											<div class="details_rating">
												<div class="rating" id="rate1">
                                                   <?php echo RATINGS;?> : 
												 <?php $avgrating=$this->Custom->userRatingcount($userDetail['ManageUser']['user_id']);
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
                            
                            <br>
                            
							<div class="clearing"></div>
                            
                         
                          <div class="box"><?php echo PRODUCTDISPLAYPAGE;?></div> 
                          </div>
						 
                          
                          
                          
						</div>
						
					</div>
					
					<div class="clearfix col-lg-12" style="height:2px;padding:  0;background:url(<?php echo $base_url;?>images/horiz_dotter_border.png);"></div>
                    
                    <div class="col-lg-12">
						<div id="product_description">
						  <h2><?php echo PRODUCTINFO;?></h2>
						  <span itemprop="description">
						<?php echo $adv_details;?>
						  
						 <!-- <h2>Related Keywords </h2>
						  <span itemprop="Keywords">
						  <p>Dezmembrez grande punto,,Automobile Junkyard Complete</p>-->
						  
						  <h3><?php echo NEEDEXPERTADVICE;?></h3>
						  <ul>
							<li class="call"><?php echo CALLUSNOWON;?> <?php echo @$userDetail['ManageUser']['telephone1'];?> </li>
							<li><?php echo ALTERNATIVEYOUCAN;?> <a href="mailto:<?php echo @$userDetail['ManageUser']['email'];?>"><?php echo EMAILUS;?> »</a></li>
							
						  </ul>
						</span></span></div>
					</div>
					
                    <div class="clearfix" style="height:20px;"></div>
                    
                    <div class="col-lg-5">
						<div class="row">
							<div id="product_spec">
						  <table width="392" cellspacing="0" cellpadding="0" summary="Brand Table for White Computer Desk - High Gloss for Home or Office" id="product_brand_table">
							<caption>
							<?php echo BRAND;?> 
							<!--<font style="font-size:12px">(Compatible with)</font>-->
							</caption>
							<tbody>
                            <?php if($adv_brand_id!='')
							{
								$brandarr=explode(",",$adv_brand_id);
								$modelarr=explode(",",$adv_model_id);
								if(!empty($brandarr))
								{
									foreach($brandarr as $brandkey => $brandid)
									{
										$brandname=$this->Custom->brand_nm($brandid);
										$modelname=$this->Custom->brand_nm($modelarr[$brandkey]);
										?>
                                        <tr>
                                        <td width="50%"><?php echo $brandname;?></td>
                                        <td><?php echo $modelname;?></td>
                                      </tr>	
                                        <?php
									}
								}
							}
							?>
                             						 
							  
							</tbody>
						  </table>
						</div>
						<!--</div>
					</div>	-->				
					
											</div>
					</div>
				
					<div class="clearfix" style="height:20px;"></div>
					<div class="clearfix col-lg-12" style="height:2px;padding:  0;background:url(<?php echo $base_url;?>images/horiz_dotter_border.png); margin-bottom:15px;"></div>
					
					<div class="datascl">
						<h2><?php echo DELIVERYANDPAYMENT;?></h2>
						<br>
						<div class="product_section product_shipping">
						  <p><font><font Delivery from </font><b>
                          <span itemscope="" itemtype="#">
                          <span itemprop="addressLocality"><font><?php echo @$locationname;?></font></span>
                          </span>
                          </b><b>
                          <span itemscope="" itemtype="http://schema.org/PostalAddress"><font> , </font></span></b><b>
                          <span itemscope="" itemtype="#"><span itemprop="addressRegion"><font><?php echo @$countyname;?></font></span></span></b><font> by: </font></font><b> <span itemscope="" itemtype="http://schema.org/PostalAddress"> <span itemprop="addressLocality"><font></font></span><font></font><span itemprop="addressRegion"><font></font></span> </span> </b><font></font></p>
						  <ul>
                          <?php if($personal_teaching==1){?>
							<li><font><font><?php echo PERSONALTEACHING;?></font></font></li>
                            <?php }?>
                            <?php if($courier==1 || $free_courier==1){
								if($free_courier==1){$cost='free';}else{$cost=$courier_cost.'RON';}
								?>
							<li><font><font class=""><?php echo COURIORDELIVERYCOST;?> <?php echo $cost;?></font></font></li>
                            <?php }?>
                            <?php if($romanian_mail==1 || $free_romanian_mail==1){
								if($free_romanian_mail==1){$rcost='free';}else{$rcost=$romanian_mail_cost.'RON';}
								?>
							<li><font><font class=""><?php echo ROMANIDELIVERYCOST;?> <?php echo $rcost;?></font></font></li>
                            <?php }?>
							
						  </ul>
                          <?php
						  $payment_mode = str_replace("Cash on delivery", "Ramburs",  $payment_mode);
						  $payment_mode = str_replace("Upon delivery", "La livrare",  $payment_mode);
						  $payment_mode = str_replace("Wire Transfer", "Transfer Bancar",  $payment_mode);
						  $payment_mode = str_replace("Banking Card", "Card de Banking",  $payment_mode);
						  $payment_mode = str_replace("Others", "alții",  $payment_mode);
						  ?>
						  <div class="clearing"></div>
						  <p></p>
						  <p><font><font> <?php echo TIMENEEDPROCEORDER;?>: </font></font><b><font><font><?php echo $time_required;?> <?php echo DAYS;?></font></font></b><font><font> . </font></font></p>
						  <p> <b><font><font><?php echo PAYMENTMETHODS;?>: </font></font></b> <span><font><font><?php echo $payment_mode;?></font></font></span> </p>
						</div>
					</div>
					
					
					
					<div class="clearfix" style="height:20px;"></div>
					<div class="clearfix col-lg-12" style="height:2px;padding:  0;background:url(<?php echo $base_url;?>images/horiz_dotter_border.png); margin-bottom:15px;"></div>
                    <?php if(!empty($warrantyDetail)){?>
                    <div class="datascl">
						<h2><?php echo GUARENTY;?></h2>
						<br>
						<div class="product_section product_shipping">
                        <?php
						if($warrantyDetail['SalesWarranty']['disclaimer_of_warranty']==1){?>
						  <p><strong><?php echo ITGIVES;?> <?php echo $warrantyDetail['SalesWarranty']['discaimer_warranty_mth'];?> <?php echo MONTHWARRENTY;?>.</strong></p>
                          <p style="padding-top:4px;"> <b><?php echo WARRENTYPOLICY;?>:</b><br />
                             <?php echo nl2br(stripslashes($warrantyDetail['SalesWarranty']['terms_of_warranty']));?>
                            </p>
                            <?php }else{?>
                            <?php echo OFFERWARRENTYY;?>
                            <?php }?>
						  
						  <div class="clearing"></div>
						</div>
					</div>
					
					
					<div class="clearfix" style="height:20px;"></div>
					<div class="clearfix col-lg-12" style="height:2px;padding:  0;background:url(<?php echo $base_url;?>images/horiz_dotter_border.png); margin-bottom:15px;"></div>
                    
                     <div class="datascl">
						<h2> <?php echo RETURNPLOY;?></h2>
						<br>
						<div class="product_section product_shipping">
                        <?php
						if($warrantyDetail['SalesWarranty']['return_policy']==1){?>
						  <p><strong><?php echo PIECECANDRETURN;?> <?php echo $warrantyDetail['SalesWarranty']['return_policy_days'];?> <?php echo DAYOFRECIVING;?></strong></p>
                          <p style="padding-top:4px;">
                          <?php
						  if($warrantyDetail['SalesWarranty']['method_return_accepted']!='')
						  {
							  $method_return_acceptString=str_replace(",", "</b> or <b>",$warrantyDetail['SalesWarranty']['method_return_accepted']);
						  }
						  ?>
                          <?php echo CHOOSERETURNS;?> <b><?php echo $method_return_acceptString;?></b> .
                          <br />
                          The <b><?php echo $warrantyDetail['SalesWarranty']['transportation_cost'];?></b> <?php echo SHALLBEARCOSTRETURNTRANS;?>.
                            </p>
                            <?php
						  if($warrantyDetail['SalesWarranty']['return_policy_info']!='')
						  {?>
                            <p>
                            <b><?php echo RETURNPOLICYINFO;?></b><br />
                            <?php echo nl2br(stripslashes($warrantyDetail['SalesWarranty']['return_policy_info']));?>
                            </p>
                            <?php }?>
                            <?php }else{?>
                            <?php echo OFFERWARRENTYY;?>
                            <?php }?>
						  
						  <div class="clearing"></div>
						</div>
					</div>
					
					
					<div class="clearfix" style="height:20px;"></div>
					<div class="clearfix col-lg-12" style="height:2px;padding:  0;background:url(<?php echo $base_url;?>images/horiz_dotter_border.png); margin-bottom:15px;"></div>
                    <?php }?>
                    
                    
                    
                    <div class="details_bottomsldier">
                        <div id="slider">
                            <ul>
                            <?php
							 if(!empty($allimg)){
								 $imgcount=1;
								foreach($allimg as $thumbimgres)
								{ 
									$sliderImg=$thumbimgres['PostadImg']['img_path'];
									if($sliderImg!=''){
										
										if (file_exists('files/postad/540X400_'.$sliderImg)) {
										$sliderImg_path = $base_url.'files/postad/540X400_'.$sliderImg;
										}else{
										$sliderImg_path = $base_url.'files/postad/'.$sliderImg;
										}
									 ?>  				
									<li>
										<table>
											<tr>
												<td>
													<a href="<?php echo $base_url.'files/postad/'.$sliderImg; ?>" target="_blank"><img src="<?php echo $sliderImg_path; ?>" alt="" /></a>
													
												</td>
											</tr>
										</table>
									</li>
									<?php
									}
								}
							 }
							 ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="clearfix" style="height:30px;"></div>
                    
					
                    <div style="width:100%;float:left; "><img style="margin-right:10px; width:30px;" src="<?php echo $base_url;?>images/g13.png"><?php echo CLICKBUTTONTOASK;?><br><div>
	    <input type="button" value="<?php echo ASKQUESTION;?>" onclick="addQuestion(1);" name="button" class="btn_dlts addquestion <?php if($sessionuserID==$ads_userid){?> sales_disabled<?php }?>" <?php if($sessionuserID==$ads_userid){?> disabled="disabled"<?php }?>>
	  </div>
</div>



<div class="clear40 col-lg-12" style="background:url(<?php echo $base_url;?>images/horiz_dotter_border.png) repeat-x center center;"></div>

 				 <div class="clear" style="height:20px;"></div>
                
                        <!--  New Question Answer panel start on 14th May  -->
                        
                        <div class="message_item questionpan">
                        <?php
                        if(!empty($salesQuestionRes) && count($salesQuestionRes)>0){
                            foreach($salesQuestionRes as $requestQustionResult)
                            {
                                 $rqid=$requestQustionResult['SalesQuestion']['question_id'];
                                $questionUserid=$requestQustionResult['SalesQuestion']['user_id'];
                                $requestuserDetail=$this->Custom->user_details($questionUserid);
                                $countyID=$requestuserDetail['country_id'];
                                $qcountyName=$this->Custom->region_nm($countyID);
                                $locationID=$requestuserDetail['locality_id'];
                                $qlocationName=$this->Custom->location_nm($locationID);
                                $is_facebook=$requestuserDetail['is_facebook'];
                                $fbid=$requestuserDetail['fb_id'];
                                $profile_img=$requestuserDetail['profile_img'];
                                $rquestion=$requestQustionResult['SalesQuestion']['question'];
                                $rcreated=$requestQustionResult['SalesQuestion']['created'];
                                $request_questionfst=$this->Custom->salesDetailReplylist($rqid);
                                $salesQuestImgRes=$this->Custom->BapCustuniSalesQuestImg($rqid);
                                ?>
                                <!--  Step  1 List  -->
                                <div class="message_content stepOne">
                                    <div class="message_top">
                                        <div class="col-lg-12 paid_seller">
                                            <div class="row">
                                                <div class="col-lg-1" style="width:40px;">
                                                    <div class="row">
                                                    <?php if($profile_img!=''){
														
														if (file_exists('files/profileimg/136X181_'.$profile_img)) {
														$profile_img_path = $base_url.'files/profileimg/136X181_'.$profile_img;
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
                                                    <?php if(!empty($salesQuestImgRes)){
                                                    		foreach($salesQuestImgRes as $salesQuestImgResult){
                                                    			$saleQuestImgPath=$base_url."files/salesquestion/".$salesQuestImgResult['SalesquestionImage']['img_file'];
		                                                    	?>
														        <div class="col-lg-3 blockimg23">
				                                                    <a href="<?=$saleQuestImgPath?>" target="_blank"><img src="<?=$saleQuestImgPath?>" alt="" style="height: auto;"></a>
				                                                </div>
				                                                <?php 
				                                            }
		                                                }?>
                                                    </div>
                                                </div>
                                                
                                                <div class="seller_Date">
                                                    <div class="msg_date"><?php echo date("F d, Y, H:i", strtotime($rcreated));?></div>
                                                </div>
                                                
                                                <?php if($ads_userid== $sessionuserID){?>
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
                                         $fstrqid=$request_qstFirst['SalesQuestion']['question_id'];
                                        $fstquestionUserid=$request_qstFirst['SalesQuestion']['user_id'];
                                        $fstParent=$request_qstFirst['SalesQuestion']['parent'];
                                        $parentQst=$this->Custom->parentSalesDetail($fstParent);
                                        $parentUser=$parentQst['SalesQuestion']['user_id'];
                                        $fstrequestuserDetail=$this->Custom->user_details($fstquestionUserid);
                                        $fstcountyID=$fstrequestuserDetail['country_id'];
                                        $fstqcountyName=$this->Custom->region_nm($fstcountyID);
                                        $fstlocationID=$fstrequestuserDetail['locality_id'];
                                        $fstqlocationName=$this->Custom->location_nm($fstlocationID);
                                        $fstis_facebook=$fstrequestuserDetail['is_facebook'];
                                        $fstfbid=$fstrequestuserDetail['fb_id'];
                                        $fstprofile_img=$fstrequestuserDetail['profile_img'];
                                        $fstrquestion=$request_qstFirst['SalesQuestion']['question'];
                                        $fstrcreated=$request_qstFirst['SalesQuestion']['created'];
                                        $rqstmemberDetail=$this->Custom->BapCustUniMembership($fstquestionUserid);
                                        $request_questionsec=$this->Custom->salesDetailReplylist($fstrqid);
                                        $fsalesQuestImgRes=$this->Custom->BapCustuniSalesQuestImg($fstrqid);
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
	                                                    <?php if(!empty($fsalesQuestImgRes)){
	                                                    		foreach($fsalesQuestImgRes as $fsalesQuestImgResult){
	                                                    			$fsaleQuestImgPath=$base_url."files/salesquestion/".$fsalesQuestImgResult['SalesquestionImage']['img_file'];
			                                                    	?>
															        <div class="col-lg-3 blockimg23" style="height: auto;">
					                                                    <a href="<?=$fsaleQuestImgPath?>" target="_blank"><img src="<?=$fsaleQuestImgPath?>" alt="" style="height: auto;"></a>
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
                                         $secrqid=$request_questionSecond['SalesQuestion']['question_id'];
                                        $secquestionUserid=$request_questionSecond['SalesQuestion']['user_id'];
                                        $secParent=$request_questionSecond['SalesQuestion']['parent'];
                                        $secparentQst=$this->Custom->parentSalesDetail($secParent);
                                        $secparentUser=$secparentQst['SalesQuestion']['user_id'];
                                        $secrequestuserDetail=$this->Custom->user_details($secquestionUserid);
                                        $seccountyID=$secrequestuserDetail['country_id'];
                                        $secqcountyName=$this->Custom->region_nm($seccountyID);
                                        $seclocationID=$secrequestuserDetail['locality_id'];
                                        $secqlocationName=$this->Custom->location_nm($seclocationID);
                                        $secis_facebook=$secrequestuserDetail['is_facebook'];
                                        $secfbid=$secrequestuserDetail['fb_id'];
                                        $secprofile_img=$secrequestuserDetail['profile_img'];
                                        $secrquestion=$request_questionSecond['SalesQuestion']['question'];
                                        $secrcreated=$request_questionSecond['SalesQuestion']['created'];
                                        $secrqstmemberDetail=$this->Custom->BapCustUniMembership($secquestionUserid);
                                        $request_questionTrd=$this->Custom->salesDetailReplylist($secrqid);
                                        $ssalesQuestImgRes=$this->Custom->BapCustuniSalesQuestImg($secrqid);
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
	                                                    <?php if(!empty($ssalesQuestImgRes)){
	                                                    		foreach($ssalesQuestImgRes as $ssalesQuestImgResult){
	                                                    			$ssaleQuestImgPath=$base_url."files/salesquestion/".$ssalesQuestImgResult['SalesquestionImage']['img_file'];
			                                                    	?>
															        <div class="col-lg-3 blockimg23" style="height: auto;">
					                                                    <a href="<?=$ssaleQuestImgPath?>" target="_blank"><img src="<?=$ssaleQuestImgPath?>" alt="" style="height: auto;"></a>
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
                                         $trdrqid=$request_questionThird['SalesQuestion']['question_id'];
                                        $trdquestionUserid=$request_questionThird['SalesQuestion']['user_id'];
                                        $trdParent=$request_questionThird['SalesQuestion']['parent'];
                                        $trdparentQst=$this->Custom->parentSalesDetail($trdParent);
                                        $trdparentUser=$trdparentQst['SalesQuestion']['user_id'];
                                        $trdrequestuserDetail=$this->Custom->user_details($trdquestionUserid);
                                        $trdcountyID=$trdrequestuserDetail['country_id'];
                                        $trdqcountyName=$this->Custom->region_nm($trdcountyID);
                                        $trdlocationID=$trdrequestuserDetail['locality_id'];
                                        $trdqlocationName=$this->Custom->location_nm($trdlocationID);
                                        $trdis_facebook=$trdrequestuserDetail['is_facebook'];
                                        $trdfbid=$trdrequestuserDetail['fb_id'];
                                        $trdprofile_img=$trdrequestuserDetail['profile_img'];
                                        $trdrquestion=$request_questionThird['SalesQuestion']['question'];
                                        $trdrcreated=$request_questionThird['SalesQuestion']['created'];
                                        $trdrqstmemberDetail=$this->Custom->BapCustUniMembership($trdquestionUserid);
                                        $trdsalesQuestImgRes=$this->Custom->BapCustuniSalesQuestImg($trdrqid);
                                        //$request_questiontrd=$this->Custom->requestReplylist($secrqid);
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
	                                                    <?php if(!empty($trdsalesQuestImgRes)){
	                                                    		foreach($trdsalesQuestImgRes as $trdsalesQuestImgResult){
	                                                    			$trdsaleQuestImgPath=$base_url."files/salesquestion/".$trdsalesQuestImgResult['SalesquestionImage']['img_file'];
			                                                    	?>
															        <div class="col-lg-3 blockimg23" style="height: auto;">
					                                                    <a href="<?=$trdsaleQuestImgPath?>" target="_blank"><img src="<?=$trdsaleQuestImgPath?>" alt="" style="height: auto;"></a>
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
                    
                        <?php echo $this->Form->create('SalesQuestion', array('id' => 'salesquestion', 'enctype' => 'multipart/form-data')); ?>
                       
                           <?php
						echo $this->Form->input('question', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));
						
						echo $this->Form->input('adv_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$adv_id));
						echo $this->Form->input('parent', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control'));
						?>
						<div class="clear" style="height:20px"></div>
						<?php
						echo $this->Form->input('img_files', array('label' => false, 'type' => 'file', 'multiple' => 'multiple', 'name' => 'data[SalesQuestion][img_files][]', 'div' => false, 'class' => 'form-control', 'style' => 'width:50%'));
						?>
						<span><i>(Maximum 8 Image allow to upload)</i></span>
                          <div class="clear" style="height:20px"></div>
                          <div class="captch">
                              <img src="<?php echo $base_url;?>captcha/captcha_code_file.php?rand=<?php echo rand();?>" id="captchaimg">
                              
                          <input type="text" class="required form-control" id="code" name="code">
                          </div>
                          <div class="clear10"></div>
                          <input type="hidden" name="adv_user_id" value="<?php echo $ads_userid;?>" />
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
					
					
					
					<div class="clearfix" style="height:20px;"></div>
					<div class="clearfix col-lg-12" style="height:2px;padding:  0;background:url(<?php echo $base_url;?>images/horiz_dotter_border.png); margin-bottom:15px;"></div>
					
					<!--<div class="datascl">
						<h2>Recent View</h2>
						
						<img src="images/recent.png" alt="">
					</div>-->
					<div class="col-lg-12">
                        
                            <div style="width:100%; margin:0 auto;  " class="recently_viewed_container"> <h2 class="viewed_title"><?php echo RECENTLYVIEW;?></h2> <div class="recently_viewed">   
                             <?php
							 
							 							// print_r($_COOKIE['recentSale']);
							if(isset($recentViews))
							{
								$recentviewcount=1;
								//$sessionSales=$recentSale;
								//krsort($sessionSales);
								$sessionSales = $recentViews;
								//print_r($sessionSales);
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
												$adv_details=stripslashes($salesDetail['PostAd']['adv_details']);
												$content=(strlen($adv_details)>30) ? substr($adv_details,0,30).'...' : $adv_details;
												$slug=stripslashes($salesDetail['PostAd']['slug']);
												$salespath=$base_url.'pages/sales-details/'.$slug;
												$salesImg=$this->Custom->BapCustUniSalesImg($sessionSalesID);
												$catnm=$this->Custom->category_name($salesDetail['PostAd']['category_id']);
												$subcatnm=$this->Custom->category_name($salesDetail['PostAd']['sub_cat_id']);
												if(!empty($salesImg))
												{
													$imgpath=$base_url.'files/postad/'.$salesImg['PostadImg']['img_path'];
													if($recentviewcount<=3)
													{
													
													if (file_exists('files/postad/80X60_'.$salesImg['PostadImg']['img_path'])) {
													$salesImg_path = $base_url.'files/postad/80X60_'.$salesImg['PostadImg']['img_path'];
													}else{
													$salesImg_path = $base_url.'files/postad/'.$salesImg['PostadImg']['img_path'];
													}
											?>
                                                  <div id="recently_viewed_<?php echo $postId;?>" class="viewed_item">
                                                  		<a title="<?php echo $adv_name;?> " href="javascript:void(0);" onclick="saveView(<?php echo $postId;?>,'<?php echo $salespath;?>');"> 
                                                            <span class="item_image">
                                                             <img width="80" height="80" alt="<?php echo $adv_name;?>" class="listimg1" src="<?php echo $salesImg_path;?>"> 
                                                            </span>
                                                            <span class="item_category"><?php echo $catnm;?> <?php echo $subcatnm;?></span> 
                                                            <span class="item_title">
                                                            <?php echo $adv_name;?>                             
                                                             </span>
                                                      	 </a> 
                                                   </div>
                                                          
                               				 <?php
													}
											 $recentviewcount++;
												}
											}
										}
									}
							}
									?>
                                                            
                               </div> 
                               </div>
                            
                        </div>
					
					
					
					
				</div>
					
				<!-- middle end -->
				
				<div class="clearfix" style="height:10px;"></div>
                

                          
			   
			</div>
		</div>
		<div class="clearfix"></div>
    </div>
	
<link href="<?php echo $base_url; ?>css/screen.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo $base_url; ?>js/easySlider1.7.js"></script>
<script type="text/javascript">
	$(document).ready(function(){	
		$("#slider").easySlider({
			auto: true, 
			continuous: true
		});
	});	
</script>

<?php
echo $this->element('footer-home');
?>