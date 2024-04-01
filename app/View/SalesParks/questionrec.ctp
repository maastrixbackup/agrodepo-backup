<script type="text/javascript">
function sendReply(showval, qid)
{
	if(showval==1)
	{
		$("#showoffer").hide();
		$("#showquestion").show();
		$("#ParkQuestionParent").val(qid);
		 $('html, body').animate({
        scrollTop: $("#showquestion").offset().top- 135
    }, 2000);
	}
	else
	{
		$("#showoffer").hide();
		$("#showquestion").hide();
		$("#ParkQuestionParent").val(0);
	}
}
</script>
<div id="listing_items">
    <table cellpadding="0" cellspacing="0" class="tab-content">
        <tbody>
            <tr class="listing_header">
            <td width="50px"><font><font><?php echo Sl;?></font></font></td>
              <td align="center" width="226"><font><font>primesc de la</font></font></td>
              <td align="center" width="100"><font><font>Park Tipul</font></font></td>
              <td align="center" width="159"><font><font>Numele Park</font></font></td>
              <td align="center" width="130"><font><font>mesaj</font></font></td>
               <td align="center" width="129"><font><font>a răspuns la</font></font></td>

                <td align="center" width="114">primit Data</td>
                <td align="center" width="114"><font><font><?php echo OPTIONS;?></font></font></td>
            </tr>
            <?php 
				if(isset($questionRes) && !empty($questionRes)){
					$questionCount=1;
					//($questionRes);
					foreach($questionRes as $questionResult){
						$qid=$questionResult['ParkQuestion']['qid'];
					$submitedID=$questionResult['ParkQuestion']['user_id'];
					$submitedBY=$this->Custom->user_details($submitedID);
					$parkid=$questionResult['ParkQuestion']['park_id'];
					$parkDetail=$this->Custom->BapCustUniParkDetail($parkid);
					$parktype=$questionResult['ParkQuestion']['park_type'];
					$question=stripslashes($questionResult['ParkQuestion']['question']);
					$sentDate=date("d-m-Y", strtotime($questionResult['ParkQuestion']['created']));
					$parentID=$questionResult['ParkQuestion']['parent'];
					$repliedDetail=$this->Custom->BapCustUniParkParent($parentID);
				?>
                
                    <tr class="listing_data">
                    <td align="center"><?php echo $questionCount;?></td>
                    <td align="center"><?php echo stripslashes($submitedBY['first_name'].' '. $submitedBY['last_name']);?></td>
                    <td align="center"><?php if($parktype==1){echo "Parcuri dezmembrări";}else{echo "Firme piese";}?></td>
                        <td valign="top" class="listing_title_thumb col_name">
                            
                            <a href="<?php echo $base_url;?>pages/parks/<?php echo stripslashes($parkDetail['SalesPark']['slug']);?>" title="<?php echo stripslashes($parkDetail['SalesPark']['park_name']);?>" target="_blank"><strong><?php echo stripslashes($parkDetail['SalesPark']['park_name']);?></strong></a>
                          
                        </td>
                        <td align="center"><?php echo $question;?></td>
                        <td align="center"><?php if(count($repliedDetail)>0){echo $repliedDetail['ParkQuestion']['question'];}else{echo "N/A";}?></td>
                        <td align="center"><font><font><?php echo date("F d, Y",strtotime($sentDate));?></font></font></td>
                        <td>
                            <div class="mycp_listing_option">
                                <button class="btn btn-success addquestion" type="button" onclick="sendReply(1, <?php echo $qid;?>);">Reply</button>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $questionCount++;
                     }	
				}
				else
				{
					?>
                    <tr>
                        <td colspan="8">
                        	Parcuri Nu a fost gasit
                        </td>
                    </tr>
					<?php
				}
				?>
          
        </tbody>
    </table>
    <div class="clear"></div>
    <div class="clear40 col-lg-12" style="background:url(<?php echo $base_url;?>images/horiz_dotter_border.png) repeat-x center center;"></div>
    <!--question form start-->
    <div class="message_text bg_grey post_offer_message" id="showquestion" <?php if(!isset($this->request->data['question'])){?> style="display:none"<?php }?>><div class="datascl">
    
<h2>Intrebare Despre Park</h2>
<br>
<div class="product_section product_shipping">
<p>
<?php echo QUESTIOONONTHISNOTICE;?>
</p>
</div>

<div class="clearfix"></div>

<h5>întrebare</h5>

<div class="highlight">
<div class="col-lg-7">
<div class="row">

<?php echo $this->Form->create('ParkQuestion', array('id' => 'salesquestion')); ?>

   <?php
echo $this->Form->input('question', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));
echo $this->Form->input('parent', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>0));
?>
  <!--<div class="clear" style="height:20px"></div>-->
  <?php /*?><div class="captch">
      <img src="<?php echo $base_url;?>captcha/captcha_code_file.php?rand=<?php echo rand();?>" id="captchaimg">
      
  <input type="text" class="required form-control" id="code" name="code">
  </div><?php */?>
  <div class="clear10"></div>
    <button type="submit" name="question" class="btn gbutton6"><?php echo ASKQUESTION;?></button>
  </form>

</div>
</div>

<div class="col-lg-1"></div>

<div class="col-lg-4">
<div class="msg_label red_label">
<span class="warning_sign"></span>
<b><font><font><?php echo PROHIBITED;?></font></font></b>
<font><font> <?php echo PERSONALINFODATA;?></font></font>
</div>
</div>
<div class="clear"></div>
</div>

</div></div>
    <!--question form end-->
</div>
