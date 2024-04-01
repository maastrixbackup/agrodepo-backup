<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
            <?php echo $this->element('myadmin/dashboard-left');?>
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <div class="input-group">
                                        <input type="text" placeholder="Search Category, Brands by Keywords" name="searchtxt" id="searchtxt" value="<?php echo @$searchtxt;?>"  class="form-control input-sm pull-right eanterSearch" style="width: 300px; margin-right:5px;" >
                                                               <div class="input-group-btn">
                                                          &nbsp;&nbsp; <button  type="button" name="searchbutn"  class="btn btn-sm btn-default" id="searchbutn" onclick="return searchBrandFunc();">Search</button>
                                              
                                            </div>
                                        </div>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
               <section class="content">
          <!-- Info boxes -->
          
           <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total No of Users</span>
                  <span class="info-box-number"><?=$totalusers?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
           <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Byer</span>
                  <span class="info-box-number"><?=$totalBuyer?></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?=$buyerPercent?>%"></div>
                  </div>
                  <span class="progress-description">
                    <?=$buyerPercent?>% Buyer from Total user
                  </span>
                </div><!-- /.info-box-content -->
              </div>
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Seller</span>
                  <span class="info-box-number"><?=$totalSeller?></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?=$sellerPercent?>%"></div>
                  </div>
                  <span class="progress-description">
                    <?=$sellerPercent?>% Seller from Total user
                  </span>
                </div><!-- /.info-box-content -->
              </div>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-record"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Sales Made</span>
                  <span class="info-box-number"><?=$totSalesMade?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-android-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Auto Parts</span>
                  <span class="info-box-number"><?=$totalautoParts?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
          </div><!-- /.row -->

           <div class="row">
             <div class="col-md-6">
                  <!-- USERS LIST -->
                  <div class="box box-danger">
                    <div class="box-header with-border">
                      <h3 class="box-title">Latest Members</h3>
                      <div class="box-tools pull-right">
                       <!--  <span class="label label-danger"><?php echo $this->Custom->totalNotice('register');?> New Members</span> -->
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                      <ul class="users-list clearfix">
                      <?php
                      if(!empty($latestmembers)){
                        foreach ($latestmembers as $latestmember) {
                          $userID=$latestmember['MasterUser']['user_id'];
                          $name=stripcslashes($latestmember['MasterUser']['first_name']." ".$latestmember['MasterUser']['last_name']);
                          $joinDate=date("Y-m-d",strtotime($latestmember['MasterUser']['created']));
                          $prevDay = date('Y-m-d', strtotime('-1 day', date('Y-m-d')));
                          if($joinDate==date("Y-m-d")){
                            $joinDate="Today";
                          }elseif ($joinDate==$prevDay) {
                            $joinDate="Yesterday";
                          }else{
                            $joinDate=date("d M", strtotime($joinDate));
                          }
                          ?>

                           <li>
                          <?php

                              
                              if($latestmember['MasterUser']['profile_img']!=''){
                        
                                if (file_exists('files/profileimg/172X180_'.$latestmember['MasterUser']['profile_img'])) {
                                $imgdetail_path=$base_url.'files/profileimg/172X180_'.$latestmember['MasterUser']['profile_img'];
                                   }else{
                                $imgdetail_path=$base_url.'files/profileimg/'.$latestmember['MasterUser']['profile_img'];
                                     }
                                ?>
                                      <img src="<?php echo $imgdetail_path;?>" style="width:128px; height:128px;" alt="">
                                      <?php }else if($latestmember['MasterUser']['is_facebook']==1)
                              {
                                ?>
                                          <img src="http://graph.facebook.com/<?php echo $latestmember['MasterUser']['fb_id'];?>/picture?type=large" style="width:128px; height:128px;" alt="">
                                          <?php
                              }else{?>
                                          <img src="<?php echo $this->webroot;?>images/user.png" style="width:128px; height:128px;" alt="">
                                          <?php }?>
                          <a class="users-list-name" href="<?=$base_url."admin/ManageUsers/view/".$userID?>"><?=$name?></a>
                          <span class="users-list-date"><?=$joinDate?></span>
                        </li>
                          <?php
                        }
                      }
                      ?>
                      </ul><!-- /.users-list -->
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                      <a href="<?=$base_url."admin/ManageUsers/"?>" class="uppercase">View All Users</a>
                    </div><!-- /.box-footer -->
                  </div><!--/.box -->
                </div><!-- /.col -->
                <div class="col-md-6">
                  <!-- PRODUCT LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest visited Ads</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                  <?php
                  if(!empty($latestVisits)){
                      foreach ($latestVisits as $latestVisitID) {
                          $salesDetail=$this->Custom->BapCustUniSales($latestVisitID);
                          if(!empty($salesDetail))
                          {
                              $postId=stripslashes($salesDetail['PostAd']['adv_id']);
                              $adv_name=stripslashes($salesDetail['PostAd']['adv_name']);
                              $product_cond=stripslashes($salesDetail['PostAd']['product_cond']);
                              $price=stripslashes($salesDetail['PostAd']['price']);
                              $currency=stripslashes($salesDetail['PostAd']['currency']);
                              $quantity=stripslashes($salesDetail['PostAd']['quantity']);
                              $adv_details=strip_tags(stripslashes($salesDetail['PostAd']['adv_details']));
                              $content=(strlen($adv_details)>200) ? substr($adv_details,0,200).'...' : $adv_details;
                              $slug=stripslashes($salesDetail['PostAd']['slug']);
                              $salespath=$base_url.'pages/sales-details/'.$slug;
                              $salesImg=$this->Custom->BapCustUniSalesImg($latestVisitID);
                                $path='files/postad/128x120_'.$salesImg['PostadImg']['img_path'];
                                if (file_exists($path)) {
                                $imgpath=$base_url.'files/postad/128x120_'.$salesImg['PostadImg']['img_path'];
                                   }else{
                                $imgpath=$base_url.'files/postad/'.$salesImg['PostadImg']['img_path'];
                                     }
                          ?>
                          <li class="item">
                          <?php if(!empty($salesImg)){?>
                        <div class="product-img">
                          <img src="<?php echo $imgpath;?>" alt="Sales Image">
                        </div>
                        <?php }else{?>
                        <div class="product-img">
                          <img src="<?php echo $base_url;?>latestadmin/dist/img/default-50x50.gif" alt="Sales Image">
                        </div>
                        <?php }?>
                        <div class="product-info">
                          <a href="<?=$salespath?>" class="product-title" target="_blank"><?=$adv_name?> <span class="label label-warning pull-right"><?php echo $price.' '.$currency;?></span></a>
                          <span class="product-description">
                            <?php echo nl2br($content);?>
                          </span>
                        </div>
                      </li><!-- /.item -->
                          <?php
                        }
                      }
                  }
                  ?>
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?php echo $base_url;?>admin/ManageSales" class="uppercase">View All Ads</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
                </div><!-- /.col -->   

                
              </div><!-- /.row -->


               <div class="row">
                <div class="col-md-6">
                  <!-- Most viewed -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Most Viewed Ads</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                  <?php
                  if(!empty($mostViewRes)){
                      foreach ($mostViewRes as $mostViewResult) {
                              $postId=stripslashes($mostViewResult['PostAd']['adv_id']);
                              $adv_name=stripslashes($mostViewResult['PostAd']['adv_name']);
                              $product_cond=stripslashes($mostViewResult['PostAd']['product_cond']);
                              $price=stripslashes($mostViewResult['PostAd']['price']);
                              $currency=stripslashes($mostViewResult['PostAd']['currency']);
                              $quantity=stripslashes($mostViewResult['PostAd']['quantity']);
                              $adv_details=strip_tags(stripslashes($mostViewResult['PostAd']['adv_details']));
                              $content=(strlen($adv_details)>200) ? substr($adv_details,0,200).'...' : $adv_details;
                              $slug=stripslashes($mostViewResult['PostAd']['slug']);
                              $salespath=$base_url.'pages/sales-details/'.$slug;
                              $salesImg=$this->Custom->BapCustUniSalesImg($postId);
                                $path='files/postad/128x120_'.$salesImg['PostadImg']['img_path'];
                                if (file_exists($path)) {
                                $imgpath=$base_url.'files/postad/128x120_'.$salesImg['PostadImg']['img_path'];
                                   }else{
                                $imgpath=$base_url.'files/postad/'.$salesImg['PostadImg']['img_path'];
                                     }
                          ?>
                          <li class="item">
                          <?php if(!empty($salesImg)){?>
                        <div class="product-img">
                          <img src="<?php echo $imgpath;?>" alt="Sales Image">
                        </div>
                        <?php }else{?>
                        <div class="product-img">
                          <img src="<?php echo $base_url;?>latestadmin/dist/img/default-50x50.gif" alt="Sales Image">
                        </div>
                        <?php }?>
                        <div class="product-info">
                          <a href="<?=$salespath?>" class="product-title" target="_blank"><?=$adv_name?> <span class="label label-warning pull-right"><?php echo $price.' '.$currency;?></span></a>
                          <span class="product-description">
                            <?php echo nl2br($content);?>
                          </span>
                        </div>
                      </li><!-- /.item -->
                          <?php
                      }
                  }
                  ?>
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?php echo $base_url;?>admin/ManageSales" class="uppercase">View All Ads</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
                </div><!-- /.col -->   
                <div class="col-md-6">
                  <!-- TABLE: LATEST SALES ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Sales Order</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Sales Name</th>
                          <th>Status</th>
                          <th>Ordered Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      if(!empty($salesOrderRes)){
                        foreach ($salesOrderRes as $salesOrderResult) {
                          $advDetail=$this->Custom->BapCustUniAdvDetail($salesOrderResult['SalesOrder']['adv_id']);
                          $status=array(0=>"New Order",1=>"Confirmed Order",2=>"Completed Order",3=>"Shipped Order",4=>"Canceled Order");
                          ?>
                          <tr>
                          <td><a href="<?php echo $base_url;?>admin/Reports/salesorder_view/<?=$salesOrderResult['SalesOrder']['id']?>"><?=$salesOrderResult['SalesOrder']['orderid']?></a></td>
                          <td><?=stripslashes($advDetail['PostAd']['adv_name']);?></td>
                          <td><span class="label label-success"><?=$status[$salesOrderResult['SalesOrder']['status']]?></span></td>
                          <td><span><?=date('d-m-Y', strtotime($salesOrderResult['SalesOrder']['created']))?></span></td>
                        </tr>
                          <?php
                        }
                      }
                      ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <!-- <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
                  <a href="<?php echo $base_url;?>admin/Reports/sales_order" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
                </div>
                
              </div><!-- /.row -->

              <div class="row">
                <div class="col-md-6">
                  <!-- TABLE: LATEST SALES ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Parts Order</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Parts Name</th>
                          <th>Status</th>
                          <th>Ordered Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      //print_r($partsOrderRes);exit();
                      if(!empty($partsOrderRes)){
                        foreach ($partsOrderRes as $partsOrderresult) {
                          $partsDetail=$this->Custom->BapCustUniPartsDetail($partsOrderresult['PartsOrder']['parts_id']);
                          $status=array(0=>"New Order",1=>"Confirmed Order",2=>"Completed Order",3=>"Shipped Order",4=>"Canceled Order");
                          ?>
                          <tr>
                          <td><a href="<?php echo $base_url;?>admin/Reports/requestorder"><?=$partsOrderresult['PartsOrder']['orderid']?></a></td>
                          <td><?=stripslashes($partsDetail['RequestAccessory']['name_piece'])?></td>
                          <td><span class="label label-success"><?=$status[$partsOrderresult['PartsOrder']['status']]?></span></td>
                          <td><span><?=date('d-m-Y', strtotime($partsOrderresult['PartsOrder']['created']))?></span></td>
                        </tr>
                          <?php
                        }
                      }
                      ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <!-- <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
                  <a href="<?php echo $base_url;?>admin/Reports/requestorder" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
                </div>
              </div>


             









          <?php /*?><div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Monthly Recap Report</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8">
                      <p class="text-center">
                        <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                      </p>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="salesChart" style="height: 180px;"></canvas>
                      </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Goal Completion</strong>
                      </p>
                      <div class="progress-group">
                        <span class="progress-text">Add Products to Cart</span>
                        <span class="progress-number"><b>160</b>/200</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Complete Purchase</span>
                        <span class="progress-number"><b>310</b>/400</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Visit Premium Page</span>
                        <span class="progress-number"><b>480</b>/800</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Send Inquiries</span>
                        <span class="progress-number"><b>250</b>/500</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                        <h5 class="description-header">$35,210.43</h5>
                        <span class="description-text">TOTAL REVENUE</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                        <h5 class="description-header">$10,390.90</h5>
                        <span class="description-text">TOTAL COST</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                        <h5 class="description-header">$24,813.53</h5>
                        <span class="description-text">TOTAL PROFIT</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block">
                        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                        <h5 class="description-header">1200</h5>
                        <span class="description-text">GOAL COMPLETIONS</span>
                      </div><!-- /.description-block -->
                    </div>
                  </div><!-- /.row -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <!-- MAP & BOX PANE -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Visitors Report</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-9 col-sm-8">
                      <div class="pad">
                        <!-- Map will be created here -->
                        <div id="world-map-markers" style="height: 325px;"></div>
                      </div>
                    </div><!-- /.col -->
                    <div class="col-md-3 col-sm-4">
                      <div class="pad box-pane-right bg-green" style="min-height: 280px">
                        <div class="description-block margin-bottom">
                          <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                          <h5 class="description-header">8390</h5>
                          <span class="description-text">Visits</span>
                        </div><!-- /.description-block -->
                        <div class="description-block margin-bottom">
                          <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                          <h5 class="description-header">30%</h5>
                          <span class="description-text">Referrals</span>
                        </div><!-- /.description-block -->
                        <div class="description-block">
                          <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                          <h5 class="description-header">70%</h5>
                          <span class="description-text">Organic</span>
                        </div><!-- /.description-block -->
                      </div>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
             

              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Orders</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Item</th>
                          <th>Status</th>
                          <th>Popularity</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR9842</a></td>
                          <td>Call of Duty IV</td>
                          <td><span class="label label-success">Shipped</span></td>
                          <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div></td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR1848</a></td>
                          <td>Samsung Smart TV</td>
                          <td><span class="label label-warning">Pending</span></td>
                          <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                          <td>iPhone 6 Plus</td>
                          <td><span class="label label-danger">Delivered</span></td>
                          <td><div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div></td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                          <td>Samsung Smart TV</td>
                          <td><span class="label label-info">Processing</span></td>
                          <td><div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div></td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR1848</a></td>
                          <td>Samsung Smart TV</td>
                          <td><span class="label label-warning">Pending</span></td>
                          <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                          <td>iPhone 6 Plus</td>
                          <td><span class="label label-danger">Delivered</span></td>
                          <td><div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div></td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR9842</a></td>
                          <td>Call of Duty IV</td>
                          <td><span class="label label-success">Shipped</span></td>
                          <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-4">
              <!-- Info Boxes Style 2 -->
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Inventory</span>
                  <span class="info-box-number">5,200</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                  </div>
                  <span class="progress-description">
                    50% Increase in 30 Days
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Mentions</span>
                  <span class="info-box-number">92,050</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 20%"></div>
                  </div>
                  <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Downloads</span>
                  <span class="info-box-number">114,381</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Direct Messages</span>
                  <span class="info-box-number">163,921</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 40%"></div>
                  </div>
                  <span class="progress-description">
                    40% Increase in 30 Days
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->

              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Browser Usage</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="chart-responsive">
                        <canvas id="pieChart" height="150"></canvas>
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                      <ul class="chart-legend clearfix">
                        <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                        <li><i class="fa fa-circle-o text-green"></i> IE</li>
                        <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                        <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                        <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                        <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">United States of America <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                    <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a></li>
                    <li><a href="#">China <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                  </ul>
                </div><!-- /.footer -->
              </div><!-- /.box -->

              <!-- PRODUCT LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Recently Added Products</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                    <li class="item">
                      <div class="product-img">
                        <img src="<?php echo $base_url;?>latestadmin/dist/img/default-50x50.gif" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title">Samsung TV <span class="label label-warning pull-right">$1800</span></a>
                        <span class="product-description">
                          Samsung 32" 1080p 60Hz LED Smart HDTV.
                        </span>
                      </div>
                    </li><!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="<?php echo $base_url;?>latestadmin/dist/img/default-50x50.gif" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title">Bicycle <span class="label label-info pull-right">$700</span></a>
                        <span class="product-description">
                          26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                        </span>
                      </div>
                    </li><!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="<?php echo $base_url;?>latestadmin/dist/img/default-50x50.gif" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                        <span class="product-description">
                          Xbox One Console Bundle with Halo Master Chief Collection.
                        </span>
                      </div>
                    </li><!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="<?php echo $base_url;?>latestadmin/dist/img/default-50x50.gif" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title">PlayStation 4 <span class="label label-success pull-right">$399</span></a>
                        <span class="product-description">
                          PlayStation 4 500GB Console (PS4)
                        </span>
                      </div>
                    </li><!-- /.item -->
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript::;" class="uppercase">View All Products</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row --><?php */?>
        </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->