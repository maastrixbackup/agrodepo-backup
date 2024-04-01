<?php
echo $this->element('header-home');
//echo $this->element('sql_dump');
?>
 <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span><?php echo DASHBOARD;?></a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);">
            <?php
			if(isset($this->request->params['pass'][1]))
			{
				$pagename=$this->request->params['pass'][1];
			}
			else
			{
				$pagename='';
			}
            if($pagename=='most-viewed'){?>
        	<?php echo MOSTVIEWED;?>
            <?php }else if($pagename=='favourite'){?>
            <?php echo FAVOTITES;?>
            <?php }else if($pagename=='favourite-ads'){?>
            <?php echo MOSTFAVOURITEADS;?>
            <?php }  else{?>
            <?php echo MOSTVIEWED;?>
            <?php }?>
            </a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
       <?php
            if($pagename=='most-viewed'){?>
        	<?php echo MOSTVIEWED;?>
            <?php }else if($pagename=='favourite'){?>
            <?php echo FAVOTITES;?>
            <?php }else if($pagename=='favourite-ads'){?>
            <?php echo MOSTFAVOURITEADS;?>
            <?php }  else{?>
            <?php echo MOSTVIEWED;?>
            <?php }?>
			<a href="<?php echo $base_url;?>PostAds/add" class="ctgbtn"><?php echo SELLASONG;?></a>
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
            <div class="row">
            	<div class="listtop34  not_fix">
                	<div class="normaalborder">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php if($pagename=='' || $pagename=='most-viewed'){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo MOSTVIEWED;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>pages/statistics-views/most-viewed" ><?php echo MOSTVIEWED;?></a></li>
                              <?php
						  }?>
                         <?php if($pagename=='favourite'){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo FAVOTITES;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>pages/statistics-views/favourite" ><?php echo FAVOTITES;?></a></li>
                              <?php
						  }?>
                           <?php if($pagename=='favourite-ads'){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo MOSTFAVOURITEADS;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>pages/statistics-views/favourite-ads" ><?php echo MOSTFAVOURITEADS;?></a></li>
                              <?php
						  }?>
						</ul>
						
						<div class="clearfix" style="height:15px;"></div>
						 <?php echo $this->Session->flash(); ?>
					<?php 
					//pr($statisticsRes);exit;
					//echo count($statisticsRes);
					if(isset($statisticsRes) && !empty($statisticsRes)){
						$requestcount=1;
						
						?>
					<div id="listing_items">
						<table cellpadding="0" cellspacing="0" class="tab-content">
							<tbody>
								<tr class="listing_header">
								<td width="60"><font><font><?php echo Sl;?></font></font></td>
                                <td align="center" width="200"><font><font><?php echo SALECLERK;?></font></font></td>
								  <td align="center" width="226"><font><font><?php echo NOTICE;?></font></font></td>
                                  <td align="center" width="200"><font><font><?php echo ADIMAGE;?></font></font></td>
								  <td align="center" width="200"><font><font><?php echo TOTALFAVORITE;?></font></font></td>
								</tr>
								<?php 
								
								foreach($statisticsRes as $statisticsResult){
									$adv_id=stripslashes($statisticsResult['PostAd']['adv_id']);
									$adv_name=stripslashes($statisticsResult['PostAd']['adv_name']);
									$slug=stripslashes($statisticsResult['PostAd']['slug']);
									$path=$base_url.'pages/sales-details/'.$slug;
									$userdetail=$this->Custom->BapUserDetails($statisticsResult['PostAd']['user_id']);
									$adImg=$this->Custom->AdvImage($adv_id);
									if($statisticsResult[0]['totfav']>0)
									{
									?>
								<tr class="listing_data">
								<td align="center"><?php echo $requestcount;?></td>
                                <td align="center" class="sales_clerk">
										<a href="<?php echo $base_url;?>pages/user-profiles/<?php echo $userdetail['MasterUser']['user_id'];?>"><?php echo $userdetail['MasterUser']['first_name'].' '.$userdetail['MasterUser']['last_name'];?></a>
										<div class="clearfix"></div>
										
									
									</td>
									<td valign="top" class="listing_title_thumb col_name">
										
										<a href="<?php echo $path;?>" title="<?php echo $adv_name;?>"><strong><?php echo $adv_name;?></strong></a>
										
									</td>
                                    <td align="center"><?php
                                    if($adImg!='')
									{
										?>
                                        <img src="<?php echo $base_url;?>files/postad/<?php echo $adImg;?>" style="width:100px;" />
                                        <?php
									}
									?></td>
                                    <td><?php echo $statisticsResult[0]['totfav'];?></td>
									
								</tr>
								<?php
								$requestcount++;
									}
								 }
								?>
							  
							</tbody>
						</table>
					</div>
					  <?php }else{?>
                            <div class="tabdata">
                                            <strong> <?php echo NOFAVOURFOUND;?></strong>
                                        </div>
                            <?php }?>
					</div>
                    
                </div>
            </div>
                
          </div>
            </div>
        <div class="clear"></div>
      </div>
          
          <div class="clearfix" style="height:1px;"></div>
        </div>
  </div>
<?php
echo $this->element('footer-home');
?>