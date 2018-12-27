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
					<h4 class="chat-name">Blocked Management</h4>
					
					<div class="public-profile">
					   <?php 
					   $datas=$db->check_blockedMine();
						if(mysqli_num_rows($datas)) {
						   if(isset($_REQUEST['keyword']) && $row['id']==$_SESSION['session_user_set']){
							   ?>
							   <p class="alert alert-info text-center">You Can Not Search Your Profile</p>
							   <?php
						   }
						   else 
						   {
							   
						 ?>
						
						
						<form action="profile-page.php" method="GET" >
						<div class="find-new">
							<input style="margin-bottom:15px;" type="text" required name="keyword" placeholder="Email / Account ID / Phone">
							<span class="search-ico"><a href="#"><i class="fa fa-search"></i></a></span>
						</div>
				        </form>
						<?php 
							
							while($rows=mysqli_fetch_assoc($datas))
							{
								$data1=$db->get_user_byId($rows['block_to']);
								$row1=mysqli_fetch_assoc($data1);
								?>
								<a href="profile-page.php?id=<?php echo $row1['id']; ?>">
								<div class="pub-pro">
									<img src="uploads/<?php echo $row1['profile']; ?>" alt="">
								</div>
								<div class="public-content">
									<p><?php echo $row1['fname']." ".$row1['lname']; ?></p>
									<p>Gender: <?php echo $row1['gender']; ?></p>
									<p>Country: <?php echo $row1['country']; ?></p>
									<p>Age: <?php echo $row1['age']; ?> Years</p>
								</div>
								</a>
								<?php
							}
						?>
						
						
					   <?php } }
						else {
						?>
						<p class="alert alert-danger">No Result Found</p>
						<?php
						} ?>
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>