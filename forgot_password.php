<?php include 'include/header.php';
if(isset($_SESSION['forgot_phase']))
{
	?>
	<style>
	.phase1
	{
		display:none !important;
	}
	.phase2
	{
		display:block !important;
	}
	</style>
	<?php
}
 ?>
  <body>
  
  <div class="login-page">
  	<div class="login-header">
		<h3>Forget Password</h3>
	</div>
	
	
	<form method="post" id="forgot_phone" onSubmit="return reset_password();"  >
	
	<div class="login-form">
		<div class="phase1">
			<div class="field-login">
				<input placeholder="Enter Email / Account Id / Phone" class="" id="user_emails"  name="email" type="text" />
				
			</div>
			
			<div class="field-login">
				<input placeholder="Enter ASP Pin" class="phonevalidation" id="phase_afp"  name="afp_pin" type="text" />
				<p class="forget-pass"><a href="forgot_asp.php" style="float:left">Forget ASP</a><a href="index.php">Return To Login</a></p>
			</div>
			
			<div class="field-login">
				<input value="Next" onClick="return forgot_phase();" class="login-btn" type="button" />
			</div>
		</div>
		<div class="phase2" style="display:none;">
			<div class="field-login select-country">
			</div>
			<div class="field-login phase_step1" style="text-align:center;">
				<input type="button" value="Send OTP on Mobile" onClick="return otp_forgot();" class="login-btn btn-verifys" style="background: #86162d;margin-bottom: -40px;">
				<input type="text" value="+86" name="mobile" style="display:none;" id="mobile_code"   placeholder="" class="mobile-number-input phonevalidation"> 
				<div class="verify-button" style="display:none;">
					<button type="button"  class="btn btn-primary">Verify</button>
				</div>
				<br>
				<br>
			</div>
			
			<div class="field-login phase_step1">
				<input type="text" maxlength="4" id="mobile_otp" name="otp" required placeholder="Enter OTP Received On Mobile">
			</div>
			
			<div class="field-login phase_step1">
				
				<p class="forget-pass"><a href="forgot_mode.php" style="float:left">Reset Via Email</a><a href="index.php">Return To Login</a></p>
			</div>
			<div class="field-login phase_step1">
				<input type="button" value="Verify" onClick="return check_password('mobile');" class="login-btn">
			</div>
			
			<div class="field-login phase_step2" style="display:none;">
				<input placeholder="Enter New Password" minlength="6" required id="cnpass" name="password" type="password">
				<input placeholder="Confirm Password" minlength="6" required id="cspass" type="password">
				<p class="forget-pass"><a href="index.php">Return To Login</a></p>
			</div>
			
			<div class="field-login phase_step2" style="display:none;">
				<input type="submit" value="Update Password" class="login-btn">
			</div>
		</div>
		
		<p class="text-center create-link">
			Don't have an account? <a href="verification.php">Create account</a>
		</p>
	</div>
	</form>
  </div>
  
     
	<script src="build/js/intlTelInput.js"></script>
    <script>
    $("#mobile_code1").intlTelInput({
		preferredCountries: ['cn', 'pk'],
		//separateDialCode: true,
      utilsScript: "build/js/utils.js"
    });
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