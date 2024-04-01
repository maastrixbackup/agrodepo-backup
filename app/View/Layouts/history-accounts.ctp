<?php
echo $this->element('header-home');
?>
    <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof tdauto">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span><?php echo DASHBOARD;?></a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo HISTORYACCOUNTS;?></a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	<?php echo HISTORYACCOUNTS;?>
           
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
          
                 <?php echo $this->Session->flash(); ?>
				
                 <div class="row">
                                <div class="listtop34">
                                    
                                  
                                    <div class="clearfix" style="height:1px;"></div>
                                    
                                    <!--<h4>Page 1 of 1</h4>-->
                                    <div class="paging">
                    <?php
                        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                        echo $this->Paginator->numbers(array('separator' => ''));
                        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                    ?>
                    </div>
                                    
                                    <div class="clearfix" style="height:10px;"></div>
                                    
                                    <div id="listing_items">
                                        <table cellpadding="0" cellspacing="0" class="tab-content">
                                            <tbody>
                                               
                                                <tr class="listing_header">
                                          <td width="10%" align="center"><?php echo Sl;?></td>
                                          <td width="20%" align="left"><?php echo TRANSATIONID;?></td>
                                          <td width="25%" align="left"><?php echo MEMBERPLANS;?></td>
                                          <td width="10%" align="left"> <?php echo AMOUNT;?></td>
                                          <td width="25%" align="left"><?php echo CREDITS;?></td>
                                          <td width="20%" align="left"><?php echo PAYMENTDATE;?></td>
                                        
                                          </tr>
                                          <?php 
                                          $i=1;
										  if(count($historyRes)>0)
										  {
											 
                                          foreach($historyRes AS $historyResult){
											  $transferid=$historyResult['UpgradeMembership']['transfer_id'];
											 $price=$historyResult['UpgradeMembership']['price'];
											 $credit=$historyResult['UpgradeMembership']['credit'];
											  $created=$historyResult['UpgradeMembership']['created'];
											  $memdetails=$this->Custom->getMemberByID($historyResult['UpgradeMembership']['member_type']);
                                                ?>
                                                <tr class="listing_data">
                                                    <td valign="top">
                                                    <?php echo $i;?>  
                                                    </td>
                                                    <td valign="top">
                                                       <?php
													  echo md5($transferid);
													    ?>    
                                                     </td>
                                                   
                                                    <td align="center" class="sales_clerk">
                                                  <?php if(!empty($memdetails)){
													  
													  ?>
                                                      
                                                      <?php
													  
													  }?>
                                                    <div class="clearfix"></div>
                                                    <span class="">
													<?php if($memdetails['UserMembership']['plan_img']!=''){?>
                                                    <img src="<?php echo $base_url.'files/memberplanimg/'.$memdetails['UserMembership']['plan_img'];?>" style="width:40px;" alt="" />
                                                    <?php }?>
													<?php echo $memdetails['UserMembership']['memb_type'];?></span>
                                                
                                                </td>
                                                <td valign="top">
                                                    <?php echo $price;?> RON
                                                    </td>
                                                    <td valign="top">
                                                        <?php echo $credit;?>
                                                        
                                                    </td>
                                                    <td valign="top">
                                                    <?php echo date('d-m-Y',strtotime($created));?>
                                                    </td>
                                                 
                                                </tr>
                                                
                                                <?php
                                                 $i++;
                                            
                                              }
											  }
										  else
										  {
											  ?>
                                              <tr>
                                              <td colspan="6" style="text-align:center"><?php echo NOHISTORIFOUND;?></td>
                                              </tr>
                                              <?php
										  }
                                             
                                          ?>
                                       
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clear40 col-lg-12" style="background:url(<?php echo $base_url;?>images/horiz_dotter_border.png) repeat-x center center;"></div>
                                 
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
