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
					<h4 class="chat-name">Test Papers</h4>
					
					<div class="public-profile">
						<div class="exam-button">
						<?php
							if(isset($_SESSION['quiz_succ']))
							{
								?>
								<p class="alert alert-success"><?php echo $_SESSION['quiz_succ']; ?></p>
								<?php
								unset($_SESSION['quiz_succ']);
							}
						?>
							<table class="table">
								<tr>
								<th>S.No</th>
								<th>Exam Name</th>
								<th>Exam Subject</th>
								<th>No. of question</th>
								<th>Create Date</th>
								<th>Action</th>
								</tr>
								<?php
								 $datas=$db->Get_all_exams();
								 if(mysqli_num_rows($datas))
								 {
									 $i=1;
									 while($rows=mysqli_fetch_assoc($datas))
									 {
										 $data1=$db->Get_questionsByExam($rows['id']);
										 $count=mysqli_num_rows($data1);
										 ?>
										 <tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $rows['exam_name']; ?></td>
										<td><?php echo $rows['exam_subject']; ?></td>
										<td><?php echo $count; ?></td>
										<td><?php echo $rows['cdate']; ?></td>
										<td><a href="view_paper.php?id=<?php echo $rows['id']; ?>" class="btn btn-info btn-xs" >Preview</button></td>
										</tr>
										 <?php
										 $i++;
									 }
								 }
								 else 
								 {
									 ?>
									 <tr>
									 <td colspan="5" align="center">No result found Yet!</td>
									 </tr>
									 <?php
								 }
								?>
							</table>
						</div>
												
					</div>
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>