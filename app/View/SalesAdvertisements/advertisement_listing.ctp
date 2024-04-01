<div id="search_section" style="float:left;padding-right:25%;">
<?php echo $this->Form->create('SalesAdvertisement', array('enctype' => 'multipart/form-data')); ?>
	<h2>Car Parts</h2>
	<h3>Product Condition</h3>
	<?php 
		echo $this->Form->input('new', array('type'=>'checkbox','id'=>'new','div'=>false,'label'=>false,'value'=>'new','onclick'=>'show_res()')).'New<br>';
		echo $this->Form->input('old', array('type'=>'checkbox','id'=>'old','div'=>false,'label'=>false,'value'=>'old','onclick'=>'show_res()')).'Old<br>';
	?>
	<div></div>
	<h3>Categories</h3>
	<?php
	
		foreach($cat_arr as $k1=>$v1){
			$cat_nm = $this->Custom->category_name($k1);
			if(!empty($cat_chk) ){
				foreach($cat_chk as $k=>$v){
				if($k1==$v){
					echo $this->Form->input($cat_nm, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][category]['.$k1.']','div'=>false,'label'=>false,'value'=>$k1,'checked'=>'checked','onclick'=>'show_res()')).$cat_nm.'('.$v1.')'.'<br><br>';
				}else{
					echo $this->Form->input($cat_nm, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][category]['.$k1.']','div'=>false,'label'=>false,'value'=>$k1,'onclick'=>'show_res()')).$cat_nm.'('.$v1.')'.'<br><br>';
				}
			}
			}else{	
			echo $this->Form->input($cat_nm, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][category]['.$k1.']','div'=>false,'label'=>false,'value'=>$k1,'onclick'=>'show_res()')).$cat_nm.'('.$v1.')'.'<br><br>';
			}
			if($cat_id==$k1){
			foreach($sub_cat_arr as $k2=>$v2){
				if(!empty($sub_cat_chk)){
			     foreach($sub_cat_chk as $k=>$v){
				if($k2==$v){
					echo $this->Form->input($v2, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][sub_category]['.$k2.']','div'=>false,'label'=>false,'value'=>$k2,'checked'=>'checked','onclick'=>'show_res()')).$v2.'<br/><br/>';
				}else{
					echo $this->Form->input($v2, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][sub_category]['.$k2.']','div'=>false,'label'=>false,'value'=>$k2,'onclick'=>'show_res()')).$v2.'<br/><br/>';
				}
			}
			}else{	
			echo $this->Form->input($v2, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][sub_category]['.$k2.']','div'=>false,'label'=>false,'value'=>$k2,'onclick'=>'show_res()')).$v2.'<br/><br/>';
			}
			
		} 
			}
		}
	?>
	<div></div>
	<h3>Brand / Model</h3> 
	<?php
		foreach($brand_arr as $k1=>$v1){
			$brand_nm = $this->Custom->brand_nm($k1);
			if(!empty($brand_chk) ){
				foreach($brand_chk as $k=>$v){
				if($k1==$v){
					echo $this->Form->input($brand_nm, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][brand]['.$k1.']','div'=>false,'label'=>false,'value'=>$k1,'checked'=>'checked','onclick'=>'show_res()')).$brand_nm.'('.$v1.')'.'<br><br>';
				}else{
					echo $this->Form->input($brand_nm, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][brand]['.$k1.']','div'=>false,'label'=>false,'value'=>$k1,'onclick'=>'show_res()')).$brand_nm.'('.$v1.')'.'<br><br>';
				}
			}
			}else{	
			echo $this->Form->input($brand_nm, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][brand]['.$k1.']','div'=>false,'label'=>false,'value'=>$k1,'onclick'=>'show_res()')).$brand_nm.'('.$v1.')'.'<br><br>';
			}
			
			if($brand_id==$k1){
			foreach($sub_brand_arr as $k2=>$v2){
			if(!empty($sub_brand_chk)){
			foreach($sub_brand_chk as $k=>$v){
				if($k2==$v){
					echo $this->Form->input($v2, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][sub_brand]['.$k2.']','div'=>false,'label'=>false,'value'=>$k2,'checked'=>'checked','onclick'=>'show_res()')).$v2.'<br/><br/>';
				}else{
					echo $this->Form->input($v2, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][sub_brand]['.$k2.']','div'=>false,'label'=>false,'value'=>$k2,'onclick'=>'show_res()')).$v2.'<br/><br/>';
				}
			}
			}else{	
			echo $this->Form->input($v2, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][sub_brand]['.$k2.']','div'=>false,'label'=>false,'value'=>$k2,'onclick'=>'show_res()')).$v2.'<br/><br/>';
			}
				
			//echo $k2."---".$v2."<br/>";
			//echo $this->Form->input($v2, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][sub_brand]['.$k2.']','div'=>false,'label'=>false,'value'=>$k2,'onclick'=>'show_res()')).$v2.'<br/><br/>';
		} 
			}
			
			
		}
	?>
	<div></div>
	<h3>Country</h3> 
	<?php
		foreach($country as $k1=>$v1){
			//echo $k1."---".$v1."<br/>";
			echo $this->Form->input($v1, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][country]['.$k1.']','div'=>false,'label'=>false,'value'=>$k1,'onclick'=>'show_res()')).$v1.'<br/><br/>';
		} 
	?>
	<div></div>
	<h3>Locality</h3> 
	<?php
		foreach($locality as $k1=>$v1){
			//echo $k1."---".$v1."<br/>";
			echo $this->Form->input($k1, array('type'=>'checkbox','name'=>'data[SalesAdvertisement][Locality]['.$k1.']','div'=>false,'label'=>false,'value'=>$k1,'onclick'=>'show_res()')).$v1.'<br/><br/>';
		}
		
	?>
	<div></div>
	<!--h3>Country</h3>
	<h3>Locality</h3-->
