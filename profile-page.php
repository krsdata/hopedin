<?php include 'include/header.php';
include 'include/head.php';
if(isset($_REQUEST['keyword']))
{
	$sel="select * from registration where (email LIKE '".$_REQUEST['keyword']."' or  account_id LIKE '".$_REQUEST['keyword']."' or mobile='".trim($_REQUEST['keyword'],"+")."')";
	$data=$db->query($sel);
	$row=mysqli_fetch_array($data);
	$image=$row['profile'];
}
else if(isset($_REQUEST['id']))
{
	$data=$db->get_user_byId($_REQUEST['id']);
	$row=mysqli_fetch_array($data);
	$image=$row['profile'];
}
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
					
					<?php $data1=$db->Get_my_friends();
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
						  while($row1=mysqli_fetch_array($data1))
						  {
							?>
							<li class="chat-selected"><a class="" data-id="<?php echo $row1['id']; ?>" href="profile-page.php?id=<?php echo $row1['id']; ?>"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span> <?php echo explode(" ",$row1['fname'])[0]; ?></a>  <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
							<?php
						  }
						  }
						  else 
						  {
							  ?>
							  <p class="alert alert-danger text-center">No Friends Yet!</p>
							  <?php
						  }
					?>
						
				</ul>
			</div>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Profile <a href="#"><i class="fa fa-share"></i></a></h4>
					
					<div class="public-profile">
					   <?php 
					    if(isset($_SESSION['succ_msg'])){
							?>
							<p class="alert alert-success text-center"><?php echo $_SESSION['succ_msg']; ?></p>
							<?php
							unset($_SESSION['succ_msg']);
						} 
					   if(mysqli_num_rows($data)) {
						   if(isset($_REQUEST['keyword']) && $row['id']==$_SESSION['session_user_set']){
							   ?>
							   <p class="alert alert-info text-center">You Can Not Search Your Profile</p>
							   <?php
						   }
						   else 
						   {
							  $ss_type=$_SESSION['session_user_type'];
							   
						 ?>
						<div class="pub-pro">
							<img src="uploads/<?= $image; ?>" alt="">
						</div>
						<div class="public-content">
							<?php if($row['user_type']=='school'){
								?>
							<p><?php echo $row['school_name']; ?></p>
							<p><?php echo $row['nationality']; ?></p>
							<p>School Level: <?php echo $row['int_education']; ?></p>
							<p>Founded On: <?php echo $row['founded_on']; ?></p>
								<?php
							} else { ?>
							<p><?php echo $row['fname']." ".$row['lname']; ?></p>
							<p>Gender: <?php echo $row['gender']; ?></p>
							<p>Country: <?php echo $row['country']; ?></p>
							<p>Age: <?php echo $row['age']; ?> Years</p>
							<?php } ?>
							<!--<p>Mobile: +8615579830172</p>
							<p>Email: eaglestar6115@gmail.com</p>-->
						</div>
						<div class="acr">
							<div class="panel-group" id="accordion">
							<?php 
							if(($ss_type=='student' and $row['user_type']=='school') || ($ss_type=='school' and $row['user_type']=='school')){
								?>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Website <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								
							<?php } 
							if($ss_type=='school' and $row['user_type']=='student'){
							?>
							<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Contact Info <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="profile-history.php">Set As Co-ordinator <span><a class="set-click" href="#">SET</a> </span> </a>
									</h4>
								  </div>
								  
								</div>
								
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Add To Teacher <span><label class="switch">
										<input type="checkbox" id="block_sets" onchange="return block_unblock(93);">
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
							<?php } 
							if($ss_type=='student' and $row['user_type']=='student'){
							?>
							<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Contact Info <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								
							<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Set As Guardian <span><label class="switch">
										<input type="checkbox" id="" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
							<?php } 
							
							if($ss_type=='school' and $row['user_type']=='school'){
							?>
							
							<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Add As Sub-Campus <span><label class="switch">
										<input type="checkbox" id="block_sets" onchange="return block_unblock(93);">
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
							<?php } ?>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="preference.php">Preference <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="privacy.php">Privacy <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="profile-history.php">History <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Add To Favorite <span><label class="switch">
										<input type="checkbox" id="" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <?php 
									  $checked="";
									  $req_data=$db->check_blocked($row['id']);
									  if(mysqli_num_rows($req_data))
									  {
										 $checked="checked";
									  }
									  ?>
									  <a>Block User <span><label class="switch">
										<input type="checkbox" <?php echo $checked; ?> id="block_sets" onchange="return block_unblock(<?php echo $row['id']; ?>);" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
							  </div> 
						</div>
						
						<div class="delete-user-btn">
							<?php if($row['id']==$_SESSION['session_user_set']){
								?>
								<a href="process/process.php?action=delete_account" onclick="return confirm('Are You want to delete Account?');">Delete Contact</a>
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
										<a class="chat-btn"  style="margin-bottom:3px;" href="dashboard.php?user=<?php echo $row['id']; ?>">Chat</a> 
										<!-- a class="chat-btn" data-toggle="modal" data-target="#msgModal" style="margin-bottom:3px;" href="javascript:void(0);">Chat</a --> 
										 <style>
										 .modal-backdrop
										 {
											 display:none;  
										 }
										 </style>
										<!-- Modal -->
										<div id="msgModal" style="top:20%;" class="modal fade" role="dialog">
										  <div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Send Message</h4>
											  </div>
											  <form method="post" id="chat_msg" onsubmit="return chat_start();" >
											  <div class="modal-body">
												<textarea id="chat_text" required name="msg" class="form-control"></textarea>
												<input type="hidden" id="reciver_id" value="<?php echo $row['id']; ?>" required name="rid">
												<input type="hidden" id="custom_mine" value="1" required >
											  </div>
											  <div class="modal-footer">
												<button type="submit" class="btn btn-success" >Send</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											  </div>
											  </form>
											</div>

										  </div>
										</div>
										<a class="" onclick="return confirm('Are you want to remove from contact?');" href="process/process.php?action=request_contact&key=<?php echo $_REQUEST['keyword']; ?>&id=<?php echo $req_row['id']; ?>" >Delete Contact</a>
										<?php
									}
									else if($req_row['status']==2)
									{
										?>
										<a class="my_btn<?php echo $row['id']; ?>"  data-id="<?php echo $row['id']; ?>" href="javascript:void(0);"><i class="fa fa-ban" aria-hidden="true"></i> Blocked</a>
										<?php
									}
									else 
									{
										?>
										<a class="add_new_friend my_btn<?php echo $row['id']; ?>"  data-id="<?php echo $row['id']; ?>" href="javascript:void(0);">+ Send Friend Request</a>
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