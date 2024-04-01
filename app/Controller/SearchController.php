<?php
App::uses('AppController', 'Controller');
/**
 * PostAds Controller
 *
 * @property PostAd $PostAd
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SearchController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'RequestHandler');

	
/**
 * index method
 *
 * @return void
 */
	public function index($categorySlug='',$brandSlug='') {
		$this->set('title_for_layout','Search List');
		
		//=================================
		if($categorySlug!='' && $brandSlug!=''){
			if(!is_numeric($categorySlug)){
				$this->loadModel('ManageCategory');
				$catResult=$this->ManageCategory->find('first', array('conditions' => array('slug' => $categorySlug)));
			}else{
				$this->loadModel('ManageCategory');
				$catResult=$this->ManageCategory->find('first', array('conditions' => array('slug' => $categorySlug)));
				if(count($catResult)<=0){
					$catResult=$this->ManageCategory->find('first', array('conditions' => array('category_id' => $categorySlug)));
				}
			}
			if(!is_numeric($brandSlug)){
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $brandSlug)));
			}else{
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $brandSlug)));
				if(count($brandResult)<=0){
					$brandResult=$this->ManageBrand->find('first', array('conditions' => array('brand_id' => $brandSlug)));
				}
			}
			if(count($catResult)>0){
			$this->request->params['named']['category']=$catResult['ManageCategory']['category_id'];
			}
			if(count($brandResult)>0){
			$this->request->params['named']['brand']=$brandResult['ManageBrand']['brand_id'];
			}
		}else if($categorySlug!='' && $brandSlug==''){
			if(!is_numeric($categorySlug)){
				$this->loadModel('ManageCategory');
				$catResult=$this->ManageCategory->find('first', array('conditions' => array('slug' => $categorySlug)));
			}else{
				$this->loadModel('ManageCategory');
				$catResult=$this->ManageCategory->find('first', array('conditions' => array('slug' => $categorySlug)));
				if(count($catResult)<=0){
					$catResult=$this->ManageCategory->find('first', array('conditions' => array('category_id' => $categorySlug)));
				}
			}
			
			if(count($catResult)>0){
			$this->request->params['named']['category']=$catResult['ManageCategory']['category_id'];
			}else{
				if(!is_numeric($categorySlug)){
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $categorySlug)));
				}else{
					$this->loadModel('ManageBrand');
					$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $categorySlug)));
					if(count($brandResult)<=0){
						$brandResult=$this->ManageBrand->find('first', array('conditions' => array('brand_id' => $categorySlug)));
					}
					//$brandResult=$this->ManageBrand->find('first', array('conditions' => array('brand_id' => $categorySlug)));
				}
				if(count($brandResult)>0){
				$this->request->params['named']['brand']=$brandResult['ManageBrand']['brand_id'];
				}
			}
			
		}
		//print_r($this->request->params['named']);exit;
		//==================================
		$this->loadModel('PostAd');
		
		
		$postkeywords='';
		$category='';
		$currentDate=date("Y-m-d");
		$andwhr=array();
		$orwhr=array();
		array_push($andwhr,array('PostAd.adv_status' =>1));
		array_push($andwhr,array("(case when PostAd.is_promote_list='1' then PromotionAd.is_list_expire >= '".$currentDate."' else PostAd.adv_id !='' end)"));
		
		if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
		{
			$this->loadModel('MasterUser');
			$user_id=urldecode($this->request->params['named']['user_id']);
			$userGet=$this->MasterUser->find('first', array(
				"conditions" => array(
					'AND' => array(
					array('MasterUser.user_id' => $user_id),
					)
				)
			));
			if(count($userGet)>0){
				$this->request->params['named']['seller']=stripslashes($userGet['MasterUser']['first_name'].' '.$userGet['MasterUser']['last_name']);
			}
			array_push($andwhr,array('PostAd.user_id' => $user_id));
			
		}
		if(isset($this->request->params['named']['postkeywords']) && $this->request->params['named']['postkeywords']!='')
		{
			
			$postkeywords=urldecode($this->request->params['named']['postkeywords']);
			//echo $postkeywords;
			$myword=explode(" ", $postkeywords);
			if(!empty($myword))
			{
				foreach($myword as $singword)
				{
					array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$singword.'%'));
					//array_push($andwhr,array('PostAd.adv_details LIKE ' => '%'.$singword.'%'));
				}
			}
			if(!empty($myword))
			{
				foreach($myword as $singword)
				{
					array_push($andwhr,array('OR' => array(array('PostAd.adv_name LIKE ' => '%'.$singword.'%'), array('PostAd.adv_details LIKE ' => '%'.$singword.'%'))));
					//array_push($andwhr,array('PostAd.adv_details LIKE ' => '%'.$singword.'%'));
				}
			}
			/*array_push($orwhr,array('PostAd.adv_name LIKE ' => ''.$postkeywords.'%'));
			array_push($orwhr,array('PostAd.adv_details LIKE ' => ''.$postkeywords.'%'));
			array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$postkeywords.''));
			array_push($orwhr,array('PostAd.adv_details LIKE ' => '%'.$postkeywords.''));
			array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$postkeywords.'%'));
			array_push($orwhr,array('PostAd.adv_details LIKE ' => '%'.$postkeywords.'%'));*/
			/*array_push($orwhr,array('MATCH(PostAd.adv_name) AGAINST(\''. $postkeywords .'\')'));*/
		}
		if(isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')
		{

			$category=urldecode($this->request->params['named']['category']);
			array_push($andwhr,array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)), ));
		}
		if(isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')
		{
			$brand=urldecode($this->request->params['named']['brand']);
			array_push($andwhr,array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),));
		}
		if((isset($this->request->params['named']['start_amt']) && $this->request->params['named']['start_amt']!=''))
		{
			$start_amt=urldecode($this->request->params['named']['start_amt']);
			$end_amt=urldecode($this->request->params['named']['end_amt']);
			array_push($andwhr,array('PostAd.price >= ' => $start_amt,'PostAd.price <= ' => $end_amt));
		}
		if(isset($this->request->params['named']['county']) && $this->request->params['named']['county']!='')
		{

			$county=urldecode($this->request->params['named']['county']);
			array_push($andwhr,array('MasterUser.country_id' =>$county));
		}
		//------------------------
		//highest price
		$setMax=$this->PostAd->query("SET SQL_BIG_SELECTS=1");
		$highprice=$this->PostAd->find('first', array( 
		'joins' =>
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
		'conditions' => array(
			'AND' => array('PostAd.adv_status' =>1),
			),
		'order' =>array('PostAd.price' => 'desc'),
		'limit' => 20));
		$rangeprice=(isset($highprice['PostAd']['price']))? $highprice['PostAd']['price'] : 0;
		$this->set('rangeprice',$rangeprice);
		
		//-------------------------
		//$andconditions=implode(",",$andwhr);
		$this->Paginator->settings = array( 
		'joins' =>
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
		'conditions' => array(
			'AND' => $andwhr,
			'OR' => $orwhr
			),
		'order' =>array('PostAd.is_promote_list' => 'desc', 'PostAd.adv_id' => 'desc'),
		'limit' => 20);
		$this->set('category', $category);
		$this->set('postkeywords', $postkeywords);
		$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
		$this->layout="search";
		//exit;
	}
