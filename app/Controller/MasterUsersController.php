<?php

App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

/**

 * MasterUsers Controller

 *

 * @property MasterUser $MasterUser

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class MasterUsersController extends AppController {



/**

 * Components

 *

 * @var array

 */

	public $components = array('Paginator', 'Session','RequestHandler','PhpMailerEmail','Email', 'Dez');

	//public $helper = array('custom');

/**

 * index method

 *

 * @return void

 */

 

 

 

	/*function captcha_image()

    {

        $this->Captcha->image();

    }

    

    function captcha_audio()

    {

        $this->Captcha->audio();

    } */

 

	public function index() {

		$this->MasterUser->recursive = 0;

		$this->set('masterUsers', $this->Paginator->paginate());

	}

	

	/*public function login() { //echo "<pre>";print_r($this->request->data['MasterUser']); //exit;

		//$this->chk_session();

		if(isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser'])){

			$chk_email = array();

			$email = trim($this->request->data['MasterUser']['Email']);

			$pass = trim($this->request->data['MasterUser']['Password']);

			$user_count = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.email'=>$email,'MasterUser.pass'=>md5($pass))));

			//echo count($user_count);exit;

			if(count($user_count) == 0){

				$email_info = $this->MasterUser->findByemail($email); 

				if($email_info){

					$chk_pass = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.user_id'=>$email_info['MasterUser']['user_id'],'MasterUser.pass'=>md5($pass))));

					if(count($chk_pass) == 0){

						$attempt = $email_info['MasterUser']['wrong_login_attempt'] + 1;

						if($attempt == 3){

							$this->MasterUser->query("UPDATE master_users set is_active = 1,wrong_login_attempt=".$attempt." WHERE master_users.user_id = ".$email_info['MasterUser']['user_id']);

							$this->set('err_message','<font color=red>Account has inactive due to three times wrong password, for active please send request to Admin.</font>');

						}else{

							$this->MasterUser->query("UPDATE master_users set wrong_login_attempt =" . $attempt. " WHERE master_users.user_id = ".$email_info['MasterUser']['user_id']);

							$this->set('err_message','<font color=red>Login Failed ! Invalid Identity.</font>');

						}

					}

				}else{

					$this->set('err_message','<font color=red>Login Failed ! Invalid Identity.</font>');

				}

				

			}else{

				if($user_count){

					$email_data = $this->MasterUser->findByemail($email);

					if($email_data['MasterUser']['is_active'] == 1){

						$this->set('err_message','<font color=red>Account has inactive due to three times wrong password, for active please send request to Admin.</font>');

					}else{

						$User = array();

						$User = $user_count['MasterUser']; //echo "<pre>";print_r($User); exit;

						$this->Session->write('User',$User);

						$this->redirect(array('action' => 'user_dashboard'));

					}

				}//else{

					//$this->set('err_message','<font color=red>Login Failedddd ! Invalid Identity.</font>');

				//}

			}

		}

	}*/

	

	

	public function facebookregistrationprocess() { 

	  $this->layout = "ajax"; 

	  $str = "";

	  $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));

	  $max = count($characters) - 1;

	  for ($i = 0; $i < 6; $i++)

	  {

		  $rand = mt_rand(0, $max);

		  $str .= $characters[$rand];

	  }



	  $checkUser = $this->MasterUser->find('first',array('conditions' =>array('MasterUser.email'=>trim($this->data['email']))));

	  if(isset($checkUser['MasterUsers']['user_id'])){

		   echo 'avl';

		   exit;      

	  }else{

		   $userData=array();

		   $userData['MasterUser']['first_name']= trim($this->data['name']);

		   $userData['MasterUser']['email']= trim($this->data['email']);

		   //$userData['MasterUser']['pass']=$str;

		   $userData['MasterUser']['is_active']=0;

		   //$userData['MasterUser']['is_facebook']=1;

		   $this->MasterUser->save($userData);

		   $lastID=$this->MasterUser->getLastInsertId();

		   if($lastID!='')

		   {

				

				App::import('Vendor', 'PhpMailer', array('file' => 'PhpMailer' . DS . 'class.phpmailer.php'));

			

				$mail = new PHPMailer();

				

				$mail->IsSMTP();

				$mail->SMTPDebug  = 0;

				$mail->Host       = "relay-hosting.secureserver.net";

				

				$cdate=date('Y-m-d');

				$to=$this->data['email'];	

				//$headers = "MIME-Version: 1.0" . "\r\n";

				//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				//$headers .= 'From: <email@MyGreenbrookHome.com>' . "\r\n";

				$message='<table width="650" style="background:#fff; margin:0px auto; font-family:Raleway; font-size:15px; line-height:18px;border-collapse: collapse;" border:1px solid #ddd; vspace="0">

								<tr><td colspan="2"><p style="border-bottom:1px solid #ddd; padding:0 10px; margin:20px 20px 0;"></p>&nbsp;</td></tr><tr><td colspan="2" style=" padding:10px 30px; font-size:26px; line-height:30px; text-align:center;"><p style="margin:0px; padding:0px; color:#666666;">Click Continue to confirm your email.</p><p><a href="http://maasinfotech24x7.com/greenbrooksv2/Homes/emailconfiramation/'.base64_encode($lastID).'/'.base64_encode($cdate).'" style="color:#fff; font-weight:bold; border-bottom:1px solid #72c27f; box-shadow:0 2px #368133; display:inline-block; background:#4db848; text-decoration:none; padding:8px 40px; font-size:22px;">Continue</a></p></td></tr><tr><td colspan="2"><p style="border-bottom:1px solid #ddd; padding:0 10px; margin:20px 20px 0;"></p>&nbsp;</td></tr><tr><td colspan="2" style="padding:10px 25px; line-height:23px;"><p style="margin:0px; padding:0px; text-align:center; color:#666;">Greenbrook Property Development, LLC<br>32455 W. 12 Mile Road, #3523 Farmington Hills, MI 48333</p></td></tr><tr><td colspan="2" style="height:150px">&nbsp;</td></tr></table>';

				

				$mail->SetFrom('lopalori@gmail.com', 'MyDezmemHome');

				$mail->Subject    = 'Confirm Email For MyDezmemHome.com';

				$mail->MsgHTML($message);		

				$mail->AddAddress($to, $this->data['name']);

				

				$mail->Send();

			   

			   //mail($this->data['email']," Confirm Email For MyGreenbrookHome.com", $message,$headers);

			   echo 'ok';

		   }

		   exit;

		  }

    	}

	

	public function signinprocess(){

	 

	     $this->layout = "ajax"; 

	     session_name('CAKEPHP'); 

		 if($this->data['type']=='site'){

		     $isexist=$this->MasterUsers->find('count', array('conditions' =>array('MasterUsers.email'=>trim($this->data['signin_email']),'MasterUsers.pass'=>trim($this->data['signin_password']),'User.is_active'=>1)));

		 }else if($this->data['type']=='fb'){

		    $isexist=$this->MasterUsers->find('count', array('conditions' =>array('MasterUsers.email'=>trim($this->data['signin_email']),'MasterUsers.is_active'=>1)));

			

			//$update_user_name = "UPDATE `users` SET `user_name` ='".trim($this->data['first_name'])."' WHERE `user_email`='".$this->data['signin_email']."'";

	        //$this->User->query($update_user_name) ;

			

		 }

		 

		 if($isexist==1){

		      $userData=$this->MasterUsers->find('first', array('conditions' =>array('MasterUsers.email'=>trim($this->data['signin_email']) ,'MasterUsers.is_active'=>1)));

			  if(isset($userData['MasterUsers']['user_id']))

			  {

		        $this->Session->write('userData',$userData);

                $this->Session->write('user_id',$userData['MasterUsers']['user_id']);

                 $this->Session->write('mail_id',$userData['MasterUsers']['email']);

                  $this->Session->write('user_name',$userData['MasterUsers']['first_name']);

				 echo 'ok';

				 exit;

			  }

	    

		 }else{

		     $this->facebook_logout();

		     echo 'fail'; 

			 exit;

		 }

	 }



	function forgot_password(){

		$this->set('title_for_layout','Forgot Password');

		$this->loadModel('MasterMessage');

		$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>7)));

		$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 8)));

		if(isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser'])){

			$email = trim($this->request->data['MasterUser']['Email']);

			$user_count = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.email'=>$email)));

			if($user_count){

				

				$pwd=strtolower($user_count['MasterUser']['first_name']).'@123!';

				$rand_pass = md5($pwd); //echo $rand_pass;exit;

				$this->request->data['MasterUser']['user_id'] = $user_count['MasterUser']['user_id'];

				$this->request->data['MasterUser']['pass'] = $rand_pass; //echo "<pre>";print_r($this->request->data);exit;

				$this->MasterUser->save($this->request->data);	

				$this->loadModel('AdminUser');

				$adminres=$this->AdminUser->find('first',array('conditions' => array('uid' =>2)));

				$adminname=stripslashes($adminres['AdminUser']['full_name']);

				$adminemail=$adminres['AdminUser']['mail_id'];	

				$logindetail="Login ID: ".$user_count['MasterUser']['email'];
					$logindetail.="<br>Password: ".$pwd;
					$username=stripslashes($user_count['MasterUser']['first_name'].' '.$user_count['MasterUser']['last_name']);
					$usertemplateDetail=$this->Dez->BapCustUniGetTemplate(2);
					$userSubject=stripslashes($usertemplateDetail['EmailTemplate']['mail_subject']);
					$message =stripslashes($usertemplateDetail['EmailTemplate']['mail_body']);
					$message= str_replace('{Name}', $username, $message);
					$message= str_replace('{logindetail}', $logindetail, $message);

				/*$message = '<table width="400" border="0" cellspacing="0" cellpadding="0">

									<tr>

									<td align="left" valign="middle" colspan="2">Dear '.$user_count['MasterUser']['first_name'].' '.$user_count['MasterUser']['last_name'].',</td>

								</tr>

								<tr>

									<td align="left" valign="middle" colspan="2">&nbsp;</td>

								</tr>

								<tr>

									<td align="left" valign="middle" colspan="2">You have requested for new password and here is your login details;</td>

								</tr>

								<tr>

								<td>Lgoin ID: </td>

								<td>'.$user_count['MasterUser']['email'].'</td>

								</tr>

								<tr>

								<td>New Password: </td>

								<td>'.$pwd.'</td>

								</tr>

								<tr>

									<td align="left" valign="middle">&nbsp;</td>

								</tr>

								<tr>

									<td align="left" valign="middle">Thanks</td>

								</tr>

								<tr>

									<td align="left" valign="middle">Dezmebraripenet</td>

								</tr>

							</table>';*/

				// mail here

				/*$email = "lopalori@gmail.com";

				App::import('Vendor', 'PhpMailer', array('file' => 'PhpMailer' . DS . 'class.phpmailer.php'));

				$mail = new PHPMailer();

				$mail->IsSMTP();

				$mail->SMTPDebug  = 0;

				$mail->Host = "relay-hosting.secureserver.net";

				$mail->SetFrom($email, 'Dezmem');

				$mail->Subject    = 'Dezmem :: Password recovery';

				$mail->MsgHTML($message);		

				$mail->AddAddress($email, "");

				$mail->Send()*/;

				$Email = new CakeEmail('default');

				$Email->to($user_count['MasterUser']['email']);

				$Email->subject($userSubject);

				$Email->replyTo($adminemail);

				$Email->from (array($adminemail => 'Dezmembraripenet'));

				$Email->emailFormat('both');

				//$Email->headers();

				$Email->send($message);

				//mail($email,"password change",$message);

				

				$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));

				$this->redirect(array('controller'=>'Logins','action'=>'login'));

			}else{

				$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));

			}

		}

		$this->layout='forgotpassword';

	}



