<?php
	// Kết nối database
	include('includes/general.php');
	// Kết nối header
	include('includes/header.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$error = array();
		if(!empty($_POST['username']))
			$username = addslashes(trim($_POST['username']));
		else
			$error[] = 'username';
		if(!empty($_POST['password']))
			$password = addslashes(trim($_POST['password']));
		else
			$error[] = 'password';
		if(isset($username) && isset($password)) {
			$q = "INSERT INTO users (username, password, date_created) VALUES ('{$username}', MD5({$password}), NOW())";
			$r = mysqli_query($cn, $q);
			if(!$r) {
				die("Query {$q} \n<br /> MySQL Error: ". mysqli_error($cn));
			}
			if(mysqli_affected_rows($cn) == 1) {
				$message = "Đăng ký thành công, bạn ấn vào <a style='text-decoration: none;' href='http://localhost/messenger/index.php'>đây</a> để đăng nhập";
			}
		}
	}
?>
	// Nếu tồn tại $user
	if ($user)
	{
		// Hiển thị trò chuyện
		echo '
			<div class="main-chat">		
			</div><!-- div.main-chat -->
			<div class="box-chat">
				<form method="POST" id="formSendMsg" onsubmit="return false;">
					<input type="text" placeholder="Nhập nội dung tin nhắn ...">
				</form><!-- form#formSendMsg -->
			</div><!-- div.box-chat -->
		';
	}
	// Ngược lại
	else
	{
		// Hiển thị form đăng nhập, đăng ký
		echo '
			<?php
				if(isset($message)) echo $message;
			?>
			<div class="box-join">
				<p>Tạo tài khoản hoặc đăng nhập để tham gia với chúng tôi</p>
				<form method="POST" id="formJoin">
					<input type="text" placeholder="Tên đăng nhập" class="data-input" id="username" name="username" value="<?php if(isset($username)) echo $username; ?>"><?php if(isset($error) && in_array('username', $error)) echo '<span class="danger">Username không được để trống</span>'; ?>
					<input type="password" placeholder="Mật khẩu" class="data-input" id="password" name="password"><?php if(isset($error) && in_array('password', $error)) echo '<span class="danger">Password không được để trống</span>'; ?>
					<p><input type="submit" name="submit" value="Đăng ký" class="btn-danger"></p>
					<div class="alert danger"></div>
				</form><!-- form#formJoin -->
			</div><!-- div.box-join -->
		';
	}
<?php
	// Kết nối footer
	include('includes/footer.php');
?>