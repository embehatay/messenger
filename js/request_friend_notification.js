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
					var request_tag = '<li id="request_from_' + result + '"><p>Người dùng <strong><i>' + result + '</i></strong> đã yêu cầu kết bạn</p><p style="display: none">' + result + '</p><span class="decline"><i class="fa fa-user-times" aria-hidden="true"></i>  Decline</span><span class="accept"><i class="fa fa-check" aria-hidden="true"></i>  Accept</span></li>';
					$('#show_notification').append(request_tag);
					previous_request_friend_notification = result;
				}
			} else {
				$('#request_from_' + previous_request_friend_notification).remove();
				previous_request_friend_notification = '';
			}
		}
	});
}

request_friend_notification();
setInterval(request_friend_notification, 5000);