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
<script>           
function removeQuestion(id){
	var conf=confirm('Are you sure you want to delete');
	if(conf){
	var url="<?php echo $this->webroot;?>RequestParts/delete_question/id:"+id;
	window.location=url;
	}
}


</script>
    <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof tdauto">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span><?php echo DASHBOARD;?></a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php if($params=='ask-question'){ echo "Asked Question";}else{ echo MYQUESTION;}?></a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	<?php if($params=='ask-question'){ echo "Asked Question";}else{ echo MYQUESTION;}?>
           
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
                                          <td width="5%" align="center"><?php echo Sl;?></td>
                                          <td width="10%" align="left"><?php echo NOTICE;?></td>
                                          <td width="10%" align="left"><?php echo NRPOSTS;?></td>
                                          <td width="25%" align="left"><?php echo SALECLERK;?></td>
                                          <td width="30%" align="left"><?php echo QUESTION;?></td>
                                          <td width="10%" align="left"><?php echo DATE;?></td>
                                          </tr>
                                          <?php 
                                          $i=1;
										  if(count($SalesQuestion)>0)
										  {
                                          foreach($SalesQuestion AS $SalesQuestionRes){
                                            $question =$SalesQuestionRes['SalesQuestion'];
											$advDetail= $this->Custom->BapCustUniAdvDetail($question['adv_id']);
											$userdetail=$this->Custom->BapUserDetails($advDetail['PostAd']['user_id']);
											$questionurl=$base_url.'pages/my-question-reply/'.$question['question_id'];
                                            
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
                                                    <a href="<?php echo $base_url;?>pages/user-profiles/<?php echo $userdetail['MasterUser']['user_id'];?>"><?php echo $userdetail['MasterUser']['first_name'].' '.$userdetail['MasterUser']['last_name'];?></a>
                                                    <div class="clearfix"></div>
                                                    <span class="user_star stars_purple">0</span>
                                                    <div class="clearfix"></div>
                                                    <span class="gbutton6"><?php echo DETAILSSELLER;?></span>
                                                    <!--<a href="#" class="to_rate"><img src="<?php //echo $base_url;?>images/feedback.gif" /> To Rate</a>-->
                                                
                                                </td>
                                                    <td valign="top">
                                                        <a href="<?php echo $questionurl;?>"> <?php echo $question['question'];?> </a>
                                                        
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
                                              <td colspan="6" style="text-align:center"><?php echo NOREPLAYFOUND;?></td>
                                              </tr>
                                              <?php
										  }
                                             
                                          ?>
                                       
                                            </tbody>
                                        </table>
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
