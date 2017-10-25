// Biến lưu lại ds bạn bè
var previous_friend_list;
function show_friend_list() {
	$.ajax({
		url: "show_friend_list.php",
		type: "post",
		dataType: "text",
		data: {

		},
		success : function(result) {
			if(result && result != previous_friend_list) {
				$("#show_friend_list").html(result);
				previous_friend_list = result;
			}
		}
	});
}

show_friend_list();
setInterval(function() {show_friend_list()}, 5000);