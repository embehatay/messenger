<?php
	include('includes/general.php');
	$private_chat = $_POST['private_chat'];
	$chatter = $_POST['chatter'];
	if($_POST['del_close_notif_first'] == 1) {
		$sql_update = "UPDATE request_close_chat SET user_chat_with = '' WHERE file_name = '$private_chat'";
		if(!$cn->query($sql_update)) echo $cn->error;
	}
	else {
		$sql_sel = "SELECT user_chat_with FROM request_close_chat WHERE file_name = '$private_chat'";
		$result_sel = $cn->query($sql_sel);
		$row = $result_sel->fetch_assoc();
		if(!empty($row['user_chat_with']) && $row['user_chat_with'] != $user) {
			$sql_update = "UPDATE request_close_chat SET user_chat_with = '' WHERE file_name = '$private_chat'";
			if(!$cn->query($sql_update)) echo $cn->error;	
			echo $chatter;
		}
	}
?>