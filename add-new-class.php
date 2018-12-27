<?php include 'include/header.php';
include 'include/head.php';
?>
  
  
  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 side-menu">
				<?php include 'include/session_left.php'; ?>
			</div>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Add New Class</h4>
					
					<div class="public-profile">
						<form method="post" id="session_form" onsubmit="return session_step(2);">	
							<div class="signup-form">
								<?php include 'include/add_class_inner.php'; ?>
							</div>
							<div class="login-form">
							<div class="field-login">
								<input type="submit" id="session_btn" value="Next" class="login-btn">
							</div>
							</div>
						</form>
							
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>