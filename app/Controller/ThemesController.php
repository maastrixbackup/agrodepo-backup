<?php
App::uses('AppController', 'Controller');
/**
 * Themes Controller
 *
 * @property Theme $Theme
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ThemesController extends AppController {

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
		$this->set('title_for_layout', 'Manage Themes');
		$this->Theme->recursive = 0;
		$this->set('themes', $this->Paginator->paginate());
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
		if (!$this->Theme->exists($id)) {
			throw new NotFoundException(__('Invalid theme'));
		}
		$options = array('conditions' => array('Theme.' . $this->Theme->primaryKey => $id));
		$this->set('theme', $this->Theme->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->set('title_for_layout', 'Add New Propertites');
		if ($this->request->is('post')) {
			$this->Theme->create();
			if ($this->Theme->save($this->request->data)) {
				$this->Session->setFlash(__('The theme has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The theme could not be saved. Please, try again.'));
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
		if (!$this->Theme->exists($id)) {
			throw new NotFoundException(__('Invalid theme'));
		}
		$this->set('title_for_layout', 'Edit Propertites');
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Theme->save($this->request->data)) {
				$this->Session->setFlash(__('The theme has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The theme could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Theme.' . $this->Theme->primaryKey => $id));
			$this->request->data = $this->Theme->find('first', $options);
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
		$this->Theme->id = $id;
		if (!$this->Theme->exists()) {
			throw new NotFoundException(__('Invalid theme'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Theme->delete()) {
			$this->Session->setFlash(__('The theme has been deleted.'));
		} else {
			$this->Session->setFlash(__('The theme could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
