<div class="box">
    <div class="box-header">
        <h3 class="box-title">Manage Sale Detail</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            
            <tr>
               <td><?php echo __('User Name'); ?></td>
		<td>
			<?php 
			if($manageSale['ManageSale']['user_id']!=0){
			$user_details =$this->Custom->user_details($manageSale['ManageSale']['user_id']);
			echo $user_details['first_name'];
		}else{
			echo 'N/A';
		}
			//echo h($manageSale['ManageSale']['user_id']); ?>
			&nbsp;
		</td>
         </tr>
            <tr>
              <td><?php echo __('Category'); ?></td>
		<td>
			<?php echo $this->Custom->category_name($manageSale['ManageSale']['category_id']); ?>
			&nbsp;
		</td>  
            </tr>
           <tr><td><?php echo __('Sub Category'); ?></td>
		<td>
			<?php echo $this->Custom->category_name($manageSale['ManageSale']['sub_cat_id']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Advertisement Name'); ?></td>
		<td>
			<?php echo h($manageSale['ManageSale']['adv_name']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Advertisement Details'); ?></td>
		<td>
			<?php echo $manageSale['ManageSale']['adv_details']; ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Image'); ?></td>
		<td>
			<?php 
			$img_name=$this->Custom->AlladvImage($manageSale['ManageSale']['adv_id']);
		
		foreach($img_name AS $k=>$v){
			$img=$this->webroot."files/postad/$v";
			print "<img src='$img' style='witdh:100px;height:100px'> ";
		}
			//echo h($manageSale['ManageSale']['adv_img']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
        <td><?php echo __('Brand '); ?></td>
		<td>
			<?php echo $this->Custom->brand_nm($manageSale['ManageSale']['adv_brand_id']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Model'); ?></td>
		<td>
			<?php echo $this->Custom->brand_nm($manageSale['ManageSale']['adv_model_id']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
        <td><?php echo __('Product Condition'); ?></td>
		<td>
			<?php echo h($manageSale['ManageSale']['product_cond']); ?>
			&nbsp;
		</td>
        </tr>
        
        <tr>
		<td><?php echo __('Price'); ?></td>
		<td>
			<?php echo h($manageSale['ManageSale']['price']." ".$manageSale['ManageSale']['currency']); ?>
			&nbsp;
		</td>
		</tr>
        <tr>
		<td><?php echo __('Quantity'); ?></td>
		<td>
			<?php echo h($manageSale['ManageSale']['quantity']); ?>
			&nbsp;
		</td>
        </tr>
		<tr>
		<td><?php echo __('Payment Mode'); ?></td>
		<td>
			<?php echo h($manageSale['ManageSale']['payment_mode']); ?>
			&nbsp;
		</td>
        </tr>
		<tr>
		<td><?php echo __('Delivery Method'); ?></td>
		<td>
			<?php 
			$dm='';
		if($manageSale['ManageSale']['personal_teaching']){
			$dm.= 'Personal Teaching,';
		}	
		if($manageSale['ManageSale']['courier']){
			if($manageSale['ManageSale']['free_courier']==1){
			$dm.= 'Courier (Free),';
			}else{
				$dm.= "Courier (".$manageSale['ManageSale']['courier_cost']." RON),";
			}
		}	
		if($manageSale['ManageSale']['romanian_mail']){
			
			if($manageSale['ManageSale']['free_romanian_mail']==1){
			$dm.= 'Romanian Mail (Free)';
			}else{
				$dm.= "Romanian Mail (".$manageSale['ManageSale']['romanian_mail_cost']." RON)";
			}
		}
		echo trim($dm,',');
			 ?>
			&nbsp;
		</td>
		</tr>
        <tr>
		<td><?php echo __('Time Required'); ?></td>
		<td>
			<?php echo h($manageSale['ManageSale']['time_required'].' Day'); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Status'); ?></td>
		<td>
			<?php 
			$status=array('0'=>'Unpublish','1'=>'Publish');
			echo $status[$manageSale['ManageSale']['adv_status']]; ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Created'); ?></td>
		<td>
			<?php echo date('d/m/Y',strtotime($manageSale['ManageSale']['created'])); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Modified'); ?></td>
		<td>
			<?php echo date('d/m/Y',strtotime($manageSale['ManageSale']['modified'])); ?>
			&nbsp;
		</td>
        </tr>
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->



