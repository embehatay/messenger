<?php
	include('includes/general.php');
	if(!empty($_POST['friend']))
		$friend = $_POST['friend'];
	/**
	* Xóa tên người yêu cầu kết bạn khỏi ds request
	*/
	$temp_array = array();
	$sql_select_request_list = "SELECT request_list FROM users WHERE username = '$user'";
	$result_select = $cn->query($sql_select_request_list);
	$row_select = $result_select->fetch_assoc();
	$temp_array = json_decode($row_select['request_list']);
	if(($key = array_search($friend, $temp_array)) !== false) {
		unset($temp_array[$key]);
		if($temp_array) {
			$temp_array = array_values($temp_array);
			$new_request_list = json_encode($temp_array);
			$sql_update_request_list = "UPDATE users SET request_list = '$new_request_list' WHERE username = '$user'";
		} else {
			$sql_update_request_list = "UPDATE users SET request_list = '' WHERE username = '$user'";
		}		
	}
	if(!$cn->query($sql_update_request_list))
		echo $cn->error;

	/**
	* Xóa tên user hiện tại khỏi ds waiting của user yêu cầu
	*/
	
	$temp_array = array();
	$sql_select_waiting_list = "SELECT waiting_list FROM users WHERE username = '$friend'";
	$result_select = $cn->query($sql_select_waiting_list);
	$row_select = $result_select->fetch_assoc();
	$temp_array = json_decode($row_select['waiting_list']);
	if(($key = array_search($user, $temp_array)) !== false) {
		unset($temp_array[$key]);
		if($temp_array) {
			$temp_array = array_values($temp_array);
			$new_waiting_list = json_encode($temp_array);
			$sql_update_waiting_list = "UPDATE users SET waiting_list = '$new_waiting_list' WHERE username = '$friend'";
		} else {
			$sql_update_waiting_list = "UPDATE users SET waiting_list = '' WHERE username = '$friend'";
		}	
	}
	if(!$cn->query($sql_update_waiting_list))
		echo $cn->error;
?>