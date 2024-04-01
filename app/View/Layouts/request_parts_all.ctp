<?php
echo $this->element('header-home');
?>
 <div class="container">
		<div class="row">
					
			<div class="innerpanel">
			
				<?php 
				//echo $this->element('sql_dump');
				//pr($active_request);?>
				
				<!-- Right Sidebar Start -->
				<div class="col-md-12">
					<div class="clearfix" style="height:15px;"></div>
					
                        <div id="breadcrumb">
                            <ul class="crumbs">
                                <li class="first">
                                	<a style="z-index:9;" href="<?php echo $this->webroot;?>pages/request-parts"><span></span><?php echo HOME;?></a>
                                </li>
                                <!--<li><a style="z-index:8;" href="#">Engine Parts</a></li>-->
                                <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo FILTER;?> </a></li>   
                            </ul>
                        </div>
                        
                    <div class="clear"></div>
                    
					<article>
						<div class="searchlist1">
                        	<h2><!--Auto Parts category--> <span><?php echo FILTER;?></span></h2>
                            
                            <div class="col-lg-12 reficetab">
                            	<div class="row">
                                	<div class="col-xs-2 .col-sm-2">
                                    	<h1 class="tabtitle1"><img src="<?php echo $base_url;?>images/icon_filter.png" style="margin-bottom:5px;"><?php echo FILTER;?></h1>
                                    </div>
                                    
                                    <div class="col-lg-2 .col-sm-2">
                                    	<div class="row">
                                            <span class="filter-box1">
                                           
													
                                            	<select class="form-control" id="brand_id" onChange="getSubBrand()">
                                                    <option selected="selected" value=""><?php echo ALLBRANDD;?></option>
                                                    <?php 
													$brand=$this->Custom->dezBrand();
													//pr($brand);
													foreach($brand AS $k => $v){?>
														<option value="<?php echo $v['SalesBrand']['brand_id'];?>" <?php if($v['SalesBrand']['brand_id']==$brand_id && $brand_id!='' && isset($brand_id)){echo 'selected=selected'; } ?>><?php echo $v['SalesBrand']['brand_name'];?></option>
														<?php }
													?>
                                                   
                                                </select>
                                            </span><br><br>
                                            
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-lg-2 .col-sm-2">
                                    	<div class="row">
                                            <span class="filter-box1">
                                            	<select class="form-control" id="model_id" onchange="searchTxt()">
                                                <option selected="selected" value=""><?php echo ALLMODEELS;?></option>
                                                <?php if(isset($brand_id) || isset($model_id) ){
													$sub_brand=$this->Custom->subBrand($brand_id);
									foreach($sub_brand As $k=>$v){
										?>
										<option value="<?php echo $k;?>" <?php if($k==$model_id && isset($model_id) ){ echo 'selected';}?>><?php echo $v;?></option>
										<?php
										}
									}?>   
                                                </select>
                                            </span><br><br>
                                         <!--   <span class="sortby">Sort By: </span>-->
                                        </div>
                                    </div>
                                    
                                    
                                    
                              <!--      <div class="col-lg-2 .col-sm-2">
                                    	<div class="row">
                                            <span class="filter-box1">
                                            	<select class="form-control" onChange="shortBychange(this)">
                                                    <option selected="selected" value="popular">New parts</option>
                                                    <option value="phigh">Date (descending)</option>
                                                    <option value="plow">Price (low to high)</option>
                                                    <option value="hdiscount">Price (high to low)</option>
                                                </select>
                                            </span><br><br>
                                           
                                        </div>
                                    </div>
                                    -->
                                    
                                    
                                    <div class="col-lg-2 .col-sm-2">
                                    	<div class="row">
                                            <span class="filter-box1">
                                            <?php
											
											 $application=array("2"=>"Requests resolved","1"=>"Requests active","0"=>"Requests inactive");
											?>
                                            
                                            	<select class="form-control" id="app_id" onchange="searchTxt()">
                                                    <option  value="" selected="selected"><?php echo ALLAPPLICATION;?></option>
                                                    <?php foreach($application AS $k=>$v){ 
														?>
                                                        <option value="<?php echo $k;?>" <?php if(isset($app_id)&& $app_id!='' && $app_id==$k){ echo "selected";}?>><?php echo $v;?></option>
														<?php
														}?>
                                                  
                                                </select>
                                            </span><br><br>
                                           <!-- <span class="sortby">Sort By: </span>-->
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-lg-2 .col-sm-2">
                                    	<div class="row">
                                            <span class="filter-box1">
                                            	<select class="form-control" id="county_id" onchange="searchTxt()">
                                                    <option selected="selected" value=""><?php echo ALLCOUNTRY;?></option>
                                                    <?php 
													$county=$this->Custom->getAllCounty();
													foreach($county AS $k=>$v){ ?>
														<option value="<?php echo $k;?>" <?php if(@$county_id==$k && isset($county_id)) echo 'selected';?>><?php echo $v;?></option>
													<?php	}
													?>
                                                </select>
                                            </span>
                                            <!--<span class="sortby">Sort By: </span>-->
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            
                            <div class="clear" style="height:15px;"></div>
                            
                            <div class="col-lg-12">
                            	<div class="row searchlistdata">
                                	<ul>
                                    	
                                        	<!--<div class="col-lg-2">
                                            	<div class="row">
                                                	<a href="#">
                                                        <img src="images/promt13.jpg" class="listimg1" alt="">
                                                    </a>
                                                </div>
                                            </div>-->
                                            
                                           
                                                <?php foreach($active_request AS $key=>$val){
												
													$rp=$val['RequestPart'];
													$ra=$val['RequestAccessory'];
													?>
                                                    <li>
                                                    <div class="col-lg-10">
                                            	<div class="datalistitem">
                                  <div class="filter-txt"><b><?php echo $this->Custom->brand_nm($rp['brand_id']).' '.$this->Custom->brand_nm($rp['model_id']).' '.$rp['version'].' ';?></b><?php echo $rp['yr_of_manufacture'].' '.$rp['vehicle_identy_no'].' '.$rp['engines']; ?></div>
                     <p>
                   <?php if(date('Y-m-d',strtotime($rp['modified']))==strtotime(date('Y-m-d'))){
					  $day= "today";
					  ?>
					  <img src="<?php echo $base_url;?>images/symbol1.jpg" align="top">
					  <?php
				}else if(date('Y-m-d',strtotime($rp['modified']))==date('Y-m-d',strtotime('-1 day'))){
						   $day= "yesterday"; 
						   }else{
							    $day =date('F d, Y',strtotime($rp['modified']));
							   }?>
                                   <?php echo POSTEDON;?><?php echo date('F d, Y',strtotime($rp['created'])); ?> (updated <?php echo $day." "; ?> hour <?php echo date('h:i',strtotime($rp['modified'])); ?>) <?php echo DELIVERYIN;?> <?php echo $this->Custom->region_nm($rp['county']).', '.$this->Custom->location_nm($rp['city']);?>
                       </p>
                 <div class="clear" style="height:5px;"></div>
                  <div class="cl_items">
                                                  <?php //$request_flag=1;
											$partlist=$this->Custom->getAllParts($rp['request_id'],$request_flag);
												 // pr($partlist);
												 if(!empty($partlist)){
												  foreach($partlist AS $k=>$v){
													 $parts=$v['RequestAccessory'];
													 ?>
													  <div class="col-lg-5">
                                            <a target="_blank" href="<?php echo $this->webroot.'pages/request-parts/'.$parts['slug'];?>" title="<?php echo $parts['name_piece'];?>"><span class="cl_item_arrow"></span><span class="cl_item_title"><!--<img src="<?php //echo $base_url;?>images/symbol2.png" align="top">-->&nbsp;<?php echo $parts['name_piece'];?></span><span class="cl_item_nroffers">(<?php echo $parts['offerno'];?> <?php echo OFFER;?>)</span></a></div>
													 <?php 
													}
												 }
												  ?>  
                                                  </div>
                                              
                                                    <!--<div class="sr_user_isseller">
                                                    	Seller Premium
                                                        <br>
                                                        <span>SECAUTO 1</span>
                                                    </div>-->
                                                </div>
                                            </div>
                                   <!--<div class="col-lg-2">
                                            	<div class="row">
                                                	<div class="sr_price">
                                                    	<h3>PRICE</h3>
                                                        <span>570 EUR</span>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <div class="clearfix"></div>
                                        </li>
													<?php
													} ?>
                                        
                                    </ul>
                              </div>
                            </div>
                             <!-- CakePHP Pagination-->
           <div class="paging">
		<?php
            echo $this->Paginator->prev( __('«'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('»'), array(), null, array('class' => 'next disabled'));
        ?>
        </div>
        <!-- CakePHP Pagination End-->
                        </div>
						<div class="clearfix"></div>
					</article>
					
			  </div>
				<!-- Right Sidebar end -->
				
				<div class="clearfix" style="height:1px;"></div>
                
                
                 
                
                          
			   
			</div>
		</div>
		<div class="clearfix"></div>
    </div>
<?php
echo $this->element('footer-home');
?>
