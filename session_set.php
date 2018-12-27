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
					<h4 class="chat-name">Active Session</h4>
					
					<div class="public-profile">
						<?php if(isset($_SESSION['succ_msg'])){
							?>
							<p class="alert alert-success"><?php echo $_SESSION['succ_msg']; ?></p>
							<?php
							unset($_SESSION['succ_msg']);
						} else if(isset($_SESSION['err_msg'])) {
							?>
							<p class="alert alert-danger"><?php echo $_SESSION['err_msg']; ?></p>
							<?php
							unset($_SESSION['err_msg']);
						} ?>
						<div class="acr">
							<div class="panel-group" id="accordion">
								<?php $ses_data=$db->session_school($_SESSION['session_user_set']); 
								if(mysqli_num_rows($ses_data))
								{
									while($ses_row=mysqli_fetch_assoc($ses_data))
									{
									
								?>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title" style="text-align:center;">
									  <a href="session_inner.php?info=<?php echo $ses_row['id']; ?>"><i class="far fa-calendar-alt" style="float:left; margin-top:3px; margin-right:15px;"></i><span style="float:left;"><?php echo $ses_row['student_major']; ?>  </span><span class="date-meeting" style="text-align:center;"><?php echo $ses_row['enrollment_year']; ?></span><i class="fa fa-angle-right"></i></span>
									   </a>
									</h4>
								  </div>
								  
								</div>
									<?php } } else {
								?>
								<p class="alert alert-danger">No Session yet!</p>
								<?php								
								}
								?>
    
	
	
	
						</div> 
						</div>
						
						
						
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>