<style type="text/css" media="screen">
	.comment_date {
		position: absolute;
		right: 0;
	}
</style>
<script type="text/javascript">
	function addComment(){
var comment = $('#comment').val();
$.ajax({
type: "POST",
data: "comment=" + comment + '&professorID=<?php echo $professorID ?>&courseID=<?php echo $courseID ?>
	',
	url: "
<?php echo base_url("/index.php/course/comment");?>
	",

	success: function(msg){
	if(msg!='null'){}
	//show course added
	$('#commentList').html(msg);
	$('#successModal').modal('show');
	$('#comment').val('');
	}},
	error:function(xhr,err,ex){

	//  alert("exception: "+ex);

	document.getElementById('error_msg').innerText='Unknown error sending AJAX request for courselist.';
	document.getElementById('error_msg').style.display='block';
	}
	});
	}
</script>
<div class="container">
	<div class="hero-unit">
		<?php
		$this -> load -> helper('url');
		$professorName = $professorFirstName . ' ' . $professorLastName;
		echo "<h3>" . anchor(base_url('CollegePage/' . $state . '/' . $collegeName), $collegeName) . "</h3>";
		echo "<h3>" . anchor(base_url('Professor/view/' . $state . '/' . $collegeName . '/' . $professorFirstName . '/' . $professorLastName . '/' . $department), $professorName) . "</h3>";
		echo "<h2>" . $catalogNumber . ' - ' . $courseName . "</h2>";
		?>
	</div>
	<div class='well'>
		<?php
		$commentAttributes = array('id' => 'comment', 'class' => 'input-xlarge', 'style' => 'width:90%;resize:none', 'placeholder' => 'Comment...', 'name' => 'comment', 'autocomplete' => 'off');
		echo form_textarea($commentAttributes);
		?>

		<a href="javascript:addComment();" class="btn-large btn-primary">Comment</a>
	</div>
	<div id='commentList'>
		<?php
		if (isset($comments)) {
			foreach ($comments as $comment) {
				echo '<div class="well">';
				echo '<div class="comment_date"><h6>' . $comment -> DateString . '</h6></div>';
				echo $comment -> Comment;
				echo '</div>';
			}
		} else {
			echo '<div class="well">';
			echo "No comments found.  Have you taken this course?  Leave a comment!";
			echo '</div>';
		}
		?>
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
			<div id = 'modal_success_msg' class="alert alert-success">
				Comment Added
			</div>
		</div>
	</div>
</div>
