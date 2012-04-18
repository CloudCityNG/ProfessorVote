<div class="container">
	<div class="hero-unit raised">
		<div class="control-group">
			<div class="page-header">
				<h1>User Profile for <?php echo $username;?></h1>
			</div>
			<?php 
			if($this -> session -> userdata('is_logged_in') == TRUE)
			{?>
				<p><?php echo anchor('profile/edit_profile/'.$username, 'Edit Profile')?></p>
			<?php }?>
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