<?php
echo $this->element('header-home');
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
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo MYREQUESTPARTS;?></a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	<?php echo MYREQUESTPARTS;?>
			<a href="<?php echo $base_url;?>RequestParts/add" class="ctgbtn"><?php echo ASKFOROFFERPART;?></a>
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
            <div class="row">
            	<div class="listtop34  not_fix">
                	<div class="normaalborder">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php if($this->request->params['action']=='index'){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo ACTIVEREQUEST;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>RequestParts" ><?php echo ACTIVEREQUEST;?></a></li>
                              <?php
						  }?>
                          <?php if($this->request->params['action']=='resolve'){?>
						  <li class="active"><a href="javascript:void(0);" ><?php echo REQUESTSOLVED;?></a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>RequestParts/resolve" ><?php echo REQUESTSOLVED;?></a></li>
                              <?php
						  }?>
                            <?php if($this->request->params['action']=='inactive'){?>
						  <li class="active"><a href="javascript:void(0);" >cererea de anulare</a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>RequestParts/inactive" >cererea de anulare</a></li>
                              <?php
						  }?>
						 
						</ul>
						
						<div class="clearfix" style="height:15px;"></div>
						 <?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content');?>
						
						
						
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