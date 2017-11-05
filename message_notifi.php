<?php
	include('includes/general.php');
	$notificated_to = $_POST['notificated_to'];
	// $restrict = join("','", $notificated_to);
	if($notificated_to == 1)
		$sql_select_not_received = "SELECT * FROM messages";
	else if(count($notificated_to) == 1)
		$sql_select_not_received = "SELECT * FROM messages WHERE user_from <> '$notificated_to[0]'";
	else if(count($notificated_to) > 1){
		$restrict = join("','", $notificated_to);
		$sql_select_not_received = "SELECT * FROM messages WHERE user_from NOT IN ('$restrict')";
	}
	// $sql_select_not_received = "SELECT * FROM messages WHERE not_received NOT IN ('$restrict')";
	$result_not_received = $cn->query($sql_select_not_received);
	$list_message_notifi = '';
	while($row = $result_not_received->fetch_assoc()) {
		if($user === $row['not_received']) {
			$result = array(
				'file_name' => $row['file_name'],
				'body' => $row['body'],
				'user_from' => $row['user_from'],
				'date_sent' => $row['date_sent'],
				'not_received' => $row['not_received']
			);
			$list_message_notifi .= '<li class='. "list_message_notifi" . '><span style="display: none">' . $row['user_from'] . '</span>Người dùng <strong>' . $row['user_from'] . '</strong> đã nhắn tin cho bạn: "<em>' . $row['body'] . '</em>" - vào lúc ' . $row['date_sent'];
			// echo json_encode($result);
			// $cn->query("UPDATE messages SET not_received = '' WHERE file_name ='" .$row['file_name']. "'");
		}
	}
	echo $list_message_notifi;
?>