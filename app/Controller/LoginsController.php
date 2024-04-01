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
class LoginsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','PhpMailerEmail','Email','RequestHandler');
	//public $helper = array('custom');
/**
 * index method
 *
 * @return void
 */
 
 function beforeFilter(){
		$this->response->disableCache();
		$ses_val = $this->Session->read('User'); 
		
		if($ses_val == null || $ses_val == ""){
			if($this->request->params['action'] != "login"){
				$this->redirect(array('controller'=>'Logins','action'=>'login'));
			}
					
			//$this->requestAction('Logins/login');
		}else{
		//echo "bbb";
			//echo 444;exit;
		}
	}
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
	
	public function login() { 
		if($this->Session->check('User')){
			return $this->redirect(Router::url('/Logins/user_dashboard', true));
		}
		$this->loadModel('MasterUser');
		$this->set('title_for_layout','Login');
		$this->loadModel('MasterMessage');
		$attemptMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 4)));
		$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 5)));
		$inactiveMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 6)));
		if(isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser'])){ 
			$chk_email = array();
			$email = trim($this->request->data['MasterUser']['Email']);
			$pass = trim($this->request->data['MasterUser']['Password']);
			$user_count = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.email'=>$email,'MasterUser.pass'=>md5($pass))));
			
			// if mail id & password was incorrect
			if(count($user_count) == 0){ 
				$email_info = $this->MasterUser->findByemail($email);
				if(count($email_info)){  // if mail id present
				$chk_pass = $this->MasterUser->find('first', array('conditions'=>array('MasterUser.user_id'=>$email_info['MasterUser']['user_id'],'MasterUser.pass'=>md5($pass))));
					if(count($chk_pass) == 0){
						$attempt = $email_info['MasterUser']['wrong_login_attempt'] + 1;
						if($attempt >= 3){
							$this->MasterUser->query("UPDATE master_users set is_active = 0,wrong_login_attempt=".$attempt." WHERE master_users.user_id = ".$email_info['MasterUser']['user_id']);
							//--------------------Mailing functionality----------------------------------
							$this->loadModel('AdminUser');
							$adminres=$this->AdminUser->find('first',array('conditions' => array('uid' =>2)));
							$adminname=stripslashes($adminres['AdminUser']['full_name']);
												$adminemail=$adminres['AdminUser']['mail_id'];
												$MailMessage="<table width='100%'  style='line-height:20px; font-size:12px'>
												<tr>
												<td colspan='3'>Dear ".$adminname.",</td>
												
												</tr>
												<tr>
												<td colspan='3'>A user three times wrong attempt on login page. Now his/ her account has blocked</td>
												
												</tr>
												<tr>
												<td width='25%'><strong>Login ID</strong></td>
												<td  width='2%'><strong>:</strong></td>
												<td width='73%'>".stripslashes($this->request->data['MasterUser']['Email'])."</td>
												</tr>
												<tr>
												<td colspan='3'>&nbsp;</td>
												
												</tr>
												<tr>
												<td colspan='3'>Thank You</td>
												
												</tr>
												<tr>
												<td colspan='3'>Dezmembraripenet</td>
												
												</tr>
												</table>";
												$userMsg="<table width='100%'  style='line-height:20px; font-size:12px'>
												<tr>
												<td colspan='3'>Dear ".$email_info['MasterUser']['first_name'].' '.$email_info['MasterUser']['last_name'].",</td>
												
												</tr>
												<tr>
												<td colspan='3'>Your account is temporarily blocked due to three times wrong attempt</td>
												
												</tr>
												<tr>
												<td colspan='3'>&nbsp;</td>
												
												</tr>
												<tr>
												<td colspan='3'>Thank You</td>
												
												</tr>
												<tr>
												<td colspan='3'>Dezmembraripenet</td>
												
												</tr>
												</table>";
												//echo $MailMessage;
												//echo $userMsg;exit;
												if($clientip=$this->RequestHandler->getClientIp()!='127.0.0.1')
												{
													$Email = new CakeEmail('default');
													$Email->to($adminemail);
													$Email->subject('Login Attempt');
													$Email->replyTo($this->request->data['MasterUser']['Email']);
													$Email->from (array($adminemail => 'Dezmembraripenet'));
													$Email->emailFormat('both');
													//$Email->headers();
													$Email->send($MailMessage);
													
													//User msg
													$UserEmail = new CakeEmail('default');
													$UserEmail->to($email_info['MasterUser']['email']);
													$UserEmail->subject('Login Attempt');
													$UserEmail->replyTo($this->request->data['MasterUser']['Email']);
													$UserEmail->from (array($adminemail => 'Dezmembraripenet'));
													$UserEmail->emailFormat('both');
													//$Email->headers();
													$UserEmail->send($userMsg);
												}
							//------------------------------------------------------------------------------
							$this->Session->setFlash(__('<div class="alert alert-danger">'.$attemptMsg['MasterMessage']['msg'].'</div>'));
						}else{
							$this->MasterUser->query("UPDATE master_users set wrong_login_attempt =" . $attempt. " WHERE master_users.user_id = ".$email_info['MasterUser']['user_id']);
							
							$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
						}
					}
				}else{ // if mail id not present
					$this->Session->setFlash(__('<div class="alert alert-danger">'.$failMsg['MasterMessage']['msg'].'</div>'));
				}
				
			}else{ 
					$email_data = $this->MasterUser->findByemail($email);
					// if user is inactive
					if($email_data['MasterUser']['is_active'] == 0){ 
						$this->Session->setFlash(__('<div class="alert alert-danger">'.$inactiveMsg['MasterMessage']['msg'].'</div>'));
					}else{ 
						$User = array();
						$date=Date('Y-m-d');
						$this->MasterUser->id=$user_count['MasterUser']['user_id'];
						$this->MasterUser->saveField('last_login',$date);
						$User = $user_count['MasterUser']; 
						$User['last_login)']=$date;
						
						$this->LoadModel('AuditLogin');
						$login_details['AuditLogin']['user_id']=$user_count['MasterUser']['user_id'];
						$login_details['AuditLogin']['login_time']=date('Y-m-d h:i:s');
						$login_details['AuditLogin']['ip_address']=$_SERVER['REMOTE_ADDR'];
						$log_id=$this->AuditLogin->save($login_details);
						$User['login_id']=$log_id['AuditLogin']['audit_id'];
						$this->Session->write('User',$User); 
						$this->MasterUser->save(array('user_id' => $user_count['MasterUser']['user_id'], 'wrong_login_attempt' => 0));
						if($this->Session->check('redirectLink'))
						{
							$cutoemPath=$this->Session->read('redirectLink');
							$this->Session->delete('redirectLink');
							$this->redirect($cutoemPath);
						}
						else
						{
							$this->redirect(array('action' => 'user_dashboard'));
						}
						
						//$this->redirect(array('controllers'=>'MasterUsers','action'=>'user_dashboard'));
						//$this->redirect($this->webroot.'MasterUsers/user_dashboard');
					}
			}
		}
		
		$this->layout="login";
	}

	function user_dashboard(){
		//pr($this->Session->read());exit;
		$this->set('title_for_layout','User Dashboard');
		//$this->layout = "default";
		$sessUser=$this->Session->read('User');
		$this->set('user_data',$this->Session->read('User'));
		$this->layout = "user-dashboard";
		$this->loadModel('UserTotalCredit');
		$creditRes=$this->UserTotalCredit->find('first', array('conditions' => array('user_id' => $sessUser['user_id'])));
		$this->set('userCredits', $creditRes);
	}
	/**
 * order status method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function status() {
		$this->loadModel('SalesOrder');
		if($this->request->is('post'))
		{
			$orderid=$this->request->data['orderid'];
			$statusval=$this->request->data['statusval'];
			$options=array('id' => $orderid, 'status' => $statusval);
			if($this->SalesOrder->save($options))
			{
				echo 1;
			}
			else
			{
				echo 2;
			}
		}
		exit;
	}
	
}
