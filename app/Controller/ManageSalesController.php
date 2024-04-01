<?php
App::uses('AppController', 'Controller');
App::uses('resize', 'Vendor');
/**

 * ManageSales Controller

 *

 * @property ManageSale $ManageSale

 * @property PaginatorComponent $Paginator

 * @property RequestHandlerComponent $RequestHandler

 * @property SessionComponent $Session

 */

class ManageSalesController extends AppController {



/**

 * Components

 *

 * @var array

 */

	public $components = array('Paginator', 'RequestHandler', 'Dez', 'Session');

	public function beforeFilter()

	{

		if(!$this->Session->check('adminUser'))

		{

			$this->redirect(Router::url('/admin/', true));

		}

		else

		{

			$uid=$this->Session->read('adminUser');

			$this->loadModel('AdminLogin');

			$userres=$this->AdminLogin->find('first', array('conditions' => array('uid' => $uid)));

			$this->set('adminRes', $userres);

		}

	}



/**

 * index method

 *

 * @return void

 */

	public function admin_index() {

		$this->loadModel('ManageSale');

		// brand Name

		$this->loadModel("ManageBrand");

		$brand = $this->ManageBrand->find('list',array('conditions'=>array("ManageBrand.flag" => 0,"ManageBrand.status"=>1), 'fields' => array('ManageBrand.brand_id','ManageBrand.brand_name')));

		$this->set("brand",$brand);

		

		// category name

		$this->loadModel("ManageCategory");

		$category = $this->ManageCategory->find('list',array('conditions'=>array("ManageCategory.flag" => 0,"ManageCategory.status"=>1), 'fields' => array('ManageCategory.category_id','ManageCategory.category_name')));

		$this->set("category",$category);

		

		// Search Code here

		$searchtxt=@$this->request->params['named']['searchtxt'];

		

		$brand_id=@$this->request->params['named']['brand_id']!=''?@$this->request->params['named']['brand_id']:'';

		$sub_brand_id=@$this->request->params['named']['sub_brand_id']!=''?@$this->request->params['named']['sub_brand_id']:'';

		

		$cat_id=@$this->request->params['named']['cat_id']!=''?@$this->request->params['named']['cat_id']:'';

		$sub_cat_id=@$this->request->params['named']['sub_cat_id']!=''?@$this->request->params['named']['sub_cat_id']:'';

		//print $searchtxt."<br/>".$brand_id."<br/>".$sub_brand_id."<br/>".$cat_id."<br/>".$sub_cat_id;//exit;

		

		$andwhr=array();

		$orwhr=array();

		

		

		if($searchtxt!=''){

			$searchtxt=urldecode($searchtxt);

			array_push($orwhr,array('ManageSale.adv_name LIKE'=>'%'.$searchtxt.'%'));

			array_push($orwhr,array('ManageSale.adv_details LIKE'=>'%'.$searchtxt.'%'));

		}

		

		if($brand_id!=''){

			$brand_id=urldecode($brand_id);

	array_push($andwhr,array('FIND_IN_SET(\''. $brand_id .'\',ManageSale.adv_brand_id)'));

			

		}

		//pr($cond);

		if($sub_brand_id!=''){

			$sub_brand_id=urldecode($sub_brand_id);

			array_push($andwhr,array('FIND_IN_SET(\''. $sub_brand_id .'\',ManageSale.adv_model_id)'));

			

		}

		if($cat_id!=''){

			$cat_id=urldecode($cat_id);

			array_push($andwhr,array('FIND_IN_SET(\''. $cat_id .'\',ManageSale.category_id)'));

			

		}

		if($sub_cat_id!=''){

			$sub_cat_id=urldecode($sub_cat_id);

			array_push($andwhr,array('FIND_IN_SET(\''. $sub_cat_id .'\',ManageSale.sub_cat_id)'));

		}

		

		

		$this->Paginator->settings = array( 'conditions' => array(

			'AND' => $andwhr,

			'OR' => $orwhr

			),

			'order' =>array('ManageSale.adv_id' => 'desc'),

			 'limit' => 20);

		

		//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));

		$this->set('manageSales', $this->Paginator->paginate('ManageSale'));

		$this->set('searchtxt',$searchtxt);

		$this->set('brand_id',$brand_id);

		$this->set('sub_brand_id',$sub_brand_id);

		$this->set('cat_id',$cat_id);

		$this->set('sub_cat_id',$sub_cat_id);

		$this->layout="manage_admin";

		

	}



/**

 * view method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function admin_view($id = null) {

		if (!$this->ManageSale->exists($id)) {

			throw new NotFoundException(__('Invalid manage sale'));

		}

		$options = array('conditions' => array('ManageSale.' . $this->ManageSale->primaryKey => $id));

		$this->set('manageSale', $this->ManageSale->find('first', $options));

		$this->layout="view_admin";

	}



/**

 * add method

 *

 * @return void

 */

