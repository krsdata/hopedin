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
				<div class="create-test-btn text-center">
					<a href="create_test.php">Create Test</a>	
				</div>
				<ul class="side-menu-list">
					<li><a href="test-paper.php"><span class="menu-icon"></span> Available Test</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="daily-schedule.php"><span class="menu-icon"></span> </span> Received Test</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="monthly-report.php"><span class="menu-icon"></span> Scheduled Test</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="e-money.php"><span class="menu-icon"></span>Live Test</a>  <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
				</ul>
			</div>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Admin Preview</h4>
					
					<div class="public-profile">
						<div class="exam-button">
						<?php
							/*if(isset($_SESSION['quiz_id']))
							{*/
							if(isset($_SESSION['quiz_succ']))
							{
								?>
								<p class="alert alert-success"><?php echo $_SESSION['quiz_succ']; ?></p>
								<?php
								unset($_SESSION['quiz_succ']);
							}
							
						$k=1;
						$data1=$db->Get_questionsByExam($_REQUEST['id']);
						if(mysqli_num_rows($data1))
						{
						while($row1=mysqli_fetch_assoc($data1))
						{ ?>
						<div class="exam-form">
								<label style="float:  left; width: 100%; margin-top: 15px;"><?php echo $k.") ".$row1['Question']; ?></label>
								<span style="display:  block; float:  left; width: 20%;"><?php echo $row1['option1']; ?> <input class="objective-radio" value="1" name="answer" style="float:  left; width:  20px; margin-top:  -7px; margin-right: 11px;" type="radio">
								</span>
								<span style="display:  block; float:  left; width: 20%;"><?php echo $row1['option2']; ?> <input class="objective-radio" value="2" name="answer" style="float:  left; width:  20px; margin-top:  -7px; margin-right: 11px;" type="radio">
								</span>
								<span style="display:  block; float:  left; width: 20%;"><?php echo $row1['option3']; ?> <input class="objective-radio" value="3" name="answer" style="float:  left; width:  20px; margin-top:  -7px; margin-right: 11px;" type="radio">
								</span>
								<span style="display:  block; float:  left; width: 20%;"><?php echo $row1['option4']; ?> <input class="objective-radio" value="4" name="answer" style="float:  left; width:  20px; margin-top:  -7px; margin-right: 11px;" type="radio">
								</span>
								<br>
								<p style="clear:both;"><b>Answer: </b>Option-<?php echo $row1['answer']; ?></p>
						</div>
						<?php $k++; } }
						else
						{
							?>
							<p class="alert alert-danger">Question are not sets yet!</p>
							<?php
						}
						//}
						?>
						</div>
												
					</div>
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>