
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
                          <td width="5%" align="left"><input type="checkbox" onclick="check_all();" id="chkAll" name="chkAll"></td>
                          <td width="5%" align="center"><?php echo Sl;?></td>
                          <!--<td width="10%" align="left"><?php //echo REQID;?></td>-->
                          <td width="20%" align="left"><?php echo PARTS;?></td>
                          <td width="40%" align="left"><?php echo QUESTION;?></td>
                           <td align="left" width="20%"><?php echo ACTION;?></td>
                          </tr>
                          <?php 
						  $i=1;
						  foreach($RequestQuestion AS $question_req){
							$question =$question_req['RequestQuestion'];
						//	$partDetail = $this->Custom->partsDetails($question['parts_id']);
							$partDetail=$this->Custom->BapCustUniPartsDetail($question['parts_id']);
								?>
								<tr class="listing_data">
                                    <td align="left">
                                        <input type="checkbox" data-id="<?php echo 'chk_'.$question['question_id'];?>" data-up-credits="0">
                                    </td>
                                    <td valign="top">
                                    <?php echo $i;?>  
                                    </td>
                                   <?php /*?> <td valign="top">
                                       <?php echo $question['request_id'];?>    
                                     </td><?php */?>
                                    <td valign="top">
                                        <?php if(count($partDetail)>0){ echo $partDetail['RequestAccessory']['name_piece'];}?>    
                                    </td>
                                    <td valign="top">
                                        <a href="<?php echo $this->webroot.'RequestParts/view_reply/'.$question['question_id'];?>"> <?php echo $question['description'];?> </a>
                                        
                                    </td>
                                 
                                    <td>
                                        <div class="mycp_listing_option">
                                      
                                            <button class="btn btn-danger" type="button" onclick="removeQuestion(<?php echo $question['question_id']; ?>)"><?php echo REMOVE;?></button>
                                            <?php if(count($partDetail)>0){?> <button class="btn btn-success" type="button" onclick="location.href='<?php echo $base_url;?>pages/request-parts/<?php echo $partDetail['RequestAccessory']['slug'];?>/reply:yes/replyid:<?php echo $question['question_id'];?>'">răspunde</button><?php }?>
                                            
                                        </div>
                                        
                                       
                                    </td>
                                    
                                </tr>
								
								<?php
								 $i++;
							
							  }
							 
						  ?>
                       
                            </tbody>
                        </table>
                	</div>
                    
                </div>
            </div>
            <script>
            
            function removeQuestion(id){
				var conf=confirm('Are you sure you want to delete');
				if(conf){
				var url="<?php echo $this->webroot;?>RequestParts/delete_question/id:"+id;
				window.location=url;
				}
			}

            
            </script>