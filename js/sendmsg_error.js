// Hàm gửi tin nhắn
function sendMsg() {
	// Khai ba1oca1c biến trong form
	$body_msg = $('#formSendMsg input[type="text"]').val();

	// alert($body_msg);
	// Gửi dữ liệu
	$.ajax({
		url : 'sendmsg.php', // đường dẫn file xử lý
		type : 'POST', // phương thức
		// dữ liệu
		data : {
			body_msg : $body_msg
		// thực thi khi gửi dữ liệu thành công
		}, success : function() {
			$('#formSendMsg input[type="text"]').val(''); // làm trống thanh trò chuyện
		}
	});
}

function sendPrivate(message, private_chat, le3, chatter) {
	$body_msg = message;
	$.ajax({
		url : 'sendPrivate.php', 
		type : 'POST', 
		data : {
			body_msg : $body_msg,
			private_chat: private_chat,
			user_session: user_session,
			chatter: chatter
		}, success : function() {
			le3.val('');
		}
	});
}

function get_message(private_chat, chatter) {
	$.ajax({
		url : 'get_msg.php', 
		type : 'POST', 
		data : {
			private_chat: private_chat,
			user_session: user_session,
			chatter: chatter
		}, success : function(result) {
			if(result) {
				$("#" + private_chat).append(result);
				var wtf = $('#' + private_chat);
				var height = wtf[0].scrollHeight;
				wtf.scrollTop(height);
			}
		}
	});
}

function loadData(private_chat) {
	$.ajax({
        url : "privateLog.php",
        type : "post",
        dataType:"text",
        data : {
            private_chat: private_chat
        },
        success : function (result){
        	$('#'+private_chat).html(result);
        	var wtf = $('#' + private_chat);
			var height = wtf[0].scrollHeight;
			wtf.scrollTop(height);
        }
    });
}

function load_ajax(){
    // alert("hihi");
    $.ajax({
        url : "test.php",
        type : "post",
        dataType:"text",
        data : {
             number : $('#formSendMsg input[type="text"]').val()
        },
        success : function (result){
        	$('#formSendMsg input[type="text"]').val('')
            $('#test').html(result);
        }
    });
}  

// Bắt sự kiện gõ phím enter trong thanh trò chuyện
$('#formSendMsg input[type="text"]').keypress(function(event) {
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if (keycode == '13') {
		// alert("hihi");
		// Chạy hàm gửi tin nhắn
		sendMsg();
	}
});

// Bắt sự kiện click vào thanh trò chuyện
$('#formSendMsg input[type="text"]').click(function(e) {
	// Kéo hết thanh cuộn trình duyệt đến cuối
	window.scrollBy(0, $(document).height());
});

// Tạo mảng để lưu lại những thằng đang chat cùng
var notificated_to = [];
// Mảng lưu lại những file đang bật lên dùng để bật/tắt thông báo tin nhắn và thông báo đăng xuất
var file_name = [];
// Tạo đối tượng lưu lại các cái Interval
var assoc_message = {};

// Hàm tạo tab chat
// Đồng thời setInterval cho thông báo khi 1 user tắt tab chat
function create_tab_chat(chatter, private_chat) {
	notificated_to.push(chatter);
	file_name.push(private_chat);
	//Bỏ class active
	$("ul#tabs li").removeClass("active");
    $(".private_chat").hide();
    $(".box_private").hide();
	//Tạo tiêu đề chat
	var header1 = $('<li rel="'+private_chat+'" class="active"><strong>'+ chatter +'</strong><span id="request_button_'+ private_chat +'" class="request_close_chat"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span><span class="close_private"><i class="fa fa-window-close" aria-hidden="true"></i></span></li>');
	//Tạo form nhap tin nhan
	var form_id = "form_" + private_chat;
	var le1 = $('<div id='+form_id+' class="box_private"></div>');
	var le2 = $('<form method="POST" class="form_private" onsubmit="return false;"></form>');
	var le3 = $('<input type="text" placeholder="Nhập nội dung tin nhắn ...">');
	le2.append(le3);
	le1.append(le2);
	//Vùng chat
	var el = $('<div id="' + private_chat + '" class="private_chat"></div>');
	$("#tabs").append(header1);
	$("#tab_container").append(el);
	$("#tab_container").append(le1);
	le3.focus();
	// khi mới mở tab chat thì load file sử dụng ra trước, lợi dụng cái này để xóa tên người nhận trong CSDL trước
	loadData(private_chat);
	le3.keypress(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			if(le3.val()) {
				var today = new Date();
				var d = today.getDate();
			    var mo = today.getMonth() + 1;
			    var y = today.getFullYear();
				var h = today.getHours();
			    var m = today.getMinutes();
			    if(d < 10)
			    	d = '0' + d;
			    if(mo < 10) {
			    	mo = '0' + mo;
			    }
			    if(h < 10)
			    	h = '0' + h;
			    if(m < 10) {
			    	m = '0' + m;
			    }
				var user_message = '<div class="msg-user"><p>' + le3.val() + '</p><div class="info-msg-user">Bạn - '+ d + '/'+ mo + '/'+ y +' lúc ' + h + ':'+ m +'</div></div>';
				$("#" + private_chat).append(user_message);
				var wtf = $('#' + private_chat);
				var height = wtf[0].scrollHeight;
				wtf.scrollTop(height);
				sendPrivate(le3.val(), private_chat, le3, chatter);
			}
		}
	});
	// var load_message = setInterval(function() {get_message(private_chat, chatter);}, 1000);
	var load_close_tab_notification = setInterval(function() {get_close_tab_notification(private_chat, del_close_notif_first);}, 5000);
	var load_request_close_notification = setInterval(function() {get_request_close_notification(private_chat, del_close_notif_first, chatter);}, 5000);
	// Quăng interval vô đối tượng này để về sau tắt
	assoc_message[private_chat] = load_message;
	assoc_message['close_tab' + private_chat] = load_close_tab_notification;
	assoc_message['request_close' + private_chat] = load_request_close_notification;
}

