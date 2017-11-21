// show edit modal
$('#editProfile').click(function() {
	$('#profile-mdl').modal('show');
});

// submit the profile form 
$(document).on('submit', '#profile-frm', function(event) {
	event.preventDefault();
	var _this = $(this);
	$.ajax({
		url 	: 'admin/edit_profile',
		type 	: 'post',
		dataType: 'json',
		data 	: _this.serialize(),
		success : function(data) {
			if (data.success) {
				_this[0].reset();
				$('#profile-mdl').modal('hide');
				toastr.success(data.msg);
				profileData();
			}
		},
		error 	: function() {
			alert('error: edit_profile');
		}
	});
});

// show modal upload
$('#upload').click(function() {
	$('#upload-mdl').modal('show');
	$('#upload-frm').attr('action', 'admin/save_upload');
});

$(document).on('submit', '#upload-frm', function(event) {
		event.preventDefault();
		var _this 	= $(this);
		var result 	= $('input[type=checkbox]').val();
		if ($('select[name=doc-title]').val() == 'select-title') {
			$('select[name=doc-title]').parent().parent().addClass('has-error');
			toastr.error('Please select category');
		} else if ($('.checkbox:checked').length == 0) {
			$('select[type=checkbox]').addClass('has-error');
			toastr.error('Please select one or more faculty to view this files!');
		} else  {	
			$.ajax({
				url 		: _this.attr('action'),
				type 		: 'post',
				dataType	: 'json',
				data 		: new FormData(this),
				processData : false,
				contentType	: false,
				cache 		: false,
				async 		: true,
				success 	: function(data) {
					if (data.success) {
						listDocuments.ajax.reload();
						toastr.success(data.msg);
						_this[0].reset();
						$('#upload-mdl').modal('hide');
						if (data.sendTrue) {
							var html = '';
							html += '<div class="alert alert-success alert-dismissable fade in">'+
								            '<button class="close" data-dismiss="alert" aria-label="close">&times;</button>'+
								            '<strong>'+data.sendOk+' '+
								        '</div>';
							$('#sendValid').html(html);
							$(".alert-success").fadeTo(3000, 500).slideUp(500, function(){
							    $(".alert-success").alert('close');
							});
						} else {
							var html = '';
							html += '<div class="alert alert-danger alert-dismissable fade in">'+
								            '<button class="close" data-dismiss="alert" aria-label="close">&times;</button>'+
								            '<strong>'+data.sendFailed+' '+
								        '</div>';
							$('#sendValid').html(html);
							$(".alert-danger").fadeTo(3000, 500).slideUp(500, function(){
							    $("#success-alert").alert('close');
							});
						}
						logs();
					} else {
						toastr.error(data.invalid);
					}
				},
				error 		: function() {
					alert('error: save_upload');
				}
			});
		}
});

$(document).on('click', '#scanBtn', function() {
	$.ajax({
		url 	: 'execute',
		type 	: 'post',
		dataType: 'json',
		success : function(data) {
			if (!data.success) {
				toastr.error(data.msg);			
			}
		}
	});
});
$('#myNotification').click(function() {
	$.ajax({
		url 	: 'admin/update_seen',
		type 	: 'post',
		dataType: 'json',
		success : function(data) {
			if (data.success) {
				$('span#hideNotification').addClass('hide');
			}
		},
		error 	: function() {
			alert('error: update_seen');
		}
	});
});

