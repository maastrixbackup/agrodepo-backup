<div style='padding-left:100px;'>
<?php foreach($firmparts_details as $details){ //pr($details); ?>
	<div class='fl' style='float:left;clear:none;'>
		<img src="<?php echo $this->webroot.'img/firmparts_logo/'.$details['SalesFirmPart']['logo'];?>" style="width:120px;">
	</div>
	<div class='fl'  style='float:left;clear:none;'>
		<b><font size='5px'><?php echo $details['SalesFirmPart']['commercial_name']; ?></font></b><br>
		<b><?php echo str_replace('_SRL',' SRL',str_replace('SC_','SC ',$details['SalesFirmPart']['comp_name']));?></b><br>
	</div>
	<div style="clear:both"></div>
	<div align='left'>
		<b>About Us</b><br>
		<div style="width:500px"><?php echo $details['SalesFirmPart']['description'];?></div>
	</div>
<!--	<div align='left'>
		<div style="width:500px">
			<?php 
				$images = explode(',',$details['SalesFirmPart']['parts_pics']); //pr($images);
				foreach($images as $img){ //pr($img);
			?>
					<img src="<?php echo $this->webroot.'img/firmparts_img/'.$img;?>" style="width:120px;">
			<?php
				}
			?>
		</div>
	</div> -->
	<div align='left'>
		<b>Sell ​​car parts for:</b><br>
		<div style="width:500px">
			<?php 
				$brand_names = '';
				$brands = explode(',',$details['SalesFirmPart']['brand_id']);
				foreach($brands as $brand){
					$b_nm = $this->Custom->brand_nm($brand);
					$brand_names = $brand_names.",".$b_nm;
				} 
				$brand_names = ltrim($brand_names,','); 
				echo $brand_names;
			?>
		</div> 
	</div>
	<div align='left'>
		<b>Warranty, transport , delivery , return :</b><br>
		<div style="width:500px"><?php echo $details['SalesFirmPart']['warranty_detail'];?></div>
	</div>
	<div >
		<div style='float:left'><b>Rate this company:</b><br/>
		<span>Your rating: <a href='javascript:void(0)'>Remove</a>
		<?php 
		 for($i=0;$i<5;$i++){
					  echo "<a href='javascript:void(0)'><img src=$this->webroot/img/rate.png /></a>";
				  }
		?>
		<span>
		</div>
		<div style='float:right'>
		<b>Rating:</b>
		<?php 
		 for($i=0;$i<5;$i++){
					  echo "<img src=$this->webroot/img/rate.png />";
				  }
		?>&nbsp;&nbsp;0/5<br/><!--hard coaded -->
		Average Rating <b>0</b> out of 0 votes. <!--hard coaded -->
		</div>
		<div style='clear:both'></div>
	</div>
	
<?php } ?>
</div>

<div>
	<?php echo $this->Form->create('SalesFirmpartsComment'); ?>
	<b>Have a question for wheels and tires SRL?</b><br/>
	<div style='border:1px solid black;'>
	<b>Ask a question auto parts firm</b><br/>
Do not include personal information such as phone number, e-mail, etc.
		<textarea rows="3" "required" name="data[SalesFirmpartsComment][comment]" id="comment" style="width:560px"></textarea>
		
		<br>
		<?php echo $this->Form->button('Send',array('type'=>'submit','div'=>false)); ?>
		</div>
	<?php echo $this->Form->end();?>
	
	<?php foreach($comments as $com){ ?>
		<div>
			<?php echo "<b>User Name:</b>". $this->Custom->user_nm($com['SalesFirmpartsComment']['user_id']);?>
			<?php echo "&nbsp;<b>Comment:</b>". $com['SalesFirmpartsComment']['comment'];?>
		</div>
	<?php } ?>
	
</div>