<div class="container">
	<div class="content">
		<div class="control-group">
			<div class="page-header">
				<h1>User Profile for <?=$username?></h1>
			</div>
			<?php 
			if($this -> session -> userdata('is_logged_in') == TRUE)
			{?>
				<p><?=anchor('profile/edit_profile/'.$username, 'Edit Profile')?></p>
			<?php }?>
			<div class="controls" style="margin-bottom: 1em">
				First Name: <?=$first_name?>
			</div>
			
			<div class="controls" style="margin-bottom: 1em">
				Last Name: <?=$last_name?>
			</div>
			
			<div class="controls" style="margin-bottom: 1em">
				Email Address: <?=$email_address?>
			</div>
		</div>	
	</div>	
</div>