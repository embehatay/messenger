<?php
	include('includes/general.php');
	$sql_select_not_received = "SELECT * FROM messages";
	$result_not_received = $cn->query($sql_select_not_received);
	while($row = $result_not_received->fetch_assoc()) {
		if($user === $row['not_received']) {
			$result = array(
				'file_name' => $row['file_name'],
				'body' => $row['body'],
				'user_from' => $row['user_from'],
				'date_sent' => $row['date_sent'],
				'not_received' => $row['not_received']
			);
			echo json_encode($result);
			// $cn->query("UPDATE messages SET not_received = '' WHERE file_name ='" .$row['file_name']. "'");
		}
	}
	echo '';
?>