<div class="container">
	<div class="hero-unit raised">
		<?=form_open('profile/edit_profile/'.$profile['username'])?>
		<form class="form-horizontal">
			<fieldset>
				<div class="control-group">
					<div class="page-header">
						<h1>Edit Profile</h1>
					</div>
					
					<legend>
						Personal Information
					</legend>
					
					<div class="controls" style="margin-bottom: 1em">
						<?php
						echo form_error('first_name');
						$firstNameAttributes = array('id' => 'first_name', 'name' => 'first_name', 'class' => 'input-xlarge', 'value'=> (isset($profile['first_name'])), 'type' => 'text');
						echo form_input($firstNameAttributes);
						?>				
					</div>
					
					<div class="controls" style="margin-bottom: 1em">
						<?php
						echo form_error('last_name');
						$lastNameAttributes = array('id' => 'last_name', 'name' => 'last_name', 'class' => 'input-xlarge', 'value' => (isset($profile['last_name'])), 'type' => 'text');
						echo form_input($lastNameAttributes);
						?>
					</div>
						
					<div class="controls" style="margin-bottom: 1em">
						<?php
						echo form_error('email_address');
						$emailAddressAttributes = array('id' => 'email_address', 'name' => 'email_address', 'class' => 'input-xlarge', 'value' => (isset($profile['email_address'])), 'type' => 'text');
						echo form_input($emailAddressAttributes);
						?>
					</div>	
				</fieldset>
				
				<fieldset>
					<div class="control-group">
						<legend>
							Login Information
						</legend>
						<div class="controls" style="margin-bottom: 1em">
							<?php
							echo form_error('username');
							$usernameAttributes = array('id' => 'username', 'name' => 'username', 'class' => 'input-xlarge', 'value' => (isset($profile['username'])), 'type' => 'text');
							echo form_input($usernameAttributes);
							?>
						</div>
						
						<div class="controls" style="margin-bottom: 1em">
							<?php
							echo form_error('password');
							$passwordAttributes = array('id' => 'password', 'name' => 'password', 'class' => 'input-xlarge', 'value' => (isset($this -> validation -> {'password'}) ? $this -> validation -> {'password'} : ''), 'type' => 'text');
							echo form_password($passwordAttributes);
							?>
						</div>
						
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
							echo form_submit($submitAttributes);
							?>
						</div>
						
						<div>
							<?php
							$cancelAttributes = (array('id' => 'cancel', 'name' => 'cancel', 'class' => 'btn btn-large btn-primary', 'value' => 'Cancel', 'type' => 'submit', 'onclick' => 'location.href = \'<?=base_url();?>index.php/profile/<?$profile[\'username\']?>')); 
							echo form_submit($cancelAttributes);
							?>      
						</div>
					</div>
				</fieldset>
			</form>
			<?=form_close()?>
	</div>
</div>


