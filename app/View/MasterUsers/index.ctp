<span style="color: #f00; font-size: 13px; left: 30px; position: absolute; top: 157px; width: 100%;" id="e_error"> &nbsp;</span>

<a href=<?php echo $this->webroot.'MasterUsers/add'?>>
<?php 
	echo "Registration";
	echo "</a><br>";
?>
<a href=<?php echo $this->webroot.'Logins/login'?>>
<?php echo "Login</a><br>";	?>

<a href=<?php echo $this->webroot.'MasterUsers/forgot_password'?>>
<?php echo "Forgot Password</a><br/>";	?>

<!--a href="javascript:void(0);" onclick="fb_login('fbsgnup');"><p class="facebook-bg">Sign up with Facebook</p></a><br/-->
<fb:login-button scope="public_profile,email" onlogin="checkLoginState('user');" class="wdfb_login_button">
    </fb:login-button> 

<!--a href="javascript:void(0);" onclick="fb_login('fbsgnin');"><p class="facebook-bg">Sign in with Facebook</p></a-->
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
/*****************START FOR FACEBOOK CODE***************************************/  

	var str_logout=0;
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response,loginby) {
   // console.log('statusChangeCallback');
    //console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI(loginby);
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
     // document.getElementById('status').innerHTML = 'Please log ' +'into this app.';
    } else {
		
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
    <?php /*?>  document.getElementById('status').innerHTML = 'Please log ' +
        'in with Facebook.';<?php if(isset($_SESSION["login_by"]) && $_SESSION["login_by"]!=""){?>
	
	  $.post('<?php echo get_bloginfo('template_directory'); ?>/custom/utils.php?site_session=destroy',function(success)
	  {	  	  
	  location.reload();
	  });
	<?php }?><?php */?>
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState(loginby) {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response,loginby);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '734120263300172', //734120263300172
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.0' // use version 2.0
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
	  var loginby='notauser';
    statusChangeCallback(response,loginby);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI(loginby) {
    FB.api('/me', function(response) { 
	  //var profilepic="http://graph.facebook.com/"+response.id+"/picture?type=large";
	 // console.log(response);
	  var rootpath='<?php echo $this->webroot; ?>';
		$.ajax({
			type: "POST",
			//url: <?php echo $this->webroot.'MasterUsers/facebookregistrationprocess/'?>,
			url: rootpath+"MasterUsers/facebookregistrationprocess/",
			data:"email="+response.email+"&name="+response.first_name,
				success: function(res){
					console.log(res);
					
				}
			});
    });
  }
	   
	   function fblogout(logoutby){
		FB.logout(function(response) {});
	}


/*****************END FOR FACEBOOK CODE***************************************/  
</script>