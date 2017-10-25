<?php
/*
include('includes/general.php');
	// Nhập giá trị number bằng phương thức post
// $number = isset($_POST['number']) ? (int)$_POST['number'] : false;
 $number = $_POST['number'];
// Kiểm tra number có lớn hơn không hay không
/*if (!$number){
    die ('<h1>Vui lòng nhập một số lớn hơn không (0)</h1>');
}
 
// Lặp từ 1 tới number để in ra màn hình
for ($i = 1; $i <= $number; $i++){
    echo '<li>Số: '.$i.'</li>';
}
$q = "INSERT INTO messages (body, user_from, date_sent) VALUES ('{$number}', '{$user}', '{$date_current}')";
mysqli_query($cn, $q);
echo $number . ' ' . $date_current . $user;*/
	$user = 'tai';
	if(file_exists("log.html") && filesize("log.html") > 0) {
		$handle = fopen("log.html", "r");
		$messages = fread($handle, filesize("log.html"));
		// echo $messages;
	}
	//Thêm class để hiển thị tin nhắn theo user hiện tại hoặc user khác
	echo '<script>
			console.log("hihi");
			var array = [];
			array.push("tai_message");
			console.log(array[0]);
			if(array[0] != "' . "$user" . "_message". '")
				alert("hihi");
			else
				alert("nhu bui");
	</script>';
?>