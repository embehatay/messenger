<?php
include('includes/general.php');
	if(isset($user) && !empty($user)) {
		$dt = time();                                 
		$timeon = 1800;            
		$nrvst = 0;                                     
		$nrusr = 0;                                    
		$usron = '';       
		$sqldel = "DELETE FROM `userson` WHERE `dt`<". ($dt - $timeon);
		$sqliu = "INSERT INTO `userson` (`uvon`, `dt`) VALUES ('$user', $dt) ON DUPLICATE KEY UPDATE `dt`=$dt";
		$sqlsel = "SELECT * FROM `userson`";
		$sql_friend_list = "SELECT friend_list, request_list, waiting_list FROM users WHERE username = '$user'";
		$friend_result = $cn->query($sql_friend_list);
		$friend_row = $friend_result->fetch_assoc();
		if(!$friend_row['friend_list']) {
			$friend_list = array();
		} else {
			$friend_list = json_decode($friend_row['friend_list']);
		}

		if(!$friend_row['waiting_list']) {
			$waiting_list = array();
		} else {
			$waiting_list = json_decode($friend_row['waiting_list']);
		}

		if(!$friend_row['request_list']) {
			$request_list = array();
		} else {
			$request_list = json_decode($friend_row['request_list']);
		}

		if(!$cn->query($sqldel)) echo 'Error: '. $cn->error;
		if(!$cn->query($sqliu)) echo 'Error: '. $cn->error;
		$result = $cn->query($sqlsel);

		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
		      $nrusr++;
		      if($row['uvon'] == $user) {
		      	$usron .= '<li><p id="' . $row['uvon'] . '" class="private_msg"><strong><i>'.$row['uvon']. ' (you)</i></strong></p></li>';
		      }
		      else {
		      	if(array_search($row['uvon'], $friend_list) !== false) {
			      $usron .= '<li><p id="' . $row['uvon'] . '" class="private_msg"><i>'.$row['uvon']. '</i></p><i class="fa fa-users" aria-hidden="true"></i></li>';
		      	} else if(array_search($row['uvon'], $waiting_list) !== false) {
		      		$usron .= '<li><p id="' . $row['uvon'] . '" class="private_msg"><i>'.$row['uvon']. '</i></p><span class="waiting"><i class="fa fa-clock-o" aria-hidden="true"></i>  Waiting...</span></li>';
		      	} else if(array_search($row['uvon'], $request_list) !== false) {
		      		$usron .= '<li>
		      			<p id="' . $row['uvon'] . '" class="private_msg"><i>'.$row['uvon']. '</i></p>
		      			<p style="display: none">'. $row['uvon'] .'</p>
		      			<span class="decline"><i class="fa fa-user-times" aria-hidden="true"></i>  Decline</span>
		      			<span class="accept"><i class="fa fa-check" aria-hidden="true"></i>  Accept</span>
		      		</li>';
		      	} else {
		      		$usron .= '<li><p id="' . $row['uvon'] . '" class="private_msg"><i>'.$row['uvon']. '</i></p><span class="add_friend"><i class="fa fa-user-plus" aria-hidden="true"></i>  Add</span></li>';
		      	}
		      } 
		  }
		}

		$cn->close();
		$reout = '<li><h3>Online: '. $nrusr . '</h3><ul>' . $usron . '</ul>';
		echo $reout;             
	}
?>