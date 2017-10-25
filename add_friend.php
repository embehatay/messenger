<?php
	include('includes/general.php');
	if(!empty($_POST['friend']))
		$friend = $_POST['friend'];
	/**
	* Thêm tên người mà user hiện tại muốn kết bạn vào cột waiting list
	*/
	$temp_array = array();
	$temp_array_2 = array();
	array_push($temp_array, $friend);
	$sql_select_waiting_list = "SELECT waiting_list FROM users WHERE username = '$user'";
	$result_select = $cn->query($sql_select_waiting_list);
	$row_select = $result_select->fetch_assoc();
	if(!$row_select['waiting_list']) {
		$temp_array = json_encode($temp_array);
		$sql_insert = "UPDATE users SET waiting_list = '$temp_array' WHERE username = '$user'";
	} else {
		$temp_array_2 = json_decode($row_select['waiting_list']);
		array_push($temp_array_2, $friend);
		$new_friend_list = json_encode($temp_array_2);
		$sql_insert = "UPDATE users SET waiting_list = '$new_friend_list' WHERE username = '$user'";
	}
	
	if(!$cn->query($sql_insert))
		echo $cn->error;

	/**
	* Thêm tên user hiện tại vào cột request list của người mà user hiện tại muốn kết bạn
	*/
	$request_array = array();
	$request_array2 = array();
	array_push($request_array, $user);
	$sql_select_request_list = "SELECT request_list FROM users WHERE username = '$friend'";
	$result_request = $cn->query($sql_select_request_list);
	$row_request = $result_request->fetch_assoc();
	if(!$row_request['request_list']) {
		$request_array = json_encode($request_array);
		$sql_insert_request = "UPDATE users SET request_list = '$request_array' WHERE username = '$friend'";
	} else {
		$request_array2 = json_decode($row_request['request_list']);
		array_push($request_array2, $user);
		$new_request_list = json_encode($request_array2);
		$sql_insert_request = "UPDATE users SET request_list = '$new_request_list' WHERE username = '$friend'";
	}
	
	if(!$cn->query($sql_insert_request))
		echo $cn->error;
?>