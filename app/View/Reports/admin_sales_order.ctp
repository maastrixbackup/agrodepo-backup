<?php //pr($salesOrderRes);exit;?>
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Sales order</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                                <th width="5%"><?php echo $this->Paginator->sort('id','SL#'); ?></th>
                                                <th width="7%"><?php echo $this->Paginator->sort('user_id', 'Ordered By'); ?></th>
                                                <th width="7%"><?php echo $this->Paginator->sort('adv_id', 'Ordered To'); ?></th>
                                                <th width="5%"><?php echo $this->Paginator->sort('orderid', 'Order ID'); ?></th>
                                                <th width="10%"><?php echo $this->Paginator->sort('adv_name', 'Sales Name'); ?></th>
                                                <th width="5%"><?php echo $this->Paginator->sort('qty','Quantity'); ?></th>
                                                <th width="5%"><?php echo $this->Paginator->sort('totprice','Price'); ?></th>
                                                <?php /*?><th width="10%"><?php echo $this->Paginator->sort('delivery_method', 'Delivery Methods'); ?></th><?php */?>
                                               	<th width="5%"><?php echo $this->Paginator->sort('status', 'Status'); ?></th>
                                                <th width="5%"><?php echo $this->Paginator->sort('delivery_status', 'Delivery Status'); ?></th>
                                                <th width="10%"><?php echo $this->Paginator->sort('created','Ordered Date'); ?></th>
                                                <th class="actions" width="32%"><?php echo __('Actions'); ?></th>
                                        </tr>
                                        <?php
										//pr($requestParts);
										$pageno=$this->request->params['paging']['SalesOrder']['page'];
									$perpage=$this->request->params['paging']['SalesOrder']['limit'];
									if(!empty($salesOrderRes))
									{
										if($pageno!=1)
										{
											
											$rpcount=$perpage*$pageno;
											$rpcount=($rpcount-$perpage)+1;
										}
										else
										{
											$rpcount=1;	
										} 
										
										foreach ($salesOrderRes as $salesOrderResult): 
										$orderTo=$this->Custom->user_details($salesOrderResult['PostAd']['user_id']);
										?>
                                            <tr>
                                                <td><?php echo $rpcount; ?>&nbsp;</td>
                                               
                                                <td><?php echo stripslashes($salesOrderResult['MasterUser']['first_name'].' '.$salesOrderResult['MasterUser']['last_name']);?>&nbsp;</td>
                                                <td><?php echo stripslashes($orderTo['first_name'].' '.$orderTo['last_name']);?>&nbsp;</td>
                                                <td><?php echo $salesOrderResult['SalesOrder']['orderid'];?>&nbsp;</td>
                                                <td><?php echo $salesOrderResult['PostAd']['adv_name'];?>&nbsp;</td>
                                                <td><?php echo $salesOrderResult['SalesOrder']['qty'];?>&nbsp;</td>
                                                <td><?php echo $salesOrderResult['SalesOrder']['totprice'];?> RON&nbsp;</td>
                                                <?php /*?><td><?php echo $salesOrderResult['SalesOrder']['delivery_method'];?>&nbsp;</td><?php */?>
                                                <td><?php
                                                    $status=array(0=>"New Order",1=>"Confirmed Order",2=>"Completed Order",3=>"Shipped Order",4=>"Canceled Order");
                                                    echo $this->Form->input('status',array("options"=>$status,'label'=>false,'onchange'=>'Status(this.value,'.$salesOrderResult['SalesOrder']['id'].')','selected'=>$salesOrderResult['SalesOrder']['status']));
                                                 ?>&nbsp;</td>
                                                <td><?php
                                                    $deliveryStatus=array(0=>"Pending",1=>"Delivered");
                                                    echo $this->Form->input('delivery_status',array("options"=>$deliveryStatus,'label'=>false,'onchange'=>'deliveryStatus(this.value,'.$salesOrderResult['SalesOrder']['id'].')','selected'=>$salesOrderResult['SalesOrder']['delivery_status']));
                                                
                                                 ?>&nbsp;
                                                 </td>
                                                <td><?php echo date('d-m-Y',strtotime($salesOrderResult['SalesOrder']['created'])); ?>&nbsp;</td>
                                                <td class="actions" style="padding: 8px 0px 0px 0px;">
                                                    
                                                    <?php 
                                                    echo $this->Form->postLink(__('order detail'), array('action' => 'salesorder_view', $salesOrderResult['SalesOrder']['id']), null, null, $salesOrderResult['SalesOrder']['id']); 
                                                    ?> &nbsp;&nbsp;
                                                     <?php 
                                                    echo $this->Form->postLink(__('Sales Detail'), array('controller' => 'ManageSales','action' => 'view', $salesOrderResult['SalesOrder']['adv_id']), null, null, $salesOrderResult['SalesOrder']['adv_id']); 
                                                    ?> &nbsp;&nbsp;
                                                    <?php
                                                    echo $this->Form->postLink(__('Delete'), array('action' => 'order_delete', $salesOrderResult['SalesOrder']['id']), null, __('Are you sure you want to delete # %s?', $salesOrderResult['PostAd']['adv_name'])); ?>
                                                    
                                                </td>
                                            </tr>

                                        <?php 
										$rpcount++;
										endforeach;
									}?>
                                    </table>
                                   
                                </div><!-- /.box-body -->
                               
                            </div><!-- /.box -->
                             <div class="clearfix"></div>
                                 
									<div class="float_left">
                                    <?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	
                                    </div>
                                    
                                    <div class="paging">
								<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
								
								
                                </div>
                        </div>
                    </div>
                </section><!-- /.content -->
<script type='text/javascript'>
function deliveryStatus(statusval,orderid){
	$.ajax(
	{
		type: 'POST',
		url: '<?php echo $base_url; ?>admin/Reports/delivery_status',
		data: 'orderid='+orderid+'&statusval='+statusval,
		success: function(data) {
			if(data==1)
			{
				alert("Delivery Status Updated Successfully");
			}
			else
			{
				alert("Delivery Status Updating Failed");
			}
		}
	});
}
function Status(statusval,orderid){
	$.ajax(
	{
		type: 'POST',
		url: '<?php echo $base_url; ?>admin/Reports/status',
		data: 'orderid='+orderid+'&statusval='+statusval,
		success: function(data) {
			if(data==1)
			{
				alert("Status Updated Successfully");
			}
			else
			{
				alert("Status Updating Failed");
			}
		}
	});
}

</script>
