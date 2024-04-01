<?php
App::uses('AppController', 'Controller');
/**
 * BackupDbs Controller
 *
 * @property BackupDb $BackupDb
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BackupDbsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Dez');
	
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
		$this->set('title_for_layout', 'Manage Backup Files');
		$this->BackupDb->recursive = 0;
		$this->Paginator->settings =array('order' => array('backup_id' => 'desc'));
		$this->set('backupDbs', $this->Paginator->paginate());
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
		$this->BackupDb->id = $id;
		if (!$this->BackupDb->exists()) {
			throw new NotFoundException(__('Invalid backup db'));
		}
		$backup_detail=$this->BackupDb->find('first', array('backup_id' => $id));
		$this->request->onlyAllow('post', 'delete');
		if ($this->BackupDb->delete()) {
			@unlink(WWW_ROOT.'files/backup_db/'.$backup_detail['BackupDb']['backup_file']);
			$this->Session->setFlash(__('The backup db has been deleted.'));
		} else {
			$this->Session->setFlash(__('The backup db could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
