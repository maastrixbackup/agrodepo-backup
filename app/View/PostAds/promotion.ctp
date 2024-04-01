<script type="text/javascript">
function promotionvalidate()
{
	if($(".promotion_type").is(":checked")==false)
	{
		$("#errmsg").html('Choose Promotion Type');
		return false;	
	}
	else
	{
		$("#errmsg").html('');
	}
	if($("#listtype").is(":checked")==true)
	{
		if($(".listPlan").is(":checked")==false)
		{
			$("#listmsg").html('Choose Promotion Plan');
			return false;	
		}
		else
		{
			$("#listmsg").html('');
		}
	}
	if($("#hometype").is(":checked")==true)
	{
		if($(".homePlan").is(":checked")==false)
		{
			$("#homemsg").html('Choose Promotion Plan');
			return false;	
		}
		else
		{
			$("#homemsg").html('');
		}
	}
}
$(document).ready(function(e) {
	
    $(".homePlan").click(function(e) {
		if($(".homePlan").is(":checked")==true)
		{
			$("#hometype").attr("checked","checked");
			$("#errmsg").html('');
		}
		$("#homeprice").val($(this).attr("title"));
       // alert($(this).val());
	   var listadprice=parseFloat($("#listprice").val());
		var homeadprice=parseFloat($("#homeprice").val());
		var total=homeadprice+listadprice;
		$("#totalprice").val(total);
		$(".totalprice").html("Total: "+homeadprice+" RON + "+listadprice+" RON ="+total+" RON");
    });
	 $(".listPlan").click(function(e) {
		 if($(".listPlan").is(":checked")==true)
		{
			$("#listtype").attr("checked","checked");
			$("#errmsg").html('');
		}
		$("#listprice").val($(this).attr("title"));
		var listadprice=parseFloat($("#listprice").val());
		var homeadprice=parseFloat($("#homeprice").val());
		var total=homeadprice+listadprice;
		$("#totalprice").val(total);
		$(".totalprice").html("Total: "+listadprice+" RON + "+homeadprice+" RON ="+total+" RON");
       // alert($(this).val());
    });
	$("#hometype").click(function(e) {
		if($(this).is(":checked")==false)
		{
			$( ".homePlan" ).each(function( index ) {
				$(this).removeAttr("checked");
			});
			$("#homemsg").html('');
			$("#homeprice").val(0);
			var listadprice=parseFloat($("#listprice").val());
		var homeadprice=parseFloat($("#homeprice").val());
		var total=homeadprice+listadprice;
		$("#totalprice").val(total);
		$(".totalprice").html("Total: "+listadprice+" RON + "+homeadprice+" RON ="+total+" RON");
		}
	});
	$("#listtype").click(function(e) {
		if($(this).is(":checked")==false)
		{
			$( ".listPlan" ).each(function( index ) {
			$(this).removeAttr("checked");
			});
			$("#listmsg").html('');
			$("#listprice").val(0);
			var listadprice=parseFloat($("#listprice").val());
			var homeadprice=parseFloat($("#homeprice").val());
			var total=homeadprice+listadprice;
			$("#totalprice").val(total);
			$(".totalprice").html("Total: "+listadprice+" RON + "+homeadprice+" RON ="+total+" RON");
		}
	});	
});
</script>
<?php
echo $this->Form->create('PostAd', array('onsubmit' => 'return promotionvalidate();', 'name' => 'promotionfrm'));
?>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 left_0">
                        <div>
                            <div class="box_promo1">
                                <div class="col-lg-12">
                                    <div class="row top_checkall">
                                        <input type="checkbox" id="listtype" name="promotiontype[]" value="2" class="regular-radio promotion_type">
                                        <label for="listtype"></label>
                                        <input type="hidden" name="payment_type" value="<?php if(isset($this->request->data['payment_type'])){echo 1;}else{echo 0;}?>" />
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="listcheck">
                                        <div class="checktitle">Afisre prioritara:&nbsp; &nbsp; <span id="listmsg" style="color:#F00; font-size:12px;"></span></div>
                                         <?php
									if(!empty($listplanRes))
									{
										$listcount=1;
										foreach($listplanRes as $listplanResult)
										{
											?>
                                        <label>
                                            <input type="radio" id="listplan<?php echo $listcount;?>" title="<?php echo $listplanResult['PromotionPlan']['promotion_price'];?>" name="promotelist" value="<?php echo $listplanResult['PromotionPlan']['promotion_id'];?>" class="regular-radio listPlan">
                                            <label for="listplan<?php echo $listcount;?>"></label>
                                            <p><?php echo $listplanResult['PromotionPlan']['promotion_days'];?> zile - <span><?php echo $listplanResult['PromotionPlan']['promotion_price'];?> RON</span></p>
                                        </label>
                                        <div class="clearfix"></div>
                                        
                                        <?php
									$listcount++;
									}
								}
								?>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                     
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 right_0">
<div>
	<div class="box_promo1">
		<div class="col-lg-12">
			<div class="row top_checkall">
				<input type="checkbox" id="hometype" name="promotiontype[]" value="1" class="regular-radio promotion_type">
				<label for="hometype"></label>
			</div>
		</div>
		
		<div class="col-lg-12">
			<div class="listcheck">
				<div class="checktitle">promovare in homepage:&nbsp; &nbsp; <span id="homemsg" style="color:#F00; font-size:12px;"></span></div>
                <?php
					if(!empty($homeplanRes))
					{
						$homecount=1;
						foreach($homeplanRes as $homeplanResult)
						{
							?>
						<label>
							<input type="radio" id="homeplan<?php echo $homecount;?>" title="<?php echo $homeplanResult['PromotionPlan']['promotion_price'];?>" name="promotehome" value="<?php echo $homeplanResult['PromotionPlan']['promotion_id'];?>" class="regular-radio homePlan">
							<label for="homeplan<?php echo $homecount;?>"></label>
							<p><?php echo $homeplanResult['PromotionPlan']['promotion_days'];?> zile - <span><?php echo $homeplanResult['PromotionPlan']['promotion_price'];?> RON</span></p>
						</label>
						<div class="clearfix"></div>
						<?php
						$homecount++;
						}
					}
					?>
			</div>
		</div>
	</div>
	<div class="totalprice">Total: 0 RON</div>
	<span id="errmsg" style="color:#F00"></span>&nbsp;&nbsp;<input type="submit" name="Submit2" value="Promoveaza" class="price_btn">
</div>
</div>
<input type="hidden" name="homeprice" id="homeprice" value="0" />
<input type="hidden" name="listprice" id="listprice" value="0" />
<input type="hidden" name="totalprice" id="totalprice" value="0" />
<input type="hidden" name="adv_id" id="adv_id" value="<?php echo $this->request->data['adv_id'];?>" />
</form>