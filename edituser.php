<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/header.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php";
?>
	<!--content-->
	<div class="content ">
		<?php
			if(!empty($_GET['idUser']) && $session->get('UserAuthenticate')['id_user'] == $_GET['idUser']) {
				$idUser = $_GET['idUser'];
			} else {
				header("location:/404.php");
				exit();
			}

			$user = $DB->select("SELECT * FROM users WHERE id_user='{$idUser}'")[0];
		?>
		<div class="header-title-postnews">
			<h2 class="tit"><i class="fa fa-shopping-cart"></i>Sửa thông tin</h2>
		</div>
		<form method="post" action="/functions/auth.php" class="form-adduser postnews-content"  enctype="multipart/form-data">
			<label class="left-login">Username : (*)</label>
			<div class="right-login">
				<input class="input-right" type="text" name="username" value="<?php echo $user['username'] ?>" readonly="readonly">
				<br/ ><label for="username" class="error"></label>
			</div>
			<div class="clr"></div>
			<label class="left-login">New Password: </label>
			<div class="right-login">
				<input class="input-right" type="password" name="editpassword" value="">
				<br/ ><label for="editpassword" ></label>
			</div>
			<div class="clr"></div>
			<label class="left-login">Information:</label>
			<div class="right-login">
				<textarea  name = 'info' cols="40" rows="5"><?php echo $user['info'] ?></textarea>
				<br/ ><label for="email" class="error"></label>
			</div>
			<div class="clr"></div>
			<label class="left-login">Avatar: </label>
			<div class="right-login">
				<input class="input-right" type="file" name="avatar">
			</div>
			<div class="clr"></div>
			<label class="left-login">Password: (*)</label>
			<div class="right-login">
				<input class="input-right" type="password" name="password">
				<br/ >
				<label for="editpassword" class="error">
					<?php 
						if ($session->has('editPasswordConfirm')) {
							echo $session->get('editPasswordConfirm');
							$session->remove('editPasswordConfirm');
						} 
					?>
				</label>
			</div>
			<div class="clr"></div>
			<input type="submit" class="button " name="edit" value="Edit">
		</form>
	</div>
	<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php" ?>