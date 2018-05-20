<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
	if(!empty($_GET['idCmt'])){
		$idCmt = $_GET['idCmt'];
		$queryCmt = "SELECT * FROM comment WHERE id_cmt={$idCmt}";
		$resultCmt = $mySQLI->query($queryCmt);
		$arCmt = mysqli_fetch_assoc($resultCmt);
		$idTin = $arCmt['id_tinraovat'];
		$query = "DELETE FROM comment WHERE id_cmt={$idCmt}";
		if($result=$mySQLI->query($query)){
			header('location:index.php?msg=Xóa thành công&idTin=' . $idTin);
		}else{
			echo "Có lỗi : ";
			die();
		}
	}else{
		header('location:index.php');
	}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>