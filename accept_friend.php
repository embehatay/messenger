<?php
	// Test git hub phát
	include('includes/general.php');
	if(!empty($_POST['friend']))
		$friend = $_POST['friend'];
	/**
	* Thêm tên người mà user hiện tại muốn kết bạn vào cột friend list và xóa tên user khỏi cột request list
	*/
	$temp_array = array();
	$temp_array_2 = array();
	array_push($temp_array, $friend);
	$sql_select_friend_list = "SELECT friend_list FROM users WHERE username = '$user'";
	$result_select = $cn->query($sql_select_friend_list);
	$row_select = $result_select->fetch_assoc();
	if(!$row_select['friend_list']) {
		$temp_array = json_encode($temp_array);
		$sql_update = "UPDATE users SET friend_list = '$temp_array' WHERE username = '$user'";
	} else {
		$temp_array_2 = json_decode($row_select['friend_list']);
		array_push($temp_array_2, $friend);
		$new_friend_list = json_encode($temp_array_2);
		$sql_update = "UPDATE users SET friend_list = '$new_friend_list' WHERE username = '$user'";
	}	
	if(!$cn->query($sql_update))
		echo $cn->error;
	else {
		$sql_select_request_list = "SELECT request_list FROM users WHERE username = '$user'";
		$result_request = $cn->query($sql_select_request_list);
		$row_request = $result_request->fetch_assoc();
		$row_request2 = json_decode($row_request['request_list']);
		if(($key = array_search($friend, $row_request2)) !== false) {
			unset($row_request2[$key]);
			if($row_request2) {
				$row_request2 = array_values($row_request2);
				$row_request2 = json_encode($row_request2);
				$sql_update_request = "UPDATE users SET request_list = '$row_request2'";				
			} else {
				$sql_update_request = "UPDATE users SET request_list = ''";
			}
		}		
		if(!$cn->query($sql_update_request))
			echo "";
	}

	/**
	* Thêm tên user hiện tại vào cột friend list của friend và xóa tên user khỏi cột waiting list
	*/
	$temp_array = array();
	$temp_array_2 = array();
	array_push($temp_array, $user);
	$sql_select_friend_list = "SELECT friend_list FROM users WHERE username = '$friend'";
	$result_select = $cn->query($sql_select_friend_list);
	$row_select = $result_select->fetch_assoc();
	if(!$row_select['friend_list']) {
		$temp_array = json_encode($temp_array);
		$sql_update = "UPDATE users SET friend_list = '$temp_array' WHERE username = '$friend'";
	} else {
		$temp_array_2 = json_decode($row_select['friend_list']);
		array_push($temp_array_2, $friend);
		$new_friend_list = json_encode($temp_array_2);
		$sql_update = "UPDATE users SET friend_list = '$new_friend_list' WHERE username = '$friend'";
	}
	if(!$cn->query($sql_update))
		echo $cn->error;
	else {
		$sql_select_waiting_list = "SELECT waiting_list FROM users WHERE username = '$friend'";
		$result_waiting = $cn->query($sql_select_waiting_list);
		$row_waiting = $result_waiting->fetch_assoc();
		$row_waiting2 = json_decode($row_waiting['waiting_list']);
		if(($key = array_search($user, $row_waiting2)) !== false) {
			unset($row_waiting2[$key]);
			if($row_waiting2) {
				$row_waiting2 = array_values($row_waiting2);
				$row_waiting2 = json_encode($row_waiting2);
				$sql_update_waiting = "UPDATE users SET waiting_list = '$row_waiting2'";				
			} else {
				$sql_update_waiting = "UPDATE users SET waiting_list = ''";
			}
		}		
		if(!$cn->query($sql_update_waiting))
			echo "";
	}
?>