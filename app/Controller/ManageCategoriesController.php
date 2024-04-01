<?php
App::uses('AppController', 'Controller');
/**
 * ManageCategories Controller
 *
 * @property ManageCategory $ManageCategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ManageCategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Dez');
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
			
		$this->loadModel("ManageCategory");
		$this->loadModel("SalesCategory");
		$parent=array('' => '-No Parent-');
		$parent+= $this->SalesCategory->find('list',array('conditions'=>array("SalesCategory.flag" => 0), 'fields' => array('SalesCategory.category_id','SalesCategory.category_name')));
		
		$this->set("parent",$parent);
		$flag=@$this->request->params['named']['flag']!=''?@$this->request->params['named']['flag']:'';
		$searchtxt=@$this->request->params['named']['searchtxt'];
		if($searchtxt!='' || $flag!=''){
			if($flag==''){
				$this->Paginator->settings = array('conditions' => array( 'OR' => array(
				array('ManageCategory.category_name LIKE ' => '%'.$searchtxt.'%')
			)), 'order' =>array('ManageCategory.category_id' => 'desc'), 'limit' => 2);
			
			}else{
				$this->Paginator->settings = array('conditions' => array( 'OR' => array(
				array('ManageCategory.category_name LIKE ' => '%'.$searchtxt.'%')
			),'AND'=>array('ManageCategory.flag '=>$flag)), 'order' =>array('ManageCategory.category_id' => 'desc'), 'limit' => 20);
			//print_r( $this->Paginator->paginate());
			}
			
		$this->set('manageCategories', $this->Paginator->paginate());
				
		$this->set('searchtxt', $searchtxt);
		$this->set('par_ct', @$flag);
		}else{
			$this->Paginator->settings=array('order'=>array('ManageCategory.category_id'=>'desc'),'limit'=>20);
		$this->ManageCategory->recursive = 0;
		$this->set('manageCategories', $this->Paginator->paginate());
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
		if (!$this->ManageCategory->exists($id)) {
			throw new NotFoundException(__('Invalid manage category'));
		}
		$options = array('conditions' => array('ManageCategory.' . $this->ManageCategory->primaryKey => $id));
		$this->set('manageCategory', $this->ManageCategory->find('first', $options));
		$this->layout="view_admin";
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		$this->loadModel("SalesCategory");
		
		$parent = $this->SalesCategory->find('list',array('conditions'=>array("SalesCategory.flag" => 0), 'fields' => array('SalesCategory.category_id','SalesCategory.category_name')));
		$parent[0]="Parent";
		$this->set("parent",$parent);
		if ($this->request->is('post')) {
			$this->request->data['ManageCategory']['slug']=$this->Dez->SlugBYName('ManageCategory',$this->request->data['ManageCategory']['category_name']);
			//print_r($this->request->data);exit;
			$this->ManageCategory->create();
			if ($this->ManageCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The manage category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The manage category could not be saved. Please, try again.'));
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
		if (!$this->ManageCategory->exists($id)) {
			throw new NotFoundException(__('Invalid manage category'));
		}
		$this->loadModel("SalesCategory");
		$parent = $this->SalesCategory->find('list',array('conditions'=>array("SalesCategory.flag" => 0,"SalesCategory.category_id !="=>$id), 'fields' => array('SalesCategory.category_id','SalesCategory.category_name')));
		$parent[0]="Parent";
		$this->set("parent",$parent);
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['ManageCategory']['slug']=$this->Dez->SlugBYName('ManageCategory',$this->request->data['ManageCategory']['category_name'],$id,'category_id');
			//print_r($this->request->data);exit;
			if ($this->ManageCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The manage category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The manage category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ManageCategory.' . $this->ManageCategory->primaryKey => $id));
			$this->request->data = $this->ManageCategory->find('first', $options);
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
		$this->ManageCategory->id = $id;
		if (!$this->ManageCategory->exists()) {
			throw new NotFoundException(__('Invalid manage category'));
		}
		$this->request->onlyAllow('post', 'delete');
		
	$this->loadModel('PostAd');
	$postoptions=array('conditions' => array(
	"AND" => array(
		array('OR' => array(array('PostAd.category_id' =>$id),array('PostAd.sub_cat_id' =>$id)), ),
		)
	));
	
	$postadcount=$this->PostAd->find('count', $postoptions);
	//echo $postadcount;exit;
	if($postadcount<=0)
		{
		if ($this->ManageCategory->delete()) {
			$this->Session->setFlash(__('The manage category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The manage category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
		else
		{
			$this->Session->setFlash(__('First delete its related ads to delete this Category. '));
			return $this->redirect(array('action' => 'index'));
		}
		$this->layout="manage_admin";
	}
	function changeStatus(){//print_r($this->request->data);exit;
	$this->layout='ajax';
	$this->LoadModel("ManageCategory");
	$status=$this->request->data['status'];
	$category_id=$this->request->data['category_id'];
	$this->ManageCategory->id=$category_id;
	if($this->ManageCategory->saveField("status",$status)){
		echo 1;exit;
	}else{
		echo 0;exit;
	}
   }
}