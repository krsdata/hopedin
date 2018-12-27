<?php include 'include/header.php';
include 'include/head.php';
?>
<style>
.radio_session input  
{
	width: auto;
	height: auto;
}
.radio_session label  
{
	margin-right: 20px;
}

</style>
<script type="text/javascript" src="js/mcq_section.js?time=<?php echo time(); ?>" ></script>
  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			
			<div class="col-sm-offset-2 col-md-6 right-content">
				<div class="main-right">
					<h4 class="chat-name">Online Exam</h4> 
					<div class="public-profile text-center">
						<h1 id="h1">Multiple Choice Quiz</h1>
						
						<h2 id ="titleQuestion"></h2>
						<div name ="myForm" id = "myForm">
						 <div id="radios" class="radio_session">
							
							
						</div>
						<br id="break">
							<select id="begin-select">
								<option value="" >Select A Paper</option>
								<?php 
								$be_data=$db->Get_all_exams();
								while($be_row=mysqli_fetch_assoc($be_data))
								{
									?>
									<option value="<?php echo $be_row['id']; ?>" ><?php echo $be_row['exam_name']; ?></option>
									<?php
								}
								?>
							</select>
							<button type = "button" class="btn btn-success" name ="begin" id="begin">Start Exam</button>
							<button style="display:none;" class="btn btn-danger" type = "button" name = "back" id = "back">Back</button>
							
							<button style="display:none;" class="btn btn-success" type = "button" name="next" id="btnskip">Skip</button>
							
							<button style="display:none;" class="btn btn-success" type = "button" name="next" id="nextbtn">Next</button>
							 <p style="display:none;" id ="btnvalid">Please select an answer</p>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
  
    
	

  </body>