<?php include 'include/header.php';
include 'include/head.php';
?> 
<script type="text/javascript" src="js/jquery.form.min.js"></script>

<div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 side-menu">
				<ul class="">
					<li><a class="btn btn-primary" href="javascript:void(0);">Active Session</a></li>
					<li><a class="btn btn-primary" href="javascript:void(0);">Add New Session</a></li>
					<li><a class="btn btn-primary" href="javascript:void(0);">Past Session</a></li>
				</ul>
				
			</div>
			<div class="col-sm-9 right-content">   
				<div class="main-right">
					<h4 class="chat-name">Session Information </h4>
					 <form action="/action_page.php" style="margin-top: 59px;">
						  <div class="form-group">
							<input type="text" placeholder="Student Major" name="student_major" required class="form-control" >
						  </div>
						  <div class="form-group">
							<input type="number" placeholder="Enrollment Year" min="2000" name="enrollment_year" required class="form-control" >
						  </div>
						  <div class="form-group">
							<input type="text" placeholder="Intake" name="intake" required class="form-control" >
						  </div>
						  
						  <div class="form-group">
							<select required name="session_start" class="form-control">
								<option value="">Session Started On</option>
								<?php
									for($i=2000; $i<=2030;$i++)
									{
										?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php
									}
								?>
							</select>
							
						  </div>
						  
						   <div class="form-group">
							<select required name="session_complete" class="form-control">
								<option value="">Session Complete On</option>
								<?php
									for($i=2000; $i<=2030;$i++)
									{
										?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php
									}
								?>
							</select>
							
						  </div>
						  
						  <div class="form-group">
						  
							<input type="number" placeholder="Maximum Number Of Student" min="1" name="max_student" required class="form-control" >
							
						  </div>
						  <button type="submit" class="btn btn-success btn-theme">NEXT</button>
					</form> 
				</div>
			</div>
			 
		</div>
	</div>
</div>


	
  </body>