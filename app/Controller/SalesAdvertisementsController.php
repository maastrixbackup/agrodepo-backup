<?php
App::uses('AppController', 'Controller');
/**
 * MasterUsers Controller
 *
 * @property MasterUser $MasterUser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SalesAdvertisementsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	//public $paginate = array('limit' => 2);
		
	/*function advertisement_listing(){ //echo "<pre>";print_r($this->request->data);exit;
		$cond = '';
		$cat_ids = array();
		$arry = $this->request->data['SalesAdvertisement']['category']; print_r($arry);exit;
		
		
		if( isset($this->request->data['SalesAdvertisement']['new']) && $this->request->data['SalesAdvertisement']['new'] == 'new' ){ //echo 33;
			//$cond .=  "'SalesAdvertisement.product_cond' =>'".$this->request->data['SalesAdvertisement']['new'];
			$con = $this->request->data['SalesAdvertisement']['new'];
			$detail_adv = $this->Paginator->paginate('SalesAdvertisement', array('SalesAdvertisement.product_cond'=>$con));
		}
		if( isset($this->request->data['SalesAdvertisement']['old']) && $this->request->data['SalesAdvertisement']['old'] == 'old' ){ //echo 11;
			$con = $this->request->data['SalesAdvertisement']['old'];
			//$cond .=  "'SalesAdvertisement.product_cond'"=>$con;
			$detail_adv = $this->Paginator->paginate('SalesAdvertisement', array('SalesAdvertisement.product_cond'=>$con));
		}
		//$detail_adv = $this->Paginator->paginate('SalesAdvertisement', array($cond));
		if( ($this->request->data['SalesAdvertisement']['old'] != 'old') && ($this->request->data['SalesAdvertisement']['new'] != 'new')){
			$detail_adv = $this->Paginator->paginate('SalesAdvertisement');
		}
		if( ($this->request->data['SalesAdvertisement']['old'] == 'old') && ($this->request->data['SalesAdvertisement']['new'] == 'new')){
			$detail_adv = $this->Paginator->paginate('SalesAdvertisement');
		}
	
		
	
		//$cond = array('SalesAdvertisement.category_id' => '3');
		//echo "----".$cond;exit;
		//$detail_adv = $this->Paginator->paginate('SalesAdvertisement', array($cond)); 
		$this->set('all_adv',$detail_adv);
		$cat_arr = array();
		$cnt = '';
		foreach($detail_adv as $adv){
			$cat = $adv['SalesAdvertisement']['category_id'];
			if (array_key_exists($cat, $cat_arr)) {
				$vall = $cat_arr[$cat];
				$cat_arr[$cat] = $vall + 1;
			}else{
				$cat_arr[$cat] = $cnt + 1;
			}
		} 
		$this->set('cat_arr',$cat_arr);
	}*/
	
	
	function advertisement_listing(){
	//echo "<pre>";print_r($this->request->data); //exit;
		$this->loadModel("MasterCountry");
		$this->loadModel("MasterLocation");
		$this->loadModel("SalesCategory");
		$this->loadModel("SalesBrand");
		$cond = '';
		
		//checked category
		$cat_ids = array();
		$arry = $this->request->data['SalesAdvertisement']['category'];
		foreach($arry as $k1=>$v1){
			if($v1 == 0){
				unset($arry[$k1]);
			}else{ 
				$cat_ids[] = $v1;
			}
		}
		//checked sub category
		$sub_cat_ids = array();
		$sub_cat_arry = $this->request->data['SalesAdvertisement']['sub_category']; 		
		foreach($sub_cat_arry as $k1=>$v1){
			if($v1 == 0){
				unset($sub_cat_arry[$k1]);
			}else{ 
				$sub_cat_ids[] = $v1;
			}
		}
		//checked brand
		$brand_ar = array();
		$brand_arry = $this->request->data['SalesAdvertisement']['brand'];
		foreach($brand_arry as $k11=>$v11){
			if($v11 == 0){
				unset($brand_arry[$k11]);
			}else{ 
				$brand_ar[] = $v11;
			}
		}
		// checked sub brand
		$sub_brand_ar = array();
		$sub_brand_arry = $this->request->data['SalesAdvertisement']['sub_brand'];
		foreach($sub_brand_arry as $k11=>$v11){
			if($v11 == 0){
				unset($sub_brand_arry[$k11]);
			}else{ 
				$sub_brand_ar[] = $v11;
			}
		}

		//fetch category
		if($cat_ids[0]){
			$category_arr=$this->SalesCategory->find("list",array("conditions"=>array("SalesCategory.status "=>1,"SalesCategory.flag "=>0,"SalesCategory.category_id "=>$cat_ids[0]),
		"fields"=>array("SalesCategory.category_id","SalesCategory.category_name")));
		}else{
			$category_arr=$this->SalesCategory->find("list",array("conditions"=>array("SalesCategory.status "=>1,"SalesCategory.flag "=>0),
		"fields"=>array("SalesCategory.category_id","SalesCategory.category_name")));
		}
		
		$this->set("cat_arr",$category_arr);
		
		// fetch sub category
		$category_id=$cat_ids[0];
		$sub_category_arr=$this->SalesCategory->find("list",array("conditions"=>array("SalesCategory.status "=>1,"SalesCategory.flag "=>$category_id),
		"fields"=>array("SalesCategory.category_id","SalesCategory.category_name")));
		$this->set("sub_cat_arr",$sub_category_arr);
		$this->set("cat_id",$category_id);
		
		//fetch brand
		if($brand_ar[0]){
				$brand_arr=$this->SalesBrand->find("list",array("conditions"=>array("SalesBrand.status "=>1,"SalesBrand.brand_id "=>$brand_ar[0]),
		"fields"=>array("SalesBrand.brand_id","SalesBrand.brand_name")));
		}else{
				$brand_arr=$this->SalesBrand->find("list",array("conditions"=>array("SalesBrand.status "=>1,"SalesBrand.flag "=>0),
		"fields"=>array("SalesBrand.brand_id","SalesBrand.brand_name")));
		}
	
		$this->set("brand_arr",$brand_arr);
		
		//fetch sub_brand
		$brand_id=$brand_ar[0];
		$sub_brand_arr=$this->SalesBrand->find("list",array("conditions"=>array("SalesBrand.status "=>1,"SalesBrand.flag "=>$brand_id),
		"fields"=>array("SalesBrand.brand_id","SalesBrand.brand_name")));
		$this->set("sub_brand_arr",$sub_brand_arr);
		$this->set("brand_id",$brand_id);
		
		// fetch country
		$country_arr=$this->MasterCountry->find("list",array("fields"=>array("MasterCountry.country_id","MasterCountry.country_name"),"limit"=>10));
		$this->set("country",$country_arr);
		
		// fetch locality
		$locality_arr=$this->MasterLocation->find("list",array("fields"=>array("MasterLocation.location_id","MasterLocation.location_name"),"limit"=>10));
		$this->set("locality",$locality_arr);
		
		// search 
		$cond=1;
		$pcond=$this->request->data['SalesAdvertisement'];
		if( $pcond['old'] && $pcond['new']){ 
			$cond.=" AND sa.product_cond='new'";
		}else if($pcond['old']){
			$cond.=" AND sa.product_cond='old'";
		}else if($pcond['new']){
			$cond.=" AND (product_cond='old' OR sa.product_cond='new')";
		}
		$cat_chk=implode(",",$cat_ids);
		$brand_chk=implode(",",$brand_ar);
		$sub_brand_chk=implode(",",$sub_brand_ar);
		$sub_cat_chk=implode(",",$sub_cat_ids);
		
		$this->set("cat_chk",$cat_ids);
		$this->set("brand_chk",$brand_ar);
		$this->set("sub_cat_chk",$sub_cat_ids);
		$this->set("sub_brand_chk",$sub_brand_ar);
		if($category_id){
			$cond.=" AND sa.category_id =$category_id";
		}
		if($brand_id){
			$cond.=" AND sa.adv_brand_id =$brand_id";
		}
		if(!empty($sub_brand_ar) && is_array($sub_brand_ar)){
			$cond.=" AND sa.adv_model_id IN ($sub_brand_chk)";
		}
		if(!empty($sub_cat_ids)){
			$cond.=" AND sa.sub_cat_id IN ($sub_cat_chk)";
		}
		
		$sql="SELECT sa.* FROM  sales_advertisements sa JOIN sales_brands sb ON sa.adv_brand_id = sb.brand_id  JOIN sales_categories sc on sa.category_id = sc.category_id WHERE ".$cond;
		$result=$this->SalesAdvertisement->query($sql);
		$this->set('all_adv',$result);
		$cat_arr = array();
		$cnt = '';$cnt1 = '';
	} 
	
	function show_details($id=''){
		$this->loadModel('SalesAdvertisement');
		$adv_detail = $this->SalesAdvertisement->findByadv_id($id);
		$this->set('adv_detail',$adv_detail);
	}
	
	function pr($arr){
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
	
}
