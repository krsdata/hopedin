<?php include 'include/header.php';
include 'include/head.php'; 
//test
?>
  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<?php include 'include/profile_menu.php';			?>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Account Management <span style="float:right; margin-left:15px;"><a href="javascript:void(0);" onclick="$('#profile_submit').trigger('click');" >Save <svg class="svg-inline--fa fa-check fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg><!-- <i class="fa fa-check"></i> --></a></span></h4>
					
					<div class="public-profile genral-profile-acc signup-form">
					   <?php if(mysqli_num_rows($data)) {
						   if(isset($_REQUEST['keyword']) && $row['id']==$_SESSION['session_user_set']){
							   ?>
							   <p class="alert alert-info text-center">You Can Not Search Your Profile</p>
							   <?php
						   }
						   else 
						   {
							   
						 ?>
						
						<div class="account-barcode">
							<h3>Change Email Address</h3>
						</div>
					<form method="post" id="change_email" onsubmit="return change_subemail();">	
					<div class="genral-information-section">
							
						<div class="field-login sign-input">
						<label>Enter Email Address</label>
						<input type="email" class="" required name="email" placeholder="Registered Email">
						</div>
						<div class="field-login sign-input">
						<label>Enter ASP Pin</label>
						<input class="" required name="asp_pin" placeholder="Enter ASP Pin">
						</div>
						<div class="field-login sign-input">
						<label>Enter New Email Address</label>
						<input type="email" required="" name="new_email" placeholder="Enter New Email">
						
						</div>
						<button type="submit" id="profile_submit" style="display:none">Save</button>
					</div>
					</form>
						<div class="acr">
							<div class="panel-group account-view" id="accordion">
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Account Number: <?php echo $row['account_id']; ?> <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Account Type: <span class="upper_case"><?php echo $row['user_type']; ?></span> Account <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Reg. Date: <?php echo date('d F Y',strtotime($row['cdate'])); ?> <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Last Login Activity: <?php echo date('d F Y',strtotime($row['last_login'])); ?> <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								
							  </div> 
						</div>
						
						<div class="delete-user-btn">
							<?php if($row['id']==$_SESSION['session_user_set']){
								?>
								<a href="process/process.php?action=delete_account" onclick="return confirm('Are You want to delete Account?');">Delete Profile</a>
								<?php
							}
							else {
								$req_data=$db->Check_friends_request($row['id']);
								if(mysqli_num_rows($req_data))
								{
									$req_row=mysqli_fetch_assoc($req_data);
									if($req_row['status']==1)
									{
										?>
										<a class="" href="javascript:void(0);">Chat</a>
										<a class="" href="javascript:void(0);">Delete Contact</a>
										<?php
									}
									else 
									{
										?>
										<a class="" href="javascript:void(0);">Requested</a>
										<?php
									}
								}
								else {
									?>
									<a class="add_new_friend my_btn<?php echo $row['id']; ?>"  data-id="<?php echo $row['id']; ?>" href="javascript:void(0);">+ Send Friend Request</a>
									<?php
								}
								
							}
							?>
							
						</div>
					   <?php } }
						else {
						?>
						<p class="alert alert-danger">No Result Found For '<?php echo $_REQUEST['keyword']; ?>'</p>
						<?php
						} ?>
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>