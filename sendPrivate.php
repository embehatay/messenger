<?php
	// Lưu chat vào database
	// Kết nối database, lấy dữ liệu chung
	include('includes/general.php');

	// Nếu không tồn tại $user
	if (!$user)
	{
		header('Location: index.php'); // Di chuyển đến file index.php
	}
	$body_msg = !empty($_POST['body_msg']) ? @mysqli_real_escape_string($cn, $_POST['body_msg']) : false;
	// Xử lý chuỗi $body_msg
	$body_msg = htmlentities($body_msg);
	$body_msg = trim($body_msg);
	$private_chat = $_POST['private_chat'];
	$not_received = $_POST['chatter'];

	/*
	*
	* Lưu chat vào Database
	*
	*/
	// Nếu $body_msg khác rỗng
	// if ($body_msg != '')
	// {
		// Thực thi gửi tin nhắn
		/*$query_send_msg = mysqli_query($cn, "INSERT INTO messages (body, user_from, date_sent) VALUES (		
				'{$body_msg}',
				'{$user}',
				'{$date_current}'
			)");*/

	/*
	*
	* Lưu chat vào file .json
	*
	*/
	/*if(!empty($user)) {
		$body_msg = !empty($_POST['body_msg']) ? @mysqli_real_escape_string($cn, $_POST['body_msg']) : false;
		$body_msg = htmlentities($body_msg);
		$body_msg = trim($body_msg);
		$data = array(
			"body" => $body_msg,
			"user_from" => $user,
			"date_sent" => $date_current
		);
		$fp = fopen("log.json", 'r+');
		if(fread($fp, 1) == '')
			fwrite($fp, "[]");
		fseek($fp, -2, SEEK_END);
		//Cái if này để chỉ chạy khi chưa có dữ liệu gì
		if(fread($fp, 1) == '['){
			fwrite($fp, json_encode($data) . "]");
		}
		//Cái if này chạy khi đã có dữ liệu trong file log.json
		else {
			fseek($fp, -2, SEEK_END);
			if(fread($fp, 1) == '}')
			fwrite($fp, "," . json_encode($data) . "]");
		}
		fclose($fp);
	}*/

	/*
	*
	* Lưu chat vào file .html
	*
	*/
	if($body_msg != '') {
		$query_send_msg = "INSERT INTO messages (file_name, body, user_from, date_sent, not_received) VALUES ('$private_chat', '$body_msg', '$user', '$date_current', '$not_received') ON DUPLICATE KEY UPDATE body = '$body_msg', user_from = '$user', date_sent = '$date_current', not_received = '$not_received', da_xem = 0";
		mysqli_query($cn, $query_send_msg);
		$day_sent = substr($date_current, 8, 2); // Ngày gửi
		$month_sent = substr($date_current, 5, 2); // Tháng gửi
		$year_sent = substr($date_current, 0, 4); // Năm gửi
		$hour_sent = substr($date_current, 11, 2); // Giờ gửi
		$min_sent = substr($date_current, 14, 2); // Phút gửi
		$fp = fopen("private/". $private_chat .".html", 'a');
		$data = 
		'<div class="priuser_msg ' .$user. "_message" . '">
			<p>'.$body_msg.'</p>
			<div class="priuser_detail ' .$user. "_message_detail" . '">
				<span class="specify_user_pri">' .$user . '</span> - '.$day_sent.'/'.$month_sent.'/'.$year_sent.' lúc '.$hour_sent.':'.$min_sent.'
			</div>
		</div>';
		fwrite($fp, $data);
		fclose($fp);
	}
?>