
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
                          <td width="3%" align="left"><input type="checkbox" onclick="check_all();" id="chkAll" name="chkAll"></td>
                          <td width="3%" align="center"><?php echo Sl;?></td>
                          <td width="7%" align="left">Piese de schimb cerere</td>
                          <td width="19%" align="left">Denumire piesa</td>
                          <td width="12%" align="left">Doriti piesa</td>
                          <td width="8%" align="left"><?php echo PRICE;?></td>
                          <td width="10%" align="left"><?php echo CURRENCY;?></td>
                          <td width="10%" align="left">Garanție</td>
                           <td align="left">Valabilitate</td>
                           <td align="left"><?php echo STATUS;?></td>
                           <!--<td align="left">Action</td>-->
                          </tr>
                          <?php 
						  $i=1;
						  foreach($bidOffer AS $bidofr){
							$bid =$bidofr['BidOffer'];
							//pr($bid);
								?>
								<tr class="listing_data">
                                    <td align="left">
                                        <input type="checkbox" data-id="<?php echo 'chk_'.$bid['bid_id'];?>" data-up-credits="0">
                                    </td>
                                    <td valign="top">
                                    <?php echo $i;?>  
                                    </td>
                                    <td valign="top">
                                       <?php $partsdetail=$this->Custom->BapCustUniPartsDetail($bid['parts_id']);
									   echo $partsdetail['RequestAccessory']['name_piece'];
									   ?>  
                                         
                                     </td>
                                    <td valign="top">
                                        <?php 
										 
										echo $bid['piece'];?>    
                                    </td>
                                    <td valign="top">
                                         <?php
										 $conditionsOffer=array('new'=>'Noua', 'New'=>'Noua','used'=>'din dezmembran','Used'=>'din dezmembran');
										  echo $conditionsOffer[$bid['offers']];?> 
                                        
                                    </td>
                                    
                                    <td align="center"><?php echo $bid['price'];?> </td>
                                    <td align="center"><?php echo $bid['currency'];?></td>
                                    <td align="center"> <?php if($bid['warranty']=='We do not offer warranty'){echo 'Noi nu oferim garanție';}else if($bid['warranty']=='Ofer warranty'){echo "oferta de garanție";}?></td>
                               <td align="center"><?php echo $bid['validity'];?></td>
                               <td align="center"><?php
							   $status=array(0=>'aprobata',1=>'castigatoare',2=>'anula');
							    echo $status[$bid['status']];
								if($bid['status']==1)
								{
									?>
                                    <br />
                                    <a href="<?php echo $base_url;?>RequestParts/deliverydetail/<?php echo $bid['bid_id'];?>" class="btn btn-success">Detaliu vedere livrare</a>
                                    <?php
								}
								?></td>
                                 <!--   <td>-->
                                        <!--<div class="mycp_listing_option">
                                            <button class="btn btn-success" type="button" onclick="viewBid(<?php echo $bid['bid_id']; ?>)">View</button>
                                        </div>-->
                                       <!-- <div class="mycp_listing_option">
                                      
                                            <button class="btn btn-danger" type="button" onclick="removeBid(<?php echo $bid['bid_id']; ?>)">Remove</button>
                                        </div>-->
                                        
                                        <!--<div class="mycp_listing_option">
                                            <button class="btn btn-primary" type="button">Promotes</button>
                                        </div>-->
                                   <!-- </td>-->
                                    
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