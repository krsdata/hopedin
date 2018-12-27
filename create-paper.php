<?php include 'include/header.php';
include 'include/head.php';
$datas=$db->get_exam_detail($_REQUEST['info']);
if(mysqli_num_rows($datas)==0)
{
	echo "<script>window.location.href='create-test.php'</script>";
	die; 
}
$rows=mysqli_fetch_assoc($datas);
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
					<h4 class="chat-name">Create Test Paper <b>(<?php echo $rows['exam_name']; ?> : <?php echo $rows['exam_subject']; ?>)</b></h4>
					
					<div class="public-profile">
						<div class="exam-button">
							<form id="quize_form" onsubmit="return quize_submit(<?php echo $_REQUEST['info']; ?>);" method="POST" style="height:  400px; overflow-y: scroll; padding:  15px; border:  1px solid #ccc; border-radius: 5px;">
							<div class="exam-form" style="float:  left;width: 50%;">
								<input type="button" value="Create Exam Quize">
								</div>
								<div class="exam-form" style="float:  right; width:  50%;text-align:  right;">
								<input type="button" value="Cancel">
								</div>
								<div clas="clear" style="display: table; width: 100%; margin-bottom: 15px;"></div>
								<div class="exam-form">
								<label>Enter Question</label>
								<textarea required name="question" style="width:  100%; height:  70px; margin-bottom: 15px;"></textarea>
								</div>
							
							
								<div class="exam-form">
								<label>Add description</label>
								<textarea placeholder="Add description" name="description"  style="width:  100%; height:  70px; margin-bottom: 15px;"></textarea>
								</div>

								<div class="exam-form">
								<label>Options</label>
								<span style="display:  block;">A <input type="text" name="option1" required class="objective-input"></span>
								<span style="display:  block;">B <input type="text" name="option2" required class="objective-input"></span>
								<span style="display:  block;">C <input type="text" name="option3" required class="objective-input"></span>
								<span style="display:  block;">D <input type="text" name="option4" required class="objective-input"></span>
								</div>
								<div class="exam-form">
								<label style="float:  left; width: 100%; margin-top: 15px;">Answer</label>
								<span style="display:  block; float:  left; width: 20%;">A <input type="radio" class="objective-radio" value="1" checked name="answer" style="float:  left; width:  20px; margin-top:  -7px; margin-right: 11px;">
								</span>
								<span style="display:  block; float:  left; width: 20%;">B <input type="radio" class="objective-radio" value="2" name="answer" style="float:  left; width:  20px; margin-top:  -7px; margin-right: 11px;">
								</span>
								<span style="display:  block; float:  left; width: 20%;">C <input type="radio" class="objective-radio" value="3" name="answer" style="float:  left; width:  20px; margin-top:  -7px; margin-right: 11px;">
								</span>
								<span style="display:  block; float:  left; width: 20%;">D <input type="radio" class="objective-radio" value="4" name="answer" style="float:  left; width:  20px; margin-top:  -7px; margin-right: 11px;">
								</span>
							</div>
							
							<div class="exam-form" style=" display:  table; width: 100%; display:none;">
								<label>Correct Answer Marks</label>
								<input min="1" name="correct_answer" value="1" required type="number" />
							</div>
							<div class="exam-form" style=" display:  table; width: 100%; display:none;">
								<label>Incorrect Answer Marks</label>
								<input min="1" name="incorrect_answer" value="1" required type="number" />
							</div>
							<div class="exam-form" style=" display:  table; width:100%">
								<label>
								<input style="width:50px;float: left;" name="mandatory" value="1" type="checkbox" /> <p>Mandatory Question</p></label>
							</div>
							<input type="hidden" value="1" id="next_move" name="next_move" />
							<div class="exam-form" style="margin-bottom: 15px; margin-top:  15px;">
								<input type="submit" onclick="$('#next_move').val(1);" value="Submit &amp; Next">
							</div>
							<div class="exam-form">
							<input type="submit" onclick="$('#next_move').val(0);" name="complete" value="Exam Quiz Complete">
								<i style="display:none;" class="fa fa-spinner fa-spin fa-3x fa-fw prop_load"></i>
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