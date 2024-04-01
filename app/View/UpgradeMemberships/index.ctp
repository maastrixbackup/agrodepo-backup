<script type="text/javascript">
function submitMember(memid)
{
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>UpgradeMemberships/memType',
				data: 'memid='+memid,
				success: function(data) {
					//alert(data);
					if(data==1)
					{
						window.location="<?php echo $base_url; ?>UpgradeMemberships/card";
					}
					else
					{
						alert("Please try Again");
					}
					
				}
			});
}
</script>
<div class="row">
    <div class="listtop34">
        
        
        <div class="clear10"></div>
        <?php if(isset($userMembership) && !empty($userMembership)){
			$membershipcount=1;
			foreach($userMembership as $userMembershipRes)
			{
				$memRes=$userMembershipRes['UserMembership'];
				$memb_type=stripslashes($memRes['memb_type']);
				$memb_id=stripslashes($memRes['memb_id']);
				$price=stripslashes($memRes['price']);
				$credits=stripslashes($memRes['credits']);
				$plan_img=stripslashes($memRes['plan_img']);
				if($this->Session->check('membertype_id'))
				{
					$sessid=$this->Session->read('membertype_id');
				}
				else
				{
					$sessid='';
				}
			?>
        <div class="upgrade_box<?php if($sessid==$memb_id){?> active<?php }?>">
        <?php if($plan_img!=''){?>
            <a href="javascript:void(0);" onclick="submitMember(<?php echo $memb_id;?>);"> <img src="<?php echo $base_url;?>files/memberplanimg/<?php echo $plan_img;?>" alt="<?php echo $memb_type;?>"/></a>
             <?php }else{?>
             <a href="javascript:void(0);" onclick="submitMember(<?php echo $memb_id;?>);"> <img src="<?php echo $base_url;?>images/profileholder.png" alt="gold"/></a>
			 <?php }?>
             <h4><a href="javascript:void(0);" onclick="submitMember(<?php echo $memb_id;?>);"> <?php echo $memb_type;?></a></h4><br/>
             <div class="textr">
             <span><?php echo PRICE;?> :</span>  <?php echo $price;?> RON<br/>
             <span><?php echo CREDITS;?> :</span>  <?php echo $credits;?> </div>
        </div>
        <?php
		if($membershipcount%4==0){echo '<div class="clear10"></div>';}
		$membershipcount++;
		} }?> 
    </div>
</div>