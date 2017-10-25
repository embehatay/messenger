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
	if(file_exists("log.html") && filesize("log.html") > 0) {
		$handle = fopen("log.html", "r");
		$messages = fread($handle, filesize("log.html"));
		echo $messages;
	}
	//Thêm class để hiển thị tin nhắn theo user hiện tại hoặc user khác
	echo '<script>
		var all_user_msg = document.getElementsByClassName("alluser_msg");
		var all_user_detail = document.getElementsByClassName("alluser_detail");
		var specify_user = document.getElementsByClassName("specify_user");
		for(var i = 0; i < all_user_msg.length; i++) {
			var string = all_user_msg[i].getAttribute("class");
			var array = string.split(" ");
			if(array[1] == "' . "$user" . "_message". '") {
				all_user_msg[i].className += " msg-user";
				all_user_detail[i].className += " info-msg-user";
				specify_user[i].innerHTML = "Bạn";
			} else {
				all_user_msg[i].className += " msg";
				all_user_detail[i].className += " info-msg";
			}
		}
	</script>';
?>