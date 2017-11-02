/*$(".add_friend").click(function() {
	alert("hihi");
});*/
// Gửi tên người dùng mà mình muốn thêm bạn lên server
function add_friend(friend) {
	$.ajax({
		url: "add_friend.php",
		type: "post",
		dataType: "text",
		data: {
			friend: friend,
		},
		success: function(result) {
			alert("Bạn đã thêm " + friend + ", chờ phản hồi.");
		}
	});
}

function accept_friend(friend) {
	$.ajax({
		url: "accept_friend.php",
		type: "post",
		dataType: "text",
		data: {
			friend: friend,
		},
		success: function(result) {
			alert("Bạn đã thêm " + friend + " vào danh sách bạn bè");
		}
	});
}

function decline_friend(friend) {
	$.ajax({
		url: "decline_friend.php",
		type: "post",
		dataType: "text",
		data: {
			friend: friend,
		},
		success: function(result) {
			alert("Bạn đã từ chối lời mời kết bạn của " + friend);
		}
	});
}

$(document).on("click", ".add_friend", function() {
	add_friend($(this).prev().attr("id"));
});

$(document).on("click", ".accept", function() {
	accept_friend($(this).prev().prev().text());
});

$(document).on("click", ".decline", function() {
	decline_friend($(this).prev().text());
});
