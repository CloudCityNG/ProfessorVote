<script type="text/javascript">
	<?php if(!isset($courseNames)){ 
		$courseNames=array('');
	}
	 if(!isset($catalogNumbers)){ 
		$catalogNumbers=array('');
	}
	?>
//$('document').ready(function(){
	var newCourseDiv;
	var courseNames=[<?php echo "'".implode("','",$courseNames)."'"?>].sort();
	var catalogNumbers=[<?php echo "'".implode("','",$catalogNumbers)."'"?>].sort();
function initAutoComplete(){

	var courseNames=[<?php echo "'".implode("','",$courseNames)."'"?>].sort();
	var catalogNumbers=[<?php echo "'".implode("','",$catalogNumbers)."'"?>].sort();
	$('#course_name').typeahead({
		source:courseNames,
		items:6
	});
	$('#catalog_number').typeahead({
		source:catalogNumbers,
		items:6
	});
	$('#successModal').on('hidden', function () { 
		
 		newCourseDiv='#'+$("#catalog_number").val();
 		tempFunct();
 		$('#catalog_number').val('');
		$('#course_name').val('');
					
 	});
}

function tempFunct(){
	//TODO:course name exists makes new course ajax fail
	
	 $.ajax({
            type: "POST",
            data: "collegeName=" + $("#college_name").val() + '&firstName=' + $("#professor_first_name").val() + '&state=<?php echo $state ?>'+
            '&lastName=' + $("#professor_last_name").val() + '&department=' + $("#professor_department").val()+'&professorID=<?php echo $professorID ?>',
            url: "<?php echo site_url("Professor/getCourseListHTML");?>",
          
            success: function(msg){

            	$('#courseList').html(msg);
            	$(document.body).animate({scrollTop: $(newCourseDiv).offset().top}, 1200);
            	//$.scrollTo(newCourseDiv, 800, {easing:'elasout'});            
        },
        error:function(xhr,err,ex){
     //   	alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
  //  alert("responseText: "+xhr.responseText);
  //  alert("exception: "+err);
  //  alert("exception: "+ex);

    document.getElementById('error_msg').innerText='Unknown error sending AJAX request for courselist.';
     document.getElementById('error_msg').style.display='block';
        }
        });
	
}
//function typeahead_catalogNumber(){
//	if($('catalog_number').val()!='' or $('catalog_number').val();!=null){
//var catnum= $('catalog_number').val();
//int index = $.inArray(catnum,catalog_numbers);
//if(index>=0){
//	$('course_name').val(courseNames[index]);
//}
//}
//}


