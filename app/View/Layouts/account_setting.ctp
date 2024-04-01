<?php
echo $this->element('header-home');
?>
	<div class="container">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content');?>
    </div>
<?php
echo $this->element('footer-home');
?>
