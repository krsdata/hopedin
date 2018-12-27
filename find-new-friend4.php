<?php include 'include/header.php';
include 'include/head.php';
?> 

  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<?php include 'include/friend_menu.php'; ?>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Profile <a href="#"><i class="fa fa-share"></i></a></h4>
					
					<div class="public-profile">
					   						<div class="pub-pro">
							<img src="uploads/1543116493.png" alt="">
						</div>
						<div class="public-content">
							<p>Abdul Aziz</p>
							<p>Gender: female</p>
							<p>Country: 4</p>
							<p>Age: 21 Years</p>
							<!--<p>Mobile: +8615579830172</p>
							<p>Email: eaglestar6115@gmail.com</p>-->
						</div>
						<div class="acr">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="">Website <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="preference.php">Preference <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="privacy.php">Privacy <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="profile-history.php">History <span><i class="fa fa-angle-right"></i></span></a>
									</h4>
								  </div>
								  
								</div>
								
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="profile-history.php">Set As Co-ordinator <span><a class="set-click" href="#">SET</a> </span> </a>
									</h4>
								  </div>
								  
								</div>
								
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Add To Teacher <span><label class="switch">
										<input type="checkbox" id="block_sets" onchange="return block_unblock(93);">
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Add To Favorite <span><label class="switch">
										<input type="checkbox" id="block_sets" onchange="return block_unblock(93);">
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Add As Sub-Campus <span><label class="switch">
										<input type="checkbox" id="block_sets" onchange="return block_unblock(93);">
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
								
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  									  <a>Block User <span><label class="switch">
										<input type="checkbox" id="block_sets" onchange="return block_unblock(93);">
										<span class="slider"></span>
										</label></span></a>
									</h4>
								  </div>
								  
								</div>
							  </div> 
						</div>
						
						<div class="delete-user-btn">
																	<a class="chat-btn" style="margin-bottom:3px;" href="dashboard.php?user=93">Chat</a> 
										<!-- a class="chat-btn" data-toggle="modal" data-target="#msgModal" style="margin-bottom:3px;" href="javascript:void(0);">Chat</a --> 
										 <style>
										 .modal-backdrop
										 {
											 display:none;  
										 }
										 </style>
										<!-- Modal -->
										<div id="msgModal" style="top:20%;" class="modal fade" role="dialog">
										  <div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">×</button>
												<h4 class="modal-title">Send Message</h4>
											  </div>
											  <form method="post" id="chat_msg" onsubmit="return chat_start();">
											  <div class="modal-body">
												<textarea id="chat_text" required="" name="msg" class="form-control"></textarea>
												<input type="hidden" id="reciver_id" value="93" required="" name="rid">
												<input type="hidden" id="custom_mine" value="1" required="">
											  </div>
											  <div class="modal-footer">
												<button type="submit" class="btn btn-success">Send</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											  </div>
											  </form>
											</div>

										  </div>
										</div>
										<a class="" onclick="return confirm('Are you want to remove from contact?');" href="process/process.php?action=request_contact&amp;key=&amp;id=8">Delete Contact</a>
																	
						</div>
					   						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>