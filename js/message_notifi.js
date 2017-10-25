function message_notifi() {
	$.ajax({
		url: 'message_notifi.php',
		type: 'post',
		dataType: 'text',
		data: {

		},
		success : function(result) {
			if(result)
				alert(result);
		}
	});
}

if(user_session) {
	var default_message_notifi = setInterval(function(){message_notifi();}, 5000);
}