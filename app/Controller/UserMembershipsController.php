<?php

App::uses('AppController', 'Controller');
App::uses('resize', 'Vendor');
/**

 * UserMemberships Controller

 *

 * @property UserMembership $UserMembership

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class UserMembershipsController extends AppController {



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

 * index method

 *

 * @return void

 */

	public function admin_index() {

		$this->UserMembership->recursive = 0;

		$this->Paginator->settings=array('order'=>array('UserMembership.memb_id'=>'desc'),'limit'=>20);

		$this->set('userMemberships', $this->Paginator->paginate('UserMembership'));

		$this->layout="manage_admin";

	}



/**

 * view method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function admin_view($id = null) {

		if (!$this->UserMembership->exists($id)) {

			throw new NotFoundException(__('Invalid user membership'));

		}

		$options = array('conditions' => array('UserMembership.' . $this->UserMembership->primaryKey => $id));

		$this->set('userMembership', $this->UserMembership->find('first', $options));

		$this->layout="view_admin";

	}



/**

 * add method

 *

 * @return void

 */

	public function admin_add() {

		if ($this->request->is('post')) {

			//pr($this->request->data);

			$this->UserMembership->create();

			

			if(isset($this->request->data['UserMembership']['plan_img']['name']) && $this->request->data['UserMembership']['plan_img']['name']!=''){

			$img_name=time().'_'.$this->request->data['UserMembership']['plan_img']['name'];

			$path=WWW_ROOT.'files/memberplanimg/'.$img_name;

			$tmp_file=$this->request->data['UserMembership']['plan_img']['tmp_name'];

			

			$this->request->data['UserMembership']['plan_img']=$img_name;

		if( move_uploaded_file($tmp_file,$path)){
			
			$resizeObj = new resize(WWW_ROOT.'files/memberplanimg/'.$img_name);
			$resizeObj -> resizeImage(45, 45, 'crop');
			$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/45X45_'.$img_name, 90);
			
			$resizeObj -> resizeImage(100, 100, 'crop');
			$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/100X100_'.$img_name, 90);
			
			$resizeObj -> resizeImage(70, 100, 'crop');
			$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/70X100_'.$img_name, 90);
			
			$resizeObj -> resizeImage(74, 105, 'crop');
			$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/74X105_'.$img_name, 90);
			
			$resizeObj -> resizeImage(40, 56, 'crop');
			$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/40X56_'.$img_name, 90);
			
			$resizeObj -> resizeImage(60, 60, 'crop');
			$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/60X60_'.$img_name, 90);
			
			
			$resizeObj -> resizeImage(102, 142, 'crop');
			$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/102X142_'.$img_name, 90);
			
			

			if ($this->UserMembership->save($this->request->data)) {

				$this->Session->setFlash(__('The user membership has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The user membership could not be saved. Please, try again.'));

			}

	      }else{

			  $this->Session->setFlash(__('The user membership could not be saved. Please, try again.'));

		}

		}else{

			$this->request->data['UserMembership']['plan_img']='';

			if ($this->UserMembership->save($this->request->data)) {

				$this->Session->setFlash(__('The user membership has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The user membership could not be saved. Please, try again.'));

			}

		}

		}

		$this->layout="add_admin";

		

	}



