<span style="color: #f00; font-size: 13px; left: 30px; position: absolute; top: 157px; width: 100%;" id="e_error"> &nbsp;</span>

<a href=<?php echo $this->webroot.'MasterUsers/add'?>>
<?php 
	echo "Registration";
	echo "</a><br>";
?>
<a href=<?php echo $this->webroot.'MasterUsers/login'?>>
<?php echo "Login</a><br>";	?>

<a href=<?php echo $this->webroot.'MasterUsers/forgot_password'?>>
<?php echo "Forgot Password</a><br/>";	?>

<a href="javascript:void(0);" onclick="fb_login('fbsgnup');"><p class="facebook-bg">Sign up with Facebook</p></a><br/>
<!--a href="javascript:void(0);" onclick="fb_login('fbsgnin');"><p class="facebook-bg">Sign in with Facebook</p></a-->

<script type="text/javascript">
		/*****************START FOR FACEBOOK CODE***************************************/  

	window.fbAsyncInit = function() {
	
		/* 	  FB.init({
		appId      : '311541335710624', // App ID
		channelUrl : 'http://localhost', // Channel File
		status     : true, // check login status
		cookie     : true, // enable cookies to allow the server to access the session
		xfbml      : true  // parse XFBML
		});
		*/
	
		FB.init({
			appId      : '734120263300172', // App ID 1496676653930391
			channelUrl : 'http://maasinfotech24x7.com/greenbrooksv2/', // Channel File
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			xfbml      : true  // parse XFBML
		});
		
		FB.Event.subscribe('auth.authResponseChange', function(response) {
			// Here we specify what we do with the response anytime this event occurs.
			
			if (response.status === 'connected') {
				testAPI();
			} else if (response.status === 'not_authorized') {
				FB.login();
			} else {
				FB.login();
			}
		});
	};

	// Load the SDK asynchronously
	(function(d){
		var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement('script'); js.id = id; js.async = true;
		js.src = "http://connect.facebook.net/en_US/all.js";
		ref.parentNode.insertBefore(js, ref);
	}(document));

	// Here we run a very simple test of the Graph API after login is successful. 
	// This testAPI() function is only called in those cases.
  
	function fb_login(type){
	 
		FB.login(function(response) {
		
			if (response.authResponse){
				console.log('Welcome!  Fetching your information.... ');
				//console.log(response); // dump complete info
				access_token = response.authResponse.accessToken; //get access token
				user_id = response.authResponse.userID; //get FB UID
				var userInfo = document.getElementById('user-info');  
				FB.api('/me', function(response) {
				if(response)
				{
			
				/* 
			alert(response.email);
			for(var key in response) {
			alert('key: ' + key + '\n' + 'value: ' + response[key]);
			}
			*/
			//document.getElementById('facebook_login_error').innerHTML='<img src="<?php echo $this->webroot ?>img/ajax-loader-small.gif"  style="margin-top:10px;"/>';
				
					var rootpath='<?php echo $this->webroot; ?>';
					switch(type){
						
						case'fbsgnup':
							$.ajax({
							type: "POST",
							//url: <?php echo $this->webroot.'MasterUsers/facebookregistrationprocess'?>,
							url: rootpath+"MasterUsers/facebookregistrationprocess/",
							data:"email="+response.email+"&name="+response.name,
								success: function(res){
							
									if(res=='ok'){
										
										//$("#signupinbox").hide(500);
										//$("#emailconfbox").toggle(500);
										//document.getElementById('email_content').innerHTML=response.email;
									}else if(res=='avl'){					
										document.getElementById('e_error').innerHTML='Email already exists';
									}
								}
							});
							break;
						case'fbsgnin':
							$.ajax({
								type: "POST",
								url: <?php echo $this->webroot.'MasterUsers/signinprocess/'?>,
								//url: rootpath+"Homes/signinprocess/",
								data:"signin_email="+response.email+"&link="+response.link+"&name="+response.name+"&type=fb",
								success: function(res)
								{
									if(res=='ok'){
										//document.location='<?php echo $this->webroot;?>';
										window.location.reload();
									}else{
									
										document.getElementById('e_error').innerHTML='Incorrect email or password. Please try again or click \'Don\'t know your password\'.';
										document.getElementById('e_error').innerHTML='';
									}
								}
							});
							break;
						}
			
					}else{
						FB.logout(function(response){
						console.log(response);
					});
				}           
			});
		} else {
			//user hit cancel button
			console.log('User cancelled login or did not fully authorize.');
		}
		}, {
			scope: 'public_profile,email'
			//scope: 'publish_stream,email,user_birthday,user_hometown,user_location,user_photos,user_name,user_website'
		});
	}
	/*****************END FOR FACEBOOK CODE***************************************/  
</script>