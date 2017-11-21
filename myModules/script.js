
$(document).on('click', '#Uploaded', function() {
	$('#uploadeDoc').show();
	$('#listFile').hide();
	$('#list-faculty').hide();
});

$(document).on('click', '#listDocuments', function() {
	$('#uploadeDoc').hide();
	$('#listFile').show();
	$('#list-faculty').hide();
});

$(document).on('click', '#listFaculty', function() {
	$('#list-faculty').show();
	$('#uploadeDoc').hide();
	$('#listFile').hide();
});


$(document).ready(function(){
    var tooltip = ['#myNotification'];
    var title 	= ['Notification'];
    for (var i = 0; i < tooltip.length; i++) {
	    $(tooltip[i]).tooltip({
	    	title: title[i],
	    	 html: true, 
	    	 trigger: "hover",
	    	 placement: "bottom"
	    });
    }
});

function renderTime() {

	// date
	var mydate = new Date();
	var year = mydate.getYear();
		if(year < 1000) {
			year+=1900;
		}

	var day = mydate.getDay();
	var month = mydate.getMonth();
	var daym = mydate.getDate();
	var dayarray = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	var montharray = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	//end date

	var currentTime = new Date();
	var h = currentTime.getHours();
	var m = currentTime.getMinutes();
	var s = currentTime.getSeconds();
	var session = "AM";

		if(h == 0) {
			h = 12;
		}

		if(h > 12) {
			h = h - 12;
			session = "PM";
		} 

		h = (h < 10) ? "0" + h : h;
		m = (m < 10) ? "0" + m : m;
		s = (s < 10) ? "0" + s : s;
 
	// var myClock = document.getElementById("clockDisplay");
	 var dateToday = ""+dayarray[day]+" "+montharray[month]+ " "+daym+ ", "+year+" | " +h+ ": "+m+": "+s+" "+session+"";

	setTimeout("renderTime()", 1000);
	$('input[name=dateToday]').val(dateToday);
	$('#dateToday').html(dateToday);
}

renderTime();