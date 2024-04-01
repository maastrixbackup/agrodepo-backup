<div class="col-md-3">
        <div class="block block-cat-menu">
            <div class="innermargin">
                <div class="photo_panel">
                <?php
				$user=$this->Session->read('User'); 
				$imgdetail=$this->Custom->BapCustUniprofileimg($user['user_id']);
				
				if(!empty($imgdetail) && $imgdetail['MasterUser']['profile_img']!=''){
	
					if (file_exists('files/profileimg/172X180_'.$imgdetail['MasterUser']['profile_img'])) {
					$imgdetail_path=$base_url.'files/profileimg/172X180_'.$imgdetail['MasterUser']['profile_img'];
					   }else{
					$imgdetail_path=$base_url.'files/profileimg/'.$imgdetail['MasterUser']['profile_img'];
						   }
					?>
                <img src="<?php echo $imgdetail_path;?>" border="0" width="172" height="180" alt="">
                <?php }else if($user['is_facebook']==1)
				{
					?>
                    <img src="http://graph.facebook.com/<?php echo $user['fb_id'];?>/picture?type=large" border="0" width="172" height="180" alt="">
                    <?php
				}else{?>
                    <img src="<?php echo $this->webroot;?>images/user.png" border="0" width="172" height="180" alt="">
                    <?php }?>
                    <a href="#" style="text-decoration:none;">
                        <div class="change_photo" onclick="location.href='<?php echo $base_url;?>pages/profile-img'"><?php echo EDITPROFILEPIC;?></div>
                    </a>
                </div>
                
                <div class="panel panel-primary">
                  <div class="panel-body listitem">
                    
                    <ul class="mtree transit">
<li><a href="#"><?php echo PURCHASE;?></a>
<ul>
    <li><a href="<?php echo $this->webroot;?>pages/my-purchases"><?php echo MYPURCHASE;?></a></li>
    <li><a href="<?php echo $this->webroot;?>pages/my-question"><?php echo MYQUESTION;?></a></li>
</ul>
</li>
<li><a href="#"><?php echo SALES;?></a>
<ul>
    <li <?php if($this->request->params['controller'] == 'PostAds' && $this->request->params['action'] == 'add'){?> class="active"<?php }?>><a href="<?php echo $this->webroot;?>PostAds/add"><?php echo POSTAD;?></a></li>
    <li <?php if($this->request->params['controller'] == 'PostAds' && $this->request->params['action'] == 'index'){?> class="active"<?php }?>><a href="<?php echo $this->webroot.'PostAds';?>"><?php echo ACTIVESALE;?></a></li>
    <li><a href="<?php echo $this->webroot;?>pages/ask-question"><?php echo ASKFORSALE;?></a></li>
   <?php /*?> <li><a href="<?php echo $this->webroot;?>pages/sales-order-list"><?php echo ORDERR;?></a></li><?php */?>
    <li><a href="<?php echo $this->webroot;?>pages/commands"><?php echo COMMANDS;?></a></li>
    <li><a href="<?php echo $this->webroot;?>pages/out-of-stock"><?php echo OUTOFSTOCT;?></a></li>
    <li <?php if($this->request->params['controller'] == 'PostAds' && $this->request->params['action'] == 'deletead'){?> class="active"<?php }?>><a href="<?php echo $this->webroot;?>PostAds/deletead"><?php echo DELETEADD;?></a></li>
    <li><a href="<?php echo $this->webroot;?>PostAds/promotead"><?php echo PROMOTEDADS;?></a></li>
