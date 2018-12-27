<?php include 'include/header.php';
include 'include/head.php';
?>
    
  
  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 side-menu">
				<div class="search-menu">
					<input type="text" placeholder="Search here">
					<span class="search-ico"><a href="#"><i class="fa fa-search"></i></a></span>
				</div>
				<ul class="side-menu-list">
					<li><a href="general-information.php"><span class="menu-icon"><i class="fa fa-search-plus"></i></span> General Information</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="profile-management.php"><span class="menu-icon"><i class="fa fa-user-plus"></i></span> </span> Profile Management</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="account-privacy.php"><span class="menu-icon"><i class="fa fa-users"></i></span> Privacy</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="asp-pin.php"><span class="menu-icon"><i class="fa fa-podcast"></i></span> Asp Pin Management</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="password-management.php"><span class="menu-icon"><i class="fa fa-tags"></i></span> Password Management</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="blocked-contact.php"><span class="menu-icon"><i class="fa fa-tags"></i></span> Blocked Contact</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="account-management.php"><span class="menu-icon"><i class="fa fa-tags"></i></span> Account Management</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
				</ul>
			</div>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Account Detail</h4>
					
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
									  <a href="">Account Number: 40031825603 <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Account Type: ST Account <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Reg. Date: 25th March 2018 <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Last Login Activity: 25th March 2018 <span><i class="fa fa-angle-right"></i></span></a>
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