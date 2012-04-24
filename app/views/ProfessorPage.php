<script type="text/javascript">
	function clickMouseDown(theID){
		document.getElementById(theID).className= "well";
	}
	function clickMouseUp(theID){
		document.getElementById(theID).className = "well raised";
	}
	function divOnHover(obj, theID){
        obj.style.cursor = "pointer";
        //document.getElementById(theID).className = "well raised";
	}
	function gotoThis(url){
		window.location = url;
	}
</script>
<div class="container">
	<div class="content">
		<?php 
		if(isset($displayInModal)&&$displayInModal=='true'){			
			echo "<script type='text/javascript'>\$(document).ready(function(){\$('#addCourseModal').modal('show');});</script>";
		}
		?>
		<div class ="hero-unit raised">
			<h1><?php
			if (isset($firstName)) {
				echo $firstName;
			}
			if (isset($lastName)) {
				echo " " . $lastName;
			}
			?>

			<small><?php
			if (isset($department)) {
				echo $department;
			}
				?></small></h1>
		</div>
		<?php if($this->session->userdata('is_logged_in') == TRUE) {?>
		<p>Don't see your course?</p><a data-toggle="modal" href="#addCourseModal" class="btn btn-large btn-primary" onclick="javascript:initAutoComplete();">Add It!</a>
	<?php }else{ ?>
	 	Don't see your course? Log in to add one!
	 	<?php }?> 
	 	
		</br></br>

<?php $coursePulse = new CoursePulse();?>
<div id="courseList">
		<?php
	if (isset($courses)==FALSE||$courses == NULL||count($courses)<1) {
	?>
	<div class="well raised">
	No courses were found for this professor.  Have you taken a course with this professor? Add It!
	</div>
	<?php
	} else {
	    //echo $this->Pulse_model->getCoursePulseVotes($courses[1]['CourseID']);
	    $courses[0]['Votes'] = '15';
//print_r($courses);
echo $courses[1]['CourseID'];
 foreach($courses as $course): 
	?>
	
	<div class="well raised" id="<?php echo $course['CatalogNumber'] ?>" onmouseover="divOnHover(this, '<?php echo $course['CatalogNumber'] ?>');" onmousedown = "clickMouseDown('<?php echo $course['CatalogNumber'] ?>');" onmouseup = "clickMouseUp('<?php echo $course['CatalogNumber'] ?>');" OnClick="gotoThis('<?php echo base_url('course/view/'.$state.'/'.$collegeName.'/'.$firstName.'/'.$lastName.'/'.$department.'/'.$course['CatalogNumber']);?>');" >
	     <div class="pull-right" style="margin-right: 1em">
            <?php echo $coursePulse -> voteHTML($course['CourseID']);?>
        </div>
	    
		<div class='catalogNumber'><strong><?php echo $course['CatalogNumber'];?> </strong></div>
		<div class='courseName'><strong><?php echo  $course['CourseName'];?></strong></div>

	</div>
	<?php endforeach;?>
	<?php }?>
	</div>
		
		
		
		

		
		<div class="modal hide fade" id="addCourseModal">
			<div class="modal-header">
                <a class="close" data-dismiss="modal" id="addCourseModalClose">X</a>
                <h3>Add a Course</h3>
            </div>
            <div class="modal-body">
            	<?php echo $addCourse; ?>
            	
            </div>
		</div>
		<div class="modal hide fade" id="errorModal">
			<div class="modal-header">
                <a class="close" data-dismiss="modal" id="errorModalClose">X</a>
                <h3>Error</h3>
            </div>
            <div class="modal-body">
            	<div id = 'modal_error_msg' class="alert alert-error"></div>
            	
            </div>
		</div>
		<div class="modal hide fade" id="successModal">
			<div class="modal-header">
                <a class="close" data-dismiss="modal" id="successModalClose">X</a>
                <h3>Success!</h3>
            </div>
            <div class="modal-body">
            	<div id = 'modal_success_msg' class="alert alert-success"></div>
            	
            </div>
		</div>
	</div>
</div>