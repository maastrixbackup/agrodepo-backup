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
             <div id="breadcrumb">
             <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span><?php echo DASHBOARD;?></a> </li>
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>PostAds/promotion/<?php echo $this->Session->read('promotion_adv_id');?>"><span></span>Promovare anunt</a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);">Metodă De Plată</a></li>
          </ul>
            </div>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	Metodă De Plată
            <!--<a href="choose_category.html" class="ctgbtn">Sell ​​a song »</a>-->
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
            
            </div>
        <div class="clear"></div>
      </div>
          
          <div class="clearfix" style="height:1px;"></div>
        </div>
  </div>
      <div class="clearfix"></div>
    </div>
<?php
echo $this->element('footer-home');
?>