<div class="container">
	<div class="content">
		<?php 
		if(isset($displayInModal)&&$displayInModal=='true'){			
			echo "<script type='text/javascript'>\$(document).ready(function(){\$('#addCourseModal').modal('show');});</script>";
		}
		?>
		<div class ="hero-unit">
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
		<p>Don't see your course?</p><a data-toggle="modal" href="#addCourseModal" class="btn btn-large btn-primary"onclick="javascript:initAutoComplete();">Add that shit!</a>
		</br></br>
		
		<?php
	if (isset($courses)==FALSE||$courses == NULL||count($courses)<1) {
	?>
	<div class="well">
	No courses were found for this professor.  Have you taken a course with this professor? Add that shit!
	</div>
	<?php
	} else {

 foreach($courses as $course): 
	?>
	<div class="well">
		<div class='catalogNumber'> <?php echo anchor(base_url('course/view/'.$state.'/'.$collegeName.'/'.$firstName.'/'.$lastName.'/'.$department.'/'.$course['CatalogNumber']), $course['CatalogNumber']);?> </div>
		<div class='CourseName'><?php echo anchor(base_url('course/view/'.$state.'/'.$collegeName.'/'.$firstName.'/'.$lastName.'/'.$department.'/'.$course['CatalogNumber']), $course['CourseName']);?></div>

	</div>
	<?php endforeach;?>
	<?php }?>
		
		
		
		

		
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