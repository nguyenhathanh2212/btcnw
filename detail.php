<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/header.php" ?>
<?php 
	if (!empty($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		header("location:/404");
		die();
	}
?>
	<!--content-->
	<div class="content">
		<?php 
			$querySQL = "SELECT tinraovat.*, username, diachi, email, tendanhmuc,id_danhmuc 
				FROM tinraovat 
				INNER JOIN users ON tinraovat.id_user=users.id_user 
				INNER JOIN danhmucsanpham ON tinraovat.id_danhmucsanpham=danhmucsanpham.id_danhmuc
				WHERE id_tinraovat={$id}";

			$result = $DB->select($querySQL)[0];
			$result['ngaydang'] = date('d-m-Y',strtotime($result['ngaydang']));
			$urlCate = "/category/".convertUtf8ToLatin($result['tendanhmuc']) . '-' . $result['id_danhmuc'];
		?>
		<div class="category-title">
			<a href="/">Trang chủ</a>
			<div class="fa fa-caret-right"></div>
			<a href="<?php echo $urlCate?>"><?php echo $result['tendanhmuc']?></a>
		</div>
		<div class="main-content">

			<div class="header-title-det header-title">
				<div class="header-list-a">
					<div class="icon-a fa fa-flag"></div>
					<a href="">
						<?php echo $result['tentinraovat']?>
					</a>
				</div>
				<div class="info-new">
					<ul>
						<li>Ngày đăng: <?php echo $result['ngaydang']?></li>
						/
						<li>Mã tin: <?php echo $id?></li>
						/
						<li>Đăng bởi: <a href="timeline.php?idUser=<?php echo $result['id_user']?>" class="user" alt=""><?php echo $result['username']?></a></li>
					</ul>
				</div>
			</div>
			<div class="info-product">
				<div class="left-info">
					<ul class="bxslider">
						<li><img src="<?php echo '/files/' . $result['picture']?>" /></li>
					</ul>
					<div class="contact-info">
						<h2><span class="fa fa-thumb-tack"></span> THÔNG TIN LIÊN HỆ</h2>
						<ul>
							<li><span class="fa fa-caret-right"></span>Trang cá nhân: <a href="timeline.php?idUser=<?php echo $result['id_user']?>" class="user" alt=""><?php echo $result['username']?></a></li>
							<li><span class="fa fa-caret-right"></span>Địa chỉ: <span><?php echo $result['diachi']?></span></li>
							<li><span class="fa fa-caret-right"></span>Số điện thoại: <span><?php echo $result['sodienthoai']?></span></li>
							<li><span class="fa fa-caret-right"></span>Email: <span><?php echo $result['email']?></span></li>
							<li><span class="fa fa-caret-right"></span>Facebook: <a href="http://fb.com/tieucuong231" target="_blank">tieucuong231</a></li>
						</ul>
						<div class="contact-button">
							<a href="mailto:<?php echo $result['email']?>" class="fa fa-envelope">
								Gửi mail
							</a>
						</div>
					</div>
				</div>
				<div class="right-info">
					<h1><?php echo $result['gia']?><sup>đ</sup></h1>
					<h3><?php echo $result['noiban']?></h3>
					<p>
						<?php echo $result['mota']?>
					</p>
				</div>
			</div>
			<div class="user-comment">
				<div class="comments-tdk">
		            <div class="comment-header">
							<h2><span class="fa fa-comment-o"></span> BÌNH LUẬN</h2>
					</div>
		            <form id="<?php echo $id?>" action="" method="POST" class="form-cmt" >
		                <div class="row infor-cmt">
		                    <div class="col-sm-6">
		                        <input type="text" name="hoten" id="hoten-sub" class="infor" placeholder="Nhập họ tên">
		                    </div>
		                    <div class="col-sm-6">
		                        <input type="email" name="email" id="email-sub" class="infor" placeholder="Nhập email">
		                    </div>
		                </div>
		                <textarea class="content-cmt" name="content" placeholder="Viết nội dung bình luận"></textarea>
		                <input type="submit" name="binhluan" id="binhluan" class="binhluan sub" value="Đăng bình luận"/>
		            </form>
		        </div>
		        <div class="list-cmt">
		            <ul class="ul-list-cmt">
		                <?php
		                    $queryCmt = "SELECT * FROM comment 
			                    WHERE id_tinraovat={$id} 
			                    ORDER BY ngaycmt DESC ";

		                    $resultCmt = $DB->select($queryCmt);

		                    foreach ($resultCmt as $comment) {
		                        $dayCreateCmt=date("d/m/Y", strtotime($comment['ngaycmt']));
		                        $hourCreateCmt=date("H:i:s", strtotime($comment['ngaycmt']));
		                ?>
			                <li class="li-list-cmt">
			                    <h4><?php echo $comment['tennguoicmt'] ?></h4>
			                    <div  class="detail-cmt">
			                        <span><?php echo $hourCreateCmt?></span> | <span><?php echo $dayCreateCmt?></span> | <span><?php echo $comment['email'] ?></span>
			                    </div>
			                    <p><?php echo $comment['noidung'] ?></p>
			                </li>
		                <?php } ?>
		            </ul>
		        </div>
			</div>
		</div>
		
		<div class="all-new">
			<div class="header-list">
				<div class="fa fa-star"></div>
				<a href="" title="">TIN LIÊN QUAN</a>
			</div>
			<div class="list-all-new">
				<ul>
					<?php 
						$querySQL = "SELECT tinraovat.*, username 
							FROM tinraovat 
							INNER JOIN users ON tinraovat.id_user=users.id_user 
							WHERE id_tinraovat != {$id} 
							AND id_danhmucsanpham = {$result['id_danhmuc']} LIMIT 5, 5";

						$resultNews = $DB->select($querySQL);

						foreach ($resultNews as $resultNew) {
							$url = "/detail/" . convertUtf8ToLatin($resultNew['tentinraovat']) . '-' . $resultNew['id_tinraovat'] . ".html";
					?>
						<li>
							<a href="<?php echo $url ?>" title="">
								<h2><?php echo $resultNew['tentinraovat']?></h2>
								<span class="place"><?php echo $resultNew['noiban'] ?></span><br/>
								<img src="<?php echo '/files/' . $resultNew['picture'] ?>" title="Tuyển dụng" alt=""/>
								<br/>
								<span class="price"><?php echo $resultNew['gia'] ?><sup>đ</sup></span>
							</a>
							<br/>
							<h4>
								Đăng bởi 
								<a href="timeline.php?idUser=<?php echo $resultNew['id_user']?>" class="user" alt="">
									<?php echo $resultNew['username'] ?>
								</a>
							</h4>
						</li>
					<?php }?>
				</ul>	
			</div>
			<div class="list-all-new">
				<ul>
					<?php 
						$querySQL = "SELECT tinraovat.*, username 
							FROM tinraovat 
							INNER JOIN users ON tinraovat.id_user=users.id_user 
							WHERE id_tinraovat != {$id} 
							AND id_danhmucsanpham = {$result['id_danhmuc']} LIMIT 0, 5";

						$resultNews = $DB->select($querySQL);

						foreach ($resultNews as $resultNew) {
							$url = "/detail/" . convertUtf8ToLatin($resultNew['tentinraovat']) . '-' . $resultNew['id_tinraovat'] . ".html";	
					?>
						<li>
							<a href="<?php echo $url?>" title="">
								<h2><?php echo $resultNew['tentinraovat'] ?></h2>
								<span class="place"><?php echo $resultNew['noiban'] ?></span><br/>
								<img src="<?php echo '/files/' . $resultNew['picture'] ?>" title="Tuyển dụng" alt=""/>
								<br/>
								<span class="price"><?php echo $resultNew['gia'] ?><sup>đ</sup></span>
							</a>
							<br/>
							<h4>
								Đăng bởi 
								<a href="timeline.php?idUser=<?php echo $resultNew['id_user'] ?>" class="user" alt="">
									<?php echo $resultNew['username'] ?>
								</a>
							</h4>
						</li>
					<?php } ?>
				</ul>					
			</div>
		</div>
	</div>
	<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php" ?>