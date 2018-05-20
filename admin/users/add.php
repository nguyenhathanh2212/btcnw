<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	<!--content-->
	<div class="content">
			
			<h2 class="tit"><i class="fa fa-user-plus"></i>  Thêm user</h2>
			<?php
				if(isset($_POST['add'])){
					$username=trim($_POST['username']);
					$password=trim($_POST['password']);
					$password=md5($password);
					$email=trim($_POST['email']);
					$queryUser="SELECT username FROM users";
					$resultUser=$mySQLI->query($queryUser);
					while ($arUser=mysqli_fetch_assoc($resultUser)) {
						$name=$arUser['username'];
						if($name==$username){
							header("location:index.php?msg=Username đã tồn tại");
							die();
						}
					}
					if($username!='admin'){
						$query="INSERT INTO users(username,password,email) VALUES ('{$username}','{$password}','{$email}')";
						if($mySQLI->query($query)){
							header("location:index.php?msg=Thêm thành công");
						}else{
							die();
						}
					}else{
						header("location:index.php?msg=Không thể thêm admin");
					}
				}
			?>
			<form method="post" action="" class="form-adduser">
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
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>