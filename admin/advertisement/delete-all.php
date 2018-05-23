<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';
	echo 1;
	// delete all with ajax
	if (isset($_POST['advertisementsId'])) {
		$advertisementsId = $_POST['advertisementsId'];
		$values = join(",", $advertisementsId);

		$pictures = $DB->select("SELECT picture FROM advertisement WHERE id IN ($values)");
		$result = $DB->delete('advertisement', "id IN ($values)");

		// delete picture
		foreach ($pictures as $picture) {
			if (!empty($picture['picture'])) {
				unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $picture['picture']);
			}
		}

		if ($result) {
			$session->set('msgSuccess', 'Xóa quảng cáo thành công');
		} else {
			$session->set('msgError', 'Xóa quảng cáo thất bại');
		}
	} else {
		header('Location:index.php');
	}
