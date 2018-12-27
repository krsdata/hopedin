<?php include 'include/header.php';
include 'include/head.php';
?> 

<script src="js/recorder.js"></script>
<script>
        // Expose globally your audio_context, the recorder instance and audio_stream
        var audio_context;
        var recorder;
        var audio_stream;

        /**
         * Patch the APIs for every browser that supports them and check
         * if getUserMedia is supported on the browser. 
         * 
         */
        function Initialize() {
            try {
                // Monkeypatch for AudioContext, getUserMedia and URL
                window.AudioContext = window.AudioContext || window.webkitAudioContext;
                navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
                window.URL = window.URL || window.webkitURL;

                // Store the instance of AudioContext globally
                audio_context = new AudioContext;
                console.log('Audio context is ready !');
                console.log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
            } catch (e) {
                alert('No web audio support in this browser!');
            }
        }
 
        /**
         * Starts the recording process by requesting the access to the microphone.
         * Then, if granted proceed to initialize the library and store the stream.
         *
         * It only stops when the method stopRecording is triggered.
         */
        function startRecording() {
            // Access the Microphone using the navigator.getUserMedia method to obtain a stream
			navigator.getUserMedia = (
				navigator.getUserMedia ||
				navigator.webkitGetUserMedia ||
				navigator.mozGetUserMedia ||
				navigator.msGetUserMedia
			);
            navigator.getUserMedia({ audio: true }, function (stream) {
                // Expose the stream to be accessible globally
                audio_stream = stream;
                // Create the MediaStreamSource for the Recorder library
                var input = audio_context.createMediaStreamSource(stream);
                console.log('Media stream succesfully created');

                // Initialize the Recorder Library
                recorder = new Recorder(input);
                console.log('Recorder initialised');

                // Start recording !
                recorder && recorder.record();
                console.log('Recording...');
                $('#start-btn').hide();
            	$('#stop-btn').show();
                // Disable Record button and enable stop button !
                document.getElementById("start-btn").disabled = true;
                document.getElementById("stop-btn").disabled = false;
            }, function (e) {
                console.error('No live audio input: ' + e);
            });
        }

        /**
         * Stops the recording process. The method expects a callback as first
         * argument (function) executed once the AudioBlob is generated and it
         * receives the same Blob as first argument. The second argument is
         * optional and specifies the format to export the blob either wav or mp3
         */
        function stopRecording(callback, AudioFormat) {
            // Stop the recorder instance
            recorder && recorder.stop();
            console.log('Stopped recording.');

            // Stop the getUserMedia Audio Stream !
            audio_stream.getAudioTracks()[0].stop();

            // Disable Stop button and enable Record button !
            document.getElementById("start-btn").disabled = false;
            document.getElementById("stop-btn").disabled = true;

            // Use the Recorder Library to export the recorder Audio as a .wav file
            // The callback providen in the stop recording method receives the blob
            if(typeof(callback) == "function"){

                /**
                 * Export the AudioBLOB using the exportWAV method.
                 * Note that this method exports too with mp3 if
                 * you provide the second argument of the function
                 */
                recorder && recorder.exportWAV(function (blob) {
                    callback(blob);

                    // create WAV download link using audio data blob
                    // createDownloadLink();

                    // Clear the Recorder to start again !
                    recorder.clear();
                }, (AudioFormat || "audio/wav"));
            }
        }
$(document).ready(function(){
	$("#contactss_users").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$(".added-contact-share li").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});
    </script>

<link href="https://eaglestarworld.com/lib/css/emoji.css" rel="stylesheet">
<style>

.emoji-items a 
{
	padding:3px;
}
#stop-btn
{
	  -webkit-filter: invert(40%) grayscale(100%) brightness(100%) sepia(100%) hue-rotate(-50deg) saturate(400%) contrast(2);
      filter: grayscale(100%) brightness(100%) sepia(100%) hue-rotate(-50deg) saturate(600%) contrast(0.8);
}
</style>
<script>
$(window).load(function(){
	setInterval(update_contact_list,3000); 
});

