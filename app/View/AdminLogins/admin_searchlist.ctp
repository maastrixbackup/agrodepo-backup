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
              <div class="col-md-6">
                  <!-- TABLE: LATEST SALES ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Brand List</h3>
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
                          <th>sl#</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Created Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      if(!empty($brandList)){
                        $brandCount=1;
                        foreach ($brandList as $brandListRes) {
                         
                          $status=array(0=>"Inactive",1=>"Active");
                          ?>
                          <tr>
                          <td><?=$brandCount?></td>
                          <td><a href="<?php echo $base_url;?>admin/ManageBrands/view/<?=$brandListRes['ManageBrand']['brand_id']?>"><?=$brandListRes['ManageBrand']['brand_name']?></a></td>
                          <td><span class="label label-success"><?=$status[$brandListRes['ManageBrand']['status']]?></span></td>
                          <td><span><?=date('d-m-Y', strtotime($brandListRes['ManageBrand']['created']))?></span></td>
                        </tr>
                          <?php
                          $brandCount++;
                        }
                      }else{
                        ?>
                         <tr>
                          <td colspan="4">No Brand Found</td>
                        </tr>
                        <?php
                      }
                      ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <!-- <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
                  <!-- <a href="<?php //echo $base_url;?>admin/Reports/sales_order" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
                </div>



                 <div class="col-md-6">
                  <!-- TABLE: LATEST SALES ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Category List</h3>
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
                          <th>sl#</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Created Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      if(!empty($ManageCategory)){
                        $categoryCount=1;
                        foreach ($ManageCategory as $categoryListRes) {
                         
                          $status=array(0=>"Inactive",1=>"Active");
                          ?>
                          <tr>
                          <td><?=$categoryCount?></td>
                          <td><a href="<?php echo $base_url;?>admin/ManageCategories/view/<?=$categoryListRes['ManageCategory']['category_id']?>"><?=$categoryListRes['ManageCategory']['category_name']?></a></td>
                          <td><span class="label label-success"><?=$status[$categoryListRes['ManageCategory']['status']]?></span></td>
                          <td><span><?=date('d-m-Y', strtotime($categoryListRes['ManageCategory']['created']))?></span></td>
                        </tr>
                          <?php
                          $categoryCount++;
                        }
                      }else{
                        ?>
                         <tr>
                          <td colspan="4">No Categories Found</td>
                        </tr>
                        <?php
                      }
                      ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <!-- <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
                  <!-- <a href="<?php //echo $base_url;?>admin/Reports/sales_order" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
                </div>



                
              </div><!-- /.row -->

        </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->