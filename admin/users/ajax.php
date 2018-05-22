<?php require_once $_SERVER['DOCUMENT_ROOT'].'/functions/dbconnect.php';  ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
	$active=$_POST['act'];
	$id=$_POST['aid'];
	$query="UPDATE users SET active={$active} WHERE id_user='{$id}'";
	$mySQLI->query($query);
	$mySQLI->close();
	echo $id;
?>