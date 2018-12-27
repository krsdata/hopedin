<?php include 'include/header.php';
include 'include/head.php';
?>
    
  
  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<?php include 'include/profile_menu.php';
			?>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Password Management<span style="float:right; margin-left:15px;"><a href="javascript:void(0);" onclick="$('#profile_submit').trigger('click');">Save <i class="fa fa-check"></i></a></span>
					 </h4>
					
					<div class="public-profile genral-profile-acc signup-form">
					   
				<form method="post" onsubmit="return password_submit();" id="password_form" >	
				  <div class="genral-information-section">
							
					<div class="field-login sign-input">
					<label>Enter Old Password</label>
					<input type="password" required  name="old_password" Placeholder="Old Password">
					<span class="input-icon"><i class="fa fa-user"></i></span>
					</div>
					<div class="field-login sign-input">
					<label>Enter New Password</label>
					<input type="password" required minlength="6" name="password" Placeholder="New Password">
					<span class="input-icon"><i class="fa fa-user"></i></span>
					</div>
				    </div>
				   <button type="submit" id="profile_submit" style="display:none" >Save</button>
				</form>
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>