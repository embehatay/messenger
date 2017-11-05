<?php
	include('includes/general.php');
	$sql_sel = "SELECT request_list FROM users WHERE username = '$user'";
	$request_friend = '';
	$result = $cn->query($sql_sel);
	if($result->num_rows > 0) {
		$rows = $result->fetch_assoc();
		if($rows['request_list']) {
			$rows = json_decode($rows['request_list']);
			if($rows)
				foreach($rows as $row) {
					$request_friend .= '<li class="users_request"><p>Người dùng <strong><i>' . $row . '</i></strong> đã yêu cầu kết bạn</p><p style="display: none">' . $row . '</p><span class="decline"><i class="fa fa-user-times" aria-hidden="true"></i>  Decline</span><span class="accept"><i class="fa fa-check" aria-hidden="true"></i>  Accept</span></li>';
				}
		}	
	}
	echo $request_friend;
?>