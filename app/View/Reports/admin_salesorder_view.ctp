<?php //pr($salesOrderResult);exit;?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Order details</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-primary btn-flat" onclick="location.href='<?php echo $base_url;?>admin/Reports/sales_order'">Manage Sales order</button>
               
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <td width="30%"><?php echo __('Order ID'); ?></td>
                <td><?php echo $salesOrderResult['SalesOrder']['orderid'];?></td>
            </tr>
            <tr>
                <td><?php echo __('Ordered By'); ?></td>
                <td><?php echo stripslashes($salesOrderResult['MasterUser']['first_name'].' '.$salesOrderResult['MasterUser']['last_name']);?></td>
            </tr>
             <tr>
                <td><?php echo __('Sales Name'); ?></td>
                <td><?php echo stripslashes($salesOrderResult['PostAd']['adv_name']);?></td>
            </tr>
            <tr>
                <td><?php echo __('Quantity'); ?></td>
                <td><?php echo $salesOrderResult['SalesOrder']['qty'];?></td>
            </tr>
            <tr>
                <td><?php echo __('Price'); ?></td>
                <td><?php echo $salesOrderResult['SalesOrder']['totprice'];?> RON</td>
            </tr>
            <tr>
                <td><?php echo __('Delivery Method'); ?></td>
                <td><?php echo $salesOrderResult['SalesOrder']['delivery_method'];?></td>
            </tr>
             <tr>
                <th><?php echo __('Billing Details'); ?></th>
               
            </tr>
            <tr>
                <td><?php echo __('Name'); ?></td>
                <td><?php echo $salesOrderResult['SalesOrder']['fname'].' '.$salesOrderResult['SalesOrder']['lname'];?></td>
            </tr>
            <tr>
                <td><?php echo __('Phone'); ?></td>
                <td><?php echo $salesOrderResult['SalesOrder']['phone'];?></td>
            </tr>
             <tr>
                <td><?php echo __('County'); ?></td>
                <td><?php echo $this->Custom->region_nm($salesOrderResult['SalesOrder']['county']);?></td>
            </tr>
             <tr>
                <td><?php echo __('City'); ?></td>
                <td><?php echo $this->Custom->location_nm($salesOrderResult['SalesOrder']['location']);?></td>
            </tr>
            <tr>
                <td><?php echo __('Post Code'); ?></td>
                <td><?php echo $salesOrderResult['SalesOrder']['postcode'];?></td>
            </tr>
            <tr>
                <td><?php echo __('Delivery Address'); ?></td>
                <td><?php echo $salesOrderResult['SalesOrder']['delivery_add'];?></td>
            </tr>
            <tr>
                <td><?php echo __('Notes Command'); ?></td>
                <td><?php echo $salesOrderResult['SalesOrder']['note_command'];?></td>
            </tr>
            <tr>
                <td><?php echo __('Delivery Status'); ?></td>
                <td><?php 
				$status=array(0 => 'Pending', 1 => 'Delivered');
				echo $status[$salesOrderResult['SalesOrder']['delivery_status']];
				?></td>
            </tr>
             <tr>
                <td><?php echo __('Ordered Date'); ?></td>
                <td><?php echo date('d-m-Y',strtotime($salesOrderResult['SalesOrder']['created'])); ?></td>
            </tr>
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->
