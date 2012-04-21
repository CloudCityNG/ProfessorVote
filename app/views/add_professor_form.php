<div class="container-fluid" >
    <?php
    echo form_open('professor/addCollege_Ajax');
    ?>
    <form class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <legend>
                    <?php echo "Professor Information";?>
                </legend>
                <div id="createCollegeMessage"></div>
                <div class="controls" style="margin-bottom: 1em">
                    <?php
                    $professorFirstNameAttributes = array('id' => 'professor_first_name', 'class' => 'input-xlarge', 'placeholder' => 'First Name', 'type' => 'text', 'name' => 'professor_first_name');
                    echo form_input($professorFirstNameAttributes);
                    ?>
                </div>
                <div class="controls" style="margin-bottom: 1em">
                    <?php
                    $professorLastNameAttributes = array('id' => 'professor_last_name', 'class' => 'input-xlarge', 'placeholder' => 'Last Name', 'type' => 'text', 'name' => 'professor_last_name');
                    echo form_input($professorLastNameAttributes);
                    ?>
                </div>
                <div class="controls" style="margin-bottom: 1em">
                    <?php
                    $professorDepartmentAttributes = array('id' => 'professor_department', 'class' => 'input-xlarge', 'placeholder' => 'Department Name', 'type' => 'text', 'name' => 'professor_department');
                    echo form_input($professorDepartmentAttributes);
                    ?>
                </div>
            </div>
            <div class="form-actions">
                <div>
                    <?php
                    $submitAttributes = array('id' => 'submitProfessorCollege', 'class' => 'btn btn-large btn-primary', 'value' => 'Add College', 'type' => 'submit');
                    echo form_submit($submitAttributes);
                    ?>
                </div>
            </div>
        </fieldset>
        <?php
        echo form_close();
        ?>
</div>


