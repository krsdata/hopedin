<?php include 'include/header.php';
if(!isset($_SESSION['mobileNumber']))
{
	echo "<script>window.location.href='verification.php'</script>";
	die;
}
if($_SESSION['session_type']=='school')
{
	echo "<script>window.location.href='school_profile.php'</script>";
	die;
}
?>
  <body> 
  <div class="login-page">
  	<div class="login-header">
		<h3>Profile</h3>
	</div>
	<form method="post" id="singup_form" enctype="multipart/form-data" onsubmit="return Do_signup();" >
	<div class="upload-img text-center">
		<img id="blah" src="img/profile_photo.jpg" alt="">
			<p>Upload Photo 
				<a onclick="$('#uploadss').click();" href="javascript:void(0);">
					<i class="fa fa-edit"></i>
				</a>
			</p>
		</div>
		<input type="file" name="file" style="display:none;" id="uploadss" accept="image/*" />
		<div class="signup-form">
			<div class="container">
				<div class="row">
					<?php if($_SESSION['session_type']=='school'){
						?>
						
						<div class="col-sm-6">
						<div class="field-login sign-input">
							<input type="text" required name="school_name" placeholder="Enter School Full Name">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
						</div> 
						
						
						<div class="col-sm-6">
						<div class="field-login sign-input">
							<input type="text" required name="fname" placeholder="School Name Abbreviation i.e. AMC, BZU, GMU">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
				    </div>
					<!--
						<div class="col-sm-6">
						<div class="field-login sign-input">
							<input type="text" required name="fname" placeholder="School Owner First Name">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
				    </div> 
					
					<div class="col-sm-6">
						<div class="field-login sign-input">
							<input type="text" required name="lname" placeholder="School Owner Last Name">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
				    </div> 
					
					-->
					
					<div class="col-sm-6">
						<div class="field-login sign-input">
							<input type="text" <?php if($_SESSION['session_type']=='school'){ ?> onblur="(this.type='text')" onfocus="(this.type='date')" <?php } ?> required name="founded_on" placeholder="Founded On">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
				    </div>
					
					<div class="col-sm-6">
						<div class="field-login sign-input">
							<select required name="school_grade">
								<option value="">School Grade/Level</option>
								<option value="Kindergarten">Kindergarten</option>
								<option value="Training School">Training School</option>
								<option value="Primary School">Primary School</option>
								<option value="Middle School">Middle School</option>
								<option value="Secondary School">Secondary School</option>
								<option value="Junior Secondary School">Junior Secondary School</option>
								<option value="Senior Secondary School">Senior Secondary School</option>
								<option value="Vocational School">Vocational School</option>
								<option value="Short Cycle / Post-secondary School">Short Cycle / Post-secondary School</option>
								<option value="High School">High School</option>
								<option value="Junior High School">Junior High School</option>
								<option value="Senior High School">Senior High School</option>
								<option value="College">College</option>
								<option value="Tertiary School">Tertiary School</option>
								<option value="University">University</option>
							</select>
							
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>
				    </div>
					
					
					<div class="col-sm-6">
						<div class="field-login sign-input">
							<select required name="school_status">
								<option value="">School Status</option>
								<option value="Main Campus">Main Campus</option>
								<option value="Sub Campus">Sub Campus</option>
							</select>
							
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>
				    </div>
					
					<div class="col-sm-6">
						<div class="field-login sign-input">
							<select required name="int_education">
								<option value="">School Level</option>
								<option value="National School">National School</option>
								<option value="International School">International School</option>
							</select>
							
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>
				    </div>
					 
					<div class="col-sm-6">
						<div class="field-login sign-input">
							<input type="text" required name="nationality" placeholder="School Owner Nationality">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
				    </div> 
					
					
					
					
						<?php 
					} else  { ?>
					<div class="col-sm-6">
						<div class="field-login sign-input">
							<input type="text" required name="fname" placeholder="First Name">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
				    </div> 
					
					<div class="col-sm-6">
						<div class="field-login sign-input">
							<input type="text" required name="lname" placeholder="Last Name">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
				    </div> 
					
					<?php } ?>
					
						<div class="col-sm-6">
									<div class="field-login sign-input">
										<select required onchange="return change_country($(this).val());" name="country" >
											<option value="">Select A Country</option>
											<?php $data1=$db->Get_countries();
												  while($row1=mysqli_fetch_assoc($data1))
												  {
													  ?>
													  <option value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>
													  <?php
												  }
											?>
										</select>
										<span class="input-icon">
											<i class="fa fa-flag"></i>
										</span>
									</div>
								</div>
								<?php if($_SESSION['session_type']=='school'){
								?>
								<div class="col-sm-6">
									<div class="field-login sign-input">
									
									<select required id="set_province" name="province" >
										<option value="">Select A Country First</option>
									</select>
										
									<span class="input-icon"><i class="fa fa-transgender"></i></span>
									</div>
								</div>
								
								<div class="extra_feild">
								</div>
								<div class="extra_feild1">
								</div>
								
								<div class="col-sm-6">
									<div class="field-login sign-input">
									<input type="number" required name="num_student" placeholder="Number of Local/Native Student">		
									<span class="input-icon"><i class="fa fa-transgender"></i></span>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="field-login sign-input">
									<input type="number" required name="num_intn_student" placeholder="Number of International Student">		
									<span class="input-icon"><i class="fa fa-transgender"></i></span>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="field-login sign-input">
									<input type="number" required name="num_teacher" placeholder="Number of Local/Native Teacher">		
									<span class="input-icon"><i class="fa fa-transgender"></i></span>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="field-login sign-input">
									<input type="number" required name="num_intn_teacher" placeholder="Number of International Teacher">		
									<span class="input-icon"><i class="fa fa-transgender"></i></span>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="field-login sign-input">
									<textarea style="width: 100%;" required name="school_intro" placeholder="School Introduction / About School"></textarea>		
									<span class="input-icon"><i class="fa fa-transgender"></i></span>
									</div>
								</div>
								<?php } ?>
								<div class="col-sm-6">
									<div class="field-login sign-input">
									<select required name="gender">
										<option value="">Gender</option>
										<option value="male">Male</option>
										<option value="female">Female</option>
									</select>
									<span class="input-icon"><i class="fa fa-transgender"></i></span>
									</div>
								</div>
								
								
								<div class="col-sm-6" style="display:none;">
								<div class="field-login sign-input">
									<input type="text" name="mobile" readonly value="<?= $_SESSION['mobileNumber']; ?>" class="phonevalidation" required placeholder="Enter 10 Digit Mobile Number">
										<span class="input-icon">
											<i class="fa fa-phone"></i>
										</span>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="field-login sign-input">
										<input type="text" onchange="return getAge($(this).val());" required name="dob" <?php if($_SESSION['session_type']=='school'){ ?> onblur="(this.type='text')" onfocus="(this.type='date')" <?php } ?> placeholder="School Owner Date Of Birth">
											<span class="input-icon"><i class="fa fa-calendar"></i></span>
										</div>
							    </div>             
									<div class="col-sm-6">
										<div class="field-login sign-input">
											<input class="age_type" type="number" readonly required name="age" placeholder="Age">
												<span class="input-icon"><i class="fa fa-id-badge"></i></span>
											</div>
									</div>
								
								<div class="col-sm-6">
									<div class="field-login sign-input">
									<select required name="language">
										<option value="">Prefered Language</option>
										<option value="English">English</option>
										<option value="Chinese">Chinese</option>
									</select>
									<span class="input-icon"><i class="fa fa-language"></i></span>
									</div>
								</div>
								
							
										<div class="col-sm-6">
											<div class="field-login sign-input">
											<select required name="currency">
												<option value="">Select Currency</option>
												<option value="usd">USD</option>
												<option value="rmb">RMB</option>
												<option value="pkr">PKR</option>
												<option value="inr">INR</option>
											</select>
											<span class="input-icon"><i class="fa fa-money-bill-alt" aria-hidden="true"></i></span>
											</div>
										</div>
											<div class="col-sm-6">
												<div class="field-login sign-input">
													<input type="email" name="email" required placeholder="Email">
														<span class="input-icon">
															<i class="fa fa-envelope"></i>
														</span>
													</div>
												</div>
												
												<div class="col-sm-6">
												<div class="field-login sign-input">
													<input type="text" minlength="5" maxlength="5" class="phonevalidation" name="afp_pin" placeholder="Enter 5 Digit ASP Pin i,e 12345">
													<span class="input-icon"><i class="fa fa-envelope"></i></span>
												</div>
												</div>
												<div class="col-sm-6">
													<div class="field-login sign-input">
														<input type="password" required name="password" id="pass" minlength="6" placeholder="Password">
															<span class="input-icon">
																<i class="fa fa-lock"></i>
															</span>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="field-login sign-input">
															<input type="password" id="cpass" required placeholder="Retype Password">
																<span class="input-icon">
																	<i class="fa fa-lock"></i>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="login-form">
												<div class="field-login">
													<input type="submit" value="Create Account" class="login-btn btn_prop">
													</div>
													<p class="text-center create-link">
			Already User? 
														<a href="index.php">Login</a>
													</p>
												</div>
											</form>
	
  </div>
  
    
	<script>
