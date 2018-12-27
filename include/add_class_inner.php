<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function() {
   $( ".datepicker" ).datepicker({dateFormat: 'yy',  changeYear: true,  changeMonth: false,onClose: function() {
        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).datepicker('setDate', new Date(iYear, 1));  
     }});
   $( ".datepicker1" ).datepicker({dateFormat: 'yy',  changeYear: true,  changeMonth: false,onClose: function() {
        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
   $(this).datepicker('setDate', new Date(iYear, 1)); } } );
   $( ".datepicker2" ).datepicker({dateFormat: 'yy',  changeYear: true,  changeMonth: false,onClose: function() {
        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
   $(this).datepicker('setDate', new Date(iYear, 1)); }});
});
function Get_students(val)
{
	//var i=val.length;
	$('.dynamic_sec').html('');
	for(var i=1;i<=val.length;i++)
	{
		$('.dynamic_sec').append('<input type="number" min="0" max="9" class="input-form2" maxlength="1" name="roll_number[]" value="0">');	
	}
}
</script>
<style>
.ui-datepicker-calendar {
       display: none;
    }
    .ui-datepicker-month {
       display: none;
    }
    .ui-datepicker-prev{
       display: none;
    }
    .ui-datepicker-next{
       display: none;
    }	
</style>
<div class="add-class-form class-form1">
		    <div class="row">
        		<h4 class="session-info">
                	Session Information
                </h4>
        	</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="field-login sign-input">
					<input type="text" class="input-form1" name="student_major" required placeholder="Student Major">
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="field-login sign-input">
					
					<input type="text" placeholder="Enrolment's Year" class="input-form1 datepicker" name="enrollment_year" required />
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="field-login sign-input">
						<select class="input-form1" name="intake" required>
						<option value="">Intake</option>
						<option value="January">January</option>
						<option value="February">February</option>
						<option value="March">March</option>
						<option value="April">April</option>
						<option value="May">May</option>
						<option value="June">June</option>
						<option value="July">July</option>
						<option value="August">August</option>
						<option value="September">September</option>
						<option value="October">October</option>
						<option value="November">November</option>
						<option value="December">December</option>
						
					</select>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="field-login sign-input">
						<input type="text" placeholder="Session Starded On" class="input-form1 datepicker1" name="session_start" required />
					</div>
				</div>
				
				
				
				<div class="col-sm-6">
					<div class="field-login sign-input">
						<input type="text" placeholder="Session Complete On" class="input-form1 datepicker2" name="session_complete" required />
					</div>
				</div>
				<div class="col-sm-6">
					<div class="field-login sign-input">
					<select class="input-form1" onchange="return Get_students($(this).val());" name="max_student" required>
						<option value="">Maximum Number Of Students</option>
						<option value="99">99</option>
						<option value="999">999</option>
						<option value="9999">9999</option>
						<option value="99999">99999</option>
						<option value="999999">999999</option>
						<option value="9999999">9999999</option>
						<option value="99999999">99999999</option>
						<option value="999999999">999999999</option>
					</select>
					</div>
				</div>
			</div>
		</div>
		
<div class="add-class-form class-form2" style="display:none;">
		    <div class="row">
        		<h4 class="session-info">
                	Roll Number Sequence
                </h4>
        	</div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<div class="field-login sign-input roll-number-field">
					<div class="dynamic_sec">
						
					</div>
					<input type="number" min="0" max="9" class="input-form2" maxlength="1" name="roll_number[]" value="1">
					</div>
				</div>
			</div>
</div>

<div class="add-class-form class-form3" style="display:none;">
		    <div class="row">
        		<h4 class="session-info">
                	Basic Data
                </h4>
        	</div>
			<div class="row basic-data">
				<div class="acr" style="padding:0px 15px; margin-top:0px;">
					<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a>Full Name <span><label class="switch">
										<input name="full_name" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									 <a>Father/Mother Name <span><label class="switch">
										<input name="father_name" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									 <a>Nationality <span><label class="switch">
										<input name="nationality" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a>National ID Card Number + Scan Picture <span><label class="switch">
										<input name="nationality_card" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a>Passport Number + Scan Picture <span><label class="switch">
										<input name="passport_scan" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									 <a>Student Card Number + Scan Picture <span><label class="switch">
										<input name="student_scan" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									<a>Date Of Birth <span><label class="switch">
										<input name="dob" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									   <a>Age <span><label class="switch">
										<input name="age" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									 <a>Marital Status <span><label class="switch">
										<input name="marital_status" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a>Permanent Address <span><label class="switch">
										<input name="parmanent_address" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
										<a>Add Past Academic Data <span><label class="switch">
										<input name="" type="checkbox" value="1" >
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								
				</div>
			</div>
</div>

<div class="add-class-form class-form4" style="display:none;">
		    <div class="row">
        		<h4 class="session-info">
                	Contact Information
                </h4>
        	</div>
			<div class="row basic-data">
				<div class="acr" style="padding:0px 15px; margin-top:0px;">
					<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a>Hopedin ID <span><label class="switch">
										<input type="checkbox" value="1" name="hopedin_id">
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Phone Number <span><label class="switch">
										<input type="checkbox" value="1" name="phone_number">
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Email ID <span><label class="switch">
										<input type="checkbox" value="1" name="email_id">
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Wechat ID <span><label class="switch">
										<input type="checkbox" value="1" name="wechat_id">
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>		
								
				</div>
			</div>
		</div>