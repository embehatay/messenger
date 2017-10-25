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

//Gửi thông báo về cho user trong mảng notificated_to
function get_notification() {
	$.ajax({
		url: "get_notification.php",
		type: "post",
		dataType: "text",
		data: {

		},
		success : function(result) {
			if(result)
				$("#notification").html(result);
		}
	});
}

setInterval(get_notification, 6000);