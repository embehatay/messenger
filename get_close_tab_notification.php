<?php
	include('includes/general.php');
	$private_chat = $_POST['private_chat'];
	if($_POST['del_close_notif_first'] == 1) {
		$sql_update = "UPDATE close_tab_notification SET user_chat_with = '' WHERE file_name_using = '$private_chat'";
		if(!$cn->query($sql_update)) echo $cn->error;
	}
	else {
		$sql_sel = "SELECT user_chat_with FROM close_tab_notification WHERE file_name_using = '$private_chat'";
		$result_sel = $cn->query($sql_sel);
		$row = $result_sel->fetch_assoc();
		if(!empty($row['user_chat_with'])) {
			$sql_update = "UPDATE close_tab_notification SET user_chat_with = '' WHERE file_name_using = '$private_chat'";
			if(!$cn->query($sql_update)) echo $cn->error;	
			echo $row['user_chat_with'];
		}
	}
?>