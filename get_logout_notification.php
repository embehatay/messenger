<?php
	include("includes/general.php");
	$q1 = "SELECT * FROM logout_notification WHERE sendner <> '$user' ORDER BY logout_moment DESC LIMIT 1";
	$r1 = $cn->query($q1);
	if($r1->num_rows == 1) {
		$row = $r1->fetch_assoc();
		if($row['receivers']) {
			echo $row['sendner'];
			$receivers = json_decode($row['receivers']);
			if(($key = array_search($user, $receivers)) !== false)
				unset($receivers[$key]);
			if($receivers) {
				$receivers = array_values($receivers);
				$json_notification_to = json_encode($receivers);
				$q2 = "UPDATE logout_notification SET receivers = '$json_notification_to' WHERE logout_moment = " . "'" . $row['logout_moment'] . "'";
			} else {
				$q2 = "UPDATE logout_notification SET receivers = '' WHERE logout_moment = " . "'" .$row['logout_moment'] . "'";
			}
			if(!$cn->query($q2)) echo 'Error: ' . $cn->error;			
		}
	}
?>