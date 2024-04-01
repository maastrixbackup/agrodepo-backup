<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
<?php
	$metaTitle='';
	$metaDesc='';
	$metaKeword='';
	$canonicalLink='';
	$page_path='';
	//print_r($this->request->params);
	//exit();
	if($this->request->params['controller']=='Homes'){
		$dataDetail=$this->Custom->bapCustUniSeoData('home');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);

			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url;
		}else if($this->request->params['controller']=='Search'){
			if($this->request->params['action']=='index'){
				if(isset($this->request->params['pass'][0])){$categorySlug=$this->request->params['pass'][0];}
				else{$categorySlug='';}
				if(isset($this->request->params['pass'][1])){$brandSlug=$this->request->params['pass'][1];}else{$brandSlug='';}
			//=================================
				if($categorySlug!='' && $brandSlug!=''){
					$metaTitle='';
					if(!is_numeric($categorySlug)){
						$catResult=$this->Custom->getcatDetail('slug',$categorySlug);
					}else{
						$catResult=$this->Custom->getcatDetail('slug',$categorySlug);
						if(count($catResult)<=0){
							$catResult=$this->Custom->getcatDetail('category_id',$categorySlug);
						}
					}
					if(!is_numeric($brandSlug)){
						$brandResult=$this->Custom->getBrandDetail('slug',$brandSlug);
					}else{
						$brandResult=$this->Custom->getBrandDetail('slug',$brandSlug);
						if(count($brandResult)<=0){
							$brandResult=$this->Custom->getBrandDetail('brand_id',$brandSlug);
						}
					}
					//print_r($catResult);
					//print_r($brandResult);
					//exit;
					if(count($catResult)>0){
					$metaTitle.=stripslashes($catResult['Managecategory']['category_name']);
					//$metaDesc.=stripslashes($catResult['Managecategory']['category_name']);
					$metaDesc.=stripslashes($catResult['Managecategory']['meta_description']);
					$metaKeword.=stripslashes($catResult['Managecategory']['meta_keywords']);
					}
					if(count($brandResult)>0){
					$metaTitle.=" - ".stripslashes($brandResult['ManageBrand']['brand_name']);
					//$metaDesc.=" - ".stripslashes($brandResult['ManageBrand']['brand_name']);
					$metaDesc.=stripslashes($brandResult['ManageBrand']['meta_description']);
					$metaKeword.=stripslashes($brandResult['ManageBrand']['meta_keywords']);
					}
				}else if($categorySlug!='' && $brandSlug==''){
					$metaTitle='';
					if(!is_numeric($categorySlug)){
						$catResult=$this->Custom->getcatDetail('slug',$categorySlug);
					}else{
						$catResult=$this->Custom->getcatDetail('category_id',$categorySlug);
					}

					if(count($catResult)>0){
					$metaTitle.=stripslashes($catResult['Managecategory']['category_name']);
					//$metaDesc.=stripslashes($catResult['Managecategory']['category_name']);
					$metaDesc.=stripslashes($catResult['Managecategory']['meta_description']);
					$metaKeword.=stripslashes($catResult['Managecategory']['meta_keywords']);
					}else{
						if(!is_numeric($categorySlug)){
						$brandResult=$this->Custom->getBrandDetail('slug',$categorySlug);
						}else{
							$brandResult=$this->Custom->getBrandDetail('brand_id',$categorySlug);
						}
						if(count($brandResult)>0){
						$metaTitle.=stripslashes($brandResult['ManageBrand']['brand_name']);
						//$metaDesc.=stripslashes($brandResult['ManageBrand']['brand_name']);
						$metaDesc.=stripslashes($brandResult['ManageBrand']['meta_description']);
					    $metaKeword.=stripslashes($brandResult['ManageBrand']['meta_keywords']);
						}
					}

				}else{

				$dataDetail=$this->Custom->bapCustUniSeoData('search');
					if(!empty($dataDetail)){
					$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
					$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
					$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
					}

				}
				if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
					$canonicalLink=1;
				}
				$page_path=$base_url.'Search';
			}//Search index page
			else if($this->request->params['action']=='category'){

				//category seo start here
				if(isset($this->request->params['pass'][0])){$categorySlug=$this->request->params['pass'][0];}
				else{$categorySlug='';}
				if(isset($this->request->params['pass'][1])){$subCatSlug=$this->request->params['pass'][1];}else{$subCatSlug='';}

				if($categorySlug!='' && $subCatSlug!=''){
					if(!is_numeric($subCatSlug)){
						$catResult=$this->Custom->getcatDetail('slug',$subCatSlug);
					}else{
						$catResult=$this->Custom->getcatDetail('slug',$subCatSlug);
						if(count($catResult)<=0){
							$catResult=$this->Custom->getcatDetail('category_id',$subCatSlug);
						}
					}

				}else if($categorySlug!='' && $subCatSlug==''){
					if(!is_numeric($categorySlug)){
						$catResult=$this->Custom->getcatDetail('slug',$categorySlug);
					}else{
						$catResult=$this->Custom->getcatDetail('slug',$categorySlug);
						if(count($catResult)<=0){
							$catResult=$this->Custom->getcatDetail('category_id',$categorySlug);
						}
					}
				}
				if(count($catResult)>0){
					//echo $catResult['Managecategory']['category_id'];
				$metaTitle.=stripslashes($catResult['Managecategory']['category_name']);
				//$metaDesc.=stripslashes($catResult['Managecategory']['category_name']);
				$metaDesc.=stripslashes($catResult['Managecategory']['meta_description']);
				$metaKeword.=stripslashes($catResult['Managecategory']['meta_keywords']);
				}
				//print_r($this->request->params);exit();
				if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
					$paramsVal=$this->request->params['named'];
					if(count($paramsVal)>1){
						$canonicalLink=1;
					}
				}
				$page_path=$base_url.'category';
				//Category Seo end here

			}// Category page
			else if($this->request->params['action']=='brand'){

				//Brand seo start here========
				if(isset($this->request->params['pass'][0])){$brandSlug=$this->request->params['pass'][0];}
				else{$brandSlug='';}
				if(isset($this->request->params['pass'][1])){$subbrandSlug=$this->request->params['pass'][1];}else{$subbrandSlug='';}
				//=================================
					if($brandSlug!='' && $subbrandSlug!=''){

						if(!is_numeric($subbrandSlug)){
							$brandResult=$this->Custom->getBrandDetail('slug',$subbrandSlug);
						}else{
							$brandResult=$this->Custom->getBrandDetail('slug',$subbrandSlug);
							if(count($brandResult)<=0){
								$brandResult=$this->Custom->getBrandDetail('brand_id',$subbrandSlug);
							}
						}

					}else if($brandSlug!='' && $subbrandSlug==''){
						if(!is_numeric($brandSlug)){
							$brandResult=$this->Custom->getBrandDetail('slug',$brandSlug);
						}else{
							$brandResult=$this->Custom->getBrandDetail('slug',$brandSlug);
							if(count($brandResult)<=0){
								$brandResult=$this->Custom->getBrandDetail('brand_id',$brandSlug);
							}
						}

					}
					if(count($brandResult)>0){
					$metaTitle=stripslashes($brandResult['ManageBrand']['brand_name']);
					//$metaDesc.=" - ".stripslashes($brandResult['ManageBrand']['brand_name']);
					$metaDesc=stripslashes($brandResult['ManageBrand']['meta_description']);
					$metaKeword=stripslashes($brandResult['ManageBrand']['meta_keywords']);
					}
					//print_r($this->request->params);exit();
					if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
						if(count($this->request->params['named'])>1){
							$canonicalLink=1;
						}
					}
					if(count($this->request->params['named'])>1){
						$page_path=$base_url.'brand';
					}
				//Brand Seo End Here===========

			}//brnad page

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('request-parts',$this->request->params['pass']) && !isset($this->request->params['pass'][1]))){
			//echo 1; exit;
		$dataDetail=$this->Custom->bapCustUniSeoData('requestpart');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/request-parts';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('truck-parks',$this->request->params['pass']))){
			//echo 1; exit;
		$dataDetail=$this->Custom->bapCustUniSeoData('truckparks');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/truck-parks';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('company-parts',$this->request->params['pass']))){
			//echo 1; exit;
		$dataDetail=$this->Custom->bapCustUniSeoData('companyparts');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/company-parts';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('sales-details',$this->request->params['pass']))){
			//echo 1; exit;
			$slugval=$this->request->params['pass'][1];
			$dataDetail=$this->Custom->bapCustUniSeoData('salesdetail', $slugval);
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['PostAd']['meta_title']);
			$metaDesc=stripslashes($dataDetail['PostAd']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['PostAd']['meta_keywords']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/sales-details/'.$slugval;
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('request-parts',$this->request->params['pass']) && isset($this->request->params['pass'][1]))){
			//echo 1; exit;
			$slugval=$this->request->params['pass'][1];
			$dataDetail=$this->Custom->bapCustUniSeoData('requestdetail', $slugval);
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['RequestAccessory']['name_piece']);
			$metaDesc=stripslashes($dataDetail['RequestAccessory']['description']);
			$metaKeword=stripslashes($dataDetail['RequestAccessory']['name_piece']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/request-parts/'.$slugval;
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('parks',$this->request->params['pass']) && isset($this->request->params['pass'][1]))){
			//echo 1; exit;
			$slugval=$this->request->params['pass'][1];
			$dataDetail=$this->Custom->bapCustUniSeoData('parksdetail', $slugval);
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SalesPark']['park_name']);
			$metaDesc=stripslashes($dataDetail['SalesPark']['description']);
			$metaKeword=stripslashes($dataDetail['SalesPark']['park_name']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/parks/'.$slugval;
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('request-parts-active',$this->request->params['pass']) && !isset($this->request->params['pass'][1]))){
			//echo 1; exit;
		$dataDetail=$this->Custom->bapCustUniSeoData('requestpartfilter');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/request-parts-active';
		}else if($this->request->params['controller']=='PostAds' && $this->request->params['action']=='add'){
		$dataDetail=$this->Custom->bapCustUniSeoData('sales1ststep');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			/*if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'PostAds/add';*/
		}else if($this->request->params['controller']=='PostAds' && $this->request->params['action']=='productdescription'){
		$dataDetail=$this->Custom->bapCustUniSeoData('sales2ndstep');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			/*if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'PostAds/productdescription';*/
		}else if($this->request->params['controller']=='PostAds' && $this->request->params['action']=='ready'){
		$dataDetail=$this->Custom->bapCustUniSeoData('sales3rdstep');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='PostAds' && $this->request->params['action']=='shipdetail'){
		$dataDetail=$this->Custom->bapCustUniSeoData('sales4thstep');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='add'){
		$dataDetail=$this->Custom->bapCustUniSeoData('addrequest');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='edit'){
		$dataDetail=$this->Custom->bapCustUniSeoData('editrequest');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
		}else if($this->request->params['controller']=='Logins' && $this->request->params['action']=='login'){
		$dataDetail=$this->Custom->bapCustUniSeoData('logins');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
		}else if($this->request->params['controller']=='MasterUsers' && $this->request->params['action']=='add'){
		$dataDetail=$this->Custom->bapCustUniSeoData('register');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('my-purchases',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('mypurchase');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/my-purchases/';
		}else if($this->request->params['controller']=='Logins' && $this->request->params['action']=='user_dashboard'){
		$dataDetail=$this->Custom->bapCustUniSeoData('userdashboard');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
		}else if($this->request->params['controller']=='MasterUsers' && $this->request->params['action']=='account_setting'){
		$dataDetail=$this->Custom->bapCustUniSeoData('accountsetting');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
		}else if($this->request->params['controller']=='PostAds' && $this->request->params['action']=='index'){
			$dataDetail=$this->Custom->bapCustUniSeoData('saleslist');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'PostAds/';
		}else if($this->request->params['controller']=='PostAds' && $this->request->params['action']=='promotion'){
			$dataDetail=$this->Custom->bapCustUniSeoData('promotion');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'PostAds/';
		}else if($this->request->params['controller']=='PostAds' && $this->request->params['action']=='deletead'){
			$dataDetail=$this->Custom->bapCustUniSeoData('deletead');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'PostAds/deletead';
		}else if($this->request->params['controller']=='PostAds' && $this->request->params['action']=='promotead'){
			$dataDetail=$this->Custom->bapCustUniSeoData('promotead');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'PostAds/promotead';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='index'){
			$dataDetail=$this->Custom->bapCustUniSeoData('requestlist');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='resolve'){
			$dataDetail=$this->Custom->bapCustUniSeoData('requestresolve');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/resolve';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='inactive'){
			$dataDetail=$this->Custom->bapCustUniSeoData('requestinactive');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/inactive';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='bidding'){
			$dataDetail=$this->Custom->bapCustUniSeoData('bidding');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/bidding';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='offer_losing'){
			$dataDetail=$this->Custom->bapCustUniSeoData('offer_losing');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/offer_losing';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='offer_active'){
			$dataDetail=$this->Custom->bapCustUniSeoData('offer_active');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/offer_active';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='offer_inactive'){
			$dataDetail=$this->Custom->bapCustUniSeoData('offer_inactive');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/offer_inactive';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='request_question'){
			$dataDetail=$this->Custom->bapCustUniSeoData('request_question');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/request_question';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='offer_winning'){
			$dataDetail=$this->Custom->bapCustUniSeoData('offer_winning');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/offer_winning';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='offertomyrequest'){
			$dataDetail=$this->Custom->bapCustUniSeoData('offertomyrequest');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/offertomyrequest';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='deliverydetail'){
			$dataDetail=$this->Custom->bapCustUniSeoData('deliverydetail');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/deliverydetail';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='partsorder'){
			$dataDetail=$this->Custom->bapCustUniSeoData('partsorder');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/partsorder';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='ask_seller'){
			$dataDetail=$this->Custom->bapCustUniSeoData('ask_seller');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/ask_seller';
		}else if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='ask_seller_sent'){
			$dataDetail=$this->Custom->bapCustUniSeoData('ask_seller_sent');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'RequestParts/ask_seller';
		}else if($this->request->params['controller']=='UpgradeMemberships' && $this->request->params['action']=='index'){
			$dataDetail=$this->Custom->bapCustUniSeoData('upgrademem');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'UpgradeMemberships/index';
		}else if($this->request->params['controller']=='UpgradeMemberships' && $this->request->params['action']=='card'){
			$dataDetail=$this->Custom->bapCustUniSeoData('upgradecard');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'UpgradeMemberships/card';
		}else if($this->request->params['controller']=='UpgradeMemberships' && $this->request->params['action']=='confirm_plan'){
			$dataDetail=$this->Custom->bapCustUniSeoData('upgradeconfirm_plan');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'UpgradeMemberships/card';
		}else if($this->request->params['controller']=='SalesWarranties' && $this->request->params['action']=='index'){
			$dataDetail=$this->Custom->bapCustUniSeoData('saleswarranty');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='MasterUsers' && $this->request->params['action']=='change_password'){
			$dataDetail=$this->Custom->bapCustUniSeoData('change_password');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='MasterUsers' && $this->request->params['action']=='change_email'){
			$dataDetail=$this->Custom->bapCustUniSeoData('change_email');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='SalesParks' && $this->request->params['action']=='index'){
			$dataDetail=$this->Custom->bapCustUniSeoData('salesparktrunkpark');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='SalesParks' && $this->request->params['action']=='companypieces'){
			$dataDetail=$this->Custom->bapCustUniSeoData('companypieces');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='SalesParks' && $this->request->params['action']=='questionrec'){
			$dataDetail=$this->Custom->bapCustUniSeoData('questionrec');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='SalesParks' && $this->request->params['action']=='sentquestion'){
			$dataDetail=$this->Custom->bapCustUniSeoData('salesparksentquestion');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('my-question',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('myquestion');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/my-question/';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('inbox',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('inbox');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/my-question/';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('compose-message',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('compose-message');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('sent-message',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('sent-message');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('archive-posts',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('archive-posts');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('history-msg',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('history-msg');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('rating-given-buyer',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('rating-given-buyer');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('rating-given-seller',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('rating-given-seller');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('rating-receive-buyer',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('rating-receive-buyer');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('rating-receive-seller',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('rating-receive-seller');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('my-rating',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('my-rating');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('accounts-credits',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('accounts-credits');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('history-accounts',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('history-accounts');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('ask-question',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('askquestion');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/ask-question/';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('commands',$this->request->params['pass']) && !isset($this->request->params['pass'][1]))){
			$dataDetail=$this->Custom->bapCustUniSeoData('commands');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/commands/';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('commands',$this->request->params['pass']) && (isset($this->request->params['pass'][1])&& $this->request->params['pass'][1]=='confirmed'))){
			$dataDetail=$this->Custom->bapCustUniSeoData('confirmed');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/commands/confirmed';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('commands',$this->request->params['pass']) && (isset($this->request->params['pass'][1])&& $this->request->params['pass'][1]=='shipped'))){
			$dataDetail=$this->Custom->bapCustUniSeoData('shipped');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/commands/shipped';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('commands',$this->request->params['pass']) && (isset($this->request->params['pass'][1])&& $this->request->params['pass'][1]=='completed'))){
			$dataDetail=$this->Custom->bapCustUniSeoData('completed');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/commands/completed';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('commands',$this->request->params['pass']) && (isset($this->request->params['pass'][1])&& $this->request->params['pass'][1]=='cancel'))){
			$dataDetail=$this->Custom->bapCustUniSeoData('cancel');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/commands/cancel';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('commands',$this->request->params['pass']) && (isset($this->request->params['pass'][1])&& $this->request->params['pass'][1]=='all'))){
			$dataDetail=$this->Custom->bapCustUniSeoData('all');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/commands/all';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('out-of-stock',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('outofstock');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}
			if(isset($this->request->params['named'])&& !empty($this->request->params['named'])){
				$canonicalLink=1;
			}
			$page_path=$base_url.'pages/commands/out-of-stock';
		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('success-stories-list',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('success-stories-list');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('success-stories',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('success-stories');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('my-profile',$this->request->params['pass']))){
			$dataDetail=$this->Custom->bapCustUniSeoData('my-profile');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('statistics-views',$this->request->params['pass']) && (isset($this->request->params['pass'][1]) && $this->request->params['pass'][1]=='most-viewed'))){
			$dataDetail=$this->Custom->bapCustUniSeoData('most-viewed');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('statistics-views',$this->request->params['pass']) && (isset($this->request->params['pass'][1]) && $this->request->params['pass'][1]=='favourite'))){
			$dataDetail=$this->Custom->bapCustUniSeoData('favourite');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}else if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('statistics-views',$this->request->params['pass']) && (isset($this->request->params['pass'][1]) && $this->request->params['pass'][1]=='favourite-ads'))){
			$dataDetail=$this->Custom->bapCustUniSeoData('favourite-ads');
			if(!empty($dataDetail)){
			$metaTitle=stripslashes($dataDetail['SeoField']['meta_title']);
			$metaDesc=stripslashes($dataDetail['SeoField']['meta_desc']);
			$metaKeword=stripslashes($dataDetail['SeoField']['meta_keyword']);
			}

		}
		//-------------------------------------------
		//echo $metaTitle."<br>";
		//echo $metaDesc."<br>";
		//exit();
		if($metaTitle!=''){
		?>
    <title><?php echo $metaTitle; ?></title>
    <?php }else{?>
    <title><?php echo $title_for_layout; ?></title>
    <?php }?>
    <?php if($metaDesc!=''){?>
	<meta name="description" content="<?php echo $metaDesc; ?>">
    <?php }?>
     <?php if($metaKeword!=''){?>
    <meta name="keywords" content="<?php echo $metaKeword; ?>">
    <?php }?>
    <?php if($canonicalLink==1){
		 ?>
         <meta name="robots" content="noindex, nofollow">
		<link rel="canonical" href="<?php echo $page_path;?>" />
		<?php }?>
   <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->webroot ?>css/main.css" rel="stylesheet">
    <link href="<?php echo $this->webroot ?>css/bootstrap.css" rel="stylesheet">



    <?php if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('sales-details',$this->request->params['pass']) || in_array('torate',$this->request->params['pass']) || in_array('buyer-torate',$this->request->params['pass']) || in_array('parks',$this->request->params['pass']))){?>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="<?php echo $base_url;?>css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <?php }?>
     <?php echo $this->element('theme-css');?>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <link rel="shortcut icon" type="images/png" href="<?php echo $this->webroot ?>images/favicon.ico"/>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


	<?php //pr($this->request->params);?>

     <?php if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' && (in_array('sales-details',$this->request->params['pass']) || in_array('torate',$this->request->params['pass']) || in_array('buyer-torate',$this->request->params['pass']) || in_array('parks',$this->request->params['pass']))){?>
      <script src="<?php echo $this->webroot ?>js/jquery.min.js"></script>
      <script src="<?php echo $base_url;?>js/star-rating.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo $this->webroot ?>js/cloud_zoom.js"></script>
        <script type="text/javascript">
		jQuery(document).ready(function () {
			<?php if(in_array('parks',$this->request->params['pass'])){?>
			 /*
			Parks rate start
			*/
			$("#prksrate").rating({
				starCaptions: function(val) {
					//document.getElementById('input-21f').value=val;
					//alert($("#input-21f").val(val));
					if (val <5) {
						return val;
					} else {
						return '5';
					}
				},
				starCaptionClasses: function(val) {

					if (val < 3) {
						return 'label label-danger';
					} else {
						return 'label label-success';
					}
				},
				hoverOnClear: false
			});
			$('#prksrate').on('rating.change', function() {
				var ratingval=$('#prksrate').val();
				var rating_from=$('#rating_from').val();
				var park_id=$('#park_id').val();
				//alert(ratingval);
				$("#rating_loader").html('Processing...');
				$.ajax(
				{
					type: 'POST',
					url: '<?php echo $base_url; ?>Search/parksRating',
					data: 'park_id='+park_id+'&ratingval='+ratingval+'&rating_from='+rating_from,
					success: function(data) {
						$("#rating_loader").html('');
						//alert(data);
						if(data==1)
						{
							alert('Rating successfully to this Parks');
							$.ajax(
							{
								type: 'POST',
								url: '<?php echo $base_url; ?>Search/parksRatingval',
								data: 'park_id='+park_id+'&ratingval='+ratingval+'&rating_from='+rating_from,
								success: function(data) {
									$("#ratepoint").html(data);
								}
							});

						}
						else if(data==2)
						{
							alert('failed failed');
						}
						else if(data==3)
						{
							alert('Rating successfully to this Parks');
							$.ajax(
							{
								type: 'POST',
								url: '<?php echo $base_url; ?>Search/parksRatingval',
								data: 'park_id='+park_id+'&ratingval='+ratingval+'&rating_from='+rating_from,
								success: function(data) {
									$("#ratepoint").html(data);
								}
							});
						}
						else if(data==4)
						{
							alert('First login to rating this Parks');
						}

					}
				});
			});
			$(".ratinguser .clear-rating").css("display","none");
			$(".ratinguser .caption").css("display","none");
			/*
			Parks rate End
			*/
			<?php }?>
			<?php if(in_array('torate',$this->request->params['pass']) || in_array('buyer-torate',$this->request->params['pass'])){?>
			 /*
			Product as Described rate start
			*/
			$("#productdescribed").rating({
				starCaptions: function(val) {
					//document.getElementById('input-21f').value=val;
					//alert($("#input-21f").val(val));
					if (val <5) {
						return val;
					} else {
						return '5';
					}
				},
				starCaptionClasses: function(val) {

					if (val < 3) {
						return 'label label-danger';
					} else {
						return 'label label-success';
					}
				},
				hoverOnClear: false
			});
			$('#productdescribed').on('rating.change', function() {
				var ratingval=$('#productdescribed').val();
				$('#productdescribedval').val(ratingval);
			});
			/*
			Product as Described rate End
			*/
			 /*
			communication rate start
			*/
			$("#communication").rating({
				starCaptions: function(val) {
					//document.getElementById('input-21f').value=val;
					//alert($("#input-21f").val(val));
					if (val <5) {
						return val;
					} else {
						return '5';
					}
				},
				starCaptionClasses: function(val) {

					if (val < 3) {
						return 'label label-danger';
					} else {
						return 'label label-success';
					}
				},
				hoverOnClear: false
			});
			$('#communication').on('rating.change', function() {
				var ratingval=$('#communication').val();
				$('#communicationval').val(ratingval);
			});
			/*
			communication rate start
			*/
			/*
			deliverytime rate start
			*/
			$("#deliverytime").rating({
				starCaptions: function(val) {
					//document.getElementById('input-21f').value=val;
					//alert($("#input-21f").val(val));
					if (val <5) {
						return val;
					} else {
						return '5';
					}
				},
				starCaptionClasses: function(val) {

					if (val < 3) {
						return 'label label-danger';
					} else {
						return 'label label-success';
					}
				},
				hoverOnClear: false
			});
			$('#deliverytime').on('rating.change', function() {
				var ratingval=$('#deliverytime').val();
				$('#deliverytimeval').val(ratingval);
			});
			/*
			deliverytime rate start
			*/
			/*
			cost_of_transport rate start
			*/
			$("#cost_of_transport").rating({
				starCaptions: function(val) {
					//document.getElementById('input-21f').value=val;
					//alert($("#input-21f").val(val));
					if (val <5) {
						return val;
					} else {
						return '5';
					}
				},
				starCaptionClasses: function(val) {

					if (val < 3) {
						return 'label label-danger';
					} else {
						return 'label label-success';
					}
				},
				hoverOnClear: false
			});
			$('#cost_of_transport').on('rating.change', function() {
				var ratingval=$('#cost_of_transport').val();
				$('#cost_of_transportval').val(ratingval);
			});
			/*
			cost_of_transport rate start
			*/
			$(".ratinguser .clear-rating").css("display","none");
			$(".ratinguser .caption").css("display","none");
			<?php }?>
        $("#input-21f").rating({
            starCaptions: function(val) {
				//document.getElementById('input-21f').value=val;
				//alert($("#input-21f").val(val));
                if (val <5) {
                    return val;
                } else {
                    return '5';
                }
            },
            starCaptionClasses: function(val) {

                if (val < 3) {
                    return 'label label-danger';
                } else {
                    return 'label label-success';
                }
            },
            hoverOnClear: false
        });

        $('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'lg'
           });

        $('#btn-rating-input').on('click', function() {
            var $a = self.$element.closest('.star-rating');
            var chk = !$a.hasClass('rating-disabled');
            $('#rating-input').rating('refresh', {showClear:!chk, disabled:chk});
        });


        $('.btn-danger').on('click', function() {
            $("#kartik").rating('destroy');
        });

        $('.btn-success').on('click', function() {
            $("#kartik").rating('create');
        });

        $('#input-21f').on('rating.change', function() {
            var ratingval=$('#input-21f').val();
			var advid=$("#rateadvid").val();
			$("#rating_loader").html('Processing...');
			$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>Search/salesRating',
				data: 'advid='+advid+'&ratingval='+ratingval,
				success: function(data) {
					$("#rating_loader").html('');
					//alert(data);
					if(data==1)
					{
						alert('Rating successfully to this Sales');
						$.ajax(
						{
							type: 'POST',
							url: '<?php echo $base_url; ?>Search/Ratingval',
							data: 'advid='+advid+'&ratingval='+ratingval,
							success: function(data) {
								$("#ratepoint").html(data);
							}
						});

					}
					else if(data==2)
					{
						alert('failed failed');
					}
					else if(data==3)
					{
						alert('Rating successfully to this Sales');
						$.ajax(
						{
							type: 'POST',
							url: '<?php echo $base_url; ?>Search/Ratingval',
							data: 'advid='+advid+'&ratingval='+ratingval,
							success: function(data) {
								$("#ratepoint").html(data);
							}
						});
					}
					else if(data==4)
					{
						alert('First login to rating this sales');
					}

				}
			});
        });

        $('.clear-rating').on('click',function() {
            var ratingval=$('#input-21f').val();
			var advid=$("#rateadvid").val();
			$("#rating_loader").html('Processing...');
			$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>Search/salesRating',
				data: 'advid='+advid+'&ratingval='+ratingval,
				success: function(data) {
					$("#rating_loader").html('');
					//alert(data);
					if(data==1)
					{
						alert('Rating successfully to this Sales');
						$.ajax(
						{
							type: 'POST',
							url: '<?php echo $base_url; ?>Search/Ratingval',
							data: 'advid='+advid+'&ratingval='+ratingval,
							success: function(data) {
								$("#ratepoint").html(data);
							}
						});

					}
					else if(data==2)
					{
						alert('failed failed');
					}
					else if(data==3)
					{
						alert('Rating cleared successfully');
						$.ajax(
						{
							type: 'POST',
							url: '<?php echo $base_url; ?>Search/Ratingval',
							data: 'advid='+advid+'&ratingval='+ratingval,
							success: function(data) {
								$("#ratepoint").html(data);
							}
						});
					}
					else if(data==4)
					{
						alert('First login to rating this sales');
					}

				}
			});
        });
        $('.rb-rating').rating({'showCaption':true, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
    });


                    CloudZoom.quickStart();
                </script>
 <?php }else{?>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

 <?php }?>
<!-- Code for Auto Complete-->
	 <script>
  $(function() {
  	/*
  	* Post new Ad auto complete =======
  	*/
  		 $("#PostAdCategoryBrand").keyup(function(e) {
        		if (e.keyCode == 13) {  // enter
			        if ($(".keywrd_pop_top2").is(":visible")) {
			            selectOption();
			        } else {
			            $(".keywrd_pop_top2").show();
			        }
			    }
        		else if (e.keyCode == 38) { // up
			        var selected = $(".selected");
			        $(".keywrd_pop_top2 li").removeClass("selected");
			        if (selected.prev().length == 0) {
			            selected.siblings().last().addClass("selected");
			        } else {
			            selected.prev().addClass("selected");
			        }
			        selected.prev().focus();
			        $("#PostAdCategoryBrand").val(selected.prev().text());
			    }
			    else if (e.keyCode == 40) { // down
			        var selected = $(".selected");//alert(selected);
			        $(".keywrd_pop_top2 li").removeClass("selected");
			        if (selected.next().length == 0) {
			            selected.siblings().first().addClass("selected");
			        } else {
			            selected.next().addClass("selected");
			        }
			        selected.next().focus();
			        $("#PostAdCategoryBrand").val(selected.next().text());
			    }
			    else
			    {
			    	var keyTag = $("#PostAdCategoryBrand").val();
	        		if (keyTag!="") {
			            $(".keywrd_pop_top2").show();
			            $(".keywrd_pop").hide();
			            $.ajax(
			            {
			                type: 'POST',
			                url: '<?php echo $base_url;?>PostAds/autocomplete',
			                data: 'tag='+keyTag,
			                success: function(data) {
			                    if(data)
			                    {
			                    	$(".keywrd_pop_top2").html(data);
			                    }

			                }
			            });
			        }
			        else
			        {
			            $(".keywrd_pop_top2").hide();
			        }

			    }
        	});
$("body").click(function() {
					$("#topSrc2").hide(100);
				});
  	/*
  	* End Post New Ad
  	*/
   $("#postkeywords").keyup(function(e) {
        		if (e.keyCode == 13) {  // enter
			        if ($(".keywrd_pop_top").is(":visible")) {
			            selectOption();
			        } else {
			            $(".keywrd_pop_top").show();
			        }
			    }
        		else if (e.keyCode == 38) { // up
			        var selected = $(".selected");
			        $(".keywrd_pop_top li").removeClass("selected");
			        if (selected.prev().length == 0) {
			            selected.siblings().last().addClass("selected");
			        } else {
			            selected.prev().addClass("selected");
			        }
			        selected.prev().focus();
			        $("#postkeywords").val(selected.prev().text());
			    }
			    else if (e.keyCode == 40) { // down
			        var selected = $(".selected");//alert(selected);
			        $(".keywrd_pop_top li").removeClass("selected");
			        if (selected.next().length == 0) {
			            selected.siblings().first().addClass("selected");
			        } else {
			            selected.next().addClass("selected");
			        }
			        selected.next().focus();
			        $("#postkeywords").val(selected.next().text());
			    }
			    else
			    {
			    	var keyTag = $("#postkeywords").val();
	        		if (keyTag!="") {
			            $(".keywrd_pop_top").show();
			            $(".keywrd_pop").hide();
			            $.ajax(
			            {
			                type: 'POST',
			                url: '<?php echo $base_url;?>Homes/autocomplete',
			                data: 'tag='+keyTag,
			                success: function(data) {
			                    if(data)
			                    {
			                    	$(".keywrd_pop_top").html(data);
			                    }

			                }
			            });
			        }
			        else
			        {
			            $(".keywrd_pop_top").hide();
			        }

			    }
        	});
$("body").click(function() {
					$("#topSrc").hide(100);
				});
/*
* JS for POST ad AutoComplete
*/
	 $("#searchtxt").keyup(function(e) {
        		if (e.keyCode == 13) {  // enter
			        if ($(".keywrd_pop_top1").is(":visible")) {
			            selectOptionTwo();
			        } else {
			            $(".keywrd_pop_top1").show();
			        }
			    }
        		else if (e.keyCode == 38) { // up
			        var selected = $(".selected");
			        $(".keywrd_pop_top1 li").removeClass("selected");
			        if (selected.prev().length == 0) {
			            selected.siblings().last().addClass("selected");
			        } else {
			            selected.prev().addClass("selected");
			        }
			        selected.prev().focus();
			        $("#searchtxt").val(selected.prev().text());
			    }
			    else if (e.keyCode == 40) { // down
			        var selected = $(".selected");//alert(selected);
			        $(".keywrd_pop_top1 li").removeClass("selected");
			        if (selected.next().length == 0) {
			            selected.siblings().first().addClass("selected");
			        } else {
			            selected.next().addClass("selected");
			        }
			        selected.next().focus();
			        $("#searchtxt").val(selected.next().text());
			    }
			    else
			    {
			    	var keyTag = $("#searchtxt").val();
			    	var UserID = $("#sessuserid").val();
	        		if (keyTag!="") {
			            $(".keywrd_pop_top1").show();
			            $(".keywrd_pop1").hide();
			            $.ajax(
			            {
			                type: 'POST',
			                url: '<?php echo $base_url;?>Homes/autocomplete',
			                data: 'tag='+keyTag+'&responseFrom=postad'+'&UserID='+UserID,
			                success: function(data) {
			                    if(data)
			                    {
			                    	$(".keywrd_pop_top1").html(data);
			                    }

			                }
			            });
			        }
			        else
			        {
			            $(".keywrd_pop_top1").hide();
			        }

			    }
        	});
$("body").click(function() {
					$("#topSrc1").hide(100);
				});
/*
* End SJ auto complete
*/
  });
function selectOption() {
			    $("#postkeywords").focus();
			    $(".keywrd_pop_top").hide();
			}
			function selectOptionTwo() {
			    $("#searchtxt").focus();
			    $(".keywrd_pop_top1").hide();
			}

  </script>

	<!-- Code for Auto Complete End-->
    <script type="text/javascript">
	function saveView(advid,advUrl)
	{
		if(advid!='')
		{
			$.ajax(
				{
					type: 'POST',
					url: '<?php echo $base_url; ?>Search/viewsave',
					data: 'advid='+advid,
					success: function(data) {
						if(data==1)
						{
							window.location=advUrl;
						}
						else
						{
							alert("wrong Enter");
						}
					}
				});
		}
	}


	</script>
<?php if(($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='request_response')){?>
	 <script src="<?php echo $this->webroot; ?>SpryAssets/SpryAccordion.js" type="text/javascript"></script>
      <script src="<?php echo $this->webroot; ?>js/jquery.dropdown.js"></script>
	<?php }?>

     <?php if($this->request->params['controller']!='Search' && $this->request->params['controller']!='Logins' && $this->request->params['controller']!='PostAds' && $this->request->params['controller']!='RequestParts'  && $this->request->params['controller']!='pages'){
?>
    <script src="<?php echo $this->webroot ?>js/jquery.dropdown.js"></script>
    <script src="<?php echo $this->webroot ?>SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
    <script src="<?php echo $this->webroot ?>SpryAssets/SpryTabbedPanels_left.js" type="text/javascript">

    </script>

    <script>
        $(document).ready(function(){
        var lang = $("#languages").width(130).dropdown({
            //change:function(value){alert(value)}
        });
        lang.select(8);

        var emot = $("#emoticons").width(130).dropdown({
            //click:function(value){alert(value)}
        });
        });
    </script>

	<script type="text/javascript" src="<?php echo $this->webroot ?>js/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?php echo $this->webroot ?>js/jquery.hoverIntent.minified.js"></script>
	<script type="text/javascript" src="<?php echo $this->webroot ?>js/sherpa_ui.js"></script>
	<link href="<?php echo $this->webroot ?>css/960_fluid.css" media="screen" rel="stylesheet" type="text/css">
	<link href="<?php echo $this->webroot ?>css/category-menu.css" media="screen" rel="stylesheet" type="text/css">

    <link href="<?php echo $this->webroot ?>SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->webroot ?>SpryAssets/SpryTabbedPanels_left.css" rel="stylesheet" type="text/css">


    <link href="<?php echo $this->webroot ?>css/responsiveslides.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo $this->webroot ?>css/responsiveslides-2.css" media="screen" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo $this->webroot ?>js/responsiveslides.js"></script>
	<script type="" src="<?php echo $this->webroot ?>js/jquery-ui.custom.js"></script>
    <script>
	// You can also use "$(window).load(function() {"
	$(function () {
	  $("#slider4").responsiveSlides({
		auto: true,
		pager: false,
		nav: true,
		speed: 500,
		namespace: "callbacks",
		/*before: function () {
		  $('.events').append("<li>before event fired.</li>");
		},
		after: function () {
		  $('.events').append("<li>after event fired.</li>");
		}*/
	  });

	});
	</script>

    <script>
		function tick(){
		$('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });
		}
		setInterval(function(){ tick () }, 3000);
	</script>


    <link type="text/css" rel="stylesheet" href="<?php echo $this->webroot ?>css/liquidcarousel.css" />
	<script type="text/javascript" src="<?php echo $this->webroot ?>js/jquery.liquidcarousel.pack.js"></script>
    <script type="text/javascript">
    <!--
        $(document).ready(function() {
            $('#liquid1').liquidcarousel({height:360, duration:1500, hidearrows:false});
            $(".wrapper").css("width", "788px");

        });

    -->
    </script>




    <link type="text/css" rel="stylesheet" href="<?php echo $this->webroot ?>css/liquidcarousel-bottom.css" />
    <script type="text/javascript" src="<?php echo $this->webroot ?>js/jquery.liquidcarousel.pack-bottom.js"></script>
    <script type="text/javascript">
    <!--
        $(document).ready(function() {
            $('#liquid2').liquidcarousel({height:360, duration:1500, hidearrows:false});
        });
    -->
    </script>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot ?>css/dd.css" />

    <script>
    	function shobtab1(id,sthis){
		//alert('sghhgs');
		   $('.usual>ul>li>a').removeClass('selected');
			if(id==1)
			{
				$(sthis).addClass('selected');
			    $('#tab2').hide();
				$('#tab1').show();
			}
			else if(id==2)
			{
			    $(sthis).addClass('selected');
			    $('#tab1').hide().removeClass('selected');
				$('#tab2').show().addClass('selected');
			}


		}

    </script>

    <?php }?>
    <?php if($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='request_response'){
		?>
		 <link href="<?php echo $base_url;?>SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css">
		<?php
		}?>
    <?php if(($this->request->params['controller']=='Logins' && $this->request->params['action']=='user_dashboard') || ($this->request->params['controller']=='MasterUsers' && $this->request->params['action']!='add') || ($this->request->params['controller']=='pages' && ((isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='profile-img') || (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='compose-message') || (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='subscribe') || (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='success-stories') || (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='success-stories-list')))){
?>
<link href="<?php echo $this->webroot ?>css/mtree.css" rel="stylesheet" type="text/css">
<?php }?>
 <?php if(($this->request->params['controller']=='Search' && ($this->request->params['action']=='index' || $this->request->params['action']=='category' || $this->request->params['action']=='brand'))){
?>
<!--price range slider-->
	 <link rel="stylesheet" href="<?php echo $base_url;?>css/price_range.css"><input type="hidden" name="ser_page1" id="ser_page1" />

   <script src="<?php echo $base_url;?>js/price_range.js"></script>
     <script type="text/javascript">
	  <?php
	  if(isset($this->request->params['named']['start_amt'])){$start_amt=$this->request->params['named']['start_amt'];}else{$start_amt='';}
	   if(isset($this->request->params['named']['end_amt'])){$end_amt=$this->request->params['named']['end_amt'];}else{$end_amt='';}
	  ?>
    $(function() {
     $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: <?php if(isset($rangeprice)){echo $rangeprice;}else{echo 100;}?>,
      values: [ <?php if(isset($this->request->params['named']['start_amt'])){echo $this->request->params['named']['start_amt'];}else{echo 0;}?>, <?php if(isset($this->request->params['named']['end_amt'])){echo $this->request->params['named']['end_amt'];}else{if(isset($rangeprice)){echo $rangeprice;}else{echo 100;}}?> ],
      slide: function( event, ui ) {
       $( "#start_amt" ).val(ui.values[0] );
	    $( "#end_amt" ).val(ui.values[1] );
      }
    });
    $( "#start_amt" ).val( $( "#slider-range" ).slider( "values", 0 ) );
	 $( "#end_amt" ).val($( "#slider-range" ).slider( "values", 1 ) );
  });
  </script>
<script type="text/javascript">
	function show_all(str,str1,str2){
if(str1=="show"){
document.getElementById(str).className = "fl_item fl_item_visible expand_all";
$("#"+str2+"1").hide();
$("#"+str2+"2").show();
}else{
document.getElementById(str).className = "fl_item fl_item_visible expand_normal";
$("#"+str2+"2").hide();
$("#"+str2+"1").show();
}
}
</script>
<script type="text/javascript">
function categoryList(catval, pageOf, par_brand, par_model)
{
	if(typeof(pageOf)==='undefined'){
		pageOf='piese-auto';
	}
	//alert(1);
	var searchtxt=$("#postkeywords").val();
	var start_amt=$("#start_amt").val();
	var end_amt=$("#end_amt").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>"+pageOf+"/";
	if($("#catlist"+catval).is(":checked")==true)
	{
		//url+="category:"+catval+"/";
		url+=$("#catlist"+catval).val()+"/";
	}
	if(typeof(par_brand)==='undefined' && typeof(par_model)==='undefined'){
		$(".brandmatch").each(function(index) {
	        if($(this).is(":checked")==true)
		   {
			   //alert($(this).val());
			  // url+="brand:"+$(this).val()+"/";
			  url+=$(this).val()+"/";
		   }
	    });
	}else{
		if(typeof(par_brand)!=='undefined'){
			url+="brand:"+par_brand+"/";
		}
		if(typeof(par_model)!=='undefined')
		url+="model:"+par_model+"/";
	}

	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}
	if(blankchk.test(start_amt))
	{
		url+="start_amt:"+start_amt+"/";
	}
	if(blankchk.test(end_amt))
	{
		url+="end_amt:"+end_amt+"/";
	}
	$(".countymatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   url+="county:"+thisval+"/";
	   }
    });
	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
}
function subCategoryList(catval, parentCat, pageOf, par_brand, par_model)
{
	if(typeof(parentCat)==='undefined'){
		parentCat='';
	}else{
		parentCat=parentCat+"/";
	}
	if(typeof(pageOf)==='undefined'){
		pageOf='piese-auto';
	}
	//alert(1);
	var searchtxt=$("#postkeywords").val();
	var start_amt=$("#start_amt").val();
	var end_amt=$("#end_amt").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>"+pageOf+"/";
	if($("#subcatlist"+catval).is(":checked")==true)
	{
		//url+="category:"+catval+"/";
		url+=parentCat+$("#subcatlist"+catval).val()+"/";
	}

    if(typeof(par_brand)==='undefined' && typeof(par_model)==='undefined'){
		$(".brandmatch").each(function(index) {
	        if($(this).is(":checked")==true)
		   {
			   //alert($(this).val());
			  // url+="brand:"+$(this).val()+"/";
			  url+=$(this).val()+"/";
		   }
	    });
	}else{
		if(typeof(par_brand)!=='undefined'){
			url+="brand:"+par_brand+"/";
		}
		if(typeof(par_model)!=='undefined')
		url+="model:"+par_model+"/";
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	if(blankchk.test(start_amt))
	{
		url+="start_amt:"+start_amt+"/";
	}
	if(blankchk.test(end_amt))
	{
		url+="end_amt:"+end_amt+"/";
	}
	$(".countymatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   url+="county:"+thisval+"/";
	   }
    });
	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
}
function brandList(brandval, pageOf)
{
	if(typeof(pageOf)==='undefined'){
		pageOf='piese-auto';
	}
	var searchtxt=$("#postkeywords").val();
	var start_amt=$("#start_amt").val();
	var end_amt=$("#end_amt").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>"+pageOf+"/";
	$(".catmatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   //url+="category:"+thisval+"/";
		   url+=thisval+"/";
	   }
    });
	if(blankchk.test(brandval))
	{
		if($("#brand"+brandval).is(":checked")==true)
		{
			//url+="brand:"+brandval+"/";
			url+=$("#brand"+brandval).val()+"/";
		}
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	if(blankchk.test(start_amt))
	{
		url+="start_amt:"+start_amt+"/";
	}
	if(blankchk.test(end_amt))
	{
		url+="end_amt:"+end_amt+"/";
	}
	$(".countymatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   url+="county:"+thisval+"/";
	   }
    });
	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
}
function modelList(modelval, parentBrand, pageOf)
{
	if(typeof(parentBrand)==='undefined'){
		parentBrand='';
	}else{
		parentBrand=parentBrand+"/";
	}
	if(typeof(pageOf)==='undefined'){
		pageOf='piese-auto';
	}
	var searchtxt=$("#postkeywords").val();
	var start_amt=$("#start_amt").val();
	var end_amt=$("#end_amt").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>"+pageOf+"/";
	$(".catmatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		  // url+="category:"+thisval+"/";
		  url+=thisval+"/";
	   }
    });
	if(blankchk.test(modelval))
	{
		if($("#model"+modelval).is(":checked")==true)
		{
			//url+="brand:"+modelval+"/";
			url+=parentBrand+$("#model"+modelval).val()+"/";
		}
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	if(blankchk.test(start_amt))
	{
		url+="start_amt:"+start_amt+"/";
	}
	if(blankchk.test(end_amt))
	{
		url+="end_amt:"+end_amt+"/";
	}
	$(".countymatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   url+="county:"+thisval+"/";
	   }
    });
	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
}
/* Only For Category Page Brand functionality */
function cbrandList(brandval, pageOf, par_cat, chield_cat)
{
	if(typeof(pageOf)==='undefined'){
		pageOf='piese-auto';
	}
	var searchtxt=$("#postkeywords").val();
	var start_amt=$("#start_amt").val();
	var end_amt=$("#end_amt").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>"+pageOf+"/";
	/*$(".catmatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   //url+="category:"+thisval+"/";
		   url+=thisval+"/";
	   }
    });*/
    if(par_cat!=''){
    	url+=par_cat+"/";
    	if(chield_cat!=''){
    		url+=chield_cat+"/"
    	}
    }
	if(blankchk.test(brandval))
	{
		if($("#brand"+brandval).is(":checked")==true)
		{
			url+="brand:"+brandval+"/";
			//url+=$("#brand"+brandval).val()+"/";
		}
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	if(blankchk.test(start_amt))
	{
		url+="start_amt:"+start_amt+"/";
	}
	if(blankchk.test(end_amt))
	{
		url+="end_amt:"+end_amt+"/";
	}
	$(".countymatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   url+="county:"+thisval+"/";
	   }
    });
	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
}
function cmodelList(parentBrand, modelval, pageOf, par_cat, chield_cat)
{
	if(typeof(parentBrand)==='undefined'){
		parentBrand='';
	}else{
		parentBrand=parentBrand;
	}
	if(typeof(pageOf)==='undefined'){
		pageOf='piese-auto';
	}
	var searchtxt=$("#postkeywords").val();
	var start_amt=$("#start_amt").val();
	var end_amt=$("#end_amt").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>"+pageOf+"/";
	/*$(".catmatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   //url+="category:"+thisval+"/";
		  url+=thisval+"/";
	   }
    });*/
    if(par_cat!=''){
    	url+=par_cat+"/";
    	if(chield_cat!=''){
    		url+=chield_cat+"/"
    	}
    }
	if(blankchk.test(modelval))
	{
		if($("#model"+modelval).is(":checked")==true)
		{
			//url+="brand:"+modelval+"/";
			url+="brand:"+parentBrand+"/"+"model:"+$("#model"+modelval).val()+"/";
		}
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	if(blankchk.test(start_amt))
	{
		url+="start_amt:"+start_amt+"/";
	}
	if(blankchk.test(end_amt))
	{
		url+="end_amt:"+end_amt+"/";
	}
	$(".countymatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   url+="county:"+thisval+"/";
	   }
    });
	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
}
/* Only For Category Page Brand Functionality End */
function priceList(pageOf, pCat, psubCat, par_brand, par_model)
{
	if(typeof(pageOf)==='undefined'){
		pageOf='piese-auto';
	}
	var searchtxt=$("#postkeywords").val();
	var start_amt=$("#start_amt").val();
	var end_amt=$("#end_amt").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>"+pageOf+"/";
	/*===Category Start====*/
    if(typeof(pCat)==='undefined' && typeof(psubCat)==='undefined'){
		$(".catmatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   url+=thisval+"/";
	   }
    });
	}else{
		if(typeof(pCat)!=='undefined'){
			url+=pCat+"/";
		}
		if(typeof(psubCat)!=='undefined')
		url+=psubCat+"/";
	}
    /*===Brand Start=======*/

    if(typeof(par_brand)==='undefined' && typeof(par_model)==='undefined'){
		$(".brandmatch").each(function(index) {
	        if($(this).is(":checked")==true)
		   {
			   //alert($(this).val());
			  // url+="brand:"+$(this).val()+"/";
			  url+=$(this).val()+"/";
		   }
	    });
	}else{
		if(typeof(par_brand)!=='undefined'){
			url+="brand:"+par_brand+"/";
		}
		if(typeof(par_model)!=='undefined')
		url+="model:"+par_model+"/";
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	if(blankchk.test(start_amt))
	{
		url+="start_amt:"+start_amt+"/";
	}
	if(blankchk.test(end_amt))
	{
		url+="end_amt:"+end_amt+"/";
	}
	$(".countymatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var cval=$(this).val();
		   url+="county:"+cval+"/";
	   }
    });
	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
}
function countyList(countyval, pageOf,pCat, psubCat, par_brand, par_model)
{
	if(typeof(pageOf)==='undefined'){
		pageOf='piese-auto';
	}
	var searchtxt=$("#postkeywords").val();
	var start_amt=$("#start_amt").val();
	var end_amt=$("#end_amt").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>"+pageOf+"/";

    /*===Category Start====*/
    if(typeof(pCat)==='undefined' && typeof(psubCat)==='undefined'){
		$(".catmatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   url+=thisval+"/";
	   }
    });
	}else{
		if(typeof(pCat)!=='undefined'){
			url+=pCat+"/";
		}
		if(typeof(psubCat)!=='undefined')
		url+=psubCat+"/";
	}
    /*===Brand Start=======*/
	if(typeof(par_brand)==='undefined' && typeof(par_model)==='undefined'){
		$(".brandmatch").each(function(index) {
	        if($(this).is(":checked")==true)
		   {
			   //alert($(this).val());
			  // url+="brand:"+$(this).val()+"/";
			  url+=$(this).val()+"/";
		   }
	    });
	}else{
		if(typeof(par_brand)!=='undefined'){
			url+="brand:"+par_brand+"/";
		}
		if(typeof(par_model)!=='undefined')
		url+="model:"+par_model+"/";
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	if(blankchk.test(start_amt))
	{
		url+="start_amt:"+start_amt+"/";
	}
	if(blankchk.test(end_amt))
	{
		url+="end_amt:"+end_amt+"/";
	}
	if(blankchk.test(countyval))
	{
		if($("#county"+countyval).is(":checked")==true)
		{
		url+="county:"+countyval+"/";
		}
	}
	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
}
function sellerList(pageOf,pCat, psubCat, par_brand, par_model)
{
	if(typeof(pageOf)==='undefined'){
		pageOf='piese-auto';
	}
	var seller=$("#seller").val();
	var searchtxt=$("#postkeywords").val();
	var start_amt=$("#start_amt").val();
	var end_amt=$("#end_amt").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>"+pageOf+"/";
     /*===Category Start====*/
    if(typeof(pCat)==='undefined' && typeof(psubCat)==='undefined'){
		$(".catmatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   url+=thisval+"/";
	   }
    });
	}else{
		if(typeof(pCat)!=='undefined'){
			url+=pCat+"/";
		}
		if(typeof(psubCat)!=='undefined')
		url+=psubCat+"/";
	}
    /*===Brand Start=======*/
	if(typeof(par_brand)==='undefined' && typeof(par_model)==='undefined'){
		$(".brandmatch").each(function(index) {
	        if($(this).is(":checked")==true)
		   {
			   //alert($(this).val());
			  // url+="brand:"+$(this).val()+"/";
			  url+=$(this).val()+"/";
		   }
	    });
	}else{
		if(typeof(par_brand)!=='undefined'){
			url+="brand:"+par_brand+"/";
		}
		if(typeof(par_model)!=='undefined')
		url+="model:"+par_model+"/";
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	if(blankchk.test(start_amt))
	{
		url+="start_amt:"+start_amt+"/";
	}
	if(blankchk.test(end_amt))
	{
		url+="end_amt:"+end_amt+"/";
	}
	$(".countymatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var cval=$(this).val();
		   url+="county:"+cval+"/";
	   }
    });
	if(blankchk.test(seller))
	{
		$.ajax({
			type:"POST",
			url:"<?php echo $base_url;?>Search/getuserid/",
			data: "username="+seller,
			success: function(data){
					url+="user_id:"+data+"/";
					window.location=url;
					//alert(url);
			}
		});
	}
	<?php /*?><?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?><?php */?>
	//return false;
	//alert(url);
	//window.location=url;
}
function sortBy(sortval, pageDefault, pCat, psubCat, par_brand, par_model)
{
	if(typeof(pageDefault)==='undefined'){
		pageDefault='piese-auto';
	}
	var searchtxt=$("#seller").val();
	var start_amt=$("#start_amt").val();
	var end_amt=$("#end_amt").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>"+pageDefault+"/";
	 /*===Category Start====*/
    if(typeof(pCat)==='undefined' && typeof(psubCat)==='undefined'){
		$(".catmatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var thisval=$(this).val();
		   url+=thisval+"/";
	   }
    });
	}else{
		if(typeof(pCat)!=='undefined'){
			url+=pCat+"/";
		}
		if(typeof(psubCat)!=='undefined')
		url+=psubCat+"/";
	}
    /*===Brand Start=======*/
	if(typeof(par_brand)==='undefined' && typeof(par_model)==='undefined'){
		$(".brandmatch").each(function(index) {
	        if($(this).is(":checked")==true)
		   {
			   //alert($(this).val());
			  // url+="brand:"+$(this).val()+"/";
			  url+=$(this).val()+"/";
		   }
	    });
	}else{
		if(typeof(par_brand)!=='undefined'){
			url+="brand:"+par_brand+"/";
		}
		if(typeof(par_model)!=='undefined')
		url+="model:"+par_model+"/";
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	if(blankchk.test(start_amt))
	{
		url+="start_amt:"+start_amt+"/";
	}
	if(blankchk.test(end_amt))
	{
		url+="end_amt:"+end_amt+"/";
	}
	$(".countymatch").each(function(index) {
       if($(this).is(":checked")==true)
	   {
		   //alert($(this).val());
		   var cval=$(this).val();
		   url+="county:"+cval+"/";
	   }
    });
	if(blankchk.test(sortval))
	{
		url+=sortval+"/";
	}
	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
}
</script>
<?php }?>
<script type="text/javascript">
function searchPost()
{
	var searchtxt=$("#postkeywords").val();
	var category=$("#category").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>piese-auto/";
	if(blankchk.test(category))
	{
		url+=category+"/";
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
}
$( document ).ready(function() {
$('.searchinput').keypress(function (e) {
  if (e.which == 13) {
   var searchtxt=$("#postkeywords").val();
  	var category=$("#category").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>piese-auto/";
	if(blankchk.test(category))
	{
		url+=category+"/";
	}
	if(blankchk.test(searchtxt))
	{
		url+="postkeywords:"+searchtxt+"/";
	}

	<?php
	if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
	{?>
	url+="user_id:<?php echo$this->request->params['named']['user_id'];?>/";
	<?php }?>
	window.location=url;
    return false;    //<---- Add this line
  }
});
});
</script>

<script>
	$(document).on("scroll", function() {
	  if ($(document).scrollTop() > 20) {
		$(".scroll").addClass("nav_scroll");
	  } else {
		$(".scroll").removeClass("nav_scroll");
	  }
	});

</script>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response, chktype) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI(chktype);
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
     	//alert("Login Failed due to Unauthorized");
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
     // alert("Login Failed due to connection ERROR");
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState(chktype) {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response,chktype);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '396456933896831', //Live App: 396456933896831, my Test: 1547464088850977
    cookie     : true,  // enable cookies to allow the server to access
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI(chktype) {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=email,about,first_name,last_name,id', function(response) {
		//console.log(response);
		<?php if(!$this->Session->check('User')){?>
		if(chktype!='innerpg')
		{
		$("#fbloader").html('<?php echo PROCESSING;?>...');
		}
		else
		{
			$("#innerfbloader").html('');
		}
		$.ajax(
				{
					type: 'POST',
					url: '<?php echo $base_url;?>Homes/facebooklogin',
					data: 'fb_id='+response.id+'&email='+response.email+'&first_name='+response.first_name+'&last_name='+response.last_name,
					success: function(data) {
						if(data==1)
						{
							if(chktype!='innerpg')
							{
							$("#fbloader").html('<?php echo MYACCOUNT;?>');
							//alert("Login Successfully");
							window.location="<?php echo $base_url;?>Logins/user_dashboard";
							}
							else
							{
								$("#innerfbloader").html('');
								alert("Autentificare cu succes");
								//$( "#salesquestion" ).submit();
							}
						}
						else if(data==3)
						{
							if(chktype!='innerpg')
							{
							$("#fbloader").html('<?php echo PROCESSING;?>...');
							}
							else
							{
								$("#innerfbloader").html('');
							}
							fblogout('emailExist');
							alert("E-mail există deja");
						}
						else
						{
							if(chktype!='innerpg')
							{
							$("#fbloader").html('<?php echo PROCESSING;?>...');
							}
							else
							{
								$("#innerfbloader").html('');
							}
							alert("Autentificare Eșuată");
						}
					}
				});
		<?php }?>
      /*console.log('Successful login for: ' + response.name);*/
     /* document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';*/
    });
  }
  function fblogout(statusval){
	FB.logout(function(response) {
		if(statusval!='emailExist')
		{
				$.post('<?php echo $base_url; ?>Homes/fbLogOut',function(success)
			  {
				 window.location="<?php echo $base_url; ?>";
			  });
		}
		});
	}
	function updateStatus(noticetype)
	{
		$.ajax(
		{
			type: 'POST',
			url: '<?php echo $base_url; ?>App/noticeStatus',
			data: 'noticetype='+noticetype,
			success: function(data) {
				//alert(data);
				if(data==1 || data!='no')
				{
					if(noticetype=='sales-question'){
						if(data!=1){
						var slugname='sales-details/'+data;
						}else{
							var slugname='sales-details/'+data;
						}
					}
					else if(noticetype=='bid-question'){
						if(data!=1){
						var slugname='request-parts/'+data;
						}else{
							var slugname='request-parts/'+data;
						}
					}else{
						var slugname='sales-details/'+data;
					}
					//return false;
					switch(noticetype){
						case 'sales-add':
						window.location="<?php echo $base_url;?>PostAds";
						break;
						case 'sales-modified':
						window.location="<?php echo $base_url;?>PostAds";
						break;
						case 'request-parts':
						window.location="<?php echo $base_url;?>RequestParts";
						break;
						case 'request-modified':
						window.location="<?php echo $base_url;?>RequestParts";
						break;
						case 'sales-question':
						window.location="<?php echo $base_url;?>pages/"+slugname;
						break;
						case 'sales-order':
						window.location="<?php echo $base_url;?>pages/commands";
						break;
						case 'request-question':
						window.location="<?php echo $base_url;?>RequestParts/request_question";
						break;
						case 'bid-offer':
						window.location="<?php echo $base_url;?>RequestParts/offertomyrequest";
						break;
						case 'bid-question':
						window.location="<?php echo $base_url;?>pages/"+slugname;
						break;
						case 'parts-order':
						window.location="<?php echo $base_url;?>RequestParts/bidding";
						break;
						case 'park-question':
						window.location="<?php echo $base_url;?>SalesParks/questionrec";
						break;
						case 'seller-rate':
						window.location="<?php echo $base_url;?>pages/rating-given-buyer";
						break;
						case 'buyer-rate':
						window.location="<?php echo $base_url;?>pages/rating-given-seller";
						break;
						default:
						window.location="<?php echo $base_url;?>Logins/user_dashboard";
						break;
					}
				}
				else if(data=="no")
				{
					alert("Not Available");
				}
			}
		});
	}
	function successStories()
	{
		window.location="<?php echo $base_url;?>#successstories";
		 $('html, body').animate({
			scrollTop: $(".block-success-story").offset().top- 135
		}, 2000);
	}

