<?php //pr($bidOfferResult);exit;?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Bid offer details</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-primary btn-flat" onclick="location.href='<?php echo $base_url;?>admin/Reports/bid_offer'">Manage Bid Offer</button>
               
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            
            <tr>
                <td><?php echo __('Bid By'); ?></td>
                <td><?php echo stripslashes($bidOfferResult['MasterUser']['first_name'].' '.$bidOfferResult['MasterUser']['last_name']);?></td>
            </tr>
            <tr>
                <td><?php echo __('Denumire piesa'); ?></td>
                <td><?php echo $bidOfferResult['BidOffer']['piece'];?></td>
            </tr>
             <tr>
                <td><?php echo __('Pret'); ?></td>
                <td><?php echo $bidOfferResult['BidOffer']['price'].' '.$bidOfferResult['BidOffer']['currency'];?></td>
            </tr>
            <tr>
                <td><?php echo __('Doriti piesa'); ?></td>
                <td><?php echo $bidOfferResult['BidOffer']['offers'];?></td>
                  
            </tr>
             <tr>
                <td><?php echo __('Garanție'); ?></td>
                <td><?php
				 echo $bidOfferResult['BidOffer']['warranty'];
				 ?></td>
                  
            </tr>
            <tr>
                <td><?php echo __('Valabilitate'); ?></td>
                <td><?php
				 echo $bidOfferResult['BidOffer']['validity'];
				 ?></td>
                  
            </tr>
             <tr>
                <td><?php echo __('Livrare'); ?></td>
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
					?></td>
                  
            </tr>
             <tr>
                <td><?php echo __('Plata'); ?></td>
                <td><?php echo $bidOfferResult['BidOffer']['payment_method'];?></td>
                  
            </tr>
            <tr>
                <td><?php echo __('Bid Date'); ?></td>
                <td><?php echo date('d-m-Y',strtotime($bidOfferResult['BidOffer']['created'])); ?></td>
            </tr>
            <tr>
            <td colspan="2">
            <ul class="nav nav-pills">
            <?php
			$imgRes=$this->Custom->bidImg($bidOfferResult['BidOffer']['bid_id']);
			if(!empty($imgRes))
			{
				foreach($imgRes as $imgpath)
				{
					?>
                    <li class="list-group-item"><img src="<?php echo $base_url.'files/bidimg/'.$imgpath;?>" style="width:100px; height:100px" alt="" /></li>
                    <?php
				}
			}
			?>
            </ul>
            </td>
            </tr>
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->