/**

 * edit method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function admin_edit($id = null) {

		if (!$this->UserMembership->exists($id)) {

			throw new NotFoundException(__('Invalid user membership'));

		}

		

		if ($this->request->is(array('post', 'put'))) {

			//pr($this->request->data);exit;

			if(isset($this->request->data['UserMembership']['plan_img']['name']) && $this->request->data['UserMembership']['plan_img']['name']!=''){

			$img_name=time().'_'.$this->request->data['UserMembership']['plan_img']['name'];

			$path=WWW_ROOT.'files/memberplanimg/'.$img_name;

			$tmp_file=$this->request->data['UserMembership']['plan_img']['tmp_name'];

			$this->request->data['UserMembership']['plan_img']=$img_name;

			@unlink(WWW_ROOT.'files/memberplanimg/'.$this->request->data['UserMembership']['prev_img_hid']);

				if( move_uploaded_file($tmp_file,$path)){
						$resizeObj = new resize(WWW_ROOT.'files/memberplanimg/'.$img_name);
						$resizeObj -> resizeImage(45, 45, 'crop');
						$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/45X45_'.$img_name, 90);
						
						$resizeObj -> resizeImage(100, 100, 'crop');
						$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/100X100_'.$img_name, 90);
						
						$resizeObj -> resizeImage(70, 100, 'crop');
						$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/70X100_'.$img_name, 90);
						
						$resizeObj -> resizeImage(74, 105, 'crop');
						$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/74X105_'.$img_name, 90);
						
			
						$resizeObj -> resizeImage(40, 56, 'crop');
						$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/40X56_'.$img_name, 90);
						
			
						$resizeObj -> resizeImage(60, 60, 'crop');
						$resizeObj -> saveImage(WWW_ROOT.'files/memberplanimg/60X60_'.$img_name, 90);
						
			
						if ($this->UserMembership->save($this->request->data)) {

							$this->Session->setFlash(__('The user membership has been saved.'));

							return $this->redirect(array('action' => 'index'));

						} else {

							$this->Session->setFlash(__('The user membership could not be saved. Please, try again.'));

						}

				 }else{

				  $this->Session->setFlash(__('The user membership could not be saved. Please, try again.'));

				}

			

			}else if($this->request->data['UserMembership']['plan_img_hid']!=''){

				$this->request->data['UserMembership']['plan_img']=$this->request->data['UserMembership']['plan_img_hid'];				if ($this->UserMembership->save($this->request->data)) {

				$this->Session->setFlash(__('The user membership has been saved.'));

				return $this->redirect(array('action' => 'index'));

				} else {

				$this->Session->setFlash(__('The user membership could not be saved. Please, try again.'));

				}

			}else{

				$this->request->data['UserMembership']['plan_img']='';

				unset($this->request->data['UserMembership']['plan_img_hid']);

				if ($this->UserMembership->save($this->request->data)) {

				$this->Session->setFlash(__('The user membership has been saved.'));

				return $this->redirect(array('action' => 'index'));

				} else {

				$this->Session->setFlash(__('The user membership could not be saved. Please, try again.'));

			}

					

			}

			

			

		} else {

			$options = array('conditions' => array('UserMembership.' . $this->UserMembership->primaryKey => $id));

			$this->request->data = $this->UserMembership->find('first', $options);

		}

		$this->layout="add_admin";

	}



/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function admin_delete($id = null) {

		$this->UserMembership->id = $id;

		$img_name_arr=$this->UserMembership->find('first',array('conditions'=>array('UserMembership.memb_id'=>$id)));

		$img_name=$img_name_arr['UserMembership']['plan_img'];

		//pr($img_name);exit;

		if (!$this->UserMembership->exists()) {

			throw new NotFoundException(__('Invalid user membership'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->UserMembership->delete()) {

			@unlink(WWW_ROOT.'files/memberplanimg/'.$img_name);
			@unlink(WWW_ROOT.'files/memberplanimg/45X45_'.$img_name);
			@unlink(WWW_ROOT.'files/memberplanimg/100X100_'.$img_name);

			$this->Session->setFlash(__('The user membership has been deleted.'));

		} else {

			$this->Session->setFlash(__('The user membership could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

		$this->layout="manage_admin";

	}

	/*

		change the status

	*/

	function changeStatus(){//print_r($this->request->data);exit;

	$this->layout='ajax';

	$this->LoadModel("UserMembership");

	$status=$this->request->data['status'];

	$memb_id=$this->request->data['memb_id'];

	$this->UserMembership->id=$memb_id;

	if($this->UserMembership->saveField("status",$status)){

		echo 1;exit;

	}else{

		echo 0;exit;

	}

   }

}