/**

 * view method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function view($id = null) {

		if (!$this->MasterUser->exists($id)) {

			throw new NotFoundException(__('Invalid master user'));

		}

		$options = array('conditions' => array('MasterUser.' . $this->MasterUser->primaryKey => $id));

		$this->set('masterUser', $this->MasterUser->find('first', $options));

	}



/**

 * add method

 *

 * @return void

 */

 



	public function add() { 

	//pr($this->request->data);

	$this->set('title_for_layout','Register');

		if(isset($this->request->data['c_id']) && !empty($this->request->data['c_id'])){

			$contry_id = $this->request->data['c_id'];

			$this->loadModel('MasterLocation');

			$locations = $this->MasterLocation->find('list', array('conditions'=>array('MasterLocation.country_id'=>$contry_id),'fields'=>array('MasterLocation.location_id','MasterLocation.location_name'), 'order' => array('MasterLocation.location_name' => 'asc')));

			//print_r($locations);

			if(!empty($locations))

			{

				echo "<option value=''>--".CHOOSETWON."--</option>";

				foreach($locations as $singkey => $singloc)

				{

					echo "<option value='".$singkey."'>".$singloc."</option>";

				}

			}

		/*	$loc = json_encode($locations);

			print_r($loc);*/

			exit;

		}

		$this->loadModel('MasterCountry');

		$country = $this->MasterCountry->find('list', array('fields'=>array('MasterCountry.country_id','MasterCountry.country_name')));

		$this->set('country',$country);

		

		$this->loadModel('MasterUserType');

		$user_type = $this->MasterUserType->find('list', array('fields'=>array('MasterUserType.ut_id','MasterUserType.user_type')));

		$this->set('user_type',$user_type);

			//echo "<pre>";

		//print_r($this->Session->read());

		if ($this->request->data('MasterUser')) {

			//echo "<pre>";print_r($this->request->data);exit;

			$ses = $this->Session->read(); //echo "<pre>";print_r($ses);exit;

				$this->loadModel('MasterMessage');

				$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 1)));

				$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 2)));

				$incorrectMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 3)));

			if($ses['6_letters_code'] == trim($this->request->data['MasterUser']['captcha_text']) ){

				$this->MasterUser->create();

				//$this->request->data['is_active'] = 1;

				$password = md5(trim($this->request->data['MasterUser']['password']));

				//pr($this->request->data['MasterUser']);

				$this->request->data['MasterUser']['pass'] = $password;

				$this->request->data['MasterUser']['locality_id']=!empty($this->request->data['MasterUser']['locality_id'])?$this->request->data['MasterUser']['locality_id']:0;

				
				$password=$this->request->data['MasterUser']['password'];
				unset($this->request->data['MasterUser']['confirm_password']);

				unset($this->request->data['MasterUser']['tc']);

				unset($this->request->data['MasterUser']['password']);

				unset($this->request->data['MasterUser']['captcha_text']);

			 	$this->request->data['MasterUser']['is_active']=1;

				//echo "<pre>";print_r($this->request->data);exit;

				/*$id=$this->MasterUser->save($this->request->data);

				echo "<pre>";

				print_r($id);*/

				

				if ($this->MasterUser->save($this->request->data)) { 

					$insertid=$this->MasterUser->getLastInsertId();

					//$this->redirect(array('controller'=>'MasterUsers','action'=>'index'));

					// mail to user
					$userType= array(1 => 'Buyer', 2 => 'Seller');
					$register_name=$this->request->data['MasterUser']['first_name'].' '.$this->request->data['MasterUser']['last_name'];
					$registerDetail="Name: ".$this->request->data['MasterUser']['first_name'].' '.$this->request->data['MasterUser']['last_name'];
					$registerDetail.="<br>Email: ".$this->request->data['MasterUser']['email'];
					$registerDetail.="<br>User Type: ".$userType[$this->request->data['MasterUser']['user_type_id']];
					$registerDetail.="<br>Phone No: ".$userType[$this->request->data['MasterUser']['telephone1']];

					$logindetail="Email Address: ".$this->request->data['MasterUser']['email'];
					$logindetail.="<br>Password: ".$password;

					$AccountLink='<a href="'.Router::url('pages/user-profiles/'.$insertid, true).'">here</a>';
					$usertemplateDetail=$this->Dez->BapCustUniGetTemplate(1);
					$userSubject=stripslashes($usertemplateDetail['EmailTemplate']['mail_subject']);
					$message =stripslashes($usertemplateDetail['EmailTemplate']['mail_body']);
					$message= str_replace('{Name}', $register_name, $message);
					$message= str_replace('{RegisterDetail}', $registerDetail, $message);
					$message= str_replace('{logindetail}', $logindetail, $message);
					$message= str_replace('{AccountLink}', $AccountLink, $message);
					/*$message = '<table width="400" border="0" cellspacing="0" cellpadding="0">

									<tr>

										<td align="left" colspan="2">Dear '.$this->request->data['MasterUser']['first_name'].' '.$this->request->data['MasterUser']['last_name'].'</td>

									</tr>

									<tr>

									<td>Your account is successfully added in Dezmembraripenet, now you are the member of Dezmembraripenet.</td>

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

								$admintemplateDetail=$this->Dez->BapCustUniGetTemplate(4);
								$adminSubject=stripslashes($admintemplateDetail['EmailTemplate']['mail_subject']);
								$adminMsg =stripslashes($admintemplateDetail['EmailTemplate']['mail_body']);
								$adminMsg= str_replace('{Name}', $register_name, $adminMsg);
								$adminMsg= str_replace('{RegisterDetail}', $registerDetail, $adminMsg);
								$adminMsg= str_replace('{logindetail}', $logindetail, $adminMsg);
								$adminMsg= str_replace('{AccountLink}', $AccountLink, $adminMsg);

								/*$adminMsg = '<table width="400" border="0" cellspacing="0" cellpadding="0">

									<tr>

										<td align="left" colspan="2">Dear Admin</td>

									</tr>

									<tr>

									<td>A new user registered with your site to see the account detail click <a href="'.Router::url('/ManageUsers/view/'.$insertid, true).'">here</a></td>

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

				

					

					

					//-------------------------

					//Mail for User

					/*	$adminemail="maas_jyotirmayee@yahoo.com";

						$to_email=$this->request->data['MasterUser']['email'];

						$Email = new CakeEmail('default');

						$Email->to($to_email);

						$Email->subject('Dezmembraripenet :: Account creation');

						$Email->replyTo($adminemail);

						$Email->from (array($adminemail => 'Dezmembraripenet'));

						$Email->emailFormat('both');

						//$Email->headers();

						$Email->send($message);

					

					//--------------End-----------------

					

					// Mail for admin

						$admin_msg="A new user has been registered";

						$Email->to($adminemail);

						$Email->subject('Dezmembraripenet :: New User Registration');

						//$Email->replyTo($adminemail);

						$Email->from (array($adminemail => 'Dezmembraripenet'));

						$Email->emailFormat('both');

						//$Email->headers();

						$Email->send($admin_msg); */

						if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')

						{

						$to_email=$this->request->data['MasterUser']['email'];
						$this->loadModel('AdminUser');
						$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
							if(!empty($siteemail)){$adminemail=$siteemail['AdminUser']['mail_id'];}else{$adminemail='info@dezmembraripenet.com';}
						//$adminemail="chittas970@gmail.com";

						$Email = new CakeEmail('default');

						$Email->to($to_email);

						$Email->subject($userSubject);

						$Email->replyTo($adminemail);

						$Email->from (array($adminemail => 'Dezmembraripenet'));

						$Email->emailFormat('both');

						//$Email->headers();

						$Email->send($message);

						

						//Admin Mail-----------------

						$adminEmail = new CakeEmail('default');

						$adminEmail->to($adminemail);

						$adminEmail->subject($adminSubject);

						$adminEmail->replyTo($adminemail);

						$adminEmail->from (array($to_email => 'Dezmembraripenet'));

						$adminEmail->emailFormat('both');

						//$Email->headers();

						$adminEmail->send($adminMsg);

						//----------------------------

						}

						

						$user_count = $this->MasterUser->find('first', array('conditions'=>array('user_id' => $insertid)));

						$User=$user_count['MasterUser'];

						$this->Session->write('User',$User); 

						$this->Session->setFlash(__('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>'));

						$this->loadModel('Notice');

						$this->Notice->save(array('notice_type' => 'register', 'postid' => $insertid, 'notice_name' => 'Register'));

						$this->redirect(array('controller' => 'Logins', 'action' => 'user_dashboard'));

					

				} else {

					$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));

					//$this->redirect(array('controller'=>'MasterUsers','action'=>'index'));

				}

			}else{

				//$this->set('err_message','<font color=red>Captcha Failed ! Please try again.</font>');

				$this->Session->setFlash(__('<div class="alert alert-danger">'.$incorrectMsg['MasterMessage']['msg'].'</div>'));

			}

			

			

		}

		$this->layout='register';

	}



