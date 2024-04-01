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
function replyQuestion(replyid,advid,srlno)
{
	if(replyid!='')
	{
		$("#showquestion").show();
		 $('html, body').animate({
        scrollTop: $("#showquestion").offset().top- 135
    }, 2000);
	$("#parent").val(replyid);
	$("#SalesQuestionAdvId").val(advid);
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
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php if($params=='ask-question'){ echo ASKEDQUESTION;}else{ echo MYQUESTION;}?></a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	<?php if($params=='ask-question'){ echo ASKEDQUESTION;}else{ echo MYQUESTION;}?>
           
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
                                          <td width="25%" align="left"><?php echo POSTEDBY;?></td>
                                          <td width="20%" align="left"><?php echo QUESTION;?></td>
                                          <td width="10%" align="left"><?php DATE;?></td>
                                           <td width="10%" align="left"><?php echo ACTION;?></td>
                                          </tr>
                                          <?php 
                                          $i=1;
										  if(count($SalesQuestion)>0)
										  {
                                          foreach($SalesQuestion AS $SalesQuestionRes){
                                            $question =$SalesQuestionRes['SalesQuestion'];
											$advDetail= $this->Custom->BapCustUniAdvDetail($question['adv_id']);
											$userdetail=$this->Custom->BapUserDetails($question['user_id']);
                                            $questionurl=$base_url.'pages/sent-question/'.$question['question_id'];
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
                                                    <span class="gbutton6"><?php echo DETAILSSELLER;?></span>
                                                    <!--<a href="#" class="to_rate"><img src="<?php //echo $base_url;?>images/feedback.gif" /> To Rate</a>-->
                                                
                                                </td>
                                                    <td valign="top">
                                                        <a href="#"> <?php echo $question['question'];?> </a>
                                                        
                                                    </td>
                                                    <td valign="top">
                                                    <?php echo date('d-m-Y',strtotime($question['created']));?>
                                                    </td>
                                                    <td><a href="#" class="btn btn-success" onclick="replyQuestion(<?php echo $question['question_id'];?>,<?php echo $question['adv_id'];?>);"> <?php echo REPLAY;?> </a>
                                                      <a href="<?php echo $questionurl;?>" class="btn btn-primary"> <?php echo SENTQUESTION;?> </a></td></td>
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
                                    <div class="clear40 col-lg-12" style="background:url(<?php echo $base_url;?>images/horiz_dotter_border.png) repeat-x center center;"></div>
                                    <!--question form start-->
                                    <div class="message_text bg_grey post_offer_message full_width" id="showquestion" <?php if(!isset($this->request->data['question'])){?> style="display:none"<?php }?>><div class="datascl">
                    <h2><?php echo REPLYABTQUESTION;?></h2>
                    <div class="highlight full_width">
                        <div class="col-lg-7">
                            <div class="row">
                            
                                <?php echo $this->Form->create('SalesQuestion', array('enctype' => 'multipart/form-data')); ?>
                               
                                   <?php
                                echo $this->Form->input('question', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));
                                
                                echo $this->Form->input('adv_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control'));
                                ?>
                                 <input type="hidden" name="data[SalesQuestion][parent]" id="parent" value="" />
                                  <div class="clear10"></div>
                                  <?php
            echo $this->Form->input('img_files', array('label' => false, 'type' => 'file', 'multiple' => 'multiple', 'name' => 'data[SalesQuestion][img_files][]', 'div' => false, 'class' => 'form-control', 'style' => 'width:50%'));
            ?>
            <span><i>(Maximum 8 Image allow to upload)</i></span>
                          <div class="clear" style="height:20px"></div>
                                  <button type="submit" name="question" class="btn gbutton6"><?php echo REPLAY;?> </button>
                                 
                                </form>
                                
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="msg_label red_label">
                                <span class="warning_sign"></span>
                                <b><font><font><?php echo PROHIBITED;?></font></font></b>
                                <font><font><?php echo PERSONALINFODATA;?></font></font>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                </div></div>
                                    <!--question form end-->
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
