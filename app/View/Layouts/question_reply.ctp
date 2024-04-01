<?php
echo $this->element('header-home');
?>

    <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof tdauto">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span>Dashboard</a> </li>
            <li class="first"><a style="z-index:9;" href="<?php echo $base_url;?>RequestParts/request_question">Question on Offer</a></li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);">Reply On Question</a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	 View Reply on Question
           
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
          
                 <?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content');?>
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
