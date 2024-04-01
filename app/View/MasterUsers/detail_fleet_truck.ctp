<div style='padding-left:100px;'>
<?php foreach($details_of_trucks as $details){ //pr($details); ?>
	<div class='fl' style='float:left;clear:none;'>
		<img src="<?php echo $this->webroot.'img/park_logo/'.$details['SalesFleetTruck']['logo'];?>" style="width:120px;">
	</div>
	<div class='fl'  style='float:left;clear:none;'>
		<b><font size='5px'><?php echo $details['SalesFleetTruck']['park_name']; ?></font></b><br>
		<b><?php echo str_replace('_SRL',' SRL',str_replace('SC_','SC ',$details['SalesFleetTruck']['comp_name']));?></b><br>
	</div>
	<div style="clear:both"></div>
	<div align='left'>
		<b>About Us:</b><br>
		<div style="width:500px"><?php echo $details['SalesFleetTruck']['description'];?></div><br/><br/>
<div align='left'>
		<div style="width:500px">
			<?php 
				$images = explode(',',$details['SalesFleetTruck']['fleet_pics']); //pr($images);
				foreach($images as $img){ //pr($img);
			?>
					<img src="<?php echo $this->webroot.'img/truck_img/'.$img;?>" style="width:120px;">
			<?php
				}
			?>
		</div>
	</div> 
	<div align='left'>
		<b>Vehicle Brands dismantled:</b><br>
		<div style="width:500px">
			<?php 
				$brand_names = '';
				$brands = explode(',',$details['SalesFleetTruck']['brand_id']);
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
		<b>Warranty, transport, delivery, return:</b><br>
		<div style="width:500px"><?php echo str_replace('-','<br/>- ',$details['SalesFleetTruck']['warranty_detail']);?></div>
	</div>
	<div >
		<div style='float:left'><b>Rate park:</b><br/>
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
	<?php echo $this->Form->create('MasterUser'); ?>
	<b>Have a question for <?php echo $details['SalesFleetTruck']['park_name'];?>?</b><br/>
	<div style='border:1px solid black;'>
	<b>Ask a question truck fleet</b><br/>
Do not include personal information such as phone number, e-mail, etc.
		<textarea rows="3" "required" name="data[MasterUser][comment]" id="comment" style="width:560px"></textarea><br>
		<?php echo $this->Form->button('Send',array('type'=>'submit','div'=>false)); ?>
	<?php echo $this->Form->end();?>
	
	
	
</div>
    <?php foreach($comments as $com){ ?>
		<div style='border:1px solid black;margin:5px;'>
			<div style='float:left;width:20%;text-align:center; min-height:150Px;background:sky;'>
			<a href='javascript:void(0)'>
			<?php echo $this->Custom->user_nm($com['SalesFleetComment']['user_id']);?>
			</a><br/>
			<img src="<?php echo $this->webroot.'img/person.png'?>"/><br/>
			<?php 
			$user=$this->Custom->user_details($com['SalesFleetComment']['user_id']);
			echo $this->Custom->user_type($user['user_type_id'])."<br/>";
			echo $this->Custom->region_nm($user['country_id']).", ".$this->Custom->location_nm($user['locality_id']);
			
			?>
			</div>
			<div style='float:left;width:65%; min-height:100Px;'>
			<p><?php echo  $com['SalesFleetComment']['comment'];?></p>
			<br/>
			Date: <?php echo date('F j,Y, h:i',strtotime($com['SalesFleetComment']['created']));?>
			
			</div>
			<div style='clear:both'></div>
		</div>
	<?php } ?>