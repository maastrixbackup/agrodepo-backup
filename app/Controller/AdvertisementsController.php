<?php
App::uses('AppController', 'Controller');
App::uses('resize', 'Vendor');
/**

 * Advertisements Controller

 *

 * @property Advertisement $Advertisement

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class AdvertisementsController extends AppController {



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

		$this->Advertisement->recursive = 0;

		$this->set('advertisements', $this->Paginator->paginate());

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

		if (!$this->Advertisement->exists($id)) {

			throw new NotFoundException(__('Invalid advertisement'));

		}

		$options = array('conditions' => array('Advertisement.' . $this->Advertisement->primaryKey => $id));

		$this->set('advertisement', $this->Advertisement->find('first', $options));

		$this->layout="view_admin";

	}



/**

 * add method

 *

 * @return void

 */

	public function admin_add() {

		if ($this->request->is('post')) {

			$this->Advertisement->create();

			if($this->request->data['Advertisement']['ad_type']==1){

				unset($this->request->data['Advertisement']['ad_script']);

				$banner_link=trim(@$this->request->data['Advertisement']['banner_link']);

				$banner_title=trim(@$this->request->data['Advertisement']['banner_title']);

				$banner_image=trim(@$this->request->data['Advertisement']['banner_image']['name']);

				//pr($this->request->data['Advertisement']['banner_image']);exit;

				$prtn='/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i';

				

				if($banner_title ==''){

					$this->Session->setFlash(__('Enter Banner Title'));

				}

				else if( $banner_link==''){

					$this->Session->setFlash(__('Enter Banner Title and Banner Link'));

				}

				else if(!preg_match($prtn,$banner_link))

				{

					$this->Session->setFlash(__('Enter a valid URL'));

							

				}

				else if($banner_image=='')

				{

				$this->Session->setFlash(__('Enter Banner Image'));

				}

				else

				{

					if($banner_image!=''){

					$banner_image=time().'_'.$banner_image;

					move_uploaded_file($this->request->data['Advertisement']['banner_image']['tmp_name'],'files/advertisement/'.$banner_image);//exit;
					
					$resizeObj = new resize(WWW_ROOT.'files/advertisement/'.$banner_image);
					$resizeObj -> resizeImage(810, 160, 'crop');
					$resizeObj -> saveImage(WWW_ROOT.'files/advertisement/810X160_'.$banner_image, 90);

					$resizeObj -> resizeImage(256, 214, 'crop');
					$resizeObj -> saveImage(WWW_ROOT.'files/advertisement/256X214_'.$banner_image, 90);

					$resizeObj -> resizeImage(327, 240, 'crop');
					$resizeObj -> saveImage(WWW_ROOT.'files/advertisement/327X240_'.$banner_image, 90);

					$resizeObj -> resizeImage(100, 100, 'crop');
					$resizeObj -> saveImage(WWW_ROOT.'files/advertisement/100X100_'.$banner_image, 90);

					$this->request->data['Advertisement']['banner_image']=$banner_image;

					}

					if ($this->Advertisement->save($this->request->data)) {

					$this->Session->setFlash(__('The advertisement has been saved.'));

					return $this->redirect(array('action' => 'index'));

					} else {

					$this->Session->setFlash(__('The advertisement could not be saved. Please, try again.'));

					}

				}

				

			}else if($this->request->data['Advertisement']['ad_type']==2){

				unset($this->request->data['Advertisement']['banner_title']);

				unset($this->request->data['Advertisement']['banner_link']);

				unset($this->request->data['Advertisement']['banner_image']);

				

				if(trim($this->request->data['Advertisement']['ad_script']) ==''){

					$this->Session->setFlash(__('Enter Ad Script'));

				}else{

					if ($this->Advertisement->save($this->request->data)) {

					$this->Session->setFlash(__('The advertisement has been saved.'));

					return $this->redirect(array('action' => 'index'));

					} else {

					$this->Session->setFlash(__('The advertisement could not be saved. Please, try again.'));

					}

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

		if (!$this->Advertisement->exists($id)) {

			throw new NotFoundException(__('Invalid advertisement'));

		}

		if ($this->request->is(array('post', 'put'))) {

			

			if($this->request->data['Advertisement']['ad_type']==1){

				//pr($this->request->data);exit;

				unset($this->request->data['Advertisement']['ad_script']);

				$banner_link=trim(@$this->request->data['Advertisement']['banner_link']);

				$banner_title=trim(@$this->request->data['Advertisement']['banner_title']);

				$banner_image=(trim(@$this->request->data['Advertisement']['banner_image']['name']));

				if($banner_image!=''){

					$bnr_img=time().'_'.$banner_image;

				}else{

					$bnr_img=trim(@$this->request->data['hid_img']);

				}

				

				

				//pr($this->request->data['Advertisement']['banner_image']);exit;

				$prtn='/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i';

				

				if($banner_title ==''){

					$this->Session->setFlash(__('Enter Banner Title'));

				}

				else if( $banner_link==''){

					$this->Session->setFlash(__('Enter Banner Title and Banner Link'));

				}

				else if(!preg_match($prtn,$banner_link))

				{

					$this->Session->setFlash(__('Enter a valid URL'));

							

				}

				else if($bnr_img=='')

				{

				$this->Session->setFlash(__('Enter Banner Image'));

				}

				else

				{

					if($banner_image!=''){

					

					move_uploaded_file($this->request->data['Advertisement']['banner_image']['tmp_name'],'files/advertisement/'.$bnr_img);//exit;
					$resizeObj = new resize(WWW_ROOT.'files/advertisement/'.$banner_image);
					$resizeObj -> resizeImage(810, 160, 'crop');
					$resizeObj -> saveImage(WWW_ROOT.'files/advertisement/810X160_'.$banner_image, 90);
					
					$resizeObj -> resizeImage(256, 214, 'crop');
					$resizeObj -> saveImage(WWW_ROOT.'files/advertisement/256X214_'.$banner_image, 90);

					$resizeObj -> resizeImage(327, 240, 'crop');
					$resizeObj -> saveImage(WWW_ROOT.'files/advertisement/327X240_'.$banner_image, 90);

				   $this->request->data['Advertisement']['banner_image']=$bnr_img;

					}else{

						$this->request->data['Advertisement']['banner_image']=$bnr_img;

					}

					if ($this->Advertisement->save($this->request->data)) {

					$this->Session->setFlash(__('The advertisement has been saved.'));

					return $this->redirect(array('action' => 'index'));

					} else {

					$this->Session->setFlash(__('The advertisement could not be saved. Please, try again.'));

					}

				}

					

				

			}else if($this->request->data['Advertisement']['ad_type']==2){

				unset($this->request->data['Advertisement']['banner_title']);

				unset($this->request->data['Advertisement']['banner_link']);

				unset($this->request->data['Advertisement']['banner_image']);

				

				if(trim($this->request->data['Advertisement']['ad_script']) ==''){

					$this->Session->setFlash(__('Enter Ad Script'));

				}else{

					if ($this->Advertisement->save($this->request->data)) {

					$this->Session->setFlash(__('The advertisement has been saved.'));

					return $this->redirect(array('action' => 'index'));

					} else {

					$this->Session->setFlash(__('The advertisement could not be saved. Please, try again.'));

					}

				}

				

			}

			

		} else {

			$options = array('conditions' => array('Advertisement.' . $this->Advertisement->primaryKey => $id));

			$this->request->data = $this->Advertisement->find('first', $options);

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

		$this->Advertisement->id = $id;

		if (!$this->Advertisement->exists()) {

			throw new NotFoundException(__('Invalid advertisement'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->Advertisement->delete()) {

			$this->Session->setFlash(__('The advertisement has been deleted.'));

		} else {

			$this->Session->setFlash(__('The advertisement could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

		$this->layout="manage_admin";

	}



	function changeStatus(){//print_r($this->request->data);exit;

	$this->layout='ajax';

	$this->LoadModel("Advertisement");

	$status=$this->request->data['status'];

	$ad_id=$this->request->data['ad_id'];

	

	$this->Advertisement->id=$ad_id;

	if($this->Advertisement->saveField("status",$status)){

		echo 1;exit;

	}else{

		echo 0;exit;

	}

	

   }



}

