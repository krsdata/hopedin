<?php include 'include/header.php';
include 'include/head.php';
?> 
  
  <div class="dashboard-content">
  	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 side-menu">
				<div class="search-menu">
					<input type="text" placeholder="Search here">
					<span class="search-ico"><a href="#"><i class="fa fa-search"></i></a></span>
				</div>
				<ul class="side-menu-list">
					<?php $data1=$db->Get_my_friends();
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
						  while($row1=mysqli_fetch_array($data1))
						  {
							 
							?>
							<li class="chat-selected"><a class="" href="profile-page.php?id=<?php echo $row1['id']; ?>"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span> <?php echo explode(" ",$row1['fname'])[0]; ?></a>  <span class="right-ico"> <i class="fa fa-angle-right"></i></span></li>
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
						
				</ul>
			</div>
			
		</div>
	</div>
  </div>
  
    
	

  </body>