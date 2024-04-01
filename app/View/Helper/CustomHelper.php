<?php
	class CustomHelper extends AppHelper {
		function brand_nm($b_id){
			App::import('Model','SalesBrand'); 
			$SalesBrand = new SalesBrand(); 
			$brand_name = $SalesBrand->find('first',array('conditions'=>array("SalesBrand.brand_id" => $b_id), 'fields' => array('SalesBrand.brand_name')));
			if(!empty($brand_name)){
				$brand_name = isset($brand_name['SalesBrand']['brand_name'])?$brand_name['SalesBrand']['brand_name']:'';
				return $brand_name;
				}
			
			
		}
		function sub_brand_nm($b_id){
			App::import('Model','SalesBrand'); 
			$SalesBrand = new SalesBrand(); 
			$sub_brand_name = $SalesBrand->find('list',array('conditions'=>array("SalesBrand.flag" => $b_id), 'fields' => array('SalesBrand.brand_id','SalesBrand.brand_name')));
			//$brand_name = $brand_name['SalesBrand']['brand_name'];
			if(!empty($sub_brand_name))
			return $sub_brand_name;
			
		}
		function region_nm($c_id){
			App::import('Model','MasterCountry'); 
			$MasterCountry = new MasterCountry(); 
			$country_name = $MasterCountry->find('first',array('conditions'=>array("MasterCountry.country_id" => $c_id), 'fields' => array('MasterCountry.country_name')));
			if(!empty($country_name)){
			$country_name = $country_name['MasterCountry']['country_name'];
			return $country_name;
			}
			
		}
		function location_nm($l_id){
			App::import('Model','MasterLocation'); 
			$MasterLocation = new MasterLocation(); 
			$location_name = $MasterLocation->find('first',array('conditions'=>array("MasterLocation.location_id" => $l_id), 'fields' => array('MasterLocation.location_name')));
			if(!empty($location_name)){
			$location_name = $location_name['MasterLocation']['location_name'];
			return $location_name;
			}
		}
		
		function category_name($ct_id){
			App::import('Model','SalesCategory'); 
			$SalesCategory = new SalesCategory(); 
			$cat_name = $SalesCategory->find('first',array('conditions'=>array("SalesCategory.category_id" => $ct_id), 'fields' => array('SalesCategory.category_name')));
			if(!empty($cat_name)){
			$cat_name = $cat_name['SalesCategory']['category_name'];
			return $cat_name;
			}
		}
		function user_nm($u_id){
			App::import('Model','MasterUser'); 
			$MasterUser = new MasterUser(); 
			$u_name = $MasterUser->find('first',array('conditions'=>array("MasterUser.user_id" => $u_id), 'fields' => array('MasterUser.first_name')));
			if(!empty($u_name)){
			$u_name = $u_name['MasterUser']['first_name'];
			return $u_name;
			}
		}
		function user_type($user_type_id){
			App::import('Model','MasterUserType');
			$MasterUserType = new MasterUserType();
			$u_type=$MasterUserType->find('first',array('conditions'=>array('MasterUserType.ut_id'=>$user_type_id)));
			if(!empty($u_type)){
			$user_type=$u_type['MasterUserType']['user_type'];
			return $user_type;
			}
		}
		function user_details($user_id){
			App::import('Model','MasterUser'); 
			$MasterUser = new MasterUser(); 
			$u_name = $MasterUser->find('first',array('conditions'=>array("MasterUser.user_id" => $user_id)));
			if(!empty($u_name))
			return $u_name['MasterUser'];
			
		}
		function BapUserDetails($user_id){
			App::import('Model','MasterUser'); 
			$MasterUser = new MasterUser(); 
			$details = $MasterUser->find('first',array('conditions'=>array("MasterUser.user_id" => $user_id)));
			if(!empty($details))
			return $details;
		}
		function totalUser(){
			App::import('Model','MasterUser'); 
			$MasterUser = new MasterUser(); 
			$count=$MasterUser->find('count');
			if(!empty($count))
			return $count;
		}
		function totalBuyer(){
			App::import('Model','MasterUser'); 
			$MasterUser = new MasterUser(); 
			$count=$MasterUser->find('count',array('conditions'=>array('MasterUser.user_type_id'=>1)));
			if(!empty($count))
			return $count;
		}
		function totalSeller(){
			App::import('Model','MasterUser'); 
			$MasterUser = new MasterUser(); 
			$count=$MasterUser->find('count',array('conditions'=>array('MasterUser.user_type_id'=>2)));
			if(!empty($count))
			return $count;
		}
		/*
		/All Category fetch functionaity
		*/
		function dez_categories($flag=0){
			App::import('Model','SalesCategory'); 
			$SalesCategory = new SalesCategory(); 
			$categorylist=$SalesCategory->find('all',array('conditions'=>array('SalesCategory.status'=>1, 'SalesCategory.flag'=>$flag),'order' => array('category_name' => 'asc')));
			 if(!empty($categorylist))
			return $categorylist;
		}
		/*
		/All Brand fetch functionaity
		*/
		function dezBrand($flag=0, $ordering="brand_name"){
			App::import('Model','SalesBrand'); 
			$SalesBrand = new SalesBrand(); 
			$brandlist=$SalesBrand->find('all',array('conditions'=>array('status'=>1, 'flag'=>$flag),'order' => array($ordering => 'asc')));
			 if(!empty($brandlist))
			return $brandlist;
		}
		/*
		/All County fetch functionaity
		*/
		function dezCounty(){
			App::import('Model','MasterCountry'); 
			$MasterCountry = new MasterCountry(); 
			$countylist=$MasterCountry->find('all',array('order' => array('country_name' => 'asc')));
			 if(!empty($countylist))
			return $countylist;
		}
		/*
		/All city fetch functionaity
		*/
		function dezCity(){
			App::import('Model','MasterLocation'); 
			$MasterLocation = new MasterLocation(); 
			$locationlist=$MasterLocation->find('all',array('order' => array('location_name' => 'asc')));
			 if(!empty($locationlist))
			return $locationlist;
		}
		/*
		/All Categorydetails fetch functionaity
		*/
		function dezSingCat($catid)
		{
			App::import('Model','SalesCategory'); 
			$SalesCategory = new SalesCategory(); 
			$categorylist=$SalesCategory->find('first',array('conditions'=>array('SalesCategory.category_id'=>$catid),'order' => array('category_name' => 'asc')));
			 if(!empty($categorylist))
			return $categorylist;
		}
		/*
		/All Branddetail fetch functionaity
		*/
		function dezSingBrand($brandid)
		{
			App::import('Model','SalesBrand'); 
			$SalesBrand = new SalesBrand(); 
			$branddetail=$SalesBrand->find('first',array('conditions'=>array('SalesBrand.brand_id'=>$brandid),'order' => array('brand_name' => 'asc')));
			 if(!empty($branddetail))
			return $branddetail;
		}
		/*
		/Post ads Count fetch functionaity
		*/
		function dezPostAdsCount($fieldname, $val, $brand='', $county='', $postkeywords='')
		{
			App::import('Model','PostAd'); 
			$PostAd = new PostAd(); 
			$andwhr=array();
			$orwhr=array();
			array_push($andwhr, array('PostAd.'.$fieldname.''=>$val));
			array_push($andwhr, array('PostAd.adv_status' =>1));
			if($brand!='')
			{
			array_push($andwhr,array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),));
			}
			if($county!='')
			{
			array_push($andwhr,array('MasterUser.country_id' =>$county));
			}
			if($postkeywords!='')
			{
				array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$postkeywords.'%'));
				array_push($orwhr,array('PostAd.adv_details LIKE ' => '%'.$postkeywords.'%'));
			}
			$currentDate=date("Y-m-d");
			array_push($andwhr,array("(case when PostAd.is_promote_list='1' then PromotionAd.is_list_expire >= '".$currentDate."' else PostAd.adv_id !='' end)"));
			$postadres=$PostAd->find('count',array('joins' =>
                  array(
                    array(
                        'table' => 'master_users',
                        'alias' => 'MasterUser',
                        'type' => 'left',
                        'foreignKey' => false,
                        'conditions'=> array('PostAd.user_id = MasterUser.user_id')
                    ),
					array(
						'table' => 'promotion_ad',
						'alias' => 'PromotionAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PromotionAd.adv_id = PostAd.adv_id')
					),     
				 ),
				 'conditions'=>array(
				'AND' => $andwhr,
				'OR' => $orwhr
				),));
			 if(isset($postadres))
			return $postadres;
		}
		/*
		/Request Parts Count fetch functionaity
		*/
		function dezRequestPartCount($fieldname,$val)
		{
			App::import('Model','RequestPart'); 
			$RequestPart = new RequestPart(); 
			$RequestPartres=$RequestPart->find('count',array(
			 'joins' =>
				  array(
					array(
						'table' => 'request_accessories',
						'alias' => 'RequestAccessory',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('RequestAccessory.request_id = RequestPart.request_id')
					)          
				 ),
			'conditions'=>array('RequestPart.'.$fieldname.''=>$val,'RequestPart.status IN' =>array(1,2))
			));
			 if(isset($RequestPartres))
			return $RequestPartres;
		}
		/*
		/Post ads fetch functionaity
		*/
		function dezPostAdsRes($advid)
		{
			App::import('Model','PostAd'); 
			$PostAd = new PostAd(); 
			$postadres=$PostAd->find('first',array('conditions'=>array('PostAd.adv_id'=>$advid,'PostAd.adv_status' =>1)));
			 if(isset($postadres))
			return $postadres;
		}
		/*
		/Post ads brand Count fetch functionaity
		*/
		function dezPostAdsBrandCount($val,$cat='',$county='',$postkeywords='')
		{
			App::import('Model','PostAd'); 
			$PostAd = new PostAd(); 
			$andwhr=array();
			$orwhr=array();
			array_push($andwhr, array('FIND_IN_SET(\''. $val .'\',PostAd.adv_brand_id)'));
			array_push($andwhr, array('PostAd.adv_status' =>1));
			if($cat!='')
			{
				array_push($andwhr,array('OR' => array(array('PostAd.category_id' =>$cat),array('PostAd.sub_cat_id' =>$cat)), ));
			}
			if($county!='')
			{
			array_push($andwhr,array('MasterUser.country_id' =>$county));
			}
			if($postkeywords!='')
			{
				array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$postkeywords.'%'));
				array_push($orwhr,array('PostAd.adv_details LIKE ' => '%'.$postkeywords.'%'));
			}
			$currentDate=date("Y-m-d");
			array_push($andwhr,array("(case when PostAd.is_promote_list='1' then PromotionAd.is_list_expire >= '".$currentDate."' else PostAd.adv_id !='' end)"));
			$postadres=$PostAd->find('count',array('joins' =>
                  array(
                    array(
                        'table' => 'master_users',
                        'alias' => 'MasterUser',
                        'type' => 'left',
                        'foreignKey' => false,
                        'conditions'=> array('PostAd.user_id = MasterUser.user_id')
                    ),
					array(
						'table' => 'promotion_ad',
						'alias' => 'PromotionAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PromotionAd.adv_id = PostAd.adv_id')
					),     
				 ),
				 'conditions'=>array(
				'AND' => $andwhr,
				'OR' => $orwhr
				),));
			 if(isset($postadres))
			return $postadres;
		}
		/*
		/Post ads model Count fetch functionaity
		*/
		function dezPostAdsModelCount($val,$cat='',$county='',$postkeywords='')
		{
			App::import('Model','PostAd'); 
			$PostAd = new PostAd();
			$andwhr=array();
			$orwhr=array();
			array_push($andwhr, array('FIND_IN_SET(\''. $val .'\',PostAd.adv_model_id)'));
			array_push($andwhr, array('PostAd.adv_status' =>1));
			if($cat!='')
			{
				array_push($andwhr,array('OR' => array(array('PostAd.category_id' =>$cat),array('PostAd.sub_cat_id' =>$cat)), ));
			}
			if($county!='')
			{
			array_push($andwhr,array('MasterUser.country_id' =>$county));
			}
			if($postkeywords!='')
			{
				array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$postkeywords.'%'));
				array_push($orwhr,array('PostAd.adv_details LIKE ' => '%'.$postkeywords.'%'));
			}
			$currentDate=date("Y-m-d");
			array_push($andwhr,array("(case when PostAd.is_promote_list='1' then PromotionAd.is_list_expire >= '".$currentDate."' else PostAd.adv_id !='' end)"));
			$postadres=$PostAd->find('count',array('joins' =>
                  array(
                    array(
                        'table' => 'master_users',
                        'alias' => 'MasterUser',
                        'type' => 'left',
                        'foreignKey' => false,
                        'conditions'=> array('PostAd.user_id = MasterUser.user_id')
                    ),
					array(
						'table' => 'promotion_ad',
						'alias' => 'PromotionAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PromotionAd.adv_id = PostAd.adv_id')
					),     
				 ),
				  'conditions'=>array(
				'AND' => $andwhr,
				'OR' => $orwhr
				),));
			 if(isset($postadres))
			return $postadres;
		}
		/*
		/Post ads county Count fetch functionaity
		*/
		function dezPostAdscountyCount($val, $cat='', $brand='',$postkeywords='')
		{
			//echo $cat.",".$brand;
			App::import('Model','PostAd'); 
			$PostAd = new PostAd(); 
			$andwhr=array();
			$orwhr=array();
			array_push($andwhr, array('MasterUser.country_id' => $val));
			array_push($andwhr, array('PostAd.adv_status' =>1));
			if($cat!='')
			{
				array_push($andwhr,array('OR' => array(array('PostAd.category_id' =>$cat),array('PostAd.sub_cat_id' =>$cat)), ));
			} 
			if($brand!='')
			{
			array_push($andwhr,array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),));
			}
			if($postkeywords!='')
			{
				array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$postkeywords.'%'));
				array_push($orwhr,array('PostAd.adv_details LIKE ' => '%'.$postkeywords.'%'));
			}
			$currentDate=date("Y-m-d");
			array_push($andwhr,array("(case when PostAd.is_promote_list='1' then PromotionAd.is_list_expire >= '".$currentDate."' else PostAd.adv_id !='' end)"));
			//$postadres=$PostAd->find('count',array('conditions'=>array(array('FIND_IN_SET(\''. $val .'\',PostAd.adv_model_id)'),'PostAd.adv_status' =>1)));
			$postlist=$PostAd->find('count', array('joins' =>
                  array(
                    array(
                        'table' => 'master_users',
                        'alias' => 'MasterUser',
                        'type' => 'left',
                        'foreignKey' => false,
                        'conditions'=> array('PostAd.user_id = MasterUser.user_id')
                    ),
					array(
						'table' => 'promotion_ad',
						'alias' => 'PromotionAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PromotionAd.adv_id = PostAd.adv_id')
					),     
				 ),
				  'conditions'=>array(
				'AND' => $andwhr,
				'OR' => $orwhr
				),));
				 if(isset($postlist))
			return $postlist;
		}
		/*
		/Request single image model Count fetch functionaity
		*/
		function RequestSingimg($partsid)
		{
			App::import('Model','RequestImg'); 
			$RequestImg = new RequestImg(); 
			$req_imgres=$RequestImg->find('first',array('conditions'=>array('parts_id' => $partsid),'order' => array('img_id' => 'asc')));
			if(!empty($req_imgres))
			return $req_imgres;
		}
		/*
		/Request all image model Count fetch functionaity
		*/
		public function RequestAllImg($partsid)
		{
			App::import('Model','RequestImg'); 
			$RequestImg = new RequestImg(); 
			$req_imgres=$RequestImg->find('all',array('conditions'=>array('parts_id' => $partsid),'order' => array('seq_no' => 'asc')));
			if(!empty($req_imgres))
			return $req_imgres;
		}
		// get all the subcategory under a category
		function subCat($cat_id){
			App::import('Model','SalesCategory');
			$SalesCat=new SalesCategory();
			$sub_cat=$SalesCat->find('list',array('conditions'=>array('flag'=>$cat_id,'status'=>1)));
			if(!empty($sub_cat))
			return $sub_cat;
		}
		// get all the subcategory under a category with all data
		function BapCustUnisubCat($cat_id){
			App::import('Model','SalesCategory');
			$SalesCat=new SalesCategory();
			$sub_cat=$SalesCat->find('all',array('conditions'=>array('flag'=>$cat_id,'status'=>1)));
			if(!empty($sub_cat))
			return $sub_cat;
		}
		
		// get all the subbrand under a brand in key value pair
		function subBrand($brand_id){
			App::import('Model','SalesBrand');
			$SalesBrand=new SalesBrand();
			$sub_brand=$SalesBrand->find('list',array('conditions'=>array('flag'=>$brand_id,'status'=>1)));
			if(!empty($sub_brand))
			return $sub_brand;
		}
		
		function AdvImage($adv_id){
			App::import('Model','PostadImg');
			$PostadImg=new PostadImg();
			$img_name=$PostadImg->find('first',array('conditions'=>array('post_ad_id'=>$adv_id)));
			//pr($img_name);
			if(!empty($img_name))
			return $img_name['PostadImg']['img_path'];
		}
		// for left one advertisement management
		function leftOneAd(){
			App::import('Model','Advertisement');
			$Advertisement=new Advertisement();
		$left1=$Advertisement->find('first', array('conditions' => array('status' => 1, 'show_position' =>2), 'order' => 'Rand()'));
		return $left1;
			}
			// for left Two advertisement management
		function leftTwoAd(){
			App::import('Model','Advertisement');
			$Advertisement=new Advertisement();
		$left2=$Advertisement->find('first', array('conditions' => array('status' => 1, 'show_position' =>3), 'order' => 'Rand()'));
		return $left2;
			}
			// for Middle advertisement management
		function middleAd(){
			App::import('Model','Advertisement');
			$Advertisement=new Advertisement();
		$middlead=$Advertisement->find('first', array('conditions' => array('status' => 1, 'show_position' =>4), 'order' => 'Rand()'));
		return $middlead;
			}
		function rightsideAd(){
			App::import('Model','Advertisement');
			$Advertisement=new Advertisement();
			$ad=$Advertisement->find('first', array('conditions' => array('status' => 1, 'show_position' =>5), 'order' => 'Rand()'));
			return $ad;
		}
		function Bap_cust_uni_time_since($postdate) {
		$todaydate = date("Y-m-d H:i:s"); 

		$ago = strtotime($todaydate) - strtotime($postdate); 
		  if ($ago >= 86400) {  
			$diff = floor($ago/86400).' days ago';  
		  } elseif ($ago >= 3600) {  
			$diff = floor($ago/3600).' hours ago';  
		  } elseif ($ago >= 60) {  
			$diff = floor($ago/60).' minutes ago';  
		  } else {  
			$diff = $ago.' seconds ago';  
		  } 
		  return $diff;
		}
		function AlladvImage($adv_id){
			App::import('Model','PostadImg');
			$PostadImg=new PostadImg();
			$img_name=$PostadImg->find('list',array('conditions'=>array('post_ad_id'=>$adv_id)));
			//pr($img_name);
			if(!empty($img_name))
			return $img_name;
		}
		// get all parts of a request
		function getAllParts($rid,$status){
			App::import('Model','RequestAccessory');
			$RequestAccessory=new RequestAccessory();
			$partlist=$RequestAccessory->find('all',array('conditions'=>array('RequestAccessory.request_id'=>$rid,'RequestAccessory.status'=>$status)));
			if(!empty($partlist))
			return $partlist;
			}
			// get all county
		function getAllCounty(){
			App::import('Model','MasterCountry'); 
			$MasterCountry = new MasterCountry(); 
			$country_name = $MasterCountry->find('list',array('fields' => array('MasterCountry.country_id','MasterCountry.country_name')));
			if(!empty($country_name))
			return $country_name;
			}
			
			// get parts name
			function parts_name($pid){
				
				App::import('Model','SalesAddPart');
			$SalesAddPart=new SalesAddPart();
			$parts=$SalesAddPart->find('first',array('conditions'=>array('SalesAddPart.part_id'=>$pid)));
			
			if(!empty($parts))
			return $parts['SalesAddPart']['name_piece'];
				}
			// requestparts details
			function reqPartDetails($rid){
			App::import('Model','RequestPart');
			$RequestPart=new RequestPart();
			$req_details=$RequestPart->find('first',array('conditions'=>array('RequestPart.request_id'=>$rid)));
			
			if(!empty($req_details))
			return $req_details['RequestPart'];
			}
			// parts details
			function partsDetails($pid){
				
				App::import('Model','SalesAddPart');
			$SalesAddPart=new SalesAddPart();
			$parts=$SalesAddPart->find('first',array('conditions'=>array('SalesAddPart.part_id'=>$pid)));
			
			if(!empty($parts))
			return $parts['SalesAddPart'];
				}
				
				
			/*
			get the nof of winner , request & cancel 
			*/
				
			function count_bid_type($parts_id){
				App::import('Model','BidOffer');
				$BidOffer=new BidOffer();
				//$counts=$BidOffer->find('list',array('conditions'=>array('BidOffer.request_id'=>$req_id,'BidOffer.user_id'=>$user_id),'fields'=>array('status','count(status)'),'group by'=>'BidOffer.status'));
				$count=$BidOffer->query("SELECT status,count(status) AS cnt FROM bid_offers WHERE parts_id=$parts_id GROUP BY status");
			
				if(isset($count) && count($count)){
					foreach($count AS $cnt){
					$status_count[$cnt['bid_offers']['status']]=$cnt[0]['cnt'];
					}
				return $status_count;
				}
				
			}
			function bidImg($bid){
				App::import('Model','BidImg');
			$BidImg=new BidImg();
			$img_name=$BidImg->find('list',array('conditions'=>array('BidImg.bid_id'=>$bid)));
			//pr($img_name);
			if(!empty($img_name))
			return $img_name;
			}
		/*
		/Sales Details fetch functionaity
		*/
		function BapCustUniSales($salesID)
		{
			App::import('Model','PostAd');
			$PostAd=new PostAd();
			$salesdetails=$PostAd->find('first', array('conditions' => array('adv_id' => $salesID, 'adv_status' => 1)));
			return($salesdetails);
		}
		/*
		/Sales single fetch image functionaity
		*/
		function BapCustUniSalesImg($adv_id){
			App::import('Model','PostadImg');
			$PostadImg=new PostadImg();
			$imgdetails=$PostadImg->find('first',array('conditions'=>array('post_ad_id'=>$adv_id)));
			return($imgdetails);
		}
		/*
		/Single Rating functionaity
		*/
		function BapCustUnisingRate($adv_id,$userid){
			App::import('Model','SalesRating');
			$SalesRating=new SalesRating();
			$ratingres=$SalesRating->find('first', array('conditions' => array('user_id' => $userid, 'adv_id' => $adv_id)));
			return($ratingres);
		}
		
		/*
		Get all the question of a particular request offer & parent
		*/
		function getQuestion($req_id,$parent=0){
			App::import('Model','RequestQuestion');
			$RequestQuestion=new RequestQuestion();
			/*$questionlist=$RequestQuestion->generateTreeList(array('conditions' => array('request_id' => $req_id)));
			print_r($questionlist);exit;*/
			$question=$RequestQuestion->find('all', array('conditions' => array('request_id' => $req_id,'parent'=>$parent)));
			if(!empty($question) && count($question))
			return($question);
		}
		/*
		Get adv_details
		*/
		function BapCustUniAdvDetail($adv_id){
			App::import('Model','PostAd');
			$PostAd=new PostAd();
			$postadres=$PostAd->find('first', array('conditions' => array('adv_id' => $adv_id)));
			return($postadres);
		}
		/*
		/Profile Img fetch functionaity
		*/
		function BapCustUniprofileimg($userid){
			App::import('Model','MasterUser');
			$MasterUser=new MasterUser();
			$imgres=$MasterUser->find('first', array('conditions' => array('user_id' => $userid)));
			return($imgres);
		}
		/*
		/membershipplan fetch functionaity
		*/
		function BapCustUniMembership($userid){
			App::import('Model','UpgradeMembership');
			$UpgradeMembership=new UpgradeMembership();
			$membership=$UpgradeMembership->find('first', array(
			'joins' =>
				  array(
					array(
						'table' => 'user_memberships',
						'alias' => 'UserMembership',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('UserMembership.memb_id = UpgradeMembership.member_type')
					)          
				 ),
			'conditions' => array('UpgradeMembership.user_id' => $userid), 'fields' => array('UserMembership.*','UpgradeMembership.*'), 'order' => array('UpgradeMembership.upgrade_id' => 'desc')));
			return($membership);
		}
		/*
		Get The soical Icon.
		*/
		function getSoicalIcon(){
			App::import('Model','SocialIcon');
			$SocialIcon=new SocialIcon();
			$social_icon=$SocialIcon->find('all', array('order'=>'SocialIcon.orderno asc'));
			//pr($social_icon);
			if(count($social_icon)>0){
				return $social_icon;
				}
			}
		/*
			Get Sales Question
		*/
		function getSalesQuestion($parent_id){
			App::import('Model','SalesQuestion');
			$SalesQuestion=new SalesQuestion();
			$question=$SalesQuestion->find('first', array('conditions'=>array('SalesQuestion.question_id'=>$parent_id)));
			//pr($question);
			if(count($question)>0){
				return $question['SalesQuestion'];
				}
		}
		/*
			Get Advertisement Question
		*/
		function getAdvtName($adv_id){
			App::import('Model','SalesAdvertisement');
			$SalesAdvertisement=new SalesAdvertisement();
			$advt_name=$SalesAdvertisement->find('first', array('conditions'=>array('SalesAdvertisement.adv_id'=>$adv_id)));
			//pr($advt_name);
			if(count($advt_name)>0){
				return $advt_name['SalesAdvertisement'];
				}
		}
		/*
			Get membership by user Memberid
		*/
		function getMemberByID($memid)
		{
			App::import('Model','UserMembership');
			$UserMembership=new UserMembership();
			$memdetails=$UserMembership->find('first', array('conditions' => array('memb_id' => $memid)));
			return($memdetails);
		}
		function userAllPositivePercent($userid)
		{
			App::import('Model','UserRating');
			$UserRating=new UserRating();
			$allpositivegrade=$UserRating->find('count', array('conditions' => array('user_id' => $userid, 'grade' => 1), 'order' => array('rating_id' => 'desc')));
			$UserRating=$UserRating->find('count', array('conditions' => array('user_id' => $userid), 'order' => array('rating_id' => 'desc')));
			if(!empty($UserRating))
			{
				$totpercent=$allpositivegrade/$UserRating*100;
				return($totpercent);
			}
			else
			{
				return(0);
			}
		}
		function userRatingcount($userid)
		{
			App::import('Model','UserRating');
			$UserRating=new UserRating();
			$UserRating=$UserRating->find('all', array('conditions' => array('user_id' => $userid), 'order' => array('rating_id' => 'desc')));
			$totrate=0;
			$avg_rate=0;
			if(!empty($UserRating))
			{
				
				foreach($UserRating as $userratingres)
				{
					$totval=$userratingres['UserRating']['productdescribedval']+$userratingres['UserRating']['communicationval']+$userratingres['UserRating']['deliverytimeval']+$userratingres['UserRating']['cost_of_transportval'];
					$totrate+=$totval/4;
				}
				$avg_rate=$totrate/count($UserRating);
			
			}
			return($avg_rate);
		}
		function curentPlan($upgradeid)
		{
			App::import('Model','UserCreditAccount');
			$UserCreditAccount=new UserCreditAccount();
			$res=$UserCreditAccount->find('count', array('conditions' => array('upgrade_id' => $upgradeid)));
			return($res);
		}
		function userProfileResult($userid)
		{
			App::import('Model','UserRating');
			$UserRating=new UserRating();
			$allpositivegrade=$UserRating->find('all', array('conditions' => array('user_id' => $userid), 'order' => array('rating_id' => 'desc')));
			$grade=0;
			if(!empty($allpositivegrade))
			{
				foreach($allpositivegrade as $allpositivegraderes)
				{
				$grade+=$allpositivegraderes['UserRating']['grade'];
				
				}
				return($grade);
			}
			else
			{
				return(0);
			}
		}
		function allParksimg($park_id)
		{
			App::import('Model','ParkImg');
			$ParkImg=new ParkImg();
			$res=$ParkImg->find('all', array('conditions' => array('park_id' => $park_id)));
			return($res);
		}
		function parkRating($park_id, $rating_from)
		{
			App::import('Model','ParkRating');
			$ParkRating=new ParkRating();
			$res=$ParkRating->find('all', array('conditions' => array('rating_from' => $rating_from, 'park_id' => $park_id)));
			return($res);
		}
		function partsImg($parts_id){
			App::import('Model','RequestImg');
			$RequestImg=new RequestImg();
			$img_name=$RequestImg->find('list',array('conditions'=>array('RequestImg.parts_id'=>$parts_id)));
			//pr($img_name);
			if(!empty($img_name))
			return $img_name;
		}
		function BapCustUniGetMsg($msgid)
		{
			App::import('Model','ManageMessage');
			$ManageMessage=new ManageMessage();
			$msgDetail=$ManageMessage->find('first', array('conditions' => array('msg_id' => $msgid)));
			return($msgDetail);
		}
		function BapCustUniGetTemplate($compose_id)
		{
			App::import('Model','NewsletterTemplate');
			$NewsletterTemplate=new NewsletterTemplate();
			$composeDetail=$NewsletterTemplate->find('first', array('conditions' => array('compose_id' => $compose_id)));
			return($composeDetail);
		}
		function brandList($limit=-1)
		{
			App::import('Model','ManageBrand');
			$ManageBrand=new ManageBrand();
			$brandlist=$ManageBrand->find('list', array('conditions' => array('status' => 1, 'flag' => 0), 'order' => array('brand_name' => 'asc'), 'limit' => $limit));
			return ($brandlist);
		}
		function bapCustUnibrandList($limit=-1)
		{
			App::import('Model','ManageBrand');
			$ManageBrand=new ManageBrand();
			$brandlist=$ManageBrand->find('all', array('conditions' => array('status' => 1, 'flag' => 0), 'order' => array('brand_name' => 'asc'), 'limit' => $limit));
			return ($brandlist);
		}
		function categoryList($limit=-1)
		{
			App::import('Model','ManageCategory');
			$ManageCategory=new ManageCategory();
			$catlist=$ManageCategory->find('list', array('conditions' => array('status' => 1, 'flag' => 0), 'order' => array('category_name' => 'asc'), 'limit' => $limit));
			return ($catlist);
		}
		function bapCustUnicategoryList($limit=-1)
		{
			App::import('Model','SalesCategory');
			$ManageCategory=new SalesCategory();
			$catlist=$ManageCategory->find('all', array('conditions' => array('status' => 1, 'flag' => 0), 'order' => array('category_name' => 'asc'), 'limit' => $limit));
			return ($catlist);
		}
		function countyList()
		{
			App::import('Model','MasterCountry');
			$MasterCountry=new MasterCountry();
			$countylist=$MasterCountry->find('list', array('order' => array('country_name' => 'asc')));
			return ($countylist);
		}
		function locationList($countyID)
		{
			App::import('Model','MasterLocation');
			$MasterLocation=new MasterLocation();
			$locationList=$MasterLocation->find('list', array('conditions' => array('country_id' => $countyID),'order' => array('location_name' => 'asc'), 'fields' => array('location_id', 'location_name')));
			return ($locationList);
		}
		function composeList($usertype)
		{
			App::import('Model','NewsletterTemplate');
			$NewsletterTemplate=new NewsletterTemplate();
			$composelist=$NewsletterTemplate->find('list', array('conditions' => array('compose_status' => 1, 'user_type' => $usertype), 'order' => array('compose_id' => 'desc')));
			return ($composelist);
		}
		function subscribeList($usertype)
		{
			App::import('Model','SubscribeAlert');
			$SubscribeAlert=new SubscribeAlert();
			$userOptions=array('joins' =>
							  array(
								array(
									'table' => 'master_users',
									'alias' => 'MasterUser',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('MasterUser.user_id = SubscribeAlert.user_id')
								)          
							 ),
						'conditions' => array('AND' =>
						array('MasterUser.user_type_id' => $usertype),
						array('MasterUser.is_active' => 1),
						array('MasterUser.wrong_login_attempt <=' => 3)
						),
						'fields' => array('MasterUser.user_id', 'MasterUser.first_name'),
			  			'order' => array('MasterUser.user_id' => 'desc'));
						
						$alluserOptions=array('joins' =>
							  array(
								array(
									'table' => 'master_users',
									'alias' => 'MasterUser',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('MasterUser.user_id = SubscribeAlert.user_id')
								)          
							 ),
						'conditions' => array('AND' =>
						array('MasterUser.user_type_id' => $usertype),
						array('MasterUser.is_active' => 1),
						array('MasterUser.wrong_login_attempt <=' => 3)
						),
						'fields' => array('MasterUser.user_id', 'MasterUser.first_name', 'MasterUser.last_name'),
			  			'order' => array('MasterUser.user_id' => 'desc'));
						$allsubscriberes=$SubscribeAlert->find('all', $alluserOptions);
			$subscribelist=$SubscribeAlert->find('list', $userOptions);
			if(!empty($allsubscriberes))
			{
				foreach($allsubscriberes as $subscribeRes)
				{
					$subscribeID=$subscribeRes['MasterUser']['user_id'];
					$subscribename=$subscribeRes['MasterUser']['first_name'].' '.$subscribeRes['MasterUser']['last_name'];
					$subscribelist[$subscribeID]=$subscribename;
					
				}
			}
			return ($subscribelist);
		}
		function warrantyDetail($userid)
		{
			App::import('Model','SalesWarranty');
			$SalesWarranty=new SalesWarranty();
			$warrantydetail=$SalesWarranty->find('first', array('conditions' => array('SalesWarranty.user_id' => $userid)));
			return ($warrantydetail);
		}
		function totalView($adv_id)
		{
			App::import('Model','SalesView');
			$SalesView=new SalesView();
			$totview=$SalesView->find('count', array('conditions' => array('SalesView.adv_id' => $adv_id)));
			return ($totview);
		}
		function totalfav($adv_id)
		{
			App::import('Model','SalesAddToFavourite');
			$SalesAddToFavourite=new SalesAddToFavourite();
			$totfav=$SalesAddToFavourite->find('count', array('conditions' => array('SalesAddToFavourite.adv_id' => $adv_id)));
			return ($totfav);
		}
		function totalNotice($noticetype='')
		{
			App::import('Model','Notice');
			$Notice=new Notice();
			if($noticetype!='')
			{
				$totnotice=$Notice->find('count', array('conditions' => array('Notice.status' => 0, 'user_id' => 0, 'Notice.notice_type' => $noticetype)));
			}
			else
			{
				$totnotice=$Notice->find('count', array('conditions' => array('Notice.status' => 0, 'user_id' => 0)));
			}
			return ($totnotice);
		}
		function userTotalNotice($userid)
		{
			App::import('Model','Notice');
			$Notice=new Notice();
			$totnotice=0;
			if($userid!='')
			{
				$totnotice+=$Notice->find('count', array(
				'joins' =>
				  array(
					array(
						'table' => 'sales_advertisements',
						'alias' => 'PostAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PostAd.adv_id = Notice.postid')
					)          
				 ),
				'conditions' => array(
				'Notice.status' => 0,
				 'Notice.notice_type' => 'sales-order',
				 'PostAd.user_id' => $userid,
				 )
				 ));
				 $totnotice+=$Notice->find('count', array(
				'joins' =>
				  array(
					array(
						'table' => 'sales_advertisements',
						'alias' => 'PostAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PostAd.adv_id = Notice.postid')
					)          
				 ),
				'conditions' => array(
				'Notice.status' => 0,
				 'Notice.notice_type' => 'sales-question',
				 'PostAd.user_id' => $userid,
				 )
				 ));
				  $totnotice+=$Notice->find('count', array(
				'joins' =>
				  array(
					array(
						'table' => 'request_parts',
						'alias' => 'RequestPart',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('RequestPart.request_id = Notice.postid')
					)          
				 ),
				'conditions' => array(
				'Notice.status' => 0,
				 'Notice.notice_type' => 'bid-offer',
				 'RequestPart.user_id' => $userid,
				 )
				 ));
			}
			else
			{
				$totnotice=0;
			}
			return ($totnotice);
		}
		function salesOrderNotice($userid)
		{
			App::import('Model','Notice');
			$Notice=new Notice();
			$totnotice=0;
			if($userid!='')
			{
				$totnotice+=$Notice->find('count', array(
				'joins' =>
				  array(
					array(
						'table' => 'sales_advertisements',
						'alias' => 'PostAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PostAd.adv_id = Notice.postid')
					)          
				 ),
				'conditions' => array(
				'Notice.status' => 0,
				 'Notice.notice_type' => 'sales-order',
				 'PostAd.user_id' => $userid,
				 )
				 ));
				
				 
			}
			else
			{
				$totnotice=0;
			}
			return ($totnotice);
		}
		function BidNotice($userid)
		{
			App::import('Model','Notice');
			$Notice=new Notice();
			$totnotice=0;
			if($userid!='')
			{
				  $totnotice+=$Notice->find('count', array(
				'joins' =>
				  array(
					array(
						'table' => 'request_parts',
						'alias' => 'RequestPart',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('RequestPart.request_id = Notice.postid')
					)          
				 ),
				'conditions' => array(
				'Notice.status' => 0,
				 'Notice.notice_type' => 'bid-offer',
				 'RequestPart.user_id' => $userid,
				 )
				 ));
			}
			else
			{
				$totnotice=0;
			}
			return ($totnotice);
		}
		function salesCommentNotice($userid)
		{
			App::import('Model','Notice');
			$Notice=new Notice();
			$totnotice=0;
			if($userid!='')
			{
				 $totnotice+=$Notice->find('count', array(
				'joins' =>
				  array(
					array(
						'table' => 'sales_advertisements',
						'alias' => 'PostAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PostAd.adv_id = Notice.postid')
					)          
				 ),
				'conditions' => array(
				'Notice.status' => 0,
				 'Notice.notice_type' => 'sales-question',
				 'PostAd.user_id' => $userid,
				 )
				 ));
			}
			else
			{
				$totnotice=0;
			}
			return ($totnotice);
		}
		public function BapCustrUniUserNotice($userid,$notice_type='')
		{
			App::import('Model','Notice');
			$Notice=new Notice();
			if($notice_type!='')
			{
				$noticeCount=$Notice->find('count', array('conditions' => array('user_status' => 0, 'user_id' => $userid, 'notice_type' => $notice_type)));
			}
			else
			{
				$noticeCount=$Notice->find('count', array('conditions' => array('user_status' => 0, 'user_id' => $userid)));
			}
			return $noticeCount;
		}
		public function BapCustUniTranslate($from_lan, $to_lan, $text){
		$json = json_decode(file_get_contents('https://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=' . urlencode($text) . '&langpair=' . $from_lan . '|' . $to_lan));
		$translated_text = $json->responseData->translatedText;
	
		return $translated_text;
	}
