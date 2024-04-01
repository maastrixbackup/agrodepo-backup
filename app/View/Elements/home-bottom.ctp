<div class="listview">
    <div class="col-md-4">
        <div class="block block-success-story">
            <div class="block-heading silver">
                <div class="symbol" style="background-image:url(<?php echo $base_url;?>images/profile.png); background-repeat:no-repeat;"><?php echo PRIMIUMSUPPLIER;?></div>
            </div>
             <div class="block-body">
                <ul id="ticker">
            <?php
			if(!empty($premiumRes))
			{
				foreach($premiumRes as $premiumResult)
				{
					$userID=$premiumResult['MasterUser']['user_id'];
					$userName=$premiumResult['MasterUser']['first_name'].' '.$premiumResult['MasterUser']['last_name'];
					$otherAdd=stripslashes($premiumResult['MasterUser']['other_add']);
					$otherAdd=(strlen($otherAdd)>65)? nl2br(substr($otherAdd,0,65)).'...' : $otherAdd;
					$coutyID=stripslashes($premiumResult['MasterUser']['country_id']);
					$countyName=$this->Custom->region_nm($coutyID);
					$locationID=stripslashes($premiumResult['MasterUser']['locality_id']);
					$locationName=$this->Custom->location_nm($locationID);
					$profileImg=stripslashes($premiumResult['MasterUser']['profile_img']);
					$memberDetail=$this->Custom->BapCustUniMembership($userID);
					if(file_exists("files/profileimg/80X80_".$profileImg)) {
					$profileImg_path=$base_url."files/profileimg/80X80_".$profileImg;
					}else{
					$profileImg_path=$base_url."files/profileimg/".$profileImg;
						 }
					?>
                    <li>
                        <div class="cbp-qtcontent cbp-qtcurrent" style="transition: opacity 700ms ease; -webkit-transition: opacity 700ms ease;">
                        <?php if($profileImg!=''){?>
                            <a href="<?php echo $base_url;?>pages/user-profiles/<?php echo $userID;?>">
                            <img src="<?php echo $profileImg_path;?>" title="<?php echo stripslashes($userName);?>" border="0" width="80" height="80" class="thumb" alt="<?php echo stripslashes($userName);?>"></a>
                            <?php }else{?>
                            <a href="<?php echo $base_url;?>pages/user-profiles/<?php echo $userID;?>"><img src="<?php echo $base_url;?>images/profileholder.png" title="<?php echo stripslashes($userName);?>" border="0" width="80" height="80" class="thumb" alt="<?php echo stripslashes($userName);?>"></a>
                            <?php }?>
                            <span class="block-title"><a href="<?php echo $base_url;?>pages/user-profiles/<?php echo $userID;?>"><?php echo stripslashes($userName);?></a></span>
                            <span><?php echo $countyName;?>, <?php echo $locationName;?></span>
                            <?php if(!empty($otherAdd)){?>
                            <span><?php echo $otherAdd;?></span>
                            <?php }?>
                        </div>
                        <?php if(!empty($memberDetail)){
							if($memberDetail['UserMembership']['plan_img']!='')
							{
								$planName=$memberDetail['UserMembership']['memb_type'];
								$plan_img=$memberDetail['UserMembership']['plan_img'];
								if(file_exists("files/memberplanimg/45X45_".$plan_img)) {
								$plan_img_path=$base_url."files/memberplanimg/45X45_".$plan_img;
								}else{
								$plan_img_path=$base_url."files/memberplanimg/".$plan_img;
									 }
							?>
                        <img src="<?php echo $plan_img_path;?>" class="member23" alt="<?php echo $planName;?>">
                        <?php 
							}
						}?>
                    </li>
                    
                    <div class="clear"></div>
                    <?php
				}
				
			}
			?>
             </ul>
             
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="block block-success-story">
            <div class="block-heading silver">
                <div class="symbol" style="background-image:url(<?php echo $base_url;?>images/success.png); background-repeat:no-repeat;"><?php echo SUCCESSSTORIES;?></div>
            </div>
            
            <div class="block-body">
            <?php
			if(!empty($storyRes))
			{
				$user_details=$this->Custom->user_details($storyRes['SuccessStory']['user_id']);
				$userName=$user_details['first_name'].' '.$user_details['last_name'];
				$coutyyID=stripslashes($user_details['country_id']);
				$countyyName=$this->Custom->region_nm($coutyyID);
				$locationnID=stripslashes($user_details['locality_id']);
				$locationnName=$this->Custom->location_nm($locationnID);
				$profileeImg=stripslashes($user_details['profile_img']);
				$succ_story_ID = $storyRes['SuccessStory']['success_id'];
				if(!empty($profileeImg))
				{
				if(file_exists("files/profileimg/80X80_".$profileImg)) {
				$profileImg_path=$base_url."files/profileimg/80X80_".$profileImg;
				}else{
				$profileImg_path=$base_url."files/profileimg/".$profileImg;
					 }
				?>
                 <a href="javascript:void(0);"><img src="<?php echo $profileImg_path;?>" title="<?php echo stripslashes($userName);?>" width="50" border="0" class="thumb" alt="<?php echo stripslashes($userName);?>"></a>
                            <?php }else{?>
                            <a href="javascript:void(0);"><img src="<?php echo $base_url;?>images/profileholder.png" title="<?php echo stripslashes($userName);?>" border="0"  width="50" border="0" class="thumb" alt="<?php echo stripslashes($userName);?>"></a>
                            <?php }?>
                <div class="block-title"><a href="#"><?php echo $userName;?></a></div>
                <?php echo $countyyName;?>,&nbsp;<?php echo $locationnName;?>
                
                <br>
                <div class="callout">
                    <a href="<?php echo $base_url;?>pages/success-stories-details/<?php echo $succ_story_ID;?>"><?php echo stripslashes($storyRes['SuccessStory']['content']);?></a>
                    <b class="notch"></b>
                </div><br>
                
                <a href="<?php echo $base_url;?>pages/success-stories/" class="post-story"><span class="icontags3"></span><?php echo PUBLISHSTORY;?></a>
                <a href="#" class="more-story"><span class="icontags4"></span><?php echo SUCCESSSTORIES;?></a>
                <?php
                }
                ?>
                </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="block block-success-story">
            <div class="block-heading silver">
                <div class="symbol" style="background-image:url(<?php echo $base_url;?>images/news.png); background-repeat:no-repeat;"><?php echo TRADENEWSNOTICE;?></div>
            </div>
            
            <div class="block-body">
            <?php
			if(!empty($newsRes))
			{
				$newscount=1;
				foreach($newsRes as $newsResult)
				{
					if(count($newsRes)==$newscount){$separator='<div class="clearfix" style="height:2px;"></div><div class="seperator"></div>';}else{$separator=' <div class="clearfix" style="height:2px;"></div><div class="seperator"></div><div class="clearfix" style="height:8px;"></div>';}
					$newsID=$newsResult['News']['news_id'];
					$newsTitle=$newsResult['News']['news_title'];
					$newsContent=stripslashes($newsResult['News']['news_content']);
					$newsContent=(strlen($newsContent)>65)? nl2br(strip_tags(substr($newsContent,0,65))).'...' : nl2br(strip_tags($newsContent));
					$newsImg=$newsResult['News']['news_img'];
					$postDate=date("d-m-Y [H:i A]", strtotime($newsResult['News']['created']));
					if (file_exists("files/news/60X60_".$newsImg)) {
						$newsImg_path= $base_url."files/news/60X60_".$newsImg;
                       }else{
						$newsImg_path= $base_url."files/news/".$newsImg;
						   }
					?>
                    <?php //echo $base_url;pages/news/<?php //echo $newsID;?>
                <div class="block-content">
                    <img src="<?php echo $newsImg_path;?>" alt="<?php echo $newsTitle;?>" width="50" border="0" class="thumb">
                    <span class="block-title"><a href="<?php echo $base_url;?>pages/news-details/<?php echo $newsID;?>" title="<?php echo $newsTitle;?>"><?php echo $newsTitle;?></a></span><br>
                    <?php echo $newsContent;?>
                 	<br>
                    <span class="date"><?php echo $postDate;?></span>
                </div>
               
                <?php
				$newscount++;
				}
			}
			if(count($newsRes)>=2)
			{
			?>
                <a href="#" class="morelist">&raquo; More News</a>
           <?php }?>
          </div>
        </div>
    </div>
</div>