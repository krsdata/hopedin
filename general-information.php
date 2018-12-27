<?php include 'include/header.php';
include 'include/head.php';

$data=$db->get_user();
$row=mysqli_fetch_array($data);
?>
    
  
  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<?php include 'include/profile_menu.php';
			?>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">General Information</h4>
					
					<div class="public-profile">
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
							<img src="img/bar-code.jpg" style="height:  200px; margin:  0 auto; display:  block;">
						</div>
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