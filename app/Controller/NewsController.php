<?php

App::uses('AppController', 'Controller');
App::uses('resize', 'Vendor');
/**

 * News Controller

 *

 * @property News $News

 * @property PaginatorComponent $Paginator

 */

class NewsController extends AppController {



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

		$this->set('title_for_layout', 'Manage News');

		$this->News->recursive = 0;

		$this->set('news', $this->Paginator->paginate());

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

		$this->set('title_for_layout', 'News Detail');

		if (!$this->News->exists($id)) {

			throw new NotFoundException(__('Invalid news'));

		}

		$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));

		$this->set('news', $this->News->find('first', $options));

		$this->layout="manage_admin";

	}



/**

 * admin_add method

 *

 * @return void

 */

	public function admin_add() {

		$this->set('title_for_layout', 'Add News');

		if ($this->request->is('post')) {

			if($this->request->data['News']['news_img']['name']!='')

			{

				$newsimg=time().$this->request->data['News']['news_img']['name'];

				move_uploaded_file($this->request->data['News']['news_img']['tmp_name'],WWW_ROOT.'files/news/'.$newsimg);
				
				$resizeObj = new resize(WWW_ROOT.'files/news/'.$newsimg);
				$resizeObj -> resizeImage(60, 60, 'crop');
	        	$resizeObj -> saveImage(WWW_ROOT.'files/news/60X60_'.$newsimg, 90);


				$resizeObj -> resizeImage(70, 54, 'crop');
	        	$resizeObj -> saveImage(WWW_ROOT.'files/news/70X54_'.$newsimg, 90);


				$this->request->data['News']['news_img']=$newsimg;

			}

			$this->News->create();

			if ($this->News->save($this->request->data)) {

				$this->Session->setFlash(__('The news has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The news could not be saved. Please, try again.'));

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

		$this->set('title_for_layout', 'Edit News');

		if (!$this->News->exists($id)) {

			throw new NotFoundException(__('Invalid news'));

		}

		if ($this->request->is(array('post', 'put'))) {

			$voptions = array('conditions' => array('News.' . $this->News->primaryKey => $id));

				$newsres=$this->News->find('first', $voptions);

			if($this->request->data['News']['news_img']['name']!='')

			{

				$newsimg=time().$this->request->data['News']['news_img']['name'];

				move_uploaded_file($this->request->data['News']['news_img']['tmp_name'],WWW_ROOT.'files/news/'.$newsimg);
				
				$resizeObj = new resize(WWW_ROOT.'files/news/'.$newsimg);
				$resizeObj -> resizeImage(60, 60, 'crop');
	        	$resizeObj -> saveImage(WWW_ROOT.'files/news/60X60_'.$newsimg, 90);
				
				$resizeObj -> resizeImage(70, 54, 'crop');
	        	$resizeObj -> saveImage(WWW_ROOT.'files/news/70X54_'.$newsimg, 90);
				
				$this->request->data['News']['news_img']=$newsimg;

				

				@unlink(WWW_ROOT.'files/news/'.$newsres['News']['news_img']);

			}

			else

			{

				$this->request->data['News']['news_img']=$newsres['News']['news_img'];

			}

			if ($this->News->save($this->request->data)) {

				$this->Session->setFlash(__('The news has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The news could not be saved. Please, try again.'));

			}

		} else {

			$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));

			$this->request->data = $this->News->find('first', $options);

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

		$this->News->id = $id;

		if (!$this->News->exists()) {

			throw new NotFoundException(__('Invalid news'));

		}

		$voptions = array('conditions' => array('News.' . $this->News->primaryKey => $id));

		$newsres=$this->News->find('first', $voptions);

		$this->request->onlyAllow('post', 'delete');

		if ($this->News->delete()) {

			@unlink(WWW_ROOT.'files/news/'.$newsres['News']['news_img']);

			$this->Session->setFlash(__('The news has been deleted.'));

		} else {

			$this->Session->setFlash(__('The news could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	}

}

