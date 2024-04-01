<?php //pr($firm_parts);exit;
	foreach($firm_parts as $lst){ //pr($lst);exit;
?>		<div style='border:1px solid black;margin:5px;'>
		<div class='fl' style='float:left;clear:none;'>
			<a href="<?php echo $this->webroot.'MasterUsers/detail_firmparts/'.$lst['SalesFirmPart']['parts_id']?>">
				<img src="<?php echo $this->webroot.'img/firmparts_logo/'.$lst['SalesFirmPart']['logo'];?>" style="width:120px;">
			</a><br/>
			<span>
			<?php
			 for($i=0;$i<5;$i++){
					  echo "<img src=$this->webroot/img/rate.png />";
				  }
				?>
			<span>
		</div>
		<div class='fl'  style='float:left;clear:none;'>
				<a href="<?php echo $this->webroot.'MasterUsers/detail_firmparts/'.$lst['SalesFirmPart']['parts_id']?>"><?php echo $lst['SalesFirmPart']['commercial_name']; ?></a><br>
				<b><?php echo str_replace('_SRL',' SRL',str_replace('SC_','SC ',$lst['SalesFirmPart']['comp_name'])); 
				//echo $lst['SalesFirmPart']['comp_name'];
				?></b><br>
				<div style="width:500px;">
				<?php 
					$description = trim($lst['SalesFirmPart']['description']);
					$max_len = 180;
					if (strlen($description) > $max_len) { 
						$stringCut = substr($description, 0, $max_len);   
						$desc = $stringCut."...";
					}else{
						$desc = $description;
					}
					echo $desc;
				?>
				</div><br/><br/>
				Distance from you:<b>20.5km</b> <!-- hard coaded-->
				<div align='right'><a href="<?php echo $this->webroot.'MasterUsers/detail_firmparts/'.$lst['SalesFirmPart']['parts_id']?> ">more »</a></div>
		</div>
		<div style="clear:both"></div>
		</div>
<?php
	}
?>