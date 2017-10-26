<?php
	// comment
	include('includes/general.php');
	$sql_select_friend_list = "SELECT friend_list FROM users WHERE username = '$user'";
	$result_select_friend_list = $cn->query($sql_select_friend_list);
	if($friend_list_string = ($result_select_friend_list->fetch_assoc())) {
		$friends = array();
		$friends = json_decode($friend_list_string['friend_list']);
		if($friends) {
			foreach($friends as $friend) {
				echo '<li><p id="show_' . $friend . '" class="show_friends"><i>'.$friend. '</i></p></li>';
			}			
		}
	}
?>