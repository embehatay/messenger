//Gửi mảng notificated_to lên server
/*$("#logout").click(function() {
	$.ajax({
		url: "logout.php",
		type: "post",
		dataType: "text",
		data: {
			notificated_to: notificated_to
		},
		success : function() {
			alert("hihi");
		}
	});
});*/

//Khi 1 user log out thì thông báo cho những thằng đang chat cùng biết
$("#logout").click(function() {
	$.ajax({
		url: "logout.php",
		type: "post",
		dataType: "text",
		data: {
			notificated_to : notificated_to
		},
		success : function(result) {
			
		}
	});
});

