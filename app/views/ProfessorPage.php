<div class="container">
	<div class="content">
		<?php 
		if(isset($displayInModal)&&$displayInModal=='true'){			
			echo "<script type='text/javascript'>\$(document).ready(function(){\$('#addCourseModal').modal('show');});</script>";
		}
		?>
		<script type="text/javascript"></script>
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
		<a data-toggle="modal" href="#addCourseModal" class="btn btn-large btn-primary">Add Course</a>
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
                <a class="close" data-dismiss="modal" id="errorModalClose">X</a>
                <h3>Success!</h3>
            </div>
            <div class="modal-body">
            	<div id = 'modal_success_msg' class="alert alert-success"></div>
            	
            </div>
		</div>
	</div>
