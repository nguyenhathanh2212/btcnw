<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php"; ?>
<?php
	if (!empty($_GET['idQc'])) {
		$idQc = $_GET['idQc'];
		$queryQc = "SELECT * FROM advertisement WHERE id = {$idQc}";
		$resultQc = $DB->select($queryQc)[0];
		$picture = $resultQc['picture'];
		unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $picture);
		if($DB->delete('advertisement', "id = {$idQc}")){
			 $session->set('msgSuccess', 'Xóa thành công!');
        } else {
            $session->set('msgError', 'Xóa thất bại!');
        }
	}

    header("location: /admin/advertisement/");
    exit();
?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>