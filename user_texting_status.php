<?php  
	include('includes/general.php');
	$private_chat = $_POST['private_chat'];
	$user_name = explode('_', $private_chat);
	$text = $_POST['text'];
	if($user == $user_name[0]) {		
		if($text == "texting")
			$cn->query("UPDATE messages SET user1_texting_status = 1 WHERE file_name = '$private_chat'");
		else
			$cn->query("UPDATE messages SET user1_texting_status = 0 WHERE file_name = '$private_chat'");
	} else if($user == $user_name[1]) {
		if($text == "texting")
			$cn->query("UPDATE messages SET user2_texting_status = 1 WHERE file_name = '$private_chat'");
		else
			$cn->query("UPDATE messages SET user2_texting_status = 0 WHERE file_name = '$private_chat'");
	}
?>