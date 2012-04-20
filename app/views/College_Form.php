<div class="container-fluid" >
	<?php
	echo form_open('college/addCollege');
	?>
	<form class="form-horizontal">
		<fieldset>
			<div class="control-group">
				<legend>
					College Information
				</legend>
				<div class="controls" style="margin-bottom: 1em">
					<?php
					echo form_error('college_name');
					$collegeNameAttributes = array('id' => 'college_name', 'class' => 'input-xlarge', 'placeholder' => 'College Name', 'type' => 'text', 'name' => 'college_name');
					if (isset($college_name)) {
						$collegeNameAttributes = array('id' => 'college_name', 'value' => $college_name, 'class' => 'input-xlarge', 'placeholder' => 'College Name', 'type' => 'text', 'name' => 'college_name');
					}

					echo form_input($collegeNameAttributes);
					?>
				</div>
				<div class="controls" style="margin-bottom: 1em">
					<?php
					echo form_error('state');
					$stateAttributes = array('id' => 'state', 'class' => 'input-xlarge', 'placeholder' => 'State', 'type' => 'text', 'name' => 'state', 'maxlength' => '2');

					if (isset($state)) {
						$stateAttributes = array('id' => 'state', 'value' => $state, 'class' => 'input-xlarge', 'placeholder' => 'State', 'type' => 'text', 'name' => 'state');

					}
					echo form_input($stateAttributes);
					?>
				</div>
				<div class="controls" style="margin-bottom: 1em">
					<?php
					echo form_error('city');
					$cityAttributes = array('id' => 'city', 'class' => 'input-xlarge', 'placeholder' => 'City', 'type' => 'text', 'name' => 'city');

					if (isset($city)) {
						$cityAttributes = array('id' => 'city', 'value' => $city, 'class' => 'input-xlarge', 'placeholder' => 'City', 'type' => 'text', 'name' => 'city');

					}
					echo form_input($cityAttributes);
					?>
				</div>
			</div>
			<div class="form-actions">
				<div>
					<?php
					$submitAttributes = array('id' => 'submit', 'class' => 'btn btn-large btn-primary', 'value' => 'Add College', 'type' => 'submit');
					echo form_submit($submitAttributes);
					?>
				</div>
			</div>
		</fieldset>
		<?php if ( defined('college_name' )): ?>
		<?php echo $this -> set_value('college_name', $college_name);?>
		<?php endif;?>
		<?php if ( defined('state') ): ?>
		<?php echo $this -> set_value('state', $state);?>
		<?php endif;?>
		<?php if ( defined('city') ): ?>
		<?php echo $this -> set_value('city', $city);?>
		<?php endif;?>
		<?php
		echo form_close();
		?>
</div>