/**
 * category method
 *
 * @return void
 */
	public function category($categorySlug='',$subCatSlug='') {
		$this->set('title_for_layout','Categories');
		
		//=================================
		if($categorySlug!='' && $subCatSlug!=''){
			if(!is_numeric($subCatSlug)){
				$this->loadModel('ManageCategory');
				$catResult=$this->ManageCategory->find('first', array('conditions' => array('slug' => $subCatSlug)));
			}else{
				$this->loadModel('ManageCategory');
				$catResult=$this->ManageCategory->find('first', array('conditions' => array('slug' => $subCatSlug)));
				if(count($catResult)<=0){
					$catResult=$this->ManageCategory->find('first', array('conditions' => array('category_id' => $subCatSlug)));
				}
			}
			
			if(count($catResult)>0){
			$this->request->params['named']['category']=$catResult['ManageCategory']['category_id'];
			}
			
		}else if($categorySlug!='' && $subCatSlug==''){
			if(!is_numeric($categorySlug)){
				$this->loadModel('ManageCategory');
				$catResult=$this->ManageCategory->find('first', array('conditions' => array('slug' => $categorySlug)));
			}else{
				$this->loadModel('ManageCategory');
				$catResult=$this->ManageCategory->find('first', array('conditions' => array('category_id' => $categorySlug)));
			}
			
			if(count($catResult)>0){
			$this->request->params['named']['category']=$catResult['ManageCategory']['category_id'];
			}
			
		}

		//print_r($this->request->params['named']);exit;
		//==================================
		$this->loadModel('PostAd');
		
		
		$postkeywords='';
		$category='';
		$currentDate=date("Y-m-d");
		$andwhr=array();
		$orwhr=array();
		array_push($andwhr,array('PostAd.adv_status' =>1));
		array_push($andwhr,array("(case when PostAd.is_promote_list='1' then PromotionAd.is_list_expire >= '".$currentDate."' else PostAd.adv_id !='' end)"));
		
		if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
		{
			$this->loadModel('MasterUser');
			$user_id=urldecode($this->request->params['named']['user_id']);
			$userGet=$this->MasterUser->find('first', array(
				"conditions" => array(
					'AND' => array(
					array('MasterUser.user_id' => $user_id),
					)
				)
			));
			if(count($userGet)>0){
				$this->request->params['named']['seller']=stripslashes($userGet['MasterUser']['first_name'].' '.$userGet['MasterUser']['last_name']);
			}
			array_push($andwhr,array('PostAd.user_id' => $user_id));
			
		}
		if(isset($this->request->params['named']['postkeywords']) && $this->request->params['named']['postkeywords']!='')
		{
			
			$postkeywords=urldecode($this->request->params['named']['postkeywords']);
			//echo $postkeywords;
			$myword=explode(" ", $postkeywords);
			if(!empty($myword))
			{
				foreach($myword as $singword)
				{
					array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$singword.'%'));
					//array_push($andwhr,array('PostAd.adv_details LIKE ' => '%'.$singword.'%'));
				}
			}
			if(!empty($myword))
			{
				foreach($myword as $singword)
				{
					array_push($andwhr,array('OR' => array(array('PostAd.adv_name LIKE ' => '%'.$singword.'%'), array('PostAd.adv_details LIKE ' => '%'.$singword.'%'))));
					//array_push($andwhr,array('PostAd.adv_details LIKE ' => '%'.$singword.'%'));
				}
			}
			/*array_push($orwhr,array('PostAd.adv_name LIKE ' => ''.$postkeywords.'%'));
			array_push($orwhr,array('PostAd.adv_details LIKE ' => ''.$postkeywords.'%'));
			array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$postkeywords.''));
			array_push($orwhr,array('PostAd.adv_details LIKE ' => '%'.$postkeywords.''));
			array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$postkeywords.'%'));
			array_push($orwhr,array('PostAd.adv_details LIKE ' => '%'.$postkeywords.'%'));*/
			/*array_push($orwhr,array('MATCH(PostAd.adv_name) AGAINST(\''. $postkeywords .'\')'));*/
		}
		if(isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')
		{

			$category=urldecode($this->request->params['named']['category']);
			array_push($andwhr,array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)), ));
		}
		
		if(isset($this->request->params['named']['model']) && $this->request->params['named']['model']!='')
		{
			$brand=urldecode($this->request->params['named']['brand']);
			$this->request->params['named']['selectBrand']=$brand;
			$model=urldecode($this->request->params['named']['model']);
			if(!is_numeric($model)){
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $model)));
			}else{
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $model)));
				if(count($brandResult)<=0){
					$brandResult=$this->ManageBrand->find('first', array('conditions' => array('brand_id' => $model)));
				}
			}
			if(count($brandResult)>0){
			$this->request->params['named']['brand']=$brandResult['ManageBrand']['brand_id'];
			}
			$brand=$this->request->params['named']['brand'];
			array_push($andwhr,array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),));
		}elseif(isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')
		{
			$brand=urldecode($this->request->params['named']['brand']);
			$this->request->params['named']['selectBrand']=$brand;
			if(!is_numeric($brand)){
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $brand)));
			}else{
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $brand)));
				if(count($brandResult)<=0){
					$brandResult=$this->ManageBrand->find('first', array('conditions' => array('brand_id' => $brand)));
				}
			}
			if(count($brandResult)>0){
			$this->request->params['named']['brand']=$brandResult['ManageBrand']['brand_id'];
			}
			$brand=$this->request->params['named']['brand'];
			array_push($andwhr,array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),));
		}
		if((isset($this->request->params['named']['start_amt']) && $this->request->params['named']['start_amt']!=''))
		{
			$start_amt=urldecode($this->request->params['named']['start_amt']);
			$end_amt=urldecode($this->request->params['named']['end_amt']);
			array_push($andwhr,array('PostAd.price >= ' => $start_amt,'PostAd.price <= ' => $end_amt));
		}
		if(isset($this->request->params['named']['county']) && $this->request->params['named']['county']!='')
		{

			$county=urldecode($this->request->params['named']['county']);
			array_push($andwhr,array('MasterUser.country_id' =>$county));
		}
		//------------------------
		//highest price
		$setMax=$this->PostAd->query("SET SQL_BIG_SELECTS=1");
		$highprice=$this->PostAd->find('first', array( 
		'joins' =>
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
		'conditions' => array(
			'AND' => array('PostAd.adv_status' =>1),
			),
		'order' =>array('PostAd.price' => 'desc'),
		'limit' => 20));
		$rangeprice=(isset($highprice['PostAd']['price']))? $highprice['PostAd']['price'] : 0;
		$this->set('rangeprice',$rangeprice);
		
		//-------------------------
		//$andconditions=implode(",",$andwhr);
		$this->Paginator->settings = array( 
		'joins' =>
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
		'conditions' => array(
			'AND' => $andwhr,
			'OR' => $orwhr
			),
		'order' =>array('PostAd.is_promote_list' => 'desc', 'PostAd.adv_id' => 'desc'),
		'limit' => 20);
		$this->set('category', $category);
		$this->set('postkeywords', $postkeywords);
		$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
		$this->layout="search";
		//exit;
	}

