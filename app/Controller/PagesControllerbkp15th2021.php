<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('resize', 'Vendor');
/*App::import('Vendor', 'Mailer', array('file' => 'Mailer/PHPMailer.php'));*/
//App::uses('AppHelper', 'View/Helper');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	public $components = array('Paginator', 'Session', 'Cookie', 'Dez','RequestHandler');
	// public $helpers = array('Dez');
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
	public function slugName($slug='',$postname='',$orderid='')
	{
								
		/*$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Dezmembraripenet<noreply@dezmembraripenet.ro>' . "\r\n";
		mail('chittas970@gmail.com', 'test custom mail', 'my content goes here',$headers);*/
		/*$mail = new PHPMailer();
		$mail->SMTPDebug = 2;
		$mail->Debugoutput = 'html';
		$mail->Host = "mail.dezmembraripenet.ro";
		//$mail->SMTPSecure = "ssl";
		$mail->Port = 26;
		$mail->SMTPAuth = true;
		$mail->Username = "noreply@dezmembraripenet.ro";
		$mail->Password = "dezmem@123";

		$mail->setFrom( 'noreply@dezmembraripenet.ro', 'Dezmembraripenet');
		//$mail->setFrom('in.priyaranjan@gmail.com', $blogname);
		$mail->addReplyTo( 'noreply@dezmembraripenet.ro', 'dezmembraripenet');
		$mail->addAddress( 'chittas970@gmail.com', 'chittaranjan' );
		$mail->Subject = 'Message From Dezmembraripent Site';
		$mail->isHTML(true);
		$mail->msgHTML( 'test content yes' );
		if(!$mail->send()) { 
		echo 0;
		}else{echo 1;}exit;
		pr($this->request->params);exit;*/
		//pr($this->request->params);exit;
		if($slug!='')
		{
			
			switch($slug){
				case 'request-parts':
				//Request parts code start from here
				if($postname=='')
				{
				$this->set('title_for_layout','Request parts');
				$this->layout="request_partlist";
				$this->loadModel('RequestPart');
				//-------Active request parts list functionality----------------
				$options=array(             
					'joins' =>
							  array(
								array(
									'table' => 'request_accessories',
									'alias' => 'RequestAccessory',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('RequestAccessory.request_id = RequestPart.request_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => array(
								array('RequestAccessory.status IN' => array(1,2), 'RequestPart.status IN' => array(1,2)),
							 )),
							 'fields' =>
							 array('RequestPart.*','RequestAccessory.*'),
							 'order' =>
							  array('RequestPart.request_id' => 'desc'),
							  'limit' =>10
						);
						$this->Paginator->settings =$options;
						$this->set('activeRequest', $this->Paginator->paginate('RequestPart'));
				//$activatedlist=$this->RequestPart->find('all',$options);
				//$this->set('activeRequest',$activatedlist);
				//-------Active request parts list functionality End ----------------
				
				//-------Resolve Offer request parts list functionality----------------
				
				$resolveoptions=array(             
					'joins' =>
							  array(
								array(
									'table' => 'request_accessories',
									'alias' => 'RequestAccessory',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('RequestAccessory.request_id = RequestPart.request_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => array(
								array('RequestAccessory.status' => 2, 'RequestPart.status' => 1),
							 )),
							 'fields' =>
							 array('RequestPart.*','RequestAccessory.*'),
							 'order' =>
							  array('RequestAccessory.part_id' => 'desc'),
							  'limit' =>5
						);
				$resoveofferlist=$this->RequestPart->find('all',$resolveoptions);
				$this->set('ResoveOfferlist',$resoveofferlist);
				}
				else
				{
					$this->loadModel('RequestAccessory');
					$AccessoryRes=$this->RequestAccessory->find('first', array('conditions' => array('slug' => $postname, 'status IN' => array(1, 2))));
					$this->set('AccessoryRes',$AccessoryRes);
					if(!empty($AccessoryRes))
					{
						if($this->request->is('post'))
						{
							
							if(isset($this->request->data['question']))
							{
								//-----------------------------------------------------
								$this->loadModel('MasterMessage');
								$loginBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 29)));
								$incorrectSecurity=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 3)));
								$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>42)));
								$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 43)));
								
								//-------------------------------------------------------
								if($this->request->data['RequestQuestion']['parent']<=0 || $this->request->data['RequestQuestion']['parent']=='')
								{
									$this->request->data['RequestQuestion']['parent']=0;
								}
								//print_r($this->Session->read('6_letters_code'));
								//pr($this->request->data);exit;
								if(!$this->Session->check('User'))
								{
									$this->set('openlogin','yes');
									$this->Session->setFlash(__('<div class="alert alert-danger">'.$loginBlank['MasterMessage']['msg'].'</div>'));
									if(isset($this->request->data['MasterUser']['user_login_id']))
									{
										$useremail=$this->request->data['MasterUser']['user_login_id'];
										$userpass=$this->request->data['MasterUser']['user_pass'];
										$this->loadModel('MasterUser');
										$user_count = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.email'=>$useremail,'MasterUser.pass'=>md5($userpass),'is_active' => 1)));
										if(count($user_count)>0)
										{
											$this->Session->write('User',$user_count['MasterUser']);
										$this->request->data['RequestQuestion']['user_id']=$user_count['MasterUser']['user_id'];
												
													if($this->Session->read('6_letters_code')==$this->request->data['code'])
													{
														$this->loadModel('RequestQuestion');
														if($this->RequestQuestion->save($this->request->data))
														{
													$questionInsertID=$this->RequestQuestion->getLastInsertID();
													//----------------------sales question Image save functionality---------------------------------
													//print_r($this->Session->read('6_letters_code'));
													//pr($this->request->data);exit;
													//------------------------------------------------------
													if(count($this->request->data['RequestQuestion']['img_files'])>0)

														{
															//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

															foreach($this->request->data['RequestQuestion']['img_files'] as $allimg)

															{

																//echo 1;

																if($allimg['name']!='')

																{

																$filename = time().$allimg['name'];

																//$filename=$this->Ikm->CleanFilePath($filename);

																// echo $filename;exit;
																$filename= $this->Dez->CleanFilePath($filename);
																move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/requestquestion/'.$filename);
																$uploadedFile=WWW_ROOT.'files/requestquestion/'.$filename;
																//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
																$this->request->data['RequestquestionImage']['img_file'] = $filename;
																}
																else
																{

																$this->request->data['RequestquestionImage']['img_file'] ='';	

																}

																$this->request->data['RequestquestionImage']['qid']=$questionInsertID;

																$this->request->data['RequestquestionImage']['requestid']=$this->request->data['RequestQuestion']['request_id'];
																$this->request->data['RequestquestionImage']['parts_id']=$this->request->data['RequestQuestion']['parts_id'];
																$this->loadModel('RequestquestionImage');
																$this->RequestquestionImage->create();

																$save=$this->RequestquestionImage->save($this->request->data);

															}

															

														}

														unset($this->request->data['RequestquestionImage']['img_files']);
													//---------------------Sales question Image save end----------------------------------
															//---Mail Detail fetch-------------
													$request_user_id = $this->request->data['request_user_id'];
													$parts_id = $this->request->data['RequestQuestion']['parts_id'];
													$parentchk = $this->request->data['RequestQuestion']['parent'];
													$this->loadModel('MasterUser');
													$userRes= $this->MasterUser->find('first', array('conditions' => array('user_id' => $request_user_id)));
													
													$toUser=$userRes['MasterUser']['email'];
													$toName=$userRes['MasterUser']['first_name'].' '.$userRes['MasterUser']['last_name'];
													if($parentchk>0){
														$this->loadModel('RequestQuestion');
														$rqRes=$this->RequestQuestion->find('first', array('conditions' => array('question_id' => $parentchk)));
														$formUserid = $rqRes['RequestQuestion']['user_id'];
													}
													else{
													$formUserid = $user_count['MasterUser']['user_id'];
													}
													$formUserid = $user_count['MasterUser']['user_id'];
													$formDetail= $this->MasterUser->find('first', array('conditions' => array('user_id' => $formUserid)));
													$fromUser=$formDetail['MasterUser']['email'];
													$fromName=$formDetail['MasterUser']['first_name'].' '.$formDetail['MasterUser']['last_name'];
													$this->loadModel('RequestAccessory');
													$partsDetail=$this->RequestAccessory->find('first', array('conditions' => array('part_id' => $parts_id)));
													$partsName=stripslashes($partsDetail['RequestAccessory']['name_piece']);
													$partsSlug=stripslashes($partsDetail['RequestAccessory']['slug']);
													//---------------------------------
													//-------------Mailing Code-------------------
															$baseurl='http://'.$_SERVER['SERVER_NAME'].Router::url('/');

																	  //=========Post User Body==============

																	   //$pbody='<table width="492">';
																	   if($parentchk<=0){
																	   	 $partsQuestionTemp=$this->Dez->BapCustUniGetTemplate(7);
																	  /*$pbody='<tr><td colspan="3">Ati primit un mesaj la cererea dumneavoastra "'.$partsName.'"</td></tr>
																  <tr><td colspan="3">Apasati <a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'">aici</a> pentru a vedea</td></tr>
																   <tr><td colspan="3"><a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'" style="display: block;background-color: #0084FF;color: #FFF;font-family: sans-serif;font-size: 14px;text-align: center;width: 150px;text-decoration: none;height: 37px;line-height: 37px;">vezi cererea</a></td></tr>
																  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';*/
																	   }else{
																	   	$partsQuestionTemp=$this->Dez->BapCustUniGetTemplate(8);
																		    /*$pbody='<tr><td colspan="3">Un răspuns este adăugat pe părți "'.$partsName.'"</td></tr>
																  <tr><td colspan="3">Apasati <a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'">aici</a> pentru a merge pagina parti cerere</td></tr>
																   <tr><td colspan="3"><a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'" style="display: block;background-color: #0084FF;color: #FFF;font-family: sans-serif;font-size: 14px;text-align: center;width: 150px;text-decoration: none;height: 37px;line-height: 37px;">vezi cererea</a></td></tr>
																  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';*/
																	   }
																	 
																	
																	 
																		  /* $pbody.='<table width="492">
																		  <tr><td colspan="3"><br/>Salutari,</td></tr>
																		  <tr><td colspan="3">Echipa Dezmembraripenet</td></tr>
																		  </table>';*/

																			$partsqSubject=stripslashes($partsQuestionTemp['EmailTemplate']['mail_subject']);
																			$pbody =stripslashes($partsQuestionTemp['EmailTemplate']['mail_body']);
																			$pbody= str_replace('{partsName}', $partsName, $pbody);
																			$pbody= str_replace('{PartsUrl}', '<a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'" style="display: block;background-color: #0084FF;color: #FFF;font-family: sans-serif;font-size: 14px;text-align: center;width: 150px;text-decoration: none;height: 37px;line-height: 37px;">vezi cererea</a>', $pbody);
																	  
																	  if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
																	{
																$this->loadModel('AdminUser');
																		$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
																		if(!empty($siteemail)){$adminemail=$siteemail['AdminUser']['mail_id'];}else{$adminemail='info@dezmembraripenet.com';}
																	
																		//Admin Mail-----------------
																		$postuserEmail = new CakeEmail('default');
																		if($parentchk<=0){
																		$postuserEmail->to(array($toUser => $toName));
																		}else{
																		$postuserEmail->to(array($fromUser => $fromName));	
																		}
																		$postuserEmail->subject('Cerere Piese Intrebare');
																		
																		if($parentchk<=0){
																		$postuserEmail->replyTo($fromUser);
																		$postuserEmail->from (array($fromUser => $fromName));
																		}else{
																		$postuserEmail->replyTo($toUser);
																		$postuserEmail->from (array($toUser => $toName));	
																		}
																		$postuserEmail->emailFormat('both');
																		//$Email->headers();
																		$postuserEmail->send($pbody);
																		//----------------------------
																	}
																	//-------------------------------------------
															$lastid=$this->RequestQuestion->getLastInsertID();
															$sessionUser=$this->Session->read('User');
															$this->loadModel('Notice');
															$this->Notice->create();
															$this->Notice->save(array('notice_type' => 'bid-question', 'postid' => $this->request->data['RequestQuestion']['request_id'], 'notice_name' => 'Request Bid Comment'));
															$this->Notice->create();
															$this->Notice->save(array('notice_type' => 'bid-question', 'postid' => $this->request->data['RequestQuestion']['request_id'], 'notice_name' => 'Request Bid Comment', 'user_id' => $this->request->data['request_user_id']));
																										/*$this->loadModel('Notice');
															$this->Notice->save(array('notice_type' => 'request-question', 'postid' => $lastid, 'notice_name' => 'Request Parts Comment'));*/
															$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
															unset($this->request->data);
														}
														else
														{
															$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
														}
													}
													else
													{
														$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectSecurity['MasterMessage']['msg'].'</div>'));
													}
												
												
										}
										
									}
									
								}
								else
								{
									
									$user=$this->Session->read('User');
									$this->request->data['RequestQuestion']['user_id']=$user['user_id'];
									//echo "<pre>";print_r($this->request->data);exit;
									/*if($this->request->data['request_user_id']!=$user['user_id'])
									{*/
									
										if($this->Session->read('6_letters_code')==$this->request->data['code'])
										{
											if($this->request->data['RequestQuestion']['bidid']!='')
											{
												
												$this->loadModel('BidQuestion');
												if($this->BidQuestion->save($this->request->data['RequestQuestion']))
												{
													
													$lastid=$this->BidQuestion->getLastInsertID();

													//----------------------sales question Image save functionality---------------------------------
													//print_r($this->Session->read('6_letters_code'));
													//pr($this->request->data);exit;
													//------------------------------------------------------
													if(count($this->request->data['RequestQuestion']['img_files'])>0)

														{
															//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

															foreach($this->request->data['RequestQuestion']['img_files'] as $allimg)

															{

																//echo 1;

																if($allimg['name']!='')

																{

																$filename = time().$allimg['name'];

																//$filename=$this->Ikm->CleanFilePath($filename);

																// echo $filename;exit;
																$filename= $this->Dez->CleanFilePath($filename);
																move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/bidquestion/'.$filename);
																$uploadedFile=WWW_ROOT.'files/bidquestion/'.$filename;
																//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
																$this->request->data['BidquestionImage']['img_file'] = $filename;
																}
																else
																{

																$this->request->data['BidquestionImage']['img_file'] ='';	

																}

																$this->request->data['BidquestionImage']['qid']=$lastid;

																$this->request->data['BidquestionImage']['requestid']=$this->request->data['RequestQuestion']['request_id'];
																$this->request->data['BidquestionImage']['parts_id']=$this->request->data['RequestQuestion']['parts_id'];
																$this->request->data['BidquestionImage']['bidid']=$this->request->data['RequestQuestion']['bidid'];
																$this->loadModel('BidquestionImage');
																$this->BidquestionImage->create();

																$save=$this->BidquestionImage->save($this->request->data);

															}

															

														}

														unset($this->request->data['BidquestionImage']['img_files']);
													//---------------------Sales question Image save end----------------------------------

													$sessionUser=$this->Session->read('User');
													$this->loadModel('Notice');
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'bid-question', 'postid' => $this->request->data['RequestQuestion']['request_id'], 'notice_name' => 'Request Bid Comment'));
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'bid-question', 'postid' => $this->request->data['RequestQuestion']['request_id'], 'notice_name' => 'Request Bid Comment', 'user_id' => $this->request->data['request_user_id']));
													$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
													unset($this->request->data);
												}
												else
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
												}
											}
											else
											{
												$this->loadModel('RequestQuestion');
												if($this->RequestQuestion->save($this->request->data))
												{

													$questionInsertID=$this->RequestQuestion->getLastInsertID();
													//----------------------sales question Image save functionality---------------------------------
													//print_r($this->Session->read('6_letters_code'));
													//pr($this->request->data);exit;
													//------------------------------------------------------
													if(count($this->request->data['RequestQuestion']['img_files'])>0)

														{
															//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

															foreach($this->request->data['RequestQuestion']['img_files'] as $allimg)

															{

																//echo 1;

																if($allimg['name']!='')

																{

																$filename = time().$allimg['name'];

																//$filename=$this->Ikm->CleanFilePath($filename);

																// echo $filename;exit;
																$filename= $this->Dez->CleanFilePath($filename);
																move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/requestquestion/'.$filename);
																$uploadedFile=WWW_ROOT.'files/requestquestion/'.$filename;
																//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
																$this->request->data['RequestquestionImage']['img_file'] = $filename;
																}
																else
																{

																$this->request->data['RequestquestionImage']['img_file'] ='';	

																}

																$this->request->data['RequestquestionImage']['qid']=$questionInsertID;

																$this->request->data['RequestquestionImage']['requestid']=$this->request->data['RequestQuestion']['request_id'];
																$this->request->data['RequestquestionImage']['parts_id']=$this->request->data['RequestQuestion']['parts_id'];
																$this->loadModel('RequestquestionImage');
																$this->RequestquestionImage->create();

																$save=$this->RequestquestionImage->save($this->request->data);

															}

															

														}

														unset($this->request->data['RequestquestionImage']['img_files']);
													//---------------------Sales question Image save end----------------------------------
													//---Mail Detail fetch-------------
													$request_user_id = $this->request->data['request_user_id'];
													$parts_id = $this->request->data['RequestQuestion']['parts_id'];
													$parentchk = $this->request->data['RequestQuestion']['parent'];
													$this->loadModel('MasterUser');
													$userRes= $this->MasterUser->find('first', array('conditions' => array('user_id' => $request_user_id)));
													
													$toUser=$userRes['MasterUser']['email'];
													$toName=$userRes['MasterUser']['first_name'].' '.$userRes['MasterUser']['last_name'];
													if($parentchk>0){
														$this->loadModel('RequestQuestion');
														$rqRes=$this->RequestQuestion->find('first', array('conditions' => array('question_id' => $parentchk)));
														$formUserid = $rqRes['RequestQuestion']['user_id'];
													}
													else{
													$formUserid = $user['user_id'];
													}
													$formDetail= $this->MasterUser->find('first', array('conditions' => array('user_id' => $formUserid)));
													$fromUser=$formDetail['MasterUser']['email'];
													$fromName=$formDetail['MasterUser']['first_name'].' '.$formDetail['MasterUser']['last_name'];
													$this->loadModel('RequestAccessory');
													$partsDetail=$this->RequestAccessory->find('first', array('conditions' => array('part_id' => $parts_id)));
													$partsName=stripslashes($partsDetail['RequestAccessory']['name_piece']);
													$partsSlug=stripslashes($partsDetail['RequestAccessory']['slug']);
													//---------------------------------
													//-------------Mailing Code-------------------
															$baseurl='http://'.$_SERVER['SERVER_NAME'].Router::url('/');

																	  //=========Post User Body==============
																	   $pbody='<table width="492">';
																	   if($parentchk<=0){
																	   	$partsQuestionTemp=$this->Dez->BapCustUniGetTemplate(8);
																	/*  $pbody='<tr><td colspan="3">Ati primit un mesaj la cererea dumneavoastra "'.$partsName.'"</td></tr>
																  <tr><td colspan="3">Apasati <a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'">aici</a> pentru a vedea</td></tr>
																  <tr><td colspan="3"><a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'" style="display: block;background-color: #0084FF;color: #FFF;font-family: sans-serif;font-size: 14px;text-align: center;width: 150px;text-decoration: none;height: 37px;line-height: 37px;">vezi cererea</a></td></tr>
																  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';*/
																	   }else{
																	   	$partsQuestionTemp=$this->Dez->BapCustUniGetTemplate(8);
																		   /* $pbody='<tr><td colspan="3">Un răspuns este adăugat pe părți "'.$partsName.'"</td></tr>
																  <tr><td colspan="3">Apasati <a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'">aici</a> pentru a merge pagina parti cerere</td></tr>
																   <tr><td colspan="3"><a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'" style="display: block;background-color: #0084FF;color: #FFF;font-family: sans-serif;font-size: 14px;text-align: center;width: 150px;text-decoration: none;height: 37px;line-height: 37px;">vezi cererea</a></td></tr>
																  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';*/
																	   }
																	 
																	
																	 
																		  /* $pbody.='<table width="492">
																		  <tr><td colspan="3"><br/>Salutari,</td></tr>
																		  <tr><td colspan="3">Echipa Dezmembraripenet</td></tr>
																		  </table>';*/
																		  $partsqSubject=stripslashes($partsQuestionTemp['EmailTemplate']['mail_subject']);
																			$pbody =stripslashes($partsQuestionTemp['EmailTemplate']['mail_body']);
																			$pbody= str_replace('{partsName}', $partsName, $pbody);
																			$pbody= str_replace('{PartsUrl}', '<a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'" style="display: block;background-color: #0084FF;color: #FFF;font-family: sans-serif;font-size: 14px;text-align: center;width: 150px;text-decoration: none;height: 37px;line-height: 37px;">vezi cererea</a>', $pbody);
																	  
																	  
																	  if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
																	{
																$this->loadModel('AdminUser');
																		$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
							if(!empty($siteemail)){$adminemail=$siteemail['AdminUser']['mail_id'];}else{$adminemail='info@dezmembraripenet.com';}
																	
																		//Admin Mail-----------------
																		$postuserEmail = new CakeEmail('default');
																		if($parentchk<=0){
																		$postuserEmail->to(array($toUser => $toName));
																		}else{
																		$postuserEmail->to(array($fromUser => $fromName));	
																		}
																		$postuserEmail->subject('Cerere Piese Intrebare');
																		
																		if($parentchk<=0){

																		$postuserEmail->replyTo($fromUser);
																		$postuserEmail->from (array($fromUser => $fromName));
																		}else{
																		$postuserEmail->replyTo($toUser);
																		$postuserEmail->from (array($toUser => $toName));	
																		}
																		$postuserEmail->emailFormat('both');
																		//$Email->headers();
																		$postuserEmail->send($pbody);
																		//----------------------------
																	}
																	//-------------------------------------------
													$lastid=$this->RequestQuestion->getLastInsertID();
													/*$this->loadModel('Notice');
					$this->Notice->save(array('notice_type' => 'request-question', 'postid' => $lastid, 'notice_name' => 'Request Parts Comment'));*/
												$sessionUser=$this->Session->read('User');
													$this->loadModel('Notice');
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'request-question', 'postid' => $this->request->data['RequestQuestion']['request_id'], 'notice_name' => 'Request Parts Comment'));
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'request-question', 'postid' => $this->request->data['RequestQuestion']['request_id'], 'notice_name' => 'Request Parts Comment', 'user_id' => $this->request->data['request_user_id']));
													$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
													unset($this->request->data);
												}
												else
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
												}
											}
										}
										else
										{
											$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectSecurity['MasterMessage']['msg'].'</div>'));
										}
									
									//}
									/*else
									{
										$this->Session->setFlash(__('<div class="alert alert-danger">Nu poti cere întrebarea la propria cerere.</div>'));	
									}*/
								}
							}
							
							//---------------------------------------
							
							//Bid offersfunctionality start from here
							//---------------------------------------
							if(isset($this->request->data['bidoffer']))
							{
								//-----------------------------------------------------
								$this->loadModel('MasterMessage');
								$loginBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 29)));
								$ownOfferValid=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 44)));
								$offerBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 45)));
								$availabilityBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 46)));
								$deliveryblnk=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 47)));
								$deliveryCostBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 48)));
								$pmtMethodBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 49)));
								$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>50)));
								$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 51)));
								$insufficientCredit=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 52)));
								
								//-------------------------------------------------------
								//print_r($this->Session->read('6_letters_code'));
								//pr($this->request->data);exit;
								if(!$this->Session->check('User'))
								{
									$this->set('bidopenlogin','yes');
									$this->Session->setFlash(__('<div class="alert alert-danger">'.$loginBlank['MasterMessage']['msg'].'</div>'));
									if(isset($this->request->data['MasterUser']['user_login_id']))
									{
										$useremail=$this->request->data['MasterUser']['user_login_id'];
										$userpass=$this->request->data['MasterUser']['user_pass'];
										$this->loadModel('MasterUser');
										$user_count = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.email'=>$useremail,'MasterUser.pass'=>md5($userpass),'is_active' => 1)));
										$request_id=$this->request->data['BidOffer']['request_id'];
										if(count($user_count)>0)
										{
											$this->loadModel('RequestPart');
									$requestcount=$this->RequestPart->find('count', array('conditions' => array('request_id' => $request_id, 'user_id' =>$user_count['MasterUser']['user_id'])));
												$this->set('bidopenlogin','no');
												$this->Session->write('User',$user_count['MasterUser']);
											if($requestcount>0)
											{
												$this->Session->setFlash(__('<div class="alert alert-danger">'.$ownOfferValid['MasterMessage']['msg'].'</div>'));
												
											}
											else
											{
												$this->set('bidopenlogin','no');
												$this->Session->write('User',$user_count['MasterUser']);
												$this->request->data['BidOffer']['user_id']=$user_count['MasterUser']['user_id'];
												
												$currentdate=date("Y-m-d");
												$this->loadModel('UserCreditAccount');
												$options=array(
												 'joins' =>
												  array(
													array(
														'table' => 'upgrade_membership',
														'alias' => 'UpgradeMembership',
														'type' => 'left',
														'foreignKey' => false,
														'conditions'=> array('UpgradeMembership.upgrade_id = UserCreditAccount.upgrade_id')
													)          
												 ),
												 'conditions' => array('UpgradeMembership.plan_status' => 1, 'UpgradeMembership.payment_status' => 1, 'UserCreditAccount.user_id' => $user_count['MasterUser']['user_id'], 'UserCreditAccount.credits >' => 0),
												 'fields' => array('UpgradeMembership.*','UserCreditAccount.*'),
												  'order' => array('UserCreditAccount.upgrade_id' => 'desc')
												   );
												$usercredits=$this->UserCreditAccount->find('first', $options);
												//pr($usercredits);exit;
												if(count($usercredits)>0)
												{
													
												$paymentmodearr=array_filter($this->request->data['BidOffer']['payment_method']);
												$personal_teaching=$this->request->data['BidOffer']['personal_teaching'];
												$courier=$this->request->data['BidOffer']['courier'];
												$romanian_mail=$this->request->data['BidOffer']['roman_mail'];
												$courier_cost=$this->request->data['BidOffer']['courier_cost'];
												$romanian_mail_cost=$this->request->data['BidOffer']['roman_mail_cost'];
												$free_courier=$this->request->data['BidOffer']['free_courier'];
												$free_romanian_mail=$this->request->data['BidOffer']['free_roman_mail'];
												
												$offers=$this->request->data['BidOffer']['offers'];
												$request_id=$this->request->data['BidOffer']['request_id'];
												$parts_id=$this->request->data['BidOffer']['parts_id'];
												$valabilitate=$this->request->data['BidOffer']['validity'];
												$warranty=$this->request->data['BidOffer']['warranty'];
												
													
													if($offers == '0')
													{
														$this->Session->setFlash(__('<div class="alert alert-danger">'.$offerBlank['MasterMessage']['msg'].'</div>'));
													}
													else if($warranty=='Ofer warranty' && $valabilitate=='')
													{
														
														$this->Session->setFlash(__('<div class="alert alert-danger">Introduceți valabilitate</div>'));
													}
													else if($warranty=='Ofer warranty' && is_numeric($valabilitate)==false)
													{
														
														$this->Session->setFlash(__('<div class="alert alert-danger">Introduceți valabilitate Numeric</div>'));
													}
													else if($personal_teaching==0 && $courier==0 && $romanian_mail==0 && $free_courier==0 && $free_romanian_mail==0)
													{
														
														$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryblnk['MasterMessage']['msg'].'</div>'));
													}
													else if($courier==1 && $free_courier==0 && ($courier_cost=='' || $courier_cost==0))
													{
														$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryCostBlank['MasterMessage']['msg'].'</div>'));
													}
													else if($romanian_mail==1 && $free_romanian_mail==0 && ($romanian_mail_cost=='' || $romanian_mail_cost==0))
													{
														$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryCostBlank['MasterMessage']['msg'].'</div>'));
													}
													else if(empty($paymentmodearr))
													{
														$this->Session->setFlash(__('<div class="alert alert-danger">'.$pmtMethodBlank['MasterMessage']['msg'].'</div>'));
													}
													else
													{
														
														$this->request->data['BidOffer']['payment_method']=implode(",",$paymentmodearr);
														$request_id=$this->request->data['BidOffer']['request_id'];
														$parts_id=$this->request->data['BidOffer']['parts_id'];
														$this->loadModel('BidOffer');
													
														if($this->BidOffer->save($this->request->data))
														{
															//pr($this->request->data);
															$requestUser=$this->request->data['bidrequest_user_id'];
															$this->loadModel('MasterUser');
															$userRes= $this->MasterUser->find('first', array('conditions' => array('user_id' => $requestUser)));
															$toUser=$userRes['MasterUser']['email'];
															$toName=$userRes['MasterUser']['first_name'].' '.$userRes['MasterUser']['last_name'];
															$formUserid = $this->request->data['BidOffer']['user_id'];
															$formDetail= $this->MasterUser->find('first', array('conditions' => array('user_id' => $formUserid)));
															$fromUser=$formDetail['MasterUser']['email'];
															$fromName=$formDetail['MasterUser']['first_name'].' '.$formDetail['MasterUser']['last_name'];
															$parts_id=$this->request->data['BidOffer']['parts_id'];
															$this->loadModel('RequestAccessory');
															$partsDetail=$this->RequestAccessory->find('first', array('conditions' => array('part_id' => $parts_id)));
															$partsName=stripslashes($partsDetail['RequestAccessory']['name_piece']);
															$partsSlug=stripslashes($partsDetail['RequestAccessory']['slug']);
															//-------------Mailing Code-------------------
															$baseurl='http://'.$_SERVER['SERVER_NAME'].Router::url('/');

																	  //=========Post User Body==============
																		$bidOffertemp=$this->Dez->BapCustUniGetTemplate(9);
																	$bidofferSubject=stripslashes($bidOffertemp['EmailTemplate']['mail_subject']);
																	$pbody =stripslashes($bidOffertemp['EmailTemplate']['mail_body']);
																	$pbody= str_replace('{partsName}', $partsName, $pbody);
																	$pbody= str_replace('{PartsUrl}', '<a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'" style="display: block;background-color: #0084FF;color: #FFF;font-family: sans-serif;font-size: 14px;text-align: center;width: 150px;text-decoration: none; height: 37px;line-height: 37px;">vezi cererea</a>', $pbody);
																	  /* $pbody='<table width="492">
																	  <tr><td colspan="3">Aveti o oferta noua la cererea dumneavoaastra "'.$partsName.'"</td></tr>
																  <tr><td colspan="3">Apasati <a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'">aici</a> pentru a vedea</td></tr>
																  <tr><td colspan="3"><a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'" style="display: block;background-color: #0084FF;color: #FFF;font-family: sans-serif;font-size: 14px;text-align: center;width: 150px;text-decoration: none; height: 37px;line-height: 37px;">vezi cererea</a></td></tr>
																  
																  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';
																	 
																	
																	 
																		   $pbody.='<table width="492">
																		  <tr><td colspan="3"><br/>Salutari,</td></tr>
																		  <tr><td colspan="3">Echipa Dezmembraripenet</td></tr>
																		  </table>';*/
																	  
																	  if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
																	{
																$this->loadModel('AdminUser');
																		$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
							if(!empty($siteemail)){$adminemail=$siteemail['AdminUser']['mail_id'];}else{$adminemail='info@dezmembraripenet.com';}
																	
																		//Admin Mail-----------------
																		$postuserEmail = new CakeEmail('default');
																		$postuserEmail->to($toUser);
																		$postuserEmail->subject($bidofferSubject);
																		$postuserEmail->replyTo($fromUser);
																		$postuserEmail->from (array($fromUser => $fromName));
																		$postuserEmail->emailFormat('both');
																		//$Email->headers();
																		$postuserEmail->send($pbody);
																		//----------------------------
																	}
															//---------------------------------------------
															$totcredits=$usercredits['UserCreditAccount']['credits'];
															$minustotcredit=$totcredits-1;
															$creditid=$usercredits['UserCreditAccount']['credit_id'];
															$this->UserCreditAccount->save(array('credit_id' => $creditid, 'credits' => $minustotcredit));
															$bidid=$this->BidOffer->getLastInsertId();
															//======Offer count functionality=====
															$countbid=$this->BidOffer->find('count', array('conditions' => array('request_id' => $request_id, 'parts_id'=> $parts_id)));
															$this->loadModel('RequestAccessory');
															$this->RequestAccessory->save(array('part_id' => $parts_id, 'request_id' => $request_id, 'offerno' => $countbid));
															//===============================================
															$this->loadModel('BidTempFile');
															 $clientip=$this->RequestHandler->getClientIp();
															 $bid_temp_img=$this->BidTempFile->find('all',array('conditions' => array('parts_id' => $parts_id,'user_id' => $user_count['MasterUser']['user_id'], 'ip_address' => $clientip)));
															// pr($req_temp_img);
															 if(!empty($bid_temp_img))
															 {
																 $this->loadModel('BidImg');
																 foreach($bid_temp_img as $bid_temp_res)
																 {
																	$img_path=$bid_temp_res['BidTempFile']['img_pth'];
																	copy(WWW_ROOT.'files/tempfile/'.$img_path,WWW_ROOT.'files/bidimg/'.$img_path);
																	
																	$resizeObj = new resize(WWW_ROOT.'files/bidimg/'.$img_path);
																	$resizeObj -> resizeImage(107, 95, 'crop');
																	$resizeObj -> saveImage(WWW_ROOT.'files/bidimg/107X95_'.$img_path, 90);
																													
																	
																	$this->BidImg->create();
																	$imgsv=$this->BidImg->save(array('bid_id' => $bidid,'request_id' => $request_id,'user_id' => $user_count['MasterUser']['user_id'],'parts_id' => $parts_id,'img_path'=>$img_path));
																	if($imgsv)
																	{
																		$this->loadModel('BidTempFile');
																		$this->BidTempFile->delete($bid_temp_res['BidTempFile']['temp_id']);
																		@unlink(WWW_ROOT.'files/tempfile/'.$img_path);
																		
																	}	
																 }
															 }
												/*$this->loadModel('Notice');
				$this->Notice->save(array('notice_type' => 'bid-offer', 'postid' => $request_id, 'notice_name' => 'Bid offer'));*/
										$sessionUser=$this->Session->read('User');
										$this->loadModel('Notice');
										$this->Notice->create();
										$this->Notice->save(array('notice_type' => 'bid-offer', 'postid' => $request_id, 'notice_name' => 'Bid offer'));
										$this->Notice->create();
										$this->Notice->save(array('notice_type' => 'bid-offer', 'postid' => $request_id, 'notice_name' => 'Bid offer', 'user_id' => $this->request->data['bidrequest_user_id']));
															$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
															unset($this->request->data);
														}
														else
														{
															$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
														}
													}
												}
												else
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$insufficientCredit['MasterMessage']['msg'].'</div>'));
												}
											}
											
													
										}
										
									}
									
								}
								else
								{
															
											$user=$this->Session->read('User');
											$this->request->data['BidOffer']['user_id']=$user['user_id'];
											$currentdate=date("Y-m-d");
											$this->loadModel('UserCreditAccount');
											$options=array(
												 'joins' =>
												  array(
													array(
														'table' => 'upgrade_membership',
														'alias' => 'UpgradeMembership',
														'type' => 'left',
														'foreignKey' => false,
														'conditions'=> array('UpgradeMembership.upgrade_id = UserCreditAccount.upgrade_id')
													)          
												 ),
												 'conditions' => array('UpgradeMembership.plan_status' => 1, 'UpgradeMembership.payment_status' => 1, 'UserCreditAccount.user_id' => $user['user_id'], 'UserCreditAccount.credits >' => 0),
												 'fields' => array('UpgradeMembership.*','UserCreditAccount.*'),
												  'order' => array('UserCreditAccount.upgrade_id' => 'desc')
												   );
												$usercredits=$this->UserCreditAccount->find('first', $options);
											//echo $user['user_id'];
											/*$usercredits=$this->UserCreditAccount->find('first', array('conditions' => array('user_id' => $user['user_id'], 'credits >' => 0), 'order' => array('credit_id' => 'desc')));*/
											//pr($usercredits);exit;
											if(count($usercredits)>0)
											{
											$paymentmodearr=array_filter($this->request->data['BidOffer']['payment_method']);
											$personal_teaching=$this->request->data['BidOffer']['personal_teaching'];
											$courier=$this->request->data['BidOffer']['courier'];
											$romanian_mail=$this->request->data['BidOffer']['roman_mail'];
											$courier_cost=$this->request->data['BidOffer']['courier_cost'];
											$romanian_mail_cost=$this->request->data['BidOffer']['roman_mail_cost'];
											$free_courier=$this->request->data['BidOffer']['free_courier'];
											$free_romanian_mail=$this->request->data['BidOffer']['free_roman_mail'];
											$offers=$this->request->data['BidOffer']['offers'];
											$request_id=$this->request->data['BidOffer']['request_id'];
											$parts_id=$this->request->data['BidOffer']['parts_id'];
											$valabilitate=$this->request->data['BidOffer']['validity'];
											$warranty=$this->request->data['BidOffer']['warranty'];
												
												if($offers == '0')
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$offerBlank['MasterMessage']['msg'].'</div>'));
												}
												else if($warranty=='Ofer warranty' && $valabilitate=='')
												{
													
													$this->Session->setFlash(__('<div class="alert alert-danger">Introduceți valabilitate</div>'));
												}
												else if($warranty=='Ofer warranty' && is_numeric($valabilitate)==false)
												{
													
													$this->Session->setFlash(__('<div class="alert alert-danger">Introduceți valabilitate Numeric</div>'));
												}
												else if($personal_teaching==0 && $courier==0 && $romanian_mail==0 && $free_courier==0 && $free_romanian_mail==0)
												{
													
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryblnk['MasterMessage']['msg'].'</div>'));
												}
												else if($courier==1 && $free_courier==0 && ($courier_cost=='' || $courier_cost==0))
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryCostBlank['MasterMessage']['msg'].'</div>'));
												}
												else if($romanian_mail==1 && $free_romanian_mail==0 && ($romanian_mail_cost=='' || $romanian_mail_cost==0))
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryCostBlank['MasterMessage']['msg'].'</div>'));
												}
												else if(empty($paymentmodearr))
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$pmtMethodBlank['MasterMessage']['msg'].'</div>'));
												}
												else
												{
													$this->request->data['BidOffer']['payment_method']=implode(",",$paymentmodearr);
													$request_id=$this->request->data['BidOffer']['request_id'];
													$parts_id=$this->request->data['BidOffer']['parts_id'];
													$this->loadModel('RequestPart');
													$requestcount=$this->RequestPart->find('count', array('conditions' => array('request_id' => $request_id, 'user_id' =>$user['user_id'])));
													
													if($requestcount>0)
													{
														$this->Session->setFlash(__('<div class="alert alert-danger">'.$ownOfferValid['MasterMessage']['msg'].'</div>'));
													}
													else
													{
														$this->loadModel('BidOffer');
														//pr($this->request->data);
														
														//exit;
														$baseurl='http://'.$_SERVER['SERVER_NAME'].Router::url('/');
														if($this->BidOffer->save($this->request->data))
														{
															//pr($this->request->data);
															$requestUser=$this->request->data['bidrequest_user_id'];
															$this->loadModel('MasterUser');
															$userRes= $this->MasterUser->find('first', array('conditions' => array('user_id' => $requestUser)));
															$toUser=$userRes['MasterUser']['email'];
															$toName=$userRes['MasterUser']['first_name'].' '.$userRes['MasterUser']['last_name'];
															$formUserid = $this->request->data['BidOffer']['user_id'];
															$formDetail= $this->MasterUser->find('first', array('conditions' => array('user_id' => $formUserid)));
															$fromUser=$formDetail['MasterUser']['email'];
															$fromName=$formDetail['MasterUser']['first_name'].' '.$formDetail['MasterUser']['last_name'];
															$parts_id=$this->request->data['BidOffer']['parts_id'];
															$this->loadModel('RequestAccessory');
															$partsDetail=$this->RequestAccessory->find('first', array('conditions' => array('part_id' => $parts_id)));
															$partsName=stripslashes($partsDetail['RequestAccessory']['name_piece']);
															$partsSlug=stripslashes($partsDetail['RequestAccessory']['slug']);
															//-------------Mailing Code-------------------
															$baseurl='http://'.$_SERVER['SERVER_NAME'].Router::url('/');

																	  //=========Post User Body==============
																	  /* $pbody='<table width="492">
																	  <tr><td colspan="3">Aveti o oferta noua la cererea dumneavoaastra "'.$partsName.'"</td></tr>
																  <tr><td colspan="3">Apasati <a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'">aici</a> pentru a vedea</td></tr>
																  <tr><td colspan="3"><a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'" style="display: block;background-color: #0084FF;color: #FFF;font-family: sans-serif;font-size: 14px;text-align: center;width: 150px;text-decoration: none; height: 37px;line-height: 37px;">vezi cererea</a></td></tr>
																  
																  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';
																	 
																	
																	 
																		   $pbody.='<table width="492">
																		  <tr><td colspan="3"><br/>Salutari,</td></tr>
																		  <tr><td colspan="3">Echipa Dezmembraripenet</td></tr>
																		  </table>';*/
																		  $bidOffertemp=$this->Dez->BapCustUniGetTemplate(9);
																	$bidofferSubject=stripslashes($bidOffertemp['EmailTemplate']['mail_subject']);
																	$pbody =stripslashes($bidOffertemp['EmailTemplate']['mail_body']);
																	$pbody= str_replace('{partsName}', $partsName, $pbody);
																	$pbody= str_replace('{PartsUrl}', '<a href="'.$baseurl.'pages/request-parts/'.$partsSlug.'" style="display: block;background-color: #0084FF;color: #FFF;font-family: sans-serif;font-size: 14px;text-align: center;width: 150px;text-decoration: none; height: 37px;line-height: 37px;">vezi cererea</a>', $pbody);
																	  
																	  if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
																	{
																
																	
																		//Admin Mail-----------------
																		$postuserEmail = new CakeEmail('default');
																		$postuserEmail->to($toUser);
																		$postuserEmail->subject($bidofferSubject);
																		$postuserEmail->replyTo($fromUser);
																		$postuserEmail->from (array($fromUser => $fromName));
																		$postuserEmail->emailFormat('both');
																		//$Email->headers();
																		$postuserEmail->send($pbody);
																		//----------------------------
																	}
															$totcredits=$usercredits['UserCreditAccount']['credits'];
															$minustotcredit=$totcredits-1;
															$creditid=$usercredits['UserCreditAccount']['credit_id'];
															$this->UserCreditAccount->save(array('credit_id' => $creditid, 'credits' => $minustotcredit));
															$bidid=$this->BidOffer->getLastInsertId();
															//======Offer count functionality=====
															$countbid=$this->BidOffer->find('count', array('conditions' => array('request_id' => $request_id, 'parts_id'=> $parts_id)));
															$this->loadModel('RequestAccessory');
															$this->RequestAccessory->save(array('part_id' => $parts_id, 'request_id' => $request_id, 'offerno' => $countbid));
															//==================================================
															$this->loadModel('BidTempFile');
															 $clientip=$this->RequestHandler->getClientIp();
															 $bid_temp_img=$this->BidTempFile->find('all',array('conditions' => array('parts_id' => $parts_id,'user_id' => $user['user_id'], 'ip_address' => $clientip)));
															// pr($req_temp_img);
															 if(!empty($bid_temp_img))
															 {
																 $this->loadModel('BidImg');
																 foreach($bid_temp_img as $bid_temp_res)
																 {
																	$img_path=$bid_temp_res['BidTempFile']['img_pth'];
																	copy(WWW_ROOT.'files/tempfile/'.$img_path,WWW_ROOT.'files/bidimg/'.$img_path);
																	$resizeObj = new resize(WWW_ROOT.'files/bidimg/'.$img_path);
																	$resizeObj -> resizeImage(107, 95, 'crop');
																	$resizeObj -> saveImage(WWW_ROOT.'files/bidimg/107X95_'.$img_path, 90);
																													
																	
																	$this->BidImg->create();
																	$imgsv=$this->BidImg->save(array('bid_id' => $bidid,'request_id' => $request_id,'user_id' => $user['user_id'],'parts_id' => $parts_id,'img_path'=>$img_path));
																	if($imgsv)
																	{
																		$this->loadModel('BidTempFile');
																		$this->BidTempFile->delete($bid_temp_res['BidTempFile']['temp_id']);
																		@unlink(WWW_ROOT.'files/tempfile/'.$img_path);
																	}	
																 }
															 }
															 /*$this->loadModel('Notice');
				$this->Notice->save(array('notice_type' => 'bid-offer', 'postid' => $request_id, 'notice_name' => 'Bid offer'));*/
										$sessionUser=$this->Session->read('User');
										$this->loadModel('Notice');
										$this->Notice->create();
										$this->Notice->save(array('notice_type' => 'bid-offer', 'postid' => $request_id, 'notice_name' => 'Bid offer'));
										$this->Notice->create();
										$this->Notice->save(array('notice_type' => 'bid-offer', 'postid' => $request_id, 'notice_name' => 'Bid offer', 'user_id' => $this->request->data['bidrequest_user_id']));
															$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
															$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
															unset($this->request->data);
														}
														else
														{
															$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
														}
													}
												}
											}
											else
											{
												$this->Session->setFlash(__('<div class="alert alert-danger">'.$insufficientCredit['MasterMessage']['msg'].'</div>'));
											}
											
													
										
								}
							}
							
						}
						$this->loadModel('RequestPart');
						$RequestRes=$this->RequestPart->find('first', array('conditions' => array('request_id' => $AccessoryRes['RequestAccessory']['request_id'], 'status' => array(1, 2))));
						$this->set('RequestRes', $RequestRes);
						$this->loadModel('BidOffer');
						$bidOfferRes=$this->BidOffer->find('all', array('conditions' => array('request_id' => $AccessoryRes['RequestAccessory']['request_id'], 'status IN' => array(0, 1, 2)), 'order' => array('bid_id' => 'desc')));
						$this->set('bidOfferRes', $bidOfferRes);
						$this->set('usr_id', $this->Session->read('User.user_id'));
						$this->set('title_for_layout',$AccessoryRes['RequestAccessory']['name_piece']);
						$this->layout="request_part_details";
						$part_id=$AccessoryRes['RequestAccessory']['part_id'];
						$this->loadModel('RequestQuestion');
					$requestQustionRes=$this->RequestQuestion->find('all', array('conditions' => array('parent' => 0, 'parts_id' => $part_id), 'order' => array('question_id' => 'desc')));
					$this->set('requestQustionRes', $requestQustionRes);
					}
					else
					{
						$this->set('title_for_layout','404 Not Found');
						$this->layout="404";
					}
				
					
					
				}
				//-------Resolve Offer request parts list functionality End ----------------
				
				//-------------End----------------------
				break;
				case 'sales-details' :
				
					if($postname!=''):
					
					$this->loadModel('PostAd');
					$salesDetail=$this->PostAd->find('first', array('conditions' => array('adv_status' => 1, 'slug' =>$postname)));
					
					if(empty($salesDetail))
					{
						$this->set('title_for_layout','404 Not Found');
						$this->layout="404";
					}
					else
					{
						$this->loadModel('SalesOrder');
						$SalesOrder=$this->SalesOrder->find('first', array('conditions' => array('SalesOrder.adv_id' => $salesDetail['PostAd']['adv_id']),'fields' => array('SUM(SalesOrder.qty) as orderqty')));
						$this->set('SalesOrder',$SalesOrder);
						//pr($SalesOrder);exit;
						$this->set('salesDetail',$salesDetail);
						if(!empty($salesDetail))
						{
							$userid=$salesDetail['PostAd']['user_id'];
							$adv_id=$salesDetail['PostAd']['adv_id'];
							$this->loadModel('ManageUser');
							$userdetail=$this->ManageUser->find('first', array('conditions' => array('user_id' => $userid)));
							$this->loadModel('PostadImg');
							$allimg=$this->PostadImg->find('all', array('conditions' => array('post_ad_id' => $adv_id)));
							$this->set('title_for_layout', stripslashes($salesDetail['PostAd']['adv_name']));
							
							//Recently Viewed Sales....
							//Most Viewed Company Function
							/*if($this->Session->check('recentsales'))
							{
								$sessionSales=$this->Session->read('recentsales');
								//print_r($sessionSales);exit;
								if(!in_array($adv_id,$sessionSales))
								{
									//$salesarr=$this->Session->read('recentsales');
									array_push($sessionSales,$adv_id);
									$this->Session->write('recentsales',$sessionSales);
								}
							}
							else
							{
								$salesarr=array();
								array_push($salesarr,$adv_id);
								$this->Session->write('recentsales',$salesarr);
								//$CSDB->Insert($wpdb->prefix.'mostviewedjob',array('jobid' => $jobid));
								
							}*/
							$this->loadModel('RecentView');
							$ip=$this->RequestHandler->getClientIp();
							$currentdate=date("Y-m-d");
							$is_list_expire=date('Y-m-d', strtotime("+7 days"));
							$exp_all=$this->RecentView->find('all', array( 'conditions' => array('ip_id' => $ip, 'DATE(exp_date) <' => $currentdate), 'order' => array('created' => 'desc'), 'fields' => array('recent_id','adv_id')));
							if(count($exp_all)>0)
							{
								foreach($exp_all as $expRes)
								{
									$deleteView=$this->RecentView->delete(array('recent_id' => $expRes['RecentView']['recent_id']));
								}
							}
							$fetchview=$this->RecentView->find('all', array( 'conditions' => array('adv_id' => $adv_id, 'ip_id' => $ip, 'DATE(exp_date) >=' => $currentdate), 'order' => array('created' => 'desc')));
							if(count($fetchview)<=0)
							{
								$save=$this->RecentView->save(array('adv_id' => $adv_id, 'ip_id' => $ip, 'exp_date' => $is_list_expire));
							}
							$fetchRecent=$this->RecentView->find('list', array( 'conditions' => array('ip_id' => $ip, 'DATE(exp_date) >=' => $currentdate), 'order' => array('created' => 'desc'), 'fields' => array('recent_id','adv_id')));
							$this->set('recentViews', $fetchRecent);
							//In Cookie Method
							/*if($this->Cookie->check('recentSale'))
							{
								$recentSale=$this->Cookie->read('recentSale');
								//echo 2;
								if(!in_array($adv_id, $recentSale))
								{
									$greaterindex=max(array_keys($recentSale));
									$item=$greaterindex+1;
									//setcookie("recentSale[".$item."]", $adv_id, time()+604800);
									$this->Cookie->write("recentSale.".$item,$adv_id, false, 604800);
									
								}
								//print_r($_COOKIE['recentSale']);exit;
								$this->set('recentSale', $this->Cookie->read('recentSale'));

							}
							else
							{
								
								$item=1;
								$this->Cookie->write("recentSale.".$item,$adv_id, false, 604800);
								//echo 1; exit;
								$this->set('recentSale', $this->Cookie->read('recentSale'));
							}*/
							//print_r($this->Cookie->read('recentSale'));exit;
							//=========================
						}
						else
						{
							$userdetail=array();
							$allimg=array();
						}
						$this->set('userDetail',$userdetail);
						$this->set('allimg',$allimg);
						if($this->request->is('post'))
						{
							if(isset($this->request->data['question']))
								{
									//-----------------------------------------------------
									$this->loadModel('MasterMessage');
									$loginBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 29)));
									$incorrectSecurity=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 3)));
									$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>42)));
									$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 43)));
									if($this->request->data['SalesQuestion']['parent']<=0 || $this->request->data['SalesQuestion']['parent']=='')
									{
										$this->request->data['SalesQuestion']['parent']=0;
									}
									//print_r($this->request->data);exit;
									$advuserid = $this->request->data['adv_user_id'];
									$this->loadModel('MasterUser');
									$ad_userDetail = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.user_id'=>$advuserid)));
									$this->loadModel('PostAd');
									$getadv_id = $this->request->data['SalesQuestion']['adv_id'];
									$ad_Detail = $this->PostAd->find('first', array('conditions'=>array('PostAd.adv_id'=>$getadv_id)));
									//print_r($ad_userDetail);
									//print_r($ad_Detail);exit;
									if(!$this->Session->check('User'))
									{
										$this->set('openlogin','yes');
										$this->Session->setFlash(__('<div class="alert alert-danger">'.$loginBlank['MasterMessage']['msg'].'</div>'));
										if(isset($this->request->data['MasterUser']['user_login_id']))
										{
											$useremail=$this->request->data['MasterUser']['user_login_id'];
											$userpass=$this->request->data['MasterUser']['user_pass'];
											$this->loadModel('MasterUser');
											$user_count = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.email'=>$useremail,'MasterUser.pass'=>md5($userpass),'is_active' => 1)));
											if(count($user_count)>0)
											{
												$this->Session->write('User',$user_count['MasterUser']);
											$this->request->data['SalesQuestion']['user_id']=$user_count['MasterUser']['user_id'];
											$this->request->data['SalesQuestion']['status']=1;
												if($this->request->data['adv_user_id']!=$user_count['MasterUser']['user_id'])
												{
														if($this->Session->read('6_letters_code')==$this->request->data['code'])
														{
															$this->loadModel('SalesQuestion');
															if($this->SalesQuestion->save($this->request->data))
															{
																$questionInsertID=$this->SalesQuestion->getLastInsertID();
																$questionPostID=$this->request->data['SalesQuestion']['adv_id'];
																//----------------------sales question Image save functionality---------------------------------
																//print_r($this->Session->read('6_letters_code'));
																//pr($this->request->data);exit;
																//------------------------------------------------------
																if(count($this->request->data['SalesQuestion']['img_files'])>0)

																	{
																		//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

																		foreach($this->request->data['SalesQuestion']['img_files'] as $allimg)

																		{

																			//echo 1;

																			if($allimg['name']!='')

																			{

																			$filename = time().$allimg['name'];

																			//$filename=$this->Ikm->CleanFilePath($filename);

																			// echo $filename;exit;
																			$filename= $this->Dez->CleanFilePath($filename);
																			move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/salesquestion/'.$filename);
																			$uploadedFile=WWW_ROOT.'files/salesquestion/'.$filename;
																			//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
																			$this->request->data['SalesquestionImage']['img_file'] = $filename;
																			}
																			else
																			{

																			$this->request->data['SalesquestionImage']['img_file'] ='';	

																			}

																			$this->request->data['SalesquestionImage']['qid']=$questionInsertID;

																			$this->request->data['SalesquestionImage']['postid']=$questionPostID;
																			$this->loadModel('SalesquestionImage');
																			$this->SalesquestionImage->create();

																			$save=$this->SalesquestionImage->save($this->request->data);

																		}

																		

																	}

																	unset($this->request->data['SalesQuestion']['img_files']);
																//---------------------Sales question Image save end----------------------------------
																/*$this->loadModel('Notice');
																$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment'));*/
																//------------Mail functionality-------------
													$link=Router::url('/pages/sales-details/'.stripslashes($ad_detail['PostAd']['slug']), true);
													$salesQuestionTemp=$this->Dez->BapCustUniGetTemplate(10);
													$salesQSubject=stripslashes($salesQuestionTemp['EmailTemplate']['mail_subject']);
													$message =stripslashes($salesQuestionTemp['EmailTemplate']['mail_body']);
													$message= str_replace('{Name}', stripslashes($ad_userDetail['MasterUser']['first_name']).' '.stripslashes($ad_userDetail['MasterUser']['last_name']), $message);
													$message= str_replace('{PostAdName}', stripslashes($ad_Detail['PostAd']['adv_name']), $message);
													$message= str_replace('{FromName}', stripslashes($user_count['MasterUser']['first_name']).' '.stripslashes($user_count['MasterUser']['last_name']), $message);
													$message= str_replace('{SalesLink}', $link, $message);
														/*$message = '<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td align="left" colspan="2">Salut '.stripslashes($ad_userDetail['MasterUser']['first_name']).' '.stripslashes($ad_userDetail['MasterUser']['last_name']).',</td>
																</tr>
																<tr>
																<td>
																Ai primit o intrebare noua pe piesa '.stripslashes($ad_Detail['PostAd']['adv_name']).' de la utilizatorul from '.stripslashes($user_count['MasterUser']['first_name']).' '.stripslashes($user_count['MasterUser']['last_name']).'.
																<br>
																Faceți clic pe linkul de mai jos pentru a citi și a răspunde:<br>
																<a href="'.$link.'">Citeste si raspunde</a></td>
																</tr>
																<tr>
																	<td align="left">&nbsp;</td>
																</tr>
																<tr>
																	<td align="left" valign="middle">Thank You</td>
																</tr>
																<tr>
																	<td align="left" valign="middle">Dezmembraripenet</td>
																</tr>
															</table>';*/
															if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
															{
																	$this->loadModel('AdminUser');
																	$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
																	if(!empty($siteemail)){$siteemailID=$siteemail['AdminUser']['mail_id'];}else{$siteemailID='info@dezmembraripenet.com';}
																$to_email=$siteemailID;
																$Email = new CakeEmail('default');
																$Email->to($to_email);
																$Email->subject($salesQSubject);
																$Email->replyTo(array($siteemailID => 'Dezmembraripenet'));
																$Email->from (array($siteemailID => 'Dezmembraripenet'));
																$Email->emailFormat('both');
																//$Email->headers();
																$Email->send($message);
																}
													//--------------------------------------------
																$this->loadModel('Notice');
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment'));
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment', 'user_id' => $this->request->data['adv_user_id']));
																$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
																unset($this->request->data);
															}
															else
															{
																$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
															}
														}
														else
														{
															$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectSecurity['MasterMessage']['msg'].'</div>'));
														}
												}
												else if($this->request->data['SalesQuestion']['parent'] > 0 && $this->request->data['SalesQuestion']['parent']!='')
												{
													
														if($this->Session->read('6_letters_code')==$this->request->data['code'])
														{
															$this->loadModel('SalesQuestion');
															if($this->SalesQuestion->save($this->request->data))
															{
																/*$this->loadModel('Notice');
																$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment'));*/
																//------------Mail functionality-------------
													$link=Router::url('/pages/sales-details/'.stripslashes($ad_Detail['PostAd']['slug']), true);
														/*$message = '<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td align="left" colspan="2">Salut '.stripslashes($ad_userDetail['MasterUser']['first_name']).' '.stripslashes($ad_userDetail['MasterUser']['last_name']).',</td>
																</tr>
																<tr>
																	<td align="left">&nbsp;</td>
																</tr>
																<tr>
																<td>
																Ai primit o intrebare noua pe piesa '.stripslashes($ad_Detail['PostAd']['adv_name']).' de la utilizatorul from '.stripslashes($user['first_name']).' '.stripslashes($user['last_name']).'.
																<br>
																Faceți clic pe linkul de mai jos pentru a citi și a răspunde:<br>
																<a href="'.$link.'">Citeste si raspunde</a></td>
																</tr>
																<tr>
																	<td align="left">&nbsp;</td>
																</tr>
																<tr>
																	<td align="left" valign="middle">Thank You</td>
																</tr>
																<tr>
																	<td align="left" valign="middle">Dezmembraripenet</td>
																</tr>
															</table>';*/
															$salesQuestionTemp=$this->Dez->BapCustUniGetTemplate(10);
														$salesQSubject=stripslashes($salesQuestionTemp['EmailTemplate']['mail_subject']);
														$message =stripslashes($salesQuestionTemp['EmailTemplate']['mail_body']);
														$message= str_replace('{Name}', stripslashes($ad_userDetail['MasterUser']['first_name']).' '.stripslashes($ad_userDetail['MasterUser']['last_name']), $message);
														$message= str_replace('{PostAdName}', stripslashes($ad_Detail['PostAd']['adv_name']), $message);
														$message= str_replace('{FromName}', stripslashes($user_count['MasterUser']['first_name']).' '.stripslashes($user_count['MasterUser']['last_name']), $message);
														$message= str_replace('{SalesLink}', $link, $message);
															if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
															{
																	$this->loadModel('AdminUser');
																	$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
																	if(!empty($siteemail)){$siteemailID=$siteemail['AdminUser']['mail_id'];}else{$siteemailID='info@dezmembraripenet.com';}
																$to_email=$ad_userDetail['MasterUser']['email'];;
																$Email = new CakeEmail('default');
																$Email->to($to_email);
																$Email->subject($salesQSubject);
																$Email->replyTo(array($siteemailID => 'Dezmembraripenet'));
																$Email->from (array($siteemailID => 'Dezmembraripenet'));
																$Email->emailFormat('both');
																//$Email->headers();
																$Email->send($message);
																}
													//--------------------------------------------
																$this->loadModel('Notice');
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment'));
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment', 'user_id' => $this->request->data['adv_user_id']));
																$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
																unset($this->request->data);
															}
															else
															{
																$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
															}
														}
														else
														{
															$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectSecurity['MasterMessage']['msg'].'</div>'));
														}
												
												}
												else
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">Nu poti cere întrebare propriul produs .</div>'));
												}
											}
											
										}
										
									}
									else
									{
										
										$user=$this->Session->read('User');
										$this->request->data['SalesQuestion']['user_id']=$user['user_id'];
										$this->request->data['SalesQuestion']['status']=1;
										if($this->request->data['adv_user_id']!=$user['user_id'])
										{
											if($this->Session->read('6_letters_code')==$this->request->data['code'])
											{
												$this->loadModel('SalesQuestion');
												if($this->SalesQuestion->save($this->request->data))
												{
													$questionInsertID=$this->SalesQuestion->getLastInsertID();
													$questionPostID=$this->request->data['SalesQuestion']['adv_id'];
													//----------------------sales question Image save functionality---------------------------------
													//print_r($this->Session->read('6_letters_code'));
													//pr($this->request->data);exit;
													//------------------------------------------------------
													if(count($this->request->data['SalesQuestion']['img_files'])>0)

														{
															//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

															foreach($this->request->data['SalesQuestion']['img_files'] as $allimg)

															{

																//echo 1;

																if($allimg['name']!='')

																{

																$filename = time().$allimg['name'];

																//$filename=$this->Ikm->CleanFilePath($filename);

																// echo $filename;exit;
																$filename= $this->Dez->CleanFilePath($filename);
																move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/salesquestion/'.$filename);
																$uploadedFile=WWW_ROOT.'files/salesquestion/'.$filename;
																//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
																$this->request->data['SalesquestionImage']['img_file'] = $filename;
																}
																else
																{

																$this->request->data['SalesquestionImage']['img_file'] ='';	

																}

																$this->request->data['SalesquestionImage']['qid']=$questionInsertID;

																$this->request->data['SalesquestionImage']['postid']=$questionPostID;
																$this->loadModel('SalesquestionImage');
																$this->SalesquestionImage->create();

																$save=$this->SalesquestionImage->save($this->request->data);

															}

															

														}

														unset($this->request->data['SalesQuestion']['img_files']);
													//---------------------Sales question Image save end----------------------------------
													$sessionUser=$this->Session->read('User');
													$this->loadModel('Notice');
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment'));
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment', 'user_id' => $this->request->data['adv_user_id']));
													$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
													
													
													//------------Mail functionality-------------
													$link=Router::url('/pages/sales-details/'.stripslashes($ad_Detail['PostAd']['slug']), true);
														/*$message = '<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td align="left" colspan="2">Salut '.stripslashes($ad_userDetail['MasterUser']['first_name']).' '.stripslashes($ad_userDetail['MasterUser']['last_name']).',</td>
																</tr>
																<tr>
																<td>
																Ai primit o intrebare noua pe piesa '.stripslashes($ad_Detail['PostAd']['adv_name']).' de la utilizatorul from '.stripslashes($user['first_name']).' '.stripslashes($user['last_name']).'.
																<br>
																Faceți clic pe linkul de mai jos pentru a citi și a răspunde:<br>
																<a href="'.$link.'">Citeste si raspunde</a></td>
																</tr>
																<tr>
																	<td align="left">&nbsp;</td>
																</tr>
																<tr>
																	<td align="left" valign="middle">Thank You</td>
																</tr>
																<tr>
																	<td align="left" valign="middle">Dezmembraripenet</td>
																</tr>
															</table>';*/
															$salesQuestionTemp=$this->Dez->BapCustUniGetTemplate(10);
													$salesQSubject=stripslashes($salesQuestionTemp['EmailTemplate']['mail_subject']);
													$message =stripslashes($salesQuestionTemp['EmailTemplate']['mail_body']);
													$message= str_replace('{Name}', stripslashes($ad_userDetail['MasterUser']['first_name']).' '.stripslashes($ad_userDetail['MasterUser']['last_name']), $message);
													$message= str_replace('{PostAdName}', stripslashes($ad_Detail['PostAd']['adv_name']), $message);
													$message= str_replace('{FromName}', stripslashes($user_count['MasterUser']['first_name']).' '.stripslashes($user_count['MasterUser']['last_name']), $message);
													$message= str_replace('{SalesLink}', $link, $message);
															if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
															{
																	$this->loadModel('AdminUser');
																	$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
																	if(!empty($siteemail)){$siteemailID=$siteemail['AdminUser']['mail_id'];}else{$siteemailID='info@dezmembraripenet.com';}
																$to_email=$ad_userDetail['MasterUser']['email'];
																$Email = new CakeEmail('default');
																$Email->to($to_email);
																$Email->subject($salesQSubject);
																$Email->replyTo(array($siteemailID => 'Dezmembraripenet'));
																$Email->from (array($siteemailID => 'Dezmembraripenet'));
																$Email->emailFormat('both');
																//$Email->headers();
																$Email->send($message);
																}
													//--------------------------------------------
													unset($this->request->data);
												}
												else
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
												}
											}
											else
											{
												$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectSecurity['MasterMessage']['msg'].'</div>'));
											}
										}
										else if($this->request->data['SalesQuestion']['parent'] > 0 && $this->request->data['SalesQuestion']['parent']!='')
										{
											
											if($this->Session->read('6_letters_code')==$this->request->data['code'])
											{
												$this->loadModel('SalesQuestion');
												if($this->SalesQuestion->save($this->request->data))
												{
													$sessionUser=$this->Session->read('User');
													$this->loadModel('Notice');
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment'));
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment', 'user_id' => $this->request->data['adv_user_id']));
													$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
													unset($this->request->data);
												}
												else
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
												}
											}
											else
											{
												$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectSecurity['MasterMessage']['msg'].'</div>'));
											}
										
										}
										else
										{
											$this->Session->setFlash(__('<div class="alert alert-danger">Nu poti cere întrebare propriul produs .</div>'));
										}
									}
								}
						}
						$this->loadModel('SalesQuestion');
					$salesQuestionRes=$this->SalesQuestion->find('all', array('conditions' => array('parent' => 0, 'adv_id' => $salesDetail['PostAd']['adv_id']), 'order' => array('question_id' => 'desc')));
					$this->set('salesQuestionRes', $salesQuestionRes);
						$this->layout="sales_detail";
					}
					endif;
					
				break;
				case 'sales-order' :
				//pr($this);exit;
				if(isset($this->request->params['named']['pid'])){$advid=$this->request->params['named']['pid'];}else{$advid=0;}
				if(isset($this->request->params['named']['qty'])){$qty=$this->request->params['named']['qty'];}else{$qty=0;}
				$this->set('qty',$qty);
				$this->set('advid',$advid);
				if(!$this->Session->check('User'))
				{
					$customPath= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					//$customPath=$_SERVER['HTTP_REFERER']
					$this->Session->write('redirectLink',$customPath);
					return $this->redirect(Router::url('/Logins/login', true));
				}
				$this->loadModel('PostAd');
				if (!$this->PostAd->exists($advid)) {
					if(isset($_SERVER['HTTP_REFERER']))
					{
					$this->redirect($_SERVER['HTTP_REFERER']);
					}
					else
					{
						$this->redirect(Router::url('/', true));
					}
				}
				
				
					//$warrantydetail=$this->helpers->Dez->warrantyDetails($advid);
				$this->loadModel('PostAd');
				$salesDetail=$this->PostAd->find('first', array('conditions' => array('adv_status' => 1, 'adv_id' =>$advid)));
				$this->set('salesDetail',$salesDetail);
				if(!empty($salesDetail))
					{
						
						$userid=$salesDetail['PostAd']['user_id'];
						$adv_id=$salesDetail['PostAd']['adv_id'];
						
						
						$this->loadModel('ManageUser');
						$userdetail=$this->ManageUser->find('first', array('conditions' => array('user_id' => $userid)));
						$this->loadModel('PostadImg');
						$imgdetail=$this->PostadImg->find('first', array('conditions' => array('post_ad_id' => $adv_id)));
						$this->set('title_for_layout', 'Sales Order');
					}
					else
					{
						$userdetail=array();
						$allimg=array();
					}
					$this->set('userDetail',$userdetail);
					$this->set('imgdetail',$imgdetail);
					$this->loadModel('MasterCountry');
				$countylist = array(''=>'-Choose region-');
				$countylist += $this->MasterCountry->find('list', array('fields' => array
		('country_id','country_name'), 'order' =>array('country_name' => 'asc')));
			$this->set('countylist', $countylist);
					//--------------Order save functiona;lity------------
					if($this->request->is('post'))
						{
							//-----------------------------------------------------
							$this->loadModel('MasterMessage');
							$loginBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 29)));
							$ownSalesValidate=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 53)));
							$alreadyOrder=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 54)));
							$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>55)));
							$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 56)));
							$deliveryblnk=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 47)));
							
							//-------------------------------------------------------
							$this->loadModel('SalesWarranty');
							$warrantyDetails=$this->SalesWarranty->find('first', array('conditions' => array('SalesWarranty.user_id' => $userid)));
							if(!empty($warrantyDetails))
							{
								if($warrantyDetails['SalesWarranty']['message_response']==1)
								{
									$msgdetail='<table><tr><td colspan="3">'.nl2br(stripslashes($warrantyDetails['SalesWarranty']['message_content'])).'</td></tr></table>';
								}
								else
								{
									$msgdetail='<table><tr><td colspan="3">Your order booked has been successfully purchased.<br/></td></tr>
							  <tr><td colspan="3">Thank you for your purchase!<br/><br/></td></tr></table>';
								}
							}
							else
							{
								$msgdetail='</table><tr><td colspan="3">Your order booked has been successfully purchased.<br/></td></tr>
						  <tr><td colspan="3">Thank you for your purchase!<br/><br/></td></tr></table>';
							}
							$this->loadModel('SalesOrder');
							if(isset($this->request->data['order_send']))
							{
								$lastid=$this->SalesOrder->find('first', array('order' => array('id' => 'desc')));
								  if(!empty($lastid))
								  {
									$lsid=$lastid['SalesOrder']['orderid'];
									$lastempid=explode('R',$lsid); 
									$lastempid1=$lastempid[1]+1;
									$orderID=$lastempid[0].'R'.$lastempid1;
								  }else{
									$orderID='OR10001';
								  }
								  $this->request->data['SalesOrder']['orderid']=$orderID;
								//print_r($this->Session->read('6_letters_code'));
								//pr($this->request->data);exit;
								if(!$this->Session->check('User'))
								{
									$this->set('openlogin','yes');
									$this->Session->setFlash(__('<div class="alert alert-danger">'.$loginBlank['MasterMessage']['msg'].'</div>'));
									if(isset($this->request->data['MasterUser']['user_login_id']))
									{
										$useremail=$this->request->data['MasterUser']['user_login_id'];
										$userpass=$this->request->data['MasterUser']['user_pass'];
										$this->loadModel('MasterUser');
										$user_count = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.email'=>$useremail,'MasterUser.pass'=>md5($userpass),'is_active' => 1)));
										if(count($user_count)>0)
										{
											$cpuntsalesorder=$this->SalesOrder->find('count', array('conditions' => array('user_id' => $user_count['MasterUser']['user_id'], 'status' => 1, 'adv_id' => $this->request->data['SalesOrder']['adv_id'])));
											$cpuntsalesorder=0;
											$postAd=$this->loadModel('PostAd');
											$aduserchk=$this->PostAd->find('count', array('conditions' => array('adv_id' => $this->request->data['SalesOrder']['adv_id'],'user_id' => $user_count['MasterUser']['user_id'])));
											if($aduserchk>0)
											{
												$this->Session->setFlash(__('<div class="alert alert-danger">'.$ownSalesValidate['MasterMessage']['msg'].'</div>'));
											}
											else
											{
												if($cpuntsalesorder>0)
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$alreadyOrder['MasterMessage']['msg'].'</div>'));
												}
												else
												{		
												$this->Session->write('User',$user_count['MasterUser']);
											$this->request->data['SalesOrder']['user_id']=$user_count['MasterUser']['user_id'];
														
															$this->loadModel('SalesOrder');
														if($this->request->data['SalesOrder']['delivery_method']=='')
														{
															$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryblnk['MasterMessage']['msg'].'</div>'));
														}
														else
														{
															$this->request->data['SalesOrder']['status']=0;
															if($this->SalesOrder->save($this->request->data))
															{
																$baseurl='http://'.$_SERVER['SERVER_NAME'].Router::url('/');
																//Mail Functionality----------------
																$MyPurchaseLink='<a href="'.$baseurl.'pages/my-purchases">here</a>';
																$username=stripslashes($this->request->data['SalesOrder']['fname']).' '.stripslashes($this->request->data['SalesOrder']['lname']);
																
																
																$OrderrId='Order ID#: <strong>'.$orderID.'</strong>';
																$OrderDetaill='<table width="492" border="1">
																	  <tr>
																	  <td width="30%" align="center">Title</td>
																	  <td width="31%" align="center">Quantity</td>
																	  <td width="30%" align="center">Price</td>
																	  </tr><tr>
																		<td>'.stripslashes($salesDetail['PostAd']['adv_name']).'</td>
																		<td>'.stripslashes($this->request->data['SalesOrder']['qty']).'</td>
																		<td>'.stripslashes($this->request->data['SalesOrder']['totprice']).' RON</td>
																	  </tr><table>';
																$posttemplateDetail=$this->Dez->BapCustUniGetTemplate(3);
																$postSubject=stripslashes($posttemplateDetail['EmailTemplate']['mail_subject']);
																$body =stripslashes($posttemplateDetail['EmailTemplate']['mail_body']);
																$body= str_replace('{Name}', $username, $body);
																$body= str_replace('{sellerMsgDetail}', $msgdetail, $body);
																$body= str_replace('{MyPurchaseLink}', $MyPurchaseLink, $body);
																$body= str_replace('{OrderId}', $OrderrId, $body);
																$body= str_replace('{OrderDetail}', $OrderDetaill, $body);
																/*$body='<table width="492" cellspacing="0" cellpadding="0">
																  <tr><td colspan="3">Dear '.stripslashes($this->request->data['SalesOrder']['fname']).' '.stripslashes($this->request->data['SalesOrder']['lname']).',</td></tr>
																  <tr><td colspan="3">&nbsp;</td></tr>
																 '.$msgdetail.'
																 <tr><td colspan="3">&nbsp;</td></tr>
																  <tr><td colspan="3">Click <a href="'.$baseurl.'pages/my-purchases">here</a> to go your order list page</td></tr>
																 <tr><td colspan="3">&nbsp;</td></tr>
																  <tr><td colspan="3">Your Order Details<br/></td></tr>
																  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																  <tr><td colspan="3">Your Details: <br/><br/></td></tr></table>';
																$body.='<table width="492" border="1">
																  <tr>
																  <td width="30%" align="center">Title</td>
																  <td width="31%" align="center">Quantity</td>
																  <td width="30%" align="center">Price</td>
																  </tr>';
																   $body.='<tr>
																		<td>'.stripslashes($salesDetail['PostAd']['adv_name']).'</td>
																		<td>'.stripslashes($this->request->data['SalesOrder']['qty']).'</td>
																		<td>'.stripslashes($this->request->data['SalesOrder']['totprice']).' RON</td>
																	  </tr>
																	  </table>';
																	  $body.='<table width="492">
																	  <tr><td colspan="3"><br/>Regards,</td></tr>
																	  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																	  </table>';*/
																	  
																	  //Admin & poat ads submit User Mail ====================
																	  $aposttemplateDetail=$this->Dez->BapCustUniGetTemplate(5);
																		$apostSubject=stripslashes($aposttemplateDetail['EmailTemplate']['mail_subject']);
																		$abody =stripslashes($aposttemplateDetail['EmailTemplate']['mail_body']);
																		$abody= str_replace('{Name}', $username, $abody);
																		$abody= str_replace('{OrderId}', $OrderrId, $abody);
																		$abody= str_replace('{OrderDetail}', $OrderDetaill, $abody);
																	 /* $abody='<table width="492">
																	  <tr><td colspan="3"><u><strong>Order Details</strong></u></td></tr>
																	  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																	  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';
																	 
																 $abody.='<table width="492" border="1">
																  <tr>
																  <td width="30%" align="center">Title</td>
																  <td width="31%" align="center">Quantity</td>
																  <td width="30%" align="center">Price</td>
																  </tr>';
																  $abody.='<tr>
																		<td>'.stripslashes($salesDetail['PostAd']['adv_name']).'</td>
																		<td>'.stripslashes($this->request->data['SalesOrder']['qty']).'</td>
																		<td>'.stripslashes($this->request->data['SalesOrder']['totprice']).' RON</td>
																	  </tr>
																	  </table>';
																	   $abody.='<table width="492">
																	  <tr><td colspan="3"><br/>Regards,</td></tr>
																	  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																	  </table>';*/
																	  //=========Post User Body==============
																	   $pposttemplateDetail=$this->Dez->BapCustUniGetTemplate(6);
																		$ppostSubject=stripslashes($pposttemplateDetail['EmailTemplate']['mail_subject']);
																		$pbody =stripslashes($pposttemplateDetail['EmailTemplate']['mail_body']);
																		$pbody= str_replace('{Name}', $username, $pbody);
																		$pbody= str_replace('{OrderId}', $OrderrId, $pbody);
																		$pbody= str_replace('{OrderDetail}', $OrderDetaill, $pbody);
																		$pbody= str_replace('{CommandLink}', '<a href="'.$baseurl.'pages/commands">here</a>', $pbody);
																	  /* $pbody='<table width="492">
																	   <tr><td colspan="3">A new order has been successfully ordered on your product.</td></tr>
																	   <tr><td colspan="3">&nbsp;</td></tr>
																	  <tr><td colspan="3"><u><strong>Order Details</strong></u></td></tr>
																	  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																	  <tr><td colspan="3">&nbsp;</td></tr>
																  <tr><td colspan="3">Click <a href="'.$baseurl.'pages/commands">here</a> to view order against  your product</td></tr>
																  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';
																	 
																	 $pbody.='<table width="492" border="1">
																	  <tr>
																	  <td width="30%" align="center">Title</td>
																	  <td width="31%" align="center">Quantity</td>
																	  <td width="30%" align="center">Price</td>
																	  </tr>';
																	  $pbody.='<tr>
																			<td>'.stripslashes($salesDetail['PostAd']['adv_name']).'</td>
																			<td>'.stripslashes($this->request->data['SalesOrder']['qty']).'</td>
																			<td>'.stripslashes($this->request->data['SalesOrder']['totprice']).' RON</td>
																		  </tr>
																		  </table>';
																		   $pbody.='<table width="492">
																		  <tr><td colspan="3"><br/>Regards,</td></tr>
																		  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																		  </table>';*/
																	  
																	  if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
																	{
																	$to_email=$user_count['MasterUser']['email'];
																	$this->loadModel('AdminUser');
																		$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
							if(!empty($siteemail)){$adminemail=$siteemail['AdminUser']['mail_id'];}else{$adminemail='info@dezmembraripenet.com';}
																	$Email = new CakeEmail('default');
																	$Email->to($to_email);
																	$Email->subject($postSubject);
																	$Email->replyTo($adminemail);
																	$Email->from (array($adminemail => 'Dezmembraripenet'));
																	$Email->emailFormat('both');
																	//$Email->headers();
																	$Email->send($body);
																	
																	//Admin Mail-----------------
																	$adminEmail = new CakeEmail('default');
																	$adminEmail->to($adminemail);
																	$adminEmail->subject($apostSubject);
																	$adminEmail->replyTo($adminemail);
																	$adminEmail->from (array($to_email => 'Dezmembraripenet'));
																	$adminEmail->emailFormat('both');
																	//$Email->headers();
																	$adminEmail->send($abody);
																	//----------------------------
																	
																		//Admin Mail-----------------
																		$postuserEmail = new CakeEmail('default');
																		$postuserEmail->to($userdetail['ManageUser']['email']);
																		$postuserEmail->subject($ppostSubject);
																		$postuserEmail->replyTo($adminemail);
																		$postuserEmail->from (array($to_email => 'Dezmembraripenet'));
																		$postuserEmail->emailFormat('both');
																		//$Email->headers();
																		$postuserEmail->send($pbody);
																		//----------------------------
																	}
																//-----------------------------------
																$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
																$sessionUser=$this->Session->read('User');
																$this->loadModel('Notice');
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'sales-order', 'postid' => $this->request->data['SalesOrder']['adv_id'], 'notice_name' => 'Sales Order'));
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'sales-order', 'postid' => $this->request->data['SalesOrder']['adv_id'], 'notice_name' => 'Sales Order', 'user_id' => $this->request->data['adv_userid']));
																unset($this->request->data);
															}
															else
															{
																$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
															}
														}
												}
											}
											
													
													
										}
										
									}
									
								}
								else
								{
									$user=$this->Session->read('User');
									$this->request->data['SalesOrder']['user_id']=$user['user_id'];
											$this->loadModel('SalesOrder');
										if($this->request->data['SalesOrder']['delivery_method']=='')
										{
											$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryblnk['MasterMessage']['msg'].'</div>'));
										}
										else
										{
											$cpuntsalesorder=$this->SalesOrder->find('count', array('conditions' => array('user_id' => $user['user_id'], 'status' => 1, 'adv_id' => $this->request->data['SalesOrder']['adv_id'])));
											$cpuntsalesorder=0;
											$postAd=$this->loadModel('PostAd');
											$aduserchk=$this->PostAd->find('count', array('conditions' => array('adv_id' => $this->request->data['SalesOrder']['adv_id'],'user_id' => $user['user_id'])));
											if($aduserchk>0)
											{
												$this->Session->setFlash(__('<div class="alert alert-danger">'.$ownSalesValidate['MasterMessage']['msg'].'</div>'));
											}
											else
											{
												if($cpuntsalesorder>0)
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$alreadyOrder['MasterMessage']['msg'].'</div>'));
												}
												else
												{
													$this->request->data['SalesOrder']['status']=0;
													if($this->SalesOrder->save($this->request->data))
													{
														$baseurl='http://'.$_SERVER['SERVER_NAME'].Router::url('/');
														//Mail Functionality----------------
														$MyPurchaseLink='<a href="'.$baseurl.'pages/my-purchases">here</a>';
																$username=stripslashes($this->request->data['SalesOrder']['fname']).' '.stripslashes($this->request->data['SalesOrder']['lname']);
																
																
																$OrderrId='Order ID#: <strong>'.$orderID.'</strong>';
																$OrderDetaill='<table width="492" border="1">
																	  <tr>
																	  <td width="30%" align="center">Title</td>
																	  <td width="31%" align="center">Quantity</td>
																	  <td width="30%" align="center">Price</td>
																	  </tr><tr>
																		<td>'.stripslashes($salesDetail['PostAd']['adv_name']).'</td>
																		<td>'.stripslashes($this->request->data['SalesOrder']['qty']).'</td>
																		<td>'.stripslashes($this->request->data['SalesOrder']['totprice']).' RON</td>
																	  </tr></table>';
																$posttemplateDetail=$this->Dez->BapCustUniGetTemplate(3);
																$postSubject=stripslashes($posttemplateDetail['EmailTemplate']['mail_subject']);
																$body =stripslashes($posttemplateDetail['EmailTemplate']['mail_body']);
																$body= str_replace('{Name}', $username, $body);
																$body= str_replace('{sellerMsgDetail}', $msgdetail, $body);
																$body= str_replace('{MyPurchaseLink}', $MyPurchaseLink, $body);
																$body= str_replace('{OrderId}', $OrderrId, $body);
																$body= str_replace('{OrderDetail}', $OrderDetaill, $body);
																	/*$body='<table width="492" cellspacing="0" cellpadding="0">
																	  <tr><td colspan="3">Dear '.stripslashes($this->request->data['SalesOrder']['fname']).' '.stripslashes($this->request->data['SalesOrder']['lname']).',</td></tr>
																	  <tr><td colspan="3">&nbsp;</td></tr>
																	 '.$msgdetail.'
																	  <tr><td colspan="3">&nbsp;</td></tr>
																  <tr><td colspan="3">Click <a href="'.$baseurl.'pages/my-purchases">here</a> to go your order list page</td></tr>
																	  <tr><td colspan="3">&nbsp;</td></tr>
																	  <tr><td colspan="3">Your Membership Details<br/></td></tr>
																	  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																	  <tr><td colspan="3">Your Details: <br/><br/></td></tr></table>';
																	$body.='<table width="492" border="1">
																	  <tr>
																	  <td width="30%" align="center">Title</td>
																	  <td width="31%" align="center">Quantity</td>
																	  <td width="30%" align="center">Price</td>
																	  </tr>';
																	   $body.='<tr>
																			<td>'.stripslashes($salesDetail['PostAd']['adv_name']).'</td>
																			<td>'.stripslashes($this->request->data['SalesOrder']['qty']).'</td>
																			<td>'.stripslashes($this->request->data['SalesOrder']['totprice']).' RON</td>
																		  </tr>
																		  </table>';
																		  $body.='<table width="492">
																		  <tr><td colspan="3"><br/>Regards,</td></tr>
																		  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																		  </table>';*/
																		  
																		  //Admin & poat ads submit User Mail ====================
																		 /* $abody='<table width="492">
																		  <tr><td colspan="3"><u><strong>Order Details</strong></u></td></tr>
																		  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																		  <tr><td colspan="3">&nbsp;</td></tr>
																		  </table>';
																		 
																	 $abody.='<table width="492" border="1">
																	  <tr>
																	  <td width="30%" align="center">Title</td>
																	  <td width="31%" align="center">Quantity</td>
																	  <td width="30%" align="center">Price</td>
																	  </tr>';
																	  $abody.='<tr>
																			<td>'.stripslashes($salesDetail['PostAd']['adv_name']).'</td>
																			<td>'.stripslashes($this->request->data['SalesOrder']['qty']).'</td>
																			<td>'.stripslashes($this->request->data['SalesOrder']['totprice']).' RON</td>
																		  </tr>
																		  </table>';
																		   $abody.='<table width="492">
																		  <tr><td colspan="3"><br/>Regards,</td></tr>
																		  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																		  </table>';*/
																		  $aposttemplateDetail=$this->Dez->BapCustUniGetTemplate(5);
																		$apostSubject=stripslashes($aposttemplateDetail['EmailTemplate']['mail_subject']);
																		$abody =stripslashes($aposttemplateDetail['EmailTemplate']['mail_body']);
																		$abody= str_replace('{Name}', $username, $abody);
																		$abody= str_replace('{OrderId}', $OrderrId, $abody);
																		$abody= str_replace('{OrderDetail}', $OrderDetaill, $abody);
																		   //=========Post User Body==============
																	  /* $pbody='<table width="492">
																	  <tr><td colspan="3">A new order has been successfully ordered on your product.</td></tr>
																	   <tr><td colspan="3">&nbsp;</td></tr>
																	  <tr><td colspan="3"><u><strong>Order Details</strong></u></td></tr>
																	  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																	  <tr><td colspan="3">&nbsp;</td></tr>
																  <tr><td colspan="3">Click <a href="'.$baseurl.'pages/commands">here</a> to view order against  your product</td></tr>
																  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';
																	 
																	 $pbody.='<table width="492" border="1">
																	  <tr>
																	  <td width="30%" align="center">Title</td>
																	  <td width="31%" align="center">Quantity</td>
																	  <td width="30%" align="center">Price</td>
																	  </tr>';
																	  $pbody.='<tr>
																			<td>'.stripslashes($salesDetail['PostAd']['adv_name']).'</td>
																			<td>'.stripslashes($this->request->data['SalesOrder']['qty']).'</td>
																			<td>'.stripslashes($this->request->data['SalesOrder']['totprice']).' RON</td>
																		  </tr>
																		  </table>';
																		   $pbody.='<table width="492">
																		  <tr><td colspan="3"><br/>Regards,</td></tr>
																		  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																		  </table>';*/
																		  $pposttemplateDetail=$this->Dez->BapCustUniGetTemplate(6);
																		$ppostSubject=stripslashes($pposttemplateDetail['EmailTemplate']['mail_subject']);
																		$pbody =stripslashes($pposttemplateDetail['EmailTemplate']['mail_body']);
																		$pbody= str_replace('{Name}', $username, $pbody);
																		$pbody= str_replace('{OrderId}', $OrderrId, $pbody);
																		$pbody= str_replace('{OrderDetail}', $OrderDetaill, $pbody);
																		$pbody= str_replace('{CommandLink}', '<a href="'.$baseurl.'pages/commands">here</a>', $pbody);
																		  
																		  if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
																		{
																		$to_email=$user['email'];
																		$this->loadModel('AdminUser');
																		$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
							if(!empty($siteemail)){$adminemail=$siteemail['AdminUser']['mail_id'];}else{$adminemail='info@dezmembraripenet.com';}
																		//$adminemail="chittas970@gmail.com";
																		$Email = new CakeEmail('default');
																		$Email->to($to_email);
																		$Email->subject($postSubject);
																		$Email->replyTo($adminemail);
																		$Email->from (array($adminemail => 'Dezmembraripenet'));
																		$Email->emailFormat('both');
																		//$Email->headers();
																		$Email->send($body);
																		
																		//Admin Mail-----------------
																		$adminEmail = new CakeEmail('default');
																		$adminEmail->to($adminemail);
																		$adminEmail->subject($apostSubject);
																		$adminEmail->replyTo($adminemail);
																		$adminEmail->from (array($to_email => 'Dezmembraripenet'));
																		$adminEmail->emailFormat('both');
																		//$Email->headers();
																		$adminEmail->send($abody);
																		//----------------------------
																		
																			//Admin Mail-----------------
																			$postuserEmail = new CakeEmail('default');
																			$postuserEmail->to($userdetail['ManageUser']['email']);
																			$postuserEmail->subject($ppostSubject);
																			$postuserEmail->replyTo($adminemail);
																			$postuserEmail->from (array($to_email => 'Dezmembraripenet'));
																			$postuserEmail->emailFormat('both');
																			//$Email->headers();
																			$postuserEmail->send($pbody);
																			//----------------------------
																		}
																	//-----------------------------------
														$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
														/*$this->loadModel('Notice');
																$this->Notice->save(array('notice_type' => 'sales-order', 'postid' => $this->request->data['SalesOrder']['adv_id'], 'notice_name' => 'Sales Order'));*/
														$sessionUser=$this->Session->read('User');
														$this->loadModel('Notice');
														$this->Notice->create();
														$this->Notice->save(array('notice_type' => 'sales-order', 'postid' => $this->request->data['SalesOrder']['adv_id'], 'notice_name' => 'Sales Order'));
														$this->Notice->create();
														$this->Notice->save(array('notice_type' => 'sales-order', 'postid' => $this->request->data['SalesOrder']['adv_id'], 'notice_name' => 'Sales Order', 'user_id' => $this->request->data['adv_userid']));
														//$this->redirect(Router::url('/', true));
														unset($this->request->data);
													}
													else
													{
														$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
													}
												}
											}
										}
								}
							}
							//echo $body;exit;

						}
						else
						{
							if($this->Session->check('User'))
							{
							$sess_data=$this->Session->read('User');
							$this->request->data['SalesOrder']['fname']=$sess_data['first_name'];
							$this->request->data['SalesOrder']['lname']=$sess_data['last_name'];
							$this->request->data['SalesOrder']['phone']=$sess_data['telephone1'];
							$this->request->data['SalesOrder']['county']=$sess_data['country_id'];
							$this->request->data['SalesOrder']['location']=$sess_data['locality_id'];
							$this->request->data['SalesOrder']['postcode']=$sess_data['postal_code'];
							}
						}
					//---------------------------------------------------
					
				$this->layout="sales_order";
				
				break;
				case 'request-parts-active' :
				$this->loadModel("RequestPart");
				
				$andwhr=array();
				$orwhr=array();
		
		array_push($andwhr,array('RequestAccessory.status' => 1, 'RequestPart.status' => 1));
		
		$brand_id=@$this->request->params['named']['brand_id']!=''?@$this->request->params['named']['brand_id']:'';
		$model_id=@$this->request->params['named']['model_id']!=''?@$this->request->params['named']['model_id']:'';
		$county_id=@$this->request->params['named']['county_id']!=''?@$this->request->params['named']['county_id']:'';
		$app_id=@$this->request->params['named']['app_id']!=''?@$this->request->params['named']['app_id']:'';
		
		if($brand_id!=''){
			$brand_id=urldecode($brand_id);
	array_push($andwhr,array('RequestPart.brand_id'=>$brand_id));
			
		}
		//pr($cond);
		if($model_id!=''){
			$model_id=urldecode($model_id);
			array_push($andwhr,array('RequestPart.model_id'=>$model_id));
			
		}
		if($county_id!=''){
			$county_id=urldecode($county_id);
			array_push($andwhr,array('RequestPart.county'=>$county_id));
			
		}
		if($app_id!=''){
			$app_id=urldecode($app_id);
			array_push($andwhr,array('RequestPart.status'=>$app_id));
		}
	
		
		

				// for active request parts
				$this->set('title_for_layout','Request parts');
				
				$this->Paginator->settings =array(             
					'joins' =>
							  array(
								array(
									'table' => 'request_accessories',
									'alias' => 'RequestAccessory',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('RequestAccessory.request_id = RequestPart.request_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => $andwhr),
							 'fields' =>
							 array('RequestPart.*','RequestAccessory.*'),
							 'group by'=>'RequestPart.request_id',
							 'order' =>
							  array('RequestPart.request_id' => 'desc'),
							  'limit' =>10
						);
			
		
				//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
				$this->set('active_request', $this->Paginator->paginate('RequestPart'));
				$this->set('request_flag',1);
				$this->set('brand_id', $brand_id);
				$this->set('model_id', $model_id);
				$this->set('county_id', $county_id);
				$this->set('app_id', $app_id);
				
	
				$this->layout="request_parts_all";
				break;
				
				case 'request-parts-solved' :
				$this->loadModel("RequestPart");
				
				$andwhr=array();
				$orwhr=array();
		
		array_push($andwhr,array('RequestAccessory.status' => 2, 'RequestPart.status' => 1));
		
		$brand_id=@$this->request->params['named']['brand_id']!=''?@$this->request->params['named']['brand_id']:'';
		$model_id=@$this->request->params['named']['model_id']!=''?@$this->request->params['named']['model_id']:'';
		$county_id=@$this->request->params['named']['county_id']!=''?@$this->request->params['named']['county_id']:'';
		$app_id=@$this->request->params['named']['app_id']!=''?@$this->request->params['named']['app_id']:'';
		
		if($brand_id!=''){
			$brand_id=urldecode($brand_id);
	array_push($andwhr,array('RequestPart.brand_id'=>$brand_id));
			
		}
		//pr($cond);
		if($model_id!=''){
			$model_id=urldecode($model_id);
			array_push($andwhr,array('RequestPart.model_id'=>$model_id));
			
		}
		if($county_id!=''){
			$county_id=urldecode($county_id);
			array_push($andwhr,array('RequestPart.county'=>$county_id));
			
		}
		if($app_id!=''){
			$app_id=urldecode($app_id);
			array_push($andwhr,array('RequestPart.status'=>$app_id));
		}
	
		
		

				// for active request parts
				$this->set('title_for_layout','Request parts');
				
				$this->Paginator->settings =array(             
					'joins' =>
							  array(
								array(
									'table' => 'request_accessories',
									'alias' => 'RequestAccessory',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('RequestAccessory.request_id = RequestPart.request_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => $andwhr),
							 'fields' =>
							 array('RequestPart.*','RequestAccessory.*'),
							 'group by'=>'RequestPart.request_id',
							 'order' =>
							  array('RequestAccessory.part_id' => 'desc'),
							  'limit' =>10
						);
			
		
				//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
				$this->set('active_request', $this->Paginator->paginate('RequestPart'));
				$this->set('request_flag',2); // for solved request
				$this->set('brand_id', $brand_id);
				$this->set('model_id', $model_id);
				$this->set('county_id', $county_id);
				$this->set('app_id', $app_id);
				
	
				$this->layout="request_parts_all";
				break;
				case 'my-purchases':
				
				//------------------------------------------
				// My purchase code
				//-------------------------------------------
					if(!$this->Session->check('User'))
					{
						return $this->redirect(Router::url('/', true));
					}
					$userres=$this->Session->read('User');
					$this->set('title_for_layout','My Purchases');
					$this->loadModel('SalesOrder');
					$this->Paginator->settings =array(             
					'joins' =>
							  array(
								array(
									'table' => 'sales_advertisements',
									'alias' => 'PostAd',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('PostAd.adv_id = SalesOrder.adv_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => array('SalesOrder.user_id' =>$userres['user_id'] )),
							 'fields' =>
							 array('PostAd.*','SalesOrder.*'),
							 'order' =>
							  array('SalesOrder.orderid' => 'desc'),
							  'limit' =>10
						);
			
		
				//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
				$this->set('SalesOrders', $this->Paginator->paginate('SalesOrder'));
					$this->layout="my_purchase";
				break;
				case 'rating-receive-buyer':
				
				//------------------------------------------
				// My purchase code
				//-------------------------------------------
					if(!$this->Session->check('User'))
					{
						return $this->redirect(Router::url('/', true));
					}
					$userres=$this->Session->read('User');
					$this->set('title_for_layout','Rating received Buyer');
					$this->loadModel('SalesOrder');
					$this->Paginator->settings =array(             
					'joins' =>
							  array(
								array(
									'table' => 'sales_advertisements',
									'alias' => 'PostAd',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('PostAd.adv_id = SalesOrder.adv_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => array('SalesOrder.user_id' =>$userres['user_id'] )),
							 'fields' =>
							 array('PostAd.*','SalesOrder.*'),
							 'order' =>
							  array('SalesOrder.orderid' => 'desc'),
							  'limit' =>10
						);
			
		
				//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
				$this->set('SalesOrders', $this->Paginator->paginate('SalesOrder'));
					$this->layout="rating_receive_buyer";
				break;
				case 'rating-given-seller':
				
				//------------------------------------------
				// My purchase code
				//-------------------------------------------
					if(!$this->Session->check('User'))
					{
						return $this->redirect(Router::url('/', true));
					}
					$userres=$this->Session->read('User');
					$this->set('title_for_layout','Rating given Seller');
					$this->loadModel('SalesOrder');
					$this->Paginator->settings =array(             
					'joins' =>
							  array(
								array(
									'table' => 'sales_advertisements',
									'alias' => 'PostAd',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('PostAd.adv_id = SalesOrder.adv_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => array('SalesOrder.user_id' =>$userres['user_id'] )),
							 'fields' =>
							 array('PostAd.*','SalesOrder.*'),
							 'order' =>
							  array('SalesOrder.orderid' => 'desc'),
							  'limit' =>10
						);
			
		
				//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
				$this->set('SalesOrders', $this->Paginator->paginate('SalesOrder'));
					$this->layout="rating_given_seller";
				break;
				case 'sales-order-list':
				
				//------------------------------------------
				// My purchase code
				//-------------------------------------------
					if(!$this->Session->check('User'))
					{
						return $this->redirect(Router::url('/', true));
					}
					$userres=$this->Session->read('User');
					$this->set('title_for_layout','Rating given Seller');
					$this->loadModel('SalesOrder');
					$this->Paginator->settings =array(             
					'joins' =>
							  array(
								array(
									'table' => 'sales_advertisements',
									'alias' => 'PostAd',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('PostAd.adv_id = SalesOrder.adv_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => array('SalesOrder.user_id' =>$userres['user_id'] )),
							 'fields' =>
							 array('PostAd.*','SalesOrder.*'),
							 'order' =>
							  array('SalesOrder.orderid' => 'desc'),
							  'limit' =>10
						);
			
		
				//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
				$this->set('SalesOrders', $this->Paginator->paginate('SalesOrder'));
					$this->layout="sales_order_list";
				break;
				case 'rating-receive-seller':
				
				//------------------------------------------
				// My purchase code
				//-------------------------------------------
					if(!$this->Session->check('User'))
					{
						return $this->redirect(Router::url('/', true));
					}
					$userres=$this->Session->read('User');
					$this->set('title_for_layout','Rating received Seller');
					$this->loadModel('SalesOrder');
					$this->Paginator->settings =array(             
					'joins' =>
							  array(
								array(
									'table' => 'sales_advertisements',
									'alias' => 'PostAd',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('PostAd.adv_id = SalesOrder.adv_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => array('PostAd.user_id' =>$userres['user_id'] )),
							 'fields' =>
							 array('PostAd.*','SalesOrder.*'),
							 'order' =>
							  array('SalesOrder.orderid' => 'desc'),
							  'limit' =>10
						);
			
		
				//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
				$this->set('SalesOrders', $this->Paginator->paginate('SalesOrder'));
					$this->layout="rating_receive_seller";
				break;
				case 'rating-given-buyer':
				
				//------------------------------------------
				// My purchase code
				//-------------------------------------------
					if(!$this->Session->check('User'))
					{
						return $this->redirect(Router::url('/', true));
					}
					$userres=$this->Session->read('User');
					$this->set('title_for_layout','Rating given Buyer');
					$this->loadModel('SalesOrder');
					$this->Paginator->settings =array(             
					'joins' =>
							  array(
								array(
									'table' => 'sales_advertisements',
									'alias' => 'PostAd',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('PostAd.adv_id = SalesOrder.adv_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => array('PostAd.user_id' =>$userres['user_id'] )),
							 'fields' =>
							 array('PostAd.*','SalesOrder.*'),
							 'order' =>
							  array('SalesOrder.orderid' => 'desc'),
							  'limit' =>10
						);
			
		
				//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
				$this->set('SalesOrders', $this->Paginator->paginate('SalesOrder'));
					$this->layout="rating_given_buyer";
				break;
				case 'my-question' :
				
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		  }
		  $this->set('title_for_layout','My Question');	
				$this->loadModel('SalesQuestion');
				$user=$this->Session->read('User');
				$userid=$user['user_id'];
				//pr($user_id);exit;
				$options=array( 
				'conditions' =>array('SalesQuestion.user_id'=>$userid,'SalesQuestion.parent'=>0),
							'order' =>array('SalesQuestion.question_id' => 'desc')
								);
				$this->Paginator->settings=$options;
				$this->set('SalesQuestion', $this->Paginator->paginate('SalesQuestion'));
				
				 $this->layout='my_question';
				break;
				case 'my-question-reply' :
				$questionid=$this->request->params['pass'][1];
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		  }
		  $this->set('title_for_layout','Question Reply');	
				$this->loadModel('SalesQuestion');
				$user=$this->Session->read('User');
				$userid=$user['user_id'];
				//pr($user_id);exit;
				$options=array( 
				'conditions' =>array('SalesQuestion.parent'=>$questionid),
							'order' =>array('SalesQuestion.question_id' => 'desc')
								);
				$this->Paginator->settings=$options;
				$this->set('SalesQuestion', $this->Paginator->paginate('SalesQuestion'));
				if($this->request->is('post'))
					{
						//-----------------------------------------------------
						$this->loadModel('MasterMessage');
						$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>66)));
						$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 67)));
						
						//-------------------------------------------------------
						if(isset($this->request->data['question']))
							{
									$user=$this->Session->read('User');
									$this->request->data['SalesQuestion']['user_id']=$user['user_id'];
									$this->request->data['SalesQuestion']['status']=1;
									$this->loadModel('SalesQuestion');
									if($this->SalesQuestion->save($this->request->data))
									{
										$questionInsertID=$this->SalesQuestion->getLastInsertID();
										$questionPostID=$this->request->data['SalesQuestion']['adv_id'];
										//----------------------sales question Image save functionality---------------------------------
										//print_r($this->Session->read('6_letters_code'));
										//pr($this->request->data);exit;
										//------------------------------------------------------
										if(count($this->request->data['SalesQuestion']['img_files'])>0)

											{
												//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

												foreach($this->request->data['SalesQuestion']['img_files'] as $allimg)

												{

													//echo 1;

													if($allimg['name']!='')

													{

													$filename = time().$allimg['name'];

													//$filename=$this->Ikm->CleanFilePath($filename);

													// echo $filename;exit;
													$filename= $this->Dez->CleanFilePath($filename);
													move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/salesquestion/'.$filename);
													$uploadedFile=WWW_ROOT.'files/salesquestion/'.$filename;
													//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
													$this->request->data['SalesquestionImage']['img_file'] = $filename;
													}
													else
													{

													$this->request->data['SalesquestionImage']['img_file'] ='';	

													}

													$this->request->data['SalesquestionImage']['qid']=$questionInsertID;

													$this->request->data['SalesquestionImage']['postid']=$questionPostID;
													$this->loadModel('SalesquestionImage');
													$this->SalesquestionImage->create();

													$save=$this->SalesquestionImage->save($this->request->data);

												}

												

											}

											unset($this->request->data['SalesQuestion']['img_files']);
										//---------------------Sales question Image save end----------------------------------
										$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
										unset($this->request->data);
									}
									else
									{
										$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
									}
							}
					}
				 $this->layout='my_question_reply';
				break;
				case 'ask-question' :
				
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		  }
		  $this->set('title_for_layout','Asked Question');	
				$this->loadModel('SalesQuestion');
				$user=$this->Session->read('User');
				$userid=$user['user_id'];
				//pr($user_id);exit;
				$options=array( 
				'joins' =>
				  array(
					array(
						'table' => 'sales_advertisements',
						'alias' => 'PostAd',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('PostAd.adv_id = SalesQuestion.adv_id')
					)          
				 ),
				'conditions' =>array('PostAd.user_id'=>$userid,'SalesQuestion.parent'=>0),
							'order' =>array('SalesQuestion.question_id' => 'desc')
								);
				$this->Paginator->settings=$options;
				$this->set('SalesQuestion', $this->Paginator->paginate('SalesQuestion'));
				if($this->request->is('post'))
					{
						//-----------------------------------------------------
						$this->loadModel('MasterMessage');
						$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>66)));
						$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 67)));
						
						//-------------------------------------------------------
						if(isset($this->request->data['question']))
							{
									$user=$this->Session->read('User');
									$this->request->data['SalesQuestion']['user_id']=$user['user_id'];
									$this->request->data['SalesQuestion']['status']=1;
									$this->loadModel('SalesQuestion');
									if($this->SalesQuestion->save($this->request->data))
									{
										$questionInsertID=$this->SalesQuestion->getLastInsertID();
										$questionPostID=$this->request->data['SalesQuestion']['adv_id'];
										//----------------------sales question Image save functionality---------------------------------
										//print_r($this->Session->read('6_letters_code'));
										//pr($this->request->data);exit;
										//------------------------------------------------------
										if(count($this->request->data['SalesQuestion']['img_files'])>0)

											{
												//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

												foreach($this->request->data['SalesQuestion']['img_files'] as $allimg)

												{

													//echo 1;

													if($allimg['name']!='')

													{

													$filename = time().$allimg['name'];

													//$filename=$this->Ikm->CleanFilePath($filename);

													// echo $filename;exit;
													$filename= $this->Dez->CleanFilePath($filename);
													move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/salesquestion/'.$filename);
													$uploadedFile=WWW_ROOT.'files/salesquestion/'.$filename;
													//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
													$this->request->data['SalesquestionImage']['img_file'] = $filename;
													}
													else
													{

													$this->request->data['SalesquestionImage']['img_file'] ='';	

													}

													$this->request->data['SalesquestionImage']['qid']=$questionInsertID;

													$this->request->data['SalesquestionImage']['postid']=$questionPostID;
													$this->loadModel('SalesquestionImage');
													$this->SalesquestionImage->create();

													$save=$this->SalesquestionImage->save($this->request->data);

												}

												

											}

											unset($this->request->data['SalesQuestion']['img_files']);
										//---------------------Sales question Image save end----------------------------------
										$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
										unset($this->request->data);
									}
									else
									{
										$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
									}
							}
					}
				 $this->layout='ask_question';
				break;
				case 'sent-question' :
				if(!isset($this->request->params['pass'][1]))
				{
					$this->redirect(Router::url('/pages/ask-question', true));
				}
				$questionid=$this->request->params['pass'][1];
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		  }
		  $this->set('title_for_layout','Sent Question');	
				$this->loadModel('SalesQuestion');
				$user=$this->Session->read('User');
				$userid=$user['user_id'];
				//pr($user_id);exit;
				$options=array( 
				'conditions' =>array('SalesQuestion.parent'=>$questionid),
							'order' =>array('SalesQuestion.question_id' => 'desc')
								);
				$this->Paginator->settings=$options;
				$this->set('SalesQuestion', $this->Paginator->paginate('SalesQuestion'));
				 $this->layout='sent_question';
				break;
				case 'view-ask-reply' :
				if(!isset($this->request->params['pass'][1]))
				{
					$this->redirect(Router::url('/pages/ask-question', true));
				}
				$questionid=$this->request->params['pass'][1];
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		  }
		  $this->set('title_for_layout','View reply');	
				$this->loadModel('SalesQuestion');
				$user=$this->Session->read('User');
				$userid=$user['user_id'];
				//pr($user_id);exit;
				$options=array( 
				'conditions' =>array('SalesQuestion.parent'=>$questionid),
							'order' =>array('SalesQuestion.question_id' => 'desc')
								);
				$this->Paginator->settings=$options;
				$this->set('SalesQuestion', $this->Paginator->paginate('SalesQuestion'));
				 $this->layout='view_ask_reply';
				break;
				case 'my-sent-question' :
				if(!isset($this->request->params['pass'][1]))
				{
					$this->redirect(Router::url('/pages/my-question', true));
				}
				$questionid=$this->request->params['pass'][1];
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		  }
		  $this->set('title_for_layout','View reply');	
				$this->loadModel('SalesQuestion');
				$user=$this->Session->read('User');
				$userid=$user['user_id'];
				//pr($user_id);exit;
				$options=array( 
				'conditions' =>array('SalesQuestion.parent'=>$questionid),
							'order' =>array('SalesQuestion.question_id' => 'desc')
								);
				$this->Paginator->settings=$options;
				$this->set('SalesQuestion', $this->Paginator->paginate('SalesQuestion'));
				 $this->layout='my_sent_question';
				break;
				case 'profile-img':
				if(!$this->Session->check('User'))
				{
					return $this->redirect(Router::url('/Logins/login', true));
				}
				//-----------------------------------------------------
				$this->loadModel('MasterMessage');
				$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>32)));
				$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 33)));
				
				//-------------------------------------------------------
				$this->loadModel('MasterUser');
				$this->set('title_for_layout','Change Profile Image');
				$ses_data = $this->Session->read('User'); //echo "<pre>";print_r($ses_data);//exit;
		
				$this->set('umail',@$ses_data['User']['email']);
				if($this->request->is(array('post','put')))
				{
					 if(count($this->request->data['MasterUser']['profile_img'])>0)
					{
						$allimg=$this->request->data['MasterUser']['profile_img'];
						//echo 1;
						if($allimg['name']!='')
						{
						$filename = time().$allimg['name'];
						//$filename=$this->Ikm->CleanFilePath($filename);
						// echo $filename;exit;
						$this->request->data['MasterUser']['profile_img'] = $filename;
						
						}
						else
						{
						$this->request->data['MasterUser']['profile_img'] ='';	
						}
					}
					$this->request->data['MasterUser']['user_id']=$ses_data['user_id'];
						if($this->MasterUser->save($this->request->data))
						{
							 if(count($this->request->data['MasterUser']['profile_img'])>0)
							{
							move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/profileimg/'.$filename);
							
							$resizeObj = new resize(WWW_ROOT.'files/profileimg/'.$filename);
							$resizeObj -> resizeImage(172, 180, 'crop');
							$resizeObj -> saveImage(WWW_ROOT.'files/profileimg/172X180_'.$filename, 90);
							
							$resizeObj -> resizeImage(40, 40, 'crop');
							$resizeObj -> saveImage(WWW_ROOT.'files/profileimg/40X40_'.$filename, 90);
			
							$resizeObj -> resizeImage(136, 181, 'crop');
							$resizeObj -> saveImage(WWW_ROOT.'files/profileimg/136X181_'.$filename, 90);
							}
						$this->Session->setFlash('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>');
						}else{
							$this->Session->setFlash('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>');
						}
					}
		
				$this->layout='profile_img';
				break;
				case 'torate' :
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		 		 }
				if($orderid=='')
				{
					$this->redirect(Router::url('/pages/rating-given-seller', true));
				}
				//-----------------------------------------------------
				$this->loadModel('MasterMessage');
				$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>34)));
				$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 35)));
				
				//-------------------------------------------------------
				$this->loadModel('SalesOrder');
						$orderdetail=$this->SalesOrder->find('first', array('conditions' => array('id' => $orderid)));
						$this->set('orderdetail',$orderdetail);
				$rate_type=$this->request->params['pass'][1];
				
				$this->set('title_for_layout', 'To Rate '.$rate_type);
				$sess_user=$this->Session->read('User');
				if($this->request->is(array('post','put')))
				{
					//pr($this->request->data);exit;
					
					if(isset($this->request->data['torate']))	
					{
						$this->request->data['UserRating']['from_user_id']=$sess_user['user_id'];
						$this->loadModel('SalesOrder');
						$orderdetail=$this->SalesOrder->find('first', array('conditions' => array('id' => $orderid)));
						$this->set('orderdetail',$orderdetail);
						if(!empty($orderdetail))
						{
							$this->request->data['UserRating']['orderid']=$orderid;
							$adv_id=$orderdetail['SalesOrder']['adv_id'];
							$this->set('orderdetail',$orderdetail);
							$this->loadModel('PostAd');
							$postdetails=$this->PostAd->find('first', array('conditions' => array('adv_id' => $adv_id)));
							if(!empty($postdetails))
							{
								$this->request->data['UserRating']['user_id']=$postdetails['PostAd']['user_id'];
							}
							$this->request->data['UserRating']['adv_id']=$adv_id;
						}
						if($rate_type=='seller'){$ratingtype=1;}else{$ratingtype=2;}
						$this->request->data['UserRating']['rating_type']=$ratingtype;
						//pr($this->request->data);exit;
						$this->loadModel('UserRating');
						//pr($this->request->data);exit;
						if($this->UserRating->save($this->request->data))
						{
							$this->loadModel('Notice');
							$this->Notice->create();
							$this->Notice->save(array('notice_type' => 'seller-rate', 'postid' => $adv_id, 'notice_name' => 'Rating To Seller'));
							$this->Notice->create();
							$this->Notice->save(array('notice_type' => 'seller-rate', 'postid' => $adv_id, 'notice_name' => 'Parks Comment', 'user_id' => $postdetails['PostAd']['user_id']));
							$this->Session->setFlash('<div class="alert alert-success">'.str_replace("{UserType}", $rate_type, $successMsg['MasterMessage']['msg']).'.</div>');
						}
						else
						{
							$this->Session->setFlash('<div class="alert alert-denger">'.$failMsg['MasterMessage']['msg'].'</div>');
						}
						
					}
				}
				else
				{
					$this->loadModel('SalesOrder');
						$orderdetail=$this->SalesOrder->find('first', array('conditions' => array('id' => $orderid)));
						$this->set('orderdetail',$orderdetail);
						if(!empty($orderdetail))
						{
							
							$adv_id=$orderdetail['SalesOrder']['adv_id'];
							$this->loadModel('PostAd');
							$postdetails=$this->PostAd->find('first', array('conditions' => array('adv_id' => $adv_id)));
							if(!empty($postdetails))
							{
								$this->loadModel('UserRating');
								$ratingdetail=$this->UserRating->find('first', array('conditions' => array('orderid' => $orderid,'user_id' => $postdetails['PostAd']['user_id'])));
								$this->request->data=$ratingdetail;
							}
						}
					
				}
				if($rate_type=='seller')
				{
				$this->layout='rating_to_seller';
				}
				else
				{
					$this->layout='rating_to_seller';
				}
				break;
				case 'buyer-torate' :
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		  		}
				$sess_user=$this->Session->read('User');
				if($orderid=='')
				{
					$this->redirect(Router::url('/pages/rating-given-buyer', true));
				}
				$rate_type=$this->request->params['pass'][1];
				$this->loadModel('SalesOrder');
						$orderdetail=$this->SalesOrder->find('first', array('conditions' => array('id' => $orderid)));
						$this->set('orderdetail',$orderdetail);
				$this->set('title_for_layout', 'To Rate Buyer');
				
				if($this->request->is(array('post','put')))
				{
					//pr($this->request->data);exit;
					
					if(isset($this->request->data['torate']))	
					{
						$this->request->data['UserRating']['from_user_id']=$sess_user['user_id'];
						$this->loadModel('SalesOrder');
						$orderdetail=$this->SalesOrder->find('first', array('conditions' => array('id' => $orderid)));
						$this->set('orderdetail',$orderdetail);
						if(!empty($orderdetail))
						{
							$this->request->data['UserRating']['orderid']=$orderid;
							$adv_id=$orderdetail['SalesOrder']['adv_id'];
						
							$this->request->data['UserRating']['adv_id']=$adv_id;
							$this->request->data['UserRating']['user_id']=$orderdetail['SalesOrder']['user_id'];
						}
						$this->request->data['UserRating']['rating_type']=2;
						//pr($this->request->data);exit;
						$this->loadModel('UserRating');
						//pr($this->request->data);exit;
						if(isset($this->request->data['UserRating']['rating_id'])){
							$this->Session->setFlash('<div class="alert alert-success">You have already rating</div>');
						}
						else
						{
							if($this->UserRating->save($this->request->data))
							{
								$this->loadModel('Notice');
								$this->Notice->create();
								$this->Notice->save(array('notice_type' => 'buyer-rate', 'postid' => $adv_id, 'notice_name' => 'Rating To Buyer'));
								$this->Notice->create();
								$this->Notice->save(array('notice_type' => 'buyer-rate', 'postid' => $adv_id, 'notice_name' => 'Rating To Buyer', 'user_id' => $orderdetail['SalesOrder']['user_id']));
								$this->Session->setFlash('<div class="alert alert-success">Rating successfully give to Buyer.</div>');
							}
							else
							{
								$this->Session->setFlash('<div class="alert alert-denger">Rating failed.</div>');
							}
						}
						
					}
				}
				else
				{
					$this->loadModel('SalesOrder');
						$orderdetail=$this->SalesOrder->find('first', array('conditions' => array('id' => $orderid)));
						$this->set('orderdetail',$orderdetail);
						if(!empty($orderdetail))
						{
							
								$this->loadModel('UserRating');
								$ratingdetail=$this->UserRating->find('first', array('conditions' => array('orderid' => $orderid,'user_id' =>$orderdetail['SalesOrder']['user_id'])));
								$this->request->data=$ratingdetail;
						}
					
				}
				
					$this->layout='rating_to_buyer';
				break;
				case 'my-profile' :
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		 		 }
				$user=$this->Session->read('User');
				$this->set('userid', $user['user_id']);
				$this->set('title_for_layout','My Profile');
				$this->loadModel('UserRating');
				$userrating=$this->UserRating->find('all', array('conditions' => array('user_id' => $user['user_id']), 'order' => array('rating_id' => 'desc')));
				$this->set('userRating',$userrating);
				
				$raceiveasbuyer=$this->UserRating->find('all', array('conditions' => array('user_id' => $user['user_id'], 'rating_type' => 2), 'order' => array('rating_id' => 'desc')));
				$this->set('raceiveasbuyer',$raceiveasbuyer);
				$receivedtheseller=$this->UserRating->find('all', array('conditions' => array('user_id' => $user['user_id'], 'rating_type' => 1), 'order' => array('rating_id' => 'desc')));
				$this->set('receivedtheseller',$receivedtheseller);
				//==================
				// grade count query
				//====================
				$allpositivegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => 1), 'order' => array('rating_id' => 'desc')));
				$this->set('allpositivegrade',$allpositivegrade);
				$allneutralgrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => 0), 'order' => array('rating_id' => 'desc')));
				$this->set('allneutralgrade',$allneutralgrade);
				$allnegativegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => -1), 'order' => array('rating_id' => 'desc')));
				$this->set('allnegativegrade',$allnegativegrade);
				$last6month=date("Y-m-d H:i:s", strtotime("-6 months"));
				$lastyr=date("Y-m-d H:i:s", strtotime("-12 months"));
				$lastmonth=date("Y-m-d 00:00:00", strtotime("-1 months"));
				$currentdate=date('Y-m-d H:i:s');
				//---------Last Year-----------
				$lastyrpositivegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => 1 ,'created >=' => $lastyr, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('lastyrpositivegrade',$lastyrpositivegrade);
				$lastyrneutralgrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => 0,'created >=' => $lastyr, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('lastyrneutralgrade',$lastyrneutralgrade);
				$lastyrnegativegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => -1,'created >=' => $lastyr, 'created <=' =>$currentdate ), 'order' => array('rating_id' => 'desc')));
				$this->set('lastyrnegativegrade',$lastyrnegativegrade);
				//----------------------------
				//---------Last ^ Month-----------
				$last6mthpositivegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => 1 ,'created >=' => $last6month, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('last6mthpositivegrade',$last6mthpositivegrade);
				$last6mthneutralgrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => 0,'created >=' => $last6month, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('last6mthneutralgrade',$last6mthneutralgrade);
				$last6mthnegativegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => -1,'created >=' => $last6month, 'created <=' =>$currentdate ), 'order' => array('rating_id' => 'desc')));
				$this->set('last6mthnegativegrade',$last6mthnegativegrade);
				//----------------------------
				//---------Last Month-----------
				$lastmthpositivegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => 1 ,'created >=' => $lastmonth, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('lastmthpositivegrade',$lastmthpositivegrade);
				$lastmthneutralgrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => 0,'created >=' => $lastmonth, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('lastmthneutralgrade',$lastmthneutralgrade);
				$lastmthnegativegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $user['user_id'], 'grade' => -1,'created >=' => $lastmonth, 'created <=' =>$currentdate ), 'order' => array('rating_id' => 'desc')));
				$this->set('lastmthnegativegrade',$lastmthnegativegrade);
				//----------------------------
				//==================
				// grade count query
				//====================
				
				$this->layout="my-profile";
				break;
				case 'user-profiles' :
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		 		 }
				if($postname==''){
					return $this->redirect(Router::url('/pages/my-profile', true));
		 		 }
				 $userprofileid=$postname;
				 $this->set('userid', $userprofileid);
				$user=$this->Session->read('User');
				$this->loadModel('MasterUser');
				$userDetail=$this->MasterUser->find('first', array('conditions' => array('user_id' =>$userprofileid)));
				$this->set('title_for_layout',$userDetail['MasterUser']['first_name'].' '. $userDetail['MasterUser']['last_name']."'s Profile");
				$this->loadModel('UserRating');
				$userrating=$this->UserRating->find('all', array('conditions' => array('user_id' => $userprofileid), 'order' => array('rating_id' => 'desc')));
				$this->set('userRating',$userrating);
				
				$raceiveasbuyer=$this->UserRating->find('all', array('conditions' => array('user_id' => $userprofileid, 'rating_type' => 2), 'order' => array('rating_id' => 'desc')));
				$this->set('raceiveasbuyer',$raceiveasbuyer);
				$receivedtheseller=$this->UserRating->find('all', array('conditions' => array('user_id' => $userprofileid, 'rating_type' => 1), 'order' => array('rating_id' => 'desc')));
				$this->set('receivedtheseller',$receivedtheseller);
				//==================
				// grade count query
				//====================
				$allpositivegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => 1), 'order' => array('rating_id' => 'desc')));
				$this->set('allpositivegrade',$allpositivegrade);
				$allneutralgrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => 0), 'order' => array('rating_id' => 'desc')));
				$this->set('allneutralgrade',$allneutralgrade);
				$allnegativegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => -1), 'order' => array('rating_id' => 'desc')));
				$this->set('allnegativegrade',$allnegativegrade);
				$last6month=date("Y-m-d H:i:s", strtotime("-6 months"));
				$lastyr=date("Y-m-d H:i:s", strtotime("-12 months"));
				$lastmonth=date("Y-m-d 00:00:00", strtotime("-1 months"));
				$currentdate=date('Y-m-d H:i:s');
				//---------Last Year-----------
				$lastyrpositivegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => 1 ,'created >=' => $lastyr, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('lastyrpositivegrade',$lastyrpositivegrade);
				$lastyrneutralgrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => 0,'created >=' => $lastyr, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('lastyrneutralgrade',$lastyrneutralgrade);
				$lastyrnegativegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => -1,'created >=' => $lastyr, 'created <=' =>$currentdate ), 'order' => array('rating_id' => 'desc')));
				$this->set('lastyrnegativegrade',$lastyrnegativegrade);
				//----------------------------
				//---------Last ^ Month-----------
				$last6mthpositivegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => 1 ,'created >=' => $last6month, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('last6mthpositivegrade',$last6mthpositivegrade);
				$last6mthneutralgrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => 0,'created >=' => $last6month, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('last6mthneutralgrade',$last6mthneutralgrade);
				$last6mthnegativegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => -1,'created >=' => $last6month, 'created <=' =>$currentdate ), 'order' => array('rating_id' => 'desc')));
				$this->set('last6mthnegativegrade',$last6mthnegativegrade);
				//----------------------------
				//---------Last Month-----------
				$lastmthpositivegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => 1 ,'created >=' => $lastmonth, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('lastmthpositivegrade',$lastmthpositivegrade);
				$lastmthneutralgrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => 0,'created >=' => $lastmonth, 'created <=' => $currentdate), 'order' => array('rating_id' => 'desc')));
				$this->set('lastmthneutralgrade',$lastmthneutralgrade);
				$lastmthnegativegrade=$this->UserRating->find('count', array('conditions' => array('user_id' => $userprofileid, 'grade' => -1,'created >=' => $lastmonth, 'created <=' =>$currentdate ), 'order' => array('rating_id' => 'desc')));
				$this->set('lastmthnegativegrade',$lastmthnegativegrade);
				//----------------------------
				//==================
				// grade count query
				//====================
				
				$this->layout="my-profile";
				break;
				case 'history-accounts' :
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		 		 }
				 $user=$this->Session->read('User');
				 $this->set('title_for_layout','History Accounts');
				 $this->loadModel('UpgradeMembership');
				 $options=array('conditions' => array('plan_status' => 1, 'payment_status' => 1, 'user_id' => $user['user_id']), 'order' => array('upgrade_id' => 'desc'), 'limit' =>5);
				 $this->Paginator->settings=$options;
				$this->set('historyRes', $this->Paginator->paginate('UpgradeMembership'));
				 $this->layout="history-accounts";
				break;
				case 'accounts-credits' :
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		 		 }
				 $user=$this->Session->read('User');
				 $this->set('title_for_layout','Accounts Credits');
				 $this->loadModel('UserCreditAccount');
				 $options=array(
				 'joins' =>
				  array(
					array(
						'table' => 'upgrade_membership',
						'alias' => 'UpgradeMembership',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('UpgradeMembership.upgrade_id = UserCreditAccount.upgrade_id')
					)          
				 ),
				 'conditions' => array('UpgradeMembership.plan_status' => 1, 'UpgradeMembership.payment_status' => 1, 'UserCreditAccount.user_id' => $user['user_id']),
				 'fields' => array('UpgradeMembership.*','UserCreditAccount.*'),
				  'order' => array('UserCreditAccount.upgrade_id' => 'desc')
				   );
				$this->set('historyRes', $this->UserCreditAccount->find('all',$options));
				 $this->layout="accounts-credits";
				break;
				case 'truck-parks' :				
				$this->set('title_for_layout','Truck parks');
				$this->loadModel('SalesPark');
				$this->SalesPark->recursive = 0;
				$this->Paginator->settings = array(
				'conditions' => array('SalesPark.add_type' => 1, 'SalesPark.status' => 1),
				'order' =>array('SalesPark.park_id' => 'desc'),
				'limit' => 10
				);
				$this->set('truckRes', $this->Paginator->paginate('SalesPark'));
				$recentparts=$this->SalesPark->find('all', array('conditions' => array('SalesPark.add_type' => 1, 'SalesPark.status' => 1),
				'order' =>array('SalesPark.park_id' => 'desc'),
				'limit' => 3));
				$this->set('recentparts', $recentparts);
				$this->layout="truck-parks";
				break;
				case 'company-parts' :
				$this->set('title_for_layout','Company Parts');
				$this->loadModel('SalesPark');
				$this->SalesPark->recursive = 0;
				$this->Paginator->settings = array(
				'conditions' => array('SalesPark.add_type' => 2, 'SalesPark.status' => 1),
				'order' =>array('SalesPark.park_id' => 'desc'),
				'limit' => 10
				);
				$this->set('truckRes', $this->Paginator->paginate('SalesPark'));
				$recentparts=$this->SalesPark->find('all', array('conditions' => array('SalesPark.add_type' =>2, 'SalesPark.status' => 1),
				'order' =>array('SalesPark.park_id' => 'desc'),
				'limit' => 3));
				$this->set('recentparts', $recentparts);
				$this->layout="company-parts";
				break;
				case 'parks' :
				if($postname!='')
				{
					$postname=urlencode($postname);
				$this->loadModel('SalesPark');
				$parkdetail=$this->SalesPark->find('first', array('conditions' => array('slug' => $postname, 'status' => 1)));
					if(!empty($parkdetail))
					{
						$park_id=$parkdetail['SalesPark']['park_id'];
						$park_type=$parkdetail['SalesPark']['add_type'];
						$this->set('title_for_layout',$parkdetail['SalesPark']['park_name']);
						$recentparts=$this->SalesPark->find('all', array('conditions' => array('SalesPark.add_type' => $parkdetail['SalesPark']['add_type'], 'SalesPark.status' => 1, 'SalesPark.park_id !=' => $parkdetail['SalesPark']['park_id']),
						'order' =>array('SalesPark.park_id' => 'desc'),
						'limit' => 3));
						$this->set('recentparts', $recentparts);
						$this->set('parkDetail', $parkdetail);
						$this->layout="parks-detail";
						if($this->request->is('post'))
						{
							
							if(isset($this->request->data['question']))
								{
									//pr($this->request->data);exit;
									//-----------------------------------------------------
									$this->loadModel('MasterMessage');
									$loginBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 29)));
									$incorrectSecurity=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 3)));
									$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>42)));
									$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 43)));
									
									//-------------------------------------------------------
									//print_r($this->Session->read('6_letters_code'));
									//pr($this->request->data);exit;
									if($this->request->data['ParkQuestion']['parent']<=0 || $this->request->data['ParkQuestion']['parent']=='')
									{
										$this->request->data['ParkQuestion']['parent']=0;
									}
									if(!$this->Session->check('User'))
									{
										$this->set('openlogin','yes');
										$this->Session->setFlash(__('<div class="alert alert-danger">'.$loginBlank['MasterMessage']['msg'].'</div>'));
										if(isset($this->request->data['MasterUser']['user_login_id']))
										{
											$useremail=$this->request->data['MasterUser']['user_login_id'];
											$userpass=$this->request->data['MasterUser']['user_pass'];
											$this->loadModel('MasterUser');
											$user_count = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.email'=>$useremail,'MasterUser.pass'=>md5($userpass),'is_active' => 1)));
											if(count($user_count)>0)
											{
												$this->Session->write('User',$user_count['MasterUser']);
											$this->request->data['ParkQuestion']['user_id']=$user_count['MasterUser']['user_id'];
											$this->request->data['ParkQuestion']['status']=1;
												if($this->request->data['park_user_id']!=$user_count['MasterUser']['user_id'])
												{
														if($this->Session->read('6_letters_code')==$this->request->data['code'])
														{
															$this->loadModel('ParkQuestion');
															if($this->ParkQuestion->save($this->request->data))
															{
																$parkQuestionID=$this->ParkQuestion->getLastInsertID();

													//----------------------sales question Image save functionality---------------------------------
													//print_r($this->Session->read('6_letters_code'));
													//pr($this->request->data);exit;
													//------------------------------------------------------
													if(count($this->request->data['ParkQuestion']['img_files'])>0)

														{
															//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

															foreach($this->request->data['ParkQuestion']['img_files'] as $allimg)

															{

																//echo 1;

																if($allimg['name']!='')

																{

																$filename = time().$allimg['name'];

																//$filename=$this->Ikm->CleanFilePath($filename);

																// echo $filename;exit;
																$filename= $this->Dez->CleanFilePath($filename);
																move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/parkquestion/'.$filename);
																$uploadedFile=WWW_ROOT.'files/parkquestion/'.$filename;
																//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
																$this->request->data['ParksquestionImage']['img_file'] = $filename;
																}
																else
																{

																$this->request->data['ParksquestionImage']['img_file'] ='';	

																}

																$this->request->data['ParksquestionImage']['qid']=$parkQuestionID;

																$this->request->data['ParksquestionImage']['postid']=$this->request->data['ParkQuestion']['park_id'];
															
																$this->loadModel('ParksquestionImage');
																$this->ParksquestionImage->create();

																$save=$this->ParksquestionImage->save($this->request->data);

															}

															

														}

														unset($this->request->data['ParksquestionImage']['img_files']);
													//---------------------Sales question Image save end----------------------------------
																/*$this->loadModel('Notice');
																$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment'));*/
																$this->loadModel('Notice');
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'parks-question', 'postid' => $this->request->data['ParkQuestion']['park_id'], 'notice_name' => 'Parks Comment'));
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'parks-question', 'postid' => $this->request->data['ParkQuestion']['park_id'], 'notice_name' => 'Parks Comment', 'user_id' => $this->request->data['adv_user_id']));
																$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
																unset($this->request->data);
															}
															else
															{
																$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
															}
														}
														else
														{
															$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectSecurity['MasterMessage']['msg'].'</div>'));
														}
												}
												else if($this->request->data['ParkQuestion']['parent']>0 || $this->request->data['ParkQuestion']['parent']!='')
												{
													
														if($this->Session->read('6_letters_code')==$this->request->data['code'])
														{
															$this->loadModel('ParkQuestion');
															if($this->ParkQuestion->save($this->request->data))
															{
																$parkQuestionID=$this->ParkQuestion->getLastInsertID();

													//----------------------sales question Image save functionality---------------------------------
													//print_r($this->Session->read('6_letters_code'));
													//pr($this->request->data);exit;
													//------------------------------------------------------
													if(count($this->request->data['ParkQuestion']['img_files'])>0)

														{
															//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

															foreach($this->request->data['ParkQuestion']['img_files'] as $allimg)

															{

																//echo 1;

																if($allimg['name']!='')

																{

																$filename = time().$allimg['name'];

																//$filename=$this->Ikm->CleanFilePath($filename);

																// echo $filename;exit;
																$filename= $this->Dez->CleanFilePath($filename);
																move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/parkquestion/'.$filename);
																$uploadedFile=WWW_ROOT.'files/parkquestion/'.$filename;
																//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
																$this->request->data['ParksquestionImage']['img_file'] = $filename;
																}
																else
																{

																$this->request->data['ParksquestionImage']['img_file'] ='';	

																}

																$this->request->data['ParksquestionImage']['qid']=$parkQuestionID;

																$this->request->data['ParksquestionImage']['postid']=$this->request->data['ParkQuestion']['park_id'];
															
																$this->loadModel('ParksquestionImage');
																$this->ParksquestionImage->create();

																$save=$this->ParksquestionImage->save($this->request->data);

															}

															

														}

														unset($this->request->data['ParksquestionImage']['img_files']);
													//---------------------Sales question Image save end----------------------------------
																/*$this->loadModel('Notice');
																$this->Notice->save(array('notice_type' => 'sales-question', 'postid' => $this->request->data['SalesQuestion']['adv_id'], 'notice_name' => 'Sales Comment'));*/
																$this->loadModel('Notice');
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'parks-question', 'postid' => $this->request->data['ParkQuestion']['park_id'], 'notice_name' => 'Parks Comment'));
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'parks-question', 'postid' => $this->request->data['ParkQuestion']['park_id'], 'notice_name' => 'Parks Comment', 'user_id' => $this->request->data['adv_user_id']));
																$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
																unset($this->request->data);
															}
															else
															{
																$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
															}
														}
														else
														{
															$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectSecurity['MasterMessage']['msg'].'</div>'));
														}
												
												}
												else
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">Nu poti cere întrebare propriul produs .</div>'));
												}
											}
											
										}
										
									}
									else
									{
										$user=$this->Session->read('User');
										$this->request->data['ParkQuestion']['user_id']=$user['user_id'];
										$this->request->data['ParkQuestion']['status']=1;
										if($this->request->data['park_user_id']!=$user['user_id'])
										{
											if($this->Session->read('6_letters_code')==$this->request->data['code'])
											{
												$this->loadModel('ParkQuestion');
												if($this->ParkQuestion->save($this->request->data))
												{
													$parkQuestionID=$this->ParkQuestion->getLastInsertID();

													//----------------------sales question Image save functionality---------------------------------
													//print_r($this->Session->read('6_letters_code'));
													//pr($this->request->data);exit;
													//------------------------------------------------------
													if(count($this->request->data['ParkQuestion']['img_files'])>0)

														{
															//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

															foreach($this->request->data['ParkQuestion']['img_files'] as $allimg)

															{

																//echo 1;

																if($allimg['name']!='')

																{

																$filename = time().$allimg['name'];

																//$filename=$this->Ikm->CleanFilePath($filename);

																// echo $filename;exit;
																$filename= $this->Dez->CleanFilePath($filename);
																move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/parkquestion/'.$filename);
																$uploadedFile=WWW_ROOT.'files/parkquestion/'.$filename;
																//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
																$this->request->data['ParksquestionImage']['img_file'] = $filename;
																}
																else
																{

																$this->request->data['ParksquestionImage']['img_file'] ='';	

																}

																$this->request->data['ParksquestionImage']['qid']=$parkQuestionID;

																$this->request->data['ParksquestionImage']['postid']=$this->request->data['ParkQuestion']['park_id'];
															
																$this->loadModel('ParksquestionImage');
																$this->ParksquestionImage->create();

																$save=$this->ParksquestionImage->save($this->request->data);

															}

															

														}

														unset($this->request->data['ParksquestionImage']['img_files']);
													//---------------------Sales question Image save end----------------------------------
													$sessionUser=$this->Session->read('User');
													$this->loadModel('Notice');
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'park-question', 'postid' => $this->request->data['ParkQuestion']['park_id'], 'notice_name' => 'Parks Comment'));
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'park-question', 'postid' => $this->request->data['ParkQuestion']['park_id'], 'notice_name' => 'Parks Comment', 'user_id' => $this->request->data['park_user_id']));
													$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
													unset($this->request->data);
												}
												else
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
												}
											}
											else
											{
												$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectSecurity['MasterMessage']['msg'].'</div>'));
											}
										}
										else if($this->request->data['ParkQuestion']['parent']>0 || $this->request->data['ParkQuestion']['parent']!='')
										{
											
											if($this->Session->read('6_letters_code')==$this->request->data['code'])
											{
												$this->loadModel('ParkQuestion');
												if($this->ParkQuestion->save($this->request->data))
												{
													$parkQuestionID=$this->ParkQuestion->getLastInsertID();

													//----------------------sales question Image save functionality---------------------------------
													//print_r($this->Session->read('6_letters_code'));
													//pr($this->request->data);exit;
													//------------------------------------------------------
													if(count($this->request->data['ParkQuestion']['img_files'])>0)

														{
															//echo "<pre>";print_r($this->request->data['SalesQuestion']['img_files']);exit();

															foreach($this->request->data['ParkQuestion']['img_files'] as $allimg)

															{

																//echo 1;

																if($allimg['name']!='')

																{

																$filename = time().$allimg['name'];

																//$filename=$this->Ikm->CleanFilePath($filename);

																// echo $filename;exit;
																$filename= $this->Dez->CleanFilePath($filename);
																move_uploaded_file($allimg['tmp_name'], WWW_ROOT.'files/parkquestion/'.$filename);
																$uploadedFile=WWW_ROOT.'files/parkquestion/'.$filename;
																//$this->Dez->bapcustrotate(WWW_ROOT.'files/tempfile/',$filename);
																$this->request->data['ParksquestionImage']['img_file'] = $filename;
																}
																else
																{

																$this->request->data['ParksquestionImage']['img_file'] ='';	

																}

																$this->request->data['ParksquestionImage']['qid']=$parkQuestionID;

																$this->request->data['ParksquestionImage']['postid']=$this->request->data['ParkQuestion']['park_id'];
															
																$this->loadModel('ParksquestionImage');
																$this->ParksquestionImage->create();

																$save=$this->ParksquestionImage->save($this->request->data);

															}

															

														}

														unset($this->request->data['ParksquestionImage']['img_files']);
													//---------------------Sales question Image save end----------------------------------
													$sessionUser=$this->Session->read('User');
													$this->loadModel('Notice');
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'park-question', 'postid' => $this->request->data['ParkQuestion']['park_id'], 'notice_name' => 'Parks Comment'));
													$this->Notice->create();
													$this->Notice->save(array('notice_type' => 'park-question', 'postid' => $this->request->data['ParkQuestion']['park_id'], 'notice_name' => 'Parks Comment', 'user_id' => $this->request->data['park_user_id']));
													$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
													unset($this->request->data);
												}
												else
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
												}
											}
											else
											{
												$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectSecurity['MasterMessage']['msg'].'</div>'));
											}
										
										}
										else
										{
											$this->Session->setFlash(__('<div class="alert alert-danger">Nu poti cere întrebare propriul produs .</div>'));
										}
									}
								}
						}
						$this->loadModel('ParkQuestion');
					$parkQustionRes=$this->ParkQuestion->find('all', array('conditions' => array('parent' => 0, 'park_id' => $park_id, 'park_type' => $park_type), 'order' => array('qid' => 'desc')));
					$this->set('parkQustionRes', $parkQustionRes);

					}
					else
					{
						$this->set('title_for_layout','404 Not Found');
						$this->layout="404";
					}
				}
				else
				{
					$this->set('title_for_layout','404 Not Found');
					$this->layout="404";
				}
				break;
				case 'inbox':
				$this->set('title_for_layout','Inbox');
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
				  }
				  $sess_user=$this->Session->read('User');
				$this->loadModel('ManageMessage');
				$this->ManageMessage->recursive = 0;
				$this->Paginator->settings = array(
				'conditions' => array('to_user' => $sess_user['user_id'], 'status' => 1),
				'order' =>array('ManageMessage.msg_id' => 'desc'),
				'limit' => 10
				);
				$this->set('msgRes', $this->Paginator->paginate('ManageMessage'));
				$this->layout="inbox";
				break;
				case 'sent-message':
				$this->set('title_for_layout','Sent Message');
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
				  }
				  $sess_user=$this->Session->read('User');
				$this->loadModel('ManageMessage');
				$this->ManageMessage->recursive = 0;
				$this->Paginator->settings = array(
				'conditions' => array('from_user' => $sess_user['user_id'], 'status' => 1),
				'order' =>array('ManageMessage.msg_id' => 'desc'),
				'limit' => 10
				);
				$this->set('msgRes', $this->Paginator->paginate('ManageMessage'));
				$this->layout="sent-message";
				break;
				case 'compose-message':
				$this->set('title_for_layout','Sent Message');
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
				  }
				  $sessionuser=$this->Session->read('User');
				  //-------------------------------------
				  $this->loadModel('MasterMessage');
				$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>36)));
				$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 37)));
				  //---------------------------------------
				$this->loadModel('MasterUser');
				$alluser=array('' => 'Select user');
				$alluser+=$this->MasterUser->find('list', array('conditions' => array('user_id !=' => $sessionuser['user_id'], 'is_active' => 1, 'wrong_login_attempt <=' => 3), 'fields' => array('user_id', 'first_name'), 'order' => array('first_name' => 'asc')));
				$this->set('alluser',$alluser);
				
				if($this->request->is('post'))
				{
					$this->loadModel('ManageMessage');
					//pr($this->request->data);exit;
					if(isset($this->request->data['send_msg']))
					{
						$this->request->data['ManageMessage']['from_user']=$sessionuser['user_id'];
						$this->request->data['ManageMessage']['status']=1;
						if($this->ManageMessage->save($this->request->data))
						{
							$this->Session->setFlash('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>');
							unset($this->request->data);
						}
						else
						{
							$this->Session->setFlash('<div class="alert alert-denger">'.$failMsg['MasterMessage']['msg'].'</div>');
						}
					}
				}
				$this->layout="compose_message";
				break;
				case 'delete-msg':
				$this->loadModel('ManageMessage');
				if(isset($this->request->params['named']['msgid']))
				{
					$id=$this->request->params['named']['msgid'];
				}
				else
				{
					return $this->redirect(Router::url('/pages/inbox', true));
				}
				 //-------------------------------------
				  $this->loadModel('MasterMessage');
				$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>38)));
				$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 39)));
				  //---------------------------------------
				$this->ManageMessage->id = $id;
				if (!$this->ManageMessage->exists()) {
					return $this->redirect(Router::url('/pages/inbox', true));
			  	}
				if($this->ManageMessage->save(array('msg_id' => $id,'status' => 2)))
				{
					$this->Session->setFlash('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>');
					return $this->redirect(Router::url('/pages/inbox', true));
				}
				else
				{
					$this->Session->setFlash('<div class="alert alert-denger">'.$failMsg['MasterMessage']['msg'].'</div>');
					return $this->redirect(Router::url('/pages/inbox', true));
				}
				break;
				case 'history-msg':
				$this->set('title_for_layout','History Message');
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
				  }
				  $sess_user=$this->Session->read('User');
				$this->loadModel('ManageMessage');
				$this->ManageMessage->recursive = 0;
				$this->Paginator->settings = array(
				'conditions' => array('to_user' => $sess_user['user_id'], 'status' => 2),
				'order' =>array('ManageMessage.msg_id' => 'desc'),
				'limit' => 10
				);
				$this->set('msgRes', $this->Paginator->paginate('ManageMessage'));
				$this->layout="history-msg";
				break;
				case 'archive-posts':
				$this->set('title_for_layout','Archive posts');
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
				  }
				  $sess_user=$this->Session->read('User');
				$this->loadModel('ManageMessage');
				$this->ManageMessage->recursive = 0;
				$this->Paginator->settings = array(
				'conditions' => array('to_user' => $sess_user['user_id'], 'status IN' =>array(1,2)),
				'order' =>array('ManageMessage.msg_id' => 'desc'),
				'limit' => 10
				);
				$this->set('msgRes', $this->Paginator->paginate('ManageMessage'));
				$this->layout="archive-posts";
				break;
				case  'out-of-stock':
				$this->set('title_for_layout','Out Of Stock');
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
				  }
				  $this->loadModel('PostAd');
				  
				  $sess_user=$this->Session->read('User');
				  $this->PostAd->recursive = 0;
		//-------Active request parts list functionality----------------
				$options=array(             
					'joins' =>
							  array(
							  	array(
									'table' => 'sales_order',
									'alias' => 'SalesOrder',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('SalesOrder.adv_id = PostAd.adv_id')
								)         
							 ),
							  'conditions' =>
							  array('AND' => array(
								array('PostAd.adv_status' => 1,'PostAd.user_id' => $sess_user['user_id']),
							 )),
							 'fields' =>
							 array('SalesOrder.*','PostAd.*','SUM(SalesOrder.qty) as totqty'),
							 'order' =>
							  array('PostAd.adv_id' => 'desc'),
							  'group' => 
							  array('SalesOrder.adv_id'),
						);
		$this->Paginator->settings=$options;
		$this->set('SalesOrders', $this->Paginator->paginate('PostAd'));
				  $this->layout="out_of_stock";
				break;
				case 'my-rating' :
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		 		 }
				$user=$this->Session->read('User');
				$this->set('userid', $user['user_id']);
				$this->set('title_for_layout','My Rating');
				$this->loadModel('UserRating');
				
				//==================
				// grade fetch query
				//====================
				$allpositivegrade=$this->UserRating->find('all', array('conditions' => array('user_id' => $user['user_id'], 'grade' => 1), 'order' => array('rating_id' => 'desc')));
				$this->set('allpositivegrade',$allpositivegrade);
				$allneutralgrade=$this->UserRating->find('all', array('conditions' => array('user_id' => $user['user_id'], 'grade' => 0), 'order' => array('rating_id' => 'desc')));
				$this->set('allneutralgrade',$allneutralgrade);
				$allnegativegrade=$this->UserRating->find('all', array('conditions' => array('user_id' => $user['user_id'], 'grade' => -1), 'order' => array('rating_id' => 'desc')));
				$this->set('allnegativegrade',$allnegativegrade);
				
				//==================
				// grade fetch query
				//====================
				
				$this->layout="my-rating";
				break;
				case 'subscribe' :
				$this->set('title_for_layout','Alert Subscribe');
				if(!$this->Session->check('User')){
					return $this->redirect(Router::url('/', true));
		 		 }
				$user=$this->Session->read('User');
				
				$this->loadModel('ManageBrand');
				$brandlist=$this->ManageBrand->find('list', array('conditions' => array('status' => 1, 'flag' => 0), 'order' => array('brand_name' => 'asc')));
				$this->set('brandlist',$brandlist);
				
				$this->loadModel('ManageCategory');
				$categorieslist=$this->ManageCategory->find('list', array('conditions' => array('status' => 1, 'flag' => 0), 'order' => array('category_name' => 'asc')));
				$this->set('categorieslist',$categorieslist);
				
				$this->loadModel('MasterCountry');
				$masterCountryList=$this->MasterCountry->find('list', array('order' => array('country_name' => 'asc')));
				$this->set('masterCountryList',$masterCountryList);
				
				
				$this->loadModel('SubscribeAlert');
					
				if($this->request->is(array('post','put')))
				{
					//----------------------------------------------------------
					$this->loadModel('MasterMessage');
					$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 75)));
					$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 76)));
					//---------------------------------------------
					//pr($this->request->data);exit;
					if(isset($this->request->data['alert_subscribe']))
					{
						if(!empty($this->request->data['SubscribeAlert']['brand_list']))
						{
							$this->request->data['SubscribeAlert']['brand_list']=implode(",",$this->request->data['SubscribeAlert']['brand_list']);
						}
						if(!empty($this->request->data['SubscribeAlert']['categories']))
						{
							$this->request->data['SubscribeAlert']['categories']=implode(",",$this->request->data['SubscribeAlert']['categories']);
						}
						if(!empty($this->request->data['SubscribeAlert']['couties']))
						{
							$this->request->data['SubscribeAlert']['couties']=implode(",",$this->request->data['SubscribeAlert']['couties']);
						}
					
						$this->request->data['SubscribeAlert']['user_id']=$user['user_id'];
						$this->loadModel('SubscribeAlert');
						if($this->SubscribeAlert->save($this->request->data))
						{
							$this->Session->setFlash('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>');
							if(!empty($this->request->data['SubscribeAlert']['brand_list']))
							{
								$this->request->data['SubscribeAlert']['brand_list']=explode(",",$this->request->data['SubscribeAlert']['brand_list']);
							}
							if(!empty($this->request->data['SubscribeAlert']['categories']))
							{
								$this->request->data['SubscribeAlert']['categories']=explode(",",$this->request->data['SubscribeAlert']['categories']);
							}
							if(!empty($this->request->data['SubscribeAlert']['couties']))
							{
								$this->request->data['SubscribeAlert']['couties']=explode(",",$this->request->data['SubscribeAlert']['couties']);
							}
						}
						else
						{
							$this->Session->setFlash('<div class="alert alert-denger">'.$failMsg['MasterMessage']['msg'].'</div>');
						}
					}
				}
				else
				{
					$alertres=$this->SubscribeAlert->find('first', array('conditions' => array('user_id' => $user['user_id'])));
					if(!empty($alertres))
					{
						
						$this->request->data=$alertres;
						$this->request->data['SubscribeAlert']['brand_list']=explode(",",$alertres['SubscribeAlert']['brand_list']);
						$this->request->data['SubscribeAlert']['categories']=explode(",",$alertres['SubscribeAlert']['categories']);
						$this->request->data['SubscribeAlert']['couties']=explode(",",$alertres['SubscribeAlert']['couties']);
					}
				}
				$this->layout="subscribe";
				break;
				case 'commands' :
				//------------------------------------------
				// My Sales order code
				//-------------------------------------------
					if(!$this->Session->check('User'))
					{
						return $this->redirect(Router::url('/', true));
					}
					$userres=$this->Session->read('User');
					$this->set('title_for_layout','Commands');
					$andwhr=array(array('PostAd.user_id' =>$userres['user_id']));
					if($postname=='confirmed'){array_push($andwhr, array('SalesOrder.status' => 1));}else if($postname=='shipped'){array_push($andwhr, array('SalesOrder.status' => 3));}else if($postname=='completed'){array_push($andwhr, array('SalesOrder.status' => 2));}else if($postname=='cancel'){array_push($andwhr, array('SalesOrder.status' => 4));}else if($postname=='all'){}else{array_push($andwhr, array('SalesOrder.status' => 0));}
					
					$this->loadModel('SalesOrder');
					$this->Paginator->settings =array(             
					'joins' =>
							  array(
								array(
									'table' => 'sales_advertisements',
									'alias' => 'PostAd',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('PostAd.adv_id = SalesOrder.adv_id')
								)          
							 ),
							  'conditions' =>
							  array('AND' => $andwhr),
							 'fields' =>
							 array('PostAd.*','SalesOrder.*'),
							 'order' =>
							  array('SalesOrder.orderid' => 'desc'),
							  'limit' =>10
						);
			
		
				//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
				$this->set('SalesOrders', $this->Paginator->paginate('SalesOrder'));
				$this->layout="commands";
				break;
				case 'statistics-views' :
				//------------------------------------------
				// My Sales order code
				//-------------------------------------------
					if(!$this->Session->check('User'))
					{
						return $this->redirect(Router::url('/', true));
					}
					$userres=$this->Session->read('User');
					
					$andwhr=array(array('PostAd.user_id' =>$userres['user_id']));
					if($postname=='most-viewed' || $postname=='')
					{
						$this->set('title_for_layout','Most Viewed');
					$this->loadModel('PostAd');
					$setMax=$this->PostAd->query("SET SQL_BIG_SELECTS=1");
					$this->Paginator->settings =array(             
					'joins' =>
							  array(
								array(
									'table' => 'sales_view',
									'alias' => 'SalesView',
									'type' => 'left',
									'foreignKey' => false,
									'conditions'=> array('SalesView.adv_id = PostAd.adv_id')
								)        
							 ),
							 
							  'conditions' =>
							  array('AND' => $andwhr),
							 'fields' =>
							 array('PostAd.*','COUNT(*) as totview'),
							  'group' =>
							  array('PostAd.adv_id'),
							  'order' =>
							  array('totview' => 'DESC'),
							  'limit' =>10
						);
						$this->set('statisticsRes', $this->Paginator->paginate('PostAd'));
						$this->layout="most-viewed";
					}
					else if($postname=='favourite')
					{	
						$andwhr=array(array('SalesAddToFavourite.user_id' =>$userres['user_id']));
						$this->set('title_for_layout','Most Favourites');
						//array_push($andwhr, array('SalesAddToFavourite.fav_id !=' =>''));
						$this->loadModel('PostAd');
						$setMax=$this->PostAd->query("SET SQL_BIG_SELECTS=1");
						$this->Paginator->settings =array(             
						'joins' =>
								  array(
									array(
										'table' => 'sales_add_to_favourites',
										'alias' => 'SalesAddToFavourite',
										'type' => 'left',
										'foreignKey' => false,
										'conditions'=> array('SalesAddToFavourite.adv_id = PostAd.adv_id')
									)        
								 ),
								 
								  'conditions' =>
								  array('AND' => $andwhr),
								 'fields' =>
								 array('PostAd.*','COUNT(*) as totfav', 'SalesAddToFavourite.user_id'),
								 'order' =>
								  array('totfav' => 'DESC'),
								  'group' =>
								  array('PostAd.adv_id'),
								  'limit' =>10
							);
						$this->set('statisticsRes', $this->Paginator->paginate('PostAd'));
						$this->layout="favourites-list";
					}
					else if($postname=='favourite-ads')
					{	
						$andwhr=array(array('PostAd.user_id' =>$userres['user_id']));
						$this->set('title_for_layout','Most Favourites ads');
						//array_push($andwhr, array('SalesAddToFavourite.fav_id !=' =>''));
						$this->loadModel('PostAd');
						$setMax=$this->PostAd->query("SET SQL_BIG_SELECTS=1");
						$this->Paginator->settings =array(             
						'joins' =>
								  array(
									array(
										'table' => 'sales_add_to_favourites',
										'alias' => 'SalesAddToFavourite',
										'type' => 'left',
										'foreignKey' => false,
										'conditions'=> array('SalesAddToFavourite.adv_id = PostAd.adv_id')
									)        
								 ),
								 
								  'conditions' =>
								  array('AND' => $andwhr),
								 'fields' =>
								 array('PostAd.*','COUNT(*) as totfav', 'SalesAddToFavourite.user_id'),
								 'order' =>
								  array('totfav' => 'DESC'),
								  'group' =>
								  array('PostAd.adv_id'),
								  'limit' =>10
							);
						$this->set('statisticsRes', $this->Paginator->paginate('PostAd'));
						$this->layout="favourites-ads-list";
					}
					else
					{
						$this->set('title_for_layout','404 Not found');
						$this->layout="404";
					}
				
				//$this->set('SearchRes', $this->Paginator->paginate('PostAd'));
				
				break;
				case 'success-stories':
				if(!$this->Session->check('User'))
				{
					return $this->redirect(Router::url('/', true));
				}
				$userres=$this->Session->read('User');
				$this->set('userid',$userres['user_id']);
				$this->set('title_for_layout','Success Stories');
				$this->loadModel('SuccessStory');
				
				if ($this->request->is(array('post', 'put'))) {
					//----------------------------------------------------------
					$this->loadModel('MasterMessage');
					$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 79)));
					$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 80)));
					//---------------------------------------------
					//pr($this->request->data)
					//$this->SuccessStory->create();
					if ($this->SuccessStory->save($this->request->data)) {
						$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
						//return $this->redirect(array('action' => 'index'));
						if(!isset($this->request->data['SuccessStory']['success_id']))
						{
							unset($this->request->data);
						}
					} else {
						$this->Session->setFlash(__('<div class="alert alert-denger">'.$failMsg['MasterMessage']['msg'].'</div>'));
					}
				}
				if(isset($this->request->params['pass'][1]))
				{
					$result=$this->SuccessStory->find('first', array('conditions' => array('success_id' => $this->request->params['pass'][1])));
					$this->request->data=$result;
				}
				$this->layout="success-stories";
				break;
				case 'success-stories-list':
				if(!$this->Session->check('User'))
				{
					return $this->redirect(Router::url('/', true));
				}
				$userres=$this->Session->read('User');
				$this->set('title_for_layout','Success Stories List');
				$this->loadModel('SuccessStory');
				$successRes=$this->SuccessStory->find('all', array('conditions' => array('user_id' => $userres['user_id'], 'submit_from' => 1)));
				$this->set('successRes', $successRes);
				$this->layout="success-stories-list";
				break;				
				//================mmab=========31.12.15==========starts=================
				case 'success-stories-details':
				//if(!$this->Session->check('User'))
				//{
					//return $this->redirect(Router::url('/', true));
				//}
				//$userres=$this->Session->read('User');
				//$this->set('userid',$userres['user_id']);
				$this->set('title_for_layout','Success Stories Details');
				$this->loadModel('SuccessStory');
				if(isset($this->request->params['pass'][1]))
				{
					$result=$this->SuccessStory->find('first', array('conditions' => array('success_id' => $this->request->params['pass'][1])));
					$this->request->data=$result;
					$this->set('storyResDetails', $result);
				}
				$this->layout="success-stories-details";
				break;
				
				case 'news-details':
				//if(!$this->Session->check('User'))
				//{
					//return $this->redirect(Router::url('/', true));
				//}
				//$userres=$this->Session->read('User');
				//$this->set('userid',$userres['user_id']);
				$this->set('title_for_layout','News Details');
				$this->loadModel('News');
				if(isset($this->request->params['pass'][1]))
				{
					$result=$this->News->find('first', array('conditions' => array('news_id' => $this->request->params['pass'][1])));
					$this->request->data=$result;
					$this->set('newsDetails', $result);
				}
				$this->layout="news-details";
				break;
				//================mmab=========31.12.15=====ends======================
				
				case 'sales-preview' :
				
					if($postname!=''):
					
					$this->loadModel('PostAd');
					$salesDetail=$this->PostAd->find('first', array('conditions' => array('slug' =>$postname)));
					
					if(empty($salesDetail))
					{
						$this->set('title_for_layout','404 Not Found');
						$this->layout="404";
					}
					else
					{
						$this->loadModel('SalesOrder');
						$SalesOrder=$this->SalesOrder->find('first', array('conditions' => array('SalesOrder.adv_id' => $salesDetail['PostAd']['adv_id']),'fields' => array('SUM(SalesOrder.qty) as orderqty')));
						$this->set('SalesOrder',$SalesOrder);
						//pr($SalesOrder);exit;
						$this->set('salesDetail',$salesDetail);
						if(!empty($salesDetail))
						{
							$userid=$salesDetail['PostAd']['user_id'];
							$adv_id=$salesDetail['PostAd']['adv_id'];
							$this->loadModel('ManageUser');
							$userdetail=$this->ManageUser->find('first', array('conditions' => array('user_id' => $userid)));
							$this->loadModel('PostadImg');
							$allimg=$this->PostadImg->find('all', array('conditions' => array('post_ad_id' => $adv_id)));
							$this->set('title_for_layout', stripslashes($salesDetail['PostAd']['adv_name']));
							
							//Recently Viewed Sales....
							//Most Viewed Company Function
							if($this->Session->check('recentsales'))
							{
								$sessionSales=$this->Session->read('recentsales');
								//print_r($sessionSales);exit;
								if(!in_array($adv_id,$sessionSales))
								{
									//$salesarr=$this->Session->read('recentsales');
									array_push($sessionSales,$adv_id);
									$this->Session->write('recentsales',$sessionSales);
								}
							}
							else
							{
								$salesarr=array();
								array_push($salesarr,$adv_id);
								$this->Session->write('recentsales',$salesarr);
								//$CSDB->Insert($wpdb->prefix.'mostviewedjob',array('jobid' => $jobid));
								
							}
							//=========================
						}
						else
						{
							$userdetail=array();
							$allimg=array();
						}
						$this->set('userDetail',$userdetail);
						$this->set('allimg',$allimg);
						$this->layout="sales_preview";
					}
					endif;
					
				break;
				case 'parts-order' :
				$this->set('title_for_layout', 'Order Parts');
				$bidid=(isset($this->request->params['named']['bidid'])) ? $this->request->params['named']['bidid'] : '';
				if(!$this->Session->check('User'))
				{
					$customPath= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					//$customPath=$_SERVER['HTTP_REFERER']
					$this->Session->write('redirectLink',$customPath);
					return $this->redirect(Router::url('/Logins/login', true));
				}
				
				if($bidid=='')
				{
					if(isset($_SERVER['HTTP_REFERER']))
					{
					$this->redirect($_SERVER['HTTP_REFERER']);
					}
					else
					{
						$this->redirect(Router::url('/', true));
					}
				}
				$this->loadModel('BidOffer');
				if (!$this->BidOffer->exists($bidid)) {
					if(isset($_SERVER['HTTP_REFERER']))
					{
					$this->redirect($_SERVER['HTTP_REFERER']);
					}
					else
					{
						$this->redirect(Router::url('/', true));
					}
				}
				
				$this->loadModel('BidOffer');
				$bidDetail=$this->BidOffer->find('first', array('conditions' => array('status' => 0, 'bid_id' =>$bidid)));
				$this->set('bidDetail',$bidDetail);
					$this->loadModel('MasterCountry');
				$countylist = array(''=>'-Choose region-');
				$countylist += $this->MasterCountry->find('list', array('fields' => array
		('country_id','country_name'), 'order' =>array('country_name' => 'asc')));
			$this->set('countylist', $countylist);
					//--------------Order save functiona;lity------------
					if($this->request->is('post'))
						{
							//-----------------------------------------------------
							$this->loadModel('MasterMessage');
							$loginBlank=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 29)));
							$ownSalesValidate=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 53)));
							$alreadyOrder=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 54)));
							$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>55)));
							$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 56)));
							$deliveryblnk=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 47)));
							
							//-------------------------------------------------------
							
							$this->loadModel('PartsOrder');
							if(isset($this->request->data['order_send']))
							{
								$this->loadModel('MasterCountry');
								$countyRes=$this->MasterCountry->find('first', array('conditions' => array('country_id' => $this->request->data['PartsOrder']['county'])));
								
								$shippcounty=$countyRes['MasterCountry']['country_name'];
								$this->loadModel('MasterLocation');
								$localRes=$this->MasterLocation->find('first', array('conditions' => array('location_id' => $this->request->data['PartsOrder']['location'])));
								$shipplocality=$localRes['MasterLocation']['location_name'];
								
								$shippcounty=$countyRes['MasterCountry']['country_name'];
								$lastid=$this->PartsOrder->find('first', array('order' => array('id' => 'desc')));
								  if(!empty($lastid))
								  {
									$lsid=$lastid['PartsOrder']['orderid'];
									$lastempid=explode('R',$lsid); 
									$lastempid1=$lastempid[1]+1;
									$orderID=$lastempid[0].'R'.$lastempid1;
								  }else{
									$orderID='OR10001';
								  }
								  $this->request->data['PartsOrder']['orderid']=$orderID;
								//print_r($this->Session->read('6_letters_code'));
								//pr($this->request->data);exit;
								if(!$this->Session->check('User'))
								{
									$this->set('openlogin','yes');
									$this->Session->setFlash(__('<div class="alert alert-danger">'.$loginBlank['MasterMessage']['msg'].'</div>'));
									if(isset($this->request->data['MasterUser']['user_login_id']))
									{
										$useremail=$this->request->data['MasterUser']['user_login_id'];
										$userpass=$this->request->data['MasterUser']['user_pass'];
										$this->loadModel('MasterUser');
										$user_count = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.email'=>$useremail,'MasterUser.pass'=>md5($userpass),'is_active' => 1)));
										if(count($user_count)>0)
										{
											$this->loadModel('RequestPart');
											$partsUserCount=$this->RequestPart->find('count', array('conditions'=>array('RequestPart.user_id'=>$user_count['MasterUser']['user_id'],'RequestPart.request_id'=>$this->request->data['PartsOrder']['request_id'])));
											if($partsUserCount>0)
											{
											
											
											
											$cpuntsalesorder=$this->PartsOrder->find('count', array('conditions' => array('user_id' => $user_count['MasterUser']['user_id'], 'status' => 1, 'bid_id' => $this->request->data['PartsOrder']['bid_id'])));
											$cpuntsalesorder=0;
										
												if($cpuntsalesorder>0)
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">'.$alreadyOrder['MasterMessage']['msg'].'</div>'));
												}
												else
												{		
												$this->Session->write('User',$user_count['MasterUser']);
											$this->request->data['PartsOrder']['user_id']=$user_count['MasterUser']['user_id'];
														
															$this->loadModel('PartsOrder');
														if($this->request->data['PartsOrder']['delivery_method']=='')
														{
															$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryblnk['MasterMessage']['msg'].'</div>'));
														}
														else
														{
															$this->request->data['PartsOrder']['status']=0;
															if($this->PartsOrder->save($this->request->data))
															{
																$this->loadModel('BidOffer');
																$bidofferRes=$this->BidOffer->find('first', array('conditions' => array('bid_id' => $this->request->data['PartsOrder']['bid_id'])));
																$this->loadModel('MasterUser');
																$userdetail=$this->MasterUser->find('first', array('conditions' => array('user_id' => $bidofferRes['BidOffer']['user_id'])));
																$baseurl='http://'.$_SERVER['SERVER_NAME'].Router::url('/');
																//Mail Functionality----------------
																/*$body='<table width="492" cellspacing="0" cellpadding="0">
																  <tr><td colspan="3">Dear '.stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']).',</td></tr>
																  <tr><td colspan="3">&nbsp;</td></tr>
																 <tr><td colspan="3">Your order has been successfully booked.<br/></td></tr>
											  <tr><td colspan="3">Thank you for your order!<br/><br/></td></tr>
											   <tr><td colspan="3">&nbsp;</td></tr>
																  <tr><td colspan="3">Click <a href="'.$baseurl.'RequestParts/partsorder">here</a> to go your parts order list page</td></tr>
																 <tr><td colspan="3">&nbsp;</td></tr>
																  <tr><td colspan="3">Your Order Details<br/></td></tr>
																  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																  <tr><td colspan="3">Your Details: <br/><br/></td></tr></table>';
																$body.='<table width="492" border="1">
																  <tr>
																  <td width="30%" align="center">Title</td>
																  <td width="30%" colspan="2" align="center">Price</td>
																  </tr>';
																   $body.='<tr>
																		<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																		<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).' RON</td>
																	  </tr>
																	  </table>';
																	  $body.='<table width="492">
																	  <tr><td colspan="3"><br/>Regards,</td></tr>
																	  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																	  </table>';
																	  
																	  //Admin & poat ads submit User Mail ====================
																	  $abody='<table width="492">
																	  <tr><td colspan="3"><u><strong>Order Details</strong></u></td></tr>
																	  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																	  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';
																	 
																 $abody.='<table width="492" border="1">
																  <tr>
																  <td width="30%" align="center">Title</td>
																  <td width="30%" align="center">Price</td>
																  </tr>';
																  $abody.='<tr>
																		<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																		<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).' RON</td>
																	  </tr>
																	  </table>';
																	   $abody.='<table width="492">
																	  <tr><td colspan="3"><br/>Regards,</td></tr>
																	  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																	  </table>';
																	  //================Post order=================
																	   $pbody='<table width="492">
																	  <tr><td colspan="3"><u><strong>Order Details</strong></u></td></tr>
																	  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																	  
																	  <tr><td colspan="3">&nbsp;</td></tr>
																	  </table>';
																	 
																	 $pbody.='<table width="492" border="1">
																	  <tr>
																	  <td width="30%" align="center">Title</td>
																	  <td width="30%" align="center">Price</td>
																	  </tr>';
																	  $pbody.='<tr>
																			<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																			<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).' RON</td>
																		  </tr>
																		  </table>';
																		   $pbody.='<table width="492">
																		  <tr><td colspan="3"><br/>Regards,</td></tr>
																		  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																		  </table>';*/
																		  $partsOrderDetail='<table width="492" border="1">
																		  <tr>
																		  <td width="30%" align="center">Denumire piesa </td>
																		  <td width="30%" colspan="2" align="center">Pret</td>
																		  </tr><tr>
																				<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																				<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).'</td>
																			  </tr>
																			  </table>';
																			$PartsDeliveryDetail.='<table width="492">
																			  <tr><td colspan="3"><u><strong>Delivery Details</strong></u></td></tr>
																			  <tr><td colspan="3">Name: <strong>'.stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']).'</strong></td></tr>
																			   <tr><td colspan="3">Telephone: <strong>'.stripslashes($this->request->data['PartsOrder']['phone']).'</strong></td></tr>
																			   <tr><td colspan="3">County: <strong>'.stripslashes($shippcounty).'</strong></td></tr>
																			   <tr><td colspan="3">Location: <strong>'.stripslashes($shipplocality).'</strong></td></tr>
																				<tr><td colspan="3">Postcode: <strong>'.stripslashes($this->request->data['PartsOrder']['postcode']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Method: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_method']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Address: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_add']).'</strong></td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table>';
																			 $OfferPieceName= stripslashes($bidofferRes['BidOffer']['piece']);
																		  $partsusertempDetail=$this->Dez->BapCustUniGetTemplate(11);
																		$partsUserSubject=stripslashes($partsusertempDetail['EmailTemplate']['mail_subject']);
																		$body =stripslashes($partsusertempDetail['EmailTemplate']['mail_body']);
																		$body= str_replace('{Name}', stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']), $body);
																		$body= str_replace('{OrderId}', 'Order ID#: <strong>'.$orderID.'</strong>', $body);
																		$body= str_replace('{PartsOrderDetail}', $partsOrderDetail, $body);
																		$body= str_replace('{PartsDeliveryDetail}', $PartsDeliveryDetail, $body);
																		$body= str_replace('{OfferPieceName}', $OfferPieceName, $body);

																		 /* $body='<table width="492" cellspacing="0" cellpadding="0">
																		  <tr><td colspan="3">Dear '.stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']).',</td></tr>
																		  <tr><td colspan="3">&nbsp;</td></tr>
																		 <tr><td colspan="3">Your order has been successfully booked.<br/></td></tr>
													  <tr><td colspan="3">Thank you for your order!<br/><br/></td></tr>
																		 <tr><td colspan="3">&nbsp;</td></tr>
																		  <tr><td colspan="3">Your Order Details<br/></td></tr>
																		  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																		  <tr><td colspan="3">Your Details: <br/><br/></td></tr></table>';
																		$body.='<table width="492" border="1">
																		  <tr>
																		  <td width="30%" align="center">Denumire piesa </td>
																		  <td width="30%" colspan="2" align="center">Pret</td>
																		  </tr>';
																		   $body.='<tr>
																				<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																				<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).'</td>
																			  </tr>
																			  </table>';
																			  $body.='<table width="492">
																			  <tr><td colspan="3"><br/>Regards,</td></tr>
																			  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																			  </table>';*/
																			  
																			  //Admin & poat ads submit User Mail ====================
																			   $partsadmintempDetail=$this->Dez->BapCustUniGetTemplate(13);
																		$partsaSubject=stripslashes($partsadmintempDetail['EmailTemplate']['mail_subject']);
																		$abody =stripslashes($partsadmintempDetail['EmailTemplate']['mail_body']);
																		$abody= str_replace('{Name}', stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']), $abody);
																		$abody= str_replace('{OrderId}', 'Order ID#: <strong>'.$orderID.'</strong>', $abody);
																		$abody= str_replace('{PartsOrderDetail}', $partsOrderDetail, $abody);
																		$abody= str_replace('{PartsDeliveryDetail}', $PartsDeliveryDetail, $abody);
																		$abody= str_replace('{OfferPieceName}', $OfferPieceName, $abody);
																			  /*$abody='<table width="492">
																			  <tr><td colspan="3"><u><strong>Order Details</strong></u></td></tr>
																			  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table>';
																			 
																			 
																		 $abody.='<table width="492" border="1">
																		  <tr>
																		  <td width="30%" align="center">Denumire piesa </td>
																		  <td width="30%" align="center">Price</td>
																		  </tr>';
																		  $abody.='<tr>
																				<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																				<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).'</td>
																			  </tr>
																			  
																			  </table>';
																				$abody.='<table width="492">
																			  <tr><td colspan="3"><u><strong>Delivery Details</strong></u></td></tr>
																			  <tr><td colspan="3">Name: <strong>'.stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']).'</strong></td></tr>
																			   <tr><td colspan="3">Telephone: <strong>'.stripslashes($this->request->data['PartsOrder']['phone']).'</strong></td></tr>
																			   <tr><td colspan="3">County: <strong>'.stripslashes($shippcounty).'</strong></td></tr>
																			   <tr><td colspan="3">Location: <strong>'.stripslashes($shipplocality).'</strong></td></tr>
																				<tr><td colspan="3">Postcode: <strong>'.stripslashes($this->request->data['PartsOrder']['postcode']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Method: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_method']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Address: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_add']).'</strong></td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table>';
																			   $abody.='<table width="492">
																			  <tr><td colspan="3"><br/>Regards,</td></tr>
																			  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																			  </table>';*/

																			  //====Mail To Bidder===========
																			   $partsbiidertempDetail=$this->Dez->BapCustUniGetTemplate(12);
																		$partsbidderSubject=stripslashes($partsbiidertempDetail['EmailTemplate']['mail_subject']);
																		$pbody =stripslashes($partsbiidertempDetail['EmailTemplate']['mail_body']);
																		$pbody= str_replace('{Name}', stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']), $pbody);
																		$pbody= str_replace('{OrderId}', 'Order ID#: <strong>'.$orderID.'</strong>', $pbody);
																		$pbody= str_replace('{PartsOrderDetail}', $partsOrderDetail, $pbody);
																		$pbody= str_replace('{PartsDeliveryDetail}', $PartsDeliveryDetail, $pbody);
																		$pbody= str_replace('{OfferPieceName}', $OfferPieceName, $pbody);
																			  /* $pbody='<table width="492">
																			  <tr><td colspan="3">Your bidding against '.stripslashes($bidofferRes['BidOffer']['piece']).' parts has ordered. below are order detail</td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table><table width="492">
																			  <tr><td colspan="3"><u><strong>Order Details</strong></u></td></tr>
																			  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table>';
																			 
																			 
																		 $pbody.='<table width="492" border="1">
																		  <tr>
																		  <td width="30%" align="center">Denumire piesa </td>
																		  <td width="30%" align="center">Price</td>
																		  </tr>';
																		  $pbody.='<tr>
																				<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																				<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).'</td>
																			  </tr>
																			  
																			  </table>';
																				$pbody.='<table width="492">
																			  <tr><td colspan="3"><u><strong>Delivery Details</strong></u></td></tr>
																			  <tr><td colspan="3">Name: <strong>'.stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']).'</strong></td></tr>
																			   <tr><td colspan="3">Telephone: <strong>'.stripslashes($this->request->data['PartsOrder']['phone']).'</strong></td></tr>
																			   <tr><td colspan="3">County: <strong>'.stripslashes($shippcounty).'</strong></td></tr>
																			   <tr><td colspan="3">Location: <strong>'.stripslashes($shipplocality).'</strong></td></tr>
																				<tr><td colspan="3">Postcode: <strong>'.stripslashes($this->request->data['PartsOrder']['postcode']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Method: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_method']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Address: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_add']).'</strong></td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table>';
																			   $pbody.='<table width="492">
																			  <tr><td colspan="3"><br/>Regards,</td></tr>
																			  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																			  </table>';*/
																	  
																	  if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='::1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
																	{
																		$this->loadModel('AdminUser');
																		$adminRes=$this->AdminUser->find('first', array('conditions' => array('uid' => 2)));
																	$to_email=$user_count['MasterUser']['email'];
																	$adminemail=$adminRes['AdminUser']['mail_id'];
																	$Email = new CakeEmail('default');
																	$Email->to($to_email);
																	$Email->subject('Dezmembraripenet :: Parts Order');
																	$Email->replyTo($adminemail);
																	$Email->from (array($adminemail => 'Dezmembraripenet'));
																	$Email->emailFormat('both');
																	//$Email->headers();
																	$Email->send($body);
																	
																	//Admin Mail-----------------
																	$adminEmail = new CakeEmail('default');
																	$adminEmail->to($adminemail);
																	$adminEmail->subject('Dezmembraripenet :: Parts Order');
																	$adminEmail->replyTo($adminemail);
																	$adminEmail->from (array($to_email => 'Dezmembraripenet'));
																	$adminEmail->emailFormat('both');
																	//$Email->headers();
																	$adminEmail->send($pbody);
																	//----------------------------
																	
																		//Admin Mail-----------------
																		$postuserEmail = new CakeEmail('default');
																		$postuserEmail->to($userdetail['MasterUser']['email']);
																		$postuserEmail->subject('Dezmembraripenet :: Parts Order');
																		$postuserEmail->replyTo($adminemail);
																		$postuserEmail->from (array($to_email => 'Dezmembraripenet'));
																		$postuserEmail->emailFormat('both');
																		//$Email->headers();
																		$postuserEmail->send($abody);
																		//----------------------------
																	}
																//-----------------------------------
																$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
																/*$this->loadModel('Notice');
																$this->Notice->save(array('notice_type' => 'parts-order', 'postid' => $this->request->data['PartsOrder']['bid_id'], 'notice_name' => 'Parts Order'));*/
																$sessionUser=$this->Session->read('User');
																$this->loadModel('Notice');
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'parts-order', 'postid' => $this->request->data['PartsOrder']['bid_id'], 'notice_name' => 'Parts Order'));
																$this->Notice->create();
																$this->Notice->save(array('notice_type' => 'parts-order', 'postid' => $this->request->data['PartsOrder']['bid_id'], 'notice_name' => 'Parts Order', 'user_id' => $this->request->data['bid_user_id']));
																unset($this->request->data);
															}
															else
															{
																$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
															}
														}
												}
											
											
													
													
										
											}
											else
											{
												$this->Session->setFlash(__('<div class="alert alert-danger">Sunteți în imposibilitatea de a comanda acest parte</div>'));
											}
										}
										
									}
									
								}
								else
								{
									$user=$this->Session->read('User');
									$this->request->data['PartsOrder']['user_id']=$user['user_id'];
											$this->loadModel('PartsOrder');
											$cpuntsalesorder=$this->PartsOrder->find('count', array('conditions' => array('user_id' => $user['user_id'], 'status' => 1, 'bid_id' => $this->request->data['PartsOrder']['bid_id'])));
											$cpuntsalesorder=0;
												$this->loadModel('RequestAccessory');
												$checkofferCount=$this->RequestAccessory->find('count', array('conditions' => array('part_id' => $this->request->data['PartsOrder']['parts_id'], 'status' => 2)));
												if($checkofferCount<=0)
												{
													$this->loadModel('RequestPart');
													$partsUserCount=$this->RequestPart->find('count', array('conditions'=>array('RequestPart.user_id'=>$user['user_id'],'RequestPart.request_id'=>$this->request->data['PartsOrder']['request_id'])));
													if($partsUserCount>0)
													{
														if($cpuntsalesorder>0)
														{
															$this->Session->setFlash(__('<div class="alert alert-danger">'.$alreadyOrder['MasterMessage']['msg'].'</div>'));
														}
														else
														{		
																if($this->request->data['PartsOrder']['delivery_method']=='')
																{
																	$this->Session->setFlash(__('<div class="alert alert-danger">'.$deliveryblnk['MasterMessage']['msg'].'</div>'));
																}
																else
																{
																	$this->request->data['PartsOrder']['status']=0;
																	if($this->PartsOrder->save($this->request->data))
																	{
																		$this->loadModel('RequestAccessory');
																		$this->RequestAccessory->id=$this->request->data['PartsOrder']['parts_id'];
																		$this->RequestAccessory->saveField('status',2);
																		$this->loadModel('RequestPart');
																		$this->RequestPart->id=$this->request->data['PartsOrder']['request_id'];
																		$this->RequestPart->saveField('status',2);
																		$this->loadModel('BidOffer');
																		$this->BidOffer->id=$this->request->data['PartsOrder']['bid_id'];
																		$this->BidOffer->saveField('status',1);
																		$bidofferRes=$this->BidOffer->find('first', array('conditions' => array('bid_id' => $this->request->data['PartsOrder']['bid_id'])));
																		$this->loadModel('MasterUser');
																		$userdetail=$this->MasterUser->find('first', array('conditions' => array('user_id' => $bidofferRes['BidOffer']['user_id'])));
																		//Mail Functionality----------------
																		 $partsOrderDetail='<table width="492" border="1">
																		  <tr>
																		  <td width="30%" align="center">Denumire piesa </td>
																		  <td width="30%" colspan="2" align="center">Pret</td>
																		  </tr><tr>
																				<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																				<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).'</td>
																			  </tr>
																			  </table>';
																			$PartsDeliveryDetail.='<table width="492">
																			  <tr><td colspan="3"><u><strong>Delivery Details</strong></u></td></tr>
																			  <tr><td colspan="3">Name: <strong>'.stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']).'</strong></td></tr>
																			   <tr><td colspan="3">Telephone: <strong>'.stripslashes($this->request->data['PartsOrder']['phone']).'</strong></td></tr>
																			   <tr><td colspan="3">County: <strong>'.stripslashes($shippcounty).'</strong></td></tr>
																			   <tr><td colspan="3">Location: <strong>'.stripslashes($shipplocality).'</strong></td></tr>
																				<tr><td colspan="3">Postcode: <strong>'.stripslashes($this->request->data['PartsOrder']['postcode']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Method: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_method']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Address: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_add']).'</strong></td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table>';
																			 $OfferPieceName= stripslashes($bidofferRes['BidOffer']['piece']);
																		  $partsusertempDetail=$this->Dez->BapCustUniGetTemplate(11);
																		$partsUserSubject=stripslashes($partsusertempDetail['EmailTemplate']['mail_subject']);
																		$body =stripslashes($partsusertempDetail['EmailTemplate']['mail_body']);
																		$body= str_replace('{Name}', stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']), $body);
																		$body= str_replace('{OrderId}', 'Order ID#: <strong>'.$orderID.'</strong>', $body);
																		$body= str_replace('{PartsOrderDetail}', $partsOrderDetail, $body);
																		$body= str_replace('{PartsDeliveryDetail}', $PartsDeliveryDetail, $body);
																		$body= str_replace('{OfferPieceName}', $OfferPieceName, $body);

																		 /* $body='<table width="492" cellspacing="0" cellpadding="0">
																		  <tr><td colspan="3">Dear '.stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']).',</td></tr>
																		  <tr><td colspan="3">&nbsp;</td></tr>
																		 <tr><td colspan="3">Your order has been successfully booked.<br/></td></tr>
													  <tr><td colspan="3">Thank you for your order!<br/><br/></td></tr>
																		 <tr><td colspan="3">&nbsp;</td></tr>
																		  <tr><td colspan="3">Your Order Details<br/></td></tr>
																		  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																		  <tr><td colspan="3">Your Details: <br/><br/></td></tr></table>';
																		$body.='<table width="492" border="1">
																		  <tr>
																		  <td width="30%" align="center">Denumire piesa </td>
																		  <td width="30%" colspan="2" align="center">Pret</td>
																		  </tr>';
																		   $body.='<tr>
																				<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																				<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).'</td>
																			  </tr>
																			  </table>';
																			  $body.='<table width="492">
																			  <tr><td colspan="3"><br/>Regards,</td></tr>
																			  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																			  </table>';*/
																			  
																			  //Admin & poat ads submit User Mail ====================
																			   $partsadmintempDetail=$this->Dez->BapCustUniGetTemplate(13);
																		$partsaSubject=stripslashes($partsadmintempDetail['EmailTemplate']['mail_subject']);
																		$abody =stripslashes($partsadmintempDetail['EmailTemplate']['mail_body']);
																		$abody= str_replace('{Name}', stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']), $abody);
																		$abody= str_replace('{OrderId}', 'Order ID#: <strong>'.$orderID.'</strong>', $abody);
																		$abody= str_replace('{PartsOrderDetail}', $partsOrderDetail, $abody);
																		$abody= str_replace('{PartsDeliveryDetail}', $PartsDeliveryDetail, $abody);
																		$abody= str_replace('{OfferPieceName}', $OfferPieceName, $abody);
																			  /*$abody='<table width="492">
																			  <tr><td colspan="3"><u><strong>Order Details</strong></u></td></tr>
																			  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table>';
																			 
																			 
																		 $abody.='<table width="492" border="1">
																		  <tr>
																		  <td width="30%" align="center">Denumire piesa </td>
																		  <td width="30%" align="center">Price</td>
																		  </tr>';
																		  $abody.='<tr>
																				<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																				<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).'</td>
																			  </tr>
																			  
																			  </table>';
																				$abody.='<table width="492">
																			  <tr><td colspan="3"><u><strong>Delivery Details</strong></u></td></tr>
																			  <tr><td colspan="3">Name: <strong>'.stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']).'</strong></td></tr>
																			   <tr><td colspan="3">Telephone: <strong>'.stripslashes($this->request->data['PartsOrder']['phone']).'</strong></td></tr>
																			   <tr><td colspan="3">County: <strong>'.stripslashes($shippcounty).'</strong></td></tr>
																			   <tr><td colspan="3">Location: <strong>'.stripslashes($shipplocality).'</strong></td></tr>
																				<tr><td colspan="3">Postcode: <strong>'.stripslashes($this->request->data['PartsOrder']['postcode']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Method: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_method']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Address: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_add']).'</strong></td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table>';
																			   $abody.='<table width="492">
																			  <tr><td colspan="3"><br/>Regards,</td></tr>
																			  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																			  </table>';*/

																			  //====Mail To Bidder===========
																			   $partsbiidertempDetail=$this->Dez->BapCustUniGetTemplate(12);
																		$partsbidderSubject=stripslashes($partsbiidertempDetail['EmailTemplate']['mail_subject']);
																		$pbody =stripslashes($partsbiidertempDetail['EmailTemplate']['mail_body']);
																		$pbody= str_replace('{Name}', stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']), $pbody);
																		$pbody= str_replace('{OrderId}', 'Order ID#: <strong>'.$orderID.'</strong>', $pbody);
																		$pbody= str_replace('{PartsOrderDetail}', $partsOrderDetail, $pbody);
																		$pbody= str_replace('{PartsDeliveryDetail}', $PartsDeliveryDetail, $pbody);
																		$pbody= str_replace('{OfferPieceName}', $OfferPieceName, $pbody);
																			  /* $pbody='<table width="492">
																			  <tr><td colspan="3">Your bidding against '.stripslashes($bidofferRes['BidOffer']['piece']).' parts has ordered. below are order detail</td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table><table width="492">
																			  <tr><td colspan="3"><u><strong>Order Details</strong></u></td></tr>
																			  <tr><td colspan="3">Order ID#: <strong>'.$orderID.'</strong></td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table>';
																			 
																			 
																		 $pbody.='<table width="492" border="1">
																		  <tr>
																		  <td width="30%" align="center">Denumire piesa </td>
																		  <td width="30%" align="center">Price</td>
																		  </tr>';
																		  $pbody.='<tr>
																				<td>'.stripslashes($bidofferRes['BidOffer']['piece']).'</td>
																				<td colspan="2">'.stripslashes($this->request->data['PartsOrder']['totprice']).'</td>
																			  </tr>
																			  
																			  </table>';
																				$pbody.='<table width="492">
																			  <tr><td colspan="3"><u><strong>Delivery Details</strong></u></td></tr>
																			  <tr><td colspan="3">Name: <strong>'.stripslashes($this->request->data['PartsOrder']['fname']).' '.stripslashes($this->request->data['PartsOrder']['lname']).'</strong></td></tr>
																			   <tr><td colspan="3">Telephone: <strong>'.stripslashes($this->request->data['PartsOrder']['phone']).'</strong></td></tr>
																			   <tr><td colspan="3">County: <strong>'.stripslashes($shippcounty).'</strong></td></tr>
																			   <tr><td colspan="3">Location: <strong>'.stripslashes($shipplocality).'</strong></td></tr>
																				<tr><td colspan="3">Postcode: <strong>'.stripslashes($this->request->data['PartsOrder']['postcode']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Method: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_method']).'</strong></td></tr>
																				 <tr><td colspan="3">Delivery Address: <strong>'.stripslashes($this->request->data['PartsOrder']['delivery_add']).'</strong></td></tr>
																			  <tr><td colspan="3">&nbsp;</td></tr>
																			  </table>';
																			   $pbody.='<table width="492">
																			  <tr><td colspan="3"><br/>Regards,</td></tr>
																			  <tr><td colspan="3">Team Dezmembraripenet</td></tr>
																			  </table>';*/
																			 // echo $abody;exit;
																			  if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='::1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
																			{
																				$this->loadModel('AdminUser');
																				$adminRes=$this->AdminUser->find('first', array('conditions' => array('uid' => 2)));
																			$to_email=$user['email'];
																			$adminemail=$adminRes['AdminUser']['mail_id'];
																			$Email = new CakeEmail('default');
																			$Email->to($to_email);
																			$Email->subject('Dezmembraripenet :: Parts Order');
																			$Email->replyTo($adminemail);
																			$Email->from (array($adminemail => 'Dezmembraripenet'));
																			$Email->emailFormat('both');
																			//$Email->headers();
																			$Email->send($body);
																			
																			//Admin Mail-----------------
																			$adminEmail = new CakeEmail('default');
																			$adminEmail->to($adminemail);
																			$adminEmail->subject('Dezmembraripenet :: Parts Order');
																			$adminEmail->replyTo($adminemail);
																			$adminEmail->from (array($to_email => 'Dezmembraripenet'));
																			$adminEmail->emailFormat('both');
																			//$Email->headers();
																			$adminEmail->send($abody);
																			//----------------------------
																			
																				//Admin Mail-----------------
																				$postuserEmail = new CakeEmail('default');
																				$postuserEmail->to($userdetail['MasterUser']['email']);
																				$postuserEmail->subject('Dezmembraripenet :: Parts Order');
																				$postuserEmail->replyTo($adminemail);
																				$postuserEmail->from (array($to_email => 'Dezmembraripenet'));
																				$postuserEmail->emailFormat('both');
																				//$Email->headers();
																				$postuserEmail->send($pbody);
																				//----------------------------
																			}
																		//-----------------------------------
																		$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));
																		/*$this->loadModel('Notice');
																		$this->Notice->save(array('notice_type' => 'parts-order', 'postid' => $this->request->data['PartsOrder']['bid_id'], 'notice_name' => 'Parts Order'));*/
																		$sessionUser=$this->Session->read('User');
																		$this->loadModel('Notice');
																		$this->Notice->create();
																		$this->Notice->save(array('notice_type' => 'parts-order', 'postid' => $this->request->data['PartsOrder']['bid_id'], 'notice_name' => 'Parts Order'));
																		$this->Notice->create();
																		$this->Notice->save(array('notice_type' => 'parts-order', 'postid' => $this->request->data['PartsOrder']['bid_id'], 'notice_name' => 'Parts Order', 'user_id' => $this->request->data['bid_user_id']));
																		unset($this->request->data);
																	}
																	else
																	{
																		$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
																	}
																}
														}
													}
													else
													{
														$this->Session->setFlash(__('<div class="alert alert-danger">Aceasta piese nu este cererea dvs., astfel încât , nu sunt în măsură de a comanda această parte</div>'));
													}
												}
												else
												{
													$this->Session->setFlash(__('<div class="alert alert-danger">Această solicitare de piese deja rezolvate</div>'));
												}
											
											
													
													
										
								}
							}
							//echo $body;exit;

						}
						else
						{
							$sess_data=$this->Session->read('User');
							$this->request->data['PartsOrder']['fname']=$sess_data['first_name'];
							$this->request->data['PartsOrder']['lname']=$sess_data['last_name'];
							$this->request->data['PartsOrder']['phone']=$sess_data['telephone1'];
							$this->request->data['PartsOrder']['county']=$sess_data['country_id'];
							$this->request->data['PartsOrder']['location']=$sess_data['locality_id'];
							$this->request->data['PartsOrder']['postcode']=$sess_data['postal_code'];
						}
					//---------------------------------------------------
					
				
				$this->layout="parts-order";
				break;
				default:
       		 	$this->set('title_for_layout','404 Not found');
				$this->layout="404";
				break;
			}
			
		}
		else
		{
			$this->set('title_for_layout', 'Dezmembraripenet | Piese Auto');
			$this->layout='home';
		}
	}
	 function getSubbrand(){
	   $this->layout='ajax';
	  $brand_id= $this->request->data['brand_id'];
	   $this->loadModel("ManageBrand");
		$sub_brand = $this->ManageBrand->find('list',array('conditions'=>array("ManageBrand.flag" => $brand_id,"ManageBrand.status"=>1), 'fields' => array('ManageBrand.brand_id','ManageBrand.brand_name')));
		//$this->set("sub_brand",$sub_brand);
		if(count($sub_brand)>0){
			echo "<option value=''>All Model</option>";
			foreach($sub_brand AS $key=>$val){
			echo "<option value=$key>$val</option>";
		}
		}else{
			echo "<option value=''>All Model</option>";
		}
		
		exit;
	   
   }
}
