$(document).ready(function(){
	$(".phonevalidation").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        } 
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
$(window).load(function(){
	setInterval(update_chat,12000); 
	setInterval(chat_unread_msg,8000);        	
});
$(document).on('click','.exam_cancel',function(){
	if(confirm('Are you want to cancel this exam form?'))
	{
		location.reload();
	}
});
$(document).on('click','.a_dob',function(){
	$('.a_dob').hide();
	$('.a_reg').show();
	$('#multi_dob').val('');
	$('#multi_dob').attr('data-val','regs');
	$('#multi_dob').attr('placeholder','Registration Date');
});
$(document).on('click','.a_reg',function(){
	$('.a_dob').show();
	$('.a_reg').hide();
	$('#multi_dob').val('');
	$('#multi_dob').attr('data-val','dob');
	$('#multi_dob').attr('placeholder','Date Of Birth');
});
$(document).on('keyup','.emoji-wysiwyg-editor',function(event){
//$('#chat_text').keyup(function(event){ 
    var keyCode = (event.keyCode ? event.keyCode : event.which); 
    if (keyCode == 13) {
		    $('.emoji-wysiwyg-editor').blur();
			chat_start();
		
    }
});
$(document).on('click','.my_record_file',function(){
	$('#show_model').modal('show');
	$('#show_model .modal-body').html($(this).clone());
	$('#show_model .modal-body audio').removeClass('my_record_file');
	$('#show_model .modal-body video').removeClass('my_record_file');
	$('#show_model .modal-body video').attr('controls','controls');
	
});
$(document).on('click','.gets_emojis img',function(){
	$('.emoji-wysiwyg-editor').append($(this).clone());
});

$(document).on('keydown','#mobile_code',function(e){
	var myval=$(this).val();
	if($(this).val()=='+' && e.keyCode==8)
	{
		e.preventDefault();
	}
	if(myval=='')
	{
		$(this).val('+');
	}
});

$(document).on('click','.add_new_friend',function(){
	var rid=$(this).data('id');
	$.ajax({
		url:"process/process.php?action=add_new_friend",
		type:"POST",
		data:{'rid':rid},
		beforeSend:function()
		{
			$('.add_new_friend').prop('disabled',true);
		},
		success:function(data)
		{
			$('.add_new_friend').prop('disabled',false);
			$('.my_btn'+rid).html('Requested');
			$('.my_btn'+rid).removeClass('add_new_friend');
		}
	});
});
$(document).on('click','.get_chat',function(){
	var id=$(this).data('id');
	var gp=$(this).data('group');
	$('.cout'+id).hide();
	$.ajax({
		url:"process/process.php?action=get_chat_side",
		type:"POST",
		data:{'id':id,'group':gp},
		//dataType: "json",
		success:function(data)
		{
			$('.right_chat').html(data);
			window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: 'lib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
        Initialize();

            // Handle on start recording button
            document.getElementById("start-btn").addEventListener("click", function(){
                startRecording();
            }, false);

            // Handle on stop recording button
            document.getElementById("stop-btn").addEventListener("click", function(){
                // Use wav format
               $('#start-btn').show();
            	$('#stop-btn').hide();
                var _AudioFormat = "audio/wav";
                // You can use mp3 to using the correct mimetype
                //var AudioFormat = "audio/mpeg";

                stopRecording(function(AudioBLOB){
                    // Note:
                    // Use the AudioBLOB for whatever you need, to download
                    // directly in the browser, to upload to the server, you name it !

                    // In this case we are going to add an Audio item to the list so you
                    // can play every stored Audio
                    //alert(AudioBLOB);
                    //alert(AudioBLOB);
					console.log(AudioBLOB);
                    var url = URL.createObjectURL(AudioBLOB);
                   var li = document.createElement('li');
                    var au = document.createElement('audio');
                    var hf = document.createElement('a');
					var filename = new Date().toISOString();
                    au.controls = true;
                    au.src = url;
                    hf.href = url;
                    // Important:
                    // Change the format of the file according to the mimetype
                    // e.g for audio/wav the extension is .wav 
                    //     for audio/mpeg (mp3) the extension is .mp3
                    hf.download = new Date().toISOString() + '.wav';
                    hf.innerHTML = hf.download;
                    li.appendChild(au);
                    li.appendChild(hf);
					var upload = document.createElement('a');
					upload.href="#";
					upload.innerHTML = "Upload";
					upload.addEventListener("click", function(event){
						  /*var xhr=new XMLHttpRequest();
						  xhr.onload=function(e) {
							  if(this.readyState === 4) {
								  console.log("Server returned: ",e.target.responseText);
							  }
						  };*/
						  var fd=new FormData();
						  fd.append("audio_data",AudioBLOB, filename);
						  $.ajax({
								url:"process/process.php?action=add_recordFile&id="+id,
								type:"POST",
								async: false,
								data:fd,
								contentType: false,
								processData:false,
								beforeSend:function()
								{
									$('.loader1').show();
								},
								success:function(data)
								{
									$('.loader1').hide();
									update_chat();
								}
						  });
						  /*xhr.open("POST","process/process.php?action=add_recordFile&id="+id,true);
						  xhr.send(fd);*/
					});
					li.appendChild(document.createTextNode (" "))//add a space in between
					li.appendChild(upload);
                    //$('#recordingsList').append(li);
					upload.click();
                }, _AudioFormat);
            }, false);
			update_chat();
		}
	});
	
});
function blobToDataURL(blob, callback) {
    var a = new FileReader();
    a.onload = function(e) {callback(e.target.result);}
    a.readAsDataURL(blob);
}

$(document).on('change','#check_parent input',function(){
	var name=$(this).data('name');
	var act=0;
	if($(this).is(':checked'))
	{
		var act=1;
	}
	$.ajax({
		url:"process/process.php?action=check_allow",
		type:"POST",
		data:{'act':act,'name':name},
		success:function(data)
		{
			if(act==1)
			{
				alert('Checked!');
			}
			return false;
		}
	});
});
/*function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				
				document.getElementById('results').innerHTML = 
					'<h2>Processing:</h2>';
					
				Webcam.upload( data_uri, 'saveimage.php', function(code, text) {
					document.getElementById('results').innerHTML = 
					'<h2>Capture:</h2>' + 
					'<img id="sel_camera" src="'+text+'"/>';
				} );	
			} );
}*/

function updates_submit()
{
	$.ajax({
		url : "process/process.php?action=updates_submit",
		type: "POST",
		data : new FormData($('#create_updates')[0]),
		contentType: false,
		cache: false,
		processData:false,
		beforeSend:function()
		{
			$('.spin_btn').prop('disabled',true);
			$('.spin_loader').show();
		},
		success:function(data) 
		{
				$('.spin_btn').prop('disabled',false);
				$('.spin_loader').hide();
				var data=$.trim(data);
				$('#create_updates')[0].reset();
				alert('Group info has been updated successfully!');
				return false;
		}
		});
	return false;
}
function process_new_members(rid)
{
	var arr = new Array();
	$(".new_users").each(function(){
        if($(this).is(':checked'))
		{
			arr.push($(this).val());
		}
    });
	
	if(arr.length)
	{
		//var reciver_id=$('#reciver_id').val();
		$.ajax({
		url : "process/process.php?action=process_new_members",
		type: "POST",
		data : {'rid':rid,'list':arr},
		success:function(data) 
		{
			$('#adds_group').modal('hide');
			$(".new_users").prop('checked',false);
			alert('New Member Added Successfully!');
			return false;
		}
		});
	}
	else 
	{
		alert('Please select at least one contact!');
		return false;
	}
	return false;
}

function create_submit()
{
	var arr = new Array();
	$(".group_users").each(function(){
        if($(this).is(':checked'))
		{
			arr.push($(this).val());
		}
    });
	
	if(arr.length)
	{
		//var reciver_id=$('#reciver_id').val();
		$.ajax({
		url : "process/process.php?action=create_submit",
		type: "POST",
		data : new FormData($('#create_form')[0]),
		contentType: false,
		cache: false,
		processData:false,
		beforeSend:function()
		{
			$('.spin_btn').prop('disabled',true);
			$('.spin_loader').show();
		},
		success:function(data) 
		{
				$('.spin_btn').prop('disabled',false);
				$('.spin_loader').hide();
				var data=$.trim(data);
				$('#group_modals').modal('hide');
				$(".group_users").prop('checked',false);
				update_chat();
				return false;
		}
		});
	}
	else 
	{
		alert('Please select at least one contact!');
		return false;
	}
	return false;
}
function remove_member(rid,uid)
{
	$.ajax({
		url : "process/process.php?action=remove_member",
		type: "POST",
		data : {'rid':rid,'uid':uid},
		success:function(data) 
		{
			$('.unique'+uid).remove();
			alert('Removed successfully!');
			return false;
		}
	});
}
function add_new_friend(rid)
{
	$.ajax({
		url : "process/process.php?action=add_new_friends",
		type: "POST",
		data : {'rid':rid},
		beforeSend:function()
		{
			$('#cost_btn').html('Add New Friend <i class="fa fa-spinner" aria-hidden="true"></i>');
		},
		success:function(data) 
		{
			$('#cost_btn').html('Add New Friend');
			$('#infos_group').modal('hide');
			$('.new-members').html(data);
			$('#adds_group').modal('show');
			return false;
		}
	});
}
function share_all_contact()
{
	var arr = new Array();
	$(".my_selects").each(function(){
        if($(this).is(':checked'))
		{
			arr.push($(this).val());
		}
    });
	
	if(arr.length)
	{
		var reciver_id=$('#reciver_id').val();
		var gp=$('#reciver_id').data('val');
		$.ajax({
		url : "process/process.php?action=share_all_contact",
		type: "POST",
		data : {'id':reciver_id,'contact':arr,'group':gp},
		success:function(data) 
		{
				var data=$.trim(data);
				$('#contact-share').modal('hide'); 
				$(".my_selects").prop('checked',false);
				update_chat();
				return false;
		}
		});
	}
	else 
	{
		alert('Please select at least one contact!');
		return false;
	}
}
function capture_photo()
{
	var captures=$('#campture_url').attr('src');
	var reciver_id=$('#reciver_id').val();
	var gp=$('#reciver_id').data('val');
	$.ajax({
    url : "process/process.php?action=capture_photo",
    type: "POST",
    data : {'id':reciver_id,'capture':captures,'group':gp},
    success:function(data) 
	{
			var data=$.trim(data);
			$('#results').html('');
			$('.camera_start').show();
			$('.camera_stop').hide();
			Webcam.reset();
			update_chat();
			return false;
	}
	});
	return false;	
}
function upload_camera()
{
	var img=$('#sel_camera').attr('src');
	img=img.split('/');
	img=img[2];
	if(img)
	{
		var reciver_id=$('#reciver_id').val();
		var gp=$('#reciver_id').data('val');
		$.ajax({
		url:"process/process.php?action=upload_camera",
		type:"POST",
		data:{'id':reciver_id,'file':img,'group':gp},
		success:function(data)
		{
			$('#cameraModal').modal('hide');
			update_chat();
			return false;
		}
		});
	}
}	

function showLocation(position){
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
	if(latitude && longitude)
	{
	var reciver_id=$('#reciver_id').val();
	var group=$('#reciver_id').data('val');
		$.ajax({
		url:"process/process.php?action=upload_location",
		type:"POST",
		data:{'id':reciver_id,'latitude':latitude,'longitude':longitude,'group':group},
		success:function(data)
		{
			update_chat();
			return false;
		}
	});
	}
	
    console.log(latitude+" "+longitude);
}
function update_chat()
{
	var reciver_id=$('#reciver_id').val();
	var group=$('#reciver_id').data('val');
	if(reciver_id)
	{
		$.ajax({
		url:"process/process.php?action=update_chat",
		type:"POST",
		dataType: "json",
		data:{'id':reciver_id,'group':group},
		success:function(data)
		{
			$('.chat-screen').html('');
			if(data.chat)
			{
				$.each(data.chat, function (index, value) {
					var min_file=''
					if(value.file)
					{
						var types=value.types.split("/");
						types1=types[0];
						if(types1=='image')
						{
							min_file='<a target="_blank" href="img/chat_files/'+value.file+'"><img src="img/chat_files/'+value.file+'" height="200" /></a>';
						}
						else if(types1=='video')
						{
							min_file='<video width="320" height="240" class="my_record_file" ><source src="img/chat_files/'+value.file+'" type="video/mp4">Your browser does not support the video tag.</video> ';
						}
						else if(types1=='audio')
						{
							min_file=' <audio class="my_record_file" controls><source src="img/chat_files/'+value.file+'" type="audio/mpeg"> Your browser does not support the audio tag.</audio>  ';
						}
						else if(types1=='record')
						{
							min_file=' <audio class="my_record_file" controls><source src="'+value.file+'" type="audio/mpeg"> Your browser does not support the audio tag.</audio>  ';
						}
						else if(types1=='location')
						{
							min_file='<a target="_blank" href="map.php?points='+value.points+'"> <img src="img/'+value.file+'" height="200"></a>';
						}
						else if(types1=='contact')
						{
							min_file='<a class="shared_contacts" href="profile-page.php?id='+value.contacts+'"><p><b>Shared Contact</b></p> <br>'+value.contact_info+'</a>';
						}
						else 
						{
							min_file='<a target="_blank" href="img/chat_files/'+value.file+'"><img src="img/file.png" height="50" /></a>';
						}
					}
					if(reciver_id==value.id || (group=='1' && data.current!=value.sender))
					{
						$('.chat-screen').append('<div class="chat-recv"><div class="chat-pic"><img src="uploads/'+value.profile+'"></div><div class="chat-get"><p class="chat-content">'+value.msg+min_file+'</p><span>'+value.cdate+'</span></div></div>');
					}
					else 
					{
						var deliver='';
						var green='';
						if(value.deliver==1)
						{
							deliver='<i class="fa fa-check" aria-hidden="true"></i>';
						}
						if(value.status==1)
						{
							var green='mark_green';
							deliver='<i class="fa fa-check" aria-hidden="true"></i>';
						}
						$('.chat-screen').append('<div class="chat-recv"><div class="chat-get bg-green"><p class="chat-content">'+value.msg+min_file+'</p><span>'+value.cdate+'</span></div><div class="chat-pic"><img src="uploads/'+value.profile+'"></div><div class="check_mark '+green+'"><i class="fa fa-check" aria-hidden="true"></i>'+deliver+'</div></div>');
					}
				});
			}
		}
		});
	}
}
function file_submit()
{
	var group=$('#reciver_id').data('val');
	$.ajax({
    url : "process/process.php?action=file_submit&group="+group+'&id='+$('#reciver_id').val(),
    type: "POST",
    data : new FormData($('#upload_form')[0]),
    contentType: false,
    cache: false,
    processData:false,
	beforeSend:function()
	{
		$('.btn_prop').prop('disabled',true);
		$('.btn_load').show();
	},
    success:function(data) 
	{
		var data=$.trim(data);
		$('.btn_prop').prop('disabled',false);
		$('.btn_load').hide();
		$('#upload_form')[0].reset();
		$('#files_Modal').modal('hide');
		if(data=='0')
		{
			alert('Failed! File Not uploaded. Try Again..');
		}
		update_chat();
		return false;
	}
	});
	return false;
}
function chat_unread_msg()
{
	$.ajax({
		url:"process/process.php?action=chat_unread_msg",
		type:"POST",
		success:function(data)
		{
			var data=$.trim(data);
			data=data.split('@');
			
			if(data[0]>0)
			{
				$('.count_read').html('<span style="position:absolute; left: 80%;" class="badge">'+data[0]+'</span>');
			}
			else 
			{
				$('.count_read').html('');
			}
			if(data[1]>0) 
			{
				$('.count_request').html('<span style="position:absolute; left: 80%;" class="badge">'+data[1]+'</span>');
				$('.count_request1').html('<span class="badge">'+data[1]+'</span>'); 
			}
			else 
			{
				$('.count_request').html('');
				$('.count_request1').html('');
			}
			return false;
		}
	});
}
function update_contact_list()
{
	if($('#chat_users').val()=='')
	{
		
	
	$.ajax({
		url:"process/process.php?action=update_contact_list",
		type:"POST",
		success:function(data)
		{
			$('.my_contact_list').html(data);
			$('.my_contact_list li').sort(function(a,b) {
				 return $(a).data('id') < $(b).data('id');
			}).appendTo('.my_contact_list');
			return false;
		}
	});
	}
	return false;
	
}
function update_notification()
{
	$.ajax({
		url:"process/process.php?action=update_notification",
		type:"POST",
		success:function(data)
		{
			var data=$.trim(data);
			$('.count_not').hide();
			return false;
		}
	});
	return false;
}
function chat_start()
{
	var reciver_id=$('#reciver_id').val();
	var group=$('#reciver_id').data('val');
	$.ajax({
		url:"process/process.php?action=chat_start",
		type:"POST",
		data:$('#chat_msg').serialize()+'&group='+group,
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='2')
			{
				alert('Unblock friend to send a Message!');
				return false;
			}
			if(data=='3')
			{
				alert('You can not send message, your friend blocked you!');
				return false;
			}
			$('#chat_text').val('');
			$('.emoji-wysiwyg-editor').html('');
			if($('#custom_mine').val())
			{
				$('#msgModal').hide();
				alert('Message send Successfully!');
				return false;
			}

			update_chat();
			return false;
		}
	});
	return false;
}
function block_unblock(to)
{
	if($('#block_sets').is(':checked'))
	{
		var act="1";
		var msg='';
	}
	else 
	{
		var act="0";
		var msg='un';
	}
		
	$.ajax({
			url:"process/process.php?action=block_unblock",
			type:"POST",
			data:{'act':act,'to':to},
			success:function(data)
			{
				return false;
			}
		});
	
}
function Do_signup()
{
	var file=$('#uploadss').val();
	var pass=$('#pass').val();
	var cpass=$('#cpass').val();
	if(file=='')
	{
		alert('Please Upload an Photo...');
		return false;
	}
	else if(pass!=cpass)
	{
		alert('Password and confirm password should be same');
		$('#cpass').val('');
		$('#cpass').focus();
		return false;
	}
	else
	{
		var form=$('#signup_form')[0];
		var formData = new FormData(form);
		$.ajax({
			url:"process/process.php?action=Do_signup",
			type:"POST",
			data: new FormData($('#singup_form')[0]),
	        contentType: false,
	        cache: false,
	        processData:false,
	        beforeSend:function()
	        {
	        	$('.btn_prop').prop('disabled',true);
	        },
			success:function(data)
			{
				$('.btn_prop').prop('disabled',false);
				var data=$.trim(data);
				if(data=='1')
				{
					alert('Success! Registration Done Successfully. Please Login...');
					window.location.href="index.php";
				}				
				else if(data=='3')				
				{					
					alert('Sorry! Verified Mobile Number already registered!');			return false;				
				}
				else 
				{
					alert('Sorry! Email Already exists!');
					$('#uemail').focus()
					return false;
				}
			}
		});
		return false;
	}
	return false;
}
function getAge(birth) {
		  ageMS = Date.parse(Date()) - Date.parse(birth);
		  age = new Date();
		  age.setTime(ageMS);
		  ageYear = age.getFullYear() - 1970;
		  if(ageYear>0)
		  {
			  $('.age_type').val(ageYear);
		  }
		  else
		  {
			   $('.age_type').val('');
			   alert('Invalid Date Of Birth!');
			   return false;      	 
		  }

		  // ageMonth = age.getMonth(); // Accurate calculation of the month part of the age
		  // ageDay = age.getDate();    // Approximate calculation of the day part of the age
}
function asp_submit()
{
	$.ajax({
		url:"process/process.php?action=asp_form",
		type:"POST",
		data:$('#asp_form').serialize(),
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='1')
			{
				alert('ASP pin has been changed successfully!');
				$('#asp_form')[0].reset();
				return false;
			}
			else if(data=='2')
			{
				alert('Error! Invalid Password.');
				return false;
			}
			else 
			{
				alert('Error! Invalid Old ASP pin.');
				return false;
			}
		}
	});
	return false;
}
function password_submit()
{
	$.ajax({
		url:"process/process.php?action=password_submit",
		type:"POST",
		data:$('#password_form').serialize(),
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='1')
			{
				alert('Success! Password Has been changed successfully!');
				$('#password_form')[0].reset();
				return false;
			}
			else 
			{
				alert('Error! Invalid Old Password.');
				return false;
			}
		}
	});
	return false;
}

