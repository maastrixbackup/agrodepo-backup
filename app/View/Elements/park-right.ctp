	<div class="col-lg-12">
                            
								<div class="row">
									
									<?php
									if(!empty($recentparts))
									{
										foreach($recentparts as $recentpartsRes)
										{
											$park_name=stripslashes($recentpartsRes['SalesPark']['park_name']);
											$logo=stripslashes($recentpartsRes['SalesPark']['logo']);
											$comp_name=stripslashes($recentpartsRes['SalesPark']['comp_name']);
											$slug=stripslashes($recentpartsRes['SalesPark']['slug']);
											$parkUrl=$base_url.'pages/parks/'.$slug;
											$description=(strlen($recentpartsRes['SalesPark']['description'])>35) ? substr(stripslashes($recentpartsRes['SalesPark']['description']),0,35).'...' : stripslashes($recentpartsRes['SalesPark']['description']);
											?>
                                            <div class="listview23">
                                                <a href="<?php echo $parkUrl;?>">
                                                <?php if($logo!=''){
													
													if (file_exists('files/company_logo/95X56_'.$logo)) {
													$logo_path = $base_url.'files/company_logo/95X56_'.$logo;
													}else{
													$logo_path = $base_url.'files/company_logo/'.$logo;
													}
													?>	
                                                        <img src="<?php echo $logo_path;?>" class="leftico" alt="<?php echo $comp_name;?>">
                                                        <?php }else{?>
                                                        <img src="<?php echo $base_url;?>images/profileholder.png" class="leftico" alt="<?php echo $comp_name;?>">
                                                        <?php }?>
                                                    <?php echo $park_name;?><br />
                                                   <?php echo $description;?> 
                                                </a>
                                            </div>
                                            <?php
										}
									}
									?>
                                     <?php 
									$ad_details=$this->Custom->rightsideAd();
									if(count($ad_details) >0 && !empty($ad_details)){
									$ad_details=$ad_details['Advertisement'];
									if($ad_details['ad_type']==1){// for banner type
										if (file_exists('files/advertisement/256X214_'.$ad_details['banner_image'])) {
										$ad_details_path = $base_url.'files/advertisement/256X214_'.$ad_details['banner_image'];
										}else{
										$ad_details_path = $base_url.'files/advertisement/'.$ad_details['banner_image'];
										}
											?>
                                            <div class="listview23">
											 <a href="<?php echo $ad_details['banner_link'];?>" target="_blank">
									<img src="<?php echo $ad_details_path ;?>" alt="<?php echo $ad_details['banner_title'];?>" class="listimg1">
									</a>
                                    </div>
											<?php
										}elseif($ad_details['ad_type']==2){ // for script type
										?>
                                        <div class="listview23">
											<?php
											echo stripslashes($ad_details['ad_script']);
											?>
                                            </div>
                                            <?php
										}
									}
									
									?>

								</div>
							</div>