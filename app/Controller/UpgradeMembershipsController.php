<?php

App::uses('AppController', 'Controller');

/**

 * UpgradeMemberships Controller

 *

 * @property UpgradeMembership $UpgradeMembership

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class UpgradeMembershipsController extends AppController {



/**

 * Components

 *

 * @var array

 */

	public $components = array('Paginator', 'Session');

	public function beforeFilter(){

	

			if(!$this->Session->check('User'))

			{

				return $this->redirect(Router::url('/', true));

			}

			

			

		}

/**

 * index method

 *

 * @return void

 */

	public function index() {

		if(isset($this->request->params['named']['billtype']))

		{

			$this->Session->write('billtype',$this->request->params['named']['billtype']);

		}

		$this->set('title_for_layout','Upgrade membership');

		$user_session=$this->Session->read('User');

		$userid=$user_session['user_id'];

		$userstatus=$user_session['is_active'];

		$this->loadModel('UserMembership');

		$UserMembership=$this->UserMembership->find('all', array('conditions' => array('status' => 1), 'order' => array('price' => 'desc')));

		$this->set('userMembership',$UserMembership);

		$this->layout='upgrade_membership1';

	}

/**

 * memType method

 *

 * @return void

 */

	public function memType()

	{

		if($this->request->is('post'))

		{

			if($this->request->data['memid']!='')

			{

				$this->Session->write('membertype_id',$this->request->data['memid']);

				echo 1;

			}

		}

		exit;

	}

	public function cardsubmit()

	{

		if($this->request->is('post'))

		{

			if($this->request->data['submitval']=='yes')

			{
				if($this->request->data['submittype']=='card')
				{
				$this->Session->write('card',1);
				}
				else if($this->request->data['submittype']=='banktransfer')
				{
				$this->Session->write('card',2);
				}
				else if($this->request->data['submittype']=='sms')
				{
				$this->Session->write('card',3);
				}

				echo 1;

			}

		}

		exit;

	}

/**

 * card method

 *

 * @return void

 */

	public function card() {

		if(!$this->Session->check('membertype_id'))

		{

			return $this->redirect(array('action' => 'index'));

		}

		$this->set('title_for_layout','Membership Card');

		$user_session=$this->Session->read('User');

		$userid=$user_session['user_id'];

		$userstatus=$user_session['is_active'];

		$this->loadModel('UserMembership');

		$UserMembership=$this->UserMembership->find('all', array('conditions' => array('status' => 1), 'order' => array('price' => 'desc')));

		$this->set('userMembership',$UserMembership);

		$this->layout='upgrade_membership2';

	}

/**

 * Confirm order method

 *

 * @return void

 */

	public function confirm_plan() {

		if(!$this->Session->check('membertype_id'))

		{

			return $this->redirect(array('action' => 'index'));

		}

		if(!$this->Session->check('card'))

		{

			return $this->redirect(array('action' => 'card'));

		}
		
		$this->set('title_for_layout','Confirm Plan');

		$user_session=$this->Session->read('User');

		$userid=$user_session['user_id'];

		$userstatus=$user_session['is_active'];

		$this->loadModel('UserMembership');

		$UserMembership=$this->UserMembership->find('first', array('conditions' => array('status' => 1, 'memb_id' => $this->Session->read('membertype_id')), 'order' => array('price' => 'desc')));

		$this->set('UserMembership',$UserMembership);

		$this->loadModel('TempMembershipDetail');

		//pr($this->request->data);exit;

		if($this->request->is(array('post', 'put')))

		{

			//pr($this->request->data);exit;

			if(isset($this->request->data['confirm_order']))

			{

				

				if(!$this->Session->check('randomid'))

				{

				$randomid=rand();

				$this->Session->write('randomid',$randomid);

				}

				else

				{

					$randomid=$this->Session->read('randomid');

					$tempdetails=$this->TempMembershipDetail->find('first', array('conditions' => array('randomid' => $randomid)));

					if(!empty($tempdetails))

					{

						$this->request->data['TempMembershipDetail']['temp_mem_id']=$tempdetails['TempMembershipDetail']['temp_mem_id'];

					}

				}

				$this->request->data['TempMembershipDetail']['randomid']=$randomid;
				$cardval=$this->Session->read('card');
		if($cardval==1){ $this->request->data['TempMembershipDetail']['pmt_from']='Credit Card';}else if($cardval==2){$this->request->data['TempMembershipDetail']['pmt_from']='Bank Transfer';}else if($cardval==1){$this->request->data['TempMembershipDetail']['pmt_from']='SMS Transfer';}

				//pr($this->request->data);exit;

				if($this->TempMembershipDetail->save($this->request->data))

				{

					//$this->Session->setFlash(__('Billing details Saved successfully'));
					if($this->Session->check('card') && $this->Session->read('card')==1)
					{

					return $this->redirect(array('action' => 'paymentredirect'));
					}
					else if($this->Session->check('card') && $this->Session->read('card')==2)
					{
						return $this->redirect(array('action' => 'bankredirect'));
					}
					else if($this->Session->check('card') && $this->Session->read('card')==3)
					{
						return $this->redirect(array('action' => 'smsredirect'));
					}

					

				}

				else

				{

					$this->Session->setFlash(__('Billing details Saving failed'));

				}

			}

		}

		else

		{

			if($this->Session->check('randomid'))

				{

					$randomid=$this->Session->read('randomid');

					$tempdetails=$this->TempMembershipDetail->find('first', array('conditions' => array('randomid' => $randomid)));

					if(!empty($tempdetails))

					{

						$this->request->data=$tempdetails;

						//$this->request->data['TempMembershipDetail']['temp_mem_id']=$tempdetails['TempMembershipDetail']['temp_mem_id'];

						

					}

				}

				

		}

		$this->layout='upgrade_membership3';

	}



