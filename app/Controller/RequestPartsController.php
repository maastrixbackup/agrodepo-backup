<?php
App::uses('AppController', 'Controller');
App::uses('resize', 'Vendor');
App::uses('CakeEmail', 'Network/Email');
/**
 * RequestParts Controller
 *
 * @property RequestPart $RequestPart
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RequestPartsController extends AppController
{

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator', 'Session', 'Dez', 'RequestHandler');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index()
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$user = $this->Session->read('User');
		$this->set('title_for_layout', 'My Request Parts');
		$this->RequestPart->recursive = 0;
		//-------Active request parts list functionality----------------
		$options = array(
			'joins' =>
			array(
				array(
					'table' => 'request_accessories',
					'alias' => 'RequestAccessory',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array('RequestAccessory.request_id = RequestPart.request_id')
				)
			),
			'conditions' =>
			array('AND' => array(
				array('RequestAccessory.status' => 1, 'RequestPart.status' => 1, 'RequestPart.user_id' => $user['user_id']),
			)),
			'fields' =>
			array('RequestPart.*', 'RequestAccessory.*'),
			'order' =>
			array('RequestPart.request_id' => 'desc'),
		);
		$this->Paginator->settings = $options;
		$this->set('requestParts', $this->Paginator->paginate());
		$this->layout = "my_request_part";
	}
	/**
	 * index method
	 *
	 * @return void
	 */
	public function offertomyrequest()
	{
		if ($this->Session->check('User')) {


			$this->set('title_for_layout', 'Offer Bid');
			$this->loadModel('BidOffer');
			$user_id = $this->Session->read('User.user_id');
			//pr($user_id);exit;
			$options = array(
				'joins' =>
				array(
					array(
						'table' => 'request_parts',
						'alias' => 'RequestPart',
						'type' => 'left',
						'foreignKey' => false,
						'conditions' => array('RequestPart.request_id = BidOffer.request_id')
					)
				),
				'conditions' => array('RequestPart.user_id' => $user_id),
				'order' => array('BidOffer.bid_id' => 'desc')
			);
			$this->Paginator->settings = $options;
			$this->set('bidOffer', $this->Paginator->paginate('BidOffer'));


			$this->layout = 'bidding_list';
		} else {
			return $this->redirect(Router::url('/Logins/login', true));
		}
		$this->layout = "offer_to_myrequest";
	}
	/**
	 * Resoved method
	 *
	 * @return void
	 */
	public function resolve()
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$user = $this->Session->read('User');
		$this->set('title_for_layout', 'My Request Parts');
		$this->RequestPart->recursive = 0;
		//-------Active request parts list functionality----------------
		$options = array(
			'joins' =>
			array(
				array(
					'table' => 'request_accessories',
					'alias' => 'RequestAccessory',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array('RequestAccessory.request_id = RequestPart.request_id')
				)
			),
			'conditions' =>
			array('AND' => array(
				array('RequestAccessory.status' => 2, 'RequestPart.status' => 1, 'RequestPart.user_id' => $user['user_id']),
			)),
			'fields' =>
			array('RequestPart.*', 'RequestAccessory.*'),
			'order' =>
			array('RequestPart.request_id' => 'desc'),
		);
		$this->Paginator->settings = $options;
		$this->set('requestParts', $this->Paginator->paginate());
		$this->layout = "my_request_part";
	}
	/**
	 * Offer Winning method
	 *
	 * @return void
	 */
	public function offer_winning()
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$user = $this->Session->read('User');
		$this->set('title_for_layout', 'Offer Winnig');
		$this->RequestPart->recursive = 0;
		//-------Active request parts list functionality----------------
		$options = array(
			'joins' =>
			array(
				array(
					'table' => 'request_accessories',
					'alias' => 'RequestAccessory',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array('RequestAccessory.request_id = RequestPart.request_id')
				)
			),
			'conditions' =>
			array('AND' => array(
				array('RequestAccessory.status' => 2, 'RequestPart.status' => 1, 'RequestPart.user_id' => $user['user_id']),
			)),
			'fields' =>
			array('RequestPart.*', 'RequestAccessory.*'),
			'order' =>
			array('RequestPart.request_id' => 'desc'),
		);
		$this->Paginator->settings = $options;
		$this->set('requestParts', $this->Paginator->paginate());
		$this->layout = "offer_winning";
	}
	/**
	 * Inactive request method
	 *
	 * @return void
	 */
	public function inactive()
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$user = $this->Session->read('User');
		$this->set('title_for_layout', 'My Request Parts');
		$this->RequestPart->recursive = 0;
		//-------Active request parts list functionality----------------
		$options = array(
			'joins' =>
			array(
				array(
					'table' => 'request_accessories',
					'alias' => 'RequestAccessory',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array('RequestAccessory.request_id = RequestPart.request_id')
				)
			),
			'conditions' =>
			array('AND' => array(
				array('RequestAccessory.status' => 0, 'RequestPart.status' => 3, 'RequestPart.user_id' => $user['user_id']),
			)),
			'fields' =>
			array('RequestPart.*', 'RequestAccessory.*'),
			'order' =>
			array('RequestPart.request_id' => 'desc'),
		);
		$this->Paginator->settings = $options;
		$this->set('requestParts', $this->Paginator->paginate());
		$this->layout = "my_request_part";
	}

	/**
	 * Offer Loosing request method
	 *
	 * @return void
	 */
	public function offer_losing()
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$user = $this->Session->read('User');
		$this->set('title_for_layout', 'Offer losing');
		$this->RequestPart->recursive = 0;
		//-------Active request parts list functionality----------------
		$options = array(
			'joins' =>
			array(
				array(
					'table' => 'request_accessories',
					'alias' => 'RequestAccessory',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array('RequestAccessory.request_id = RequestPart.request_id')
				),
				array(
					'table' => 'bid_offers',
					'alias' => 'BidOffer',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array('BidOffer.parts_id = RequestAccessory.part_id')
				)
			),
			'conditions' =>
			array('AND' => array(
				array('RequestAccessory.status' => 2, 'RequestPart.status' => 1, 'BidOffer.status IN' => array(0, 2), 'RequestPart.user_id' => $user['user_id']),
			)),
			'fields' =>
			array('RequestPart.*', 'RequestAccessory.*', 'BidOffer.*'),
			'order' =>
			array('RequestPart.request_id' => 'desc'),
		);
		$this->Paginator->settings = $options;
		$this->set('requestParts', $this->Paginator->paginate());
		$this->layout = "offer_losing";
	}

	/**
	 * Offer Active method
	 *
	 * @return void
	 */
	public function offer_active()
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$user = $this->Session->read('User');
		$this->set('title_for_layout', 'Offer Active');
		$this->RequestPart->recursive = 0;
		//-------Active request parts list functionality----------------
		$options = array(
			'joins' =>
			array(
				array(
					'table' => 'request_accessories',
					'alias' => 'RequestAccessory',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array('RequestAccessory.request_id = RequestPart.request_id')
				),
				array(
					'table' => 'bid_offers',
					'alias' => 'BidOffer',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array('BidOffer.parts_id = RequestAccessory.part_id')
				)
			),
			'conditions' =>
			array('AND' => array(
				array('RequestAccessory.status' => 1, 'RequestPart.status' => 1, 'BidOffer.status' => 0, 'RequestPart.user_id' => $user['user_id']),
			)),
			'fields' =>
			array('RequestPart.*', 'RequestAccessory.*', 'BidOffer.*'),
			'order' =>
			array('RequestPart.request_id' => 'desc'),
		);
		$this->Paginator->settings = $options;
		$this->set('requestParts', $this->Paginator->paginate());
		$this->layout = "offer_losing";
	}
	/**
	 * Offer Inactive method
	 *
	 * @return void
	 */
	public function offer_inactive()
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$user = $this->Session->read('User');
		$this->set('title_for_layout', 'Offer Inactive');
		$this->RequestPart->recursive = 0;
		//-------Active request parts list functionality----------------
		$options = array(
			'joins' =>
			array(
				array(
					'table' => 'request_accessories',
					'alias' => 'RequestAccessory',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array('RequestAccessory.request_id = RequestPart.request_id')
				),
				array(
					'table' => 'bid_offers',
					'alias' => 'BidOffer',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array('BidOffer.parts_id = RequestAccessory.part_id')
				)
			),
			'conditions' =>
			array('AND' => array(
				array('RequestAccessory.status' => 1, 'RequestPart.status' => 1, 'BidOffer.status' => 2, 'RequestPart.user_id' => $user['user_id']),
			)),
			'fields' =>
			array('RequestPart.*', 'RequestAccessory.*', 'BidOffer.*'),
			'order' =>
			array('RequestPart.request_id' => 'desc'),
		);
		$this->Paginator->settings = $options;
		$this->set('requestParts', $this->Paginator->paginate());
		$this->layout = "offer_losing";
	}
	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null)
	{
		if (!$this->RequestPart->exists($id)) {
			throw new NotFoundException(__('Invalid request part'));
		}
		$options = array('conditions' => array('RequestPart.' . $this->RequestPart->primaryKey => $id));
		$this->set('requestPart', $this->RequestPart->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		$this->loadModel('SalesBrand');
		$brandlist = array('' => '-Choose Brand-');
		$brandlist += $this->SalesBrand->find('list', array('fields' => array('SalesBrand.brand_id', 'SalesBrand.brand_name'), 'conditions' => array('SalesBrand.flag' => 0, 'status' => 1), 'order' => array('SalesBrand.brand_name' => 'asc')));
		$this->set('brandlist', $brandlist);

		$this->loadModel('MasterCountry');
		$countylist = array('' => '-Choose region-');
		$countylist += $this->MasterCountry->find('list', array('fields' => array('country_id', 'country_name'), 'order' => array('country_name' => 'asc')));
		$this->set('countylist', $countylist);

		$this->loadModel('PostAd');
		$adList = array('' => '--Select--');
		$adList += $this->PostAd->find('list', array('fields' => array('PostAd.adv_id', 'PostAd.adv_name'), 'conditions' => array('PostAd.adv_status' => 1), 'order' => array('PostAd.adv_name' => 'asc')));
		$this->set('adList', $adList);

		if ($this->request->is('post')) {
			/*$paymentmodearr=array_filter($this->request->data['RequestPart']['payment_mode']);
			$personal_teaching=$this->request->data['RequestPart']['personal_teaching'];
			$courier=$this->request->data['RequestPart']['courier'];
			$romanian_mail=$this->request->data['RequestPart']['romanian_mail'];
			$courier_cost=$this->request->data['RequestPart']['courier_cost'];
			$romanian_mail_cost=$this->request->data['RequestPart']['romanian_mail_cost'];
			$free_courier=$this->request->data['RequestPart']['free_courier'];
			$free_romanian_mail=$this->request->data['RequestPart']['free_romanian_mail'];*/
			$this->request->data['RequestAccessory']['status'] = 1;

			$this->loadModel('MasterMessage');
			$successMsg = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 26)));
			$failMsg = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 27)));
			$yrBlank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 24)));
			$i_offerBlank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 25)));
			$invalidLogin = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 28)));
			$loginBlank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 29)));
			$paymentModeblank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 15)));
			$deliveryMethodBlank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 16)));
			$costBlank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 17)));
			if ($this->request->data['RequestAccessory']['name_piece'] == '') {
				$this->Session->setFlash(__('<div class="alert alert-danger">Titlu articol Trebuie să fie completați</div>'));
			} else if ($this->request->data['RequestAccessory']['description'] == '') {
				$this->Session->setFlash(__('<div class="alert alert-danger">Descriere piese de scriere</div>'));
			} else {
				if (!$this->Session->check('User')) {
					if (isset($this->request->data['MasterUser']['user_login_id'])) {
						$useremail = $this->request->data['MasterUser']['user_login_id'];
						$userpass = $this->request->data['MasterUser']['user_pass'];
						$this->loadModel('MasterUser');
						$user_count = $this->MasterUser->find('first', array('conditions' => array('MasterUser.email' => $useremail, 'MasterUser.pass' => md5($userpass), 'is_active' => 1)));
						if (count($user_count) > 0) {
							$this->Session->write('User', $user_count['MasterUser']);
							$this->request->data['RequestPart']['user_id'] = $user_count['MasterUser']['user_id'];

							$this->RequestPart->create();
							$year = $this->request->data['RequestPart']['yr_of_manufacture'];
							$year = intval($year);
							$currentyr = date("Y");
							$currentyr = intval($currentyr);
							$oldyr = date("1900");
							$oldyr = intval($oldyr);

							if ($year < $oldyr || $year > $currentyr) {
								$this->Session->setFlash(__('<div class="alert alert-danger">' . $yrBlank['MasterMessage']['msg'] . '</div>'));
							} else {
								$this->request->data['RequestPart']['status'] = 1;
								if ($this->RequestPart->save($this->request->data)) {
									$insertid = $this->RequestPart->getLastInsertId();
									$this->loadModel('RequestAccessory');
									$this->request->data['RequestAccessory']['request_id'] = $insertid;


									if ($this->request->data['RequestAccessory']['name_piece'] != '') {
										$this->request->data['RequestAccessory']['slug'] = $this->Dez->slugGenerate($this->request->data['RequestAccessory']['name_piece']);
										$this->RequestAccessory->create();
										if ($this->RequestAccessory->save($this->request->data)) {
											$requestinsertid = $this->RequestAccessory->getLastInsertId();
											$this->loadModel('RequestTempImg');
											$clientip = $this->RequestHandler->getClientIp();
											$seqno = 1;
											$req_temp_img = $this->RequestTempImg->find('all', array('conditions' => array('seqno IN' => array(1, 2, 3, 4, 5), 'ip_address' => $clientip)));
											// pr($req_temp_img);
											if (!empty($req_temp_img)) {
												$this->loadModel('RequestImg');
												foreach ($req_temp_img as $req_img_res) {
													$img_path = $req_img_res['RequestTempImg']['img_path'];
													$seq_no = $req_img_res['RequestTempImg']['seqno'];
													copy(WWW_ROOT . 'files/tempfile/' . $img_path, WWW_ROOT . 'files/requestpart/' . $img_path);

													$resizeObj = new resize(WWW_ROOT . 'files/requestpart/' . $img_path);
													$resizeObj->resizeImage(160, 100, 'crop');
													$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/160X100_' . $img_path, 90);

													$resizeObj->resizeImage(140, 80, 'crop');
													$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/140X80_' . $img_path, 90);

													$resizeObj->resizeImage(128, 120, 'crop');
													$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/128X120_' . $img_path, 90);

													$resizeObj->resizeImage(150, 150, 'crop');
													$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/150X150_' . $img_path, 90);



													$this->RequestImg->create();
													$imgsv = $this->RequestImg->save(array('parts_id' => $requestinsertid, 'img_path' => $img_path, 'seq_no' => $seq_no));
													if ($imgsv) {
														$this->loadModel('RequestTempImg');
														$this->RequestTempImg->delete($req_img_res['RequestTempImg']['id']);
														@unlink(WWW_ROOT . 'files/tempfile/' . $img_path);
													}
												}
											}
											/* $this->loadModel('Notice');
										$this->Notice->save(array('notice_type' => 'request-parts', 'postid' => $requestinsertid, 'notice_name' => 'Reaquest Parts'));*/
											$sessionUser = $this->Session->read('User');
											$this->loadModel('Notice');
											$this->Notice->create();
											$this->Notice->save(array('notice_type' => 'request-parts', 'postid' => $requestinsertid, 'notice_name' => 'Reaquest Parts'));
											$this->Notice->create();
											$this->Notice->save(array('notice_type' => 'request-parts', 'postid' => $requestinsertid, 'notice_name' => 'Reaquest Parts', 'user_id' => $sessionUser['user_id']));


											//===========Subscribe mail alert==========
											$this->loadModel('SubscribeAlert');
											$alertResults = $this->SubscribeAlert->find('all', array('order' => array('alert_id' => 'desc')));
											//echo "<pre>";print_r($alertResult);exit();
											if (!empty($alertResults)) {
												//=====Post Ad Detail===========
												$this->loadModel('RequestAccessory');
												$apostDetail = $this->RequestAccessory->find('first', array('conditions' => array('part_id' => $requestinsertid)));

												//print_r($apostDetail);exit();
												//==============================
												$sessDetail = $this->Session->read('User');
												foreach ($alertResults as $alertResult) {

													if ($alertResult['SubscribeAlert']['is_request'] == 1) {
														$alertUserid = $alertResult['SubscribeAlert']['user_id'];

														$alertBrand_list = $alertResult['SubscribeAlert']['brand_list'];
														if (!empty($alertBrand_list)) {
															$alertbrandArray = explode(",", $alertBrand_list);
														} else {
															$alertbrandArray = array();
														}
														$alertCategories = $alertResult['SubscribeAlert']['categories'];
														if (!empty($alertCategories)) {
															$alertCatArray = explode(",", $alertCategories);
														} else {
															$alertCatArray = array();
														}

														$alertCouties = $alertResult['SubscribeAlert']['couties'];
														if (!empty($alertCouties)) {
															$allertCountyArray = explode(",", $alertCouties);
														} else {
															$allertCountyArray = array();
														}

														if (in_array($this->request->data['RequestPart']['brand_id'], $alertbrandArray) && in_array($this->request->data['RequestPart']['county'], $allertCountyArray)) {
															if ($sessDetail['user_id'] != $alertUserid) {
																$this->loadModel('MasterUser');
																$userDetail = $this->MasterUser->find('first', array('conditions' => array('user_id' => $alertUserid)));

																//Mail Functionality start here==============
																$baseurl = 'http://' . $_SERVER['SERVER_NAME'] . Router::url('/');
																$adLink = '<a href="' . $baseurl . 'pages/request-parts/' . $apostDetail['RequestAccessory']['slug'] . '">Request Parts Detail</a>';
																$register_name = $userDetail['MasterUser']['first_name'] . ' ' . $userDetail['MasterUser']['last_name'];
																$usertemplateDetail = $this->Dez->BapCustUniGetTemplate(15);
																$userSubject = stripslashes($usertemplateDetail['EmailTemplate']['mail_subject']);
																$messageBody = stripslashes($usertemplateDetail['EmailTemplate']['mail_body']);
																$messageBody = str_replace('{Name}', $register_name, $messageBody);
																$messageBody = str_replace('{RequestPartsLink}', $adLink, $messageBody);

																$to_email = $userDetail['MasterUser']['email'];
																$this->loadModel('AdminUser');
																$siteemail = $this->AdminUser->find('first', array('AdminUser.uid' => 2));
																if (!empty($siteemail)) {
																	$adminemail = $siteemail['AdminUser']['mail_id'];
																} else {
																	$adminemail = 'info@dezmembraripenet.com';
																}
																//$adminemail="chittas970@gmail.com";
																//echo $messageBody;exit();
																$Email = new CakeEmail('default');

																$Email->to($to_email);

																$Email->subject($userSubject);

																$Email->replyTo($adminemail);

																$Email->from(array($adminemail => 'Dezmembraripenet'));

																$Email->emailFormat('both');

																//$Email->headers();

																$Email->send($messageBody);
																//==============================================================

															}
														}
													}
												}
											}
											//===========Subscribe mail alert end==========

										}
									}


									$this->Session->setFlash(__('<div class="alert alert-success">' . $successMsg['MasterMessage']['msg'] . '</div>'));
									//return $this->redirect(array('action' => 'index'));
									unset($this->request->data);
								} else {
									$this->Session->setFlash(__('<div class="alert alert-danger">' . $failMsg['MasterMessage']['msg'] . '</div>'));
								}
							}
						} else {
							$this->Session->setFlash(__('<div class="alert alert-danger">' . $invalidLogin['MasterMessage']['msg'] . '</div>'));
							$this->set('openlogin', 'yes');
						}
					} else {
						$this->Session->setFlash(__('<div class="alert alert-danger">' . $loginBlank['MasterMessage']['msg'] . '</div>'));
						//return $this->redirect(array('action' => 'add/#openlogin'));
						$this->set('openlogin', 'yes');
					}
				} else {
					$user = $this->Session->read('User');
					$this->request->data['RequestPart']['user_id'] = $user['user_id'];
					//echo "<pre>";print_r($this->request->data['RequestAccessory']);exit;
					$this->RequestPart->create();
					//echo "<pre>";print_r($this->request->data);exit;
					//$i_offer=array_filter($this->request->data['RequestPart']['i_offer_parts']);
					$year = $this->request->data['RequestPart']['yr_of_manufacture'];
					$year = intval($year);
					$currentyr = date("Y");
					$currentyr = intval($currentyr);
					$oldyr = date("1900");
					$oldyr = intval($oldyr);

					if ($year < $oldyr || $year > $currentyr) {
						$this->Session->setFlash(__('<div class="alert alert-danger">' . $yrBlank['MasterMessage']['msg'] . '</div>'));
					}
					/*else if(empty($i_offer))
				{
					$this->Session->setFlash(__('<div class="alert alert-danger">'.$i_offerBlank['MasterMessage']['msg'].'</div>'));
				}*/
					/*else if(in_array(1,$nameblank))
				{
					$this->Session->setFlash(__('Enter Name Piece'));
				}*/ else {
						$this->request->data['RequestPart']['status'] = 1;
						//$this->request->data['RequestPart']['i_offer_parts']=implode(",", $this->request->data['RequestPart']['i_offer_parts']);
						if ($this->RequestPart->save($this->request->data)) {
							$insertid = $this->RequestPart->getLastInsertId();

							$this->loadModel('RequestAccessory');
							$this->request->data['RequestAccessory']['request_id'] = $insertid;
							if ($this->request->data['RequestAccessory']['name_piece'] != '') {
								$this->request->data['RequestAccessory']['slug'] = $this->Dez->slugGenerate($this->request->data['RequestAccessory']['name_piece']);
								$this->RequestAccessory->create();
								if ($this->RequestAccessory->save($this->request->data)) {
									$requestinsertid = $this->RequestAccessory->getLastInsertId();
									$this->loadModel('RequestTempImg');
									$clientip = $this->RequestHandler->getClientIp();
									$seqno = 1;
									$req_temp_img = $this->RequestTempImg->find('all', array('conditions' => array('seqno IN' => array(1, 2, 3, 4, 5), 'ip_address' => $clientip)));
									// pr($req_temp_img);
									if (!empty($req_temp_img)) {
										$this->loadModel('RequestImg');
										foreach ($req_temp_img as $req_img_res) {
											$img_path = $req_img_res['RequestTempImg']['img_path'];
											$seq_no = $req_img_res['RequestTempImg']['seqno'];
											copy(WWW_ROOT . 'files/tempfile/' . $img_path, WWW_ROOT . 'files/requestpart/' . $img_path);
											$resizeObj = new resize(WWW_ROOT . 'files/requestpart/' . $img_path);
											$resizeObj->resizeImage(160, 100, 'crop');
											$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/160X100_' . $img_path, 90);

											$resizeObj->resizeImage(140, 80, 'crop');
											$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/140X80_' . $img_path, 90);

											$resizeObj->resizeImage(128, 120, 'crop');
											$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/128X120_' . $img_path, 90);

											$resizeObj->resizeImage(150, 150, 'crop');
											$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/150X150_' . $img_path, 90);


											$this->RequestImg->create();
											$imgsv = $this->RequestImg->save(array('parts_id' => $requestinsertid, 'img_path' => $img_path, 'seq_no' => $seq_no));
											if ($imgsv) {
												$this->loadModel('RequestTempImg');
												$this->RequestTempImg->delete($req_img_res['RequestTempImg']['id']);
												@unlink(WWW_ROOT . 'files/tempfile/' . $img_path);
											}
										}
									}

									$sessionUser = $this->Session->read('User');
									$this->loadModel('Notice');
									$this->Notice->create();
									$this->Notice->save(array('notice_type' => 'request-parts', 'postid' => $requestinsertid, 'notice_name' => 'Reaquest Parts'));
									$this->Notice->create();
									$this->Notice->save(array('notice_type' => 'request-parts', 'postid' => $requestinsertid, 'notice_name' => 'Reaquest Parts', 'user_id' => $sessionUser['user_id']));


									//===========Subscribe mail alert==========
									$this->loadModel('SubscribeAlert');
									$alertResults = $this->SubscribeAlert->find('all', array('order' => array('alert_id' => 'desc')));
									//echo "<pre>";print_r($alertResult);exit();
									if (!empty($alertResults)) {
										//=====Post Ad Detail===========
										$this->loadModel('RequestAccessory');
										$apostDetail = $this->RequestAccessory->find('first', array('conditions' => array('part_id' => $requestinsertid)));

										//print_r($apostDetail);exit();
										//==============================
										$sessDetail = $this->Session->read('User');
										foreach ($alertResults as $alertResult) {
											$alertUserid = $alertResult['SubscribeAlert']['user_id'];

											$alertBrand_list = $alertResult['SubscribeAlert']['brand_list'];
											if (!empty($alertBrand_list)) {
												$alertbrandArray = explode(",", $alertBrand_list);
											} else {
												$alertbrandArray = array();
											}
											$alertCategories = $alertResult['SubscribeAlert']['categories'];
											if (!empty($alertCategories)) {
												$alertCatArray = explode(",", $alertCategories);
											} else {
												$alertCatArray = array();
											}

											$alertCouties = $alertResult['SubscribeAlert']['couties'];
											if (!empty($alertCouties)) {
												$allertCountyArray = explode(",", $alertCouties);
											} else {
												$allertCountyArray = array();
											}

											if (in_array($this->request->data['RequestPart']['brand_id'], $alertbrandArray) && in_array($this->request->data['RequestPart']['county'], $allertCountyArray)) {
												if ($sessDetail['user_id'] != $alertUserid) {
													$this->loadModel('MasterUser');
													$userDetail = $this->MasterUser->find('first', array('conditions' => array('user_id' => $alertUserid)));

													//Mail Functionality start here==============
													$baseurl = 'http://' . $_SERVER['SERVER_NAME'] . Router::url('/');
													$adLink = '<a href="' . $baseurl . 'pages/request-parts/' . $apostDetail['RequestAccessory']['slug'] . '">Request Parts Detail</a>';
													$register_name = $userDetail['MasterUser']['first_name'] . ' ' . $userDetail['MasterUser']['last_name'];
													$usertemplateDetail = $this->Dez->BapCustUniGetTemplate(15);
													$userSubject = stripslashes($usertemplateDetail['EmailTemplate']['mail_subject']);
													$messageBody = stripslashes($usertemplateDetail['EmailTemplate']['mail_body']);
													$messageBody = str_replace('{Name}', $register_name, $messageBody);
													$messageBody = str_replace('{RequestPartsLink}', $adLink, $messageBody);

													$to_email = $userDetail['MasterUser']['email'];
													$this->loadModel('AdminUser');
													$siteemail = $this->AdminUser->find('first', array('AdminUser.uid' => 2));
													if (!empty($siteemail)) {
														$adminemail = $siteemail['AdminUser']['mail_id'];
													} else {
														$adminemail = 'info@dezmembraripenet.com';
													}
													//$adminemail="chittas970@gmail.com";
													//echo $messageBody;exit();
													$Email = new CakeEmail('default');

													$Email->to($to_email);

													$Email->subject($userSubject);

													$Email->replyTo($adminemail);

													$Email->from(array($adminemail => 'Dezmembraripenet'));

													$Email->emailFormat('both');

													//$Email->headers();

													$Email->send($messageBody);
													//==============================================================

												}
											}
										}
									}
									//===========Subscribe mail alert end==========

								}
							}
							$this->Session->setFlash(__('<div class="alert alert-success">' . $successMsg['MasterMessage']['msg'] . '</div>'));
							//return $this->redirect(array('action' => 'index'));
							unset($this->request->data);
						} else {
							$this->Session->setFlash(__('<div class="alert alert-danger">' . $failMsg['MasterMessage']['msg'] . '</div>'));
						}
					}
				}
			}
		}
		$this->layout = 'request_add';
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null, $partid = '')
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		if (!$this->RequestPart->exists($id)) {
			throw new NotFoundException(__('Invalid request part'));
		}
		$this->loadModel('SalesBrand');
		$brandlist = array('' => '-Choose Brand-');
		$brandlist += $this->SalesBrand->find('list', array('fields' => array('SalesBrand.brand_id', 'SalesBrand.brand_name'), 'conditions' => array('SalesBrand.flag' => 0, 'status' => 1), 'order' => array('SalesBrand.brand_name' => 'asc')));
		$this->set('brandlist', $brandlist);

		$this->loadModel('MasterCountry');
		$countylist = array('' => '-Choose region-');
		$countylist += $this->MasterCountry->find('list', array('fields' => array('country_id', 'country_name'), 'order' => array('country_name' => 'asc')));
		$this->set('countylist', $countylist);
		$this->loadModel('PostAd');
		$adList = array('' => '--Select--');
		$adList += $this->PostAd->find('list', array('fields' => array('PostAd.adv_id', 'PostAd.adv_name'), 'conditions' => array('PostAd.adv_status' => 1), 'order' => array('PostAd.adv_name' => 'asc')));
		$this->set('adList', $adList);
		if ($this->request->is(array('post', 'put'))) {
			//pr($this->request->data);exit;
			$this->loadModel('MasterMessage');
			$successMsg = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 30)));
			$failMsg = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 31)));
			$yrBlank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 24)));
			$i_offerBlank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 25)));
			$paymentModeblank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 15)));
			$deliveryMethodBlank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 16)));
			$costBlank = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 17)));

			$user = $this->Session->read('User');
			$this->request->data['RequestPart']['user_id'] = $user['user_id'];
			//echo "<pre>";print_r($this->request->data['RequestAccessory']);exit;
			//$this->RequestPart->create();
			//echo "<pre>";print_r($this->request->data);exit;
			//$i_offer=array_filter($this->request->data['RequestPart']['i_offer_parts']);
			$year = $this->request->data['RequestPart']['yr_of_manufacture'];
			$year = intval($year);
			$currentyr = date("Y");
			$currentyr = intval($currentyr);
			$oldyr = date("1900");
			$oldyr = intval($oldyr);
			if ($year < $oldyr || $year > $currentyr) {
				$this->Session->setFlash(__('<div class="alert alert-danger">' . $yrBlank['MasterMessage']['msg'] . '</div>'));
			} else if ($this->request->data['RequestAccessory']['name_piece'] == '') {
				$this->Session->setFlash(__('<div class="alert alert-danger">Titlu articol Trebuie să fie completați</div>'));
			} else if ($this->request->data['RequestAccessory']['description'] == '') {
				$this->Session->setFlash(__('<div class="alert alert-danger">Descriere piese de scriere</div>'));
			} else {
				if ($this->RequestPart->save($this->request->data)) {
					$this->loadModel('RequestAccessory');
					$this->request->data['RequestAccessory']['request_id'] = $this->request->data['RequestPart']['request_id'];
					if ($this->request->data['RequestAccessory']['name_piece'] != '') {
						//echo $this->request->data['RequestAccessory']['part_id'];exit;
						$this->request->data['RequestAccessory']['slug'] = $this->Dez->slugGenerate($this->request->data['RequestAccessory']['name_piece'], $this->request->data['RequestAccessory']['part_id']);
						if ($this->RequestAccessory->save($this->request->data)) {
							$requestinsertid = $partid;
							$this->loadModel('RequestTempImg');
							$clientip = $this->RequestHandler->getClientIp();
							$seqno = 1;
							$req_temp_img = $this->RequestTempImg->find('all', array('conditions' => array('seqno IN' => array(1, 2, 3, 4, 5), 'ip_address' => $clientip)));
							// pr($req_temp_img);
							if (!empty($req_temp_img)) {
								$this->loadModel('RequestImg');
								foreach ($req_temp_img as $req_img_res) {
									$img_path = $req_img_res['RequestTempImg']['img_path'];
									$seq_no = $req_img_res['RequestTempImg']['seqno'];
									copy(WWW_ROOT . 'files/tempfile/' . $img_path, WWW_ROOT . 'files/requestpart/' . $img_path);
									$resizeObj = new resize(WWW_ROOT . 'files/requestpart/' . $img_path);
									$resizeObj->resizeImage(160, 100, 'crop');
									$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/160X100_' . $img_path, 90);

									$resizeObj->resizeImage(140, 80, 'crop');
									$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/140X80_' . $img_path, 90);

									$resizeObj->resizeImage(128, 120, 'crop');
									$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/128X120_' . $img_path, 90);

									$resizeObj->resizeImage(150, 150, 'crop');
									$resizeObj->saveImage(WWW_ROOT . 'files/requestpart/150X150_' . $img_path, 90);




									$this->RequestImg->create();
									$imgsv = $this->RequestImg->save(array('parts_id' => $requestinsertid, 'img_path' => $img_path, 'seq_no' => $seq_no));
									if ($imgsv) {
										$this->loadModel('RequestTempImg');
										$this->RequestTempImg->delete($req_img_res['RequestTempImg']['id']);
										@unlink(WWW_ROOT . 'files/tempfile/' . $img_path);
									}
								}
							}
							/*$this->loadModel('Notice');
										$this->Notice->save(array('notice_type' => 'request-modified', 'postid' =>$partid, 'notice_name' => 'Reaquest Parts'));*/
							$sessionUser = $this->Session->read('User');
							$this->loadModel('Notice');
							$this->Notice->create();
							$this->Notice->save(array('notice_type' => 'request-modified', 'postid' => $partid, 'notice_name' => 'Reaquest Parts'));
							$this->Notice->create();
							$this->Notice->save(array('notice_type' => 'request-modified', 'postid' => $partid, 'notice_name' => 'Reaquest Parts', 'user_id' => $sessionUser['user_id']));
						}
					}
					$this->Session->setFlash(__('<div class="alert alert-success">' . $successMsg['MasterMessage']['msg'] . '</div>'));
					//return $this->redirect(array('action' => 'index'));
					//unset($this->request->data);
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger">' . $failMsg['MasterMessage']['msg'] . '</div>'));
				}
			}
		} else {
			$options = array('conditions' => array('RequestPart.' . $this->RequestPart->primaryKey => $id));

			$this->request->data = $this->RequestPart->find('first', $options);
			$this->loadModel('RequestAccessory');
			$acceoptions = array('conditions' => array('RequestAccessory.request_id' => $id));
			$acceresult = $this->RequestAccessory->find('first', $acceoptions);
			//pr($acceres);exit;
			//pr($acceres);
			if (!empty($acceresult)) {

				if ($partid == $acceresult['RequestAccessory']['part_id']) {
					$this->request->data['RequestAccessory']['name_piece'] = $acceresult['RequestAccessory']['name_piece'];
					$this->request->data['RequestAccessory']['description'] = $acceresult['RequestAccessory']['description'];
					$this->request->data['RequestAccessory']['part_id'] = $acceresult['RequestAccessory']['part_id'];
				}
			}
		}
		$this->layout = 'request_add';
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null)
	{
		$this->RequestPart->id = $id;
		if (!$this->RequestPart->exists()) {
			throw new NotFoundException(__('Invalid request part'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RequestPart->delete()) {
			$this->Session->setFlash(__('The request part has been deleted.'));
		} else {
			$this->Session->setFlash(__('The request part could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	/**
	 * Model data onload on brand method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function modeldata()
	{
		$optionval = '<option value="">-Choose the model-</option>';
		if ($this->request->is('post')) {
			if (isset($this->request->data['brandid'])) {
				$brandid = $this->request->data['brandid'];
				//====To Create a dynamic select box=======
				$this->loadModel('SalesBrand');
				$brandres = $this->SalesBrand->find('all', array('conditions' => array('flag' => $brandid, 'status' => 1), 'fields' => array('brand_id', 'brand_name'), 'order' => array('brand_name' => 'asc')));

				if (!empty($brandres)) {

					foreach ($brandres as $brandResult) {
						$optionval .= '<option value="' . $brandResult['SalesBrand']['brand_id'] . '">' . $brandResult['SalesBrand']['brand_name'] . '</option>';
					}
				}
				//==========End Here===========================
			}
			echo $optionval;
		}
		exit();
	}
	/**
	 * Model Get method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function modelget($brandid = null)
	{
		$this->loadModel('SalesBrand');
		$modellist = array('' => '-Choose the model-');
		$modellist += $this->SalesBrand->find('list', array('fields' => array('brand_id', 'brand_name'), 'conditions' => array('flag' => $brandid, 'status' => 1), 'order' => array('brand_name' => 'asc')));
		return ($modellist);
	}
	/**
	 * City data onload on county method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function citydata()
	{
		$optionval = '<option value="">-' . CHOOSECITY . '-</option>';
		if ($this->request->is('post')) {
			if (isset($this->request->data['countyid'])) {
				$countyid = $this->request->data['countyid'];
				//====To Create a dynamic select box=======
				$this->loadModel('MasterLocation');
				$locationres = $this->MasterLocation->find('all', array('conditions' => array('country_id' => $countyid), 'fields' => array('location_id', 'location_name'), 'order' => array('location_name' => 'asc')));

				if (!empty($locationres)) {

					foreach ($locationres as $locationResult) {
						$optionval .= '<option value="' . $locationResult['MasterLocation']['location_id'] . '">' . $locationResult['MasterLocation']['location_name'] . '</option>';
					}
				}
				//==========End Here===========================
			}
			echo $optionval;
		}
		exit();
	}
	/**
	 * City Get method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function cityget($countyid = null)
	{
		$this->loadModel('MasterLocation');
		$citylist = array('' => '.CHOOSECITY.');
		$citylist += $this->MasterLocation->find('list', array('fields' => array('location_id', 'location_name'), 'conditions' => array('country_id' => $countyid), 'order' => array('location_name' => 'asc')));
		return ($citylist);
	}
	/**
	 * File Upload method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */

	public function fileupload()
	{
		$this->loadModel('RequestTempImg');
		if ($this->request->is('post')) {
			if (count($this->request->data['RequestPart']['part_img']) > 0) {
				foreach ($this->request->data['RequestPart']['part_img'] as $allimg) {
					//echo 1;
					if ($allimg['name'] != '') {
						$filename = time() . $allimg['name'];
						$filename = $this->Dez->CleanFilePath($filename);
						//$filename=$this->Ikm->CleanFilePath($filename);
						// echo $filename;exit;
						move_uploaded_file($allimg['tmp_name'], WWW_ROOT . 'files/tempfile/' . $filename);
						$this->request->data['RequestTempImg']['img_path'] = $filename;
					} else {
						$this->request->data['RequestTempImg']['img_path'] = '';
					}
					$this->request->data['RequestTempImg']['ip_address'] = $this->RequestHandler->getClientIp();
					$this->request->data['RequestTempImg']['seqno'] = $this->request->data['RequestPart']['seqno'];
					$this->RequestTempImg->create();
					$save = $this->RequestTempImg->save($this->request->data);
				}
			}
		}
		$imgcontent = '';
		if (isset($this->request->params['named']['seqno']) && !isset($this->request->params['named']['partsid'])) {
			$clientip = $this->RequestHandler->getClientIp();
			$seqno = $this->request->params['named']['seqno'];
			$req_temp_img = $this->RequestTempImg->find('all', array('conditions' => array('seqno' => $seqno, 'ip_address' => $clientip)));
			// pr($req_temp_img);
			if (!empty($req_temp_img)) {
				$imgcontent = '<ul class="iframe_list">';
				foreach ($req_temp_img as $req_img_res) {
					$temp = "'temp'";
					$imgcontent .= '<li id="imgtemp' . $req_img_res['RequestTempImg']['id'] . '"><img src="' . Router::url('/', true) . 'files/tempfile/' . $req_img_res['RequestTempImg']['img_path'] . '"><button type="button" onclick="removedata(' . $req_img_res['RequestTempImg']['id'] . ',' . $temp . ')">X</button></li>';
				}
				$imgcontent .= '</ul>';
			}
		} else if (isset($this->request->params['named']['seqno']) && isset($this->request->params['named']['partsid'])) {
			$partid = $this->request->params['named']['partsid'];
			$seqno = $this->request->params['named']['seqno'];
			$this->loadModel('RequestImg');
			$RequestImgres = $this->RequestImg->find('all', array('conditions' => array('parts_id' => $partid, 'seq_no' => $seqno)));
			// pr($req_temp_img);
			if (!empty($RequestImgres)) {

				$imgcontent = '<ul class="iframe_list">';
				foreach ($RequestImgres as $RequestImgresult) {
					$temp = "'original'";
					$imgcontent .= '<li id="imgoriginal' . $RequestImgresult['RequestImg']['img_id'] . '"><img src="' . Router::url('/', true) . 'files/requestpart/' . $RequestImgresult['RequestImg']['img_path'] . '"><button type="button" onclick="removedata(' . $RequestImgresult['RequestImg']['img_id'] . ',' . $temp . ')">X</button></li>';
				}
				$imgcontent .= '</ul>';
			} else {
				$clientip = $this->RequestHandler->getClientIp();
				$seqno = $this->request->params['named']['seqno'];
				$req_temp_img = $this->RequestTempImg->find('all', array('conditions' => array('seqno' => $seqno, 'ip_address' => $clientip)));
				// pr($req_temp_img);
				if (!empty($req_temp_img)) {
					$imgcontent = '<ul class="iframe_list">';
					foreach ($req_temp_img as $req_img_res) {
						$temp = "'temp'";
						$imgcontent .= '<li id="imgtemp' . $req_img_res['RequestTempImg']['id'] . '"><img src="' . Router::url('/', true) . 'files/tempfile/' . $req_img_res['RequestTempImg']['img_path'] . '"><button type="button" onclick="removedata(' . $req_img_res['RequestTempImg']['id'] . ',' . $temp . ')">X</button></li>';
					}
					$imgcontent .= '</ul>';
				}
			}
		}
		// echo $imgcontent;exit;
		$this->set('imgContent', $imgcontent);
		$this->layout = "fileupload";
	}
	public function removeimg()
	{
		$imgid = $this->request->data['imgid'];
		$imgtype = $this->request->data['img_fold'];
		if ($imgid != '') {
			if ($imgtype == "temp") {
				$this->loadModel('RequestTempImg');
				$imgdetail = $this->RequestTempImg->find('first', array('id' => $imgid));
				if (!empty($imgdetail)) {
					//echo $imgid;
					$this->loadModel('RequestTempImg');
					if ($this->RequestTempImg->delete($imgid)) {
						@unlink(WWW_ROOT . 'files/tempfile/' . $imgdetail['RequestTempImg']['img_path']);
						echo 1;
					}
				}
			} else if ($imgtype == "original") {
				$this->loadModel('RequestImg');
				$imgdetail = $this->RequestImg->find('first', array('img_id' => $imgid));
				@unlink(WWW_ROOT . 'files/requestpart/' . $imgdetail['RequestImg']['img_path']);
				$this->RequestImg->delete($imgid);
				echo 1;
			}
		}
		exit;
	}
	public function fetchimg()
	{
		$imgcontent = '';
		if (isset($this->request->params['named']['seqno'])) {
			$clientip = $this->RequestHandler->getClientIp();
			$seqno = $this->request->params['named']['seqno'];
			$req_temp_img = $this->RequestTempImg->find('all', array('conditions' => array('seqno' => $seqno, 'ip_address' => $clientip)));
			// pr($req_temp_img);
			if (!empty($req_temp_img)) {
				$imgcontent = '<ul class="iframe_list">';
				foreach ($req_temp_img as $req_img_res) {
					$temp = "'temp'";
					$imgcontent .= '<li id="imgtemp' . $req_img_res['RequestTempImg']['id'] . '"><img src="' . Router::url('/', true) . 'files/tempfile/' . $req_img_res['RequestTempImg']['img_path'] . '"><button type="button" onclick="removedata(' . $req_img_res['RequestTempImg']['id'] . ',' . $temp . ')">X</button></li>';
				}
				$imgcontent .= '</ul>';
			}
		}
		return ($imgcontent);
	}
	public function originalImg($partid)
	{
		$imgcontent = '';
		$this->loadModel('RequestImg');
		$RequestImgres = $this->RequestImg->find('all', array('conditions' => array('parts_id' => $partid)));
		// pr($req_temp_img);
		if (!empty($RequestImgres)) {

			$imgcontent = '<ul class="iframe_list">';
			foreach ($RequestImgres as $RequestImgresult) {
				$temp = "'original'";
				$imgcontent .= '<li id="imgoriginal' . $RequestImgresult['RequestImg']['img_id'] . '"><img src="' . Router::url('/', true) . 'files/requestpart/' . $RequestImgresult['RequestImg']['img_path'] . '"><button type="button" onclick="removedata(' . $RequestImgresult['RequestImg']['img_id'] . ',' . $temp . ')">X</button></li>';
			}
			$imgcontent .= '</ul>';
		}
		return ($imgcontent);
	}
	/**
	 * Bid Offers File Upload method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */

	public function bidupload($partsid = '')
	{
		$this->loadModel('BidTempFile');
		if ($this->request->is('post')) {
			if ($this->Session->check('User')) {
				if (count($this->request->data['BidTempFile']['img_pth']) > 0) {
					foreach ($this->request->data['BidTempFile']['img_pth'] as $allimg) {
						//echo 1;
						if ($allimg['name'] != '') {
							$filename = time() . $allimg['name'];
							$filename = $this->Dez->CleanFilePath($filename);
							//$filename=$this->Ikm->CleanFilePath($filename);
							// echo $filename;exit;
							move_uploaded_file($allimg['tmp_name'], WWW_ROOT . 'files/tempfile/' . $filename);
							$this->request->data['BidTempFile']['img_pth'] = $filename;
						} else {
							$this->request->data['BidTempFile']['img_pth'] = '';
						}
						$this->request->data['BidTempFile']['ip_address'] = $this->RequestHandler->getClientIp();
						$this->request->data['BidTempFile']['parts_id'] = $partsid;
						$this->request->data['BidTempFile']['seq_no'] = $this->request->params['named']['seqno'];
						if ($this->Session->check('User')) {
							$user = $this->Session->read('User');
							$this->request->data['BidTempFile']['user_id'] = $user['user_id'];
						}

						$this->BidTempFile->create();
						$save = $this->BidTempFile->save($this->request->data);
					}
				}
			}
		}
		$imgcontent = '';
		if ($partsid) {
			if ($this->Session->check('User')) {
				$user = $this->Session->read('User');
				$userid = $user['user_id'];
			} else {
				$userid = '';
			}
			$clientip = $this->RequestHandler->getClientIp();
			$bid_temp_img = $this->BidTempFile->find('all', array('conditions' => array('parts_id' => $partsid, 'seq_no' => $this->request->params['named']['seqno'], 'ip_address' => $clientip, 'user_id' => $userid)));
			// pr($bid_temp_img);exit;
			if (!empty($bid_temp_img)) {
				$imgcontent = '<ul class="iframe_list">';
				foreach ($bid_temp_img as $bid_img_res) {
					$temp = "'temp'";
					$imgcontent .= '<li id="imgtemp' . $bid_img_res['BidTempFile']['temp_id'] . '"><img src="' . Router::url('/', true) . 'files/tempfile/' . $bid_img_res['BidTempFile']['img_pth'] . '"><button type="button" onclick="removedata(' . $bid_img_res['BidTempFile']['temp_id'] . ',' . $temp . ')">X</button></li>';
				}
				$imgcontent .= '</ul>';
			}
		}
		// echo $imgcontent;exit;
		$this->set('imgContent', $imgcontent);
		$this->layout = "fileupload";
	}
	public function removeBidImg()
	{
		$imgid = $this->request->data['imgid'];
		$imgtype = $this->request->data['img_fold'];
		if ($imgid != '') {
			if ($imgtype == "temp") {
				$this->loadModel('BidTempFile');
				$imgdetail = $this->BidTempFile->find('first', array('id' => $imgid));
				if (!empty($imgdetail)) {
					@unlink(WWW_ROOT . 'files/tempfile/' . $imgdetail['BidTempFile']['img_pth']);
					$this->BidTempFile->delete($imgid);
				}
				echo 1;
			} else if ($imgtype == "original") {
				$this->loadModel('BidImg');
				$imgdetail = $this->BidImg->find('first', array('img_id' => $imgid));
				@unlink(WWW_ROOT . 'files/bidimg/' . $imgdetail['BidImg']['img_path']);
				$this->BidImg->delete($imgid);
				echo 1;
			}
		}
		exit;
	}
	// offer bidding listing
	public function bidding()
	{
		if ($this->Session->check('User')) {


			$this->set('title_for_layout', 'Offer Bid');
			$this->loadModel('BidOffer');
			$user_id = $this->Session->read('User.user_id');
			//pr($user_id);exit;
			$options = array(
				'conditions' => array('BidOffer.user_id' => $user_id),
				'order' => array('BidOffer.bid_id' => 'desc')
			);
			$this->Paginator->settings = $options;
			$this->set('bidOffer', $this->Paginator->paginate('BidOffer'));


			$this->layout = 'bidding_list';
		} else {
			return $this->redirect(Router::url('/Logins/login', true));
		}
	}
	public function delete_bid()
	{
		$this->loadModel('BidOffer');
		//pr($this->request);exit;
		$id = $this->request->params['named']['id'];
		$this->BidOffer->id = $id;
		if (!$this->BidOffer->exists()) {
			throw new NotFoundException(__('Invalid Offer bid'));
		}

		//$this->request->onlyAllow('post', 'delete');
		if ($this->BidOffer->delete()) {
			$this->Session->setFlash(__('The Offer bid has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Offer bid could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'bidding'));
	}
	// view bid
	public function viewBid()
	{
		if ($this->Session->check('User')) {
			$this->set('title_for_layout', 'Offer Bid');
			$this->loadModel('BidOffer');
			$user_id = $this->Session->read('User.user_id');
			$bid_id = $this->request->params['named']['id'];
			//pr($user_id);exit;
			$bidOffer = $this->BidOffer->find('all', array('conditions' => array('BidOffer.user_id' => $user_id, 'BidOffer.bid_id' => $bid_id), 'order' => array('BidOffer.bid_id' => 'desc')));
			$this->set('bidOffer', $bidOffer);
			$this->layout = 'bidview';
		} else {
			return $this->redirect(Router::url('/Logins/login', true));
		}
	}

	// Request Question part	
	public function request_question()
	{
		if ($this->Session->check('User')) {
			$this->set('title_for_layout', 'Question On Offer');
			$this->loadModel('RequestQuestion');
			$user = $this->Session->read('User');
			$user_id = $user['user_id'];
			//pr($user_id);exit;
			$options = array(
				'joins' =>
				array(
					array(
						'table' => 'request_parts',
						'alias' => 'RequestPart',
						'type' => 'left',
						'foreignKey' => false,
						'conditions' => array('RequestPart.request_id = RequestQuestion.request_id')
					)
				),
				'conditions' => array('RequestPart.user_id' => $user_id, 'RequestQuestion.parent' => 0),
				'order' => array('RequestQuestion.question_id' => 'desc')
			);
			$this->Paginator->settings = $options;
			$this->set('RequestQuestion', $this->Paginator->paginate('RequestQuestion'));

			$this->layout = 'request_question';
		} else {
			return $this->redirect(Router::url('/Logins/login', true));
		}
	}
	/*
		View Reply Parts
		*/
	public function view_reply($parent)
	{
		if ($this->Session->check('User')) {
			$this->set('title_for_layout', 'View Reply');
			$this->loadModel('RequestQuestion');
			$user_id = $this->Session->read('User.user_id');
			//pr($user_id);exit;
			$options = array(
				'conditions' => array('RequestQuestion.user_id' => $user_id, 'RequestQuestion.parent' => $parent),
				'order' => array('RequestQuestion.question_id' => 'desc')
			);
			$this->Paginator->settings = $options;
			$this->set('RequestQuestion', $this->Paginator->paginate('RequestQuestion'));
			$this->set('qs_id', $parent);
			$this->layout = 'question_reply';
		} else {
			return $this->redirect(Router::url('/Logins/login', true));
		}
	}

	public function delete_question()
	{
		$this->loadModel('RequestQuestion');
		//pr($this->request);exit;
		$id = $this->request->params['named']['id'];
		$this->RequestQuestion->id = $id;
		if (!$this->RequestQuestion->exists()) {
			throw new NotFoundException(__('Invalid Offer bid'));
		}

		//$this->request->onlyAllow('post', 'delete');
		if ($this->RequestQuestion->delete()) {
			$this->Session->setFlash(__('The Question on Offer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Question on Offer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'request_question'));
	}
	public function request_response($req_id = null, $parts_id)
	{
		if (!$this->RequestPart->exists($req_id)) {
			throw new NotFoundException(__('Invalid request part'));
		}
		if ($this->Session->check('User')) {
			$this->loadModel('BidOffer');
			$this->loadModel('RequestPart');
			$this->set('title_for_layout', 'Request Response Details');
			/*$options=array( 'conditions' =>array('BidOffer.request_id'=>$req_id),
			'order' =>array('BidOffer.bid_id' => 'desc')
			);
			$this->Paginator->settings=$options;
			$this->set('bidOffer', $this->Paginator->paginate('BidOffer'));*/

			$user_resp = $this->BidOffer->find('all', array(
				'conditions' => array('BidOffer.parts_id' => $parts_id),
				'order' => array('BidOffer.bid_id' => 'desc')
			));
			$this->set('user_resp', $user_resp);
			$request_parts = $this->RequestPart->find('first', array('conditions' => array('RequestPart.request_id' => $req_id)));
			//pr($request_parts);
			$this->set('req_dtl', $request_parts['RequestPart']);
			$this->set('parts_id', $parts_id);


			$this->layout = 'request_response';
		} else {
			return $this->redirect(Router::url('/Logins/login', true));
		}
	}

	public function addReply()
	{
		$this->LoadModel('RequestQuestion');
		$this->request->data['RequestQuestion']['user_id'] = $this->Session->read('User.user_id');
			//pr($this->request->data['RequestQuestion']); exit;
		;
		if ($this->RequestQuestion->save($this->request->data)) {
			$this->Session->setFlash(__('<div class="alert alert-success">Reply added Sucessfully</div>'));
		} else {
			$this->Session->setFlash(__('<div class="alert alert-danger">Reply not Added.</div>'));
		}
		$this->redirect(array('controller' => 'RequestParts', 'action' => "request_response/" . $this->request->data['RequestQuestion']['request_id']));
		exit;
	}

	public function addReplyQuestion()
	{
		//pr($this->request);exit;
		$this->LoadModel('RequestQuestion');
		$this->request->data['RequestQuestion']['user_id'] = $this->Session->read('User.user_id');
		//pr($this->request->data['RequestQuestion']); exit;
		if ($this->RequestQuestion->save($this->request->data)) {
			$this->Session->setFlash(__('<div class="alert alert-success">Question added Sucessfully</div>'));
		} else {
			$this->Session->setFlash(__('<div class="alert alert-danger">Question not Added.</div>'));
		}
		$this->redirect(array('controller' => 'RequestParts', 'action' => "view_reply/" . $this->request->data['qs_id']));
		exit;
	}

	function change_bid_status()
	{
		$this->layout = 'ajax';
		$this->loadModel('BidOffer');
		//pr($this->request->data);
		$status = $this->request->data['status'];
		$bid_id = $this->request->data['bid_id'];
		$parts_id = $this->request->data['parts_id'];
		if ($status == 1) {
			$this->loadModel('RequestAccessory');
			$this->RequestAccessory->id = $parts_id;
			$this->RequestAccessory->saveField('status', 2);
		}
		$this->BidOffer->id = $bid_id;
		if ($this->BidOffer->saveField('status', $status)) {
			print 1;
		} else {
			print 2;
		}
		exit;
	}
	/**
	 * Bid offer question method
	 * Method Name: ask_seller
	 * @throws NotFoundException
	 * Author By: Chittaranjan
	 * @return void
	 */
	public function ask_seller()
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$this->loadModel('BidQuestion');
		$user = $this->Session->read('User');
		$this->set('title_for_layout', 'Ask Seller List');
		$this->BidQuestion->recursive = 0;
		//-------Active request parts list functionality----------------
		$options = array(
			'conditions' =>
			array('AND' => array(
				array('BidQuestion.status' => 1, 'BidQuestion.to_id' => $user['user_id']),
			)),
			'order' =>
			array('BidQuestion.qid' => 'desc'),
		);
		$this->Paginator->settings = $options;
		$this->set('bidQuestions', $this->Paginator->paginate('BidQuestion'));
		if ($this->request->is('post')) {
			if (isset($this->request->data['question'])) {
				$this->request->data['BidQuestion']['user_id'] = $user['user_id'];
				$this->loadModel('BidQuestion');
				if ($this->request->data['BidQuestion']['description'] == '') {
					$this->Session->setFlash(__('<div class="alert alert-danger">Write Question Detail</div>'));
				} else {
					//-----------------------------------------------------
					$this->loadModel('MasterMessage');
					$successMsg = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 66)));
					$failMsg = $this->MasterMessage->find('first', array('conditions' => array('msg_id' => 67)));

					//-------------------------------------------------------
					if ($this->BidQuestion->save($this->request->data)) {
						$this->Session->setFlash(__('<div class="alert alert-success">' . $successMsg['MasterMessage']['msg'] . '</div>'));
						unset($this->request->data);
					} else {
						$this->Session->setFlash(__('<div class="alert alert-danger">' . $failMsg['MasterMessage']['msg'] . '</div>'));
					}
				}
			}
		}
		$this->layout = "ask_seller";
	}
	/**
	 * Bid offer question sent list method
	 * Method Name: ask_seller_sent
	 * @throws NotFoundException
	 * Author By: Chittaranjan
	 * @return void
	 */
	public function ask_seller_sent()
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$this->loadModel('BidQuestion');
		$user = $this->Session->read('User');
		$this->set('title_for_layout', 'Ask Seller Sent List');
		$this->BidQuestion->recursive = 0;
		//-------Active request parts list functionality----------------
		$options = array(
			'conditions' =>
			array('AND' => array(
				array('BidQuestion.status' => 1, 'BidQuestion.user_id' => $user['user_id']),
			)),
			'order' =>
			array('BidQuestion.qid' => 'desc'),
		);
		$this->Paginator->settings = $options;
		$this->set('bidQuestions', $this->Paginator->paginate('BidQuestion'));
		$this->layout = "ask_seller";
	}
	public function deliverydetail($id = '')
	{
		$this->set('title_for_layout', 'Parts Order Detail');
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$this->loadModel('BidOffer');
		$bidDetail = $this->BidOffer->find('first', array('conditions' => array('bid_id' => $id)));
		$this->set('bidDetail', $bidDetail);
		if (!$this->BidOffer->exists($id)) {
			return $this->redirect(Router::url('/RequestParts/bidding', true));
		}
		$this->loadModel('PartsOrder');
		$partsOrders = $this->PartsOrder->find('first', array('conditions' => array('bid_id' => $id), 'order' => array('id' => 'desc')));
		if (empty($partsOrders)) {
			$this->Session->setFlash('<div class="alert alert-danger">Greșită Castigul Detalii</div>');
			return $this->redirect(Router::url('/RequestParts/bidding', true));
		}
		$this->set('partsOrders', $partsOrders);
		$this->layout = "parts_order_detail";
	}
	public function partsorder()
	{
		$this->set('title_for_layout', 'Your Parts Order');
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		$user = $this->Session->read('User');
		$this->loadModel('PartsOrder');
		$partsOrders = $this->PartsOrder->find('all', array('conditions' => array('user_id' => $user['user_id']), 'order' => array('id' => 'desc')));
		$this->set('partsOrders', $partsOrders);
		$this->layout = "parts_order_list";
	}
	public function cancel($requestID = '', $partsID = '')
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		if ($requestID != '') {
			$cancel = $this->RequestPart->save(array('request_id' => $requestID, 'status' => 3));
		}
		if ($partsID != '') {
			$this->loadModel('RequestAccessory');
			$partscancel = $this->RequestAccessory->save(array('part_id' => $partsID, 'status' => 0));
		}
		if ($cancel) {
			$this->Session->setFlash('<div class="alert alert-success">anulat cu succes</div>');
		} else {
			$this->Session->setFlash('<div class="alert alert-danger">anularea a eșuat</div>');
		}
		return $this->redirect(Router::url('/RequestParts', true));
	}
	public function activestatus($requestID = '', $partsID = '')
	{
		if (!$this->Session->check('User')) {
			return $this->redirect(Router::url('/', true));
		}
		if ($requestID != '') {
			$cancel = $this->RequestPart->save(array('request_id' => $requestID, 'status' => 1));
		}
		if ($partsID != '') {
			$this->loadModel('RequestAccessory');
			$partscancel = $this->RequestAccessory->save(array('part_id' => $partsID, 'status' => 1));
		}
		if ($cancel) {
			$this->Session->setFlash('<div class="alert alert-success">activat cu succes</div>');
		} else {
			$this->Session->setFlash('<div class="alert alert-danger">Activating Successfully</div>');
		}
		return $this->redirect(Router::url('/RequestParts', true));
	}
}
