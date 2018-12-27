<?php include 'include/header.php';
include 'include/head.php';
?>
  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<?php include 'include/friend_menu.php'; ?>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Friend Requests</h4> 
					<div class="public-profile">
						<?php if(isset($_SESSION['succ_msg'])){
							?>
							<p class="alert alert-success"><?php echo $_SESSION['succ_msg']; ?></p>
							<?php
							unset($_SESSION['succ_msg']);
						} ?>
						<div class="acr">
							<div class="panel-group"> 
							    <?php $data=$db->Get_my_requests(); 
								$count=mysqli_num_rows($data);
								if($count)
								{
									while($row=mysqli_fetch_assoc($data))
									{
									?>
									<div class="panel panel-default">
									  <div class="panel-heading">
										<a href="freind-verify.php?info=<?php echo $row['id']; ?>">
										<h4 class="panel-title">
										  <span class="pic-req"><img src="uploads/<?php echo $row['profile']; ?>"></span>
										  <span class="req-name"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></span>
										  
										  <span class="go-angel"><b style="color:red; margin-right:15px;">Requested</b> <i class="fa fa-angle-right"></i></span>
										</h4>
										</a>
									  </div>
									  
									</div>
									<?php
									}
								}
								else 
								{
									?>
									<p class="alert alert-danger">No Requests Yet!</p>
									<?php
								}
								?>
								
								
						<!--div class="panel panel-default">
								  <div class="panel-heading">
									<a href="freind-request-verify.php">
									<h4 class="panel-title">
									  <span class="pic-req"><img src="img/profile_photo.jpg"></span>
									  <span class="req-name">John Smith</span>
									  
									  <span class="go-angel"><b class="added-frq" style="margin-right:15px;">Added</b> <i class="fa fa-angle-right"></i></span>
									</h4>
									</a>
								  </div>
								  
								</div -->
	
						</div> 
						</div>
						
						
						
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
    
	

  </body>