function search_new(val)
{
	$.ajax({
		url:"process/process.php?action=search_new",
		type:"POST",
		data:{'keyword':val},
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='0')
			{
				$('.find_result').html('<p class="alert alert-danger">No Result Found!</p>');
				return false;
			}
			else 
			{
				$('.find_result').html(data);
			}
		}
	});
}
function otp_forgot()
{
	$.ajax({
		url:"process/process.php?action=otp_forgot",
		type:"POST",
		data:$('#forgot_phone').serialize(),
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='0')
			{
				alert('Sorry! This mobile number is not registered.');
				return false;
			}
			else 
			{
				alert('OPT Send!');
				return false;
			}
		}
	});
}
function check_password(field)
{
	var otp=$('#mobile_otp').val();
	if(otp=='')
	{
		alert('Please enter otp.');
		return false;
	}
	else 
	{
		if(field=='mobile')
		{
			var sets={'otp':otp,"mobile":$('#mobile_code').val()};
		}
		else 
		{
			var sets={'otp':otp,"email":$('#email_code').val()};
		}
		$.ajax({
			url:"process/process.php?action=check_password",
			type:"POST",
			data:sets,
			success:function(data)
			{
				var data=$.trim(data);
				if(data=='1')
				{
					$('.phase_step1').hide();
					$('.phase_step2').show();
					return false;
				}
				else 
				{
					alert('Error! Invalid OTP. Try again...');
					return false;
				}
			}
		});
	}
}
function otp_forgot_email()
{
	$.ajax({
		url:"process/process.php?action=otp_forgot_email",
		type:"POST",
		data:$('#forgot_phone').serialize(),
		success:function(data)
		{
			var data=$.trim(data);
			if(data=='0')
			{
				alert('Sorry! This email id is not registered.');
				return false;
			}
			else 
			{
				alert('OPT Send on email!');
				return false;
			}
		}
	});
}