// Cái này để xử lý phần chat solo khi click từ vùng user online
$(document).on("click", ".private_msg", function() {
	if($(this).attr("id") != user_session) {
		var chatter = $(this).attr("id");
		var private_chat = (user_session < chatter) ? user_session + "_" + chatter : chatter + "_" + user_session;
		// Nếu không tồn tại tab chat giữa 2 thằng thì tạo tab chat
		if(!document.getElementById(private_chat)) {
			if(del_close_notif_first == 1) {
				// Khi 1 thằng ấn vào tên thằng khác để chat thì phải xóa trường user_chat_with trước trong cả 2 bảng để 
				// chỉ hiện thông báo khi cả 2 thằng đang chat cùng nhau
				get_close_tab_notification(private_chat, del_close_notif_first);
				get_request_close_notification(private_chat, del_close_notif_first, chatter);
				del_close_notif_first = 0;
			}
			create_tab_chat(chatter, private_chat);
		}
	}
});

// Cái này để xử lý phần chat solo khi click từ vùng friend list
$(document).on("click", ".show_friends", function() {
	var chatter = $(this).children().html();
	var private_chat = (user_session < chatter) ? user_session + "_" + chatter : chatter + "_" + user_session;
	if(!document.getElementById(private_chat)) {
		if(del_close_notif_first == 1) {
			get_close_tab_notification(private_chat, del_close_notif_first);
			get_request_close_notification(private_chat, del_close_notif_first, chatter);
			del_close_notif_first = 0;
		}
		create_tab_chat(chatter, private_chat);
	}
});

//Gửi thông báo về cho user trong mảng notificated_to
function get_logout_notification() {
	$.ajax({
		url: "get_logout_notification.php",
		type: "post",
		dataType: "text",
		data: {

		},
		success : function(result) {
			if(result) {
				var file_using = (result < user_session) ? result + '_' + user_session : user_session + '_' + result;
				if(document.getElementById(file_using)) {
					$("#" + file_using).append("<p style='color: red'>Người dùng <strong>" + result + "</strong> đã đăng xuất</p>");
					var wtf = $('#' + file_using);
					var height = wtf[0].scrollHeight;
					wtf.scrollTop(height);					
				}
			}
		}
	});
}

setInterval(get_logout_notification, 4000);

// Khi 1 user tắt tab chat thì thông báo cho thằng đang chat cùng nó biết
var del_close_notif_first = 1;
function get_close_tab_notification(private_chat, del_close_notif_first) {
	$.ajax({
		url : "get_close_tab_notification.php",
		type: "post",
		dataType : "text",
		data : {
			del_close_notif_first : del_close_notif_first,
			private_chat : private_chat
		},
		success : function(result) {
			if(result) {
				$('#' + private_chat).append("<p style='color: red'>Người dùng <strong>" + result + "</strong> đã tắt cuộc trò chuyện</p>");
				var wtf = $('#' + private_chat);
				var height = wtf[0].scrollHeight;
				wtf.scrollTop(height);
			}
		}
	});
}

// Thông báo khi 1 thằng yêu cầu tắt chat
function get_request_close_notification(private_chat, del_close_notif_first, chatter) {
	$.ajax({
		url : "get_request_close_notification.php",
		type: "post",
		dataType : "text",
		data : {
			chatter : chatter,
			del_close_notif_first : del_close_notif_first,
			private_chat : private_chat
		},
		success : function(result) {
			if(result) {
				$('#' + private_chat).append("<p style='color: red'>Người dùng <strong>" + result + "</strong> đã yêu cầu tắt cuộc trò chuyện</p>");
				$('#request_button_' + private_chat).remove();
				var wtf = $('#' + private_chat);
				var height = wtf[0].scrollHeight;
				wtf.scrollTop(height);
			}
		}
	});
}