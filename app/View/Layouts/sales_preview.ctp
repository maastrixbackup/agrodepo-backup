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
			 ?>  
      <a rel="useZoom: 'zoom1', smallImage: '<?php echo $base_url;?>files/postad/<?php echo $thumbimg;?>'" class="cloud-zoom-gallery" href="<?php echo $base_url;?>files/postad/<?php echo $thumbimg;?>">
      <img class="zoom-tiny-image" src="<?php echo $base_url;?>files/postad/<?php echo $thumbimg;?>">
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
                               
                                <div itemprop="price" class="order_price-new"><!--<font><font style="font-size:29px !important; color:#cc0607;font-weight:bold;">--> Pret : <?php echo $price.' '.$currency;?></font></font></div>
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
                                
								  pcs.
							    </div>
								<div class="clearing order_spacer"></div>
								<div style="padding-left: 15px;" class="btn_option_wrapper"> 
								 
                                 
                                          
         
      <!--<button class="cancelbtn" name="order_now_submit" style="width:80%;margin:10px 7% 5px;background-image:url(http://maasinfotech24x7.com/dezmembraripenet/images/cart_icon.png); background-position:17px 12px;float:left; background-repeat:no-repeat;">Order Now  </button>-->
        
        <div>
            <a href="Javascript:void(0);" class="cancelbtn-new sales_disabled"><?php echo COMMANDS;?></a>  
        	<a href="Javascript:void(0);" class="savebtn-new addquestion sales_disabled"><?php echo ASKQUESTION;?></a>  
        </div>
       
       <div class="blue_txt2"><a href="<?php echo $base_url;?>Search/index/user_id:<?php echo $ads_userid;?>"><?php echo VIEWADS;?></a></div>  
        <div class="clearing"></div>
        <div id="add_to_fav" style="margin-left:10px;" class="sales_disabled"><?php echo ADDTOFAVORITE;?></div>
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
                <?php /*?><input id="input-21f" value="<?php echo $rateval;?>" type="number" min=0 max=5 step=0.5 data-size="md" >
                <input type="hidden" name="rateadvid" id="rateadvid" value="<?php echo $adv_id;?>" /><?php */?>
                </div>
				<?php /*?><div class="rtng_nbr2">
					<?php echo RATINGS;?>: <strong><span id="ratepoint"><?php echo $rateval;?></span>/5</strong>
				</div><?php */?>
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
												if($memberdetails['UserMembership']['plan_img']!=''){?>
                                                <img src="<?php echo $base_url;?>files/memberplanimg/<?php echo $memberdetails['UserMembership']['plan_img'];?>" alt="dez" width="60" height="60"/>
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
                                        <?php if(@$userDetail['ManageUser']['profile_img']!=''){?>
                                        <img src="<?php echo $base_url;?>files/profileimg/<?php echo $userDetail['ManageUser']['profile_img'];?>" alt="<?php echo @$userDetail['ManageUser']['first_name'].' '.@$userDetail['ManageUser']['last_name'];?>"/>
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
												<img src="<?php echo $base_url;?>images/details-Call.png" alt=""><?php echo PHONE;?> : <?php echo VIEW;?>
											</a>  
                                            <div class="clearing"></div>
							  					<div style="position: relative;width: 100%;margin:13px 10px 0px 0px;border-radius: 5px;" class="numdetails">
        	<h2> <?php echo WHISK;?>: <?php echo @$userDetail['ManageUser']['telephone1'];?>         </h2>
            <p><?php echo NOTICESDATAA;?></p>
          </div>             
											<div class="savebtn-green2">
												<?php echo $this->Custom->userAllPositivePercent($userDetail['ManageUser']['user_id']);?>% Calificative Pozitive
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
							<li class="call"><?php echo CALLUSNOWON;?> 01355 236 117</li>
							<li><?php echo ALTERNATIVEYOUCAN;?> <a href="#"><?php echo EMAILUS;?>  »</a></li>
							
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
							<li><font><font class=""><?php echo COURIORDELIVERYCOST;?><?php echo $cost;?></font></font></li>
                            <?php }?>
                            <?php if($romanian_mail==1 || $free_romanian_mail==1){
								if($free_romanian_mail==1){$rcost='free';}else{$rcost=$romanian_mail_cost.'RON';}
								?>
							<li><font><font class=""><?php echo ROMANIDELIVERYCOST;?>  <?php echo $rcost;?></font></font></li>
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
						  <p><font><font><?php echo TIMENEEDPROCEORDER;?>: </font></font><b><font><font><?php echo $time_required;?> days</font></font></b><font><font> . </font></font></p>
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
						<h2><?php echo RETURNPLOY;?></h2>
						<br>
						<div class="product_section product_shipping">
                        <?php
						if($warrantyDetail['SalesWarranty']['return_policy']==1){?>
						  <p><strong><?php echo PIECECANDRETURN;?><?php echo $warrantyDetail['SalesWarranty']['return_policy_days'];?> <?php echo DAYOFRECIVING;?></strong></p>
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
					
                    <div style="width:100%;float:left; "><img style="margin-right:10px; width:30px;" src="<?php echo $base_url;?>images/g13.png"><?php echo CLICKBUTTONTOASK;?><br><div>
	    <input type="button" value=" <?php echo ASKQUESTION;?>" name="button" class="btn_dlts addquestion <?php if($sessionuserID==$ads_userid){?> sales_disabled<?php }?>" <?php if($sessionuserID==$ads_userid){?> <?php }?>disabled="disabled">
	  </div>
</div>



<div class="clear40 col-lg-12" style="background:url(<?php echo $base_url;?>images/horiz_dotter_border.png) repeat-x center center;"></div>

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
                    
                        <?php echo $this->Form->create('SalesQuestion'); ?>
                       
                           <?php
						echo $this->Form->input('question', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));
						
						echo $this->Form->input('adv_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$adv_id));
						?>
                          <div class="clear" style="height:20px"></div>
                          <div class="captch">
                              <img src="<?php echo $base_url;?>captcha/captcha_code_file.php?rand=<?php echo rand();?>" id="captchaimg">
                              
                          <input type="text" class="required form-control" id="code" name="code">
                          </div>
                          <div class="clear10"></div>
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
												<label for="exampleInputEmail2">?php echo PASSWORD;?></label>
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
												<a href="#">
													<img src="<?php echo $base_url;?>images/facebook_login_button.png" alt="" style="width:183px; margin-top:5px;">
												</a>
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
                        <font><font><?php echo PERSONALINFODATA;?></font></font>
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
							if($this->Session->check('recentsales'))
							{
								$recentviewcount=1;
								$sessionSales=$this->Session->read('recentsales');
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
											?>
                                                  <div id="recently_viewed_<?php echo $postId;?>" class="viewed_item">
                                                  		<a title="<?php echo $adv_name;?> " href="javascript:void(0);" onclick="saveView(<?php echo $postId;?>,'<?php echo $salespath;?>');"> 
                                                            <span class="item_image">
                                                             <img width="80" height="80" alt="<?php echo $adv_name;?>" class="listimg1" src="<?php echo $imgpath;?>"> 
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
<?php
echo $this->element('footer-home');
?>