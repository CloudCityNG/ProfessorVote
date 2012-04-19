$(document).ready(function() {
	domModal = $('#loginModel');
	$('#submit').live('click', function() {
		domModal.modal('hide');
	});

	$('#signup').live('click', function() {
		domModal.modal('hide');
	});

	$('#loginModalClose').live('click', function() {
		domModal.modal('hide');
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
			url : "login/ajax_check",
			type : 'POST',
			async : false,
			data : form_data,
			success : function(msg) {
				$('#message').html(msg);
			}
		});
		return false;
	});
});
