<script type="text/javascript">
function cardSubmit(submitval, submittype)
{
	$.ajax(
	{
		type: 'POST',
		url: '<?php echo $base_url; ?>PostAds/cardsubmit',
		data: 'submitval='+submitval+'&submittype='+submittype,
		success: function(data) {
			//alert(data);
			if(data==1)
			{
				switch(submittype){
					case 'card' :
					window.location="<?php echo $base_url; ?>PostAds/paymentpromotion/<?php echo $this->Session->read('promotion_adv_id');?>";
					break;
					case 'banktransfer' :
					window.location="<?php echo $base_url; ?>PostAds/bankpromotion/<?php echo $this->Session->read('promotion_adv_id');?>";
					break;
					case 'sms' :
					window.location="<?php echo $base_url; ?>PostAds/smspromotion/<?php echo $this->Session->read('promotion_adv_id');?>";
					break;
				}
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
                    
                    
                    <div class="credi_box">
                        <a href="javascript:void(0);" onclick="cardSubmit('yes', 'card');"> <img src="<?php echo $base_url;?>images/card.png" alt=""/></a>
                         
                       <div class="cr_right">  <h4 class="nblue"><a href="javascript:void(0);" onclick="cardSubmit('yes', 'card');"><?php echo CREDITCARD;?></a></h4>
                       <div class="clearfix"></div>
                         <div class="textr">
                      <?php echo POWERBYCREDITCARD;?>
                         </div></div>
                   
                    
                    <div class="clearfix" style="height:10px;"></div>
                    
                    
                    
                </div>
                	<div class="clear10"></div>
                    <div class="credi_box">
                        <a href="javascript:void(0);" onclick="cardSubmit('yes', 'banktransfer');"> <img src="<?php echo $base_url;?>images/bank-transfer.png" alt=""/></a>
                         
                       <div class="cr_right">  <h4 class="nblue"><a href="javascript:void(0);" onclick="cardSubmit('yes', 'banktransfer');">Bank Transfer</a></h4>
                       <div class="clearfix"></div>
                         <div class="textr">
                      Payment By Banktransfer
                         </div></div>
                   
                    
                    <div class="clearfix" style="height:10px;"></div>
                    
                    
                    
                </div>
                	<div class="clear10"></div>
                    <div class="credi_box">
                        <a href="javascript:void(0);" onclick="cardSubmit('yes', 'sms');"> <img src="<?php echo $base_url;?>images/sms-card.png" alt=""/></a>
                         
                       <div class="cr_right">  <h4 class="nblue"><a href="javascript:void(0);" onclick="cardSubmit('yes', 'sms');">SMS</a></h4>
                       <div class="clearfix"></div>
                         <div class="textr">
                      Payment By SMS
                         </div></div>
                   
                    
                    <div class="clearfix" style="height:10px;"></div>
                    
                    
                    
                </div>
                    
                    
                    
            </div>
                
          </div>