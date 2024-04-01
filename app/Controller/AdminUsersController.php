<?php
App::uses('AppController', 'Controller');
/**
 * AdminUsers Controller
 *
 * @property AdminUser $AdminUser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AdminUsersController extends AppController {

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
		$this->set('title_for_layout', 'Manage Admin');
		$this->AdminUser->recursive = 0;
		$this->set('login_user_id',$this->Session->read('adminUser'));
		$this->set('adminUsers', $this->Paginator->paginate());
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
		if (!$this->AdminUser->exists($id)) {
			throw new NotFoundException(__('Invalid admin user'));
		}
		$options = array('conditions' => array('AdminUser.' . $this->AdminUser->primaryKey => $id));
		$this->set('adminUser', $this->AdminUser->find('first', $options));
		$this->layout="view_admin";
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			//pr($this->request->data);exit;
			$this->AdminUser->create();
			if ($this->AdminUser->save($this->request->data)) {
				$this->Session->setFlash(__('The admin user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin user could not be saved. Please, try again.'));
			}
		}
		$this->layout="add_admin";
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->AdminUser->exists($id)) {
			throw new NotFoundException(__('Invalid admin user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AdminUser->save($this->request->data)) {
				$this->Session->setFlash(__('The admin user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AdminUser.' . $this->AdminUser->primaryKey => $id));
			$this->request->data = $this->AdminUser->find('first', $options);
		}
		$this->layout="add_admin";
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->AdminUser->id = $id;
		if (!$this->AdminUser->exists()) {
			throw new NotFoundException(__('Invalid admin user'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->AdminUser->delete()) {
			$this->Session->setFlash(__('The admin user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The admin user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