$(document).ready(function(){
	update_contact_list();
  $("#chat_users").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".my_contact_list .chat-selected").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>

<script type="text/javascript" src="js/jquery.form.min.js"></script>

<div class="camera-div" style="position:relative; z-index:99999999999999999999999999;">
<div id="results"></div>
<div id="my_camera"></div>
</div>
<div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 side-menu">
				<ul class="side-menu-list" style="position: relative;width: 100%;height: 50px;overflow: unset; display:none;">
					<li><a href="javascript:void(0);" data-toggle="modal" data-target="#group_modals" ><span class="menu-icon"><i class="fa fa-plus" style="font-size:30px;"></i></span>Create Group</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
				</ul>
				<div class="search-menu">
					<input type="text" id="chat_users" placeholder="Search here">
					<span class="search-ico"><a href="#"><i class="fa fa-search"></i></a></span>
				</div>
				<ul class="side-menu-list my_contact_list">
					<li><a href="#"><span class="menu-icon"><i class="fa fa-mobile" style="font-size:30px;"></i></span> Mobile Chat App</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<?php $data1=$db->Get_my_friend_chat(); 
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
						  while($row1=mysqli_fetch_array($data1))
						  {
							  $mdata=$db->Get_unread_msg($row1['id']);
							  $msg_count=mysqli_num_rows($mdata);
							?>
							<li class="chat-selected"><a class="get_chat my_chatting<?php echo $row1['id']; ?>" data-id="<?php echo $row1['id']; ?>" href="javascript:void(0);"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span> <?php echo explode(" ",$row1['fname'])[0]; ?> <span class="time"><?php if($row1['cdate']){ echo $db->humanTiming(strtotime($row1['cdate']))." ago"; } ?></span>  <span class="right-ico"><?php if($msg_count){ ?><span class="badge cout<?php echo $row1['id']; ?>"><?php echo $msg_count; ?></span><?php } ?> <i class="fa fa-angle-right"></i></span></a> </li>
							<?php
						  }
						  }
						  else 
						  {
							  ?>
							  <p class="alert alert-danger text-center">No Chat Yet!</p>
							  <?php
						  }
					?>
						
				</ul>
			</div>
			<div class="col-sm-9 right-content right_chat">   

				<?php
					
					if(isset($_REQUEST['user']))   
					{
						$data=$db->get_user_byId($_REQUEST['user']);
						$row=mysqli_fetch_assoc($data);
					?>
					<div class="main-right">
					<h4 class="chat-name"><?php echo $row['fname'] ?> <a style="color:#163962;" href="profile-page.php?id=<?php echo $row['id']; ?>"><i class="fa fa-user"></i></a></h4>
					<div class="chat-screen">
					</div>
					<div class="fix-typer">
						<div class="chat-type-board">
						   <form method="post" id="chat_msg" onsubmit="return chat_start();" >
							<div class="typer">
								<span><a href="#"><i class="fa fa-calendar"></i></a></span>
								<span class="laod-aud"><a href="javascript:void(0);" id="start-btn" ><i class="fa fa-circle-o-notch fa-spin fa-fw loader1"  style="display:none;"></i><img src="img/mike.png"></a>
								<a href="javascript:void(0);" style="display:none;" id="stop-btn"><img src="img/mike.png"></a>
								</span>
								<span>
								
								<input type="text" id="chat_text" data-emojiable="true" style="display:none;" required name="msg" placeholder="Type your message">
								<div class="emoji-wysiwyg-editor" onblur="$('#chat_text').val($(this).html());" data-id="8e40fb82-5d4e-462a-b5b0-d7f05ded14ef" data-type="input" placeholder="Type your message" contenteditable="true" style="height: 40px;"></div>
								<input type="hidden" id="reciver_id" value="<?php echo $row['id']; ?>" required name="rid">
								<button type="submit" id="chat_submit" style="display:none;" >send</button>
								</span>
								<span style="position: relative; right: 36px;"><a href="javascript:void(0);" id="open-emoji"><i class="fa fa-smile-o"></i></a> <div id="target-emoji">
				<ul class="gets_emojis">
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/blush.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/grinning.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/grin.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/flushed.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/frowning.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/angry.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/cry.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/disappointed_relieved.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/cold_sweat.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/fearful.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/heart_eyes.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/innocent.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/joy.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/kissing_closed_eyes.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/kissing_heart.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/laughing.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/mask.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/no_mouth.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/pensive.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/persevere.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/relieved.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/satisfied.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/scream.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/sleeping.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/sleepy.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/smile.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/smiley.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/smirk.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/sob.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/stuck_out_tongue.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/stuck_out_tongue_closed_eyes.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/stuck_out_tongue_winking_eye.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/sunglasses.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/sweat.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/tired_face.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/triumph.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/weary.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/wink.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/worried.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/yum.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/baby.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/bow.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/boy.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/girl.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/cop.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/man.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/woman.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/older_man.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/older_woman.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/bust_in_silhouette.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/busts_in_silhouette.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/clap.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/fist.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/hand.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/muscle.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/ok_hand.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/open_hands.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/point_down.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/point_up.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/punch.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/raised_hands.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/thumbsdown.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/thumbsup.png"></a></li>
					
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/walking.png"></a></li>
					<li><a href="#"><img class="emoji-icon1" src="img/emojis/runner.png"></a></li>
				</ul>
			</div>
		</span>
								<span><a onclick="$('#chat_submit').trigger('click');" href="javascript:void(0);"><i class="fa fa-arrow-circle-o-right"></i></a></span>
							</div>
						    </form>
						</div>
					
						<div class="chat-uploaders">
							
							<ul>
							<li><a href="javascript:void(0);" onclick="$('#gallery_file').trigger('click');" ><span><i  class="fa fa-folder-open"></i></span><span>Gallery</span></a>
							</li>
							<li><a href="javascript:void(0);" class="cameras camera_start" onClick="setup(); $(this).hide().next().show();"><span><i  class="fa fa-camera"></i></span><span>Camera</span></a> <a href="javascript:void(0);" class="cameras camera_stop" onClick="take_snapshot()" style="display:none"><span style="color:red;"><i  class="fa fa-camera"></i></span><span>Take Snap</span></a></li>
							<li><a href="javascript:void(0);" onclick="$('#gallery_file').trigger('click');"><span><i  class="fa fa-print"></i></span><span>Document</span></a></li>
							<li><a href="#"><span><i class="fa fa-phone"></i></span><span>Call Audio</span></a></li>
							<li><a href="#"><span><i class="fa fa-video-camera" aria-hidden="true"></i></span><span>Call Video</span></a></li>
							<li><a href="#"><span><i  class="fa fa-gift"></i></span><span>Kick In</span></a></li>
							<li><a href="#"><span><i class="fa fa-exchange"></i></span><span>Transfer</span></a></li>
							<li><a href="#"><span><i  class="fa fa-dollar"></i></span><span>Pay Free</span></a></li>
							<li><a href="#"><span><i  class="fa fa-heart"></i></span><span>Favorite</span></a></li>
							<li><a href="javascript:void(0);" onclick="return Get_geo_location();" ><span><i  class="fa fa-map"></i></span><span>Location</span></a></li>
							<li><a href="javascript:void(0);" data-toggle="modal" data-target="#contact-share"><span><i  class="fa fa-address-book"></i></span><span>Contact</span></a></li>   
						</ul> 
						</div>
					</div>
				</div>
				<div id="files_Modal" style="top:25%;" class="modal fade" role="dialog">
					  <div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Upload File:</h4>
						  </div>
						  <form action="process.php" onsubmit="return file_submit();" method="post" enctype="multipart/form-data" id="upload_form">
						  <div class="modal-body">
							<div class="form-wrap">
								<input name="file" onchange="$('#gallery_submit').click();" id="gallery_file" type="file" />
								<input type="hidden" value="<?php echo $row['id']; ?>" required name="rid">
								<!--div id="progress-wrp"><div class="progress-bar"></div ><div class="status">0%</div></div>
								<div id="output" --><!-- error or success results ></div -->
							</div>
						  </div> 
						  <div class="modal-footer">
							<button type="submit" id="gallery_submit" class="btn btn-success btn_prop">Send <i class="fa fa-spinner fa-spin fa-fw btn_load" style="display:none;"></i></button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  </div>
						  </form>
						</div>

					  </div>
				  </div>
				  <?php
					}
				?>
				<div id="contact-share" style="top:10%; z-index: 99999;" class="modal fade" role="dialog">
				  <div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header" style="padding:0px !important; background:none;">
									<h4 class="modal-title" style="background:#35b729; padding:10px;">Share Contact</h4>
									<div class="contact-search-box">
									<input type="text" id="contactss_users" style="color: black;" placeholder="Search here">
									</div>
							  </div>
							 
							  <div class="modal-body">
							   
							  <ul class="added-contact-share">
								  <?php $data1=$db->Get_my_friends();
									  $count=mysqli_num_rows($data1);
									  if($count)
									  {
										  while($row1=mysqli_fetch_array($data1))
										  {
											 
											?>
											<li class="chat-selected contact-share-list"><a class="" data-id="<?php echo $row1['id']; ?>" href="javascript:void(0);"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span><?php echo explode(" ",$row1['fname'])[0]; ?> </a><span class="right-ico check-box-add"><input class="my_selects" type="checkbox" value="<?php echo $row1['id']; ?>" name="selects[]" ></span></li>
											<?php
										  }
									  }
									  else 
									  {
										  ?>
										 <li><p class="alert alert-danger text-center">No Contacts Yet!</p></li>
										  <?php
									  }
									?>
										
									</ul>
							  </div> 
							  <div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal" style="background:#86162d; float:left; color:#fff; border:none;">Cancel</button>
							   <button type="button" onclick="return share_all_contact();" class="btn btn-default" style="background:#35b729; color:#fff; border:none;">Share Contact</button>
							  </div>
							  
							</div>

						  </div>
				</div>
			</div>
			 
		</div>
	</div>
  </div>
  
 <div id="group_modals" style="top:10%; z-index: 99999;" class="modal fade" role="dialog">
	  <div class="modal-dialog">
				<form method="post" enctype="multipart/form-data" id="create_form" onsubmit="return create_submit();" >
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header" style="padding:0px !important; background:none;">
						<h4 class="modal-title" style="background:#35b729; padding:10px;">Create New Group</h4>
						
						<div class="col-sm-12 contact-search-box">
							<div class="col-sm-6">
								<label> Group Name
									<input type="text" name="gp_name" required id="" style="color: black;" placeholder="Enter Group Name">
								</label>
							</div>
							<div class="col-sm-6">
							<label>Group Icon
								<input type="file" name="file_icon" />
							</label>
							</div>
							<div class="col-sm-6">
							<label>Member Added By Me
								<input type="radio" checked value="0" name="addedby" />
							</label>
							</div>
							<div class="col-sm-6">
							<label>Member Added By All
								<input type="radio" value="1" name="addedby" />
							</label>
							</div>
						</div>
						<hr>
						<div class="contact-search-box" style="clear:both;">
						<input type="text" id="group_users" style="color: black;" placeholder="Search here">
						</div>
				  </div>
				 
				  <div class="modal-body">
				  
				  <ul class="added-contact-share1">
					  <?php $data1=$db->Get_my_friends();
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
							  while($row1=mysqli_fetch_array($data1))
							  {
								 
								?>
								<li style="display:inline-block; width:100%" class="chat-selected contact-share-list"><a class="" data-id="<?php echo $row1['id']; ?>" href="javascript:void(0);"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span><?php echo explode(" ",$row1['fname'])[0]; ?> </a><span class="right-ico check-box-add"><input class="group_users" type="checkbox" value="<?php echo $row1['id']; ?>" name="group_users[]" ></span></li>
								<?php
							  }
						  }
						  else 
						  {
							  ?>
							 <li><p class="alert alert-danger text-center">No Contacts Yet!</p></li>
							  <?php
						  }
						?>
							
						</ul>
				  </div> 
				  <div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal" style="background:#86162d; float:left; color:#fff; border:none;">Cancel</button>
				   <button type="submit" class="btn btn-default spin_btn" style="background:#35b729; color:#fff; border:none;"> <i style="display:none;" class="fa fa-spinner fa-spin fa-fw spin_loader"></i>Create Group</button>
				  </div>
				  
				</div>
				</form>

			  </div>
