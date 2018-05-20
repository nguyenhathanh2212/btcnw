<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	<!--content-->
	<div class="content">
			
			<h2 class="tit"><i class="icon-cat fa fa-money"></i>  Sửa Danh mục</h2>
			<br/>
			<?php
				if(!empty($_GET['idCate'])){
					$idCate=$_GET['idCate'];
				}else{
					header("location:index.php");
				}
				$queryCate= "SELECT * FROM danhmucsanpham WHERE id_danhmuc='{$idCate}'";
				$resultCate=$mySQLI->query($queryCate);
				$arCate=mysqli_fetch_assoc($resultCate);
				$nameCate = $arCate['tendanhmuc'];
			?>
			<?php
				if(isset($_POST['edit'])){
					$newNameCate=$_POST['tendanhmuc'];
					$query="UPDATE danhmucsanpham SET tendanhmuc='{$newNameCate}' WHERE id_danhmuc={$idCate}";

					if($mySQLI->query($query)){
						header("location:index.php?msg=Sửa thành công");
					} else{
						header("location:index.php?msg=Sửa thất bại");
					}
				}
			?>
			<form method="post" action="" class="form-editCate" enctype="multipart/form-data">
				<label class="left-login">Tên danh mục : (*)</label>
				<div class="right-login">
					<input class="input-right" type="text" name="tendanhmuc" value="<?php echo $nameCate?>">
					<br/ ><label for="tendanhmuc" class="error"></label>
				</div>
				<div class="clr"></div>
				<br/>
				<input type="submit" class="button" name="edit" value="Edit">
			</form>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>