/**

 * edit method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function edit($id = null) {

		if(!$this->Session->check('User'))

		{

			return $this->redirect(Router::url('/Logins/login', true));

		}

		if (!$this->MasterUser->exists($id)) {

			throw new NotFoundException(__('Invalid master user'));

		}

		if ($this->request->is(array('post', 'put'))) {

			if ($this->MasterUser->save($this->request->data)) {

				$this->Session->setFlash(__('The master user has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The master user could not be saved. Please, try again.'));

			}

		} else {

			$options = array('conditions' => array('MasterUser.' . $this->MasterUser->primaryKey => $id));

			$this->request->data = $this->MasterUser->find('first', $options);

		}

	}



/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function delete($id = null) {

		if(!$this->Session->check('User'))

		{

			return $this->redirect(Router::url('/Logins/login', true));

		}

		$this->MasterUser->id = $id;

		if (!$this->MasterUser->exists()) {

			throw new NotFoundException(__('Invalid master user'));

		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->MasterUser->delete()) {

			$this->Session->setFlash(__('The master user has been deleted.'));

		} else {

			$this->Session->setFlash(__('The master user could not be deleted. Please, try again.'));

		}

		return $this->redirect(array('action' => 'index'));

	}

	

	

	

	

	

	

	function account_setting(){

		if(!$this->Session->check('User'))

		{

			return $this->redirect(Router::url('/Logins/login', true));

		}

		$this->set('title_for_layout','Account Setting');

		 //-------------------------------------

		  $this->loadModel('MasterMessage');

		$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>40)));

		$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 41)));

		  //---------------------------------------

		if(isset($this->request->data['c_id']) && !empty($this->request->data['c_id'])){

			$contry_id = $this->request->data['c_id'];

			$this->loadModel('MasterLocation');

			$locations = $this->MasterLocation->find('list', array('conditions'=>array('MasterLocation.country_id'=>$contry_id),'fields'=>array('MasterLocation.location_id','MasterLocation.location_name')));

			$loc = json_encode($locations);

			print_r($loc);exit;

		}

	

		$ses = $this->Session->read(); //echo "<pre>";print_r($ses);exit;

		$this->set('user_detail',$ses);

		$this->loadModel('MasterUserType');

		$user_type = $this->MasterUserType->find('list', array('fields'=>array('MasterUserType.ut_id','MasterUserType.user_type')));

		$this->set('user_type',$user_type);

		

		$this->loadModel('MasterCountry');

		$country = $this->MasterCountry->find('list', array('fields'=>array('MasterCountry.country_id','MasterCountry.country_name')));

		$this->set('country',$country);

		

		if(isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser'])){ //echo "<pre>";print_r($this->request->data['MasterUser']);exit;

			$this->request->data['MasterUser']['user_id'] = $ses['User']['user_id'];			

			$this->request->data['MasterUser']['first_name'] = $this->request->data['MasterUser']['first_name'];

			$this->request->data['MasterUser']['last_name'] = $this->request->data['MasterUser']['last_name'];

			$this->request->data['MasterUser']['email'] = $ses['User']['email'];

			

			

			//$this->request->data['MasterUser']['telephone'] = $telephone;

			$this->request->data['MasterUser']['country_id'] = $this->request->data['MasterUser']['country_id'];

			$this->request->data['MasterUser']['locality_id']=!empty($this->request->data['MasterUser']['locality_id'])?$this->request->data['MasterUser']['locality_id']:0;

			$this->request->data['MasterUser']['postal_code'] = $this->request->data['MasterUser']['Postal'];

			$this->request->data['MasterUser']['other_add'] = $this->request->data['MasterUser']['other_add'];

			$this->request->data['MasterUser']['user_type_id'] = $this->request->data['MasterUser']['user_type_id'];

			$fid=$this->MasterUser->save($this->request->data);

			

			$login_user = $this->MasterUser->find('first',array('conditions'=>array('MasterUser.user_id'=>$ses['User']['user_id'])));

			$this->Session->write('User',$login_user['MasterUser']); 

			//$ses11 = $this->Session->read(); echo "<pre>";print_r($ses11);exit;

			if($fid){

				$this->Session->setFlash('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>');

			}else{

				$this->Session->setFlash('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>');

			}

			

			$this->redirect(array('action' => 'account_setting'));

		}

		$this->layout='account_setting';

	}

	function change_email($user=''){

		

		if(!$this->Session->check('User'))

		{

			return $this->redirect(Router::url('/Logins/login', true));

		}

		$this->set('title_for_layout','Change Email');

		$ses_data = $this->Session->read(); //echo "<pre>";print_r($ses_data);//exit;



		$this->set('umail',@$ses_data['User']['email']);

		if($this->request->is(array('post','put')))

		{

			$this->loadModel('MasterMessage');

				$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 68)));

				$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 69)));

					if($this->MasterUser->save(array('user_id' => $ses_data['User']['user_id'],'email' => $this->request->data['MasterUser']['Email'])))

					{

					//$User = array();

				$ses_data['User']['email'] = $this->request->data['MasterUser']['Email'];

				$this->Session->write('User',$ses_data['User']); 

				$ses_data1 = $this->Session->read(); //echo "<pre>";print_r($ses_data1);exit;

				$this->Session->setFlash('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>');

					if($user){

						$this->redirect(array('action' => 'change_email'));

					}else{

						$this->redirect(array('action' => 'account_setting'));

					}

					

					

				}else{

					$this->Session->setFlash('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>');

				}

				

				

			}

		

		$this->layout='change_email';

	}

	

	function change_password(){

		if(!$this->Session->check('User'))

		{

			return $this->redirect(Router::url('/Logins/login', true));

		}

		$user_session=$this->Session->read('User');

		$userid=$user_session['user_id'];

		$this->set('title_for_layout','Change Password');



		if(isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser'])){ 

		//----------------------------------------------------------

		$this->loadModel('MasterMessage');

		$pwdLengthMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 70)));

		$incorrectCrrntPwd=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 71)));

		$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 72)));

		$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 73)));

		$pwdMisMatch=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 74)));

		//---------------------------------------------

				

			$cur_pass = trim($this->request->data['MasterUser']['current_password']);

			$new_pass = trim($this->request->data['MasterUser']['new_password']);

			$repass = trim($this->request->data['MasterUser']['retype_new_password']);

			$ses_data = $this->Session->read();

			

			$user_info = $this->MasterUser->find('first', array('conditions' => array('user_id' => $userid, 'pass' => md5($cur_pass))));

			if(strlen($new_pass)<5)

			{

				$this->Session->setFlash('<div class="alert alert-danger">'.$pwdLengthMsg['MasterMessage']['msg'].'</div>');

			}

			else if(strlen($repass)<5)

			{

				$this->Session->setFlash('<div class="alert alert-danger">'.$pwdLengthMsg['MasterMessage']['msg'].' </div>');

			}

			else if(count($user_info) <= 0){ 

			$this->Session->setFlash('<div class="alert alert-danger">'.$incorrectCrrntPwd['MasterMessage']['msg'].'</div>');	

			}else{ 

				if($new_pass == $repass){

					$updatpwd=$this->MasterUser->save(array('user_id' => $userid, 'pass' => md5($new_pass)));

					if($updatpwd)

					{

						$this->Session->setFlash('<div class="alert alert-success">'.$successMsg['MasterMessage']['msg'].'</div>');

						$this->redirect(array('action' => 'change_password'));	

					}

					else

					{

						$this->Session->setFlash('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>');

					}

				}else{ 

					$this->Session->setFlash('<div class="alert alert-danger">'.$pwdMisMatch['MasterMessage']['msg'].'</div>');	

				}

			}

		} 

		$this->layout='change-password';

	}

	

	/*function add_fleet_truck($f_id=''){ //echo $f_id;exit;

		$this->loadModel('SalesBrand'); 

		$this->loadModel('SalesFleetTruck');

		$brand_list = $this->SalesBrand->find('list', array('conditions'=>array('SalesBrand.flag'=>0,'SalesBrand.status'=>1),'fields'=>array('SalesBrand.brand_id','SalesBrand.brand_name')));

		$this->set("brand_list",$brand_list);

		

		$this->loadModel('MasterCountry');

		$country = $this->MasterCountry->find('list', array('fields'=>array('MasterCountry.country_id','MasterCountry.country_name')));

		$this->set('country',$country);

		

		if(isset($this->request->data['c_id']) && !empty($this->request->data['c_id'])){

			$contry_id = $this->request->data['c_id'];

			$this->loadModel('MasterLocation');

			$locations = $this->MasterLocation->find('list', array('conditions'=>array('MasterLocation.country_id'=>$contry_id),'fields'=>array('MasterLocation.location_id','MasterLocation.location_name')));

			$loc = json_encode($locations);

			print_r($loc);exit;

		}

		

		if( isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser']) ){

			//echo "<pre>";print_r($this->request->data['MasterUser']);exit;

			$MasterUser['SalesFleetTruck']['park_name'] = trim($this->request->data['MasterUser']['park_name']);

			$MasterUser['SalesFleetTruck']['comp_name'] = trim($this->request->data['MasterUser']['company_name']);

			$MasterUser['SalesFleetTruck']['vat'] = trim($this->request->data['MasterUser']['vat']);

			$MasterUser['SalesFleetTruck']['country_id'] = trim($this->request->data['MasterUser']['country_id']);

			$MasterUser['SalesFleetTruck']['location_id'] = trim($this->request->data['MasterUser']['locality_id']);

			$MasterUser['SalesFleetTruck']['postal_code'] = trim($this->request->data['MasterUser']['postal_code']);

			$MasterUser['SalesFleetTruck']['street'] = trim($this->request->data['MasterUser']['street']);

			$MasterUser['SalesFleetTruck']['nr'] = trim($this->request->data['MasterUser']['nr']);

			$MasterUser['SalesFleetTruck']['other_add'] = trim($this->request->data['MasterUser']['other_add']);

			$MasterUser['SalesFleetTruck']['phone'] = trim($this->request->data['MasterUser']['phone']);

			$MasterUser['SalesFleetTruck']['fax'] = trim($this->request->data['MasterUser']['fax']);

			$MasterUser['SalesFleetTruck']['email'] = trim($this->request->data['MasterUser']['email']);

			$MasterUser['SalesFleetTruck']['website'] = trim($this->request->data['MasterUser']['website']);

			$MasterUser['SalesFleetTruck']['description'] = trim($this->request->data['MasterUser']['description']);

			

			$img_nm1 = trim($this->request->data['MasterUser']['logo']['name']);

			$img_tmp1 = $this->request->data['MasterUser']['logo']['tmp_name'];

			move_uploaded_file($img_tmp1,'img/park_logo/'.$img_nm1);

			$MasterUser['SalesFleetTruck']['logo'] = trim($this->request->data['MasterUser']['logo']['name']);

			

			$img = '';

			foreach($this->request->data['MasterUser']['photos'] as $images){

				$img_nm = trim($images['name']);

				$img_tmp = $images['tmp_name'];

				move_uploaded_file($img_tmp,'img/truck_img/'.$img_nm);

				$img = $img.",".$img_nm;

			}

			$img = ltrim($img,',');

			$img = rtrim($img,',');

			$MasterUser['SalesFleetTruck']['fleet_pics'] = trim($img);

			

			$MasterUser['SalesFleetTruck']['warranty_detail'] = trim($this->request->data['MasterUser']['warrent']);

			

			$brand_ids = '';

			foreach($this->request->data['MasterUser']['brand'] as $k=>$v){

				$brand_ids = $brand_ids.",".$v;

			}

			$brand_ids = ltrim($brand_ids,',');

			$brand_ids = rtrim($brand_ids,',');

			

			$MasterUser['SalesFleetTruck']['brand_id'] = $brand_ids;

			$MasterUser['SalesFleetTruck']['contact_person'] = trim($this->request->data['MasterUser']['contact_name']);

			//echo "<pre>";print_r($MasterUser);exit;

			$this->SalesFleetTruck->save($MasterUser);

			$this->Session->setFlash('Fleet truck added successfully.');

			$this->redirect(array('action' => 'after_add_truck'));

		}

	}*/

	

	function add_fleet_truck($f_id=''){

		//echo $f_id;//exit;

		$this->loadModel('SalesBrand'); 

		$this->loadModel('SalesFleetTruck');

		

		$brand_list = $this->SalesBrand->find('list', array('conditions'=>array('SalesBrand.flag'=>0,'SalesBrand.status'=>1),'fields'=>array('SalesBrand.brand_id','SalesBrand.brand_name')));

		$this->set("brand_list",$brand_list);

		

		$this->loadModel('MasterCountry');

		$country = $this->MasterCountry->find('list', array('fields'=>array('MasterCountry.country_id','MasterCountry.country_name')));

		$this->set('country',$country);

		if($f_id){

			$fleet_truck = $this->SalesFleetTruck->find('all',array('conditions'=>array('SalesFleetTruck.fleet_id'=>$f_id)));

		$this->set('fleet_truck',$fleet_truck[0]['SalesFleetTruck']);

		$this->set('f_id',$f_id);

		}

		//echo "<pre>";

		//print_r($fleet_truck);

		

		if(isset($this->request->data['c_id']) && !empty($this->request->data['c_id'])){

			$contry_id = $this->request->data['c_id'];

			$this->loadModel('MasterLocation');

			$locations = $this->MasterLocation->find('list', array('conditions'=>array('MasterLocation.country_id'=>$contry_id),'fields'=>array('MasterLocation.location_id','MasterLocation.location_name')));

			$loc = json_encode($locations);

			print_r($loc);exit;

		}

		

		if( isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser']) ){

			//echo "<pre>";print_r($this->request->data['MasterUser']);exit;

			$MasterUser['SalesFleetTruck']['park_name'] = trim($this->request->data['MasterUser']['park_name']);

			$MasterUser['SalesFleetTruck']['comp_name'] = 'SC_'.trim($this->request->data['MasterUser']['company_name']).'_SRL';

			$MasterUser['SalesFleetTruck']['vat'] = 'EN_'.trim($this->request->data['MasterUser']['vat']);

			$MasterUser['SalesFleetTruck']['country_id'] = trim($this->request->data['MasterUser']['country_id']);

			$MasterUser['SalesFleetTruck']['location_id'] = trim($this->request->data['MasterUser']['locality_id']);

			$MasterUser['SalesFleetTruck']['postal_code'] = trim($this->request->data['MasterUser']['postal_code']);

			$MasterUser['SalesFleetTruck']['street'] = trim($this->request->data['MasterUser']['street']);

			$MasterUser['SalesFleetTruck']['nr'] = trim($this->request->data['MasterUser']['nr']);

			$MasterUser['SalesFleetTruck']['other_add'] = trim($this->request->data['MasterUser']['other_add']);

			$MasterUser['SalesFleetTruck']['phone'] = trim($this->request->data['MasterUser']['phone']);

			$MasterUser['SalesFleetTruck']['fax'] = trim($this->request->data['MasterUser']['fax']);

			$MasterUser['SalesFleetTruck']['email'] = trim($this->request->data['MasterUser']['email']);

			$MasterUser['SalesFleetTruck']['website'] = trim($this->request->data['MasterUser']['website']);

			$MasterUser['SalesFleetTruck']['description'] = trim($this->request->data['MasterUser']['description']);

			

			$img_nm1 = trim($this->request->data['MasterUser']['logo']['name']);

			if($img_nm1){

				$img_tmp1 = $this->request->data['MasterUser']['logo']['tmp_name'];

			move_uploaded_file($img_tmp1,'img/park_logo/'.$img_nm1);$MasterUser['SalesFleetTruck']['logo'] = trim($this->request->data['MasterUser']['logo']['name']);

			}else if(trim($this->request->data['hid_logo'])){

				$MasterUser['SalesFleetTruck']['logo'] = trim($this->request->data['hid_logo']);

			}

			

			$img = '';

			foreach($this->request->data['MasterUser']['photos'] as $images){

				$img_nm = trim($images['name']);

				if($img_nm){

				$img_tmp = $images['tmp_name'];

				move_uploaded_file($img_tmp,'img/truck_img/'.$img_nm);

				$img = $img.",".$img_nm;	

				}

			}

			$img = ltrim($img,',');

			$img = rtrim($img,',');

			if($img){

				$MasterUser['SalesFleetTruck']['fleet_pics'] = trim($img);

			}else if(trim($this->request->data['truck_img'])){

				$MasterUser['SalesFleetTruck']['fleet_pics'] = trim($this->request->data['truck_img']);

			}

			

			

			$MasterUser['SalesFleetTruck']['warranty_detail'] = trim($this->request->data['MasterUser']['warrent']);

			

			$brand_ids = '';

			foreach($this->request->data['MasterUser']['brand'] as $k=>$v){

				$brand_ids = $brand_ids.",".$v;

			}

			$brand_ids = ltrim($brand_ids,',');

			$brand_ids = rtrim($brand_ids,',');

			

			$MasterUser['SalesFleetTruck']['brand_id'] = $brand_ids;

			$MasterUser['SalesFleetTruck']['contact_person'] = trim($this->request->data['MasterUser']['contact_name']);

			//echo "<pre>";print_r($MasterUser);exit;

			if($f_id){

				$MasterUser['SalesFleetTruck']['fleet_id'] = $f_id;

			}

			$this->SalesFleetTruck->save($MasterUser);

			if($f_id){

				$this->Session->setFlash('Fleet truck updated successfully.');

				$this->redirect(array('action' => 'truck_part_setting'));

			}else{

			    $this->Session->setFlash('Fleet truck added successfully.');

                $this->redirect(array('action' => 'after_add_truck'));			

			}

		}

	}

	

	

	function after_add_truck(){

	}

	

	function fleet_truck_list(){

		$this->loadModel('SalesFleetTruck');

		$list_of_trucks = $this->SalesFleetTruck->find('all');

		$this->set('list_of_trucks',$list_of_trucks);

	}

	function detail_fleet_truck($fid = ''){

		$this->loadModel('SalesFleetTruck');

		$this->loadmodel('SalesFleetComment');

		$details_of_trucks = $this->SalesFleetTruck->find('all', array('conditions'=>array('SalesFleetTruck.fleet_id'=>$fid)));

		$this->set('details_of_trucks',$details_of_trucks);

		

		$comments = $this->SalesFleetComment->find('all', array('conditions'=>array('SalesFleetComment.fleet_truck_id'=>$fid)));

		$this->set('comments', $comments);

		

		if( isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser']) ){

			//pr($this->request->data['MasterUser']);//exit;

			$ses = $this->Session->read(); //pr($ses); exit;

			if($ses['User']){

				$comment['SalesFleetComment']['fleet_truck_id'] = $fid;

				$comment['SalesFleetComment']['user_id'] = $ses['User']['user_id'];

				$comment['SalesFleetComment']['comment'] = $this->request->data['MasterUser']['comment'];

				$this->SalesFleetComment->save($comment['SalesFleetComment']);

				$this->redirect(array('action' => 'detail_fleet_truck/'.$fid));

			}

		}

	}

	

	function truck_part_setting(){

		$this->loadModel('SalesFleetTruck'); 

		$comp_nm_lst = $this->SalesFleetTruck->find('all'); //echo "<pre>";print_r($comp_nm_lst);exit;

		$this->set('comp_nm_lst',$comp_nm_lst);		

	}

	function alert_auto(){ 

		//echo "<pre>";print_r($this->request);exit;

		$this->loadModel("SalesEmailAlert");

		$user_id=$this->Session->read("User.user_id"); // get the login user id

		

		if( isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser']) ){

			$data=$this->request->data['MasterUser'];

			//echo "<pre>";print_r($data);

			$alert_id=$data['alert_hid'];

			$SalesAlert['SalesEmailAlert']['email']=$data['email'];

			$SalesAlert['SalesEmailAlert']['user_id']=$user_id;

			$SalesAlert['SalesEmailAlert']['brand_ids']=implode(",",$data['brand']);

			$SalesAlert['SalesEmailAlert']['application_type']=$data['app_request'];

			$SalesAlert['SalesEmailAlert']['country_id']=implode(",",$data['country']);

			$SalesAlert['SalesEmailAlert']['app_relist_alert']=$data['app_relist_alert'];

			$SalesAlert['SalesEmailAlert']['category_ids']=implode(",",$data['category']);

			$SalesAlert['SalesEmailAlert']['app_separate_email']=$data['app_separate_email'];

			$SalesAlert['SalesEmailAlert']['alert_type']=$data['rcv_alert_time'];

			$SalesAlert['SalesEmailAlert']['email_send_time']=($data['rcv_alert_time']==4)?$data['mail_time']:'';

			if($alert_id){

				$SalesAlert['SalesEmailAlert']['alert_id']=$alert_id;

				$this->Session->setFlash("Alerts auto parts requests updated successfully");

			}else{

				$this->Session->setFlash("Alerts auto parts requests added successfully");

			}

			//print_r($SalesAlert);

			$this->SalesEmailAlert->save($SalesAlert);

		}

		

		$alert_data=$this->SalesEmailAlert->find("all",array("conditions"=>array("SalesEmailAlert.user_id"=>$user_id)));

		if(is_array($alert_data) && !empty($alert_data)){

			$this->set("alert_data",$alert_data[0]['SalesEmailAlert']);

			$alert_id=$alert_data[0]['SalesEmailAlert']['alert_id'];	

		}

		

		$this->loadModel('SalesBrand');

		$brand_list = $this->SalesBrand->find('list', array('conditions'=>array('SalesBrand.flag'=>0,'SalesBrand.status'=>1),'fields'=>array('SalesBrand.brand_id','SalesBrand.brand_name')));

		$this->set("brand_list",$brand_list);

		

		$this->loadModel('SalesCategory');

		$cat_list = $this->SalesCategory->find('list', array('conditions'=>array('SalesCategory.flag'=>0,'SalesCategory.status'=>1),'fields'=>array('SalesCategory.category_id','SalesCategory.category_name')));

		$this->set('cat_list',$cat_list);

		

		$this->loadModel('MasterCountry');

		$country = $this->MasterCountry->find('list', array('fields'=>array('MasterCountry.country_id','MasterCountry.country_name'),"limit"=>10));

		$this->set('country',$country);

	}

	

	function post_add(){

		$this->set('title_for_layout','Post Advertisement');

		$this->loadModel('SalesCategory');

		$this->loadModel('SalesBrand');

		$this->loadModel('SalesAdvertisement');

		$cat_list = $this->SalesCategory->find('list', array('conditions'=>array('SalesCategory.flag'=>0,'SalesCategory.status'=>1),'fields'=>array('SalesCategory.category_id','SalesCategory.category_name')));

		$this->set('cat_list',$cat_list);

		$this->loadModel('SalesBrand');

		$brand_list = $this->SalesBrand->find('list', array('conditions'=>array('SalesBrand.flag'=>0,'SalesBrand.status'=>1),'fields'=>array('SalesBrand.brand_id','SalesBrand.brand_name')));

		$this->set("brand_list",$brand_list);

		

		//echo "<pre>";print_r($this->request->data);exit;

		if(isset($this->request->data['brand_id']) && !empty($this->request->data['brand_id'])){

			$brand_id = $this->request->data['brand_id'];

			$condition = array('SalesBrand.flag'=>$brand_id,'SalesBrand.status'=>'1');

			$model_nm = $this->SalesBrand->find('list',array('conditions' => $condition,'fields' =>array('SalesBrand.brand_id','SalesBrand.brand_name'),'order' => array('SalesBrand.brand_name' => 'ASC')));

			$loc = json_encode($model_nm);

			print_r($loc);exit;

		}

		

		

		if(isset($this->request->data['cat_id']) && !empty($this->request->data['cat_id'])){

			$cat_id = $this->request->data['cat_id'];

			$condition = array('SalesCategory.flag'=>$cat_id,'SalesCategory.status'=>'1');

			$sub_cat=$this->SalesCategory->find('list',array('conditions' => $condition,'fields' =>array('SalesCategory.category_id','SalesCategory.category_name'),'order' => array('SalesCategory.category_name' => 'ASC')));

			$loc = json_encode($sub_cat);

			print_r($loc);exit;

			//print_r($this->request->data);exit;

		}

		

		if(isset($this->request->data) && !empty($this->request->data)){

			//echo "<pre>";print_r($this->request->data); //exit;

			

			$this->request->data['SalesAdvertisement']['category_id'] = $this->request->data['MasterUser']['category_id'];

			$this->request->data['SalesAdvertisement']['sub_cat_id'] = $this->request->data['MasterUser']['sub_cat_id']; 

			$this->request->data['SalesAdvertisement']['adv_name'] = $this->request->data['MasterUser']['song_name'];

			$this->request->data['SalesAdvertisement']['adv_details'] = $this->request->data['MasterUser']['myelement'];

			$img = '';

			

			foreach($this->request->data['MasterUser']['photos'] as $images){

				$img_nm = $images['name'];

				$img_tmp = $images['tmp_name'];

				move_uploaded_file($img_tmp,'img/profile/orig/'.$img_nm);

				

				$img = $img.",".$images['name'];

			}

			$img = ltrim($img,',');

			$img = rtrim($img,',');

		//echo $img; exit;

			

			$this->request->data['SalesAdvertisement']['adv_img'] = $img; 

			$this->request->data['SalesAdvertisement']['adv_brand_id'] = $this->request->data['MasterUser']['brand']; 

			$this->request->data['SalesAdvertisement']['adv_model_id'] = $this->request->data['MasterUser']['brand_model_nm'];  

			$this->request->data['SalesAdvertisement']['product_cond'] = $this->request->data['MasterUser']['product_cond'];

			$this->request->data['SalesAdvertisement']['price'] = $this->request->data['MasterUser']['price']; 

			$this->request->data['SalesAdvertisement']['currency'] = $this->request->data['MasterUser']['currency']; 

			$this->request->data['SalesAdvertisement']['quantity'] = $this->request->data['MasterUser']['quantity'];

			$payment = '';

			if(isset($this->request->data['MasterUser']['cash']) && $this->request->data['MasterUser']['cash'] != 0){

				$payment = $payment.",".$this->request->data['MasterUser']['cash'];

			}

			if(isset($this->request->data['MasterUser']['upon']) && $this->request->data['MasterUser']['upon'] != 0){

				$payment = $payment.",".$this->request->data['MasterUser']['upon'];

			}

			if(isset($this->request->data['MasterUser']['wire']) && $this->request->data['MasterUser']['wire'] != 0){

				$payment = $payment.",".$this->request->data['MasterUser']['wire'];

			}

			if(isset($this->request->data['MasterUser']['card']) && $this->request->data['MasterUser']['card'] != 0){

				$payment = $payment.",".$this->request->data['MasterUser']['card'];

			}

			if(isset($this->request->data['MasterUser']['other']) && $this->request->data['MasterUser']['other'] != 0){

				$payment = $payment.",".$this->request->data['MasterUser']['other'];

			}

			$payment = ltrim($payment,',');

			$payment = rtrim($payment,',');

			$this->request->data['SalesAdvertisement']['payment_mode'] = $payment;

			//$this->request->data['MasterUser']['delivery_method'] = $this->request->data['MasterUser']['category_id'];  

			$this->request->data['SalesAdvertisement']['time_required'] = $this->request->data['MasterUser']['dispatch_time']; 

			

			$this->SalesAdvertisement->save($this->request->data);

			$last_insert_id = $this->SalesAdvertisement->getLastInsertId();

			$last_id_info = $this->SalesAdvertisement->find('first', array('conditions'=>array('SalesAdvertisement.adv_id'=>$last_insert_id)));

			//echo "<pre>";print_r($last_id_info);exit;

			$this->set('saved_data_info',$last_id_info);

			$this->set('saved_data','saved_data');

		}

		$this->layout='category';

		

	}

	function auto_sub_cat($cid =''){

		$this->layout='ajax';

		$this->loadModel('SalesCategory');

		$nm=$_REQUEST['q'];

		$sub_cat = '';

		$condition = array('SalesCategory.category_name LIKE'=>'%'.$nm.'%','SalesCategory.flag'=>$cid,'SalesCategory.status'=>'1');

		$sub_cat=$this->SalesCategory->find('all',array('conditions' => $condition,'fields' =>array('SalesCategory.category_id','SalesCategory.category_name'),'order' => array('SalesCategory.category_name' => 'ASC')));

		//print_r($sub_cat);

		foreach($sub_cat as $k => $v){  

			$id = $v['SalesCategory']['category_id']; 

			$name = $v['SalesCategory']['category_name'];

			echo "$name|$id\n";

		}





		exit;

	}

	

	function logout(){

		$this->autoRender = false;

		$this->LoadModel('AuditLogin');

		//$login_details['AuditLogin']['user_id']=$this->Session->data('User.user_id');

		$logout_time=date('Y-m-d h:i:s');

		$this->AuditLogin->id=$this->Session->read('User.login_id');

		$this->AuditLogin->saveField('logout_time',$logout_time);

		

		$this->Session->delete('User');

		//$this->Session->destroy();

		$this->redirect(array('controller' => 'Logins', 'action' => 'login'));

	}

	

	

	

