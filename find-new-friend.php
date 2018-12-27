<?php include 'include/header.php';
include 'include/head.php';
?> 

  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<?php include 'include/friend_menu.php'; ?>
			<div class="col-sm-9 right-content">
				<div class="main-right">
					<h4 class="chat-name">Find New Friends</h4>
					
					<div class="public-profile">
					 <form action="profile-page.php" method="GET" >
						<div class="find-new">
							<input type="text" required name="keyword" placeholder="Email / Account ID / Phone">
							<span class="search-ico"><a href="#"><i class="fa fa-search"></i></a></span>
						</div>
				        </form>						
											
						<div class="acr">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									  <a href="#"><i class="fa fa-qrcode" style="float:left; margin-top:3px; margin-right:15px;"></i>Scan QR Code <span><i class="fa fa-angle-right"></i></span>
									   </a>
									</h4>
								  </div>
								  
								</div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#"><i class="fa fa-globe" style="float:left; margin-top:3px; margin-right:15px;"></i>Look In Near By <span><i class="fa fa-angle-right"></i></span></a>
        </h4>
      </div>
      
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#"><i class="fa fa-address-book" style="float:left; margin-top:3px; margin-right:15px;"></i>Add Phone Contact <span><i class="fa fa-angle-right"></i></span></a>
        </h4>
      </div>
      
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#"><i class="fab fa-facebook-f" style="float:left; margin-top:3px; margin-right:15px;"></i>Add Facebook Friend <span><i class="fa fa-angle-right"></i></span></a>
        </h4>
      </div>
      
    </div>
	
	
  </div> 
						</div>
						
						
						
						
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
  </div>
  
     
	

  </body>