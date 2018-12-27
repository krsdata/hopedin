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
					<?php $set_data=$db->Get_sessionByid($_REQUEST['info']); 
						  $set_row=mysqli_fetch_assoc($set_data);
					?>
					<h4 class="chat-name"><?php echo $set_row['student_major']; ?> (<?php echo $set_row['enrollment_year']; ?>) </span><i class="fa fa-angle-right"></i></span></h4>
					
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
								
	
							</div> 
						</div>
						
						
						
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>