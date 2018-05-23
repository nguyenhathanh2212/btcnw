<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';

	// delete all with ajax
	if (isset($_REQUEST['usersId'])) {
		$usersId = $_REQUEST['usersId'];
		$values = join(",", $usersId);

		$pictures = $DB->select("SELECT avatar, background FROM users WHERE id IN ($values)");
		$result = $DB->delete('users', "id IN ($values)");

		// delete picture
		foreach ($pictures as $picture) {
			if (!empty($picture['avatar'])) {
				unlink($_SERVER['DOCUMENT_ROOT'].'/files/' . $picture['avatar']);
			}

			if (!empty($picture['background'])) {
				unlink($_SERVER['DOCUMENT_ROOT'].'/files/' . $picture['background']);
			}
		}

		if ($result) {
			$session->set('msgSuccess', 'Xóa người dùng thành công');
		} else {
			$session->set('msgError', 'Xóa người dùng thất bại');
		}
	} else {
		header('Location:index.php');
	}
