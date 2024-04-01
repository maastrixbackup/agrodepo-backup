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
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"> <?php if($this->request->params['action']=='index'){?>
          camioane Parcuri <?php }else
          {
              ?>
               Firme piese
              <?php
          }?></a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        <?php if($this->request->params['action']=='index'){?>
          camioane Parcuri
			<a href="<?php echo $base_url;?>SalesParks/add" class="ctgbtn">Parcuri dezmembrări</a>
          <?php }else
          {
              ?>
               Firme piese
               <a href="<?php echo $base_url;?>SalesParks/company_add" class="ctgbtn">Firme piese</a>
              <?php
          }?>
			
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
            <div class="row">
            	<div class="listtop34  not_fix">
                	<div class="normaalborder">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php if($this->request->params['action']=='index'){?>
						  <li class="active"><a href="javascript:void(0);" >camioane Parcuri</a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>SalesParks" >camioane Parcuri</a></li>
                              <?php
						  }?>
                          <?php if($this->request->params['action']=='companypieces'){?>
						  <li class="active"><a href="javascript:void(0);" >Firme piese</a></li>
                          <?php }else
						  {
							  ?>
                               <li><a href="<?php echo $base_url;?>SalesParks/companypieces" >Firme piese</a></li>
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