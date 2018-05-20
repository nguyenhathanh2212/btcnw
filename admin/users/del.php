<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
	if(!empty($_GET['idUser'])){
		$idUser=$_GET['idUser'];
		$queryUser="SELECT * FROM users WHERE id_user={$idUser}";
		$resultUser=$mySQLI->query($queryUser);
		$arUser=mysqli_fetch_assoc($resultUser);
		$username=$arUser['username'];
		if($username!='admin'){
			$avatar=$arUser['avatar'];
			$background=$arUser['background'];
			unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$avatar);
			unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$background);
			$query="DELETE FROM users WHERE id_user={$idUser}";
			if($result=$mySQLI->query($query)){
				header('location:index.php?msg=Xóa thành công');
			}else{
				echo "Có lổi : ";
				die();
			}
		}else{
			header('location:index.php?msg=bạn không thể xóa admin');
		}
	}else{
		header("location:index.php");
	}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>