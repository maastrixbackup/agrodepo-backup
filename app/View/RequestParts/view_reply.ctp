



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
                          <!--<td width="5%" align="left"><input type="checkbox" onclick="check_all();" id="chkAll" name="chkAll"></td>-->
                          <td width="5%" align="center"><?php echo Sl;?></td>
                          <td width="10%" align="left"><?php echo REQID;?></td>
                          <td width="20%" align="left"><?php echo PARTS;?></td>
                          <td width="40%" align="left"><?php echo QUESTION;?></td>
                           <td align="left" width="20%"><?php echo ACTION;?></td>
                          </tr>
                          <?php 
						  $i=1;
						  if(count($RequestQuestion)){
						  foreach($RequestQuestion AS $question_req){
							$question =$question_req['RequestQuestion'];
							
								?>
								<tr class="listing_data">
                                    <!--<td align="left">
                                        <input type="checkbox" data-id="<?php echo 'chk_'.$question['question_id'];?>" data-up-credits="0">
                                    </td>-->
                                    <td valign="top">
                                    <?php echo $i;?>  
                                    </td>
                                    <td valign="top">
                                       <?php echo $question['request_id'];?>    
                                     </td>
                                    <td valign="top">
                                        <?php echo $this->Custom->parts_name($question['parts_id']);?>    
                                    </td>
                                    <td valign="top" >
                                        <?php echo $question['description'];?>
                                        
                                    </td>
                                    <td><a style="text-decoration:none; cursor:pointer;" href="javascript:void(0)" onclick="askQuestion('<?php echo $question['question_id'];?>');"><?php echo ASKQUESTION;?></a></td>
                                   
                                </tr>
                                <tr>
                                <td colspan="6">
                                 <div class="message_text bg_grey post_offer_message" id="showquestion_<?php echo $question['question_id'];?>" style='display:none' ><div class="datascl">
            <h2><?php echo REPLYABTQUESTIONS;?></h2>
            <br>
            <div class="product_section product_shipping">
              <p>
                <?php echo QUESTIOONONTHISNOTICE;?>
              </p>
            </div>
            
            <div class="clearfix"></div>
            
            <h5><?php echo ADDRESSELLERQUESTION;?></h5>
            
            <div class="highlight">
                <div class="col-lg-7">
                    <div class="row">
                    
                        <?php echo $this->Form->create('RequestQuestion',array('url' => array('controller' => 'RequestParts', 'action' => 'addReplyQuestion'))); ?>
                       <input type='hidden' id="qs_id" name="qs_id" value="<?php echo $qs_id;?>">
                           <?php
						echo $this->Form->input('description', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'form-control', 'cols' => false, 'rows' =>3));
						echo $this->Form->input('request_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$question['request_id']));
						echo $this->Form->input('parent', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>0));
						echo $this->Form->input('parts_id', array('label' => false, 'type' => 'hidden', 'div' => false, 'class' => 'form-control', 'value'=>$question['parts_id']));
						?>
                          <div class="clear" style="height:20px"></div>
                         <!-- <div class="captch">
                              <img src="<?php echo $base_url;?>captcha/captcha_code_file.php?rand=<?php echo rand();?>" id="captchaimg">
                              
                          <input type="text" class="required form-control" id="code" name="code">
                          </div>-->
                          <div class="col-lg-4">
                    <div class="msg_label red_label">
                        <span class="warning_sign"></span>
                        <b><font><font><?php echo PROHIBITED;?></font></font></b>
                        <font><font> <?php echo PERSONALINFODATA;?></font></font>
                    </div>
                </div>
                          <div class="clear10"></div>
                          <button type="submit" name="question" class="btn gbutton6"><?php echo SUBMITTHEANSWER;?></button>
                           <?php
					 /* if(isset($openlogin) && $openlogin='yes')
					  {
						  ?>
                         <!----> <div id="openlogin form-inline">
						      
											  <div class="form-group">
												<label for="exampleInputName2">User Id</label>
												&nbsp;&nbsp;
												 <input type="text" name="data[MasterUser][user_login_id]" class="form-control" id="MasterUserUserLoginId" />
											  </div>
											  <div class="form-group">
												&nbsp;&nbsp;&nbsp;&nbsp;
												<label for="exampleInputEmail2">Password</label>
												&nbsp;&nbsp;
												<input type="password" name="data[MasterUser][user_pass]"  id="MasterUserUserPass" class="form-control" />
											  </div>
											  
											  &nbsp;&nbsp;
											  <input type="submit" name="question" class="btn btn-success" value="Login">
											  
											  <div class="clearfix"></div>
											  <br>
											  <div class="form-group">
												<label for="exampleInputEmail2">Login with Facebook account</label>
												<br>
												<a href="#">
													<img src="<?php echo $base_url;?>images/facebook_login_button.png" alt="" style="width:183px; margin-top:5px;">
												</a>
											  </div>

                          </div>
                          <?php
					  }*/
					  ?>
                        </form>
                        
                    </div>
                </div>
                
                <div class="col-lg-1"></div>
                
               
                <div class="clear"></div>
            </div>
            
        </div></div>
                                </td>
                                </tr>
                                
								
								<?php
								 $i++;
						  }
							
							  }else{
								  echo "<tr><td colspan='6'><div><?php echo NORECORDPRESENT;?></div></td></tr>";
								  }
							 
						  ?>
                       
                            </tbody>
                        </table>
                        
       
                	</div>
                    
                </div>
            </div>
            <script>
			function askQuestion(id){
				$("#showquestion_"+id).toggle();
				}
            
         
            
            </script>




