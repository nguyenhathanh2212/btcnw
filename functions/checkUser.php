<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/session.php';

	if(!$session->has('UserAuthenticate')){
		header("location:/login.php");
	}
?>