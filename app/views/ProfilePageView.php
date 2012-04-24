
<div class="container">
	<ul class="breadcrumb">
		<li>
			<a href=<?php echo "/home"?>>Home</a><span class="divider">/</span>
		</li>
		<li class="active">
			Profile
		</li>
	</ul>
	<div class="hero-unit raised">
		<div class="control-group">
			<div class="page-header">
				<h1>User Profile for <?php echo $username;?></h1>
			</div>
			<?php 
			if($this -> session -> userdata('is_logged_in') == TRUE && $this -> session -> userdata('username') == $username)
			{?>
				<a data-toggle="modal" href="#editProfileModal">Edit Profile</a>
				<!--<p><?php echo anchor('profile/edit_profile/'.$username, 'Edit Profile')?></p>-->
			<?php }?>
			<div class="controls" style="margin-bottom: 1em">
				<h4>User Number: <?php echo $id;?></h4>
			</div>
			
			<div class="controls" style="margin-bottom: 1em">
				<h4>First Name: <?php echo $first_name;?></h4>
			</div>
			
			<div class="controls" style="margin-bottom: 1em">
				<h4>Last Name: <?php echo $last_name;?></h4>
			</div>
			
			<div class="controls" style="margin-bottom: 1em">
				<h4>Email Address: <?php echo $email_address;?></h4>
			</div>
		</div>	
	</div>	
</div>

<div class="modal hide fade" id="editProfileModal">
	<div class="modal-header">
		<a class="close" data-dismiss="modal" id="editProfileModalClose"><i class="icon-remove"></i></a>
		<h3>Edit Profile</h3>
	</div>
	<div class="hero-unit">
		<fieldset>
			<div class="control-group">
				<div class="modal-body">
					<?php $this -> load -> view("ProfilePageEdit", TRUE);?>
				</div>
			</div>
		</fieldset>
	</div>
</div>