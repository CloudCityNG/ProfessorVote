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