/**
 * Paymentredirect order method
 *
 * @return void
 */
 	public function paymentredirect()
	{

		if(!$this->Session->check('membertype_id'))

		{

			return $this->redirect(array('action' => 'index'));

		}

		if(!$this->Session->check('card'))

		{

			return $this->redirect(array('action' => 'card'));

		}

		if(!$this->Session->check('randomid'))

		{

			return $this->redirect(array('action' => 'confirm_plan'));

		}

		$this->loadModel('UserMembership');

		$UserMembership=$this->UserMembership->find('first', array('conditions' => array('status' => 1, 'memb_id' => $this->Session->read('membertype_id')), 'order' => array('price' => 'desc')));

		$this->set('UserMembership',$UserMembership);

		$randomid=$this->Session->read('randomid');

		$this->loadModel('TempMembershipDetail');

		$tempdetails=$this->TempMembershipDetail->find('first', array('conditions' => array('randomid' => $randomid)));

		$this->set('tempDetails',$tempdetails);

		$this->set('title_for_layout','Redirect To Payemt page');

		$this->layout='paymentredirect';

	}
	/**
 * Banktransferredirect order method
 *
 * @return void
 */
 	public function bankredirect()
	{
		if(!$this->Session->check('membertype_id'))
		{

			return $this->redirect(array('action' => 'index'));

		}
		if(!$this->Session->check('card'))
		{

			return $this->redirect(array('action' => 'card'));
		}
		if(!$this->Session->check('randomid'))
		{

			return $this->redirect(array('action' => 'confirm_plan'));

		}

		$this->loadModel('UserMembership');

		$UserMembership=$this->UserMembership->find('first', array('conditions' => array('status' => 1, 'memb_id' => $this->Session->read('membertype_id')), 'order' => array('price' => 'desc')));

		$this->set('UserMembership',$UserMembership);

		$randomid=$this->Session->read('randomid');

		$this->loadModel('TempMembershipDetail');

		$tempdetails=$this->TempMembershipDetail->find('first', array('conditions' => array('randomid' => $randomid)));

		$this->set('tempDetails',$tempdetails);

		$this->set('title_for_layout','Redirect To Bank Transfer page');

		$this->layout='bankredirect';

	}
/**
* Banktransferredirect order method
 *
 * @return void
 */
 	public function smsredirect()
	{
		if(!$this->Session->check('membertype_id'))
		{

			return $this->redirect(array('action' => 'index'));
		}
		if(!$this->Session->check('card'))
		{

			return $this->redirect(array('action' => 'card'));
		}
		if(!$this->Session->check('randomid'))
		{

			return $this->redirect(array('action' => 'confirm_plan'));

		}

		$this->loadModel('UserMembership');

		$UserMembership=$this->UserMembership->find('first', array('conditions' => array('status' => 1, 'memb_id' => $this->Session->read('membertype_id')), 'order' => array('price' => 'desc')));

		$this->set('UserMembership',$UserMembership);

		$randomid=$this->Session->read('randomid');

		$this->loadModel('TempMembershipDetail');

		$tempdetails=$this->TempMembershipDetail->find('first', array('conditions' => array('randomid' => $randomid)));

		$this->set('tempDetails',$tempdetails);

		$this->set('title_for_layout','Redirect To Sms page');

		$this->layout='smsredirect';

	}
	
