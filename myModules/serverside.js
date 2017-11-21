
	// list documents file uploaded by the sender
	var listFile = $('#fileTbl').DataTable({
		"bProcessing" 	: true,
		"serverSide" 	: true,
		"responsive"    : true,
		"ajax" 			: {
			url 		: 'query_data/fetchfile_uploaded',
			type 		: 'post'
		},
		"rowCallback": function( row, data ) {
            var highlight = ['success', ''];
            $(listFile.$('tr', row)).addClass(highlight[data[4]]);
        },
        "order": [],
		"columnDefs"  : [
			{
				"targets" 	: [0, 1, 2, 3],
				"orderable" : true
			}
		]
	});
	$('#fileTbl tbody').on('click', 'tr', function() {
		var tr   = $(this).closest('tr');
		var row  = listFile.row( tr );
		var data = row.data();
		openfile(data[5], data[6]);
		if ( $(this).hasClass('selected') ) {
		    $(this).removeClass('selected');
		} else {
		    listFile.$('tr.selected').removeClass('selected');
		    $(this).removeClass('success');
		    $(this).addClass('selected');
		    window.open('documents/'+data[1]+' ','name','width=800,height=500');
		}
	});
	$('#fileTbl tbody').on('mouseover', 'tr', function() {
		var tr   = $(this).closest('tr');
		var row  = listFile.row( tr );
		var data = row.data();
		if (data) {
			 $(tr).tooltip({
			 	title 		: 'Uploaded by: '+data[7]+' '+data[8]+' '+data[9]+'',
			 	html		: true,
			 	trigger		: "hover",
			 	placement	: "top"
			 }); 
		}
	});

	// get faculty or administrator uploaded documents
	var listDocuments = $('#table-uploaded').DataTable({
		"bProcessing" : true,
		"serverSide"  : true,
		"responsive"  : true,
		"ajax" 		  : {
			url 	  : "query_data/fetchfile_file",
			type 	  : 'post'
		},
        "order": [],
		"columnDefs"  : [
			{
				"targets" 	: [0, 1, 2, 3],
				"orderable" : true
			}
		]
	});

	listDocuments.ajax.reload();
	
	$('#table-uploaded tbody').on('click', 'tr', function() {
		var tr   = $(this).closest('tr');
		var row  = listDocuments.row( tr );
		var data = row.data();
		if ( $(this).hasClass('selected') ) {
		    $(this).removeClass('selected');
		} else {
		    listDocuments.$('tr.selected').removeClass('selected');
		    $(this).removeClass('success');
		    $(this).addClass('selected');
		    window.open('documents/'+data[1]+' ','name','width=800,height=500');
		}
	});
	$('#table-uploaded tbody').on('mouseover', 'tr', function() {
		var tr   = $(this).closest('tr');
		var row  = listDocuments.row( tr );
		var data = row.data();
		// ajax request to update the documents that seen by the faculty or administrator 
		    $.ajax({
				url 	: 'admin/list_upload',
				type 	: 'post',
				dataType: 'json',
				data 	: {doc_id: data[4]},
				success : function(data) {
					var html = '';
					var checkArr = ['remove', 'check'];
					for (var i = 0; i < data.length; i++) {
						html += '<tr>'+
									'<td>'+data[i].fac_fname+' '+data[i].fac_mname+' '+data[i].fac_lname+'</td>'+
									'<td>: seen <i class="fa fa-'+checkArr[data[i].open]+'"></i></td>'+
								'</tr>';
						$('#list').html(html);
					}
						$(tr).popover({
							title 		: '',
							html		: true,
							trigger		: "hover",
							placement	: "bottom",
							content 	: '<table> <tr> <thead> <th></th><th></th> </thead> </tr><tbody id="list"></tbody> </table>'
						}); 
				},
				error 	: function() {
					alert('error: listUpload');
				}
			});
		 
	});