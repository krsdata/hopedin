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
				<ul class="side-menu-list chat_names">
					<li><a href="#"><span class="menu-icon"><i class="fa fa-mobile-alt" style="font-size:30px;"></i></span> Mobile Chat App</a> <span class="right-ico"><i class="fa fa-angle-right"></i></span></li>
					<?php $data1=$db->Get_my_friends();
						  $count=mysqli_num_rows($data1);
						  if($count)
						  {
						  while($row1=mysqli_fetch_array($data1))
						  {
							  $mdata=$db->Get_unread_msg($row1['id']);
							  $msg_count=mysqli_num_rows($mdata);
							?>
							<li class="chat-selected"><a class="get_chat my_chatting<?php echo $row1['id']; ?>" data-id="<?php echo $row1['id']; ?>" href="javascript:void(0);"><span class="menu-icon"><img src="uploads/<?php echo $row1['profile']; ?>"></span> <?php echo explode(" ",$row1['fname'])[0]; ?></a> <span class="time"><?php if($row1['cdate']){ echo $db->humanTiming(strtotime($row1['cdate']))." ago"; } ?></span>  <span class="right-ico"><?php if($msg_count){ ?><span class="badge cout<?php echo $row1['id']; ?>"><?php echo $msg_count; ?></span><?php } ?> <i class="fa fa-angle-right"></i></span></li>
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
			<div class="col-sm-9 right-content right_chat">
				
			</div>
		</div>
	</div>
  </div>
  <?php
if(isset($_REQUEST['info']))
{
	?>
	<script>
	$(document).ready(function(){
		$('.my_chatting<?php echo $_REQUEST['info']; ?>').trigger('click');
	});
	</script>
	<?php
}
?>
  
    
	

  </body>