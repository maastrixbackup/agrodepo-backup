<?php
$e='';
require_once WWW_ROOT.'sms_paymt/Mobilpay/Payment/Request/Abstract.php';
require_once WWW_ROOT.'sms_paymt/Mobilpay/Payment/Request/Sms.php';
#adresa catre care se face redirectarea la plata (test/productie)
$paymentUrl = 'http://sandboxsecure.mobilpay.ro';
//$paymentUrl = 'https://secure.mobilpay.ro';

#calea catre certificatul public 
#certificatul este generat de mobilpay, accesibil in Admin -> Conturi de comerciant -> Detalii -> Setari securitate
$x509FilePath = WWW_ROOT.'sms_paymt/public.cer';

try
{
	$objPmReqSms 				= new Mobilpay_Payment_Request_Sms();
	//$objPmReqSms->type			= 'sms';
	#merchant account signature - generated by mobilpay.ro for every merchant account
	#semnatura contului de comerciant - mergi pe www.mobilpay.ro Admin -> Conturi de comerciant -> Detalii -> Setari securitate
	$objPmReqSms->signature 	= '818X-VUQW-J8D7-KU6H-X8CX';
	#service/product identificator generated by mobilpay.ro for every service/product
	#semnatura contului de comerciant - mergi pe www.mobilpay.ro Admin -> Conturi de comerciant -> Produse si servicii -> Semnul plus
	$objPmReqSms->service 		= '009832-012917-079392';
	#supply return_url and/or confirm_url only if you want to overwrite the ones configured for the service/product when it was created
	#if you don't want to supply a different return/confirm URL, just let it null
	$objPmReqSms->returnUrl 	= $base_url.'UpgradeMemberships/failed'; //sau $objPmReqSms->returnUrl = '<new return url>';
	$objPmReqSms->confirmUrl 	= $base_url.'UpgradeMemberships/success'; //sau $objPmReqSms->confirmUrl = '<new confirm url>';
	#you should assign here the transaction ID registered by your application for this commercial operation
	#order_id should be unique for a merchant account
	srand((double) microtime() * 1000000);
	$objPmReqSms->orderId 		= md5(uniqid(rand()));
	$objPmReqSms->encrypt($x509FilePath);
}
catch(Exception $e)
{
}
?>
<div class="span-15 prepend-1">

<?php if(!($e instanceof Exception)):?>
<p>
	<form name="frmPaymentRedirect" id="frmPaymentRedirect" method="post" action="<?php echo $paymentUrl;?>">
	<input type="hidden" name="env_key" value="<?php echo $objPmReqSms->getEnvKey();?>"/>
	<input type="hidden" name="data" value="<?php echo $objPmReqSms->getEncData();?>"/>
	
	</form>
</p>
<!--
<script type="text/javascript" language="javascript">
	window.setTimeout(document.frmPaymentRedirect.submit(), 5000);
</script> -->
<?php else:?>
<p><strong><?php
//pr($e);
 echo $e->getMessage();?></strong></p>
<?php endif;?>
<script type="text/javascript">
	document.getElementById('frmPaymentRedirect').submit();</script>
