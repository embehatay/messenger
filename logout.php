<?php
	include('includes/general.php');
	// print_r($_POST['notificated_to']);
	if(isset($_POST['notificated_to'])) {
		$notificated_to = json_encode($_POST['notificated_to']);
		$sql_insert_notif = "INSERT INTO logout_notification (sendner, notificated_to, logout_moment) VALUES ('{$user}', '{$notificated_to}', '$date_current')";
	}
	$sqldel_onl_user = "DELETE FROM userson WHERE uvon = " . "'$user'";
	// Bắt đầu session
	// session_start();
	// Xoá session
	session_destroy();
	if(!$cn->query($sqldel_onl_user)) echo 'Error: '. $cn->error;
	if(!empty($notificated_to))
		if(!$cn->query($sql_insert_notif)) echo 'Error: '. $cn->error;
	// echo $sqldel_onl_user;
	// Di chuyển đến trang index.php
	header('Location: index.php');
	// echo "hihi";
	// echo $notificated_to;
?>