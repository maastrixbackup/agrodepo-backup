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
            <?php if(($this->request->params['controller']=='PostAds' && ($this->request->params['action']=='deletead' || $this->request->params['action']=='deletesearch'))){?>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo DELETEADS;?></a></li>
        
        <?php }else{?>
        	<li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo ACTIVESALE;?></a></li>
            <?php }?>
            
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        <?php if(($this->request->params['controller']=='PostAds' && ($this->request->params['action']=='deletead' || $this->request->params['action']=='deletesearch'))){?>
        <?php echo DELETEADS;?>
        <?php }else{?>
        	<?php echo ACTIVESALE;?>
            <?php }?>
            <a href="<?php echo $base_url;?>PostAds/add" class="ctgbtn"><?php echo SELLASONG;?> »</a>
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <?php echo $this->Session->flash(); ?>
	 <?php echo $this->fetch('content');?>
        
            </div>
        <div class="clear"></div>
      </div>
          
          <div class="clearfix" style="height:1px;"></div>
        </div>
  </div>
<?php
echo $this->element('footer-home');
?>