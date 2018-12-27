<?php include 'include/header.php';
unset($_SESSION['mobileNumber']);
if(isset($_POST['user_type']))
{
	$_SESSION['session_type']=$_POST['user_type'];
}
if(!isset($_SESSION['session_type']))
{
	echo "<script>window.location.href='step_first.php';</script>";
	die;
}
?>
  <body>
  
  <div class="login-page">
  	<div class="login-header">
		<h3>Verify Your Mobile Number</h3>
	</div>
	
	<form method="post" id="Do_send_otp" onsubmit="return verify_otp();" enctype="multipart/form-data" >
	<div class="login-form">
		<div class="field-login select-country">
		</div>
		
		<div class="field-login" style="text-align:center;">
			<input id="mobile_code" required name="mobile" value="+86" autocomplete="off" type="tel" class="mobile-number-input phonevalidation" placeholder="" >
			
			<div class="verify-button">
				<button type="button" onclick="return Do_send_otp();" class="btn btn-primary">Verify</button>
			</div>
		</div>
		<br/><br/>
		
		<div class="field-login">
			<input type="text" maxlength="4" name="otp" required placeholder="Enter OTP">
		</div>
		<div class="field-login">
			<input type="submit" value="Next" class="login-btn">
		</div>
		<p class="text-center create-link">
			Already have an account? <a href="index.php">Login</a>
		</p>
	</div>
	</form>
  </div>
  
     
	<script src="build/js/intlTelInput.js"></script>
    <script>
    $("#mobile_code").intlTelInput({
		preferredCountries: ['cn', 'pk'],
		//separateDialCode: true,
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: "body",
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
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