function addCourse(){
$.ajax({
            type: "POST",
            url: "<?php echo site_url("course/add");?>",
            data: "catalog_number="+$("#catalog_number").val()+"&college_name="+$("#college_name").val()
            +'&course_name='+$("#course_name").val()+'&professor_first_name='+$("#professor_first_name").val()+
            '&professor_last_name='+$("#professor_last_name").val()+'&professor_department='+$("#professor_department").val(),
            success: function(msg){
            	
            	if(msg=='success'){
					//hide modal
					$('#addCourseModal').modal('hide');		
					$('#modal_success_msg').text("Course successfully added!");
					$('#successModal').modal('show');
					//clear addCourse panel
					
					$('.alert-error').hide();
					tempFunct();
					
					
					//TODO:repopulate page , highlight and scroll to new course
				}
				else if(msg =='error'){
					javascript:$('#addCourseModal').modal('hide');					
					$('#modal_error_msg').text("System error adding course.");
					javascript:$('#errorModal').modal('show');
				}
				else if(msg=='college_error'){
					javascript:$('#addCourseModal').modal('hide');					
					$('#modal_error_msg').text("System error when obtaining college data.  Course not added.");
					javascript:$('#errorModal').modal('show');
				} else if(msg=="true")//comment out true
                {
                    document.getElementById('catalog_number_err').style.display='none';
                    document.getElementById('course_name_err').style.display='none';
                    document.getElementById('error_msg').style.display='none';
                    addCourse();
                    
                    
                }else
                {
                	document.getElementById('catalog_number_err').style.display='none';
                    document.getElementById('course_name_err').style.display='none';
                    document.getElementById('error_msg').style.display='none';
                    
                	var messages = msg.split("|");
                	if(messages.length==1){
                		var m = messages[0];
                			var m2 = m.split('#')
                			if(m2.length==2){
                				var field = m2[0];
                				var err = m2[1];
                				document.getElementById(field).style.display='block';
                				document.getElementById(field).innerText=err;

                			}
                	}
                	else if(messages.length ==2){
                		for(x in messages){
                			var m = messages[x];
                			var m2 = m.split('#')
                			if(m2.length==2){
                				var field = m2[0];
                				var err = m2[1];
                				document.getElementById(field).style.display='block';
                				document.getElementById(field).innerText=err;
                			}
                		}
                	}                   
                }
				//else{
				//	javascript:$('#addCourseModal').modal('hide');					
				//	$('#modal_error_msg').text("Unknown response from system while adding course.");
				//	javascript:$('#errorModal').modal('show');
			//	}


            	
                
            
        },
        error:function(xhr,err,ex){
       	alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
  alert("responseText: "+xhr.responseText);
    alert("exception: "+err);
    alert("exception: "+ex);

    document.getElementById('error_msg').innerText='Unknown error sending AJAX request.';
     document.getElementById('error_msg').style.display='block';
        }
        });	
}


	
</script>
<div class="container-fluid" >
	<?php
	$form_attributes= array('id'=>'addCourseForm', 'class'=>'addCourseForm');
	echo form_open('course/add',$form_attributes);
	?>

		<fieldset>
			<legend>
					Course Information
				</legend>
			<div class="control-group">

				
				<?php    if (isset($error_msg)) {  ?>
					<div class="alert alert-error"><?php  echo $error_msg ?> </div>
					
					<?php } ?>
				
				
				
				<div class="controls" style="margin-bottom: 1em">
					<?php
					//TODO: MAKE dropdown selection autopopulate the other text box field based on its input
					echo form_label('Catalog Number','catalog_number');
					echo form_error('catalog_number');
					?>
					<div class="alert alert-error" id='catalog_number_err' style='display:none'></div>
					<?php
					$catalogNumberAttributes = array('onChange'=>'typeahead_catalogNumber();','id' => 'catalog_number', 'class' => 'input-xlarge required', 'placeholder' => 'MATH1101', 'type' => 'text', 'name' => 'catalog_number','data-provide'=>'typeahead','autocomplete'=>'off');
					if (isset($catalog_number)) {
						$catalogNumberAttributes = array('id' => 'catalog_number', 'value' => $catalog_number, 'class' => 'input-xlarge required', 'placeholder' => $catalog_number, 'type' => 'text', 'name' => 'catalog_number','data-provide'=>'typeahead','autocomplete'=>'off');
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
					$courseNameAttributes = array('id' => 'course_name', 'class' => 'input-xlarge', 'placeholder' => 'Introduction to College Mathematics', 'type' => 'text', 'name' => 'course_name','data-provide'=>'typeahead','autocomplete'=>'off');
					if (isset($course_name)) {
						$courseNameAttributes = array('id' => 'course_name', 'value' => $course_name, 'class' => 'input-xlarge', 'placeholder' => $course_name, 'type' => 'text', 'name' => 'course_name','data-provide'=>'typeahead','autocomplete'=>'off');
					}
	
					echo form_input($courseNameAttributes);
					?>
					<div class="alert alert-error" id='error_msg' style='display:none'></div>
					<?php
					
					$collegeNameAttributes = array('id'=>'college_name','name'=>'college_name','value'=>$collegeName,'type'=>'hidden');
					echo form_input($collegeNameAttributes);
					
					$professorFirstNameAttributes = array('id'=>'professor_first_name','name'=>'professor_first_name','value'=>$professorFirstName,'type'=>'hidden');
					echo form_input($professorFirstNameAttributes);
					$professorLastNameAttributes = array('id'=>'professor_last_name','name'=>'professor_last_name','value'=>$professorLastName,'type'=>'hidden');
					echo form_input($professorLastNameAttributes);
					$professorDepartmentAttributes = array('id'=>'professor_department','name'=>'professor_department','value'=>$professorDepartment,'type'=>'hidden');
					echo form_input($professorDepartmentAttributes);
					?>
				</div>
				
				
			</div>
			<div class="form-actions">
				<div>
					<a href="javascript:addCourse();" class="btn btn-large btn-primary">Add Course</a>
					
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