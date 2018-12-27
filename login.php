<?php include 'include/header.php';
unset($_SESSION['forgot_phase']);
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
	<div class="login-form">
	<form method="post" action="process/process.php?action=Do_login">
		<?php if(isset($_REQUEST['msg']) && $_REQUEST['msg']=='invalid'){
			?>
			<p class="text-center text-danger margin-top"><b>Error! Invalid Login detail. Try Again...</b></p>
			<?php
		}
		if(isset($_SESSION['succ_msg'])){
			?>
			<p class="text-center text-success"><b><?php echo $_SESSION['succ_msg']; ?></b></p>
			<?php
			} 
			unset($_SESSION['succ_msg']);
	    ?>
		
		<div class="field-login">
			<input type="text" required name="email" placeholder="Enter Email / Account ID / Phone Number" />	
		</div>
		<div class="field-login">
			<input type="password" required name="password" placeholder="Password">
			<p class="forget-pass"><a href="index.php" style="float:left">Change Login Mode</a><a href="forgot_password.php">Forget Password</a></p>
		</div>
		<div class="field-login">
			<input type="submit" value="Login" class="login-btn">
		</div>
		<p class="text-center create-link">
			Don't have an account? <a href="profile.php">Create account</a>
		</p>
	</form>
	</div>
  </div>
  
     
	

  </body>