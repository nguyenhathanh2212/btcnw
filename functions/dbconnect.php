<?php
	$localhost='localhost';
	$username="root";
	$password="";
	$database='websitettcn';
	$mySQLI=new mysqli($localhost,$username,$password,$database);
	$mySQLI->set_charset('utf8');
	if(mysqli_connect_errno()){
		echo "Có lỗi xãy ra khi kết nối : " .mysqli_connect_error();
		die();
	}

?>