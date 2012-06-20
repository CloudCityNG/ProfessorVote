<div class="container-fluid" >
	<?php
	echo form_open('login/create_user');
	?>
		<fieldset>
			<legend>
					Registration Information
				</legend>
			<div class="control-group">
				
				<div id="registerMessage"></div>
				</div>
				<div class="controls" style="margin-bottom: 1em">
					<?php
					echo form_error('email_address');
					$emailAttributes = array('id' => 'email_address', 'class' => 'input-xlarge', 'placeholder' => 'Email Address', 'type' => 'text', 'name' => 'email_address');
					echo form_input($emailAttributes);
					?>
				</div>
				<div class="controls" style="margin-bottom: 1em">
					<?php
					echo form_error('password');
					$passwordAttributes = array('id' => 'registerPassword', 'class' => 'input-xlarge', 'placeholder' => 'Password', 'type' => 'text', 'name' => 'password');
					echo form_password($passwordAttributes);
					?>
				</div>
				<div class="controls">
					<?php
					echo form_error('password2');
					$passwordAttributes2 = array('id' => 'registerPassword2', 'class' => 'input-xlarge', 'placeholder' => 'Password Confirm', 'type' => 'text', 'name' => 'password2');
					echo form_password($passwordAttributes2);
					?>
				</div>
			</div>
			<div class="form-actions">
				<div>
					<?php
					$submitAttributes = array('id' => 'submitRegistration', 'class' => 'btn btn-large btn-primary', 'value' => 'Create Account', 'type' => 'submit');
					echo form_submit($submitAttributes);
					?>
				</div>
			</div>
		</fieldset>
	<?php
	echo form_close();
	?>
</div>