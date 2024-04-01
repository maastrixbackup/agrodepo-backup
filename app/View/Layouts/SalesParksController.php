<?php
App::uses('AppController', 'Controller');
/**
 * SalesParks Controller
 *
 * @property SalesPark $SalesPark
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SalesParksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler', 'Session','Dez');
	public function beforeFilter(){
	
			if(!$this->Session->check('User'))
			{
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
		if(!$this->Session->check('User'))
			{
				return $this->redirect(Router::url('/', true));
			}
			$user=$this->Session->read('User');
		$this->set('title_for_layout','Truck Parks');	
		$this->SalesPark->recursive = 0;
		//-------Active request parts list functionality----------------
				$options=array(             
							  'conditions' =>
							  array('AND' => array(
								array('SalesPark.status' => 1, 'SalesPark.add_type' => 1, 'SalesPark.user_id' => $user['user_id']),
							 )),
							 'order' =>
							  array('SalesPark.park_id' => 'desc'),
						);
		$this->Paginator->settings=$options;
		$this->set('salesParks', $this->Paginator->paginate());
		$this->layout="sales_park_list";
	}
	public function companypieces()
	{
		if(!$this->Session->check('User'))
			{
				return $this->redirect(Router::url('/', true));
			}
			$user=$this->Session->read('User');
		$this->set('title_for_layout','Firme piese List');	
		$this->SalesPark->recursive = 0;
		//-------Active request parts list functionality----------------
				$options=array(             
							  'conditions' =>
							  array('AND' => array(
								array('SalesPark.status' => 1, 'SalesPark.add_type' => 2, 'SalesPark.user_id' => $user['user_id']),
							 )),
							 'order' =>
							  array('SalesPark.park_id' => 'desc'),
						);
		$this->Paginator->settings=$options;
		$this->set('salesParks', $this->Paginator->paginate());
		$this->layout="sales_park_list";
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SalesPark->exists($id)) {
			throw new NotFoundException(__('Invalid sales park'));
		}
		$options = array('conditions' => array('SalesPark.' . $this->SalesPark->primaryKey => $id));
		$this->set('salesPark', $this->SalesPark->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if(!$this->Session->check('User'))
			{
				return $this->redirect(Router::url('/Logins', true));
			}
			$user=$this->Session->read('User');
		$this->set('title_for_layout','Sales Park Add');
		
		$this->loadModel('MasterCountry');
		$county = array(''=>SELECTCOUNTRY);
		$county += $this->MasterCountry->find('list', array('fields' => array
('MasterCountry.country_id','MasterCountry.country_name'),'order' =>array('MasterCountry.country_name' => 'asc')));
	$this->set('masterCountry', $county);
	
	$this->loadModel('ManageBrand');
		//$brand = array(''=>'Select Brand');
		$brand = $this->ManageBrand->find('list', array('conditions' => array('ManageBrand.flag' => 0), 'fields' => array
('ManageBrand.brand_id','ManageBrand.brand_name'),'order' =>array('ManageBrand.brand_name' => 'asc')));
	$this->set('brandList', $brand);
	
		if ($this->request->is('post')) {
				//-----------------------------------------------------
				$this->loadModel('MasterMessage');
				$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>57)));
				$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 58)));
				//-------------------------------------------------------
			
			$this->request->data['SalesPark']['user_id']=$user['user_id'];
			if(!isset($this->request->data['SalesPark']['brand_id']))
			{
				$this->Session->setFlash(__('<div class="alert alert-danger">Marca trebuie să fie selectați</div>'));
			}
			else
			{
				$brandarr=$this->request->data['SalesPark']['brand_id'];
				if(!empty($this->request->data['SalesPark']['brand_id']))
				{
					
					$this->request->data['SalesPark']['brand_id']=implode(',',$brandarr);
				}
					$this->request->data['SalesPark']['add_type']=1;
					//pr($this->request->data['SalesPark']['logo']);exit;
					 if($this->request->data['SalesPark']['logo']['name']!='')
					{
						
							//echo 1;
							
							$filename = time().$this->request->data['SalesPark']['logo']['name'];
							//$filename=$this->Ikm->CleanFilePath($filename);
							// echo $filename;exit;
							move_uploaded_file($this->request->data['SalesPark']['logo']['tmp_name'], WWW_ROOT.'files/company_logo/'.$filename);
							$this->request->data['SalesPark']['logo'] = $filename;
							
							
						
						
					}
					$this->request->data['SalesPark']['status']=1;
					$this->request->data['SalesPark']['slug']=$this->Dez->slug('SalesPark',$this->request->data['SalesPark']['park_name']);
				$this->SalesPark->create();
				if ($this->SalesPark->save($this->request->data)) {
					
					$inderid = $this->SalesPark->getLastInsertId();
						if($this->Session->check('parksrandom_id'))
						{
							$clientip=$this->RequestHandler->getClientIp();
							$randomid=$this->Session->read('parksrandom_id');
							 $this->loadModel('TempImg');
							$imgdetail=$this->TempImg->find('all', array('ip_address'=>$clientip, 'random_id' =>$randomid ));
							//pr($imgdetail);exit;
							if(!empty($imgdetail))
							{
								$this->loadModel('ParkImg');
								foreach($imgdetail as $imgRes)
								{
								$img_path=$imgRes['TempImg']['img_path'];
								copy(WWW_ROOT.'files/tempfile/'.$img_path,WWW_ROOT.'files/parkimg/'.$img_path);
								$this->ParkImg->create();
								$imgsv=$this->ParkImg->save(array('park_id' => $inderid,'img_path'=>$img_path));
								@unlink(WWW_ROOT.'files/tempfile/'.$imgRes['TempImg']['img_path']);
								 $this->TempImg->delete($imgRes['TempImg']['img_id']);
								}
							}
							
						}
						unset($this->request->data);
					$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
					//return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
					$this->request->data['SalesPark']['brand_id']=$brandarr;
				}
			}
			
		}
		$this->layout="sales_park_add";
	}
/**
 * Company add method
 *
 * @return void
 */
	public function company_add() {
		if(!$this->Session->check('User'))
			{
				return $this->redirect(Router::url('/Logins', true));
			}
			$user=$this->Session->read('User');
		$this->set('title_for_layout','Sales Park Add');
		
		$this->loadModel('MasterCountry');
		$county = array(''=>SELECTCOUNTRY);
		$county += $this->MasterCountry->find('list', array('fields' => array
('MasterCountry.country_id','MasterCountry.country_name'),'order' =>array('MasterCountry.country_name' => 'asc')));
	$this->set('masterCountry', $county);
	
	$this->loadModel('ManageBrand');
		$brand = $this->ManageBrand->find('list', array('conditions' => array('ManageBrand.flag' => 0), 'fields' => array
('ManageBrand.brand_id','ManageBrand.brand_name'),'order' =>array('ManageBrand.brand_name' => 'asc')));
	$this->set('brandList', $brand);
	
		if ($this->request->is('post')) {
			//-----------------------------------------------------
				$this->loadModel('MasterMessage');
				$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>59)));
				$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 60)));
				//-------------------------------------------------------
			
			$this->request->data['SalesPark']['user_id']=$user['user_id'];
			if(!isset($this->request->data['SalesPark']['brand_id']))
			{
				$this->Session->setFlash(__('<div class="alert alert-danger">Marca trebuie să fie selectați</div>'));
			}
			else
			{
				$brandarr=$this->request->data['SalesPark']['brand_id'];
				if(!empty($this->request->data['SalesPark']['brand_id']))
				{
					
					$this->request->data['SalesPark']['brand_id']=implode(',',$brandarr);
				}
					$this->request->data['SalesPark']['add_type']=2;
					//pr($this->request->data['SalesPark']['logo']);exit;
					 if($this->request->data['SalesPark']['logo']['name']!='')
					{
						
							//echo 1;
							
							$filename = time().$this->request->data['SalesPark']['logo']['name'];
							//$filename=$this->Ikm->CleanFilePath($filename);
							// echo $filename;exit;
							move_uploaded_file($this->request->data['SalesPark']['logo']['tmp_name'], WWW_ROOT.'files/company_logo/'.$filename);
							$this->request->data['SalesPark']['logo'] = $filename;
							
							
						
						
					}
					$this->request->data['SalesPark']['status']=1;
					$this->request->data['SalesPark']['slug']=$this->Dez->slug('SalesPark',$this->request->data['SalesPark']['park_name']);
					//pr($this->request->data);exit;
				$this->SalesPark->create();
				if ($this->SalesPark->save($this->request->data)) {
					
					$inderid = $this->SalesPark->getLastInsertId();
						if($this->Session->check('parksrandom_id'))
						{
							$clientip=$this->RequestHandler->getClientIp();
							$randomid=$this->Session->read('parksrandom_id');
							 $this->loadModel('TempImg');
							$imgdetail=$this->TempImg->find('all', array('ip_address'=>$clientip, 'random_id' =>$randomid ));
							//pr($imgdetail);exit;
							if(!empty($imgdetail))
							{
								$this->loadModel('ParkImg');
								foreach($imgdetail as $imgRes)
								{
								$img_path=$imgRes['TempImg']['img_path'];
								copy(WWW_ROOT.'files/tempfile/'.$img_path,WWW_ROOT.'files/parkimg/'.$img_path);
								$this->ParkImg->create();
								$imgsv=$this->ParkImg->save(array('park_id' => $inderid,'img_path'=>$img_path));
								@unlink(WWW_ROOT.'files/tempfile/'.$imgRes['TempImg']['img_path']);
								 $this->TempImg->delete($imgRes['TempImg']['img_id']);
								}
							}
							
						}
						unset($this->request->data);
					$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
					//return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
					$this->request->data['SalesPark']['brand_id']=$brandarr;
				}
			}
			
		}
		$this->layout="sales_park_add";
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SalesPark->exists($id)) {
			throw new NotFoundException(__('Invalid sales park'));
		}
		
		if(!$this->Session->check('User'))
			{
				return $this->redirect(Router::url('/Logins', true));
			}
			$user=$this->Session->read('User');
		$this->set('title_for_layout','Park Edir');
		
		$this->loadModel('MasterCountry');
		$county = array(''=>SELECTCOUNTRY);
		$county += $this->MasterCountry->find('list', array('fields' => array
('MasterCountry.country_id','MasterCountry.country_name'),'order' =>array('MasterCountry.country_name' => 'asc')));
	$this->set('masterCountry', $county);
	
	$this->loadModel('ManageBrand');
		$brand = $this->ManageBrand->find('list', array('conditions' => array('ManageBrand.flag' => 0), 'fields' => array
('ManageBrand.brand_id','ManageBrand.brand_name'),'order' =>array('ManageBrand.brand_name' => 'asc')));
	$this->set('brandList', $brand);
	
		if ($this->request->is(array('post', 'put'))) {
			//-----------------------------------------------------
				$this->loadModel('MasterMessage');
				$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>59)));
				$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 60)));
				//-------------------------------------------------------
			
			$this->request->data['SalesPark']['user_id']=$user['user_id'];
			if(!isset($this->request->data['SalesPark']['brand_id']))
			{
				$this->Session->setFlash(__('<div class="alert alert-danger">Marca trebuie să fie selectați</div>'));
			}
			else
			{
				$brandarr=$this->request->data['SalesPark']['brand_id'];
				if(!empty($this->request->data['SalesPark']['brand_id']))
				{
					
					$this->request->data['SalesPark']['brand_id']=implode(',',$brandarr);
				}
					 if($this->request->data['SalesPark']['logo']['name']!='')
					{
						
							//echo 1;
							
							$filename = time().$this->request->data['SalesPark']['logo']['name'];
							//$filename=$this->Ikm->CleanFilePath($filename);
							// echo $filename;exit;
							move_uploaded_file($this->request->data['SalesPark']['logo']['tmp_name'], WWW_ROOT.'files/company_logo/'.$filename);
							$this->request->data['SalesPark']['logo'] = $filename;
							
							
						
						
					}
					else
					{
						unset($this->request->data['SalesPark']['logo']);
					}
					$this->request->data['SalesPark']['slug']=$this->Dez->slug('SalesPark',$this->request->data['SalesPark']['park_name'], $this->request->data['SalesPark']['park_id'],'park_id');
					//pr($this->request->data);exit;
				if ($this->SalesPark->save($this->request->data)) {
					
					$inderid = $this->SalesPark->getLastInsertId();
						if($this->Session->check('parksrandom_id'))
						{
							$clientip=$this->RequestHandler->getClientIp();
							$randomid=$this->Session->read('parksrandom_id');
							 $this->loadModel('TempImg');
							$imgdetail=$this->TempImg->find('all', array('ip_address'=>$clientip, 'random_id' =>$randomid ));
							//pr($imgdetail);exit;
							if(!empty($imgdetail))
							{
								$this->loadModel('ParkImg');
								foreach($imgdetail as $imgRes)
								{
								$img_path=$imgRes['TempImg']['img_path'];
								copy(WWW_ROOT.'files/tempfile/'.$img_path,WWW_ROOT.'files/parkimg/'.$img_path);
								$this->ParkImg->create();
								$imgsv=$this->ParkImg->save(array('park_id' => $inderid,'img_path'=>$img_path));
								@unlink(WWW_ROOT.'files/tempfile/'.$imgRes['TempImg']['img_path']);
								 $this->TempImg->delete($imgRes['TempImg']['img_id']);
								}
							}
							
						}
						//unset($this->request->data);
					$this->Session->setFlash(__('<div class="alert alert-success">Park Actualizat cu succes</div>'));
					//return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger">Park Actualizarea a eșuat</div>'));
					$this->request->data['SalesPark']['brand_id']=$brandarr;
				}
			}
			
		}
		 else {
			$options = array('conditions' => array('SalesPark.' . $this->SalesPark->primaryKey => $id));
			$this->request->data = $this->SalesPark->find('first', $options);
		}
		$this->layout="sales_park_add";
	
		
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SalesPark->id = $id;
		if (!$this->SalesPark->exists()) {
			throw new NotFoundException(__('Invalid sales park'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SalesPark->delete()) {
			$this->Session->setFlash(__('The sales park has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sales park could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	 /**
 * File Upload method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	 public function fileupload()
	 {
		 $this->loadModel('TempImg');
		 if($this->request->is('post'))
		 {
			 if(count($this->request->data['SalesParks']['img_path'])>0)
			{
				$generateid=rand();
				//pr($this->request->data['SalesParks']['img_path']);exit;
				foreach($this->request->data['SalesParks']['img_path'] as $allimg)
				{
					//echo 1;
					if($allimg['name']!='')
					{
					$filename = time().$allimg['name'];
					//$filename=$this->Ikm->CleanFilePath($filename);
					// echo $filename;exit;
					move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/tempfile/'.$filename);
					$this->request->data['TempImg']['img_path'] = $filename;
					
					}
					else
					{
					$this->request->data['TempImg']['img_path'] ='';	
					}
					$this->request->data['TempImg']['ip_address']=$this->RequestHandler->getClientIp();
					if(!$this->Session->check('parksrandom_id'))
					{
					$this->request->data['TempImg']['random_id']=$generateid;
					$this->Session->write('parksrandom_id',$generateid);
					}
					else
					{
						$this->request->data['TempImg']['random_id']=$this->Session->read('parksrandom_id');
					}
					$this->TempImg->create();
					$save=$this->TempImg->save($this->request->data);
				}
				
			}
		 }
		 $imgcontent='';
			if($this->Session->check('parksrandom_id'))
			{
			 $clientip=$this->RequestHandler->getClientIp();
			 $randomid=$this->Session->read('parksrandom_id');
			 $req_temp_img=$this->TempImg->find('all',array('conditions' => array('random_id' => $randomid, 'ip_address' => $clientip)));
			// pr($req_temp_img);
			 if(!empty($req_temp_img))
			 {
				 $imgcontent='<ul class="iframe_list">';
				 foreach($req_temp_img as $req_img_res)
				 {
					 $temp="'temp'";
					 $imgcontent.='<li id="imgtemp'.$req_img_res['TempImg']['img_id'].'"><img src="'.Router::url('/', true).'files/tempfile/'.$req_img_res['TempImg']['img_path'].'"><button type="button" onclick="removedata('.$req_img_res['TempImg']['img_id'].','.$temp.')">X</button></li>';
				 }
				 $imgcontent.='</ul>';
			 }
			}
		// echo $imgcontent;exit;
		 $this->set('imgContent',$imgcontent);
		$this->layout="fileupload"; 
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
				 $this->loadModel('ParkImg');
				 $imgdetail=$this->ParkImg->find('first', array('img_id'=>$imgid));
				 @unlink(WWW_ROOT.'files/parkimg/'.$imgdetail['TempImg']['img_path']);
				 $this->ParkImg->delete($imgid);
				 echo 1;
			 }
		 }
		 exit;
		 
	 }
}
