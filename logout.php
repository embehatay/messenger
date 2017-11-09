<?php
	include('includes/general.php');
	if(isset($_POST['notificated_to'])) {
		// mảng lưu lại tên những thằng đang chát cùng
		$notificated_to = json_encode($_POST['notificated_to']);
		$sql_insert_notif = "INSERT INTO logout_notification (sendner, receivers, logout_moment) VALUES ('$user', '$notificated_to', '$date_current') ON DUPLICATE KEY UPDATE receivers = '$notificated_to', logout_moment = '$date_current'";			
		if(!$cn->query($sql_insert_notif)) echo 'Error: '. $cn->error;
	}
	$sqldel_onl_user = "DELETE FROM userson WHERE uvon = " . "'$user'";
	session_destroy();
	if(!$cn->query($sqldel_onl_user)) echo 'Error: '. $cn->error;
	header('Location: index.php');
?>