<div class="container-fluid" >
	<?php
    echo form_open('professor/addCollege_Ajax');
	?>
	<?php
    $collegeStateAttributes = array('id' => 'CollegeStateLable', 'class' => 'control-label', 'placeholder' => 'State', 'type' => 'text', 'name' => 'CollegeStateLable');
    echo form_label($collegeINFO -> State, 'CollegeStateLable', $collegeStateAttributes);
    $collegeNameAttributes = array('id' => 'CollegeNameLable', 'class' => 'control-label', 'placeholder' => 'State', 'type' => 'text', 'name' => 'CollegeNameLable');
    echo form_label($collegeINFO -> Name, 'CollegeNameLable', $collegeNameAttributes);
	?>
	<form class="form-horizontal">
		<fieldset>
			<div class="control-group">
				<div id="createProfessorMessage"></div>
				<div class="controls" style="margin-bottom: 1em">
					<?php
                    $professorFirstNameAttributes = array('id' => 'professor_first_name', 'class' => 'input-xlarge', 'placeholder' => 'Professors First Name', 'type' => 'text', 'name' => 'professor_first_name');
                    echo form_input($professorFirstNameAttributes);
					?>
				</div>
				<div class="controls" style="margin-bottom: 1em">
					<?php
                    $professorLastNameAttributes = array('id' => 'professor_last_name', 'class' => 'input-xlarge', 'placeholder' => 'Professors Last Name', 'type' => 'text', 'name' => 'professor_last_name');
                    echo form_input($professorLastNameAttributes);
					?>
				</div>
				<div class="controls">
					<label class="control-label" for="select01">Select Department</label>
					<select id="selectedDepartment">
						<?php $departments = $this -> Professor_model -> getAllDepartments();?>
						<?php foreach ($departments as $row):
						?>
						<option><?php $department = $row -> Department;?>
							<?php echo $department;?></option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="form-actions">
				<div>
					<?php
                    $submitAttributes = array('id' => 'submitProfessor', 'class' => 'btn btn-large btn-primary', 'value' => 'Add Professor', 'type' => 'submit');
                    echo form_submit($submitAttributes);
					?>
				</div>
			</div>
		</fieldset>
		<?php
        echo form_close();
		?>
</div>
