<?php
echo $this->element('header-home');
?>
<script type="text/javascript">
function Status(statusval,orderid){
	$("#showloader").html('prelucrare...');
	$.ajax(
	{
		type: 'POST',
		url: '<?php echo $base_url; ?>Logins/status',
		data: 'orderid='+orderid+'&statusval='+statusval,
		success: function(data) {
			if(data==1)
			{
				alert("Status Updated Successfully");
				$("#showloader").html('');
				location.reload();
			}
			else
			{
				alert("Status Updating Failed");
			}
		}
	});
}
</script>
 <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span><?php echo DASHBOARD;?></a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);">
            <?php
			if(isset($this->request->params['pass'][1]))
			{
				$pagename=$this->request->params['pass'][1];
			}
			else
			{
				$pagename='';
			}
            if($pagename=='confirmed'){?>
        	<?php echo CONFIRMORDERS;?>
            <?php }else if($pagename=='shipped'){?>
            <?php echo SHIPEDORDERS;?>
             <?php }else if($pagename=='completed'){?>
            <?php echo COMPLETEORDERS;?>
            <?php }else if($pagename=='cancel'){?>
            <?php echo CANCLEORDERS;?>
            <?php }else if($pagename=='all'){?>
            <?php echo ALLORDERS;?>
            <?php }else{?>
            <?php echo NEWORDERS;?>
            <?php }?>
            </a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        <?php 
		if($pagename=='confirmed'){?>
        	<?php echo CONFIRMORDERS;?>
            <?php }else if($pagename=='shipped'){?>
            <?php echo SHIPEDORDERS;?>
             <?php }else if($pagename=='completed'){?>
            <?php echo COMPLETEORDERS;?>
            <?php }else if($pagename=='cancel'){?>
            <?php echo CANCLEORDERS;?>
            <?php }else if($pagename=='all'){?>
            <?php echo ALLORDERS;?>
            <?php }else{?>
            <?php echo NEWORDERS;?>
            <?php }?>
			<a href="<?php echo $base_url;?>PostAds/add" class="ctgbtn"><?php echo SELLASONG;?></a>
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
            <div class="row">
            	<div class="listtop34  not_fix">
                	<div class="normaalborder">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php if($pagename==''){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo NEWORDERS;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>pages/commands/" ><?php echo NEWORDERS;?></a></li>
                              <?php
						  }?>
                         <?php if($pagename=='confirmed'){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo CONFIRMORDERS;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>pages/commands/confirmed" ><?php echo CONFIRMORDERS;?></a></li>
                              <?php
						  }?>
                           <?php if($pagename=='shipped'){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo SHIPEDORDERS;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>pages/commands/shipped" ><?php echo SHIPEDORDERS;?></a></li>
                              <?php
						  }?>
                          <?php if($pagename=='completed'){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo COMPLETEORDERS;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>pages/commands/completed" ><?php echo COMPLETEORDERS;?></a></li>
                              <?php
						  }?>
						  <?php if($pagename=='cancel'){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo CANCLEORDERS;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>pages/commands/cancel" ><?php echo CANCLEORDERS;?></a></li>
                              <?php
						  }?>
                           <?php if($pagename=='all'){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo ALLORDERS;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>pages/commands/all" ><?php echo ALLORDERS;?></a></li>
                              <?php
						  }?>
						</ul>
						
						<div class="clearfix" style="height:15px;"></div>
						 <?php echo $this->Session->flash(); ?>
					<?php 
					if(isset($SalesOrders) && !empty($SalesOrders)){
						$requestcount=1;
						
						?>
					<div id="listing_items">
						<table cellpadding="0" cellspacing="0" class="tab-content">
							<tbody>
								<tr class="listing_header">
								<td width="60"><font><font><?php echo Sl;?></font></font></td>
								  <td align="center" width="226"><font><font><?php echo NOTICE;?></font></font></td>
								  <td align="center" width="100"><font><font><?php echo QTYXPRICE;?></font></font></td>
                                  <td align="center" width="100">stare</td>
									<td align="center" width="173"><font><font>cumpărător</font></font></td>
									<td align="center" width="114"><font><font><?php echo DATEOFPURCHASE;?></font></font></td>
								</tr>
								<?php 
								//pr($SalesOrders);
								foreach($SalesOrders as $SalesOrdersRes){
									$adv_name=stripslashes($SalesOrdersRes['PostAd']['adv_name']);
									$orderID=stripslashes($SalesOrdersRes['SalesOrder']['orderid']);
									$qty=stripslashes($SalesOrdersRes['SalesOrder']['qty']);
									$price=stripslashes($SalesOrdersRes['PostAd']['price']);
									$created=stripslashes($SalesOrdersRes['SalesOrder']['created']);
									$slug=stripslashes($SalesOrdersRes['PostAd']['slug']);
									$currency=stripslashes($SalesOrdersRes['PostAd']['currency']);
									$path=$base_url.'pages/sales-details/'.$slug;
									$userdetail=$this->Custom->BapUserDetails($SalesOrdersRes['SalesOrder']['user_id']);
									$personal_teaching=$SalesOrdersRes['PostAd']['personal_teaching'];
									$courier=$SalesOrdersRes['PostAd']['courier'];
									$courier_cost=$SalesOrdersRes['PostAd']['courier_cost'];
									$free_courier=$SalesOrdersRes['PostAd']['free_courier'];
									$romanian_mail=$SalesOrdersRes['PostAd']['romanian_mail'];
									$romanian_mail_cost=$SalesOrdersRes['PostAd']['romanian_mail_cost'];
									$free_romanian_mail=$SalesOrdersRes['PostAd']['free_romanian_mail'];
									?>
								<tr class="listing_data">
								<td align="center"><?php echo $requestcount;?></td>
									<td valign="top" class="listing_title_thumb col_name">
										
										<a href="<?php echo $path;?>" title="<?php echo $adv_name;?>"><strong><?php echo $adv_name;?></strong></a>
										<br>
										
										<?php echo ORDERID;?>: <?php echo $orderID;?>&nbsp;
										<br>
									</td>
									<td align="center">
										<?php echo $qty;?> x <?php echo $price.' '.$currency;?>
										
									</td>
                                     <td class="center_DTL"><?php
											$status=array(0=>NEWORDERS,1=>CONFIRMORDERS,3=>SHIPEDORDERS,2=>COMPLETEORDERS,4=>CANCLEORDERS);
											echo $this->Form->input('status',array("options"=>$status,'label'=>false,'onchange'=>'Status(this.value,'.$SalesOrdersRes['SalesOrder']['id'].')','selected'=>$SalesOrdersRes['SalesOrder']['status'], 'class' => 'form-control'));
										 ?>&nbsp;<span id="showloader"></span></td>
									<td align="center" class="sales_clerk">
										<a href="<?php echo $base_url;?>pages/user-profiles/<?php echo $userdetail['MasterUser']['user_id'];?>"><?php echo $userdetail['MasterUser']['first_name'].' '.$userdetail['MasterUser']['last_name'];?></a>
										 <div class="clearfix"></div>
                                    <span class="user_star stars_purple"><?php echo $this->Custom->userProfileResult($userdetail['MasterUser']['user_id']);?></span>
                                    <div class="clearfix"></div>
                                    <span class="gbutton6 "  data-toggle="modal" data-target="#sales_order<?php echo $requestcount;?>">Cumparator Detalii
                                    </span>
                                    <div class="modal fade" id="sales_order<?php echo $requestcount;?>">
              <div class="modal-dialog order_modal3">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Comanda Detalii</h4>
                  </div>
                  <div class="modal-body order_listscroll2">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <td width="30%">Comanda ID</td>
                              <td width="70%"><?php echo $SalesOrdersRes['SalesOrder']['orderid'];?> </td>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td width="30%">Odered Prin</td>
                              <td width="70%"><?php $user_details=$this->Custom->user_details($SalesOrdersRes['SalesOrder']['user_id']);?> 
                                        <?php echo $user_details['first_name'].' '.$user_details['last_name'];?> </td>
                            </tr>
                            <tr>
                              <td width="30%">Niciun Telefon</td>
                              <td width="70%" style="text-align:left;"><?php echo $user_details['telephone1'];?> </td>
                            </tr>
                            <tr>
                              <td width="30%">Livrare Nume</td>
                              <td width="70%" style="text-align:left;"><?php echo $SalesOrdersRes['SalesOrder']['fname'].' '.$SalesOrdersRes['SalesOrder']['lname'];?></td>
                            </tr>
                             
                            <tr>
                              <td width="30%">județ</td>
                              <td width="70%" style="text-align:left;"><?php echo $this->Custom->region_nm($SalesOrdersRes['SalesOrder']['county']);?></td>
                            </tr>
                             <tr>
                              <td width="30%">locație</td>
                              <td width="70%" style="text-align:left;"><?php echo $this->Custom->location_nm($SalesOrdersRes['SalesOrder']['location']);?></td>
                            </tr>
                             <tr>
                              <td width="30%">Cod Poștal</td>
                              <td width="70%" style="text-align:left;"><?php echo $SalesOrdersRes['SalesOrder']['postcode'];?></td>
                            </tr>
                             <tr>
                              <td width="30%">metoda de livrare</td>
                              <td width="70%" style="text-align:left;">
							  <?php if($SalesOrdersRes['SalesOrder']['delivery_method']=="Personal Teaching"){?>
							  <?php if($personal_teaching==1){ echo PERSONALTEACHING; }?>
                              <?php }else if($SalesOrdersRes['SalesOrder']['delivery_method']=="courier"){?>
                                         <?php if($courier==1 || $free_courier==1){
                                            if($free_courier==1){$cost='free shipping';}else{$cost=$courier_cost.' RON';}
                                            ?>
                                       Courier( <?php echo $cost;?>) 
                                        <?php }}else if($SalesOrdersRes['SalesOrder']['delivery_method']=="roman"){?>
                                        
                                        <?php if($romanian_mail==1 || $free_romanian_mail==1){
                                            if($free_romanian_mail==1){$rcost='free shipping';}else{$rcost=$romanian_mail_cost.' RON';}
                                            ?>
                                       <?php echo ROMANIANMAIL;?>(<?php echo $rcost;?>)
                                        <?php }}?></td>
                            </tr>
                             <tr>
                              <td width="30%">Adresă De Livrare</td>
                              <td width="70%" style="text-align:left;"><?php echo $SalesOrdersRes['SalesOrder']['delivery_add'];?></td>
                            </tr>
                            <tr>
                              <td width="30%">Pret Total</td>
                              <td width="70%" style="text-align:left;"><?php echo $SalesOrdersRes['SalesOrder']['totprice'].' '.$SalesOrdersRes['PostAd']['currency'];?></td>
                            </tr>
                            
                          </tbody>
                        </table>
                  </div>
                </div>
              </div>
            </div>
										
									
									</td>
									<td>
									  <?php echo date("F d, Y H:i",strtotime($created));?>
									</td>
								</tr>
								<?php
								$requestcount++;
								 }
								?>
							  
							</tbody>
						</table>
					</div>
					  <?php }else{?>
                            <div class="tabdata">
                                            <strong><?php echo YOUHAVENO;?> <?php 
																if($pagename=='confirmed'){?>
																	<?php echo CONFIRMORDERS;?>
																	<?php }else if($pagename=='shipped'){?>
																	<?php echo SHIPEDORDERS;?>
																	 <?php }else if($pagename=='completed'){?>
																	<?php echo COMPLETEORDERS;?>
																	<?php }else if($pagename=='cancel'){?>
																	<?php echo CANCLEORDERS;?>
																	<?php }else if($pagename=='all'){?>
																	<?php echo ALLORDERS;?>
																	<?php }else{?>
																	<?php echo NEWORDERS;?>
																	<?php }?></strong>
                                        </div>
                            <?php }?>
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
  <script>
$(document).ready(function(e) {
	
    $(".custom_popbox").click(function(e) {
        $(this).find($(".popup_visible")).toggle(200);
    });
});
</script>
<?php
echo $this->element('footer-home');
?>