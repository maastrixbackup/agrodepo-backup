<?php
App::uses('AppController', 'Controller');
App::uses('resize', 'Vendor');
App::uses('CakeEmail', 'Network/Email');
/**

 * PostAds Controller

 *

 * @property PostAd $PostAd

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class PostAdsController extends AppController {



/**

 * Components

 *

 * @var array

 */

	public $components = array('Paginator', 'Session', 'Dez', 'RequestHandler');

	//public $helpers = array('Custom');



	public function beforeFilter(){



			if(!$this->Session->check('User'))

			{

				/*$customPath='/';

				if(isset($this->request->params['controller']))

				{

					$customPath.=$this->request->params['controller'].'/';

				}

				if(isset($this->request->params['action']))

				{

					$customPath.=$this->request->params['action'].'/';

				}*/

				$customPath= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

				//$customPath=$_SERVER['HTTP_REFERER']

				$this->Session->write('redirectLink',$customPath);

				return $this->redirect(Router::url('/Logins/login', true));

			}





		}

/**

 * index method

 *

 * @return void

 */

	public function index() {

		$this->set('title_for_layout','Active Sales');
		$user_session=$this->Session->read('User');

		$userid=$user_session['user_id'];

		$userstatus=$user_session['is_active'];

		$this->PostAd->recursive = 0;

		$this->Paginator->settings = array('conditions' => array('PostAd.adv_status' =>1,'PostAd.user_id' =>$userid ),'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => 10);

		$this->set('postAds', $this->Paginator->paginate());

		$alladd=$this->PostAd->find('all', array('conditions' => array('PostAd.adv_status' =>1,'PostAd.user_id' =>$userid ),'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => 10));

		$this->set('alladd', $alladd);

		$this->layout='active_sales';

	}

/**

 * Delete Ad method

 *

 * @return void

 */

	public function deletead() {

		$this->set('title_for_layout','Delete ads');

		$user_session=$this->Session->read('User');
		$userid=$user_session['user_id'];

		$userstatus=$user_session['is_active'];

		$this->PostAd->recursive = 0;

		$this->Paginator->settings = array('conditions' => array('PostAd.adv_status' =>2,'PostAd.user_id' =>$userid ),'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => 10);

		$this->set('postAds', $this->Paginator->paginate());

		$alladd=$this->PostAd->find('all', array('conditions' => array('PostAd.adv_status' =>2,'PostAd.user_id' =>$userid ),'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => 10));

		$this->set('alladd', $alladd);

		$this->layout='active_sales';

	}

/**

 * Search method

 *

 * @return void

 */

	public function search() {

		$this->set('title_for_layout','Active Sales');

		$user_session=$this->Session->read('User');

		$userid=$user_session['user_id'];

		$userstatus=$user_session['is_active'];

		//echo "<pre>";print_r($this->Session->read('User'));exit;

		$this->PostAd->recursive = 0;

		if(isset($this->request->params['named']['perpage'])){$perpage=$this->request->params['named']['perpage'];}else{$perpage=10;}

		$searchtxt='';

		if(((isset($this->request->params['named']['searchtxt']) && $this->request->params['named']['searchtxt']!='')) && ((isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')) && ((isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')))

		{

			//Search !='' && brand!='' && category!=''
			$searchtxt=urldecode($this->request->params['named']['searchtxt']);

			$category=urldecode($this->request->params['named']['category']);

			$brand=urldecode($this->request->params['named']['brand']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>1),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)), ),

		array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),),

		),

		"OR" => array(

		array('PostAd.adv_name LIKE ' => '%'.$searchtxt.'%'),

            array('PostAd.adv_details LIKE ' => '%'.$searchtxt.'%'),

			)),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['searchtxt']) && $this->request->params['named']['searchtxt']!='')) && ((isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')) && (!isset($this->request->params['named']['brand'])))

		{

			//Search !='' && brand=='' && category!=''

			$searchtxt=urldecode($this->request->params['named']['searchtxt']);

			$category=urldecode($this->request->params['named']['category']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>1),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)),),

		),

		"OR" => array(

		array('PostAd.adv_name LIKE ' => '%'.$searchtxt.'%'),

            array('PostAd.adv_details LIKE ' => '%'.$searchtxt.'%'),

			)),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);

		}

		else if(((isset($this->request->params['named']['searchtxt']) && $this->request->params['named']['searchtxt']!='')) && ((isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')) && (!isset($this->request->params['named']['category'])))

		{

			//Search !='' && brand!='' && category==''

			$searchtxt=urldecode($this->request->params['named']['searchtxt']);

			$brand=urldecode($this->request->params['named']['brand']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>1),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),)

		),

		"OR" => array(

		array('PostAd.adv_name LIKE ' => '%'.$searchtxt.'%'),

            array('PostAd.adv_details LIKE ' => '%'.$searchtxt.'%'),

			)),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')) && ((isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')) && (!isset($this->request->params['named']['searchtxt'])))

		{

			//Search =='' && brand!='' && category!=''

			$brand=urldecode($this->request->params['named']['brand']);

			$category=urldecode($this->request->params['named']['category']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>1),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),),

		array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)),)

		),

		),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['searchtxt']) && $this->request->params['named']['searchtxt']!='')) && (!isset($this->request->params['named']['brand'])) && (!isset($this->request->params['named']['category'])))

		{

			//Search !='' && brand=='' && category==''

			$searchtxt=urldecode($this->request->params['named']['searchtxt']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>1),

		array('PostAd.user_id' =>$userid),

		),

		"OR" => array(

		array('PostAd.adv_name LIKE ' => '%'.$searchtxt.'%'),

            array('PostAd.adv_details LIKE ' => '%'.$searchtxt.'%'),

			)),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')) && (!isset($this->request->params['named']['brand'])) && (!isset($this->request->params['named']['searchtxt'])))

		{

			//Search =='' && brand=='' && category!=''

			$category=urldecode($this->request->params['named']['category']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>1),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)),),

		),

		),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')) && (!isset($this->request->params['named']['category'])) && (!isset($this->request->params['named']['searchtxt'])))

		{

			//Search =='' && brand!='' && category==''

			$brand=urldecode($this->request->params['named']['brand']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>1),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),),

		),

		),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else

		{

			$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>1),

		array('PostAd.user_id' =>$userid),

		),

		),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);

			//return $this->redirect(array('action' => 'index/'));

		}

		$this->set('searchtxt',$searchtxt);

		$this->set('postAds', $this->Paginator->paginate());

		$alladd=$this->PostAd->find('all', array('conditions' => array('PostAd.adv_status' =>1,'PostAd.user_id' =>$userid ),'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => 10));

		$this->set('alladd', $alladd);

		$this->layout='active_sales';

	}



/**

 * Delete Search method

 *

 * @return void

 */

	public function deletesearch() {



		$user_session=$this->Session->read('User');

		$userid=$user_session['user_id'];

		$userstatus=$user_session['is_active'];

		//echo "<pre>";print_r($this->Session->read('User'));exit;

		$this->PostAd->recursive = 0;

		if(isset($this->request->params['named']['perpage'])){$perpage=$this->request->params['named']['perpage'];}else{$perpage=10;}

		$searchtxt='';

		if(((isset($this->request->params['named']['searchtxt']) && $this->request->params['named']['searchtxt']!='')) && ((isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')) && ((isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')))

		{

			//Search !='' && brand!='' && category!=''

			$searchtxt=urldecode($this->request->params['named']['searchtxt']);

			$category=urldecode($this->request->params['named']['category']);

			$brand=urldecode($this->request->params['named']['brand']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>2),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)), ),

		array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),),

		),

		"OR" => array(

		array('PostAd.adv_name LIKE ' => '%'.$searchtxt.'%'),

            array('PostAd.adv_details LIKE ' => '%'.$searchtxt.'%'),

			)),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['searchtxt']) && $this->request->params['named']['searchtxt']!='')) && ((isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')) && (!isset($this->request->params['named']['brand'])))

		{

			//Search !='' && brand=='' && category!=''

			$searchtxt=urldecode($this->request->params['named']['searchtxt']);

			$category=urldecode($this->request->params['named']['category']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>2),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)),),

		),

		"OR" => array(

		array('PostAd.adv_name LIKE ' => '%'.$searchtxt.'%'),

            array('PostAd.adv_details LIKE ' => '%'.$searchtxt.'%'),

			)),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['searchtxt']) && $this->request->params['named']['searchtxt']!='')) && ((isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')) && (!isset($this->request->params['named']['category'])))

		{

			//Search !='' && brand!='' && category==''

			$searchtxt=urldecode($this->request->params['named']['searchtxt']);

			$brand=urldecode($this->request->params['named']['brand']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>2),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),)

		),

		"OR" => array(

		array('PostAd.adv_name LIKE ' => '%'.$searchtxt.'%'),

            array('PostAd.adv_details LIKE ' => '%'.$searchtxt.'%'),

			)),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')) && ((isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')) && (!isset($this->request->params['named']['searchtxt'])))

		{

			//Search =='' && brand!='' && category!=''

			$brand=urldecode($this->request->params['named']['brand']);

			$category=urldecode($this->request->params['named']['category']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>2),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),),

		array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)),)

		),

		),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['searchtxt']) && $this->request->params['named']['searchtxt']!='')) && (!isset($this->request->params['named']['brand'])) && (!isset($this->request->params['named']['category'])))

		{

			//Search !='' && brand=='' && category==''

			$searchtxt=urldecode($this->request->params['named']['searchtxt']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>2),

		array('PostAd.user_id' =>$userid),

		),

		"OR" => array(

		array('PostAd.adv_name LIKE ' => '%'.$searchtxt.'%'),

            array('PostAd.adv_details LIKE ' => '%'.$searchtxt.'%'),

			)),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['category']) && $this->request->params['named']['category']!='')) && (!isset($this->request->params['named']['brand'])) && (!isset($this->request->params['named']['searchtxt'])))

		{

			//Search =='' && brand=='' && category!=''

			$category=urldecode($this->request->params['named']['category']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>2),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('PostAd.category_id' =>$category),array('PostAd.sub_cat_id' =>$category)),),

		),

		),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else if(((isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']!='')) && (!isset($this->request->params['named']['category'])) && (!isset($this->request->params['named']['searchtxt'])))

		{

			//Search =='' && brand!='' && category==''

			$brand=urldecode($this->request->params['named']['brand']);

		$this->Paginator->settings = array('conditions' => array(

		"AND" => array(

		array('PostAd.adv_status' =>2),

		array('PostAd.user_id' =>$userid),

		array('OR' => array(array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $brand .'\',PostAd.adv_model_id)')),),

		),

		),

		'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);



		}

		else

		{

			$this->Paginator->settings = array('conditions' => array(

			"AND" => array(

			array('PostAd.adv_status' =>2),

			array('PostAd.user_id' =>$userid),

			),

			),

			'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => $perpage);

		}

		$this->set('searchtxt',$searchtxt);

		$this->set('postAds', $this->Paginator->paginate());

		$alladd=$this->PostAd->find('all', array('conditions' => array('PostAd.adv_status' =>2,'PostAd.user_id' =>$userid ),'order' =>array('PostAd.adv_id' => 'desc'), 'limit' => 10));

		$this->set('alladd', $alladd);

		$this->layout='active_sales';

	}

/**

 * view method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function view($id = null) {

		if (!$this->PostAd->exists($id)) {

			throw new NotFoundException(__('Invalid post ad'));

		}

		$options = array('conditions' => array('PostAd.' . $this->PostAd->primaryKey => $id));

		$this->set('postAd', $this->PostAd->find('first', $options));

	}



/**

 * add method

 *

 * @return void

 */

	public function add($id='') {

		$user_session=$this->Session->read('User');

		$userid=$user_session['user_id'];

		$this->set('title_for_layout','Add Sales');

		$this->loadModel('SalesCategory');

		$cat_list = $this->SalesCategory->find('list', array('conditions'=>array('SalesCategory.flag'=>0,'SalesCategory.status'=>1),'fields'=>array('SalesCategory.category_id','SalesCategory.category_name'), 'order' => array('category_name' => 'asc')));

		$this->set('cat_list',$cat_list);

		$this->loadModel('SalesBrand');

		$brand_list = $this->SalesBrand->find('list', array('conditions'=>array('SalesBrand.flag'=>0,'SalesBrand.status'=>1),'fields'=>array('SalesBrand.brand_id','SalesBrand.brand_name'), 'order' => array('brand_name' => 'asc')));

		$this->set("brand_list",$brand_list);

		if ($this->request->is(array('post','put'))) {

			if($this->Session->check('postAdsID')){

				$id=$this->Session->read('postAdsID');

				$this->request->data['PostAd']['adv_id']=$id;

			}

			else

			{
				if($id!=''){
					$this->request->data['PostAd']['adv_id']=$id;
					$this->Session->write('postAdsID',$id);
				}else{
				$this->PostAd->create();
				}

			}

			$this->request->data['PostAd']['user_id']=$userid;

				$this->loadModel('MasterMessage');

		$brandBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 11)));

		$modelBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 12)));

			if(!isset($this->request->data['PostAd']['adv_brand']))

		{

			if($this->request->data['PostAd']['adv_brand_id']=='' && $this->request->data['PostAd']['adv_model_id']=='')

			{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$brandBlank['MasterMessage']['msg'].'</div>'));

			}

			else

			{

				$this->Session->setFlash(__('<div class="alert alert-danger">'.$modelBlank['MasterMessage']['msg'].'</div>'));

			}

		}

		else if(!isset($this->request->data['PostAd']['adv_model']))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$modelBlank['MasterMessage']['msg'].'</div>'));

		}

		else

		{

			$this->request->data['PostAd']['adv_brand_id']=implode(",",$this->request->data['PostAd']['adv_brand']);

			$this->request->data['PostAd']['adv_model_id']=implode(",",$this->request->data['PostAd']['adv_model']);

			if ($this->PostAd->save($this->request->data)) {

				//$this->Session->setFlash(__('The post ad has been saved.'));

				if(!$this->Session->check('postAdsID')){

				$lastid=$this->PostAd->getLastInsertID();

				$this->Session->write('postAdsID',$lastid);

				}

				else

				{

					$lastid=$this->Session->read('postAdsID');

				}

				return $this->redirect(array('action' => 'productdescription/'.$lastid));

			} else {

				$this->Session->setFlash(__('<div class="alert alert-danger">The post ad could not be saved. Please, try again.</div>'));

			}

		}

		}

		else {

			if($this->Session->check('postAdsID')){

				$id=$this->Session->read('postAdsID');

			}

			if($id!='')

			{

			$options = array('conditions' => array('PostAd.' . $this->PostAd->primaryKey => $id));

			$this->request->data = $this->PostAd->find('first', $options);

			}

		}

		$this->layout='post_category';

	}



