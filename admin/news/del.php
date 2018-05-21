<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php";?>
<?php
	if (!empty($_GET['idTin'])) {
		$idTin = $_GET['idTin'];
		$select = "SELECT * FROM recruitment WHERE id = {$idTin}";
		$result = $DB->select($select)[0];
		$picture = $result['picture'];
		unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$picture);

		if($DB->delete('recruitment', "id = {$idTin}")){
			 $session->set('msgSuccess', 'Xóa thành công!');
        } else {
            $session->set('msgError', 'Xóa thất bại!');
        }

        header("location: /admin/news/");
        exit();
	}else{
		header("location: /admin/news/index.php");
	}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>
