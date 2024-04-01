<?php
echo $this->element('header-home');
if($this->Session->check('User'))
{
	$session_user=$this->Session->read('User');
}
else
{
	$session_user=array();
}
//pr($bidDetail);
if(!empty($bidDetail))
{
	$bidofferDetail=$bidDetail['BidOffer'];
	$price=$bidofferDetail['price'];
	$currency=$bidofferDetail['currency'];
	$request_id=$bidofferDetail['request_id'];
	$parts_id=$bidofferDetail['parts_id'];
	$bid_id=$bidofferDetail['bid_id'];
	$price=$bidofferDetail['price'];
	$personal_teaching=$bidofferDetail['personal_teaching'];
	$courier=$bidofferDetail['courier'];
	$courier_cost=$bidofferDetail['courier_cost'];
	$free_courier=$bidofferDetail['free_courier'];
	$romanian_mail=$bidofferDetail['roman_mail'];
	$romanian_mail_cost=$bidofferDetail['roman_mail_cost'];
	$free_romanian_mail=$bidofferDetail['free_roman_mail'];
	$warranty=$bidofferDetail['warranty'];
	$validity=$bidofferDetail['validity'];
	$payment_mode=$bidofferDetail['payment_method'];
	$bid_user_id=$bidofferDetail['user_id'];
}
?>
<script type="text/javascript">
function changeCity(countyval)
{
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>RequestParts/citydata',
				data: 'countyid='+countyval,
				success: function(data) {
					//alert(data);
					if(data)
					{
						$("#PartsOrderLocation").html(data);
					}
					
				}
			});
}
</script>
<?php
//pr($this->request->data);
?>
<div class="container">
      <div class="row">
    <div class="innerpanel"> 
    <?php echo $this->Session->flash(); ?>
    <div class="col-md-12">
					<div class="clearfix" style="height:15px;"></div>
						<div class="col-lg-12 prof bs-example order_listnew">		
                        	
                             <?php echo $this->Form->create('PartsOrder', array('class' => 'form-horizontal')); ?>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                
                                    <h2 class="detailstitle1"><?php echo ORDERDETAILLL;?></h2>
                                    <div class="clearfix" style="height:10px;"></div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label"><?php echo PRICE;?>: </label>
                                        <div class="col-lg-7"><label><?php echo $price;?> <?php echo $currency;?></label></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label"><?php echo METHODOFDELIVERY;?>: </label>
                                        
                                        <div class="col-lg-7 required">
                                        <?php echo $this->Form->input('request_id', array('label' => false, 'div' => false, 'type' => 'hidden', 'value' => $request_id));?>
                           <?php echo $this->Form->input('parts_id', array('label' => false, 'div' => false, 'type' => 'hidden', 'value' => $parts_id));?>
                           <?php echo $this->Form->input('bid_id', array('label' => false, 'div' => false, 'type' => 'hidden', 'value' => $bid_id));?>
                           <?php echo $this->Form->input('totprice', array('label' => false, 'div' => false, 'type' => 'hidden', 'value' => $price.' '.$currency));?>
									   <?php 
                                      if(isset($this->request->data['PartsOrder']['delivery_method']))
                                      {
                                          $deliv_mth=$this->request->data['PartsOrder']['delivery_method'];
                                      }
                                      else
                                      {
                                          $deliv_mth='';
                                      }
                                      ?>
                                    <select name="data[PartsOrder][delivery_method]" id="PartsOrderDeliveryMethod" class="form-control" required>
                                          <option value="">- <?php echo CHOOSEMETHODDELIVERY;?>-</option>
                                           <?php if($personal_teaching==1){?>
                                 <option value="Personal Teaching"<?php if($deliv_mth=='Personal Teaching'){?> selected="selected"<?php }?>><?php echo PERSONALTEACHING;?></option>
                                        <?php }?>
                                         <?php if($courier==1 || $free_courier==1){
                                            if($free_courier==1){$cost='free shipping';}else{$cost=$courier_cost.' RON';}
                                            ?>
                                        <option value="courier"<?php if($deliv_mth=='courier'){?> selected="selected"<?php }?>>Courier( <?php echo $cost;?>)</option>
                                        <?php }?>
                                        <?php if($romanian_mail==1 || $free_romanian_mail==1){
                                            if($free_romanian_mail==1){$rcost='free shipping';}else{$rcost=$romanian_mail_cost.' RON';}
                                            ?>
                                        <option value="roman"<?php if($deliv_mth=='roman'){?> selected="selected"<?php }?>><?php echo ROMANIANMAIL;?>(<?php echo $rcost;?>)</option>
                                        <?php }?>
                                        </select>
                                        	
                                        </div>
                                    </div>                                    
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label">Warranty: </label>
                                        <div class="col-lg-7"><label><?php if($warranty!=''){echo $warranty."(".$validity.")";}else{echo "N/A";}?></label></div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label"><?php echo PAYMENTS;?>: </label>
                                        <div class="col-lg-7"><label><?php echo $payment_mode;?></label></div>
                                    </div>
                                </div>
                                 
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                
                                    <h2 class="detailstitle1"><?php echo CUSTOMERDTA;?></h2>
                                    <div class="clearfix" style="height:10px;"></div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label"><?php echo FIRSTNAME;?>: </label>
                                        <input type="hidden" name="bid_user_id" value="<?php echo $bid_user_id;?>" />
                                        <?php
						echo $this->Form->input('fname', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control', 'placeholder' => 'Prenumele tău'));
						?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label"><?php echo LASTNAME;?>: </label>
                                         <?php
						echo $this->Form->input('lname', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control', 'placeholder' => 'Numele de familie'));
						?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label"><?php echo PHONE;?>: </label>
                                       <?php
						echo $this->Form->input('phone', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control'));
						?>
                                    </div>      
                                    
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label">City: </label>
                                         <?php
						echo $this->Form->input('county', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control', 'type' => 'select', 'options' => $countylist, 'onchange' => 'changeCity(this.value)'));
						?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label">Locality: </label>
                                        <?php
									  if(isset($this->request->data['PartsOrder']['county']))
									  {
										  $citylist=$this->requestAction('/RequestParts/cityget/'.$this->request->data['PartsOrder']['county']);
									  
									 
									echo $this->Form->input('location', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control', 'type' => 'select', 'options' => $citylist));
									  }
									  else
									  {
										echo $this->Form->input('location', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control', 'type' => 'select', 'options' => array('' => '-'.CHOOSECITY.'-')));
										}
									?>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label"><?php echo POSTALCODE;?>: </label>
                                        <?php
								echo $this->Form->input('postcode', array('label' => false, 'div' => 'col-lg-7', 'class' => 'form-control', 'placeholder' => POSTALCODE, 'type' => 'text'));
								?>
                                    </div>   
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-lg-5 control-label"><?php echo DELIVERYADDRESSS;?>: </label>
                                        <?php
						echo $this->Form->input('delivery_add', array('label' => false, 'type' => 'textarea', 'div' => 'col-lg-7', 'class' => 'form-control', 'cols' => false, 'rows' =>false));
						
						?>
                                    </div>  
                                    
                                    <button type="submit" name="order_send" class="btn savebtn spacer_btn34">Confirm the Order</button>
    								 <br /><br />
									<?php
									  if(isset($openlogin) && $openlogin='yes')
									  {
										  ?>
										  <div id="openlogin form-inline">
                                          				<div class="form-group">
                                                            <label class="col-lg-5 control-label"><?php echo USERID;?>: </label>
                                                            <div class="col-lg-7">
                                                                <input type="text" name="data[MasterUser][user_login_id]" class="form-control" id="MasterUserUserLoginId" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-5 control-label"><?php echo PASSWORD;?>: </label>
                                                            <div class="col-lg-7">
                                                               <input type="password" name="data[MasterUser][user_pass]"  id="MasterUserUserPass" class="form-control" />
                                                            </div>
                                                        </div>
														 <div class="form-group">
                                                            <label class="col-lg-5 control-label">&nbsp;</label>
                                                            <div class="col-lg-7">
                                                              <input type="submit" name="order_send" class="btn btn-success" value="Login">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-5 control-label">&nbsp;</label>
                                                            <div class="col-lg-7">
                                                             <?php echo LOGINFACEBOOKACCOUNT;?>
                                                            </div>
                                                        </div>
                                                         <div class="form-group">
                                                            <label class="col-lg-5 control-label">&nbsp;</label>
                                                            <div class="col-lg-7">
                                                             <fb:login-button scope="public_profile,email" class="faacebook_suctomCL" onlogin="checkLoginState('innerpg');">
				<?php echo FBLOGIN;?>
				</fb:login-button>&nbsp;<span id="innerfbloader">
                                                            </div>
                                                        </div>
										  </div>
										  <?php
									  }
									  ?> 
                                </div>
                               
							</form>
                            
                        </div>
                    <div class="clear"></div>
			  </div>
         <?php /*?> <!-- Left Sidebar Start -->
          <div class="col-md-12 prof">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>"><span></span><?php echo HOME;?></a> </li>
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>pages/sales-details/<?php echo $slug;?>"><span></span> <?php echo $adv_name;?></a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo SALESCONFIRMORDER;?></a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08"><?php echo PLSCONFIRMORDER;?></h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
              <div class="row cereri">
                <div class="user_header">
                                  
                                  <div class="user_data_left">
                                  <?php if(isset($imgdetail) && !empty($imgdetail)){?>
                                      <img src="<?php echo $base_url;?>files/postad/<?php echo $imgdetail['PostadImg']['img_path'];?>" style="float:left;margin-right:10px;" width="80" height="80"/>
                                      <?php }else{?>
                                       <img src="<?php echo $base_url;?>images/profileholder.png" style="float:left;margin-right:10px;" width="80" height="80"/>
                                      <?php }?>
                                      <?php echo $adv_name;?>
                                  </div>
                                  
                                  <div class="user_data_left" style="float:right !important;">
                                    <div class="feedback">
                                      <b>
                                      <font>
                                      <font>
                                     <?php echo PLATINUMDEALERS;?>
                                      </font>
                                      </font>
                                      </b>
                                    </div>
                                    <span class="user_feedback_btn">
                                     <span class="username">
                                    <font>
                                    <font>
                                   <?php echo @$userDetail['ManageUser']['first_name'].' '.@$userDetail['ManageUser']['last_name'];?>
                                    </font>
                                    </font>
                                    </span>
                                    
                                    <span class="user_stars">
                                    <span class="user_star stars_green">
                                    </span>
                                    <font>
                                    <font>
                                    0
                                    </font>
                                    </font>
                                    </span>
                                    <span class="user_ribbon ">
                                    <span class="ribbon_percent">
                                    <font>
                                    <font>
                                    0%
                                    </font>
                                    </font>
                                    </span>
                                    <span class="ribbon_label">
                                    <font>
                                    <font>
                                    <?php echo POSITIVINGRATINGS;?>
                                    </font>
                                    </font>
                                    </span>
                                    <span class="ribbon_info" title="If the buyer has a lower percentage of 100% means that has negative ratings.  The percentages below 90% may indicate a problem.  Read explanation NEGATIVE ratings received by the buyer before making an offer.">
                                    </span>
                                    </span>
                                    </span>
                                  </div>
                                  
                                  
                                  <span class="separator" style="float:right;">
                                  </span>
                                  <div class="clearing">
                                  </div>
                                </div>
                                
            <div class="clear" style="height:20px;"></div>
            <div class="purchase_confirm">
                  <?php echo $this->Form->create('SalesOrder', array('class' => 'purchase-confirm-form')); ?>
                <div class="order_section">
                      <h2><?php echo ORDERDETAILLL;?></h2>
                      <div class="grid">
                    <div class="grid_row">
                          <div class="grid_left"> <?php echo PRICE;?>: </div>
                         
                          <div class="grid_right"> <?php echo $price;?> <?php echo $currency;?> x <?php echo $qty;?> pc. <span class="total"><font><font><?php echo TOTAL;?>: <?php if($qty!=''){echo $price*$qty; echo ' '.$currency;}?> </font></font></span><font><font> + delivery cost * </font></font></div>
                          <div class="clearing"></div>
                        </div>
                    <div class="grid_row">
                          <div class="grid_left"><font><font> * <?php echo METHODOFDELIVERY;?>: </font></font></div>
                          <div class="grid_right">
                          <input type="hidden" name="data[SalesOrder][qty]" id="SalesOrderQty" value="<?php echo $qty;?>" />
                          <input type="hidden" name="data[SalesOrder][adv_id]" id="SalesOrderAdvId" value="<?php echo $advid;?>" />
                          <input type="hidden" name="data[SalesOrder][totprice]" id="SalesOrderTotprice" value="<?php echo $price*$qty;?>" />
                          <input type="hidden" name="data[SalesOrder][phone]" id="SalesOrderPhone" value="<?php echo @$userDetail['ManageUser']['telephone1'];?> " />
                          <div class="input select required">
                          <?php 
						  if(isset($this->request->data['SalesOrder']['delivery_method']))
						  {
							  $deliv_mth=$this->request->data['SalesOrder']['delivery_method'];
						  }
						  else
						  {
							  $deliv_mth='';
						  }
						  ?>
                        <select name="data[SalesOrder][delivery_method]" id="SalesOrderDeliveryMethod">
                              <option value=""><font><font>- <?php echo CHOOSEMETHODDELIVERY;?>-</font></font></option>
                               <?php if($personal_teaching==1){?>
                     <option value="Personal Teaching"<?php if($deliv_mth=='Personal Teaching'){?> selected="selected"<?php }?>><?php echo PERSONALTEACHING;?></option>
                            <?php }?>
                             <?php if($courier==1 || $free_courier==1){
								if($free_courier==1){$cost='free shipping';}else{$cost=$courier_cost.' RON';}
								?>
							<option value="courier"<?php if($deliv_mth=='courier'){?> selected="selected"<?php }?>>Courier( <?php echo $cost;?>)</option>
                            <?php }?>
                            <?php if($romanian_mail==1 || $free_romanian_mail==1){
								if($free_romanian_mail==1){$rcost='free shipping';}else{$rcost=$romanian_mail_cost.' RON';}
								?>
							<option value="roman"<?php if($deliv_mth=='roman'){?> selected="selected"<?php }?>><?php echo ROMANIANMAIL;?>(<?php echo $rcost;?>)</option>
                            <?php }?>
                            </select>
                            </div>
                        <p style="padding-top:5px;"><font><font> <?php echo ORDERSENTS;?> </font></font><b><font><font>in <?php echo $time_required; if($time_required==1){?> day<?php }else{?> days<?php }?></font></font></b><font><font> . </font></font></p>
                        <p class="more_info"> <b><font><font><?php echo DELIVERYDETAILL;?>:</font></font></b><br>
                            </p>
                      </div>
                          <div class="clearing"></div>
                        </div>
                    <!--<div class="grid_row">
                          <div class="grid_left"><font><font> Warranty: </font></font></div>
                          <div class="grid_right"><font><font> The warranty for this piece. </font></font></div>
                          <div class="clearing"></div>
                        </div>-->
                    <div class="grid_row">
                          <div class="grid_left"><font><font> <?php echo PAYMENTS;?>: </font></font></div>
                          <div class="grid_right"><font><font class=""> <?php echo $payment_mode;?> </font></font></div>
                          <div class="clearing"></div>
                        </div>
                    <!--<div class="grid_row">
                          <div class="grid_left"><font><font> Return: </font></font></div>
                          <div class="grid_right"><font><font> Return will not be accepted. </font></font></div>
                          <div class="clearing"></div>
                        </div>-->
                  </div>
                    </div>
                <div class="order_section" style="margin-top:10px;">
                      <h2><font><font><?php echo CUSTOMERDTA;?></font></font></h2>
                      <div class="grid client_data">
                    
                    <div class="grid_row">
                          <div class="grid_left"><font><font> * <?php echo FIRSTNAME;?>: </font></font></div>
                          <div class="grid_right input text required">
                           <?php
						echo $this->Form->input('fname', array('label' => false, 'div' => false, 'placeholder' => 'Prenumele tău'));
						?>
                      </div>
                          <div class="clearing"></div>
                        </div>
                    <div class="grid_row">
                          <div class="grid_left"><font><font> * <?php echo LASTNAME;?>: </font></font></div>
                          
                          <?php
						echo $this->Form->input('lname', array('label' => false, 'div' => 'grid_right', 'placeholder' => 'Numele de familie'));
						?>
                          <div class="clearing"></div>
                        </div>
                    <div class="grid_row">
                          <div class="grid_left"><font><font> <?php echo PHONE;?>: </font></font></div>
                          <div class="grid_right"><font><font> <?php echo @$userDetail['ManageUser']['telephone1'];?> </font></font></div>
                          <div class="clearing"></div>
                        </div>
                    <div class="grid_row">
                          <div class="grid_left"><font><font> * <?php echo STREETADDRES;?>: </font></font></div>
                          <div class="grid_right">
                        <p> <span class="address_location required">
                           <?php
						echo $this->Form->input('county', array('label' => false, 'div' => false, 'type' => 'select', 'options' => $countylist, 'onchange' => 'changeCity(this.value)'));
						?>
                          </span> <span class="address_location address_city">
                          <?php
						  if(isset($this->request->data['SalesOrder']['county']))
						  {
							  $citylist=$this->requestAction('/RequestParts/cityget/'.$this->request->data['SalesOrder']['county']);
						  
						 
						echo $this->Form->input('location', array('label' => false, 'div' => false, 'type' => 'select', 'options' => $citylist));
						  }
						  else
						  {
							echo $this->Form->input('location', array('label' => false, 'div' => false, 'type' => 'select', 'options' => array('' => '-'.CHOOSECITY.'-')));
							}
						?>
                          </span> <span class="address_location input number required">
                           <?php
						echo $this->Form->input('postcode', array('label' => false, 'div' => false, 'placeholder' => POSTALCODE, 'type' => 'text'));
						?>
                          <!--<span class="btn_find_zipcode"><font><font>Search postcode</font></font></span>--> </span> </p>
                        <div class="clearing"></div>
                        <div class="err" id="err_client_adresa">
                              <div class="clearing"></div>
                            </div>
                        <p> </p>
                        <div class="info"><font><font>* <?php echo DELIVERYADDRESSS;?>:</font></font></div>
                         <?php
						echo $this->Form->input('delivery_add', array('label' => false, 'type' => 'textarea', 'cols' => false, 'rows' =>false));
						
						?>
                      </div>
                          <div class="clearing"></div>
                        </div>
                    <div class="grid_row">
                          <div class="grid_left"><font><font> <?php echo NOTESCOMMAND;?>: </font></font></div>
                          <div class="grid_right">
                        <?php
						echo $this->Form->input('note_command', array('label' => false, 'type' => 'textarea', 'cols' => false, 'rows' =>false));
						
						?>
                      </div>
                          <div class="clearing"></div>
                        </div>
                    <div class="grid_row">
                          <div class="grid_left"> &nbsp; </div>
                          <div class="grid_right">
                        <?php
						echo $this->Form->input('save_info', array('label' => false, 'type' => 'checkbox', 'div' => false, 'style' => 'width:auto;'));
						
						?>
                        <label for="save_my_data" style="cursor:pointer;"><font><font><?php echo SAVEABOVEINFO;?></font></font></label>
                      </div>
                          <div class="clearing"></div>
                        </div>
                  </div>
                    </div>
                    <div class="clear10"></div>
                <font><font>
                    <div style="text-align:center;width:100%;"><input type="submit" name="order_send" value="Confirm Order" class="flat_btn" style="float:inherit;"></div>
                </font></font>
                 <?php
					  if(isset($openlogin) && $openlogin='yes')
					  {
						  ?>
                          <div id="openlogin form-inline">
						      
											  <div class="form-group">
												<label for="exampleInputName2"><?php echo USERID;?></label>
												&nbsp;&nbsp;
												 <input type="text" name="data[MasterUser][user_login_id]" class="form-control" id="MasterUserUserLoginId" />
											  </div>
											  <div class="form-group">
												&nbsp;&nbsp;&nbsp;&nbsp;
												<label for="exampleInputEmail2"><?php echo PASSWORD;?></label>
												&nbsp;&nbsp;
												<input type="password" name="data[MasterUser][user_pass]"  id="MasterUserUserPass" class="form-control" />
											  </div>
											  
											  &nbsp;&nbsp;
											  <input type="submit" name="order_send" class="btn btn-success" value="Login">
											  
											  <div class="clearfix"></div>
											  <br>
											  <div class="form-group">
												<label for="exampleInputEmail2"><?php echo LOGINFACEBOOKACCOUNT;?></label>
												<br>
												<fb:login-button scope="public_profile,email" class="faacebook_suctomCL" onlogin="checkLoginState('innerpg');">
<?php echo FBLOGIN;?>
</fb:login-button>&nbsp;<span id="innerfbloader">
											  </div>

                          </div>
                          <?php
					  }
					  ?>
              </form>
                  <div class="clearing"></div>
                  <br>
                  <br>
                  <br>
                  <!--<div class="purchase_info">
                <div class="top"><font><font> Before you confirm your order, </font></font><a href="#"><font><font>consult the ratings the seller</font></font></a><font><font> and part description. </font></font><br>
                      <font><font> If you have questions, addressed them in advance seller messaging song page. </font></font></div>
                <div class="bottom">
                      <div class="info_title"><font><font> How does the command:</font></font><br>
                  </div>
                      <div class="toggle_extra_info"> <span class="arrow"></span> <span class="info"><font><font>display explanations</font></font></span> </div>
                      <div class="extra_info">
                    <div class="column" style="width:26%;">
                          <p class="column_title"><font><font>1. make contact with the seller</font></font></p>
                          <p class="column_text"><font><font> After confirmation, the seller will receive your order and you will have access to contact details of the seller. </font><font>If you do not receive the phone within 10 minutes from the seller, trying to contact him directly to be sure to see your command. </font></font></p>
                        </div>
                    <div class="arrow">&nbsp;</div>
                    <div class="column" style="width:27%;">
                          <p class="column_title"><font><font>2. Establishes details</font></font></p>
                          <p class="column_text"><font><font> Get in touch with the seller via private message, email or telephone to determine the exact details on how to order delivery and payment method. </font></font></p>
                        </div>
                    <div class="arrow">&nbsp;</div>
                    <div class="column" style="width:33%;">
                          <p class="column_title"><span><font><font>3. Important:</font></font></span><font><font> you give and get rating</font></font></p>
                          <p class="column_text"><font><font> After the transaction and receipt of the product, please grant seller rating. </font></font><br>
                        <font><font>Ratings are very important for both seller and for other customers who want to buy products from the same seller. </font></font></p>
                        </div>
                  </div>
                      <div class="clearing"></div>
                    </div>
              </div>-->
                </div>
            <div class="clearfix" style="height:10px;"></div>
          </div>
              <div class="clearfix" style="height:1px;"></div>
            </div>
        <div class="clear"></div>
      </div>
          <!-- Left Sidebar End -->
          
          <div class="clearfix" style="height:1px;"></div><?php */?>
          <div class="clear"></div>
        </div>
  </div>
      <div class="clearfix"></div>
    </div>
<?php
echo $this->element('footer-home');
?>