</div>
<div id="show_model" style="top:25%;" class="modal fade" role="dialog">
					  <div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Now Playing:</h4>
						  </div>
						 
						  <div class="modal-body">
							
						  </div> 
						  <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  </div>
						  
						</div>

					  </div>
</div>



 
  <ol id="recordingsList" style="top:450px; position:relative; display:none;"></ol>
  <?php
if(isset($_REQUEST['info']))
{	?>
<script>
	$(document).ready(function(){
		$('.my_chatting<?php echo $_REQUEST['info']; ?>').trigger('click');
	});
</script><?php  
}
?>
<script>
function Get_geo_location()
{
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(showLocation, function(){},{maximumAge:0, timeout:10000});
        //navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        $('#location').html('Geolocation is not supported by this browser.');
	}
}

</script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
	<!--<script src="https://eaglestarworld.com/lib/js/config.js"></script>
    <script src="https://eaglestarworld.com/lib/js/util.js"></script>
    <script src="https://eaglestarworld.com/lib/js/jquery.emojiarea.js"></script>
    <script src="https://eaglestarworld.com/lib/js/emoji-picker.js"></script>-->
	<script type="text/javascript" src="js/webcam.min.js"></script>
	<script language="JavaScript">
		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
	</script>
	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		function setup() {
			Webcam.reset();
			Webcam.attach( '#my_camera' );
		}
		
		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				document.getElementById('results').innerHTML = '<img  id="campture_url" src="'+data_uri+'"/> <button type="button" onclick="return capture_photo();" class="btn btn-success">Upload</button>';
			} );
		}
		
	</script>
	<script>
		$('.Show').click(function() {
    $('#target-emoji').show(500);
    $('.Show').hide(0);
    $('.Hide').show(0);
});
$('.Hide').click(function() {
    $('#target-emoji').hide(500);
    $('.Show').show(0);
    $('.Hide').hide(0);
});
$(document).on('click','#open-emoji',function(){
	 $('#target-emoji').toggle('');
});

	</script>
    <!-- End emoji-picker JavaScript -->
	
	

   
  </body>