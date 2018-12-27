<?php include 'include/header.php';
include 'include/head.php';
$id=$_REQUEST['info'];
$data=$db->Get_my_requestsByid($id);
if(mysqli_num_rows($data)==0)
{
	echo "<script>window.location.href='freind-request.php'</script>";
	die;
}
$row=mysqli_fetch_array($data);
?>
  
  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<?php include 'include/friend_menu.php'; ?>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name"><span style="float:left; font-size:18px;"><i class="fa fa-angle-left" style="float:left; margin-right:10px;"></i> Friend Requests</span>Verify<i class="fa fa-ellipsis-v"></i></h4>
					
					<div class="public-profile">
						<div class="pub-pro">
							<img src="uploads/<?php echo $row['profile']; ?>" alt="">
						</div>
						<div class="public-content">
							<p><?php echo $row['fname'].' '.$row['lname']; ?></p>
							<p>Gender: <?php echo $row['gender']; ?></p>
							<p>Country: <?php echo $row['country']; ?></p>
							<p>Age: <?php echo $row['age']; ?> Years</p>
							<!--<p>Mobile: +8615579830172</p>
							<p>Email: eaglestar6115@gmail.com</p>-->
						</div>
						
						
						<div class="delete-user-btn accept-btn">
							<a href="process/process.php?action=request_action&set=1&id=<?php echo $id; ?>" onclick="return confirm('Are you want to accept Request?');">Accept Friend Request</a>
						</div>
						
						<div class="delete-user-btn reject-btn">
							<a href="process/process.php?action=request_action&set=3&id=<?php echo $id; ?>" onclick="return confirm('Are you want to Reject Request?');">Reject Friend Request</a>
						</div>
						
						<div class="delete-user-btn block-btn">
							<a href="process/process.php?action=request_action&set=2&id=<?php echo $id; ?>" onclick="return confirm('Are you want to Block Request?');">Block Friend Request</a>
						</div>
						
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>