/****************************************************Start of Addition of Parts*************************************************************/

	function add_parts(){

		$this->loadModel('SalesBrand');

		$this->loadModel('MasterCountry');

		$this->loadModel('MasterLocation');

		$this->loadModel('SalesAddPart');

		

		$brand_list = $this->SalesBrand->find('list', array('conditions'=>array('SalesBrand.flag'=>0,'SalesBrand.status'=>1),'fields'=>array('SalesBrand.brand_id','SalesBrand.brand_name')));

		$this->set("brand_list",$brand_list);

		if(isset($this->request->data['brand_id']) && !empty($this->request->data['brand_id'])){

			$brand_id = $this->request->data['brand_id'];

			$condition = array('SalesBrand.flag'=>$brand_id,'SalesBrand.status'=>'1');

			$model_nm = $this->SalesBrand->find('list',array('conditions' => $condition,'fields' =>array('SalesBrand.brand_id','SalesBrand.brand_name'),'order' => array('SalesBrand.brand_name' => 'ASC')));

			$loc = json_encode($model_nm);

			print_r($loc);exit;

		}

		

		$country = $this->MasterCountry->find('list', array('fields'=>array('MasterCountry.country_id','MasterCountry.country_name')));

		$this->set('country',$country);

		

		if(isset($this->request->data['c_id']) && !empty($this->request->data['c_id'])){

			$contry_id = $this->request->data['c_id'];

			$locations = $this->MasterLocation->find('list', array('conditions'=>array('MasterLocation.country_id'=>$contry_id),'fields'=>array('MasterLocation.location_id','MasterLocation.location_name')));

			$loc = json_encode($locations);

			print_r($loc);exit;

		}

		

		if(isset($this->request->data) && !empty($this->request->data)){ 

			unset($this->request->data['SalesAddPart']['model_name']); //echo "<pre>";print_r($this->request->data); exit;

			$offer_part = '';

			if(isset($this->request->data['SalesAddPart']['we']) && !empty($this->request->data['SalesAddPart']['we']) && $this->request->data['SalesAddPart']['we'] != 0){

				$offer_part = $offer_part.",".$this->request->data['SalesAddPart']['we'];

			}

			if(isset($this->request->data['SalesAddPart']['from_truck']) && !empty($this->request->data['SalesAddPart']['from_truck']) && $this->request->data['SalesAddPart']['from_truck'] != 0){

				$offer_part = $offer_part.",".$this->request->data['SalesAddPart']['from_truck'];

			}

			$offer_part = ltrim($offer_part,',');

			$offer_part = rtrim($offer_part,',');

			$this->request->data['SalesAddPart']['offer_parts'] = $offer_part;

			

			$img = trim($this->request->data['SalesAddPart']['file']['name']);

			$this->request->data['SalesAddPart']['file_name'] = $img;

			$tmp_nm = $this->request->data['SalesAddPart']['file']['tmp_name'];

			move_uploaded_file($tmp_nm,'img/add_parts/'.$img);

			

			if( isset($this->request->data['SalesAddPart']['Add']['name_piece']) && !empty($this->request->data['SalesAddPart']['Add']['name_piece']) ){

				$another = $this->request->data['SalesAddPart']['Add'];

			}

			unset($this->request->data['SalesAddPart']['Add']);

			unset($this->request->data['SalesAddPart']['file']);

			unset($this->request->data['SalesAddPart']['from_truck']);

			unset($this->request->data['SalesAddPart']['we']);

			//echo "<pre>";print_r($this->request->data);//exit;

			$this->SalesAddPart->create();

			$this->SalesAddPart->save($this->request->data);

			if(isset($another) && !empty($another)){

				$offer['SalesAddPart']['brand_id'] = $this->request->data['SalesAddPart']['brand_id'];

				$offer['SalesAddPart']['model_id'] = $this->request->data['SalesAddPart']['model_id'];

				$offer['SalesAddPart']['version'] = $this->request->data['SalesAddPart']['version'];

				$offer['SalesAddPart']['manufacture_yr'] = $this->request->data['SalesAddPart']['manufacture_yr'];

				$offer['SalesAddPart']['engine'] = $this->request->data['SalesAddPart']['engine'];

				$offer['SalesAddPart']['identification_no'] = $this->request->data['SalesAddPart']['identification_no'];

				$offer['SalesAddPart']['country_id'] = $this->request->data['SalesAddPart']['country_id'];

				$offer['SalesAddPart']['location_id'] = $this->request->data['SalesAddPart']['location_id'];

				$offer_part = '';

				if(isset($this->request->data['SalesAddPart']['we']) && !empty($this->request->data['SalesAddPart']['we']) && $this->request->data['SalesAddPart']['we'] != 0){

					$offer_part = $offer_part.",".$this->request->data['SalesAddPart']['we'];

				}

				if(isset($this->request->data['SalesAddPart']['from_truck']) && !empty($this->request->data['SalesAddPart']['from_truck']) && $this->request->data['SalesAddPart']['from_truck'] != 0){

					$offer_part = $offer_part.",".$this->request->data['SalesAddPart']['from_truck'];

				}

				$offer_part = ltrim($offer_part,',');

				$offer_part = rtrim($offer_part,',');

				$offer['SalesAddPart']['offer_parts'] = $offer_part;

				

				$offer['SalesAddPart']['name_piece'] = $another['name_piece'];

				$offer['SalesAddPart']['description'] = $another['description'];

				$offer['SalesAddPart']['part_no'] = $another['part_no'];

				$offer['SalesAddPart']['price'] = $another['price'];

				$offer['SalesAddPart']['currency'] = $another['currency'];

				$offer['SalesAddPart']['file_name'] = $another['file']['name'];

				//echo "1111<pre>";print_r($offer);exit;

				$this->SalesAddPart->create();

				$this->SalesAddPart->save($offer);

			}

			//echo "<pre>";print_r($this->request->data);exit;

			$this->Session->setFlash('Offers added successfully.');

			$this->redirect(array('controller' => 'MasterUsers', 'action' => 'add_parts'));

		}

		

	}



	function add_parts_list(){

		$this->loadModel('SalesAddPart');

		//$request_list = $this->SalesAddPart->query("Select * from sales_add_parts,master_countries,master_locations,sales_brands WHERE sales_add_parts.brand_id = sales_brands.brand_id, sales_add_parts.model_id = sales_brands.brand_id, sales_add_parts.country_id = master_countries.country_id, sales_add_parts.location_id = master_locations.location_id");

		$request_list = $this->SalesAddPart->find('all');

		$this->set('request_list',$request_list);

		//echo "<pre>";print_r($request_list);exit;

	

	}





