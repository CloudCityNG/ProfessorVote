<hr />
<footer>
	<p>
		&copy; ProfessorVote.com 2012 --
		Page rendered in <strong>{elapsed_time}</strong> seconds
	</p>
</footer>
<!-- Le javascript
=============================s===================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/scripts/jquery-1.7.1.min.js"></script>
<script src="/scripts/jquery.scrollTo-1.4.2-min.js"></script>
<script src="/scripts/jquery.validate.min.js"></script>
<script src="/scripts/bootstrap.min.js"></script>
<script src="/scripts/header.js"></script>
<script src="/CoursePulse/assets/js/pulse.core.js"></script>
<script type="text/javascript">
$(document).ready(function() {
<?php
$this->load->model('College_model');
 $schoolNames=$this->College_model->getAllNames(); ?>

	var schoolNames=[<?php echo implode(",",$schoolNames)?>].sort();
	$('#school_name_tb').typeahead({
		source:schoolNames,
		items:6
	});
});

$(document).ready(function() {
		$('#submitLogin').click(function() {
			var form_data = {
				username : $('#username').val(),
				password : $('#password').val(),
				ajax : '1'
			};
			$.ajax({
				url : "<?php echo site_url('login/ajax_check'); ?>",
				type : 'POST',
				async : false,
				data : form_data,
				success : function(msg) {
					if(msg == 'true') {
						location.reload(true)
					} else {
						$('#message').html(msg);
					}
				}
			});
			return false;
		});
	});
	$(document).ready(function() {
		$('#submitLogin').click(function() {
			var form_data = {
				username : $('#username').val(),
				password : $('#password').val(),
				ajax : '1'
			};
			$.ajax({
				url : "<?php echo site_url('login/ajax_check'); ?>",
				type : 'POST',
				async : false,
				data : form_data,
				success : function(msg) {
					if(msg == 'true') {
						location.reload(true)
					} else {
						$('#message').html(msg);
					}
				}
			});
			return false;
		});
	});
	$(document).ready(function() {
		$('#submitRegistration').click(function() {
			var form_data = {
				first_name : $('#first_name').val(),
				last_name : $('#last_name').val(),
				email_address : $('#email_address').val(),
				username : $('#registerUsername').val(),
				password : $('#registerPassword').val(),
				password2 : $('#registerPassword2').val(),
				ajax : '1'
			};
			$.ajax({
				url : "<?php echo site_url('login/create_user_ajax'); ?>",
				type : 'POST',
				async : false,
				data : form_data,
				success : function(msg) {
					if(msg == 'true') {
						location.reload(true)
					} else {
						$('#registerMessage').html(msg);
					}
				}
			});
			return false;
		});
	});

    $(document).ready(function() {
            $('#submitAddCollege').click(function() {
                var form_data = {
                    college_name : $('#college_name').val(),
                    state_name: $('#stateLable').text(),
                    ajax : '1'
                };
                $.ajax({
                    url : "<?php echo site_url('college/addCollege_Ajax'); ?>",
                    type : 'POST',
                    async : false,
                    data : form_data,
                    success : function(msg) {
                        if(msg == 'true') {
                            location.reload(true)
                        } else {
                            $('#createCollegeMessage').html(msg);
                        }
                    }
                });
                return false;
            });
        });
        
     $(document).ready(function() {
            $('#submitProfessor').click(function() {
                var form_data = {
                    professor_first_name : $('#professor_first_name').val(),
                    professor_last_name : $('#professor_last_name').val(),
                    professor_department : $('#selectedDepartment').val(),
                    state_name: $('#CollegeStateLable').text(),
                    college_name: $('#CollegeNameLable').text(),
                    ajax : '1'
                };
                $.ajax({
                    url : "<?php echo site_url('Professor/addProfessor_Ajax'); ?>",
                    type : 'POST',
                    async : false,
                    data : form_data,
                    success : function(msg) {
                        if(msg == 'true') {
                            location.reload(true);
                        } else {
                            $('#createProfessorMessage').html(msg);
                        }
                    }
                });
                return false;
            });
        });
       

</script>
</body> </html>