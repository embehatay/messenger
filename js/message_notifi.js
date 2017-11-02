var previous_message_notifi = '';
var file_name_message_notifi = '';
function message_notifi() {
	$.ajax({
		url: 'message_notifi.php',
		type: 'post',
		data: {

		},
		success : function(result) {
			if(result){
				if(result != previous_message_notifi) {
					var myData = $.parseJSON(result);
					file_name_message_notifi = myData.file_name;
					previous_message_notifi = result;
					var cover_tag = '<li id="message_notifi_' + myData.file_name + '"></li>';
					var notification = 'Người dùng <strong>' + myData.user_from + '</strong> đã gửi tin nhắn: "<em>' + myData.body + '</em>"- vào lúc ' + myData.date_sent;
					if(!document.getElementById('message_notifi_' + file_name_message_notifi)) {
						$('#show_notification').append(cover_tag);
						$('#message_notifi_' + file_name_message_notifi).html(notification);
					}
					else
						$('#message_notifi_' + file_name_message_notifi).html(notification);
				}
			} else {
				$('#message_notifi_' + file_name_message_notifi).remove();
				previous_message_notifi = '';
				file_name_message_notifi = '';
				date_sent = '';
			}
		}
	});
}

if(user_session) {
	message_notifi();
	var default_message_notifi = setInterval(function(){message_notifi();}, 5000);
}