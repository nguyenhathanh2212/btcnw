<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/header.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php";
?>
<?php if ($session->has('msgSuccess')) { ?>
	<div class="alert-message success">
		<?php echo $session->get('msgSuccess'); ?>
		<?php $session->remove('msgSuccess'); ?>
	</div>
<?php } ?>
<?php if ($session->has('msgError')) { ?>
	<div class="alert-message error">
		<?php echo $session->get('msgError'); ?>
		<?php $session->remove('msgError'); ?>
	</div>
<?php } ?>
<!--content-->
	<div class="content ">
		<div class="header-title-postnews">
				<h2 class="tit"><i class="fa fa-shopping-cart"></i>Thêm tin</h2>
			</div>
			<form method="post" action="/functions/postnews.php" class="form-addtin postnews-content" enctype="multipart/form-data">
					<label class="left-login">Name : (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="title" required>
						<br/ ><label for="title" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Category: (*)</label>
					<div class="right-login">
						<select name="category_id" id="danhmuc" class="input-right" required>
							<option value="" >--Chọn danh mục--</option>
							<?php
								$queryDM="SELECT * FROM category";

								$resuitDM = $DB->select($queryDM);
								foreach ($resuitDM as  $value) { ?>
								<option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
								<?php }?>
							?>
						</select>
						<br/ ><label for="danhmuc" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Salary: (*)</label>
					<div class="right-login">
						<input class="input-right" type="number" name="salary" required>
						<br/ ><label for="salary" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Location: (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="location" required>
						<br/ ><label for="location" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Phone: (*)</label>
					<div class="right-login">
						<input class="input-right" type="number" name="phone" required>
						<br/ ><label for="phone" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Picture: </label>
					<div class="right-login">
						<input class="input-right" type="file" name="picture">
					</div>
					<div class="clr"></div>
					<label class="left-login">Description: (*)</label>
					<div class="right-login">
						<textarea class="mota ckeditor" name="description" required></textarea>
						<br/ ><label for="description" class="error"></label>
					</div>
					<div class="clr"></div>
					<input type="submit" class="button" name="add" value="Add">
			</form>
	</div>
	<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php" ?>