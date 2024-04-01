<!--My Design -->
<div class="col-lg-12">
            <div class="row">
            	<div class="listtop34">
                    
                    <div class="clearfix" style="height:1px;"></div>
                    
                    <h4><?php
	echo $this->Paginator->counter(array(
	'format' => __('pagină {:page} of {:pages}, arătând {:current} înregistrări din {:count} in total înregistrare{:start}, se încheie la {:end}')
	));
	?></h4>
                    
                    <div class="clearfix" style="height:10px;"></div>
                    
                    <div id="listing_items">
                        <table cellpadding="0" cellspacing="0" class="tab-content">
                            <tbody>
                                <tr class="listing_header">
                                    <td class="col_select">
                                        <?php echo $this->Paginator->sort('adv_id',Sl); ?>
                                  </td>
                                    <td width="250"><font><font><?php echo $this->Paginator->sort('adv_name',NOTICE); ?></font></font></td>
                                  <td align="center">Home Plan</td>
                                  <td align="center">List Plan</td>
                                  <td>homepage Expire Date</td>
                                  <td align="center">Afisre prioritara Expire Date</td>
                                  <td align="center">Total Price</td>
                                    <td align="center"><font><font><?php echo __(OPTIONS); ?></font></font></td>
                                </tr>
                                <?php 
								if(!empty($postAds))
								{
									$postadcount=1;
								foreach ($postAds as $postAd): 
								
									$homeplandetail=$this->requestAction('/PostAds/promotionplan/'.$postAd['PromotionAd']['promotion_home']);
									$listplandetail=$this->requestAction('/PostAds/promotionplan/'.$postAd['PromotionAd']['promotion_list']);
								?>
                                <tr class="listing_data">
                                    <td class="col_select">
                                        <?php echo $postadcount;?>
                                    </td>
                                    <td valign="top" class="listing_title_thumb col_name">
                                     <?php $firstimg=$this->requestAction('PostAds/getfirstimg/'.$postAd['PostAd']['adv_id']);
									if(!empty($firstimg))
									{
										if($firstimg['PostadImg']['img_path']!='')
										{
											?>
                                             <a href="<?php echo $base_url.'pages/sales-details/'.$postAd['PostAd']['slug'];?>">
                                            <img src="<?php echo $base_url;?>files/postad/<?php echo $firstimg['PostadImg']['img_path'];?>" alt="<?php echo h($postAd['PostAd']['adv_name']); ?>" style="padding:0;background:#EEEEEE;">
                                        </a> 
											
											<?php
										}
										
									}
									?>
                                        <a href="<?php echo $base_url.'pages/sales-details/'.$postAd['PostAd']['slug'];?>" title="<?php echo h($postAd['PostAd']['adv_name']); ?>"><font><font>
                                            <?php echo h($postAd['PostAd']['adv_name']); ?></font></font></a>
                                    </td>
                                    <td align="center"><?php if(!empty($homeplandetail)){echo $homeplandetail['PromotionPlan']['promotion_days']." Days(".$homeplandetail['PromotionPlan']['promotion_price']." RON)";}else{ echo "N/A";}?></td>
                                     <td align="center"><?php if(!empty($listplandetail)){echo $listplandetail['PromotionPlan']['promotion_days']." Days(".$listplandetail['PromotionPlan']['promotion_price']." RON)";}else{ echo "N/A";}?></td>
                                    <td align="center"><?php if($postAd['PromotionAd']['promotion_home']>0){echo date("d-m-Y",strtotime($postAd['PromotionAd']['is_home_expire']));}else{?>Not Promoted for Home<?php }?></td>
                                     <td align="center"><?php if($postAd['PromotionAd']['promotion_list']>0){echo date("d-m-Y",strtotime($postAd['PromotionAd']['is_list_expire']));}else{?>Not Promoted for list<?php }?></td>
                                    
                                    
                                     <td align="center"><?php echo h($postAd['PromotionAd']['total_price']); ?> RON</td>
                                    <td>
                                        <div class="mycp_listing_option">
                                            <button class="btn btn-success" onclick="location.href='<?php echo $base_url;?>PostAds/productdescription/<?php echo $postAd['PostAd']['adv_id'];?>';" type="button"><?php echo EDIT;?></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php 
								$postadcount++;
								endforeach;
									}
								 ?>
                            </tbody>
                        </table>
                        <div class="clearfix" style="height:10px;"></div>
                        <div class="paging">
						<?php
                            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                            echo $this->Paginator->numbers(array('separator' => ''));
                            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                        ?>
                        </div>
                	</div>
                    
                </div>
            </div>
                
          </div>