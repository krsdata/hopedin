<?php include 'include/header.php';
if(!isset($_SESSION['mobileNumber']))
{
	echo "<script>window.location.href='verification.php'</script>";
	die;
}
if($_SESSION['session_type']!='school')
{
	echo "<script>window.location.href='profile.php'</script>";
	die;
}
?>
<script>
function continue_set(val)
{
	if(val==1 && $('#uploadss').val()=='')
	{
		alert('Please Upload a logo!');
		return false;
	}
	val++;
	$('.all-sets').hide();
	$('.my-sets'+val).show();
	if(val!=2)
	{
		$('.my-sets'+val+' input').attr('required','required');
		$('.my-sets'+val+' select').attr('required','required');
	}
	if(val==4)
	{
		$('#singup_form').attr('onsubmit','return Do_signup();');
		$('.login-btn').val('Create Account');
	}
	else
	{
		$('#singup_form').attr('onsubmit','return continue_set('+val+');');
	}
	return false;
}
</script>
  <body> 
  <div class="login-page">
  	<div class="login-header">
		<h3>School Basic Data</h3>
	</div>
	<form method="post" id="singup_form" enctype="multipart/form-data" onSubmit="return continue_set(1);" >
	    
		<input type="file" name="file" style="display:none;" id="uploadss" accept="image/*" />
		<div class="signup-form">
			<div class="container">
				<div class="row">
				 <div class="all-sets my-sets1">
					<div class="upload-img text-center">
						<img id="blah" src="img/profile_photo.jpg" alt="">
							<p>Upload Logo Of School 
								<a onClick="$('#uploadss').click();" href="javascript:void(0);">
									<i class="fa fa-edit"></i>
								</a>
							</p>
					</div>
					<?php if($_SESSION['session_type']=='school'){
						?>
						
						<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
							<input type="text" required name="school_name" placeholder="Enter School Full Name">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
						</div> 
						
						
						<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
							<input type="text" required name="school_abb" placeholder="School Name Abbreviation i.e. AMC, BZU">
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
					
					<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
							<input type="text" <?php if($_SESSION['session_type']=='school'){ ?> onBlur="(this.type='text')" onFocus="(this.type='date')" <?php } ?> required name="founded_on" placeholder="Founded On">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
				    </div>
					
					<div class="col-sm-offset-3 col-sm-6">
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
					
					
					<div class="col-sm-offset-3 col-sm-6">
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
					
					<div class="col-sm-offset-3 col-sm-6">
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
					 <!--
					
					-->
					<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
							<select required onChange="return change_country($(this).val());" name="country" >
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
								<div class="col-sm-offset-3 col-sm-6">
									<div class="field-login sign-input">
									
									<select required id="set_province" name="province" >
										<option value="">Select A Province</option>
									</select>
										
									<span class="input-icon"><i class="fa fa-transgender"></i></span>
									</div>
								</div>
								
								<div class="extra_feild">
								</div>
								<div class="extra_feild1">
								</div>
						</div>
					
					
					
					<div class="all-sets my-sets2" style="display:none;">
					<div class="school-level">
					
					<div class="col-sm-12 table-level">
					<h2>Local Student's Programs</h2>
				</div>
				<div class="col-sm-12">
					<h3>Select Study Level Supported For Local Students</h3>
				</div>
				<!--
				<div class="col-sm-12">
					<div class="level-btn">
						<button type="button" onClick="$('.basic-level').show(); $('.higher-level').hide();" style="background:blue; padding:10px; color:#fff; border:none;">Basic Level</button>
						<button type="button" onClick="$('.basic-level').hide(); $('.higher-level').show();" style="background:red; padding:10px; color:#fff; border:none;">Higher Level</button>
					</div>
				</div>
				-->
				<div class="basic-level">
				<div class="col-sm-12">
					
					<div class="select-level-radio">
						<span>001</span> <input name="001" value="City Toddlers" type="radio"> City Toddlers
					</div>
					<div class="select-level-radio">
						<span>002</span> <input name="002" type="radio"> Playgroup <input name="002" type="radio"> Pre-K <input name="002" type="radio"> Pre-school <input name="002" type="radio"> Babysitter <input type="radio" name="002" > Daycare
					</div>
					<div class="select-level-radio">
						<span>003</span> <input name="003" type="radio"> Nursery
					</div>
					<div class="select-level-radio">
						<span>004</span> <input name="004" type="radio"> Kindergarten
					</div>
					<div class="select-level-radio">
						<span>005</span> <input name="005" type="radio"> Class 1 <input name="005" type="radio"> K-1
					</div>
					<div class="select-level-radio">
						<span>006</span> <input name="006" type="radio"> Class 2 <input name="006" type="radio"> K-2
					</div>
					<div class="select-level-radio">
						<span>007</span> <input name="007" type="radio"> Class 3 <input name="007" type="radio"> K-3
					</div>
					<div class="select-level-radio">
						<span>008</span> <input name="008" type="radio"> Class 4 <input name="008" type="radio"> K-4
					</div>
					<div class="select-level-radio">
						<span>009</span> <input name="009" type="radio"> Class 5 <input name="009" type="radio"> K-5
					</div>
					<div class="select-level-radio">
						<span>010</span> <input name="010" type="radio"> Class 6 <input name="010" type="radio"> K-6
					</div>
					<div class="select-level-radio">
						<span>011</span> <input name="011" type="radio" value="Class 7"> Class 7 <input name="011" type="radio" value="K-7" > K-7
					</div>
					<div class="select-level-radio">
						<span>012</span> <input name="012" type="radio" value="Class 8" > Class 8 <input name="012" type="radio" value="K-8"> K-8
					</div>
					<div class="select-level-radio">
						<span>013</span> <input name="013" type="radio" value="Class 9" > Class 9 <input name="013" type="radio" value="K-9" > K-9 <input name="013" type="radio" value="O-Level (O-1)" > O-Level (O-1)
					</div>
					<div class="select-level-radio">
						<span>014</span> <input name="014" type="radio" value="Class 10" > Class 10 <input name="014" type="radio" value="K-10"> K-10 <input name="014" type="radio" value="O-Level (O-2)"> O-Level (O-2)
					</div>
					<div class="select-level-radio">
						<span>015</span> <input name="015" type="radio" value="O-Level" > O-Level <input name="015" type="radio" value="Matriculation"> Matriculation <input name="015" type="radio" value="GCSE"> GCSE
						<input name="015" value="GED" type="radio"> GED <input name="015" value="HiSET" type="radio"> HiSET <input name="015" value="TASC" type="radio"> TASC
						<input value="HKCEE" name="015" type="radio"> HKCEE <input value="CBSE" name="015" type="radio"> CBSE <input value="ICSE" name="015" type="radio"> ICSE
					</div>
					
					<div class="select-level-radio">
						<span>016</span> <input name="016" value="11 Class" type="radio"> 11 Class <input name="016" value="A-Level (A-1)" type="radio"> A-Level (A-1) <input name="016" value="Inter (Part-1)" type="radio"> Inter (Part-1)
					</div>
					
					<div class="select-level-radio">
						<span>017</span> <input name="017" value="12 Class" type="radio"> 12 Class <input name="017" value="A-Level (A-1)" type="radio"> A-Level (A-1) <input name="017" value="Inter (Part-1)" type="radio"> Inter (Part-2)
					</div>
					
					<div class="select-level-radio">
						<span>018</span> <input name="018" value="A-Level" type="radio"> A-Level <input name="018" value="Intermediate" type="radio"> Intermediate 
					</div>
					
					<div class="select-level-radio">
						<span>019</span> <input name="019" value="Bachelor's" type="radio"> Bachelor's 
					</div>
					
					<div class="select-level-radio">
						<span>020</span> <input name="020" value="Master's" type="radio"> Master's 
					</div>
					
					<div class="select-level-radio">
						<span>021</span> <input name="021" value="Doctor's/PhD" type="radio"> Doctor's/PhD 
					</div>
					
					<div class="select-level-radio">
						<span>022</span> <input name="022" value="Non-Degree's" type="radio"> Non-Degree's 
					</div>
					
					<div class="select-level-radio">
						<span>023</span> <input name="023" value="Diploma's" type="radio"> Diploma's 
					</div>
					
				</div>
				</div>
				
				</div>
				
					</div>
					
					<div class="all-sets my-sets3" style="display:none;" >
						<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
							<input type="text"  name="fname" placeholder="First Name">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
						</div> 
						
						<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
							<input type="text"  name="lname" placeholder="Last Name">
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
						</div>
						
						<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
							<select  name="nationality" >
								<option value="">School Owner Nationality</option>
								<?php $data1=$db->Get_countries();
									  while($row1=mysqli_fetch_assoc($data1))
									  {
										  ?>
										  <option value="<?php echo $row1['name']; ?>"><?php echo $row1['name']; ?></option>
										  <?php
									  }
								?>
							</select>
							<input type="hidden" value=""  />
								<span class="input-icon">
									<i class="fa fa-user"></i>
								</span>
						</div>
						</div> 
						
						<div class="col-sm-offset-3 col-sm-6">
							<div class="field-login sign-input">
							<select  name="gender">
								<option value="">Gender</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
							<span class="input-icon"><i class="fa fa-transgender"></i></span>
							</div>
						</div>
						
						<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
							<input type="text" onChange="return getAge($(this).val());"  name="dob" <?php if($_SESSION['session_type']=='school'){ ?> onBlur="(this.type='text')" onFocus="(this.type='date')" <?php } ?> placeholder="School Owner Date Of Birth">
								<span class="input-icon"><i class="fa fa-calendar"></i></span>
							</div>
					</div>             
						<div class="col-sm-offset-3 col-sm-6">
							<div class="field-login sign-input">
								<input class="age_type" type="number" readonly  name="age" placeholder="Age">
									<span class="input-icon"><i class="fa fa-id-badge"></i></span>
								</div>
						</div>
								
					</div>
					
					<div class="all-sets my-sets4" style="display:none;" >
						<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
						<select  name="language">
							<option value="">Prefered Language</option>
							<option value="English">English</option>
							<option value="Chinese">Chinese</option>
						</select>
						<span class="input-icon"><i class="fa fa-language"></i></span>
						</div>
					</div>
								
							
					<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
						<select  name="currency">
							<option value="">Select Currency</option>
							<option value="usd">USD</option>
							<option value="rmb">RMB</option>
							<option value="pkr">PKR</option>
							<option value="inr">INR</option>
						</select>
						<span class="input-icon"><i class="fa fa-money-bill-alt" aria-hidden="true"></i></span>
						</div>
					</div>
					<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
							<input type="email" name="email"  placeholder="Email">
								<span class="input-icon">
									<i class="fa fa-envelope"></i>
								</span>
							</div>
						</div>
												
						<div class="col-sm-offset-3 col-sm-6">
						<div class="field-login sign-input">
							<input type="text" minlength="5" maxlength="5" class="phonevalidation" name="afp_pin" placeholder="Enter 5 Digit ASP Pin i,e 12345">
							<span class="input-icon"><i class="fa fa-envelope"></i></span>
						</div>
						</div>
						<div class="col-sm-offset-3 col-sm-6">
							<div class="field-login sign-input">
								<input type="password"  name="password" id="pass" minlength="6" placeholder="Password">
									<span class="input-icon">
										<i class="fa fa-lock"></i>
									</span>
								</div>
							</div>
						<div class="col-sm-offset-3 col-sm-6">
							<div class="field-login sign-input">
								<input type="password" id="cpass"  placeholder="Retype Password">
									<span class="input-icon">
										<i class="fa fa-lock"></i>
									</span>
								</div>
							</div>
					</div>	
					
					
					
					 
					
					
					<!--
						
								
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
								-->
								<?php } ?>
								
								
								<!--
								<div class="col-sm-6" style="display:none;">
								<div class="field-login sign-input">
									<input type="text" name="mobile" readonly value="<?= $_SESSION['mobileNumber']; ?>" class="phonevalidation" required placeholder="Enter 10 Digit Mobile Number">
										<span class="input-icon">
											<i class="fa fa-phone"></i>
										</span>
									</div>
								</div>
								-->
								
								
								
								
							</div>
					</div>
			</div>
			<div class="login-form">
				<div class="field-login">
					<input type="submit" value="Next" class="login-btn btn_prop">
					</div>
					<p class="text-center create-link">
						Already User? 
						<a href="index.php">Login</a>
					</p>
				</div>
			</form>
	
  </div>
  
  <style>
  .my-sets2 input
  {
	  width:auto;
	  height:auto;
	  display: inline-block;
  }
</style>  
	<script>
$(document).on('click','.metro_class',function(){
	if($(this).val()=='Metro-line Facility Available')
	{
		$('.extra_feild1').html('<div class="col-sm-offset-3 col-sm-6"><div class="field-login sign-input"><input required="" name="metro_number" placeholder="Enter Metro Line Number/Station Name" type="text"><span class="input-icon"><i class="fa fa-transgender"></i></span></div></div>');
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
			var extra='<div class="col-sm-offset-3 col-sm-6"><div class="field-login sign-input"><select class="metro_class" required name="metro_line"><option value="">Metro-line Facility</option><option value="Metro-line Facility Available">Metro-line Facility Available</option><option value="There is No Metro-Station">There is No Metro-Station</option></select><span class="input-icon"><i class="fa fa-transgender"></i></span></div></div>';
		}
		else 
		{
			var extra='';
		}
		$('.extra_feild').html('<div class="col-sm-offset-3 col-sm-6"><div class="field-login sign-input"><input required="" name="zip_city" placeholder="Enter zip code/Postal Code/ City Name" type="text"><span class="input-icon"><i class="fa fa-transgender"></i></span></div></div>'+extra);
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