function receiveNotify() {
	$.ajax({
		url 	: 'admin/receive_notif',
		type 	: 'post',
		dataType: 'json',
		success : function(data) {
			var html   		= '';
			var newNotify 	= ['success', ' ']; 
			if (data.length == "0") {
				$('.tbl-notification').html('<span> 0 notification</span>');	
			} else {
				for (var i = 0; i < data.length; i++) {
					html += '<tr class="'+newNotify[data[i].click_notification]+'">'+
								'<td onclick=clickNotify("'+data[i].not_id+'","'+data[i].file+'")>'+data[i].fac_fname+' '+data[i].fac_mname+' '+data[i].fac_lname+' was seen your '+data[i].title+' '+data[i].date_notify+'</td>'+
							'</tr>';
				}
				$('#receiveNotify').html(html);
			}
		},
		error 	: function() {
			alert('error: receive_notif');
		}
	});
}
receiveNotify();
function clickNotify(not_id, file) {
	$.ajax({
		url 	: 'admin/click_notify',
		type 	: 'post',
		dataType: 'json',
		data 	: {not_id: not_id},
		success : function(data) {
			window.open('documents/'+file+' ','name','width=600,height=500');
			receiveNotify();
		},
		error 	: function() {
			alert('error: click_notify');
		}
	});
}	


var required = ['input[type=text]','input[type=number]', 'input[type=password]', 'input[type=tel]'];
for (var i = 0; i < required.length; i++) {
	$('form').find(required[i]).attr  ('required', true);
}

function listUpload(doc_id, num) {
	$.ajax({
		url 	: 'admin/listUpload',
		type 	: 'post',
		dataType: 'json',
		data 	: {doc_id: doc_id},
		success : function(data) {
			var html 	= '';
			var checkArr = ['remove', 'ok'];
			for (var i 	= 0; i < data.length; i++) {
				var seenDate = ['', data[i].date_seen];
				html += ''+data[i].fac_fname+' '+data[i].fac_mname+' '+data[i].fac_lname+': seen <span class="glyphicon glyphicon-'+checkArr[data[i].open]+' " ></span> <br />';
			}
			$('#demo'+num+'').html(html);
		},
		error 	: function() {
			alert('error: listUpload');
		}
	});
}

$(document).on('click', '#view', function() {
	var file = $(this).attr('data');
	window.open('documents/'+file+' ','name','width=600,height=500');	
});

function checkFaculty() {
	$.ajax({
		url 	: 'admin/show_faculty',
		type 	: 'post',
		dataType: 'json',
		success : function(data) {
			var html = '';
			for (var i = 0; i < data.length; i++) {
				html+= '<tr>'+
							'<td><input type="checkbox" class="checkbox" name="check[]" value="'+data[i].fac_ID+'"></td>'+
							'<td>'+data[i].fac_fname+' '+data[i].fac_mname+' '+data[i].fac_lname+ '</td>'+
						'</tr>';	
			}
			$('#check-faculty').html(html);
		},
		error 	: function() {
			alert('error: show_faculty');
		}
	});
}
checkFaculty();
$('#check-all').on('change', function() {
	$('.checkbox').prop('checked', $(this).prop("checked"));
});
//deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the 
//listed checkbox product is checked	
$(document).on('change', '.checkbox', function() { //".checkbox" change
	if ($('.checkbox:checked').length == $('.checkbox').length) {
		$('#check-all').prop('checked', true);
	} else {
		$('#check-all').prop('checked', false);
	}
});

// sets the attributes input required is to true
var attr = ['input[type=text]', 'input[type=file]', 'input[type=radio]'];
for (var i = 0; i < attr.length; i++) {
	$('form').find(attr[i]).attr('required', true);
}

// click the logout to show confirm modal
$('#log-out').click(function(event) {
	$('#confirm-mdl').modal('show');
	$('.modal-title').text('Confirm!');
});

// if click yes
// proceed to logout
$('#yes').click(function() {
	window.location = 'faculty/logout';
});

// show modal for new faculty
$('#new-fact').click(function() {
	$('#facult-mdl').modal('show');
	$('#faculty-frm').attr('action', 'admin/save_faculty');
	$('.modal-title').html('<i class="fa fa-plus-circle"></i> New Faculty');
});


