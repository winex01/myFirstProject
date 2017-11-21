

// when the faculty login
$('#lgn-frm').submit(function(event) {
	event.preventDefault();
	var _this = $(this);
	
	$.ajax({
		url 	: 'login/login',
		type 	: 'post',
		dataType: 'json',
		data 	: _this.serialize(),
		success : function(data) {
			if (data.success) {
				window.location = data.url;
			} else {
				$('form').parent().parent().addClass('has-error');
				toastr.error(data.invalid);
			}
		},
		error   : function() {
			alert('Could not login');
		}
	});
});




