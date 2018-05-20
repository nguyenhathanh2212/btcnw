<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/header.php"; ?>
<!--content-->
	<div class="content">
		<div class="category-title">
			<a href="index.php">Trang chủ</a>
			<span class="fa fa-caret-right"></span>
			<a href="contacts.php">Liên hệ</a>
		</div>
		<div class="main-content">
			<div class="header-list">
				<div class="fa fa-id-card"></div>
				<a href="">THÔNG TIN LIÊN HỆ</a>
			</div>
			<div class="contact-content">
				<p>Bạn có thể liên lạc với chúng thôi thông qua thông tin dưới đây:</p>
				<div class="info-company">
					<h2>Công ty ....</h2>
					<ul>
						<li><span class="fa fa-caret-right"></span>Địa chỉ: <span>Cẩm Lệ, Đà Nẵng</span></li>
						<li><span class="fa fa-caret-right"></span>Số điện thoại: <span>+123456789</span></li>
						<li><span class="fa fa-caret-right"></span>Email: <span>congtyabc@gmail.com</span></li>
						<li><span class="fa fa-caret-right"></span>Facebook: <a href="http://fb.com/CongTyabc" target="_blank">Công ty</a></li>
					</ul>
				</div>
				<p>Hoặc bạn có thể gửi tin nhắn cho chúng tôi thông qua biểu mẫu dưới đây:</p>
				<div class="message-contact">
					<form>
						<div class="element-form">
							<label>Chủ đề:</label>
							<input type="text" name="topic" value="">	
						</div>
						<div class="element-form">
							<label>Họ và tên:</label>
							<input type="text" name="fullname">	
						</div>
						<div class="element-form">
							<label>Điện thoại:</label>
							<input type="text" name="phone">	
						</div>
						<div class="element-form">
							<label>Email:</label>
							<input type="text" name="email">	
						</div>
						<div class="element-form">
							<label>Tin nhắn:</label>
							<textarea name="message"></textarea>	
						</div>
						<div class="button-form">
							<input type="button" name="reset" value="Reset">
							<input type="submit" name="submit" value="Gửi tin nhắn">		
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php" ?>