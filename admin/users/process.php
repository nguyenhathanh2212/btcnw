<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';
	
	// add user
	if (isset($_POST['add'])){
		$username = trim($_POST['username']);
		$password = md5(trim($_POST['password']));
		$email = trim($_POST['email']);
		$user = $DB->select("SELECT * FROM users WHERE username = '{$username}'");

		if(count($user) > 0) {
			$session->set('msgError', 'Người dùng đã tồn tại');
			header("location:/admin/users/add.php");
			exit();
		}

		$result = $DB->create('users', [
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'active' => 0,
		]);

		if ($result) {
			$session->set('msgSuccess', 'Thêm người dùng thành công');
		} else {
			$session->set('msgError', 'Thêm người dùng thất bại');
		}

		header("location:/admin/users");
		exit();
	}

	header("location:/admin/users");
	