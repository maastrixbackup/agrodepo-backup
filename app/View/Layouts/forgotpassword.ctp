<?php
echo $this->element('header-home');
?>
	<div class="container">
		<div class="row">					
			<div class="innerpanel">
			
				
				<!-- Right Sidebar Start -->
				<div class="col-md-12">
					<div class="clearfix" style="height:15px;"></div>
					<div class="col-lg-12 prof bs-example minheight2">					
						 <?php echo $this->Session->flash(); ?>
                                 <?php echo $this->fetch('content');?>
                    <div class="clear"></div>
			  </div>
		</div>
		<div class="clearfix"></div>
    </div>
    </div>
<?php
echo $this->element('footer-home');
?>