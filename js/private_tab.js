$(".private_chat").hide();
$(".private_chat:first").show();
$(document).on("click", "ul#tabs li", function() {
    $("ul#tabs li").removeClass("active");
    // alert("hihi");
    $(this).addClass("active");
    $(".private_chat").hide();
    $(".box_private").hide();
    var activeTab = $(this).attr("rel");
    $("#"+activeTab).show();
    $("#form_"+activeTab).show();
});

// Xử lý khi user ấn vào tắt tab chat
$(document).on("click", ".close_private", function() {
	// Lấy tên thằng đang chát cùng
	var file_name_using = $(this).parent().attr("rel");
	var file_name_split = [];
	file_name_split = file_name_using.split("_");
	file_name_split.splice(file_name_split.indexOf(user_session), 1);
	var user_chat_with = file_name_split[0];
	close_tab_notification(file_name_using, user_chat_with);

	// Chuẩn bị để tắt interval load tin nhắn và load thông báo tắt tab chat
	var file_index = file_name.indexOf(file_name_using);
	if(file_index > -1) {
		file_name.splice(file_index, 1);
	}

	// Khi tắt một tab chat thì phải tắt cả cái Interval đang chạy
	clearInterval(assoc_message[file_name_using]);
	delete assoc_message.file_name_using;
	var close_tab_notif = 'close_tab' + file_name_using;
	clearInterval(assoc_message[close_tab_notif]);
	delete assoc_message.close_tab_notification;

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
			user_chat_with : user_chat_with
		},
		success : function(result) {
		}
	});
}