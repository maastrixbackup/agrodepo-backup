<div class="box">
    <div class="box-header">
        <h3 class="box-title">Membership Plan Detail</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
               <td><?php echo __('Transaction ID'); ?></td>
		<td>
			
        <?php echo md5($payment['Payment']['transfer_id']); ?>
			&nbsp;
		</td>
         </tr>
            <tr>
               <td><?php echo __('User Name'); ?></td>
		<td>
			
         <?php $userdetails=$this->Custom->BapUserDetails($payment['Payment']['user_id']);
		if(!empty($userdetails)){echo $userdetails['MasterUser']['first_name'].' '.$userdetails['MasterUser']['last_name'];}
		 ?>
			&nbsp;
		</td>
         </tr>
            <tr>
              <td><?php echo __('Member Type'); ?></td>
		<td>
			<?php 
		$memdetails=$this->Custom->getMemberByID($payment['Payment']['member_type']);
		if(!empty($memdetails)){echo $memdetails['UserMembership']['memb_type'];}
		 ?>
			&nbsp;
		</td>  
            </tr>
           <tr><td><?php echo __('Payment Method'); ?></td>
		<td>
			<?php echo h($payment['Payment']['payment_method']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Name'); ?></td>
		<td>
			<?php echo h($payment['Payment']['name']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Email Address'); ?></td>
		<td>
			<?php echo h($payment['Payment']['email']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Phone'); ?></td>
		<td>
			<?php echo h($payment['Payment']['phone']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
        <td><?php echo __('Address '); ?></td>
		<td>
			<?php echo h($payment['Payment']['address']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('County'); ?></td>
		<td>
			<?php echo $this->Custom->region_nm($payment['Payment']['county']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
        <td><?php echo __('City'); ?></td>
		<td>
			<?php echo $this->Custom->location_nm($payment['Payment']['city']); ?>
			&nbsp;
		</td>
        </tr>
        
        <tr>
		<td><?php echo __('Zip'); ?></td>
		<td>
			<?php echo h($payment['Payment']['zip']); ?>
			&nbsp;
		</td>
		</tr>
        <?php if($payment['Payment']['shipping_different']==1){?>
        <tr>
		<td><?php echo __('Shipping Name'); ?></td>
		<td>
			<?php echo h($payment['Payment']['shipping_name']); ?>
			&nbsp;
		</td>
        </tr>
		<tr>
		<td><?php echo __('Shipping Email'); ?></td>
		<td>
			<?php echo h($payment['Payment']['shipping_email']); ?>
			&nbsp;
		</td>
        </tr>
		<tr>
		<td><?php echo __('Shipping Phone'); ?></td>
		<td>
			<?php echo h($payment['Payment']['shipping_phone']); ?>
			&nbsp;
		</td>
		</tr>
        <tr>
		<td><?php echo __('Shipping Address'); ?></td>
		<td>
			<?php echo h($payment['Payment']['shipping_address']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Shipping County'); ?></td>
		<td>
			<?php echo $this->Custom->region_nm($payment['Payment']['shipping_county']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Shipping City'); ?></td>
		<td>
			<?php echo $this->Custom->location_nm($payment['Payment']['shipping_city']); ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Shipping Zip'); ?></td>
		<td>
			<?php echo h($payment['Payment']['shipping_zip']); ?>
			&nbsp;
		</td>
        </tr>
        
        <?php }?>
         <tr>
               <td><?php echo __('Payment Status'); ?></td>
		<td>
			
        <?php
		$methodarr=array(0=>'Pending', 1=> 'Paid');
		 echo $methodarr[$payment['Payment']['payment_status']];
		  ?>
			&nbsp;
		</td>
         </tr>
          <tr>
               <td><?php echo __('Amount'); ?></td>
		<td>
			
        <?php
		 echo $payment['Payment']['price'];
		  ?>
			&nbsp;
		</td>
         </tr>
          <tr>
               <td><?php echo __('Credits'); ?></td>
		<td>
			
        <?php
		 echo $payment['Payment']['credit'];
		  ?>
			&nbsp;
		</td>
         </tr>
         <tr>
               <td><?php echo __('Status'); ?></td>
		<td>
			
       <?php
		$statusarr=array(0=>'Pending', 1=> 'Approved');
		 echo $statusarr[$payment['Payment']['plan_status']];
		  ?>
			&nbsp;
		</td>
         </tr>
          <tr>
               <td><?php echo __('Date'); ?></td>
		<td>
			
        <?php
		 echo date("d-m-Y", strtotime($payment['Payment']['created']));
		  ?>
			&nbsp;
		</td>
         </tr>
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->