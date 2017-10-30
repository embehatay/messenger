<?php
	include('includes/general.php');
	$file_name_using = $_POST['file_name_using'];
	$sql_update = "INSERT INTO request_close_chat VALUES ('$file_name_using', '$user') ON DUPLICATE KEY UPDATE user_chat_with = '$user'";
	if(!$cn->query($sql_update)) echo $cn->error;
?>