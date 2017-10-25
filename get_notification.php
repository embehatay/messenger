<?php
	include("includes/general.php");
	$q1 = "SELECT * FROM logout_notification WHERE sendner <> '$user' ORDER BY logout_moment DESC LIMIT 1";
	$r1 = $cn->query($q1);
	if($r1->num_rows == 1) {
		$row = $r1->fetch_assoc();
		if($row['notificated_to'] != NULL) {
			echo "Người dùng <strong><i>" . $row['sendner'] . " </i></strong>đã đăng xuất!";
			$notificated_to = json_decode($row['notificated_to']);
			if(($key = array_search($user, $notificated_to)) !== false)
				unset($notificated_to[$key]);
			if($notificated_to) {
				$json_notification_to = json_encode($notificated_to);
				$q2 = "UPDATE logout_notification SET notificated_to = '$json_notification_to' WHERE logout_moment = " . "'" . $row['logout_moment'] . "'";
			} else {
				$q2 = "UPDATE logout_notification SET notificated_to = '' WHERE logout_moment = " . "'" .$row['logout_moment'] . "'";
			}
			if(!$cn->query($q2)) echo 'Error: ' . $cn->error;			
		}
	}
?>