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
                <td width="30%"><?php echo __('Posted By'); ?></td>
                <td><?php
				$userdetails=$this->Custom->user_details($bidOfferResult['RequestPart']['user_id']); 
				echo stripslashes($userdetails['first_name'].' '.$userdetails['last_name']);
				?></td>
            </tr>
             <tr>
                <td><?php echo __('Brand'); ?></td>
                <td><?php
				$brandname=$this->Custom->brand_nm($bidOfferResult['RequestPart']['brand_id']); 
				echo stripslashes($brandname);
				?></td>
            </tr>
            <tr>
                <td><?php echo __('Model'); ?></td>
                <td><?php
				$modelname=$this->Custom->brand_nm($bidOfferResult['RequestPart']['model_id']); 
				echo stripslashes($modelname);
				?></td>
            </tr>
            <tr>
                <td><?php echo __('Version'); ?></td>
                <td><?php
				echo stripslashes($bidOfferResult['RequestPart']['version']); 
				?></td>
            </tr>
            <tr>
                <td><?php echo __('Year Of manufacture'); ?></td>
                <td><?php
				echo stripslashes($bidOfferResult['RequestPart']['yr_of_manufacture']); 
				?></td>
            </tr>
             <tr>
                <td><?php echo __('Engines'); ?></td>
                <td><?php
				echo stripslashes($bidOfferResult['RequestPart']['engines']); 
				?></td>
            </tr>
            <tr>
                <td><?php echo __('Vehicle Identification Number'); ?></td>
                <td><?php
				echo stripslashes($bidOfferResult['RequestPart']['vehicle_identy_no']); 
				?></td>
            </tr>
            <tr>
                <td><?php echo __('I offer parts'); ?></td>
                <td><?php
				if($bidOfferResult['RequestPart']['i_offer_parts']!='')
				{
					$offerarr=explode(',',$bidOfferResult['RequestPart']['i_offer_parts']);
					$offerarr=array_filter($offerarr);
				if(!empty($offerarr))
				{
					echo implode(",",$offerarr);
				}
				}
				?></td>
            </tr>
            <tr>
                <td><?php echo __('County'); ?></td>
                <td><?php
				$region_nm=$this->Custom->region_nm($bidOfferResult['RequestPart']['county']); 
				echo stripslashes($region_nm);
				?></td>
            </tr>
            <tr>
                <td><?php echo __('City'); ?></td>
                <td><?php
				$location_nm=$this->Custom->location_nm($bidOfferResult['RequestPart']['city']); 
				echo stripslashes($location_nm);
				?></td>
            </tr>
            <tr>
                <td><?php echo __('Name piece'); ?></td>
                <td><?php echo $bidOfferResult['RequestAccessory']['name_piece'];?></td>
            </tr>
             <tr>
                <td><?php echo __('Description'); ?></td>
                <td><?php echo $bidOfferResult['RequestAccessory']['description'];?></td>
            </tr>
             <tr>
                <td><?php echo __('Part No'); ?></td>
                <td><?php echo $bidOfferResult['RequestAccessory']['part_no'];?></td>
            </tr>
             <tr>
                <td><?php echo __('Maximum price'); ?></td>
                <td><?php echo $bidOfferResult['RequestAccessory']['max_price'].' '.$bidOfferResult['RequestAccessory']['currency'];?></td>
            </tr>
             <tr>
                <td><?php echo __('Status'); ?></td>
                <td><?php 
				$statusarr=array(0 => 'Inactive', 1 => 'Active', 2 => 'Resolved');
				echo $statusarr[$bidOfferResult['RequestAccessory']['offerno']];
				?></td>
            </tr>
            <tr>
                <td><?php echo __('Total offer'); ?></td>
                <td><?php echo $bidOfferResult['RequestAccessory']['offerno'];?></td>
            </tr>
            <tr>
                <td><?php echo __('Request Date'); ?></td>
                <td><?php echo date('d-m-Y',strtotime($bidOfferResult['RequestAccessory']['modified'])); ?></td>
            </tr>
             <td colspan="2">
            <ul class="nav nav-pills">
            <?php
			$imgRes=$this->Custom->partsImg($bidOfferResult['RequestAccessory']['part_id']);
			if(!empty($imgRes))
			{
				foreach($imgRes as $imgpath)
				{
					?>
                    <li class="list-group-item"><img src="<?php echo $base_url.'files/requestpart/'.$imgpath;?>" style="width:100px; height:100px" alt="" /></li>
                    <?php
				}
			}
			?>
            </ul>
            </td>
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->
