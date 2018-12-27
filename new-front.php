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
					<a href="#">Create Test</a>
				</div>
				<ul class="side-menu-list">
					<li><a href="available.php"><span class="menu-icon"></span> Available Test</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="daily-schedule.php"><span class="menu-icon"></span> </span> Received Test</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="monthly-report.php"><span class="menu-icon"></span> Scheduled Test</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="e-money.php"><span class="menu-icon"></span>Live Test</a>  <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
				</ul>
			</div>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Basic Information</h4>
					
					<div class="public-profile">
						<div class="acr" style="margin:0px;">
							<div class="set-exam">
								
<div class="set-row">
									<p>Exam Name <span style="float:right"><input class="exam-input" type="text" placeholder="Enter Exam Name"></span></p>
								</div>
<div class="set-row">
									<p>Subject Name <span style="float:right"><input class="exam-input" type="text" placeholder="Enter Subject Name"></span></p>
								</div>
<div class="set-row">
									<p>Test Safety Pin (TSP) <span style="float:right"><a onclick="myFunction()">Set Pin</a></span>
									<div id="myDIV" style="position:absolute; display:none; right: 15px;">
										<input type="password" placeholder="Type Test Safety Pin (TSP)">
										<br/>
										<input type="password" placeholder="Retype Test Safety Pin (TSP)">
										<br/>
										<button>Done</button>
									</div>
									</p>
								</div>
<div class="set-row">
									<p>Set Timer <span style="float:right"><a href="#">Set Timer</a></span></p>
								</div>
								<div class="set-row">
									<p>Pass Mark Percentage <span style="float:right"><a href="#">Set Mark</a></span></p>
								</div>
								<div class="set-row">
									<p>Preview Before Submission <span style="float:right"><input type="checkbox" style="width:25px;"></span></p>
								</div>
								
								<div class="exams-btns">
									<div class="">
									<button style="background:#4fb263; color:#fff; width:200px; border:none; margin-right:15px;">Next</button>
									<button style="background:#9d270b; color:#fff; width:200px; border:none;">Cancel</button>
									</div>
								</div>
								
							</div> 
						</div>
						
						
						
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	
	<script>
function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script> 
  </body>