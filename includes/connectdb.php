<?php
	$namehost = 'localhost';
	$userhost = 'root';
	$passhost = '';
	$database = 'messenger';

	/*$namehost = 'mysql.hostinger.vn';
	$userhost = 'u895484055_taitt';
	$passhost = 'day12day34';
	$database = 'u895484055_embe';*/

	// Lệnh kết nối tới database
	$cn = mysqli_connect($namehost, $userhost, $passhost, $database);

	// Nếu kết nối database thất bạn sẽ báo lỗi
	if (!$cn)
	{
		echo 'Could not connect to database.';
	}
?>