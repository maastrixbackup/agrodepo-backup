 <div class="clearfix" style="height:5px;"></div>
  <footer id="footer">
    <div class="container">
        <div class="col-md-3">
          <div class="block-subscribe">
            <div class="block-content">
              <img src="<?php echo $this->webroot ?>images/footerlogo.png" border="0" class="trade-alert" style="width: 100%;">
              <br>
              <span class="info" id="actionMessage_newsletter">
             <?php echo NEWSLETTER;?>
              </span>
             <!-- <form name="Newsletter" id="newsletter_form_box" method="post" action="MasterUsers/add_newsletter">
                <input type="text" class="form-control"  placeholder="Nume utilizator" name="user_name">
                <input type="email" class="form-control"  placeholder="Adresa email" name="user_email">
                <input type="submit" name="Submit2" value="SUBSCRIBE NOW" class="newsletter_snd_btn">
              </form>-->


               <?php
			echo $this->Form->create('NewsLetter', array('id'=>'newsletterfrm'));
 echo $this->Form->input('news_name',array('label'=>false,'placeholder'=>USERNAME,'class' => 'form-control', 'required' =>  false, 'div' => false));
					echo $this->Form->input('news_email',array('label'=>false,'placeholder'=>EMAIL, 'required' =>  false,'class' => 'form-control', 'div' => false));  ?>
				<input type="button" name="Submit2" value="<?php echo SUBSCRIBENOW;?>" class="newsletter_snd_btn addnewsletter"><span id="newsprocessing" style="color:#579B39; display:none"><?php echo PROCESSING; ?></span>
              </form>
              <span id="newsmsg"></span>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <span class="title">
          Dezmembraripenet.ro
		  </span>
          <ul>
            <li><a href="<?php echo $base_url;?>piese-auto">Piese Auto</a></li>
           <li><a href="<?php echo $base_url;?>pages/request-parts">Cereri Piese</a></li>
           <li><a href="<?php echo $base_url;?>pages/truck-parks">Parcuri dezmembrări</a></li>
           <li><a href="<?php echo $base_url;?>pages/company-parts">Firme piese</a></li>
          </ul>
      </div>
        <div class="col-md-2">
          <span class="title">
          <?php echo CATEGORI;?>
		  </span>
           <?php
		  $catlist=$this->Custom->bapCustUnicategoryList(8);
		 // echo $this->Html->nestedList($catlist);
		 if(!empty($catlist))
		 {
			 ?>
             <ul>
             <?php
			 foreach($catlist as $categoryResult)
			 {
			 	if(trim($categoryResult['SalesCategory']['slug'])!=''){
                     $catPath=$base_url.'category/'.$categoryResult['SalesCategory']['slug'];
                     $catSlug=$categoryResult['SalesCategory']['slug'];
                 }else{
                    $catPath=$base_url.'category/'.$categoryResult['SalesCategory']['category_id'];
                     $catSlug=$categoryResult['SalesCategory']['category_id'];
                 }
                 $catVal= stripcslashes($categoryResult['SalesCategory']['category_name']);
				?>
                <li><a href="<?php echo $catPath;?>"><?php echo $catVal;?></a></li>
                <?php
			 }
			 ?>
             </ul>
             <?php
		 }
		  ?>

      </div>
        <div class="col-md-3">
          <span class="title">
          <?php echo BRAND;?></span>
           <?php
		  $brandlist=$this->Custom->bapCustUnibrandList(8);
		 // echo $this->Html->nestedList($catlist);
		 if(!empty($brandlist))
		 {
			 ?>
             <ul>
             <?php
			 foreach($brandlist as $brandid => $brandResult)
			 {
			 	if(trim($brandResult['ManageBrand']['slug'])!=''){
                     $brandPath=$base_url.'brand/'.$brandResult['ManageBrand']['slug'];
                 }else{
                    $brandPath=$base_url.'brand/'.$brandResult['ManageBrand']['brand_id'];
                 }
                 $brandVal= stripcslashes($brandResult['ManageBrand']['brand_name']);
				?>
                <li><a href="<?php echo $brandPath;?>"><?php echo $brandVal;?></a></li>
                <?php
			 }
			 ?>
             </ul>
             <?php
		 }
		  ?>
      </div>
      <div class="col-md-2">
          <span class="title">
          <?php echo SOCIALICON;?>
          </span>
        <div class="social">
        	<?php $social_icon = $this->Custom->getSoicalIcon();
			if(!empty($social_icon))
			{
			foreach($social_icon AS $sc_icon){
				$social_icn=$sc_icon['SocialIcon'];
				$icon_img=$social_icn['social_img'];
				?>
				<a href="<?php echo $social_icn['social_link']; ?>" target="_blank" >
            <img src="<?php echo $this->webroot."files/socialicon/".$icon_img; ?>" width="25" border="0" title="<?php   echo $social_icn['social_name']; ?>">
           <?php   echo $social_icn['social_name']; ?></a>
				<?php
				}
			}

			?>
            </div>
      </div>
    </div>

      <div class="bottom">
        <div class="container">
          <div class="col-md-12">
            Copyright © 2014 Dezmembraripenet.ro ™ All Rights Reserved
            &nbsp;
            <a href="http://dezmembraripenet.ro/" target="_blank" title="Dezmembraripenet">
            www.Dezmembraripenet.ro            </a>
            <p class="disclaimer">
              All Offers/Products/Company Profiles/Images and other user-posted contents are posted by the user and Dezmembraripenet.ro shall not be held liable for any such content. However, Dezmembraripenet.ro respects the intellectual property, copyright, trademark, trade secret or any other personal or proprietary third party rights and expects the same from others. To see our intellectual property policy and for infringement claims.            </p>
          </div>
        </div>
    </div>
    </footer>
 <?php if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' && (in_array('subscribe',$this->request->params['pass']))){?>

 <?php }else{?>

	<script src="<?php echo $this->webroot ?>js/bootstrap.js"></script>
	<?php }?>

      <?php if($this->request->params['controller']!='Search' && $this->request->params['controller']!='Logins' && $this->request->params['controller']!='RequestParts' && $this->request->params['controller']!='PostAds' && $this->request->params['controller']!='pages'){
?>
    <script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
    </script>
    <?php }?>
    <?php if(($this->request->params['controller']=='RequestParts' && $this->request->params['action']=='request_response')){
?>
<?php echo count($user_resp);?>
    <script type="text/javascript">
	$(document).ready(function() {
	var cnt="<?php echo count($user_resp);?>";
	cnt=parseInt(cnt);
	if(cnt>0)
	{
		for(var k=1; k<=cnt; k++)
		{
			var incr_val="Accordion"+k;
			var incr_val = new Spry.Widget.Accordion("Accordion"+k);
		}
	}

	});
    </script>
    <?php }?>


  <?php if(($this->request->params['controller']=='Logins' && $this->request->params['action']=='user_dashboard')|| ($this->request->params['controller']=='MasterUsers' && $this->request->params['action']!='add') || ($this->request->params['controller']=='pages' && ((isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='profile-img') || (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='compose-message') || (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='subscribe') || (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='success-stories') || (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='success-stories-list')))){?>
  <?php if($this->request->params['controller']=='pages' && $this->request->params['action']=='slugName' && (in_array('subscribe',$this->request->params['pass']))){?>

 <?php }else{?>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <?php }?>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/velocity/0.2.1/jquery.velocity.min.js'></script>
    <script src="<?php echo $this->webroot ?>js/mtree.js" type="text/javascript"></script>
    <?php }?>
    <script type="text/jscript">
	$(document).ready(function() {
        $(".addnewsletter").click(function() {
            var NewsLetterNewsName=$("#NewsLetterNewsName").val();
			var NewsLetterNewsEmail=$("#NewsLetterNewsEmail").val();
			var filter=/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
			var blanktest=/\S/;
			if((!blanktest.test(NewsLetterNewsName)) || (!blanktest.test(NewsLetterNewsEmail)) || (!filter.test(NewsLetterNewsEmail)))
			{
				if(!blanktest.test(NewsLetterNewsName))
				{
					$("#NewsLetterNewsName").focus();
					$("#NewsLetterNewsName").css("background-color", "rgb(245, 211, 211)");
					return false;
				}
				else
				{
					$("#NewsLetterNewsName").css("background-color", "");
				}
				if(!blanktest.test(NewsLetterNewsEmail))
				{
					$("#NewsLetterNewsEmail").focus();
					$("#NewsLetterNewsEmail").css("background-color", "rgb(245, 211, 211)");
					return false;
				}
				else if(!filter.test(NewsLetterNewsEmail))
				{
					$("#NewsLetterNewsEmail").focus();
					$("#NewsLetterNewsEmail").css("background-color", "rgb(245, 211, 211)");
					return false;
				}
				else
				{
					$("#NewsLetterNewsEmail").css("background-color", "");
				}
			}
			else
			{
				$("#newsprocessing").show();
				$.ajax(
				{
					type: 'POST',
					url: '<?php echo $base_url; ?>Homes/newsletter',
					data: $("#newsletterfrm").serialize(),
					success: function(data) {
						if(data==1)
						{
							$("#newsmsg").html('<font color="#82C241"><?php echo $successMsg;?></font>');
							$("#newsprocessing").hide();
						}
						else if(data==2)
						{
							$("#newsmsg").html('<font color="#f77e1c"><?php echo $failMsg;?></font>');
							$("#newsprocessing").hide();
						}
						else if(data==3)
						{
							$("#newsmsg").html('<font color="#f77e1c"><?php echo $emailExist;?></font>');
							$("#newsprocessing").hide();
						}
					}
				});
			}
        });
    });
	<?php

		if(isset($this->request->params['named']['confirm']) && $this->request->params['named']['confirm']==1)
		{
			?>
			alert("<?php echo $verisuccessMsg;?>");
			<?php
			//$this->Session->delete('confirmmsg');
		}
		elseif(isset($this->request->params['named']['confirm']) && $this->request->params['named']['confirm']==0)
		{
			?>
			alert("<?php echo $verifailMsg;?>");
			<?php
			//$this->Session->delete('confirmmsg');
		}
	?>
	</script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5864afa0e7588f12124dc4de/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>
</html>
