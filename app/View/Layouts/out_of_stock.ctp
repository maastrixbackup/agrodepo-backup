<?php
echo $this->element('header-home');
//echo $this->element('sql_dump');
//pr($SalesOrders);
?>
 <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span><?php echo DASHBOARD;?></a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo OUTOFSTOCT;?></a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	<?php echo OUTOFSTOCT;?>
			<a href="<?php echo $base_url;?>PostAds/add" class="ctgbtn"><?php echo SELLASONG;?></a>
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
            <div class="row">
            	<div class="listtop34  not_fix">
                	<div class="normaalborder">
						
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
            <td width="10%"><font><font><?php echo Sl;?></font></font></td>
              <td align="center" width="20%"><font><font><?php echo NOTICE;?></font></font></td>
              <td align="center" width="20%"><font><font><?php echo QTYXPRICE;?></font></font></td>
                <!--<td align="center" width="25%"><font><font><?php echo SALECLERK;?></font></font></td>-->
                <td align="center" width="25%"><font><font><?php echo DATEOFORDER;?></font></font></td>
            </tr>
            <?php 
			
			foreach($SalesOrders as $SalesOrdersRes){
				if($SalesOrdersRes[0]['totqty']== $SalesOrdersRes['PostAd']['quantity'])
				{
				$adv_name=stripslashes($SalesOrdersRes['PostAd']['adv_name']);
				$orderID=stripslashes($SalesOrdersRes['SalesOrder']['orderid']);
				$qty=stripslashes($SalesOrdersRes['SalesOrder']['qty']);
				$price=stripslashes($SalesOrdersRes['PostAd']['price']);
				$created=stripslashes($SalesOrdersRes['SalesOrder']['created']);
				$slug=stripslashes($SalesOrdersRes['PostAd']['slug']);
				$currency=stripslashes($SalesOrdersRes['PostAd']['currency']);
				$path=$base_url.'pages/sales-details/'.$slug;
				$userdetail=$this->Custom->BapUserDetails($SalesOrdersRes['PostAd']['user_id']);
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
                <!--<td align="center" class="sales_clerk">
                	<a href="<?php echo $base_url;?>pages/user-profiles/<?php echo $userdetail['MasterUser']['user_id'];?>"><?php echo $userdetail['MasterUser']['first_name'].' '.$userdetail['MasterUser']['last_name'];?></a>
                    <div class="clearfix"></div>
                    <span class="user_star stars_purple"><?php echo $this->Custom->userProfileResult($userdetail['MasterUser']['user_id']);?></span>
                    <div class="clearfix"></div>
                    <span class="gbutton6"><?php echo DETAILSSELLER;?>
                    </span>
                
                </td>-->
                <td>
                  <?php echo date("F d, Y H:i",strtotime($created));?>
                </td>
            </tr>
            <?php
			$requestcount++;
				}
			 }
			?>
          
        </tbody>
    </table>
</div>
  <?php }else{?>
                            <div class="tabdata">
                                            <strong><?php echo NOSALERATING;?></strong>
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
<?php
echo $this->element('footer-home');
?>