</script>
<script>
  /*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46342924-1', 'auto');
  ga('send', 'pageview');*/

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46340960-2', 'auto');
  ga('send', 'pageview');

</script>
 <?php if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' &&(in_array('subscribe',$this->request->params['pass']))){?>
 <script src="<?php echo $this->webroot ?>js/bootstrap.js"></script>
<script src="<?php echo $base_url;?>/multiselect/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo $base_url;?>/multiselect/css/bootstrap-multiselect.css" />
<script type="text/javascript">
    $(document).ready(function() {
        $('#SubscribeAlertBrandList').multiselect();
        $('#SubscribeAlertCategories').multiselect();
        $('#SubscribeAlertCouties').multiselect();
    });
</script>
<?php }?>
</head>
  <body>
	<header class="headertag" id="fix_header">
    	<div class="topheader">
            <div class="container">
                <div class="row">
                	<div class="col-md-5 welcome user-link">
                      <?php echo WELCOMEDEZMEM;?> : <a href="<?php echo $base_url;?>Logins/login"><?php echo AUTHENTICATION;?></a> | <a href="<?php echo $base_url;?>MasterUsers/add"><?php echo REGISTER;?></a>
                    </div>

                    <div class="col-md-7 top-links">
                        <div class="col-lg-8" style="float:right;padding-right: 0;">
                        	<ul>
                               <!-- <li class="first"><a href="#"><?php echo MERCHANTACCOUNT;?></a><span>|</span></li>
                                <li><a href="#"><?php echo TRADE;?></a><span>|</span></li>-->
                                <li><a href="javascript:void(0);" onclick="return successStories();"><?php echo SUCCESSSTORIES;?></a><span>|</span></li>
                                <li><a href="<?php echo $base_url;?>Logins/user_dashboard"><?php echo YOURACCOUNT;?></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <header id="header">
         <?php //pr($this->Session);exit; ?>
            <div class="container">

                <div class="row scroll">
                	<div class="col-md-6">
                       <?php if(isset($settingres['Sitesetting']['logo_image'])){?>
                    <a href="<?php echo $base_url;?>"><img src="<?php echo $base_url.'files/site_logo/'.$settingres['Sitesetting']['logo_image'];?>" alt="" title="" border="0" class="logo head_logo"></a>
                    <?php }else{?>
                    <a href="<?php echo $base_url;?>"><img src="<?php echo $this->webroot ?>images/logo.jpg" alt="" title="" border="0" class="logo head_logo"></a>
                    <?php }?>
                    </div>

                    <div class="col-md-6">
                    	<div class="clearfix" style="height:10px;"></div>
                                 <?php
						$topadd=$this->requestAction('/Homes/topad');
						  if(!empty($topadd)){
							if($topadd['Advertisement']['ad_type']==1)
							{
								$topadlink=$topadd['Advertisement']['banner_link'];
								$topadimg=$topadd['Advertisement']['banner_image'];
								$topadtitle=$topadd['Advertisement']['banner_title'];
							?>
                        	<a href="<?php echo $topadlink;?>" target="_blank"><img src="<?php echo $base_url;?>files/advertisement/<?php echo $topadimg;?>" alt="<?php echo $topadtitle;?>" width="468" class="head_add" height="60" style="float: right;"></a>
                            <?php }else if($topadd['Advertisement']['ad_type']==2){
								echo stripslashes($topadd['Advertisement']['ad_script']);
								}
							}?>
                    </div>
                </div>
            </div>
        </header>

		<div class="navbar navbar-inverse" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Manu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <!--<a class="navbar-brand" href="#">Menu</a> -->
            </div>

            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li<?php if($this->request->params['controller']=='Search'){?> class="active"<?php }?>><a href="<?php echo $base_url;?>piese-auto"><?php echo AUTOPARTS;?></a></li>
                <li<?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='request-parts'){?> class="active"<?php }?>><a href="<?php echo $base_url;?>pages/request-parts">Cereri Piese</a></li>
                <li<?php if(isset($this->request->params['pass'][0]) && ($this->request->params['pass'][0]=='truck-parks')){?> class="active"<?php }?>><a href="<?php echo $base_url;?>pages/truck-parks" style="border-right:0px !important">Parcuri dezmembrări</a></li>
                 <li<?php if(isset($this->request->params['pass'][0]) && ($this->request->params['pass'][0]=='company-parts')){?> class="active"<?php }?>><a href="<?php echo $base_url;?>pages/company-parts" style="border-right:0px !important"><?php echo COMPANIESPIECES;?></a></li>
                <!--<li><a href="#">Service-uri & Manopera</a></li>-->

                <!--<li class="dropdown"><a href="#" style="border-left:0px;" class="dropdown-toggle" data-toggle="dropdown">BizDirectory<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Company Directories</a></li>
                		<li><a href="#">Product Directories</a></li>
                		<li><a href="#">Buying Leads Directories</a></li>
                		<li><a href="#">Selling Leads Directories</a></li>
                    </ul>
                </li>-->

                </li>
                 <?php if($this->Session->check('User')){
					$userDetail=$this->Session->read('User');
					?>
                <!-- notification design start-->
                <li class="dropdown lastliitem pull-right notify">
                	<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-warning"></i>
                        <span class="number"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id']);?></span>
                    </a>
                    <ul class="dropdown-menu notifications">
							<li class="dropdown-menu-title">
								<span>Ai <?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id']);?> Notificări</span>
							</li>
							<li>
                                <a href="javascript:void(0);" onclick="return updateStatus('sales-add');">
									<span class="icon green"><i class="fa fa-comment-o"></i></span>
									<span class="message"> anunțuri de vânzare</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'], 'sales-add');?></span>
                                </a>
                            </li>
							<li>
                                <a href="javascript:void(0);" onclick="return updateStatus('sales-modified');">
									<span class="icon green"><i class="fa fa-comment-o"></i></span>
									<span class="message">vânzări modificate</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'sales-modified');?></span>
                                </a>
                            </li>
							<li>
                                <a href="javascript:void(0);" onclick="return updateStatus('request-parts');">
									<span class="icon green"><i class="fa fa-comment-o"></i></span>
									<span class="message"> Piese cerere</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'request-parts');?></span>
                                </a>
                            </li>
							<li>
                                <a  href="javascript:void(0);" onclick="return updateStatus('request-modified');">
									<span class="icon blue"><i class="fa fa-user"></i></span>
									<span class="message"> Piese modificate</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'request-modified');?></span>
                                </a>
                            </li>
                             <li>
                                <a href="javascript:void(0);" onclick="return updateStatus('park-question');">
									<span class="icon blue"><i class="fa fa-user"></i></span>
									<span class="message">Park Inbox</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'park-question');?></span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="return updateStatus('sales-question');">
									<span class="icon blue"><i class="fa fa-user"></i></span>
									<span class="message">Comentariu de vânzări</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'sales-question');?></span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="return updateStatus('sales-order');">
									<span class="icon blue"><i class="fa fa-user"></i></span>
									<span class="message">comenzi de vânzări</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'sales-order');?></span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="return updateStatus('request-question');">
									<span class="icon blue"><i class="fa fa-user"></i></span>
									<span class="message">Cerere Piese Intrebare</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'], 'request-question');?></span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="return updateStatus('bid-offer');">
									<span class="icon blue"><i class="fa fa-user"></i></span>
									<span class="message">Licitate piese oferta</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'bid-offer');?></span>
                                </a>
                            </li>
                             <li>
                                <a href="javascript:void(0);" onclick="return updateStatus('bid-question');">
									<span class="icon blue"><i class="fa fa-user"></i></span>
									<span class="message">bid Comentariu</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'bid-question');?></span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="return updateStatus('parts-order');">
									<span class="icon blue"><i class="fa fa-user"></i></span>
									<span class="message"> câștigătoare oferta</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'parts-order');?></span>
                                </a>
                            </li>
                             <li>
                                <a href="javascript:void(0);" onclick="return updateStatus('buyer-rate');">
									<span class="icon blue"><i class="fa fa-user"></i></span>
									<span class="message">Evaluare la Vanzator</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'buyer-rate');?></span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="return updateStatus('seller-rate');">
									<span class="icon blue"><i class="fa fa-user"></i></span>
									<span class="message">Evaluare la Cumpărător</span>
									<span class="time"><?php echo $this->Custom->BapCustrUniUserNotice($userDetail['user_id'],'seller-rate');?></span>
                                </a>
                            </li>
						</ul>
                </li>
                <!-- notification design end-->
                 <?php }?>

                <li class="dropdown lastliitem">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="fbloader"><?php echo MYACCOUNT;?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  <?php if($this->Session->check('User')){?>
                  	<li><a href="<?php echo $this->webroot ?>Logins/user_dashboard" class="trade">Dashboard</a></li>
                    <li class="divider"></li>
                      <li><a href="<?php echo $base_url;?>pages/my-purchases"><img src="<?php echo $this->webroot ?>images/purchase.png" alt="" class="iocnlist1"><?php echo MYPURCHASES;?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $base_url;?>RequestParts/"><img src="<?php echo $this->webroot ?>images/request.png" alt="" class="iocnlist1"><?php echo MYREQUEST;?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $base_url;?>pages/statistics-views/favourite"><img src="<?php echo $this->webroot ?>images/favorite.png" alt="" class="iocnlist1"><?php echo FAVOTITES;?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $base_url;?>MasterUsers/account_setting"><img src="<?php echo $this->webroot ?>images/settings.png" alt="" class="iocnlist1"><?php echo SETTINGS;?></a></li>
                    <?php if($this->Session->check('facebookLogin')){?>
                    <li><a href="Javascript:void(0);" onclick="return fblogout('logout');" class="trade"><?php echo LOGOUT;?></a></li>
                    <?php }else{?>
                  	<li><a href="<?php echo $this->webroot ?>MasterUsers/logout" class="trade"><?php echo LOGOUT;?></a></li>
                    <?php }?>
                    <li class="divider"></li>
                  <?php }else{?>
                  <li><a href="<?php echo $this->webroot ?>Logins/login" class="trade"><img src="<?php echo $this->webroot ?>images/login.png" alt="" class="iocnlist1"><?php echo LOGIN;?></a></li>
                    <li class="divider"></li>
                  	<li><fb:login-button scope="public_profile,email" class="faacebook_suctomCL" onlogin="checkLoginState('login');">
<?php echo FBLOGIN;?>
</fb:login-button></li>
					<li class="divider"></li>
                    <li class="dropdown-header"><?php echo NEWUSER;?></li>
                    <li><a href="<?php echo $this->webroot ?>MasterUsers/add"><img src="<?php echo $this->webroot ?>images/register.png" alt="" class="iocnlist1"><?php echo CREATYOURACCOUNT;?></a></li>
                    <li class="divider"></li>
                    <?php }?>


                  </ul>
                </li>

              </ul>


            </div>
            <!--/.nav-collapse -->
          </div>
        </div>
    </header>
    <div class="fixtopmr">&nbsp;</div>
	<?php
if(!($this->request->params['action']=='login' || ($this->request->params['controller']=='MasterUsers') || (($this->request->params['action']=='slugName') &&( (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='sales-order'))))){
?>
	<div class="block-search">
	  <div class="container">
		<div class="row">
			<div class="col-md-7" style="position: relative;padding-right: 0;">
            <?php echo $this->element('topsearch');?>

			</div>
			<div class="col-md-5 leads-btn">
				<a href="<?php echo $base_url;?>RequestParts/add" class="trade"><span class="glyphicon icontags1"></span><?php echo ENQUIRYPARTS;?></a>
				<a href="<?php echo $base_url;?>PostAds/add" class="buying"><span class="glyphicon icontags2"></span><?php echo LISTINGS;?></a>
                <!--<a href="#" class="searchadvance"><span class="glyphicon icontags6"></span> Cautare Avansata</a>-->
			</div>
		</div>

		<!--<div class="col-md-12 clearfix">
				<p></p>
			</div>-->
	  </div>
	</div>
<?php
}
?>