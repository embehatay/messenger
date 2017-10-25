// Bắt sự kiện gõ phím enter trong thanh trò chuyện
$(document).ready(function() {
	$('#message').keypress(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			// Chạy hàm gửi tin nhắn
			// alert($('#formSendMsg input[type="text"]').val());
			sendMsg();   		
		}
	});

	// Bắt sự kiện click vào thanh trò chuyện
	$('#formSendMsg input[type="text"]').click(function(e) {
		// Kéo hết thanh cuộn trình duyệt đến cuối
		window.scrollBy(0, $(document).height());
	});	
});

// Hàm gửi tin nhắn
function sendMsg() {
	// Khai ba1oca1c biến trong form
	var body_msg = $('#message').val();
	alert($body_msg);
	// Gửi dữ liệu
	$.ajax({
		url : 'sendmsg.php', // đường dẫn file xử lý
		type : "post", // phương thức
		// dữ liệu
		dataType: "text";
		data : {
			body_msg : body_msg
		// thực thi khi gửi dữ liệu thành công
		}, 
		success : function(result) {
			$('#formSendMsg input[type="text"]').val(''); // làm trống thanh trò chuyện
			// $('#test').html(result);			
		}
	});
}