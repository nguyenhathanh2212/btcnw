<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
	if(!empty($_GET['idQc'])){
		$idQc=$_GET['idQc'];
		$queryQc="SELECT * FROM quangcao WHERE id_qc={$idQc}";
		$resultQc=$mySQLI->query($queryQc);
		$arQc=mysqli_fetch_assoc($resultQc);
		$picture=$arQc['anhquangcao'];
		unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$picture);
		$query="DELETE FROM quangcao WHERE id_qc={$idQc}";
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