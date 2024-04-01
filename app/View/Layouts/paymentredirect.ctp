<?php
echo $this->element('header-home');
?>
  <script type="text/javascript">
jQuery(window).load(function () {
  // alert('page is loaded');   
   $("#payment_load").hide();
   //$(".owl-carousel").html("loading....");
});
</script>
    <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
             <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span>Dashboard</a> </li>
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>UpgradeMemberships/"><span></span>Membership Type</a> </li>
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>UpgradeMemberships/card"><span></span>Card</a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);">Confirm Plan</a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        
        <div class="col-lg-12" id="payment_load">
      <h2>  <img src="<?php echo $base_url;?>images/block-loading.gif" style="text-align:center" /> Redirecționare la plata pagina...</h2>
         <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
            
                
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
