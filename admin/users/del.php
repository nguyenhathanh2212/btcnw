<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';
    require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php";
	
	if (isset($_GET['idUser'])) {
		$idUser= $_GET['idUser'];
		$user = $DB->select("SELECT * FROM users WHERE id={$idUser}")[0];
		
		if ($user['active'] == 0) {
			if (!empty($user['avatar'])) {
				unlink($_SERVER['DOCUMENT_ROOT'].'/files/' . $user['avatar']);
			}

			if (!empty($user['background'])) {
				unlink($_SERVER['DOCUMENT_ROOT'].'/files/' . $user['background']);
			}

			$result = $DB->delete('users', "id = {$idUser}");

			if ($result) {
				$session->set('msgSuccess', 'Xóa người dùng thành công');
			} else {
				$session->set('msgError', 'Xóa người dùng thất bại');
			}
		} else {
			$session->set('msgError', 'Không thể xóa người này');
		}

		header("location:index.php");
		exit();
	}
		
	header("location:index.php");
