<?php
	// Kết nối database, lấy dữ liệu chung
	include('includes/general.php');

	// Nếu không tồn tại $user
	/*if (!$user)
	{
		header('Location: index.php'); // Di chuyển đến file index.php
	}*/

	// Khai báo các biến gán với dữ liệu nhận được
	$body_msg = !empty($_POST['body_msg']) ? @mysqli_real_escape_string($cn, $_POST['body_msg']) : false;
	// Xử lý chuỗi $body_msg
	$body_msg = htmlentities($body_msg);
	$body_msg = trim($body_msg);

	// Nếu $body_msg khác rỗng
	// if ($body_msg != '')
	// {
		// Thực thi gửi tin nhắn
		$query_send_msg = mysqli_query($cn, "INSERT INTO messages (id_msg, body, user_from, date_sent) VALUES (
				2,
				'$body_msg',
				'$user',
				'$date_current'
			)");
		// or die("Query {$query} \n<br /> MySQL Error: ". mysqli_error($dbc))
	// }
		// print_r($_POST['body_msg']);
		echo "con cặt";
?>