<?php
App::uses('AppController', 'Controller');
/**
 * NewsLetters Controller
 *
 * @property NewsLetter $NewsLetter
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReportsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	//var $name = 'Recipes';
	var $uses = array('SalesQuestion','AuditLogin','RequestPart');
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
 * admin_ask_question method
 *
 * @return void
 */
	public function admin_ask_question() {
		$this->loadModel('SalesQuestion');
		$this->SalesQuestion->recursive = 0;
		$this->Paginator->settings = array('order' =>array('SalesQuestion.created' => 'desc'));
		$this->set('salesQuestions', $this->Paginator->paginate('SalesQuestion'));
		$this->layout="manage_admin";
	}



/**
 * admin_ask_qstn_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_ask_qstn_delete($id = null) {
		$this->loadModel('SalesQuestion');
		$this->SalesQuestion->id = $id;
		/*if (!$salesQues->exists()) {
			throw new NotFoundException(__('Invalid  Qusetion'));
		}
		*/
		//$this->request->onlyAllow('post', 'delete');
		$count=$this->SalesQuestion->find('count',array('conditions'=>array('SalesQuestion.parent'=>$id)));
		
		if($count==0){
			
			if ($this->SalesQuestion->delete()) {
				
				$this->Session->setFlash(__('The Question  has been deleted.'));
			} else {
				$this->Session->setFlash(__('The Question could not be deleted. Please, try again.'));
			}
		}else{
			$this->Session->setFlash(__('The Question can not delete.First delete its related Qusetion.'));
		}
		return $this->redirect(array('action' => 'ask_question'));
		$this->layout="manage_admin";
	}
	/*
		change the status
	*/
	function admin_chngStatus(){
	$this->layout='ajax';
	$model=$this->request->data['model'];
	$status=$this->request->data['status'];
	$id=$this->request->data['id'];
	$this->loadModel($model);
	$this->$model->id=$id;
	if($this->$model->saveField("status",$status)){
		echo 1;
	}else{
		echo 0;
	}
	if($model=='RequestPart' && ($status==1 || $status==2 || $status==3))
	{
		$this->loadModel('RequestAccessory');
		$partsdetail=$this->RequestAccessory->find('first', array('conditions' => array('request_id' => $id)));
		if(!empty($partsdetail))
		{
			$partsid=$partsdetail['RequestAccessory']['part_id'];
			
			if($status==3)
			{
				$partsstatus=0;
			}
			else
			{
				$partsstatus=$status;
			}
			$this->RequestAccessory->save(array('part_id' => $partsid, 'status' => $partsstatus));
		}
		
	}
	exit;
   }
/**
 * admin_ask_seller method
 *
 * @return void
 */
	public function admin_ask_seller() {
		$this->set('title_for_layout', 'Ask Seller');
		$this->loadModel('BidQuestion');
		$this->BidQuestion->recursive = 0;
		$this->Paginator->settings = array('order' =>array('BidQuestion.qid' => 'desc'));
		$this->set('salesQuestions', $this->Paginator->paginate('BidQuestion'));
		$this->layout="manage_admin";
	}
