<?php
App::uses('AppController', 'Controller');
/**
 * SalesWarranties Controller
 *
 * @property SalesWarranty $SalesWarranty
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SalesWarrantiesController extends AppController {

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
			else
			{
				$user_session=$this->Session->read('User');
				$userid=$user_session['user_id'];
				$userstatus=$user_session['is_active'];
			}
			
			
		}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$user_session=$this->Session->read('User');
		$userid=$user_session['user_id'];
		$userstatus=$user_session['is_active'];
		$this->set('title_for_layout','Sales Warranty');
		if ($this->request->is(array('post', 'put'))) {
			//----------------------------------------------------------
			$this->loadModel('MasterMessage');
			$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 77)));
			$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 78)));
			//---------------------------------------------
			//pr($this->request->data);exit;
			if($this->request->data['SalesWarranty']['return_policy']==1)
			{
				$this->request->data['SalesWarranty']['method_return_accepted']=implode(',', $this->request->data['SalesWarranty']['method_return_accepted']);
			}
			if(isset($this->request->data['SalesWarranty']['payment_methods']))
			{
				$this->request->data['SalesWarranty']['payment_methods']=implode(',', $this->request->data['SalesWarranty']['payment_methods']);
			}
			$this->request->data['SalesWarranty']['user_id']=$userid;
			if ($this->SalesWarranty->save($this->request->data)) {
				$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('<div class="alert alert-success">'.$failMsg['MasterMessage']['msg'].'</div>'));
			}
		} else {
			$options = array('conditions' => array('SalesWarranty.user_id' => $userid ));
			$this->request->data = $this->SalesWarranty->find('first', $options);
		}
		$this->layout='sales_warranty';
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SalesWarranty->exists($id)) {
			throw new NotFoundException(__('Invalid sales warranty'));
		}
		$options = array('conditions' => array('SalesWarranty.' . $this->SalesWarranty->primaryKey => $id));
		$this->set('salesWarranty', $this->SalesWarranty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SalesWarranty->create();
			if ($this->SalesWarranty->save($this->request->data)) {
				$this->Session->setFlash(__('The sales warranty has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sales warranty could not be saved. Please, try again.'));
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
		if (!$this->SalesWarranty->exists($id)) {
			throw new NotFoundException(__('Invalid sales warranty'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SalesWarranty->save($this->request->data)) {
				$this->Session->setFlash(__('The sales warranty has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sales warranty could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SalesWarranty.' . $this->SalesWarranty->primaryKey => $id));
			$this->request->data = $this->SalesWarranty->find('first', $options);
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
		$this->SalesWarranty->id = $id;
		if (!$this->SalesWarranty->exists()) {
			throw new NotFoundException(__('Invalid sales warranty'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SalesWarranty->delete()) {
			$this->Session->setFlash(__('The sales warranty has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sales warranty could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
