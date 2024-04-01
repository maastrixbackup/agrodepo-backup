<?php
echo $this->element('header-home');
//pr($this->request->data);exit;
?>
<script type="text/javascript">
function ratingvalidate()
{
	if($(".grade").is(":checked")==false)
	{
		$("#errmsg").html("Choose a grade");
		$("#grade").focus();
		return false;
	}
	else
	{
		$("#errmsg").html("");
	}
}
</script>
 <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span>Dashboard</a> </li>
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>pages/rating-given-buyer"><span></span> Rating For Buyer</a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);">To Rate</a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <?php echo $this->Session->flash(); ?>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	To Rate
            <!--<a href="choose_category.html" class="ctgbtn">Sell ​​a song »</a>-->
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
            <div class="row">
            <form action="" method="post" name="ratingform" id="ratingform" onsubmit="return ratingvalidate();">
            	<div class="listtop34">
                	
                    
                     <?php $advdetails=$this->Custom->BapCustUniAdvDetail($orderdetail['SalesOrder']['adv_id']);?>
                    <?php 
					if(isset($advdetails['PostAd']['user_id']))
					{
						$userdetails=$this->Custom->user_details($advdetails['PostAd']['user_id']);
						$username=$userdetails['first_name'].' '.$userdetails['last_name'];
						$membership=$this->Custom->BapCustUniMembership($advdetails['PostAd']['user_id']);
						if($userdetails['profile_img']!='')
						{
							$userimg=$base_url.'files/profileimg/'.$userdetails['profile_img'];
						}
						else
						{
							$userimg=$base_url.'images/profileholder.png';
						}
						if(!empty($membership))
						{
							$memplan=$membership['UserMembership']['memb_type'];
						}
						else
						{
							$memplan='';
						}
					}
					else
					{
						$userimg=$base_url.'images/profileholder.png';
						$memplan='';
						$username='';
					}
					?>
                    <div class="clear10"></div>
                    <h5>Qualification for transaction <strong># <?php echo $orderdetail['SalesOrder']['orderid'];?></strong> made ​​on <strong><?php echo date("F d, Y, H:i",strtotime($orderdetail['SalesOrder']['created']));?></strong></h5>
                    
                    <div class="user_header">
                                  
                                  <div class="user_data_left">
                                       <img src="<?php echo $userimg;?>" style="float:left;margin-right:10px;" width="80" height="80"/>
                                     <a href="<?php echo $base_url.'pages/sales-details/'.stripslashes(@$advdetails['PostAd']['slug']);?>"> <?php echo stripslashes(@$advdetails['PostAd']['adv_name']);?> </a><br>
                                      
                                    <?php echo $memplan;?> Vendor: <strong><a href="<?php echo $base_url;?>pages/user-profiles/<?php echo $userdetail['MasterUser']['user_id'];?>"><?php echo $username;?></a></strong> <br>
                                    <img src="<?php echo $base_url;?>images/star_seller.png" alt="rating"/><?php echo $this->Custom->userProfileResult($userdetail['MasterUser']['user_id']);?>% OK

                                  </div>
                                  <span class="separator" style="float:right;">
                                  </span>
                                  <div class="clearing">
                                  </div>
                                </div>
                <div class="clear15"></div>
                    
                <strong>The grade you give you: <span id="errmsg" style="color:#F00;"></span></strong> 
                <div class="clear10"></div> 
                
                <div class="col-lg-2 col-sm-2 col-xs-4 rates">
                <div class="row">
                <?php if(isset($this->request->data['UserRating']['rating_id'])){?>
                <input type="hidden" name="data[UserRating][rating_id]" id="rating_id" value="<?php echo $this->request->data['UserRating']['rating_id'];?>" />
                <?php }?>
                <input type="radio" name="data[UserRating][grade]" id="grade" class="grade" value="1" <?php if(isset($this->request->data['UserRating']['grade']) && $this->request->data['UserRating']['grade']==1){?> checked="checked"<?php }?>> &nbsp;Positive <br>
                    <span class="fdbk_sign positive"></span>
                  
                </div>
                </div> 
                
                <div class="col-lg-2 col-sm-2 col-xs-4 rates">
                <div class="row">
                <input type="radio" name="data[UserRating][grade]" id="grade" class="grade" value="0"<?php if(isset($this->request->data['UserRating']['grade']) && $this->request->data['UserRating']['grade']==0){?> checked="checked"<?php }?>> &nbsp;Neutral <br>
                    <span class="fdbk_sign neutral"></span>
                  
                </div>
                </div>
                
                <div class="col-lg-2 col-sm-2 col-xs-4 rates">
                <div class="row">
                <input type="radio" name="data[UserRating][grade]" id="grade" class="grade" value="-1" <?php if(isset($this->request->data['UserRating']['grade']) && $this->request->data['UserRating']['grade']==-1){?> checked="checked"<?php }?>> &nbsp;Negative <br>
                    <span class="fdbk_sign negative"></span>
                  
                </div>
                </div> 
                
                 <div class="clear15"></div>
                 
                 <p class="sif_desc">* In case of unfinished transaction, please grant a neutral rating.</p> 
                 <p>How did you find this platinum seller? Please describe it in a few words:</p>
                  <div class="col-lg-6 col-sm-6 col-xs-12 ">
                    <div class="row"><textarea name="data[UserRating][how_to_know]" id="how_to_know" class="form-control"><?php if(isset($this->request->data['UserRating']['grade'])){echo $this->request->data['UserRating']['how_to_know'];}?></textarea></div>
                 </div>
                 
                 <div class="clear15"></div>
                 <p class="sif_desc">Gives seller notes according to 4 criteria:</p>
                 <div class="clear10"></div>
                 <div class="col-lg-2 col-sm-2 col-xs-12 ">
                       <div class="row">
                           Product as described
                       </div>
                 </div>
                 <div class="col-lg-3 col-sm-6 col-xs-12 ">
                       <div class="row ratinguser">
                           <?php
						  if(isset($this->request->data['UserRating']['productdescribedval']))
						  {
							$rateval=$this->request->data['UserRating']['productdescribedval'];
							$communicationval=$this->request->data['UserRating']['communicationval'];
							$deliverytimeval=$this->request->data['UserRating']['deliverytimeval'];
							$cost_of_transportval=$this->request->data['UserRating']['cost_of_transportval'];
						  }
						  else
						  {
							  $rateval=0;
							$communicationval=0;
							$deliverytimeval=0;
							$cost_of_transportval=0;
						  }
							?>
                            <input type="hidden" id="productdescribedval" value="<?php echo $rateval;?>" name="data[UserRating][productdescribedval]">
                <input id="productdescribed" value="<?php echo $rateval;?>" type="number" min=0 max=5 step=0.5 >
                       </div>
                 </div>
                 
                 <div class="clear10"></div>
                 <div class="col-lg-2 col-sm-2 col-xs-12 ">
                       <div class="row">
                           Communication with seller
                       </div>
                 </div>
                 <div class="col-lg-3 col-sm-6 col-xs-12 ">
                       <div class="row ratinguser">
                       		<input type="hidden" id="communicationval" value="<?php echo $communicationval;?>" name="data[UserRating][communicationval]">
                           <input id="communication" value="<?php echo $communicationval;?>" type="number" min=0 max=5 step=0.5 >
                       </div>
                 </div>
                 
                 <div class="clear10"></div>
                 <div class="col-lg-2 col-sm-2 col-xs-12 ">
                       <div class="row ratinguser">
                           Delivery time
                       </div>
                 </div>
                 <div class="col-lg-3 col-sm-6 col-xs-12 ">
                       <div class="row ratinguser">
                          <input type="hidden" id="deliverytimeval" value="<?php echo $deliverytimeval;?>" name="data[UserRating][deliverytimeval]">
                           <input id="deliverytime" value="<?php echo $deliverytimeval;?>" type="number" min=0 max=5 step=0.5 >
                       </div>
                 </div>
                 
                 <div class="clear10"></div>
                 <div class="col-lg-2 col-sm-2 col-xs-12 ">
                       <div class="row">
                           Cost of transport
                       </div>
                 </div>
                 <div class="col-lg-3 col-sm-6 col-xs-12 ">
                       <div class="row ratinguser">
                          <input type="hidden" id="cost_of_transportval" value="<?php echo $cost_of_transportval;?>" name="data[UserRating][cost_of_transportval]">
                           <input id="cost_of_transport" value="<?php echo $cost_of_transportval;?>" type="number" min=0 max=5 step=0.5 >
                       </div>
                 </div>
                 
                 <div class="clear15"></div>
                  <?php if(!isset($this->request->data['UserRating']['rating_id'])){?>
                 <button class="flat_btn" type="submit" name="torate" id="torate">To Rate</button>
                 <?php }?>
                 
                     <div class="clear40"></div>
            </div>
             </form>   
          </div>
            </div>
        <div class="clear"></div>
      </div>
          
          <div class="clearfix" style="height:1px;"></div>
        </div>
  </div>
      <div class="clearfix"></div>
    </div>
<?php
echo $this->element('footer-home');
?>