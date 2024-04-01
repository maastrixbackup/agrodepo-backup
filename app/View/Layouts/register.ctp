<?php
echo $this->element('header-home');
?>
<div class="container">
		<div class="row">					
			<div class="innerpanel">
			
				
				<!-- Right Sidebar Start -->
				<div class="col-md-12">
					<div class="clearfix" style="height:15px;"></div>
					<div class="col-lg-12 prof bs-example">					
								
								<div class="clearfix"></div>
								                                                                  <div id="errmsg" style="padding-left:50px;">&nbsp;</div>
                                 <div class="clearfix" style="height:10px;"></div>
					             						
                        
                        <div class="clearfix" style="height:0px;"></div>
                        
                        <?php echo $this->Session->flash(); ?>
                         <?php echo $this->fetch('content');?>
                        
                        <div class="clearfix" style="height:15px;"></div>	
							</div>
                    <div class="clear"></div>
			  </div>
		</div>
		<div class="clearfix"></div>
    </div>
    </div>
<?php
echo $this->element('footer-home');
?>