/**
 * admin_ask_seller_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_ask_seller_delete($id = null) {
		$this->loadModel('BidQuestion');
		$this->BidQuestion->id = $id;
		if($this->BidQuestion->delete())
		{
			$this->Session->setFlash(__('deleted successfully'));
		}
		else
		{
			$this->Session->setFlash(__('Deleting failed'));
		}
		return $this->redirect(array('action' => 'ask_seller'));
		$this->layout="manage_admin";
	}
/**
 * ask_seller_status method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function ask_seller_status() {
		$this->loadModel('BidQuestion');
		if($this->request->is('post'))
		{
			$ask_id=$this->request->data['ask_id'];
			$status=$this->request->data['status'];		
			$this->BidQuestion->id = $ask_id;
			if($this->BidQuestion->save(array('status' => $status)))
			{
				echo 1;
			}
			else
			{
				echo 2;
			}
		}
		exit;
	}
   /**
 * admin_login_report method
 *
 * @return void
 */
	public function admin_login_report() {
		$this->loadModel('AuditLogin');
		$this->AuditLogin->recursive = 0;
		$this->Paginator->settings = array('order' =>array('AuditLogin.audit_id' => 'desc'));
		$this->set('auditLogins', $this->Paginator->paginate('AuditLogin'));
		$this->layout="manage_admin";
	}
	/**
 * admin_login_delete method
 *
 * 
 * @param string $id
 * @return void
 */
	
	public function admin_login_delete($id = null){
		$this->loadModel('AuditLogin');
		$this->AuditLogin->id = $id;
		if ($this->AuditLogin->delete()) {
				
				$this->Session->setFlash(__('The Login details  has been deleted.'));
			} else {
				$this->Session->setFlash(__('The Login details could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'admin_login_report'));
			$this->layout="manage_admin";
		}
		   /**
 * admin_login_report method
 *
 * @return void
 */
		
	public function admin_request_part(){
		$this->loadModel('RequestPart');
		$this->RequestPart->recursive = 0;
		//$this->Paginator->settings = array('order' =>array('RequestPart.request_id' => 'desc'));
		//$this->set('requestParts', $this->Paginator->paginate('RequestPart'));
		$options=array(             
					'joins' =>
							  array(
								array(
									'table' => 'request_accessories',
									'alias' => 'RequestAccessory',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('RequestAccessory.request_id = RequestPart.request_id')
								)          
							 ),
							 'fields' =>
							 array('RequestPart.*','RequestAccessory.*'),
							 'order' =>
							  array('RequestPart.request_id' => 'desc'),
							  'limit' =>10
						);
						$this->Paginator->settings =$options;
						$this->set('requestParts', $this->Paginator->paginate('RequestPart'));
		$this->layout="manage_admin";	
		}

/**
 * admin_request_parts_delete method
 *
 * @return void
 */
		
	public function admin_request_parts_delete($id = null,$flag=null){
		$this->loadModel('RequestPart');
		$this->loadModel('RequestAccessory');
		$this->loadModel('BidOffer');
		$this->loadModel('RequestQuestion');
		
		$count_rparts=$this->RequestAccessory->find('count',array('conditions'=>array('RequestAccessory.request_id'=>$id)));
		$count_bid=$this->BidOffer->find('count',array('conditions'=>array('BidOffer.request_id'=>$id)));
		$count_rquestion=$this->RequestQuestion->find('count',array('conditions'=>array('RequestQuestion.request_id'=>$id)));
		if(!isset($flag)){
		if($count_rparts==0 && $count_bid==0 && $count_rquestion==0){
			
			$this->RequestPart->id = $id;
				if ($this->RequestPart->delete()) {	
				$this->Session->setFlash(__('The Request Parts  has been deleted.'));
				} else {
					$this->Session->setFlash(__('The Request Parts could not be deleted. Please, try again.'));
				}
			}else{
				$path_yes="request_parts_delete/".$id."/1";
				$path_no="request_parts_delete/".$id."/0";
				$this->Session->setFlash(__("The Request Parts could not be deleted. First delete its related data<br/>Are You sure to delete its related data &nbsp;&nbsp; <a href=$path_yes >Yes</a>&nbsp;&nbsp;<a href=$path_no>No</a>"));
			}
		}else if($flag==1){
			
			$delete_flag=0;
			if($count_rparts>0){
				if($this->RequestAccessory->deleteAll(array('RequestAccessory.request_id'=>$id))){
					$delete_flag=1;
					}else{
					$delete_flag=0;
				}
			}
			if($count_bid>0){
				if($this->BidOffer->deleteAll(array('BidOffer.request_id'=>$id))){
					$delete_flag=1;
					}else{
					$delete_flag=0;
				}
			}
			if($count_rquestion>0){
				if($this->RequestQuestion->deleteAll(array('RequestQuestion.request_id'=>$id))){
					$delete_flag=1;
					}else{
					$delete_flag=0;
				}
			}
			if($delete_flag==1){
				$this->RequestPart->id = $id;
				if($this->RequestPart->delete()){
					$this->Session->setFlash(__('The Request Parts  and all its related data has been deleted.'));
				}
			}
				
		}else if($flag==0){
			//$this->Session->setFlash(__('The Request Parts  and all its related data Not deleted'));
		}
		return $this->redirect(array('action' => 'admin_request_part'));
		$this->layout="manage_admin";
		}
		
/**
 * admin_parts_list method
 *
 * @return void
 */
	public function admin_parts_list($id = null){
		$this->loadModel('RequestAccessory');
		$this->RequestAccessory->recursive = 0;
		$this->Paginator->settings = array('conditions' =>array('RequestAccessory.request_id'=>$id),'order' =>array('RequestAccessory.part_id' => 'desc'));
		$this->set('parts_lists', $this->Paginator->paginate('RequestAccessory'));
		$this->layout="manage_admin";	
		
		}
/**
 * admin_request_parts_delete method
 *
 * @return void
 */
		public function admin_partlist_delete($id=null,$flag=null){
			
			$this->loadModel('RequestAccessory');
			$this->loadModel('BidOffer');
			$this->loadModel('RequestQuestion');
			$request_arr=$this->RequestAccessory->find('first',array('conditions'=>array('RequestAccessory.part_id'=>$id)));
			$req_id=$request_arr['RequestAccessory']['request_id'];
		
			$count_bid=$this->BidOffer->find('count',array('conditions'=>array('BidOffer.parts_id'=>$id)));
		$count_rquestion=$this->RequestQuestion->find('count',array('conditions'=>array('RequestQuestion.parts_id'=>$id)));
		if(!isset($flag)){
		if($count_bid==0 && $count_rquestion==0){
				$this->RequestAccessory->id = $id;
				if ($this->RequestAccessory->delete()) {	
				$this->Session->setFlash(__('The Parts  has been deleted.'));
				} else {
					$this->Session->setFlash(__('The  Parts could not be deleted. Please, try again.'));
				}
			}else{
				$path_yes="../partlist_delete/".$id."/1";
				$path_no="../partlist_delete/".$id."/0";
				$this->Session->setFlash(__("The Parts could not be deleted. First delete its related data<br/>Are You sure to delete its related data &nbsp;&nbsp; <a href=$path_yes >Yes</a>&nbsp;&nbsp;<a href=$path_no>No</a>"));
			}
		}else if($flag==1){
			$delete_flag=0;
			if($count_bid>0){
				if($this->BidOffer->deleteAll(array('BidOffer.parts_id'=>$id))){
					$delete_flag=1;
					}else{
					$delete_flag=0;
				}
			}
			if($count_rquestion>0){
				if($this->RequestQuestion->deleteAll(array('RequestQuestion.parts_id'=>$id))){
					$delete_flag=1;
					}else{
					$delete_flag=0;
				}
			}
			if($delete_flag==1){
				$this->RequestAccessory->id = $id;
				if($this->RequestAccessory->delete()){
					$this->Session->setFlash(__('The  Parts  and all its related data has been deleted.'));
				}
			}
				
		}else if($flag==0){
			//$this->Session->setFlash(__('The  Parts  and all its related data Not deleted'));
		}
		return $this->redirect(array('action' => 'admin_parts_list/'.$req_id));
		$this->layout="manage_admin";
			
				
		}
/**
 * admin_bid_offer method
 *
 * @return void
 */
	public function admin_bid_offer(){
		$this->set('title_for_layout', 'Bid Offers');
		$this->loadModel('BidOffer');
		
		$options=array(
		'joins' =>
				  array(
					array(
						'table' => 'request_accessories',
						'alias' => 'RequestAccessory',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('RequestAccessory.part_id = BidOffer.parts_id')
					),
					array(
						'table' => 'request_parts',
						'alias' => 'RequestPart',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('RequestPart.request_id = BidOffer.request_id')
					),
					array(
						'table' => 'master_users',
						'alias' => 'MasterUser',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('MasterUser.user_id = BidOffer.user_id')
					)         
				 ),
		'fields' => array('BidOffer.*', 'MasterUser.first_name', 'MasterUser.last_name'),
		'order' =>array('BidOffer.bid_id' => 'desc'),
		'limit' => 20
		);
		$this->BidOffer->recursive = 0;
		$this->Paginator->settings = $options;
		$this->set('bidOfferRes', $this->Paginator->paginate('BidOffer'));
		$this->layout="manage_admin";	
		
		}
/**
 * admin_bid_offer_view method
 *
 * @return void
 */
 	public function admin_bidoffer_view($id = null){
		$this->set('title_for_layout', 'Bid Offers Details');
		$this->loadModel('BidOffer');
		$this->BidOffer->id = $id;
		if (!$this->BidOffer->exists()) {
			$this->redirect(array('action' => 'bid_offer'));
		}
		$options=array(
		'joins' =>
				  array(
					array(
						'table' => 'request_accessories',
						'alias' => 'RequestAccessory',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('RequestAccessory.part_id = BidOffer.parts_id')
					),
					array(
						'table' => 'request_parts',
						'alias' => 'RequestPart',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('RequestPart.request_id = BidOffer.request_id')
					),
					array(
						'table' => 'master_users',
						'alias' => 'MasterUser',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('MasterUser.user_id = BidOffer.user_id')
					)         
				 ),
		'conditions' => array('BidOffer.bid_id' => $id),
		'fields' => array('BidOffer.*', 'MasterUser.first_name', 'MasterUser.last_name'),
		'order' =>array('BidOffer.bid_id' => 'desc'),
		'limit' => 20
		);
		$bidOfferRes=$this->BidOffer->find('first', $options);
		$this->set('bidOfferResult', $bidOfferRes);
		$this->layout="manage_admin";
	}
/**
 * admin_bid_offer_parts_view method
 *
 * @return void
 */
 	public function admin_bid_parts_view($id = null){
		$this->set('title_for_layout', 'Bid Offers Parts Details');
		$this->loadModel('BidOffer');
		$this->BidOffer->id = $id;
		if (!$this->BidOffer->exists()) {
			$this->redirect(array('action' => 'bid_offer'));
		}
		$options=array(
		'joins' =>
				  array(
					array(
						'table' => 'request_accessories',
						'alias' => 'RequestAccessory',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('RequestAccessory.part_id = BidOffer.parts_id')
					),
					array(
						'table' => 'request_parts',
						'alias' => 'RequestPart',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('RequestPart.request_id = BidOffer.request_id')
					),
					array(
						'table' => 'master_users',
						'alias' => 'MasterUser',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('MasterUser.user_id = BidOffer.user_id')
					)         
				 ),
		'conditions' => array('BidOffer.bid_id' => $id),
		'fields' => array('RequestAccessory.*', 'RequestPart.*'),
		'order' =>array('BidOffer.bid_id' => 'desc'),
		'limit' => 20
		);
		$bidOfferRes=$this->BidOffer->find('first', $options);
		$this->set('bidOfferResult', $bidOfferRes);
		$this->layout="manage_admin";
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_bid_delete($id = null) {
		$this->loadModel('BidOffer');
		$this->BidOffer->id = $id;
		if (!$this->BidOffer->exists()) {
			$this->redirect(array('action' => 'bid_offer'));
		}
		$biddetail=$this->BidOffer->find('first', array('conditions' => array('bid_id' => $id)));
		 $this->loadModel('BidImg');
				 $imgres=$this->BidImg->find('all', array('conditions' => array('bid_id'=>$id)));
		$this->request->onlyAllow('post', 'delete');
		if ($this->BidOffer->delete()) {
			$this->loadModel('RequestAccessory');
			$accessorydetail=$this->RequestAccessory->find('first', array('conditions' => array('part_id' => $biddetail['BidOffer']['parts_id'])));
			if(!empty($accessorydetail))
			{
				$offerno=$accessorydetail['RequestAccessory']['offerno'];
				$offerno-=$offerno;
				$this->RequestAccessory->save(array('part_id' => $accessorydetail['RequestAccessory']['part_id'], 'offerno' => $offerno));
			}
			if(!empty($imgres))
			{
				 foreach($imgres as $imgdetail)
				 {
				 @unlink(WWW_ROOT.'files/bidimg/'.$imgdetail['BidImg']['img_path']);
				 $this->BidImg->delete($imgdetail['BidImg']['img_id']);
				 }
			}
			$this->Session->setFlash(__('The bid offer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bid offer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'bid_offer'));
	}
/**
 * Bid offer Status status method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_bid_status() {
		$this->loadModel('BidOffer');
		if($this->request->is('post'))
		{
			$bidid=$this->request->data['bidid'];
			$statusval=$this->request->data['statusval'];
			
			$options=array('bid_id' => $bidid, 'status' => $statusval);
			if($this->BidOffer->save($options))
			{
				$biddetail=$this->BidOffer->find('first', array('conditions' => array('bid_id' => $bidid)));
					$this->loadModel('RequestAccessory');
					$accessorydetail=$this->RequestAccessory->find('first', array('conditions' => array('part_id' => $biddetail['BidOffer']['parts_id'])));
				if($statusval==1)
				{
					
					if(!empty($accessorydetail))
					{
						$this->RequestAccessory->save(array('part_id' => $accessorydetail['RequestAccessory']['part_id'], 'status' => 2));
					}
				}
				else
				{
					if(!empty($accessorydetail))
					{
						$this->RequestAccessory->save(array('part_id' => $accessorydetail['RequestAccessory']['part_id'], 'status' => 1));
					}
				}
				echo 1;
			}
			else
			{
				echo 2;
			}
		}
		exit;
	}
/**
 * admin_sales_order method
 *
 * @return void
 */
	public function admin_sales_order(){
		$this->set('title_for_layout', 'Sales Order');
		$this->loadModel('SalesOrder');
		$options=array(
		'joins' =>
				  array(
					array(
						'table' => 'sales_advertisements',
						'alias' => 'PostAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PostAd.adv_id = SalesOrder.adv_id')
					),
					array(
						'table' => 'master_users',
						'alias' => 'MasterUser',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('MasterUser.user_id = SalesOrder.user_id')
					)         
				 ),
		'fields' => array('SalesOrder.*', 'PostAd.adv_name, PostAd.user_id', 'MasterUser.first_name', 'MasterUser.last_name'),
		'order' =>array('SalesOrder.id' => 'desc'),
		'limit' => 20
		);
		$this->SalesOrder->recursive = 0;
		$this->Paginator->settings = $options;
		$this->set('salesOrderRes', $this->Paginator->paginate('SalesOrder'));
		$this->layout="manage_admin";	
		
		}
/**
 * admin_sales_order method
 *
 * @return void
 */
	public function admin_salesorder_view($id=null){
		$this->set('title_for_layout', 'Sales Order Detail');
		$this->loadModel('SalesOrder');
		$this->SalesOrder->id = $id;
		if (!$this->SalesOrder->exists()) {
			$this->redirect(array('action' => 'sales_order'));
		}
		$options=array(
		'joins' =>
				  array(
					array(
						'table' => 'sales_advertisements',
						'alias' => 'PostAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PostAd.adv_id = SalesOrder.adv_id')
					),
					array(
						'table' => 'master_users',
						'alias' => 'MasterUser',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('MasterUser.user_id = SalesOrder.user_id')
					)         
				 ),
		'conditions' => array('SalesOrder.id' => $id),
		'fields' => array('SalesOrder.*', 'PostAd.adv_name', 'MasterUser.first_name', 'MasterUser.last_name'),
		'order' =>array('SalesOrder.id' => 'desc'),
		'limit' => 20
		);
		$salesOrderResult=$this->SalesOrder->find('first', $options);
		$this->set('salesOrderResult', $salesOrderResult);
		$this->layout="manage_admin";	
		
	}
/**
 * order delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_order_delete($id = null) {
		$this->loadModel('SalesOrder');
		$this->SalesOrder->id = $id;
		if (!$this->SalesOrder->exists()) {
			$this->redirect(array('action' => 'sales_order'));
		}
		
		$this->request->onlyAllow('post', 'delete');
		if ($this->SalesOrder->delete()) {
			$this->Session->setFlash(__('The sales order has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sales order could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'sales_order'));
	}
/**
 * order delivery status method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delivery_status() {
		$this->loadModel('SalesOrder');
		if($this->request->is('post'))
		{
			$orderid=$this->request->data['orderid'];
			$statusval=$this->request->data['statusval'];
			$options=array('id' => $orderid, 'delivery_status' => $statusval);
			if($this->SalesOrder->save($options))
			{
				echo 1;
			}
			else
			{
				echo 2;
			}
		}
		exit;
	}
/**
 * order status method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_status() {
		$this->loadModel('SalesOrder');
		if($this->request->is('post'))
		{
			$orderid=$this->request->data['orderid'];
			$statusval=$this->request->data['statusval'];
			$options=array('id' => $orderid, 'status' => $statusval);
			if($this->SalesOrder->save($options))
			{
				echo 1;
			}
			else
			{
				echo 2;
			}
		}
		exit;
	}
/**
*Function for view request parts
* Method Name: view_part
* Author By: Chittaranjan Sahoo
**/
	public function admin_view_part($requestid='')
	{
		$this->set('title_for_layout', 'Request Parts Detail');
		$this->loadModel('RequestPart');
		$this->RequestPart->id = $requestid;
		if (!$this->RequestPart->exists()) {
			$this->redirect(array('action' => 'request_part'));
		}
		$options=array(             
					'joins' =>
							  array(
								array(
									'table' => 'request_accessories',
									'alias' => 'RequestAccessory',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('RequestAccessory.request_id = RequestPart.request_id')
								)          
							 ),
					 'conditions' => array(
					 'AND'=> array(
					 array('RequestPart.request_id' => $requestid),
					 ),
					 ),
					 'fields' =>
					 array('RequestPart.*','RequestAccessory.*'),
					 'order' =>
					  array('RequestPart.request_id' => 'desc'),
					  'limit' =>1
						);
		$requestDetail=$this->RequestPart->find('first', $options);
		$this->set('requestPart', $requestDetail);
		$this->layout="manage_admin";	
	}
	public function admin_requestorder()
	{
		$this->set('title_for_layout', 'All Parts Order');
		$this->loadModel('PartsOrder');
		$this->PartsOrder->recursive = 0;
		$this->Paginator->settings = array('order' => array('id' => 'desc'));
		$this->set('partsOrders', $this->Paginator->paginate('PartsOrder'));
		$this->layout="manage_admin";
	}
	public function admin_delete_parts_order($id='')
	{
		$this->loadModel('PartsOrder');
		if(!$this->PartsOrder->exists($id))
		{
			$this->redirect(array('action' => 'requestorder'));
		}
		if($this->PartsOrder->delete($id))
		{
			$this->Session->setFlash('Order deleted succesfully');
			$this->redirect(array('action' => 'requestorder'));
		}
	}
	public function admin_parkquestion()
	{
		 $this->set('title_for_layout', 'Park Questions');
		 $this->loadModel('ParkQuestion');
		 $options=array(
		 'joins' =>
				  array(
					array(
						'table' => 'sales_parks',
						'alias' => 'SalesPark',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('SalesPark.park_id = ParkQuestion.park_id')
					)          
				 ),
		  'order' => array('ParkQuestion.qid' => 'desc')
		 );
		 //$questionRes=$this->ParkQuestion->find('all', $options);
		 $this->ParkQuestion->recursive = 0;
		$this->Paginator->settings = $options;
		$this->set('questionRes', $this->Paginator->paginate('ParkQuestion'));
		 //$this->set('questionRes', $questionRes);
		 $this->layout="manage_admin";
	}
	public function admin_parkqs_delete($id)
	{
		$this->loadModel('ParkQuestion');
		$this->ParkQuestion->id = $id;
		if (!$this->ParkQuestion->exists()) {
			$this->redirect(array('action' => 'parkquestion'));
		}
		
		$this->request->onlyAllow('post', 'delete');
		if ($this->ParkQuestion->delete()) {
			$this->Session->setFlash(__('The question has been deleted.'));
		} else {
			$this->Session->setFlash(__('The question could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'parkquestion'));
	}
	public function admin_viewquestionimage(){
		$this->layout="manage_admin";
	}
}