	public function admin_add() {

		$this->set('title_for_layout','Add Description');

		$this->loadModel('SalesCategory');

		$this->loadModel('SalesBrand');

		$cat_list = $this->SalesCategory->find('list', array('conditions'=>array('SalesCategory.flag'=>0,'SalesCategory.status'=>1),'fields'=>array('SalesCategory.category_id','SalesCategory.category_name')));

		$this->set('cat_list',$cat_list);

		$brand_list = $this->SalesBrand->find('list', array('conditions'=>array('SalesBrand.flag'=>0,'SalesBrand.status'=>1),'fields'=>array('SalesBrand.brand_id','SalesBrand.brand_name')));

		$this->set("brand_list",$brand_list);

		

		$this->loadModel('ManageUser');

		$userList = array(''=>'Select User');

		$userList+=$this->ManageUser->find('list', array('conditions'=>array('ManageUser.is_active'=>1),'fields'=>array('ManageUser.user_id','ManageUser.first_name')));

		$this->set("userList",$userList);

		

		if ($this->request->is(array('post', 'put'))) {

			

			$paymentmodearr=array_filter($this->request->data['ManageSale']['payment_mode']);

			$personal_teaching=$this->request->data['ManageSale']['personal_teaching'];

			$courier=$this->request->data['ManageSale']['courier'];

			$romanian_mail=$this->request->data['ManageSale']['romanian_mail'];

			$courier_cost=$this->request->data['ManageSale']['courier_cost'];

			$romanian_mail_cost=$this->request->data['ManageSale']['romanian_mail_cost'];

			$free_courier=$this->request->data['ManageSale']['free_courier'];

			$free_romanian_mail=$this->request->data['ManageSale']['free_romanian_mail'];

			

		if($this->request->data['ManageSale']['adv_details']=='')

		{

			$this->Session->setFlash(__('write your description'));

		}

		else if(strlen($this->request->data['ManageSale']['adv_details'])<45)

		{

			$this->Session->setFlash(__('Description length must be minimum 45 character'));

		}

		else if(!isset($this->request->data['ManageSale']['adv_brand']))

		{

			if($this->request->data['ManageSale']['adv_brand_id']=='' && $this->request->data['ManageSale']['adv_model_id']=='')

			{

			$this->Session->setFlash(__('Select your Ad brand'));

			}

			else

			{

				$this->Session->setFlash(__('Select your Ad Model'));

			}

		}

		else if(!isset($this->request->data['ManageSale']['adv_model']))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">Select your Ad Model</div>'));

		}

		else if(isset($this->request->data['ManageSale']['price']) && ($this->request->data['ManageSale']['price']==0 || $this->request->data['ManageSale']['price']==''))

		{

			$this->Session->setFlash(__('<div class="alert alert-danger">Price must be fill out</div>'));

		}

		else if(isset($this->request->data['ManageSale']['quantity']) && ($this->request->data['ManageSale']['quantity']==0 || $this->request->data['ManageSale']['quantity']==''))

		{

			$this->Session->setFlash(__('Quantity must be fill out'));

		}

		

		else if(empty($paymentmodearr))

		{

			$this->Session->setFlash(__('Choose a payment Mode'));

		}

		else if($personal_teaching==0 && $courier==0 && $romanian_mail==0 && $free_courier==0 && $free_romanian_mail==0)

		{

			

			$this->Session->setFlash(__('Choose a Delivery Method'));

		}

		else if($courier==1 && $free_courier==0 && ($courier_cost=='' || $courier_cost==0))

		{

			$this->Session->setFlash(__('Delivery cost must be fill out'));

		}

		else if($romanian_mail==1 && $free_romanian_mail==0 && ($romanian_mail_cost=='' || $romanian_mail_cost==0))

		{

			$this->Session->setFlash(__('Delivery cost must be fill out'));

		}

		else

		{

			

		//echo "<pre>";print_r($this->request->data);exit;

		

			$this->request->data['ManageSale']['payment_mode']=implode(",",$paymentmodearr);

			$this->request->data['ManageSale']['adv_brand_id']=implode(",",$this->request->data['ManageSale']['adv_brand']);

			$this->request->data['ManageSale']['adv_model_id']=implode(",",$this->request->data['ManageSale']['adv_model']);

			$postdetail=$this->ManageSale->find('first', array('conditions' => array('adv_id' => $this->request->data['ManageSale']['adv_id'])));

			$this->request->data['ManageSale']['slug']=$this->Dez->SlugBYName('ManageSale',$this->request->data['ManageSale']['adv_name']);

			if ($this->ManageSale->save($this->request->data)) {

				$lastid=$this->ManageSale->getLastInsertID();

				 $this->loadModel('PostadImg');

				 $imgdetail=$this->PostadImg->find('all', array('conditions' => array('post_ad_id' => $lastid)));

				 if(count($imgdetail)<=8)

				 {

					 $rest=8-count($imgdetail);

					  $this->loadModel('TempImg'); 

					 $ipaddress=$this->RequestHandler->getClientIp();

					 if($this->Session->check('random_id'))

					 {

						$tempimg=$this->TempImg->find('all', array('conditions' => array('ip_address' => $ipaddress)));

					 }

					 else

					 {

						$tempimg=array(); 

					 }

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

								$post_id=$this->request->data['ManageSale']['adv_id'];

								copy(WWW_ROOT.'files/tempfile/'.$img_path,WWW_ROOT.'files/postad/'.$img_path);
								
								$resizeObj = new resize(WWW_ROOT.'files/postad/'.$img_path);
								
								$resizeObj -> resizeImage(350, 260, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/350X260_'.$img_path, 90);
								
                                $resizeObj -> resizeImage(128, 120, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/128X120_'.$img_path, 90);
								
                                $resizeObj -> resizeImage(165, 135, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/165X135_'.$img_path, 90);
								
								$resizeObj -> resizeImage(100, 100, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/100X100_'.$img_path, 90);
								
								$resizeObj -> resizeImage(50, 50, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/50X50_'.$img_path, 90);

								$this->PostadImg->create();

								$imgsv=$this->PostadImg->save(array('post_ad_id' => $lastid,'img_path'=>$img_path));

								if($imgsv)

								{

									$this->loadModel('TempImg');

									$this->TempImg->delete($tempsingle['TempImg']['img_id']);

									@unlink(WWW_ROOT.'files/tempfile/'.$img_path);

								}

								

							}

							

								$this->Session->setFlash(__('successfully Updated'));

								return $this->redirect(array('action' => 'index'));

						}

						else

						{

							$this->Session->setFlash(__('Upload Upto 8 images'));

						}

					}

					else if(count($imgdetail)==0)

					{

						$this->Session->setFlash(__('upload your post Ad image'));

					}

					else

					{

						$this->Session->setFlash(__('successfully Updated'));

						return $this->redirect(array('action' => 'index'));

					}

				 }

				 else

				 {

					 

					$this->Session->setFlash(__('You have already '.count($imgdetail).' images on your Ad so, delete some image to add new image'));

				 }

				//return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The post ad could not be saved. Please, try again.'));

			}

		}

		}

		$this->layout="add_admin";

		/*else

		{

			$options = array('conditions' => array('ManageSale.' . $this->ManageSale->primaryKey => $id));

			$this->request->data = $this->ManageSale->find('first', $options);

			//print_r($this->request->data);

		}*/

		

	}



/**

 * edit method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function admin_edit($id = null) {

		if (!$this->ManageSale->exists($id)) {

			throw new NotFoundException(__('Invalid manage sale'));

		}

		$this->set('title_for_layout','Add Description');

		$this->loadModel('SalesCategory');

		$this->loadModel('SalesBrand');

		$cat_list = $this->SalesCategory->find('list', array('conditions'=>array('SalesCategory.flag'=>0,'SalesCategory.status'=>1),'fields'=>array('SalesCategory.category_id','SalesCategory.category_name')));

		$this->set('cat_list',$cat_list);

		$brand_list = $this->SalesBrand->find('list', array('conditions'=>array('SalesBrand.flag'=>0,'SalesBrand.status'=>1),'fields'=>array('SalesBrand.brand_id','SalesBrand.brand_name')));

		$this->set("brand_list",$brand_list);

		

		$this->loadModel('ManageUser');

		$userList = array(''=>'Select User');

		$userList+=$this->ManageUser->find('list', array('conditions'=>array('ManageUser.is_active'=>1),'fields'=>array('ManageUser.user_id','ManageUser.first_name')));

		$this->set("userList",$userList);

		if ($this->request->is(array('post', 'put'))) {

			

			$paymentmodearr=array_filter($this->request->data['ManageSale']['payment_mode']);

			$personal_teaching=$this->request->data['ManageSale']['personal_teaching'];

			$courier=$this->request->data['ManageSale']['courier'];

			$romanian_mail=$this->request->data['ManageSale']['romanian_mail'];

			$courier_cost=$this->request->data['ManageSale']['courier_cost'];

			$romanian_mail_cost=$this->request->data['ManageSale']['romanian_mail_cost'];

			$free_courier=$this->request->data['ManageSale']['free_courier'];

			$free_romanian_mail=$this->request->data['ManageSale']['free_romanian_mail'];

		if($this->request->data['ManageSale']['adv_details']=='')

		{

			$this->Session->setFlash(__('write your description'));

		}

		else if(strlen($this->request->data['ManageSale']['adv_details'])<45)

		{

			$this->Session->setFlash(__('Description length must be minimum 45 character'));

		}

		else if(!isset($this->request->data['ManageSale']['adv_brand']))

		{

			if($this->request->data['ManageSale']['adv_brand_id']=='' && $this->request->data['ManageSale']['adv_model_id']=='')

			{

			$this->Session->setFlash(__('Select your Ad brand'));

			}

			else

			{

				$this->Session->setFlash(__('Select your Ad Model'));

			}

		}

		else if(!isset($this->request->data['ManageSale']['adv_model']))

		{

			$this->Session->setFlash(__('Select your Ad Model'));

		}

		else if(isset($this->request->data['ManageSale']['price']) && ($this->request->data['ManageSale']['price']==0 || $this->request->data['ManageSale']['price']==''))

		{

			$this->Session->setFlash(__('Price must be fill out'));

		}

		else if(isset($this->request->data['ManageSale']['quantity']) && ($this->request->data['ManageSale']['quantity']==0 || $this->request->data['ManageSale']['quantity']==''))

		{

			$this->Session->setFlash(__('Quantity must be fill out'));

		}

		

		else if(empty($paymentmodearr))

		{

			$this->Session->setFlash(__('Choose a payment Mode'));

		}

		else if($personal_teaching==0 && $courier==0 && $romanian_mail==0 && $free_courier==0 && $free_romanian_mail==0)

		{

			

			$this->Session->setFlash(__('Choose a Delivery Method'));

		}

		else if($courier==1 && $free_courier==0 && ($courier_cost=='' || $courier_cost==0))

		{

			$this->Session->setFlash(__('Delivery cost must be fill out'));

		}

		else if($romanian_mail==1 && $free_romanian_mail==0 && ($romanian_mail_cost=='' || $romanian_mail_cost==0))

		{

			$this->Session->setFlash(__('Delivery cost must be fill out'));

		}

		else

		{

			

		//echo "<pre>";print_r($this->request->data);exit;

		

			$this->request->data['ManageSale']['payment_mode']=implode(",",$paymentmodearr);

			$this->request->data['ManageSale']['adv_brand_id']=implode(",",$this->request->data['ManageSale']['adv_brand']);

			$this->request->data['ManageSale']['adv_model_id']=implode(",",$this->request->data['ManageSale']['adv_model']);

			$postdetail=$this->ManageSale->find('first', array('conditions' => array('adv_id' => $this->request->data['ManageSale']['adv_id'])));

			$this->request->data['ManageSale']['slug']=$this->Dez->SlugBYName('ManageSale',$this->request->data['ManageSale']['adv_name'],$this->request->data['ManageSale']['adv_id']);

			if ($this->ManageSale->save($this->request->data)) {

				$lastid=$this->request->data['ManageSale']['adv_id'];

				 $this->loadModel('PostadImg');

				 $imgdetail=$this->PostadImg->find('all', array('conditions' => array('post_ad_id' => $lastid)));

				 if(count($imgdetail)<=8)

				 {

					 $rest=8-count($imgdetail);

					  $this->loadModel('TempImg'); 

					 $ipaddress=$this->RequestHandler->getClientIp();

					 if($this->Session->check('random_id'))

					 {

						$tempimg=$this->TempImg->find('all', array('conditions' => array('ip_address' => $ipaddress)));

					 }

					 else

					 {

						$tempimg=array(); 

					 }

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

								$post_id=$this->request->data['ManageSale']['adv_id'];

								copy(WWW_ROOT.'files/tempfile/'.$img_path,WWW_ROOT.'files/postad/'.$img_path);
								
								$resizeObj = new resize(WWW_ROOT.'files/postad/'.$img_path);
								
								$resizeObj -> resizeImage(350, 260, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/350X260_'.$img_path, 90);
								
                                $resizeObj -> resizeImage(128, 120, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/128X120_'.$img_path, 90);
								
                                $resizeObj -> resizeImage(100, 100, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/100X100_'.$img_path, 90);
								
								$resizeObj -> resizeImage(50, 50, 'crop');
								$resizeObj -> saveImage(WWW_ROOT.'files/postad/50X50_'.$img_path, 90);

								$this->PostadImg->create();

								$imgsv=$this->PostadImg->save(array('post_ad_id' => $lastid,'img_path'=>$img_path));

								if($imgsv)

								{

									$this->loadModel('TempImg');

									$this->TempImg->delete($tempsingle['TempImg']['img_id']);

									@unlink(WWW_ROOT.'files/tempfile/'.$img_path);

								}

								

							}

							

								$this->Session->setFlash(__('successfully Updated'));

								return $this->redirect(array('action' => 'index'));

						}

						else

						{

							$this->Session->setFlash(__('Upload Upto 8 images'));

						}

					}

					else if(count($imgdetail)==0)

					{

						$this->Session->setFlash(__('upload your post Ad image'));

					}

					else

					{

						$this->Session->setFlash(__('successfully Updated'));

						return $this->redirect(array('action' => 'index'));

					}

					

				 }

				 else

				 {

					 

					$this->Session->setFlash(__('You have already '.count($imgdetail).' images on your Ad so, delete some image to add new image'));

				 }

				//return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The post ad could not be saved. Please, try again.'));

			}

		}

		} else {

			$options = array('conditions' => array('ManageSale.' . $this->ManageSale->primaryKey => $id));

			$this->request->data = $this->ManageSale->find('first', $options);

		}

		$this->layout="add_admin";

	}



/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function admin_delete($id = null) {

		$this->ManageSale->id = $id;

		if (!$this->ManageSale->exists()) {

			throw new NotFoundException(__('Invalid manage sale'));

		}

		 $this->loadModel('PostadImg');

				 $imgres=$this->PostadImg->find('all', array('conditions' => array('post_ad_id'=>$id)));

		$this->request->onlyAllow('post', 'delete');

		if ($this->ManageSale->delete()) {

			

			if(!empty($imgres))

			{

				 foreach($imgres as $imgdetail)

				 {

				 @unlink(WWW_ROOT.'files/postad/'.$imgdetail['PostadImg']['img_path']);

				 $this->PostadImg->delete($imgdetail['PostadImg']['imgid']);

				 }

			}

			$this->Session->setFlash(__('The manage sale has been deleted.'));

		} else {

			$this->Session->setFlash(__('The manage sale could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

		$this->layout="manage_admin";

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

			if(count($this->request->data['ManageSale']['adv_img'])>0)

			{

				foreach($this->request->data['ManageSale']['adv_img'] as $allimg)

				{

					//echo 1;

					if($allimg['name']!='')

					{

					$filename = time().$allimg['name'];

					//$filename=$this->Ikm->CleanFilePath($filename);

					// echo $filename;exit;

					move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/tempfile/'.$filename);
					$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
					$this->request->data['TempImg']['img_path'] = $filename;

					

					}

					else

					{

					$this->request->data['TempImg']['img_path'] ='';	

					}

					$random=rand(10, 10000);

					$this->request->data['TempImg']['random_id']=$random;

					$this->request->data['TempImg']['ip_address']=$this->RequestHandler->getClientIp();

					$this->request->data['TempImg']['post_id']=$this->request->data['ManageSale']['post_id'];

					$this->Session->write('random_id',$random);

					$this->TempImg->create();

					$save=$this->TempImg->save($this->request->data);

				}

				

			}

			unset($this->request->data['ManageSale']['adv_img']);

			unset($this->request->data['ManageSale']);

			if($save)

			{

				$postid=$this->request->data['TempImg']['post_id'];

			}

			

		}

		if($this->Session->check('random_id')){

			$randseaaion=$this->Session->read('random_id');

			$tempdata=$this->TempImg->find('all',array('conditions' => array('ip_address' => $this->RequestHandler->getClientIp())));

			$this->set('tempfile',$tempdata);

		}

		else

		{

			$this->set('tempfile',array());

		}

		if($postid!=NULL)

		{

		$this->loadModel('PostadImg');

		$originalfile=$this->PostadImg->find('all',array('conditions' => array('post_ad_id' => $postid)));

		$this->set('originalfile',$originalfile);

		$this->set('postid',$postid);

		}

		else

		{

			$this->set('originalfile',array());

			$this->set('postid','');

		}

		$this->layout='fileupload';

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

				 $this->PostadImg->delete($imgid);

				 echo 1;

			 }

		 }

		 exit;

		 

	 }

	 /*

		change the status

	*/

	function changeStatus(){//print_r($this->request->data);exit;

	$this->layout='ajax';

	$this->LoadModel("ManageSale");

	$status=$this->request->data['status'];

	$adv_id=$this->request->data['adv_id'];

	$this->ManageSale->id=$adv_id;

	if($this->ManageSale->saveField("adv_status",$status)){

		echo 1;exit;

	}else{

		echo 0;exit;

	}

   }

   function getSubbrand(){

	   $this->layout='ajax';

	  $brand_id= $this->request->data['brand_id'];

	   $this->loadModel("ManageBrand");

		$sub_brand = $this->ManageBrand->find('list',array('conditions'=>array("ManageBrand.flag" => $brand_id,"ManageBrand.status"=>1), 'fields' => array('ManageBrand.brand_id','ManageBrand.brand_name')));

		//$this->set("sub_brand",$sub_brand);

		if(count($sub_brand)>0){

			echo "<option value=''>-Select-</option>";

			foreach($sub_brand AS $key=>$val){

			echo "<option value=$key>$val</option>";

		}

		}else{

			echo "<option value=''>-Select-</option>";

		}

		

		exit;

	   

   }

   function getSubcat(){

	   $this->layout='ajax';

	  $cat_id= $this->request->data['cat_id'];

	  

	   $this->loadModel("ManageCategory");

		$sub_cat = $this->ManageCategory->find('list',array('conditions'=>array("ManageCategory.flag" => $cat_id,"ManageCategory.status"=>1), 'fields' => array('ManageCategory.category_id','ManageCategory.category_name')));

		

		if(count($sub_cat)>0){

			echo "<option value=''>-Select-</option>";

			foreach($sub_cat AS $key=>$val){

			echo "<option value=$key >$val</option>";

		}

		}else{

			echo "<option value=''>-Select-</option>";

		}

		

		exit;

	   

   }

   public function admin_promoteddetail($adv_id='')

   {

	   $this->set('title_for_layout', 'Promotion Details');

	   if($adv_id!='')

	   {

		   $this->loadModel('PromotionAd');

		   $promotionDetail=$this->PromotionAd->find('first', array('conditions' => array('PromotionAd.adv_id' => $adv_id)));

		   $this->set('promotionDetail', $promotionDetail);

	   }

	   else

	   {

		   $this->redirect(array('action' => 'index'));

	   }

	   $this->layout="manage_admin";

   }

   public function admin_expirepromote()

   {

	   $this->set('title_for_layout', 'Promotion Expire');

	   if($this->request->is('post'))

	   {

		   $currentDate=date("Y-m-d");

		   $this->loadModel('PromotionAd');

		   $promotionChk=$this->PromotionAd->find('all', array('conditions' => array('AND' => array('is_home_expire <' => $currentDate, 'is_list_expire <' => $currentDate))));

		   if(count($promotionChk)>0)

		   {

			  // pr($promotionChk);exit;

			   foreach($promotionChk as $promotionChkRes)

			   {

				   $adv_id=$promotionChkRes['PromotionAd']['adv_id'];

				   $this->loadModel('PostAd');

				   $save=$this->PostAd->save(array('adv_id' => $adv_id, 'is_promote' => 0, 'is_promote_list' => 0));

				   if($save)

				   {

					   $this->PromotionAd->delete($promotionChkRes['PromotionAd']['promotion_id']);

				   }

			   }

			   $this->Session->setFlash("Successfully reset all expired promoted ad");

		   }

		   else

		   {

			   $this->Session->setFlash("Expire ads not found ");

		   }

	   }

	   $this->layout="manage_admin";

	   

   }

  	public function admin_add_credit()

	{

		$this->loadModel('UserCreditWallet');

		$this->set('title_for_layout', 'Add Credits');

		if($this->request->is('post'))

		{

			if(isset($this->request->data['add_credit']))

			{

				$this->request->data['UserCreditWallet']['credits_by']=1;

				$this->loadModel('MasterUser');

				$email=$this->request->data['UserCreditWallet']['user_id'];

				$userRes=$this->MasterUser->find('first', array('conditions' => array('email' => $email)));

				if(empty($userRes))

				{

					$this->Session->setFlash('This Email ID not exist in user list. Please try again');

				}

				else if($this->request->data['UserCreditWallet']['credits']=='')

				{

					$this->Session->setFlash('Enter the Credits');

				}

				else

				{

					$userID=$userRes['MasterUser']['user_id'];

					$this->request->data['UserCreditWallet']['user_id']=$userID;

					$this->loadModel('UserCreditWallet');

					$this->UserCreditWallet->create();

					if($this->UserCreditWallet->save($this->request->data))

					{

						$this->loadModel('UserTotalCredit');

						$usercredit=$this->UserTotalCredit->find('first', array('conditions' => array('user_id' => $userID)));

						if(count($usercredit))

						{

						$creditval=$usercredit['UserTotalCredit']['credits'];

						$totcredit=$this->request->data['UserCreditWallet']['credits']+$creditval;

						$this->UserTotalCredit->save(array('id' => $usercredit['UserTotalCredit']['id'],'user_id' => $userID, 'credits' => $totcredit));

						}

						else

						{

							$totcredit=$this->request->data['UserCreditWallet']['credits'];

							$this->UserTotalCredit->create();

							$this->UserTotalCredit->save(array('credits' => $totcredit,'user_id' => $userID));

						}

						$this->Session->setFlash('Credit added successfully');

						$this->redirect(array('action' => 'usercredits'));

					}

				}

			}

		}

		$this->layout="manage_admin";

	}

   public function admin_usercredits()

   {

	   $this->loadModel('UserCreditWallet');

		$this->set('title_for_layout', 'All Credits List');

		$this->UserCreditWallet->recursive = 0;

		$this->Paginator->settings = array('order' =>array('credit_id' => 'desc'),'limit' => 20);

		$this->set('creditsList', $this->Paginator->paginate('UserCreditWallet'));

		$this->layout="manage_admin";

   }

   public function admin_autocomplete()

   {

	   $this->loadModel('MasterUser');

	   if($this->request->is('post'))

	   {

		   $keyword = $this->request->data['keyword'];

		   $userresult=$this->MasterUser->find('all', array('conditions' => array('email LIKE' =>'%'.$keyword.'%')));

		   if(!empty($userresult))

		   {

			   foreach($userresult as $userres)

			   {

		   // put in bold the written text

			$emailID = str_replace($keyword, '<b>'.$keyword.'</b>', $userres['MasterUser']['email']);

			// add new option

			echo '<li onclick="set_item(\''.str_replace("'", "\'", $userres['MasterUser']['email']).'\')">'.$emailID.'</li>';

			   }

		   }

	   }

	   exit;

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

}

