<?php
App::uses('AppController', 'Controller');
/**
 * MasterMessages Controller
 *
 * @property MasterMessage $MasterMessage
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MasterMessagesController extends AppController {

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
		$this->set('title_for_layout', 'Manage Success Stories');
		$this->MasterMessage->recursive = 0;
		$this->Paginator->settings =array('order' => array('msg_id' => 'desc'));
		$this->set('masterMessages', $this->Paginator->paginate());
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
		if (!$this->MasterMessage->exists($id)) {
			throw new NotFoundException(__('Invalid master message'));
		}
		$options = array('conditions' => array('MasterMessage.' . $this->MasterMessage->primaryKey => $id));
		$this->set('masterMessage', $this->MasterMessage->find('first', $options));
		$this->layout="manage_admin";
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->set('title_for_layout', 'Manage Success Stories');
		if ($this->request->is('post')) {
			$this->MasterMessage->create();
			if ($this->MasterMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The master message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master message could not be saved. Please, try again.'));
			}
		}
		$this->layout="manage_admin";
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->set('title_for_layout', 'Manage Success Stories');
		if (!$this->MasterMessage->exists($id)) {
			throw new NotFoundException(__('Invalid master message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MasterMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The master message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MasterMessage.' . $this->MasterMessage->primaryKey => $id));
			$this->request->data = $this->MasterMessage->find('first', $options);
		}
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
		$this->MasterMessage->id = $id;
		if (!$this->MasterMessage->exists()) {
			throw new NotFoundException(__('Invalid master message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MasterMessage->delete()) {
			$this->Session->setFlash(__('The master message has been deleted.'));
		} else {
			$this->Session->setFlash(__('The master message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