function reset_password()
{
	var pass=$('#cnpass').val();
	var cpass=$('#cspass').val();
	if(pass!=cpass)
	{
		alert('Password and confirm password Should be same!');
		$('#cspass').val('');
		$('#cspass').focus();
		return false;
	}
	$.ajax({
		url:"process/process.php?action=reset_password",
		type:"POST",
		data:$('#forgot_phone').serialize(),
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
				alert('Error! ASP Not match.');
				return false;
			}
			else 
			{
				alert('Error! Invalid OTP. Try again...');
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
			var data=$.trim(data);
			if(data=='1')
			{
				alert('Verification code send successfully.');
				return false;
			}
			else 
			{
				alert('Sorry! this mobile number already Exists. Please Login.');
				return false;
			}
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
					window.location.href='profile.php';
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
function forgot_phase()
{
	var pin=$('#phase_afp').val();
	var email=$('#user_emails').val();
	var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
	if(email=='')
	{
		alert('Please Enter Email Id/ Phone/ Account Id!');
		$('#user_emails').focus();
		return false;
	}
    else if(pin) 
	{
		$.ajax({
			url:"process/process.php?action=forgot_phase",
			type:"POST",
			data:{'pin':pin,'email':email},
			success:function(data)
			{
				var data=$.trim(data);
				if(data=='1')
				{
					$('.phase2').show();
					$('.phase1').hide();
					return false;
				}
				else
				{
					alert('Invalid AFP PIN! Try Again...');
					return false;
				}
			}
		});
		return false;
	}
	else
	{
		alert('Please Enter AFP Pin!');
		$('#phase_afp').focus();
		return false;
	}
}function change_subemail(){	$.ajax({		
	url:"process/process.php?action=change_subemail",		
	type:"POST",		
	data:$('#change_email').serialize(),		
	success:function(data)		{			
		var data=$.trim(data);			
		if(data=='1')			{				$('#change_email')[0].reset();				alert('Success! Your email id has been changed.');				return false;			}			else if(data=='2')			{				alert('Error! Current email does not match.');				return false;			}			else if(data=='3')			{				alert('Error! This email id already exists.');				return false;			}			else			{				alert('Invalid AFP PIN! Try Again...');				return false; 			}		}	});	return false;}
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
function session_step(val)
{
	var prev=parseInt(val)-1;
	var next=parseInt(val)+1;
	$('.class-form'+prev).hide();
	$('.class-form'+val).show();
	if(next==5)
	{
		$('#session_form').removeAttr('onsubmit');
		$('#session_btn').attr('value','Create New Session');
		$('#session_form').attr('action','process/process.php?action=session_create');
	}
	else 
	{
		$('#session_form').attr('onsubmit','return session_step('+next+');');
	}
	
	return false;
}
function quize_submit(exam)
{
	$.ajax({
			url:"process/process.php?action=quize_submit",
			type:"POST",
			dataType:'json',
			async: false,
			data:$('#quize_form').serialize()+'&exam='+exam,
			beforeSend:function()
			{
				$('#quize_form input[type="submit"]').prop('disabled',true);
				$('.prop_load').show();
			},
			success:function(data)
			{
				$('#quize_form input[type="submit"]').prop('disabled',false);
				$('#quize_form')[0].reset();
				$('.prop_load').hide();
				if(data.result==1)
				{
					if(data.next_move==0)
					{
						alert('complete the quize!');
						window.location.href='test-paper.php';
					}
					else 
					{
						alert('Added Successfully, Lets Move on to next question!');
					}
					return false;
				}
				else
				{
					alert('Error! Something went wrong. Try again...');
					return false;
				}
			}
	});
	return false;
}
/* create New exam */
function create_new_exam(val)
{
	$('.content'+val).hide();
	val++;
	if(val==4)
	{
		$('.content'+val+' .exam-input').attr('required','required');
		$('#for_create_exam').removeAttr('onsubmit');
		$('#for_create_exam').attr('action','process/process.php?action=create_new_exam');
	}
	else {
		$('#for_create_exam').attr('onsubmit','return create_new_exam('+val+');');
		$('.content'+val+' .exam-input').attr('required','required');
		
	}
	$('.content'+val).show();
	return false
}
function test_safety()
{
	var safety1=$('.safety1').val();
	var safety2=$('.safety2').val();
	if(safety1=='' || safety2=='' )
	{
		alert('Please enter safety pin!');
		$('.safety1').focus();
		return false;
	}
	if(safety1.length<4)
	{
		alert('Pin must be minimum 4 character!');
		$('.safety1').focus();
		return false;
	}
	if(safety1!=safety2)
	{
		alert('Confirm safety pin does Not match with pin!');
		$('.safety2').focus();
		return false;
	}
	$('.set_pin_action').removeAttr('onclick');
	$('.set_pin_action').html('Setted');
	$('#myDIV1').hide();
}
function test_time()
{
	var time_set=$('.time_set').val();	 
	if(time_set=='')
	{
		alert('Please enter time!');
		$('.time_set').focus();
		return false;
	}
	$('.time_action').removeAttr('onclick');
	$('.time_action').html('Setted');
	$('#myDIV2').hide();
}
function test_marks()
{
	var time_set=$('.percents').val();	 
	if(time_set=='' || time_set<1)
	{
		alert('Invalid marks!');
		$('.percents').focus();
		return false;
	}
	$('.marks_action').removeAttr('onclick');
	$('.marks_action').html('Setted');
	$('#myDIV3').hide();
}
function attempt_allows()  
{
	var time_set=$('.allow_text').val();	 
	if(time_set=='' || time_set<1)
	{
		alert('Invalid Input!'); 
		$('.allow_text').focus();
		return false;
	}
	$('.attempt_action').removeAttr('onclick');
	$('.attempt_action').html('Setted');
	$('#myDIV4').hide();
} 


/* End New exam */