</ul>
</li>
<li><a href="#"><?php echo REQUESTPARTS;?></a>
<ul><li  <?php if($this->request->params['controller'] == 'RequestParts' && $this->request->params['action'] == 'add'){?> class="active"<?php }?>><a href="<?php echo $this->webroot;?>RequestParts/add"><?php echo ADDOFFER;?></a>
</li><li  <?php if($this->request->params['controller'] == 'RequestParts' && $this->request->params['action'] == 'index'){?> class="active"<?php }?>><a href="<?php echo $this->webroot;?>RequestParts/"><?php echo MYREQUESTPART;?></a></li>
<li  <?php if($this->request->params['controller'] == 'RequestParts' && $this->request->params['action'] == 'bidding'){?> class="active"<?php }?>><a href="<?php echo $this->webroot;?>RequestParts/bidding"><?php echo BIDDING;?></a></li>
<li><a href="<?php echo $this->webroot;?>RequestParts/offer_losing"><?php echo SUPPLYDEMAND;?></a></li>
<li <?php if($this->request->params['controller'] == 'RequestParts' && $this->request->params['action'] == 'request_question'){?> class="active"<?php }?>><a href="<?php echo $this->webroot;?>RequestParts/request_question"><?php echo NEWQUESTIONOFFER;?></a></li>
<li><a href="<?php echo $this->webroot;?>RequestParts/offer_winning"><?php echo OFFERWINNING;?></a></li>
<li><a href="<?php echo $this->webroot;?>RequestParts/offertomyrequest"><?php echo OFFERMYREQUEST;?></a></li>
<li><a href="<?php echo $this->webroot;?>RequestParts/partsorder">Piese de schimb Comanda</a></li>
<li>
<a href="#">Adresați-vă Vanzator</a>
	<ul>
    	<li><a href="<?php echo $this->webroot;?>RequestParts/ask_seller">Inbox</a></li>
        <li><a href="<?php echo $this->webroot;?>RequestParts/ask_seller_sent">Sent</a></li>
    </ul>
</li>
</ul>
</li>
<li><a href="#"><?php echo POSTS;?></a>
<ul><li><a href="<?php echo $base_url;?>pages/inbox"><?php echo INBOX;?></a>
</li><li><a href="<?php echo $base_url;?>pages/sent-message"><?php echo SUBMISSIONS;?></a></li>
<li><a href="<?php echo $base_url;?>pages/archive-posts"><?php echo ARCHIVPOST;?></a></li>
<li><a href="<?php echo $base_url;?>pages/history-msg"><?php echo EMAILHISTORY;?></a></li>
<li><a href="<?php echo $base_url;?>pages/compose-message"><?php echo SENDPRIVATEMESG;?></a></li>
</ul>
</li>
<li><a href="#"><?php echo RATINGGIVEN;?></a>
<ul><li><a href="<?php echo $this->webroot;?>pages/rating-given-buyer"><?php echo RATINGBYER;?></a>
</li><li><a href="<?php echo $this->webroot;?>pages/rating-given-seller"><?php echo SELLERRATING;?></a></li>
</ul>
</li>
<li><a href="#"><?php echo RATINGRECIVED;?></a>
<ul><li><a href="<?php echo $this->webroot;?>pages/rating-receive-buyer"><?php echo RATINGBYER;?></a>
</li><li><a href="<?php echo $this->webroot;?>pages/rating-receive-seller"><?php echo SELLERRATING;?></a></li>
</ul>
</li>
<li><a href="#"><?php echo MYRATING;?></a>
<ul><li><a href="<?php echo $base_url;?>pages/my-rating"><?php echo TOTALPNNR;?> </a>
</ul>
</li>
<li><a href="#"><?php echo FINANCIAL;?></a>
<ul><li><a href="<?php echo $base_url;?>pages/accounts-credits"><?php echo ACCOUNTCREADIT;?></a></li>
<li><a href="<?php echo $base_url;?>pages/history-accounts"><?php echo HISTORYACCOUNT;?></a></li>
<li><a href="#"><?php echo FEEDACCOUNTS;?></a>
<ul>
<li><a href="<?php echo $base_url;?>UpgradeMemberships/index/billtype:company"><?php echo PAYPALINDIVISUAL;?></a></li>
<li><a href="<?php echo $base_url;?>UpgradeMemberships/index/billtype:person"><?php echo PAYPALLIGAL;?></a></li>
</ul>
</li>
</ul>
</li>

