$(document).on("click", ".request_close_chat", function() {
	user_chat_with = $(this).parent().text();
	file_name_using = $(this).parent().attr("rel");
	send_request_close_chat(file_name_using);
	alert("Bạn đã yêu cầu dừng cuộc trò chuyện với user: " + user_chat_with);
	$(this).remove();
});

function send_request_close_chat(file_name_using) {
	$.ajax({
		url : "send_request_close_chat.php",
		type : "post",
		dataType : "text",
		data : {
			file_name_using : file_name_using
		},
		success : function() {

		}
	});
}