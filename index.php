<?php
	// Kết nối database
	include('includes/general.php');
	// Kết nối header
	include('includes/header.php');

	// Nếu tồn tại $user
	if ($user)
	{
		// Hiển thị trò chuyện
		echo '
			<div id="main">
				<div class="main-chat">
					<h3 style="color: red; text-align: center; border-bottom: 1px solid red; height: 35px; padding-top: 8px">Your Notifications</h3><ul id="show_notification"></ul>		
				</div><!-- div.main-chat -->
				<!--<div class="box-chat">
					<form method="POST" id="formSendMsg" onsubmit="return false;">
						<input type="text" placeholder="Nhập nội dung tin nhắn ...">
					</form> form#formSendMsg 
				</div> div.box-chat -->
			</div>
			<div id="private">
				<ul id="tabs"></ul>
				<div id="tab_container"></div>
			</div>
			<div id="show_friend_and_user">
				<div id="online_users"></div>
				<div id="friend_list_container"><h3 style="color: white; text-align: center; border-bottom: 1px solid red; height: 35px; padding-top: 8px">Your Friends</h3><ul id="show_friend_list"></ul></div>
			</div>
			<script>
				var user_session = "' . $user . '";	
			</script>
			<div id="test"></div>
		';
	}
	// Ngược lại
	else
	{
		// Hiển thị form đăng nhập, đăng ký
		echo '
			<div class="box-join">
				<p>Tạo tài khoản hoặc đăng nhập để tham gia với chúng tôi</p>
				<form method="POST" id="formJoin" onsubmit="return false;">
					<input type="text" placeholder="Tên đăng nhập" class="data-input" id="username" autofocus>
					<input type="password" placeholder="Mật khẩu" class="data-input" id="password">
					<a href="http://localhost/messenger/register.php" class="btn-danger">Đăng ký</a>
					<button class="btn-submit">Bắt đầu</button>
					<div class="alert danger"></div>
				</form><!-- form#formJoin -->
			</div><!-- div.box-join -->
		';
	}

	// Kết nối footer
	include('includes/footer.php');
?>