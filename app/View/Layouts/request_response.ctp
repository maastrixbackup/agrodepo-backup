<?php
echo $this->element('header-home');
?>
<div class="container">
		<div class="row">
				 <?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content');?>
						
		</div>
		<div class="clearfix"></div>
    </div>
    <?php
echo $this->element('footer-home');
?>