/**

 * edit method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function edit($id = null) {

		if (!$this->PostAd->exists($id)) {

			throw new NotFoundException(__('Invalid post ad'));

		}

		if ($this->request->is(array('post', 'put'))) {

			if ($this->PostAd->save($this->request->data)) {

				$this->Session->setFlash(__('The post ad has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The post ad could not be saved. Please, try again.'));

			}

		} else {

			$options = array('conditions' => array('PostAd.' . $this->PostAd->primaryKey => $id));

			$this->request->data = $this->PostAd->find('first', $options);

		}

	}

	/**

 * Productdetails method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function productdescription($id = null) {

		$this->set('title_for_layout','Add Description');

		if(!$this->Session->check('postAdsID'))

		{

			if (!$this->PostAd->exists($id)) {

			throw new NotFoundException(__('Invalid post ad'));

			}

		}

		else

		{

			$id=$this->Session->read('postAdsID');



		}

		$this->loadModel('MasterMessage');

		$descBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 10)));

		$descLength=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 9)));

		$brandBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 11)));

		$modelBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 12)));

		$priceBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 13)));

		$qtyBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 14)));

		$paymentModeblank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 15)));

		$deliveryMethodBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 16)));

		$costBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 17)));

		$secondStep=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 18)));

		$updMag=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 19)));

		$imgBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 20)));

		$uptoImg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 21)));

		$moreImg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 22)));

		$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 23)));

		$this->loadModel('SalesCategory');

		$this->loadModel('SalesBrand');

		$cat_list = $this->SalesCategory->find('list', array('conditions'=>array('SalesCategory.flag'=>0,'SalesCategory.status'=>1),'fields'=>array('SalesCategory.category_id','SalesCategory.category_name'), 'order' => array('category_name' => 'asc')));

		$this->set('cat_list',$cat_list);

		$brand_list = $this->SalesBrand->find('list', array('conditions'=>array('SalesBrand.flag'=>0,'SalesBrand.status'=>1),'fields'=>array('SalesBrand.brand_id','SalesBrand.brand_name'), 'order' => array('brand_name' => 'asc')));

		$this->set("brand_list",$brand_list);



		if ($this->request->is(array('post', 'put'))) {



			/*$paymentmodearr=array_filter($this->request->data['PostAd']['payment_mode']);

			$personal_teaching=$this->request->data['PostAd']['personal_teaching'];

			$courier=$this->request->data['PostAd']['courier'];

			$romanian_mail=$this->request->data['PostAd']['romanian_mail'];

			$courier_cost=$this->request->data['PostAd']['courier_cost'];

			$romanian_mail_cost=$this->request->data['PostAd']['romanian_mail_cost'];

			$free_courier=$this->request->data['PostAd']['free_courier'];

			$free_romanian_mail=$this->request->data['PostAd']['free_romanian_mail'];*/

		if($this->request->data['PostAd']['adv_details']=='')

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$descBlank['MasterMessage']['msg'].'</div>'));

		}

		else if(strlen($this->request->data['PostAd']['adv_details'])<45)

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$descLength['MasterMessage']['msg'].'</div>'));

		}

		/*else if(!isset($this->request->data['PostAd']['adv_brand']))

		{

			if($this->request->data['PostAd']['adv_brand_id']=='' && $this->request->data['PostAd']['adv_model_id']=='')

			{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$brandBlank['MasterMessage']['msg'].'</div>'));

			}

			else

			{

				$this->Session->setFlash(__('<div class="alert alert-danger">'.$modelBlank['MasterMessage']['msg'].'</div>'));

			}

		}

		else if(!isset($this->request->data['PostAd']['adv_model']))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$modelBlank['MasterMessage']['msg'].'</div>'));

		}*/

		else if(isset($this->request->data['PostAd']['price']) && ($this->request->data['PostAd']['price']==0 || $this->request->data['PostAd']['price']==''))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$priceBlank['MasterMessage']['msg'].'</div>'));

		}

		else if(isset($this->request->data['PostAd']['quantity']) && ($this->request->data['PostAd']['quantity']==0 || $this->request->data['PostAd']['quantity']==''))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$qtyBlank['MasterMessage']['msg'].'</div>'));

		}



		/*else if(empty($paymentmodearr))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$paymentModeblank['MasterMessage']['msg'].'</div>'));

		}

		else if($personal_teaching==0 && $courier==0 && $romanian_mail==0 && $free_courier==0 && $free_romanian_mail==0)

		{



			$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryMethodBlank['MasterMessage']['msg'].'</div>'));

		}

		else if($courier==1 && $free_courier==0 && ($courier_cost=='' || $courier_cost==0))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$costBlank['MasterMessage']['msg'].'</div>'));

		}

		else if($romanian_mail==1 && $free_romanian_mail==0 && ($romanian_mail_cost=='' || $romanian_mail_cost==0))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$costBlank['MasterMessage']['msg'].'</div>'));

		}*/

		else

		{

		//echo "<pre>";print_r($this->request->data);exit;



			//$this->request->data['PostAd']['payment_mode']=implode(",",$paymentmodearr);

			//$this->request->data['PostAd']['adv_brand_id']=implode(",",$this->request->data['PostAd']['adv_brand']);

			//$this->request->data['PostAd']['adv_model_id']=implode(",",$this->request->data['PostAd']['adv_model']);

			$postdetail=$this->PostAd->find('first', array('conditions' => array('adv_id' => $this->request->data['PostAd']['adv_id'])));

			if($postdetail['PostAd']['adv_status']==2){$this->request->data['PostAd']['adv_status']=1;}

			$this->request->data['PostAd']['slug']=$this->Dez->SlugBYName('PostAd',$this->request->data['PostAd']['adv_name'],$this->request->data['PostAd']['adv_id']);

			if ($this->PostAd->save($this->request->data)) {



				 $this->loadModel('PostadImg');

				 $imgdetail=$this->PostadImg->find('all', array('conditions' => array('post_ad_id' => $this->request->data['PostAd']['adv_id'])));

				 if(count($imgdetail)<=8)

				 {

					 $rest=8-count($imgdetail);

					  $this->loadModel('TempImg');

					$tempimg=$this->TempImg->find('all', array('conditions' => array('post_id' => $this->request->data['PostAd']['adv_id'])));

					//echo $this->request->data['PostAd']['adv_id'];

					//print_r($tempimg);exit;

					if(count($tempimg)>0)

					{

						//echo $rest;echo count($tempimg);

						if($rest>=count($tempimg))

						{

							//print_r($tempimg);exit;

							foreach($tempimg as $tempsingle)

							{

								//print_r($tempsingle);

								$img_path=$tempsingle['TempImg']['img_path'];

								$post_id=$this->request->data['PostAd']['adv_id'];

								copy(WWW_ROOT.'files/tempfile/'.$img_path,WWW_ROOT.'files/postad/'.$img_path);

								$resizeObj = new resize(WWW_ROOT.'files/postad/'.$img_path);
								$resizeObj -> resizeImage(160, 100, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/160X100_'.$img_path, 90);

								$resizeObj -> resizeImage(133, 100, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/133X100_'.$img_path, 90);

								$resizeObj -> resizeImage(50, 37, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/50X37_'.$img_path, 90);

								$resizeObj -> resizeImage(540, 400, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/540X400_'.$img_path, 90);

								$resizeObj -> resizeImage(80, 60, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/80X60_'.$img_path, 90);

								$resizeObj -> resizeImage(350, 260, 'crop');
								$resizeObj -> saveImage($filePath.'350X260_'.$fileName, 90);

						        $resizeObj -> resizeImage(128, 120, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/128X120_'.$img_path, 90);

						        $resizeObj -> resizeImage(100, 100, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/100X100_'.$img_path, 90);

								$resizeObj -> resizeImage(50, 50, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/50X50_'.$img_path, 90);
								$resizeObj -> resizeImage(165, 135, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/files/postad/165X135_'.$img_path, 90);

								$this->PostadImg->create();

								$imgsv=$this->PostadImg->save(array('post_ad_id' => $post_id,'img_path'=>$img_path));

								if($imgsv)

								{

									$this->loadModel('TempImg');

									$this->TempImg->delete($tempsingle['TempImg']['img_id']);

									@unlink(WWW_ROOT.'files/tempfile/'.$img_path);

								}



							}

							if($postdetail['PostAd']['adv_status']==0)

							{

							$this->Session->setFlash(__('<div class="alert alert-success">'.$secondStep['MasterMessage']['msg'].'</div>'));

							return $this->redirect(array('action' => 'shipdetail/'.$this->request->data['PostAd']['adv_id']));

							}

							else

							{

								$sessionUser=$this->Session->read('User');

								$this->loadModel('Notice');

								$this->Notice->create();

								$this->Notice->save(array('notice_type' => 'sales-modified', 'postid' => $this->request->data['PostAd']['adv_id'], 'notice_name' => 'Sales Modified'));

								$this->Notice->create();

								$this->Notice->save(array('notice_type' => 'sales-modified', 'postid' => $this->request->data['PostAd']['adv_id'], 'notice_name' => 'Sales Modified', 'user_id' => $sessionUser['user_id']));

								$this->redirect(array('controller' => 'Logins', 'action' => 'user_dashboard'));

								$this->Session->setFlash(__('<div class="alert alert-success">'.$updMag['MasterMessage']['msg'].'</div>'));

								return $this->redirect(array('action' => 'index'));

							}

						}

						else

						{

							$this->Session->setFlash(__('<div class="alert alert-danger">'.$uptoImg['MasterMessage']['msg'].'</div>'));

						}

					}



					else

					{



						if($postdetail['PostAd']['adv_status']==0)

							{

							$this->Session->setFlash(__('<div class="alert alert-success">'.$secondStep['MasterMessage']['msg'].'</div>'));

							return $this->redirect(array('action' => 'shipdetail/'.$this->request->data['PostAd']['adv_id']));

							}

							else

							{

								$this->loadModel('Notice');

								$this->Notice->save(array('notice_type' => 'sales-modified', 'postid' => $this->request->data['PostAd']['adv_id'], 'notice_name' => 'Sales Modified'));

								$this->Session->setFlash(__('<div class="alert alert-success">'.$updMag['MasterMessage']['msg'].'</div>'));

								return $this->redirect(array('action' => 'index'));

							}

					}



				 }

				 else

				 {



					$this->Session->setFlash(__('<div class="alert alert-danger">'.str_replace("{count}", count($imgdetail),$moreImg['MasterMessage']['msg']).'/div>'));

				 }

				//return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));

			}

		}

		}

		else

		{

			$options = array('conditions' => array('PostAd.' . $this->PostAd->primaryKey => $id));

			$this->request->data = $this->PostAd->find('first', $options);

			//print_r($this->request->data);

		}

		$this->layout='post_description';



	}

/**

 * PostAds Ship details method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

 	public function shipdetail($id=null)

	{

		if($this->Session->check('postAdsID'))

		{

			$id=$this->Session->read('postAdsID');

		}

		$this->set('title_for_layout','Shipping Detail');

		$this->loadModel('MasterMessage');

		$paymentModeblank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 15)));

		$deliveryMethodBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 16)));

		$costBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 17)));

		if ($this->request->is(array('post', 'put'))) {



			$paymentmodearr=array_filter($this->request->data['PostAd']['payment_mode']);

			$personal_teaching=$this->request->data['PostAd']['personal_teaching'];

			$courier=$this->request->data['PostAd']['courier'];

			$romanian_mail=$this->request->data['PostAd']['romanian_mail'];

			$courier_cost=$this->request->data['PostAd']['courier_cost'];

			$romanian_mail_cost=$this->request->data['PostAd']['romanian_mail_cost'];

			$free_courier=$this->request->data['PostAd']['free_courier'];

			$free_romanian_mail=$this->request->data['PostAd']['free_romanian_mail'];



		//pr($this->request->data);exit;





		if($personal_teaching==0 && $courier==0 && $romanian_mail==0 && $free_courier==0 && $free_romanian_mail==0)

		{



			$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryMethodBlank['MasterMessage']['msg'].'</div>'));

		}

		else if($courier==1 && $free_courier==0 && ($courier_cost=='' || $courier_cost==0))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$costBlank['MasterMessage']['msg'].'</div>'));

		}

		else if($romanian_mail==1 && $free_romanian_mail==0 && ($romanian_mail_cost=='' || $romanian_mail_cost==0))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$costBlank['MasterMessage']['msg'].'</div>'));

		}

		else if(empty($paymentmodearr))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">'.$paymentModeblank['MasterMessage']['msg'].'</div>'));

		}

		else

		{

		//echo "<pre>";print_r($this->request->data);exit;



			$this->request->data['PostAd']['payment_mode']=implode(",",$paymentmodearr);

			$postdetail=$this->PostAd->find('first', array('conditions' => array('adv_id' => $this->request->data['PostAd']['adv_id'])));

			if ($this->PostAd->save($this->request->data)) {



				//$this->Session->setFlash(__('<div class="alert alert-success">"Succe"</div>'));

				return $this->redirect(array('action' => 'ready/'.$id));

			} else {

				$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));

			}

		}

		}

		else

		{



			$options = array('conditions' => array('PostAd.' . $this->PostAd->primaryKey => $id));

			$this->request->data = $this->PostAd->find('first', $options);

			//print_r($this->request->data);

		}

		$this->layout="shipdetail";

	}

	/**

 * PostAds Preview method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function preview($id=null) {

		$this->set('title_for_layout','Ad Preview');

		if(!$this->Session->check('postAdsID'))

		{

			if (!$this->PostAd->exists($id)) {

			throw new NotFoundException(__('Invalid post ad'));

			}

		}

		else

		{

			$id=$this->Session->read('postAdsID');



		}

		$this->loadModel('MasterMessage');

		$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 23)));

		if ($this->request->is(array('post', 'put'))) {

			if ($this->PostAd->save($this->request->data)) {

				$this->Session->setFlash(__('Congratulations'));

				if($this->Session->check('postAdsID'))

				{

					$this->Session->delete('postAdsID');

				}

				$this->loadModel('Notice');

				$this->Notice->save(array('notice_type' => 'sales-add', 'postid' => $id, 'notice_name' => 'Sales Added'));

				return $this->redirect(array('action' => 'ready/'.$id));

			} else {

				$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));

			}



		} else {

			$options = array('conditions' => array('PostAd.' . $this->PostAd->primaryKey => $id));

			$this->request->data = $this->PostAd->find('first', $options);

		}

		$this->layout='post_preview';

	}

/**

 * PostAds Ready method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function ready($id=null) {

		$this->set('title_for_layout','Ad Ready');

			if(!$this->Session->check('postAdsID'))

			{

				if (!$this->PostAd->exists($id)) {

				return $this->redirect(array('action' => 'add/'.$id));

				}

			}

		else

		{

			$id=$this->Session->read('postAdsID');



		}

		$this->loadModel('MasterMessage');

		$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 23)));
		$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 81)));

		if ($this->request->is(array('post', 'put'))) {

			if ($this->PostAd->save($this->request->data)) {

				$this->Session->setFlash(__('Congratulations'));

				if($this->Session->check('postAdsID'))

				{

					$this->Session->delete('postAdsID');

				}

				$sessionUser=$this->Session->read('User');

				$this->loadModel('Notice');

				$this->Notice->create();

				$this->Notice->save(array('notice_type' => 'sales-add', 'postid' => $id, 'notice_name' => 'Sales Added'));

				$this->Notice->create();

				$this->Notice->save(array('notice_type' => 'sales-add', 'postid' => $id, 'notice_name' => 'Sales Added', 'user_id' => $sessionUser['user_id']));

				$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));

				$options = array('conditions' => array('PostAd.' . $this->PostAd->primaryKey => $id));

			$this->request->data = $this->PostAd->find('first', $options);

			//===========Subscribe mail alert==========
			/*$this->loadModel('SubscribeAlert');
					$alertResults=$this->SubscribeAlert->find('all', array('order' => array('alert_id' => 'desc')));
					//echo "<pre>";print_r($alertResult);exit();
					if(!empty($alertResults)){
						//=====Post Ad Detail===========
							$apostDetail=$this->PostAd->find('first', array('conditions' => array('adv_id' => $id)));
							//print_r($apostDetail);exit();
						//==============================
							$sessDetail=$this->Session->read('User');
						foreach($alertResults as $alertResult){
							$alertUserid=$alertResult['SubscribeAlert']['user_id'];

							$alertBrand_list=$alertResult['SubscribeAlert']['brand_list'];
							if(!empty($alertBrand_list)){
								$alertbrandArray=explode(",", $alertBrand_list);
							}else{
								$alertbrandArray=array();
							}
							$alertCategories=$alertResult['SubscribeAlert']['categories'];
							if(!empty($alertCategories)){
								$alertCatArray=explode(",", $alertCategories);
							}else{
								$alertCatArray=array();
							}

							$alertCouties=$alertResult['SubscribeAlert']['couties'];
							if(!empty($alertCouties)){
								$allertCountyArray=explode(",", $alertCouties);
							}else{
								$allertCountyArray=array();
							}

							if(in_array($apostDetail['PostAd']['category_id'], $alertCatArray) && in_array($apostDetail['PostAd']['adv_brand_id'], $alertbrandArray)){
								if($sessDetail['user_id']!= $alertUserid){
									$this->loadModel('MasterUser');
									$userDetail=$this->MasterUser->find('first', array('conditions' => array('user_id' => $alertUserid)));

									//Mail Functionality start here==============
									$baseurl='http://'.$_SERVER['SERVER_NAME'].Router::url('/');
									$adLink='<a href="'.$baseurl.'pages/sales-details/'.$apostDetail['PostAd']['slug'].'">Ad Detail</a>';
									$register_name=$userDetail['MasterUser']['first_name'].' '.$userDetail['MasterUser']['last_name'];
									$usertemplateDetail=$this->Dez->BapCustUniGetTemplate(14);
									$userSubject=stripslashes($usertemplateDetail['EmailTemplate']['mail_subject']);
									$messageBody =stripslashes($usertemplateDetail['EmailTemplate']['mail_body']);
									$messageBody= str_replace('{Name}', $register_name, $messageBody);
									$messageBody= str_replace('{AdLink}', $adLink, $messageBody);

									$to_email=$userDetail['MasterUser']['email'];
									$this->loadModel('AdminUser');
									$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
										if(!empty($siteemail)){$adminemail=$siteemail['AdminUser']['mail_id'];}else{$adminemail='info@dezmembraripenet.com';}
									//$adminemail="chittas970@gmail.com";
										//echo $messageBody;exit();
									$Email = new CakeEmail('default');

									$Email->to($to_email);

									$Email->subject($userSubject);

									$Email->replyTo($adminemail);

									$Email->from (array($adminemail => 'Dezmembraripenet'));

									$Email->emailFormat('both');

									//$Email->headers();

									$Email->send($messageBody);
									//==============================================================

								}

							}
						}
					}*/
			//===========Subscribe mail alert end==========

			} else {

				$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));

				$options = array('conditions' => array('PostAd.' . $this->PostAd->primaryKey => $id));

			$this->request->data = $this->PostAd->find('first', $options);

			}



		} else {

			$options = array('conditions' => array('PostAd.' . $this->PostAd->primaryKey => $id));

			$this->request->data = $this->PostAd->find('first', $options);

		}



			$this->layout='post_ready';

	}



/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function delete($id = null) {

		$this->PostAd->id = $id;

		if (!$this->PostAd->exists()) {

			throw new NotFoundException(__('Invalid post ad'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->PostAd->save(array('adv_id' => $id, 'adv_status' => 2))) {

			$this->Session->setFlash(__('The post ad has been removed.'));

		} else {

			$this->Session->setFlash(__('The post ad could not be removed. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	}

/**

 * Sub Category Ajax method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	 public function subcatajax()

	 {

		 $this->loadModel('SalesCategory');

		 if($this->request->is('post'))

		 {

			 if(isset($this->request->data['cat_id']) && !empty($this->request->data['cat_id'])){

			$cat_id = $this->request->data['cat_id'];

			$condition = array('SalesCategory.flag'=>$cat_id,'SalesCategory.status'=>'1');

			$sub_cat=$this->SalesCategory->find('list',array('conditions' => $condition,'fields' =>array('SalesCategory.category_id','SalesCategory.category_name'),'order' => array('SalesCategory.category_name' => 'ASC')));

			$loc = json_encode($sub_cat);

			print_r($loc);

			//print_r($this->request->data);exit;

		}

		 }

		 exit;

	 }

 /**

 * File Upload method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */



	 public function fileupload($postid=null)

	 {

		 $this->loadModel('TempImg');

		if($this->request->is('post'))

		{

			//echo count($this->request->data['PostAd']['adv_img']);

			//echo "<pre>";print_r($this->request->data['PostAd']['adv_img']);exit;

			if(count($this->request->data['PostAd']['adv_img'])>0)

			{

				foreach($this->request->data['PostAd']['adv_img'] as $allimg)

				{

					//echo 1;

					if($allimg['name']!='')

					{

					$filename = time().$allimg['name'];

					//$filename=$this->Ikm->CleanFilePath($filename);

					// echo $filename;exit;
					$filename= $this->Dez->CleanFilePath($filename);
					move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/tempfile/'.$filename);
					$uploadedFile=WWW_ROOT.'files/tempfile/'.$filename;
					//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
					$this->request->data['TempImg']['img_path'] = $filename;



					}

					else

					{

					$this->request->data['TempImg']['img_path'] ='';

					}

					$this->request->data['TempImg']['ip_address']=$this->RequestHandler->getClientIp();

					$this->request->data['TempImg']['post_id']=$this->request->data['PostAd']['post_id'];

					$this->TempImg->create();

					$save=$this->TempImg->save($this->request->data);

				}



			}

			unset($this->request->data['PostAd']['adv_img']);

			unset($this->request->data['PostAd']);

			if($save)

			{

				$postid=$this->request->data['TempImg']['post_id'];

			}



		}

		else

		{

			if($this->Session->check('postAdsID')){

				$postid=$this->Session->read('postAdsID');

			}

			$this->PostAd->id = $postid;

			if (!$this->PostAd->exists()) {

				throw new NotFoundException(__('Invalid post ad'));

			}

		}

		$tempdata=$this->TempImg->find('all',array('conditions' => array('post_id' => $postid)));

		$this->set('tempfile',$tempdata);

		$this->loadModel('PostadImg');

		$originalfile=$this->PostadImg->find('all',array('conditions' => array('post_ad_id' => $postid)));

		$this->set('originalfile',$originalfile);

		$this->set('postid',$postid);

		$this->layout='fileupload';

	 }

	 public function removeimg()

	 {

		 $imgid=$this->request->data['imgid'];

		 $imgtype=$this->request->data['img_fold'];

		 if($imgid!='')

		 {

			 if($imgtype=="temp")

			 {

				 $this->loadModel('TempImg');

				$imgdetail=$this->TempImg->find('first', array('img_id'=>$imgid));

				if(!empty($imgdetail))

				{

					@unlink(WWW_ROOT.'files/tempfile/'.$imgdetail['TempImg']['img_path']);

				 $this->TempImg->delete($imgid);

				}

				 echo 1;

			 }

			 else if($imgtype=="original")

			 {

				 $this->loadModel('PostadImg');

				 $imgdetail=$this->PostadImg->find('first', array('imgid'=>$imgid));

				 @unlink(WWW_ROOT.'files/postad/'.$imgdetail['PostadImg']['img_path']);
				 @unlink(WWW_ROOT.'files/postad/133X100_'.$imgdetail['PostadImg']['img_path']);
				 @unlink(WWW_ROOT.'files/postad/160X100_'.$imgdetail['PostadImg']['img_path']);
				 @unlink(WWW_ROOT.'files/postad/50X37_'.$imgdetail['PostadImg']['img_path']);
				 @unlink(WWW_ROOT.'files/postad/540X400_'.$imgdetail['PostadImg']['img_path']);
				 @unlink(WWW_ROOT.'files/postad/80X60_'.$imgdetail['PostadImg']['img_path']);


				 $this->PostadImg->delete($imgid);

				 echo 1;

			 }

		 }

		 exit;



	 }

	 public function getfirstimg($id=null)

	 {

		 if (!$this->PostAd->exists($id)) {

			throw new NotFoundException(__('Invalid post ad'));

		}

		$this->loadModel('PostadImg');

		$imglist=$this->PostadImg->find('first', array('conditions' => array('post_ad_id' => $id), 'order' => array('imgid' => 'asc')));

		return ($imglist);

	 }



	 public function getcatparent($id=null)

	 {

		 $this->loadModel('SalesCategory');

		  if (!$this->SalesCategory->exists($id)) {

			throw new NotFoundException(__('Invalid category ID'));

		}

		$catres=$this->SalesCategory->find('first', array('conditions' => array('category_id' => $id)));

		return($catres['SalesCategory']['flag']);

	 }



	 public function getbrandparent($id=null)

	 {

		 $this->loadModel('SalesBrand');

		  if (!$this->SalesBrand->exists($id)) {

			throw new NotFoundException(__('Invalid brand ID'));

		}

		$brandres=$this->SalesBrand->find('first', array('conditions' => array('brand_id' => $id)));

		return($brandres['SalesBrand']['flag']);

	 }

	 public function catdetail()

	 {

		 if($this->request->is('post'))

		 {

			 if($this->request->data['cat_id'])

			 {

				 $this->loadModel('SalesCategory');

				 $cat_name = $this->SalesCategory->find('first',array('conditions'=>array("SalesCategory.category_id" => $this->request->data['cat_id']), 'fields' => array('SalesCategory.category_name')));

			$cat_name = $cat_name['SalesCategory']['category_name'];

				 echo $cat_name;

			 }

		 }

		 exit;

	 }

/**

* Method Name: promotion

* Method for promote an ad

* Author By: Chittaranjan

**/

	public function promotion($id=null)

	{

		$this->set('title_for_layout','Promotion');

		if (!$this->PostAd->exists($id)) {

			return $this->redirect(Router::url('/PostAds', true));

		}

		$this->loadModel('PromotionPlan');

		$homeplanRes=$this->PromotionPlan->find('all', array('conditions' => array('status' => 1, 'promotion_type' => 1), 'order' => array('promotion_id' => 'asc')));

		$listplanRes=$this->PromotionPlan->find('all', array('conditions' => array('status' => 1, 'promotion_type' => 2), 'order' => array('promotion_id' => 'asc')));

		$this->set('homeplanRes', $homeplanRes);

		$this->set('listplanRes', $listplanRes);

		$this->request->data['adv_id']=$id;

		if($this->request->is('post'))

		{

			$sessuser=$this->Session->read('User');

			$this->loadModel('UserTotalCredit');

			$creditRes=$this->UserTotalCredit->find('first', array('conditions' => array('user_id' => $sessuser['user_id'])));

			if($this->request->data['payment_type']==1)

			{

				$creditRes=array();

			}

			else

			{

				$creditRes=$creditRes;

			}

			if(!empty($creditRes))

			{

				$this->request->data['payment_type'];

				$credits=$creditRes['UserTotalCredit']['credits'];

				if($credits<$this->request->data['totalprice'])

				{

					$this->Session->setFlash(__('<div class="alert alert-danger">You have not sufficent credits to promote this ad. your remaining credits is '.$credits.'. So if do you want to payment though mobilpay click again on Submit button</div>'));

				}

				else

				{



					$user_session=$this->Session->read('User');

					//---------------------------------------

						if(isset($this->request->data['promotelist']))

						{

							$promotelist=$this->request->data['promotelist'];

						}

						else

						{

							$promotelist=0;

						}

						if(isset($this->request->data['promotehome']))

						{

							$promotehome=$this->request->data['promotehome'];

						}

						else

						{

							$promotehome=0;

						}

						$homeprice=$this->request->data['homeprice'];

						$listprice=$this->request->data['listprice'];

						$totalprice=$this->request->data['totalprice'];

						$adv_id=$this->request->data['adv_id'];

						$this->loadModel('PromotionPlan');

						if($promotelist>0)

						{



							$listplandetail=$this->PromotionPlan->find('first', array('conditions' => array('promotion_id' => $promotelist, 'status' => 1)));

							if(!empty($listplandetail))

							{

								$promotion_day=$listplandetail['PromotionPlan']['promotion_days'];

								$is_list_expire=date('Y-m-d', strtotime("+".$promotion_day." days"));

								$this->request->data['PromotionAd']['is_list_expire']=$is_list_expire;

							}



						}

						if($promotehome>0)

						{



							$homeplandetail=$this->PromotionPlan->find('first', array('conditions' => array('promotion_id' => $promotehome, 'status' => 1)));

							if(!empty($homeplandetail))

							{

								$hpromotion_day=$homeplandetail['PromotionPlan']['promotion_days'];

								$is_home_expire=date('Y-m-d', strtotime("+".$hpromotion_day." days"));

								$this->request->data['PromotionAd']['is_home_expire']=$is_home_expire;

							}



						}

					//---------------------------------------

					if(!empty($this->request->data['promotiontype']))

					{

						$promotiontype=implode(",",$this->request->data['promotiontype']);

					}

					else

					{

						$promotiontype='';

					}

					$this->request->data['PromotionAd']['user_id']=$sessuser['user_id'];

					$this->request->data['PromotionAd']['adv_id']=$this->request->data['adv_id'];

					$this->request->data['PromotionAd']['promotion_type']=$promotiontype;

					$this->request->data['PromotionAd']['total_price']=$this->request->data['totalprice'];

					$this->request->data['PromotionAd']['promotion_list']=$promotelist;

					$this->request->data['PromotionAd']['promotion_home']=$promotehome;

					$this->request->data['PromotionAd']['listprice']=$this->request->data['listprice'];

					$this->request->data['PromotionAd']['homeprice']=$this->request->data['homeprice'];

					$this->request->data['PromotionAd']['status']=1;

					$this->request->data['PromotionAd']['transfer_id']=rand(10, 10000);



					//pr($this->request->data['PromotionAd']);exit;

					$this->loadModel('PromotionAd');

						if($this->PromotionAd->save($this->request->data))

						{

							$creditid=$creditRes['UserTotalCredit']['id'];

							$remaincredit=$credits-$this->request->data['totalprice'];

							$this->UserTotalCredit->save(array('id' => $creditid, 'credits' => $remaincredit));

							$promotion_type=$promotiontype;

							if($promotion_type!='')

							{

								$pro_typearr=explode(",", $promotion_type);

							}

							if(!empty($pro_typearr) && in_array(2, $pro_typearr))

							{

								$is_promote_list=1;

							}

							else

							{

								$is_promote_list=0;

							}

							$this->loadModel('PostAd');

							$this->PostAd->save(array('adv_id' => $this->request->data['adv_id'], 'is_promote' => 1, 'is_promote_list' => $is_promote_list));

							$insertid=$this->PromotionAd->getLastInsertId();

							$this->Session->setFlash(__('<div class="alert alert-success">Ad promoted successfully</div>'));

							return $this->redirect(array('action' => 'index/'));

						}



				}

			}

			else

			{

				$this->loadModel('TempPromoteAd');

				if(!empty($this->request->data['promotiontype']))

				{

					$promotiontype=implode(",",$this->request->data['promotiontype']);

				}

				$user=$this->Session->read('User');

				$userid=$user['user_id'];

				if(isset($this->request->data['promotelist']))

				{

					$promotelist=$this->request->data['promotelist'];

				}

				else

				{

					$promotelist=0;

				}

				if(isset($this->request->data['promotehome']))

				{

					$promotehome=$this->request->data['promotehome'];

				}

				else

				{

					$promotehome=0;

				}

				$homeprice=$this->request->data['homeprice'];

				$listprice=$this->request->data['listprice'];

				$totalprice=$this->request->data['totalprice'];

				$adv_id=$this->request->data['adv_id'];

				$randomid=rand(10, 100000);

				//pr($this->request->data);exit;

				$options=array('user_id' => $userid, 'adv_id' => $adv_id, 'promotion_type' => $promotiontype, 'promotion_list' => $promotelist, 'promotion_home' => $promotehome, 'list_price' => $listprice, 'home_price' => $homeprice, 'total_price' => $totalprice, 'random_id' => $randomid);

				if($this->TempPromoteAd->save($options))

				{

					$this->Session->write('promotion_random_id', $randomid);

					$this->Session->write('promotion_adv_id', $adv_id);

					return $this->redirect(Router::url('/PostAds/paymentmethod/', true));

					//return $this->redirect(Router::url('/PostAds/paymentpromotion/'.$adv_id, true));

				}

			}

		}

		$this->layout='promotion';

	}

/**

 * payment type choose method

 *

 * @return void

 */

	public function paymentmethod()

	{

		if(!$this->Session->check('promotion_adv_id'))

		{

			return $this->redirect(Router::url('/PostAds/', true));

		}

		$advid=$this->Session->read('promotion_adv_id');

		if(!$this->Session->check('promotion_random_id'))

		{

			return $this->redirect(Router::url('/PostAds/promotion/'.$advid, true));

		}

		$this->layout='promotionmethod';

	}

/**

 * cardsubmit method

 *

 * @return void

 */

	public function cardsubmit()

	{

		if($this->request->is('post'))

		{

			if($this->request->data['submitval']=='yes')

			{

				if($this->request->data['submittype']=='card')

				{

				$this->Session->write('promotioncard',1);

				}

				else if($this->request->data['submittype']=='banktransfer')

				{

				$this->Session->write('promotioncard',2);

				}

				else if($this->request->data['submittype']=='sms')

				{

				$this->Session->write('promotioncard',3);

				}

				echo 1;

			}

		}

		exit;

	}



/**

 * Paymentredirect order method

 *

 * @return void

 */

 	public function paymentpromotion($id=null)

	{

		if (!$this->PostAd->exists($id)) {

			return $this->redirect(Router::url('/PostAds', true));

		}

		if(!$this->Session->check('promotion_random_id'))

		{

			return $this->redirect(Router::url('/PostAds/promotion/'.$id, true));

		}

		$user=$this->Session->read('User');

		$userid=$user['user_id'];

		$randomid=$this->Session->read('promotion_random_id');

		$this->loadModel('TempPromoteAd');

		$tempdetails=$this->TempPromoteAd->find('first', array('conditions' => array('random_id' => $randomid)));

		$this->set('tempDetails',$tempdetails);

		$this->loadModel('MasterUser');

		$userDetail=$this->MasterUser->find('first', array('conditions' => array('is_active' => 1, 'user_id' => $userid)));

		$this->set('userDetail',$userDetail);

		$this->set('title_for_layout','Redirect To Payemt page');

		$this->layout='paymentpromotion';

	}

/**

 * bankpromotion order method

 *

 * @return void

 */

 	public function bankpromotion($id=null)

	{

		if (!$this->PostAd->exists($id)) {

			return $this->redirect(Router::url('/PostAds', true));

		}

		if(!$this->Session->check('promotion_random_id'))

		{

			return $this->redirect(Router::url('/PostAds/promotion/'.$id, true));

		}

		$user=$this->Session->read('User');

		$userid=$user['user_id'];

		$randomid=$this->Session->read('promotion_random_id');

		$this->loadModel('TempPromoteAd');

		$tempdetails=$this->TempPromoteAd->find('first', array('conditions' => array('random_id' => $randomid)));

		$this->set('tempDetails',$tempdetails);

		$this->loadModel('MasterUser');

		$userDetail=$this->MasterUser->find('first', array('conditions' => array('is_active' => 1, 'user_id' => $userid)));

		$this->set('userDetail',$userDetail);

		$this->set('title_for_layout','Redirect To Payemt page');

		$this->layout='paymentpromotion';

	}

/**

 * smspromotion order method

 *

 * @return void

 */

 	public function smspromotion($id=null)

	{

		if (!$this->PostAd->exists($id)) {

			return $this->redirect(Router::url('/PostAds', true));

		}

		if(!$this->Session->check('promotion_random_id'))

		{

			return $this->redirect(Router::url('/PostAds/promotion/'.$id, true));

		}

		$user=$this->Session->read('User');

		$userid=$user['user_id'];

		$randomid=$this->Session->read('promotion_random_id');

		$this->loadModel('TempPromoteAd');

		$tempdetails=$this->TempPromoteAd->find('first', array('conditions' => array('random_id' => $randomid)));

		$this->set('tempDetails',$tempdetails);

		$this->loadModel('MasterUser');

		$userDetail=$this->MasterUser->find('first', array('conditions' => array('is_active' => 1, 'user_id' => $userid)));

		$this->set('userDetail',$userDetail);

		$this->set('title_for_layout','Redirect To Payemt page');

		$this->layout='paymentpromotion';

	}



	public function success()

	{

		if(!$this->Session->check('promotion_random_id'))

		{

			return $this->redirect(Router::url('/PostAds/', true));

		}

		else

		{



		//echo base64_decode($_REQUEST['orderId']);

		if(isset($_REQUEST['orderId']) && ($_REQUEST['orderId'] == md5($this->Session->read('promotion_random_id'))))

		{



			$this->loadModel('TempPromoteAd');

			$randomid=$this->Session->read('promotion_random_id');

		$tempdetails=$this->TempPromoteAd->find('first', array('conditions' => array('random_id' => $randomid)));

		$user_session=$this->Session->read('User');

		//---------------------------------------



			$this->loadModel('PromotionPlan');

			if($tempdetails['TempPromoteAd']['promotion_list']>0)

			{



				$listplandetail=$this->PromotionPlan->find('first', array('conditions' => array('promotion_id' => $tempdetails['TempPromoteAd']['promotion_list'], 'status' => 1)));

				if(!empty($listplandetail))

				{

					$promotion_day=$listplandetail['PromotionPlan']['promotion_days'];

					$is_list_expire=date('Y-m-d', strtotime("+".$promotion_day." days"));

					$this->request->data['PromotionAd']['is_list_expire']=$is_list_expire;

				}



			}

			if($tempdetails['TempPromoteAd']['promotion_home']>0)

			{



				$homeplandetail=$this->PromotionPlan->find('first', array('conditions' => array('promotion_id' => $tempdetails['TempPromoteAd']['promotion_home'], 'status' => 1)));

				if(!empty($homeplandetail))

				{

					$hpromotion_day=$homeplandetail['PromotionPlan']['promotion_days'];

					$is_home_expire=date('Y-m-d', strtotime("+".$hpromotion_day." days"));

					$this->request->data['PromotionAd']['is_home_expire']=$is_home_expire;

				}



			}

		//---------------------------------------



		$this->request->data['PromotionAd']['user_id']=$tempdetails['TempPromoteAd']['user_id'];

		$this->request->data['PromotionAd']['adv_id']=$tempdetails['TempPromoteAd']['adv_id'];

		$this->request->data['PromotionAd']['promotion_type']=$tempdetails['TempPromoteAd']['promotion_type'];

		$this->request->data['PromotionAd']['total_price']=$tempdetails['TempPromoteAd']['total_price'];

		$this->request->data['PromotionAd']['promotion_list']=$tempdetails['TempPromoteAd']['promotion_list'];

		$this->request->data['PromotionAd']['promotion_home']=$tempdetails['TempPromoteAd']['promotion_home'];

		$this->request->data['PromotionAd']['listprice']=$tempdetails['TempPromoteAd']['list_price'];

		$this->request->data['PromotionAd']['homeprice']=$tempdetails['TempPromoteAd']['home_price'];

		$this->request->data['PromotionAd']['status']=1;

		$this->request->data['PromotionAd']['transfer_id']=$_REQUEST['orderId'];

		if($this->Session->check('promotioncard'))

			{

				$sessionCard=$this->Session->read('promotioncard');

				if($sessionCard==1){$cardName='Credit Card';}else if($sessionCard==2){$cardName='Bank Transfer';}else if($sessionCard==3){$cardName='SMS Transfer';}

				$this->request->data['PromotionAd']['payment_mthd']=$cardName;



			}



		//pr($this->request->data['PromotionAd']);exit;

		$this->loadModel('PromotionAd');

			if($this->PromotionAd->save($this->request->data))

			{

				$promotion_type=$tempdetails['TempPromoteAd']['promotion_type'];

				if($promotion_type!='')

				{

					$pro_typearr=explode(",", $promotion_type);

				}

				if(!empty($pro_typearr) && in_array(2, $pro_typearr))

				{

					$is_promote_list=1;

				}

				else

				{

					$is_promote_list=0;

				}

				$this->loadModel('PostAd');

				$this->PostAd->save(array('adv_id' => $tempdetails['TempPromoteAd']['adv_id'], 'is_promote' => 1, 'is_promote_list' => $is_promote_list));

				$insertid=$this->PromotionAd->getLastInsertId();

				$this->TempPromoteAd->delete($tempdetails['TempPromoteAd']['temp_id']);

				$this->Session->delete('promotion_random_id');

			}

		}



		}

		$this->layout='promotion_success';

	}

	public function failed()

	{

		if(!$this->Session->check('promotion_random_id'))

		{

			return $this->redirect(Router::url('/PostAds/', true));

		}



		$this->layout='promotion_failed';

	}

	/**

 * promotead method

 *

 * @return void

 */

	public function promotead() {

		$this->set('title_for_layout','Anunțuri promovate');

		$user_session=$this->Session->read('User');

		$userid=$user_session['user_id'];

		$userstatus=$user_session['is_active'];

		$this->PostAd->recursive = 0;

		$this->Paginator->settings = array(

		'joins' =>

		  array(

			array(

				'table' => 'promotion_ad',

				'alias' => 'PromotionAd',

				'type' => 'left',

				'foreignKey' => false,

				'conditions'=> array('PromotionAd.adv_id = PostAd.adv_id')

			)

		 ),

		'conditions' =>

		 array('PostAd.adv_status' =>1,'PostAd.user_id' =>$userid, 'PostAd.is_promote' =>1),

		 'fields' =>

		 array('PostAd.*', 'PromotionAd.*'),

		 'order' =>array('PromotionAd.created' => 'desc'),

		  'limit' => 10

		  );

		$this->set('postAds', $this->Paginator->paginate());

		$this->layout='promotead';

	}

	public function promotionplan($id='')

	{

		$this->loadModel('PromotionPlan');

		$promotionres=$this->PromotionPlan->find('first', array('conditions' => array('promotion_id' => $id, 'status' => 1)));

		return($promotionres);

	}
	public function rotateimg($imgid='', $imgFrom=''){
		if($this->request->is('post')){
		  $fileName = $this->request->data['rotate_file'];
		  $rotateAngle= $this->request->data['angleVal'];
		  if($imgFrom==='temp'){
		  	$filePath=WWW_ROOT.'files/tempfile/';
		  }else{
		  	$filePath=WWW_ROOT.'files/postad/';
		  }
		  $fileDetail=getimagesize($filePath.$fileName);
		  if($fileDetail['mime']==='image/jpeg'){

		    // Load
		   // $source = imagecreatefromjpeg('uploads/'.$fileName);
		    $source=imagecreatefromstring(file_get_contents($filePath.$fileName));
		    $random=rand();
		    // Rotate
		    $rotateAngle=360-$rotateAngle;
		    $rotate = imagerotate($source, $rotateAngle, 0);
		    // Output
		    imagejpeg($rotate, $filePath.$fileName);

		    // Free the memory
		    imagedestroy($source);
		    imagedestroy($rotate);
		  }elseif ($fileDetail['mime']==='image/png') {
		     // open the image file
		    $im = imagecreatefrompng($filePath.$fileName);

		    // create a transparent "color" for the areas which will be new after rotation
		    // only quadratic images will not change dimensions
		    // r=0,b=0,g=0 ( black ), 127 = 100% transparency - we choose "invisible black"
		    $transparency = imagecolorallocatealpha( $im,0,0,0,127 );

		    // rotate, last parameter preserves alpha when true
		    $rotateAngle=360-$rotateAngle;
		    $rotated = imagerotate( $im, $rotateAngle, $transparency, 1);

		    // disable blendmode, we want real transparency
		    imagealphablending( $rotated, false );
		    // set the flag to save full alpha channel information
		    imagesavealpha( $rotated, true );

		    // now we want to start our output
		    ob_end_clean();
		    // we send image/png
		   // header( 'Content-Type: image/png' );
		    imagepng( $rotated, $filePath.$fileName );
		    // clean up the garbage
		    imagedestroy( $im );
		    imagedestroy( $rotated );
		  }
		  if($imgFrom==='original'){
			   $resizeObj = new resize($filePath.$fileName);
				$resizeObj -> resizeImage(350, 260, 'crop');
				$resizeObj -> saveImage($filePath.'350X260_'.$fileName, 90);

		        $resizeObj -> resizeImage(128, 120, 'crop');
				$resizeObj -> saveImage($filePath.'128X120_'.$fileName, 90);

		        $resizeObj -> resizeImage(100, 100, 'crop');
				$resizeObj -> saveImage($filePath.'100X100_'.$fileName, 90);

				$resizeObj -> resizeImage(50, 50, 'crop');
				$resizeObj -> saveImage($filePath.'50X50_'.$fileName, 90);
				$resizeObj -> resizeImage(165, 135, 'crop');
				$resizeObj -> saveImage(WWW_ROOT.'files/postad/165X135_'.$fileName, 90);
			}
		}
		if($imgFrom=='temp'){
			$this->loadModel('TempImg');
			$tempdata=$this->TempImg->find('first',array('conditions' => array('img_id' => $imgid)));
			$this->set('imgDetail', $tempdata);
		}else{
			$this->loadModel('PostadImg');
			$originalfile=$this->PostadImg->find('first',array('conditions' => array('imgid' => $imgid)));
			$this->set('originalfile',$originalfile);
		}
		$this->layout="blank-layout";
	}
	/*
	* Author By: chittaranjan sahoo
	* Purpose: Make autocomplete function for tPost new Ad
	* Date: 29-03-2016
	*/
	public function autocomplete(){

		if($this->request->is('post'))
		{

			$xyz = 0;
			echo "<div class='items'><ul>";
			$allpost=$this->request->data;
			$tagname=$allpost['tag'];//print_r($allpost);
			$this->loadModel('ManageCategory');


			$res=$this->ManageCategory->find('all', array('conditions' => array('status' =>1, 'category_name LIKE ' => '%'.$tagname.'%', 'flag' => 0), 'order' => array('category_name' => 'asc')));
			$subres=$this->ManageCategory->find('all', array('conditions' => array('status' =>1, 'category_name LIKE ' => '%'.$tagname.'%', 'flag !=' => 0), 'order' => array('category_name' => 'asc')));
			if(!empty($res)){
				foreach($res as $result){
					$parentcatID=$result['ManageCategory']['category_id'];
					$subres=$this->ManageCategory->find('all', array('conditions' => array('status' =>1, 'flag' => $parentcatID), 'order' => array('category_name' => 'asc')));
					if(!empty($subres)){
						foreach($subres as $subResult){
							$childID=$subResult['ManageCategory']['category_id'];
							$subCategoryName=$subResult['ManageCategory']['category_name'];
							$xyz++;
							$add_tag = str_replace(strtolower($allpost['tag']), '<b>'.$allpost['tag'].'</b>', strtolower(stripslashes($result['ManageCategory']['category_name'])));
							if ($xyz == 1)
							{?>
								<li class="selected" onclick="return sendTextThree('<?=stripslashes($result['ManageCategory']['category_name']).">>".$subCategoryName ?>', <?=$parentcatID?>,<?=$childID?>);"><?=ucfirst($add_tag).">>".ucfirst($subCategoryName)?></li><?php
			                }
			                else
			                {?>
								<li onclick="return sendTextThree('<?=stripslashes($result['ManageCategory']['category_name']).">>".$subCategoryName ?>', <?=$parentcatID?>,<?=$childID?>);"><?=ucfirst($add_tag).">>".ucfirst($subCategoryName)?></li><?php
			                }

							}
					}

				}
			}elseif(!empty($subres)){
				foreach($subres as $result){
					$childID=$result['ManageCategory']['category_id'];
					$parentcatID=$result['ManageCategory']['flag'];
					$subCategoryName=$result['ManageCategory']['category_name'];
					$parentDetail=$this->ManageCategory->find('first', array('conditions' => array('status' =>1, 'category_id' => $parentcatID), 'order' => array('category_name' => 'asc')));
					if(!empty($parentDetail)){
							$xyz++;
							$add_tag = str_replace(strtolower($allpost['tag']), '<b>'.$allpost['tag'].'</b>', strtolower(stripslashes($subCategoryName)));
							if ($xyz == 1)
							{?>
								<li class="selected" onclick="return sendTextThree('<?=stripslashes($parentDetail['ManageCategory']['category_name']).">>".$subCategoryName ?>', <?=$parentcatID?>,<?=$childID?>);"><?=ucfirst($add_tag).">>".ucfirst($subCategoryName)?></li><?php
			                }
			                else
			                {?>
								<li onclick="return sendTextThree('<?=stripslashes($parentDetail['ManageCategory']['category_name']).">>".$subCategoryName ?>', <?=$parentcatID?>,<?=$childID?>);"><?=ucfirst($add_tag).">>".ucfirst($subCategoryName)?></li><?php
			                }

					}

				}
			}else{
			?>
                <li>No result found :(</li><?php
			}
			?></ul><div>
			<script>
			function sendTextThree(text, parentID, childID)
				{
					if ($(".keywrd_pop_top2").is(":visible")) {
						if (text!='') {
							$("#PostAdCategoryBrand").val(text);
							$("#PostAdCategoryBrand").focus();
							$(".keywrd_pop_top2").hide();
							$('#PostAdCategoryId option[value="'+parentID+'"]').attr("selected", "selected");
							show_subcat(parentID, childID);
						}
					}
					else
					{
						if (text!='') {
							$("#PostAdCategoryBrand").val(text);
							$("#PostAdCategoryBrand").focus();
							$(".keywrd_pop").hide();
							$('#PostAdCategoryId option[value="'+parentID+'"]').attr("selected", "selected");
							show_subcat(parentID, childID);
						}
					}
				}
        	</script>
			<?php
		}
		exit();
	}

}