/**

 * Paymentredirect order method

 *

 * @return void

 */

 	public function success()

	{

		if(!$this->Session->check('membertype_id'))

		{

			return $this->redirect(array('action' => 'index'));

		}

		else if(!$this->Session->check('card'))

		{

			return $this->redirect(array('action' => 'card'));

		}

		else if(!$this->Session->check('randomid'))

		{

			return $this->redirect(array('action' => 'confirm_plan'));

		}

		else

		{

		//echo base64_decode($_REQUEST['orderId']);

		if(isset($_REQUEST['orderId']) && ($_REQUEST['orderId'] == md5($this->Session->read('randomid'))))

		{

			$this->loadModel('TempMembershipDetail');

			$randomid=$this->Session->read('randomid');

			$this->loadModel('UserMembership');

		$UserMembership=$this->UserMembership->find('first', array('conditions' => array('status' => 1, 'memb_id' => $this->Session->read('membertype_id')), 'order' => array('price' => 'desc')));

		$randomid=$this->Session->read('randomid');

		$this->loadModel('TempMembershipDetail');

		$tempdetails=$this->TempMembershipDetail->find('first', array('conditions' => array('randomid' => $randomid)));

		$user_session=$this->Session->read('User');

		$this->request->data['UpgradeMembership']['user_id']=$user_session['user_id'];

		$this->request->data['UpgradeMembership']['member_type']=$UserMembership['UserMembership']['memb_id'];

		$this->request->data['UpgradeMembership']['payment_method']='card';

		$this->request->data['UpgradeMembership']['name']=$tempdetails['TempMembershipDetail']['fname'];

		$this->request->data['UpgradeMembership']['email']=$tempdetails['TempMembershipDetail']['email'];

		$this->request->data['UpgradeMembership']['phone']=$tempdetails['TempMembershipDetail']['phone'];

		$this->request->data['UpgradeMembership']['county']=$tempdetails['TempMembershipDetail']['state'];

		$this->request->data['UpgradeMembership']['city']=$tempdetails['TempMembershipDetail']['city'];

		$this->request->data['UpgradeMembership']['address']=$tempdetails['TempMembershipDetail']['address'];

		$this->request->data['UpgradeMembership']['zip']=$tempdetails['TempMembershipDetail']['zip'];

		$this->request->data['UpgradeMembership']['shipping_different']=$tempdetails['TempMembershipDetail']['copydetails'];

		$this->request->data['UpgradeMembership']['shipping_name']=$tempdetails['TempMembershipDetail']['shipping_fname'];

		$this->request->data['UpgradeMembership']['shipping_email']=$tempdetails['TempMembershipDetail']['shipping_email'];

		$this->request->data['UpgradeMembership']['shipping_phone']=$tempdetails['TempMembershipDetail']['shipping_phone'];

		$this->request->data['UpgradeMembership']['shipping_address']=$tempdetails['TempMembershipDetail']['shipping_address'];

		$this->request->data['UpgradeMembership']['shipping_city']=$tempdetails['TempMembershipDetail']['shipping_city'];

		$this->request->data['UpgradeMembership']['shipping_county']=$tempdetails['TempMembershipDetail']['shipping_state'];

		$this->request->data['UpgradeMembership']['shipping_zip']=$tempdetails['TempMembershipDetail']['shipping_zip'];

		$this->request->data['UpgradeMembership']['payment_status']=1;

		$this->request->data['UpgradeMembership']['transfer_id']=$tempdetails['TempMembershipDetail']['randomid'];

		$this->request->data['UpgradeMembership']['plan_status']=1;

		$this->request->data['UpgradeMembership']['price']=$UserMembership['UserMembership']['price'];

		$this->request->data['UpgradeMembership']['credit']=$UserMembership['UserMembership']['credits'];
		$this->request->data['UpgradeMembership']['payment_method']=$tempdetails['TempMembershipDetail']['pmt_from'];
		

		$this->loadModel('UpgradeMembership');

			if($this->UpgradeMembership->save($this->request->data))

			{

				$insertid=$this->UpgradeMembership->getLastInsertId();

				$this->loadModel('UserCreditAccount');

				$creditchk=$this->UserCreditAccount->find('first', array('conditions' => array('user_id' => $user_session['user_id'])));

				if(count($creditchk)>0)

				{

					$credit_id=$creditchk['UserCreditAccount']['credit_id'];

					$updatecredit=$creditchk['UserCreditAccount']['credits']+$UserMembership['UserMembership']['credits'];

					$options=array('credit_id' => $credit_id, 'upgrade_id' => $insertid, 'user_id' => $user_session['user_id'], 'credits' => $updatecredit);

					$this->UserCreditAccount->save($options);

					$updcreditid=$credit_id;

				}

				else

				{

					$updatecredit=$UserMembership['UserMembership']['credits'];

					$options=array('upgrade_id' => $insertid, 'user_id' => $user_session['user_id'], 'credits' => $updatecredit);

					$this->UserCreditAccount->save($options);

					$updcreditid=$this->UserCreditAccount->getLastInsertId();

				}

				if($updcreditid!='')

				{

					$this->loadModel('AddCredit');

					$this->request->data['AddCredit']['credit_id']=$updcreditid;

					$this->request->data['AddCredit']['credits']=$UserMembership['UserMembership']['credits'];

					$this->AddCredit->save($this->request->data);

					

				}

				$this->TempMembershipDetail->delete($tempdetails['TempMembershipDetail']['temp_mem_id']);

				$this->Session->delete('membertype_id');

				$this->Session->delete('card');

				$this->Session->delete('randomid');

			}

		}

		

		}

		$this->layout='payment_success';

	}

	public function failed()

	{

		if(!$this->Session->check('membertype_id'))

		{

			return $this->redirect(array('action' => 'index'));

		}

		if(!$this->Session->check('card'))

		{

			return $this->redirect(array('action' => 'card'));

		}

		if(!$this->Session->check('randomid'))

		{

			return $this->redirect(array('action' => 'confirm_plan'));

		}

		$this->loadModel('UserMembership');

		$UserMembership=$this->UserMembership->find('first', array('conditions' => array('status' => 1, 'memb_id' => $this->Session->read('membertype_id')), 'order' => array('price' => 'desc')));

		$randomid=$this->Session->read('randomid');

		$this->loadModel('TempMembershipDetail');

		$tempdetails=$this->TempMembershipDetail->find('first', array('conditions' => array('randomid' => $randomid)));

		$user_session=$this->Session->read('User');

		$this->layout='payment_failed';

	}

