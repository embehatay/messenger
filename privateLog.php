<?php
	// Kết nối database, lấy dữ liệu chung
	include('includes/general.php');
	// Lấy dữ liệu từ table messages theo thứ tự id_msg tăng dần
	// $query_get_msg = mysqli_query($cn, "SELECT * FROM messages ORDER BY id_msg ASC");
	// Dùng vòng lập while để lấy dữ liệu
	// while ($row = mysqli_fetch_assoc($query_get_msg))
	// {
		// Thời gian gửi tin nhắn
		// $date_sent = $row['date_sent'];
			// $day_sent = substr($date_sent, 8, 2); // Ngày gửi
			// $month_sent = substr($date_sent, 5, 2); // Tháng gửi
			// $year_sent = substr($date_sent, 0, 4); // Năm gửi
			// $hour_sent = substr($date_sent, 11, 2); // Giờ gửi
			// $min_sent = substr($date_sent, 14, 2); // Phút gửi

		// Nếu người gửi là $user thì hiển thị khung tin nhắn màu xanh
		/*if ($row['user_from'] == $user)
		{
			echo '
				<div class="msg-user">
					<p>'.$row['body'].'</p>
					<div class="info-msg-user">
						Bạn - '.$day_sent.'/'.$month_sent.'/'.$year_sent.' lúc '.$hour_sent.':'.$min_sent.'
					</div>
				</div>
				
			';
		}*/
		// Ngược lại người gửi không phải là $user thì hiển thị khung tin nhắn màu xám
		/*else
		{
			echo '
				<div class="msg">
					<p>'.$row['body'].'</p>
					<div class="info-msg">
						'.$row['user_from'].' - '.$day_sent.'/'.$month_sent.'/'.$year_sent.' lúc '.$hour_sent.':'.$min_sent.'
					</div>
				</div>
			';
		}
	}*/

	/*
	*
	* Hiển thị dữ liệu bằng file .json
	*
	*/
	/*if(file_exists("log.json") && filesize("log.json") > 0) {
		$handle = fopen("log.json", "r");
		// fseek($handle, -2, SEEK_END);
		$messages = fread($handle, filesize("log.json"));
		// $messages = fread($handle, 1);
		// $messages = "[" . $messages . "]";
		$messages = json_decode($messages);
		// echo "<br>";
		// print_r(($messages));exit();
		foreach($messages as $row) {
			// $row = $message;
			$date_sent = $row->date_sent;
			$day_sent = substr($date_sent, 8, 2); // Ngày gửi
			$month_sent = substr($date_sent, 5, 2); // Tháng gửi
			$year_sent = substr($date_sent, 0, 4); // Năm gửi
			$hour_sent = substr($date_sent, 11, 2); // Giờ gửi
			$min_sent = substr($date_sent, 14, 2); // Phút gửi
			if ($row->user_from == $user)
			{
				echo '
					<div class="msg-user">
						<p>'.$row->body.'</p>
						<div class="info-msg-user">
							Bạn - '.$day_sent.'/'.$month_sent.'/'.$year_sent.' lúc '.$hour_sent.':'.$min_sent.'
						</div>
					</div>
					
				';
			}
			// Ngược lại người gửi không phải là $user thì hiển thị khung tin nhắn màu xám
			else
			{
				echo '
					<div class="msg">
						<p>'.$row->body.'</p>
						<div class="info-msg">
							'.$row->user_from.' - '.$day_sent.'/'.$month_sent.'/'.$year_sent.' lúc '.$hour_sent.':'.$min_sent.'
						</div>
					</div>
				';
			}
		}
	}
	*/
	/*
	*
	* Hiển thị dữ liệu bằng file .html
	*
	*/
	$private_chat = (isset($_POST['private_chat'])) ? $_POST['private_chat'] : '';
	// Tiện thể update cái trạng thái đã xem là 1
	// if(!file_exists("private/". $private_chat .".html"))
	$cn->query("UPDATE messages SET not_received = '', da_xem = 1, user1_texting_status = 0, user2_texting_status = 0 WHERE file_name = '$private_chat'");

	if(file_exists("private/". $private_chat .".html") && filesize("private/". $private_chat .".html") > 0) {
		$handle = fopen("private/". $private_chat .".html", "r");
		$messages = fread($handle, filesize("private/". $private_chat .".html"));
		echo $messages;
	}
	//Thêm class để hiển thị tin nhắn theo user hiện tại hoặc user khác
	echo '<script>
		var pri_user_msg = document.getElementsByClassName("priuser_msg");
		var pri_user_detail = document.getElementsByClassName("priuser_detail");
		var specify_user_pri = document.getElementsByClassName("specify_user_pri");
		for(var i = 0; i < pri_user_msg.length; i++) {
			var string = pri_user_msg[i].getAttribute("class");
			var array = string.split(" ");
			if(array[1] == "' . "$user" . "_message". '") {
				pri_user_msg[i].className += " msg-user";
				pri_user_detail[i].className += " info-msg-user";
				specify_user_pri[i].innerHTML = "Bạn";
			} else {
				pri_user_msg[i].className += " msg";
				pri_user_detail[i].className += " info-msg";
			}
		}
	</script>';
?>