// save faculty
$(document).on('submit', '#faculty-frm', function(event) {
	event.preventDefault();
	var _this 	= $(this);
	var gender 	= $('select[name=gender]').val();
	var url 	= _this.attr('action');
	if (gender == 'gender') {
		toastr.error('Please Select gender!');
		$('select[name=gender]').parent().parent().addClass('has-error');

	} else {
		$.ajax({
			url 	: url,
			type 	: 'post',
			dataType: 'json',
			data 	: _this.serialize(),
			success : function(data) {
				if (data.success) {
					toastr.success(data.msg);
					$('#facult-mdl').modal('hide');
					_this[0].reset();
					showFaculty();
					checkFaculty();
				} else {
					toastr.error(data.idExist);
				}
			},
			error 	: function() {
				alert('error: saveFaculty');
			}
		});
	}
});

// show faculty data through table
function showFaculty() {
	$.ajax({
		url 	: 'admin/show_faculty',
		type 	: 'post',
		dataType: 'json',
		success : function(data) {
			var html = '';
			for (var i = 0; i < data.length; i++) {
				html += '<tr>'+
							'<td>'+data[i].fac_ID+'</td>'+
							'<td>'+data[i].fac_fname+' '+data[i].fac_mname+' '+data[i].fac_lname+ '</td>'+
							'<td>'+data[i].phone_num+'</td>'+
							'<td>'+data[i].date_added+'</td>'+
							'<td><button class="btn btn-warning" data="'+data[i].f_id+'" id=editF><i class="fa fa-pencil"></i> Edit</button></td>'+
						+'</tr>';
			}
			$('#faculty-tbl').html(html);
			var dataTable = $('#table-faculty').DataTable();
			$('#table-faculty tbody').on('click', 'tr', function() {
				if ( $(this).hasClass('selected') ) {
		            $(this).removeClass('selected');
		        }
		        else {
		            dataTable.$('tr.selected').removeClass('selected');
		            $(this).addClass('selected');
		        }
			});
		},
		error 	: function() {
			alert('error: showFaculty');
		}
	});
}
showFaculty();

// show edit modal faculty
$(document).on('click', '#editF', function() {
	var id = $(this).attr('data');
	$('#facult-mdl').modal('show');
	$('#faculty-frm').attr('action', 'admin/edit_faculty');
	$('#faculty-frm').attr('id', 'editFaculty-frm');
	$('.modal-title').html('<i class="fa fa-pencil"></i> Edit Faculty')
	$('#fac-id').val(id);
	$.ajax({
		url 	: 'admin/faculty_data',
		type 	: 'post',
		dataType: 'json',
		data 	: {id:id},
		success : function(data) {
			$('input[name=factID]').val(data.fac_ID);
			$('input[name=fname]').val(data.fac_fname);
			$('input[name=mname]').val(data.fac_mname);
			$('input[name=lname]').val(data.fac_lname);
			$('input[name=phoneNo]').val(data.phone_num);
			$('input[name=user-id]').val(data.user_id);
		},
		error 	: function() {
			alert('error: facultyData');
		}
	});

});

// edit faculty 
$(document).on('submit', '#editFaculty-frm', function(event) {
	event.preventDefault();
	var _this = $(this);
	$.ajax({
		url 	: _this.attr('action'),
		type 	: 'post',
		dataType: 'json',
		data 	: _this.serialize(),
		success : function(data) {
			if (data.success) {
				_this[0].reset();
				$('#facult-mdl').modal('hide');
				toastr.success(data.msg);
				showFaculty();
			}
		},
		error 	: function() {
			alert('error: editFaculty');
		}
	});
});

// load documents title
$(document).ready(function() {
	$.ajax({
		url 	: 'admin/category',
		type 	: 'post',
		dataType: 'json',
		success : function(data) {
			var html = '';
			html += '<select class="form-control" name=doc-title>';
			html += '<option value="select-title"> --- Select Category ----</option>';
				for (var i = 0; i < data.length; i++) {
					html += '<option value="'+data[i].title_id+'">'+data[i].title_name+'</option>';
				}
			html += '</select>';
			$('#category').html(html);
		},
		error 	: function() {
			alert('error: category');
		}
	});
});

function openfile(doc_id, fac_ID) {
	$.ajax({
		url 	: 'admin/openfile',
		type 	: 'post',
		dataType: 'json',
		data 	: {
			doc_id	 : doc_id,
			fac_ID	 : fac_ID
		},
		success : function(data) {

		},
		error 	: function() {
			alert('error: openfile');
		}
	});	
}

