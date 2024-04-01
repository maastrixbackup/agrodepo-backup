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
              <td width="10%" align="left">Piese de schimb</td>
              <td width="10%" align="left">Send To</td>
              <td width="25%" align="left">a răspuns la</td>
              <td width="30%" align="left"><?php echo QUESTION;?></td>
              <td width="10%" align="left"><?php echo DATE;?></td>
              </tr>
              <?php 
              $i=1;
              if(count($bidQuestions)>0)
              {
              foreach($bidQuestions AS $bidQuestionRes){
                $question =$bidQuestionRes['BidQuestion'];
                $partsDetail= $this->Custom->BapCustUniPartsDetail($question['parts_id']);
                $userdetail=$this->Custom->BapUserDetails($question['to_id']);
                $questionurl=$base_url.'pages/my-question-reply/'.$question['qid'];
				$parent=$question['parent'];
				if($parent>0)
				{
					$parentdetail=$this->Custom->BapCustUniBidQuestion($parent);
				}
				else
				{
					$parentdetail=array();
				}
                
                    ?>
                    <tr class="listing_data">
                        <td valign="top">
                        <?php echo $i;?>  
                        </td>
                        <td valign="top">
                           <?php
                          
                          if(!empty($partsDetail))
                          {
                              $url=$base_url.'pages/request-parts/'.$partsDetail['RequestAccessory']['slug'];
                              ?>
                              <a href="<?php echo $url;?>" target="_blank"><?php echo stripslashes($partsDetail['RequestAccessory']['name_piece']);?></a>
                              <?php
                          }
                            ?>    
                         </td>
                       <td valign="top">
                       <?php if(!empty($userdetail)){?><a href="<?php echo $base_url;?>pages/user-profiles/<?php echo $userdetail['MasterUser']['user_id'];?>" target="_blank"><?php echo $userdetail['MasterUser']['first_name'].' '.$userdetail['MasterUser']['last_name'];?></a><?php }?>
                        </td>
                        <td align="center" class="sales_clerk">
                        <?php if(!empty($parentdetail)){echo nl2br(stripslashes($parentdetail['BidQuestion']['description']));}else{echo "Parent";}?>
                    </td>
                        <td valign="top">
                            <a href="<?php echo $questionurl;?>"> <?php echo $question['description'];?> </a>
                            
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
    <div class="clear40 col-lg-12" style="background:url(<?php echo $base_url;?>images/horiz_dotter_border.png) repeat-x center center;"></div>
    <!--question form start-->
    <div class="message_text bg_grey post_offer_message full_width" id="showquestion" <?php if(!isset($this->request->data['question'])){?> style="display:none"<?php }?>><div class="datascl">
<h2><?php echo REPLYABTQUESTION;?></h2>
<div class="highlight full_width">
<div class="col-lg-7">
<div class="row">

<?php echo $this->Form->create('BidQuestion'); ?>

   <?php
echo $this->Form->input('description', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));

?>
<input type="hidden" name="data[BidQuestion][parent]" id="parent" value="" />
 <input type="hidden" name="data[BidQuestion][to_id]" id="to_id" value="" />
 <input type="hidden" name="data[BidQuestion][bidid]" id="bidid" value="" />
 <input type="hidden" name="data[BidQuestion][parts_id]" id="parts_id" value="" />
 <input type="hidden" name="data[BidQuestion][request_id]" id="request_id" value="" />
  <div class="clear10"></div>
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