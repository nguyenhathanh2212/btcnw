<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	<!--content-->
	<div class="content">
			<h2 class="tit"><i class="fa fa-user"></i>  Sửa user</h2>
			<?php
				if(!empty($_GET['idUser'])){
					$idUser=$_GET['idUser'];
				}else{
					header("location:index.php");
				}
				$queryUser= "SELECT * FROM users WHERE id_user='{$idUser}'";
				$resultUser=$mySQLI->query($queryUser);
				$arUser=mysqli_fetch_assoc($resultUser);
				$username=$arUser['username'];
				$email=$arUser['email'];
				$passwordUser=$arUser['password'];
			?>
			<?php
				if(isset($_POST['edit'])){
					$username=trim($_POST['username']);
					$password=trim($_POST['editpassword']);
					$email=trim($_POST['email']);
					$cfPassword=trim($_POST['password']);
					if(md5($cfPassword)!=$passwordUser){
						echo "<span style='color:red;padding-left:40px;'>Mật khẩu xác nhận ko đúng !</span>";
					}else{
						$query="";
						if($password==""){
							$query="UPDATE users SET email='{$email}' WHERE id_user='{$idUser}'";
						}else{
							$password=md5($password);
							$query="UPDATE users SET password='{$password}',email='{$email}' WHERE id_user='{$idUser}'";
						}
						if($mySQLI->query($query)){
							header("location:index.php?msg=Sửa thành công");
						}else{
							header("location:index.php?msg=Sửa thất bại");
						}

					}
				}
			?>
			<form method="post" action="" class="form-adduser">
					<label class="left-login">Username : (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="username" value="<?php echo $username?>" readonly="readonly">
						<br/ ><label for="username" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Password: </label>
					<div class="right-login">
						<input class="input-right" type="password" name="editpassword">
						<br/ ><label for="editpassword" ></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Email: (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="email" value="<?php echo $email?>">
						<br/ ><label for="email" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Confirm password: (*)</label>
					<div class="right-login">
						<input class="input-right" type="password" name="password">
						<br/ ><label for="editpassword" ></label>
					</div>
					<div class="clr"></div>
					<input type="submit" class="button " name="edit" value="Edit">
			</form>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>