<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
	if(!empty($_GET['idTin'])){
		$idTin=$_GET['idTin'];
		$queryTin="SELECT * FROM tinraovat WHERE id_tinraovat={$idTin}";
		$resultTin=$mySQLI->query($queryTin);
		$arTin=mysqli_fetch_assoc($resultTin);
		$picture=$arTin['picture'];
		unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$picture);
		$query="DELETE FROM tinraovat WHERE id_tinraovat={$idTin}";
		if($result=$mySQLI->query($query)){
			header('location:index.php?msg=Xóa thành công');
		}else{
			echo "Có lỗi ";
			die();
		}
	}else{
		header("location:index.php");
	}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>