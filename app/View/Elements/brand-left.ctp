<?php
if(isset($this->request->params['named']['category']))
{
	$paramcat=$this->request->params['named']['category'];
}
else
{
	$paramcat='';
}
$parambrand=(isset($this->request->params['named']['brand']))? $this->request->params['named']['brand'] : '';
$paramcounty=(isset($this->request->params['named']['county']))? $this->request->params['named']['county'] : '';
$parampostkeywords=(isset($this->request->params['named']['postkeywords']))? urldecode($this->request->params['named']['postkeywords']) : '';
?>
<!-- Left Sidebar Start -->
					<div class="col-md-3">
						<div class="block block-cat-menu">
							<div class="block-heading">
								<div class="symbol"><?php echo TRADESHOWS;?></div>
							</div>
							
                                <div class="search_filters">
                                
                                <!--  Categories section start  -->
                                
                               <?php /*?> <div id="place_subcat">
                                  <?php
								  if(isset($this->request->params['named']['category']))
									{
										$paramcat=$this->request->params['named']['category'];
										$catdetails=$this->Custom->dezSingCat($this->request->params['named']['category']);
									}
									else
									{
										$catdetails=array();
										$paramcat='';
									}
								  ?>
                                    <ul class="filter_list <?php if(!empty($catdetails)){echo "expand_all";}else{ echo "expand_normal";}?>" id="cat_list">
                                        <li class="fl_head"><font><?php CATEGORIES;?></font>
                                           <!-- <a class="fl_unset" href="javascript:void(0)" onClick="del_filter('ser_category')" title="Remove filter" rel="nofollow" style="color:#FF0000;font-size:9px;">[x] Delete Filter</a>-->
                                        </li>
                                        <?php
										$leftcat=$this->Custom->dez_categories();
										//print_r($catlist);
										if(!empty($leftcat)){
											
											foreach($leftcat as $leftcatres)
											{
												
											$fetchcat=$leftcatres['SalesCategory']['category_id'];	
											$totpostcat=$this->Custom->dezPostAdsCount('category_id',$fetchcat,$parambrand,$paramcounty,$parampostkeywords);
											if($leftcatres['SalesCategory']['slug']!=''){$parentCatSlug=$leftcatres['SalesCategory']['slug'];}else{$parentCatSlug=$leftcatres['SalesCategory']['category_id'];}	
										?>
                                        
                                        <li class="fl_item fl_item_visible">
                                           <label>
                                                <input type="checkbox" id="catlist<?php echo $parentCatSlug;?>" class="camch catmatch" onClick="categoryList('<?php echo $parentCatSlug;?>', 'category')"<?php if($paramcat==$fetchcat){?> checked="checked"<?php }?> value="<?php echo $parentCatSlug;?>">
                                                <b><font><?php echo $leftcatres['SalesCategory']['category_name'];?> (<?php echo $totpostcat;?>) </font></b>
                                            </label>
                                            <?php
											if(!empty($catdetails))
											{
												if($catdetails['SalesCategory']['flag']==0)
												{
													if($this->request->params['named']['category']==$leftcatres['SalesCategory']['category_id'])
													{
														$subcatlist=$this->Custom->dez_categories($leftcatres['SalesCategory']['category_id']);
														
													}
													else
													{
														$subcatlist=array();
													}
													
												}
												else
													{
														if($catdetails['SalesCategory']['flag']==$leftcatres['SalesCategory']['category_id'])
														{
															$subcatlist=$this->Custom->dez_categories($leftcatres['SalesCategory']['category_id']);
															
														}
														else
														{
															$subcatlist=array();
														}
													}
													if(!empty($subcatlist))
														{
														?>
                                                         <ul class="filter_list">
                                                         	<?php
															foreach($subcatlist as $subcatres)
															{
																if($subcatres['SalesCategory']['slug']!=''){$subCatSlug=$subcatres['SalesCategory']['slug'];}else{$subCatSlug=$subcatres['SalesCategory']['category_id'];}	
																$fetchsubcat=$subcatres['SalesCategory']['category_id'];
																$totpostsubcat=$this->Custom->dezPostAdsCount('sub_cat_id',$fetchsubcat,$parambrand,$paramcounty,$parampostkeywords);
																?>
                                                                 <li class="fl_item">
                                                               <label>
                                                                    <input type="checkbox" id="subcatlist<?php echo $subCatSlug;?>" class="camch catmatch" onClick="subCategoryList('<?php echo $subCatSlug;?>', '<?php echo $parentCatSlug;?>', 'category')"<?php if($paramcat==$fetchsubcat){?> checked="checked"<?php }?> value="<?php echo $subCatSlug;?>">
                                                                    <b><font><?php echo $subcatres['SalesCategory']['category_name'];?> (<?php echo $totpostsubcat;?>) </font></b>
                                                                </label>
                                                                </li>
                                                                <?php
															}
															?>
                                                         </ul>
                                                        <?php
														}
											}
											?>
                                        </li>
                                        <?php
											}
										}
										?>
                                    </ul>
 
                                    <div id="expand1" class="expand" onClick='show_all("cat_list","show","expand")'<?php if(!empty($catdetails)){?> style="display:none;"<?php }?>>More</div>
                                    <div id="expand2" class="expand" onClick='show_all("cat_list","hide","expand")'<?php if(empty($catdetails)){?> style="display:none;"<?php }?>>Less</div>
                                    
                                </div><?php */?>
                                <!--  Categories section end  -->
                                
                                
                                <!--  Make / Model section start  -->
                                
                                <div id="place_model">
                                <?php
								if(isset($this->request->params['named']['brand']))
								{
									$branddetail=$this->Custom->dezSingBrand($this->request->params['named']['brand']);
									$param_brand=$this->request->params['named']['brand'];
								}
								else
								{
									$param_brand='';
									$branddetail=array();
								}
								$brandlist=$this->Custom->dezBrand();
								if(!empty($brandlist))
								{
									
								?>
                                    <ul class="filter_list <?php if(!empty($branddetail)){echo "expand_all";}else{ echo "expand_normal";}?>" id="brand_list">
                                    <li class="fl_head"><font><?php echo BRAND;?> / <?php echo MODEL;?></font>
                                         <!--   <a class="fl_unset" href="javascript:void(0)" onClick="del_filter('ser_category')" title="Remove filter" rel="nofollow" style="color:#FF0000;font-size:9px;">[x] Delete Filter</a>-->
                                        </li>
                                    <?php
									//print_r($brandlist);
									foreach($brandlist as $brandres)
									{
										$brandtitle=stripslashes($brandres['SalesBrand']['brand_name']);
										$brandid=$brandres['SalesBrand']['brand_id'];
										$brandSlug=$brandres['SalesBrand']['slug'];
										
										$totpostbrand=$this->Custom->dezPostAdsBrandCount($brandid,$paramcat,$paramcounty,$parampostkeywords);
										if($brandres['SalesBrand']['slug']!=''){$parentBrandSlug=$brandres['SalesBrand']['slug'];}else{$parentBrandSlug=$brandres['SalesBrand']['brand_id'];}
									?>
                                        <li class="fl_item fl_item_visible">
                                            <label>
                                                <input type="checkbox" id="brand<?php echo $parentBrandSlug;?>" class="camch brandmatch" onClick="brandList('<?php echo $parentBrandSlug;?>', 'brand')"<?php if($param_brand==$brandid){?> checked="checked"<?php }?> value="<?php if($brandSlug!=''){echo $brandSlug;}else{echo $brandid;}?>">
                                                <b><font><?php echo $brandtitle;?> (<?php echo $totpostbrand;?>) </font></b>
                                            </label>
                                            <?php
											if(!empty($branddetail))
											{
												if($branddetail['SalesBrand']['flag']==0)
												{
													if($param_brand==$brandid)
													{
														$modellist=$this->Custom->dezBrand($brandid);
													}
													else
													{
														$modellist=array();
													}
												}
												else
												{
													if($branddetail['SalesBrand']['flag']==$brandid)
													{
														$modellist=$this->Custom->dezBrand($brandid);
													}
													else
													{
														$modellist=array();
													}
												}
												if(!empty($modellist))
												{
													?>
                                                    <ul class="filter_list">
                                                    <?php
													foreach($modellist as $modelres)
													{
														$modelid=$modelres['SalesBrand']['brand_id'];
														$modelname=stripslashes($modelres['SalesBrand']['brand_name']);
														$totpostmodel=$this->Custom->dezPostAdsModelCount($modelid,$paramcat,$paramcounty,$parampostkeywords);
														$modelSlug=$modelres['SalesBrand']['slug'];
														if($modelres['SalesBrand']['slug']!=''){$subModelSlug=$modelres['SalesBrand']['slug'];}else{$subModelSlug=$modelres['SalesBrand']['brand_id'];}
														?>
                                                         <li class="fl_item">
                                                        <label>
                                                            <input type="checkbox" id="model<?php echo $subModelSlug;?>" class="camch brandmatch" onClick="modelList('<?php echo $subModelSlug;?>', '<?php echo $parentBrandSlug;?>', 'brand')"<?php if($param_brand==$modelid){?> checked="checked"<?php }?> value="<?php if($modelSlug!=''){echo $modelSlug;}else{echo $modelid;}?>">
                                                            <b><font><?php echo $modelname;?> (<?php echo $totpostmodel;?>) </font></b>
                                                        </label>
                                                        </li>
                                                        <?php
													}
													?>
                                                    </ul>
                                                    <?php
												}
											}
											?>
                                        </li>
                                        <?php
									}
										?>
                                        </ul>
                                        <?php
								}
								?>
                                         <div id="expand21" class="expand" onclick="show_all('brand_list','show','expand2')"<?php if(!empty($branddetail)){?> style="display:none;"<?php }?>>More</div>
                                        <div id="expand22" class="expand" onclick="show_all('brand_list','hide','expand2')"<?php if(empty($branddetail)){?> style="display:none;"<?php }?>>Less</div>
                                </div>
                                
                                <!--  Make / Model section end  -->
                                
                                
                                <!--  Price section start  -->
                                
                                <ul class="filter_price" style="width:95%;padding-left:15px;">
                                  <p>
                                
                                  <li class="fl_head"> <label for="amount"><?php echo PRICERANGE;?></label></li>
                                   <input type="text" id="start_amt" name="start_amt" readonly="readonly">
                                    <input type="text" id="end_amt" name="end_amt" readonly="readonly">
                                  </p>
                                  <div id="slider-range"></div><div style="padding-top:10px; text-align:right;"><input type="button" onClick="priceList('brand');" value=
                                  "<?php echo CONTIN;?>"></div>
                                  
                                  </ul>
                                
                                <!--  Price section end  -->
                                 
                                 
                                <!--  County section start  -->
                                
                                <div id="place_model">
                                <?php
								$countylist=$this->Custom->dezCounty();
								if(!empty($countylist))
								{
									if(isset($this->request->params['named']['county']))
									{
										$county=$this->request->params['named']['county'];
									}
									else
									{
										$county='';
									}
								?>
                                    <ul class="filter_list <?php if(!empty($county)){echo "expand_all";}else{ echo "expand_normal";}?>" id="city_list">
                                        <li class="fl_head"><font><?php echo COUNTRY;?> </font>
                                          <!--  <a class="fl_unset" href="javascript:void(0)" onClick="del_filter('ser_category')" title="Remove filter" rel="nofollow" style="color:#FF0000;font-size:9px;">[x] Delete Filter</a>-->
                                        </li>
                                        <?php
										foreach($countylist as $countyres)
										{
											//print_r($countylist);
											$countyname=stripslashes($countyres['MasterCountry']['country_name']);
											$contryid=stripslashes($countyres['MasterCountry']['country_id']);
											$totcounty=$this->Custom->dezPostAdscountyCount($contryid, $paramcat, $parambrand,$parampostkeywords);
										?>
                                        <li class="fl_item fl_item_visible">
                                             <label>
                                                <input type="checkbox" id="county<?php echo $contryid;?>" class="camch countymatch" onClick="countyList(<?php echo $contryid;?>,'brand')"<?php if($county == $contryid){?> checked="checked"<?php }?> value="<?php echo $contryid;?>">
                                                <b><font><?php echo $countyname;?> (<?php echo $totcounty;?>) </font></b>
                                            </label>
                                        </li>                                     
                                        <?php
										}
										?>
                                        </ul>
                                        <?php
								}
								?>
                                        
                                        <div id="expand31" class="expand" onclick="show_all('city_list','show','expand3')"<?php if(!empty($county)){?> style="display:none;"<?php }?>>More</div>
                                        <div id="expand32" class="expand" onclick="show_all('city_list','hide','expand3')"<?php if(empty($county)){?> style="display:none;"<?php }?>>Less</div>
                                </div>
                                
                                <!--  County section end  -->
                                
                                
                                
                                <!--  Product Condition section start  -->
                                
                                <ul class="filter_text">
                                    <li class="fl_head">
                                        <font><?php echo SELLER;?></font>
                                       <!-- <a class="fl_unset" href="javascript:void(0)" onClick="del_filter('seller')" title="Remove filter" rel="nofollow" style="color:#FF0000;font-size:9px;">[x] Delete Filter</a>-->
                                    </li>
                                    <li class="fl_item">
                                    <?php
									if(isset($this->request->params['named']['seller']))
									{
										$seller=urldecode($this->request->params['named']['seller']);
									}
									else
									{
										$seller='';
									}
									?>
                                        <input type="text" class="text" name="seller" id="seller" value="<?php echo $seller;?>">
                                        <font>
                                            <input type="button" class="submit" value="<?php echo SEARCH;?>" onClick="sellerList('brand');">
                                        </font>
                                    </li>
                                </ul>
                                
                                <!--  Product Condition section end  -->
                                  
                             </div> 
									   
						</div>       	
						 
                        <div class="clear"></div>
                        
                        <div class="belowmenu">
                        	<!--<a href="#"><img src="<?php echo $base_url;?>images/add2.png" alt="" style="width:100%;"></a>-->				
                           
                            <?php 
							
							$ad_details=$this->Custom->leftOneAd();
							if(!empty($ad_details))
							{
							$ad_details=$ad_details['Advertisement'];
							//pr($ad_details);
							if($ad_details['ad_type']==1){ // for banner type
									?>
									 <a href="<?php echo $ad_details['banner_link'];?>" target="_blank">
                            <img src="<?php echo $this->webroot.'files/advertisement/'.$ad_details['banner_image'];?>" alt="<?php echo $ad_details['banner_title'];?>" style="width:100%;">
                            </a>
									<?php
								}elseif($ad_details['ad_type']==2){ // for script type
									
									echo stripslashes($ad_details['ad_script']);
								}
							}
							
							?>
                             
                            
                            <div class="clear"></div>
                        </div>
                        
                        
                        
					</div>
				<!-- Left Sidebar End -->