<?php
	include('includes/general.php');
	$notificated_to = $_POST['notificated_to'];
	// $restrict = join("','", $notificated_to);
	if(!is_array($notificated_to) && $notificated_to == 1)
		$sql_select_not_received = "SELECT * FROM messages";
	else if(is_array($notificated_to) && count($notificated_to) == 1)
		$sql_select_not_received = "SELECT * FROM messages WHERE user_from <> '$notificated_to[0]'";
	else if(is_array($notificated_to) && count($notificated_to) > 1){
		$restrict = join("','", $notificated_to);
		$sql_select_not_received = "SELECT * FROM messages WHERE user_from NOT IN ('$restrict')";
	}
	// $sql_select_not_received = "SELECT * FROM messages WHERE not_received NOT IN ('$restrict')";
	$result_not_received = $cn->query($sql_select_not_received);
	$final_result = array();
	$final_result['list_message_notifi'] = '';
	while($row = $result_not_received->fetch_assoc()) {
		if($user === $row['not_received']) {
			$r = $cn->query("SELECT * FROM userson WHERE uvon = '" . $row['user_from'] . "'");
			if($r->num_rows == 1 && abs(time() - strtotime($row['date_sent'])) <= 5)
				$final_result['user_from'] = $row['user_from'];
			else
				$final_result['list_message_notifi'] .= '<li class='. "list_message_notifi" . '><span style="display: none">' . $row['user_from'] . '</span>Người dùng <strong>' . $row['user_from'] . '</strong> đã nhắn tin cho bạn: "<em>' . $row['body'] . '</em>" - vào lúc ' . $row['date_sent'];
			// echo json_encode($result);
			// $cn->query("UPDATE messages SET not_received = '' WHERE file_name ='" .$row['file_name']. "'");
		}
	}
	echo json_encode($final_result);
?>