/**

 * view method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function view($id = null) {

		if (!$this->UpgradeMembership->exists($id)) {

			throw new NotFoundException(__('Invalid upgrade membership'));

		}

		$options = array('conditions' => array('UpgradeMembership.' . $this->UpgradeMembership->primaryKey => $id));

		$this->set('upgradeMembership', $this->UpgradeMembership->find('first', $options));

	}



/**

 * add method

 *

 * @return void

 */

	public function add() {

		if ($this->request->is('post')) {

			$this->UpgradeMembership->create();

			if ($this->UpgradeMembership->save($this->request->data)) {

				$this->Session->setFlash(__('The upgrade membership has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The upgrade membership could not be saved. Please, try again.'));

			}

		}

	}



/**

 * edit method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function edit($id = null) {

		if (!$this->UpgradeMembership->exists($id)) {

			throw new NotFoundException(__('Invalid upgrade membership'));

		}

		if ($this->request->is(array('post', 'put'))) {

			if ($this->UpgradeMembership->save($this->request->data)) {

				$this->Session->setFlash(__('The upgrade membership has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The upgrade membership could not be saved. Please, try again.'));

			}

		} else {

			$options = array('conditions' => array('UpgradeMembership.' . $this->UpgradeMembership->primaryKey => $id));

			$this->request->data = $this->UpgradeMembership->find('first', $options);

		}

	}



/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function delete($id = null) {

		$this->UpgradeMembership->id = $id;

		if (!$this->UpgradeMembership->exists()) {

			throw new NotFoundException(__('Invalid upgrade membership'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->UpgradeMembership->delete()) {

			$this->Session->setFlash(__('The upgrade membership has been deleted.'));

		} else {

			$this->Session->setFlash(__('The upgrade membership could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	}

}

