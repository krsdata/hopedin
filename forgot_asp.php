<?php include 'include/header.php';
?>
<script>
function process_dob()
{
	var multi_get=$('#multi_get').val();
	var multi_dob=$('#multi_dob').val();
	var acts=$('#multi_dob').data('val');
	if(multi_get=='')
	{
		alert('Please Enter Email/Phone/Account Id');
		return false;
	}
	if(!multi_dob)
	{
		alert('Please Enter a Date!');
		return false;
	}
	$.ajax({
		url:"process/process.php?action=process_dob",
		type:"POST",
		data:{'multi_get':multi_get,'date':multi_dob,'act':acts},
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='0')
			{
				if(acts=='dob')
				{
					alert('Error! Invalid Date of birth. Try again...');
				}
				else
				{
					alert('Error! Invalid Date of Registration. Try again...');
				}
				return false;
			}
			else 
			{
				$('.phase00').hide();
				$('.phase1').show();
				$('#email_address').val(data)
				return false;
				
			}
			
		}
	});
}
function transformEntry(item, type) {
    switch (type) {
        case 'email':
            var parts = item.split("@"), len = parts[0].length;
            return item.replace(parts[0].slice(1,-1), "*".repeat(len - 2));
        case 'phone':
            return item[0] + "*".repeat(item.length - 4) + item.slice(-3);
       default: 
            throw new Error("Undefined type: " + type);
    }        
}
function email_aspotp()
{
	
	$.ajax({
		url:"process/process.php?action=email_aspotp",
		type:"POST",
		data:{'email':$('#email_address').val()},
		success:function(data)
		{
			if(data=='2')
			{
				alert('This Email id is not registered!');
				return false;
			}
			else
			{
				alert('OTP Send on Registered Email '+transformEntry(data,'email')+'!');
				return false;
			}
			
		}
	});
}
function email_aspverify()
{
	
	if($('#email_otp').val()=='')
	{
		alert('Please Enter OTP!');
		return false;
	}
	
	$.ajax({
		url:"process/process.php?action=email_aspverify",
		type:"POST",
		data:{'email':$('#email_address').val(),'email_otp':$('#email_otp').val()},
		success:function(data)
		{
			if(data=='2')
			{
				alert('Invalid OTP! Try again...');
				return false;
			}
			else if(data=='1')
			{
				$('.phase1').hide();
				$('.phase2').show();
				return false;
			}
			
		}
	});
}
function request_bothOtp()
{
	$.ajax({
		url:"process/process.php?action=request_bothOtp",
		type:"POST",
		data:{'mobile':$('#mobile_code').val(),'email':$('#email_address').val()},
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='2')
			{
				alert('This Mobile Number is not registered!');
				return false;
			}
			else 
			{
				alert('OTP Send successfully on Registered Mobile +'+transformEntry(data,'phone'));
				return false;
			}
		}
	});
}
function verify_bothOtp()
{
	if($('#mobile_code').val()=='')
	{
		alert('Please Enter mobile number!');
		return false;
	}
	if($('#mobile_otp').val()=='')
	{
		alert('Please Enter OTP!');
		return false;
	}
	$.ajax({
		url:"process/process.php?action=verify_bothOtp",
		type:"POST",
		data:{'mobile':$('#mobile_code').val(),'mobile_otp':$('#mobile_otp').val(),'email':$('#email_address').val()},
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='2')
			{
				alert('Invalid OTP! Please check otp received mobile.');
				return false;
			}
			else if(data=='1')
			{
				$('.phase1').hide();
				$('.phase2').hide();
				$('.phase3').show();
				return false;
			}
		}
	});
}
function new_aspSave()
{
	var npin=$('#asp_pin').val();
	var cpin=$('#casp_pin').val();
	if(npin!=cpin)
	{
		alert('New Asp and confirm Asp pin should be same!');
		return false;
	}
	else 
	{
	$.ajax({
		url:"process/process.php?action=new_aspSave",
		type:"POST",
		data:{'mobile':$('#mobile_code').val(),'email':$('#email_address').val(),'mobile_otp':$('#mobile_otp').val(),'email_otp':$('#email_otp').val(),'afp_pin':npin},
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='1')
			{
				$('.phase3').hide();
				$('.phase4').show();
				//window.location.href='index.php';
				return false;
			}
			else
			{
				alert('Error! Something went wrong. Try Again.');
			}
		}
	});
	return false;
	}
	return false;
}
function recent_changePass()
{
	var pass=$('#cnpass').val();
	var cpass=$('#cspass').val();
	if(pass=='')
	{
		alert('Please Enter a password');
		return false;
	}
	if(pass!=cpass)
	{
		alert('Password and confirm password Should be same!');
		$('#cspass').val('');
		$('#cspass').focus();
		return false;
	}
	$.ajax({
		url:"process/process.php?action=recent_changePass",
		type:"POST",
		data:{'mobile':$('#mobile_code').val(),'email':$('#email_address').val(),'password':pass},
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='1')
			{
				alert('Success! Password Changed.');
				window.location.href='index.php';
				return false;
			}
			else if(data=='2')
			{
				alert('Error! Something went wrong. Try Again.');
				return false;
			}
			
		}
	});
	return false;
}
</script>
  <body>
  
  <div class="login-page">
  	<div class="login-header">
		<h3>Recover ASP Pin</h3>
	</div>
	
	<div class="login-form">
	<form method="post" id="forgot_asp" onSubmit="return new_aspSave();"  >
		
		<div class="phase00">
			
			<div class="field-login">
				<input type="text" name="multi_get"  id="multi_get"   placeholder="Enter Email / Account Id / Phone" class="" /> 
			</div>
			
			<div class="field-login">
				<input type="text" data-val="dob" name="dob" onFocus="(this.type='date')" onBlur="(this.type='text')"  id="multi_dob"   placeholder="Date Of Birth / Registration Date" class="" /> 
			</div>
			<div class="field-login ">
				<p class="forget-pass" style="position: relative;z-index: 99999; display:none"><a href="javascript:void(0);" class="a_dob" style="float: left;">Reset Via Regs. Date</a>
				<a href="javascript:void(0);" class="a_reg" style="float: left; display:none;">Reset Via DOB</a>
				</p>
			</div>
			
		</div>
		
		<div class="phase1" style="display:none;">
			
			<div class="field-login" >
				<input type="email" style="display:none;" name="email"  id="email_address"   placeholder="Enter Registered Email Id" class="" />
				<input type="button" onClick="return email_aspotp();" value="Send OTP on Email" class="login-btn" style="background:#86162d;">				
				
			</div>
			<br><br>
			
			<div class="field-login">
				<input type="text" name="email_otp" required  id="email_otp"   placeholder="Enter OTP Received On Email" /> 
				
			</div>
			
		</div>
		<div class="phase2" style="display:none;">
			<div class="field-login">
				<input type="button" onClick="return request_bothOtp();" value="Send OTP on Mobile" class="login-btn" style="background:#86162d;">
			</div>
			<div class="field-login" style="text-align:center; margin-top:15px; display:none">
				<input type="text" value="+86" name="mobile"  id="mobile_code1"   placeholder="" class="mobile-number-input phonevalidation" /> 
				<div class="verify-button">
					<button type="button" onClick="return request_bothOtp();" class="btn btn-primary" style="margin-left: 9px;">OTP</button>
				</div>
			</div>
			<br><br>
			
			<div class="field-login" style="text-align:center;">
				<input type="text" name="mobile_otp" required  id="mobile_otp"   placeholder="Enter OTP Received On Mobile" /> 
				
			</div>
			
			
		</div>
		
		<div class="phase3" style="display:none;">
			<div class="field-login" style="text-align:center;">
				<input type="text" minlength="5" class="phonevalidation" maxlength="5" name="new_asp" required  id="asp_pin"   placeholder="ENTER NEW ASP PIN" /> 
				
			</div>
			
			<div class="field-login">
				<input type="text" class="phonevalidation" name="" required  id="casp_pin"   placeholder="CONFIRM ASP PIN" /> 
				
			</div>
		</div>
		
			<div class="field-login ">
				<p class="forget-pass" ><a href="index.php">Return To Login</a></p>
			</div>
			<div class="field-login phase00">
				<input type="button" onClick="return process_dob();" value="NEXT" class="login-btn">
			</div>
			
			<div class="field-login phase1" style="display:none;" >
				<input type="button" onClick="return email_aspverify();" value="VERIFY" class="login-btn">
			</div>
			<div class="field-login phase2" style="display:none;">
				<input type="button" onClick="return verify_bothOtp();" value="VERIFY" class="login-btn">
			</div>
			
			<div class="field-login phase3" style="display:none;">
				<input type="submit" value="Update ASP Pin" class="login-btn">
			</div>
			
			<div class="field-login phase4" style="display:none;">
			    <p class="text-center text-danger">Your ASP pin updated successfully.</p>
				 <p class="text-center">Do You Want to Quick update Account password?</p>
				 <p class="forget-pass"><a href="index.php">Return To Login</a></p>
				<input type="button" onClick="$('.phase4').hide(); $('.phase5').show();" value="Yes" class="login-btn">
				<input type="button" onClick="location.reload();" value="Skip" class="login-btn">
			</div>
			<div class="field-login phase5" style="display:none;">
				<input placeholder="Enter New Password" minlength="6"  id="cnpass" name="password" type="password">
				<input placeholder="Confirm Password" minlength="6"  id="cspass" type="password">
				<p class="forget-pass"><a href="index.php">Return To Login</a></p>
			</div>
			
			<div class="field-login phase5" style="display:none;">
				<input type="button" onClick="return recent_changePass();" value="Update PASSWORD" class="login-btn">
			</div>
	</form>
		<p class="text-center create-link">
			Don't have an account? <a href="verification.php">Create account</a>
		</p>
	</div>
	
  </div>
  
     
	<script src="build/js/intlTelInput.js"></script>
    <script>
    $("#mobile_code").intlTelInput({
		preferredCountries: ['cn', 'pk'],
		//separateDialCode: true,
      utilsScript: "build/js/utils.js"
    });
	</script>
	<script>

	$(document).ready(function(){
		$(".phonevalidation").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        } 
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    }); 
	

	});

	</script>
  </body>