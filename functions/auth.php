<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';

    // login
	if (isset($_POST['login'])) {
		$username = trim($_POST['username']);
			$password = md5(trim($_POST['password']));
			$query = "SELECT * FROM users 
				WHERE username = '{$username}' 
				AND password = '{$password}' LIMIT 1";

	    $user = $DB->select($query);

	    if (count($user) > 0) {
	    	$session->set('UserAuthenticate', $user[0]);
	    	$session->set('msgSuccess', 'Đăng nhập thành công!');

	       	if ($session->get('UserAuthenticate')['active'] == 1) {
	       		header("location:/admin/");
	       	} else {
	       		header("location:/");
	       	}
	       	exit();
	    }

       	$session->set('errorLogin', 'Sai tài khoản hoặc mật khẩu');
       	header("location:/login");
       	exit();
	}

	// logout
	if (isset($_POST['logout'])) {
		if ($session->has('UserAuthenticate')) {
			$session->remove('UserAuthenticate');
			header('Location:/login');
			exit();
		}
	}
	
	// register
	if (isset($_POST['register'])){
		$username = trim($_POST['username']);
		$password = md5(trim($_POST['password']));
		$email = trim($_POST['email']);
		$avatar = $_FILES['avatar']['name'];
		$user = $DB->select("SELECT * FROM users WHERE username = '{$username}'");

		if(count($user) > 0) {
			$session->set('errorRegisterUser', 'Username đã được sử dụng');
			header("location:/login");
			exit();
		}

		$result = $DB->create('users', [
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'avatar' => $avatar,
			'active' => 0,
		]);

		if ($result) {
			$user = $DB->select("SELECT * FROM users WHERE username = '{$username}'")[0];
			$session->set('UserAuthenticate', $user);
			$session->set('msgSuccess', 'Đăng ký thành công!');
			header("location:/");
			exit();
		}

		$session->set('errorRegister', 'Đăng ký thất bại! Hãy thử lại');
		header("location:/login");
		exit();
	}

	// edit profile
	if(isset($_POST['edit'])) {
		if ($session->has('UserAuthenticate')) {
			$user = $session->get('UserAuthenticate');
		} else {
			header('location:/404');
			exit();
		}

		$password = trim($_POST['editpassword']);
		$info = trim($_POST['info']);
		$cfPassword = trim($_POST['password']);
		$avatar = $_FILES['avatar']['name'];

		if ($avatar == "") {
			$nameavatar = '';
		} else {
			$arPic = explode(".", $avatar);
			$endPic = end($arPic);
			$nameavatar = 'TDVL-' . time() . '.' . $endPic;
			$path_upload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $nameavatar;
			$tmp_name = $_FILES['avatar']['tmp_name'];
			move_uploaded_file($tmp_name,$path_upload);
		}

		if (md5($cfPassword) != $user['password']) {
			$session->set('editPasswordConfirm', 'Mật khẩu cũ không đúng!');
			header("location:/edit-user/edit-" . $user['id']);
			exit();
		} else {
			$data = [];
			$where = "id = " . $user['id'];

			if ($password == "") {
				$data = [
					'info' => $info,
					'avatar' => $nameavatar,
				];
			} else {
				$data = [
					'password' => md5($password),
					'info' => $info,
					'avatar' => $nameavatar,
				];
			}

			if ($DB->update('users', $data, $where)) {
				$session->set('msgSuccess', 'Cập nhật thông tin thành công!');
			} else {
				$session->set('msgError', 'Cập nhật thông tin thất bại!');
			}
		}

		header("location:/timeline/edited-" . $user['id']);
		exit();
	}

	header("location:/404.php");
