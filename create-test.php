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
					<li><a href="create-test.php"><span class="menu-icon"><i class="far fa-calendar-alt"></i></span> Create Exam</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="test-paper.php"><span class="menu-icon"><i class="far fa-calendar-alt"></i></span> </span> Test Papers</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="monthly-report.php"><span class="menu-icon"><i class="fas fa-chart-bar"></i></span> Results</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					
				</ul>
			</div>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Create Test</h4>
					
					<div class="public-profile">
						<div class="exam-button">
							<form method="post" action="process/process.php?action=create_exam">
							<div class="exam-form">
								<label>Enter Exam Name</label>
								<input name="exam_name" required type="text" />
							</div>
							<div class="exam-form">
								<label>Enter Exam Subject</label>
								<input name="exam_subject" required type="text" />
							</div>
							<div class="exam-form">
								
								<input type="submit" value="Create Exam">
							</div>
							</form>
						</div>
												
					</div>
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>