var previous_message_notifi = '';
var file_name_message_notifi = '';
function message_notifi() {
	if(notificated_to.toString())
		var bien_can_truyen = notificated_to
	else
		var bien_can_truyen = 1;
	$.ajax({
		url: 'message_notifi.php',
		type: "post",
		dataType: "text",
		data: {
			notificated_to : bien_can_truyen
		},
		success : function(result) {
			if(result){
				var final_result = $.parseJSON(result);
				if(final_result.user_from) {
					$("#" + final_result.user_from).trigger('click');
					var mySound = new sound("sound/Facebook_Message_Sound.mp3");
				    mySound.play();
				}
				else if(final_result.list_message_notifi != previous_message_notifi) {
					$('.list_message_notifi').remove();
					$('#show_notification').append(final_result.list_message_notifi);
					previous_message_notifi = final_result.list_message_notifi;
					/*var myData = $.parseJSON(result);
					file_name_message_notifi = myData.file_name;
					previous_message_notifi = result;
					var cover_tag = '<li id="message_notifi_' + myData.file_name + '"></li>';
					var notification = 'Người dùng <strong>' + myData.user_from + '</strong> đã gửi tin nhắn: "<em>' + myData.body + '</em>"- vào lúc ' + myData.date_sent;
					if(!document.getElementById('message_notifi_' + file_name_message_notifi)) {
						$('#show_notification').append(cover_tag);
						$('#message_notifi_' + file_name_message_notifi).html(notification);
					}
					else
						$('#message_notifi_' + file_name_message_notifi).html(notification);*/
				}
			} else {
				$('.list_message_notifi').remove();
				previous_message_notifi = '';
				/*$('#message_notifi_' + file_name_message_notifi).remove();
				previous_message_notifi = '';
				file_name_message_notifi = '';
				date_sent = '';*/
			}
		}
	});
}

if(user_session) {
	message_notifi();
	var default_message_notifi = setInterval(function(){message_notifi();}, 5000);
}