/****************************************************End of Addition of Parts*************************************************************/	



/****************************************************Start of Addition of firm Parts*************************************************************/

	function firm_parts($fp_id=''){

		//echo $f_id;//exit;

		

		$this->loadModel('SalesFirmPart');

		

		//get the brand details

		$this->loadModel('SalesBrand'); 

		$brand_list = $this->SalesBrand->find('list', array('conditions'=>array('SalesBrand.flag'=>0,'SalesBrand.status'=>1),'fields'=>array('SalesBrand.brand_id','SalesBrand.brand_name')));

		$this->set("brand_list",$brand_list);

		

		// get country

		$this->loadModel('MasterCountry');

		$country = $this->MasterCountry->find('list', array('fields'=>array('MasterCountry.country_id','MasterCountry.country_name')));

		$this->set('country',$country);

		

		// for edit data

		if($fp_id){

			$firm_parts = $this->SalesFirmPart->find('all',array('conditions'=>array('SalesFirmPart.parts_id'=>$fp_id)));

		  $this->set('firm_parts',$firm_parts[0]['SalesFirmPart']);

		   $this->set('fp_id',$fp_id);

		}

		//echo "<pre>";

		//print_r($firm_parts);

		

		//get location according to country

		if(isset($this->request->data['c_id']) && !empty($this->request->data['c_id'])){

			$contry_id = $this->request->data['c_id'];

			$this->loadModel('MasterLocation');

			$locations = $this->MasterLocation->find('list', array('conditions'=>array('MasterLocation.country_id'=>$contry_id),'fields'=>array('MasterLocation.location_id','MasterLocation.location_name')));

			$loc = json_encode($locations);

			print_r($loc);exit;

		}

		

		// for save data

		if( isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser']) ){

			//echo "<pre>";print_r($this->request->data['MasterUser']);exit;

			$MasterUser['SalesFirmPart']['commercial_name'] = trim($this->request->data['MasterUser']['commercial_name']);

			$MasterUser['SalesFirmPart']['comp_name'] = 'SC_'.trim($this->request->data['MasterUser']['company_name']).'_SRL';

			$MasterUser['SalesFirmPart']['vat'] = 'EN_'.trim($this->request->data['MasterUser']['vat']);

			$MasterUser['SalesFirmPart']['country_id'] = trim($this->request->data['MasterUser']['country_id']);

			$MasterUser['SalesFirmPart']['location_id'] = trim($this->request->data['MasterUser']['locality_id']);

			$MasterUser['SalesFirmPart']['postal_code'] = trim($this->request->data['MasterUser']['postal_code']);

			$MasterUser['SalesFirmPart']['street'] = trim($this->request->data['MasterUser']['street']);

			$MasterUser['SalesFirmPart']['nr'] = trim($this->request->data['MasterUser']['nr']);

			$MasterUser['SalesFirmPart']['other_add'] = trim($this->request->data['MasterUser']['other_add']);

			$MasterUser['SalesFirmPart']['phone'] = trim($this->request->data['MasterUser']['phone']);

			$MasterUser['SalesFirmPart']['fax'] = trim($this->request->data['MasterUser']['fax']);

			$MasterUser['SalesFirmPart']['email'] = trim($this->request->data['MasterUser']['email']);

			$MasterUser['SalesFirmPart']['website'] = trim($this->request->data['MasterUser']['website']);

			$MasterUser['SalesFirmPart']['description'] = trim($this->request->data['MasterUser']['description']);

			

			$img_nm1 = trim($this->request->data['MasterUser']['logo']['name']);

			if($img_nm1){

				$img_tmp1 = $this->request->data['MasterUser']['logo']['tmp_name'];

			move_uploaded_file($img_tmp1,'img/firmparts_logo/'.$img_nm1);$MasterUser['SalesFirmPart']['logo'] = trim($this->request->data['MasterUser']['logo']['name']);

			}else if(trim($this->request->data['hid_logo'])){

				$MasterUser['SalesFirmPart']['logo'] = trim($this->request->data['hid_logo']);

			}

			

			$img = '';

			foreach($this->request->data['MasterUser']['photos'] as $images){

				$img_nm = trim($images['name']);

				if($img_nm){

				$img_tmp = $images['tmp_name'];

				move_uploaded_file($img_tmp,'img/firmparts_img/'.$img_nm);

				$img = $img.",".$img_nm;	

				}

			}

			$img = ltrim($img,',');

			$img = rtrim($img,',');

			if($img){

				$MasterUser['SalesFirmPart']['parts_pics'] = trim($img);

			}else if(trim($this->request->data['parts_pics'])){

				$MasterUser['SalesFirmPart']['parts_pics'] = trim($this->request->data['parts_pics']);

			}

			

			

			$MasterUser['SalesFirmPart']['warranty_detail'] = trim($this->request->data['MasterUser']['warrent']);

			

			$brand_ids = '';

			foreach($this->request->data['MasterUser']['brand'] as $k=>$v){

				$brand_ids = $brand_ids.",".$v;

			}

			$brand_ids = ltrim($brand_ids,',');

			$brand_ids = rtrim($brand_ids,',');

			

			$MasterUser['SalesFirmPart']['brand_id'] = $brand_ids;

			$MasterUser['SalesFirmPart']['contact_person'] =(@$this->request->data['MasterUser']['is_contact']==1)? trim(@$this->request->data['MasterUser']['contact_name']):NULL;

			//echo "<pre>";print_r($MasterUser);exit;

			if($fp_id){

				$MasterUser['SalesFirmPart']['parts_id'] = $fp_id;

			}

			$this->SalesFirmPart->save($MasterUser);

			if($fp_id){

				$this->Session->setFlash('<div class="alert alert-success">Firm parts updated successfully.<div>');

				//$this->redirect(array('action' => 'truck_part_setting'));

			}else{

			    $this->Session->setFlash('Firm parts added successfully.');

                $this->redirect(array('action' => 'after_add_firmparts'));			

			}

		}

	}

	function after_add_firmparts(){

		

	}

	function firm_parts_listing(){

		$this->loadModel('SalesFirmPart');

		$firm_parts = $this->SalesFirmPart->find('all');

		$this->set('firm_parts',$firm_parts);

	}

	function detail_firmparts($fpid = ''){

		$this->loadModel('SalesFirmPart');

		$this->loadModel('SalesFirmpartsComment');

		$firmparts_details = $this->SalesFirmPart->find('all', array('conditions'=>array('SalesFirmPart.parts_id'=>$fpid)));

		$this->set('firmparts_details',$firmparts_details);

		

		$comments = $this->SalesFirmpartsComment->find('all', array('conditions'=>array('SalesFirmpartsComment.parts_id'=>$fpid)));

		$this->set('comments', $comments);

		

		if( isset($this->request->data['SalesFirmpartsComment']) && !empty($this->request->data['SalesFirmpartsComment']) ){

			//pr($this->request->data['MasterUser']);//exit;

			$ses = $this->Session->read(); //pr($ses); exit;

			if($ses['User']){

				$comment['SalesFirmpartsComment']['parts_id'] = $fpid;

				$comment['SalesFirmpartsComment']['user_id'] = $ses['User']['user_id'];

				$comment['SalesFirmpartsComment']['comment'] = $this->request->data['SalesFirmpartsComment']['comment'];

				$this->SalesFirmpartsComment->save($comment['SalesFirmpartsComment']);

				$this->redirect(array('action' => 'detail_firmparts/'.$fpid));

			}

		}

	}

	/****************************************************End of Addition of firm Parts*************************************************************/	

	

	function my_profile(){

		//echo "<pre>";

		$user_id=$this->Session->read('User.user_id');

		$this->loadModel("MasterUser");

		$user_data=$this->MasterUser->find("all",array("conditions"=>array("user_id"=>$user_id)));

		$this->set("user_data",$user_data[0]['MasterUser']);

		

		//print_r($user_data);//exit;

	}

	

