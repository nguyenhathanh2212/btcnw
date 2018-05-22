<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';

	// delete all with ajax
	if (isset($_REQUEST['newsId'])) {
		$newsId = $_REQUEST['newsId'];
		$values = join(",", $newsId);

		$pictures = $DB->select("SELECT picture FROM recruitment WHERE id IN ($values)");
		$result2 = $DB->delete('comment', "recruitment_id IN ($values)");
		$result1 = $DB->delete('recruitment', "id IN ($values)");

		// delete picture
		foreach ($pictures as $picture) {
			unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $picture['picture']);
		}

		if ($result1 && $result2) {
			$session->set('msgSuccess', 'Xóa tin thành công');
		} else {
			$session->set('msgError', 'Xóa tin thất bại');
		}
	} else {
		header('Location:index.php');
	}