<div class="box">
    <div class="box-header">
        <h3 class="box-title">Manage Promotion Detail</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-primary btn-flat" onclick="location.href='<?php echo $base_url;?>admin/ManageSales'">Manage Sales</button>   
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            
            <tr>
               <td><?php echo __('User Name'); ?></td>
		<td>
			<?php 
			if($promotionDetail['PromotionAd']['user_id']!=0){
			$user_details =$this->Custom->user_details($promotionDetail['PromotionAd']['user_id']);
			echo $user_details['first_name'].' '.$user_details['last_name'];
		}else{
			echo 'N/A';
		}
			//echo h($manageSale['ManageSale']['user_id']); ?>
			&nbsp;
		</td>
         </tr>
            <tr>
              <td><?php echo __('Promotion Type'); ?></td>
		<td>
			<?php
			$promotion_type=$promotionDetail['PromotionAd']['promotion_type'];
			if($promotion_type!='')
			{
				$typarr=array();
				$promotxt="Promotion Assign to ";
				$promotiontypearr=explode(",", $promotion_type);
				//print_r($promotiontypearr);
				if(!empty($promotiontypearr))
				{
	
					foreach($promotiontypearr as $singpromotion)
					{
						if($singpromotion==1)
						{
							array_push($typarr,'Home');
						}
						else
						{
							array_push($typarr,'List');
						}
					}
				}
				if(!empty($typarr))
				{
				$promotxt.=implode(" and ", $typarr);
				echo $promotxt;	
				}
			}
			?>
			&nbsp;
		</td>  
            </tr>
            <?php if($promotionDetail['PromotionAd']['promotion_home']>0){?>
           <tr><td><?php echo __('Promotion Home Days'); ?></td>
		<td>
			<?php $planDetail=$this->Custom->BapCustUniPromotion($promotionDetail['PromotionAd']['promotion_home']);
			echo $planDetail['PromotionPlan']['promotion_days'].' Days';
			 ?>
			&nbsp;
		</td>
        </tr>
          <tr><td><?php echo __('Promotion Home Price'); ?></td>
		<td>
			<?php
			echo $planDetail['PromotionPlan']['promotion_price'].' RON';
			 ?>
			&nbsp;
		</td>
        </tr>
         <tr><td><?php echo __('Home Expire Date'); ?></td>
		<td>
			
             <?php
			echo date("d-m-Y", strtotime($promotionDetail['PromotionAd']['is_home_expire']));
			 ?>
			&nbsp;
		</td>
        </tr>
        <?php }?>
          <?php if($promotionDetail['PromotionAd']['promotion_list']>0){?>
           <tr><td><?php echo __('Promotion List Days'); ?></td>
		<td>
			<?php $planDetail=$this->Custom->BapCustUniPromotion($promotionDetail['PromotionAd']['promotion_list']);
			echo $planDetail['PromotionPlan']['promotion_days'].' Days';
			 ?>
			&nbsp;
		</td>
        </tr>
          <tr><td><?php echo __('Promotion List Price'); ?></td>
		<td>
			<?php
			echo $planDetail['PromotionPlan']['promotion_price'].' RON';
			 ?>
			&nbsp;
		</td>
        </tr>
         <tr><td><?php echo __('List Expire Date'); ?></td>
		<td>
			
             <?php
			echo date("d-m-Y", strtotime($promotionDetail['PromotionAd']['is_list_expire']));
			 ?>
			&nbsp;
		</td>
        </tr>
        <?php }?>
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->