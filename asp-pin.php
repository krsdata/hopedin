<?php include 'include/header.php';
include 'include/head.php';
?>
    
  
  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<?php include 'include/profile_menu.php';
			?>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Account Privacy<span style="float:right; margin-left:15px;"><a href="javascript:void(0);" onclick="$('#profile_submit').trigger('click');" >Save <i class="fa fa-check"></i></a></span>
					 </h4>
					
					<div class="public-profile genral-profile-acc signup-form">
					   
					<form method="post" onsubmit="return asp_submit();" id="asp_form" >	
					<div class="genral-information-section">
							
						<div class="field-login sign-input">
						<label>Enter Old ASP Pin</label>
						<input class="phonevalidation" minlength="5" maxlength="5" type="text" required name="old_asp" Placeholder="Old ASP Pin">
						<span class="input-icon"><i class="fa fa-user"></i></span>
						</div>
						<div class="field-login sign-input">
						<label>Enter New ASP Pin</label>
						<input class="phonevalidation" minlength="5" maxlength="5" type="text" required name="new_asp" Placeholder="New ASP Pin">
						<span class="input-icon"><i class="fa fa-user"></i></span>
						</div>
						<div class="field-login sign-input">
						<label>Enter Account Password</label>
						<input type="password" required name="password" />
						<span class="input-icon"><i class="fa fa-user"></i></span>
						</div>
						<button type="submit" id="profile_submit" style="display:none" >Save</button>
					</div>
					</form>
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	<script>
	$(document).ready(function(){		
		$(".phonevalidation").keydown(function (e) {
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||             (e.keyCode >= 35 && e.keyCode <= 40)) {                 return;        }         if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {            e.preventDefault();        }    
			}); 	
	});
	
	</script>
	

  </body>