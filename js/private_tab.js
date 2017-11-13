$(".private_chat").hide();
$(".private_chat:first").show();
$(document).on("click", "ul#tabs li", function() {
    $("ul#tabs li").removeClass("active");
    $(this).addClass("active");
    $(".private_chat").hide();
    $(".box_private").hide();
    var activeTab = $(this).attr("rel");
    $("#"+activeTab).show();
    $("#form_"+activeTab).show();
    $("#form_"+activeTab+" input").focus();
});

// Xử lý khi user ấn vào tắt tab chat
$(document).on("click", ".close_private", function() {
	// Lấy tên thằng đang chát cùng
	var file_name_using = $(this).parent().attr("rel");
	close_tab_notification(file_name_using, user_session);

	// Xóa tên thằng đang chat cùng khỏi mảng notificated_to để nó ko nhận thông báo là mình đã logout nữa
	// Lấy tên thằng đang chat cùng trước
	var user_chat_with = $(this).parent().text();
	var index = notificated_to.indexOf(user_chat_with);
	if(index > -1) {
		notificated_to.splice(index, 1);
	}

	// Chuẩn bị để tắt interval load tin nhắn và load thông báo tắt tab chat đồng thời xóa file này khỏi mảng file_name
	var file_index = file_name.indexOf(file_name_using);
	if(file_index > -1) {
		file_name.splice(file_index, 1);
	}

	// Khi tắt một tab chat thì phải tắt cả cái Interval đang chạy và xóa thuộc tính ở trong đối tượng assoc_message
	clearInterval(assoc_message[file_name_using]);
	delete assoc_message.file_name_using;
	var close_tab_notif = 'close_tab' + file_name_using;
	clearInterval(assoc_message[close_tab_notif]);
	delete assoc_message.close_tab_notif;
	var request_close_notif = 'request_close' + file_name_using;
	clearInterval(assoc_message[request_close_notif]);
	delete assoc_message.request_close_notif;

	// Xóa tab chat khỏi DOM
	$("#" + file_name_using).remove();
	$("#form_" + file_name_using).remove();
	$(this).parent().remove();
});

// Hàm xử lý khi user tắt tab chat thì gửi tên người chat cùng lên server để tạo thông báo
function close_tab_notification(file_name_using, user_chat_with) {
	$.ajax({
		url : "close_tab_notification.php",
		type: "post",
		dataType: "text",
		data : {
			file_name_using : file_name_using,
			user_session : user_session
		},
		success : function(result) {
		}
	});
}