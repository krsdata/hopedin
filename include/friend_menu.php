<script>
$(document).ready(function(){
  $("#contact_user").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".mine_record li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>
			<div class="col-sm-3 side-menu">
				<div class="search-menu">
					<input type="text" id="contact_user" placeholder="Search here">
					<span class="search-ico"><a href="#"><i class="fa fa-search"></i></a></span>
				</div>
				<ul class="side-menu-list mine_record">													
					<li><a href="find-new-friend.php"><span class="menu-icon"><i class="fa fa-search-plus"></i></span> Find New Friends</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<?php 
					$data2=$db->Get_my_requests(); 
					$count2=mysqli_num_rows($data2);
					?>
					<li class=""><a href="freind-request.php"><span class="menu-icon"><i class="fa fa-user-plus"></i></span> </span> Friend Requests</a> <span class="right-ico">
					<span class="count_request1"><?php if($count2){ ?><span class="badge"><?php echo $count2; ?></span><?php } ?></span><i class="fa fa-angle-right"></i>
					</span></li>
					<li><a href="#" data-toggle="modal" data-target="#group_modals"><span class="menu-icon"><i class="fa fa-users"></i></span> Group Chat</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="#"><span class="menu-icon"><i class="fa fa-podcast"></i></span> Broadcast</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<li><a href="tags.php""><span class="menu-icon"><i class="fa fa-tags"></i></span> Tags</a> <span class="time">10:30 am</span> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<?php $data1=$db->Get_my_friends();
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
						  while($row1=mysqli_fetch_array($data1))
						  {
							 
							?>
							<li class="chat-selected"><a class="get_chat" href="profile-page.php?id=<?php echo $row1['id']; ?>"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span> <?php echo explode(" ",$row1['fname'])[0]; ?> <span class="right-ico"> <i class="fa fa-angle-right"></i></span></a>  </li>
							<?php
						  }
						  }
						  else 
						  {
							  ?>
							  <p class="alert alert-danger text-center">No Friends Yet!</p>
							  <?php
						  }
					?>
					
					<div class="manu-tabs">
					 <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Contact</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Favorite</a></li>
                                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">My Guardian</a></li>
                                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">My Clients</a></li>
                                    </ul>
									 <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="home"><?php $data1=$db->Get_my_friends();
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
						  while($row1=mysqli_fetch_array($data1))
						  {
							 
							?>
							<li class="chat-selected"><a class="get_chat" href="profile-page.php?id=<?php echo $row1['id']; ?>"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span> <?php echo explode(" ",$row1['fname'])[0]; ?> <span class="right-ico"> <i class="fa fa-angle-right"></i></span></a>  </li>
							<?php
						  }
						  }
						  else 
						  {
							  ?>
							  <p class="alert alert-danger text-center">No Friends Yet!</p>
							  <?php
						  }
					?></div>
                                        <div role="tabpanel" class="tab-pane" id="profile"><?php $data1=$db->Get_my_friends();
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
						  while($row1=mysqli_fetch_array($data1))
						  {
							 
							?>
							<li class="chat-selected"><a class="get_chat" href="profile-page.php?id=<?php echo $row1['id']; ?>"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span> <?php echo explode(" ",$row1['fname'])[0]; ?> <span class="right-ico"> <i class="fa fa-angle-right"></i></span></a>  </li>
							<?php
						  }
						  }
						  else 
						  {
							  ?>
							  <p class="alert alert-danger text-center">No Friends Yet!</p>
							  <?php
						  }
					?>
					</div>
                                        <div role="tabpanel" class="tab-pane" id="messages">
										<?php $data1=$db->Get_my_friends();
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
						  while($row1=mysqli_fetch_array($data1))
						  {
							 
							?>
							<li class="chat-selected"><a class="get_chat" href="profile-page.php?id=<?php echo $row1['id']; ?>"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span> <?php echo explode(" ",$row1['fname'])[0]; ?> <span class="right-ico"> <i class="fa fa-angle-right"></i></span></a>  </li>
							<?php
						  }
						  }
						  else 
						  {
							  ?>
							  <p class="alert alert-danger text-center">No Friends Yet!</p>
							  <?php
						  }
					?>
										</div>
                                        <div role="tabpanel" class="tab-pane" id="settings">
											<?php $data1=$db->Get_my_friends();
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
						  while($row1=mysqli_fetch_array($data1))
						  {
							 
							?>
							<li class="chat-selected"><a class="get_chat" href="profile-page.php?id=<?php echo $row1['id']; ?>"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span> <?php echo explode(" ",$row1['fname'])[0]; ?> <span class="right-ico"> <i class="fa fa-angle-right"></i></span></a>  </li>
							<?php
						  }
						  }
						  else 
						  {
							  ?>
							  <p class="alert alert-danger text-center">No Friends Yet!</p>
							  <?php
						  }
					?>
										</div>
                                    </div>	
						
				</ul>
				
				
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