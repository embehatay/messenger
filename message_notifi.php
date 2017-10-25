<?php
	include('includes/general.php');
	$sql_select_not_received = "SELECT not_received, file_name FROM messages";
	$result_not_received = $cn->query($sql_select_not_received);
	while($row = $result_not_received->fetch_assoc()) {
		if($user === $row['not_received']) {
			$cn->query("UPDATE messages SET not_received = '' WHERE file_name ='" .$row['file_name']. "'");
			echo "hihi";
		}
	}
?>