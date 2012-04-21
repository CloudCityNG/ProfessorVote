<div class="container-fluid" >
	<?php
    echo form_open('college/addCollege_Ajax');
	?>
	<form class="form-horizontal">
		<fieldset>
			<div class="control-group">
				<legend>
					<?php
                    echo form_error('state');
                    $stateAttributes = array('id' => 'stateLable', 'class' => 'control-label', 'placeholder' => 'State', 'type' => 'text', 'name' => 'state');
                    echo form_label($this -> session -> flashdata('state'), 'stateLable', $stateAttributes);
					?>
				</legend>
				<div id="createCollegeMessage"></div>
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
			</div>
			<div class="form-actions">
				<div>
					<?php
                    $submitAttributes = array('id' => 'submitAddCollege', 'class' => 'btn btn-large btn-primary', 'value' => 'Add College', 'type' => 'submit');
                    echo form_submit($submitAttributes);
					?>
				</div>
			</div>
		</fieldset>
	</form>
	<?php
    echo form_close();
	?>
</div>