<?php //echo $this->Form->button('Search',array('type'=>'submit','div'=>false)); ?>
<?php echo $this->Form->end(); ?>
</div>

<div id="result_list_section" style="float:left;">
	<h3>Last call for tenders resolved</h3>
	<table>
		<?php foreach($all_adv as $req_lst){ ?>
				<tr>
					<td>
						Advertisement Name:- <a title='Show details' href='<?php echo $this->webroot.'SalesAdvertisements/show_details/'.$req_lst['sa']['adv_id']?>'><?php echo $req_lst['sa']['adv_name']; ?></a><br>
						Description:- <?php echo trim($req_lst['sa']['adv_details']); ?><br>
						Brand:- <?php echo $this->Custom->brand_nm($req_lst['sa']['adv_brand_id']);  ?><br>
						Model:- <?php echo $this->Custom->location_nm($req_lst['sa']['adv_model_id']); ?><br>
						<?php //echo "Region and City:- ".$this->Custom->region_nm($req_lst['SalesAddPart']['country_id'])."(".$this->Custom->location_nm($req_lst['SalesAddPart']['location_id']).')'; ?><br>
						Condition:- <?php echo $req_lst['sa']['product_cond']; ?><br>
						Requested date:- <?php echo $req_lst['sa']['created']; ?><br>
						Category:- <?php echo $this->Custom->category_name($req_lst['sa']['category_id']); ?><br>
					</td>
				</tr>
		<?php } ?>
		<?php /*?>
		<tr>
			<td colspan=2>
				<p>
					<?php
					echo $this->Paginator->counter(array(
					'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
					));
					?>	
				</p>
					<div class="paging">
					<?php
						echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
						echo $this->Paginator->numbers(array('separator' => ''));
						echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
					?>
					</div>
			</td>
		</tr>
		<?php */?>
	</table>
</div>



<script type='text/javascript'>
	function show_res(){ //alert(333);
		document.getElementById("SalesAdvertisementAdvertisementListingForm").submit();
	}
</script>



