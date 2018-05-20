<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/header.php" ?>
<?php 
	if(!empty($_GET['idUser'])){
		$idUser = $_GET['idUser'];
	} else {
		header("location:/404");
		die();
	}
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
	<div class="content">
		<div class="header-title">
			<div class="fa fa-user icon-a"></div>
			<a href="" title="">TRANG CÁ NHÂN</a>
		</div>
		<?php 
			$user = $DB->select("SELECT * FROM users WHERE id_user={$idUser}")[0];

			if(empty($user['avatar'])) {		
				$user['avatar'] = "avatarmacdinh.png";
			}

			if(empty($user['background'])) {
				$user['background'] = 'backgroundmacdinh.jpg';
			}
		?>
		<div class="background" style="background-image: url('<?php echo "/files/" . $user['background'] ?>');">
			<img src="<?php echo '/files/' . $user['avatar'] ?>" class="avatar"/>
			<div class="username"><?php echo $user['username'] ?></div>
		</div>
		<div class="user-infomation">
			<div class="introduce">
				<h2>GIỚI THIỆU</h2>
				<p><?php echo $user['info'] ?></p>
			</div>
			<div class="contact-info">
				<h2>THÔNG TIN LIÊN HỆ</h2>
				<ul>
					<li>Địa chỉ: <span><?php echo $user['diachi'] ?></span></li>
					<li>Số điện thoại: <span><?php echo $user['sodienthoai'] ?></span></li>
					<li>Email: <span><?php echo $user['email'] ?></span></li>
					<?php if ($session->has('UserAuthenticate') && $session->get('UserAuthenticate')['id_user'] == $idUser) { ?>
						<li>
							<a href="<?php echo "/edit-user/edit-" . $idUser ?>">Thay đổi thông tin</a>
						</li>
					<?php } ?>
				</ul>
				<?php if (!$session->has('UserAuthenticate') || ($session->has('UserAuthenticate') && $session->get('UserAuthenticate')['id_user'] != $idUser)) { ?>
					<div class="contact-button">
						<a href="mailto:<?php echo $user['email'] ?>" class="fa fa-envelope">
							Gửi mail
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="all-new">
			<div class="header-title">
				<div class="fa fa-star icon-a"></div>
				<a href="" title="">TIN ĐÃ ĐĂNG GẦN ĐÂY</a>
			</div>
			<div class="list-all-new">
				<ul>
					<?php 
						$query = "SELECT * FROM tinraovat 
							WHERE id_user= {$idUser} 
							ORDER BY id_tinraovat DESC LIMIT 10";

						$results = $DB->select($query);

						foreach ($results as $news) {
							$url="/detail/".convertUtf8ToLatin($news['tentinraovat']).'-'.$news['id_tinraovat'].".html";
					?>
						<li>
							<a href="<?php echo $url?>" title="">
								<h2><?php echo $news['tentinraovat']?></h2>
								<span class="place"><?php echo $news['noiban'] ?></span><br/>
								<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
								<br/>
								<span class="price"><?php echo $news['gia'] ?><sup>đ</sup></span>
							</a>
							<br/>
						</li>
					<?php } ?>
					<?php if (!count($results)) { ?>
						<div class="no-result">Không có bài đăng nào</div>
					<?php } ?>
				</ul>				
			</div>
		</div>
	</div>
	<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php" ?>