<li>
<a href="<?php echo $this->webroot;?>Logins/user_dashboard"><?php echo SETTINGS;?></a>
<ul>
    <li <?php if($this->request->params['action'] == 'account_setting'){?> class="active"<?php }?>><a href="<?php echo $this->webroot.'MasterUsers/account_setting';?>"><?php echo PPINFORMATIONMANAGE;?> </a></li>
    <li <?php if($this->request->params['action'] == 'slugName' && isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='subscribe'){?> class="active"<?php }?>><a href="<?php echo $this->webroot.'pages/subscribe'?>"><?php echo ALERTAUTOPREQUEST;?> </a></li>
    
    <li <?php if($this->request->params['controller'] == 'SalesWarranties'){?> class="active"<?php }?>><a href="<?php echo $this->webroot.'SalesWarranties'?>"><?php echo WRSP;?></a></li>
    
    <li <?php if($this->request->params['action'] == 'change_password'){?> class="active"<?php }?>><a href="<?php echo $this->webroot.'MasterUsers/change_password'?>"><?php echo CHANGEPASSWORD;?></a></li>
    
    <li <?php if($this->request->params['action'] == 'change_email'){?> class="active"<?php }?>><a href="<?php echo $this->webroot.'MasterUsers/change_email/user'?>"><?php echo CHANGEEMAILADDRESS;?></a></li>
    
    <li><a href="#"><?php echo COMPANYSETTINGPARCPARTS;?></a>
        <ul>
        	 <li><a href="<?php echo $this->webroot.'SalesParks/index'?>"><?php echo TRUCKPARKS;?></a></li>
            <li><a href="<?php echo $this->webroot.'SalesParks/companypieces'?>"><?php echo COMPANYPARTS;?></a></li>
            <li><a href="<?php echo $this->webroot.'SalesParks/questionrec'?>">Intrebare Primit</a></li>
             <li><a href="<?php echo $this->webroot.'SalesParks/sentquestion'?>">Intrebare trimis</a></li>
           
        </ul>
    </li>
    <li><a href="#"><?php echo SUCCESSSTORIES;?></a>
        <ul>
            <li><a href="<?php echo $this->webroot.'pages/success-stories-list/'?>"><?php echo MANAGESUCESSSTORIES;?></a></li>
            <li><a href="<?php echo $this->webroot.'pages/success-stories/'?>"><?php echo ADDSUCESSSTORIES;?></a></li>
        </ul>
    </li>
    
</ul>
</li>
<li><a href="#"><?php echo MYPROFILE;?></a>
<ul>
    <li><a href="<?php echo $this->webroot.'pages/my-profile';?>"><?php echo PROFILEPAGE;?></a></li>
    <li ><a href="<?php echo $this->webroot.'pages/statistics-views/most-viewed';?>"><?php echo STATICVIEW;?></a></li>
</ul>
</li>
<?php /*?><li>
<?php $user=$this->Session->read('User');?>
<a href="#">Notice(<?php echo $this->Custom->userTotalNotice($user['user_id']);?>)</a>
<ul>
    <li><a href="<?php echo $this->webroot.'pages/commands';?>"><?php echo $this->Custom->salesOrderNotice($user['user_id']);?> Comenzi</a></li>
    <li><a href="<?php echo $this->webroot.'RequestParts/offertomyrequest';?>"><?php echo $this->Custom->BidNotice($user['user_id']);?> bids Offer</a></li>
    <li><a href="<?php echo $this->webroot.'/pages/ask-question';?>"><?php echo $this->Custom->salesCommentNotice($user['user_id']);?> Sales Comments</a></li>
</ul>
</li><?php */?>
<li><a href="<?php echo $this->webroot.'MasterUsers/logout';?>"><?php echo LOGOUT;?></a></li>
</ul>
    </div>
</div>
</div>	   
</div>       	
         
<div class="clear"></div>

<div class="belowmenu">
<!--<a href="#"><img src="<?php echo $this->webroot;?>images/add2.png" alt="" style="width:100%;"></a>-->
<?php 
            
            $ad_details=$this->Custom->leftOneAd();
			if(!empty($ad_details))
			{
            $ad_details=$ad_details['Advertisement'];
            //pr($ad_details);
            if($ad_details['ad_type']==1){ // for banner type
                    ?>
                     <a href="<?php echo $ad_details['banner_link'];?>" target="_blank">
            <img src="<?php echo $this->webroot.'files/advertisement/'.$ad_details['banner_image'];?>" alt="<?php echo $ad_details['banner_title'];?>" style="width:100%;">
            </a>
                    <?php
                }else if($ad_details['ad_type']==2){ // for script type
                    
                    echo stripslashes($ad_details['ad_script']);
                }
			}
            
            ?>
<div class="clear"></div>
</div>
</div>