// count all notifications
$(document).ready(function() {
	setInterval(function() {
		$.ajax({
			url 	: 'admin/notification',
			type 	: 'post',
			success : function(data) {
				if (data != "0") {
					$('.myNotification').load('admin/notification').fadeIn('slow');
				} 
			}
		});
	}, 3000);
});

// change password or username modal show
$('#changePass').click(function() {
	$('#change-mdl').modal('show');
	$('input#username').attr('required', false);
});

// show modal change pic
function changePic() {
	$('#changePic-mdl').modal('show');
}

// save selected picture
$(document).on('submit', '#changePic-frm', function(event) {
	event.preventDefault();
	var _this = $(this);
	$.ajax({
		url 	: 'admin/change_pic',
		type 	: 'post',
		dataType: 'json',
		data 	: new FormData(this),
		processData: false,
        contentType: false,
        cache:false,
        async:true,
		success : function(data) {
			if (data.success) {
				toastr.success(data.msg);
				$('#changePic-mdl').modal('hide');
				_this[0].reset();
				profileData();
			}
		},
		error 	: function() {
			alert('error: changePic');
		}
	});
});


// profile data
function profileData() {
	$.ajax({
		url 	: 'login/profile',
		type 	: 'post',
		dataType: 'json',
		success : function(data) {
			$('#profile-frm').find('input[name=fname]').val(data.fac_fname);
			$('#profile-frm').find('input[name=mname]').val(data.fac_mname);
			$('#profile-frm').find('input[name=lname]').val(data.fac_lname);
			var gender = ['avatar.png', 'avatar3.png'];
			if (data.img == "") {
				$('#profile-pic').html('<td onclick="changePic()"> <img src="image/'+gender[data.gender]+'" class="img-circle" width="160" height="135"><td>');
			} else {
				$('#profile-pic').html('<td onclick="changePic()"> <img src="image/'+data.img+'" class="img-circle" width="160" height="135"><td>');
			}
			$('#profile').html(' '+data.fac_fname+' '+data.fac_mname+' '+data.fac_lname);
		},
		error 	: function() {
			alert('error: profile');
		}
	});
}
profileData();
// change najud
$(document).on('submit', '#change-frm', function(event) {
	event.preventDefault();
	var _this = $(this);
	var error = [$('input[name=password]'), $('input[name=confirm-password]')];
	if ($('input[name=password]').val()!=$('input[name=confirm-password]').val()) {
		for (var i = 0; i < error.length; i++) {
			error[i].parent().parent().addClass('has-error');
		}
		toastr.error('Password not matched');
	} else {
		$.ajax({
			url 	: 'login/changeP_U',
			type 	: 'post',
			dataType: 'json',
			data 	: _this.serialize(),
			success : function(data) {
				if (data.success) {
					toastr.success(data.msg);
					$('#change-mdl').modal('hide');
					$('input[name=oldPass]').parent().parent().removeClass('has-error');
					_this[0].reset();
					profileData();
				}else {
					toastr.error('Old password is incorrect!');
					$('input[name=oldPass]').parent().parent().addClass('has-error');
				}
			},
			error 	: function() {
				alert('error: changeP_U');
			}
		});
	}
});


// get all faculty logs
function logs() {
	$.ajax({
		url 	: 'admin/getLogs',
		type 	: 'post',
		dataType: 'json',
		success : function(data) {
			var html = '';
			for (var i = 0; i < data.length; i++) {
				html += '<tr>'+
							'<td>'+data[i].fac_fname+' '+data[i].fac_mname+' '+data[i].fac_lname+' <small><i>'+data[i].task+' '+data[i].file_title+' on '+data[i].log_date+'</i></small></td>'+
						'</tr>';
			}
			$('#all-logs').html(html);
		},
		error 	: function() {
			alert('error: getLogs');
		}
	});
}
logs();
