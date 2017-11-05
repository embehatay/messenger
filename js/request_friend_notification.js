var previous_request_friend_notification = '';
function request_friend_notification() {
	$.ajax({
		url : 'request_friend_notification.php',
		type : "post",
		dataType : "text",
		data : {

		},
		success : function(result) {
			if(result){
				if(result != previous_request_friend_notification) {
					$('.users_request').remove();					
					$('#show_notification').append(result);
					previous_request_friend_notification = result;
				}
			} else {
				$('.users_request').remove();
				previous_request_friend_notification = '';
			}
		}
	});
}

request_friend_notification();
setInterval(request_friend_notification, 5000);