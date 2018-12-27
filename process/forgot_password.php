<?php include 'include/header.php';
 ?>
  <body>
  
  <div class="login-page">
  	<div class="login-header">
		<h3>SIGNIN</h3>
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
	<form method="post" id="forgot_phone" onsubmit="return reset_password();"  >
	<?php if(isset($_SESSION['succ_msg'])){
			?>
			<p class="text-center text-success"><b><?php echo $_SESSION['succ_msg']; ?></b></p>
			<?php
	} 
	unset($_SESSION['succ_msg']);
	?>
	<div class="login-form">
		<div class="field-login">
			<input type="text" name="mobile" required id="mobile_code"   placeholder="Mobile With Country Code" class="mobile-number-input phonevalidation"> 
			<div class="flag-sec">
				<img src="img/flag.png" class="flag">
			</div>
			<div class="verify-button">
				<button type="button" onclick="return otp_forgot();" class="btn btn-primary">Verify</button>
			</div>
		</div>
		<div class="field-login">
			<p class="text-center"><b>4 Digit OTP sent on number. Enter below</b></p>
			<input type="text" maxlength="4" name="otp" required placeholder="Enter OTP">
		</div>
		<div class="field-login">
			<input placeholder="Password" minlength="6" required name="password" type="password">
			<p class="forget-pass"><a href="forgot_mode.php" style="float:left">Reset Via Email</a><a href="index.php">Return To Login</a></p>
		</div>
		<div class="field-login">
			<input type="submit" value="Reset Password Now" class="login-btn">
		</div>
		<p class="text-center create-link">
			Don't have an account? <a href="verification.php">Create account</a>
		</p>
	</div>
	</form>
  </div>
  
     
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