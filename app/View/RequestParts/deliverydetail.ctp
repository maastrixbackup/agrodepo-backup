
 <div class="row">
            	<div class="listtop34">
                	
                   
                    <div class="clearfix" style="height:1px;"></div>
                    
                    <!--<h4>Page 1 of 1</h4>-->
                   
                    
                    <div class="clearfix" style="height:10px;"></div>
                    
                    <div id="listing_items">
                        <table cellpadding="0" cellspacing="0" class="tab-content">
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
                                <tr class="listing_header">
                          <td width="3%" align="center"><?php echo Sl;?></td>
                          <td width="7%" align="left">Comanda ID</td>
                          <td width="19%" align="left">ordonate de</td>
                          <td width="12%" align="left"><?php echo PRICE;?></td>
                          <td width="10%" align="left">telefon</td>
                           <td align="left"><?php echo STATUS;?></td>
                           <td align="left">Comandat de la data</td>
                           <td align="left">acțiune</td>
                          </tr>
                          <?php 
							$partsOrder =$partsOrders['PartsOrder'];
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
                                    1  
                                    </td>
                                    <td valign="top">
                                       <?php echo $partsOrder['orderid'];?>    
                                     </td>
                                    <td valign="top">
                                        <?php $user_details=$this->Custom->user_details($partsOrder['user_id']);?> 
                                       <a href="<?php echo $base_url;?>pages/user-profiles/<?php echo $user_details['user_id'];?>" target="_blank"> <?php echo $user_details['first_name'].' '.$user_details['last_name'];?>  </a>
                                    </td>
                                    <td valign="top">
                                         <?php echo $partsOrder['totprice'];?> 
                                        
                                    </td>
                                    
                                    <td align="center"><?php echo $partsOrder['phone'];?></td>
                        
                               <td align="center"><?php
							   $status=array(0=>'Confirmed Order');
							    echo $status[$partsOrder['status']];
								
								?></td>
                                <td align="center"><?php echo date("d-m-Y", strtotime($partsOrder['created']));?></td>
                                
                                  <td><a href="javascript:void(0);" class="btn btn-success"  data-toggle="modal" data-target="#parts_order">Vezi Detalii</a></td>  
                                </tr>
								
								
                       
                            </tbody>
                        </table>
                	</div>
                    
                </div>
            </div>
            
            
            <div class="modal fade" id="parts_order">
              <div class="modal-dialog order_modal3">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detaliu de livrare</h4>
                  </div>
                  <div class="modal-body order_listscroll">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <td width="30%">Comanda ID</td>
                              <td width="70%"><?php echo $partsOrder['orderid'];?> </td>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td width="30%">ordonate de</td>
                              <td width="70%"><?php $user_details=$this->Custom->user_details($partsOrder['user_id']);?> 
                                        <?php echo $user_details['first_name'].' '.$user_details['last_name'];?> </td>
                            </tr>
                            <tr>
                              <td width="30%">Livrare Nume</td>
                              <td width="70%" style="text-align:left;"><?php echo $partsOrder['fname'].' '.$partsOrder['lname'];?></td>
                            </tr>
                            <tr>
                              <td width="30%">județ</td>
                              <td width="70%" style="text-align:left;"><?php echo $this->Custom->region_nm($partsOrder['county']);?></td>
                            </tr>
                             <tr>
                              <td width="30%">locație</td>
                              <td width="70%" style="text-align:left;"><?php echo $this->Custom->location_nm($partsOrder['location']);?></td>
                            </tr>
                             <tr>
                              <td width="30%">Cod Poștal</td>
                              <td width="70%" style="text-align:left;"><?php echo $partsOrder['postcode'];?></td>
                            </tr>
                             <tr>
                              <td width="30%">metoda de livrare</td>
                              <td width="70%" style="text-align:left;">
							  <?php if($partsOrder['delivery_method']=="Personal Teaching"){?>
							  <?php if($personal_teaching==1){ echo PERSONALTEACHING; }?>
                              <?php }else if($partsOrder['delivery_method']=="courier"){?>
                                         <?php if($courier==1 || $free_courier==1){
                                            if($free_courier==1){$cost='free shipping';}else{$cost=$courier_cost.' RON';}
                                            ?>
                                       Courier( <?php echo $cost;?>) 
                                        <?php }}else if($partsOrder['delivery_method']=="roman"){?>
                                        
                                        <?php if($romanian_mail==1 || $free_romanian_mail==1){
                                            if($free_romanian_mail==1){$rcost='free shipping';}else{$rcost=$romanian_mail_cost.' RON';}
                                            ?>
                                       <?php echo ROMANIANMAIL;?>(<?php echo $rcost;?>)
                                        <?php }}?></td>
                            </tr>
                             <tr>
                              <td width="30%">Adresă De Livrare</td>
                              <td width="70%" style="text-align:left;"><?php echo $partsOrder['delivery_add'];?></td>
                            </tr>
                            
                          </tbody>
                        </table>
                  </div>
                </div>
              </div>
            </div>
            
            
            
            <script>
            
            function removeBid(id){
				var conf=confirm('Are you sure you want to delete');
				if(conf){
				var url="<?php echo $this->webroot;?>RequestParts/delete_bid/id:"+id;
				window.location=url;
				}
			}
			function viewBid(id){
				
				
				}
            
            </script>