/************************************************Warranty Details************************************************************************/

	function warranty_details(){

		$this->loadModel('SalesWarrantyDetail');

		

	}

/****************************************************************************************************************************************/



function sendMail(){



	$reason=array("1"=>"Seller untrustworthy","2"=>"Rating incorrect","3"=>"Other reason");

	$data=$this->request->data;

	$ind=$data[reason];

	$user_email=$this->Session->read('User.email');

	$to="lopalori@gmail.com";

	$body ="Dear, <br>Subject : $reason[$ind]<br/> Description : $data[desc]";

	//print $body;exit;

	$flag=mail($to,$reason[$ind],$body);

	 if($flag==1){

	  echo 1;exit;

  }else{

	  echo 0;exit;

  }

	

	/*$Email = new CakeEmail();

    $Email->from(array($user_email => 'Repot Reason'));

    $Email->to($to);

    $Email->subject($reason[$data['reason']]);

    $flag= $Email->send($data['desc']); */

 

	

	//mail('lopalori@gmail.com','subject','test the mail');

}

public function add_newsletter(){

	//pr($this->request);exit;

	//pr($_SERVER['HTTP_HOST']);exit;

	$this->loadModel('NewsLetter');

	$this->request->data['NewsLetter']['user_name']=$this->request->data['name'];

	$this->request->data['NewsLetter']['user_email']=$this->request->data['email'];

	$rec_exists=$this->NewsLetter->find('all',array('conditions'=>array('NewsLetter.user_email'=>$this->request->data['email'])));

	if(count($rec_exists)==0){

	if($this->NewsLetter->save($this->request->data['NewsLetter'])){

		$this->Session->setFlash(__('<div class="alert alert-success">You have subscribed successfully</div>'));

		}else{

			$this->Session->setFlash(__('<div class="alert alert-danger">You have not subscribe.Please try again.</div>'));

			}

	}else{

		$this->Session->setFlash(__('<div class="alert alert-danger">You have already subscribed.</div>'));

		}

			$path='http://'.$_SERVER['HTTP_HOST'].'/dezmem'; // hardcoaded

		$this->redirect($path);

		exit;

		

	}



	

}



