<section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Sales order</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                               <table class="table table-hover">
                            <tbody>
                                <!--<tr class="listing_header">
                                    <td width="50" class="col_select">
                                        <input type="checkbox" title="Select / Deselect all">
                                  </td> 
                                  <td width="88"><font><font>SL#</font></font></td>
                                    <td width="100"><font><font>Req. ID</font></font></td>
                                     <td width="338"><font><font>Title</font></font></td>
                                  <td width="295"><font><font>Product Condn.</font></font></td>
                                  <td align="center" width="226"><font><font>Shipping Time</font></font></td>
                                  <td align="center" width="259"><font><font>Price</font></font></td>
                                  <td align="center" width="92"><font><font>Currency</font></font></td>
                                    <td align="center" width="114"><font><font>Private Remark</font></font></td>
                                </tr>
                                -->
                                <tr>
                          <td align="center"><?php echo Sl;?></td>
                          <td align="left">Order ID</td>
                           <td align="left">Order By</td>
                          <td align="left">Bidder</td>
                          <td align="left">Request Parts</td>
                          <td align="left">Price</td>
                          <td align="left">Telephone</td>
                           <td align="left">Status</td>
                           <td align="left">Ordered Date</td>
                           <td align="left">Action</td>
                          </tr>
                          <?php 
						  if(!empty($partsOrders)):
						  $ordercount=1;
						  foreach($partsOrders as $partsOrdersRes):
							$partsOrder =$partsOrdersRes['PartsOrder'];
							$bidDetail=$this->Custom->BapCustUniBidDetail($partsOrder['bid_id']);
							$personal_teaching=$bidDetail['BidOffer']['personal_teaching'];
							$courier=$bidDetail['BidOffer']['courier'];
							$courier_cost=$bidDetail['BidOffer']['courier_cost'];
							$free_courier=$bidDetail['BidOffer']['free_courier'];
							$romanian_mail=$bidDetail['BidOffer']['roman_mail'];
							$romanian_mail_cost=$bidDetail['BidOffer']['roman_mail_cost'];
							$free_romanian_mail=$bidDetail['BidOffer']['free_roman_mail'];
							//pr($bid);
								?>
								<tr class="listing_data">
                                    
                                    <td valign="top">
                                    <?php echo $ordercount;?>  
                                    </td>
                                    <td valign="top">
                                       <?php echo $partsOrder['orderid'];?>    
                                     </td>
                                     <td valign="top">
                                        <?php 
									  
									  $user_details=$this->Custom->user_details($partsOrder['user_id']);?> 
                                     <a href="<?php echo $base_url;?>admin/ManageUsers/view/<?php echo $user_details['user_id'];?>" target="_blank"> <?php echo $user_details['first_name'].' '.$user_details['last_name'];?> </a>
                                    </td>
                                    <td valign="top">
                                        <?php 
									  
									  $user_details=$this->Custom->user_details($bidDetail['BidOffer']['user_id']);?> 
                                     <a href="<?php echo $base_url;?>admin/ManageUsers/view/<?php echo $user_details['user_id'];?>" target="_blank"> <?php echo $user_details['first_name'].' '.$user_details['last_name'];?> </a>
                                    </td>
                                    <td valign="top">
                                       <?php 
									  // echo $partsOrder['parts_id'];
									   $partsdetail=$this->Custom->BapCustUniPartsDetail($partsOrder['parts_id']);
									   if(!empty($partsdetail)){echo $partsdetail['RequestAccessory']['name_piece'];}
									   ?>    
                                     </td>
                                    <td valign="top">
                                         <?php echo $partsOrder['totprice'].' '.$bidDetail['BidOffer']['currency'];?> 
                                        
                                    </td>
                                    
                                    <td align="center"><?php echo $partsOrder['phone'];?></td>
                        
                               <td align="center"><?php
							   $status=array(0=>'Confirmed Order');
							    echo $status[$partsOrder['status']];
								
								?></td>
                                <td align="center"><?php echo date("d-m-Y", strtotime($partsOrder['created']));?></td>
                                  <td><a href="javascript:void(0);" class="btn btn-primary btn-flat"  data-toggle="modal" data-target="#parts_order<?php echo $ordercount;?>">View Details</a>&nbsp;<a href="<?php echo $base_url;?>admin/Reports/delete_parts_order/<?php echo $partsOrder['id'];?>" class="btn btn-primary btn-flat" onclick="return confirm('Are you sure to delete this record');">Delete</a>
                                  <div class="modal fade" id="parts_order<?php echo $ordercount;?>">
              <div class="modal-dialog order_modal3">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Order Details</h4>
                  </div>
                  <div class="modal-body order_listscroll">
                        <table class="table table-bordered">
                          <thead>
                           <tr>
                              <td width="30%">Order ID</td>
                              <td width="70%"><?php echo $partsOrder['orderid'];?> </td>
                            </tr>
                            
                          </thead>
                          <tbody>
                          <tr>
                              <td width="30%">Bidder</td>
                              <td width="70%"><?php 
							  $bidDetail=$this->Custom->BapCustUniBidDetail($partsOrder['bid_id']);
							  
							  $user_details=$this->Custom->user_details($bidDetail['BidOffer']['user_id']);?> 
                                        <?php echo $user_details['first_name'].' '.$user_details['last_name'];?> </td>
                            </tr>
                            <tr>
                              <td width="30%">Shipping Name</td>
                              <td width="70%" style="text-align:left;"><?php echo $partsOrder['fname'].' '.$partsOrder['lname'];?></td>
                            </tr>
                            <tr>
                              <td width="30%">County</td>
                              <td width="70%" style="text-align:left;"><?php echo $this->Custom->region_nm($partsOrder['county']);?></td>
                            </tr>
                             <tr>
                              <td width="30%">Location</td>
                              <td width="70%" style="text-align:left;"><?php echo $this->Custom->location_nm($partsOrder['location']);?></td>
                            </tr>
                             <tr>
                              <td width="30%">Postal Code</td>
                              <td width="70%" style="text-align:left;"><?php echo $partsOrder['postcode'];?></td>
                            </tr>
                             <tr>
                              <td width="30%">Delivery Method</td>
                              <td width="70%" style="text-align:left;">
							  <?php if($partsOrder['delivery_method']=="Personal Teaching"){?>
							  <?php if($personal_teaching==1){ echo "Personal Teaching"; }?>
                              <?php }else if($partsOrder['delivery_method']=="courier"){?>
                                         <?php if($courier==1 || $free_courier==1){
                                            if($free_courier==1){$cost='free shipping';}else{$cost=$courier_cost.' RON';}
                                            ?>
                                       Courier( <?php echo $cost;?>) 
                                        <?php }}else if($partsOrder['delivery_method']=="roman"){?>
                                        
                                        <?php if($romanian_mail==1 || $free_romanian_mail==1){
                                            if($free_romanian_mail==1){$rcost='free shipping';}else{$rcost=$romanian_mail_cost.' RON';}
                                            ?>
                                      Romanian Mail(<?php echo $rcost;?>)
                                        <?php }}?></td>
                            </tr>
                             
                             <tr>
                              <td width="30%">Delivery Address</td>
                              <td width="70%" style="text-align:left;"><?php echo $partsOrder['delivery_add'];?></td>
                            </tr>
                            
                          </tbody>
                        </table>
                  </div>
                </div>
              </div>
            </div>
                                  </td>  
                                </tr>
							<?php
							$ordercount++;
							endforeach;
							endif;
							?>	
								
                       
                            </tbody>
                        </table>
                                    
                                   
                                </div><!-- /.box-body -->
                               
                            </div><!-- /.box -->
                             <div class="clearfix"></div>
                                 
									<div class="float_left">
                                    <?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	
                                    </div>
                                    
                                    <div class="paging">
								<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
								
								
                                </div>
                        </div>
                    </div>
                </section>