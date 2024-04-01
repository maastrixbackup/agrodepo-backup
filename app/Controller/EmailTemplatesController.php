<?php
App::uses('AppController', 'Controller');
/**
 * EmailTemplates Controller
 *
 * @property EmailTemplate $EmailTemplate
 * @property PaginatorComponent $Paginator
 * @property DezComponent $Dez
 * @property SessionComponent $Session
 */
class EmailTemplatesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Dez', 'Session');

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
		$this->EmailTemplate->recursive = 0;
		$this->set('emailTemplates', $this->Paginator->paginate());
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
		if (!$this->EmailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid email template'));
		}
		$options = array('conditions' => array('EmailTemplate.' . $this->EmailTemplate->primaryKey => $id));
		$this->set('emailTemplate', $this->EmailTemplate->find('first', $options));
		$this->layout="view_admin";
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$templateChk=$this->EmailTemplate->find('first', array('conditions' => array('email_of' =>$this->request->data['EmailTemplate']['email_of'])));
			if(count($templateChk)>0){
				$this->Session->setFlash(__('This page is already assigned to a template. Please try Another'));
			}else{
				$this->EmailTemplate->create();
				if ($this->EmailTemplate->save($this->request->data)) {
					$this->Session->setFlash(__('Email Template Saved Successfully.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Email Template Saving Failed.'));
				}
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
		if (!$this->EmailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid email template'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$templateChk=$this->EmailTemplate->find('first', array('conditions' => array('email_of' =>$this->request->data['EmailTemplate']['email_of'], 'compose_id !=' => $this->request->data['EmailTemplate']['compose_id'])));
			if(count($templateChk)>0){
				$this->Session->setFlash(__('This page is already assigned to a template. Please try Another'));
			}else{
					if ($this->EmailTemplate->save($this->request->data)) {
						$this->Session->setFlash(__('Email Template Updated Successfully.'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('Email Template Updating Failed.'));
					}
				}
		} else {
			$options = array('conditions' => array('EmailTemplate.' . $this->EmailTemplate->primaryKey => $id));
			$this->request->data = $this->EmailTemplate->find('first', $options);
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
		$this->EmailTemplate->id = $id;
		if (!$this->EmailTemplate->exists()) {
			throw new NotFoundException(__('Invalid email template'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EmailTemplate->delete()) {
			$this->Session->setFlash(__('Email Template Deleted Successfully'));
		} else {
			$this->Session->setFlash(__('Email Template Deleting Failed'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