/**
*	Function parts detail
*	Function Name: BapCustUniPartsDetail
*	Author By: Chittaranjan Sahoo
**/
	public function BapCustUniPartsDetail($requestid)
	{
		App::import('Model','RequestAccessory');
		$RequestAccessory=new RequestAccessory();
		$partsdetail=$RequestAccessory->find('first', array('conditions' => array('part_id' => $requestid)));
		return $partsdetail;
	}
/**
*	Function offer bid detail
*	Function Name: BapCustUniBidDetail
*	Author By: Chittaranjan Sahoo
**/
	public function BapCustUniBidDetail($bidid)
	{
		App::import('Model','BidOffer');
		$BidOffer=new BidOffer();
		$biddetail=$BidOffer->find('first', array('conditions' => array('bid_id' => $bidid)));
		return $biddetail;
	}
/**
*	Function offer bid detail
*	Function Name: BapCustUniBidQuestion
*	Author By: Chittaranjan Sahoo
**/
	public function BapCustUniBidQuestion($parentid)
	{
		App::import('Model','BidQuestion');
		$BidQuestion=new BidQuestion();
		$questionDetail=$BidQuestion->find('first', array('conditions' => array('qid'=> $parentid)));
		return $questionDetail;
	}
/**
*	Function Promotion detail
*	Function Name: BapCustUniPromotion
*	Author By: Chittaranjan Sahoo
**/
	public function BapCustUniPromotion($promotionid)
	{
		App::import('Model','PromotionPlan');
		$PromotionPlan=new PromotionPlan();
		$promotionDetail=$PromotionPlan->find('first', array('conditions' => array('promotion_id'=> $promotionid)));
		return $promotionDetail;
	}
	public function SalesRatingcout($adv_id)
		{
			App::import('Model','SalesRating');
			$SalesRating=new SalesRating();
			$salesRating=$SalesRating->find('all', array('conditions' => array('adv_id' => $adv_id), 'order' => array('rating_id' => 'desc')));
			$totrate=0;
			$avg_rate=0;
			if(!empty($salesRating))
			{
				
				foreach($salesRating as $salesRatingRes)
				{
					$totval=$salesRatingRes['SalesRating']['rating'];
					$totrate+=$totval;
				}
				$avg_rate=$totrate/count($salesRating);
			
			}
			return($avg_rate);
		}
		function BapCustUniLocationList($c_id){
			App::import('Model','MasterLocation'); 
			$MasterLocation = new MasterLocation(); 
			$locationList=array('' => CHOOSECITY);
			$locationList += $MasterLocation->find('list',array('conditions'=>array("MasterLocation.country_id" => $c_id), 'fields' => array('MasterLocation.location_id', 'MasterLocation.location_name')));
			
			return $locationList;
		}
		public function BapCustUniParkDetail($parkid)
		{
			App::import('Model', 'SalesPark');
			$SalesPark= new SalesPark();
			$res=$SalesPark->find('first', array('conditions' => array('park_id' => $parkid)));
			return($res);
		}
		public function BapCustUniParkParent($parentid)
		{
			App::import('Model', 'ParkQuestion');
			$ParkQuestion= new ParkQuestion();
			$res=$ParkQuestion->find('first', array('conditions' => array('qid' => $parentid)));
			return($res);
		}
		public function requestReplylist($parentid)
		{
			App::import('Model', 'RequestQuestion');
			$RequestQuestion= new RequestQuestion();
			$requestQustionRes=$RequestQuestion->find('all', array('conditions' => array('parent' => $parentid), 'order' => array('question_id' => 'desc')));	
			return ($requestQustionRes);
		}
		public function parentRequestDetail($parentid)
		{
			App::import('Model', 'RequestQuestion');
			$RequestQuestion= new RequestQuestion();
			$requestQustionRes=$RequestQuestion->find('first', array('conditions' => array('question_id' => $parentid), 'order' => array('question_id' => 'desc')));	
			return ($requestQustionRes);
		}
		public function parkReplylist($parentid)
		{
			App::import('Model', 'ParkQuestion');
			$RequestQuestion= new ParkQuestion();
			$requestQustionRes=$RequestQuestion->find('all', array('conditions' => array('parent' => $parentid), 'order' => array('qid' => 'desc')));	
			return ($requestQustionRes);
		}
		public function parentparkDetail($parentid)
		{
			App::import('Model', 'ParkQuestion');
			$RequestQuestion= new ParkQuestion();
			$requestQustionRes=$RequestQuestion->find('first', array('conditions' => array('qid' => $parentid), 'order' => array('qid' => 'desc')));	
			return ($requestQustionRes);
		}
		public function bidQuestionRes($bidid)
		{
			App::import('Model', 'BidQuestion');
			$BidQuestion= new BidQuestion();
			$BidQuestionRes=$BidQuestion->find('all', array('conditions' => array('bidid' => $bidid, 'parent' => 0), 'order' => array('qid' => 'desc')));	
			return ($BidQuestionRes);
		}
		public function bidReplylist($parentid)
		{
			App::import('Model', 'BidQuestion');
			$BidQuestion= new BidQuestion();
			$BidQuestionRes=$BidQuestion->find('all', array('conditions' => array('parent' => $parentid), 'order' => array('qid' => 'desc')));	
			return ($BidQuestionRes);
		}
		public function parentBidDetail($parentid)
		{
			App::import('Model', 'BidQuestion');
			$BidQuestion= new BidQuestion();
			$BidQuestionRes=$BidQuestion->find('first', array('conditions' => array('qid' => $parentid), 'order' => array('qid' => 'desc')));	
			return ($BidQuestionRes);
		}
		public function salesDetailReplylist($parentid)
		{
			App::import('Model', 'SalesQuestion');
			$SalesQuestion= new SalesQuestion();
			$SalesQuestionRes=$SalesQuestion->find('all', array('conditions' => array('parent' => $parentid), 'order' => array('question_id' => 'desc')));	
			return ($SalesQuestionRes);
		}
		public function parentSalesDetail($parentid)
		{
			App::import('Model', 'SalesQuestion');
			$SalesQuestion= new SalesQuestion();
			$SalesQuestionRes=$SalesQuestion->find('first', array('conditions' => array('question_id' => $parentid), 'order' => array('question_id' => 'desc')));	
			return ($SalesQuestionRes);
		}
		public function getPages($pageid=0)
		{
			App::import('Model', 'AdminPage');
			$pages= new AdminPage();
			$fetchdetail=$pages->find('first', array('conditions' => array('pid' => $pageid, 'is_active' => 1)));
			return ($fetchdetail);
		}
		public function bapCustUniSeoData($seofrom, $slugval=''){
			App::import('Model', 'SeoField');
			$SeoField= new SeoField();
			switch ($seofrom){
				case 'home' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 1)));
				break;
				case 'search' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 2)));
				break;
				case 'requestpart' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 3)));
				break;
				case 'truckparks' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 4)));
				break;
				case 'companyparts' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 5)));
				break;
				case 'requestpartfilter' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 8)));
				break;
				case 'sales1ststep' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 9)));
				break;
				case 'sales2ndstep' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 10)));
				break;
				case 'sales3rdstep' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 11)));
				break;
				case 'sales4thstep' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 12)));
				break;
				case 'addrequest' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 13)));
				break;
				case 'editrequest' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 14)));
				break;
				case 'logins' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 6)));
				break;
				case 'register' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 7)));
				break;
				case 'userdashboard' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 16)));
				break;
				case 'mypurchase' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 15)));
				break;
				case 'myquestion' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 17)));
				break;
				case 'accountsetting' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 18)));
				break;
				case 'saleslist' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 19)));
				break;
				case 'promotion' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 20)));
				break;
				case 'askquestion' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 21)));
				break;
				case 'commands' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 22)));
				break;
				case 'confirmed' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 23)));
				break;
				case 'shipped' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 24)));
				break;
				case 'completed' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 25)));
				break;
				case 'cancel' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 26)));
				break;
				case 'all' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 27)));
				break;
				case 'outofstock' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 28)));
				break;
				case 'deletead' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 29)));
				break;
				case 'promotead' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 30)));
				break;
				case 'requestlist' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 31)));
				break;
				case 'requestresolve' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 32)));
				break;
				case 'requestinactive' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 33)));
				break;
				case 'bidding' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 34)));
				break;
				case 'offer_losing' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 35)));
				break;
				case 'offer_active' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 36)));
				break;
				case 'offer_inactive' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 37)));
				break;
				case 'request_question' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 38)));
				break;
				case 'offer_winning' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 39)));
				break;
				case 'offertomyrequest' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 40)));
				break;
				case 'deliverydetail' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 41)));
				break;
				case 'partsorder' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 42)));
				break;
				case 'ask_seller' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 43)));
				break;
				case 'ask_seller_sent' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 44)));
				break;
				case 'my-question-reply' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 45)));
				break;
				case 'inbox' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 46)));
				break;
				case 'compose-message' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 47)));
				break;
				case 'sent-message' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 48)));
				break;
				case 'archive-posts' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 49)));
				break;
				case 'history-msg' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 50)));
				break;
				case 'rating-given-buyer' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 51)));
				break;
				case 'rating-given-seller' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 52)));
				break;
				case 'rating-receive-buyer' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 53)));
				break;
				case 'rating-receive-seller' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 54)));
				break;
				case 'my-rating' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 55)));
				break;
				case 'accounts-credits' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 56)));
				break;
				case 'history-accounts' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 57)));
				break;
				case 'upgrademem' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 58)));
				break;
				case 'upgradecard' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 59)));
				break;
				case 'upgradeconfirm_plan' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 60)));
				break;
				case 'saleswarranty' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 61)));
				break;
				case 'change_password' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 62)));
				break;
				case 'change_email' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 63)));
				break;
				case 'salesparktrunkpark' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 64)));
				break;
				case 'companypieces' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 65)));
				break;
				case 'questionrec' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 66)));
				break;
				case 'salesparksentquestion' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 67)));
				break;
				case 'success-stories-list' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 68)));
				break;
				case 'success-stories' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 69)));
				break;
				case 'my-profile' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 70)));
				break;
				case 'most-viewed' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 71)));
				break;
				case 'favourite' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 72)));
				break;
				case 'favourite-ads' :
				$seodata= $SeoField->find('first', array('conditions' => array('seo_id' => 73)));
				break;
				case 'salesdetail' :
				App::import('Model', 'PostAd');
				$PostAd= new PostAd();
				$seodata= $PostAd->find('first', array('conditions' => array('slug' => $slugval)));
				break;
				case 'requestdetail' :
				App::import('Model', 'RequestAccessory');
				$RequestAccessory= new RequestAccessory();
				$seodata= $RequestAccessory->find('first', array('conditions' => array('slug' => $slugval)));
				break;
				case 'parksdetail' :
				App::import('Model', 'SalesPark');
				$SalesPark= new SalesPark();
				$seodata= $SalesPark->find('first', array('conditions' => array('slug' => $slugval)));
				break;
				default:
				$seodata=array();
				break;
			}
			return($seodata);
		}
		public function getcatDetail($field='', $categorySlug=''){
			App::import('Model', 'ManageCategory');
			$ManageCategory= new ManageCategory();
			$catResult=$ManageCategory->find('first', array('conditions' => array($field => $categorySlug)));
			return ($catResult);
			
		}
		public function getBrandDetail($field='', $brandSlug=''){
			App::import('Model', 'ManageBrand');
			$ManageBrand= new ManageBrand();
			$ManageBrandRes=$ManageBrand->find('first', array('conditions' => array($field => $brandSlug)));	
			return ($ManageBrandRes);
		}
		/*public function chkPromotionAd($adv_id){
			App::import('Model', 'PromotionAd');
			$PromotionAd= new PromotionAd();
			$ManageBrandRes=$PromotionAd->find('first', array('conditions' => array($field => $brandSlug)));	
			return ($ManageBrandRes);
		}*/
		public function BapCustuniAlertResult($userid){
			App::import('Model', 'SubscribeAlert');
			$SubscribeAlert= new SubscribeAlert();
			$SubscribeAlertRes=$SubscribeAlert->find('first', array('conditions' => array('user_id' => $userid)));	
			return ($SubscribeAlertRes);
		}
		public function BapCustuniSalesQuestImg($qid){
			App::import('Model', 'SalesquestionImage');
			$SalesquestionImage= new SalesquestionImage();
			$SalesquestionImageRes=$SalesquestionImage->find('all', array('conditions' => array('qid' => $qid)));	
			return ($SalesquestionImageRes);
		}
		public function BapCustuniRequestQuestImg($qid){
			App::import('Model', 'RequestquestionImage');
			$RequestquestionImage= new RequestquestionImage();
			$RequestquestionImageRes=$RequestquestionImage->find('all', array('conditions' => array('qid' => $qid)));	
			return ($RequestquestionImageRes);
		}
		public function BapCustuniBidQuestImg($qid){
			App::import('Model', 'BidquestionImage');
			$BidquestionImage= new BidquestionImage();
			$BidquestionImageRes=$BidquestionImage->find('all', array('conditions' => array('qid' => $qid)));	
			return ($BidquestionImageRes);
		}
		public function BapCustuniparkQuestImg($qid){
			App::import('Model', 'ParksquestionImage');
			$ParksquestionImage= new ParksquestionImage();
			$ParkquestionImageRes=$ParksquestionImage->find('all', array('conditions' => array('qid' => $qid)));	
			return ($ParkquestionImageRes);
		}
}
	
?>	