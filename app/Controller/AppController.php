<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('Paginator', 'Session', 'Cookie', 'RequestHandler');
	public function beforeRender(){
		$this->response->disableCache();
		//$this->set('fb_login_url', $this->Facebook->getLoginUrl(array('redirect_uri' => Router::url(array('controller' => 'users', 'action' => 'login'), true))));
		//$this->set('user', $this->Auth->user());
		//$user_fb = $this->Facebook->getUser();
		//$this->set('base_url', $this->webroot);
		$this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));
		//date_default_timezone_set("America/New_York");
		$this->loadModel('Theme');
		$themeRes=$this->Theme->find('all', array('conditions' => array('status' => 1), 'order' => array('theme_id' => 'desc')));
		$this->set('themeRes',$themeRes);
		//-----------------------------------------------------
		$this->loadModel('MasterMessage');
		$emailExist=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>61)));
		$successMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>62)));
		$failMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 63)));
		$verisuccessMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' =>64)));
		$verifailMsg=$this->MasterMessage->find('first', array('conditions' => array('msg_id' => 64)));
		$this->set('emailExist',$emailExist['MasterMessage']['msg']);
		$this->set('successMsg',$successMsg['MasterMessage']['msg']);
		$this->set('failMsg',$failMsg['MasterMessage']['msg']);
		$this->set('verisuccessMsg',$verisuccessMsg['MasterMessage']['msg']);
		$this->set('verifailMsg',$verifailMsg['MasterMessage']['msg']);
		//-------------------------------------------------------
		$this->loadModel('Sitesetting');
		 $settingres=$this->Sitesetting->find('first', array('conditions' => array('id' => 1)));
		 $this->set('settingres', $settingres);
	}
	
	public function noticeStatus()
	{
		if($this->Session->check('User'))
		{
			$user=$this->Session->read('User');
			if($this->request->is('post'))
			{
				if(isset($this->request->data['noticetype']))
				{
					
					if($this->request->data['noticetype']=='sales-question'){
						$this->loadModel('Notice');
						$fetchdata=$this->Notice->find('first', array('conditions' => array('notice_type' => $this->request->data['noticetype'], 'user_id' =>$user['user_id'], 'user_status' => 0)));
						if(count($fetchdata)>0){
							$this->loadModel('Notice');
					$update=$this->Notice->query("update notice set user_status='1' where notice_type='".$this->request->data['noticetype']."' and user_id='".$user['user_id']."'");
						$this->loadModel('PostAd');
						$adRes=$this->PostAd->find('first', array('conditions' => array('adv_id' =>$fetchdata['Notice']['postid'])));
						echo $adRes['PostAd']['slug'];
					
						}
						else
						{
							echo "no";
						}
					}else if($this->request->data['noticetype']=='bid-question'){
						$this->loadModel('Notice');
						$fetchdata=$this->Notice->find('first', array('conditions' => array('notice_type' => $this->request->data['noticetype'], 'user_id' =>$user['user_id'], 'user_status' => 0)));
						if(count($fetchdata)>0){
							$this->loadModel('Notice');
					$update=$this->Notice->query("update notice set user_status='1' where notice_type='".$this->request->data['noticetype']."' and user_id='".$user['user_id']."'");
						$this->loadModel('RequestAccessory');
						$adRes=$this->RequestAccessory->find('first', array('conditions' => array('part_id' =>$fetchdata['Notice']['postid'])));
						echo $adRes['RequestAccessory']['slug'];
					
						}
						else
						{
							echo "no";
						}
					}
					else
					{
					$this->loadModel('Notice');
					$update=$this->Notice->query("update notice set user_status='1' where notice_type='".$this->request->data['noticetype']."' and user_id='".$user['user_id']."'");
					echo 1;
					}
					
						
				}
				else
				{
					echo 2;
				}
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
		exit;
	}
 	
public function sitemapAction(){
		/*
		Author: Pragyaa Golchha
		Author By: Maastrix Solutions
		Purpose: Sitemap Generation
		*/
		// URLs to add to put in the sitemap 
		
		//echo PUREROOT;exit;
		$urls = array();
		
		$menu_arry = array();
		
		$freq = "daily";
		
		$priority1 = "1.00";
		
		$priority2 = "0.80";
		
		$priority3 = "0.64";
		
		$priority4 = "0.51";
		
		$char_arry = range('a','z');
		
		
		$file = "sitemap.xml";
		
		
		$sitemapFileOpen = fopen ($file, "w");
		
		if (!$sitemapFileOpen)
		{
		
			$msg = "cannot create sitemap.xml\n";
		
		}
		
		
		
		fwrite ($sitemapFileOpen,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
		
		<urlset
		
			  xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
			  xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
			  xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
					http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">
		<!-- created with Free Online Sitemap Generator www.xml-sitemaps.com -->
		");
		
		//================================
		//Home Menu
		//================================
		fwrite ($sitemapFileOpen, "<url>
									<loc>".BASE_URL1. "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority1."</priority>
								</url>");
		//================================
		//Home Menu End
		//================================
		
		//===============================
		//Static link
		//===============================
		fwrite ($sitemapFileOpen, "<url>
									<loc>".BASE_URL1."pages/request-parts"."</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."pages/truck-parks"."</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."piese-auto"."</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>

								<url>
									<loc>".BASE_URL1."pages/company-parts". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>
								
								<url>
									<loc>".BASE_URL1."pages/my-purchases". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."RequestParts/". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."pages/statistics-views/favourite". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."MasterUsers/account_setting". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."Logins/user_dashboard". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."RequestParts/add". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority3."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."PostAds/add/". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority3."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."Logins/login". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority3."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."MasterUsers/add". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority3."</priority>
								</url>
								<url>
									<loc>".BASE_URL1."MasterUsers/forgot_password". "</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority3."</priority>
								</url>
								");
		//===============================
		//Static link End Here
		//===============================
		//=====================================
		//Dynamic Page
		//=======================================
		
		/*$pageList=CmsPages::find(array(
		"conditions" => "is_active='1' and page_id NOT IN(4, 11,12,13,14,15,16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31)"
		));*/
		$this->LoadModel("AdminPage");
		$adminPage=$this->AdminPage->find('all', array('conditions' => array('is_active' => 1)));
		
		if(count($adminPage)>0){
			foreach($adminPage as $adminPageRes){
				fwrite ($sitemapFileOpen, "<url>
									<loc>".BASE_URL1."piese-auto/".$adminPageRes['AdminPage']['page_slug']."</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>");
			}
		}
		
		//==========End Here====================
		//=====================================
		//Dynamic Categories
		//=======================================
				
				//fwrite ($sitemapFileOpen, UIElements::BapCustUniSitemapcatList(0,0));
		$this->LoadModel("ManageCategory");
		$manageCategory=$this->ManageCategory->find('all', array('conditions' => array('status' => 1)));
		
		if(count($manageCategory)>0){
			foreach($manageCategory as $manageCategoryRes){
				if($manageCategoryRes['ManageCategory']['slug'] !=''){
				fwrite ($sitemapFileOpen, "<url>
									<loc>".BASE_URL1."piese-auto/".$manageCategoryRes['ManageCategory']['slug']."</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>");
			   }else{
				fwrite ($sitemapFileOpen, "<url>
									<loc>".BASE_URL1."piese-auto/".$manageCategoryRes['ManageCategory']['category_id']."</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>");
					
				   }
			}
		}
		//==========End Here====================
		
		//=====================================
		//Dynamic Brands
		//=======================================
		
				//fwrite ($sitemapFileOpen, UIElements::BapCustUniSitemapBrandList(0,0));
		$this->LoadModel("ManageBrand");
		$manageBrand=$this->ManageBrand->find('all', array('conditions' => array('status' => 1)));
		if(count($manageBrand)>0){
			foreach($manageBrand as $manageBrandRes){
			$slugname = stripslashes($manageBrandRes['ManageBrand']['slug']);
			$brand_id = stripslashes($manageBrandRes['ManageBrand']['brand_id']);
				if($slugname!=''){
				fwrite ($sitemapFileOpen, "<url>
									<loc>".BASE_URL1."piese-auto/".$slugname."</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>");
			   }else{
				fwrite ($sitemapFileOpen, "<url>
									<loc>".BASE_URL1."piese-auto/".$brand_id."</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>");
			  }
			}
		}
		//==========End Here====================
		//=====================================
		//Dynamic Products
		//=======================================
		//$productList=UIElements::BapCustUniProductList(30000);
		$this->LoadModel("ManageSale");
		$manageSale=$this->ManageSale->find('all', array('conditions' => array('adv_status' => 1)));
		
		if(count($manageSale)){
			foreach($manageSale as $manageSaleRes){
			    $slugname = stripslashes($manageSaleRes['ManageSale']['slug']);
			    $adv_id = stripslashes($manageSaleRes['ManageSale']['adv_id']);
				if($slugname!=''){
				fwrite ($sitemapFileOpen, "<url>
									<loc>".BASE_URL1."pages/sales-details/".$slugname."</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>");
			   }else{
				fwrite ($sitemapFileOpen, "<url>
									<loc>".BASE_URL1."pages/sales-details/".$adv_id."</loc>
									" . " <changefreq>".$freq."</changefreq>
									" . " <priority>".$priority2."</priority>
								</url>");
			  }

			}
		}
			//==========End Here====================
	
			//=====================================
			//Dynamic News
			//=======================================
			$this->LoadModel("News");
			$news=$this->News->find('all', array('conditions' => array('status' => 1)));
			
			if(count($news)){
				foreach($news as $newsRes){
					$news_id = stripslashes($newsRes['News']['news_id']);
					fwrite ($sitemapFileOpen, "<url>
										<loc>".BASE_URL1."pages/news-details/".$news_id."</loc>
										" . " <changefreq>".$freq."</changefreq>
										" . " <priority>".$priority2."</priority>
									</url>");
	
				}
			}
	
			//==========End Here====================
			
			//=====================================
			//Dynamic Sucess stories
			//=======================================
			$this->LoadModel("SuccessStory");
			$successStory=$this->SuccessStory->find('all', array('conditions' => array('status' => 1)));
			
			if(count($successStory)){
				foreach($successStory as $successStoryRes){
					$success_id = stripslashes($successStoryRes['SuccessStory']['success_id']);
					fwrite ($sitemapFileOpen, "<url>
										<loc>".BASE_URL1."pages/success-stories-details/".$success_id."</loc>
										" . " <changefreq>".$freq."</changefreq>
										" . " <priority>".$priority2."</priority>
									</url>");
	
				}
			}
	
			//==========End Here====================
			//=====================================
			//Dynamic Request Parts
			//=======================================
			$this->LoadModel("RequestAccessory");
			$requestAccessory=$this->RequestAccessory->find('all', array('conditions' => array('status' => 1)));
			
			if(count($requestAccessory)){
				foreach($requestAccessory as $requestAccessoryRes){
					$slugname = stripslashes($requestAccessoryRes['RequestAccessory']['slug']);
					if($slugname!=''){
					fwrite ($sitemapFileOpen, "<url>
										<loc>".BASE_URL1."pages/request-parts/".$slugname."</loc>
										" . " <changefreq>".$freq."</changefreq>
										" . " <priority>".$priority2."</priority>
									</url>");
				   }
				}
			}
			//==========End Here====================
	
			//=====================================
			//Dynamic Truck Parks & Company Parts
			//=======================================
			$this->LoadModel("SalesPark");
			$salesPark=$this->SalesPark->find('all', array('conditions' => array('status' => 1)));
			if(count($salesPark)){
				foreach($salesPark as $salesParkRes){
					$slugname = stripslashes($salesParkRes['SalesPark']['slug']);
					$add_type = stripslashes($salesParkRes['SalesPark']['add_type']);
					fwrite ($sitemapFileOpen, "<url>
										<loc>".BASE_URL1."pages/parks/".$slugname."</loc>
										" . " <changefreq>".$freq."</changefreq>
										" . " <priority>".$priority2."</priority>
									</url>");
				}
			}
			//==========End Here====================

		
		
		
		
		
		fwrite ($sitemapFileOpen, "</urlset>");
		
		fclose ($sitemapFileOpen);
		echo "Finished !";
		exit;
	}}
