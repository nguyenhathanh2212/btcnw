<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/header.php" ?>
<?php 
	if ($session->has('UserAuthenticate')) {
		header("location:/");
		exit();
	}
?>
	<!--content-->
	<div class="content-login row">
		<div class="left-content col-sm-6">
			<div class="head-login">
				<div class="icon"><i class="fa fa-user-o "></i></div><h2 class="title-login">Đăng nhập</h2>
				<div class="clr"></div>
			</div>
			<form class="form-login" action="/functions/auth.php" method="POST">
				<label class="left-login">Username: (*) </label>
				<div class="right-login">
					<input class="input-right" type="text" name="username">
					<br/ > 
					<label for="username" class="error">
						<?php 
							if ($session->has('errorLogin')) {
								echo $session->get('errorLogin');
								$session->remove('errorLogin');
							} 
						?>
					</label>
				</div>
				<div class="clr"></div>
				<label class="left-login">Password: (*) </label>
				<div class="right-login">
					<input class="input-right" type="password" name="password">
					<br/ ><label for="password" class="error"></label>
				</div>
				<div class="clr"></div>
				<input type="submit" class="button" name="login" value="Login">
			</form>
		</div>
		<div class="right-content col-sm-6">
			<div class="head-login">
				<div class="icon"><i class="fa fa-user-plus"></i></div><h2 class="title-login ">Đăng kí </h2>
				<div class="clr"></div>
			</div>
			<form class="form-create" method="post" enctype="multipart/form-data" action="/functions/auth.php">
				<label class="left-login">Username: (*) </label>
				<div class="right-login">
					<input class="input-right" type="text" name="username">
					<br/ >
					<label for="username" class="error">
						<?php 
							if ($session->has('errorRegisterUser')) {
								echo $session->get('errorRegisterUser');
								$session->remove('errorRegisterUser');
							} 
						?>
					</label>
				</div>
				<div class="clr"></div>
				<label class="left-login">Password: (*) </label>
				<div class="right-login">
					<input class="input-right" type="password" id="password" name="password">
					<br/ ><label for="password" class="error"></label>
				</div>
				<div class="clr"></div>
				<label class="left-login">Confirm pw: (*) </label>
				<div class="right-login">
					<input class="input-right" type="password" name="repassword">
					<br/ ><label for="repassword" class="error"></label>
				</div>
				<div class="clr"></div>
				<label class="left-login">Email: (*) </label>
				<div class="right-login">
					<input class="input-right" type="text" name="email">
					<br/ ><label for="email" class="error"></label>
				</div>
				<div class="clr"></div>
				<label class="left-login">Avatar: </label>
				<div class="right-login">
					<input class="input-right" type="file" name="avatar">
					<br/>
					<?php if ($session->has('errorRegister')) { ?>
						<label class="error">
							<?php echo $session->get('errorRegister'); ?>
							<?php $session->remove('errorRegister'); ?>
						</label>
					<?php } ?>
				</div>
				<div class="clr"></div>
				<input type="submit" class="button" name="register" value="Create">
			</form>
		</div>
		<div class="clr">
		</div>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php"?>
