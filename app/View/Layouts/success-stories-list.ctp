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
            <?php echo SUCESSSTORYLIST;?>
            </a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
       <?php echo SUCESSSTORYLIST;?>
			<a href="<?php echo $base_url;?>pages/success-stories" class="ctgbtn"><?php echo ADDSUCESSSTORIES;?></a>
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
            <div class="row">
            	<div class="listtop34  not_fix">
                	<div class="normaalborder">
				
						 <?php echo $this->Session->flash(); ?>
					<?php 
					//pr($statisticsRes);exit;
					//echo count($statisticsRes);
					if(isset($successRes) && !empty($successRes)){
						$requestcount=1;
						
						?>
					<div id="listing_items">
						<table cellpadding="0" cellspacing="0" class="tab-content">
							<tbody>
								<tr class="listing_header">
								<td width="60"><font><font><?php echo Sl;?></font></font></td>
								  <td align="center" width="226"><font><font><?php echo DESCRIPTION;?></font></font></td>
                                  <td align="center" width="200"><font><font><?php echo STATUS;?></font></font></td>
								  <td align="center" width="200"><font><font><?php echo POSTDATEE;?></font></font></td>
                                  <td width="10%" align="left"><?php echo ACTION;?></td>
								</tr>
								<?php 
								
								foreach($successRes as $successResult){
									//pr($successResult);
									$content=stripslashes($successResult['SuccessStory']['content']);
									$statusval=stripslashes($successResult['SuccessStory']['status']);
									$date=stripslashes($successResult['SuccessStory']['created']);
									$editurl=$base_url.'pages/success-stories/'.$successResult['SuccessStory']['success_id'];
									$statusarr=array(1=> 'Approved', 0 => 'Pending');
									?>
								<tr class="listing_data">
								<td align="center"><?php echo $requestcount;?></td>
                                <td align="center">
										<?php echo $content;?>
										<div class="clearfix"></div>
										
									
									</td>
									<td valign="top" class="listing_title_thumb col_name">
										
										<?php echo $statusarr[$statusval];?>
										
									</td>
                                    <td align="center"><?php
                                    echo date('d-m-Y', strtotime($date));
									?></td>
									<td><a href="<?php echo $editurl;?>" class="btn btn-primary"> <?php echo EDIT;?> </a></td>
								</tr>
								<?php
								$requestcount++;
									}
								?>
							  
							</tbody>
						</table>
					</div>
					  <?php }else{?>
                            <div class="tabdata">
                                            <strong> <?php echo NOSUCESSSTORIFOUND;?></strong>
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