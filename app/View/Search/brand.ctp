<article>
<?php //print_r($SearchRes);?>
<?php //echo $this->element('sql_dump'); ?>
    <div class="searchlist1">
       <!-- <h2>Car parts.</h2>-->
         <?php
            /*if($this->Session->check('User')){
                $sesUserDetail=$this->Session->read('User');
                $sessUserID=$sesUserDetail['user_id'];
                $alertDetail=$this->Custom->BapCustuniAlertResult($sessUserID);
                if(!empty($alertDetail)){
                    $brands=explode(",", $alertDetail['SubscribeAlert']['brand_list']);
                    $categories=explode(",", $alertDetail['SubscribeAlert']['categories']);
                    $counties=explode(",", $alertDetail['SubscribeAlert']['couties']);

                    ?>
                   <div class="col-lg-12 reficetab">
            <div class="row">
                <div class="col-lg-2">
                    <h1 class="tabtitle1">You Have Subscribed To</h1>
                </div>
                
                <div class="col-lg-9">
                    <div class="row">
                        <?php if(!empty($brands)){
                            $brandArr=array();
                            foreach ($brands as $brandID) {
                               $brandDetail=$this->Custom->getBrandDetail('brand_id', $brandID);
                               array_push($brandArr, $brandDetail['ManageBrand']['brand_name']);
                            }
                            echo implode(", ", $brandArr);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="clear" style="height:15px;"></div>
                    <?php
                }
            }*/
            ?>
        <div class="col-lg-12 reficetab">
            <div class="row">
                <div class="col-lg-5">
                    <h1 class="tabtitle1"><?php echo CARPARTS;?></h1>
                </div>
                
                <div class="col-lg-7">
                    <div class="row">
                        <span class="select-box1">
                            <select onChange="sortBy(this.value, 'brand');">
                            <?php if(isset($this->request->params['named']['sort'])){?>
                                <option value="sort:created/direction:asc"<?php if($this->request->params['named']['sort']=='created' && $this->request->params['named']['direction']=='asc'){?> selected="selected"<?php }?>><?php echo DATEASCENDING;?></option>
                                <option value="sort:created/direction:desc"<?php if($this->request->params['named']['sort']=='created' && $this->request->params['named']['direction']=='desc'){?> selected="selected"<?php }?>><?php echo DATEDESCENDING;?></option>
                                <option value="sort:price/direction:asc"<?php if($this->request->params['named']['sort']=='price' && $this->request->params['named']['direction']=='asc'){?> selected="selected"<?php }?>><?php echo PRICELOWHIGH;?></option>
                                <option value="sort:price/direction:desc"<?php if($this->request->params['named']['sort']=='price' && $this->request->params['named']['direction']=='desc'){?> selected="selected"<?php }?>><?php echo PRICEHIGHLOW;?></option>
                                <?php }else{?>
                                 <option value="sort:created/direction:asc"><?php echo DATEASCENDING;?></option>
                                <option value="sort:created/direction:desc"><?php echo DATEDESCENDING;?></option>
                                <option value="sort:price/direction:asc"><?php echo PRICELOWHIGH;?></option>
                                <option value="sort:price/direction:desc"><?php echo PRICEHIGHLOW;?></option>
                                <?php }?>
                            </select>
                        </span>
                        <span class="sortby"><?php echo SORTBY;?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="clear" style="height:15px;"></div>
        
        <div class="col-lg-12">
            <div class="row searchlistdata">
           
            <?php
			if(!empty($SearchRes))
			{
				?>
                <ul>
                <?php
				foreach($SearchRes as $searchResult)
				{
					$posttitle=stripslashes($searchResult['PostAd']['adv_name']);
					$postcontent=stripslashes($searchResult['PostAd']['adv_details']);
					$postcontent=(strlen(strip_tags($postcontent))>140)? substr(strip_tags($postcontent),0,140) : strip_tags($postcontent);
					$postprice=stripslashes($searchResult['PostAd']['price']);
					$postcurrency=stripslashes($searchResult['PostAd']['currency']);
					$postID=$searchResult['PostAd']['adv_id'];
					$userID=$searchResult['PostAd']['user_id'];
					//$imglist=$this->requestAction('Search/getfirstimg/'.$searchResult['PostAd']['adv_id']);
					$imglist=$this->Custom->AdvImage($searchResult['PostAd']['adv_id']);
					$salespath=$base_url.'pages/sales-details/'.$searchResult['PostAd']['slug'];
					//print_r($imglist);
					$user_details=$this->Custom->user_details($userID);
					$contyID=$user_details['country_id'];
					$locationID=$user_details['locality_id'];
					$countyName=$this->Custom->region_nm($contyID);
					$locationName=$this->Custom->location_nm($locationID);
					$memdetail=$this->Custom->BapCustUniMembership($userID);
					//print_r($imglist);
					?>
                    <li>
                        <div class="col-lg-2">
                        <?php if(isset($imglist) && $imglist!=''){
								if (file_exists($base_url.'files/postad/133X100_'.stripslashes($imglist))) {
								$imglist_path = $base_url.'files/postad/133X100_'.stripslashes($imglist);
								}else{
								$imglist_path = $base_url.'files/postad/'.stripslashes($imglist);
								}
							?>
                            <div class="row">
                                <a href="javascript:void(0);" onclick="saveView(<?php echo $postID;?>,'<?php echo $salespath;?>');">
                                    <img src="<?php echo $imglist_path ;?>" class="listimg1" alt="<?php echo $posttitle;?>">
                                </a>
                            </div>
                            <?php }?>
                        </div>
                        
                        <div class="col-lg-8">
                            <div class="datalistitem">
                                <h1><a href="javascript:void(0);" onclick="saveView(<?php echo $postID;?>,'<?php echo $salespath;?>');"><?php echo $posttitle;?></a></h1>
                                <p>
                                   <?php echo $postcontent;?>
                                </p>
                                <div class="clear" style="height:5px;"></div>
                                <div class="sr_user_isseller">
                                <?php if(!empty($memdetail)){
									if (file_exists($base_url.'files/memberplanimg/40X56_'.$memdetail['UserMembership']['plan_img'])) {
									$memdetail_path = $base_url.'files/memberplanimg/40X56_'.$memdetail['UserMembership']['plan_img'];
									}else{
									$memdetail_path = $base_url.'files/memberplanimg/'.$memdetail['UserMembership']['plan_img'];
									}
									?>
                                	<img src="<?php echo $memdetail_path;?>" alt="<?php echo $memdetail['UserMembership']['memb_type'];?>" />
                                    <?php }?>
                                    <?php 
									if(!empty($memdetail))
									{
									echo "Seller ".$memdetail['UserMembership']['memb_type'].'<br>';
									}
									?>
                                    
                                    <span><?php echo $user_details['first_name'].' '.$user_details['last_name'];?></span>
                                </div>
                                <div class="glyphicon glyphicon-map-marker txt"><?php echo $countyName;?>, <?php echo $locationName;?></div>
                            </div>
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="row">
                                <div class="sr_price">
                                    <h3>PRICE</h3>
                                    <span><?php echo $postprice.' '.$postcurrency;?></span>
                                </div>
                            </div>
                        </div>
						<a  href="javascript:void(0);" onclick="saveView(<?php echo $postID;?>,'<?php echo $salespath;?>');" class="detailstag"><?php echo DETAILS;?></a>
                        <div class="clearfix"></div>
                    </li>
					<?php
				}
				?>
                </ul>
                <?php
				
			}
			else
			{
				?>
                <h2 align="center"><?php echo NORESULTFOUND;?></h2>
                <?php
			}
			?>
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