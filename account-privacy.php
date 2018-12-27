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
					<h4 class="chat-name">Account Privacy
					 </h4>
					
					<div class="public-profile genral-profile-acc signup-form">
					   
					   <div id="check_parent" class="acr">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
								  <div class="panel-heading">
									<h4 class="panel-title">
									<?php 
										$checked="";
										if($row['add_via_email']==1)
										{
											$checked="checked";
										}
									?>
									  <a href="javascript:void(0);">Allow user to add me via email <span><label class="switch">
										  <input data-name="add_via_email" type="checkbox" <?php echo $checked; ?> >
										  <span class="slider"></span>
										</label></span>
									   </a>
									</h4>
								  </div>
								  
								</div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<?php 
			$checked="";
			if($row['add_via_phone']==1)
			{
				$checked="checked";
			}
		?>
          <a href="javascript:void(0);">Allow user to add me via phone number <span><label class="switch">
  <input type="checkbox" data-name="add_via_phone" <?php echo $checked; ?> >
  <span class="slider"></span>
</label></span></a>
        </h4>
      </div>
      
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<?php 
			$checked="";
			if($row['add_via_accid']==1)
			{
				$checked="checked";
			}
		?>
          <a href="javascript:void(0);">Allow user to add me via Account ID <span><label class="switch">
  <input type="checkbox" data-name="add_via_accid" <?php echo $checked; ?> >
  <span class="slider"></span>
</label></span></a>
        </h4>
      </div>
      
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<?php 
			$checked="";
			if($row['add_via_contact']==1)
			{
				$checked="checked";
			}
		?>
          <a href="javascript:void(0);">Allow user to add me via contact card <span><label class="switch">
  <input type="checkbox" data-name="add_via_contact" <?php echo $checked; ?> >
  <span class="slider"></span>
</label></span></a>
        </h4>
      </div>
      
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<?php 
			$checked="";
			if($row['add_group']==1)
			{
				$checked="checked";
			}
		?>
          <a href="javascript:void(0);">Allow user to add me from group <span><label class="switch">
  <input type="checkbox" data-name="add_group" <?php echo $checked; ?> >
  <span class="slider"></span>
</label></span></a>
        </h4>
      </div>
      
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<?php 
			$checked="";
			if($row['hide_posts']==1)
			{
				$checked="checked";
			}
		?>
          <a href="javascript:void(0);">Hide my all post from timeline <span><label class="switch">
  <input type="checkbox" data-name="hide_posts" <?php echo $checked; ?> >
  <span class="slider"></span>
</label></span></a>
        </h4>
      </div>
      
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<?php 
			$checked="";
			if($row['seen_message']==1)
			{
				$checked="checked";
			}
		?>
          <a href="javascript:void(0);">Do not show my seen Message <span><label class="switch">
  <input type="checkbox" data-name="seen_message" <?php echo $checked; ?> >
  <span class="slider"></span>
</label></span></a>
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