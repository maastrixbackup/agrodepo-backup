<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */
/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));
/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));
define('HTTP_SERVER',$_SERVER['SERVER_NAME']."/");
define('SUB_FOLDER', 'dez_beta/');
define('HTTP_ROOT', HTTP_SERVER.SUB_FOLDER);
define('DIR_IMAGES', WWW_ROOT.'img/');
define('DIR_UPLOAD_PROFILE_THUMB', DIR_IMAGES.'profile/thumb/');
define('DIR_UPLOAD_PROFILE_ORIG', DIR_IMAGES.'profile/orig/');
define('BASE_URL1', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));
App::import('Model','AdminLang');
$AdminLang=new AdminLang();
function getLanguage($id,$is_tag=1)
{
	//App::import('Model','AdminLang');
	$AdminLang=new AdminLang();
	$res=$AdminLang->find('first', array('conditions' => array('lid' => $id)));	
	if($is_tag==1){
		return(stripslashes($res['AdminLang']['roman_label']));
	}else{
		return(strip_tags(stripslashes($res['AdminLang']['roman_label'])));
	}
	


}
//Auto parts
$autoparts=$AdminLang->find('first', array('conditions' => array('lid' => 1)));
define('AUTOPARTS',$autoparts['AdminLang']['roman_label']);
//Companies pieces 
$companiesPieces =$AdminLang->find('first', array('conditions' => array('lid' => 4)));
define('COMPANIESPIECES',$companiesPieces['AdminLang']['roman_label']);
//My Account
$myaccount=$AdminLang->find('first', array('conditions' => array('lid' => 5)));
define('MYACCOUNT',$myaccount['AdminLang']['roman_label']);
//SUBSCRIBE NOW 
$subscribenow=$AdminLang->find('first', array('conditions' => array('lid' => 35)));
define('SUBSCRIBENOW',$subscribenow['AdminLang']['roman_label']);
//Email 
$email=$AdminLang->find('first', array('conditions' => array('lid' => 34)));
define('EMAIL',$email['AdminLang']['roman_label']);
//User name 
$username=$AdminLang->find('first', array('conditions' => array('lid' => 33)));
define('USERNAME',$username['AdminLang']['roman_label']);
//News letter
$newslettercontent=$AdminLang->find('first', array('conditions' => array('lid' => 32)));
define('NEWSLETTER',$newslettercontent['AdminLang']['roman_label']);
//Social Icon 
$socialIcon=$AdminLang->find('first', array('conditions' => array('lid' => 31)));
define('SOCIALICON',$socialIcon['AdminLang']['roman_label']);
//Publish your story 
$pstory=$AdminLang->find('first', array('conditions' => array('lid' => 30)));
define('PUBLISHSTORY',$pstory['AdminLang']['roman_label']);
//Premium Suppliers Profile 
$primiumSuppliers=$AdminLang->find('first', array('conditions' => array('lid' => 29)));
define('PRIMIUMSUPPLIER',$primiumSuppliers['AdminLang']['roman_label']);
//Most popular models  
$mostPopularmodel=$AdminLang->find('first', array('conditions' => array('lid' => 28)));
define('MOSTPOPULARMODEL',$mostPopularmodel['AdminLang']['roman_label']);
//Most Favourite ads 
$mostFavouriteads=$AdminLang->find('first', array('conditions' => array('lid' => 27)));
define('MOSTFAVOURITEADS',$mostFavouriteads['AdminLang']['roman_label']);
//Promoted Ads 
$promoteads=$AdminLang->find('first', array('conditions' => array('lid' => 26)));
define('PROMOTEDADS',$promoteads['AdminLang']['roman_label']);
//Recent offer parts  
$recentOfferpart=$AdminLang->find('first', array('conditions' => array('lid' => 25)));
define('RECENTOFFERPART',$recentOfferpart['AdminLang']['roman_label']);
//Recent publicity   
$recentPublicity=$AdminLang->find('first', array('conditions' => array('lid' => 24)));
define('RECENTPUBLICITY',$recentPublicity['AdminLang']['roman_label']);
//Please Sign In  
$plsSignin=$AdminLang->find('first', array('conditions' => array('lid' => 23)));
define('PLEASESIGNIN',$plsSignin['AdminLang']['roman_label']);
//Sign up for free  
$signUp=$AdminLang->find('first', array('conditions' => array('lid' => 22)));
define('SIGNUP',$signUp['AdminLang']['roman_label']);
//For suppliers  
$suppliers=$AdminLang->find('first', array('conditions' => array('lid' => 21)));
define('SUPPLIERS',$suppliers['AdminLang']['roman_label']);
//Buyers  
$buyers=$AdminLang->find('first', array('conditions' => array('lid' => 20)));
define('BUYERS',$buyers['AdminLang']['roman_label']);
//Trade Statistics 
$tradeStatistics=$AdminLang->find('first', array('conditions' => array('lid' => 19)));
define('TRADESTATISTICS',$tradeStatistics['AdminLang']['roman_label']);
//All Categories 
$categories=$AdminLang->find('first', array('conditions' => array('lid' => 18)));
define('CATEGORIES',$categories['AdminLang']['roman_label']);
//Products Promoted 
$productPromote=$AdminLang->find('first', array('conditions' => array('lid' => 17)));
define('PRODUCTPROMOTE',$productPromote['AdminLang']['roman_label']);
//Select Category 
$selectCategories=$AdminLang->find('first', array('conditions' => array('lid' => 16)));
define('SELECTCATEGORIES',$selectCategories['AdminLang']['roman_label']);
//Search  
$search=$AdminLang->find('first', array('conditions' => array('lid' => 15)));
define('SEARCH',$search['AdminLang']['roman_label']);
//Add a Listing   
$listing=$AdminLang->find('first', array('conditions' => array('lid' => 14)));
define('LISTINGS',$listing['AdminLang']['roman_label']);
//Enquiry Parts    
$enquiryparts=$AdminLang->find('first', array('conditions' => array('lid' => 13)));
define('ENQUIRYPARTS',$enquiryparts['AdminLang']['roman_label']);
//Your account 
$yourAccount=$AdminLang->find('first', array('conditions' => array('lid' => 12)));
define('YOURACCOUNT',$yourAccount['AdminLang']['roman_label']);
//Success stories 
$successStories=$AdminLang->find('first', array('conditions' => array('lid' => 11)));
define('SUCCESSSTORIES',$successStories['AdminLang']['roman_label']);
//Trade 
$trade=$AdminLang->find('first', array('conditions' => array('lid' => 10)));
define('TRADE',$trade['AdminLang']['roman_label']);
//merchant account 
$merchantAccount=$AdminLang->find('first', array('conditions' => array('lid' => 9)));
define('MERCHANTACCOUNT',$merchantAccount['AdminLang']['roman_label']);
//Register 
$register=$AdminLang->find('first', array('conditions' => array('lid' => 8)));
define('REGISTER',$register['AdminLang']['roman_label']);
//Authentication 
$authentication=$AdminLang->find('first', array('conditions' => array('lid' => 7)));
define('AUTHENTICATION',$authentication['AdminLang']['roman_label']);
//Welcome Dezmembraripenet.ro 
$welcomeDezmem=$AdminLang->find('first', array('conditions' => array('lid' => 6)));
define('WELCOMEDEZMEM',$welcomeDezmem['AdminLang']['roman_label']);
//parks truck 
$parkStruck=$AdminLang->find('first', array('conditions' => array('lid' => 3)));
define('PARKSTRUCK',$parkStruck['AdminLang']['roman_label']);
//Requests Parts 
$requestParts=$AdminLang->find('first', array('conditions' => array('lid' => 2)));
define('REQUESTPARTS',$requestParts['AdminLang']['roman_label']);
//Processing  
$process=$AdminLang->find('first', array('conditions' => array('lid' => 37)));
define('PROCESSING',$process['AdminLang']['roman_label']);
//Trade News & Notice 
$tradeNewsnotice=$AdminLang->find('first', array('conditions' => array('lid' => 36)));
define('TRADENEWSNOTICE',$tradeNewsnotice['AdminLang']['roman_label']);
//Settings 
$settings=$AdminLang->find('first', array('conditions' => array('lid' => 46)));
define('SETTINGS',$settings['AdminLang']['roman_label']);
//Favorites 
$favorites=$AdminLang->find('first', array('conditions' => array('lid' => 45)));
define('FAVOTITES',$favorites['AdminLang']['roman_label']);
//My Requests 
$myRequest=$AdminLang->find('first', array('conditions' => array('lid' => 44)));
define('MYREQUEST',$myRequest['AdminLang']['roman_label']);
//My Purchases 
$myPurchases=$AdminLang->find('first', array('conditions' => array('lid' => 43)));
define('MYPURCHASES',$myPurchases['AdminLang']['roman_label']);
//Create Your Account 
$creatAccount=$AdminLang->find('first', array('conditions' => array('lid' => 42)));
define('CREATYOURACCOUNT',$creatAccount['AdminLang']['roman_label']);
//New User 
$newuser=$AdminLang->find('first', array('conditions' => array('lid' => 41)));
define('NEWUSER',$newuser['AdminLang']['roman_label']);
//Login 
$login=$AdminLang->find('first', array('conditions' => array('lid' => 40)));
define('LOGIN',$login['AdminLang']['roman_label']);
//Categories 
$categori=$AdminLang->find('first', array('conditions' => array('lid' => 39)));
define('CATEGORI',$categori['AdminLang']['roman_label']);
//Brand
$brand=$AdminLang->find('first', array('conditions' => array('lid' => 38)));
define('BRAND',$brand['AdminLang']['roman_label']);
//Details 
$detail=$AdminLang->find('first', array('conditions' => array('lid' => 54)));
define('DETAILS',$detail['AdminLang']['roman_label']);
//Seller 
$seller=$AdminLang->find('first', array('conditions' => array('lid' => 53)));
define('SELLER',$seller['AdminLang']['roman_label']);
//County 
$country=$AdminLang->find('first', array('conditions' => array('lid' => 52)));
define('COUNTRY',$country['AdminLang']['roman_label']);
//Price Range: 
$priceRange=$AdminLang->find('first', array('conditions' => array('lid' => 51)));
define('PRICERANGE',$priceRange['AdminLang']['roman_label']);
//Model 
$model=$AdminLang->find('first', array('conditions' => array('lid' => 50)));
define('MODEL',$model['AdminLang']['roman_label']);
//Trade Shows with Us 
$tradeShow=$AdminLang->find('first', array('conditions' => array('lid' => 49)));
define('TRADESHOWS',$tradeShow['AdminLang']['roman_label']);
//Sort By: 
$sortBy=$AdminLang->find('first', array('conditions' => array('lid' => 48)));
define('SORTBY',$sortBy['AdminLang']['roman_label']);
//Car Parts 
$carParts=$AdminLang->find('first', array('conditions' => array('lid' => 47)));
define('CARPARTS',$carParts['AdminLang']['roman_label']);
//Continue 
$continue=$AdminLang->find('first', array('conditions' => array('lid' => 55)));
define('CONTIN',$continue['AdminLang']['roman_label']);
//Date (ascending) 
$dateAsc=$AdminLang->find('first', array('conditions' => array('lid' => 56)));
define('DATEASCENDING',$dateAsc['AdminLang']['roman_label']);
//Date (descending)  
$dateDsc=$AdminLang->find('first', array('conditions' => array('lid' => 57)));
define('DATEDESCENDING',$dateDsc['AdminLang']['roman_label']);
//Price (low to high)  
$priceLowhigh=$AdminLang->find('first', array('conditions' => array('lid' => 58)));
define('PRICELOWHIGH',$priceLowhigh['AdminLang']['roman_label']);
//Price (high to low)   
$priceHighlow=$AdminLang->find('first', array('conditions' => array('lid' => 59)));
define('PRICEHIGHLOW',$priceHighlow['AdminLang']['roman_label']);
//View all requests   
$viewRequest=$AdminLang->find('first', array('conditions' => array('lid' => 74)));
define('VIEWREQUESTS',$viewRequest['AdminLang']['roman_label']);
//Offer    
$offer=$AdminLang->find('first', array('conditions' => array('lid' => 73)));
define('OFFER',$offer['AdminLang']['roman_label']);
//Active Request    
$activeRequest=$AdminLang->find('first', array('conditions' => array('lid' => 72)));
define('ACTIVEREQUEST',$activeRequest['AdminLang']['roman_label']);
//Status   
$status=$AdminLang->find('first', array('conditions' => array('lid' => 71)));
define('STATUS',$status['AdminLang']['roman_label']);
//Nr. Deals  
$nrDeals=$AdminLang->find('first', array('conditions' => array('lid' => 70)));
define('NRDEALS',$nrDeals['AdminLang']['roman_label']);
//Car 
$car=$AdminLang->find('first', array('conditions' => array('lid' => 69)));
define('CAR',$car['AdminLang']['roman_label']);
//Pose 
$pose=$AdminLang->find('first', array('conditions' => array('lid' => 68)));
define('POSE',$pose['AdminLang']['roman_label']);
//The play required 
$playRequired=$AdminLang->find('first', array('conditions' => array('lid' => 67)));
define('PLAYREQUIRED',$playRequired['AdminLang']['roman_label']);
//Latest calls for proposals added 
$lastcallProposal=$AdminLang->find('first', array('conditions' => array('lid' => 66)));
define('LASTCALLPROPOSAL',$lastcallProposal['AdminLang']['roman_label']);
//click me 
$clickme=$AdminLang->find('first', array('conditions' => array('lid' => 65)));
define('CLICKME',$clickme['AdminLang']['roman_label']);
//Home  
$home=$AdminLang->find('first', array('conditions' => array('lid' => 64)));
define('HOME',$home['AdminLang']['roman_label']);
//Request Parts 
$requestParts=$AdminLang->find('first', array('conditions' => array('lid' => 63)));
define('REQUESTPARTSS',$requestParts['AdminLang']['roman_label']);
//Last call for tenders resolved 
$lastcalTresolved=$AdminLang->find('first', array('conditions' => array('lid' => 62)));
define('LASTCALLTENDERSRESOLVED',$lastcalTresolved['AdminLang']['roman_label']);
//Request resolved  
$requestResolve=$AdminLang->find('first', array('conditions' => array('lid' => 61)));
define('REQUESTRESOLVED',$requestResolve['AdminLang']['roman_label']);
//View all solved requests  
$viewSolve=$AdminLang->find('first', array('conditions' => array('lid' => 60)));
define('VIEWSOLVEDREQUEST',$viewSolve['AdminLang']['roman_label']);
//Yes  
$yes=$AdminLang->find('first', array('conditions' => array('lid' => 111)));
define('YES',$yes['AdminLang']['roman_label']);
//No 
$no=$AdminLang->find('first', array('conditions' => array('lid' => 88)));
define('NO',$no['AdminLang']['roman_label']);
//Have you talked to a representative of Dezmembraripenet before making this sign? 
$representiveDezmem=$AdminLang->find('first', array('conditions' => array('lid' => 110)));
define('REPESENTIVEDEZMEM',$representiveDezmem['AdminLang']['roman_label']);
//CONTACT PERSON AT DEZMEMBRARIPENET 
$contactPerson=$AdminLang->find('first', array('conditions' => array('lid' => 109)));
define('CONTACTPERSON',$contactPerson['AdminLang']['roman_label']);
//Select your brands 
$selectbrand=$AdminLang->find('first', array('conditions' => array('lid' => 108)));
define('SELECTYOURBRANDS',$selectbrand['AdminLang']['roman_label']);
//Select Brands 
$sBrand=$AdminLang->find('first', array('conditions' => array('lid' => 107)));
define('SELECTBRANDS',$sBrand['AdminLang']['roman_label']);
//WARRANTY, TRANSPORT, DELIVERY, RETURN 
$wtdr=$AdminLang->find('first', array('conditions' => array('lid' => 106)));
define('WARRANTYTDR',$wtdr['AdminLang']['roman_label']);
//Describe the conditions of the warranty provided by your auto parts company, the period of return, delivery or other contractual conditions. 
$textdoc=$AdminLang->find('first', array('conditions' => array('lid' => 105)));
define('TEXTDOC',$textdoc['AdminLang']['roman_label']);
//Upload Image 
$imageUpload=$AdminLang->find('first', array('conditions' => array('lid' => 104)));
define('UPLOADIMAGE',$imageUpload['AdminLang']['roman_label']);
//Enter Description 
$enterDescrip=$AdminLang->find('first', array('conditions' => array('lid' => 103)));
define('ENTERDESCRIPTION',$enterDescrip['AdminLang']['roman_label']);
// Description 
$description=$AdminLang->find('first', array('conditions' => array('lid' => 102)));
define('DESCRIPTION',$description['AdminLang']['roman_label']);
// Logo  
$logo=$AdminLang->find('first', array('conditions' => array('lid' => 101)));
define('LOGO',$logo['AdminLang']['roman_label']);
// Company Banner 
define('COMPANYBANNER',getLanguage(100));
// Enter Phone 
define('ENTERPHONE',getLanguage(99));
// Enter your Fax  
define('ENTERYOURFAX',getLanguage(98));
// Enter email 
define('ENTEREMAIL',getLanguage(97));
//Email Address 
define('EMAILADDRESS',getLanguage(96));
//Fax 
define('FAX',getLanguage(95));
//Phone  
define('PHONE',getLanguage(94));
//Contact 
define('CONTACT',getLanguage(93));
//Enter Street Name 
define('ENTERSTREETNAME',getLanguage(92));
//Enter No 
define('ENTERNO',getLanguage(91));
//Enter Other details 
define('ENTEROTHERDETAILS',getLanguage(90));
//Other details address 
define('OTHERDETAILADDRESS',getLanguage(89));
//Street 
define('STREET',getLanguage(87));
//Select County 
define('SELECTCOUNTRY',getLanguage(86));
//Choose City 
define('CHOOSECITY',getLanguage(85));
//Enter Postal Code  
define('ENTERPOSTALCODE',getLanguage(84));
//Postal Code 
define('POSTALCODE',getLanguage(83));
//LOCALITY
define('LOCALITY',getLanguage(82));
//Enter your Code 
define('ENTERYOURCODE',getLanguage(81));
//Enter name of the park 
define('ENTERNAMEOFPARK',getLanguage(80));
//Code fiscal 
define('CODEFISCALL',getLanguage(79));
//Enter name of company 
define('ENTERNAMEOFCOMPANY',getLanguage(78));
//The commercial name of the park 
define('COMMERCIALPARK',getLanguage(77));
//COMPANY DATA 
define('COMPANYDATA',getLanguage(76));
//Add a fleet of truck 
define('FLEETOFTRUCK',getLanguage(75));
//Location 
define('LOCATION',getLanguage(112));
//Submit
define('SUBMIT',getLanguage(113));
//Recent Parks Truck 
define('RECENTPARKSTRUCK',getLanguage(117));
//Add to park truck 
define('ADDTOPARKTRUCK',getLanguage(116));
//See all ads 
define('SEEALLADS',getLanguage(115));
//Truck Parks 
define('TRUCKPARKS',getLanguage(114));
//test company  
define('TESTCOMPANY',getLanguage(121));
//Recent Company Parts 
define('RECENTCOMPANYPARTS',getLanguage(120));
//Add to Company Parts 
define('ADDTOCOMPANYPARTS',getLanguage(119));
//Company Parts 
define('COMPANYPARTS',getLanguage(118));
//DESCRIPTION AND LOGO 
define('DESCRIPTIONANDLOGO',getLanguage(123));
//DESCRIPTION AND LOGO 
define('BRANDSELECT',getLanguage(124));
//Add Company Parts 
define('ADDCOMPANYPART',getLanguage(122));
//..............User dashboard.........//
//Logout 
define('LOGOUT',getLanguage(176));
//Statistics views  
define('STATICVIEW',getLanguage(175));
//Profile Page  
define('PROFILEPAGE',getLanguage(174));
//My Profile  
define('MYPROFILE',getLanguage(173));
//Add Success Stories 
define('ADDSUCESSSTORIES',getLanguage(172));
//Manage Success Stories 
define('MANAGESUCESSSTORIES',getLanguage(171));
//Company Settings / Parc Parts 
define('COMPANYSETTINGPARCPARTS',getLanguage(170));
//Change email address 
define('CHANGEEMAILADDRESS',getLanguage(169));
//Change Password 
define('CHANGEPASSWORD',getLanguage(168));
//Warranty / Return / Shipping / Payment 
define('WRSP',getLanguage(167));
//Alerts auto parts requests  
define('ALERTAUTOPREQUEST',getLanguage(166));
//Profile personal Information management 
define('PPINFORMATIONMANAGE',getLanguage(165));
//Pay as Legal Personl 
define('PAYPALLIGAL',getLanguage(164));
//Pay as individua 
define('PAYPALINDIVISUAL',getLanguage(163));
//Feeds Accounts  
define('FEEDACCOUNTS',getLanguage(162));
//History Account 
define('HISTORYACCOUNT',getLanguage(161));
//Accounts Credits 
define('ACCOUNTCREADIT',getLanguage(160));
//Financial 
define('FINANCIAL',getLanguage(159));
//Total Positive,Negative, Neutre Rating  
define('TOTALPNNR',getLanguage(158));
//My Rating 
define('MYRATING',getLanguage(157));
//Rating Received 
define('RATINGRECIVED',getLanguage(156));
//Seller Rating 
define('SELLERRATING',getLanguage(155));
//Rating as Buyer 
define('RATINGBYER',getLanguage(154));
//Rating Given 
define('RATINGGIVEN',getLanguage(153));
//Send a private message 
define('SENDPRIVATEMESG',getLanguage(152));
//Email History 
define('EMAILHISTORY',getLanguage(151));
//Archived Posts 
define('ARCHIVPOST',getLanguage(150));
//Submissions 
define('SUBMISSIONS',getLanguage(149));
//Inbox  
define('INBOX',getLanguage(148));
//Posts   
define('POSTS',getLanguage(147));
//Offers to my requests  
define('OFFERMYREQUEST',getLanguage(146));
//Offer Winning 
define('OFFERWINNING',getLanguage(145));
//New Question on Offer 
define('NEWQUESTIONOFFER',getLanguage(144));
//Supply & Demand 
define('SUPPLYDEMAND',getLanguage(143));
//Bidding 
define('BIDDING',getLanguage(142));
//My requests of parts 
define('MYREQUESTPART',getLanguage(141));
//Add Offer 
define('ADDOFFER',getLanguage(140));
//Deleted ads 
define('DELETEADD',getLanguage(139));
//Out of Stock 
define('OUTOFSTOCT',getLanguage(138));
//Commands 
define('COMMANDS',getLanguage(137));
//Order 
define('ORDERR',getLanguage(136));
//Asks for sales
define('ASKFORSALE',getLanguage(135));
//Active Sales 
define('ACTIVESALE',getLanguage(134));
//Post Ad 
define('POSTAD',getLanguage(133));
//Sales 
define('SALES',getLanguage(132));
//My Question 
define('MYQUESTION',getLanguage(131));
//My Purchase 
define('MYPURCHASE',getLanguage(130));
//Purchase 
define('PURCHASE',getLanguage(129));
//Sell a Song 
define('SELLASONG',getLanguage(128));
//Edit Profile 
define('EDITPROFILE',getLanguage(127));
//Name 
define('NAME',getLanguage(126));
//Welcome 
define('WELCOME',getLanguage(125));
//EDIT PROFILE PICTURE.. 
define('EDITPROFILEPIC',getLanguage(177));
//---SELL A SONGS.-----//
//Dashboard  
define('DASHBOARD',getLanguage(184));
//Ready Content  
define('READYCONTENT',getLanguage(625));
//You have selected category 
define('YOUHAVESELECTEDCATOGRY',getLanguage(183));
//Carry On  
define('CARRYON',getLanguage(182));
//Category 
define('CATEGORY',getLanguage(181));
//Ready  
define('READY',getLanguage(180));
//Preview ad 
define('PREVIEWADS',getLanguage(179));
//Choose category 
define('CHOOSECATEGORY',getLanguage(178));
//Seller 
define('SELLERRR',getLanguage(626));
//Buyer 
define('BUYERRRR',getLanguage(627));
//Recent View 
define('RECENTVIEW',getLanguage(628));
//---purchages-----//
//Details seller 
define('DETAILSSELLER',getLanguage(191));
//Sl #  
define('Sl',getLanguage(190));
//Sales Clerk   
define('SALECLERK',getLanguage(189));
//Notice 
define('NOTICE',getLanguage(188));
//Qty. X Price 
define('QTYXPRICE',getLanguage(187));
//Date of purchase  
define('DATEOFPURCHASE',getLanguage(186));
//My request Solved  
define('MYREQUESTSOLVED',getLanguage(185));
//--company piceses add--//
//Join our community and discover the growing surprises prepared! 
define('JCDGSP',getLanguage(200));
//	Buy and sell with confidence. 
define('BUYANDSELL',getLanguage(199));
//Buys the parts they want.  
define('BUYSTHEPARTSWANT',getLanguage(198));
//Forgot Password?  
define('FORGOTPASSWORD',getLanguage(197));
//Password  
define('PASSWORD',getLanguage(196));
//Mail id/Login id 
define('MAILLOGINID',getLanguage(195));
//Sign in 
define('SIGNIN',getLanguage(194));
//Register as a new member 
define('REGISTERNEWMEMBER',getLanguage(193));
//Not a member yet? 
define('NOTYETMEMBER',getLanguage(192));
//--Create account page--//
//am over 18 years old and accept the 
define('OVER18YEAROLD',getLanguage(214));
//Terms And Condition 
define('TERMANDCONDITION',getLanguage(213));
//Security code 
define('SECURITYCODE',getLanguage(212));
//Confirm Password  
define('CONFIRMATIONPASSWORD',getLanguage(211));
//Intra info 
define('INTRAINFO',getLanguage(210));
//Choose Town  
define('CHOOSETWON',getLanguage(209));
//Choose County  
define('CHOOSECOUNTY',getLanguage(208));
//City 
define('CITY',getLanguage(207));
//District 
define('DISTRICT',getLanguage(206));
//User Type  
define('USERTYPE',getLanguage(205));
//Last Name  
define('LASTNAME',getLanguage(204));
//First Name 
define('FIRSTNAME',getLanguage(203));
//Login info 
define('LOGININFO',getLanguage(202));
//Personal Information 
define('PERSONALINFORMATION',getLanguage(201));
//--Enquery Parts--//
//Add Request 
define('ADDREQUEST',getLanguage(236));
//Choose region 
define('CHOOSEREGION',getLanguage(235));
//Where do you want to be shipped? 
define('WANTTOBESHIPPED',getLanguage(234));
//From Truck  
define('FROMTRUCK',getLanguage(233));
//We 
define('WE',getLanguage(232));
//I offer parts 
define('IOFFERPART',getLanguage(231));
//Add another piece  
define('ADDANOTHERPIECE',getLanguage(230));
//Pictures  
define('PICTURES',getLanguage(229));
//Optional 
define('OPTIONAL',getLanguage(228));
//Maximum price 
define('MAXPRICE',getLanguage(227));
//Part No 
define('PARTNO',getLanguage(226));
//Name piece 
define('NAMEPIECE',getLanguage(225));
//Looking for parts or accessories 
define('LOOKPARTOFACCESSO',getLanguage(224));
//Choose the model 
define('CHOOSEMODEL',getLanguage(223));
//Choose Brand 
define('CHOOSEBRAND',getLanguage(222));
//Vehicle Identification Number 
define('VEHICLEIDNUMBER',getLanguage(221));
//Engines 
define('ENGINES',getLanguage(220));
//Year of manufacture 
define('YEAROFMANUFACTURE',getLanguage(219));
//Version 
define('VERSION',getLanguage(218));
//Brand 
define('BRANDS',getLanguage(217));
//Facts about the car looking for the song 
define('FACTOFCAR',getLanguage(216));
//Quotation for auto parts 
define('QUOTATIONFORAUTOPARTS',getLanguage(215));
//Remove
define('REMOVE',getLanguage(237));
//User Id 
define('USERID',getLanguage(238));
//Login with Facebook account 
define('LOGINFACEBOOKACCOUNT',getLanguage(239));
//---Post Ads---///
//Note: Fill in as accurately as possible the cost of transport and delivery terms! Jeopardy Rate if they are wrong! 
define('NOTEACCURATELY',getLanguage(286));
//Ready! 
define('READYS',getLanguage(285));
//Click Continue to go to the next step 
define('NEXTSTEP',getLanguage(284));
//Time required for dispatch 
define('TIMEREQDISPATCH',getLanguage(283));
//Free Shipping by Mail  
define('FREESHIPPINGMAIL',getLanguage(282));
//Free delivery by courier 
define('FREEDELIVERYCOURIER',getLanguage(281));
//RON 
define('RON',getLanguage(280));
//Delivery Cost  
define('DELIVERYCOST',getLanguage(279));
//Romanian Mail  
define('ROMANIANMAIL',getLanguage(278));
//Courier  
define('COURIER',getLanguage(277));
//Personal Teaching  
define('PERSONALTEACHING',getLanguage(276));
//Method of delivery   
define('METHODOFDELIVERY',getLanguage(275));
//Check the ways you can send the song to the buyer 
define('SENDTHESONGTOBUYER',getLanguage(274));
//How to send the song to the customer?   
define('SENDSONGTOCUSTOMER',getLanguage(273));
//Others  
define('OTHER',getLanguage(272));
//Banking Card   
define('BANKCARD',getLanguage(271));
//Wire Transfer   
define('WIRETRANSFER',getLanguage(270));
//Upon delivery  
define('UPONDELIVERY',getLanguage(269));
//Cash on delivery   
define('CASHONDELICERY',getLanguage(268));
//Check the payment methods that we accept from the list below: 
define('CHECKPAYMENTMETHOD',getLanguage(267));
//What methods of payment are accepted? 
define('PAYMENTMETHODACCEPTED',getLanguage(266));
//Number of pieces  
define('NOOFPIECES',getLanguage(265));
//Quantity Available  
define('QUANTITYAVAILABLE',getLanguage(264));
//Currency 
define('CURRENCY',getLanguage(263));
//Price 
define('PRICE',getLanguage(262));
//Note: Enter the actual price of the product including VAT. Introducing a false price erase the announcement. 
define('NOTEFORACTUALVAT',getLanguage(261));
//Rate track 
define('RATETRACK',getLanguage(260));
//Used 
define('USED',getLanguage(259));
//NEW
define('NEW',getLanguage(258));
//Select 
define('SELECT',getLanguage(257));
//Day 
define('DAYA',getLanguage(623));
//Shipping Detail 
define('SHIPPINGDETAIL',getLanguage(624));
//new or used? 
define('NEWUSED',getLanguage(256));
//Product Condition 
define('PRODUCTCONDITION',getLanguage(255));
//Information about the track 
define('INFORMATIONTRACK',getLanguage(254));
//Add 
define('ADD',getLanguage(253));
//Your ad will appear in searches like "lighthouse Logan" unless you select "Logan" below. Select models are not compatible with the song sold erase the announcement. 
define('LOGANSEARCH',getLanguage(252));
//Make and Model Car 
define('MAKEANDMODELCAR',getLanguage(251));
//Choose pictures (up to 8)  
define('CHOOSEPICTURE',getLanguage(250));
//Tip: You can select multiple photos at the same time! To increase your chances of selling adds more real pictures by piece from different angles. 
define('NOTETIP',getLanguage(249));
//Photos of the song (be careful not to be less than 250x250 pixels) 
define('PHOTOOFSONG',getLanguage(248));
//Describe as detailed piece on sale. The more customers, the chances of selling increase exponentially. 
define('DESCRIBEASDETAIL',getLanguage(247));
//Details about the song sold  
define('DETAILABTSONGSOLD',getLanguage(246));
//Use a title as suggestive and completely. eg BMW 3 Series E46 front bumper year in 2001 with projectors and green grid 
define('NOTETITLEASSUGG',getLanguage(245));
//Name of the song 
define('NAMEOFSONG',getLanguage(244));
//Edit
define('EDIT',getLanguage(243));
//Car Alarm  
define('CARALRAM',getLanguage(242));
//Auto Accessories 
define('AUTOACCESSORIES',getLanguage(241));
//The category will be added to the ad 
define('CATEGORYWILLAD',getLanguage(240));
//----Request Resolve --///
//No requests have solved.
define('NOREQUESTSOLVED',getLanguage(300));
//Requests sove parts
define('REQUESTSOVEPARTS',getLanguage(299));
//Ask for offer parts 
define('ASKFOROFFERPART',getLanguage(298));
//No requests have inactivated. 
define('NOREQUESTINACTIVE',getLanguage(297));
//Requests inactive parts. 
define('REQUESTINACTIVEPART',getLanguage(296));
//Requests solved  
define('REQUESTSOLVED',getLanguage(295));
//View Response 
define('VIEWRESPONSE',getLanguage(294));
//View Application 
define('VIEWAPPLICATION',getLanguage(293));
//Options 
define('OPTIONS',getLanguage(292));
//Date 
define('DATE',getLanguage(291));
//Offers 
define('OFFERSS',getLanguage(290));
//Application 
define('APPLICATION',getLanguage(289));
//ACTIVEREQUESTSS
define('ACTIVEREQUESTSS',getLanguage(289));
//My Request for Parts 
define('MYREQUESTPARTS',getLanguage(287));
//Where do you want to be shipped 
define('WHEREWANTTOSHIPED',getLanguage(301));
//---SALES DETAIL---//
//This phone number is provided just asking for product details to a buying decision.
//To benefit from mediation service offered by PieseAuto.ro not place orders by phone but with the button "Order Now"
//Do not forget to say you saw the ad on the website dezmembraripenet.com.//
define('NOTICESDATAA',getLanguage(344));
//to post this personal information such as phone, e-mail, website, etc. 
define('PERSONALINFODATA',getLanguage(343));
//PROHIBITED 
define('PROHIBITED',getLanguage(342));
//Addresses the seller a question 
define('ADDRESSELLERQUESTION',getLanguage(341));
//There were no questions on this notice. 
define('QUESTIOONONTHISNOTICE',getLanguage(340));
//Questions about Request Parts 
define('QUESTIONABTREQUESTPARTS',getLanguage(339));
//Return Policy Information 
define('RETURNPOLICYINFO',getLanguage(338));
//shall bear the cost of return transport 
define('SHALLBEARCOSTRETURNTRANS',getLanguage(337));
//If you choose to return 
define('CHOOSERETURNS',getLanguage(336));
//days of receiving them 
define('DAYOFRECIVING',getLanguage(335));
//The piece can be returned within 
define('PIECECANDRETURN',getLanguage(334));
//Return Policy  
define('RETURNPLOY',getLanguage(333));
//It does not offer warranty 
define('OFFERWARRENTYY',getLanguage(332));
//Warranty Policy
define('WARRENTYPOLICY',getLanguage(331));
//month warranty 
define('MONTHWARRENTY',getLanguage(330));
//It gives 
define('ITGIVES',getLanguage(329));
//Guarantee 
define('GUARENTY',getLanguage(328));
//Payment Methods
define('PAYMENTMETHODS',getLanguage(327));
//Romanian Mail delivery costs
define('ROMANIDELIVERYCOST',getLanguage(326));
//Courier delivery costs
define('COURIORDELIVERYCOST',getLanguage(325));
//whisk 
define('WHISK',getLanguage(324));
//View
define('VIEW',getLanguage(323));
//Product displayed in the paging  
define('PRODUCTDISPLAYPAGE',getLanguage(322));
//You recently viewed 
define('RECENTLYVIEW',getLanguage(321));
//Click the button "Ask Question" to find the desired track stock price. 
define('CLICKBUTTONTOASK',getLanguage(320));
//Time needed to process your order 
define('TIMENEEDPROCEORDER',getLanguage(319));
//Delivery and Payment 
define('DELIVERYANDPAYMENT',getLanguage(318));
//50% Rate 
define('50%RATE',getLanguage(317));
//View Ads 
define('VIEWADS',getLanguage(316));
//Quantity 
define('QUANTITYS',getLanguage(315));
//gesture as compl 
define('QESTUREASCOMPL',getLanguage(314));
//Ask Question 
define('ASKQUESTION',getLanguage(313));
//seller free 
define('SELLERFREE',getLanguage(312));
//Add to Favorite 
define('ADDTOFAVORITE',getLanguage(311));
//Not Rated 
define('NORATED',getLanguage(310));
//Total View 
define('TOTALVIEW',getLanguage(309));
//Rating 
define('RATINGS',getLanguage(308));
//Email Us 
define('EMAILUS',getLanguage(307));
//Alternatively you can 
define('ALTERNATIVEYOUCAN',getLanguage(306));
//Call us now on  
define('CALLUSNOWON',getLanguage(305));
//Need Expert Advice? 
define('NEEDEXPERTADVICE',getLanguage(304));
//track name 
define('TRACKNAME',getLanguage(303));
//Product Information 
define('PRODUCTINFO',getLanguage(302));
//--SALES OREDR--//
//Total
define('TOTAL',getLanguage(359));
//Save the above information in my profile 
define('SAVEABOVEINFO',getLanguage(358));
//Notes command 
define('NOTESCOMMAND',getLanguage(357));
//Delivery address 
define('DELIVERYADDRESSS',getLanguage(356));
//Street Address 
define('STREETADDRES',getLanguage(355));
//Customer Data 
define('CUSTOMERDTA',getLanguage(354));
//Payment 
define('PAYMENTS',getLanguage(353));
//Delivery details 
define('DELIVERYDETAILL',getLanguage(352));
//The order can be sent  
define('ORDERSENTS',getLanguage(351));
//Choose the method of delivery  
define('CHOOSEMETHODDELIVERY',getLanguage(350));
//Order details 
define('ORDERDETAILLL',getLanguage(349));
//positive ratings 
define('POSITIVINGRATINGS',getLanguage(348));
//Platinum Dealer 
define('PLATINUMDEALERS',getLanguage(347));
//Please confirm your order 
define('PLSCONFIRMORDER',getLanguage(346));
//Sales Confirm order 
define('SALESCONFIRMORDER',getLanguage(345));
//--PARTS DETAIL---//
//cirtificate positive
define('CERTIFICATEPOSITIVE',getLanguage(390));
//months and 
define('MONTHAND',getLanguage(388));
//Days
define('DAYS',getLanguage(387));
//Member for  
define('MEMBERFOR',getLanguage(386));
//Ask a question 
define('ASKQUESTIONSS',getLanguage(385));
//Terms of delivery 
define('TERMOFDELIVER',getLanguage(384));
//Free delivery by romanian mail 
define('FREEDELIVERYROMAILMAIL',getLanguage(383));
//Time required to process the command 
define('TIMEREQUIREDPROCESS',getLanguage(382));
//Delivery 
define('DELICERYYY',getLanguage(381));
//Custom made  
define('CUSTOMMADE',getLanguage(380));
//In stock 
define('INSTOCK',getLanguage(379));
//Availability 
define('AVAILABELITY',getLanguage(378));
//New parts 
define('NEWPARTSS',getLanguage(377));
//Used Parts 
define('USEDPARTS',getLanguage(376));
//they see only you 
define('THEYSEEONLY',getLanguage(375));
//observations on 
define('OBSERVATIONON',getLanguage(374));
//Price with VAT  
define('PRICEWITHVAT',getLanguage(373));
//eg red Dacia Logan Front without scratches 
define('DACIALOGANFRONT',getLanguage(372));
//play 
define('PLAY',getLanguage(371));
//Request details 
define('REQSTDETAIIL',getLanguage(370));
//PART REQUEST
define('PARTREQUEST',getLanguage(369));
//Offers received 
define('OFFERSRECIVEDD',getLanguage(368));
//Year 
define('YEARS',getLanguage(367));
//Vehicle Identification No  
define('VEHICLEIDNO',getLanguage(366));
//Data about request 
define('DATAABTREQST',getLanguage(365));
//cod piece  
define('CODPIECES',getLanguage(364));
//Mirror with 3d efect 
define('MIRROR3DEFFECT',getLanguage(363));
//application added in date 
define('APPLICATIONDATE',getLanguage(362));
//Mirror  
define('MIRROR',getLanguage(361));
//SOLVED   
define('SOLVED',getLanguage(360));
//facebook login   
define('FBLOGIN',getLanguage(389));
//---PARTS ALL LIST--//
//FILTER
define('FILTER',getLanguage(391));
//All brands 
define('ALLBRANDD',getLanguage(392));
//All models
define('ALLMODEELS',getLanguage(393));
//delivery in  
define('DELIVERYIN',getLanguage(397));
//Posted on 
define('POSTEDON',getLanguage(396));
//All counties 
define('ALLCOUNTRY',getLanguage(395));
//All applications 
define('ALLAPPLICATION',getLanguage(394));
//Parc run 
define('PARCRUN',getLanguage(398));
//About us
define('ABOUTUS',getLanguage(399));
//Vehicle Brands dismantled
define('VEHICLEBRANDSDISMANTL',getLanguage(400));
//Rate park
define('RATEPARKK',getLanguage(401));
//Your rating
define('YOURRATING',getLanguage(402));
//votes 
define('VOTES',getLanguage(405));
//out of 
define('OUTOF',getLanguage(404));
//Average Rating 
define('AVERAGERATTING',getLanguage(403));
//--Privew ads--//
//Click here
define('CLICKHERE',getLanguage(406));
//to preview your ad before definitive public.
define('PRIVIEWADPUBLIC',getLanguage(407));
//to be published. 
define('TOBEPUBLISH',getLanguage(413));
//advertiser 
define('ADVERTISER',getLanguage(412));
//If the ad preview everything is OK click on the button 
define('IFPREVIEWOKCLICK',getLanguage(411));
//Modify 
define('MODIFY',getLanguage(410));
//If you want to make additional changes, select the option
define('IFMAKEADITIONALCHARGE',getLanguage(409));
//Public notice 
define('PUBLICNOTICE',getLanguage(408));
//to preview your ad before definitive public. 
define('PREVIEWPUBLICADS',getLanguage(407));
//--Ready!--//
//Promotes 
define('PROMOTE',getLanguage(421));
//Announcement 
define('ANNOUNCEMENT',getLanguage(420));
//your products. The announcement can be promoted directly from the page after him. 
define('YOURPRODUCTANNOUNCEMENT',getLanguage(419));
//sell faster  
define('SELLFASTER',getLanguage(418));
//We recommend to use the methods of promotion that we provide and to 
define('WERECOMENDUSE',getLanguage(417));
//You can change at any time ad My account - Sale of assets or directly from the announcement page.  
define('YOUCANCHANGEANYTIME',getLanguage(416));
//Your Ad was successfully published Dezmembraripenet.ro  
define('YOURADSUCESSFUL',getLanguage(415));
//Congratulations 
define('CANGRATULATIONS',getLanguage(414));
//--Dashboard Menu--//
//Nr. Posts
define('NRPOSTS',getLanguage(422));
//Question
define('QUESTION',getLanguage(423));
//No Reply Found
define('NOREPLAYFOUND',getLanguage(424));
//Reply List
define('REPLYLIST',getLanguage(425));
//Reply
define('REPLAY',getLanguage(426));
//Sent Question 
define('SENTQUESTION',getLanguage(427));
//Reply about the question 
define('REPLYABTQUESTION',getLanguage(428));
//---Sales part--//
//No Result Found 
define('NORESULTFOUND',getLanguage(444));
//Delete ads 
define('DELETEADS',getLanguage(429));
//Forum 
define('FORUM',getLanguage(443));
//ads 
define('ADS',getLanguage(442));
//Active filters  
define('ACTIVEFILTER',getLanguage(441));
//All 
define('ALL',getLanguage(440));
//On page 
define('ONPAGE',getLanguage(439));
//Price Down 
define('PRICEDOWN',getLanguage(438));
//Price ascending 
define('PRICEASCEN',getLanguage(437));
//Quantity Down 
define('QUANTITYDOWN',getLanguage(436));
//Quantity Increasing 
define('QUANTITYINCREASE',getLanguage(435));
//Updated descending 
define('UPDATEDESC',getLanguage(434));
//	Updated ascending 
define('UPDATEASC',getLanguage(433));
//	Date added descending 
define('DATEDESEND',getLanguage(432));
//	Date added ascending 
define('DATEASSEND',getLanguage(431));
//	Keyword 
define('KEYWORD',getLanguage(430));
//	Posted By 
define('POSTEDBY',getLanguage(446));
//	Asked Question 
define('ASKEDQUESTION',getLanguage(445));
//Action
define('ACTION',getLanguage(447));
//View Reply 
define('VIEWREPLY',getLanguage(448));
//Sales order 
define('SALESORDER',getLanguage(449));
//Order ID 
define('ORDERID',getLanguage(450));
//No sales order. 
define('NOSELLORDER',getLanguage(451));
//Requests currently active parts. 
define('REQUESTCURENTACTIVE',getLanguage(452));
//No requests have activated. 
define('NOREQUESTHAVEACTIVE',getLanguage(453));
//Requests inactive  
define('REQUESTINACTIVE',getLanguage(454));
//You have no  
define('YOUHAVENO',getLanguage(461));
//New Orders 
define('NEWORDERS',getLanguage(460));
//All Orders 
define('ALLORDERS',getLanguage(459));
//Canceled Orders 
define('CANCLEORDERS',getLanguage(458));
//Completed Orders  
define('COMPLETEORDERS',getLanguage(457));
//Shipped Orders 
define('SHIPEDORDERS',getLanguage(456));
//Confirmed Orders 
define('CONFIRMORDERS',getLanguage(455));
//No sales rating received seller. 
define('NOSALERATING',getLanguage(463));
//Date of Order 
define('DATEOFORDER',getLanguage(462));
//Edit to relist 
define('EDITTOLIST',getLanguage(465));
//Delete filters 
define('DELETEFILTERS',getLanguage(464));
//--Request  Parts---//
//Private Remark 
define('PRIVATEREMARKS',getLanguage(470));
//Shipping Time 
define('SHIPPINGTIME',getLanguage(469));
//Product Condn. 
define('PRODUCTCONDT',getLanguage(468));
//Title  
define('TITLE',getLanguage(467));
//Req. ID  
define('REQID',getLanguage(466));
//List/ Manage Request offer Bid 
define('LISTMANAGEREQSTOFER',getLanguage(471));
//There are still requests that have offered and which should not have won. 
define('STILREQUESTWON',getLanguage(477));
//Requests Parts offered to you but you have not won.  
define('REQUESTNOTOWN',getLanguage(476));
//.mu.m 
define('MUM',getLanguage(475));
//Offer Price 
define('OFERPRICE',getLanguage(474));
//Offer Name 
define('OFERNM',getLanguage(473));
//Bid By 
define('BIDBY',getLanguage(472));
//Offer Inactive 
define('OFFERINACTIVE',getLanguage(481));
//Offer Active 
define('OFFERACTIVE',getLanguage(480));
//Offer Losing  
define('OFFERLOSSING',getLanguage(479));
//Supply & Demands  
define('SUPPLYDEMANDS',getLanguage(478));
//Parts 
define('PARTS',getLanguage(482));
//List/ Manage Question on Offer
define('LISTMANAGEQUESTION',getLanguage(483));
//No requests have Winning. 
define('NOREQUESTWINNINGS',getLanguage(485));
//Requests winning parts.  
define('REQUSTWINNINGS',getLanguage(484));
//Offer To My Parts  
define('OFFERTOMYPARTS',getLanguage(486));
////--Posts----//
//No Message Found 
define('NOMESSAGEFOUND',getLanguage(492));
//Delete 
define('DELETE',getLanguage(491));
//Sent Date 
define('SENTDATE',getLanguage(490));
//Replied On 
define('REPLIEDON',getLanguage(489));
//Message  
define('MESSAGE',getLanguage(488));
//Sent By  
define('SENTBY',getLanguage(487));
//Sent To 
define('SENTTO',getLanguage(494));
//Sent Message  
define('SENTMESSAGE',getLanguage(493));
//Message Type 
define('MESSAGETYPE',getLanguage(496));
//Archive Posts 
define('ARCHIVEPOST',getLanguage(495));
//History Message 
define('HISTORYMESSG',getLanguage(497));
//Select User 
define('SELECTUSER',getLanguage(499));
//Compose message 
define('COMPOSEMESSAGE',getLanguage(498));
//--Rating given---//
//No sales rating given Buyer. 
define('NOSALESRATINGGIVEN',getLanguage(502));
//To Rate  
define('TORATE',getLanguage(501));
//Rating for Buyer   
define('RATINGFORBUYER',getLanguage(500));
//Rating For Seller 
define('RATINGFORSELLER',getLanguage(504));
//No sales rating seller givened. 
define('NORATINGSELLERGIVEN',getLanguage(503));
//No sales rating received. 
define('NOSALESRATINGRECIVED',getLanguage(506));
//Rating Received Buyer 
define('RATINGRECIVEDBUYER',getLanguage(505));
//Rating received Seller 
define('RATINGRECIVEDSELLERS',getLanguage(507));
//No results were found. 
define('NORESULTWEREFOUND',getLanguage(513));
//grade  
define('GRADE',getLanguage(512));
//Receive From 
define('RECIVEFROM',getLanguage(511));
//All negative received 
define('ALLNEGATIVERECIVE',getLanguage(510));
//All neutral received 
define('ALLNETURALRECIVE',getLanguage(509));
//All positive received 
define('ALLPOSITIVERECIVE',getLanguage(508));
//No credits Found 
define('NOCREDITFOUND',getLanguage(517));
//Total Credits  
define('TOTALCREDITS',getLanguage(516));
//Last Membership Plan 
define('LASTMEMBERPLAN',getLanguage(515));
//Last Transaction ID
define('LASTTRANSATIONID',getLanguage(514));
//No History Found 
define('NOHISTORIFOUND',getLanguage(524));
//Payment Date  
define('PAYMENTDATE',getLanguage(523));
//Credits 
define('CREDITS',getLanguage(522));
//Amount  
define('AMOUNT',getLanguage(521));
//Membership Plan   
define('MEMBERPLANS',getLanguage(520));
//Transaction ID   
define('TRANSATIONID',getLanguage(519));
//History Accounts 
define('HISTORYACCOUNTS',getLanguage(518));
//Upgrade Membership 
define('UPGRADEMEMBERSHIP',getLanguage(525));
//Credit Card 
define('CREDITCARD',getLanguage(526));
//Power by credit card 
define('POWERBYCREDITCARD',getLanguage(527));
//Membership Type 
define('MEMBERSHIPTYPE',getLanguage(528));
//Confirm Plan 
define('CONFIRMPLAN',getLanguage(529));
//State
define('STATE',getLanguage(539));
//Confirm Order 
define('CONFIRMORDER',getLanguage(542));
//Enter Name 
define('ENTERNAME',getLanguage(541));
//Ship to a different address ? 
define('SHIPADDRESS',getLanguage(540));
//State
define('STATES',getLanguage(539));
//select here 
define('SELECTHERE',getLanguage(538));
//Address 
define('ADDRESSS',getLanguage(537));
//Enter Address 
define('ENTERADDRESS',getLanguage(536));
//enter your name 
define('ENTERYOURNAME',getLanguage(535));
//Enter your Number 
define('ENTERYOURNO',getLanguage(534));
//Billing Details 
define('BILLINGDETAILS',getLanguage(533));
//Pay securely with your credit card. 
define('PAYSECURECREDITCARD',getLanguage(532));
//Payment Type
define('PAYMENTTYPE',getLanguage(531));
//Your Membership Plans 
define('YOURMEMBERSHIPPLAN',getLanguage(543));
////-----setting-----////
//Save Changes 
define('SAVECHANGE',getLanguage(549));
//Update 
define('UPDATE',getLanguage(548));
//Other details of address 
define('OTHERDETAILOFADDRESS',getLanguage(547));
//Search postcode  
define('SEARCHPOSTCODE',getLanguage(546));
//Edit email
define('EDITEMAIL',getLanguage(545));
//Account Settings 
define('ACCOUNTSETTINGS',getLanguage(544));
//Save 
define('SAVE',getLanguage(551));
//Email id  
define('EMAILIDD',getLanguage(550));
/* Romanian Post - xx lei / kg - usually in xx days.  <br>
Courier - xx xx lei for the first kilograms. + Xx lei / kg extra weight.  <br>
Rates valid for normal volumes courier network coverage.  <br>
Payment refunded collector (not actually sending the cash paid) / cash payment is paid by the client.*/
define('ROMAINDATA',getLanguage(571));
//Thank you for order made. In the shortest possible time colleague will contact you to confirm order details and the date can be shipped. <br> We are open Monday to Friday from 9.00 to 18.00. <br> If you order made outside these hours, please be aware that we will process your orders in the order in which they were made. <br> If you forgot to tell us something through field observations, you can do the buttons below to contact this email. <br> We treat all orders very seriously and we guarantee that the products delivered will be described. <br> Good luck shopping! 
define('ROMAINDATA1',getLanguage(577));
//Standard rate for sending packages 
define('STANDARDRATESEND',getLanguage(576));
//Send message automatically 
define('SENDMESSAGEAUTO',getLanguage(575));
//Do not send automated message 
define('DONOTSENDAUTOMESG',getLanguage(574));
//Automatic response in case of order
define('AUTOMATICRESPONSECASE',getLanguage(573));
//Invoice 
define('INVOICE',getLanguage(572));
//Romanian Post - xx lei / kg - usually in xx days. <br> Courier - xx xx lei for the first kilograms. + Xx lei / kg extra weight. <br> Rates valid for normal volumes courier network coverage. <br> Payment refunded collector (not actually sending the cash paid) / cash payment is paid by the client. 
define('ROMAINDATA2',getLanguage(571));
//Standard rates for sending packages 
define('STANDARDSENPACKEGE',getLanguage(570));
//Delivery Methods 
define('DELIVERYMETHOD',getLanguage(569));
//Additional information regarding return policy
define('AADITIONALINFOPOLICY',getLanguage(568));
//Customer 
define('CUSTOMERSS',getLanguage(567));
//The transportation cost for return is supported by 
define('TRANSPOTETIONCOST',getLanguage(566));
//Replacement product  
define('REPLACEMENTPRODUCT',getLanguage(565));
//Cash consideration product 
define('CASECONSIPRO',getLanguage(564));
//Method return accepted 
define('METHODRETURN',getLanguage(563));
//The period during which you can return the product after receiving it 
define('PDWYOURETURNAFTER',getLanguage(562));
//Accept return  
define('ACCEPTRETURN',getLanguage(561));
//I do not accept return 
define('IDONOTACCEPTRETURN',getLanguage(560));
//90 days warranty is given in accordance with law. <br> For warranty claims must be made ​​proof mounting parts in RAR authorized service. 
define('ROMAINDATA3',getLanguage(559));
//Terms of warranty for products sold 
define('TERMOFPRUDUCTSOLD',getLanguage(558));
//Months
define('MONTHS',getLanguage(557));
//How many months you give warranty products sold?
define('WARRENTYPRODUCTSOLD',getLanguage(556));
//Offer warranty 
define('OFFERWARRENTY',getLanguage(555));
//We do not offer warranty 
define('WEDONTOFFERWARENTY',getLanguage(554));
//Disclaimer of Warranty 
define('DESCLAIRMERWARRENTY',getLanguage(553));
//Alert auto parts request 
define('ALLERTPARTSREQ',getLanguage(552));
//New Password 
define('NEWPASSWORD',getLanguage(579));
//Current Password 
define('CURRENTPASWORD',getLanguage(578));
//No Success Stories found 
define('NOSUCESSSTORIFOUND',getLanguage(582));
//Post Date 
define('POSTDATEE',getLanguage(581));
//Success Stories List 
define('SUCESSSTORYLIST',getLanguage(580));
//---My Profile--//
//Received as a Buyer 
define('RECEVEDABYER',getLanguage(601));
//Received The Seller 
define('RECIVEDTHESELLER',getLanguage(600));
//Rating-uri 
define('RATINGURI',getLanguage(599));
//All ratings received 
define('ALLRATINGRECVIED',getLanguage(598));
//Received From 
define('RECEVEDFROM',getLanguage(597));
//Qualifying 
define('QUALIFYING',getLanguage(596));
//Cost of transport 
define('COSTTRANSPORT',getLanguage(595));
//Delivery time 
define('DELIVERYTIME',getLanguage(594));
//Communication with seller
define('COMUNICATIONWITHSELLER',getLanguage(593));
//Product as described 
define('PRODUCTDESCRIB',getLanguage(592));
//detailed Ratings
define('DETAILRATING',getLanguage(591));
//Negative 
define('NEGATIVE',getLanguage(590));
//Neutrals 
define('NEUTRALS',getLanguage(589));
//positives 
define('POSITIVE',getLanguage(588));
//Last year 
define('LASTYEAR',getLanguage(587));
//Last 6 months 
define('LAST6MONTH',getLanguage(586));
//Last month 
define('LASTMONTH',getLanguage(585));
//Positive Feedback  
define('POSITIVEFEEDBACK',getLanguage(584));
//User Profile 
define('USERPROFILE',getLanguage(583));
//Ad Image 
define('ADIMAGE',getLanguage(603));
//Most Viewed 
define('MOSTVIEWED',getLanguage(602));
//No Favourites found 
define('NOFAVOURFOUND',getLanguage(605));
//Total Favourite 
define('TOTALFAVORITE',getLanguage(604));
//pcs 
define('PCS',getLanguage(606));
//Published Application 
define('PUBLISHEDAPPLICATION',getLanguage(607));
//Active 
define('ACTIVE',getLanguage(608));
//Resolve 
define('RESOLV',getLanguage(609));
//No Record Present
define('NORECORDPRESENT',getLanguage(612));
//Submit the Answer 
define('SUBMITTHEANSWER',getLanguage(611));
//Reply about Question 
define('REPLYABTQUESTIONS',getLanguage(610));
//Add a company car parts
define('ADDCOMPANYCARPARTS',getLanguage(613));
//Positive Rating 
define('POSITIVERATING',getLanguage(614));
//piece levrate 
define('PIESELEVERATE',getLanguage(617));
//Dismantled brands  
define('DISMENTALBRAND',getLanguage(616));
//Notifications 
define('NOTIFICATION',getLanguage(615));
//Replied By 
define('REPLIEDBY',getLanguage(618));
//Requests parts that you offer and who have not yet selected a winner. 
define('REQUESTSELECTEDWINNER',getLanguage(619));
//No active requirements to be offered.
define('NOACTIVEREQ',getLanguage(620));
//There are requests to be made inactive to offer.
define('REQUESTTOBEMADE',getLanguage(622));
//Requests Parts offered to you but have been marked as resolved without a winning bid to be elected.
define('REQUESTHASBEENMARKED',getLanguage(621));
//All Brand logo
define('OURBRAND',getLanguage(629,0));