/**
 * Brand ad list method
 *
 * @return void
 */
	public function brand($brandSlug='',$subbrandSlug='') {
		$this->set('title_for_layout','Brands');
		
		//=================================
		if($brandSlug!='' && $subbrandSlug!=''){
			
			if(!is_numeric($subbrandSlug)){
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $subbrandSlug)));
			}else{
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $subbrandSlug)));
				if(count($brandResult)<=0){
					$brandResult=$this->ManageBrand->find('first', array('conditions' => array('brand_id' => $subbrandSlug)));
				}
			}
			if(count($brandResult)>0){
			$this->request->params['named']['brand']=$brandResult['ManageBrand']['brand_id'];
			}
		}else if($brandSlug!='' && $subbrandSlug==''){
			if(!is_numeric($brandSlug)){
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $brandSlug)));
			}else{
				$this->loadModel('ManageBrand');
				$brandResult=$this->ManageBrand->find('first', array('conditions' => array('slug' => $brandSlug)));
				if(count($brandResult)<=0){
					$brandResult=$this->ManageBrand->find('first', array('conditions' => array('brand_id' => $brandSlug)));
				}
			}
			if(count($brandResult)>0){
			$this->request->params['named']['brand']=$brandResult['ManageBrand']['brand_id'];
			}
			
		}
		//print_r($this->request->params['named']);exit;
		//==================================
		$this->loadModel('PostAd');
		
		
		$postkeywords='';
		$category='';
		$currentDate=date("Y-m-d");
		$andwhr=array();
		$orwhr=array();
		array_push($andwhr,array('PostAd.adv_status' =>1));
		array_push($andwhr,array("(case when PostAd.is_promote_list='1' then PromotionAd.is_list_expire >= '".$currentDate."' else PostAd.adv_id !='' end)"));
		
		if(isset($this->request->params['named']['user_id']) && $this->request->params['named']['user_id']!='')
		{
			$this->loadModel('MasterUser');
			$user_id=urldecode($this->request->params['named']['user_id']);
			$userGet=$this->MasterUser->find('first', array(
				"conditions" => array(
					'AND' => array(
					array('MasterUser.user_id' => $user_id),
					)
				)
			));
			if(count($userGet)>0){
				$this->request->params['named']['seller']=stripslashes($userGet['MasterUser']['first_name'].' '.$userGet['MasterUser']['last_name']);
			}
			array_push($andwhr,array('PostAd.user_id' => $user_id));
			
		}
		if(isset($this->request->params['named']['postkeywords']) && $this->request->params['named']['postkeywords']!='')
		{
			
			$postkeywords=urldecode($this->request->params['named']['postkeywords']);
			//echo $postkeywords;
			$myword=explode(" ", $postkeywords);
			if(!empty($myword))
			{
				foreach($myword as $singword)
				{
					array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$singword.'%'));
					//array_push($andwhr,array('PostAd.adv_details LIKE ' => '%'.$singword.'%'));
				}
			}
			if(!empty($myword))
			{
				foreach($myword as $singword)
				{
					array_push($andwhr,array('OR' => array(array('PostAd.adv_name LIKE ' => '%'.$singword.'%'), array('PostAd.adv_details LIKE ' => '%'.$singword.'%'))));
					//array_push($andwhr,array('PostAd.adv_details LIKE ' => '%'.$singword.'%'));
				}
			}
			/*array_push($orwhr,array('PostAd.adv_name LIKE ' => ''.$postkeywords.'%'));
			array_push($orwhr,array('PostAd.adv_details LIKE ' => ''.$postkeywords.'%'));
			array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$postkeywords.''));
			array_push($orwhr,array('PostAd.adv_details LIKE ' => '%'.$postkeywords.''));
			array_push($orwhr,array('PostAd.adv_name LIKE ' => '%'.$postkeywords.'%'));
			array_push($orwhr,array('PostAd.adv_details LIKE ' => '%'.$postkeywords.'%'));*/
			/*array_push($orwhr,array('MATCH(PostAd.adv_name) AGAINST(\''. $postkeywords .'\')'));*/
		}
		if(isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')
		{

			$category=urldecode($this->request->params['named']['category']);
			array_push($andwhr,array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)), ));
		}
		if(isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')
		{
			$brand=urldecode($this->request->params['named']['brand']);
			array_push($andwhr,array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),));
		}
		if((isset($this->request->params['named']['start_amt']) && $this->request->params['named']['start_amt']!=''))
		{
			$start_amt=urldecode($this->request->params['named']['start_amt']);
			$end_amt=urldecode($this->request->params['named']['end_amt']);
			array_push($andwhr,array('PostAd.price >= ' => $start_amt,'PostAd.price <= ' => $end_amt));
		}
		if(isset($this->request->params['named']['county']) && $this->request->params['named']['county']!='')
		{

			$county=urldecode($this->request->params['named']['county']);
			array_push($andwhr,array('MasterUser.country_id' =>$county));
		}
		//------------------------
		//highest price
		$setMax=$this->PostAd->query("SET SQL_BIG_SELECTS=1");
		$highprice=$this->PostAd->find('first', array( 
		'joins' =>
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
		'conditions' => array(
			'AND' => array('PostAd.adv_status' =>1),
			),
		'order' =>array('PostAd.price' => 'desc'),
		'limit' => 20));
		$rangeprice=(isset($highprice['PostAd']['price']))? $highprice['PostAd']['price'] : 0;
		$this->set('rangeprice',$rangeprice);
		
		//-------------------------
		//$andconditions=implode(",",$andwhr);
		$this->Paginator->settings = array( 
		'joins' =>
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
		'conditions' => array(
			'AND' => $andwhr,
			'OR' => $orwhr
			),
		'order' =>array('PostAd.is_promote_list' => 'desc', 'PostAd.adv_id' => 'desc'),
		'limit' => 20);
		$this->set('category', $category);
		$this->set('postkeywords', $postkeywords);
		$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
		$this->layout="search";
		//exit;
	}
