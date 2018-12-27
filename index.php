<?php include 'include/header.php';
unset($_SESSION['forgot_phase']);

 $clientsIpAddress = $_SERVER['REMOTE_ADDR'];
 /*$ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, 'https://ipapi.co/'.$clientsIpAddress.'/timezone/');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 echo $contents = curl_exec($ch);
 curl_close($ch);*/
//echo file_get_contents('https://ipapi.co/'.$clientsIpAddress.'/timezone/');
//$db->query("update registration set zone='+5:30' ");
 ?>
  <body>
  
  <div class="login-page">
  	<div class="login-header">  
		<h3>Sign In</h3> 
	</div>
	<div class="social-btn text-center" style="padding-top:30px;">
		<div class="login-facebook">
			<a href="#"><i class="fa fa-facebook"></i> Login With Facebook</a>
		</div>
		<div class="login-linkedin">
			<a href="#"><i class="fa fa-linkedin"></i> Login With Linkedin</a>
		</div>
		<div class="login-google">
			<a href="#"><i class="fa fa-google"></i> Login With Google</a>
		</div>
		<div class="text-center">
			<img src="img/or.png" alt="">
		</div>
	</div>
	<form method="post" action="process/process.php?action=Do_login_mob" >
	<?php if(isset($_REQUEST['msg']) && $_REQUEST['msg']=='invalid'){
			?>
			<p class="text-center text-danger"><b>Error! Invalid Login detail. Try Again...</b></p>
			<?php
	} ?>
	
	<div class="login-form" >
		<div class="field-login" style="text-align:center; margin-top:15px;" >
			<input type="text" id="mobile_code" autocomplete="off" placeholder="Enter Your Mobile Number"  name="mobile" required value="+86" class="mobile-number-input mymobile phonevalidation" >
		</div>
		<div class="field-login">
			<input placeholder="Enter Password" required name="password" type="password">
			<p class="forget-pass"><a href="login.php" style="float:left">Change Login Mode</a><a href="forgot_password.php">Forget Password</a></p>
		</div>
		<div class="field-login">
			<input type="submit" value="Login" class="login-btn">
		</div>
		<p class="text-center create-link">
			Don't have an account? <a href="verification.php">Create account</a>
		</p>
	</div>
	</form>
  </div>
  
    
	<script src="build/js/intlTelInput.js"></script>
    <script>
    $("#mobile_code").intlTelInput({
		preferredCountries: ['cn', 'pk'],
		//separateDialCode: true,
        utilsScript: "build/js/utils.js"
    });
  </script>
	<script>
	function sendotp()
	{
		var mobile =$('.mymobile').val();
		$.ajax({
			url:"process/process.php?action=sendotp",
			type:"POST",
			data:{'mobile':mobile},
			success:function(data)
			{
				$('.mymobile').hide();
				$('.opt_feild').show();
				$('#opt_form').attr('onsubmit','return verifyopt();');
				return false;
			}
		});
		return false;
	}
	function verifyopt()
	{
		var otp =$('.opt_feild').val();
		if(otp)
		{
		$.ajax({
			url:"process/process.php?action=verifyopt",
			type:"POST",
			data:$('#opt_form').serialize(),
			success:function(data)
			{
				var data=$.trim(data);
				if(data=='1')
				{
					window.location.href='dashboard.php';
				}
				else
				{
					alert('Invalid OTP. Try Again...');
					$('.opt_feild').focus();
					return false;
				}
				
			}
		});
		return false;
		}
		else
		{
			alert('Enter OTP');
			return false;
		}
		return false;
		
	}
	</script>
	<script>

	$(document).ready(function(){
		$(".phonevalidation").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        } 
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    }); 
	

	});

	</script>

  </body>