<script type="text/javascript" language="JavaScript">
function validateFields(){
	//show validating GIF
	//var catalogNumber = $('#catalog_number');
	//var courseName = $('#course_name');
	//var fields = new Array('catalog_number','course_name');
	//if(fieldsNotEmpty(fields));
$.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/course/course_check",
            data: "catalog_number="+$("#catalog_number").val()+"&college_name="+$("#college_name").val(),
            success: function(msg){
                if(msg=="true")
                {
                    alert("ajax valiation true");
                    
                }
                else
                {
                	document.getElementById('catalog_number_err').style.display='block';
                	document.getElementById('catalog_number_err').innerText=msg;
                   
                }
            
        },
        error:function(xhr,err,ex){
        	alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
    alert("responseText: "+xhr.responseText);
    alert("exception: "+err);
    alert("exception: "+ex);
        }
        });
      
        return false;
	
}
	//remove validating GIF

function addCourse(){
	if(validateFields()){
		return true;
	}
	else{
		return false;
	}
}	

function fieldsNotEmpty(fieldsArray){
	for(var i =0; i<fieldsArray.length;i++){
		if($(fieldsArray[i]).value==''||$(fieldsArray[i]).value==null){
			alert($(fieldsArray[i]).name + ' is empty.' );
			return false;
		}
		return true;
	}
}
	
	
</script>
<div class="container" >
	<?php
	$form_attributes= array('id'=>'addCourseForm', 'class'=>'addCourseForm');
	echo form_open('course/add',$form_attributes);
	?>

		<fieldset>
			<div class="control-group">

				
				<?php    if (isset($error_msg)) {  ?>
					<div class="alert alert-error"><?php  echo $error_msg ?> </div>
					
					<?php } ?>
				
				
				<legend>
					Course Information
				</legend>
				<div class="controls" style="margin-bottom: 1em">
					<?php
					echo form_label('Catalog Number','catalog_number');
					echo form_error('catalog_number');
					?>
					<div class="alert alert-error" id='catalog_number_err' style='display:none'></div>
					<?php
					$catalogNumberAttributes = array('id' => 'catalog_number', 'class' => 'input-xlarge required', 'placeholder' => 'MATH1101', 'type' => 'text', 'name' => 'catalog_number');
					if (isset($catalog_number)) {
						$catalogNumberAttributes = array('id' => 'catalog_number', 'value' => $catalog_number, 'class' => 'input-xlarge required', 'placeholder' => $catalog_number, 'type' => 'text', 'name' => 'catalog_number');
					}

					echo form_input($catalogNumberAttributes);
					?>
				</div>
				<div class="controls" style="margin-bottom: 1em">
					<?php
					echo form_label('Course Name','course_name');
					echo form_error('course_name');
					?>
					<div class="alert alert-error" id='course_name_err' style='display:none'></div>
					<?php
					$courseNameAttributes = array('id' => 'course_name', 'class' => 'input-xlarge', 'placeholder' => 'Introduction to College Mathematics', 'type' => 'text', 'name' => 'course_name');
					if (isset($course_name)) {
						$courseNameAttributes = array('id' => 'course_name', 'value' => $course_name, 'class' => 'input-xlarge', 'placeholder' => $course_name, 'type' => 'text', 'name' => 'course_name');
					}
	
					echo form_input($courseNameAttributes);
					$collegeNameAttributes = array('id'=>'college_name','name'=>'college_name','value'=>$collegeName,'type'=>'hidden');
					echo form_input($collegeNameAttributes);
					?>
				</div>
				
				
			</div>
			<div class="form-actions">
				<div>
					<?php
					//$submitAttributes = array('id' => 'submit', 'class' => 'btn btn-large btn-primary', 'value' => 'Add Course', 'type' => 'submit');
					//echo form_submit($submitAttributes);
					?>
					<?php
					$submitAttributes = array('id' => 'submit', 'class' => 'btn btn-large btn-primary', 'value' => 'Add Course', 'type' => 'submit', 'onClick'=>"javascript:addCourse();");
					echo form_submit($submitAttributes);
					?>
					<a href=javascript:addCourse();>validate</a>
				</div>
			</div>
		</fieldset>
		<?php if ( defined('course_name' )):
		?>
		<?php echo $this -> set_value('course_name', $course_name);?>
		<?php endif;?>
		<?php if ( defined('catalog_number' )):
		?>
		<?php echo $this -> set_value('catalog_number', $catalog_number);?>
		<?php endif;?>

		<?php
		echo form_close();
		?>
</div>