<?php //pr($bidOfferRes);exit;?>
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Bid Offers</h3>
                                 
                                   </div>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                                <th width="5%"><?php echo $this->Paginator->sort('bid_id','SL#'); ?></th>
                                                <th width="15%"><?php echo $this->Paginator->sort('user_id', 'Bid By'); ?></th>
                                                <th width="15%"><?php echo $this->Paginator->sort('piece', 'Piesa'); ?></th>
                                                <th width="5%"><?php echo $this->Paginator->sort('price','Price with vat'); ?></th>
                                               <!-- <th><?php //echo $this->Paginator->sort('um', 'U.M.'); ?></th>
                                                <th><?php //echo $this->Paginator->sort('offers','Offer'); ?></th>-->
                                                <!--<th><?php //echo $this->Paginator->sort('availbility', 'Availability'); ?></th>-->
                                                <th width="10%"><?php echo _('Delivery'); ?></th>
                                                <!--<th><?php //echo $this->Paginator->sort('time_required', 'Time required'); ?></th>-->
                                                <th width="10%"><?php echo $this->Paginator->sort('payment_method', 'Payment Methods'); ?></th>
                                                <th width="5%"><?php echo $this->Paginator->sort('status', 'Status'); ?></th>
                                                <th width="10%"><?php echo $this->Paginator->sort('created','Bid Date'); ?></th>
                                                <th class="actions"><?php echo __('Actions'); ?></th>
                                        </tr>
                                        <?php
										//pr($requestParts);
										$pageno=$this->request->params['paging']['BidOffer']['page'];
									$perpage=$this->request->params['paging']['BidOffer']['limit'];
									if(!empty($bidOfferRes))
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
										
										foreach ($bidOfferRes as $bidOfferResult): 
										
										?>
                                            <tr>
                                                <td><?php echo $rpcount; ?>&nbsp;</td>
                                                <!--<td><?php //$user_details= $this->Custom->user_details($requestPart['RequestPart']['user_id']);
                                                //echo $user_details['first_name'].' '.$user_details['last_name'];
                                                ?>
                                                </td>-->
                                                <td><?php echo stripslashes($bidOfferResult['MasterUser']['first_name'].' '.$bidOfferResult['MasterUser']['last_name']);?>&nbsp;</td>
                                                <td><?php echo $bidOfferResult['BidOffer']['piece'];?>&nbsp;</td>
                                                <td><?php echo $bidOfferResult['BidOffer']['price'].' '.$bidOfferResult['BidOffer']['currency'];?>&nbsp;</td>
                                               <!-- <td><?php //echo $bidOfferResult['BidOffer']['um'];?></td>
                                                <td><?php //echo $bidOfferResult['BidOffer']['offers'];?>&nbsp;</td>-->
                                                <!--<td><?php
												//$availbility=array(1=>"In stock",2=>"Custom made");
												// echo $availbility[$bidOfferResult['BidOffer']['availbility']];
												 ?>&nbsp;</td>-->
                                                <td><?php 
												$delivery=array();
												if($bidOfferResult['BidOffer']['personal_teaching']==1)
												{
													array_push($delivery, 'Personal Teaching');
												}
												if($bidOfferResult['BidOffer']['courier']==1 || $bidOfferResult['BidOffer']['free_courier']==1)
												{
													if($bidOfferResult['BidOffer']['free_courier']==1 &&  $bidOfferResult['BidOffer']['courier']==0)
													{
													array_push($delivery, 'Free delivery by courier');
													}
													if($bidOfferResult['BidOffer']['free_courier']==0 &&  $bidOfferResult['BidOffer']['courier']==1)
													{
														array_push($delivery, 'Courier('.$bidOfferResult['BidOffer']['courier_cost'].')');
													}
													
												}
												if($bidOfferResult['BidOffer']['roman_mail']==1 || $bidOfferResult['BidOffer']['free_roman_mail']==1)
												{
													if($bidOfferResult['BidOffer']['free_roman_mail']==1 &&  $bidOfferResult['BidOffer']['roman_mail']==0)
													{
													array_push($delivery, 'Free delivery by romanian mail');
													}
													if($bidOfferResult['BidOffer']['free_roman_mail']==0 &&  $bidOfferResult['BidOffer']['roman_mail']==1)
													{
														array_push($delivery, 'Romanian Mail('.$bidOfferResult['BidOffer']['roman_mail_cost'].')');
													}
													
												}
												if(!empty($delivery))
												{
													echo implode(", ",$delivery);
												}
												?>&nbsp;</td>
                                                <!--<td><?php //echo $bidOfferResult['BidOffer']['time_required'];?> Days&nbsp;</td>-->
                                                <td><?php echo $bidOfferResult['BidOffer']['payment_method'];?> Days&nbsp;</td>
                                                <td><?php
                                                
                                                    $status=array(0=>"Approved",1=>"Winning",2=>"Cancel");
                                                    echo $this->Form->input('status',array("options"=>$status,'label'=>false,'onchange'=>'bidStatus(this.value,'.$bidOfferResult['BidOffer']['bid_id'].')','selected'=>$bidOfferResult['BidOffer']['status']));
                                                
                                                 ?>&nbsp;
                                                 </td>
                                                <td><?php echo date('d-m-Y',strtotime($bidOfferResult['BidOffer']['created'])); ?>&nbsp;</td>
                                                <td class="actions">
                                                    
                                                    <?php 
                                                    echo $this->Form->postLink(__('View'), array('action' => 'bidoffer_view', $bidOfferResult['BidOffer']['bid_id']), null, null, $bidOfferResult['BidOffer']['bid_id']); 
                                                    ?> &nbsp;&nbsp;
                                                     <?php 
                                                    echo $this->Form->postLink(__('Parts Detail'), array('action' => 'bid_parts_view', $bidOfferResult['BidOffer']['bid_id']), null, null, $bidOfferResult['BidOffer']['bid_id']); 
                                                    ?> &nbsp;&nbsp;
                                                    <?php
                                                    echo $this->Form->postLink(__('Delete'), array('action' => 'bid_delete', $bidOfferResult['BidOffer']['bid_id']), null, __('Are you sure you want to delete # %s?', $bidOfferResult['BidOffer']['piece'])); ?>
                                                    
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
function bidStatus(statusval,bidid){
	$.ajax(
	{
		type: 'POST',
		url: '<?php echo $base_url; ?>admin/Reports/bid_status',
		data: 'bidid='+bidid+'&statusval='+statusval,
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
