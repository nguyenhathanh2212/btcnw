<?php
	if(!isset($_SESSION['UserAuthenticate'])&&($_SESSION['UserAuthenticate']['active']==1||$_SESSION['UserAuthenticate']['username']=='admin')){
		header("location:/login.php");
	}
?>