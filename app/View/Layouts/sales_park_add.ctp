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
                    <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>"><span></span><?php echo HOME;?></a> </li>
                    <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php if($this->request->params['action']=='add'){?><?php echo FLEETOFTRUCK;?><?php }elseif($this->request->params['action']=='company_add'){?> <?php echo ADDCOMPANYPART;?><?php }else if($this->request->params['action']=='edit'){?> Editați Parcuri<?php }?></a></li>
              	</ul>
           	 </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	<?php if($this->request->params['action']=='add'){?><?php echo FLEETOFTRUCK;?><?php }elseif($this->request->params['action']=='company_add'){?><?php echo ADDCOMPANYPART;?> <?php }?>
            <!--<a href="choose_category.html" class="ctgbtn">create a account »</a>-->
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
            <div class="row">
            
             <div class="clearfix" style="height:10px;"></div>
                        
                        
                            
            
            
            	<div class="listtop34">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content');?>
                	
                    
                    <div class="clear40"></div>
                     
                    
                   
                    
                    
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