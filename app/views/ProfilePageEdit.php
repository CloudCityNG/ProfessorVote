<div class="container-fluid">
	<?php echo form_open('profile/edit_profile');?>
		<form class="form-horizontal">
			<fieldset>
				<div id="profileEditMessage"></div>
				<div class="control-group">
					<legend>
						Personal Information
					</legend>
					
					<h4>First Name:</h4>
					<div class="controls" style="margin-bottom: 1em">
						<?php
						echo form_error('first_name');
						$firstNameAttributes = array('id' => 'first_name', 'name' => 'first_name', 'class' => 'input-xlarge', 'placeholder' => $first_name, 'type' => 'text');
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
						$emailAddressAttributes = array('id' => 'email_address', 'name' => 'email_address', 'class' => 'input-xlarge', 'value' => $email_address, 'readonly' => 'readonly', 'type' => 'text');
						echo form_input($emailAddressAttributes);
						?>
					</div>	
				</fieldset>
				
				<fieldset>
					<div class="control-group">
						<legend>
							Login Information
						</legend>
						
						<h4>Username:</h4>
						<div class="controls" style="margin-bottom: 1em">
							<?php 
							echo form_error('username');
							$usernameAttributes = array('id' => 'username', 'name' => 'username', 'class' => 'input-xlarge', 'value' => $username, 'readonly' => 'readonly', 'type' => 'text');
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
				
					<div class="form-actions">
						<div>
							<?php
							$saveAttributes = array('id' => 'save', 'name' => 'save', 'class' => 'btn btn-large btn-primary', 'value' => 'Save', 'type' => 'submit');
							echo form_submit($saveAttributes);
							?>    
						</div>
					</div>
				</fieldset>
			</form>
		<?=form_close()?>
	</div>
</div>


