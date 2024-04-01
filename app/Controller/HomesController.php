<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Homes Controller
 */
class HomesController extends AppController {

	public $components = array('Paginator', 'Session', 'Cookie', 'RequestHandler');

	public function index()
	{
		/*if($this->Cookie->check('recentSale'))
		{
			$this->set('recentSale', $this->Cookie->read('recentSale'));
		}
		else
		{
			$this->set('recentSale', array());
		}*/

		$this->loadModel('RecentView');
		$ip=$this->RequestHandler->getClientIp();
		$currentdate=date("Y-m-d");
		$fetchRecent=$this->RecentView->find('list', array( 'conditions' => array('ip_id' => $ip, 'DATE(exp_date) >=' => $currentdate), 'order' => array('created' => 'desc'), 'fields' => array('recent_id','adv_id')));
		$this->set('recentViews', $fetchRecent);
		$this->set('title_for_layout', 'Dezmembraripenet | Piese Auto');
		$this->layout='home';
		if($this->Session->check('User'))
		{
			//return $this->redirect(Router::url('/Logins/user_dashboard', true));
		}
		//Banner Dynamic Function
		$this->loadModel('ManageBrand');
		$brands_image=$this->ManageBrand->find('all', array('fields' => array('brand_id', 'image','slug'),'conditions' => array('status' => 1, 'image !='=>''), 'order' => array('ordering' => 'asc'), 'limit' => 10));
		$this->set('brands_image',$brands_image);

		$this->loadModel('Banner');
		$bannerRes=$this->Banner->find('all', array('conditions' => array('status' => 1), 'order' => array('banner_id' => 'desc')));
		$this->set('bannerRes',$bannerRes);

		$this->loadModel('SalesCategory');
		$cat_arr=$this->SalesCategory->find('all',array('conditions'=>array('flag'=>0,'status'=>1)));
		$this->set('category', $cat_arr);
		$this->loadModel('Advertisement');
		$left1=$this->Advertisement->find('first', array('conditions' => array('status' => 1, 'show_position' =>2), 'order' => 'Rand()'));
		$this->set('left1',$left1);
		$this->loadModel('Advertisement');
		$left2=$this->Advertisement->find('first', array('conditions' => array('status' => 1, 'show_position' =>3), 'order' => 'Rand()'));
		$this->set('left2',$left2);
		$middlead=$this->Advertisement->find('first', array('conditions' => array('status' => 1, 'show_position' =>4), 'order' => 'Rand()'));
		$this->set('middlead',$middlead);
		$this->set('postkeywords', '');
		//Recent publicity
		$this->loadModel('PostAd');
		$recentRes=$this->PostAd->find('all', array('conditions' => array('adv_status' => 1), 'order' => array('adv_id' => 'desc'), 'limit' => 5));
		$this->set('recentRes',$recentRes);
		//Recent publicity
		$this->loadModel('RequestPart');
		$offersoptions=array(
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
					array('RequestAccessory.status' => 1, 'RequestPart.status' => 1),
				 )),
				 'fields' =>
				 array('RequestPart.*','RequestAccessory.*'),
				 'order' =>
				  array('RequestAccessory.part_id' => 'desc'),
				  'limit' =>5
			);
				$recentPartsRes=$this->RequestPart->find('all',$offersoptions);

		$this->set('recentPartsRes',$recentPartsRes);
		//most favourite publicity
		$this->loadModel('PostAd');
		$mostFavRes=$this->PostAd->query("SELECT COUNT(*) as totfav,`PostAd`.* FROM `sales_add_to_favourites` AS `SalesAddToFavourite` left JOIN `sales_advertisements` AS `PostAd` ON (`SalesAddToFavourite`.`adv_id` = `PostAd`.`adv_id`) group by SalesAddToFavourite.adv_id order by totfav desc limit 0, 5");
		$this->set('mostFavRes',$mostFavRes);
		//most view publicity
		$this->loadModel('PostAd');
		$mostViewRes=$this->PostAd->query("SELECT COUNT(*) as totview,`PostAd`.* FROM `sales_view` AS `SalesView` left JOIN `sales_advertisements` AS `PostAd` ON (`SalesView`.`adv_id` = `PostAd`.`adv_id`) group by SalesView.adv_id order by totview desc limit 0, 5");
		$this->set('mostViewRes',$mostViewRes);
		//----------------------------------------------------------|
		// All Product, user and offer parts statistics count start |
		//----------------------------------------------------------|
		//total Products Count
		$this->loadModel('PostAd');
		$productcount=$this->PostAd->find('count', array('conditions' => array('adv_status' => 1)));
		$this->set('productcount', $productcount);

		//total seller Count
		$this->loadModel('MasterUser');
		$sellercount=$this->MasterUser->find('count', array('conditions' => array('is_active' => 1, 'wrong_login_attempt <=' => 3, 'user_type_id' => 2)));
		$this->set('sellercount', $sellercount);

		//total buyer Count
		$buyercount=$this->MasterUser->find('count', array('conditions' => array('is_active' => 1, 'wrong_login_attempt <=' => 3, 'user_type_id' => 1)));
		$this->set('buyercount', $buyercount);

		//total offers Count
		$this->loadModel('RequestPart');
		$offersoptionscount=array(
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
					array('RequestAccessory.status' => 1, 'RequestPart.status' => 1),
				 )),
				 'fields' =>
				 array('RequestPart.*','RequestAccessory.*'),
				 'order' =>
				  array('RequestAccessory.part_id' => 'desc')
			);
		$offercount=$this->RequestPart->find('count',$offersoptionscount);
		$this->set('offercount', $offercount);
		//----------------------------------------------------------|
		// All Product, user and offer parts statistics count End   |
		//----------------------------------------------------------|
		//----------------------------------------------------------|
		// Premium Suplier function Start                           |
		//----------------------------------------------------------|
		//$this->loadModel('MasterUser');
		$this->loadModel('PromotionAd');
		$premierOption=array(
		'joins' =>
				  array(
					array(
						'table' => 'master_users',
						'alias' => 'MasterUser',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array('MasterUser.user_id = PromotionAd.user_id')
					)
				 ),
				  'conditions' =>
				  array('AND' => array(
					array('MasterUser.is_active' => 1, 'MasterUser.wrong_login_attempt <=' => 3),
				 )),
				 'fields' =>
				 array('MasterUser.*'),
				 'order' =>
				  array('PromotionAd.promotion_id' => 'desc'),
				  'group' => array('PromotionAd.user_id'),
			);
		//$premiumRes=$this->MasterUser->find('all', array('conditions' => array('is_active' => 1, 'wrong_login_attempt <=' => 3, 'user_type_id' => 2, 'is_premium'=>1), 'order' => array('user_id' => 'desc'), 'limit' => 10));
		$premiumRes=$this->PromotionAd->find('all', $premierOption);
		$this->set('premiumRes', $premiumRes);
		//----------------------------------------------------------|
		// Premium Suplier function End                           |
		//----------------------------------------------------------|
		//----------------------------------------------------------|
		// Trade news & event function Start                        |
		//----------------------------------------------------------|
		$this->loadModel('News');
		$newsRes=$this->News->find('all', array('conditions' => array('status' => 1), 'order' => array('news_id' => 'desc'), 'limit' => 2));
		$this->set('newsRes', $newsRes);
		//----------------------------------------------------------|
		// Trade news & event function end                          |
		//----------------------------------------------------------|
		//----------------------------------------------------------|
		// Success Stories function Start                        |
		//----------------------------------------------------------|
		$this->loadModel('SuccessStory');
		$storyRes=$this->SuccessStory->find('first', array('conditions' => array('status' => 1), 'order' => array('success_id' => 'desc'), 'limit' => 1));
		$this->set('storyRes', $storyRes);
		//----------------------------------------------------------|
		// Trade news & event function end                          |
		//----------------------------------------------------------|
		//----------------------------------------------------------|
		// Promote Ads List                       |
		//----------------------------------------------------------|
		$currentDate=date("Y-m-d");
		$this->loadModel('PostAd');
		$promoteoption=array(
		'joins' =>
		  array(
			array(
				'table' => 'promotion_ad',
				'alias' => 'PromotionAd',
				'type' => 'left',
				'foreignKey' => false,
				'conditions'=> array('PromotionAd.adv_id = PostAd.adv_id')
			)
		 ),
		'conditions' =>
		 array('PostAd.adv_status' =>1, 'PostAd.is_promote' =>1, 'FIND_IN_SET(1,PromotionAd.promotion_type)', 'PromotionAd.is_home_expire >=' => $currentDate),
		 'fields' =>
		 array('PostAd.*', 'PromotionAd.*'),
		 'order' =>array('PromotionAd.created' => 'desc'),
		 'group' => 'PromotionAd.adv_id',
		  );
		  $promoteAd=$this->PostAd->find('all',$promoteoption);
		  $this->set('promoteAd', $promoteAd);
		//----------------------------------------------------------|
		// Promote ads list function end                          |
		//----------------------------------------------------------|
		//----------------------------------------------------------|
		// Promote Ads 3 fetch                       |
		//----------------------------------------------------------|

		$this->loadModel('PostAd');
		$promotesecoption=array(
		'joins' =>
		  array(
			array(
				'table' => 'promotion_ad',
				'alias' => 'PromotionAd',
				'type' => 'left',
				'foreignKey' => false,
				'conditions'=> array('PromotionAd.adv_id = PostAd.adv_id')
			)
		 ),
		'conditions' =>
		 array('PostAd.adv_status' =>1, 'PostAd.is_promote' =>1, 'FIND_IN_SET(1,PromotionAd.promotion_type)', 'PromotionAd.is_home_expire >=' => $currentDate),
		 'fields' =>
		 array('PostAd.*', 'PromotionAd.*'),
		 'order' =>array('PromotionAd.created' => 'desc'),
		 'group' => 'PromotionAd.adv_id',
		 'limit' => 4
		  );
		  $promoteSecAd=$this->PostAd->find('all',$promotesecoption);
		  $this->set('promoteSecAd', $promoteSecAd);
		//----------------------------------------------------------|
		// Promote ads 3 fetch function end                          |
		//----------------------------------------------------------|
	}
	public function topad()
	{
		$this->loadModel('Advertisement');
		$top=$this->Advertisement->find('first', array('conditions' => array('status' => 1, 'show_position' =>1), 'order' => 'Rand()'));
		return($top);
	}
	public function newsletter()
	{
		if($this->request->is('post'))
		{
			//pr($this->request->data);exit;
			//pr($this->request->data);exit;
			$this->loadModel('NewsLetter');
			$rec_exists=$this->NewsLetter->find('all',array('conditions'=>array('NewsLetter.news_email'=>$this->request->data['NewsLetter']['news_email'])));
			if(count($rec_exists)<=0)
			{
				if($this->NewsLetter->save($this->request->data))
				{
					$insertid=$this->NewsLetter->getLastInsertId();
					$link=Router::url('/Homes/confirm_email/id:'.$insertid, true);
					//Mail functionality start here
					$message = '<table width="400" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" colspan="2">Dear '.stripslashes($this->request->data['NewsLetter']['news_name']).',</td>
						</tr>
						<tr>
						<td>You have successfully subscribed news leter in Dezmembraripenet, so to receive any more newsletters confirm your E-Mail ID click on <a href="'.$link.'">here</a> or paste the below url in your browser<br>'.$link.'.</td>
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
					</table>';
					$adminMsg = '<table width="400" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" colspan="2">Dear Admin,</td>
						</tr>
						<tr>
						<td colspan="2">A new user subscribed news letter on your site. below is the user subscribe detail</td>
						</tr>
						<tr>
							<td align="left" colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td>Name: </td>
							<td>'.stripslashes($this->request->data['NewsLetter']['news_name']).'</td>
						</tr>
						<tr>
							<td>E-Mail ID: </td>
							<td>'.stripslashes($this->request->data['NewsLetter']['news_email']).'</td>
						</tr>
						<tr>
							<td align="left" valign="middle">Thank You</td>
						</tr>
						<tr>
							<td align="left" valign="middle">Dezmembraripenet</td>
						</tr>
					</table>';
					if($this->RequestHandler->getClientIp()!='127.0.0.1' && $this->RequestHandler->getClientIp()!='192.168.1.239')
						{
							$this->loadModel('AdminUser');
							$siteemail=$this->AdminUser->find('first', array('AdminUser.uid' => 2));
							if(!empty($siteemail)){$siteemailID=$siteemail['AdminUser']['mail_id'];}else{$siteemailID='info@dezmembraripenet.com';}
						$to_email=$this->request->data['NewsLetter']['news_email'];
						$Email = new CakeEmail('default');
						$Email->to($to_email);
						$Email->subject('Dezmembraripenet :: News Letter Confirmation');
						$Email->replyTo($siteemailID);
						$Email->from (array($siteemailID => 'Dezmembraripenet'));
						$Email->emailFormat('both');
						//$Email->headers();
						$Email->send($message);

						//Admin Mail-----------------
						$adminEmail = new CakeEmail('default');
						$adminEmail->to($siteemailID);
						$adminEmail->subject('Dezmembraripenet :: Account creation');
						$adminEmail->replyTo($siteemailID);
						$adminEmail->from (array($to_email => 'Dezmembraripenet'));
						$adminEmail->emailFormat('both');
						//$Email->headers();
						$adminEmail->send($adminMsg);
						//----------------------------
						}
					echo 1;
				}
				else
				{
					echo 2;
				}
			}
			else
			{
				echo 3;
			}
		}
		exit;
	}
	/**
 * Facebook Login method
 *
 * @return void
 */
 public function facebooklogin()
 {
	 if($this->request->is('post'))
	 {
		 $fbid=$this->request->data['fb_id'];
		 $email=$this->request->data['email'];
		 $first_name=$this->request->data['first_name'];
		 $last_name=$this->request->data['last_name'];
		 $this->loadModel('MasterUser');
		 $checkemail=$this->MasterUser->find('first', array('conditions' => array('email' => $email, 'fb_id !=' => $fbid)));
		 if(!empty($checkemail))
		 {
			 echo 3;
		 }
		 else
		 {
			 $checkUser=$this->MasterUser->find('first', array('conditions' => array('fb_id' => $fbid)));
			 if(!empty($checkUser))
			 {
				 $userid=$checkUser['MasterUser']['user_id'];
				 $insertid=$userid;
				 $options=array('user_id' => $userid,'fb_id' => $fbid, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'is_facebook' => 1);
				 if($this->MasterUser->save($options))
				 {
					 $this->Session->write('facebookLogin','yes');
					 $this->Session->write('User',$checkUser['MasterUser']);
					 echo 1;
				 }
				 else
				 {
					 echo 2;
				 }
			 }
			 else
			 {
				 $options=array('fb_id' => $fbid, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'is_facebook' => 1);
				 if($this->MasterUser->save($options))
				 {
					 $insertid=$this->MasterUser->getLastInsertId();
					 $userDetails=$this->MasterUser->find('first', array('conditions' => array('user_id' => $insertid)));
					 $this->Session->write('facebookLogin','yes');
					 $this->Session->write('User',$userDetails['MasterUser']);
					 echo 1;
				 }
				 else
				 {
					 echo 2;
				 }
			 }
			 $this->loadModel('Notice');
			$this->Notice->save(array('notice_type' => 'register', 'postid' => $insertid, 'notice_name' => 'Register'));
		 }
	 }
	 exit;
 }
 /**
 * Log Out Functionality
 *
 **/
 	public function fbLogOut()
	{
		if($this->Session->check('User'))
		{
			$this->Session->delete('User');
			$this->Session->delete('facebookLogin');
			echo 1;
		}
	}
	public function confirm_email()
	{
		if(isset($this->request->params['named']['id']))
		{
			$id=$this->request->params['named']['id'];
			$this->LoadModel("NewsLetter");
			$this->NewsLetter->id=$id;
			if($this->NewsLetter->saveField("status",1)){
				$this->redirect(Router::url('/Homes/index/confirm:1', true));
			}else{
				$this->redirect(Router::url('/Homes/index/confirm:1', true));
			}
		}
		exit;
	}
	/*
	* Author By: chittaranjan sahoo
	* Purpose: Make autocomplete function for top search box
	* Date: 02-03-2016
	*/
	public function autocomplete(){

		if($this->request->is('post'))
		{
			if(isset($this->request->data['responseFrom'])){
				$appendTag='1';
				$appendFunc='one';
			}else{
				$appendTag='';
				$appendFunc='';
			}
			$xyz = 0;
			echo "<div class='items'><ul>";
			$allpost=$this->request->data;
			$tagname=$allpost['tag'];//print_r($allpost);
			$this->loadModel('PostAd');
			if(isset($this->request->data['responseFrom'])){
				if($this->Session->check('User'))
				{
					$sessuser=$this->Session->read('User');
					$userid=$sessuser['user_id'];
				}else{
					if(isset($this->request->data['UserID'])){
						$userid=$this->request->data['UserID'];
					}else{
						$userid=1;
					}
				}
				//echo $userid;
			$res=$this->PostAd->find('all', array('conditions' => array('PostAd.adv_status' =>1, 'PostAd.user_id' =>$userid, 'PostAd.adv_name LIKE ' => '%'.$tagname.'%'), 'order' => array('PostAd.adv_name' => 'asc')));
		}else{
			$res=$this->PostAd->find('all', array('conditions' => array('PostAd.adv_status' =>1, 'PostAd.adv_name LIKE ' => '%'.$tagname.'%'), 'order' => array('PostAd.adv_name' => 'asc')));
		}
			if(!empty($res)){
				foreach($res as $result){
						$xyz++;
						$add_tag = str_replace(strtolower($allpost['tag']), '<b>'.$allpost['tag'].'</b>', strtolower(stripslashes($result['PostAd']['adv_name'])));
						if ($xyz == 1)
						{?>
							<li class="selected" onclick="return sendText<?=$appendFunc?>('<?=stripslashes($result['PostAd']['adv_name'])?>');"><?=ucfirst($add_tag)?></li><?php
		                }
		                else
		                {?>
							<li onclick="return sendText<?=$appendFunc?>('<?=stripslashes($result['PostAd']['adv_name'])?>');"><?=ucfirst($add_tag)?></li><?php
		                }
				}
			}else{
			?>
                <li>No result found :(</li><?php
			}
			?></ul><div>
			<script>
			<?php if(isset($this->request->data['responseFrom'])){
				?>
				function sendTextone(text)
				{
					if ($(".keywrd_pop_top1").is(":visible")) {
						if (text!='') {
							$("#searchtxt").val(text);
							$("#searchtxt").focus();
							$(".keywrd_pop_top1").hide();
						}
					}
					else
					{
						if (text!='') {
							$("#searchtxt").val(text);
							$("#searchtxt").focus();
							$(".keywrd_pop1").hide();
						}
					}
				}
				<?php
			}else{?>
				function sendText(text)
				{
					if ($(".keywrd_pop_top").is(":visible")) {
						if (text!='') {
							$("#postkeywords").val(text);
							$("#postkeywords").focus();
							$(".keywrd_pop_top").hide();
						}
					}
					else
					{
						if (text!='') {
							$("#postkeywords").val(text);
							$("#postkeywords").focus();
							$(".keywrd_pop").hide();
						}
					}
				}
				<?php }?>
        	</script>
			<?php
		}
		exit();
	}
	public function brandlist(){
		$this->set('title_for_layout', 'Brand List');
		$this->loadModel('ManageBrand');
		$brandParent=$this->ManageBrand->find('all', array('conditions' => array('status'=>1,'flag' => 0), 'order' => array('ordering' => 'asc')));
		$this->set('brandParent', $brandParent);
		$this->layout="brandlist";
	}
}
