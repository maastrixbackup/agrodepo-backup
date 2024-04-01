<?php
App::uses('AppController', 'Controller');
/**
 * AdminLangs Controller
 *
 * @property AdminLang $AdminLang
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AdminLangsController extends AppController {

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
		$this->AdminLang->recursive = 0;
		$searchtxt=@$this->request->params['named']['searchtxt'];
		if($searchtxt!="")
		{
			$this->Paginator->settings = array('conditions' => array( 'OR' => array(
			array('AdminLang.en_label LIKE ' => '%'.$searchtxt.'%'),
			array('AdminLang.roman_label LIKE ' => '%'.$searchtxt.'%')
			)), 'order' =>array('AdminLang.lid' => 'desc'), 'limit' => 20);
				//print_r( $this->Paginator->paginate());
		}else
		{
			$this->Paginator->settings=array('order'=>array('AdminLang.lid'=>'desc'),'limit'=>20);
		}		
		$this->set('searchtxt', $searchtxt);
		$this->set('adminLangs', $this->Paginator->paginate('AdminLang'));
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
		if (!$this->AdminLang->exists($id)) {
			throw new NotFoundException(__('Invalid admin lang'));
		}
		$options = array('conditions' => array('AdminLang.' . $this->AdminLang->primaryKey => $id));
		$this->set('adminLang', $this->AdminLang->find('first', $options));
		$this->layout="view_admin";
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AdminLang->create();
			if ($this->AdminLang->save($this->request->data)) {
				$this->Session->setFlash(__('The admin lang has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin lang could not be saved. Please, try again.'));
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
		if (!$this->AdminLang->exists($id)) {
			throw new NotFoundException(__('Invalid admin lang'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AdminLang->save($this->request->data)) {
				$this->Session->setFlash(__('The admin lang has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin lang could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AdminLang.' . $this->AdminLang->primaryKey => $id));
			$this->request->data = $this->AdminLang->find('first', $options);
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
		$this->AdminLang->id = $id;
		if (!$this->AdminLang->exists()) {
			throw new NotFoundException(__('Invalid admin lang'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->AdminLang->delete()) {
			$this->Session->setFlash(__('The admin lang has been deleted.'));
		} else {
			$this->Session->setFlash(__('The admin lang could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		$this->layout="manage_admin";
		
	}
}
