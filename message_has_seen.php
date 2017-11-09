<?php  
	include('includes/general.php');
	$file_name = $_POST['private_chat'];
	$cn->query("UPDATE messages SET da_xem = 1 WHERE file_name = '$file_name'");
?>