<?php
echo $this->element('header-home');
?>
<div class="container">
		<div class="row">
					
			<div class="innerpanel">
				<!-- Left Sidebar Start -->
                <?php
                if($this->request->params['action']=='index'){
	                 echo $this->element('search-left');
	             }else if($this->request->params['action']=='category'){
	                 echo $this->element('category-left');
	             }else if($this->request->params['action']=='brand'){
	                 echo $this->element('brand-left');
	             }
                 ?>
					
				<!-- Left Sidebar End -->
				
				
				<!-- Right Sidebar Start -->
				<div class="col-md-9">
					<div class="clearfix" style="height:15px;"></div>
					
                        <div id="breadcrumb">
                            <ul class="crumbs">
                                <li class="first">
                                	<a style="z-index:9;" href="#"><span></span><?php echo CARPARTS;?></a>
                                </li>
                               <!-- <li><a style="z-index:8;" href="#">Engine Parts</a></li>
                                <li class="last"><a style="z-index:7;" href="javascript:void(0);">Oil Catch Tank </a></li>  --> 
                            </ul>
                        </div>
                        
                    <div class="clear"></div>
                    
					<?php echo $this->fetch('content');?>
					
			  </div>
				<!-- Right Sidebar end -->
				
				<div class="clearfix" style="height:1px;"></div>
                
                
                 
                
                          
			   
			</div>
		</div>
		<div class="clearfix"></div>
    </div>
<?php
echo $this->element('footer-home');
?>