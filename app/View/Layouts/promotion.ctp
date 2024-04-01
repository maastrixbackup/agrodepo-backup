<?php
echo $this->element('header-home');
?>
 <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
                <div class="col-md-12 prof cereia_auto">
                     <div class="clearfix" style="height:15px;"></div>
                     
                     <div id="breadcrumb">
                          <ul class="crumbs">
                            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span>Dashboard</a> </li>
                            <li class="last"><a style="z-index:7;" href="<?php echo $base_url;?>PostAds"><?php echo ACTIVESALE;?></a></li>
                      	</ul>
                    </div>
                    
                     <h2 class="detailstitle1">Promovare anunt</h2>
                     
                     <div class="clearfix" style="height:15px;"></div>
                       <?php echo $this->Session->flash(); ?>
					 <?php echo $this->fetch('content');?>
                     
                     
                     
                     
                     
                    <div class="clear"></div>
                    
                </div>
            <!-- Left Sidebar End -->
          
          <div class="clearfix" style="height:1px;"></div>
        </div>
  </div>
  </div>
<?php
echo $this->element('footer-home');
?>