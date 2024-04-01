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
	
	
	function advertisement_listing(){ //echo "<pre>";print_r($this->request->data); //exit;
		$cond = '';
		$cat_ids = array();
		$arry = $this->request->data['SalesAdvertisement']['category']; //print_r($arry);exit;
				
		foreach($arry as $k1=>$v1){
			if($v1 == 0){
				unset($arry[$k1]);
			}else{ 
				$cat_ids[] = $v1;
			}
		}
		$brand_ar = array();
		$brand_arry = $this->request->data['SalesAdvertisement']['brand'];
		foreach($brand_arry as $k11=>$v11){
			if($v11 == 0){
				unset($arry[$k11]);
			}else{ 
				$brand_ar[] = $v11;
			}
		}
		
		if( isset($this->request->data['SalesAdvertisement']['new']) && $this->request->data['SalesAdvertisement']['new'] == 'new' ){ 
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.product_cond'=>$this->request->data['SalesAdvertisement']['new']))); 
		}
		if( isset($this->request->data['SalesAdvertisement']['old']) && $this->request->data['SalesAdvertisement']['old'] == 'old' ){ 
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.product_cond'=>$this->request->data['SalesAdvertisement']['old']))); 
		}
		if( ($this->request->data['SalesAdvertisement']['old'] != 'old') && ($this->request->data['SalesAdvertisement']['new'] != 'new')){
			$detail_adv = $this->SalesAdvertisement->find('all');
		}
		if( ($this->request->data['SalesAdvertisement']['old'] == 'old') && ($this->request->data['SalesAdvertisement']['new'] == 'new')){
			$detail_adv = $this->SalesAdvertisement->find('all');
		}
		if(isset($cat_ids) && !empty($cat_ids)){ //echo "<pre>";print_r($cat_ids);exit;
			
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.category_id'=>$cat_ids)));
		}
		
		if( (isset($cat_ids) && !empty($cat_ids)) && $this->request->data['SalesAdvertisement']['old'] == 'old' ){
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.category_id'=>$arry, 'SalesAdvertisement.product_cond'=>'old')));
		}
		if( (isset($cat_ids) && !empty($cat_ids)) && $this->request->data['SalesAdvertisement']['new'] == 'new' ){
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.category_id'=>$arry, 'SalesAdvertisement.product_cond'=>'new')));
		}
		
		if(isset($brand_ar) && !empty($brand_ar)){ //echo "<pre>";print_r($cat_ids);exit;
			
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.adv_brand_id'=>$brand_ar)));
		}
		if( (isset($brand_ar) && !empty($brand_ar)) && (isset($cat_ids) && !empty($cat_ids)) ){ 
			
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.adv_brand_id'=>$brand_ar,'SalesAdvertisement.category_id'=>$cat_ids)));
		}
		if( (isset($brand_ar) && !empty($brand_ar)) && (isset($cat_ids) && !empty($cat_ids)) && $this->request->data['SalesAdvertisement']['old'] == 'old' ){ 
			
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.adv_brand_id'=>$brand_ar,'SalesAdvertisement.category_id'=>$cat_ids, 'SalesAdvertisement.product_cond'=>'old')));
		}
		if( (isset($brand_ar) && !empty($brand_ar)) && (isset($cat_ids) && !empty($cat_ids)) && $this->request->data['SalesAdvertisement']['new'] == 'new' ){ 
			
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.adv_brand_id'=>$brand_ar,'SalesAdvertisement.category_id'=>$cat_ids, 'SalesAdvertisement.product_cond'=>'new')));
		}
		
		if( (isset($brand_ar) && !empty($brand_ar))  && $this->request->data['SalesAdvertisement']['old'] == 'old' ){ 
			
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.adv_brand_id'=>$brand_ar,'SalesAdvertisement.category_id'=>$cat_ids, 'SalesAdvertisement.product_cond'=>'old')));
		}
		if( (isset($brand_ar) && !empty($brand_ar)) && $this->request->data['SalesAdvertisement']['new'] == 'new' ){ 
			
			$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array('SalesAdvertisement.adv_brand_id'=>$brand_ar,'SalesAdvertisement.category_id'=>$cat_ids, 'SalesAdvertisement.product_cond'=>'new')));
		}
		
	
		//$cond = array('SalesAdvertisement.category_id' => '3');
		//$detail_adv = $this->SalesAdvertisement->find('all', array('conditions'=>array($cond))); 
		$this->set('all_adv',$detail_adv);
		$cat_arr = array();
		$cnt = '';$cnt1 = '';
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
		
		
		$cat_arr1 = array();
		foreach($detail_adv as $adv){
			$cat1 = $adv['SalesAdvertisement']['adv_brand_id'];
			if (array_key_exists($cat1, $cat_arr1)) {
				$vall = $cat_arr1[$cat1];
				$cat_arr1[$cat1] = $vall + 1;
			}else{
				$cat_arr1[$cat1] = $cnt1 + 1;
			}
		} 
		$this->set('brand_arr',$cat_arr1);
	}
		
	
}
