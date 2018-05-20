<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';

	// edit category
	if (isset($_POST['edit'])) {
		$name = $_POST['tendanhmuc'];
		$cateId = $_POST['idCate'];

		$category = $DB->update('category', [
			'name' => $name
		], "id={$cateId}");

		if ($category) {
			$session->set('msgSuccess', 'Cập nhật thành công');
		} else{
			$session->set('msgError', 'Cập nhật thành công');
		}

		header("location:index.php");
		exit();
	}

	header("location:index.php");
