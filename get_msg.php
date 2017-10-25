<?php
	include('includes/general.php');
	$private_chat = $_POST['private_chat'];
	$user_session = $_POST['user_session'];
	$query_get_msg = "SELECT * FROM messages WHERE file_name = '$private_chat'";
	$result = $cn->query($query_get_msg);
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if(!empty($row['not_received'])) {
			// $not_received = array();
			$not_received = $row['not_received'];
			if($user_session == $not_received) {
				$q2 = "UPDATE messages SET not_received = '' WHERE file_name = '$private_chat'";
				if(!$cn->query($q2)) echo 'Error: ' . $cn->error;
				$date_sent = $row['date_sent'];
				$day_sent = substr($date_sent, 8, 2); // Ngày gửi
				$month_sent = substr($date_sent, 5, 2); // Tháng gửi
				$year_sent = substr($date_sent, 0, 4); // Năm gửi
				$hour_sent = substr($date_sent, 11, 2); // Giờ gửi
				$min_sent = substr($date_sent, 14, 2); // Phút gửi
				echo '
					<div class="msg">
						<p>'.$row['body'].'</p>
						<div class="info-msg">
							'.$row['user_from'].' - '.$day_sent.'/'.$month_sent.'/'.$year_sent.' lúc '.$hour_sent.':'.$min_sent.'
						</div>
					</div>
				';
			}
		}		
	}
?>