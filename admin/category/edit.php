<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	<!--content-->
	<div class="content">
		<h2 class="tit"><i class="icon-cat fa fa-list-ul"></i>  Sửa Danh mục</h2>
		<br/>
		<?php
			if (!empty($_GET['idCate']))  {
				$idCate=$_GET['idCate'];
			} else {
				header("location:index.php");
			}
			
			$category = $DB->select("SELECT * FROM category WHERE id='{$idCate}'")[0];
		?>
		<form method="post" action="process.php" class="form-editCate" enctype="multipart/form-data">
			<input type="hidden" name="idCate" value="<?php echo $category['id'] ?>">
			<label class="left-login">Tên danh mục : (*)</label>
			<div class="right-login">
				<input class="input-right" type="text" name="tendanhmuc" value="<?php echo $category['name'] ?>">
				<br/ ><label for="tendanhmuc" class="error"></label>
			</div>
			<div class="clr"></div>
			<br/>
			<input type="submit" class="button" name="edit" value="Edit">
		</form>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>