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
           <?php if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='edit'){?>
           <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span><?php echo DASHBOARD;?></a> </li>
           <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>RequestParts/"><span></span><?php echo MYREQUESTPARTS;?></a> </li>
			  <?php }else{?>
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>"><span></span><?php echo HOME;?></a> </li>
            <?php }?>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo QUOTATIONFORAUTOPARTS;?></a></li>
          </ul>
            </div>
            <div class="col-md-12 prof cereia_auto">
                        
                         <h2 class="detailstitle1"><?php echo QUOTATIONFORAUTOPARTS;?></h2>
                         
                         <div class="clearfix" style="height:15px;"></div>
                         
						 <div class="col-lg-12">
						 	<div class="row">
                                <!--form 1-->
                                
                               
                                 <?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content');?>
                                <!--  Step 3 Form start  -->
                                
                                <!--form 1-->
							</div>
						 </div>
						 
                         
                        <div class="clear"></div>
                        
					</div>
      
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