<?php include 'include/header.php';
//echo $_SESSION['session_type'];
//print_r($_SESSION);
//die;
unset($_SESSION['session_type']);
?>
  <body>
  
  <div class="login-page">
  	<div class="login-header">
		<h3>Signup As</h3>
	</div>
	
	<form method="post" action="verification.php" >
	<div class="login-form">
		<div class="field-login select-country">
		</div>
		
		<div class="field-login col-sm-3" style="text-align:center; margin-left: 37.5%;">
			<select required name="user_type" class="form-control step-first-select" >
				<option value="">Select signup As</option>
				<option value="student">Student / Teacher</option>
				<!--<option value="teacher">Teacher</option>-->
				<option value="school">School</option>
			</select>
		</div>
		<br/><br/>
		
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


  </body>