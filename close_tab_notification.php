<?php
	include('includes/general.php');
	// Lấy các biến truyền sang
	$file_name_using = $_POST['file_name_using'];
	$user_session = $_POST['user_session'];
	$sql_insert_update = "INSERT INTO close_tab_notification (file_name_using, user_chat_with, date_created) VALUES ('$file_name_using', '$user', '$date_current') ON DUPLICATE KEY UPDATE user_chat_with = '$user', date_created = '$date_current'";
	if(!$cn->query($sql_insert_update)) echo $cn->error;
?>