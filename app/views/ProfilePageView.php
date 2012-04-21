<?php $this -> load -> helper('url'); ?>
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
			if($this -> session -> userdata('is_logged_in') == TRUE)
			{?>
				<a data-toggle="modal" href="#editProfileModal">Edit Profile</a>
				<!--<p><?php echo anchor('profile/edit_profile/'.$username, 'Edit Profile')?></p>-->
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

<div class="modal hide fade" id="editProfileModal">
	<?php
	echo form_open('profile/edit_profile');
	?>
	
	<div class="modal-header">
		<a class="close" data-dismiss="modal" id="profileModalClose">X</a>
		<h3>Edit Profile</h3>
	</div>
			<div class="hero-unit">
					<fieldset>
						<div class="control-group">
							<div class="modal-body">
								<legend>
									Personal Information
								</legend>
					
								<h4>First Name:</h4>
								<div class="controls" style="margin-bottom: 1em">
									<?php
									echo form_error('first_name');
									$firstNameAttributes = array('id' => 'first_name', 'name' => 'first_name', 'class' => 'input-xlarge', 'placeholder'=> $first_name, 'focus' => 'first_name', 'type' => 'text');
									echo form_input($firstNameAttributes);
									?>				
								</div>
								
								<h4>Last Name:</h4>
								<div class="controls" style="margin-bottom: 1em">
									<?php
									echo form_error('last_name');
									$lastNameAttributes = array('id' => 'last_name', 'name' => 'last_name', 'class' => 'input-xlarge', 'placeholder' => $last_name, 'type' => 'text');
									echo form_input($lastNameAttributes);
									?>
								</div>
						
								<h4>Email Address:</h4>	
								<div class="controls" style="margin-bottom: 1em">
									<?php 
									echo form_error('email_address');
									$emailAttributes = array('id' => 'email_address', 'name' => 'email_address', 'class' => 'input-xlarge', 'value' => $email_address, 'disabled' => 'disable', 'type' => 'text');
									echo form_input($emailAttributes);
									?>
								</div>	
							
					
								<legend>
									Login Information
								</legend>
								
								<h4>Username:</h4>
								<div class="controls" style="margin-bottom: 1em">
									<?php 
									echo form_error('username');
									$usernameAttributes = array('id' => 'username', 'name' => 'username', 'class' => 'input-xlarge', 'value' => $username, 'disabled' => 'disable', 'type' => 'text');
									echo form_input($usernameAttributes);
									?>
								</div>
						
								<h4>Password:</h4>
								<div class="controls" style="margin-bottom: 1em">
									<?php
									echo form_error('password');
									$passwordAttributes = array('id' => 'password', 'name' => 'password', 'class' => 'input-xlarge', 'value' => (isset($this -> validation -> {'password'}) ? $this -> validation -> {'password'} : ''), 'type' => 'text');
									echo form_password($passwordAttributes);
									?>
								</div>
								
								<h4>Password Confirm:</h4>
								<div class="controls" style="margin-bottom: 1em">
									<?php
									echo form_error('password_confirm');
									$passwordAttributes2 = array('id' => 'password_confirm', 'name' => 'password_confirm', 'class' => 'input-xlarge', 'value' => (isset($this -> validation) ? $this -> validation -> {'password_confirm'} : ''), 'type' => 'text');
									echo form_password($passwordAttributes2);
									?>
								</div>
							</div>
						
							<div class="modal-footer">
								<div class="form-actions">
									<div>
										<?php
										$cancelAttributes = (array('id' => 'cancel', 'name' => 'cancel', 'class' => 'btn btn-large btn-primary', 'value' => 'Cancel', 'type' => 'submit')); 
										echo form_submit($cancelAttributes);
										//redirect('profile/view_profile/'.$username);
										?> 
										
										<?php
										$saveAttributes = array('id' => 'save', 'name' => 'save', 'class' => 'btn btn-large btn-primary', 'value' => 'Save', 'type' => 'submit');
										echo form_submit($saveAttributes);
										?>    
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
			<?php
			echo form_close();
			?>
		</div>