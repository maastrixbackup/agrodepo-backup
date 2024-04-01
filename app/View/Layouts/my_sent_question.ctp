<?php
echo $this->element('header-home');
if(isset($this->request->params['pass'][0]))
{
	$params=$this->request->params['pass'][0];
}
else
{
	$params='';
}
?>
    <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof tdauto">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span>Dashboard</a> </li>
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>pages/my-question"><span></span>My Question</a> </li>
             <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>pages/my-question-reply"><span></span>Reply List</a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);">Sent Question</a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	Sent Question
           
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
                                          <td width="5%" align="center">SL#</td>
                                          <td width="10%" align="left">Notice</td>
                                          <td width="5%" align="left">Nr. Posts</td>
                                          <td width="25%" align="left">Sent By</td>
                                          <td width="25%" align="left">Question</td>
                                          <td width="10%" align="left">Post Time</td>
                                          </tr>
                                          <?php 
                                          $i=1;
										  if(count($SalesQuestion)>0)
										  {
                                          foreach($SalesQuestion AS $SalesQuestionRes){
                                            $question =$SalesQuestionRes['SalesQuestion'];
											$advDetail= $this->Custom->BapCustUniAdvDetail($question['adv_id']);
											$userdetail=$this->Custom->BapUserDetails($question['user_id']);
                                            
                                                ?>
                                                <tr class="listing_data">
                                                    <td valign="top">
                                                    <?php echo $i;?>  
                                                    </td>
                                                    <td valign="top">
                                                       <?php
													  
													  if(!empty($advDetail))
													  {
														  $url=$base_url.'pages/sales-details/'.$advDetail['PostAd']['slug'];
														  ?>
                                                          <a href="<?php echo $url;?>" target="_blank"><?php echo stripslashes($advDetail['PostAd']['adv_name']);?></a>
                                                          <?php
													  }
													    ?>    
                                                     </td>
                                                   <td valign="top">
                                                    1
                                                    </td>
                                                    <td align="center" class="sales_clerk">
                                                    <a href="#"><?php echo $userdetail['MasterUser']['first_name'].' '.$userdetail['MasterUser']['last_name'];?></a>
                                                    <div class="clearfix"></div>
                                                    <span class="user_star stars_purple">0</span>
                                                    <div class="clearfix"></div>
                                                    <span class="gbutton6">Details seller</span>
                                                    <!--<a href="#" class="to_rate"><img src="<?php //echo $base_url;?>images/feedback.gif" /> To Rate</a>-->
                                                
                                                </td>
                                                    <td valign="top">
                                                        <a href="#"> <?php echo $question['question'];?> </a>
                                                        
                                                    </td>
                                                    <td valign="top">
                                                    <?php echo date('d-m-Y',strtotime($question['created']));?>
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
                                              <td colspan="7" style="text-align:center">No Reply Found</td>
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
