<?php
App::uses('AppController', 'Controller');
/**
 * SeoFields Controller
 *
 * @property SeoField $SeoField
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SeoFieldsController extends AppController {

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
		$this->SeoField->recursive = 0;
		$this->set('seoFields', $this->Paginator->paginate());
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
		if (!$this->SeoField->exists($id)) {
			throw new NotFoundException(__('Invalid seo field'));
		}
		$options = array('conditions' => array('SeoField.' . $this->SeoField->primaryKey => $id));
		$this->set('seoField', $this->SeoField->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SeoField->create();
			if ($this->SeoField->save($this->request->data)) {
				$this->Session->setFlash(__('The seo field has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo field could not be saved. Please, try again.'));
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
		if (!$this->SeoField->exists($id)) {
			throw new NotFoundException(__('Invalid seo field'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SeoField->save($this->request->data)) {
				$this->Session->setFlash(__('The seo field has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo field could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SeoField.' . $this->SeoField->primaryKey => $id));
			$this->request->data = $this->SeoField->find('first', $options);
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
		$this->SeoField->id = $id;
		if (!$this->SeoField->exists()) {
			throw new NotFoundException(__('Invalid seo field'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SeoField->delete()) {
			$this->Session->setFlash(__('The seo field has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seo field could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
