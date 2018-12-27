<?php include 'include/header.php';
include 'include/head.php'; 
?>
<link href="css/bootstrap-clockpicker.min.css" rel="stylesheet">
<script src="js/bootstrap-clockpicker.min.js"></script> 
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
			<form id="for_create_exam" onsubmit="return create_new_exam(1);" method="post">
			<div class="col-sm-9 right-content content1">
			
			
				<div class="main-right">
					<h4 class="chat-name">Basic Information</h4>
					
					<div class="public-profile">
					<?php if(isset($_SESSION['succ_msg'])){
						?>
						<p class="alert alert-success"><?php echo $_SESSION['succ_msg']; ?></p>
						<?php
						unset($_SESSION['succ_msg']);
					} ?>
						<div class="acr" style="margin:0px;">
							<div class="set-exam">
								
								<div class="set-row">
									<p>Exam Name <span style="float:right"><input class="exam-input" required name="exam_name" type="text" placeholder="Enter Exam Name"></span></p>
								</div>
								<div class="set-row">
									<p>Subject Name <span style="float:right"><input class="exam-input" name="exam_subject" required type="text" placeholder="Enter Subject Name"></span></p>
								</div>
									<div class="set-row">
									<p>Test Safety Pin (TSP) <span style="float:right"><a class="set_pin_action" onclick="myFunction(1)">Set Pin</a></span>
									<div id="myDIV1" class="myDIV" style="position:absolute; display:none; right: 15px;">
										<input name="safety_pin" class="safety1" type="password" placeholder="Type Test Safety Pin (TSP)">
										<br/>
										<input class="safety2" type="password" placeholder="Retype Test Safety Pin (TSP)">
										<br/>
										<button onclick="return test_safety();" type="button">Done</button>
									</div>
									</p>
								</div>
								<div class="set-row">
									<p>Set Timer <span style="float:right"><a class="time_action" onclick="myFunction(2)">Set Timer</a></span>
									<div id="myDIV2" class="myDIV" style="position:absolute; display:none; right: 15px;">
									<div class="input-group clockpicker">
										<input type="text" name="time_set" placeholder="Enter Test Time" class="form-control time_set" value="">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
										<br/>
										<button onclick="return test_time();" type="button">Done</button>
									</div>
									</p>
								</div>
								<div class="set-row">
									<p>Pass Mark Percentage <span style="float:right"><a class="marks_action" onclick="myFunction(3)">Set Mark</a></span>
									
									<div id="myDIV3" class="myDIV" style="position:absolute; display:none; right: 15px;">
									<input name="marks" class="percents phonevalidation" placeholder="Enter Percent">
										<br/>
										<button onclick="return test_marks();" type="button">Done</button>
									</div>
									</p>
								</div>
								<div class="set-row">
									<p>Preview Before Submission <span style="float:right"><input type="checkbox" value="1" name="preview_submit" style="width:25px;"></span>
									</p>
								</div>
								
								<div class="exams-btns">
									<div class="">
									<button style="background:#4fb263; color:#fff; width:200px; border:none; margin-right:15px;">Next</button>
									<button type="button" class="exam_cancel" style="background:#9d270b; color:#fff; width:200px; border:none;">Cancel</button>
									</div>
								</div>
								
							</div> 
						</div>
						
						
						
						
					</div>
					
					
					
					
				</div>
			</div>
			<?php include 'include/tests_inner.php'; ?>
			</form>
		</div>
	</div>
  </div>
	
	<script>
	$('.clockpicker').clockpicker({
		placement: 'top',
		align: 'left',
		donetext: 'Done'
	});	   
function myFunction(id) {
    var x = document.getElementById("myDIV"+id);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script> 
  </body>