$(document).on('click','.metro_class',function(){
	if($(this).val()=='Metro-line Facility Available')
	{
		$('.extra_feild1').html('<div class="col-sm-6"><div class="field-login sign-input"><input required="" name="metro_number" placeholder="Enter Metro Line Number/Station Name" type="text"><span class="input-icon"><i class="fa fa-transgender"></i></span></div></div>');
	}
	else
	{
		$('.extra_feild1').html('');
	}
});

function change_country(val)
{
	if(val=='44' || val=='166')
	{
		if(val=='44')
		{
			var extra='<div class="col-sm-6"><div class="field-login sign-input"><select class="metro_class" required name="metro_line"><option value="">Metro-line Facility</option><option value="Metro-line Facility Available">Metro-line Facility Available</option><option value="There is No Metro-Station">There is No Metro-Station</option></select><span class="input-icon"><i class="fa fa-transgender"></i></span></div></div>';
		}
		else 
		{
			var extra='';
		}
		$('.extra_feild').html('<div class="col-sm-6"><div class="field-login sign-input"><input required="" name="zip_city" placeholder="Enter zip code/Postal Code/ City Name" type="text"><span class="input-icon"><i class="fa fa-transgender"></i></span></div></div>'+extra);
	}
	else
	{
		$('.extra_feild').html('');
	}
	$.ajax({
			url:"process/process.php?action=set_province",
			type:"POST",
			data:{'country':val},
			dataType:'json',
			success:function(data)
			{
				$('#set_province').html('');
				$.each(data.result,function(index,value){
					$('#set_province').append('<option value="'+value.id+'">'+value.name+'</option>');
				});
			}
	});
	
}
	function verify_otp()
	{
		$.ajax({
			url:"process/process.php?action=verify_otp",
			type:"POST",
			data:$('#Do_send_otp').serialize(),
			success:function(data)
			{
				var data=$.trim(data);
				if(data=='1')
				{
					$('.new_form1').hide();
					$('.new_form2').show();
					return false;
				}
				else
				{
					alert('Invalid Otp! Try Again...');
					return false;
				}
			}
		});
		return false;
	}
	function Do_send_otp()
	{
		$.ajax({
			url:"process/process.php?action=sendotp1",
			type:"POST",
			data:$('#Do_send_otp').serialize(),
			success:function(data)
			{
				alert('Verification send successfully.');
				return false;
			}
		});
	}
	
	$(document).ready(function(){
		$("#uploadss").change(function() {
		  readURL(this);
		});		
		$(".phonevalidation").keydown(function (e) {
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||             (e.keyCode >= 35 && e.keyCode <= 40)) {                 return;        }         if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {            e.preventDefault();        }    }); 	
	});
	
	</script>
  </body>