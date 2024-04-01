<?php
App::uses('AppController', 'Controller');
/**
 * AdminLogins Controller
 *
 * @property AdminLogin $AdminLogin
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AdminLoginsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	
	/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout', 'Admin Login');

		if($this->request->is('post'))
		{
			if(isset($this->request->data['login']))
			{
				$userid=$this->request->data['userid'];
				$password=$this->request->data['password'];
				$checklogin=$this->AdminLogin->find('first', array('conditions' => array('user_id' => $userid, 'pass' => $password, 'is_active' =>1)));
				if(count($checklogin)>0)
				{
					$this->Session->write('adminUser',$checklogin['AdminLogin']['uid']);
					$this->redirect(Router::url('/admin/AdminLogins/dashboard', true));
				}
				else
				{
					$this->Session->setFlash(__('Incorrect User ID / Password'));
				}
			}
		}
		$this->layout="admin_login";
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->set('title_for_layout', 'Admin Login');
		if($this->request->is('post'))
		{
			if(isset($this->request->data['login']))
			{
				$userid=$this->request->data['userid'];
				$password=$this->request->data['password'];
				$checklogin=$this->AdminLogin->find('first', array('conditions' => array('user_id' => $userid, 'pass' => $password, 'is_active' =>1)));
				if(count($checklogin)>0)
				{
					$this->Session->write('adminUser',$checklogin['AdminLogin']['uid']);
					$this->redirect(Router::url('/admin/AdminLopgins/dashboard', true));
				}
				else
				{
					$this->Session->setFlash(__('Incorrect User ID / Password'));
				}
			}
		}
		$this->layout="admin_login";
	}
/**
 * admin_dashboard method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_dashboard()
	{
		if(!$this->Session->check('adminUser'))
		{
			$this->redirect(Router::url('/admin/', true));
		}
		$uid=$this->Session->read('adminUser');
		$userres=$this->AdminLogin->find('first', array('conditions' => array('uid' => $uid)));
		$this->set('adminRes', $userres);
		$this->set('title_for_layout', 'Admin Dashboard');
		$this->layout="admin_dashboard";
	}
	public function signOut()
	{
		$this->Session->delete('adminUser');
		if(!$this->Session->check('adminUser'))
		{
		echo 1;
		}
		else
		{
			echo 2;
		}
		exit;
	}
	public function noticeStatus()
	{
		if($this->request->is('post'))
		{
			if(isset($this->request->data['noticetype']))
			{
				$this->loadModel('Notice');
				//$result=$this->Notice->query("select * from notice where status='1' and user_id!='' and notice_type='".$this->request->data['noticetype']."'");
				//echo "select * from notice where status='1' and user_id!='' and notice_type='".$this->request->data['noticetype']."'";
				$result=$this->Notice->find('first', array('conditions' => array('status' => 0, 'user_id !=' => 0, 'notice_type' => $this->request->data['noticetype'])));
				$update=$this->Notice->query("update notice set status='1' where notice_type='".$this->request->data['noticetype']."'");
				if(isset($result['Notice']['user_id']) && ($this->request->data['noticetype']=='buyer-rate' || $this->request->data['noticetype']=='seller-rate'))
				{
					echo "/".$result['Notice']['user_id'];
				}
			}
			else
			{
				echo 2;
			}
		}
		else
		{
			echo 2;
		}
		exit;
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
	public function admin_sitesetting()
	 {
		 $this->loadModel('Sitesetting');
		  $settingres=$this->Sitesetting->find('first', array('conditions' => array('id' => 1)));
			 $this->set('settingres', $settingres);
		 if(!$this->Session->check('adminUser'))
		{
			$this->redirect(Router::url('/admin/', true));
		}
		$uid=$this->Session->read('adminUser');
		$userres=$this->AdminLogin->find('first', array('conditions' => array('uid' => $uid)));
		$this->set('adminRes', $userres);
		$this->set('title_for_layout', 'Site Setting');
		 if($this->request->is(array('post', 'put')))
		  {
			 // pr($this->request->data);exit;
		  	if($this->request->data['Sitesetting']['logo_image']['name']!='')
			  {
				  
				  $logo_img= time().$this->request->data['Sitesetting']['logo_image']['name'];
				  move_uploaded_file($this->request->data['Sitesetting']['logo_image']['tmp_name'],WWW_ROOT.'files/site_logo/'.$logo_img);
				  $this->request->data['Sitesetting']['logo_image']=$logo_img;
				  $this->request->data['Sitesetting']['id']=1;
				  @unlink(WWW_ROOT.'files/site_logo/'.$settingres['Sitesetting']['logo_image']);
				  
			  }
			  else
			  {
				  $this->request->data['Sitesetting']['logo_image']=@$settingres['Sitesetting']['logo_image'];
			  }
			  if($this->Sitesetting->save($this->request->data))
				  {
					  
					  $this->Session->setFlash(__('The Logo Updated Sucessfully'));
					   $settingres=$this->Sitesetting->find('first', array('conditions' => array('id' => 1)));
						 $this->set('settingres', $settingres);
					 // return $this->redirect(array('action' => 'index'));
				  }
			 
		  }
		  
			 
		  $this->layout="add_admin";
	 }
	 /**
 * Add method
 *Method: admin_locsave
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
	public function admin_editloc($id='')
	{
		 
		
		 $this->loadModel('MasterLocation');
		 if(!$this->Session->check('adminUser'))
		{
			$this->redirect(Router::url('/admin/', true));
		}
		
		$uid=$this->Session->read('adminUser');
		$userres=$this->AdminLogin->find('first', array('conditions' => array('uid' => $uid)));
		$this->set('adminRes', $userres);
		$this->set('title_for_layout', 'Save Locality');
		 $this->loadModel('MasterCountry');
		 $optionList = array("" => "Select County");
		 $optionList+= $this->MasterCountry->find('list', array('order' => array('country_name' => 'asc')));
		 $this->set('countyList', $optionList);
		 if($id!='')
		 {
		if($this->request->is(array('post','put')))
		{
				if(isset($this->request->data['MasterLocation']['location_name']) && $this->request->data['MasterLocation']['location_name']!='')
				{
					$update=$this->MasterLocation->save($this->request->data);
					if($update){	
						$this->Session->setFlash(__('Location updated Sucessfully'));
						$this->redirect(Router::url('/', true).'admin/AdminLogins/loclist');
					}
					else
					{
						$this->Session->setFlash(__('Location updating Failed'));
					}
				}
			}
			else
			{
				$fetchdetail=$this->MasterLocation->find('first', array('conditions' => array('location_id' => $id)));
				$this->request->data=$fetchdetail;
			}
		 }
		 $this->layout="add_admin";
	 }
	 public function admin_locsave()
	{
		 
		
		 $this->loadModel('MasterLocation');
		 if(!$this->Session->check('adminUser'))
		{
			$this->redirect(Router::url('/admin/', true));
		}
		
		$uid=$this->Session->read('adminUser');
		$userres=$this->AdminLogin->find('first', array('conditions' => array('uid' => $uid)));
		$this->set('adminRes', $userres);
		$this->set('title_for_layout', 'Save Locality');
		 $this->loadModel('MasterCountry');
		 $optionList = array("" => "Select County");
		 $optionList+= $this->MasterCountry->find('list', array('order' => array('country_name' => 'asc')));
		 $this->set('countyList', $optionList);
		if($this->request->is(array('post')))
		{
			if(isset($this->request->data['MasterLocation']['location_name']) && $this->request->data['MasterLocation']['location_name']!='')
			{
				$locationarray=explode(",", $this->request->data['MasterLocation']['location_name']);
				if(!empty($locationarray))
				{
					foreach($locationarray as $this->request->data['MasterLocation']['location_name'])
					{
						$this->MasterLocation->create();
						$this->MasterLocation->save($this->request->data);
					}
					unset($this->request->data);
					$this->Session->setFlash(__('Location saved Sucessfully'));
				}
				else
				{
					$this->Session->setFlash(__('Location saving Failed'));
				}
			}
		}
		 $this->layout="add_admin";
	 }
	 public function admin_loclist($srchtxt='', $countyid='')
	 {
		if(isset($this->request->params['named']['countyid'])){$countyid=$this->request->params['named']['countyid'];}else{$countyid='';}
		if(isset($this->request->params['named']['srchtxt'])){$srchtxt=urldecode($this->request->params['named']['srchtxt']);}else{$srchtxt='';}
		if(!$this->Session->check('adminUser'))
		{
			$this->redirect(Router::url('/admin/', true));
		}
		$this->loadModel('MasterCountry');
		$options=$this->MasterCountry->find('all', array('order' => array('country_name' => 'asc')));
		$this->set('options', $options);
		$uid=$this->Session->read('adminUser');
		$userres=$this->AdminLogin->find('first', array('conditions' => array('uid' => $uid)));
		$this->set('adminRes', $userres);
		$this->set('title_for_layout', 'Manage Locality');
		$this->loadModel('MasterLocation');
		$condition=array();
		if($countyid!='')
		{
			array_push($condition, array('country_id' => $countyid));
		}
		if($srchtxt!='')
		{
			array_push($condition, array('location_name like' => '%'.$srchtxt.'%'));
		}
		$this->Paginator->settings = array( 'conditions' => array(
			'AND' => $condition,
			), 'order' => array('location_name' => 'asc'));
		$this->set('locations', $this->Paginator->paginate('MasterLocation'));
		$this->set('countyid', $countyid);
		$this->set('srchtxt', $srchtxt);
		 $this->layout="add_admin"; 
	 }
	 public function admin_deleteloc($id='')
	 {
		 $this->loadModel('MasterLocation');
		 $this->MasterLocation->id = $id;
		if (!$this->MasterLocation->exists()) {
			throw new NotFoundException(__('Invalid Location'));
		}
		$voptions = array('conditions' => array('MasterLocation.' . $this->MasterLocation->primaryKey => $id));
		$banres=$this->MasterLocation->find('first', $voptions);
		$this->request->onlyAllow('post', 'delete');
		if ($this->MasterLocation->delete()) {
			$this->Session->setFlash(__('The location has been deleted.'));
		} else {
			$this->Session->setFlash(__('The location could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'loclist'));
	 }
}
