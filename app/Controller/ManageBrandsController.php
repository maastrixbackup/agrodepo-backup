<?php
App::uses('AppController', 'Controller');
App::uses('resize', 'Vendor');
/**
 * ManageBrands Controller
 *
 * @property ManageBrand $ManageBrand
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ManageBrandsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Dez');
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
		$this->loadModel("ManageBrand");
		$parent = $this->ManageBrand->find('list',array('conditions'=>array("ManageBrand.flag" => 0), 'fields' => array('ManageBrand.brand_id','ManageBrand.brand_name')));
		$parent[0]="Parent";
		$this->set("parent",$parent);
		$flag=@$this->request->params['named']['flag']!=''?@$this->request->params['named']['flag']:'';
		$searchtxt=@$this->request->params['named']['searchtxt'];
		if($searchtxt!='' || $flag!=''){
			if($flag==''){
				$query = array('conditions' => array( 'OR' => array(
				array('ManageBrand.brand_name LIKE ' => '%'.$searchtxt.'%')
			)), 'order' =>array('ManageBrand.ordering' => 'asc'));

			}else{
				$query = array('conditions' => array( 'OR' => array(
				array('ManageBrand.brand_name LIKE ' => '%'.$searchtxt.'%')
			),'AND'=>array('ManageBrand.flag '=>$flag)), 'order' =>array('ManageBrand.ordering' => 'asc'));
			//print_r( $this->Paginator->paginate());
			}
		$this->set('manageBrands', $this->ManageBrand->find('all',$query));
		$this->set('searchtxt', $searchtxt);
		$this->set('par_brnd', @$flag);
		}else{

		$this->ManageBrand->recursive = 0;
		$query=array('order'=>array('ManageBrand.ordering'=>'asc'));
		$this->set('manageBrands', $this->ManageBrand->find('all',$query));

		}
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
		if (!$this->ManageBrand->exists($id)) {
			throw new NotFoundException(__('Invalid manage brand'));
		}
		$options = array('conditions' => array('ManageBrand.' . $this->ManageBrand->primaryKey => $id));
		$this->set('manageBrand', $this->ManageBrand->find('first', $options));
		$this->layout="view_admin";
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		$this->loadModel('ManageBrand');
		$brand=$this->ManageBrand->Find('list',array('conditions'=>array('ManageBrand.flag'=>0),'fields'=>array('ManageBrand.brand_id','ManageBrand.brand_name')));
		$brand[0]="Parent";
		$this->set('brand',$brand);
		if ($this->request->is('post')) {
			$brandname=$this->request->data['ManageBrand']['brand_name'];
			$parentid=$this->request->data['ManageBrand']['flag'];
			$this->request->data['ManageBrand']['slug']=$this->Dez->SlugBYName('ManageBrand',$this->request->data['ManageBrand']['brand_name']);
			//print_r($this->request->data);exit;
			$brandchk=$this->ManageBrand->find('all', array('conditions' => array('brand_name like' => '%'.$brandname.'%', 'flag' => $parentid)));
			if(count($brandchk)>0)
			{
				$this->Session->setFlash(__('Brand name must be unique'));
			}
			else
			{
				if($this->request->data['ManageBrand']['image']['name']!='')
				{
					$brandimg=time().$this->request->data['ManageBrand']['image']['name'];
					move_uploaded_file($this->request->data['ManageBrand']['image']['tmp_name'],WWW_ROOT.'files/brand/'.$brandimg);
					$resizeObj = new resize(WWW_ROOT.'files/brand/'.$brandimg);
					$resizeObj -> resizeImage('', 55, 'portrait');
		        	$resizeObj -> saveImage(WWW_ROOT.'files/brand/100X100_'.$brandimg, 90);

					$this->request->data['ManageBrand']['image']=$brandimg;
				}else{
					$this->request->data['ManageBrand']['image']='';
				}
				$this->ManageBrand->create();
				if ($this->ManageBrand->save($this->request->data)) {
					$this->Session->setFlash(__('The manage brand has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The manage brand could not be saved. Please, try again.'));
				}
			}
		}
		$this->layout="add_admin";
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->loadModel('ManageBrand');
		$brand=$this->ManageBrand->Find('list',array('conditions'=>array('ManageBrand.flag'=>0,'ManageBrand.brand_id !='=>@$id),'fields'=>array('ManageBrand.brand_id','ManageBrand.brand_name')));
		$brand[0]="Parent";
		$this->set('brand',$brand);
		if (!$this->ManageBrand->exists($id)) {
			throw new NotFoundException(__('Invalid manage brand'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['ManageBrand']['slug']=$this->Dez->SlugBYName('ManageBrand',$this->request->data['ManageBrand']['brand_name'],$id,'brand_id');
			$voptions = array('conditions' => array('ManageBrand.' . $this->ManageBrand->primaryKey => $id));
			$brands=$this->ManageBrand->find('first', $voptions);

			//print_r($this->request->data);exit;
			if($this->request->data['ManageBrand']['image']['name']!='')
			{
				$brandimg=time().$this->request->data['ManageBrand']['image']['name'];
				move_uploaded_file($this->request->data['ManageBrand']['image']['tmp_name'],WWW_ROOT.'files/brand/'.$brandimg);
				$resizeObj = new resize(WWW_ROOT.'files/brand/'.$brandimg);
				$resizeObj -> resizeImage('', 55, 'portrait');
	        	$resizeObj -> saveImage(WWW_ROOT.'files/brand/100X100_'.$brandimg, 90);
	        	$this->request->data['ManageBrand']['image']=$brandimg;
	        	@unlink(WWW_ROOT.'files/brand/'.$brands['ManageBrand']['image']);
	        	@unlink(WWW_ROOT.'files/brand/100X100_'.$brands['ManageBrand']['image']);
			}
			else
			{
				$this->request->data['ManageBrand']['image']=$brands['ManageBrand']['image'];
			}

			if ($this->ManageBrand->save($this->request->data)) {
				$this->Session->setFlash(__('The manage brand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The manage brand could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ManageBrand.' . $this->ManageBrand->primaryKey => $id));
			$this->request->data = $this->ManageBrand->find('first', $options);
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

		$this->loadModel('PostAd');
		$this->ManageBrand->id = $id;
		if (!$this->ManageBrand->exists()) {
			throw new NotFoundException(__('Invalid manage brand'));
		}
		$voptions = array('conditions' => array('ManageBrand.' . $this->ManageBrand->primaryKey => $id));
		$brands=$this->ManageBrand->find('first', $voptions);
		$this->request->onlyAllow('post', 'delete');
		$this->loadModel('RequestPart');
	$count=$this->RequestPart->find('count',array('conditions'=>array('OR'=>array('FIND_IN_SET(\''. $id .'\',RequestPart.brand_id)','FIND_IN_SET(\''. $id .'\',RequestPart.model_id)'))));
	$this->loadModel('PostAd');
	$postoptions=array('conditions' => array(
	"AND" => array(
		array('OR' => array(array('FIND_IN_SET(\''. $id .'\',PostAd.adv_brand_id)'),array('FIND_IN_SET(\''. $id .'\',PostAd.adv_model_id)')),),
		)
	));
	$postadcount=$this->PostAd->find('count', $postoptions);
		if($count<=0 && $postadcount<=0)
		{
			if($this->ManageBrand->delete())
			{
				@unlink(WWW_ROOT.'files/brand/'.$brands['ManageBrand']['image']);
	        	@unlink(WWW_ROOT.'files/brand/100X100_'.$brands['ManageBrand']['image']);
				$this->Session->setFlash(__('The manage brand has been deleted.'));
			}
			else
			{
				$this->Session->setFlash(__('The manage brand could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'index'));
		}
		else
		{
			$this->Session->setFlash(__('First delete its related offers and ads to delete this brand. '));
			return $this->redirect(array('action' => 'index'));
		}
		$this->layout="manage_admin";
	}
	/*
		change the status
	*/
	function changeStatus(){//print_r($this->request->data);exit;
	$this->layout='ajax';
	$this->LoadModel("ManageBrand");
	$status=$this->request->data['status'];
	$brand_id=$this->request->data['brand_id'];
	$this->ManageBrand->id=$brand_id;
	if($this->ManageBrand->saveField("status",$status)){
		echo 1;exit;
	}else{
		echo 0;exit;
	}
   }
   /*
   * Function purpose: To ordering Brand
   * Author: Chittaranjan Sahoo
   * Date: 08-03-2016
   */
   function brandorder(){
   	if($this->request->is('post')){
   		if(isset($this->request->data['brand_order'])){
   			 $ordersarray=explode("[]=order_",$this->request->data['orders']);
				 $count=0;
				 foreach($ordersarray as $singorder)
				 {
					 if($count>0)
					 {
						$order=str_replace(",","",$singorder);
						$update_order=$this->ManageBrand->save(array('brand_id' =>$order, 'ordering' => $count));
						 }
					 $count++;
				 }
				 if($update_order)
				 {
					 echo 1;
				 }
   		}
   	}
   	exit();
   }
}
