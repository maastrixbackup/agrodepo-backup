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
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo POSTAD;?></a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08"><?php echo DESCRIPTION;?></h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
              <div class="row"> 
            <?php echo $this->Session->flash(); ?>
			
            <!--form 1-->
            <?php echo $this->fetch('content');?>
            <!--form 1--> 
          </div>
            </div>
        <div class="clear"></div>
      </div>
          <!-- Left Sidebar End -->
          
          <div class="clearfix" style="height:1px;"></div>
        </div>
  </div>
      <div class="clearfix"></div>
    </div>
<?php
echo $this->element('footer-home');
?>