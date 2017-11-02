<?php
	include('includes/general.php');
	$sql_sel = "SELECT request_list FROM users WHERE username = '$user'";
	$result = $cn->query($sql_sel);
	if($result->num_rows > 0) {
		$rows = $result->fetch_assoc();
		if($rows['request_list']) {
			$rows = json_decode($rows['request_list']);
			if($rows)
				foreach($rows as $row) {
					echo $row;
				}
		}	
	}
?>