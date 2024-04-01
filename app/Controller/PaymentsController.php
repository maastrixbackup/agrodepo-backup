<?php
App::uses('AppController', 'Controller');
/**
 * Payments Controller
 *
 * @property Payment $Payment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PaymentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	
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
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->set('title_for_layout', 'Membership Payment Report');
		$this->Payment->recursive = 0;
		$this->Paginator->settings = array('order' =>array('upgrade_id' => 'desc'),'limit' => 20);
		$this->set('payments', $this->Paginator->paginate());
		$this->layout="manage_admin";
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Payment->exists($id)) {
			throw new NotFoundException(__('Invalid payment'));
		}
		$options = array('conditions' => array('Payment.' . $this->Payment->primaryKey => $id));
		$this->set('payment', $this->Payment->find('first', $options));
		$this->layout="manage_admin";
	}
/**
 * admin_credits method
 *
 * @return void
 */
	public function admin_credits() {
		$this->set('title_for_layout', 'Manage user Credits');
		$this->loadModel('UserCreditAccount');
		$this->Payment->recursive = 0;
		$this->Paginator->settings = array(
		'joins' =>
				  array(
					array(
						'table' => 'upgrade_membership',
						'alias' => 'UpgradeMembership',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('UpgradeMembership.upgrade_id = UserCreditAccount.upgrade_id')
					)          
				 ),
		'fields' => array('UpgradeMembership.*','UserCreditAccount.*'),
		'order' =>array('credit_id' => 'desc'),
		'limit' => 20);
		$this->set('creditres', $this->Paginator->paginate('UserCreditAccount'));
		$this->layout="manage_admin";
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Payment->id = $id;
		if (!$this->Payment->exists()) {
			throw new NotFoundException(__('Invalid payment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Payment->delete()) {
			$this->Session->setFlash(__('The payment has been deleted.'));
		} else {
			$this->Session->setFlash(__('The payment could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
/**
 * Change Status method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function changeStatus()
	{
		if($this->request->is('post'))
		{
			if($this->request->data['status']=='yes')
			{
				$paymentid=$this->request->data['paymentid'];
				$statusval=$this->request->data['statusval'];
				$updatestatus=$this->Payment->save(array('upgrade_id' => $paymentid, 'plan_status' => $statusval));
				if($updatestatus)
				{
					echo 1;
				}
			}
		}
		exit;
	}
/**
 * Add Credits method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_add_credit($creditID)
	{
		$this->loadModel('UserCreditAccount');
		$this->UserCreditAccount->id = $creditID;
		if (!$this->UserCreditAccount->exists()) {
			$this->redirect(array('action' => 'credits'));
		}
		$this->set('title_for_layout', 'Add Credits');
		if($this->request->is('post'))
		{
			if(isset($this->request->data['add_credit']))
			{
				$this->request->data['AddCredit']['credit_id']=$creditID;
				$this->request->data['AddCredit']['credits_by']=1;
				$this->loadModel('AddCredit');
				if($this->AddCredit->save($this->request->data))
				{
					$usercredit=$this->UserCreditAccount->find('first', array('conditions' => array('credit_id' => $creditID)));
					$creditval=$usercredit['UserCreditAccount']['credits'];
					$totcredit=$this->request->data['AddCredit']['credits']+$creditval;
					$this->UserCreditAccount->save(array('credit_id' => $creditID, 'credits' => $totcredit));
					$this->Session->setFlash('Credit added successfully');
					$this->redirect(array('action' => 'credits'));
				}
			}
		}
		$this->layout="manage_admin";
	}
	public function admin_credits_list($creditID)
	{
		$this->loadModel('UserCreditAccount');
		$this->UserCreditAccount->id = $creditID;
		if (!$this->UserCreditAccount->exists()) {
			$this->redirect(array('action' => 'credits'));
		}
		$this->set('title_for_layout', 'All Credits List');
		$this->loadModel('AddCredit');
		$this->AddCredit->recursive = 0;
		$this->Paginator->settings = array('conditions' => array('credit_id' => $creditID), 'order' =>array('credit_id' => 'desc'),'limit' => 20);
		$this->set('creditsList', $this->Paginator->paginate('AddCredit'));
		$this->layout="manage_admin";
	}
}
