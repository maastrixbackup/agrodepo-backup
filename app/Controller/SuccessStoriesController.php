<?php
App::uses('AppController', 'Controller');
/**
 * SuccessStories Controller
 *
 * @property SuccessStory $SuccessStory
 * @property PaginatorComponent $Paginator
 */
class SuccessStoriesController extends AppController {

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
		$this->SuccessStory->recursive = 0;
		$this->Paginator->settings =array('order' => array('success_id' => 'desc'));
		$this->set('successStories', $this->Paginator->paginate());
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
		$this->set('title_for_layout', 'Manage News');
		if (!$this->SuccessStory->exists($id)) {
			throw new NotFoundException(__('Invalid success story'));
		}
		$options = array('conditions' => array('SuccessStory.' . $this->SuccessStory->primaryKey => $id));
		$this->set('successStory', $this->SuccessStory->find('first', $options));
		$this->layout="manage_admin";
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->set('title_for_layout', 'Add Success Stories');
		$this->loadModel('ManageUser');
		$userList=$this->ManageUser->find('list', array('conditions' => array('is_active' => 1, 'wrong_login_attempt <=' => 3)));
		$alluser=$this->ManageUser->find('all', array('conditions' => array('is_active' => 1, 'wrong_login_attempt <=' => 3)));
		if(!empty($alluser))
		{
			foreach($alluser as $userRes)
			{
			$userID=$userRes['ManageUser']['user_id'];
			$userName=$userRes['ManageUser']['first_name'].' '.$userRes['ManageUser']['last_name'];
			$userList[$userID]=$userName;	
			}
		}
		$this->set('userList', $userList);
		if ($this->request->is('post')) {
			$this->SuccessStory->create();
			if ($this->SuccessStory->save($this->request->data)) {
				$this->Session->setFlash(__('The success story has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The success story could not be saved. Please, try again.'));
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
		$this->set('title_for_layout', 'Edit Success Stories');
		if (!$this->SuccessStory->exists($id)) {
			throw new NotFoundException(__('Invalid success story'));
		}
		$this->loadModel('ManageUser');
		$userList=$this->ManageUser->find('list', array('conditions' => array('is_active' => 1, 'wrong_login_attempt <=' => 3)));
		$alluser=$this->ManageUser->find('all', array('conditions' => array('is_active' => 1, 'wrong_login_attempt <=' => 3)));
		if(!empty($alluser))
		{
			foreach($alluser as $userRes)
			{
			$userID=$userRes['ManageUser']['user_id'];
			$userName=$userRes['ManageUser']['first_name'].' '.$userRes['ManageUser']['last_name'];
			$userList[$userID]=$userName;	
			}
		}
		$this->set('userList', $userList);
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SuccessStory->save($this->request->data)) {
				$this->Session->setFlash(__('The success story has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The success story could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SuccessStory.' . $this->SuccessStory->primaryKey => $id));
			$this->request->data = $this->SuccessStory->find('first', $options);
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
		$this->SuccessStory->id = $id;
		if (!$this->SuccessStory->exists()) {
			throw new NotFoundException(__('Invalid success story'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SuccessStory->delete()) {
			$this->Session->setFlash(__('The success story has been deleted.'));
		} else {
			$this->Session->setFlash(__('The success story could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