/**
 * Img list method
 *
 * @return void
 */
	 public function getfirstimg($id=null)
	 {
		 $this->loadModel('PostAd');
		 if (!$this->PostAd->exists($id)) {
			throw new NotFoundException(__('Invalid post ad'));
		}
		$this->loadModel('PostadImg');
		$imglist=$this->PostadImg->find('first', array('conditions' => array('post_ad_id' => $id), 'order' => array('imgid' => 'asc')));
		return ($imglist);
	 }
	 public function addtofavourite()
	 {
		 if($this->request->is('post'))
		 {
			 if($this->Session->check('User'))
			 {
				 $advid=$this->request->data['advid'];
				 $user=$this->Session->read('User');
				 $user_id=$user['user_id'];
				 $ipaddress=$this->RequestHandler->getClientIp();
				 $this->loadModel('SalesAddToFavourite');
				 $checkfav=$this->SalesAddToFavourite->find('first', array('conditions' => array('user_id' => $user_id, 'adv_id' => $advid)));
				 if(count($checkfav)>0)
				 {
					 echo 3;
				 }
				 else
				 {
				 	$options=array('user_id' => $user_id, 'adv_id' => $advid, 'ip_address' => $ipaddress, 'favcount' => 1);
					if( $this->SalesAddToFavourite->save($options))
					{
						echo 1;
					}
					else
					{
						echo 2;
					}
				 }
			 }
			 else
			 {
				 echo 4;
			 }
		 }
		  exit;
	 }
	  public function salesRating()
	 {
		 if($this->request->is('post'))
		 {
			 if($this->Session->check('User'))
			 {
				 $advid=$this->request->data['advid'];
				 $ratingval=$this->request->data['ratingval'];
				 $user=$this->Session->read('User');
				 $user_id=$user['user_id'];
				 $ipaddress=$this->RequestHandler->getClientIp();
				 $this->loadModel('SalesRating');
				 $checkrating=$this->SalesRating->find('first', array('conditions' => array('user_id' => $user_id, 'adv_id' => $advid)));
				 if(count($checkrating)>0)
				 {
					 $options=array('rating_id' => $checkrating['SalesRating']['rating_id'], 'user_id' => $user_id, 'adv_id' => $advid, 'user_id' => $user_id, 'rating' => $ratingval);
					if( $this->SalesRating->save($options))
					{
						echo 3;
					}
					else
					{
						echo 2;
					}
				 }
				 else
				 {
				 	$options=array('user_id' => $user_id, 'adv_id' => $advid, 'user_id' => $user_id, 'rating' => $ratingval);
					if( $this->SalesRating->save($options))
					{
						echo 1;
					}
					else
					{
						echo 2;
					}
				 }
			 }
			 else
			 {
				 echo 4;
			 }
		 }
		  exit;
	 }
	 public function Ratingval(){
		 $advid=$this->request->data['advid'];
		 $ratingval=$this->request->data['ratingval'];
		 $user=$this->Session->read('User');
		 $user_id=$user['user_id'];
		 $ipaddress=$this->RequestHandler->getClientIp();
		 $this->loadModel('SalesRating');
		 $checkrating=$this->SalesRating->find('first', array('conditions' => array('user_id' => $user_id, 'adv_id' => $advid)));
		 if(!empty($checkrating))
		 {
			 echo $checkrating['SalesRating']['rating'];
		 }
		 exit;
	 }
	  public function parksRating()
	 {
		 if($this->request->is('post'))
		 {
			 if($this->Session->check('User'))
			 {
				 $park_id=$this->request->data['park_id'];
				 $ratingval=$this->request->data['ratingval'];
				 $rating_from=$this->request->data['rating_from'];
				 $user=$this->Session->read('User');
				 $user_id=$user['user_id'];
				 $ipaddress=$this->RequestHandler->getClientIp();
				 $this->loadModel('ParkRating');
				 $checkrating=$this->ParkRating->find('first', array('conditions' => array('user_id' => $user_id, 'park_id' => $park_id)));
				 if(count($checkrating)>0)
				 {
					 $options=array('id' => $checkrating['ParkRating']['id'], 'user_id' => $user_id, 'park_id' => $park_id, 'ratingno' => $ratingval, 'rating_from' => $rating_from);
					if( $this->ParkRating->save($options))
					{
						echo 3;
					}
					else
					{
						echo 2;
					}
				 }
				 else
				 {
				 	$options=array('user_id' => $user_id, 'park_id' => $park_id, 'ratingno' => $ratingval, 'rating_from' => $rating_from);
					if( $this->ParkRating->save($options))
					{
						echo 1;
					}
					else
					{
						echo 2;
					}
				 }
			 }
			 else
			 {
				 echo 4;
			 }
		 }
		  exit;
	 }
	  public function parksRatingval(){
		  $park_id=$this->request->data['park_id'];
		 $ratingval=$this->request->data['ratingval'];
		 $user=$this->Session->read('User');
		 $user_id=$user['user_id'];
		 $rating_from=$this->request->data['rating_from'];
		 $ipaddress=$this->RequestHandler->getClientIp();
		 $this->loadModel('ParkRating');
		 $checkrating=$this->ParkRating->find('all', array('conditions' => array('rating_from' => $rating_from, 'park_id' => $park_id)));
		 $ratingtotal=0;
		 if(!empty($checkrating))
		 {
			 foreach($checkrating as $ratingRes)
			 {
			 $ratingtotal+=$ratingRes['ParkRating']['ratingno'];
			 }
			 $avgpercent=$ratingtotal/count($checkrating);
			 $roundavg=round($avgpercent);
			?>
             <div class="col-lg-4">
                <div class="row"> 
             Rating:
             <?php 
                    if(!empty($avgpercent))
                    {
						for($cost_trans=1; $cost_trans<=$roundavg; $cost_trans++)
						{
							if($cost_trans>$avgpercent)
							{
								?>
                                <img border="0" src="<?php echo Router::url('/', true);?>/images/star-small-halfactive.png" alt="rating" />
                                <?php
							}
							else
							{
							?>
                            <img border="0" src="<?php echo Router::url('/', true);?>/images/star-small-active.png" alt="rating" />
                            <?php
							}
						}
                    }
					if(round($avgpercent)<5)
					{
						for($cost=5; $roundavg<$cost; $cost--)
						{
							?>
                            <img border="0" src="<?php echo Router::url('/', true);?>/images/star-small-inactive.png">   
                            <?php
						}
					}
                    ?>
                                   &nbsp; &nbsp;  <span class="grn_txt"> <strong> <?php echo $avgpercent;?> / 5</strong></span>  
                                   </div></div>
                                    
                                    
                                     <div class="col-lg-4">
                                           <div class="row"> 
                                                 <span class="op7">Average Rating <?php echo $avgpercent;?> out of <?php echo count($checkrating);?> votes.</span>
                                           </div>
                                     </div>
            <?php
		 }
		 exit;
	 }
	public function viewsave()
	{
		if($this->request->is('post'))
		{
			$advid=$this->request->data['advid'];
		$this->loadModel('PostAd');
			 if (!$this->PostAd->exists($advid)) {
				echo 2;
			}
			else
			{
				$ipaddress=$this->RequestHandler->getClientIp();
				$this->loadModel('SalesView');
				$options=array('adv_id' => $advid, 'ip_address' => $ipaddress);
				if($this->SalesView->save($options))
				{
					echo 1;
				}
				else
				{
					echo 3;
				}
			}
		}
		exit;
	}
	public function getuserid(){
		if($this->request->is('post')){
			$username=$this->request->data['username'];
			$this->loadModel('MasterUser');
			$userGet=$this->MasterUser->find('first', array(
				"conditions" => array(
					'OR' => array(
					array('MasterUser.first_name' => $username),
					array('MasterUser.last_name' => $username),
					array('CONCAT(MasterUser.first_name," ",MasterUser.last_name)' => $username),
					)
				)
			));
			if(count($userGet)>0){
				echo $userGet['MasterUser']['user_id'];
			}
			else{
				echo 0;
			}
		}
		exit();
	}
}
