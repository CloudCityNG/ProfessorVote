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
<script src="/scripts/jquery.validate.min.js"></script>
<script src="/scripts/bootstrap.min.js"></script>
<script src="/scripts/header.js"></script>
<script src="/CoursePulse/assets/js/pulse.core.js"></script>
<script type="text/javascript">
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

</script>
</body> </html>