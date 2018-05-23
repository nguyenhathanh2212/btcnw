<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
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
	<div class="content">
		<h2 class="tit"><i class="fa fa-user-plus"></i>  Thêm user</h2>
		<form method="post" action="process.php" class="form-adduser">
			<label class="left-login">Username : (*)</label>
			<div class="right-login">
				<input class="input-right" type="text" name="username">
				<br/ ><label for="username" class="error"></label>
			</div>
			<div class="clr"></div>
			<label class="left-login">Password: (*)</label>
			<div class="right-login">
				<input class="input-right" id='password' type="password" name="password">
				<br/ ><label for="password" class="error"></label>
			</div>
			<div class="clr"></div>
			<label class="left-login">Confirm password: (*)</label>
			<div class="right-login">
				<input class="input-right" type="password" name="repassword">
				<br/ ><label for="repassword" class="error"></label>
			</div>
			<div class="clr"></div>
			<label class="left-login">Email: (*)</label>
			<div class="right-login">
				<input class="input-right" type="text" name="email">
				<br/ ><label for="email" class="error"></label>
			</div>
			<div class="clr"></div>
			<div class="clr"></div>
			<input type="submit" class="button" name="add" value="Add">
		</form>
	</div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>